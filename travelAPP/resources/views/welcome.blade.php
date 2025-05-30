
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .footer {
            background-color: #2C3E50 !important;
            background-image: none !important;
        }
    </style>

    <meta charset="utf-8">
    <title>Rama Tranz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/kaiadmin/rama.png') }}" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet') }}">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background: transparent;">
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-3">
                    <a href="{{ url('dashboard') }}" class="nav-item nav-link">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <a href="{{ url('login') }}" class="nav-item nav-link">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ url('register') }}" class="nav-item nav-link">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->



    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/img/kaiadmin/Rama1.jpg" alt="Image" height="700px">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Travel dan Antar Paket</h2>
                        <h1 class="display-1 text-white m-0">RAMA TRANZ</h1>
                        <h2 class="text-white m-0">~ SINCE 2012 ~</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100 " src="assets/img/kaiadmin/Rama2.jfif" alt="Image" height="700px">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Travel dan Antar Paket</h2>
                        <h1 class="display-1 text-white m-0">RAMA TRANZ</h1>
                        <h2 class="text-white m-0">~ SINCE 2012 ~</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Footer Start -->
    <div class="container-fluid footer bg-dark text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Lokasi</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Jl. Mayor Santoso No.3112, 20 Ilir D. III, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30121</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+6281215456258</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>ramatrans@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Follow Us</h4>
                <p>Ikuti Media Sosial Kami untuk Info Menariknya :)</p>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.youtube.com/channel/UCY7MCn80wnrJTn219ACedYQ"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="https://www.instagram.com/ramatranstravel?igsh=ZHNvYm1vejhsb3I2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Waktu Buka</h4>
                <div>
                    <h6 class="text-white text-uppercase">Setiap Hari</h6>
                    <p>07:00 - 21:00</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
