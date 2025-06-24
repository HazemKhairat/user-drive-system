@if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="password-updated-message">
        Password changed successfully.
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('password-updated-message');
            if (el) el.style.display = 'none';
        }, 2000);
    </script>
@endif
<section>
    <div class="mb-4">
        <h5 class="fw-bold">Update Password</h5>
        <p class="text-muted small mb-0">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" id="update_password_current_password" class="form-control" autocomplete="current-password">
            @if($errors->updatePassword->has('current_password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input type="password" name="password" id="update_password_password" class="form-control" autocomplete="new-password">
            @if($errors->updatePassword->has('password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control" autocomplete="new-password">
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </form>
</section>
