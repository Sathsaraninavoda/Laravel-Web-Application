// Authentication API Integration
class AuthAPI {
    constructor() {
        this.baseURL = window.location.origin + '/api';
        this.token = localStorage.getItem('auth_token');
        this.setupCSRF();
    }

    // Setup CSRF token for Laravel
    async setupCSRF() {
        try {
            const response = await fetch('/sanctum/csrf-cookie');
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                this.csrfToken = csrfToken.getAttribute('content');
            }
        } catch (error) {
            console.error('CSRF setup failed:', error);
        }
    }

    // Get headers for API requests
    getHeaders() {
        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        };

        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }

        if (this.csrfToken) {
            headers['X-CSRF-TOKEN'] = this.csrfToken;
        }

        return headers;
    }

    // Register new user
    async register(userData) {
        try {
            const response = await fetch(`${this.baseURL}/auth/register`, {
                method: 'POST',
                headers: this.getHeaders(),
                body: JSON.stringify(userData)
            });

            const data = await response.json();

            if (data.success) {
                this.token = data.token;
                localStorage.setItem('auth_token', this.token);
                localStorage.setItem('user', JSON.stringify(data.user));
            }

            return data;
        } catch (error) {
            console.error('Registration error:', error);
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Login user
    async login(credentials) {
        try {
            const response = await fetch(`${this.baseURL}/auth/login`, {
                method: 'POST',
                headers: this.getHeaders(),
                body: JSON.stringify(credentials)
            });

            const data = await response.json();

            if (data.success) {
                this.token = data.token;
                localStorage.setItem('auth_token', this.token);
                localStorage.setItem('user', JSON.stringify(data.user));
            }

            return data;
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Logout user
    async logout() {
        try {
            const response = await fetch(`${this.baseURL}/auth/logout`, {
                method: 'POST',
                headers: this.getHeaders()
            });

            const data = await response.json();

            // Clear local storage regardless of response
            this.token = null;
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');

            return data;
        } catch (error) {
            console.error('Logout error:', error);
            // Clear local storage even on error
            this.token = null;
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Get user profile
    async getProfile() {
        try {
            const response = await fetch(`${this.baseURL}/auth/user`, {
                method: 'GET',
                headers: this.getHeaders()
            });

            return await response.json();
        } catch (error) {
            console.error('Profile fetch error:', error);
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Update user profile
    async updateProfile(userData) {
        try {
            const response = await fetch(`${this.baseURL}/auth/user`, {
                method: 'PUT',
                headers: this.getHeaders(),
                body: JSON.stringify(userData)
            });

            return await response.json();
        } catch (error) {
            console.error('Profile update error:', error);
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Check if user is authenticated
    isAuthenticated() {
        return !!this.token;
    }

    // Get stored user data
    getUser() {
        const user = localStorage.getItem('user');
        return user ? JSON.parse(user) : null;
    }
}

// Initialize Auth API
const authAPI = new AuthAPI();

// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function() {
    
    // Handle Registration Form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const userData = {
                name: formData.get('name'),
                email: formData.get('email'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation')
            };

            const result = await authAPI.register(userData);
            
            if (result.success) {
                alert('Registration successful!');
                window.location.href = '/dashboard';
            } else {
                alert('Registration failed: ' + (result.message || 'Unknown error'));
                if (result.errors) {
                    console.error('Validation errors:', result.errors);
                }
            }
        });
    }

    // Handle Login Form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const credentials = {
                email: formData.get('email') || formData.get('username'),
                password: formData.get('password')
            };

            console.log('Attempting login with:', credentials);

            try {
                const result = await authAPI.login(credentials);
                
                console.log('Login result:', result);
                
                if (result.success) {
                    // Store user data and redirect based on role
                    console.log('Storing auth token:', result.token);
                    console.log('Storing user data:', result.user);
                    
                    localStorage.setItem('auth_token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));
                    
                    // Verify storage worked
                    const storedToken = localStorage.getItem('auth_token');
                    const storedUser = localStorage.getItem('user');
                    console.log('Verified stored token:', storedToken);
                    console.log('Verified stored user:', storedUser);
                    
                    // Simple redirect to dashboard without role parameter
                    console.log('Redirecting to dashboard...');
                    
                    // Use a small delay to ensure localStorage is written
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 100);
                } else {
                    alert('Login failed: ' + (result.message || 'Invalid credentials'));
                }
            } catch (error) {
                console.error('Login error:', error);
                alert('Login failed: Network error');
            }
        });
    }

    // Handle Logout Links
    const logoutLinks = document.querySelectorAll('[data-logout]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', async function(e) {
            e.preventDefault();
            
            try {
                // Clear local storage first
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                
                // Try API logout
                const result = await authAPI.logout();
                
                // Always redirect to home regardless of API result
                window.location.href = '/';
            } catch (error) {
                console.error('Logout error:', error);
                // Even if logout fails, clear local data and redirect
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                window.location.href = '/';
            }
        });
    });

    // Update UI based on authentication status
    updateAuthUI();
});

// Update UI elements based on authentication status
function updateAuthUI() {
    const isAuth = authAPI.isAuthenticated();
    const user = authAPI.getUser();

    // Show/hide elements based on auth status
    const authElements = document.querySelectorAll('[data-auth-show]');
    const guestElements = document.querySelectorAll('[data-guest-show]');

    authElements.forEach(el => {
        el.style.display = isAuth ? 'block' : 'none';
    });

    guestElements.forEach(el => {
        el.style.display = isAuth ? 'none' : 'block';
    });

    // Update user name displays
    if (user && user.name) {
        const userNameElements = document.querySelectorAll('[data-user-name]');
        userNameElements.forEach(el => {
            el.textContent = user.name;
        });
    }
}
