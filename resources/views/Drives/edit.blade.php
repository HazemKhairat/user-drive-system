<x-app-layout>
    <div class="container py-4 d-flex justify-content-center">
        <div class="w-100" style="max-width: 1000px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-edit text-warning me-2"></i> Edit Drive
                    </h2>
                    <p class="text-muted small mb-0">Modify details or replace the uploaded file</p>
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

            {{-- Form --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <form action="{{ route('drive.update', $drives->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ $drives->title }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <input type="text" name="description" value="{{ $drives->description }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current File</label>
                            <div class="form-text mb-2">{{ $drives->file }}</div>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-warning text-white px-4">
                                <i class="fas fa-save me-2"></i> Update File
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>