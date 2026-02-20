<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <i class="fas fa-plus-circle text-blue-600 mr-2"></i> {{ __('Create New Drive') }}
            </h2>
            <a href="{{ route('drive.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div x-data="{ show: true }" x-show="show"
                    class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-2xl bg-green-50"
                    role="alert">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    <div class="font-medium">
                        {{ Session::get('done') }}
                    </div>
                    <button @click="show = false" type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200">
                <div class="p-6 bg-white border-b border-slate-200">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fas fa-folder-plus text-slate-400"></i>
                        <h3 class="text-lg font-medium text-slate-800">{{ __('New File Details') }}</h3>
                    </div>

                    <form action="{{ route('drive.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                placeholder="Enter file title" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                placeholder="Short description" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="file" :value="__('File')" />
                            <input id="file" name="file" type="file"
                                class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>

                        <div class="flex items-center justify-center pt-4">
                            <button
                                class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-600/20">
                                <i class="fas fa-upload mr-2"></i> {{ __('Create New File') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>