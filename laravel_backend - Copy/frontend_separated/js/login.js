// Login form handler
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    // Check if user is already authenticated
    if (authAPI && authAPI.isAuthenticated()) {
        authAPI.redirectToDashboard();
    }
});

function handleLogin(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const credentials = {
        email: formData.get('email'),
        password: formData.get('password')
    };
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Logging in...';
    submitBtn.disabled = true;
    
    // Clear any existing error messages
    const existingError = form.querySelector('.alert-danger');
    if (existingError) {
        existingError.remove();
    }
    
    // Perform login
    authAPI.login(credentials).then(result => {
        if (result.success) {
            // Redirect to dashboard
            authAPI.redirectToDashboard();
        } else {
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger';
            errorDiv.textContent = result.message || 'Login failed. Please check your credentials.';
            form.insertBefore(errorDiv, form.firstChild);
            
            // Reset button
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    }).catch(error => {
        // Show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger';
        errorDiv.textContent = 'Network error occurred. Please try again.';
        form.insertBefore(errorDiv, form.firstChild);
        
        // Reset button
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        
        console.error('Login error:', error);
    });
}

// Quick login function for testing (can be removed in production)
function quickLogin(role = 'customer') {
    const testCredentials = {
        admin: { email: 'admin@test.com', password: 'password123' },
        vendor: { email: 'vendor@test.com', password: 'password123' },
        customer: { email: 'customer@test.com', password: 'password123' }
    };
    
    const credentials = testCredentials[role];
    if (credentials) {
        authAPI.login(credentials).then(result => {
            if (result.success) {
                authAPI.redirectToDashboard();
            } else {
                console.log('Quick login failed:', result.message);
            }
        });
    }
}
