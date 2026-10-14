@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Vendor Management</h3>
                    <p class="text-muted mb-0 fs-13">Manage brokers, agents, assigned customers and commissions.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search Box -->
                    <div class="input-group shadow-sm" style="width: 170px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search" />
                    </div>

                    <!-- Bell/Notification Icon -->
                    <button
                        class="btn btn-sm btn-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 34px; height: 34px; background-color: #fff;">
                        <i class="ti ti-bell fs-16 text-muted"></i>
                    </button>

                    <!-- Admin Profile Badge -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-12 shadow-sm"
                            style="background-color: #561325; width: 34px; height: 34px;">
                            AJ
                        </div>
                        <div class="d-none d-sm-block text-start lh-1">
                            <span class="fw-bold d-block text-dark fs-13">Admin</span>
                            <small class="text-muted fs-11">Super Admin</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar, Filters & Action Button Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center justify-content-between">
                        <div class="col-xl-4 col-md-5 col-sm-12">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                    <i class="ti ti-search fs-14"></i>
                                </span>
                                <input type="text" id="vendorSearchInput" class="form-control border-start-0 ps-1 fs-13"
                                    placeholder="Search vendor, ID or city">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <select id="vendorStatusFilter" class="form-select fs-13 text-secondary border">
                                <option value="">All statuses</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-md-3 col-sm-6 text-sm-end text-start">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#addVendorModal"
                                class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                                style="background-color: #561325;">
                                <i class="ti ti-plus me-1"></i> Add Vendor
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metric KPI Cards -->
            <div class="row g-3 mb-4">
                <!-- Total vendors -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+8.4%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Total vendors</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricTotal">248</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending approval -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">!</span>
                                <span class="text-muted fs-11">Review needed</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Pending approval</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricPending">40</h3>
                        </div>
                    </div>
                </div>

                <!-- Active agents -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #E8F8F0; color: #0E9F6E; font-size: 13px;">✓</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">Active</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Active agents</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricActive">196</h3>
                        </div>
                    </div>
                </div>

                <!-- Commission due -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">₹</span>
                                <span class="text-muted fs-11">Current period</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Commission due</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricCommission">₹82,400</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vendor Directory Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">Vendor Directory</h5>
                    <p class="text-muted fs-12 mb-0">Each agent has a separate login and scoped customer access.</p>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">VENDOR ID</th>
                                <th class="py-3">AGENT NAME</th>
                                <th class="py-3">CITY</th>
                                <th class="py-3">CUSTOMERS</th>
                                <th class="py-3">STATUS</th>
                                <th class="py-3">COMMISSION</th>
                                <th class="text-center pe-4 py-3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="vendorTableBody" class="fs-13">
                            <!-- Rendered by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Access Rule Notice Bar (Bottom of Table) -->
                <div class="p-3 m-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                    <p class="fs-12 mb-0 d-flex align-items-center" style="color: #8D6718;">
                        <i class="ti ti-info-circle me-2 fs-15"></i>
                        <span><strong>Access rule:</strong> Vendors can only view and manage customers assigned to their own
                            vendor account.</span>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Vendor Modal -->
    <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold" id="addVendorModalLabel" style="color: #561325;">Add New Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addVendorForm">
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Agent / Business Name</label>
                            <input type="text" class="form-control fs-13" id="vendorName" placeholder="e.g. R. Senthil"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">City</label>
                            <input type="text" class="form-control fs-13" id="vendorCity" placeholder="e.g. Chennai"
                                required />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Initial Customers</label>
                                <input type="number" class="form-control fs-13" id="vendorCustomers" value="0" min="0"
                                    required />
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Status</label>
                                <select class="form-select fs-13" id="vendorStatus" required>
                                    <option value="Active" selected>Active</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 pb-4">
                        <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn fs-13 text-white fw-semibold"
                            style="background-color: #561325;">Save Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let vendors = [
                { id: "VN-00248", name: "R. Senthil", city: "Chennai", customers: 36, status: "Active", commission: "₹12,500" },
                { id: "VN-00247", name: "M. Fathima", city: "Vellore", customers: 21, status: "Pending", commission: "₹0" },
                { id: "VN-00246", name: "K. Prakash", city: "Salem", customers: 18, status: "Active", commission: "₹8,200" },
                { id: "VN-00245", name: "S. Meena", city: "Madurai", customers: 12, status: "Active", commission: "₹4,800" },
                { id: "VN-00244", name: "A. Kumar", city: "Trichy", customers: 9, status: "Suspended", commission: "₹0" }
            ];

            const statusColorMap = {
                'Active': 'color: #28a745;',
                'Pending': 'color: #d39e00;',
                'Suspended': 'color: #dc3545;'
            };

            const tbody = document.getElementById('vendorTableBody');
            const searchInput = document.getElementById('vendorSearchInput');
            const statusFilter = document.getElementById('vendorStatusFilter');

            function renderTable(list) {
                tbody.innerHTML = '';
                if (list.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">No vendors found matching your filter criteria.</td></tr>`;
                    return;
                }

                list.forEach(v => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="ps-4 fw-semibold text-dark">${v.id}</td>
                        <td class="fw-medium text-dark">${v.name}</td>
                        <td class="text-muted">${v.city}</td>
                        <td class="fw-medium text-dark">${v.customers}</td>
                        <td>
                            <span class="fw-semibold" style="${statusColorMap[v.status] || ''}">
                                ${v.status}
                            </span>
                        </td>
                        <td class="fw-medium text-dark">${v.commission}</td>
                        <td class="text-center pe-4">
                            <button class="btn btn-link text-muted p-0 fs-16 border-0 text-decoration-none" title="Actions">•••</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function filterVendors() {
                const query = searchInput.value.toLowerCase().trim();
                const selectedStatus = statusFilter.value;

                const filtered = vendors.filter(item => {
                    const matchesQuery = item.name.toLowerCase().includes(query) ||
                        item.id.toLowerCase().includes(query) ||
                        item.city.toLowerCase().includes(query);
                    const matchesStatus = !selectedStatus || item.status === selectedStatus;
                    return matchesQuery && matchesStatus;
                });

                renderTable(filtered);
            }

            searchInput.addEventListener('input', filterVendors);
            statusFilter.addEventListener('change', filterVendors);

            // Add vendor submit
            document.getElementById('addVendorForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const randomId = "VN-00" + Math.floor(250 + Math.random() * 50);
                const newVendor = {
                    id: randomId,
                    name: document.getElementById('vendorName').value,
                    city: document.getElementById('vendorCity').value,
                    customers: parseInt(document.getElementById('vendorCustomers').value) || 0,
                    status: document.getElementById('vendorStatus').value,
                    commission: "₹0"
                };

                vendors.unshift(newVendor);
                filterVendors();

                const modal = bootstrap.Modal.getInstance(document.getElementById('addVendorModal'));
                if (modal) modal.hide();
                this.reset();
            });

            // Initial render
            renderTable(vendors);
        });
    </script>
@endsection