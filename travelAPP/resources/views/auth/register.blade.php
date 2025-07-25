<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
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
                            <p class="text-center mb-4">~ Silakan Register ~</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}" placeholder="Masukan Username">
                                </div>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email') }}" placeholder="Masukan Email Address">
                                </div>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukan Password">
                                </div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Masukan Password Konfirmasi">
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">Sudah punya akun?
                                <a href="{{ url('login') }}" class="text-primary fw-bold">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
