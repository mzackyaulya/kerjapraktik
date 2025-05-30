<section>
    <header class="mb-4">
        <h2 class="h4 fw-bold text-primary">
            {{ __('Update Password') }}
        </h2>
        <p class="text-muted">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Kata Sandi Saat Ini') }}</label>
            <input
                type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                id="current_password"
                name="current_password"
                autocomplete="current-password"
                required
            >
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password Baru') }}</label>
            <input
                type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                id="password"
                name="password"
                autocomplete="new-password"
                required
            >
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
            <input
                type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                required
            >
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small"
                >
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>

<script>
// Bootstrap 5 validation script
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
