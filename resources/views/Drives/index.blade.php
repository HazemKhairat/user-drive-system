<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <i class="fas fa-cloud-upload-alt text-blue-600 mr-2"></i> {{ __('Your Drives') }}
            </h2>
            <a href="{{ route('drive.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-600/20">
                <i class="fas fa-plus-circle mr-2"></i> {{ __('New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div x-data="{ show: true }" x-show="show"
                    class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-2xl bg-green-50"
                    role="alert">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    <span class="sr-only">Success</span>
                    <div class="font-medium">
                        {{ Session::get('done') }}
                    </div>
                    <button @click="show = false" type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                        <span class="sr-only">Close</span>
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
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-list text-slate-400"></i>
                            <h3 class="text-lg font-medium text-slate-800">{{ __('File List') }}</h3>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <form method="GET" action="{{ route('drive.index') }}" class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-search text-slate-400 text-sm"></i>
                                </span>
                                <input type="text" name="search"
                                    class="block w-full sm:w-64 pl-10 pr-3 py-2 border border-slate-300 rounded-xl leading-5 bg-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="Search files..." value="{{ request('search') }}">
                            </form>

                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" type="button"
                                    class="inline-flex justify-center w-full rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150"
                                    id="filter-menu-button">
                                    <i class="fas fa-filter mr-2 text-slate-400"></i>
                                    Filter
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-2xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none z-10"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="py-1">
                                        <a href="{{ route('drive.index') }}"
                                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">All
                                            Files</a>
                                        <a href="{{ route('drive.index', ['status' => 'public']) }}"
                                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Public</a>
                                        <a href="{{ route('drive.index', ['status' => 'private']) }}"
                                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Private</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    File
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Status
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($drives as $item)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-400">
                                        {{ $item->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                                <i class="fas fa-file-alt text-lg"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-slate-900 truncate max-w-xs"
                                                    title="{{ $item->title }}">
                                                    {{ $item->title }}
                                                </div>
                                                <div class="text-xs text-slate-500">
                                                    @if($item->created_at)
                                                        Uploaded {{ $item->created_at->diffForHumans() }}
                                                    @else
                                                        Upload date not available
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('drive.change_status', $item->id) }}"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->status === 'private' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} transition-colors hover:opacity-80">
                                            <i
                                                class="fas fa-{{ $item->status === 'private' ? 'lock' : 'globe' }} mr-1.5 text-[10px]"></i>
                                            {{ ucfirst($item->status) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open"
                                                class="text-slate-400 hover:text-slate-600 focus:outline-none p-2 rounded-full hover:bg-slate-100 transition-colors">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <div x-show="open" @click.away="open = false"
                                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-2xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95">
                                                <div class="py-2 px-1">
                                                    <a href="{{ route('drive.show', $item->id) }}"
                                                        class="group flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                                                        <i
                                                            class="fas fa-eye mr-3 text-slate-400 group-hover:text-blue-500"></i>
                                                        View
                                                    </a>
                                                    <a href="{{ route('drive.edit', $item->id) }}"
                                                        class="group flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-amber-50 hover:text-amber-700 rounded-xl transition-colors">
                                                        <i
                                                            class="fas fa-edit mr-3 text-slate-400 group-hover:text-amber-500"></i>
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('drive.destroy', $item->id) }}"
                                                        class="group flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-xl transition-colors"
                                                        onclick="return confirm('Are you sure you want to delete this file?')">
                                                        <i
                                                            class="fas fa-trash-alt mr-3 text-red-400 group-hover:text-red-500"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <div class="mb-4 bg-slate-50 p-6 rounded-full">
                                                <i class="fas fa-folder-open text-5xl text-slate-300"></i>
                                            </div>
                                            <h4 class="text-lg font-bold text-slate-800 mb-1">No files found</h4>
                                            <p class="text-sm text-slate-500 mb-6">Get started by uploading your first file.
                                            </p>
                                            <a href="{{ route('drive.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150 shadow-lg shadow-blue-600/20">
                                                <i class="fas fa-plus-circle mr-2"></i> Upload File
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($drives->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                        {{ $drives->appends(request()->query())->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>