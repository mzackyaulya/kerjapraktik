<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('foto/icon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      background: url('{{ asset("foto/backgrounds.png") }}') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
    }

    .card-custom {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 0.15);
      max-width: 400px;
      width: 100%;
      padding: 2rem;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="card card-custom text-center">
        <img src="{{ url('foto/ramatrans.png') }}" alt="Logo" class="mx-auto mb-3" style="height: 80px; width: auto;" />
        <h4 class="mb-3">Reset Password</h4>
        <div class="mb-3 text-muted small">
            Masukkan email akun kamu untuk mengirim Link Reset Password.
        </div>

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>
                </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
