<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') | BengalClub Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset("plugins/jqvmap/jqvmap.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset("plugins/daterangepicker/daterangepicker.css") }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset("plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css") }}">
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset("dist/img/AdminLTELogo.png") }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="d-none d-md-inline ml-1">{{ Auth::guard('admin')->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <form id="logout-form-navbar" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" role="button" id="dark-mode-toggle">
          <i class="fas fa-moon" id="dark-mode-icon"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  @include("admin.partial.header")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield("content")
      </div>
    </section>
    <!-- /.content -->
  </div>

  @include("admin.partial.footer")


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js")}} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("plugins/jquery-ui/jquery-ui.min.js")}} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}} "></script>
<!-- ChartJS -->
<script src="{{ asset("plugins/chart.js/Chart.min.js")}} "></script>
<!-- Sparkline -->
<script src="{{ asset("plugins/sparklines/sparkline.js")}} "></script>
<!-- JQVMap -->
<script src="{{ asset("plugins/jqvmap/jquery.vmap.min.js")}} "></script>
<script src="{{ asset("plugins/jqvmap/maps/jquery.vmap.usa.js")}} "></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("plugins/jquery-knob/jquery.knob.min.js")}} "></script>
<!-- daterangepicker -->
<script src="{{ asset("plugins/moment/moment.min.js")}} "></script>
<script src="{{ asset("plugins/daterangepicker/daterangepicker.js")}} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}} "></script>
<!-- Summernote -->
<script src="{{ asset("plugins/summernote/summernote-bs4.min.js")}} "></script>
<!-- overlayScrollbars -->
<script src="{{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}} "></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.js")}} "></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("dist/js/demo.js")}} "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("dist/js/pages/dashboard.js")}} "></script>
<!-- SweetAlert2 -->
<script src="{{ asset("plugins/sweetalert2/sweetalert2.min.js")}} "></script>

<!-- Dark Mode Toggle Script -->
<script>
$(document).ready(function() {
    // Check for saved dark mode preference or default to light mode
    const darkMode = localStorage.getItem('darkMode');
    const body = $('body');
    const navbar = $('.main-header.navbar');
    const darkModeIcon = $('#dark-mode-icon');

    // Function to enable dark mode
    function enableDarkMode() {
        body.addClass('dark-mode');
        navbar.removeClass('navbar-white navbar-light').addClass('navbar-dark');
        darkModeIcon.removeClass('fa-moon').addClass('fa-sun');
        localStorage.setItem('darkMode', 'enabled');
    }

    // Function to disable dark mode
    function disableDarkMode() {
        body.removeClass('dark-mode');
        navbar.removeClass('navbar-dark').addClass('navbar-white navbar-light');
        darkModeIcon.removeClass('fa-sun').addClass('fa-moon');
        localStorage.setItem('darkMode', 'disabled');
    }

    // Apply saved preference on page load
    if (darkMode === 'enabled') {
        enableDarkMode();
    }

    // Toggle dark mode on button click
    $('#dark-mode-toggle').on('click', function(e) {
        e.preventDefault();
        const currentMode = localStorage.getItem('darkMode');

        if (currentMode === 'enabled') {
            disableDarkMode();
        } else {
            enableDarkMode();
        }
    });
});
</script>

@stack('scripts')
</body>
</html>
