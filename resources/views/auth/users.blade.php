<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 1100px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-users text-primary me-2"></i> User Management
                    </h2>
                    <p class="text-muted small mb-0">Manage user accounts and roles</p>
                </div>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Users Table --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-medium text-dark">
                        <i class="fas fa-table text-muted me-2"></i> Users Table
                    </h6>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th colspan="2" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr class="border-bottom">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->rule->title }}</td>

                                        @if ($item->id != 1)
                                            <td class="text-end pe-2">
                                                <a href="{{ route('edit_user_rule', $item->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-user-edit me-1 px-1"></i> Edit
                                                </a>
                                            </td>
                                            <td class="text-end pe-4">
                                                <form action="{{ route('delete_user', $item->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-user-times me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td class="text-end pe-1">
                                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 small"
                                                    title="Super Admin actions are restricted">
                                                    <i class="fas fa-lock me-1"></i> Locked
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 small"
                                                    title="Super Admin actions are restricted">
                                                    <i class="fas fa-lock me-1"></i> Locked
                                                </span>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    {{-- Pagination --}}
                    @if($users->hasPages())
                        <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top bg-white">
                            <div class="text-muted small">
                                Showing <span class="fw-semibold">{{ $users->firstItem() }}</span> to
                                <span class="fw-semibold">{{ $users->lastItem() }}</span> of
                                <span class="fw-semibold">{{ $users->total() }}</span> users
                            </div>
                            <div>
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>