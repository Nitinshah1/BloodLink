# Blood Donor Matching System

A clean and simple Blood Donor Matching System, designed for easy use by donors, patients, and visitors.

## Features

- **Clean and minimal design** - Easy to understand and navigate
- **Home Page** - Simple landing page with main actions
- **Donor Registration** - Quick registration with email/password support
- **Donor Login & Dashboard** - Secure login and profile management
  - Availability toggle (ON/OFF) for donation requests
  - Edit profile information
  - View donation history
- **Blood Search Page** - Fast search for patients/attendants
  - Filter by blood group and city
  - Display available donors with contact information
  - One-click calling functionality
- **Admin Panel** - Management interface
  - View all registered donors
  - Delete fake or inactive donors
  - Statistics by blood group
  - Total and available donor counts
- **Database Integration** - SQLite database with password hashing
- **Form Validation** - Real-time validation for all forms
- **Emergency-friendly** - Simple interface suitable for urgent situations
- **Responsive design** - Works on desktop, tablet, and mobile devices

## Setup Instructions

### Prerequisites
- Node.js (v14 or higher) - [Download here](https://nodejs.org/)
- npm (comes with Node.js)

### Quick Start

#### Option 1: Using npm (Recommended)
```bash
# Install dependencies
npm install

# Start the server
npm start
```

#### Option 2: Using Start Scripts
- **Windows**: Double-click `start-server.bat` or run it from command prompt
- **Linux/Mac**: Run `chmod +x start-server.sh && ./start-server.sh`

#### Option 3: Manual Start
```bash
# Install dependencies (first time only)
npm install

# Start the server
node server.js
```

The server will start on `http://localhost:3000`

**Note**: Make sure port 3000 is not already in use. If it is, you can change the PORT in `server.js`.

3. Open your browser and navigate to:
   - Home page: `http://localhost:3000/index.html`
   - Registration: `http://localhost:3000/register.html`
   - Donor Login: `http://localhost:3000/login.html`
   - Search Blood: `http://localhost:3000/search.html`
   - Admin Panel: `http://localhost:3000/admin.html`

## File Structure

### Frontend
- `index.html` - Home page
- `register.html` - Donor registration page
- `login.html` - Donor login page
- `dashboard.html` - Donor dashboard with availability toggle
- `search.html` - Blood search page for patients
- `admin.html` - Admin panel for management
- `styles.css` - Main styling
- `register.css` - Registration/login page styles
- `dashboard.css` - Dashboard page styles
- `search.css` - Search page styles
- `admin.css` - Admin panel styles
- `script.js` - Home page functionality
- `register.js` - Registration form handling
- `login.js` - Login functionality
- `dashboard.js` - Dashboard functionality
- `search.js` - Search functionality
- `admin.js` - Admin panel functionality

### Backend
- `server.js` - Express server with API endpoints
- `package.json` - Node.js dependencies
- `donors.db` - SQLite database (created automatically)

## API Endpoints

### Donor Endpoints
- `POST /api/donors` - Register a new donor
- `GET /api/donors` - Get available donors (supports query params: `bloodGroup`, `city`)
- `GET /api/donors/:id` - Get donor by ID
- `POST /api/donors/login` - Donor login (email/mobile + password)
- `PATCH /api/donors/:id/availability` - Update availability status
- `PATCH /api/donors/:id` - Update donor profile

### Admin Endpoints
- `POST /api/admin/login` - Admin login
- `GET /api/admin/donors` - Get all donors (admin view)
- `GET /api/admin/statistics` - Get statistics by blood group
- `DELETE /api/admin/donors/:id` - Delete a donor

### Utility
- `GET /api/health` - Health check endpoint

## Database Schema

### Donors Table
- `id` - Primary key
- `name` - Donor's full name
- `email` - Email address (optional, unique)
- `mobile` - Mobile number (unique, 10 digits)
- `password` - Hashed password (bcrypt)
- `bloodGroup` - Blood group (A+, A-, B+, B-, AB+, AB-, O+, O-)
- `city` - City location
- `lastDonation` - Last donation date (optional)
- `isAvailable` - Availability status (1 = available, 0 = unavailable)
- `createdAt` - Registration timestamp

### Admins Table
- `id` - Primary key
- `username` - Admin username (unique)
- `password` - Hashed password (bcrypt)
- `createdAt` - Creation timestamp

**Default Admin Credentials:**
- Username: `admin`
- Password: `admin123`

## Usage

### For Donors
1. **Register**: Click "Register as Donor" on the home page
   - Fill in required information (name, blood group, city, mobile)
   - Optionally add email and password to enable login
2. **Login**: Use "Donor Login" link to access your dashboard
   - Login with email or mobile number + password
3. **Dashboard**: Manage your profile
   - Toggle availability ON/OFF for donation requests
   - Edit your profile information
   - View your donation history

### For Patients/Attendants
1. Click "Search Blood" on the home page
2. Select blood group (required) and city (optional)
3. View available donors with contact information
4. Click "Call" button to contact donors directly

### For Administrators
1. Access Admin Panel from home page footer
2. Login with admin credentials (default: admin/admin123)
3. View statistics by blood group
4. Manage donor list (view, delete)
5. Monitor total and available donor counts

## Development

For development with auto-reload (restarts server on file changes):
```bash
npm run dev
```

(Requires `nodemon` to be installed - it's included in devDependencies)

## Troubleshooting

### Server won't start
1. **Port already in use**: Change PORT in `server.js` or stop the process using port 3000
2. **Node.js not installed**: Install Node.js from https://nodejs.org/
3. **Dependencies missing**: Run `npm install` again

### Database errors
- The database file (`donors.db`) is created automatically
- If you encounter database errors, delete `donors.db` and restart the server (this will reset all data)

### Connection errors in browser
- Make sure the server is running (check terminal for "Server is running" message)
- Verify you're accessing `http://localhost:3000` (not `file://`)
- Check browser console for CORS or network errors

### Login issues
- Default admin: username=`admin`, password=`admin123`
- For donors: Make sure you registered with email and password
- Check that password is at least 6 characters

