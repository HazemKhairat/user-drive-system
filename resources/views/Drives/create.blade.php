<x-app-layout>
    {{-- Main Container --}}
    <div class="container py-4 d-flex justify-content-center">
        <div class="w-100" style="max-width: 1000px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-plus-circle text-primary me-2"></i> Create New Drive
                    </h2>
                    <p class="text-muted small mb-0">Upload a new file to your drive with title and description</p>
                </div>
                <a href="{{ route('drive.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to List
                </a>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ Session::get('done') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold text-dark">
                        <i class="fas fa-folder-plus text-muted me-2"></i> New File Details
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('drive.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter file title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Short description">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-primary px-4">
                                <i class="fas fa-upload me-2"></i> Create New File
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
