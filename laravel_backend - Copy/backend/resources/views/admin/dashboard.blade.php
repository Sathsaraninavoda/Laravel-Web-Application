<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Thambapanni Sobha</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .sidebar-brand i {
            margin-right: 0.5rem;
            color: #fbbf24;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #fbbf24;
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border-left-color: #fbbf24;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .content-area {
            padding: 2rem;
        }

        /* Dashboard Cards */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stats-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-card-title {
            font-size: 0.875rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .stats-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .stats-card-change {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .change-positive {
            color: var(--success-color);
        }

        .change-negative {
            color: var(--danger-color);
        }

        /* Action Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            border-radius: 8px;
        }

        /* Tables */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background: var(--light-color);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="fas fa-gem"></i>
                Thambapanni Sobha
            </a>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-section="products">
                    <i class="fas fa-box"></i>
                    Products
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-section="vendors">
                    <i class="fas fa-truck"></i>
                    Vendors
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-section="orders">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-chart-bar"></i>
                    Reports
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-section="settings">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title" id="pageTitle">Dashboard</h1>
            </div>
            <div class="user-menu">
                <div class="user-avatar">
                    <span data-user-name>{{ Auth::user()->name[0] ?? 'U' }}</span>
                </div>
                <div class="d-none d-md-block">
                    <div class="fw-semibold">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="text-muted small">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section">
                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stats-card-title">Total Products</div>
                            <div class="stats-card-value" id="totalProducts">0</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 12% from last month
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="stats-card-title">Active Vendors</div>
                            <div class="stats-card-value" id="totalVendors">0</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 8% from last month
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stats-card-title">Total Orders</div>
                            <div class="stats-card-value" id="totalOrders">0</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 23% from last month
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-info bg-opacity-10 text-info">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stats-card-title">Revenue</div>
                            <div class="stats-card-value">$0</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 15% from last month
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-8">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Sales Overview</h3>
                            </div>
                            <div class="p-4">
                                <canvas id="salesChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Recent Orders</h3>
                            </div>
                            <div class="p-4">
                                <div id="recentOrders">
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-shopping-cart fa-2x mb-3"></i>
                                        <p>No recent orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div id="products-section" class="content-section" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Products Management</h2>
                    <button class="btn btn-primary" onclick="showAddProductModal()">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="productsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Products will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Vendors Section -->
            <div id="vendors-section" class="content-section" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Vendors Management</h2>
                    <button class="btn btn-primary" onclick="showAddVendorModal()">
                        <i class="fas fa-plus"></i> Add Vendor
                    </button>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="vendorsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Vendors will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div id="orders-section" class="content-section" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Orders Management</h2>
                    <button class="btn btn-primary" onclick="showAddOrderModal()">
                        <i class="fas fa-plus"></i> Add Order
                    </button>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="ordersTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Orders will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div id="reports-section" class="content-section" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Reports & Analytics</h2>
                    <button class="btn btn-primary" onclick="generateReport()">
                        <i class="fas fa-file-download"></i> Generate Report
                    </button>
                </div>
                
                <!-- Report Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stats-card-title">Total Sales</div>
                            <div class="stats-card-value">$15,847</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 18% this month
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-info bg-opacity-10 text-info">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="stats-card-title">Orders Today</div>
                            <div class="stats-card-value">24</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 12% from yesterday
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stats-card-title">Top Product</div>
                            <div class="stats-card-value">Ceylon Tea</div>
                            <div class="stats-card-change change-positive">
                                <i class="fas fa-arrow-up"></i> 156 sold
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-card-icon bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="stats-card-title">Low Stock</div>
                            <div class="stats-card-value">3</div>
                            <div class="stats-card-change change-negative">
                                <i class="fas fa-arrow-down"></i> Items need restock
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-8">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Sales Trends</h3>
                            </div>
                            <div class="p-4">
                                <canvas id="salesReportChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Category Performance</h3>
                            </div>
                            <div class="p-4">
                                <canvas id="categoryReportChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Table -->
                <div class="table-container">
                    <div class="table-header">
                        <h3 class="table-title">Generated Reports</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="reportsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Report Name</th>
                                    <th>Type</th>
                                    <th>Generated Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Reports will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings-section" class="content-section" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>System Settings</h2>
                    <button class="btn btn-success" onclick="saveAllSettings()">
                        <i class="fas fa-save"></i> Save All Settings
                    </button>
                </div>

                <div class="row g-4">
                    <!-- General Settings -->
                    <div class="col-xl-6">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">General Settings</h3>
                            </div>
                            <div class="p-4">
                                <form id="generalSettingsForm">
                                    <div class="mb-3">
                                        <label class="form-label">Site Name</label>
                                        <input type="text" class="form-control" value="Thambapanni Sobha" id="siteName">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Site Email</label>
                                        <input type="email" class="form-control" value="admin@thambapannisobha.com" id="siteEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Currency</label>
                                        <select class="form-select" id="currency">
                                            <option value="USD" selected>USD ($)</option>
                                            <option value="LKR">LKR (Rs.)</option>
                                            <option value="EUR">EUR (€)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Timezone</label>
                                        <select class="form-select" id="timezone">
                                            <option value="Asia/Colombo" selected>Asia/Colombo</option>
                                            <option value="UTC">UTC</option>
                                            <option value="America/New_York">America/New_York</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div class="col-xl-6">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Notification Settings</h3>
                            </div>
                            <div class="p-4">
                                <form id="notificationSettingsForm">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                        <label class="form-check-label" for="emailNotifications">
                                            Email Notifications
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="orderNotifications" checked>
                                        <label class="form-check-label" for="orderNotifications">
                                            New Order Notifications
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="stockNotifications" checked>
                                        <label class="form-check-label" for="stockNotifications">
                                            Low Stock Alerts
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="vendorNotifications">
                                        <label class="form-check-label" for="vendorNotifications">
                                            Vendor Updates
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="col-xl-6">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">System Information</h3>
                            </div>
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Version:</strong>
                                    </div>
                                    <div class="col-6">
                                        v1.0.0
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Laravel:</strong>
                                    </div>
                                    <div class="col-6">
                                        v11.x
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Database:</strong>
                                    </div>
                                    <div class="col-6">
                                        SQLite
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Last Backup:</strong>
                                    </div>
                                    <div class="col-6">
                                        2025-08-09
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Management -->
                    <div class="col-xl-6">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">User Management</h3>
                            </div>
                            <div class="p-4">
                                <button class="btn btn-primary mb-3" onclick="showAddUserModal()">
                                    <i class="fas fa-user-plus"></i> Add New User
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Admin User</td>
                                                <td><span class="badge bg-danger">Admin</span></td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" onclick="editUser(1)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- CRUD MODALS -->
    
    <!-- Product Modals -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" id="productId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Code</label>
                                    <input type="text" class="form-control" id="productCode" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" id="productName" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category *</label>
                                    <select class="form-select" id="productCategory" required>
                                        <option value="">Select Category</option>
                                        <option value="Spices">Spices</option>
                                        <option value="Ayurvedic">Ayurvedic</option>
                                        <option value="Handicrafts">Handicrafts</option>
                                        <option value="Tea">Tea</option>
                                        <option value="Jewelry">Jewelry</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Price *</label>
                                    <input type="number" class="form-control" id="productPrice" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Stock Quantity *</label>
                                    <input type="number" class="form-control" id="productStock" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="productStatus">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveProduct()">Save Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Modals -->
    <div class="modal fade" id="vendorModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorModalTitle">Add Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="vendorForm">
                        <input type="hidden" id="vendorId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Vendor Name *</label>
                                    <input type="text" class="form-control" id="vendorName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="vendorEmail" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="vendorPhone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="vendorStatus">
                                        <option value="active">Active</option>
                                        <option value="pending">Pending</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="vendorCity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" id="vendorCountry" value="Sri Lanka">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="vendorAddress" rows="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="vendorContactPerson">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Business Type</label>
                                    <input type="text" class="form-control" id="vendorBusinessType" placeholder="e.g., Spice Exporter">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveVendor()">Save Vendor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Modals -->
    <div class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalTitle">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm">
                        <input type="hidden" id="orderId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Order Number</label>
                                    <input type="text" class="form-control" id="orderNumber" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Customer Name *</label>
                                    <input type="text" class="form-control" id="orderCustomer" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Total Amount *</label>
                                    <input type="number" class="form-control" id="orderAmount" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Order Date</label>
                                    <input type="date" class="form-control" id="orderDate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Order Status</label>
                                    <select class="form-select" id="orderStatus">
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-select" id="orderPaymentStatus">
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="failed">Failed</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" class="form-control" id="orderCustomerEmail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="orderShippingAddress" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="orderNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveOrder()">Save Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal (Universal) -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalTitle">View Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Generation Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="reportForm">
                        <div class="mb-3">
                            <label class="form-label">Report Type *</label>
                            <select class="form-select" id="reportType" required>
                                <option value="">Select Report Type</option>
                                <option value="sales">Sales Report</option>
                                <option value="products">Product Report</option>
                                <option value="vendors">Vendor Report</option>
                                <option value="orders">Order Report</option>
                                <option value="inventory">Inventory Report</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="reportStartDate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="reportEndDate">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Format</label>
                            <select class="form-select" id="reportFormat">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="generateReportFile()">Generate Report</button>
                </div>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalTitle">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="userName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" id="userEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" id="userPassword" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" id="userRole">
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="userStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveUser()">Save User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmMessage">Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Working Admin Dashboard - Connected to Database
        let dashboardData = {
            products: [],
            vendors: [],
            orders: []
        };

        // API Helper Functions
        async function apiCall(endpoint, method = 'GET', data = null) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin' // Include session cookies
            };

            if (data && method !== 'GET') {
                options.body = JSON.stringify(data);
            }

            try {
                // Ensure we use the correct base URL
                const baseUrl = window.location.origin;
                const url = endpoint.startsWith('/') ? `${baseUrl}${endpoint}` : `${baseUrl}/${endpoint}`;
                const response = await fetch(url, options);
                
                // Handle different response types
                let result;
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    result = await response.json();
                } else {
                    const text = await response.text();
                    result = { message: text, success: false };
                }
                
                if (!response.ok) {
                    throw new Error(result.message || `HTTP error! status: ${response.status}`);
                }
                
                return result;
            } catch (error) {
                console.error('API Error:', error);
                showNotification('Error: ' + error.message, 'error');
                throw error;
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 5000);
        }

        function getStatusBadge(status) {
            switch(status) {
                case 'active': return 'bg-success';
                case 'inactive': return 'bg-secondary';
                case 'out_of_stock': return 'bg-danger';
                default: return 'bg-secondary';
            }
        }

        function getVendorStatusBadge(status) {
            switch(status) {
                case 'active': return 'bg-success';
                case 'pending': return 'bg-warning';
                case 'inactive': return 'bg-danger';
                default: return 'bg-secondary';
            }
        }

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

        function getPaymentStatusBadge(status) {
            switch(status) {
                case 'paid': return 'bg-success';
                case 'pending': return 'bg-warning';
                case 'failed': return 'bg-danger';
                case 'refunded': return 'bg-info';
                default: return 'bg-secondary';
            }
        }

        // Custom confirmation dialog
        function showConfirmation(message, callback) {
            document.getElementById('confirmMessage').textContent = message;
            const confirmButton = document.getElementById('confirmButton');
            
            // Remove any existing event listeners
            const newConfirmButton = confirmButton.cloneNode(true);
            confirmButton.parentNode.replaceChild(newConfirmButton, confirmButton);
            
            // Add new event listener
            newConfirmButton.addEventListener('click', function() {
                bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
                callback();
            });
            
            new bootstrap.Modal(document.getElementById('confirmModal')).show();
        }

        function showSection(section) {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            document.querySelector(`[data-section="${section}"]`).classList.add('active');
            document.querySelectorAll('.content-section').forEach(sec => sec.style.display = 'none');
            const targetSection = document.getElementById(`${section}-section`);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
            loadSectionData(section);
        }

        function loadSectionData(section) {
            switch(section) {
                case 'dashboard': loadDashboardStats(); break;
                case 'products': loadProducts(); break;
                case 'vendors': loadVendors(); break;
                case 'orders': loadOrders(); break;
                case 'reports': loadReports(); break;
                case 'settings': loadSettings(); break;
            }
        }

        async function loadDashboardStats() {
            try {
                const response = await apiCall('admin/stats');
                const stats = response.data;
                
                const totalProducts = document.getElementById('totalProducts');
                const totalVendors = document.getElementById('totalVendors');
                const totalOrders = document.getElementById('totalOrders');
                
                if (totalProducts) totalProducts.textContent = stats.total_products || '0';
                if (totalVendors) totalVendors.textContent = stats.total_vendors || '0';
                if (totalOrders) totalOrders.textContent = stats.total_orders || '0';
                
                // Update revenue card (it doesn't have an ID, so find by class)
                const revenueCards = document.querySelectorAll('.stats-card-value');
                if (revenueCards.length >= 4) {
                    revenueCards[3].textContent = `$${(stats.total_revenue || 0).toLocaleString()}`;
                }
            } catch (error) {
                console.error('Error loading dashboard stats:', error);
                // Fallback to default values
                const totalProducts = document.getElementById('totalProducts');
                const totalVendors = document.getElementById('totalVendors');
                const totalOrders = document.getElementById('totalOrders');
                
                if (totalProducts) totalProducts.textContent = '0';
                if (totalVendors) totalVendors.textContent = '0';
                if (totalOrders) totalOrders.textContent = '0';
            }
        }

        async function loadProducts() {
            const tbody = document.querySelector('#productsTable tbody');
            if (!tbody) return;
            
            try {
                const response = await apiCall('admin/products');
                dashboardData.products = response.data || [];
                
                tbody.innerHTML = dashboardData.products.map(product => `
                    <tr>
                        <td>${product.product_code || product.sku}</td>
                        <td>${product.name}</td>
                        <td>${product.category}</td>
                        <td>$${parseFloat(product.price || 0).toFixed(2)}</td>
                        <td>${product.stock_quantity || 0}</td>
                        <td><span class="badge ${getStatusBadge(product.status)}">${product.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewProduct(${product.id})" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error loading products:', error);
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">Error loading products. Please try again.</td></tr>';
            }
        }

        async function loadVendors() {
            const tbody = document.querySelector('#vendorsTable tbody');
            if (!tbody) return;
            
            try {
                const response = await apiCall('admin/vendors');
                dashboardData.vendors = response.data || [];
                
                tbody.innerHTML = dashboardData.vendors.map(vendor => `
                    <tr>
                        <td>${vendor.id}</td>
                        <td>${vendor.name}</td>
                        <td>${vendor.email}</td>
                        <td>${vendor.phone || 'N/A'}</td>
                        <td>${vendor.city || 'N/A'}, ${vendor.country || 'N/A'}</td>
                        <td><span class="badge ${getVendorStatusBadge(vendor.status)}">${vendor.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewVendor(${vendor.id})" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-primary" onclick="editVendor(${vendor.id})" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteVendor(${vendor.id})" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error loading vendors:', error);
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">Error loading vendors. Please try again.</td></tr>';
            }
        }

        async function loadOrders() {
            const tbody = document.querySelector('#ordersTable tbody');
            if (!tbody) return;
            
            try {
                const response = await apiCall('admin/orders');
                dashboardData.orders = response.data || [];
                
                tbody.innerHTML = dashboardData.orders.map(order => `
                    <tr>
                        <td>${order.order_number || order.id}</td>
                        <td>${order.customer ? order.customer.name : (order.user ? order.user.name : 'N/A')}</td>
                        <td>$${parseFloat(order.total_amount || 0).toFixed(2)}</td>
                        <td><span class="badge ${getOrderStatusBadge(order.status)}">${order.status}</span></td>
                        <td><span class="badge ${getPaymentStatusBadge(order.payment_status)}">${order.payment_status}</span></td>
                        <td>${order.created_at ? new Date(order.created_at).toLocaleDateString() : 'N/A'}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewOrder(${order.id})" title="View"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-primary" onclick="editOrderStatus(${order.id})" title="Update Status"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error loading orders:', error);
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">Error loading orders. Please try again.</td></tr>';
            }
        }

        function loadReports() {
            const tbody = document.querySelector('#reportsTable tbody');
            if (!tbody) return;
            
            const reports = [
                { name: 'Monthly Sales Report', type: 'Sales', date: '2025-08-01', status: 'completed' },
                { name: 'Product Inventory Report', type: 'Inventory', date: '2025-08-05', status: 'completed' },
                { name: 'Vendor Performance Report', type: 'Vendor', date: '2025-08-08', status: 'pending' },
                { name: 'Order Analysis Report', type: 'Orders', date: '2025-08-10', status: 'processing' }
            ];
            
            tbody.innerHTML = reports.map((report, index) => `
                <tr>
                    <td>${report.name}</td>
                    <td><span class="badge bg-info">${report.type}</span></td>
                    <td>${new Date(report.date).toLocaleDateString()}</td>
                    <td><span class="badge ${report.status === 'completed' ? 'bg-success' : report.status === 'processing' ? 'bg-warning' : 'bg-secondary'}">${report.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewReport(${index})" title="View"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-success" onclick="downloadReport(${index})" title="Download"><i class="fas fa-download"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deleteReport(${index})" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');

            // Initialize report charts
            setTimeout(() => {
                const salesReportCtx = document.getElementById('salesReportChart');
                if (salesReportCtx) {
                    new Chart(salesReportCtx, {
                        type: 'line',
                        data: {
                            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                            datasets: [{
                                label: 'Weekly Sales ($)',
                                data: [3200, 4100, 3800, 4500],
                                borderColor: 'rgb(34, 197, 94)',
                                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }

                const categoryReportCtx = document.getElementById('categoryReportChart');
                if (categoryReportCtx) {
                    new Chart(categoryReportCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Spices', 'Ayurvedic', 'Handicrafts', 'Tea', 'Jewelry'],
                            datasets: [{
                                data: [35, 25, 15, 20, 5],
                                backgroundColor: [
                                    'rgba(239, 68, 68, 0.8)',
                                    'rgba(59, 130, 246, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(16, 185, 129, 0.8)',
                                    'rgba(168, 85, 247, 0.8)'
                                ]
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: true }
                    });
                }
            }, 100);
        }

        function loadSettings() {
            showNotification('Settings loaded successfully', 'success');
        }

        // CRUD Functions - Products
        function showAddProductModal() {
            document.getElementById('productModalTitle').textContent = 'Add Product';
            document.getElementById('productCode').value = 'PROD' + String(Date.now()).slice(-4);
            document.getElementById('productForm').reset();
            document.getElementById('productCode').value = 'PROD' + String(Date.now()).slice(-4);
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }

        function editProduct(id) {
            const product = mockData.products.find(p => p.id === id);
            if (!product) return;
            
            document.getElementById('productModalTitle').textContent = 'Edit Product';
            document.getElementById('productCode').value = product.product_code;
            document.getElementById('productName').value = product.name;
            document.getElementById('productCategory').value = product.category;
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productStock').value = product.stock_quantity;
        }

        async function viewProduct(id) {
            try {
                const response = await apiCall(`admin/products/${id}`);
                const product = response.data;
                
                document.getElementById('viewModalTitle').textContent = 'Product Details';
                document.getElementById('viewModalBody').innerHTML = `
                    <div class="row">
                        <div class="col-md-6"><strong>Product Code:</strong> ${product.product_code || product.sku}</div>
                        <div class="col-md-6"><strong>Name:</strong> ${product.name}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Category:</strong> ${product.category}</div>
                        <div class="col-md-6"><strong>Price:</strong> $${parseFloat(product.price || 0).toFixed(2)}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Stock:</strong> ${product.stock_quantity || 0}</div>
                        <div class="col-md-6"><strong>Status:</strong> <span class="badge ${getStatusBadge(product.status)}">${product.status}</span></div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Description:</strong> ${product.description || 'N/A'}</div>
                        <div class="col-md-6"><strong>Created:</strong> ${product.created_at ? new Date(product.created_at).toLocaleDateString() : 'N/A'}</div>
                    </div>
                `;
                new bootstrap.Modal(document.getElementById('viewModal')).show();
            } catch (error) {
                console.error('Error viewing product:', error);
                showNotification('Error loading product details', 'error');
            }
        }

        function deleteProduct(id) {
            const product = dashboardData.products.find(p => p.id === id);
            if (!product) {
                showNotification('Product not found', 'error');
                return;
            }
            
            showConfirmation(`Are you sure you want to delete the product "${product.name}"?`, async function() {
                try {
                    await apiCall(`admin/products/${id}`, 'DELETE');
                    showNotification(`Product "${product.name}" deleted successfully`, 'success');
                    loadProducts();
                } catch (error) {
                    console.error('Error deleting product:', error);
                }
            });
        }

        async function saveProduct() {
            const productId = document.getElementById('productId')?.value;
            const code = document.getElementById('productCode').value;
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = document.getElementById('productPrice').value;
            const stock = document.getElementById('productStock').value;
            const status = document.getElementById('productStatus').value;
            const description = document.getElementById('productDescription')?.value || '';
            
            if (!name || !category || !price || !stock) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }
            
            const productData = {
                name: name,
                description: description || 'Product description', // Provide default if empty
                category: category,
                price: parseFloat(price),
                cost_price: parseFloat(price) * 0.7, // Assume 30% markup
                stock_quantity: parseInt(stock),
                min_stock_level: Math.max(1, parseInt(stock) * 0.1), // 10% of stock as minimum
                sku: code || `SKU-${Date.now()}`, // Generate SKU if empty
                status: status,
                weight: null,
                dimensions: null,
                tags: null,
                featured: false
            };
            
            try {
                const title = document.getElementById('productModalTitle').textContent;
                
                if (title === 'Add Product') {
                    // Add new product
                    await apiCall('admin/products', 'POST', productData);
                    showNotification(`Product "${name}" created successfully`, 'success');
                } else {
                    // Edit existing product
                    if (!productId) {
                        showNotification('Product ID not found', 'error');
                        return;
                    }
                    await apiCall(`admin/products/${productId}`, 'PUT', productData);
                    showNotification(`Product "${name}" updated successfully`, 'success');
                }
                
                bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
                loadProducts();
            } catch (error) {
                console.error('Error saving product:', error);
            }
        }

        // CRUD Functions - Vendors
        function showAddVendorModal() {
            document.getElementById('vendorModalTitle').textContent = 'Add Vendor';
            document.getElementById('vendorForm').reset();
            document.getElementById('vendorCountry').value = 'Sri Lanka';
            new bootstrap.Modal(document.getElementById('vendorModal')).show();
        }

        async function editVendor(id) {
            try {
                const response = await apiCall(`/admin/vendors/${id}`, 'GET');
                const vendor = response.data;
                
                document.getElementById('vendorModalTitle').textContent = 'Edit Vendor';
                document.getElementById('vendorId').value = vendor.id;
                document.getElementById('vendorName').value = vendor.name;
                document.getElementById('vendorEmail').value = vendor.email;
                document.getElementById('vendorPhone').value = vendor.phone || '';
                document.getElementById('vendorAddress').value = vendor.address || '';
                document.getElementById('vendorCity').value = vendor.city || '';
                document.getElementById('vendorCountry').value = vendor.country || '';
                document.getElementById('vendorContactPerson').value = vendor.contact_person || '';
                document.getElementById('vendorBusinessType').value = vendor.business_type || '';
                document.getElementById('vendorStatus').value = vendor.status;
                
                new bootstrap.Modal(document.getElementById('vendorModal')).show();
            } catch (error) {
                console.error('Error loading vendor:', error);
                showNotification('Error loading vendor details', 'error');
            }
        }

        async function viewVendor(id) {
            try {
                const response = await apiCall(`/admin/vendors/${id}`, 'GET');
                const vendor = response.data;
                
                document.getElementById('viewModalTitle').textContent = 'Vendor Details';
                document.getElementById('viewModalBody').innerHTML = `
                    <div class="row">
                        <div class="col-md-6"><strong>Name:</strong> ${vendor.name}</div>
                        <div class="col-md-6"><strong>Email:</strong> ${vendor.email}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Phone:</strong> ${vendor.phone || 'N/A'}</div>
                        <div class="col-md-6"><strong>Contact Person:</strong> ${vendor.contact_person || 'N/A'}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-12"><strong>Address:</strong> ${vendor.address || 'N/A'}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>City:</strong> ${vendor.city || 'N/A'}</div>
                        <div class="col-md-6"><strong>Country:</strong> ${vendor.country || 'N/A'}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Business Type:</strong> ${vendor.business_type || 'N/A'}</div>
                        <div class="col-md-6"><strong>Tax Number:</strong> ${vendor.tax_number || 'N/A'}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Status:</strong> <span class="badge ${getVendorStatusBadge(vendor.status)}">${vendor.status}</span></div>
                        <div class="col-md-6"><strong>ID:</strong> ${vendor.id}</div>
                    </div>
                `;
                new bootstrap.Modal(document.getElementById('viewModal')).show();
            } catch (error) {
                console.error('Error loading vendor:', error);
                showNotification('Error loading vendor details', 'error');
            }
        }

        async function deleteVendor(id) {
            try {
                // First get vendor details for confirmation
                const response = await apiCall(`/admin/vendors/${id}`, 'GET');
                const vendor = response.data;
                
                showConfirmation(`Are you sure you want to delete the vendor "${vendor.name}"?`, async function() {
                    try {
                        await apiCall(`/admin/vendors/${id}`, 'DELETE');
                        showNotification(`Vendor "${vendor.name}" deleted successfully`, 'success');
                        loadVendors();
                        loadDashboardStats(); // Update stats
                    } catch (error) {
                        console.error('Error deleting vendor:', error);
                        showNotification('Error deleting vendor', 'error');
                    }
                });
            } catch (error) {
                console.error('Error loading vendor for deletion:', error);
                showNotification('Error loading vendor details', 'error');
            }
        }

        async function saveVendor() {
            const vendorId = document.getElementById('vendorId').value;
            const name = document.getElementById('vendorName').value;
            const email = document.getElementById('vendorEmail').value;
            const phone = document.getElementById('vendorPhone').value;
            const address = document.getElementById('vendorAddress').value;
            const city = document.getElementById('vendorCity').value;
            const country = document.getElementById('vendorCountry').value;
            const contactPerson = document.getElementById('vendorContactPerson').value;
            const businessType = document.getElementById('vendorBusinessType').value;
            const status = document.getElementById('vendorStatus').value;
            
            if (!name || !email) {
                showNotification('Please fill in all required fields (Name and Email)', 'error');
                return;
            }
            
            const vendorData = {
                name: name,
                email: email,
                phone: phone || null,
                address: address || null,
                city: city || null,
                country: country || null,
                contact_person: contactPerson || null,
                business_type: businessType || null,
                status: status || 'pending'
            };
            
            try {
                const title = document.getElementById('vendorModalTitle').textContent;
                
                if (title === 'Add Vendor') {
                    // Add new vendor
                    await apiCall('/admin/vendors', 'POST', vendorData);
                    showNotification(`Vendor "${name}" created successfully`, 'success');
                } else {
                    // Edit existing vendor
                    await apiCall(`/admin/vendors/${vendorId}`, 'PUT', vendorData);
                    showNotification(`Vendor "${name}" updated successfully`, 'success');
                }
                
                bootstrap.Modal.getInstance(document.getElementById('vendorModal')).hide();
                loadVendors();
                loadDashboardStats(); // Update stats
            } catch (error) {
                console.error('Error saving vendor:', error);
                showNotification('Error saving vendor: ' + error.message, 'error');
            }
        }

        async function loadVendors() {
            try {
                const response = await apiCall('/admin/vendors', 'GET');
                const vendors = response.data;
                
                const tbody = document.querySelector('#vendorsTable tbody');
                tbody.innerHTML = '';
                
                vendors.forEach(vendor => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${vendor.id}</td>
                        <td>${vendor.name}</td>
                        <td>${vendor.email}</td>
                        <td>${vendor.phone || 'N/A'}</td>
                        <td>${vendor.city || 'N/A'}${vendor.country ? ', ' + vendor.country : ''}</td>
                        <td><span class="badge ${getVendorStatusBadge(vendor.status)}">${vendor.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="viewVendor(${vendor.id})" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-warning me-1" onclick="editVendor(${vendor.id})" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteVendor(${vendor.id})" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading vendors:', error);
                showNotification('Error loading vendors', 'error');
            }
        }

        function showAddVendorModal() {
            document.getElementById('vendorModalTitle').textContent = 'Add Vendor';
            document.getElementById('vendorForm').reset();
            document.getElementById('vendorId').value = '';
            new bootstrap.Modal(document.getElementById('vendorModal')).show();
        }

        // CRUD Functions - Orders
        async function showAddOrderModal() {
            document.getElementById('orderModalTitle').textContent = 'Add Order';
            document.getElementById('orderForm').reset();
            document.getElementById('orderId').value = '';
            
            // Generate unique order number
            document.getElementById('orderNumber').value = 'ORD' + String(Date.now()).slice(-6);
            document.getElementById('orderDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('orderCustomer').value = '';
            document.getElementById('orderCustomerEmail').value = '';
            document.getElementById('orderAmount').value = '';
            document.getElementById('orderStatus').value = 'pending';
            document.getElementById('orderPaymentStatus').value = 'pending';
            
            new bootstrap.Modal(document.getElementById('orderModal')).show();
        }

        async function editOrderStatus(id) {
            try {
                const response = await apiCall(`/admin/orders/${id}`, 'GET');
                const order = response.data;
                
                document.getElementById('orderModalTitle').textContent = 'Edit Order';
                document.getElementById('orderId').value = order.id;
                document.getElementById('orderNumber').value = order.order_number;
                document.getElementById('orderCustomer').value = order.customer ? order.customer.name : '';
                document.getElementById('orderCustomerEmail').value = order.customer ? order.customer.email : '';
                document.getElementById('orderAmount').value = order.total_amount;
                document.getElementById('orderDate').value = order.order_date;
                document.getElementById('orderStatus').value = order.status;
                document.getElementById('orderPaymentStatus').value = order.payment_status;
                
                new bootstrap.Modal(document.getElementById('orderModal')).show();
            } catch (error) {
                console.error('Error loading order:', error);
                showNotification('Error loading order details', 'error');
            }
        }

        async function viewOrder(id) {
            try {
                const response = await apiCall(`/admin/orders/${id}`, 'GET');
                const order = response.data;
                
                document.getElementById('viewModalTitle').textContent = 'Order Details';
                document.getElementById('viewModalBody').innerHTML = `
                    <div class="row">
                        <div class="col-md-6"><strong>Order Number:</strong> ${order.order_number}</div>
                        <div class="col-md-6"><strong>Customer:</strong> ${order.customer ? order.customer.name : 'N/A'}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Customer Email:</strong> ${order.customer ? order.customer.email : 'N/A'}</div>
                        <div class="col-md-6"><strong>Amount:</strong> $${parseFloat(order.total_amount).toFixed(2)}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Date:</strong> ${new Date(order.order_date).toLocaleDateString()}</div>
                        <div class="col-md-6"><strong>ID:</strong> ${order.id}</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-6"><strong>Status:</strong> <span class="badge ${getOrderStatusBadge(order.status)}">${order.status}</span></div>
                        <div class="col-md-6"><strong>Payment:</strong> <span class="badge ${getPaymentStatusBadge(order.payment_status)}">${order.payment_status}</span></div>
                    </div>
                `;
                new bootstrap.Modal(document.getElementById('viewModal')).show();
            } catch (error) {
                console.error('Error loading order:', error);
                showNotification('Error loading order details', 'error');
            }
        }

        async function deleteOrder(id) {
            try {
                // First get order details for confirmation
                const response = await apiCall(`/admin/orders/${id}`, 'GET');
                const order = response.data;
                
                showConfirmation(`Are you sure you want to delete the order "${order.order_number}"?`, async function() {
                    try {
                        await apiCall(`/admin/orders/${id}`, 'DELETE');
                        showNotification(`Order "${order.order_number}" deleted successfully`, 'success');
                        loadOrders();
                        loadDashboardStats(); // Update stats
                    } catch (error) {
                        console.error('Error deleting order:', error);
                        showNotification('Error deleting order', 'error');
                    }
                });
            } catch (error) {
                console.error('Error loading order for deletion:', error);
                showNotification('Error loading order details', 'error');
            }
        }

        async function saveOrder() {
            const orderId = document.getElementById('orderId').value;
            const orderNumber = document.getElementById('orderNumber').value;
            const customer = document.getElementById('orderCustomer').value;
            const customerEmail = document.getElementById('orderCustomerEmail').value;
            const amount = document.getElementById('orderAmount').value;
            const date = document.getElementById('orderDate').value;
            const status = document.getElementById('orderStatus').value;
            const paymentStatus = document.getElementById('orderPaymentStatus').value;
            
            // Debug logging
            console.log('Order form values:', {
                orderId, orderNumber, customer, customerEmail, amount, date, status, paymentStatus
            });
            
            if (!orderNumber || !customer || !amount || !date) {
                const missingFields = [];
                if (!orderNumber) missingFields.push('Order Number');
                if (!customer) missingFields.push('Customer Name');
                if (!amount) missingFields.push('Amount');
                if (!date) missingFields.push('Date');
                
                showNotification(`Please fill in all required fields: ${missingFields.join(', ')}`, 'error');
                return;
            }
            
            const orderData = {
                order_number: orderNumber,
                customer_name: customer,
                customer_email: customerEmail || null,
                total_amount: parseFloat(amount),
                order_date: date,
                status: status || 'pending',
                payment_status: paymentStatus || 'pending'
            };
            
            try {
                const title = document.getElementById('orderModalTitle').textContent;
                
                if (title === 'Add Order') {
                    // Add new order
                    await apiCall('/admin/orders', 'POST', orderData);
                    showNotification(`Order "${orderNumber}" created successfully`, 'success');
                } else {
                    // Edit existing order
                    await apiCall(`/admin/orders/${orderId}`, 'PUT', orderData);
                    showNotification(`Order "${orderNumber}" updated successfully`, 'success');
                }
                
                bootstrap.Modal.getInstance(document.getElementById('orderModal')).hide();
                loadOrders();
                loadDashboardStats(); // Update stats
            } catch (error) {
                console.error('Error saving order:', error);
                showNotification('Error saving order: ' + error.message, 'error');
            }
        }

        async function loadOrders() {
            try {
                const response = await apiCall('/admin/orders', 'GET');
                const orders = response.data;
                
                const tbody = document.querySelector('#ordersTable tbody');
                tbody.innerHTML = '';
                
                orders.forEach(order => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${order.order_number}</td>
                        <td>${order.customer ? order.customer.name : 'N/A'}</td>
                        <td>${new Date(order.order_date).toLocaleDateString()}</td>
                        <td>$${parseFloat(order.total_amount).toFixed(2)}</td>
                        <td><span class="badge ${getOrderStatusBadge(order.status)}">${order.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="viewOrder(${order.id})" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-warning me-1" onclick="editOrderStatus(${order.id})" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteOrder(${order.id})" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading orders:', error);
                showNotification('Error loading orders', 'error');
            }
        }

        // Reports Functions
        function generateReport() {
            new bootstrap.Modal(document.getElementById('reportModal')).show();
        }

        function generateReportFile() {
            const type = document.getElementById('reportType').value;
            const format = document.getElementById('reportFormat').value;
            
            if (!type) {
                showNotification('Please select a report type', 'error');
                return;
            }
            
            showNotification(`${type.charAt(0).toUpperCase() + type.slice(1)} report generated in ${format.toUpperCase()} format`, 'success');
            bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
            loadReports();
        }

        function viewReport(index) {
            showNotification('Report viewer opened', 'info');
        }

        function downloadReport(index) {
            showNotification('Report download started', 'success');
        }

        function deleteReport(index) {
            if (confirm('Are you sure you want to delete this report?')) {
                showNotification('Report deleted successfully', 'success');
                loadReports();
            }
        }

        // Settings Functions
        function saveAllSettings() {
            showNotification('All settings saved successfully', 'success');
        }

        function showAddUserModal() {
            document.getElementById('userModalTitle').textContent = 'Add User';
            document.getElementById('userForm').reset();
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }

        function editUser(id) {
            document.getElementById('userModalTitle').textContent = 'Edit User';
            document.getElementById('userName').value = 'Admin User';
            document.getElementById('userEmail').value = 'admin@thambapannisobha.com';
            document.getElementById('userRole').value = 'admin';
            document.getElementById('userStatus').value = 'active';
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }

        function saveUser() {
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const password = document.getElementById('userPassword').value;
            
            if (!name || !email || !password) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }
            
            showNotification('User saved successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
        }

        // Utility Functions
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('show'); }
        
        function logout() {
            showConfirmation('Are you sure you want to logout?', async function() {
                try {
                    // Call Laravel logout endpoint
                    const response = await fetch('/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        credentials: 'same-origin'
                    });
                    
                    if (response.ok) {
                        showNotification('Logged out successfully', 'success');
                        // Redirect to login page after a short delay
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 1000);
                    } else {
                        throw new Error('Logout failed');
                    }
                } catch (error) {
                    console.error('Logout error:', error);
                    showNotification('Logout failed. Please try again.', 'error');
                    // Fallback: redirect anyway
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                }
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation
            document.querySelectorAll('.nav-link[data-section]').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const section = e.target.closest('.nav-link').dataset.section;
                    showSection(section);
                });
            });

            // Load initial data
            loadDashboardStats();

            // Initialize charts
            setTimeout(() => {
                const salesCtx = document.getElementById('salesChart');
                if (salesCtx) {
                    new Chart(salesCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Sales ($)',
                                data: [1200, 1900, 3000, 2500, 2200, 3000],
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }

                const categoryCtx = document.getElementById('categoryChart');
                if (categoryCtx) {
                    new Chart(categoryCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Spices', 'Ayurvedic', 'Handicrafts', 'Tea'],
                            datasets: [{
                                data: [30, 25, 20, 25],
                                backgroundColor: ['rgba(239, 68, 68, 0.8)', 'rgba(59, 130, 246, 0.8)', 'rgba(245, 158, 11, 0.8)', 'rgba(16, 185, 129, 0.8)']
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: true }
                    });
                }
            }, 100);
        });
    </script>
</body>
</html>
