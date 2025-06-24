@if (session('status') === 'account-deleted')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Your account has been deleted.
    </div>
@endif

<section>
    <div class="mb-4">
        <h5 class="fw-bold">Delete Account</h5>
        <p class="text-muted small mb-0">
            Once your account is deleted, all of its resources and data will be permanently removed.
            Make sure you download any data you want to keep.
        </p>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        Delete Account
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountModalLabel">Are you sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="mb-3">
                            Once your account is deleted, all resources and data will be permanently lost.
                            Please enter your password to confirm.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Password</label>
                            <input type="password" name="password" id="delete_password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Enter your password">

                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
