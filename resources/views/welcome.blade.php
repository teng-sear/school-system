<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin School | Dashboard</title>

  {{-- Vite JS --}}
  @vite('resources/js/app.js')

  {{-- Base URL for relative assets --}}
  <base href="{{ asset('admincss') }}/" />

  {{-- Fonts & Icons --}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  {{-- Plugin Styles --}}
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0" />

  {{-- Custom Styles --}}
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #3498db;
      --accent-color: #e74c3c;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f8f9fc;
    }

    .hero-section {
      background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)),
                  url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
      background-size: cover;
      background-position: center;
      color: white;
      padding: 100px 0;
      margin-bottom: 50px;
    }

    .feature-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-10px);
    }

    .login-btn {
      padding: 15px 30px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s ease;
      margin: 10px;
      min-width: 200px;
    }

    .stats-card {
      background: white;
      border-left: 4px solid var(--secondary-color);
      padding: 25px;
      margin: 15px 0;
    }
  </style>

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @yield('customCss')
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    {{-- Preloader --}}
    <div class="preloader d-flex justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60" />
    </div>

    {{-- Hero Section --}}
    <section class="hero-section">
      <div class="container text-center">
        <h1 class="display-4 mb-4 fw-bold">Welcome to School Management System</h1>
        <p class="lead mb-5">Empowering Education Through Technology</p>
        
        <div class="login-options">
          <a href="{{ route('admin.login') }}" class="btn btn-light login-btn">
            <i class="fas fa-user-shield me-2"></i>Admin Login
          </a>
          <a href="{{ route('teacher.login') }}" class="btn btn-warning login-btn">
            <i class="fas fa-chalkboard-teacher me-2"></i>Teacher Login
          </a>
          <a href="{{ route('student.login') }}" class="btn btn-info login-btn">
            <i class="fas fa-user-graduate me-2"></i>Student Login
          </a>
        </div>
      </div>
    </section>

    {{-- Features Section --}}
    <section class="container py-5">
      <div class="row">
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
            <h4>Real-time Analytics</h4>
            <p>Track academic progress and institutional performance with interactive dashboards</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="fas fa-users-cog fa-3x text-success mb-3"></i>
            <h4>User Management</h4>
            <p>Efficiently manage students, teachers, and administrative staff</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="fas fa-book-open fa-3x text-danger mb-3"></i>
            <h4>Digital Resources</h4>
            <p>Access course materials and academic resources anytime, anywhere</p>
          </div>
        </div>
      </div>
    </section>

    {{-- Statistics Section --}}
    <section class="bg-light py-5">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-3">
            <div class="stats-card">
              <h3 class="text-primary">1500+</h3>
              <p>Active Students</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stats-card">
              <h3 class="text-success">200+</h3>
              <p>Qualified Teachers</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stats-card">
              <h3 class="text-warning">50+</h3>
              <p>Courses Offered</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stats-card">
              <h3 class="text-danger">98%</h3>
              <p>Success Rate</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-dark text-white py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>About Us</h5>
            <p>Empowering educational institutions with cutting-edge management solutions since 2023</p>
          </div>
          <div class="col-md-4">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Academic Calendar</a></li>
              <li><a href="#" class="text-white">Resources</a></li>
              <li><a href="#" class="text-white">Contact Support</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Contact</h5>
            <p><i class="fas fa-map-marker-alt me-2"></i>123 Education Street, Tech City</p>
            <p><i class="fas fa-phone me-2"></i>(555) 123-4567</p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  {{-- Scripts --}}
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="dist/js/adminlte2167.js?v=3.2.0"></script>

  {{-- Animation Script --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add animation to feature cards
      const featureCards = document.querySelectorAll('.feature-card');
      featureCards.forEach((card, index) => {
        setTimeout(() => {
          card.style.opacity = 1;
          card.style.transform = 'translateY(0)';
        }, index * 200);
      });

      // Add hover effect to login buttons
      const loginBtns = document.querySelectorAll('.login-btn');
      loginBtns.forEach(btn => {
        btn.addEventListener('mouseover', () => {
          btn.style.transform = 'scale(1.05)';
        });
        btn.addEventListener('mouseout', () => {
          btn.style.transform = 'scale(1)';
        });
      });
    });
  </script>

  @yield('customJs')
</body>
</html>