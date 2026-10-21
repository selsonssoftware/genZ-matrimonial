<!doctype html>
<html lang="en">

<!-- Mirrored from themes.coderthemes.com/paces/bootstrap/dashboard-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Oct 2026 10:21:36 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Genz Matrimony</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
    <meta name="keywords"
        content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
    <meta name="author" content="Coderthemes" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboardassets/images/top-logo.png') }}" />
    <!-- Theme Config Js -->
    <script src="{{ asset('dashboardassets/js/config.js') }}"></script>
    <script src="{{ asset('dashboardassets/js/demo.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('dashboardassets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboardassets/plugins/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboardassets/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('dashboardassets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
    #user-profile-settings {
        background-image: url("/dashboardassets/images/user-bg-pattern.svg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .stock-image {
        background-image: url("/dashboardassets/images/stock/small-8.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .theme-settings-header {
        background-image: url("/dashboardassets/images/settings-bg.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    /* DataTables Export Buttons (Excel & CSV) - Maroon Theme */
    .dt-buttons .btn-data-table-excel,
    .dt-buttons .btn-data-table-csv,
    .dt-buttons .buttons-excel,
    .dt-buttons .buttons-csv,
    .dt-buttons .dt-button.btn-data-table-excel,
    .dt-buttons .dt-button.btn-data-table-csv,
    button.btn-data-table-excel,
    button.btn-data-table-csv,
    .btn-data-table-excel,
    .btn-data-table-csv {
        background-color: #561325 !important;
        border-color: #561325 !important;
        color: #ffffff !important;
        font-weight: 500 !important;
        border-radius: 6px !important;
        box-shadow: 0 1px 3px rgba(86, 19, 37, 0.2) !important;
    }

    .dt-buttons .btn-data-table-excel:hover,
    .dt-buttons .btn-data-table-excel:focus,
    .dt-buttons .btn-data-table-excel:active,
    .dt-buttons .btn-data-table-csv:hover,
    .dt-buttons .btn-data-table-csv:focus,
    .dt-buttons .btn-data-table-csv:active,
    .dt-buttons .buttons-excel:hover,
    .dt-buttons .buttons-csv:hover,
    button.btn-data-table-excel:hover,
    button.btn-data-table-csv:hover,
    .btn-data-table-excel:hover,
    .btn-data-table-csv:hover {
        background-color: #42101d !important;
        border-color: #42101d !important;
        color: #ffffff !important;
    }

    .dt-buttons .btn-data-table-excel:focus-visible,
    .dt-buttons .btn-data-table-csv:focus-visible,
    .btn-data-table-excel:focus-visible,
    .btn-data-table-csv:focus-visible {
        box-shadow: 0 0 0 0.2rem rgba(86, 19, 37, 0.3) !important;
    }
</style>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        <header class="app-topbar">
            <div class="container-fluid topbar-menu">
                <div class="d-flex align-items-center gap-2">
                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ route('dashboard') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('dashboardassets/images/Frame.png') }}" alt="logo" />
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('dashboardassets/images/logo-sm.png') }}" alt="small logo" />
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{ route('dashboard') }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('dashboardassets/images/logo-black.png') }}" alt="dark logo" />
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('dashboardassets/images/logo-sm.png') }}" alt="small logo" />
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="sidenav-toggle-button btn btn-primary btn-icon">
                        <i class="ti ti-menu-4"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu">
                        <i class="ti ti-menu-4"></i>
                    </button>

                    <div id="search-box-rounded" class="app-search d-none d-xl-flex">
                        <input type="search" class="form-control rounded-pill topbar-search" name="search"
                            placeholder="Quick Search..." />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>

                    <div id="megamenu-columns" class="topbar-item d-none d-md-flex">
                        <div class="dropdown">
                            <button class="topbar-link btn fw-medium btn-link dropdown-toggle drop-arrow-none px-2"
                                data-bs-toggle="dropdown" type="button" aria-haspopup="false" aria-expanded="false">
                                Mega Menu
                                <i class="ti ti-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-xxl p-0">
                                <div class="h-100" style="max-height: 380px" data-simplebar="">
                                    <div class="row g-0">
                                        <!-- Dashboard & Analytics -->
                                        <div class="col-md-4">
                                            <div class="p-2">
                                                <h5 class="mb-1 fw-semibold fs-sm dropdown-header">Dashboard &amp;
                                                    Analytics</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Sales Dashboard
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Marketing Dashboard
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Finance Overview
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            User Analytics
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Traffic Insights
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Project Management -->
                                        <div class="col-md-4">
                                            <div class="p-2">
                                                <h5 class="mb-1 fw-semibold fs-sm dropdown-header">Project Management
                                                </h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-minus align-middle me-1 text-muted"></i>
                                                            Kanban Workflow
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-minus align-middle me-1 text-muted"></i>
                                                            Project Timeline
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-minus align-middle me-1 text-muted"></i>
                                                            Task Management
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-minus align-middle me-1 text-muted"></i>
                                                            Team Members
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-minus align-middle me-1 text-muted"></i>
                                                            Assignments
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- User Management -->
                                        <div class="col-md-4">
                                            <div class="p-2 bg-light bg-opacity-50">
                                                <h5 class="mb-1 fw-semibold fs-sm dropdown-header">User Management</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            User Profiles
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Access Control
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Security Settings
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            User Groups
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i
                                                                class="ti ti-chevron-right align-middle me-1 text-muted"></i>
                                                            Authentication
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .h-100-->
                            </div>
                            <!-- .dropdown-menu-->
                        </div>
                        <!-- .dropdown-->
                    </div>

                    <div id="megamenu-apps" class="topbar-item d-none d-md-flex">
                        <div class="dropdown">
                            <button class="topbar-link btn fw-medium btn-link dropdown-toggle drop-arrow-none px-2"
                                data-bs-toggle="dropdown" type="button" aria-haspopup="false" aria-expanded="false">
                                Apps
                                <i class="ti ti-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-xxl p-0">
                                <div class="h-100" style="max-height: 380px" data-simplebar="">
                                    <div class="row g-0">
                                        <div class="col-sm-8">
                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="p-2">
                                                        <a href="#!" class="dropdown-item">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-primary border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-basket fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">User Management
                                                                    </h5>
                                                                    <span class="text-muted fs-12">Products, orders
                                                                        &amp; etc.</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item my-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-success border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-message fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Chat</h5>
                                                                    <span class="text-muted fs-12">Team
                                                                        conversations</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item my-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-danger border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-list-check fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Task</h5>
                                                                    <span class="text-muted fs-12">Plan and track
                                                                        work</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item mt-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-info border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-mailbox fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Email</h5>
                                                                    <span class="text-muted fs-12">Messages and
                                                                        inbox</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="p-2">
                                                        <a href="#!" class="dropdown-item">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-secondary border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-building fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Companies</h5>
                                                                    <span class="text-muted fs-12">Business
                                                                        profiles</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item my-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-dark border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-id fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Contacts Diary</h5>
                                                                    <span class="text-muted fs-12">People and
                                                                        connections</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item my-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-warning border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-calendar fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Calendar</h5>
                                                                    <span class="text-muted fs-12">Events and
                                                                        reminders</span>
                                                                </span>
                                                            </span>
                                                        </a>

                                                        <a href="#!" class="dropdown-item mt-2">
                                                            <span class="d-flex align-items-center">
                                                                <span class="avatar-md me-2">
                                                                    <span
                                                                        class="avatar-title text-success border border-light bg-light bg-opacity-50 rounded">
                                                                        <i class="ti ti-lifebuoy fs-22"></i>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <h5 class="fs-base mb-0 lh-base">Support</h5>
                                                                    <span class="text-muted fs-12">Help and
                                                                        assistance</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row-->

                                            <div class="row g-0 border-top border-light border-dashed text-center">
                                                <div class="col">
                                                    <div class="p-3">
                                                        <p class="fw-medium text-muted mb-2 fs-11 text-uppercase lh-1">
                                                            -: &nbsp; Support &nbsp;:-</p>
                                                        <h5 class="fs-15 mb-0">help@mydomain.com</h5>
                                                    </div>
                                                </div>
                                                <!-- end col-->
                                                <div class="col">
                                                    <div class="p-3">
                                                        <p class="fw-medium text-muted mb-2 fs-11 text-uppercase lh-1">
                                                            -: &nbsp; Help: &nbsp;:-</p>
                                                        <h5 class="fs-15 mb-0">+(12) 3456 7890</h5>
                                                    </div>
                                                </div>
                                                <!-- end col-->
                                            </div>
                                            <!-- end row-->
                                        </div>
                                        <!-- end col-->

                                        <div class="col-sm-4">
                                            <div
                                                class="stock-image h-100 position-relative rounded-end rounded-0 overflow-hidden">
                                                <div
                                                    class="p-3 card-img-overlay bg-gradient bg-secondary bg-opacity-90 d-flex align-items-center justify-content-center">
                                                    <div class="text-center text-white">
                                                        <i class="ti ti-atom fs-36"></i>

                                                        <p class="text-white text-opacity-75 mb-3 text-uppercase">
                                                            Limited Offer</p>

                                                        <h3 class="fw-semibold text-white mb-2 fs-20">Unlock Exclusive
                                                            Savings</h3>

                                                        <h4 class="fw-medium fs-16 mb-1">
                                                            <del class="text-white text-opacity-75">$49.00</del>
                                                            /
                                                            <span class="fw-bold text-white">$25 USD</span>
                                                        </h4>

                                                        <button type="button" class="btn btn-danger btn-sm mt-3">
                                                            <i class="ti ti-shopping-cart me-1"></i>
                                                            Grab Deal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end .bg-light-->
                                        </div>
                                        <!-- end col-->
                                    </div>
                                    <!-- end row-->
                                </div>
                                <!-- end .h-100-->
                            </div>
                            <!-- .dropdown-menu-->
                        </div>
                        <!-- .dropdown-->
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div id="theme-dropdown" class="topbar-item d-none d-sm-flex">
                        <div class="dropdown">
                            <button class="topbar-link" data-bs-toggle="dropdown" type="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="ti ti-sun topbar-link-icon d-none" id="theme-icon-light"></i>
                                <i class="ti ti-moon topbar-link-icon d-none" id="theme-icon-dark"></i>
                                <i class="ti ti-sun-moon topbar-link-icon d-none" id="theme-icon-system"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" data-thememode="dropdown">
                                <label class="dropdown-item cursor-pointer">
                                    <input class="form-check-input" type="radio" name="data-bs-theme" value="light"
                                        style="display: none" />
                                    <i class="ti ti-sun align-middle me-1 fs-16"></i>
                                    <span class="align-middle">Light</span>
                                </label>
                                <label class="dropdown-item cursor-pointer">
                                    <input class="form-check-input" type="radio" name="data-bs-theme" value="dark"
                                        style="display: none" />
                                    <i class="ti ti-moon align-middle me-1 fs-16"></i>
                                    <span class="align-middle">Dark</span>
                                </label>
                                <label class="dropdown-item cursor-pointer">
                                    <input class="form-check-input" type="radio" name="data-bs-theme" value="system"
                                        style="display: none" />
                                    <i class="ti ti-sun-moon align-middle me-1 fs-16"></i>
                                    <span class="align-middle">System</span>
                                </label>
                            </div>
                            <!-- end dropdown-menu-->
                        </div>
                        <!-- end dropdown-->
                    </div>

                    <div id="apps-dropdown-grid" class="topbar-item d-none d-xl-flex">
                        <div class="dropdown">
                            <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                                type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                                <i class="ti ti-apps topbar-link-icon"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-lg p-2 dropdown-menu-end">
                                <div class="row align-items-center g-1">
                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span class="avatar-title text-bg-light rounded-circle">
                                                    <img src="{{ asset('dashboardassets/images/logos/google.svg') }}"
                                                        alt="Google Logo" height="18" />
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Google</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span class="avatar-title text-bg-light rounded-circle">
                                                    <img src="{{ asset('dashboardassets/images/logos/figma.svg') }}"
                                                        alt="Figma Logo" height="18" />
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Figma</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span class="avatar-title text-bg-light rounded-circle">
                                                    <img src="{{ asset('dashboardassets/images/logos/slack.svg') }}"
                                                        alt="Slack Logo" height="18" />
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Slack</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span class="avatar-title text-bg-light rounded-circle">
                                                    <img src="{{ asset('dashboardassets/images/logos/dropbox.svg') }}"
                                                        alt="Dropbox Logo" height="18" />
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Dropbox</span>
                                        </a>
                                    </div>

                                    <div class="col-4 text-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-sm rounded-circle btn-icon btn-danger">
                                            <i class="ti ti-circle-dashed-plus fs-18"></i>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span
                                                    class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ti ti-calendar fs-18"></i>
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Calendar</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span
                                                    class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ti ti-message-circle fs-18"></i>
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Chat</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span
                                                    class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ti ti-folder fs-18"></i>
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Files</span>
                                        </a>
                                    </div>

                                    <div class="col-4">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item border border-dashed rounded text-center py-2">
                                            <span class="avatar-sm d-block mx-auto mb-1">
                                                <span
                                                    class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ti ti-users fs-18"></i>
                                                </span>
                                            </span>
                                            <span class="align-middle fw-medium">Team</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End dropdown-menu -->
                        </div>
                        <!-- end dropdown-->
                    </div>

                    <div id="notification-dropdown-people" class="topbar-item">
                        <div class="dropdown">
                            <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                                type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                                <i class="ti ti-bell topbar-link-icon animate-ring"></i>
                                @if ($adminNotificationCount > 0)
                                    <span class="badge text-bg-danger badge-circle topbar-badge">
                                        {{ $adminNotificationCount > 99 ? '99+' : $adminNotificationCount }}
                                    </span>
                                @endif
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                <div class="px-3 py-2 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-md fw-semibold">Notifications</h6>
                                        </div>
                                        <div class="col text-end">
                                            <a href="{{ route('admin.profile-verification.index', ['status' => 'pending']) }}"
                                                class="badge badge-soft-success badge-label py-1">
                                                {{ $adminNotificationCount }} pending
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div style="max-height: 300px" data-simplebar="">
                                    @forelse ($adminNotifications as $notification)
                                        <a href="{{ route('admin.profile-verification.index', ['status' => 'pending', 'id' => $notification->id]) }}"
                                            class="dropdown-item notification-item py-2 text-wrap">
                                            <span class="d-flex align-items-center gap-3">
                                                <span class="flex-shrink-0 position-relative">
                                                    <span
                                                        class="avatar-md rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-user-plus fs-4"></i>
                                                    </span>
                                                    <span
                                                        class="position-absolute rounded-pill bg-warning notification-badge">
                                                        <i class="ti ti-clock align-middle"></i>
                                                        <span class="visually-hidden">pending profile</span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1 text-muted">
                                                    <span class="fw-medium text-body">
                                                        {{ $notification->member_name ?: ($notification->profile_id ?: 'Profile #'.$notification->id) }}
                                                    </span>
                                                    has a profile waiting for verification.
                                                    <br />
                                                    <span class="fs-xs">
                                                        {{ $notification->created_at ? \Carbon\Carbon::parse($notification->created_at)->diffForHumans() : 'Recently' }}
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    @empty
                                        <div class="dropdown-item text-muted py-3 text-center">
                                            No profiles are waiting for verification.
                                        </div>
                                    @endforelse
                                </div>

                                <a href="{{ route('admin.profile-verification.index', ['status' => 'pending']) }}"
                                    class="dropdown-item text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">Read
                                    All Pending Profiles</a>
                            </div>
                            <!-- End dropdown-menu -->
                        </div>
                        <!-- end dropdown-->
                    </div>

                    <div id="fullscreen-toggler" class="topbar-item d-none d-md-flex">
                        <button class="topbar-link" type="button" data-toggle="fullscreen">
                            <i class="ti ti-maximize topbar-link-icon"></i>
                            <i class="ti ti-minimize topbar-link-icon d-none"></i>
                        </button>
                    </div>

                    <div id="monochrome-toggler" class="topbar-item d-none d-xl-flex">
                        <button id="monochrome-mode" class="topbar-link" type="button" data-toggle="monochrome">
                            <i class="ti ti-palette topbar-link-icon"></i>
                        </button>
                    </div>

                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link btn-theme-setting" data-bs-toggle="offcanvas"
                            data-bs-target="#theme-settings-offcanvas" type="button">
                            <i class="ti ti-settings topbar-link-icon"></i>
                        </button>
                    </div>

                    <div id="language-selector-rounded" class="topbar-item">
                        <div class="dropdown">
                            <button class="topbar-link fw-bold" data-bs-toggle="dropdown" type="button"
                                aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('dashboardassets/images/flags/us.svg') }}" alt="user-image"
                                    class="rounded-circle me-2" height="18" id="selected-language-image" />
                                <span id="selected-language-code">EN</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="en"
                                    title="English">
                                    <img src="{{ asset('dashboardassets/images/flags/us.svg') }}" alt="English"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">English</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="de"
                                    title="German">
                                    <img src="{{ asset('dashboardassets/images/flags/de.svg') }}" alt="German"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">Deutsch</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="it"
                                    title="Italian">
                                    <img src="{{ asset('dashboardassets/images/flags/it.svg') }}" alt="Italian"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">Italiano</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="es"
                                    title="Spanish">
                                    <img src="{{ asset('dashboardassets/images/flags/es.svg') }}" alt="Spanish"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">Español</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="ru"
                                    title="Russian">
                                    <img src="{{ asset('dashboardassets/images/flags/ru.svg') }}" alt="Russian"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">Русский</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="hi"
                                    title="Hindi">
                                    <img src="{{ asset('dashboardassets/images/flags/in.svg') }}" alt="Hindi"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">हिन्दी</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="ar"
                                    title="Arabic">
                                    <img src="{{ asset('dashboardassets/images/flags/sa.svg') }}" alt="Arabic"
                                        class="me-1 rounded-circle" height="18" data-translator-image="" />
                                    <span class="align-middle">عربي</span>
                                </a>
                            </div>
                            <!-- end dropdown-menu-->
                        </div>
                        <!-- end dropdown-->
                    </div>

                    <div id="user-dropdown-detailed" class="topbar-item nav-user">
                        <div class="dropdown">
                            <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                                href="#!" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('dashboardassets/images/users/user-1.jpg') }}" width="32"
                                    class="rounded-circle me-lg-2 d-flex" alt="user-image" />
                                <div class="d-lg-flex align-items-center gap-1 d-none">
                                    <span>
                                        <h5 class="my-0 lh-1 pro-username">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h5>
                                        <span class="fs-xs lh-1">{{ ucfirst(Auth::guard('admin')->user()->role ?? 'Admin') }}</span>
                                    </span>
                                    <i class="ti ti-chevron-down align-middle"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- Header -->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome back 👋!</h6>
                                </div>

                                <!-- My Profile -->
                                <a href="{{ route('admin.profile-verification.index') }}" class="dropdown-item">
                                    <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Settings -->
                                <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                                    <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Account Settings</span>
                                </a>

                                <!-- Change Password -->
                                <a href="{{ route('change.password') }}" class="dropdown-item">
                                    <i class="ti ti-key me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Change Password</span>
                                </a>

                                <!-- Divider -->
                                <div class="dropdown-divider"></div>

                                <!-- Logout -->
                                <form id="topbar-logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('topbar-logout-form').submit();"
                                    class="dropdown-item fw-semibold text-danger">
                                    <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->
        <div class="sidenav-menu">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <span class="logo logo-light">
                    <span class="logo-lg"><img src="{{ asset('dashboardassets/images/Frame.png') }}"
                            alt="logo" /></span>
                    <span class="logo-sm"><img src="{{ asset('dashboardassets/images/Frame.png') }}"
                            alt="small logo" /></span>
                </span>

                <span class="logo logo-dark">
                    <span class="logo-lg"><img src="{{ asset('dashboardassets/images/logo-black.png') }}"
                            alt="dark logo" /></span>
                    <span class="logo-sm"><img src="{{ asset('dashboardassets/images/Frame.png') }}"
                            alt="small logo" /></span>
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <button class="button-on-hover">
                <span class="btn-on-hover-icon"></span>
            </button>

            <!-- Full Sidebar Menu Close Button -->
            <button class="button-close-offcanvas">
                <i class="ti ti-menu-4 align-middle"></i>
            </button>

            <div class="scrollbar" data-simplebar="">
                <div id="user-profile-settings" class="sidenav-user">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#!" class="link-reset">
                                <img src="{{ asset('dashboardassets/images/users/user-1.jpg') }}" alt="user-image"
                                    class="rounded-circle mb-2 avatar-md" />
                                <span class="sidenav-user-name fw-bold">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                                <span class="fs-12 fw-semibold" data-lang="user-role">{{ ucfirst(Auth::guard('admin')->user()->role ?? 'Super Admin') }}</span>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon"
                                data-bs-toggle="dropdown" data-bs-offset="0,12" href="#!" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                            </a>

                            <div class="dropdown-menu">
                                <!-- Header -->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome back!</h6>
                                </div>

                                <!-- My Profile -->
                                <a href="{{ route('admin.profile-verification.index') }}" class="dropdown-item">
                                    <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Settings -->
                                <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                                    <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Account Settings</span>
                                </a>

                                <!-- Change Password -->
                                <a href="{{ route('change.password') }}" class="dropdown-item">
                                    <i class="ti ti-key me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Change Password</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- Logout -->
                                <form id="sidenav-logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('sidenav-logout-form').submit();"
                                    class="dropdown-item text-danger fw-semibold">
                                    <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--- Sidenav Menu -->
                <div id="sidenav-menu">
                    <ul class="side-nav">

                        <!-- <li class="side-nav-title mt-2">Main</li> -->

                        <li class="side-nav-item">
                            <a href="{{ route('dashboard') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-dashboard"></i>
                                </span>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('users.index') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="menu-text">User Management</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
    <a data-bs-toggle="collapse"
       href="#profileDropdown"
       aria-expanded="false"
       aria-controls="profileDropdown"
       class="side-nav-link">
        <span class="menu-icon">
            <i class="ti ti-users"></i>
        </span>
        <span class="menu-text">Profiles</span>
        <span class="menu-arrow"></span>
    </a>

    <div class="collapse" id="profileDropdown">
        <ul class="sub-menu">
            <li class="side-nav-item">
                <a href="{{ route('admin.profile-verification.index', ['type' => 'groom']) }}"
                   class="side-nav-link">
                    <span class="menu-text">Groom</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.profile-verification.index', ['type' => 'bride']) }}"
                   class="side-nav-link">
                    <span class="menu-text">Bride</span>
                </a>
            </li>
        </ul>
    </div>
