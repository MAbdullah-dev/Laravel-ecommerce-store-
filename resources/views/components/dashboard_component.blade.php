<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('dashboardAssets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('dashboardAssets/assets/images/favicon.png') }}" />
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo" href="index.php"><img
                        src="{{ asset('dashboardAssets/assets/images/logo.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img
                        src="{{ asset('dashboardAssets/assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">

                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <!-- <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">

                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2"></span>
                                <span class="text-secondary text-small">store_Owner</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>

                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.page') }}">
                                <span class="menu-title">Dashboard</span>
                                <i class="mdi mdi-home menu-icon"></i>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">CRUD OPERATIONS</span>
                            <i class="menu-arrow"></i>
                            <i style="font-size: 18px;color: gray;" class="ri-table-line"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                @if (Auth::user()->role_id == 2)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('product.crud.page') }}">Product CRUD</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('trash.products') }}">Trash Products</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role_id == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.page') }}">Category CRUD</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('trash.categories') }}">Trash
                                            categories</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    @if (Auth::user()->role_id == 2)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false"
                                aria-controls="icons">
                                <span class="menu-title">Orders</span>
                                <i style="font-size: 18px; color: gray; margin-left: 7.8rem;"
                                    class="ri-shopping-bag-2-fill"></i>
                            </a>
                            <div class="collapse" id="icons">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('orders.page') }}">ORDER TABLE</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- partial -->
            {{ $slot }}
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('dashboardAssets/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('dashboardAssets/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('dashboardAssets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('dashboardAssets/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboardAssets/assets/js/misc.js') }}"></script>
    <script src="{{ asset('dashboardAssets/assets/js/settings.js') }}"></script>
    <script src="{{ asset('dashboardAssets/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('dashboardAssets/assets/js/jquery.cookie.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('dashboardAssets/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('#storeOwnersTable').DataTable();
            // Show users table by default
            $('#showUsersTable').addClass('active');
            $('#usersTable').removeClass('hidden');
            $('#usersTable').DataTable();


            // Click event for Users Table button
            $('#showUsersTable').click(function() {
                $('#showUsersTable').addClass('active');
                $('#showStoreOwnersTable').removeClass('active');
                $('#usersTable').removeClass('hidden');
                $('#storeOwnersTable').addClass('hidden');
                $('#usersTable').DataTable();
                $('#storeOwnersTable').DataTable().destroy();
            });

            // Click event for Store Owners Table button
            $('#showStoreOwnersTable').click(function() {
                $('#showStoreOwnersTable').addClass('active');
                $('#showUsersTable').removeClass('active');
                $('#usersTable').addClass('hidden');
                $('#storeOwnersTable').removeClass('hidden');
                $('#usersTable').DataTable().destroy();
                $('#storeOwnersTable').DataTable();
            });
        });
    </script>
</body>

</html>
