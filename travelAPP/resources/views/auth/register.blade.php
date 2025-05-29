<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/kaiadmin/Rama.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center"
      style="background: url('{{ asset('assets/img/kaiadmin/Rama1.jpg') }}') no-repeat center center; background-size: cover;">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-3">
            <div class="card mb-0 shadow-lg rounded-4">
              <div class="card-body p-4">
                <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assets/img/kaiadmin/Rama.svg') }}" width="180" alt="">
                </a>
                <p class="text-center mb-4">~ Silakan Register untuk Buat Akun ~</p>

                <form role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                      placeholder="Masukan Username">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                      placeholder="Masukan Email Address">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                      placeholder="Masukan Password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation"
                      id="password_confirmation" placeholder="Masukan Password Konfirmasi">
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mb-3 rounded-1">Register</button>

                  <div class="text-center">
                    <p class="fs-6 mb-0">Sudah Memiliki Akun?</p>
                    <a class="text-primary fw-bold" href="{{ url('login') }}">Login</a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
