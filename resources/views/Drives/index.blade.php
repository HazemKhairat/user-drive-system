<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 1100px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-cloud-upload-alt text-primary me-2"></i> Your Drives
                    </h2>
                    <p class="text-muted small mb-0">Manage your cloud storage files</p>
                </div>
                <a href="{{ route('drive.create') }}" class="btn btn-primary px-4">
                    <i class="fas fa-plus-circle me-2"></i> New
                </a>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card --}}

            <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-5">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-medium text-dark">
                            <i class="fas fa-list text-muted me-2"></i> File List
                        </h6>
                        <div class="d-flex gap-2">
                            <form method="GET" action="{{ route('drive.index') }}" class="d-inline">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" placeholder="Search files..."
                                        value="{{ request('search') }}">
                                </div>
                            </form>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('drive.index') }}">All Files</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('drive.index', ['status' => 'public']) }}">Public</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('drive.index', ['status' => 'private']) }}">Private</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 60px;">#</th>
                                    <th>File</th>
                                    <th style="width: 110px;">Status</th>
                                    <th style="width: 50px;" class="text-end pe-4">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drives as $item)
                                    <tr class="border-bottom">
                                        <td class="ps-4 text-muted fw-semibold">{{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt me-3 text-primary" style="font-size: 1.1rem;"></i>
                                                <div>
                                                    <div class="fw-medium text-truncate" style="max-width: 300px;">
                                                        {{ $item->title }}
                                                    </div>
                                                    <small class="text-muted">
                                                        @if($item->created_at)
                                                            Uploaded {{ $item->created_at->diffForHumans() }}
                                                        @else
                                                            Upload date not available
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('drive.change_status', $item->id) }}"
                                                class="badge rounded-pill d-inline-flex align-items-center py-1 px-3 text-decoration-none bg-{{ $item->status === 'private' ? 'danger' : 'success' }}-subtle text-{{ $item->status === 'private' ? 'danger' : 'success' }}">
                                                <i class="fas fa-{{ $item->status === 'private' ? 'lock' : 'globe' }} me-1"
                                                    style="font-size: 0.7rem;"></i>
                                                {{ ucfirst($item->status) }}
                                            </a>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light rounded-circle" title="Actions"
                                                    aria-label="More options" type="button" data-bs-toggle="dropdown"
                                                    style="width: 32px; height: 32px;">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                                                    style="min-width: 160px;">
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center py-2"
                                                            href="{{ route('drive.show', $item->id) }}">
                                                            <i class="fas fa-eye me-2 text-muted"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center py-2"
                                                            href="{{ route('drive.edit', $item->id) }}">
                                                            <i class="fas fa-edit me-2 text-muted"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center py-2 text-danger"
                                                            href="{{ route('drive.destroy', $item->id) }}">
                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="mb-4">
                                                <i class="fas fa-folder-open fa-4x text-black-50"></i>
                                            </div>
                                            <h5 class="text-muted mb-2">No files found</h5>
                                            <p class="text-muted mb-4">Get started by uploading your first file</p>
                                            <a href="{{ route('drive.create') }}" class="btn btn-primary px-4">
                                                <i class="fas fa-plus-circle me-2"></i> Upload File
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($drives->hasPages())
                        <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top bg-white">
                            <div class="text-muted small">
                                Showing <span class="fw-semibold">{{ $drives->firstItem() }}</span> to <span
                                    class="fw-semibold">{{ $drives->lastItem() }}</span> of <span
                                    class="fw-semibold">{{ $drives->total() }}</span> entries
                            </div>
                            <div>
                                {{ $drives->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>