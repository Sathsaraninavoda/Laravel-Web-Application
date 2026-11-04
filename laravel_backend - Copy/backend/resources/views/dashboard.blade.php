@extends('layouts.app')

@section('title', 'Thambapanni Sobha - Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <div class="logo">
                        <i class="fas fa-store me-2"></i>
                        Thambapanni Sobha
                    </div>
                    <div class="mt-2">
                        <span id="userRole" class="role-badge admin-badge">Admin</span>
                    </div>
                </div>

                <ul class="nav flex-column" id="sidebarNav">
                    {{-- Dynamic nav items could go here --}}
                </ul>

                <div class="mt-auto p-3">
                    <button class="btn btn-outline-light btn-sm w-100" onclick="logout()">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </div>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4">
                <h1 class="h2" id="dashboardTitle">Admin Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <select class="form-select" id="roleSelector" onchange="switchRole()">
                            <option value="admin">Admin View</option>
                            <option value="vendor">Vendor View</option>
                            <option value="customer">Customer View</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="headerReportsButton">
                        <i class="fas fa-download me-1"></i> Reports
                    </button>
                </div>
            </div>

           
 <div class="row mb-4" id="statsContainer">
                    </div>

                <div id="dashboardContent">
                    <div id="dashboardView" class="content-section">
                        <div class="row">
                            <div class="col-md-6" id="salesOverviewChartCol">
                                <div class="chart-container p-3 mb-4">
                                    <h6 class="mb-3">Sales Overview</h6>
                                    <div class="css-chart" id="salesChart">
                                        <div class="chart-line"></div>
                                        <div class="chart-labels"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="recentActivityCol">
                                <div class="chart-container p-4 mb-4">
                                    <h6 class="mb-3">Recent Activity</h6>
                                    <div id="recentActivity">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="chart-container p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 id="quickTableTitle">Recent Orders</h6>
                                <button class="btn btn-sm btn-success" onclick="addNew()">
                                    <i class="fas fa-plus me-1"></i> Add New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead id="quickTableHead"></thead>
                                    <tbody id="quickTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="ordersView" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Orders Management</h4>
                            <div>
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i> New Order
                                </button>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="stats-card orders p-3">
                                    <h6 class="text-muted">Total Orders</h6>
                                    <h4>1,234</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #f59e0b;">
                                    <h6 class="text-muted">Pending</h6>
                                    <h4>45</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #10b981;">
                                    <h6 class="text-muted">Completed</h6>
                                    <h4>1,156</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #ef4444;">
                                    <h6 class="text-muted">Cancelled</h6>
                                    <h4>33</h4>
                                </div>
                            </div>
                        </div>

                        <div class="chart-container p-4">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#ORD001</td>
                                            <td>Kumara Silva</td>
                                            <td>Ceylon Tea Set</td>
                                            <td>2024-01-15</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            <td>Rs. 2,500</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1">View</button>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD002</td>
                                            <td>Nimal Perera</td>
                                            <td>Handwoven Basket</td>
                                            <td>2024-01-14</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>Rs. 1,800</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1">View</button>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD003</td>
                                            <td>Priya Fernando</td>
                                            <td>Ayurvedic Oil</td>
                                            <td>2024-01-13</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            <td>Rs. 950</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1">View</button>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="productsView" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Products Management</h4>
                            <div>
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-search me-1"></i> Search
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i> Add Product
                                </button>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="stats-card products p-3">
                                    <h6 class="text-muted">Total Products</h6>
                                    <h4>856</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #10b981;">
                                    <h6 class="text-muted">Active</h6>
                                    <h4>745</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #f59e0b;">
                                    <h6 class="text-muted">Low Stock</h6>
                                    <h4>67</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card p-3" style="border-left-color: #ef4444;">
                                    <h6 class="text-muted">Out of Stock</h6>
                                    <h4>44</h4>
                                </div>
                            </div>
                        </div>

                        <div class="chart-container p-4">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/Ceylon Tea.jpg') }}" class="card-img-top" alt="Ceylon Tea">
                                        <div class="card-body">
                                            <h6 class="card-title">Ceylon Black Tea</h6>
                                            <p class="card-text text-muted small">Premium quality tea from Sri Lanka</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold">Rs. 850</span>
                                                <span class="badge bg-success">In Stock</span>
                                            </div>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-primary me-1">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/TraditionalHandwovenBasket.jpg') }}" class="card-img-top" alt="Basket">
                                        <div class="card-body">
                                            <h6 class="card-title">Handwoven Basket</h6>
                                            <p class="card-text text-muted small">Traditional Sri Lankan craftsmanship</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold">Rs. 1,200</span>
                                                <span class="badge bg-warning">Low Stock</span>
                                            </div>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-primary me-1">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/Ayurvedic Oils.jpg') }}" class="card-img-top" alt="Oil">
                                        <div class="card-body">
                                            <h6 class="card-title">Ayurvedic Oil</h6>
                                            <p class="card-text text-muted small">Natural healing oil blend</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold">Rs. 650</span>
                                                <span class="badge bg-success">In Stock</span>
                                            </div>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-primary me-1">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/CeylonCinnamonSticks.jpg') }}" class="card-img-top" alt="Cinnamon">
                                        <div class="card-body">
                                            <h6 class="card-title">Ceylon Cinnamon</h6>
                                            <p class="card-text text-muted small">Pure Ceylon cinnamon sticks</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold">Rs. 450</span>
                                                <span class="badge bg-danger">Out of Stock</span>
                                            </div>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-primary me-1">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="usersView" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Users Management</h4>
                            <button class="btn btn-success">
                                <i class="fas fa-user-plus me-1"></i> Add User
                            </button>
                        </div>

                        <div class="chart-container p-4">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kumara Silva</td>
                                            <td>kumara@email.com</td>
                                            <td><span class="badge customer-badge">Customer</span></td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>2024-01-10</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1">View</button>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nimal Perera</td>
                                            <td>nimal@email.com</td>
                                            <td><span class="badge vendor-badge">Vendor</span></td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>2024-01-08</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1">View</button>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="reportsView" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Reports & Analytics</h4>
                            <button class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Export Report
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container p-3 mb-4">
                                    <h6>Monthly Sales</h6>
                                    <div class="css-chart" id="monthlySalesChart">
                                        <div class="chart-line"></div>
                                        <div class="chart-labels"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chart-container p-3 mb-4">
                                    <h6>Top Products</h6>
                                    <div class="css-chart" id="topProductsChart">
                                        <div class="chart-line"></div>
                                        <div class="chart-labels"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chart-container p-3 mb-4">
                                    <h6>Order Status</h6>
                                    <div class="text-center pt-4">
                                        <div class="mb-2">
                                            <span class="badge bg-success me-2">Completed: 89%</span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="badge bg-warning me-2">Pending: 8%</span>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger">Cancelled: 3%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="profileView" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>My Profile</h4>
                            <button class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container p-4 text-center">
                                    <img src="{{ asset('assets/aboutus1.jpg') }}" class="rounded-circle mb-3" alt="Profile Picture">
                                    <h5>John Customer</h5>
                                    <p class="text-muted">customer@email.com</p>
                                    <span class="badge customer-badge">Customer</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="chart-container p-4">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="John">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="Customer">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" value="customer@email.com">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" class="form-control" value="+94 77 123 4567">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" value="Colombo">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" rows="3">123 Main Street, Colombo 03, Sri Lanka</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                        <button type="button" class="btn btn-outline-secondary ms-2">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        </main>
    </div>
</div>
@endsection
