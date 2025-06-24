<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 700px;">

            {{-- Page Header --}}
            <div class="mb-4 border-bottom pb-3 d-flex justify-content-between align-items-center">
                <h2 class="h4 fw-bold text-dark mb-0">
                    <i class="fas fa-edit text-warning me-2"></i> Edit Role: {{ $rule->title }}
                </h2>
                <a href="{{ route('rule.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('rule.update', $rule->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ $rule->title }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <input type="text" name="description" value="{{ $rule->description }}" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-warning text-white fw-semibold">
                                <i class="fas fa-save me-1"></i> Update Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
