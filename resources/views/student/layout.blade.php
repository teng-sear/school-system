<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student | Dashboard</title>

    @vite('resources/js/app.js')

    {{-- css dari folder public --}}
    <base href="{{ asset('admincss') }}/" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    @yield('customCss')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        {{-- navbar dashboard --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('student.logout') }}" style="display: inline;">
                        <button type="submit" class="btn btn-danger text-sm">Logout</button>
                    </form>
                </li>

            </ul>
        </nav>

        {{-- sidebar dahboard --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">
                    {{ optional(Auth::user())->name ?? 'Guest' }}
                </span>
            </a>

            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group mt-3 mb-3" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('student.dashboard') }}"
                                class="nav-link {{ Route::currentRouteName() === 'student.dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.my-subject') }}"
                                class="nav-link {{ Route::currentRouteName() === 'student.my-subject' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-landmark"></i>
                                <p>Subjects</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.timetable') }}"
                                class="nav-link {{ Route::currentRouteName() === 'student.timetable' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-clock"></i>
                                <p>Class Schedule</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.announcement-student') }}"
                                class="nav-link {{ Route::currentRouteName() === 'student.announcement-student' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-bullhorn"></i>
                                <p>Announcement</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.change-password') }}"
                                class="nav-link {{ Route::currentRouteName() === 'student.change-password' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


        {{-- content dashboard --}}
        @yield('content')

        {{-- footer dashboard --}}
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="https://adminlte.io/">School SMS</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="plugins/sparklines/sparkline.js"></script>

    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="plugins/summernote/summernote-bs4.min.js"></script>

    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="dist/js/adminlte2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script src="dist/js/pages/dashboard.js"></script>
    @yield('customJs')
</body>

</html>
