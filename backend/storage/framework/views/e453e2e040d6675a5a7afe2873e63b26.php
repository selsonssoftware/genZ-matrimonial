<?php $__env->startSection('content'); ?>

<style>
    .cms-page {
        background: #FAF5F5;
        min-height: 100vh;
        color: #542432;
    }

    .cms-module {
        border: 1px solid #F3E5E8 !important;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .cms-module:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(86, 19, 37, .08) !important;
    }

    .cms-manage-btn {
        background: #FCECEE;
        color: #561325;
        border: 0;
        white-space: nowrap;
        text-decoration: none;
    }

    .cms-manage-btn:hover {
        background: #561325;
        color: #fff;
    }

    .cms-input {
        background: #F8F4F5;
        border: 1px solid transparent;
    }

    .cms-input:focus {
        background: #fff;
        border-color: #d9aab5;
        box-shadow: 0 0 0 .15rem rgba(86, 19, 37, .08);
    }

    .cms-save-btn {
        background: #561325;
        color: #fff;
    }

    .cms-save-btn:hover {
        background: #70263d;
        color: #fff;
    }

    .cms-preview {
        background: #4A1222;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    @media (max-width: 576px) {
        .cms-page {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .cms-header-actions {
            width: 100%;
            flex-wrap: wrap;
        }

        .cms-preview {
            padding: 20px !important;
        }

        .cms-preview h2 {
            font-size: 21px !important;
            overflow-wrap: anywhere;
        }
    }
</style>

<div class="content-page">
    <div class="container-fluid cms-page py-4 px-4">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
            <div>
                <h3 class="fw-bold mb-1" style="color:#561325;">
                    CMS & Communication
                </h3>
                <p class="text-muted mb-0 fs-13">
                    Manage website content, announcements, enquiries and notifications.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3 cms-header-actions">
                <form action="<?php echo e(route('admin.cms-communication')); ?>"
                      method="GET" class="input-group shadow-sm"
                      style="width:170px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" name="search"
                           class="form-control form-control-sm border-start-0"
                           placeholder="Search modules"
                           value="<?php echo e(request('search')); ?>">
                </form>

                <button type="button"
                        class="btn border rounded-circle shadow-sm"
                        style="width:34px;height:34px;background:#fff;"
                        title="Notifications"
                        onclick="showCmsMessage('Notifications', 'Notification management needs to be connected to your notification data.')">
                    <i class="ti ti-bell text-muted"></i>
                </button>

                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                         style="background:#561325;width:34px;height:34px;font-size:12px;">
                        AJ
                    </div>
                    <div class="d-none d-sm-block lh-1">
                        <span class="fw-bold d-block text-dark fs-13">Admin</span>
                        <small class="text-muted fs-11">Super Admin</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start">

            
            <div class="col-lg-5 col-md-12 d-flex flex-column gap-3">

                
                <div class="card border-0 shadow-sm rounded-4 bg-white cms-module">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                  style="width:32px;height:32px;background:#FCECEE;color:#561325;">
                                ✦
                            </span>
                            <div>
                                <h6 class="fw-bold mb-1 fs-13 text-dark">Homepage banners</h6>
                                <p class="text-muted mb-0 fs-11">
                                    Create and schedule promotional banners
                                </p>
                            </div>
                        </div>

                        <a href="#banner-editor"
                           class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 cms-manage-btn">
                            Manage →
                        </a>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm rounded-4 bg-white cms-module">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                  style="width:32px;height:32px;background:#FCECEE;color:#561325;">
                                ✦
                            </span>
                            <div>
                                <h6 class="fw-bold mb-1 fs-13 text-dark">FAQs & help</h6>
                                <p class="text-muted mb-0 fs-11">
                                    Answers to common member questions
                                </p>
                            </div>
                        </div>

                        <button type="button"
                                class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 cms-manage-btn"
                                onclick="showCmsMessage('FAQs & Help', 'FAQ management is not connected to a database yet. A FAQ table and CRUD controller are needed to add, edit and delete FAQs.')">
                            Manage →
                        </button>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm rounded-4 bg-white cms-module">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                  style="width:32px;height:32px;background:#FCECEE;color:#561325;">
                                ✦
                            </span>
                            <div>
                                <h6 class="fw-bold mb-1 fs-13 text-dark">Email / SMS templates</h6>
                                <p class="text-muted mb-0 fs-11">
                                    Registration and payment messages
                                </p>
                            </div>
                        </div>

                        <button type="button"
                                class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 cms-manage-btn"
                                onclick="showCmsMessage('Email / SMS Templates', 'Template management needs a templates table, controller and delivery configuration before messages can be managed or sent.')">
                            Manage →
                        </button>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm rounded-4 bg-white cms-module">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between gap-2">
                        <div class="d-flex align-items-center justify-content-between gap-2 w-100">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                      style="width:32px;height:32px;background:#FCECEE;color:#561325;">
                                    ✦
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-13 text-dark">
                                        Enquiries & complaints
                                    </h6>
                                    <p class="text-muted mb-0 fs-11">
                                        Track member support requests
                                    </p>
                                </div>
                            </div>

                            <button type="button"
                                    class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 cms-manage-btn"
                                    onclick="showCmsMessage('Enquiries & Complaints', 'Enquiry management needs an enquiries table and controller to list, update and resolve support requests.')">
                                Manage →
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="col-lg-7 col-md-12" id="banner-editor">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white"
                     style="border:1px solid #F3E5E8!important;">

                    <div class="mb-3">
                        <h5 class="fw-bold mb-1" style="color:#561325;">
                            Homepage Banner
                        </h5>
                        <p class="text-muted mb-0 fs-12">
                            Preview and edit the public website hero banner.
                        </p>
                    </div>

                    
                    <div class="rounded-4 p-3 mb-4" style="background:#F8F1F3;">
                        <div class="cms-preview rounded-3 p-4 text-center text-white shadow-sm">

                            <span class="text-uppercase fw-semibold mb-1"
                                  style="font-size:11px;letter-spacing:1.5px;opacity:.85;">
                                FIND YOUR
                            </span>

                            <h2 class="fw-bold mb-2" id="previewTitle"
                                style="font-size:24px;letter-spacing:1px;">
                                <?php echo e(strtoupper($banner->title ?? 'Find your life partner')); ?>

                            </h2>

                            <p class="fs-12 mb-3 text-white-50" id="previewSubtitle">
                                <?php echo e($banner->subtitle ?? 'A thoughtful match begins with a trusted profile.'); ?>

                            </p>

                            
                            <a href="<?php echo e(route('admin.profile-verification.index')); ?>"
                               class="btn btn-sm px-3 py-2 text-white fw-bold rounded-2 border-0 fs-11"
                               style="background:#B58444;text-decoration:none;">
                                Explore profiles
                            </a>
                        </div>
                    </div>

                    
                    <form id="bannerForm"
                          method="POST"
                          action="<?php echo e(route('cms.banner.update')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="bannerTitleInput"
                                   class="form-label fs-12 fw-bold text-dark mb-1">
                                Banner title
                            </label>

                            <input type="text"
                                   name="title"
                                   id="bannerTitleInput"
                                   class="form-control fs-13 py-2 rounded-3 cms-input"
                                   value="<?php echo e(old('title', $banner->title ?? 'Find your life partner')); ?>"
                                   maxlength="255"
                                   required>

                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="bannerSubtitleInput"
                                   class="form-label fs-12 fw-bold text-dark mb-1">
                                Subtitle
                            </label>

                            <input type="text"
                                   name="subtitle"
                                   id="bannerSubtitleInput"
                                   class="form-control fs-13 py-2 rounded-3 cms-input"
                                   value="<?php echo e(old('subtitle', $banner->subtitle ?? 'A thoughtful match begins with a trusted profile.')); ?>"
                                   maxlength="2000">

                            <?php $__errorArgs = ['subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4" style="max-width:220px;">
                            <label for="bannerStatus"
                                   class="form-label fs-12 fw-bold text-dark mb-1">
                                Status
                            </label>

                            <select name="status"
                                    id="bannerStatus"
                                    class="form-select fs-13 py-2 rounded-3"
                                    required>
                                <option value="Published"
                                    <?php echo e(old('status', $banner->status ?? 'Published') === 'Published' ? 'selected' : ''); ?>>
                                    Published
                                </option>

                                <option value="Draft"
                                    <?php echo e(old('status', $banner->status ?? '') === 'Draft' ? 'selected' : ''); ?>>
                                    Draft
                                </option>

                                <option value="Archived"
                                    <?php echo e(old('status', $banner->status ?? '') === 'Archived' ? 'selected' : ''); ?>>
                                    Archived
                                </option>
                            </select>

                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button"
                                    class="btn btn-light border rounded-3 px-4 py-2"
                                    id="resetBannerBtn">
                                Reset
                            </button>

                            <button type="submit"
                                    class="btn fw-semibold px-4 py-2 rounded-3 shadow-sm text-white cms-save-btn"
                                    id="saveBannerBtn">
                                Save changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="cmsMessageModal" tabindex="-1"
     aria-labelledby="cmsMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="cmsMessageTitle"
                    style="color:#561325;"></h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted" id="cmsMessageBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn text-white"
                        style="background:#561325;"
                        data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('bannerTitleInput');
    const subtitleInput = document.getElementById('bannerSubtitleInput');
    const previewTitle = document.getElementById('previewTitle');
    const previewSubtitle = document.getElementById('previewSubtitle');
    const statusSelect = document.getElementById('bannerStatus');
    const resetButton = document.getElementById('resetBannerBtn');
    const saveButton = document.getElementById('saveBannerBtn');
    const bannerForm = document.getElementById('bannerForm');

    // Keep initial values for Reset.
    const initialTitle = titleInput.value;
    const initialSubtitle = subtitleInput.value;
    const initialStatus = statusSelect.value;

    function updateTitlePreview() {
        previewTitle.textContent =
            titleInput.value.trim().toUpperCase() || 'LIFE PARTNER';
    }

    function updateSubtitlePreview() {
        previewSubtitle.textContent =
            subtitleInput.value.trim() ||
            'A thoughtful match begins with a trusted profile.';
    }

    function updateStatusColor() {
        statusSelect.style.color =
            statusSelect.value === 'Published' ? '#28a745' : '#6c757d';
    }

    titleInput.addEventListener('input', updateTitlePreview);
    subtitleInput.addEventListener('input', updateSubtitlePreview);
    statusSelect.addEventListener('change', updateStatusColor);

    // Reset button.
    resetButton.addEventListener('click', function () {
        titleInput.value = initialTitle;
        subtitleInput.value = initialSubtitle;
        statusSelect.value = initialStatus;

        updateTitlePreview();
        updateSubtitlePreview();
        updateStatusColor();
    });

    // Prevent accidental double-click submission.
    bannerForm.addEventListener('submit', function () {
        saveButton.disabled = true;
        saveButton.textContent = 'Saving...';
    });

    updateTitlePreview();
    updateSubtitlePreview();
    updateStatusColor();
});

// Display a message for modules whose backend is not yet implemented.
function showCmsMessage(title, message) {
    document.getElementById('cmsMessageTitle').textContent = title;
    document.getElementById('cmsMessageBody').textContent = message;

    const modalElement = document.getElementById('cmsMessageModal');

    if (window.bootstrap && bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(modalElement).show();
    } else {
        // Fallback if Bootstrap modal JavaScript is not loaded.
        window.alert(title + '\n\n' + message);
    }
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\genZ-matrimonial\backend\resources\views\admin\cms-communication.blade.php ENDPATH**/ ?>