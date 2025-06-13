
<!DOCTYPE HTML>
<html>
	<head>
		<title>RamaTranz</title>
		<meta charset="utf-8">
		<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ url('assets/css/main.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	</head>
	<body>
		<header id="header" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; background: transparent; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: fixed; top: 0; left: 0; right: 0; z-index: 999;">
            <img src="{{ url('foto/ramatrans.png') }}" alt="Logo" style="height: 40px;">
            <a href="#menu" style="text-decoration: none; color: #fff; background: transparent; padding: 8px 16px; border-radius: 4px;">Menu</a>
        </header>

		<nav id="menu">
			<ul class="links">
                <li>
                    <a href="{{ url('dashboard') }}">
                        <i class="bx bx-home-alt" style="margin-right: 8px; vertical-align: middle;"></i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('login') }}">
                        <i class="bx bx-log-in" style="margin-right: 8px; vertical-align: middle;"></i> Login
                    </a>
                </li>
                <li>
                    <a href="{{ url('register') }}">
                        <i class="bx bx-user-plus" style="margin-right: 8px; vertical-align: middle;"></i> Register
                    </a>
                </li>
            </ul>
		</nav>
		<section id="banner" style="min-height: 100vh; background-size: cover; background-position: center;">
            <div class="inner">
                <header>
                    <h1>RamaTranz</h1>
                    <p>Memberikan pelayanan prima dan hadir sebagai solusi yang bernilai untuk seluruh konsumen.</p>
                </header>
                <a href="{{ url('dashboard') }}" class="button big alt scrolly">Beranda</a>
            </div>
        </section>

        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/jquery.scrolly.min.js') }}"></script>
        <script src="{{ url('assets/js/skel.min.js') }}"></script>
        <script src="{{ url('assets/js/util.js') }}"></script>
        <script src="{{ url('assets/js/main.js') }}"></script>

        <script>
            function updateBannerBackground() {
                const banner = document.getElementById('banner');
                if (!banner) return;

                const desktopBg = "{{ url('foto/backgrounds.webp') }}";
                const mobileBg  = "{{ url('foto/backgroundss.webp') }}";

                if (window.innerWidth <= 768) {
                    console.log("Set background to mobile");
                    banner.style.backgroundImage = `url('${mobileBg}')`;
                } else {
                    console.log("Set background to desktop");
                    banner.style.backgroundImage = `url('${desktopBg}')`;
                }
            }

            // Panggil saat load
            window.addEventListener('load', updateBannerBackground);
            // Panggil saat window di-resize
            window.addEventListener('resize', updateBannerBackground);
        </script>
	</body>
</html>
