<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Thu ngân</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Modules -->
    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js'])
    @livewireStyles
</head>

<body>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Dashmix.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: '{{ session('success') }}'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Dashmix.helpers('jq-notify', {
                    type: 'danger',
                    icon: 'fa fa-times me-1',
                    message: '{{ session('error') }}'
                });
            });
        </script>
    @elseif(session('errors'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    Dashmix.helpers('jq-notify', {
                        type: 'danger',
                        icon: 'fa fa-times me-1',
                        message: '{{ $error }}'
                    });
                @endforeach
            });
        </script>
    @endif
    <div id="page-container"
        class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">S
        <!-- Sidebar -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="bg-header-dark">
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="fw-semibold text-white tracking-wide" href="{{ route('cashier.dashboard') }}">
                        <span class="smini-visible">
                            D<span class="opacity-75">x</span>
                        </span>
                        <span class="smini-hidden">
                            Dash<span class="opacity-75">mix</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                            onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                            <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                        </button>
                        <!-- END Toggle Sidebar Style -->

                        <!-- Dark Mode -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#dark-mode-toggler" data-class="far fa"
                            onclick="Dashmix.layout('dark_mode_toggle');">
                            <i class="far fa-moon" id="dark-mode-toggler"></i>
                        </button>
                        <!-- END Dark Mode -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                            <i class="fa fa-times-circle"></i>
                        </button>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll">
                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}"
                                href="{{ route('cashier.dashboard') }}">
                                <i class="nav-main-link-icon fa fa-tachometer-alt"></i>
                                <span class="nav-main-link-name">Dashboard</span>
                                {{-- <span class="nav-main-link-badge badge rounded-pill bg-primary">5</span> --}}
                            </a>
                        </li>
                        <li class="nav-main-heading">Quản lý</li>

                        <li
                            class="nav-main-item{{ request()->is('cashier/invoices/*') || request()->is('cashier/invoices') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="{{ request()->is('cashier/invoices/*') ? 'true' : 'false' }}"
                                href="#">
                                <i class="nav-main-link-icon fa fa-file-invoice"></i>
                                <span class="nav-main-link-name">Hóa đơn</span>
                            </a>
                            <ul class="nav-main-submenu{{ request()->is('cashier/invoices/*') ? ' show' : '' }}">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('cashier/invoices/') ? ' active' : '' }}"
                                        href="{{ route('cashier.invoices.index') }}">
                                        <span class="nav-main-link-name">Danh sách hóa đơn</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('cashier/invoices/create') ? ' active' : '' }}"
                                        href="{{ route('cashier.invoices.create') }}">
                                        <span class="nav-main-link-name">Tạo hóa đơn</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-main-item{{ request()->is('cashier/services/*') || request()->is('cashier/services') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="{{ request()->is('cashier/services/*') ? 'true' : 'false' }}" href="#">
                                <i class="nav-main-link-icon fa fa-box"></i>
                                <span class="nav-main-link-name">Dịch vụ</span>
                            </a>
                            <ul class="nav-main-submenu{{ request()->is('cashier/services/*') ? ' show' : '' }}">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('cashier/services') ? ' active' : '' }}"
                                        href="{{ route('cashier.services') }}">
                                        <span class="nav-main-link-name">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-main-item{{ request()->is('cashier/bookings/*') || request()->is('cashier/bookings') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="{{ request()->is('cashier/bookings/*') ? 'true' : 'false' }}"
                                href="#">
                                <i class="nav-main-link-icon fa fa-calendar-check"></i>
                                <span class="nav-main-link-name">Booking</span>
                            </a>
                            <ul class="nav-main-submenu{{ request()->is('cashier/bookings/*') ? ' show' : '' }}">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('cashier/bookings') ? ' active' : '' }}"
                                        href="{{ route('cashier.bookings.index') }}">
                                        <span class="nav-main-link-name">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-main-item{{ request()->is('cashier/report/*') || request()->is('cashier/report') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="{{ request()->is('cashier/report/*') ? 'true' : 'false' }}"
                                href="#">
                                <i class="nav-main-link-icon fa fa-calendar-check"></i>
                                <span class="nav-main-link-name">Báo cáo</span>
                            </a>
                            <ul class="nav-main-submenu{{ request()->is('cashier/report/*') ? ' show' : '' }}">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('cashier/report') ? ' active' : '' }}"
                                        href="{{ route('cashier.report.index') }}">
                                        <span class="nav-main-link-name">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-main-heading">Thêm</li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon fa fa-cog"></i>
                                <span class="nav-main-link-name">Cài đặt</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="space-x-1">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-alt-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="space-x-1">
                    <!-- Notifications Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-bell"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                                Notifications
                            </div>
                            <ul class="nav-items my-2">
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">App was updated to v5.6!</div>
                                            <div class="text-muted">3 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-user-plus text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">New Subscriber was added! You now have 2580!
                                            </div>
                                            <div class="text-muted">10 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-times-circle text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">Server backup failed to complete!</div>
                                            <div class="text-muted">30 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">You are running out of space. Please consider
                                                upgrading your plan.</div>
                                            <div class="text-muted">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">New Sale! + $30</div>
                                            <div class="text-muted">2 hours ago</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="p-2 border-top">
                                <a class="btn btn-alt-primary w-100 text-center" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-eye opacity-50 me-1"></i> View All
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END Notifications Dropdown -->
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">Admin</span>
                            <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                                User Options
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-user me-1"></i> Profile
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span><i class="far fa-fw fa-envelope me-1"></i> Inbox</span>
                                    <span class="badge bg-primary rounded-pill">3</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-file-alt me-1"></i> Invoices
                                </a>
                                <div role="separator" class="dropdown-divider"></div>

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout"
                                    data-action="side_overlay_toggle">
                                    <i class="far fa-fw fa-building me-1"></i> Settings
                                </a>
                                <!-- END Side Overlay -->

                                <div role="separator" class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    <button class="dropdown-item">
                                        <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Đăng xuất
                                    </button>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-header-dark">
                <div class="bg-white-10">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                            href="https://pixelcave.com" target="_blank">pixelcave</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" href="https://pixelcave.com/products/dashmix"
                            target="_blank">Dashmix</a> &copy;
                        <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->
    {{-- <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script> --}}

    <!-- jQuery (required for BS Notify plugin) -->
    <script src="{{ asset('js') }}/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js') }}/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-notify']);
    </script>

    <script src="{{ asset('js') }}/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js') }}/lib/be_comp_dialogs.js"></script>

    @yield('js')
    @livewireScripts
</body>

</html>
