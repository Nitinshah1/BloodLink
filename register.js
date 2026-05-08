// Set max date for last donation to today
document.addEventListener('DOMContentLoaded', function() {
    const lastDonationInput = document.getElementById('lastDonation');
    const today = new Date().toISOString().split('T')[0];
    lastDonationInput.setAttribute('max', today);

    // Form submission handler
    const form = document.getElementById('donorForm');
    form.addEventListener('submit', handleSubmit);

    // Real-time validation
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearError);
    });
});

function validateField(event) {
    const field = event.target;
    const errorElement = document.getElementById(field.id + 'Error');
    
    if (!errorElement) return;

    // Clear previous error
    errorElement.textContent = '';

    // Validate required fields
    if (field.hasAttribute('required') && !field.value.trim()) {
        errorElement.textContent = 'This field is required';
        field.style.borderColor = '#dc3545';
        return false;
    }

    // Validate mobile number
    if (field.id === 'mobile' && field.value) {
        const mobileRegex = /^[0-9]{10}$/;
        if (!mobileRegex.test(field.value.replace(/\s+/g, ''))) {
            errorElement.textContent = 'Please enter a valid 10-digit mobile number';
            field.style.borderColor = '#dc3545';
            return false;
        }
    }

    // Validate date (should not be in future)
    if (field.type === 'date' && field.value) {
        const selectedDate = new Date(field.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (selectedDate > today) {
            errorElement.textContent = 'Date cannot be in the future';
            field.style.borderColor = '#dc3545';
            return false;
        }
    }

    field.style.borderColor = '#e0e0e0';
    return true;
}

function clearError(event) {
    const field = event.target;
    const errorElement = document.getElementById(field.id + 'Error');
    if (errorElement) {
        errorElement.textContent = '';
        field.style.borderColor = '#e0e0e0';
    }
}

async function handleSubmit(event) {
    event.preventDefault();

    // Clear previous messages
    document.getElementById('successMessage').style.display = 'none';
    document.getElementById('errorMessage').style.display = 'none';

    // Validate all fields
    const form = event.target;
    const inputs = form.querySelectorAll('input[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!validateField({ target: input })) {
            isValid = false;
        }
    });

    if (!isValid) {
        showError('Please fill in all required fields correctly.');
        return;
    }

    // Get form data
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    
    // Validate email if password is provided
    if (password && !email) {
        showError('Email is required when setting a password.');
        return;
    }

    // Validate password length if provided
    if (password && password.length < 6) {
        showError('Password must be at least 6 characters long.');
        return;
    }

    const formData = {
        name: document.getElementById('name').value.trim(),
        email: email || null,
        bloodGroup: document.getElementById('bloodGroup').value,
        city: document.getElementById('city').value.trim(),
        mobile: document.getElementById('mobile').value.replace(/\s+/g, ''),
        password: password || null,
        lastDonation: document.getElementById('lastDonation').value || null
    };

    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    
    submitBtn.disabled = true;
    submitText.textContent = 'Registering...';
    submitLoader.style.display = 'inline-block';

    try {
        // Send data to backend
        const response = await fetch('http://localhost:3000/api/donors', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (response.ok) {
            // Success
            document.getElementById('successMessage').style.display = 'block';
            form.reset();
            
            // Scroll to success message
            document.getElementById('successMessage').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'nearest' 
            });

            // Reset form after 3 seconds
            setTimeout(() => {
                window.location.href = 'index.html';
            }, 3000);
        } else {
            // Error from server
            showError(result.message || 'Registration failed. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to connect to server. Please follow these steps:\n\n1. Open Command Prompt in this folder\n2. Run: npm install (if not done)\n3. Run: npm start\n4. Wait for "Server is running" message\n5. Then try registering again.\n\nOr double-click start-server.bat file.');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitText.textContent = 'Register as Donor';
        submitLoader.style.display = 'none';
    }
}

function showError(message) {
    const errorBox = document.getElementById('errorMessage');
    const errorText = document.getElementById('errorText');
    // Replace \n with <br> for line breaks
    errorText.innerHTML = message.replace(/\n/g, '<br>');
    errorBox.style.display = 'block';
    
    // Scroll to error message
    errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

