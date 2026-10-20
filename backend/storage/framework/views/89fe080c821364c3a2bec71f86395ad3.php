<?php $__env->startSection('content'); ?>
    <style>
        /* Thirumana Matrimonial Theme Styles */
        :root {
            --tm-burgundy: #37101e;
            --tm-burgundy-light: #501729;
            --tm-gold: #cfa860;
            --tm-gold-hover: #b8934b;
            --tm-bg: #f8f6f5;
            --tm-border: #ebdcd5;
        }

        .tm-header-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--tm-burgundy);
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .tm-badge-gold {
            background-color: rgba(207, 168, 96, 0.15);
            color: #8c6a28;
            border: 1px solid rgba(207, 168, 96, 0.4);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .tm-card {
            background: #ffffff;
            border: 1px solid var(--tm-border);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(55, 16, 30, 0.04);
            overflow: hidden;
        }

        .tm-table thead th {
            background-color: var(--tm-burgundy);
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 15px 18px;
            border: none;
        }

        .tm-table tbody td {
            padding: 16px 18px;
            color: #443c3f;
            font-size: 14px;
            border-bottom: 1px solid var(--tm-border);
            vertical-align: middle;
        }

        .tm-table tbody tr:hover {
            background-color: rgba(207, 168, 96, 0.04);
        }

        /* Buttons */
        .btn-tm-edit {
            background-color: #f8f4f6;
            color: var(--tm-burgundy);
            border: 1px solid #ebd4dd;
            font-weight: 600;
            font-size: 12.5px;
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .btn-tm-edit:hover {
            background-color: var(--tm-burgundy);
            color: #ffffff;
            border-color: var(--tm-burgundy);
        }

        .btn-tm-delete {
            background-color: #fff5f5;
            color: #b91c1c;
            border: 1px solid #fed7d7;
            font-weight: 600;
            font-size: 12.5px;
            padding: 6px 14px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-tm-delete:hover {
            background-color: #b91c1c;
            color: #ffffff;
            border-color: #b91c1c;
        }

        .btn-tm-primary {
            background-color: var(--tm-burgundy);
            color: #ffffff;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            padding: 10px 18px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            transition: 0.2s;
        }

        .btn-tm-primary:hover {
            background-color: var(--tm-burgundy-light);
            color: #ffffff;
        }

        .tm-user-avatar {
            width: 34px;
            height: 34px;
            background: var(--tm-bg);
            border: 1px solid var(--tm-border);
            color: var(--tm-burgundy);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 8px;
            font-size: 13px;
        }

        .page-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-width: 0;
            padding: 25px;
            box-sizing: border-box;
            min-height: 100vh;
            background-color: #f5f7fb;
            overflow-x: auto;
        }

        /* Tablet */
        @media (max-width: 991px) {
            .page-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }

        /* Mobile */
        @media (max-width: 576px) {
            .page-content {
                padding: 12px;
            }
        }
    </style>
    <div class="page-content">
        <div class="container-fluid py-4">

            <!-- Top Bar with Thirumana Branding -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="tm-header-title mb-1">Admin Management</h4>
                    <span style="font-size: 13px; color: #7a7175;">Manage authenticated administrative accounts and
                        roles</span>
                </div>
                <?php if(Route::has('admins.create')): ?>
                    <a href="<?php echo e(route('admins.create')); ?>" class="btn-tm-primary">
                        <span>+</span> Add New Admin
                    </a>
                <?php endif; ?>
            </div>

            <!-- Alerts -->
            <?php if(session('success')): ?>
                <div class="alert alert-success d-flex align-items-center mb-4"
                    style="border-radius: 12px; border-left: 5px solid #166534;">
                    <i class="ti ti-check-circle me-2" style="font-size: 18px;"></i>
                    <div><?php echo e(session('success')); ?></div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger d-flex align-items-center mb-4"
                    style="border-radius: 12px; border-left: 5px solid #991b1b;">
                    <i class="ti ti-alert-triangle me-2" style="font-size: 18px;"></i>
                    <div><?php echo e(session('error')); ?></div>
                </div>
            <?php endif; ?>

            <!-- Card & Table -->
            <div class="tm-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table tm-table mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">S.No</th>
                                    <th>Admin Name</th>
                                    <th>Email Address</th>
                                    <th>Role</th>
                                    <th width="200" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center text-muted fw-bold"><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="tm-user-avatar">
                                                    <?php echo e(strtoupper(substr($admin->name ?? 'A', 0, 1))); ?>

                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark"><?php echo e($admin->name); ?></span>
                                                    <?php if($admin->id == auth()->id()): ?>
                                                        <small class="text-muted d-block" style="font-size: 11px;">(You)</small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($admin->email); ?></td>
                                        <td>
                                            <span class="tm-badge-gold">
                                                <?php echo e($admin->role ?? 'Admin'); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <!-- Edit Action -->
                                                <a href="<?php echo e(route('admins.edit', $admin->id)); ?>" class="btn-tm-edit"
                                                    title="Edit Admin">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>

                                                <!-- Delete Action (Only for other accounts, not self) -->

                                                <form action="<?php echo e(route('admins.destroy', $admin->id)); ?>" method="POST"
                                                    class="d-inline-block m-0"
                                                    onsubmit="return confirm('Are you sure you want to delete admin: <?php echo e($admin->name); ?>?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>

                                                    <button type="submit" class="btn-tm-delete">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div style="color: #a19a9d;">
                                                <div style="font-size: 32px; margin-bottom: 8px;">❤</div>
                                                <h6 class="fw-bold text-dark mb-1">No Admin Records Found</h6>
                                                <p class="small mb-0">Currently there are no other administrators registered in
                                                    the
                                                    system.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\genZ-matrimonial\backend\resources\views\admin\admins.blade.php ENDPATH**/ ?>