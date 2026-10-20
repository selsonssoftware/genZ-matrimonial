<?php $__env->startSection('content'); ?>
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

      

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php endif; ?>

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Vendor Management</h3>
                    <p class="text-muted mb-0 fs-13">Manage brokers, agents, assigned customers and commissions.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                   

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
<div class="card border-0 shadow-sm rounded-4 mb-4 bg-white"
     style="border: 1px solid #F3E5E8 !important;">
    <div class="card-body p-3">

        <form method="GET" action="<?php echo e(route('admin.vendors.index')); ?>">
            <div class="row g-2 align-items-center justify-content-between">

                <!-- Search -->
                <div class="col-xl-4 col-md-5 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                            <i class="ti ti-search fs-14"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="<?php echo e($search ?? ''); ?>"
                            class="form-control border-start-0 ps-1 fs-13"
                            placeholder="Search vendor, ID or city">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-xl-3 col-md-4 col-sm-6">
                    <select name="status"
                            class="form-select fs-13 text-secondary border">
                        <option value="">All statuses</option>

                        <option value="Active"
                            <?php echo e(($status ?? '') === 'Active' ? 'selected' : ''); ?>>
                            Active
                        </option>

                        <option value="Pending"
                            <?php echo e(($status ?? '') === 'Pending' ? 'selected' : ''); ?>>
                            Pending
                        </option>

                        <option value="Suspended"
                            <?php echo e(($status ?? '') === 'Suspended' ? 'selected' : ''); ?>>
                            Suspended
                        </option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-xl-3 col-md-4 col-sm-5 text-sm-end text-start">
                  <div class="d-flex justify-content-end align-items-center gap-2 flex-nowrap">
                    <button type="submit"
                            class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                            style="background-color: #561325;">
                        <i class="ti ti-search me-1"></i> Search
                    </button>

                    <button type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#addVendorModal"
                            class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                            style="background-color: #561325;">
                        <i class="ti ti-plus me-1"></i> Add Vendor
                    </button>
                  </div>
                </div>
            </div>
        </form>

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
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricTotal"><?php echo e(number_format($totalVendors)); ?></h3>
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
                            <h3 class="fw-bold mb-0 text-dark" id="metricPending"><?php echo e(number_format($pendingVendors)); ?></h3>
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
                            <h3 class="fw-bold mb-0 text-dark" id="metricActive"><?php echo e(number_format($activeVendors)); ?></h3>
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
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricCommission">₹<?php echo e(number_format($totalCommission, 2)); ?></h3>
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
                    <table id="vendorDirectoryTable" class="table align-middle mb-0 table-hover js-data-table" data-paging="false">
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
                       
<tbody class="fs-13">
    <?php $__empty_1 = true; $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="ps-4 fw-semibold text-dark">
                VN-<?php echo e(str_pad($vendor->id, 5, '0', STR_PAD_LEFT)); ?>

            </td>

            <td class="fw-medium text-dark">
                <?php echo e($vendor->agent_name); ?>

            </td>

            <td class="text-muted">
                <?php echo e($vendor->city); ?>

            </td>

            <td class="fw-medium text-dark">
                <?php echo e($vendor->customers_count); ?>

            </td>

            
<td>
    <?php
        $statusClass = 'text-secondary';

        if ($vendor->status === 'Active') {
            $statusClass = 'text-success';
        } elseif ($vendor->status === 'Pending') {
            $statusClass = 'text-warning';
        } elseif ($vendor->status === 'Suspended') {
            $statusClass = 'text-danger';
        }
    ?>

    <span class="fw-semibold <?php echo e($statusClass); ?>">
        <?php echo e($vendor->status); ?>

    </span>
