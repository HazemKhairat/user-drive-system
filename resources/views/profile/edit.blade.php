<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 1100px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-user-circle text-primary me-2"></i> Profile
                    </h2>
                    <p class="text-muted small mb-0">Manage your account settings and preferences</p>
                </div>
            </div>

            {{-- Profile Information --}}
            <div class="card mb-4 border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold text-primary">Profile Information</h5>
                    <p class="text-muted small mb-4">Update your name and email address.</p>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Change Password --}}
            <div class="card mb-4 border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold text-primary">Change Password</h5>
                    <p class="text-muted small mb-4">Use a strong password to keep your account secure.</p>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold text-danger">Delete Account</h5>
                    <p class="text-muted small mb-4">This action is irreversible. All data will be permanently deleted.</p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
