<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 1100px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-folder-open text-primary me-2"></i> Public Drives
                    </h2>
                    <p class="text-muted small mb-0">Browse and explore publicly available files</p>
                </div>
            </div>

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ Session::get('done') }}
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
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 60px;">#</th>
                                    <th>File</th>
                                    <th style="width: 110px;">Status</th>
                                    <th class="text-center" style="width: 80px;">View</th>
                                    <th class="text-center" style="width: 80px;">Edit</th>
                                    <th class="text-center" style="width: 80px;">Delete</th>
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
                                                    <!--  -->
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->user_id == Auth::id())
                                                <a href="{{ route('drive.change_status', $item->id) }}"
                                                    class="badge rounded-pill d-inline-flex align-items-center py-1 px-3 text-decoration-none bg-{{ $item->status === 'private' ? 'danger' : 'success' }}-subtle text-{{ $item->status === 'private' ? 'danger' : 'success' }}">
                                                    <i class="fas fa-{{ $item->status === 'private' ? 'lock' : 'globe' }} me-1"
                                                        style="font-size: 0.7rem;"></i>
                                                    {{ ucfirst($item->status) }}
                                                </a>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary small px-2 py-1"
                                                    style="opacity: 0.7;">
                                                    Not Allowed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('drive.show', $item->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->user_id == Auth::id())
                                                <a href="{{ route('drive.edit', $item->id) }}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    Edit
                                                </a>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary small px-2 py-1"
                                                    style="opacity: 0.7;">
                                                    Not Allowed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->user_id == Auth::id())
                                                <a href="{{ route('drive.destroy', $item->id) }}"
                                                    class="btn btn-sm btn-outline-danger">
                                                    Delete
                                                </a>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary small px-2 py-1"
                                                    style="opacity: 0.7;">
                                                    Not Allowed
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="mb-4">
                                                <i class="fas fa-folder-open fa-4x text-muted opacity-25"></i>
                                            </div>
                                            <h5 class="text-muted mb-2">No public files available</h5>
                                            <p class="text-muted mb-4">Try uploading a new file or check again later.</p>
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
                                {{ $drives->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>