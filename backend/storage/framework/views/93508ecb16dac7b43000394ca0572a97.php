<?php $__env->startSection('content'); ?>
    <style>
        .master-data-page {
            min-height: 100vh;
            background: #fdf9f6;
            color: #34232a;
        }

        .master-data-page .text-maroon {
            color: #581629;
        }

        .master-data-page .btn-maroon {
            background: #581629;
            border-color: #581629;
            color: #fff;
        }

        .master-data-page .btn-maroon:hover {
            background: #42101f;
            border-color: #42101f;
            color: #fff;
        }

        .master-data-page .filter-card,
        .master-data-page .members-card,
        .master-data-page .religion-card {
            border: 1px solid #eee3e5;
            border-radius: 12px;
            background: #fff;
        }

        .master-data-page .filter-card {
            position: sticky;
            top: 1rem;
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: #c9aeb5 transparent;
        }

        .master-data-page .filter-card::-webkit-scrollbar {
            width: 6px;
        }

        .master-data-page .filter-card::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: #c9aeb5;
        }

        .master-data-page .form-label {
            color: #49383d;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .master-data-page .form-control,
        .master-data-page .form-select {
            min-height: 36px;
            border-color: #e9dfe1;
            border-radius: 8px;
            font-size: 12px;
        }

        .master-data-page .form-check-input:checked {
            background-color: #581629;
            border-color: #581629;
        }

        .master-data-page .religion-pill {
            border: 1px solid #e7dadd;
            border-radius: 999px;
            color: #34232a;
            background: #fff;
            font-size: 12px;
            padding: 7px 14px;
            white-space: nowrap;
        }

        .master-data-page .religion-pill.active {
            background: #581629;
            border-color: #581629;
            color: #fff;
        }

        .master-data-page .active-filter {
            border-radius: 999px;
            background: #f8e8ec;
            color: #581629;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 9px;
            font-size: 11px;
        }

        .master-data-page .member-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            object-fit: cover;
            background: #f5e8eb;
            color: #581629;
        }

        .master-data-page .status-pill {
            border-radius: 999px;
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 8px;
            white-space: nowrap;
        }

        .master-data-page .status-approved {
            background: #e3f3e9;
            color: #277044;
        }

        .master-data-page .status-pending {
            background: #fff3dc;
            color: #8b6415;
        }

        .master-data-page .status-rejected {
            background: #fde8e8;
            color: #a52f35;
        }

        .master-data-page .status-update_requested {
            background: #e7f0fb;
            color: #325c8a;
        }

        @media (max-width: 767.98px) {
            .master-data-page .filter-card {
                position: static;
            }
        }
    </style>

    <div class="content-page master-data-page">
        <div class="container-fluid px-3 px-lg-4 py-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h3 class="fw-bold text-maroon mb-1">Matrimony Master Data</h3>
                    <p class="text-muted fs-13 mb-0">Browse and filter registered member profiles.</p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    <form method="GET" action="<?php echo e(route('admin.matrimonymasterdata')); ?>" class="d-flex gap-2">
                        <?php $__currentLoopData = request()->except(['search', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_array($value)): ?>
                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="<?php echo e($name); ?>[]" value="<?php echo e($item); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            value="<?php echo e($filters['search'] ?? ''); ?>"
                            placeholder="Search by ID, name or phone"
                            aria-label="Search members"
                        >
                        <button class="btn btn-outline-secondary btn-sm px-3" type="submit">Search</button>
                    </form>
                    <a class="btn btn-outline-secondary btn-sm px-3"
                       href="<?php echo e(route('admin.matrimonymasterdata.export', request()->query())); ?>">
                        <i class="ti ti-download me-1"></i>Export
                    </a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success py-2"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger py-2"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            <div class="religion-card p-2 mb-3">
                <div class="d-flex flex-wrap gap-2">
                    <a class="religion-pill <?php echo e(empty($filters['religion']) ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.matrimonymasterdata', request()->except(['religion', 'page']))); ?>">All</a>
                    <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="religion-pill <?php echo e(($filters['religion'] ?? '') === $religion ? 'active' : ''); ?>"
                           href="<?php echo e(route('admin.matrimonymasterdata', array_merge(request()->except('page'), ['religion' => $religion]))); ?>">
                            <?php echo e($religion); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <?php
                $activeFilters = [];
                foreach ([
                    'religion' => 'Religion',
                    'community' => 'Community',
                    'rasi' => 'Rasi',
                    'nakshatra' => 'Nakshatra',
                    'gothram' => 'Gothram',
                    'education' => 'Education',
                    'city' => 'City',
                    'status' => 'Status',
                    'vendor_id' => 'Vendor',
                ] as $filterKey => $filterLabel) {
                    if (!empty($filters[$filterKey])) {
                        $filterValue = $filters[$filterKey];
                        if ($filterKey === 'vendor_id') {
                            $filterValue = optional($vendors->firstWhere('id', $filterValue))->agent_name ?? $filterValue;
                        }
                        $activeFilters[] = $filterLabel . ': ' . str_replace('_', ' ', ucfirst($filterValue));
                    }
                }
                foreach (['age_from' => 'Age from', 'age_to' => 'Age to', 'height_from' => 'Height from', 'height_to' => 'Height to'] as $filterKey => $filterLabel) {
                    if (!empty($filters[$filterKey])) {
                        $activeFilters[] = $filterLabel . ': ' . $filters[$filterKey];
                    }
                }
                if (!empty($filters['marital_status'])) {
                    $activeFilters[] = 'Marital status: ' . implode(', ', $filters['marital_status']);
                }
                if (!empty($filters['photo_only'])) {
                    $activeFilters[] = 'Photo available';
                }
            ?>

            <?php if(count($activeFilters)): ?>
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="text-muted fs-12">Active filters:</span>
                    <?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activeFilter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="active-filter"><?php echo e($activeFilter); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a class="text-maroon fs-12 ms-1"
                       href="<?php echo e(route('admin.matrimonymasterdata', array_intersect_key(request()->query(), ['search' => true]))); ?>">Clear all</a>
                </div>
            <?php endif; ?>

            <div class="row g-3 align-items-start">
                <div class="col-xl-3 col-lg-4">
                    <form method="GET" action="<?php echo e(route('admin.matrimonymasterdata')); ?>" class="filter-card p-3">
                        <h6 class="fw-bold text-maroon mb-3">Filters</h6>
                        <?php if(!empty($filters['search'])): ?>
                            <input type="hidden" name="search" value="<?php echo e($filters['search']); ?>">
                        <?php endif; ?>
                        <?php if(!empty($filters['religion'])): ?>
                            <input type="hidden" name="religion" value="<?php echo e($filters['religion']); ?>">
                        <?php endif; ?>

                        <div class="rounded-3 p-2 mb-3" style="background:#fbf2f4;">
                            <div class="small fw-bold text-uppercase text-maroon mb-2">Details</div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-rasi">Rasi</label>
                                <select class="form-select" id="filter-rasi" name="rasi">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $horoscopeOptions['rasis']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rasi); ?>" <?php if(($filters['rasi'] ?? '') === $rasi): echo 'selected'; endif; ?>><?php echo e($rasi); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-nakshatra">Nakshatra</label>
                                <select class="form-select" id="filter-nakshatra" name="nakshatra">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $horoscopeOptions['nakshatras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nakshatra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($nakshatra); ?>" <?php if(($filters['nakshatra'] ?? '') === $nakshatra): echo 'selected'; endif; ?>><?php echo e($nakshatra); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-gothram">Gothram</label>
                                <select class="form-select" id="filter-gothram" name="gothram">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $horoscopeOptions['gothrams']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gothram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($gothram); ?>" <?php if(($filters['gothram'] ?? '') === $gothram): echo 'selected'; endif; ?>><?php echo e($gothram); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="filter-community">Community</label>
                                <select class="form-select" id="filter-community" name="community">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $communities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $community): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($community); ?>" <?php if(($filters['community'] ?? '') === $community): echo 'selected'; endif; ?>><?php echo e($community); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <div class="d-flex align-items-center gap-2">
                                <input class="form-control" type="number" min="18" max="100" name="age_from" value="<?php echo e($filters['age_from'] ?? ''); ?>" placeholder="From">
                                <span class="text-muted">to</span>
                                <input class="form-control" type="number" min="18" max="100" name="age_to" value="<?php echo e($filters['age_to'] ?? ''); ?>" placeholder="To">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Height (cm)</label>
                            <div class="d-flex align-items-center gap-2">
                                <input class="form-control" type="number" min="50" max="250" step="0.1" name="height_from" value="<?php echo e($filters['height_from'] ?? ''); ?>" placeholder="From">
                                <span class="text-muted">to</span>
                                <input class="form-control" type="number" min="50" max="250" step="0.1" name="height_to" value="<?php echo e($filters['height_to'] ?? ''); ?>" placeholder="To">
                            </div>
                        </div>

                        <?php if($maritalStatuses->isNotEmpty()): ?>
                            <div class="mb-3">
                                <label class="form-label d-block">Marital status</label>
                                <?php $__currentLoopData = $maritalStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maritalStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="form-check form-check-sm mb-1">
                                        <input class="form-check-input" type="checkbox" name="marital_status[]" value="<?php echo e($maritalStatus); ?>" <?php if(in_array($maritalStatus, $filters['marital_status'] ?? [], true)): echo 'checked'; endif; ?>>
                                        <span class="form-check-label fs-12"><?php echo e($maritalStatus); ?></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label" for="filter-education">Education</label>
                            <select class="form-select" id="filter-education" name="education">
                                <option value="">Any</option>
                                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($education); ?>" <?php if(($filters['education'] ?? '') === $education): echo 'selected'; endif; ?>><?php echo e($education); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-city">City</label>
                            <select class="form-select" id="filter-city" name="city">
                                <option value="">Any</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city); ?>" <?php if(($filters['city'] ?? '') === $city): echo 'selected'; endif; ?>><?php echo e($city); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-vendor">Vendor (agent)</label>
                            <select class="form-select" id="filter-vendor" name="vendor_id">
                                <option value="">All</option>
                                <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($vendor->id); ?>" <?php if((string) ($filters['vendor_id'] ?? '') === (string) $vendor->id): echo 'selected'; endif; ?>><?php echo e($vendor->agent_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-status">Profile status</label>
                            <select class="form-select" id="filter-status" name="status">
                                <option value="">All</option>
                                <option value="pending" <?php if(($filters['status'] ?? '') === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                                <option value="approved" <?php if(($filters['status'] ?? '') === 'approved'): echo 'selected'; endif; ?>>Verified</option>
                                <option value="rejected" <?php if(($filters['status'] ?? '') === 'rejected'): echo 'selected'; endif; ?>>Suspended</option>
                                <option value="update_requested" <?php if(($filters['status'] ?? '') === 'update_requested'): echo 'selected'; endif; ?>>Review requested</option>
                            </select>
                        </div>

                        <label class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="photo_only" value="1" <?php if(!empty($filters['photo_only'])): echo 'checked'; endif; ?>>
                            <span class="form-check-label fs-12">Photo available only</span>
                        </label>

                        <div class="d-flex gap-2">
                            <a class="btn btn-outline-secondary btn-sm flex-fill"
                               href="<?php echo e(route('admin.matrimonymasterdata', array_intersect_key(request()->query(), ['search' => true, 'religion' => true]))); ?>">Clear</a>
                            <button class="btn btn-maroon btn-sm flex-fill" type="submit">Apply filters</button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="members-card overflow-hidden">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3 border-bottom">
                            <span class="text-muted fs-12">
                                Showing <?php echo e($profiles->firstItem() ?? 0); ?>–<?php echo e($profiles->lastItem() ?? 0); ?> of <?php echo e($profiles->total()); ?> members
                            </span>
                            <form method="GET" action="<?php echo e(route('admin.matrimonymasterdata')); ?>" class="d-flex align-items-center gap-2">
                                <?php $__currentLoopData = request()->except(['sort', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(is_array($value)): ?>
                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="hidden" name="<?php echo e($name); ?>[]" value="<?php echo e($item); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <label class="text-muted fs-12 mb-0" for="sort-profiles">Sort by</label>
                                <select class="form-select form-select-sm" id="sort-profiles" name="sort" onchange="this.form.submit()" style="width:auto;">
                                    <option value="newest" <?php if(($filters['sort'] ?? 'newest') === 'newest'): echo 'selected'; endif; ?>>Newest</option>
                                    <option value="oldest" <?php if(($filters['sort'] ?? '') === 'oldest'): echo 'selected'; endif; ?>>Oldest</option>
                                    <option value="age_asc" <?php if(($filters['sort'] ?? '') === 'age_asc'): echo 'selected'; endif; ?>>Age: low to high</option>
                                    <option value="age_desc" <?php if(($filters['sort'] ?? '') === 'age_desc'): echo 'selected'; endif; ?>>Age: high to low</option>
                                </select>
                            </form>
                        </div>

                        <form method="POST" action="<?php echo e(route('admin.matrimonymasterdata.bulk-review', request()->query())); ?>" id="bulk-review-form">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="visually-hidden" for="bulk-decision">Bulk action</label>
                                    <select class="form-select form-select-sm" id="bulk-decision" name="decision" style="width:auto;">
                                        <option value="">Bulk actions</option>
                                        <option value="approved">Mark verified</option>
                                        <option value="pending">Mark pending</option>
                                        <option value="rejected">Suspend</option>
                                        <option value="update_requested">Request review</option>
                                    </select>
                                    <button class="btn btn-maroon btn-sm" type="submit"
                                            onclick="return confirm('Apply this action to the selected profiles?');">Apply</button>
                                </div>
                                <label class="d-flex align-items-center gap-2 text-muted fs-12 mb-0">
                                    <input class="form-check-input m-0" type="checkbox" id="select-all-profiles">
                                    Select all on this page
                                </label>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-hover mb-0">
                                    <thead style="background:#fcf8f8;">
                                        <tr class="text-uppercase text-muted" style="font-size:10px; letter-spacing:.04em;">
                                            <th class="ps-3" style="width:36px;"></th>
                                            <th>Member</th>
                                            <th>Age / Height</th>
                                            <th>Religion / Community</th>
                                            <th>Rasi</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Vendor</th>
                                            <th class="text-end pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $statusLabel = [
                                                    'approved' => 'Verified',
                                                    'pending' => 'Pending',
                                                    'rejected' => 'Suspended',
                                                    'update_requested' => 'Review',
                                                ][$profile->verification_status] ?? ucfirst($profile->verification_status);
                                            ?>
                                            <tr>
                                                <td class="ps-3">
                                                    <input class="form-check-input profile-select" type="checkbox" name="ids[]" value="<?php echo e($profile->id); ?>" aria-label="Select <?php echo e($profile->member_name ?: $profile->profile_id); ?>">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <?php if($profile->profile_image): ?>
                                                            <img class="member-avatar" src="<?php echo e(asset('storage/' . ltrim($profile->profile_image, '/'))); ?>" alt="">
                                                        <?php else: ?>
                                                            <span class="member-avatar d-inline-flex align-items-center justify-content-center fw-bold"><?php echo e(strtoupper(substr($profile->member_name ?: 'M', 0, 1))); ?></span>
                                                        <?php endif; ?>
                                                        <div class="lh-sm">
                                                            <div class="fw-semibold text-dark"><?php echo e($profile->member_name ?: 'Member'); ?></div>
                                                            <small class="text-muted"><?php echo e($profile->member_id ?: $profile->profile_id ?: ('#' . $profile->id)); ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div><?php echo e($profile->age ? $profile->age . ' yrs' : '—'); ?></div>
                                                    <small class="text-muted"><?php echo e($profile->height ? $profile->height . ' cm' : '—'); ?></small>
                                                </td>
                                                <td>
                                                    <div><?php echo e($profile->religion ?: '—'); ?></div>
                                                    <small class="text-muted"><?php echo e($profile->community ?: $profile->caste ?: '—'); ?></small>
                                                </td>
                                                <td><?php echo e($profile->rasi ?: '—'); ?></td>
                                                <td><?php echo e($profile->city ?: '—'); ?></td>
                                                <td><span class="status-pill status-<?php echo e($profile->verification_status); ?>"><?php echo e($statusLabel); ?></span></td>
                                                <td><?php echo e($profile->vendor_name ?: 'Direct'); ?></td>
                                                <td class="text-end pe-3">
                                                    <a class="text-maroon fw-semibold text-decoration-none"
                                                       href="<?php echo e(route('admin.profile-verification.index', ['status' => 'all', 'id' => $profile->id])); ?>">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-5">
                                                    <i class="ti ti-users fs-3 d-block mb-2"></i>
                                                    No members match the selected filters.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <?php if($profiles->hasPages()): ?>
                            <div class="d-flex justify-content-between align-items-center gap-2 p-3 border-top">
                                <span class="text-muted fs-12">Page <?php echo e($profiles->currentPage()); ?> of <?php echo e($profiles->lastPage()); ?></span>
                                <?php echo e($profiles->links()); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-all-profiles')?.addEventListener('change', function () {
            document.querySelectorAll('.profile-select').forEach(function (checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\genZ-matrimonial\backend\resources\views\admin\matrimonymasterdata.blade.php ENDPATH**/ ?>