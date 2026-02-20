<x-app-layout>
    <div class="space-y-8">
        {{-- Welcome Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Welcome back, {{ Auth::user()->name }}!
                </h2>
                <p class="text-slate-500 mt-1">
                    {{ Auth::user()->rule_id != 3 ? 'Here is what is happening across the system today.' : 'Manage your files and track your storage activity.' }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span
                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-slate-200 text-slate-600 shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ now()->format('D, M j, Y') }}
                </span>
            </div>
        </div>

        @if(Auth::user()->rule_id != 3)
            {{-- ADMIN DASHBOARD --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Stats Card --}}
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Users</span>
                    </div>
                    <div class="flex items-baseline">
                        <h3 class="text-3xl font-bold text-slate-900">{{ $usersCount }}</h3>
                        <span class="ml-2 text-xs font-medium text-emerald-500 inline-flex items-center">
                            <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            System-wide
                        </span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Files</span>
                    </div>
                    <div class="flex items-baseline">
                        <h3 class="text-3xl font-bold text-slate-900">{{ $drivesCount }}</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Public Ratio</span>
                    </div>
                    <div class="flex items-baseline">
                        <h3 class="text-3xl font-bold text-slate-900">
                            {{ round(($storageBreakdown['public'] / max($drivesCount, 1)) * 100) }}%
                        </h3>
                        <span class="ml-2 text-xs font-medium text-slate-500">of all storage</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Growth</span>
                    </div>
                    <div class="flex items-baseline">
                        <h3 class="text-3xl font-bold text-slate-900">+{{ $regularUsers }}</h3>
                        <span class="ml-2 text-xs font-medium text-slate-500 text-truncate">New registrations</span>
                    </div>
                </div>
            </div>

            {{-- Recent Users Section --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Recently Active Users</h3>
                    <a href="{{ route('listUsers') }}" wire:navigate
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700">View
                        All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">User</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Role</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Date Joined
                                </th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($latestUsers as $user)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 border-2 border-white shadow-sm">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-slate-900">{{ $user->name }}</div>
                                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4">
                                        <span
                                            class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold {{ $user->rule_id != 3 ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $user->rule->title ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 text-sm text-slate-500">
                                        {{ $user->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-8 py-4">
                                        <button class="text-slate-400 hover:text-blue-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            {{-- USER DASHBOARD --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- User Stats --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div
                            class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between">
                            <div
                                class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Files</h4>
                                <h3 class="text-3xl font-extrabold text-slate-900">{{ $userDrivesCount }}</h3>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between">
                            <div
                                class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-.588-8.243-1.582m15.686 0a22.505 22.505 0 01-15.686 0">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Public Files</h4>
                                <h3 class="text-3xl font-extrabold text-slate-900">{{ $userPublicCount }}</h3>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between">
                            <div
                                class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Private Files
                                </h4>
                                <h3 class="text-3xl font-extrabold text-slate-900">{{ $userPrivateCount }}</h3>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Activity Feed --}}
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 border-b border-slate-100">
                            <h3 class="text-lg font-bold text-slate-900">Your Recent Activity</h3>
                        </div>
                        <div class="p-8">
                            <div class="space-y-8">
                                @forelse($latestUserDrives as $drive)
                                    <div class="flex items-start">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 mr-4 shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-slate-900 truncate">{{ $drive->title }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Uploaded
                                                {{ $drive->created_at->diffForHumans() }} • <span
                                                    class="{{ $drive->status === 'public' ? 'text-emerald-500' : 'text-rose-500' }}">{{ ucfirst($drive->status) }}</span>
                                            </p>
                                        </div>
                                        <a href="{{ route('drive.show', $drive->id) }}"
                                            class="text-blue-500 hover:text-blue-600 ml-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <div
                                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-slate-900 font-bold">No activity yet</h4>
                                        <p class="text-slate-500 text-sm mt-1">Start by uploading your first file to MyDrive.
                                        </p>
                                        <a href="{{ route('drive.create') }}" wire:navigate
                                            class="inline-flex mt-6 px-6 py-2 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition">Upload
                                            Now</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar/Contextual Card --}}
                <div class="space-y-8">
                    <div
                        class="bg-gradient-to-br from-blue-600 to-indigo-700 p-8 rounded-3xl text-white shadow-lg shadow-blue-600/20">
                        <h3 class="text-xl font-bold mb-2">Storage Summary</h3>
                        <p class="text-blue-100 text-sm mb-6">You've used 40% of your current plan's storage limit.</p>

                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center justify-between text-xs font-bold mb-2">
                                    <span>Cloud Storage</span>
                                    <span>2.4 GB / 5 GB</span>
                                </div>
                                <div class="w-full bg-blue-900/30 rounded-full h-2 overflow-hidden">
                                    <div class="bg-white h-full rounded-full" style="width: 48%"></div>
                                </div>
                            </div>
                            <button
                                class="w-full py-3 bg-white text-blue-600 rounded-2xl text-sm font-bold shadow-xl shadow-blue-950/20 hover:scale-[1.02] transition-transform">Upgrade
                                Storage</button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                        <h4 class="text-sm font-bold text-slate-900 mb-4">Quick Links</h4>
                        <div class="space-y-2">
                            <a href="{{ route('drive.index') }}" wire:navigate
                                class="flex items-center p-3 rounded-2xl hover:bg-slate-50 transition-colors group">
                                <div
                                    class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">Browse
                                    Files</span>
                            </a>
                            <a href="{{ route('drive.publicDrive') }}" wire:navigate
                                class="flex items-center p-3 rounded-2xl hover:bg-slate-50 transition-colors group">
                                <div
                                    class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">Public
                                    Explorer</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>