<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            <i class="fas fa-users-cog text-blue-600 mr-2"></i> {{ __('User Management') }}
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
                        <i class="fas fa-table text-slate-400"></i>
                        <h3 class="text-lg font-medium text-slate-800">{{ __('Users Registry') }}</h3>
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
                                    User info
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Current Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach ($users as $item)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-400">
                                        {{ $item->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-slate-100 text-slate-600 border border-slate-200 uppercase font-bold text-sm">
                                                {{ substr($item->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-slate-900">{{ $item->name }}</div>
                                                <div class="text-xs text-slate-500">{{ $item->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->rule_id == 1 ? 'bg-blue-100 text-blue-800 border-blue-200' : ($item->rule_id == 2 ? 'bg-indigo-100 text-indigo-800 border-indigo-200' : 'bg-slate-100 text-slate-800 border-slate-200') }} border">
                                            <i class="fas fa-shield-alt mr-1.5 text-[10px]"></i>
                                            {{ $item->rule->title }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-3">
                                            @if ($item->id != 1)
                                                <a href="{{ route('edit_user_rule', $item->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition-colors">
                                                    <i class="fas fa-user-edit mr-1.5"></i> Edit Role
                                                </a>
                                                <form action="{{ route('delete_user', $item->id) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 border border-red-500 text-red-600 rounded-xl hover:bg-red-50 transition-colors">
                                                        <i class="fas fa-trash-alt mr-1.5"></i> Delete
                                                    </button>
                                                </form>
                                            @else
                                                <div class="inline-flex items-center px-4 py-1.5 bg-slate-100 text-slate-400 rounded-xl cursor-not-allowed border border-slate-200"
                                                    title="System Protection Active">
                                                    <i class="fas fa-lock mr-2"></i> Protected
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>