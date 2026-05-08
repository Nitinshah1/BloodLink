const express = require('express');
const sqlite3 = require('sqlite3').verbose();
const path = require('path');
const cors = require('cors');
const bcrypt = require('bcryptjs');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static('.')); // Serve static files

// Database setup - REMOVED: Database will be created manually through XAMPP/MySQL
// Please create your MySQL database and tables manually before running the server
const dbPath = path.join(__dirname, 'donors.db');
const db = new sqlite3.Database(dbPath, (err) => {
    if (err) {
        console.error('Error opening database:', err.message);
    } else {
        console.log('Connected to SQLite database');
        // Database tables should be created manually through XAMPP/MySQL
    }
});

// API Routes

// Register a new donor
app.post('/api/donors', async (req, res) => {
    const { name, email, bloodGroup, city, mobile, password, lastDonation } = req.body;

    // Validation
    if (!name || !bloodGroup || !city || !mobile) {
        return res.status(400).json({ 
            message: 'Please fill in all required fields' 
        });
    }

    // If password provided, require email
    if (password && !email) {
        return res.status(400).json({ 
            message: 'Email is required when setting a password' 
        });
    }

    // Validate mobile number format
    if (!/^[0-9]{10}$/.test(mobile)) {
        return res.status(400).json({ 
            message: 'Invalid mobile number format' 
        });
    }

    // Validate email if provided
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        return res.status(400).json({ 
            message: 'Invalid email format' 
        });
    }

    // Validate blood group
    const validBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if (!validBloodGroups.includes(bloodGroup)) {
        return res.status(400).json({ 
            message: 'Invalid blood group' 
        });
    }

    // Hash password if provided
    let hashedPassword = null;
    if (password) {
        if (password.length < 6) {
            return res.status(400).json({ 
                message: 'Password must be at least 6 characters' 
            });
        }
        hashedPassword = await bcrypt.hash(password, 10);
    }

    // Insert donor into database
    const sql = `INSERT INTO donors (name, email, bloodGroup, city, mobile, password, lastDonation, isAvailable) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, 1)`;
    
    db.run(sql, [name, email || null, bloodGroup, city, mobile, hashedPassword, lastDonation || null], function(err) {
        if (err) {
            if (err.message.includes('UNIQUE constraint failed')) {
                if (err.message.includes('email')) {
                    return res.status(400).json({ 
                        message: 'This email is already registered' 
                    });
                }
                return res.status(400).json({ 
                    message: 'This mobile number is already registered' 
                });
            }
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error saving donor information' 
            });
        }

        res.status(201).json({
            message: 'Donor registered successfully',
            donorId: this.lastID
        });
    });
});

// Get all donors (for search functionality - only available donors)
app.get('/api/donors', (req, res) => {
    const { bloodGroup, city } = req.query;
    let sql = 'SELECT id, name, bloodGroup, city, mobile FROM donors WHERE isAvailable = 1';
    const params = [];

    if (bloodGroup) {
        sql += ' AND bloodGroup = ?';
        params.push(bloodGroup);
    }

    if (city) {
        sql += ' AND city LIKE ?';
        params.push(`%${city}%`);
    }

    sql += ' ORDER BY createdAt DESC';

    db.all(sql, params, (err, rows) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error fetching donors' 
            });
        }

        res.json(rows);
    });
});

// Get all donors for admin (includes all fields except password)
app.get('/api/admin/donors', (req, res) => {
    db.all('SELECT id, name, email, mobile, bloodGroup, city, lastDonation, isAvailable, createdAt FROM donors ORDER BY createdAt DESC', (err, rows) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error fetching donors' 
            });
        }
        res.json(rows);
    });
});

// Get statistics for admin
app.get('/api/admin/statistics', (req, res) => {
    db.all(`SELECT 
        bloodGroup,
        COUNT(*) as count,
        SUM(CASE WHEN isAvailable = 1 THEN 1 ELSE 0 END) as available
        FROM donors 
        GROUP BY bloodGroup`, (err, rows) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error fetching statistics' 
            });
        }
        res.json(rows);
    });
});

// Get donor by ID (for dashboard - excludes password)
app.get('/api/donors/:id', (req, res) => {
    const { id } = req.params;
    
    db.get('SELECT id, name, email, mobile, bloodGroup, city, lastDonation, isAvailable, createdAt FROM donors WHERE id = ?', [id], (err, row) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error fetching donor' 
            });
        }

        if (!row) {
            return res.status(404).json({ 
                message: 'Donor not found' 
            });
        }

        res.json(row);
    });
});

// Donor login
app.post('/api/donors/login', async (req, res) => {
    const { emailOrMobile, password } = req.body;

    if (!emailOrMobile || !password) {
        return res.status(400).json({ 
            message: 'Email/mobile and password are required' 
        });
    }

    // Find donor by email or mobile
    db.get('SELECT * FROM donors WHERE email = ? OR mobile = ?', [emailOrMobile, emailOrMobile], async (err, donor) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error during login' 
            });
        }

        if (!donor) {
            return res.status(401).json({ 
                message: 'Invalid credentials' 
            });
        }

        if (!donor.password) {
            return res.status(401).json({ 
                message: 'No password set. Please contact support.' 
            });
        }

        const isValidPassword = await bcrypt.compare(password, donor.password);
        if (!isValidPassword) {
            return res.status(401).json({ 
                message: 'Invalid credentials' 
            });
        }

        // Return donor info without password
        const { password: _, ...donorInfo } = donor;
        res.json({
            message: 'Login successful',
            donor: donorInfo
        });
    });
});

