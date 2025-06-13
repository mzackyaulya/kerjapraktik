
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield('title')</title>
        <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport"
        />
        <link rel="icon" href="{{url('assets/img/kaiadmin/Rama.png')}}" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-d..." crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{url('assets/css/kaiadmin.min.css')}}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{url('assets/css/demo.css')}}" />
    </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
              <img
                src="{{ url('assets/img/kaiadmin/Rama.svg') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a href="{{ url('dashboard') }}">
                  <i class="fa fa-home"></i>
                  <p>BERANDA</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Travel Fitur</h4>
              </li>
              <li class="nav-item">
                <a href="{{ url('jadwal') }}">
                  <i class="fas fa-calendar"></i>
                  <p>Jadwal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('rute') }}">
                  <i class="fas fa-road"></i>
                  <p>Rute</p>
                </a>
              </li>
                @if(auth()->user()->role == 'A')
                    <li class="nav-item">
                        <a href="{{ url('sopir') }}">
                        <i class="fas fa-user"></i>
                        <p>Sopir</p>
                        </a>
                    </li>
                @endif
              <li class="nav-item">
                <a href="{{ url('kendaraan') }}">
                  <i class="fas fa-car"></i>
                  <p>Kendaraan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('pesan') }}">
                  <i class="fas fa-file-text"></i>
                  <p>Pemesanan</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img
                    src={{ url("assets/img/kaiadmin/Rama.png") }}
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                    />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
                </div>
                <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm custom-navbar">
            <div class="container-fluid">
                <!-- Kiri: Brand Text -->
                <a class="navbar-brand fw-bold text-primary ms-4" href="#">
                    Selamat Datang di RamaTranz
                </a>

                <!-- Kanan: User Dropdown -->
                <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a
                    class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    >
                        <i class="fas fa-circle-user" style="font-size: 1.9rem; color: #0d6efd;"></i>
                        <span style="font-size: 1.1rem; font-weight: 600; color: #212529;">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu shadow">
                        <li>
                            <a class="dropdown-item" href="{{ url('/profile') }}">
                            <i class="fas fa-user me-2"></i> Profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a
                            class="dropdown-item"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="container">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item fas fa-map-marker">
                     Jl. Mayor Santoso No.3112, 20 Ilir D. III, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30121
                </li>
              </ul>
            </nav>
            <div class="copyright text-bold">Whatsapp : 081215456258</div>
        </div>
    </footer>
    </div>
</div>
    <!--   Core JS Files   -->
    <script src="{{ url("assets/js/core/jquery-3.7.1.min.js")}}"></script>
    <script src="{{ url('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ url("assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}"></script>

    <!-- Chart JS -->
    <script src="{{ url("assets/js/plugin/chart.js/chart.min.js")}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ url("assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js")}}"></script>

    <!-- Chart Circle -->
    <script src="{{ url("assets/js/plugin/chart-circle/circles.min.js")}}"></script>

    <!-- Datatables -->
    <script src="{{ url("assets/js/plugin/datatables/datatables.min.js")}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ url("assets/js/plugin/jsvectormap/jsvectormap.min.js")}}"></script>
    <script src="{{ url("assets/js/plugin/jsvectormap/world.js")}}"></script>

    <!-- Sweet Alert -->
    <script src="{{ url("assets/js/plugin/sweetalert/sweetalert.min.js")}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ url("assets/js/kaiadmin.min.js")}}"></script>

    <!-- Fonts and icons -->
    <script src="{{url('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
            sessionStorage.fonts = true;
            },
        });
    </script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

    <style>
        .custom-navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .custom-navbar .navbar-brand {
            font-size: 1.5rem;
        }
        .custom-navbar .nav-link {
            font-size: 1.1rem;
        }
        .custom-navbar .fa-circle-user {
            font-size: 1.8rem;
        }
        .custom-navbar .nav-item.dropdown {
            position: relative;
        }
        .custom-navbar .dropdown-menu {
            font-size: 1rem;
            min-width: 180px;
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 0.5rem;
            transform: translateX(0);
            z-index: 9999;
        }
    </style>
    </body>
</html>
