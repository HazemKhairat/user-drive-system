<x-app-layout>
    <div class="container py-4 d-flex justify-content-center">
        <div class="w-100" style="max-width: 1000px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">
                        <i class="fas fa-eye text-info me-2"></i> Drive Details: {{ $driveData->title }}
                    </h2>
                    <p class="text-muted small mb-0">View file info, preview, and download options</p>
                </div>
                <a href="{{ route('drive.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to List
                </a>
            </div>

            {{-- File Info Card --}}
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body">

                    @php
                        $ext = strtolower($driveData->file_type);
                        $filePath = asset("upload/$driveData->file");
                    @endphp

                    {{-- Enhanced Metadata Section --}}
                    <h5 class="text-secondary fw-bold mt-4 mb-3"><i class="fas fa-info-circle me-2"></i> File
                        Information</h5>

                    <div class="row row-cols-1 row-cols-md-2 g-3 mt-4">

                        {{-- Description --}}
                        <div class="col">
                            <div class="bg-light rounded p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-align-left text-primary me-2"></i>
                                    <h6 class="mb-0 text-muted">Description</h6>
                                </div>
                                <p class="mb-0 fw-semibold text-dark">{{ $driveData->description ?? '—' }}</p>
                            </div>
                        </div>

                        {{-- Created By --}}
                        <div class="col">
                            <div class="bg-light rounded p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user text-success me-2"></i>
                                    <h6 class="mb-0 text-muted">Created By</h6>
                                </div>
                                <p class="mb-0 fw-semibold text-dark">{{ $driveData->name ?? '—' }}</p>
                            </div>
                        </div>

                        {{-- File Size --}}
                        <div class="col">
                            <div class="bg-light rounded p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-weight text-secondary me-2"></i>
                                    <h6 class="mb-0 text-muted">File Size</h6>
                                </div>
                                <p class="mb-0 fw-semibold text-dark">
                                    {{ number_format(filesize(public_path('upload/' . $driveData->file)) / 1024, 2) }}
                                    KB
                                </p>
                            </div>
                        </div>

                        {{-- File Type --}}
                        <div class="col">
                            <div class="bg-light rounded p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-file-alt text-info me-2"></i>
                                    <h6 class="mb-0 text-muted">File Type</h6>
                                </div>
                                <p class="mb-0 fw-semibold text-dark">{{ strtoupper($ext ?? '—') }}</p>
                            </div>
                        </div>




                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <button id="previewBtn" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            title="Preview the file">
                            <i class="fas fa-eye me-1"></i> Preview
                        </button>

                        <a href="{{ route('drive.download', $driveData->drive_id) }}" class="btn btn-info px-4"
                            data-bs-toggle="tooltip" title="Download the file">
                            <i class="fas fa-download me-2"></i> Download File
                        </a>
                    </div>

                    {{-- File Preview Section (Toggle) --}}
                    <div id="previewContainer" class="mt-4 text-center d-none">
                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ $filePath }}" class="img-fluid rounded shadow" style="max-width: 400px;"
                                alt="Image Preview">
                        @elseif($ext === 'pdf')
                            <iframe src="{{ $filePath }}" width="100%" height="500px" class="rounded shadow"
                                style="border: 1px solid #ddd;"></iframe>
                        @elseif(in_array($ext, ['txt', 'log', 'csv']))
                            <iframe src="{{ $filePath }}" width="100%" height="400px" class="rounded"
                                style="border: 1px solid #ccc;"></iframe>
                        @else
                            <div class="alert alert-warning d-inline-block">
                                <i class="fas fa-file-alt me-2"></i> No preview available for <strong>.{{ $ext }}</strong>
                                files.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Toggle Script --}}
    <script>
        document.getElementById('previewBtn').addEventListener('click', function () {
            const preview = document.getElementById('previewContainer');
            preview.classList.toggle('d-none');

            this.classList.toggle('btn-outline-primary');
            this.classList.toggle('btn-secondary');

            this.innerHTML = preview.classList.contains('d-none')
                ? '<i class="fas fa-eye me-1"></i> Preview'
                : '<i class="fas fa-eye-slash me-1"></i> Hide Preview';
        });

    </script>
</x-app-layout>