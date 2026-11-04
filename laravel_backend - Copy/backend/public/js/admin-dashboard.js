// API helper function
async function apiCall(endpoint, method = 'GET', data = null) {
    const token = localStorage.getItem('auth_token');
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
    };

    if (data && method !== 'GET') {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(`/api/${endpoint}`, options);
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'API request failed');
        }
        
        return result;
    } catch (error) {
        console.error('API Error:', error);
        showNotification('Error: ' + error.message, 'error');
        throw error;
    }
}

// Notification helper
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Helper function for status badges
function getStatusBadge(status) {
    switch(status) {
        case 'active': return 'bg-success';
        case 'inactive': return 'bg-secondary';
        case 'discontinued': return 'bg-danger';
        default: return 'bg-secondary';
    }
}

// Helper function for vendor status badges
function getVendorStatusBadge(status) {
    switch(status) {
        case 'active': return 'bg-success';
        case 'pending': return 'bg-warning';
        case 'inactive': return 'bg-danger';
        default: return 'bg-secondary';
    }
}

// Helper function for order status badges
function getOrderStatusBadge(status) {
    switch(status) {
        case 'pending': return 'bg-warning';
        case 'processing': return 'bg-info';
        case 'shipped': return 'bg-primary';
        case 'completed': return 'bg-success';
        case 'cancelled': return 'bg-danger';
        default: return 'bg-secondary';
    }
}

// Helper function for payment status badges
function getPaymentStatusBadge(status) {
    switch(status) {
        case 'paid': return 'bg-success';
        case 'pending': return 'bg-warning';
        case 'failed': return 'bg-danger';
        case 'refunded': return 'bg-info';
        default: return 'bg-secondary';
    }
}

// Admin Dashboard JavaScript
class AdminDashboard {
    constructor() {
        this.baseURL = window.location.origin;
        this.apiURL = this.baseURL + '/api/admin';
        this.token = localStorage.getItem('auth_token');
        this.currentSection = 'dashboard';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadDashboardData();
        this.initializeCharts();
    }

