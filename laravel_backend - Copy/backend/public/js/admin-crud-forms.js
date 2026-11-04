// CRUD Forms and Modals for Admin Dashboard

// Global variables to store current editing items
let currentEditingProduct = null;
let currentEditingVendor = null;
let currentEditingOrder = null;

// Product CRUD Functions
function addProduct() {
    currentEditingProduct = null;
    showProductModal();
}

function editProduct(productId) {
    // Find product data and populate form
    apiCall(`admin/products`)
        .then(response => {
            const product = response.data.find(p => p.id == productId);
            if (product) {
                currentEditingProduct = product;
                showProductModal(product);
            }
        })
        .catch(error => {
            showNotification('Error loading product data', 'error');
        });
}

function viewProduct(productId) {
    apiCall(`admin/products`)
        .then(response => {
            const product = response.data.find(p => p.id == productId);
            if (product) {
                showProductViewModal(product);
            }
        })
        .catch(error => {
            showNotification('Error loading product data', 'error');
        });
}

function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        apiCall(`admin/products/${productId}`, 'DELETE')
            .then(response => {
                showNotification('Product deleted successfully', 'success');
                loadProducts();
            })
            .catch(error => {
                showNotification('Error deleting product', 'error');
            });
    }
}

function showProductModal(product = null) {
    const modalHtml = `
        <div class="modal fade" id="productModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${product ? 'Edit Product' : 'Add New Product'}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" id="productName" value="${product?.name || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SKU *</label>
                                        <input type="text" class="form-control" id="productSku" value="${product?.sku || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category *</label>
                                        <select class="form-control" id="productCategory" required>
                                            <option value="">Select Category</option>
                                            <option value="Spices" ${product?.category === 'Spices' ? 'selected' : ''}>Spices</option>
                                            <option value="Ayurvedic" ${product?.category === 'Ayurvedic' ? 'selected' : ''}>Ayurvedic</option>
                                            <option value="Handicrafts" ${product?.category === 'Handicrafts' ? 'selected' : ''}>Handicrafts</option>
                                            <option value="Tea" ${product?.category === 'Tea' ? 'selected' : ''}>Tea</option>
                                            <option value="Other" ${product?.category === 'Other' ? 'selected' : ''}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control" id="productStatus" required>
                                            <option value="active" ${product?.status === 'active' ? 'selected' : ''}>Active</option>
                                            <option value="inactive" ${product?.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                            <option value="discontinued" ${product?.status === 'discontinued' ? 'selected' : ''}>Discontinued</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description *</label>
                                <textarea class="form-control" id="productDescription" rows="3" required>${product?.description || ''}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price ($) *</label>
                                        <input type="number" class="form-control" id="productPrice" step="0.01" value="${product?.price || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Cost Price ($) *</label>
                                        <input type="number" class="form-control" id="productCostPrice" step="0.01" value="${product?.cost_price || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Stock Quantity *</label>
                                        <input type="number" class="form-control" id="productStock" value="${product?.stock_quantity || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Min Stock Level *</label>
                                        <input type="number" class="form-control" id="productMinStock" value="${product?.min_stock_level || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Weight (kg)</label>
                                        <input type="number" class="form-control" id="productWeight" step="0.001" value="${product?.weight || ''}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Dimensions</label>
                                        <input type="text" class="form-control" id="productDimensions" value="${product?.dimensions || ''}" placeholder="e.g., 10x5x3 cm">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="form-control" id="productTags" value="${product?.tags || ''}" placeholder="Comma separated tags">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="productFeatured" ${product?.featured ? 'checked' : ''}>
                                <label class="form-check-label" for="productFeatured">Featured Product</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="saveProduct()">${product ? 'Update Product' : 'Add Product'}</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById('productModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();
}

function saveProduct() {
    const formData = {
        name: document.getElementById('productName').value,
        sku: document.getElementById('productSku').value,
        category: document.getElementById('productCategory').value,
        status: document.getElementById('productStatus').value,
        description: document.getElementById('productDescription').value,
        price: parseFloat(document.getElementById('productPrice').value),
        cost_price: parseFloat(document.getElementById('productCostPrice').value),
        stock_quantity: parseInt(document.getElementById('productStock').value),
        min_stock_level: parseInt(document.getElementById('productMinStock').value),
        weight: parseFloat(document.getElementById('productWeight').value) || null,
        dimensions: document.getElementById('productDimensions').value || null,
        tags: document.getElementById('productTags').value || null,
        featured: document.getElementById('productFeatured').checked
    };

    // Validation
    if (!formData.name || !formData.sku || !formData.category || !formData.description || 
        !formData.price || !formData.cost_price || !formData.stock_quantity || !formData.min_stock_level) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }

    const method = currentEditingProduct ? 'PUT' : 'POST';
    const endpoint = currentEditingProduct ? `admin/products/${currentEditingProduct.id}` : 'admin/products';

    apiCall(endpoint, method, formData)
        .then(response => {
            showNotification(response.message, 'success');
            bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
            loadProducts();
        })
        .catch(error => {
            showNotification('Error saving product', 'error');
        });
}

// Vendor CRUD Functions
function addVendor() {
    currentEditingVendor = null;
    showVendorModal();
}

function editVendor(vendorId) {
    apiCall(`admin/vendors`)
        .then(response => {
            const vendor = response.data.find(v => v.id == vendorId);
            if (vendor) {
                currentEditingVendor = vendor;
                showVendorModal(vendor);
            }
        })
        .catch(error => {
            showNotification('Error loading vendor data', 'error');
        });
}

function viewVendor(vendorId) {
    apiCall(`admin/vendors`)
        .then(response => {
            const vendor = response.data.find(v => v.id == vendorId);
            if (vendor) {
                showVendorViewModal(vendor);
            }
        })
        .catch(error => {
            showNotification('Error loading vendor data', 'error');
        });
}

function deleteVendor(vendorId) {
    if (confirm('Are you sure you want to delete this vendor?')) {
        apiCall(`admin/vendors/${vendorId}`, 'DELETE')
            .then(response => {
                showNotification('Vendor deleted successfully', 'success');
                loadVendors();
            })
            .catch(error => {
                showNotification('Error deleting vendor', 'error');
            });
    }
}

function showVendorModal(vendor = null) {
    const modalHtml = `
        <div class="modal fade" id="vendorModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${vendor ? 'Edit Vendor' : 'Add New Vendor'}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="vendorForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name *</label>
                                        <input type="text" class="form-control" id="vendorName" value="${vendor?.name || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="vendorEmail" value="${vendor?.email || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone *</label>
                                        <input type="text" class="form-control" id="vendorPhone" value="${vendor?.phone || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Contact Person *</label>
                                        <input type="text" class="form-control" id="vendorContactPerson" value="${vendor?.contact_person || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address *</label>
                                <textarea class="form-control" id="vendorAddress" rows="2" required>${vendor?.address || ''}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">City *</label>
                                        <input type="text" class="form-control" id="vendorCity" value="${vendor?.city || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Country *</label>
                                        <input type="text" class="form-control" id="vendorCountry" value="${vendor?.country || ''}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Business Type *</label>
                                        <select class="form-control" id="vendorBusinessType" required>
                                            <option value="">Select Business Type</option>
                                            <option value="Spice Supplier" ${vendor?.business_type === 'Spice Supplier' ? 'selected' : ''}>Spice Supplier</option>
                                            <option value="Ayurvedic Products" ${vendor?.business_type === 'Ayurvedic Products' ? 'selected' : ''}>Ayurvedic Products</option>
                                            <option value="Handicrafts" ${vendor?.business_type === 'Handicrafts' ? 'selected' : ''}>Handicrafts</option>
                                            <option value="Tea Supplier" ${vendor?.business_type === 'Tea Supplier' ? 'selected' : ''}>Tea Supplier</option>
                                            <option value="Other" ${vendor?.business_type === 'Other' ? 'selected' : ''}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control" id="vendorStatus" required>
                                            <option value="active" ${vendor?.status === 'active' ? 'selected' : ''}>Active</option>
                                            <option value="pending" ${vendor?.status === 'pending' ? 'selected' : ''}>Pending</option>
                                            <option value="inactive" ${vendor?.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tax Number</label>
                                <input type="text" class="form-control" id="vendorTaxNumber" value="${vendor?.tax_number || ''}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="saveVendor()">${vendor ? 'Update Vendor' : 'Add Vendor'}</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById('vendorModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('vendorModal'));
    modal.show();
}

function saveVendor() {
    const formData = {
        name: document.getElementById('vendorName').value,
        email: document.getElementById('vendorEmail').value,
        phone: document.getElementById('vendorPhone').value,
        contact_person: document.getElementById('vendorContactPerson').value,
        address: document.getElementById('vendorAddress').value,
        city: document.getElementById('vendorCity').value,
        country: document.getElementById('vendorCountry').value,
        business_type: document.getElementById('vendorBusinessType').value,
        status: document.getElementById('vendorStatus').value,
        tax_number: document.getElementById('vendorTaxNumber').value || null
    };

    // Validation
    if (!formData.name || !formData.email || !formData.phone || !formData.contact_person || 
        !formData.address || !formData.city || !formData.country || !formData.business_type) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }

    const method = currentEditingVendor ? 'PUT' : 'POST';
    const endpoint = currentEditingVendor ? `admin/vendors/${currentEditingVendor.id}` : 'admin/vendors';

    apiCall(endpoint, method, formData)
        .then(response => {
            showNotification(response.message, 'success');
            bootstrap.Modal.getInstance(document.getElementById('vendorModal')).hide();
            loadVendors();
        })
        .catch(error => {
            showNotification('Error saving vendor', 'error');
        });
}

// Order Status Update
function editOrderStatus(orderId) {
    apiCall(`admin/orders`)
        .then(response => {
            const order = response.data.find(o => o.id == orderId);
            if (order) {
                showOrderStatusModal(order);
            }
        })
        .catch(error => {
            showNotification('Error loading order data', 'error');
        });
}

function showOrderStatusModal(order) {
    const modalHtml = `
        <div class="modal fade" id="orderStatusModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Order Status - ${order.order_number}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="orderStatusForm">
                            <div class="mb-3">
                                <label class="form-label">Order Status</label>
                                <select class="form-control" id="orderStatus" required>
                                    <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="processing" ${order.status === 'processing' ? 'selected' : ''}>Processing</option>
                                    <option value="shipped" ${order.status === 'shipped' ? 'selected' : ''}>Shipped</option>
                                    <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                                    <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Payment Status</label>
                                <select class="form-control" id="paymentStatus" required>
                                    <option value="pending" ${order.payment_status === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="paid" ${order.payment_status === 'paid' ? 'selected' : ''}>Paid</option>
                                    <option value="failed" ${order.payment_status === 'failed' ? 'selected' : ''}>Failed</option>
                                    <option value="refunded" ${order.payment_status === 'refunded' ? 'selected' : ''}>Refunded</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="updateOrderStatus(${order.id})">Update Status</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById('orderStatusModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('orderStatusModal'));
    modal.show();
}

function updateOrderStatus(orderId) {
    const formData = {
        status: document.getElementById('orderStatus').value,
        payment_status: document.getElementById('paymentStatus').value
    };

    apiCall(`admin/orders/${orderId}/status`, 'PUT', formData)
        .then(response => {
            showNotification('Order status updated successfully', 'success');
            bootstrap.Modal.getInstance(document.getElementById('orderStatusModal')).hide();
            loadOrders();
        })
        .catch(error => {
            showNotification('Error updating order status', 'error');
        });
}

// View functions (for displaying detailed information)
function viewOrder(orderId) {
    apiCall(`admin/orders`)
        .then(response => {
            const order = response.data.find(o => o.id == orderId);
            if (order) {
                showOrderViewModal(order);
            }
        })
        .catch(error => {
            showNotification('Error loading order data', 'error');
        });
}

function showOrderViewModal(order) {
    const modalHtml = `
        <div class="modal fade" id="orderViewModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details - ${order.order_number}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Order Information</h6>
                                <p><strong>Order Number:</strong> ${order.order_number}</p>
                                <p><strong>Date:</strong> ${new Date(order.order_date).toLocaleDateString()}</p>
                                <p><strong>Status:</strong> <span class="badge ${getOrderStatusBadge(order.status)}">${order.status}</span></p>
                                <p><strong>Payment Status:</strong> <span class="badge ${getPaymentStatusBadge(order.payment_status)}">${order.payment_status}</span></p>
                                <p><strong>Total Amount:</strong> $${parseFloat(order.total_amount).toFixed(2)}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Customer Information</h6>
                                <p><strong>Name:</strong> ${order.customer ? order.customer.name : 'N/A'}</p>
                                <p><strong>Email:</strong> ${order.customer ? order.customer.email : 'N/A'}</p>
                                <p><strong>Phone:</strong> ${order.customer ? order.customer.phone : 'N/A'}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Shipping Address</h6>
                                <p>${order.shipping_address}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Billing Address</h6>
                                <p>${order.billing_address}</p>
                            </div>
                        </div>
                        ${order.notes ? `<hr><h6>Notes</h6><p>${order.notes}</p>` : ''}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editOrderStatus(${order.id})">Update Status</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById('orderViewModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('orderViewModal'));
    modal.show();
}
