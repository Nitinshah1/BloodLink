let currentDonor = null;

document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged in
    const donorData = sessionStorage.getItem('donor');
    if (!donorData) {
        window.location.href = 'login.html';
        return;
    }

    currentDonor = JSON.parse(donorData);
    loadDashboard();

    // Event listeners
    document.getElementById('availabilityToggle').addEventListener('click', toggleAvailability);
    document.getElementById('editBtn').addEventListener('click', showEditForm);
    document.getElementById('cancelEditBtn').addEventListener('click', hideEditForm);
    document.getElementById('editForm').addEventListener('submit', handleProfileUpdate);
    document.getElementById('logoutBtn').addEventListener('click', handleLogout);

    // Set max date for last donation
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('editLastDonation').setAttribute('max', today);
});

async function loadDashboard() {
    try {
        const response = await fetch(`http://localhost:3000/api/donors/${currentDonor.id}`);
        const donor = await response.json();

        if (response.ok) {
            currentDonor = donor;
            sessionStorage.setItem('donor', JSON.stringify(donor));
            displayProfile(donor);
            updateAvailabilityToggle(donor.isAvailable === 1);
            document.getElementById('loadingMessage').style.display = 'none';
            document.getElementById('dashboardContent').style.display = 'block';
        } else {
            showError('Failed to load profile. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to connect to server.');
    }
}

function displayProfile(donor) {
    document.getElementById('profileName').textContent = donor.name || 'N/A';
    document.getElementById('profileEmail').textContent = donor.email || 'Not provided';
    document.getElementById('profileMobile').textContent = donor.mobile || 'N/A';
    document.getElementById('profileBloodGroup').textContent = donor.bloodGroup || 'N/A';
    document.getElementById('profileCity').textContent = donor.city || 'N/A';
    document.getElementById('profileLastDonation').textContent = 
        donor.lastDonation ? new Date(donor.lastDonation).toLocaleDateString() : 'Never';

    // Populate edit form
    document.getElementById('editName').value = donor.name || '';
    document.getElementById('editEmail').value = donor.email || '';
    document.getElementById('editMobile').value = donor.mobile || '';
    document.getElementById('editBloodGroup').value = donor.bloodGroup || '';
    document.getElementById('editCity').value = donor.city || '';
    document.getElementById('editLastDonation').value = donor.lastDonation || '';
}

function updateAvailabilityToggle(isAvailable) {
    const toggle = document.getElementById('availabilityToggle');
    const statusText = document.getElementById('availabilityStatus');
    
    if (isAvailable) {
        toggle.classList.remove('unavailable');
        toggle.classList.add('available');
        toggle.querySelector('#toggleText').textContent = 'ON';
        statusText.textContent = 'Available for Donation';
        statusText.classList.remove('unavailable');
        statusText.classList.add('available');
    } else {
        toggle.classList.remove('available');
        toggle.classList.add('unavailable');
        toggle.querySelector('#toggleText').textContent = 'OFF';
        statusText.textContent = 'Not Available';
        statusText.classList.remove('available');
        statusText.classList.add('unavailable');
    }
}

async function toggleAvailability() {
    const newStatus = !(currentDonor.isAvailable === 1);
    
    try {
        const response = await fetch(`http://localhost:3000/api/donors/${currentDonor.id}/availability`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ isAvailable: newStatus })
        });

        const result = await response.json();

        if (response.ok) {
            currentDonor.isAvailable = newStatus ? 1 : 0;
            sessionStorage.setItem('donor', JSON.stringify(currentDonor));
            updateAvailabilityToggle(newStatus);
            showSuccess('Availability updated successfully');
        } else {
            showError(result.message || 'Failed to update availability');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to update availability');
    }
}

function showEditForm() {
    document.getElementById('profileView').style.display = 'none';
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('editBtn').style.display = 'none';
}

function hideEditForm() {
    document.getElementById('profileView').style.display = 'grid';
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('editBtn').style.display = 'block';
    // Reset form to current values
    displayProfile(currentDonor);
}

async function handleProfileUpdate(event) {
    event.preventDefault();

    const formData = {
        name: document.getElementById('editName').value.trim(),
        email: document.getElementById('editEmail').value.trim() || null,
        mobile: document.getElementById('editMobile').value.replace(/\s+/g, ''),
        bloodGroup: document.getElementById('editBloodGroup').value,
        city: document.getElementById('editCity').value.trim(),
        lastDonation: document.getElementById('editLastDonation').value || null
    };

    const password = document.getElementById('editPassword').value;
    if (password) {
        formData.password = password;
    }

    try {
        const response = await fetch(`http://localhost:3000/api/donors/${currentDonor.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (response.ok) {
            await loadDashboard(); // Reload to get updated data
            hideEditForm();
            showSuccess('Profile updated successfully');
            document.getElementById('editPassword').value = ''; // Clear password field
        } else {
            showError(result.message || 'Failed to update profile');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to update profile');
    }
}

function handleLogout() {
    sessionStorage.removeItem('donor');
    window.location.href = 'index.html';
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

