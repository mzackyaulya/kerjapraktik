
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"

    />
    <script src="https://unpkg.com/alpinejs" defer></script>
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('foto/icon.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('assets/js/config.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .layout-navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        .layout-page {
            background-color: #f9f9f9;
        }
        @media (max-width: 1200px) {
            #layout-menu {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 260px;
                background-color: #fff;
                z-index: 1050;
            }

            #layout-menu.open {
                transform: translateX(0);
            }

            .layout-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                z-index: 1040;
                background: rgba(0, 0, 0, 0.5);
            }

            .layout-overlay.show {
                display: block;
            }
        }
    </style>


</head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    {{-- LOGO --}}
                    <div class="app-brand demo">
                        <a href="#" class="app-brand-link">
                            <img src="{{ url('foto/ramatrans.png') }}" width="200" height="50" class="mb-3">
                        </a>
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>
                    {{-- /LOGO --}}
                    <div class="menu-inner-shadow"></div>

                    <ul class="menu-inner py-1">
                        <!-- Dashboard -->
                        <li class="menu-item ">
                            <a href="{{ url('dashboard') }}" class="menu-link">
                                <i class="menu-icon bi bi-house-door"></i>
                                <div data-i18n="Analytics" class="mt-1 fw-bold text-dark">Beranda</div>
                            </a>
                        </li>

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Fitur RamaTranz</span>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('jadwal') }}" class="menu-link">
                                <i class="menu-icon bi bi-calendar"></i>
                                <div data-i18n="Jadwal" class=" fw-bold text-dark">Jadwal</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('pelanggan') }}" class="menu-link">
                                <i class="menu-icon bi bi-person"></i>
                                <div data-i18n="Jadwal" class="fw-bold text-dark">Pelanggan</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('rute') }}" class="menu-link">
                                <i class="menu-icon bi bi-map"></i>
                                <div data-i18n="Jadwal" class="fw-bold text-dark">Rute</div>
                            </a>
                        </li>
                        @if(auth()->user()->role == 'A')
                            <li class="menu-item">
                                <a href="{{ url('sopir') }}" class="menu-link">
                                    <i class="menu-icon bi bi-person-badge"></i>
                                    <div data-i18n="Jadwal" class="fw-bold text-dark">Sopir</div>
                                </a>
                            </li>
                        @endif
                        <li class="menu-item">
                            <a href="{{ url('kendaraan') }}" class="menu-link">
                                <i class="menu-icon bi bi-car-front"></i>
                                <div data-i18n="Jadwal" class="fw-bold text-dark">Kendaraan</div>
                            </a>
                        </li>

                        <!-- Pemesanan -->
                        <li class="menu-header small text-uppercase"><span class="menu-header-text">Fitur Pemesanan</span></li>
                        <li class="menu-item">
                            <a href="{{ url('pesan') }}" class="menu-link">
                                <i class="menu-icon bi bi-ticket-perforated"></i>
                                <div data-i18n="pesan" class="fw-bold text-dark">Pemesanan Tiket</div>
                            </a>
                        </li>
                    </ul>
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-auto">

                                <li class="nav-item lh-1 me-3">
                                    <span class="text-muted" id="tanggalSekarang"></span>
                                </li>

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online me-2">
                                            <img src="{{ Auth::user()->foto ? asset('foto/pelanggan/' . Auth::user()->foto) : url('assets/img/avatars/1.png') }}"
                                                alt="User Avatar" class="w-px-40 h-px-40 rounded-circle object-fit-cover" />
                                        </div>
                                        <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                                    </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ Auth::user()->foto ? asset('foto/pelanggan/' . Auth::user()->foto) : url('assets/img/avatars/1.png') }}"
                                                            class="w-px-40 h-px-40 rounded-circle object-fit-cover" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted">{{ Auth::user()->role }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pelanggan.edit', Auth::user()->id) }}">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>
                    </nav>

                    <div class="content-wrapper">
                        {{-- content --}}
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
        <script src="{{ url('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ url('assets/js/main.js') }}"></script>
        <script src="{{ url('assets/js/dashboards-analytics.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const sidebar = document.getElementById('layout-menu');
                const overlay = document.querySelector('.layout-overlay');
                const toggles = document.querySelectorAll('.layout-menu-toggle');

                toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('show');
                });
                });

                overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                });
            });
        </script>
        <script>
            function updateTanggal() {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const tanggal = new Date().toLocaleDateString('id-ID', options);
                document.getElementById('tanggalSekarang').textContent = tanggal;
            }

            // Panggil saat pertama kali
            updateTanggal();

            // Kalau ingin update per detik (meskipun tanggal nggak berubah per detik, tapi biar kalau mau realtime bisa)
            setInterval(updateTanggal, 1000);
        </script>
        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Login',
                text: {!! json_encode(session('success')) !!},
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
        <script>
            document.getElementById("searchInput").addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                const query = this.value.trim();
                if (query !== "") {
                    // Redirect ke halaman pencarian dengan query
                    window.location.href = "/search?query=" + encodeURIComponent(query);
                }
                }
            });
        </script>
@endif
    </body>
</html>
