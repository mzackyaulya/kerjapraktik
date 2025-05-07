
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="{{url('assets/img/kaiadmin/favicon.ico')}}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-d..." crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <a href="#">
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
                <a href="{{ url('rute') }}">
                  <i class="fas fa-road"></i>
                  <p>Rute</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('sopir') }}">
                  <i class="fas fa-user"></i>
                  <p>Sopir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('kendaraan') }}">
                  <i class="fas fa-car"></i>
                  <p>Kendaraan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('jadwal') }}">
                  <i class="fas fa-calendar"></i>
                  <p>Jadwal</p>
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
                  src="assets/img/kaiadmin/logo_light.svg"
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
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form p-0 d-none d-lg-flex"
                style="padding: 15px 30px; border-radius: 8px;">
                    <span style="color: rgb(24, 21, 214); font-size: 24px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">
                        Selamat Datang di Rama Tranz
                    </span>
                </nav>
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
    <script src="{{("assets/js/core/jquery-3.7.1.min.js")}}"></script>
    <script src="{{('assets/js/core/popper.min.js')}}"></script>
    <script src="{{('assets/js/core/bootstrap.min.js')}}"></script>

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
  </body>
</html>
