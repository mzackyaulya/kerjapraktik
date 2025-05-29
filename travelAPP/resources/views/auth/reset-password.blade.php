<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/kaiadmin/Rama.png') }}" />

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
      background: url('{{ asset("assets/img/kaiadmin/Rama1.jpg") }}') no-repeat center center fixed;
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

<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom text-center">
      <img src="{{ asset('assets/img/kaiadmin/Rama.svg') }}" alt="Logo" class="mx-auto mb-4" style="height: 100px; width: auto;" />

      <h2 class="mb-4">Reset Password</h2>

      <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}" />

        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email', request()->email) }}" required autofocus
            autocomplete="username" class="form-control @error('email') is-invalid @enderror" />
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 text-start">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" name="password" required autocomplete="new-password"
            class="form-control @error('password') is-invalid @enderror" />
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4 text-start">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required
            autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror" />
          @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fs-5 rounded-2">
          Reset Password
        </button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
