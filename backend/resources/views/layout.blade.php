<!doctype html>
<html lang="en">

<!-- Mirrored from themes.coderthemes.com/paces/bootstrap/dashboard-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Oct 2026 10:21:36 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Projects Dashboard | Paces - Multipurpose Tailwind CSS & Bootstrap Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
    <meta name="keywords"
        content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
    <meta name="author" content="Coderthemes" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboardassets/images/favicon.ico') }}" />
    <!-- Theme Config Js -->
    <script src="{{ asset('dashboardassets/js/config.js') }}"></script>
    <script src="demo.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('dashboardassets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('dashboardassets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        <header class="app-topbar">
            <div class="container-fluid topbar-menu">
                <div class="d-flex align-items-center gap-2">
                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('dashboardassets/images/logo.png') }}" alt="logo" />
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('dashboardassets/images/logo-sm.png') }}" alt="small logo" />
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
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
                                            <div class="h-100 position-relative rounded-end rounded-0 overflow-hidden"
                                                style="background: url({{ asset('dashboardassets/images/stock/small-8.jpg') }}); background-size: cover">
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
                                <span class="badge text-bg-danger badge-circle topbar-badge">5</span>
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                <div class="px-3 py-2 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-md fw-semibold">Notifications</h6>
                                        </div>
                                        <div class="col text-end">
                                            <a href="#!" class="badge badge-soft-success badge-label py-1">07
                                                Notifications</a>
                                        </div>
                                    </div>
                                </div>

                                <div style="max-height: 300px" data-simplebar="">
                                    <!-- Notification 1 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-1">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="{{ asset('dashboardassets/images/users/user-4.jpg') }}"
                                                    class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span
                                                    class="position-absolute rounded-pill bg-success notification-badge">
                                                    <i class="ti ti-bell align-middle"></i>
                                                    <span class="visually-hidden">unread notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Emily Johnson</span>
                                                commented on a task in
                                                <span class="fw-medium text-body">Design Sprint</span>
                                                <br />
                                                <span class="fs-xs">12 minutes ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-1">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 2 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-2">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="{{ asset('dashboardassets/images/users/user-5.jpg') }}"
                                                    class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-info notification-badge">
                                                    <i class="ti ti-cloud-upload align-middle"></i>
                                                    <span class="visually-hidden">upload notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Michael Lee</span>
                                                uploaded files to
                                                <span class="fw-medium text-body">Marketing </span>
                                                <br />
                                                <span class="fs-xs">25 minutes ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-2">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 3 - Server CPU Alert -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-6">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <span
                                                    class="avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-database fs-4"></i>
                                                </span>
                                                <span
                                                    class="position-absolute rounded-pill bg-danger notification-badge">
                                                    <i class="ti ti-alert-circle align-middle"></i>
                                                    <span class="visually-hidden">server alert</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Server #3</span>
                                                CPU usage exceeded 90%
                                                <br />
                                                <span class="fs-xs">Just now</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-6">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 4 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-3">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="{{ asset('dashboardassets/images/users/user-6.jpg') }}"
                                                    class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span
                                                    class="position-absolute rounded-pill bg-warning notification-badge">
                                                    <i class="ti ti-alert-triangle align-middle"></i>
                                                    <span class="visually-hidden">alert</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Sophia Ray</span>
                                                flagged an issue in
                                                <span class="fw-medium text-body">Bug Tracker</span>
                                                <br />
                                                <span class="fs-xs">40 minutes ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-3">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 5 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-4">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="{{ asset('dashboardassets/images/users/user-7.jpg') }}"
                                                    class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span
                                                    class="position-absolute rounded-pill bg-primary notification-badge">
                                                    <i class="ti ti-calendar-event align-middle"></i>
                                                    <span class="visually-hidden">event notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">David Kim</span>
                                                scheduled a meeting for
                                                <span class="fw-medium text-body">UX Review</span>
                                                <br />
                                                <span class="fs-xs">1 hour ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-4">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 6 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-5">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="{{ asset('dashboardassets/images/users/user-8.jpg') }}"
                                                    class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span
                                                    class="position-absolute rounded-pill bg-secondary notification-badge">
                                                    <i class="ti ti-edit align-middle"></i>
                                                    <span class="visually-hidden">edit</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Isabella White</span>
                                                updated the document in
                                                <span class="fw-medium text-body">Product Specs</span>
                                                <br />
                                                <span class="fs-xs">2 hours ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-5">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 7 - Deployment Success -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-7">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <span
                                                    class="avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-rocket fs-4"></i>
                                                </span>
                                                <span
                                                    class="position-absolute rounded-pill bg-success notification-badge">
                                                    <i class="ti ti-check align-middle"></i>
                                                    <span class="visually-hidden">deployment</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Production Server</span>
                                                deployment completed successfully
                                                <br />
                                                <span class="fs-xs">30 minutes ago</span>
                                            </span>
                                            <button type="button"
                                                class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn"
                                                data-dismissible="#message-7">
                                                <i class="ti ti-square-rounded-x fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">Read
                                    All Messages</a>
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
                                        <h5 class="my-0 lh-1 pro-username">David Dev</h5>
                                        <span class="fs-xs lh-1">Admin Head</span>
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
                                <a href="#!" class="dropdown-item">
                                    <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Notifications -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ti ti-bell-ringing me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Notifications</span>
                                </a>

                                <!-- Settings -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Account Settings</span>
                                </a>

                                <!-- Support -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ti ti-headset me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Support Center</span>
                                </a>

                                <!-- Divider -->
                                <div class="dropdown-divider"></div>

                                <!-- Lock -->
                                <a href="auth-lock-screen.html" class="dropdown-item">
                                    <i class="ti ti-lock me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Lock Screen</span>
                                </a>

                                <!-- Logout -->
                                <a href="javascript:void(0);" class="dropdown-item fw-semibold">
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
            <a href="index.html" class="logo">
                <span class="logo logo-light">
                    <span class="logo-lg"><img src="{{ asset('dashboardassets/images/logo.png') }}" alt="logo" /></span>
                    <span class="logo-sm"><img src="{{ asset('dashboardassets/images/logo-sm.png') }}"
                            alt="small logo" /></span>
                </span>

                <span class="logo logo-dark">
                    <span class="logo-lg"><img src="{{ asset('dashboardassets/images/logo-black.png') }}"
                            alt="dark logo" /></span>
                    <span class="logo-sm"><img src="{{ asset('dashboardassets/images/logo-sm.png') }}"
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
                <div id="user-profile-settings" class="sidenav-user"
                    style="background: url({{ asset('dashboardassets/images/user-bg-pattern.svg') }})">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#!" class="link-reset">
                                <img src="{{ asset('dashboardassets/images/users/user-1.jpg') }}" alt="user-image"
                                    class="rounded-circle mb-2 avatar-md" />
                                <span class="sidenav-user-name fw-bold">David Dev</span>
                                <span class="fs-12 fw-semibold" data-lang="user-role">Art Director</span>
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
                                <a href="#!" class="dropdown-item">
                                    <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Settings -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Account Settings</span>
                                </a>

                                <!-- Lock -->
                                <a href="auth-lock-screen.html" class="dropdown-item">
                                    <i class="ti ti-lock me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Lock Screen</span>
                                </a>

                                <!-- Logout -->
                                <a href="javascript:void(0);" class="dropdown-item text-danger fw-semibold">
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

                        <li class="side-nav-title mt-2">Main</li>

                        <li class="side-nav-item">
                            <a href="{{ url('/') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-dashboard"></i>
                                </span>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>


                        <li class="side-nav-item">
                            <a href="{{ url('/management') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="menu-text">User Management</span>
                            </a>
                        </li>



                        <li class="side-nav-item">
                            <a href="{{ url('/profile') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-message"></i></span>
                                <span class="menu-text" data-lang="apps-chat">Profile Verification</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ url('/vendors') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="menu-text">Vendor Management</span>
                            </a>
                        </li>


                        <li class="side-nav-item">
                            <a href="{{ url('/matches-interests') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-list-check"></i>
                                </span>
                                <span class="menu-text">Matches &amp; Interests</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ url('/membership') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="menu-text">Membership & Payments</span>
                            </a>
                        </li>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#crm" aria-expanded="false" aria-controls="crm"
                                class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-heart-handshake"></i></span>
                                <span class="menu-text" data-lang="crm">Matrimony Master Data</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="crm">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="apps-crm-contacts.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-contacts">Contacts</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-opportunities.html" class="side-nav-link">
                                            <span class="menu-text"
                                                data-lang="apps-crm-opportunities">Opportunities</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-deals.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-deals">Deals</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-leads.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-leads">Leads</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-pipeline.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-pipeline">Pipeline</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-campaign.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-campaign">Campaign</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-proposals.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-proposals">Proposals</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-estimations.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-estimations">Estimations</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-customers.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-customers">Customers</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-crm-activities.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-crm-activities">Activities</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users"
                                class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-users"></i></span>
                                <span class="menu-text" data-lang="users">CMS & Communication</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="apps-users-contacts.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-users-contacts">Contacts</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-users-profile.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-users-profile">Profile</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-users-account-settings.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-users-account-settings">Account
                                                Settings</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-users-roles.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-users-roles">Roles</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-users-role-details.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-users-role-details">Role
                                                Details</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-users-permissions.html" class="side-nav-link">
                                            <span class="menu-text"
                                                data-lang="apps-users-permissions">Permissions</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ url('/report') }}" class="side-nav-link">
                                <span class="menu-icon">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="menu-text">Reports</span>
                            </a>
                        </li>
                            
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#hrm" aria-expanded="false" aria-controls="hrm"
                                class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-accessible"></i></span>
                                <span class="menu-text" data-lang="hrm">settings</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="hrm">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#staffs" aria-expanded="false"
                                            aria-controls="staffs" class="side-nav-link">
                                            <span class="menu-text" data-lang="staffs">Staffs</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="staffs">
                                            <ul class="sub-menu">
                                                <li class="side-nav-item">
                                                    <a href="apps-hrm-staffs.html" class="side-nav-link">
                                                        <span class="menu-text" data-lang="apps-hrm-staffs">Staffs
                                                            List</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="apps-hrm-staff-profile.html" class="side-nav-link">
                                                        <span class="menu-text" data-lang="apps-hrm-staff-profile">Staff
                                                            Profile</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="apps-hrm-staff-add.html" class="side-nav-link">
                                                        <span class="menu-text" data-lang="apps-hrm-staff-add">Add
                                                            Staffs</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-hrm-departments.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-hrm-departments">Departments</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-hrm-attendance.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-hrm-attendance">Attendance</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#leaves" aria-expanded="false"
                                            aria-controls="leaves" class="side-nav-link">
                                            <span class="menu-text" data-lang="leaves">Leaves</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="leaves">
                                            <ul class="sub-menu">
                                                <li class="side-nav-item">
                                                    <a href="apps-hrm-leaves.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="apps-hrm-leaves">Leaves</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="apps-hrm-leave-add.html" class="side-nav-link">
                                                        <span class="menu-text" data-lang="apps-hrm-leave-add">Add
                                                            Leave</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-hrm-holidays.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-hrm-holidays">Holidays</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-hrm-payroll.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-hrm-payroll">Payroll</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="apps-hrm-create-salary-slip.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="apps-hrm-create-salary-slip">Create
                                                Salary Slip</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       
                                    
                               
                        




















                        
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-fixed-columns.html"
                                                        class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-fixed-columns">Fixed
                                                            Columns</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-fixed-header.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-fixed-header">Fixed
                                                            Header</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-columns.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-columns">Show &amp; Hide
                                                            Column</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-child-rows.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-child-rows">Child Rows</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-column-searching.html"
                                                        class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-column-searching">Column
                                                            Searching</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-range-search.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-range-search">Range
                                                            Search</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-rows-add.html" class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-rows-add">Add Rows</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="tables-datatables-checkbox-select.html"
                                                        class="side-nav-link">
                                                        <span class="menu-text"
                                                            data-lang="tables-datatables-checkbox-select">Checkbox
                                                            Select</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons"
                                class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-icons"></i></span>
                                <span class="menu-text" data-lang="icons">Icons</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="icons">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="icons-tabler.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="icons-tabler">Tabler</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="icons-lucide.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="icons-lucide">Lucide</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="icons-remix.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="icons-remix">Remix</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="icons-solar-duotone.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="icons-solar-duotone">Solar Duotone</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="icons-flags.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="icons-flags">Flags</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps"
                                class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-map"></i></span>
                                <span class="menu-text" data-lang="maps">Maps</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="maps">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="maps-google.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="maps-google">Google Maps</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="maps-vector.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="maps-vector">Vector Maps</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="maps-leaflet.html" class="side-nav-link">
                                            <span class="menu-text" data-lang="maps-leaflet">Leaflet Maps</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-title mt-2" data-lang="menu-items">Menu Items</li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#menu-levels" aria-expanded="false"
                                aria-controls="menu-levels" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-sitemap"></i></span>
                                <span class="menu-text" data-lang="menu-levels">Menu Levels</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menu-levels">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#second-level" aria-expanded="false"
                                            aria-controls="second-level" class="side-nav-link">
                                            <span class="menu-text" data-lang="second-level">Second Level</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="second-level">
                                            <ul class="sub-menu">
                                                <li class="side-nav-item">
                                                    <a href="#" class="side-nav-link">
                                                        <span class="menu-text" data-lang="menu-item-1">Item 2.1</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="#" class="side-nav-link">
                                                        <span class="menu-text" data-lang="menu-item-2">Item 2.2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#second-level-2" aria-expanded="false"
                                            aria-controls="second-level-2" class="side-nav-link">
                                            <span class="menu-text" data-lang="second-level-2">Second Level</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="second-level-2">
                                            <ul class="sub-menu">
                                                <li class="side-nav-item">
                                                    <a href="#" class="side-nav-link">
                                                        <span class="menu-text" data-lang="menu-item-3">Item 2.1</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a data-bs-toggle="collapse" href="#menu-item-4"
                                                        aria-expanded="false" aria-controls="menu-item-4"
                                                        class="side-nav-link">
                                                        <span class="menu-text" data-lang="menu-item-4">Item 2.2</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <div class="collapse" id="menu-item-4">
                                                        <ul class="sub-menu">
                                                            <li class="side-nav-item">
                                                                <a href="#" class="side-nav-link">
                                                                    <span class="menu-text" data-lang="menu-item-5">Item
                                                                        3.1</span>
                                                                </a>
                                                            </li>
                                                            <li class="side-nav-item">
                                                                <a href="#" class="side-nav-link">
                                                                    <span class="menu-text" data-lang="menu-item-6">Item
                                                                        3.2</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link disabled">
                                <span class="menu-icon"><i class="ti ti-ban"></i></span>
                                <span class="menu-text" data-lang="disabled-menu">Disabled Menu</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link special-menu">
                                <span class="menu-icon"><i class="ti ti-star"></i></span>
                                <span class="menu-text" data-lang="special-menu">Special Menu</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidenav Menu End -->

        @yield('content')
        <div class="offcanvas offcanvas-end overflow-hidden" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex justify-content-between text-bg-primary gap-2 p-3"
                style="background-image: url({{ asset('dashboardassets/images/settings-bg.png') }})">
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

        <!-- Dashboard js -->
        <script src="{{ asset('dashboardassets/js/pages/dashboard-projects.js') }}') }}"></script>
</body>

</html>