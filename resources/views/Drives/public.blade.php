<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            <i class="fas fa-globe text-blue-600 mr-2"></i> {{ __('Public Drives') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Message --}}
            @if (Session::has('done'))
                <div x-data="{ show: true }" x-show="show"
                    class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-2xl bg-green-50 shadow-sm"
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
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-list text-slate-400"></i>
                        <h3 class="text-lg font-medium text-slate-800">{{ __('Public Files List') }}</h3>
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
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    View
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Edit
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Delete
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
                                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 border border-blue-100 shadow-sm">
                                                <i class="fas fa-file-alt text-lg"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-slate-900 truncate max-w-xs"
                                                    title="{{ $item->title }}">
                                                    {{ $item->title }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->user_id == Auth::id())
                                            <a href="{{ route('drive.change_status', $item->id) }}"
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->status === 'private' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} transition-colors hover:opacity-80 shadow-sm border {{ $item->status === 'private' ? 'border-red-200' : 'border-green-200' }}">
                                                <i
                                                    class="fas fa-{{ $item->status === 'private' ? 'lock' : 'globe' }} mr-1.5 text-[10px]"></i>
                                                {{ ucfirst($item->status) }}
                                            </a>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500 border border-slate-200 opacity-60">
                                                <i class="fas fa-lock text-[10px] mr-1.5"></i> Not Allowed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('drive.show', $item->id) }}"
                                            class="inline-flex items-center p-2 text-blue-600 hover:bg-blue-50 focus:outline-none rounded-xl transition-colors"
                                            title="View Details">
                                            <i class="fas fa-eye text-lg"></i>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($item->user_id == Auth::id())
                                            <a href="{{ route('drive.edit', $item->id) }}"
                                                class="inline-flex items-center p-2 text-amber-600 hover:bg-amber-50 focus:outline-none rounded-xl transition-colors"
                                                title="Edit File">
                                                <i class="fas fa-edit text-lg"></i>
                                            </a>
                                        @else
                                            <i class="fas fa-minus text-slate-300"></i>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($item->user_id == Auth::id())
                                            <a href="{{ route('drive.destroy', $item->id) }}"
                                                class="inline-flex items-center p-2 text-red-600 hover:bg-red-50 focus:outline-none rounded-xl transition-colors"
                                                onclick="return confirm('Are you sure?')" title="Delete File">
                                                <i class="fas fa-trash-alt text-lg"></i>
                                            </a>
                                        @else
                                            <i class="fas fa-minus text-slate-300"></i>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <div class="mb-4 bg-slate-50 p-6 rounded-full shadow-inner">
                                                <i class="fas fa-folder-open text-5xl text-slate-300"></i>
                                            </div>
                                            <h4 class="text-lg font-bold text-slate-800 mb-1">No public files available</h4>
                                            <p class="text-sm text-slate-500 mb-6">Try uploading a new file or check again
                                                later.</p>
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
                        {{ $drives->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>