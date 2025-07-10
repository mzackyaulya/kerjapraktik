<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('foto/icon.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-dark">
<div class="d-flex align-items-center justify-content-center min-vh-100"
       style="background: url('{{ asset("foto/BackgroundDesktop.png") }}') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ url('foto/ramatrans.png') }}" width="200" alt="logo">
                            </a>
                            <p class="text-center mb-4">~ Silakan Login ~</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Masukan Email Address">
                                </div>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                                    <span class="input-group-text"><i class="bx bx-show" id="togglePassword"></i></span>
                                </div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                <a class="text-primary small" href="{{ url('forgot-password') }}">Lupa password ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">Belum punya akun?
                                <a href="{{ url('register') }}" class="text-primary fw-bold">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePassword');

        if (passwordField && togglePasswordIcon) {
            togglePasswordIcon.addEventListener('click', function() {
                // Toggle the type attribute of the password input
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle the icon class (bx-show <-> bx-hide)
                if (type === 'password') {
                    togglePasswordIcon.classList.remove('bx-show');
                    togglePasswordIcon.classList.add('bx-hide');
                } else {
                    togglePasswordIcon.classList.remove('bx-hide');
                    togglePasswordIcon.classList.add('bx-show');
                }
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
