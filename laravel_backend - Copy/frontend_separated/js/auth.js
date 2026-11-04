// Authentication API Handler
class AuthAPI {
    constructor() {
        this.baseURL = 'http://localhost:8000/api'; // Adjust to your Laravel backend URL
        this.token = localStorage.getItem('auth_token');
    }

    // Set authentication headers
    getHeaders() {
        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        };
        
        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }
        
        return headers;
    }

    // Store auth data in localStorage
    storeAuthData(data) {
        localStorage.setItem('auth_token', data.token);
        localStorage.setItem('user', JSON.stringify(data.user));
        this.token = data.token;
        
        // Ensure role is properly stored
        if (data.user && data.user.role) {
            localStorage.setItem('user_role', data.user.role);
        }
        
        console.log('Auth data stored:', {
            token: data.token ? 'Present' : 'Missing',
            user: data.user,
            role: data.user ? data.user.role : 'undefined'
        });
    }

    // Clear auth data from localStorage
    clearAuthData() {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        localStorage.removeItem('user_role');
        this.token = null;
        console.log('Auth data cleared');
    }

    // Get stored user data
    getUser() {
        const userData = localStorage.getItem('user');
        if (userData) {
            const user = JSON.parse(userData);
            // Ensure role is present, fallback to stored role if missing
            if (!user.role) {
                const storedRole = localStorage.getItem('user_role');
                if (storedRole) {
                    user.role = storedRole;
                }
            }
            return user;
        }
        return null;
    }

    // Check if user is authenticated
    isAuthenticated() {
        return !!this.token && !!this.getUser();
    }

    // Register user
    async register(userData) {
        try {
            const response = await fetch(`${this.baseURL}/auth/register`, {
                method: 'POST',
                headers: this.getHeaders(),
                body: JSON.stringify(userData)
            });

            const data = await response.json();

            if (data.success) {
                this.storeAuthData(data);
                return { success: true, data: data };
            } else {
                return { success: false, message: data.message, errors: data.errors };
            }
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
                this.storeAuthData(data);
                return { success: true, data: data };
            } else {
                return { success: false, message: data.message };
            }
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, message: 'Network error occurred' };
        }
    }

    // Logout user
    async logout() {
        try {
            if (this.token) {
                await fetch(`${this.baseURL}/auth/logout`, {
                    method: 'POST',
                    headers: this.getHeaders()
                });
            }
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            this.clearAuthData();
        }
    }

    // Get user profile
    async getProfile() {
        try {
            const response = await fetch(`${this.baseURL}/auth/profile`, {
                method: 'GET',
                headers: this.getHeaders()
            });

            const data = await response.json();
            return data.success ? data : null;
        } catch (error) {
            console.error('Profile fetch error:', error);
            return null;
        }
    }

    // Redirect based on user role
    redirectToDashboard() {
        const user = this.getUser();
        if (user) {
            // Redirect to appropriate dashboard based on role
            switch (user.role) {
                case 'admin':
                case 'vendor':
                case 'customer':
                    window.location.href = '/dashboard.blade.php';
                    break;
                default:
                    window.location.href = '/dashboard.blade.php';
            }
        }
    }
}

// Create global auth instance
window.authAPI = new AuthAPI();

// Dashboard initialization function
function initializeDashboard() {
    console.log('=== Dashboard Initialization Started ===');
    
    const token = localStorage.getItem('auth_token');
    const user = localStorage.getItem('user');
    const sessionActive = localStorage.getItem('session_active');
    
    console.log('Checking auth token:', token);
    console.log('localStorage contents:', {
        auth_token: token,
        user: user ? JSON.parse(user) : null,
        session_active: sessionActive
    });

    if (!token || !user || sessionActive !== 'true') {
        console.log('No valid auth session found, redirecting to vendor login');
        redirectToVendorLogin();
        return;
    }

    try {
        const userData = JSON.parse(user);
        console.log('User data parsed successfully:', userData);
        
        // Ensure role is present
        if (!userData.role) {
            const storedRole = localStorage.getItem('user_role');
            if (storedRole) {
                userData.role = storedRole;
                console.log('Role restored from backup:', storedRole);
            }
        }
        
        console.log('Initializing dashboard for role:', userData.role);
        setupDashboard(userData);
        
    } catch (error) {
        console.error('Error parsing user data:', error);
        authAPI.clearAuthData();
        redirectToVendorLogin();
    }
}

function redirectToLogin() {
    console.log('Redirecting to login page');
    redirectToVendorLogin();
}

function redirectToVendorLogin() {
    console.log('Redirecting to vendor login page');
    // Check if vendor login page exists, otherwise show login prompt
    const vendorLoginUrl = '/vendor_login.html';
    
    // Try to redirect to vendor login page
    try {
        window.location.href = vendorLoginUrl;
    } catch (error) {
        console.error('Could not redirect to vendor login:', error);
        // Fallback: show login instructions
        showLoginInstructions();
    }
}

function showLoginInstructions() {
    const loginHtml = `
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div style="background: white; padding: 30px; border-radius: 10px; max-width: 400px; text-align: center;">
                <h3>🔐 Authentication Required</h3>
                <p>Please login to access the vendor dashboard.</p>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0;">
                    <strong>Test Vendor Credentials:</strong><br>
                    Email: testvendor@example.com<br>
                    Password: password123
                </div>
                <button onclick="window.location.href='/vendor_login.html'" style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Go to Login</button>
                <button onclick="this.parentElement.parentElement.remove()" style="background: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">Close</button>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', loginHtml);
}

function setupDashboard(user) {
    console.log('Setting up dashboard for user:', user);
    
    // Update UI elements with user data
    const userRoleElement = document.getElementById('userRole');
    if (userRoleElement) {
        userRoleElement.textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
        userRoleElement.className = `role-badge ${user.role}-badge`;
    }

    const dashboardTitle = document.getElementById('dashboardTitle');
    if (dashboardTitle) {
        dashboardTitle.textContent = `${user.role.charAt(0).toUpperCase() + user.role.slice(1)} Dashboard`;
    }

    // Set role selector to current user's role and disable other options
    const roleSelector = document.getElementById('roleSelector');
    if (roleSelector) {
        roleSelector.value = user.role;
        // Disable role switching for non-admin users for security
        if (user.role !== 'admin') {
            roleSelector.disabled = true;
            roleSelector.style.display = 'none';
        }
    }

    // Set global current role for dashboard functionality
    if (typeof window !== 'undefined') {
        window.currentRole = user.role;
    }

    // Initialize dashboard content based on role
    if (typeof switchRole === 'function') {
        switchRole(); // This should exist in your script.js
    }
    
    // Show appropriate sections based on user role
    if (user.role === 'vendor') {
        // Ensure vendor can see their specific sections
        console.log('Initializing vendor dashboard with CRUD access');
        // Hide admin-only sections
        const usersView = document.getElementById('usersView');
        if (usersView) usersView.style.display = 'none';
    }
}

// Global logout function
function logout() {
    authAPI.logout().then(() => {
        redirectToLogin();
    });
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize dashboard if we're on the dashboard page
    if (window.location.pathname.includes('dashboard') || document.getElementById('dashboardTitle')) {
        initializeDashboard();
    }
});

// Export for use in other scripts
window.initializeDashboard = initializeDashboard;
window.logout = logout;
