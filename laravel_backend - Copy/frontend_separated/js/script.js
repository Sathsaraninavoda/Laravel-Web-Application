// Role-based configurations
const roleConfigs = {
    admin: {
        title: 'Admin Dashboard',
        badge: 'admin-badge',
        navigation: [
            { icon: 'fas fa-tachometer-alt', text: 'Dashboard', active: true },
            { icon: 'fas fa-shopping-cart', text: 'Orders', active: false },
            { icon: 'fas fa-box', text: 'Products', active: false },
            { icon: 'fas fa-users', text: 'Users', active: false },
            { icon: 'fas fa-chart-bar', text: 'Reports', active: false }, // Keep for Admin
            
        ],
        stats: [
            { title: 'Total Orders', value: '1,234', icon: 'fas fa-shopping-cart', class: 'orders', change: '+12%' },
            { title: 'Products', value: '856', icon: 'fas fa-box', class: 'products', change: '+5%' },
            { title: 'Users', value: '2,891', icon: 'fas fa-users', class: 'users', change: '+18%' },
            { title: 'Revenue', value: 'Rs. 45,678', icon: 'fas fa-dollar-sign', class: 'revenue', change: '+23%' }
        ],
        tableTitle: 'Recent Orders',
        tableHeaders: ['Order ID', 'Customer', 'Product', 'Status', 'Amount', 'Actions'],
        tableData: [
            ['#ORD001', 'Kumara Silva', 'Ceylon Tea Set', '<span class="badge bg-success">Completed</span>', 'Rs. 2,500', '<button class="btn btn-sm btn-primary">View</button>'],
            ['#ORD002', 'Nimal Perera', 'Handwoven Basket', '<span class="badge bg-warning">Pending</span>', 'Rs. 1,800', '<button class="btn btn-sm btn-primary">View</button>'],
            ['#ORD003', 'Priya Fernando', 'Ayurvedic Oil', '<span class="badge bg-success">Completed</span>', 'Rs. 950', '<button class="btn btn-sm btn-primary">View</button>']
        ]
    },
    vendor: {
        title: 'Vendor Dashboard',
        badge: 'vendor-badge',
        navigation: [
            { icon: 'fas fa-tachometer-alt', text: 'Dashboard', active: true },
            { icon: 'fas fa-box', text: 'My Products', active: false },
            { icon: 'fas fa-shopping-cart', text: 'My Orders', active: false },
            // { icon: 'fas fa-chart-line', text: 'Sales Analytics', active: false }, // Removed for Vendor
         
        ],
        stats: [
            { title: 'My Products', value: '45', icon: 'fas fa-box', class: 'products', change: '+3' },
            { title: 'Pending Orders', value: '12', icon: 'fas fa-clock', class: 'orders', change: '+2' },
            { title: 'This Month Sales', value: 'Rs. 12,450', icon: 'fas fa-chart-line', class: 'revenue', change: '+15%' },
            { title: 'Stock Alerts', value: '8', icon: 'fas fa-exclamation-triangle', class: 'users', change: '-2' }
        ],
        tableTitle: 'My Products',
        tableHeaders: ['Product', 'Category', 'Stock', 'Price', 'Status', 'Actions'],
        tableData: [
            ['Ceylon Black Tea', 'Tea', '45 units', 'Rs. 850', '<span class="badge bg-success">Active</span>', '<button class="btn btn-sm btn-warning">Edit</button>'],
            ['Coconut Shell Bowl', 'Handicrafts', '12 units', 'Rs. 650', '<span class="badge bg-warning">Low Stock</span>', '<button class="btn btn-sm btn-warning">Edit</button>'],
            ['Cinnamon Sticks', 'Spices', '0 units', 'Rs. 450', '<span class="badge bg-danger">Out of Stock</span>', '<button class="btn btn-sm btn-warning">Edit</button>']
        ]
    },
    customer: {
        title: 'My Account',
        badge: 'customer-badge',
        navigation: [
            { icon: 'fas fa-tachometer-alt', text: 'Dashboard', active: true },
            { icon: 'fas fa-shopping-cart', text: 'Orders', active: false },
            { icon: 'fas fa-user', text: 'Profile', active: false }
        ],
        stats: [
            { title: 'Total Orders', value: '28', icon: 'fas fa-shopping-cart', class: 'orders', change: '+3' },
            { title: 'Wishlist Items', value: '15', icon: 'fas fa-products', class: 'products', change: '+2' },
            { title: 'Total Spent', value: '$. 156.8', icon: 'fas fa-dollar-sign', class: 'revenue', change: '+$. 250' },
            { title: 'Reward Points', value: '450', icon: 'fas fa-gift', class: 'users', change: '+50' }
        ],
        tableTitle: 'Recent Orders',
        tableHeaders: ['Order ID', 'Date', 'Items', 'Status', 'Total', 'Actions'],
        tableData: [
            ['#ORD045', '2024-01-15', '3 items', '<span class="badge bg-success">Delivered</span>', 'Rs. 2,500', '<button class="btn btn-sm btn-primary">Track</button>'],
            ['#ORD044', '2024-01-10', '1 item', '<span class="badge bg-info">Shipped</span>', 'Rs. 850', '<button class="btn btn-sm btn-primary">Track</button>'],
            ['#ORD043', '2024-01-08', '2 items', '<span class="badge bg-success">Delivered</span>', 'Rs. 1,200', '<button class="btn btn-sm btn-primary">Track</button>']
        ]
    }
};

