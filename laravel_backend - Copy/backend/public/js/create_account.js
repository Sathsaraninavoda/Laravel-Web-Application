(function () {
    const form = document.getElementById('registerForm');
    if (!form) {
        return;
    }

    const inputs = form.querySelectorAll('input[required]');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const strengthMeter = document.getElementById('strengthMeter');
    const submitButton = form.querySelector('button[type="submit"]');
    const spinner = submitButton ? submitButton.querySelector('.loading-spinner') : null;
    const buttonText = submitButton ? submitButton.querySelector('.btn-text') : null;

    inputs.forEach((input) => {
        input.addEventListener('blur', () => validateField(input));
        input.addEventListener('input', () => {
            if (input.classList.contains('is-invalid')) {
                validateField(input);
            }
        });
    });

    if (passwordField) {
        passwordField.addEventListener('input', checkPasswordStrength);
    }

    if (confirmPasswordField) {
        confirmPasswordField.addEventListener('input', checkPasswordMatch);
    }

    form.addEventListener('submit', handleSubmit);

    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let message = '';

        field.classList.remove('is-valid', 'is-invalid');

        switch (field.name) {
            case 'first_name':
            case 'last_name':
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
                    message = 'Password does not meet the requirements';
                }
                break;

            case 'password_confirmation':
                if (!value) {
                    isValid = false;
                    message = 'Please confirm your password';
                } else if (passwordField && value !== passwordField.value) {
                    isValid = false;
                    message = 'Passwords do not match';
                }
                break;

            case 'phone':
                if (value && !/^\+?[0-9\s\-]{9,15}$/.test(value)) {
                    isValid = false;
                    message = 'Please enter a valid phone number';
                }
                break;

            case 'terms':
                if (!field.checked) {
                    isValid = false;
                    message = 'You must agree to the terms and conditions';
                }
                break;
        }

        if (isValid) {
            field.classList.add('is-valid');
            const validFeedback = field.parentNode.querySelector('.valid-feedback');
            if (validFeedback) {
                validFeedback.textContent = field.name === 'email'
                    ? 'Email looks good!'
                    : field.name === 'password_confirmation'
                        ? 'Passwords match!'
                        : '';
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
        return password.length >= 8
            && /[A-Z]/.test(password)
            && /[a-z]/.test(password)
            && /\d/.test(password)
            && /[!@#$%^&*(),.?":{}|<>]/.test(password);
    }

    function checkPasswordStrength() {
        if (!passwordField || !strengthMeter) {
            return;
        }

        const password = passwordField.value;
        let strength = 0;
        let color = '#dc3545';

        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[a-z]/.test(password)) strength += 25;
        if (/\d/.test(password)) strength += 12.5;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 12.5;

        if (strength >= 75) color = '#28a745';
        else if (strength >= 50) color = '#ffc107';
        else if (strength >= 25) color = '#fd7e14';

        strengthMeter.style.width = strength + '%';
        strengthMeter.style.backgroundColor = color;
    }

    function checkPasswordMatch() {
        if (!confirmPasswordField) {
            return;
        }

        validateField(confirmPasswordField);
    }

    function handleSubmit(event) {
        let isFormValid = true;

        inputs.forEach((input) => {
            if (!validateField(input)) {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            event.preventDefault();
            return;
        }

        if (spinner) {
            spinner.style.display = 'inline-block';
        }
        if (buttonText) {
            buttonText.textContent = 'Creating Account...';
        }
        if (submitButton) {
            submitButton.disabled = true;
        }
    }

    window.togglePassword = function (fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + 'ToggleIcon');
        if (!field || !icon) {
            return;
        }

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    };

    window.resetForm = function () {
        form.reset();
        form.querySelectorAll('.form-control').forEach((input) => {
            input.classList.remove('is-valid', 'is-invalid');
        });
        if (strengthMeter) {
            strengthMeter.style.width = '0%';
        }
    };
})();
