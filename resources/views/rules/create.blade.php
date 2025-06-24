<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 700px;">

            {{-- Page Header --}}
            <div class="mb-4 border-bottom pb-3 d-flex justify-content-between align-items-center">
                <h2 class="h4 fw-bold text-dark mb-0">
                    <i class="fas fa-plus-circle text-success me-2"></i> Add New Role
                </h2>
                <a href="{{ route('rule.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Flash Success Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Create Rule Form --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('rule.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter role title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Enter role description" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Create New Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
