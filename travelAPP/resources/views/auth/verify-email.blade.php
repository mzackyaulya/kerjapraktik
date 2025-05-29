<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verifikasi Email</title>
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
      <img src="{{ asset('assets/img/kaiadmin/Rama.svg') }}" alt="Verifikasi Email"
        class="mx-auto mb-3" style="height: 100px; width: auto;" />
      <h2 class="mb-3">Verifikasi Email Kamu</h2>
      <p class="text-muted mb-4">
        Terima kasih sudah mendaftar! Silakan cek email kamu dan klik link verifikasi yang sudah kami kirimkan.
      </p>

      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary w-100 mb-3">
          Kirim Ulang Email Verifikasi
        </button>
      </form>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary w-100">
          Keluar
        </button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Toast -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
      aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          Link verifikasi baru telah dikirim ke email kamu!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div>

  @if (session('status') == 'verification-link-sent')
    <script>
      window.addEventListener('DOMContentLoaded', () => {
        const toastEl = document.getElementById('liveToast')
        const toast = new bootstrap.Toast(toastEl)
        toast.show()
      })
    </script>
  @endif
</body>

</html>
