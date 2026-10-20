<?php $__env->startSection('content'); ?>
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">User Management</h3>
                    <p class="text-muted mb-0 fs-13">Search, review and manage member accounts.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search Input Button-like -->
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

            <!-- Filter & Actions Bar Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center justify-content-between">
                        <!-- Search Input -->
                        <div class="col-xl-4 col-lg-3 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                    <i class="ti ti-search fs-14"></i>
                                </span>
                                <input type="text" id="userSearchInput" class="form-control border-start-0 ps-1 fs-13"
                                    placeholder="Search name, ID or mobile">
                            </div>
                        </div>

                        <!-- Gender Filter -->
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                            <select id="filterGender" class="form-select fs-13 text-secondary border">
                                <option value="">All genders</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                            <select id="filterStatus" class="form-select fs-13 text-secondary border">
                                <option value="">All statuses</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Review">Review</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>

                        <!-- Membership Filter -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                            <select id="filterPlan" class="form-select fs-13 text-secondary border">
                                <option value="">Membership</option>
                                <option value="Free">Free</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>

                        <!-- Action Buttons: Add User & Export -->
                        <div class="col-xl-2 col-lg-1 col-md-6 col-6 d-flex gap-2 justify-content-end">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                                class="btn btn-sm text-nowrap fw-semibold px-3 py-2 rounded-3"
                                style="background-color: #FCECEE; color: #561325; border: 1px solid #F5D3D8;">
                                + Add User
                            </button>

                            <button type="button"
                                class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                                style="background-color: #561325;">
                                Export <i class="ti ti-download ms-1 fs-12"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metric / Stats Cards -->
            <div class="row g-3 mb-4">
                <!-- All members -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">All members</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="countAll">12,840</h3>
                        </div>
                    </div>
                </div>

                <!-- Active -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Active</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countActive">11,904</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending / Needs review -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Pending</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countPending">186</h3>
                        </div>
                    </div>
                </div>

                <!-- Suspended -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Suspended</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countSuspended">32</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Table Section Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">All Members</h5>
                    <p class="text-muted fs-12 mb-0">Manage member profiles, membership and account status.</p>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">USER ID</th>
                                <th class="py-3">MEMBER</th>
                                <th class="py-3">GENDER · AGE</th>
                                <th class="py-3">CITY</th>
                                <th class="py-3">STATUS</th>
                                <th class="py-3">PLAN</th>
                                <th class="text-center pe-4 py-3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="fs-13">
                            <!-- Populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Table Pagination Footer -->
                <div
                    class="card-footer bg-white border-0 py-3 px-4 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="text-muted fs-12" id="paginationLabel">Showing 1-6 of 12,840 members</span>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link text-muted border-0" href="#">‹</a></li>
                            <li class="page-item active">
                                <a class="page-link text-white rounded-2 mx-1 px-2 border-0" href="#"
                                    style="background-color: #561325;">1</a>
                            </li>
                            <li class="page-item"><a class="page-link text-dark rounded-2 mx-1 px-2 border-0" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link text-dark rounded-2 mx-1 px-2 border-0" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link text-dark border-0" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold" id="addUserModalLabel" style="color: #561325;">Add New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm">
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Full Name</label>
                            <input type="text" class="form-control fs-13" id="newUserName" placeholder="e.g. Priyan S."
                                required />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Gender</label>
                                <select class="form-select fs-13" id="newUserGender" required>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Age</label>
                                <input type="number" class="form-control fs-13" id="newUserAge" placeholder="26" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">City</label>
                            <input type="text" class="form-control fs-13" id="newUserCity" placeholder="e.g. Chennai"
                                required />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Status</label>
                                <select class="form-select fs-13" id="newUserStatus" required>
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Review">Review</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Plan</label>
                                <select class="form-select fs-13" id="newUserPlan" required>
                                    <option value="Free">Free</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 pb-4">
                        <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn fs-13 text-white fw-semibold"
                            style="background-color: #561325;">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Dynamic Search & Filter Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let membersData = [
                { id: "TM-10482", name: "Priya S.", gender: "Female", age: 27, city: "Chennai", status: "Pending", plan: "Free" },
                { id: "TM-10481", name: "Arun K.", gender: "Male", age: 30, city: "Coimbatore", status: "Active", plan: "Premium" },
                { id: "TM-10480", name: "Nivetha R.", gender: "Female", age: 25, city: "Madurai", status: "Active", plan: "Free" },
                { id: "TM-10479", name: "Karthik M.", gender: "Male", age: 29, city: "Salem", status: "Review", plan: "Premium" },
                { id: "TM-10478", name: "Divya P.", gender: "Female", age: 26, city: "Trichy", status: "Suspended", plan: "Free" },
                { id: "TM-10477", name: "Sanjay R.", gender: "Male", age: 31, city: "Chennai", status: "Active", plan: "Premium" }
            ];

            const statusColorMap = {
                'Active': 'color: #28a745;',
                'Pending': 'color: #d39e00;',
                'Review': 'color: #e07e34;',
                'Suspended': 'color: #dc3545;'
            };

            const tbody = document.getElementById('usersTableBody');
            const searchInput = document.getElementById('userSearchInput');
            const filterGender = document.getElementById('filterGender');
            const filterStatus = document.getElementById('filterStatus');
            const filterPlan = document.getElementById('filterPlan');
            const paginationLabel = document.getElementById('paginationLabel');

            function renderRows(list) {
                tbody.innerHTML = '';
                if (list.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No members match your criteria.</td></tr>';
                    paginationLabel.innerText = 'Showing 0 members';
                    return;
                }

                list.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                                                            <td class="ps-4 fw-semibold text-dark">${item.id}</td>
                                                            <td class="text-dark fw-medium">${item.name}</td>
                                                            <td class="text-muted">${item.gender} · ${item.age}</td>
                                                            <td class="text-dark">${item.city}</td>
                                                            <td>
                                                                <span class="fw-semibold" style="${statusColorMap[item.status] || ''}">${item.status}</span>
                                                            </td>
                                                            <td>
                                                                <span class="${item.plan === 'Premium' ? 'fw-bold text-dark' : 'text-muted'}">${item.plan}</span>
                                                            </td>
                                                            <td class="text-center pe-4">
                                                                <button class="btn btn-link text-muted p-0 fs-16 border-0 text-decoration-none" title="Actions">•••</button>
                                                            </td>
                                                        `;
                    tbody.appendChild(tr);
                });
                paginationLabel.innerText = `Showing 1-${list.length} of 12,840 members`;
            }

            function filterList() {
                const query = searchInput.value.toLowerCase().trim();
                const gender = filterGender.value;
                const status = filterStatus.value;
                const plan = filterPlan.value;

                const filtered = membersData.filter(item => {
                    const matchesQuery = item.name.toLowerCase().includes(query) ||
                        item.id.toLowerCase().includes(query) ||
                        item.city.toLowerCase().includes(query);
                    const matchesGender = !gender || item.gender === gender;
                    const matchesStatus = !status || item.status === status;
                    const matchesPlan = !plan || item.plan === plan;

                    return matchesQuery && matchesGender && matchesStatus && matchesPlan;
                });

                renderRows(filtered);
            }

            searchInput.addEventListener('input', filterList);
            filterGender.addEventListener('change', filterList);
            filterStatus.addEventListener('change', filterList);
            filterPlan.addEventListener('change', filterList);

            // Add user modal form handler
            document.getElementById('addUserForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const randomId = "TM-" + Math.floor(10000 + Math.random() * 90000);
                const newMember = {
                    id: randomId,
                    name: document.getElementById('newUserName').value,
                    gender: document.getElementById('newUserGender').value,
                    age: parseInt(document.getElementById('newUserAge').value),
                    city: document.getElementById('newUserCity').value,
                    status: document.getElementById('newUserStatus').value,
                    plan: document.getElementById('newUserPlan').value
                };

                membersData.unshift(newMember);
                filterList();

                const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                if (modal) modal.hide();
                this.reset();
            });

            // Initial render
            renderRows(membersData);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GenZ\backend\resources\views/management.blade.php ENDPATH**/ ?>