</li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.vendors.index') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="menu-text">Vendor Management</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admins.index') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-user-shield"></i>
                                </span>
                                <span class="menu-text">Admin</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.matches-interests') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-list-check"></i>
                                </span>
                                <span class="menu-text">Matches &amp; Interests</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.membership') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-currency-rupee"></i></span>
                                <span class="menu-text">Membership &amp; Payments</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.matrimonymasterdata') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-heart-handshake"></i>
                                </span>
                                <span class="menu-text">Matrimony Master Data</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.cms-communication') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-message-circle"></i>
                                </span>
                                <span class="menu-text">CMS &amp; Communication</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.vendor-assignments.index') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="menu-text">Vendor Assignment Report</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.report') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="menu-text">Reports</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.settings.index') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-settings"></i>
                                </span>
                                <span class="menu-text" data-lang="settings">Settings</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf

                                <button type="submit" class="side-nav-link"
                                    style="width:100%; border:0; background:transparent; text-align:left; cursor:pointer;">

                                    <span class="menu-icon">
                                        <i class="ti ti-logout"></i>
                                    </span>

                                    <span class="menu-text">Logout</span>
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidenav Menu End -->

        @yield('content')

        <div class="offcanvas offcanvas-end overflow-hidden" tabindex="-1" id="theme-settings-offcanvas">

            <div class="theme-settings-header d-flex justify-content-between text-bg-primary gap-2 p-3">
                <div>
                    <h5 class="mb-1 fw-bold text-white text-uppercase">Admin Customizer</h5>
                    <p class="text-white text-opacity-75 fst-italic fw-medium mb-0">Easily configure layout, styles, and
                        preferences for your admin interface.</p>
                </div>

                <div class="flex-grow-0">
                    <button type="button"
                        class="d-block btn btn-sm bg-white bg-opacity-25 text-white rounded-circle btn-icon"
                        data-bs-dismiss="offcanvas">
                        <i class="ti ti-x fs-lg"></i>
                    </button>
                </div>
            </div>

            <div class="offcanvas-body theme-customizer-bar p-0 h-100" data-simplebar="">
                <div id="skin" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Select Theme</h5>
                    <div class="row g-3">
                        <div class="col-6" id="skin-default">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-default"
                                    value="default" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-default">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-default.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Default</h5>
                        </div>

                        <div class="col-6" id="skin-minimal">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-minimal"
                                    value="minimal" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-minimal">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-minimal.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Minimal</h5>
                        </div>

                        <div class="col-6" id="skin-modern">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-modern"
                                    value="modern" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-modern">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-modern.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Modern</h5>
                        </div>

                        <div class="col-6" id="skin-material">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-material"
                                    value="material" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-material">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-material.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Material</h5>
                        </div>

                        <div class="col-6" id="skin-saas">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-saas"
                                    value="saas" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-saas">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-saas.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">SaaS</h5>
                        </div>

                        <div class="col-6" id="skin-flat">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-flat"
                                    value="flat" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-flat">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-flat.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Flat</h5>
                        </div>

                        <div class="col-6" id="skin-galaxy">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-galaxy"
                                    value="galaxy" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-galaxy">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-galaxy.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Galaxy</h5>
                        </div>

                        <div class="col-6" id="skin-luxe">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-luxe"
                                    value="luxe" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-luxe">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-luxe.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Luxe</h5>
                        </div>

                        <div class="col-6" id="skin-retro">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-retro"
                                    value="retro" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-retro">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-retro.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Retro</h5>
                        </div>

                        <div class="col-6" id="skin-neon">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-neon"
                                    value="neon" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-neon">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-neon.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Neon</h5>
                        </div>

                        <div class="col-6" id="skin-pixel">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-pixel"
                                    value="pixel" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-pixel">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-pixel.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Pixel</h5>
                        </div>

                        <div class="col-6" id="skin-soft">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-soft"
                                    value="soft" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-soft">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-soft.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Soft</h5>
                        </div>

                        <div class="col-6" id="skin-mono">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-mono"
                                    value="mono" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-mono">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-mono.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Mono</h5>
                        </div>

                        <div class="col-6" id="skin-prism">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-prism"
                                    value="prism" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-prism">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-prism.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Prism</h5>
                        </div>

                        <div class="col-6" id="skin-nova">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-nova"
                                    value="nova" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-nova">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-nova.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Nova</h5>
                        </div>

                        <div class="col-6" id="skin-zen">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-zen"
                                    value="zen" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-zen">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-zen.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Zen</h5>
                        </div>

                        <div class="col-6" id="skin-elegant">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-elegant"
                                    value="elegant" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-elegant">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-elegant.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Elegant</h5>
                        </div>

                        <div class="col-6" id="skin-vivid">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-vivid"
                                    value="vivid" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-vivid">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-vivid.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Vivid</h5>
                        </div>

                        <div class="col-6" id="skin-aurora">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-aurora"
                                    value="aurora" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-aurora">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-aurora.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Aurora</h5>
                        </div>

                        <div class="col-6" id="skin-crystal">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-crystal"
                                    value="crystal" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-crystal">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-crystal.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Crystal</h5>
                        </div>

                        <div class="col-6" id="skin-matrix">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-matrix"
                                    value="matrix" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-matrix">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-matrix.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Matrix</h5>
                        </div>

                        <div class="col-6" id="skin-orbit">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-orbit"
                                    value="orbit" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-orbit">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-orbit.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Orbit</h5>
                        </div>

                        <div class="col-6" id="skin-neo">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-neo"
                                    value="neo" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-neo">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-neo.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Neo</h5>
                        </div>

                        <div class="col-6" id="skin-silver">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-silver"
                                    value="silver" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-silver">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-silver.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Silver</h5>
                        </div>

                        <div class="col-6" id="skin-xenon">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-skin" id="demo-skin-xenon"
                                    value="xenon" />
                                <label class="form-check-label p-0 w-100" for="demo-skin-xenon">
                                    <img src="{{ asset('dashboardassets/images/layouts/skin-xenon.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Xenon</h5>
                        </div>
                    </div>
                </div>

                <div id="theme" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Color Scheme</h5>
                    <div class="row">
                        <div class="col-4" id="theme-light">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-bs-theme"
                                    id="layout-color-light" value="light" />
                                <label class="form-check-label p-0 w-100" for="layout-color-light">
                                    <img src="{{ asset('dashboardassets/images/layouts/theme-light.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Light</h5>
                        </div>

                        <div class="col-4" id="theme-dark">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark"
                                    value="dark" />
                                <label class="form-check-label p-0 w-100" for="layout-color-dark">
                                    <img src="{{ asset('dashboardassets/images/layouts/theme-dark.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Dark</h5>
                        </div>

                        <div class="col-4" id="theme-system">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-bs-theme"
                                    id="layout-color-system" value="system" />
                                <label class="form-check-label p-0 w-100" for="layout-color-system">
                                    <img src="{{ asset('dashboardassets/images/layouts/theme-system.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">System</h5>
                        </div>
                    </div>
                </div>

                <div id="topbar-color" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Topbar Color</h5>

                    <div class="row g-3">
                        <div class="col-4" id="topbar-color-light">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-light" value="light" />
                                <label class="form-check-label p-0 w-100" for="layout-topbar-color-light">
                                    <img src="{{ asset('dashboardassets/images/layouts/topbar-color-light.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="text-center text-muted mt-2 mb-0">Light</h5>
                        </div>

                        <div class="col-4" id="topbar-color-dark">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-dark" value="dark" />
                                <label class="form-check-label p-0 w-100" for="layout-topbar-color-dark">
                                    <img src="{{ asset('dashboardassets/images/layouts/topbar-color-dark.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Dark</h5>
                        </div>

                        <div class="col-4" id="topbar-color-gray">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-gray" value="gray" />
                                <label class="form-check-label p-0 w-100" for="layout-topbar-color-gray">
                                    <img src="{{ asset('dashboardassets/images/layouts/topbar-color-gray.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Gray</h5>
                        </div>

                        <div class="col-4" id="topbar-color-gradient">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-gradient" value="gradient" />
                                <label class="form-check-label p-0 w-100" for="layout-topbar-color-gradient">
                                    <img src="{{ asset('dashboardassets/images/layouts/topbar-color-gradient.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Gradient</h5>
                        </div>
                    </div>
                </div>

                <div id="sidenav-color" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Sidenav Color</h5>

                    <div class="row g-3">
                        <div class="col-4" id="sidenav-color-light">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-menu-color"
                                    id="layout-sidenav-color-light" value="light" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-color-light">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-color-light.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Light</h5>
                        </div>

                        <div class="col-4" id="sidenav-color-dark">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-menu-color"
                                    id="layout-sidenav-color-dark" value="dark" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-color-dark">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-color-dark.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Dark</h5>
                        </div>

                        <div class="col-4" id="sidenav-color-gray">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-menu-color"
                                    id="layout-sidenav-color-gray" value="gray" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-color-gray">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-color-gray.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Gray</h5>
                        </div>

                        <div class="col-4" id="sidenav-color-gradient">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-menu-color"
                                    id="layout-sidenav-color-gradient" value="gradient" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-color-gradient">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-color-gradient.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Gradient</h5>
                        </div>
                        <div class="col-4" id="sidenav-color-image">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-menu-color"
                                    id="layout-sidenav-color-image" value="image" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-color-image">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-color-image.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="fs-sm text-center text-muted mt-2 mb-0">Image</h5>
                        </div>
                    </div>
                </div>

                <div id="sidenav-size" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Sidebar Size</h5>

                    <div class="row g-3">
                        <div class="col-4" id="sidenav-size-default">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-default" value="default" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-default">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-default.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Default</h5>
                        </div>

                        <div class="col-4" id="sidenav-size-compact">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-compact" value="compact" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-compact">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-compact.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Compact</h5>
                        </div>

                        <div class="col-4" id="sidenav-size-condensed">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-condensed" value="condensed" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-condensed">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-condensed.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Condensed</h5>
                        </div>

                        <div class="col-4" id="sidenav-size-on-hover">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-small-hover" value="on-hover" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-small-hover">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-on-hover.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">On Hover</h5>
                        </div>

                        <div class="col-4" id="sidenav-size-on-hover-active">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-small-hover-active" value="on-hover-active" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-small-hover-active">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-on-hover-active.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 fs-base text-center text-muted mt-2">On Hover - Show</h5>
                        </div>

                        <div class="col-4" id="sidenav-size-offcanvas">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidenav-size"
                                    id="layout-sidenav-size-offcanvas" value="offcanvas" />
                                <label class="form-check-label p-0 w-100" for="layout-sidenav-size-offcanvas">
                                    <img src="{{ asset('dashboardassets/images/layouts/sidenav-size-offcanvas.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Offcanvas</h5>
                        </div>
                    </div>
                </div>

                <div id="width" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Layout Width</h5>

                    <div class="row g-3">
                        <div class="col-4" id="width-fluid">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width"
                                    id="layout-width-fluid" value="fluid" />
                                <label class="form-check-label p-0 w-100" for="layout-width-fluid">
                                    <img src="{{ asset('dashboardassets/images/layouts/width-fluid.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Fluid</h5>
                        </div>

                        <div class="col-4" id="width-boxed">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width"
                                    id="layout-width-boxed" value="boxed" />
                                <label class="form-check-label p-0 w-100" for="layout-width-boxed">
                                    <img src="{{ asset('dashboardassets/images/layouts/width-boxed.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">Boxed</h5>
                        </div>
                    </div>
                </div>

                <div id="dir" class="p-3 border-bottom border-dashed">
                    <h5 class="mb-3 fw-bold">Layout Direction</h5>

                    <div class="row g-3">
                        <div class="col-4" id="dir-ltr">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="dir" id="layout-dir-ltr"
                                    value="ltr" />
                                <label class="form-check-label p-0 w-100" for="layout-dir-ltr">
                                    <img src="{{ asset('dashboardassets/images/layouts/dir-ltr.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">LTR</h5>
                        </div>

                        <div class="col-4" id="dir-rtl">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="dir" id="layout-dir-rtl"
                                    value="rtl" />
                                <label class="form-check-label p-0 w-100" for="layout-dir-rtl">
                                    <img src="{{ asset('dashboardassets/images/layouts/dir-rtl.png') }}"
                                        alt="layout-img" class="img-fluid" />
                                </label>
                            </div>
                            <h5 class="mb-0 text-center text-muted mt-2">RTL</h5>
                        </div>
                    </div>
                </div>

                <div id="position" class="p-3 border-bottom border-dashed">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Layout Position</h5>

                        <div class="d-flex gap-1">
                            <div id="position-fixed">
                                <input type="radio" class="btn-check" name="data-layout-position"
                                    id="layout-position-fixed" value="fixed" />
                                <label class="btn btn-sm btn-soft-warning w-sm"
                                    for="layout-position-fixed">Fixed</label>
                            </div>
                            <div id="position-scrollable">
                                <input type="radio" class="btn-check" name="data-layout-position"
                                    id="layout-position-scrollable" value="scrollable" />
                                <label class="btn btn-sm btn-soft-warning w-sm ms-0"
                                    for="layout-position-scrollable">Scrollable</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidenav-user" class="p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <label class="fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                        </h5>
                        <div class="form-check form-switch fs-lg">
                            <input type="checkbox" class="form-check-input" name="sidebar-user"
                                id="sidebaruser-check" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offcanvas-footer border-top p-3 text-center">
                <div class="row justify-content-end">
                    <div class="col-6">
                        <a href="#" class="btn btn-success fw-semibold py-2 w-100" target="_blank"><i
                                class="ti ti-basket me-2 fs-md"></i> Buy Now</a>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-danger fw-semibold py-2 w-100" id="reset-layout"><i
                                class="ti ti-refresh me-2 fs-md"></i> Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end offcanvas-->
        <!-- Vendor js -->
        <script src="{{ asset('dashboardassets/js/vendors.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashboardassets/js/app.js') }}"></script>


        <!-- Apex Chart js -->
        <script src="{{ asset('dashboardassets/plugins/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Custom table -->
        <script src="{{ asset('dashboardassets/js/pages/custom-table.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('dashboardassets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboardassets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.jQuery || !jQuery.fn.DataTable) {
                return;
            }

            jQuery('table.js-data-table').each(function () {
                const table = jQuery(this);
                const placeholderRows = table.find('tbody > tr').filter(function () {
                    return this.children.length === 1 && this.children[0].colSpan > 1;
                });
                const placeholderMessage = placeholderRows.first().text().trim().replace(/\s+/g, ' ');
                placeholderRows.remove();

                const options = {
                    responsive: true,
                    autoWidth: false,
                    order: [],
                    pageLength: Number(table.data('page-length')) || 10,
                    layout: {
                        topStart: ['buttons', 'pageLength'],
                        topEnd: 'search',
                        bottomStart: 'info',
                        bottomEnd: 'paging'
                    },
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            className: 'btn btn-sm btn-data-table-excel'
                        },
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            className: 'btn btn-sm btn-data-table-csv'
                        }
                    ],
                    language: {
                        emptyTable: table.data('empty-table') || placeholderMessage || 'No data available in table'
                    }
                };

                if (table.data('paging') === false) {
                    options.paging = false;
                    options.info = false;
                }

                const dataTable = table.DataTable(options);

                if (table.attr('id') === 'vendorDirectoryTable') {
                    table.on('click', '.js-toggle-vendor-assignment', function () {
                        const button = jQuery(this);
                        const template = document.getElementById(button.data('template'));

                        if (!template) {
                            console.error('Vendor assignment form template was not found.');
                            return;
                        }

                        const row = dataTable.row(button.closest('tr'));

                        if (row.child.isShown()) {
                            row.child.hide();
                            button.attr('aria-expanded', 'false');
                        } else {
                            row.child(template.innerHTML).show();
                            button.attr('aria-expanded', 'true');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Dashboard js -->
    <script src="{{ asset('dashboardassets/js/pages/dashboard-projects.js"></script>
</body>

</html>