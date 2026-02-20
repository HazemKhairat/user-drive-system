<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <i class="fas fa-gavel text-blue-600 mr-2"></i> {{ __('All Roles') }}
            </h2>
            <a href="{{ route('rule.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-600/20">
                <i class="fas fa-plus-circle mr-2"></i> {{ __('Create New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Success Message --}}
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
                                    Title
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach ($rules as $item)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">{{ $item->title }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-600 line-clamp-1 max-w-xs"
                                            title="{{ $item->description }}">
                                            {{ $item->description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('rule.edit', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-amber-500 text-amber-600 rounded-xl hover:bg-amber-50 transition-colors">
                                                <i class="fas fa-edit mr-1.5"></i> Edit
                                            </a>
                                            <a href="{{ route('rule.destroy', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-red-500 text-red-600 rounded-xl hover:bg-red-50 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                <i class="fas fa-trash-alt mr-1.5"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($rules->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                        {{ $rules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>