// Update donor availability
app.patch('/api/donors/:id/availability', (req, res) => {
    const { id } = req.params;
    const { isAvailable } = req.body;

    if (typeof isAvailable !== 'boolean') {
        return res.status(400).json({ 
            message: 'isAvailable must be a boolean' 
        });
    }

    db.run('UPDATE donors SET isAvailable = ? WHERE id = ?', [isAvailable ? 1 : 0, id], function(err) {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error updating availability' 
            });
        }

        if (this.changes === 0) {
            return res.status(404).json({ 
                message: 'Donor not found' 
            });
        }

        res.json({
            message: 'Availability updated successfully',
            isAvailable: isAvailable
        });
    });
});

// Update donor profile
app.patch('/api/donors/:id', async (req, res) => {
    const { id } = req.params;
    const { name, email, bloodGroup, city, mobile, lastDonation, password } = req.body;

    const updates = [];
    const values = [];

    if (name) {
        updates.push('name = ?');
        values.push(name);
    }
    if (email) {
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            return res.status(400).json({ message: 'Invalid email format' });
        }
        updates.push('email = ?');
        values.push(email);
    }
    if (bloodGroup) {
        const validBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        if (!validBloodGroups.includes(bloodGroup)) {
            return res.status(400).json({ message: 'Invalid blood group' });
        }
        updates.push('bloodGroup = ?');
        values.push(bloodGroup);
    }
    if (city) {
        updates.push('city = ?');
        values.push(city);
    }
    if (mobile) {
        if (!/^[0-9]{10}$/.test(mobile)) {
            return res.status(400).json({ message: 'Invalid mobile number format' });
        }
        updates.push('mobile = ?');
        values.push(mobile);
    }
    if (lastDonation !== undefined) {
        updates.push('lastDonation = ?');
        values.push(lastDonation || null);
    }
    if (password) {
        if (password.length < 6) {
            return res.status(400).json({ message: 'Password must be at least 6 characters' });
        }
        const hashedPassword = await bcrypt.hash(password, 10);
        updates.push('password = ?');
        values.push(hashedPassword);
    }

    if (updates.length === 0) {
        return res.status(400).json({ message: 'No fields to update' });
    }

    values.push(id);
    const sql = `UPDATE donors SET ${updates.join(', ')} WHERE id = ?`;

    db.run(sql, values, function(err) {
        if (err) {
            if (err.message.includes('UNIQUE constraint failed')) {
                return res.status(400).json({ 
                    message: 'Email or mobile number already in use' 
                });
            }
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error updating profile' 
            });
        }

        if (this.changes === 0) {
            return res.status(404).json({ 
                message: 'Donor not found' 
            });
        }

        res.json({
            message: 'Profile updated successfully'
        });
    });
});

// Admin login
app.post('/api/admin/login', async (req, res) => {
    const { username, password } = req.body;

    if (!username || !password) {
        return res.status(400).json({ 
            message: 'Username and password are required' 
        });
    }

    db.get('SELECT * FROM admins WHERE username = ?', [username], async (err, admin) => {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error during login' 
            });
        }

        if (!admin) {
            return res.status(401).json({ 
                message: 'Invalid credentials' 
            });
        }

        const isValidPassword = await bcrypt.compare(password, admin.password);
        if (!isValidPassword) {
            return res.status(401).json({ 
                message: 'Invalid credentials' 
            });
        }

        res.json({
            message: 'Login successful',
            admin: { id: admin.id, username: admin.username }
        });
    });
});

// Delete donor (admin only)
app.delete('/api/admin/donors/:id', (req, res) => {
    const { id } = req.params;

    db.run('DELETE FROM donors WHERE id = ?', [id], function(err) {
        if (err) {
            console.error('Database error:', err.message);
            return res.status(500).json({ 
                message: 'Error deleting donor' 
            });
        }

        if (this.changes === 0) {
            return res.status(404).json({ 
                message: 'Donor not found' 
            });
        }

        res.json({
            message: 'Donor deleted successfully'
        });
    });
});

// Health check endpoint
app.get('/api/health', (req, res) => {
    res.json({ status: 'OK', message: 'Server is running' });
});

// Error handling middleware
app.use((err, req, res, next) => {
    console.error('Error:', err);
    res.status(500).json({ 
        message: 'Internal server error',
        error: process.env.NODE_ENV === 'development' ? err.message : undefined
    });
});

// 404 handler for API routes
app.use('/api/*', (req, res) => {
    res.status(404).json({ message: 'API endpoint not found' });
});

// Start server
app.listen(PORT, () => {
    console.log('='.repeat(50));
    console.log('🩸 Blood Donor Matching System Server');
    console.log('='.repeat(50));
    console.log(`✅ Server is running on http://localhost:${PORT}`);
    console.log(`📄 Home page: http://localhost:${PORT}/index.html`);
    console.log(`📝 Registration: http://localhost:${PORT}/register.html`);
    console.log(`🔍 Search: http://localhost:${PORT}/search.html`);
    console.log(`👤 Login: http://localhost:${PORT}/login.html`);
    console.log(`⚙️  Admin: http://localhost:${PORT}/admin.html`);
    console.log(`💚 Health check: http://localhost:${PORT}/api/health`);
    console.log('='.repeat(50));
    console.log('Press Ctrl+C to stop the server');
});

// Graceful shutdown
process.on('SIGINT', () => {
    if (db) {
        db.close((err) => {
            if (err) {
                console.error('Error closing database:', err.message);
            } else {
                console.log('Database connection closed');
            }
            process.exit(0);
        });
    } else {
        process.exit(0);
    }
});