</td>

           

            <td class="fw-medium text-dark">
                ₹<?php echo e(number_format((float) $vendor->commission, 2)); ?>

            </td>

            <td class="text-center pe-4">
                <button type="button"
                        class="btn btn-sm btn-outline-secondary js-toggle-vendor-assignment"
                        data-template="assignVendor<?php echo e($vendor->id); ?>"
                        aria-expanded="false">
                    Assign Profile
                </button>
                <template id="assignVendor<?php echo e($vendor->id); ?>">
                    <form method="POST"
                          action="<?php echo e(route('admin.vendors.assign-profile', $vendor->id)); ?>"
                          class="d-flex flex-wrap gap-2 p-3">
                        <?php echo csrf_field(); ?>

                        <input type="text"
                               name="profile_id"
                               class="form-control form-control-sm"
                               placeholder="Member Profile ID"
                               required
                               style="max-width:300px;">

                        <button type="submit"
                                class="btn btn-sm text-white"
                                style="background-color:#561325;">
                            Assign Profile
                        </button>
                    </form>
                </template>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7" class="text-center py-4 text-muted">
                No vendors found.
            </td>
        </tr>
    <?php endif; ?>
</tbody>

                    </table>
                </div>
 <!-- Pagination -->
                <div class="px-4 py-3">
                    <?php echo e($vendors->links()); ?>

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
  
<div class="modal fade" id="addVendorModal" tabindex="-1"
     aria-labelledby="addVendorModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">

            
            <div class="modal-header px-4 pt-4 pb-3"
                 style="border-bottom: 1px solid #f0e3e7;">

                <div>
                    <h5 class="modal-title fw-bold"
                        id="addVendorModalLabel"
                        style="color: #561325;">
                        Add New Vendor
                    </h5>

                    <p class="text-muted small mb-0 mt-1">
                        Enter the vendor details below.
                    </p>
                </div>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            
            <form method="POST"
                  action="<?php echo e(route('admin.vendors.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="modal-body px-4 py-4">

                    <div class="row g-3">

                        
                        <div class="col-md-6">
                            <label for="agent_name"
                                   class="form-label fw-semibold">
                                Agent Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   id="agent_name"
                                   name="agent_name"
                                   class="form-control"
                                   placeholder="Enter agent name"
                                   value="<?php echo e(old('agent_name')); ?>"
                                   required>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="city"
                                   class="form-label fw-semibold">
                                City <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   id="city"
                                   name="city"
                                   class="form-control"
                                   placeholder="Enter city"
                                   value="<?php echo e(old('city')); ?>"
                                   required>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="email"
                                   class="form-label fw-semibold">
                                Email Address <span class="text-danger">*</span>
                            </label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="vendor@example.com"
                                   value="<?php echo e(old('email')); ?>"
                                   required>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="status"
                                   class="form-label fw-semibold">
                                Vendor Status <span class="text-danger">*</span>
                            </label>

                          <select id="vendor_status"
        name="status"
        class="form-select"
        style="display: block !important;
               width: 100%;
               min-height: 42px;
               background-color: #fff;
               color: #333;
               border: 1px solid #ced4da;
               appearance: auto;
               -webkit-appearance: auto;"
        required>
    <option value="Active" <?php echo e(old('status', 'Active') === 'Active' ? 'selected' : ''); ?>>
        Active
    </option>
    <option value="Pending" <?php echo e(old('status') === 'Pending' ? 'selected' : ''); ?>>
        Pending
    </option>
    <option value="Suspended" <?php echo e(old('status') === 'Suspended' ? 'selected' : ''); ?>>
        Suspended
    </option>
</select>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="commission"
                                   class="form-label fw-semibold">
                                Commission (%) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   id="commission"
                                   name="commission"
                                   class="form-control"
                                   placeholder="Enter commission"
                                   min="0"
                                   step="0.01"
                                   value="<?php echo e(old('commission')); ?>"
                                   required>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="password"
                                   class="form-label fw-semibold">
                                Password <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Create password"
                                   required>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="password_confirmation"
                                   class="form-label fw-semibold">
                                Confirm Password <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm password"
                                   required>
                        </div>

                    </div>
                </div>

                
                <div class="modal-footer px-4 py-3"
                     style="border-top: 1px solid #f0e3e7;">

                    <button type="button"
                            class="btn btn-light border rounded-3 px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn text-white fw-semibold rounded-3 px-4"
                            style="background-color: #561325;">
                        <i class="ti ti-plus me-1"></i>
                        Add Vendor
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GenZ\backend\resources\views/admin/vendors.blade.php ENDPATH**/ ?>