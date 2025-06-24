<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 700px;">

            {{-- Header --}}
            <div class="mb-4 border-bottom pb-3">
                <h2 class="h4 fw-bold text-dark mb-1">
                    <i class="fas fa-user-edit text-primary me-2"></i> Edit User Role
                </h2>
                <p class="text-muted mb-0">
                    User: <span class="fw-semibold">{{ $user->name }}</span> | Current Role: 
                    <span class="badge bg-secondary">{{ $user->rule->title }}</span>
                </p>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Back Button --}}
            <div class="mb-3">
                <a href="{{ route('listUsers') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Users List
                </a>
            </div>

            {{-- Card Form --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('update_rule', $user->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="roleSelect" class="form-label fw-semibold">Select Role</label>
                            <select class="form-select" name="rule_id" id="roleSelect" required>
                                @foreach ($rules as $rule)
                                    @if ($rule->id != 1)
                                        <option value="{{ $rule->id }}" {{ $user->rule->id == $rule->id ? 'selected' : '' }}>
                                            {{ $rule->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