    setupEventListeners() {
        // Navigation links
        document.querySelectorAll('.nav-link[data-section]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const section = e.target.closest('.nav-link').dataset.section;
                this.showSection(section);
            });
        });

        // Mobile sidebar toggle
        window.toggleSidebar = () => {
            document.getElementById('sidebar').classList.toggle('show');
        };

        // Logout function
        window.logout = async () => {
            try {
                await fetch(`${this.baseURL}/api/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${this.token}`,
                        'Content-Type': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            }
            
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        };
    }

    showSection(section) {
        // Update navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        document.querySelector(`[data-section="${section}"]`).classList.add('active');

        // Update page title
        const titles = {
            dashboard: 'Dashboard',
            products: 'Products Management',
            vendors: 'Vendors Management',
            orders: 'Orders Management',
            reports: 'Reports & Analytics'
        };
        document.getElementById('pageTitle').textContent = titles[section] || section;

        // Hide all sections
        document.querySelectorAll('.content-section').forEach(sec => {
            sec.style.display = 'none';
        });

        // Show selected section
        document.getElementById(`${section}-section`).style.display = 'block';

        // Load section data
        this.currentSection = section;
        this.loadSectionData(section);
    }

    async loadDashboardData() {
        try {
            const response = await apiCall('admin/stats');
            const stats = response.data;

            document.getElementById('totalProducts').textContent = stats.total_products || 0;
            document.getElementById('totalVendors').textContent = stats.total_vendors || 0;
            document.getElementById('totalOrders').textContent = stats.total_orders || 0;
            document.getElementById('totalRevenue').textContent = `$${(stats.total_revenue || 0).toLocaleString()}`;
            
            // Update additional stats if elements exist
            const pendingOrdersEl = document.getElementById('pendingOrders');
            const lowStockEl = document.getElementById('lowStockProducts');
            if (pendingOrdersEl) pendingOrdersEl.textContent = stats.pending_orders || 0;
            if (lowStockEl) lowStockEl.textContent = stats.low_stock_products || 0;
        } catch (error) {
            console.error('Error loading dashboard stats:', error);
            showNotification('Failed to load dashboard statistics', 'error');
        }
    }

    async loadSectionData(section) {
        switch (section) {
            case 'products':
                await this.loadProducts();
                break;
            case 'vendors':
                await this.loadVendors();
                break;
            case 'orders':
                await this.loadOrders();
                break;
            case 'reports':
                this.loadReports();
                break;
        }
    }

    async loadProducts() {
        try {
            const response = await apiCall('admin/products');
            const products = response.data;

            const tbody = document.querySelector('#productsTable tbody');
            if (!tbody) return;
            
            tbody.innerHTML = products.map(product => `
                <tr>
                    <td>${product.product_code}</td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>$${parseFloat(product.price).toFixed(2)}</td>
                    <td>${product.stock_quantity}</td>
                    <td><span class="badge ${getStatusBadge(product.status)}">${product.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewProduct(${product.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error loading products:', error);
            showNotification('Failed to load products', 'error');
        }
    }

    async loadVendors() {
        try {
            const response = await apiCall('admin/vendors');
            const vendors = response.data;

            const tbody = document.querySelector('#vendorsTable tbody');
            if (!tbody) return;
            
            tbody.innerHTML = vendors.map(vendor => `
                <tr>
                    <td>${vendor.id}</td>
                    <td>${vendor.name}</td>
                    <td>${vendor.email}</td>
                    <td>${vendor.phone}</td>
                    <td>${vendor.city}, ${vendor.country}</td>
                    <td><span class="badge ${getVendorStatusBadge(vendor.status)}">${vendor.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewVendor(${vendor.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editVendor(${vendor.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteVendor(${vendor.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error loading vendors:', error);
            showNotification('Failed to load vendors', 'error');
        }
    }

    async loadOrders() {
        try {
            const response = await apiCall('admin/orders');
            const orders = response.data;

            const tbody = document.querySelector('#ordersTable tbody');
            if (!tbody) return;
            
            tbody.innerHTML = orders.map(order => `
                <tr>
                    <td>${order.order_number}</td>
                    <td>${order.customer ? order.customer.name : 'N/A'}</td>
                    <td>$${parseFloat(order.total_amount).toFixed(2)}</td>
                    <td><span class="badge ${getOrderStatusBadge(order.status)}">${order.status}</span></td>
                    <td><span class="badge ${getPaymentStatusBadge(order.payment_status)}">${order.payment_status}</span></td>
                    <td>${new Date(order.order_date).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewOrder(${order.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editOrderStatus(${order.id})" title="Update Status">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error loading orders:', error);
            showNotification('Failed to load orders', 'error');
        }
    }

    // Helper function for status badges
    getStatusBadge(status) {
        switch(status) {
            case 'active': return 'bg-success';
            case 'inactive': return 'bg-secondary';
            case 'discontinued': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }

    // Helper function for vendor status badges
    getVendorStatusBadge(status) {
        switch(status) {
            case 'active': return 'bg-success';
            case 'pending': return 'bg-warning';
            case 'inactive': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }

    // Helper function for order status badges
    getOrderStatusBadge(status) {
        switch(status) {
            case 'pending': return 'bg-warning';
            case 'processing': return 'bg-info';
            case 'shipped': return 'bg-primary';
            case 'completed': return 'bg-success';
            case 'cancelled': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }

    // Helper function for payment status badges
    getPaymentStatusBadge(status) {
        switch(status) {
            case 'paid': return 'bg-success';
            case 'pending': return 'bg-warning';
            case 'failed': return 'bg-danger';
            case 'refunded': return 'bg-info';
            default: return 'bg-secondary';
        }
    }

    // Charts Initialization
    initializeCharts() {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart');
        if (salesCtx) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales',
                        data: [12000, 19000, 15000, 25000, 22000, 30000],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }

    loadReports() {
        // Initialize report charts
        setTimeout(() => {
            const salesReportCtx = document.getElementById('salesReportChart');
            const productCtx = document.getElementById('productChart');

            if (salesReportCtx) {
                new Chart(salesReportCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [{
                            label: 'Weekly Sales',
                            data: [8000, 12000, 15000, 18000],
                            backgroundColor: '#10b981'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            if (productCtx) {
                new Chart(productCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Spices', 'Ayurvedic', 'Handicrafts'],
                        datasets: [{
                            data: [45, 30, 25],
                            backgroundColor: ['#2563eb', '#10b981', '#f59e0b']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }, 100);
    }
}

// CRUD Functions (Global)
window.showAddProductModal = function() {
    // TODO: Implement add product modal
    alert('Add Product functionality will be implemented');
};

window.editProduct = function(id) {
    // TODO: Implement edit product
    alert(`Edit Product ${id} functionality will be implemented`);
};

window.deleteProduct = function(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        // TODO: Implement delete product
        alert(`Delete Product ${id} functionality will be implemented`);
    }
};

window.showAddVendorModal = function() {
    // TODO: Implement add vendor modal
    alert('Add Vendor functionality will be implemented');
};

window.editVendor = function(id) {
    // TODO: Implement edit vendor
    alert(`Edit Vendor ${id} functionality will be implemented`);
};

window.deleteVendor = function(id) {
    if (confirm('Are you sure you want to delete this vendor?')) {
        // TODO: Implement delete vendor
        alert(`Delete Vendor ${id} functionality will be implemented`);
    }
};

window.showAddOrderModal = function() {
    // TODO: Implement add order modal
    alert('Add Order functionality will be implemented');
};

window.viewOrder = function(id) {
    // TODO: Implement view order
    alert(`View Order ${id} functionality will be implemented`);
};

window.editOrder = function(id) {
    // TODO: Implement edit order
    alert(`Edit Order ${id} functionality will be implemented`);
};

window.deleteOrder = function(id) {
    if (confirm('Are you sure you want to delete this order?')) {
        // TODO: Implement delete order
        alert(`Delete Order ${id} functionality will be implemented`);
    }
};

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.adminDashboard = new AdminDashboard();
});
