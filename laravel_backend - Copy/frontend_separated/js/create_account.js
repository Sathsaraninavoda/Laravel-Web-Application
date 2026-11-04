// Form validation and handling
const form = document.getElementById('registerForm');
const inputs = form.querySelectorAll('input[required]');

// Real-time validation
inputs.forEach(input => {
    input.addEventListener('blur', () => validateField(input));
    input.addEventListener('input', () => {
        if (input.classList.contains('is-invalid')) {
            validateField(input);
        }
    });
});

// Password strength checker
document.getElementById('password').addEventListener('input', checkPasswordStrength);
document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

// Form submission
form.addEventListener('submit', handleSubmit);

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let message = '';
    
    // Remove existing validation classes
    field.classList.remove('is-valid', 'is-invalid');
    
    switch (field.name) {
        case 'firstName':
        case 'lastName':
            if (!value) {
                isValid = false;
                message = 'This field is required';
            } else if (value.length < 2) {
                isValid = false;
                message = 'Name must be at least 2 characters';
            } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                isValid = false;
                message = 'Name can only contain letters and spaces';
            }
            break;
            
        case 'email':
            if (!value) {
                isValid = false;
                message = 'Email is required';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address';
            }
            break;
            
        case 'password':
            if (!value) {
                isValid = false;
                message = 'Password is required';
            } else if (!isPasswordStrong(value)) {
                isValid = false;
                message = 'Password does not meet requirements';
            }
            break;
            
        case 'confirmPassword':
            const password = document.getElementById('password').value;
            if (!value) {
                isValid = false;
                message = 'Please confirm your password';
            } else if (value !== password) {
                isValid = false;
                message = 'Passwords do not match';
            }
            break;
            
        case 'phone':
            if (value && !/^\+?94\s?[0-9\s\-]{8,12}$/.test(value)) {
                isValid = false;
                message = 'Please enter a valid Sri Lankan phone number';
            }
            break;
            
        case 'terms':
            if (!field.checked) {
                isValid = false;
                message = 'You must agree to the terms and conditions';
            }
            break;
    }
    
    // Apply validation styling
    if (isValid) {
        field.classList.add('is-valid');
        const validFeedback = field.parentNode.querySelector('.valid-feedback');
        if (validFeedback) {
            validFeedback.textContent = field.name === 'email' ? 'Email looks good!' : 
                                       field.name === 'confirmPassword' ? 'Passwords match!' : '';
        }
    } else {
        field.classList.add('is-invalid');
        const invalidFeedback = field.parentNode.querySelector('.invalid-feedback');
        if (invalidFeedback) {
            invalidFeedback.textContent = message;
        }
    }
    
    return isValid;
}

function isPasswordStrong(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar;
}

function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthMeter = document.getElementById('strengthMeter');
    
    let strength = 0;
    let color = '#dc3545'; // Red
    
    if (password.length >= 8) strength += 25;
    if (/[A-Z]/.test(password)) strength += 25;
    if (/[a-z]/.test(password)) strength += 25;
    if (/\d/.test(password)) strength += 12.5;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 12.5;
    
    if (strength >= 75) color = '#28a745'; // Green
    else if (strength >= 50) color = '#ffc107'; // Yellow
    else if (strength >= 25) color = '#fd7e14'; // Orange
    
    strengthMeter.style.width = strength + '%';
    strengthMeter.style.backgroundColor = color;
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (confirmPassword && password !== confirmPassword) {
        validateField(document.getElementById('confirmPassword'));
    } else if (confirmPassword && password === confirmPassword) {
        validateField(document.getElementById('confirmPassword'));
    }
}

function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + 'ToggleIcon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function resetForm() {
    form.reset();
    // Remove all validation classes
    form.querySelectorAll('.form-control').forEach(input => {
        input.classList.remove('is-valid', 'is-invalid');
    });
    // Reset password strength meter
    document.getElementById('strengthMeter').style.width = '0%';
}

function handleSubmit(e) {
    e.preventDefault();
    
    // Validate all required fields
    let isFormValid = true;
    inputs.forEach(input => {
        if (!validateField(input)) {
            isFormValid = false;
        }
    });
    
    if (!isFormValid) {
        return;
    }
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.loading-spinner');
    const btnText = submitBtn.querySelector('.btn-text');
    
    spinner.style.display = 'inline-block';
    btnText.textContent = 'Creating Account...';
    submitBtn.disabled = true;
    
    // Collect form data
    const formData = new FormData(form);
    const userData = Object.fromEntries(formData);
    console.log('User Registration Data:', userData);
    
    // Make real API call to Laravel backend
    authAPI.register(userData).then(result => {
        // Hide loading state
        spinner.style.display = 'none';
        btnText.textContent = 'Create Account';
        submitBtn.disabled = false;
        
        if (result.success) {
            // Show success message
            document.getElementById('successMessage').style.display = 'block';
            form.style.display = 'none';
            
            // Redirect to dashboard after 2 seconds
            setTimeout(() => {
                authAPI.redirectToDashboard();
            }, 2000);
        } else {
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger';
            errorDiv.textContent = result.message || 'Registration failed. Please try again.';
            
            if (result.errors) {
                const errorList = document.createElement('ul');
                Object.values(result.errors).forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = Array.isArray(error) ? error[0] : error;
                    errorList.appendChild(li);
                });
                errorDiv.appendChild(errorList);
            }
            
            form.insertBefore(errorDiv, form.firstChild);
        }
    }).catch(error => {
        // Hide loading state
        spinner.style.display = 'none';
        btnText.textContent = 'Create Account';
        submitBtn.disabled = false;
        
        // Show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger';
        errorDiv.textContent = 'Network error occurred. Please try again.';
        form.insertBefore(errorDiv, form.firstChild);
        
        console.error('Registration error:', error);
    });
}