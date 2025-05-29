<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100"
    style="background: url('{{ asset('assets/img/kaiadmin/Rama1.jpg') }}') no-repeat center center; background-size: cover;">

    <div class="card p-4 shadow-lg rounded-3" style="width: 400px;">
        <h4 class="text-center mb-3">Reset Password</h4>

        <div class="mb-3 text-muted small text-center">
            Masukkan email akun kamu untuk mengirim Link Reset Password nya.
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>

            <div class="text-center mt-3">
                <a href="{{ url('login') }}" class="text-decoration-none">Kembali ke Login</a>
            </div>
        </form>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
