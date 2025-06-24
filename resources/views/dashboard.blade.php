<x-app-layout>
    <div class="container py-4" style="max-height: calc(100vh - 150px); overflow: hidden;">
        {{-- Compact Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-bold text-dark mb-0">
                    <i class="fas fa-chart-pie text-primary me-2"></i>Dashboard
                </h2>
            </div>
            <div class="text-muted small">
                Last updated: {{ now()->format('M j, H:i') }}
            </div>
        </div>

        {{-- Tight Stat Cards Grid --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-primary me-2"></i>
                            <h6 class="mb-0 fw-semibold">Users</h6>
                        </div>
                        <h3 class="fw-bold mt-2 mb-0">{{ $usersCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-shield text-success me-2"></i>
                            <h6 class="mb-0 fw-semibold">Admins</h6>
                        </div>
                        <h3 class="fw-bold mt-2 mb-0">{{ $adminsCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-info me-2"></i>
                            <h6 class="mb-0 fw-semibold">Regular</h6>
                        </div>
                        <h3 class="fw-bold mt-2 mb-0">{{ $regularUsers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-alt text-primary me-2"></i>
                            <h6 class="mb-0 fw-semibold">Files</h6>
                        </div>
                        <h3 class="fw-bold mt-2 mb-0">{{ $drivesCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Compact Users Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-semibold">
                    <i class="fas fa-user-clock text-secondary me-2"></i>Recent Users
                </h6>
            </div>
            <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="10%">ID</th>
                            <th width="30%">Name</th>
                            <th width="40%">Email</th>
                            <th width="20%">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestUsers as $user)
                            <tr>
                                <td class="text-muted">{{ $user->id }}</td>
                                <td class="fw-semibold text-truncate" style="max-width: 150px;">{{ $user->name }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $user->rule->title ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .table-sm td,
    .table-sm th {
        padding: 0.5rem;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>