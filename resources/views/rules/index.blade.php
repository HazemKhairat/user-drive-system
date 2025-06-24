<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 900px;">

            {{-- Page Header --}}
            <div class="mb-4 border-bottom pb-3 d-flex justify-content-between align-items-center">
                <h2 class="h4 fw-bold text-dark mb-0">
                    <i class="fas fa-gavel text-primary me-2"></i> All Roles
                </h2>
                <a href="{{ route('rule.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Create New
                </a>
            </div>

            {{-- Flash Success Message --}}
            @if (Session::has('done'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ Session::get('done') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Rules Table --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('rule.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('rule.destroy', $item->id) }}"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="p-3">
                        {{ $rules->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>