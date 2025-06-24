@if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="profile-updated-message">
        Profile updated successfully.
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('profile-updated-message');
            if (el) el.style.display = 'none';
        }, 2000);
    </script>
@endif

<section>
    <div class="mb-4">
        <h5 class="fw-bold">Profile Information</h5>
        <p class="text-muted small mb-0">Update your account's profile information and email address.</p>
    </div>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                class="form-control @error('name') is-invalid @enderror" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                class="form-control @error('email') is-invalid @enderror" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</section>