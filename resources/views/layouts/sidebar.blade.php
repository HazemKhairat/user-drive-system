<div x-data="{ open: false }" class="relative">
    <!-- Mobile Top Bar -->
    <div
        class="lg:hidden flex items-center justify-between bg-white border-b border-slate-200 px-4 py-3 sticky top-0 z-30">
        <span
            class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">MyDrive</span>
        <button @click="open = !open"
            class="text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg p-1">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Sidebar Container -->
    <aside
        :class="{'translate-x-0 transition-all duration-300': open, '-translate-x-full transition-all duration-300': !open}"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 lg:translate-x-0 lg:sticky lg:top-0 h-screen flex flex-col shadow-2xl">

        <!-- Branding -->
        <div class="px-8 py-10 flex items-center justify-between">
            <a href="/" wire:navigate class="flex items-center space-x-3 group">
                <div
                    class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-900/50 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                        </path>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white tracking-tight italic">MyDrive</span>
            </a>
            <!-- Close button for mobile -->
            <button @click="open = false" class="lg:hidden text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
            @php
                $navItems = [
                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['label' => 'Your Drives', 'route' => 'drive.index', 'icon' => 'M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9l-2-2H5a2 2 0 01-2 2v10a2 2 0 012 2z'],
                    ['label' => 'Public Drives', 'route' => 'drive.publicDrive', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'],
                    ['label' => 'All Users', 'route' => 'listUsers', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'isAdmin' => true],
                    ['label' => 'Users Rule', 'route' => 'rule.index', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'isSuperAdmin' => true],
                ];
            @endphp
            @foreach ($navItems as $item)
                @php
                    $isAdminOnly = $item['isAdmin'] ?? false;
                    $isUserAdmin = Auth::user()->rule_id != 3;
                    $isSuperAdmin = Auth::user()->rule_id == 1;
                @endphp

                @if(Route::has($item['route']) && (!$isAdminOnly || $isUserAdmin))
                    @if(isset($item['isSuperAdmin']) && !$isSuperAdmin)
                        @continue
                    @endif
                    <a href="{{ route($item['route']) }}" wire:navigate
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-2xl transition-all duration-200 {{ request()->routeIs($item['route']) ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="h-6 w-6 mr-3 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                            </path>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
        </nav>

        <!-- User Profile Section -->
        <div class="p-4 border-t border-slate-800/50">
            <div class="bg-slate-800/50 rounded-2xl p-4">
                <div class="flex items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff"
                        alt="Avatar" class="w-10 h-10 rounded-xl mr-3 border-2 border-slate-700">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">Standard Plan</p>
                    </div>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" wire:navigate
                        class="flex items-center px-3 py-2 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-700 rounded-xl transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Edit Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-3 py-2 text-xs font-semibold text-red-400 hover:text-white hover:bg-red-600/20 rounded-xl transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div x-show="open" @click="open = false"
        class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>
</div>