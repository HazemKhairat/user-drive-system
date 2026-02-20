<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <i class="fas fa-user-shield text-blue-600 mr-2"></i> {{ __('Edit User Role') }}
            </h2>
            <a href="{{ route('listUsers') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to Users') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- User Context Banner --}}
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex items-center shadow-sm">
                <div
                    class="h-12 w-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xl mr-4 border-2 border-white shadow-md">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-blue-900 uppercase tracking-wider">{{ __('Target User') }}
                    </h3>
                    <div class="flex items-center mt-1">
                        <span class="text-lg font-bold text-slate-800">{{ $user->name }}</span>
                        <span class="mx-2 text-slate-300">|</span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-white text-blue-700 border border-blue-200 shadow-sm">
                            {{ $user->rule->title }}
                        </span>
                    </div>
                </div>
            </div>

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

            {{-- Form Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200">
                <div class="p-8 bg-white border-b border-slate-200">
                    <div class="flex items-center space-x-2 mb-8">
                        <i class="fas fa-user-tag text-slate-400"></i>
                        <h3 class="text-lg font-medium text-slate-800">{{ __('Assign New Role') }}</h3>
                    </div>

                    <form action="{{ route('update_rule', $user->id) }}" method="POST" class="space-y-8">
                        @csrf

                        <div>
                            <x-input-label for="roleSelect" :value="__('Select Role')" />
                            <div class="relative mt-2">
                                <select name="rule_id" id="roleSelect"
                                    class="block w-full bg-slate-50 border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition duration-150 py-3 pl-4 pr-10 text-slate-700 font-medium appearance-none"
                                    required>
                                    @foreach ($rules as $rule)
                                        @if ($rule->id != 1)
                                            <option value="{{ $rule->id }}" {{ $user->rule->id == $rule->id ? 'selected' : '' }}>
                                                {{ $rule->title }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-slate-500 italic">
                                <i class="fas fa-info-circle mr-1"></i>
                                {{ __("Updating as Super Admin. Role changes take effect immediately.") }}
                            </p>
                        </div>

                        <div class="flex items-center justify-center pt-4">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-blue-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-600/20">
                                <i class="fas fa-save mr-2 text-lg"></i> {{ __('Update User Role') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>