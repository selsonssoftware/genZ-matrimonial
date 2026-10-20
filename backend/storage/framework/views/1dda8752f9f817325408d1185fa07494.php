<?php $__env->startSection('content'); ?>
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">CMS & Communication</h3>
                    <p class="text-muted mb-0 fs-13">Manage website content, announcements, enquiries and notifications.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="input-group shadow-sm" style="width: 170px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search" />
                    </div>

                    <button
                        class="btn btn-sm btn-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 34px; height: 34px; background-color: #fff;">
                        <i class="ti ti-bell fs-16 text-muted"></i>
                    </button>

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

            <div class="row g-4 align-items-start">

                <!-- Left Side: CMS Modules List Cards -->
                <div class="col-lg-5 col-md-12 d-flex flex-column gap-3">

                    <!-- Homepage Banners Card (Active) -->
                    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #F5D3D8 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 32px; height: 32px; background-color: #FCECEE; color: #561325; font-size: 16px;">✦</span>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-13 text-dark">Homepage banners</h6>
                                    <p class="text-muted mb-0 fs-11">Create and schedule promotional banners</p>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11"
                                style="background-color: #FCECEE; color: #561325; text-decoration: none;">
                                Manage →
                            </a>
                        </div>
                    </div>

                    <!-- FAQs & Help Card -->
                    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 32px; height: 32px; background-color: #FCECEE; color: #561325; font-size: 16px;">✦</span>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-13 text-dark">FAQs & help</h6>
                                    <p class="text-muted mb-0 fs-11">Answers to common member questions</p>
                                </div>
                            </div>
                            <a href="javascript:void(0)"
                                class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 text-muted"
                                style="background-color: #FAF0F2; text-decoration: none;">
                                Manage →
                            </a>
                        </div>
                    </div>

                    <!-- Email / SMS Templates Card -->
                    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 32px; height: 32px; background-color: #FCECEE; color: #561325; font-size: 16px;">✦</span>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-13 text-dark">Email / SMS templates</h6>
                                    <p class="text-muted mb-0 fs-11">Registration and payment messages</p>
                                </div>
                            </div>
                            <a href="javascript:void(0)"
                                class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 text-muted"
                                style="background-color: #FAF0F2; text-decoration: none;">
                                Manage →
                            </a>
                        </div>
                    </div>

                    <!-- Enquiries & Complaints Card -->
                    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 32px; height: 32px; background-color: #FCECEE; color: #561325; font-size: 16px;">✦</span>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-13 text-dark">Enquiries & complaints</h6>
                                    <p class="text-muted mb-0 fs-11">Track member support requests</p>
                                </div>
                            </div>
                            <a href="javascript:void(0)"
                                class="btn btn-sm px-3 py-1 rounded-pill fw-semibold fs-11 text-muted"
                                style="background-color: #FAF0F2; text-decoration: none;">
                                Manage →
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Right Side: Edit & Preview Form Panel -->
                <div class="col-lg-7 col-md-12">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">

                        <div class="mb-3">
                            <h5 class="fw-bold mb-1" style="color: #561325;">Homepage Banner</h5>
                            <p class="text-muted mb-0 fs-12">Preview and edit the public website hero banner.</p>
                        </div>

                        <!-- Live Banner Preview Component -->
                        <div class="rounded-4 p-3 mb-4" style="background-color: #F8F1F3;">
                            <div class="rounded-3 p-4 text-center text-white position-relative shadow-sm"
                                style="background-color: #4A1222; min-height: 180px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <span class="text-uppercase fw-semibold mb-1"
                                    style="font-size: 11px; letter-spacing: 1.5px; opacity: 0.85;">FIND YOUR</span>
                                <h2 class="fw-bold mb-2 tracking-wide" id="previewTitle"
                                    style="font-size: 24px; letter-spacing: 1px;">LIFE PARTNER</h2>
                                <p class="fs-12 mb-3 text-white-50" id="previewSubtitle">A thoughtful match begins with a
                                    trusted profile.</p>
                                <button type="button"
                                    class="btn btn-sm px-3 py-1 text-white fw-bold rounded-2 border-0 fs-11"
                                    style="background-color: #B58444;">
                                    Explore profiles
                                </button>
                            </div>
                        </div>

                        <!-- Form Inputs -->
                        <form id="bannerForm" method="POST" action="#">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label fs-12 fw-bold text-dark mb-1">Banner title</label>
                                <input type="text" class="form-control fs-13 py-2 rounded-3 border-0" id="bannerTitleInput"
                                    value="Find your life partner" style="background-color: #F8F4F5;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-12 fw-bold text-dark mb-1">Subtitle</label>
                                <input type="text" class="form-control fs-13 py-2 rounded-3 border-0"
                                    id="bannerSubtitleInput" value="A thoughtful match begins with a trusted profile."
                                    style="background-color: #F8F4F5;">
                            </div>

                            <div class="mb-4" style="max-width: 220px;">
                                <label class="form-label fs-12 fw-bold text-dark mb-1">Status</label>
                                <select class="form-select fs-13 py-2 rounded-3 border" id="bannerStatus"
                                    style="color: #28a745; font-weight: 600;">
                                    <option value="Published" selected>Published ▾</option>
                                    <option value="Draft">Draft ▾</option>
                                    <option value="Archived">Archived ▾</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn text-white fw-semibold px-4 py-2 rounded-3 shadow-sm fs-13"
                                    style="background-color: #561325;">
                                    Save changes
                                </button>
                            </div>
                        </form>

                    </div>
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

            // Title live preview update
            titleInput.addEventListener('input', function () {
                previewTitle.innerText = this.value.toUpperCase() || 'LIFE PARTNER';
            });

            // Subtitle live preview update
            subtitleInput.addEventListener('input', function () {
                previewSubtitle.innerText = this.value || 'A thoughtful match begins with a trusted profile.';
            });

            // Status select color toggle
            statusSelect.addEventListener('change', function () {
                if (this.value === 'Published') {
                    this.style.color = '#28a745';
                } else {
                    this.style.color = '#6c757d';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GenZ\backend\resources\views/admin/cms-communication.blade.php ENDPATH**/ ?>