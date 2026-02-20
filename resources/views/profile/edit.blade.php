<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            <i class="fas fa-user-circle text-blue-600 mr-2"></i> {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Profile Information --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-2xl border border-slate-200">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Change Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-2xl border border-slate-200">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-2xl border border-slate-200">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>