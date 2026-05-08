document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', handleLogin);
});

async function handleLogin(event) {
    event.preventDefault();

    // Clear previous errors
    document.getElementById('errorMessage').style.display = 'none';
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(el => el.textContent = '');

    const emailOrMobile = document.getElementById('emailOrMobile').value.trim();
    const password = document.getElementById('password').value;

    if (!emailOrMobile || !password) {
        showError('Please fill in all fields');
        return;
    }

    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    
    submitBtn.disabled = true;
    submitText.textContent = 'Logging in...';
    submitLoader.style.display = 'inline-block';

    try {
        const response = await fetch('http://localhost:3000/api/donors/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ emailOrMobile, password })
        });

        const result = await response.json();

        if (response.ok) {
            // Store donor info in sessionStorage
            sessionStorage.setItem('donor', JSON.stringify(result.donor));
            // Redirect to dashboard
            window.location.href = 'dashboard.html';
        } else {
            showError(result.message || 'Login failed. Please check your credentials.');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to connect to server. Please check if the server is running.');
    } finally {
        submitBtn.disabled = false;
        submitText.textContent = 'Login';
        submitLoader.style.display = 'none';
    }
}

function showError(message) {
    const errorBox = document.getElementById('errorMessage');
    const errorText = document.getElementById('errorText');
    errorText.textContent = message;
    errorBox.style.display = 'block';
    errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