let currentRole = window.currentRole || 'admin';

function createCSSChart(containerId, data, labels, isVendor = false) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const chartLine = container.querySelector('.chart-line');
    const chartLabels = container.querySelector('.chart-labels');
    
    if (isVendor) {
        container.classList.add('vendor-chart');
    } else {
        container.classList.remove('vendor-chart');
    }

    // Create SVG
    const maxValue = Math.max(...data);
    const minValue = Math.min(...data);
    const range = maxValue - minValue;
    const padding = range * 0.1;

    let pathData = '';
    let points = '';

    data.forEach((value, index) => {
        const x = (index / (data.length - 1)) * 100;
        const y = 100 - (((value - minValue + padding) / (range + 2 * padding)) * 100);
        
        if (index === 0) {
            pathData += `M ${x} ${y}`;
        } else {
            pathData += ` L ${x} ${y}`;
        }
        
        points += `<circle cx="${x}" cy="${y}" r="4" class="chart-point"></circle>`;
    });

    chartLine.innerHTML = `
        <svg viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="${pathData}" class="chart-path" vector-effect="non-scaling-stroke"></path>
            ${points}
        </svg>
    `;

    // Add labels
    chartLabels.innerHTML = labels.map(label => `<span>${label}</span>`).join('');
}

function switchRole() {
    const selector = document.getElementById('roleSelector');
    if (selector) {
        currentRole = selector.value;
    } else {
        // If no selector (e.g., for non-admin users), use the global currentRole
        currentRole = window.currentRole || 'customer';
    }
    updateDashboard();
}

function updateDashboard() {
    const config = roleConfigs[currentRole];
    
    // Update title and badge
    document.getElementById('dashboardTitle').textContent = config.title;
    const userRole = document.getElementById('userRole');
    userRole.textContent = currentRole.charAt(0).toUpperCase() + currentRole.slice(1);
    userRole.className = `role-badge ${config.badge}`;

    // Update navigation
    updateNavigation(config.navigation);
    
    // Update stats
    updateStats(config.stats);
    
    // Update table
    updateTable(config.tableTitle, config.tableHeaders, config.tableData);
    
    // Update charts
    updateCharts();
    
    // Update recent activity
    updateRecentActivity();

    // Layout adjustments based on role for charts
    adjustDashboardLayout(); 

    // Control the visibility of the "Reports" button in the header
    const headerReportsButton = document.getElementById('headerReportsButton');
    if (headerReportsButton) {
        if (currentRole === 'admin') {
            headerReportsButton.style.display = ''; // Admin නම් button එක පෙන්වන්න (default display)
        } else {
            headerReportsButton.style.display = 'none'; // Vendor හෝ Customer නම් button එක සඟවන්න
        }
    }
}

