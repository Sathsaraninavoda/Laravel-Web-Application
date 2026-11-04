// Simplified Admin Dashboard with Mock Data (No Authentication Required)

// Mock data for testing
const mockData = {
    stats: {
        total_products: 16,
        total_vendors: 4,
        total_orders: 10,
        total_customers: 10,
        total_revenue: 2847.50,
        pending_orders: 3,
        low_stock_products: 2
    },
    products: [
        { id: 1, product_code: 'PROD0001', name: 'Ceylon Cinnamon Sticks', category: 'Spices', price: 25.99, stock_quantity: 150, status: 'active' },
        { id: 2, product_code: 'PROD0002', name: 'Ayurvedic Herbal Oil', category: 'Ayurvedic', price: 45.00, stock_quantity: 75, status: 'active' },
        { id: 3, product_code: 'PROD0003', name: 'Hand-carved Wooden Mask', category: 'Handicrafts', price: 75.50, stock_quantity: 25, status: 'active' },
        { id: 4, product_code: 'PROD0004', name: 'Ceylon Black Tea', category: 'Tea', price: 18.99, stock_quantity: 200, status: 'active' },
        { id: 5, product_code: 'PROD0005', name: 'Turmeric Powder', category: 'Spices', price: 12.50, stock_quantity: 300, status: 'active' }
    ],
    vendors: [
        { id: 1, name: 'Spice Gardens Ltd', email: 'contact@spicegardens.lk', phone: '+94771234567', city: 'Kandy', country: 'Sri Lanka', status: 'active' },
        { id: 2, name: 'Ayurveda Exports', email: 'info@ayurvedaexports.lk', phone: '+94777654321', city: 'Colombo', country: 'Sri Lanka', status: 'active' },
        { id: 3, name: 'Craft Masters', email: 'sales@craftmasters.lk', phone: '+94771111222', city: 'Galle', country: 'Sri Lanka', status: 'pending' },
        { id: 4, name: 'Ceylon Tea Co', email: 'orders@ceylontea.lk', phone: '+94773333444', city: 'Nuwara Eliya', country: 'Sri Lanka', status: 'active' }
    ],
    orders: [
        { id: 1, order_number: 'ORD-001', customer: { name: 'John Doe' }, total_amount: 125.50, status: 'completed', payment_status: 'paid', order_date: '2025-08-05' },
        { id: 2, order_number: 'ORD-002', customer: { name: 'Jane Smith' }, total_amount: 89.99, status: 'processing', payment_status: 'paid', order_date: '2025-08-07' },
        { id: 3, order_number: 'ORD-003', customer: { name: 'Bob Johnson' }, total_amount: 234.75, status: 'shipped', payment_status: 'paid', order_date: '2025-08-09' },
        { id: 4, order_number: 'ORD-004', customer: { name: 'Alice Brown' }, total_amount: 67.48, status: 'pending', payment_status: 'pending', order_date: '2025-08-10' }
    ]
};

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

// Simplified Admin Dashboard Class
class SimplifiedAdminDashboard {
    constructor() {
        this.currentSection = 'dashboard';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadDashboardStats();
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
        window.logout = () => {
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

        // Show/hide sections
        document.querySelectorAll('.content-section').forEach(sec => {
            sec.style.display = 'none';
        });
        document.getElementById(`${section}Section`).style.display = 'block';

        this.currentSection = section;
        this.loadSectionData(section);
    }

    loadSectionData(section) {
        switch(section) {
            case 'dashboard':
                this.loadDashboardStats();
                break;
            case 'products':
                this.loadProducts();
                break;
            case 'vendors':
                this.loadVendors();
                break;
            case 'orders':
                this.loadOrders();
                break;
            case 'reports':
                this.loadReports();
                break;
        }
    }

    loadDashboardStats() {
        try {
            const stats = mockData.stats;
            document.getElementById('totalProducts').textContent = stats.total_products;
            document.getElementById('totalVendors').textContent = stats.total_vendors;
            document.getElementById('totalOrders').textContent = stats.total_orders;
            document.getElementById('totalRevenue').textContent = `$${stats.total_revenue.toLocaleString()}`;
        } catch (error) {
            console.error('Error loading dashboard stats:', error);
        }
    }

    loadProducts() {
        try {
            const products = mockData.products;
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
        }
    }

    loadVendors() {
        try {
            const vendors = mockData.vendors;
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
        }
    }

    loadOrders() {
        try {
            const orders = mockData.orders;
            const tbody = document.querySelector('#ordersTable tbody');
            if (!tbody) return;
            
            tbody.innerHTML = orders.map(order => `
                <tr>
                    <td>${order.order_number}</td>
                    <td>${order.customer.name}</td>
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
        }
    }

    loadReports() {
        showNotification('Reports functionality is ready for implementation', 'info');
    }

    initializeCharts() {
        // Initialize charts with mock data
        setTimeout(() => {
            this.initSalesChart();
            this.initCategoryChart();
        }, 100);
    }

    initSalesChart() {
        const salesCtx = document.getElementById('salesChart');
        if (!salesCtx) return;

        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1900, 3000, 2500, 2200, 3000],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    initCategoryChart() {
        const categoryCtx = document.getElementById('categoryChart');
        if (!categoryCtx) return;

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Spices', 'Ayurvedic', 'Handicrafts', 'Tea'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    }
}

// CRUD Functions (Mock implementations)
function addProduct() {
    showNotification('Add Product functionality ready - form will be implemented', 'info');
}

function editProduct(id) {
    showNotification(`Edit Product ${id} functionality ready - form will be implemented`, 'info');
}

function viewProduct(id) {
    showNotification(`View Product ${id} functionality ready - modal will be implemented`, 'info');
}

function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        showNotification(`Product ${id} deleted successfully (mock)`, 'success');
    }
}

function addVendor() {
    showNotification('Add Vendor functionality ready - form will be implemented', 'info');
}

function editVendor(id) {
    showNotification(`Edit Vendor ${id} functionality ready - form will be implemented`, 'info');
}

function viewVendor(id) {
    showNotification(`View Vendor ${id} functionality ready - modal will be implemented`, 'info');
}

function deleteVendor(id) {
    if (confirm('Are you sure you want to delete this vendor?')) {
        showNotification(`Vendor ${id} deleted successfully (mock)`, 'success');
    }
}

function editOrderStatus(id) {
    showNotification(`Edit Order Status ${id} functionality ready - form will be implemented`, 'info');
}

function viewOrder(id) {
    showNotification(`View Order ${id} functionality ready - modal will be implemented`, 'info');
}

// Initialize the simplified dashboard
document.addEventListener('DOMContentLoaded', function() {
    new SimplifiedAdminDashboard();
});
