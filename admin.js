let isAdminLoggedIn = false;

document.addEventListener('DOMContentLoaded', function() {
    // Check if admin is logged in
    const adminData = sessionStorage.getItem('admin');
    if (adminData) {
        isAdminLoggedIn = true;
        showDashboard();
        loadData();
    }

    document.getElementById('adminLoginForm').addEventListener('submit', handleAdminLogin);
    document.getElementById('refreshBtn')?.addEventListener('click', loadData);
    document.getElementById('logoutBtn')?.addEventListener('click', handleLogout);
});

async function handleAdminLogin(event) {
    event.preventDefault();

    const username = document.getElementById('adminUsername').value.trim();
    const password = document.getElementById('adminPassword').value;

    if (!username || !password) {
        showLoginError('Please fill in all fields');
        return;
    }

    try {
        const response = await fetch('http://localhost:3000/api/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password })
        });

        const result = await response.json();

        if (response.ok) {
            sessionStorage.setItem('admin', JSON.stringify(result.admin));
            isAdminLoggedIn = true;
            showDashboard();
            loadData();
        } else {
            showLoginError(result.message || 'Invalid credentials');
        }
    } catch (error) {
        console.error('Error:', error);
        showLoginError('Unable to connect to server');
    }
}

function showDashboard() {
    document.getElementById('loginSection').style.display = 'none';
    document.getElementById('dashboardSection').style.display = 'block';
    document.getElementById('logoutBtn').style.display = 'inline-block';
}

function showLoginError(message) {
    const errorBox = document.getElementById('loginError');
    const errorText = document.getElementById('loginErrorText');
    errorText.textContent = message;
    errorBox.style.display = 'block';
}

async function loadData() {
    await Promise.all([loadStatistics(), loadDonors()]);
}

async function loadStatistics() {
    try {
        const response = await fetch('http://localhost:3000/api/admin/statistics');
        const stats = await response.json();

        if (response.ok) {
            displayStatistics(stats);
        }
    } catch (error) {
        console.error('Error loading statistics:', error);
    }
}

function displayStatistics(stats) {
    const grid = document.getElementById('statisticsGrid');
    grid.innerHTML = '';

    let totalDonors = 0;
    let totalAvailable = 0;

    stats.forEach(stat => {
        totalDonors += stat.count;
        totalAvailable += stat.available;

        const card = document.createElement('div');
        card.className = 'stat-card';
        card.innerHTML = `
            <h3>${stat.bloodGroup}</h3>
            <div class="stat-value">${stat.count}</div>
            <div class="stat-label">Total Donors</div>
            <div class="stat-label" style="margin-top: 8px; color: #28a745;">
                ${stat.available} Available
            </div>
        `;
        grid.appendChild(card);
    });

    // Add total card
    const totalCard = document.createElement('div');
    totalCard.className = 'stat-card';
    totalCard.style.borderLeftColor = '#28a745';
    totalCard.innerHTML = `
        <h3 style="color: #28a745;">Total</h3>
        <div class="stat-value">${totalDonors}</div>
        <div class="stat-label">All Donors</div>
        <div class="stat-label" style="margin-top: 8px; color: #28a745;">
            ${totalAvailable} Available
        </div>
    `;
    grid.insertBefore(totalCard, grid.firstChild);
}

async function loadDonors() {
    try {
        const response = await fetch('http://localhost:3000/api/admin/donors');
        const donors = await response.json();

        if (response.ok) {
            displayDonors(donors);
        } else {
            showError('Failed to load donors');
        }
    } catch (error) {
        console.error('Error loading donors:', error);
        showError('Unable to load donors');
    }
}

function displayDonors(donors) {
    const tbody = document.getElementById('donorsTableBody');
    const noDonors = document.getElementById('noDonors');

    if (donors.length === 0) {
        tbody.innerHTML = '';
        noDonors.style.display = 'block';
        return;
    }

    noDonors.style.display = 'none';
    tbody.innerHTML = '';

    donors.forEach(donor => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${donor.id}</td>
            <td>${donor.name}</td>
            <td>${donor.email || '-'}</td>
            <td>${donor.mobile}</td>
            <td><strong>${donor.bloodGroup}</strong></td>
            <td>${donor.city}</td>
            <td>
                <span class="availability-badge ${donor.isAvailable === 1 ? 'available' : 'unavailable'}">
                    ${donor.isAvailable === 1 ? 'Available' : 'Unavailable'}
                </span>
            </td>
            <td>${donor.lastDonation ? new Date(donor.lastDonation).toLocaleDateString() : 'Never'}</td>
            <td>
                <button class="btn-danger" onclick="deleteDonor(${donor.id}, '${donor.name}')">
                    Delete
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

async function deleteDonor(id, name) {
    if (!confirm(`Are you sure you want to delete donor "${name}"? This action cannot be undone.`)) {
        return;
    }

    try {
        const response = await fetch(`http://localhost:3000/api/admin/donors/${id}`, {
            method: 'DELETE'
        });

        const result = await response.json();

        if (response.ok) {
            showSuccess(`Donor "${name}" deleted successfully`);
            loadData();
        } else {
            showError(result.message || 'Failed to delete donor');
        }
    } catch (error) {
        console.error('Error deleting donor:', error);
        showError('Unable to delete donor');
    }
}

function handleLogout() {
    sessionStorage.removeItem('admin');
    isAdminLoggedIn = false;
    document.getElementById('loginSection').style.display = 'block';
    document.getElementById('dashboardSection').style.display = 'none';
    document.getElementById('logoutBtn').style.display = 'none';
    document.getElementById('adminLoginForm').reset();
}

function showSuccess(message) {
    const successBox = document.getElementById('successMessage');
    document.getElementById('successText').textContent = message;
    successBox.style.display = 'block';
    successBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    setTimeout(() => {
        successBox.style.display = 'none';
    }, 3000);
}

function showError(message) {
    const errorBox = document.getElementById('errorMessage');
    document.getElementById('errorText').textContent = message;
    errorBox.style.display = 'block';
    errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Make deleteDonor available globally
window.deleteDonor = deleteDonor;