let currentSection = 'dashboard';

function updateNavigation(navItems) {
    const nav = document.getElementById('sidebarNav');
    nav.innerHTML = navItems.map((item, index) => `
        <li class="nav-item">
            <a class="nav-link ${index === 0 ? 'active' : ''}" href="#" onclick="showSection('${getSectionId(item.text)}', this)">
                <i class="${item.icon} me-2"></i>
                ${item.text}
            </a>
        </li>
    `).join('');
}

function getSectionId(text) {
    const sectionMap = {
        'Dashboard': 'dashboard',
        'Orders': 'orders',
        'Add to Cart': 'orders',
        'Products': 'products',
        'My Products': 'products',
        'Users': 'users',
        'Vendors': 'users',
        'Reports': 'reports',
        'Sales Analytics': 'reports',
        'Settings': 'dashboard',
        'Profile': 'profile',
        'Wishlist': 'products',
        'Addresses': 'dashboard',
        'Payment Methods': 'dashboard',
        'Inventory': 'products'
    };
    return sectionMap[text] || 'dashboard';
}

function showSection(sectionId, clickedElement) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.add('d-none');
    });

    // Show selected section
    const targetSection = document.getElementById(sectionId + 'View');
    if (targetSection) {
        targetSection.classList.remove('d-none');
    } else {
        document.getElementById('dashboardView').classList.remove('d-none');
    }

    // Update active navigation
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    clickedElement.classList.add('active');

    currentSection = sectionId;

    // Update charts if needed (e.g., Reports view has specific charts)
    if (sectionId === 'reports') {
        setTimeout(() => {
            updateReportsCharts();
        }, 100);
    }
}

function updateStats(stats) {
    const container = document.getElementById('statsContainer');
    container.innerHTML = stats.map(stat => `
        <div class="col-md-3 mb-3">
            <div class="stats-card ${stat.class} p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">${stat.title}</h6>
                        <h3 class="mb-0">${stat.value}</h3>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>${stat.change}
                        </small>
                    </div>
                    <div class="text-primary fs-2">
                        <i class="${stat.icon}"></i>
                    </div>
                </div>
            </div>
        </div>
    `).join('');
}

function updateTable(title, headers, data) {
    document.getElementById('quickTableTitle').textContent = title;
    
    const thead = document.getElementById('quickTableHead');
    thead.innerHTML = `<tr>${headers.slice(0, 4).map(h => `<th>${h}</th>`).join('')}</tr>`;
    
    const tbody = document.getElementById('quickTableBody');
    tbody.innerHTML = data.slice(0, 3).map(row => 
        `<tr>${row.slice(0, 4).map(cell => `<td>${cell}</td>`).join('')}</tr>`
    ).join('');
}

function updateCharts() {
    const salesData = currentRole === 'admin' ? 
        [12, 20, 28, 34, 25, 15, 31] :
        currentRole === 'vendor' ?
        [8, 15, 12, 22, 18, 25, 20] :
        [3, 6, 4, 8, 7, 12, 9]; // Customer view will hide this chart, so data is less relevant.

    const salesLabels = ['2020', '2021', '2022', '2023', '2024', '2025', '2026'];

    // Only create the chart if it's not the customer role
    if (currentRole !== 'customer') {
        createCSSChart('salesChart', salesData, salesLabels, currentRole === 'vendor');
    } else {
        // Optionally clear the chart if it was visible before switching to customer
        const salesChartContainer = document.getElementById('salesChart');
        if(salesChartContainer) {
            salesChartContainer.querySelector('.chart-line').innerHTML = '';
            salesChartContainer.querySelector('.chart-labels').innerHTML = '';
        }
    }
}

