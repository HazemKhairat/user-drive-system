<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <i class="fas fa-eye text-blue-500 mr-2"></i> {{ __('Drive Details: ') }} {{ $driveData->title }}
            </h2>
            <a href="{{ route('drive.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200">
                <div class="p-8 bg-white border-b border-slate-200">

                    @php
                        $ext = strtolower($driveData->file_type);
                        $filePath = asset("upload/$driveData->file");
                    @endphp

                    {{-- Enhanced Metadata Section --}}
                    <div class="flex items-center space-x-2 mb-8">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        <h3 class="text-lg font-bold text-slate-800 uppercase tracking-wider">
                            {{ __('File Information') }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                        {{-- Description --}}
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                    <i class="fas fa-align-left text-blue-600"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-500">{{ __('Description') }}</h4>
                            </div>
                            <p class="text-slate-800 font-medium ml-1">
                                {{ $driveData->description ?? 'No description provided' }}
                            </p>
                        </div>

                        {{-- Created By --}}
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-500">{{ __('Created By') }}</h4>
                            </div>
                            <p class="text-slate-800 font-medium ml-1">{{ $driveData->name ?? 'Unknown' }}</p>
                        </div>

                        {{-- File Size --}}
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-slate-200 rounded-lg mr-3">
                                    <i class="fas fa-weight text-slate-600"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-500">{{ __('File Size') }}</h4>
                            </div>
                            <p class="text-slate-800 font-medium ml-1">
                                {{ number_format(filesize(public_path('upload/' . $driveData->file)) / 1024, 2) }} KB
                            </p>
                        </div>

                        {{-- File Type --}}
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                                    <i class="fas fa-file-alt text-indigo-600"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-500">{{ __('File Type') }}</h4>
                            </div>
                            <p class="text-slate-800 font-medium ml-1 uppercase">{{ $ext ?? 'Unknown' }}</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div
                        class="flex flex-col sm:flex-row justify-center items-center gap-4 py-6 border-t border-slate-100">
                        <button id="previewBtn"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-blue-600 text-blue-600 rounded-xl font-semibold text-sm hover:bg-blue-50 transition duration-150">
                            <i class="fas fa-eye mr-2"></i> Preview
                        </button>

                        <a href="{{ route('drive.download', $driveData->drive_id) }}"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition duration-150">
                            <i class="fas fa-download mr-2"></i> Download File
                        </a>
                    </div>

                    {{-- File Preview Section (Toggle) --}}
                    <div id="previewContainer"
                        class="mt-8 hidden overflow-hidden rounded-2xl shadow-inner bg-slate-50 p-4 border border-slate-200">
                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <div class="flex justify-center">
                                <img src="{{ $filePath }}" class="max-w-full h-auto rounded-xl shadow-lg"
                                    style="max-height: 500px;" alt="Image Preview">
                            </div>
                        @elseif($ext === 'pdf')
                            <iframe src="{{ $filePath }}" width="100%" height="600px" class="rounded-xl"
                                style="border: none;"></iframe>
                        @elseif(in_array($ext, ['txt', 'log', 'csv']))
                            <iframe src="{{ $filePath }}" width="100%" height="400px"
                                class="rounded-xl bg-white p-4 font-mono text-sm" style="border: none;"></iframe>
                        @else
                            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 inline-block">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-triangle text-amber-400 mr-3"></i>
                                    <p class="text-sm text-amber-700">
                                        No preview available for <strong>.{{ $ext }}</strong> files.
                                    </p>
                                </div>
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
            preview.classList.toggle('hidden');

            this.classList.toggle('bg-blue-600');
            this.classList.toggle('text-white');
            this.classList.toggle('text-blue-600');
            this.classList.toggle('border-blue-600');

            this.innerHTML = preview.classList.contains('hidden')
                ? '<i class="fas fa-eye mr-2"></i> Preview'
                : '<i class="fas fa-eye-slash mr-2"></i> Hide Preview';
        });
    </script>
</x-app-layout>