function updateReportsCharts() {
    // Monthly Sales Chart
    const monthlyData = currentRole === 'admin' ? 
        [34, 28, 22, 15] : [24, 19, 15, 10];
    const monthlyLabels = ['Feb', 'Mar', 'Apr', 'May'];
    
    createCSSChart('monthlySalesChart', monthlyData, monthlyLabels, currentRole === 'vendor');

    // Top Products Chart
    const productData = currentRole === 'admin' ? 
        [30, 18, 12] : [20, 14, 8];
    const productLabels = currentRole === 'admin' ? 
        ['Tea', 'Spices', 'Ayurvedic'] : ['Ceylon Tea', 'Cinnamon', 'Oil'];
    
    createCSSChart('topProductsChart', productData, productLabels, currentRole === 'vendor');
}

// Function to adjust layout of charts in Dashboard View
function adjustDashboardLayout() {
    const salesOverviewChartCol = document.getElementById('salesOverviewChartCol');
    const recentActivityCol = document.getElementById('recentActivityCol');

    if (currentRole === 'customer') {
        if (salesOverviewChartCol) salesOverviewChartCol.classList.add('d-none'); // Hide Sales Overview Chart for Customer
        if (recentActivityCol) {
            recentActivityCol.classList.remove('col-md-6');
            recentActivityCol.classList.add('col-md-12'); // Make Recent Activity full width for Customer
        }
    } else {
        if (salesOverviewChartCol) salesOverviewChartCol.classList.remove('d-none'); // Show Sales Overview Chart for Admin/Vendor
        if (recentActivityCol) {
            recentActivityCol.classList.remove('col-md-12');
            recentActivityCol.classList.add('col-md-6'); // Make Recent Activity half width for Admin/Vendor
        }
    }
}

function updateRecentActivity() {
    const activities = {
        admin: [
            { text: 'New vendor registered', time: '2 minutes ago', icon: 'fas fa-user-plus text-success' },
            { text: 'Order #ORD001 completed', time: '15 minutes ago', icon: 'fas fa-check-circle text-success' },
            { text: 'Low stock alert: Ceylon Tea', time: '1 hour ago', icon: 'fas fa-exclamation-triangle text-warning' },
            { text: 'New product added', time: '2 hours ago', icon: 'fas fa-plus-circle text-info' }
        ],
        vendor: [
            { text: 'New order received', time: '5 minutes ago', icon: 'fas fa-shopping-cart text-success' },
            { text: 'Product updated', time: '30 minutes ago', icon: 'fas fa-edit text-info' },
            { text: 'Payment received', time: '1 hour ago', icon: 'fas fa-money-bill text-success' },
            { text: 'Stock updated', time: '3 hours ago', icon: 'fas fa-boxes text-info' }
        ],
        customer: [
            { text: 'Order delivered', time: '1 hour ago', icon: 'fas fa-truck text-success' },
            { text: 'Item added to wishlist', time: '2 hours ago', icon: 'fas fa-heart text-danger' },
            { text: 'Payment successful', time: '1 day ago', icon: 'fas fa-credit-card text-success' },
            { text: 'Order placed', time: '2 days ago', icon: 'fas fa-shopping-cart text-info' }
        ]
    };

    const container = document.getElementById('recentActivity');
    container.innerHTML = activities[currentRole].map(activity => `
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                <i class="${activity.icon}"></i>
            </div>
            <div class="flex-grow-1">
                <div class="small">${activity.text}</div>
                <div class="text-muted" style="font-size: 0.75rem;">${activity.time}</div>
            </div>
        </div>
    `).join('');
}

function addNew() {
    const actions = {
        admin: 'Add New Product',
        vendor: 'Add New Product',
        customer: 'Add to Cart'
    };
    alert(`${actions[currentRole]} functionality would be implemented here.`);
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        alert('Logout functionality would be implemented here.');
    }
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is authenticated and get their role
    if (window.authAPI && window.authAPI.isAuthenticated()) {
        const user = window.authAPI.getUser();
        if (user && user.role) {
            currentRole = user.role;
            window.currentRole = user.role;
        }
    }
    updateDashboard();
});