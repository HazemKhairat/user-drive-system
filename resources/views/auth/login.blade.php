<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Branding/Illustration (Hidden on Mobile) -->
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-800 text-white p-12 flex-col justify-between relative overflow-hidden">
            <!-- Decorative shapes -->
            <div class="absolute -top-24 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <a href="/" class="text-3xl font-extrabold tracking-tighter flex items-center">
                    <div
                        class="w-10 h-10 bg-white text-blue-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                            </path>
                        </svg>
                    </div>
                    MyDrive
                </a>
            </div>

            <div class="relative z-10 max-w-lg">
                <h1 class="text-5xl font-bold leading-tight mb-6">
                    Simplify your digital storage today.
                </h1>
                <p class="text-xl text-blue-100/90 leading-relaxed">
                    Join thousands of users who trust MyDrive for their secure file storage and seamless sharing needs.
                </p>
            </div>

            <div class="relative z-10">
                <p class="text-sm text-blue-200/80">
                    Developed by <span class="text-white font-semibold">Hazem Khayrat</span>
                </p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-10 lg:hidden">
                    <h2 class="text-3xl font-extrabold text-blue-600">MyDrive</h2>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-slate-800">Welcome Back</h2>
                    <p class="text-slate-500 mt-2">Sign in to manage your files</p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div
                        class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-100 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username" placeholder="you@example.com"
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-bold text-blue-600 hover:text-blue-500 transition-colors">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required
                                autocomplete="current-password" placeholder="••••••••"
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('password') border-red-500 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input
                            class="w-4 h-4 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500 focus:ring-2 transition-all"
                            type="checkbox" name="remember" id="remember">
                        <label class="ml-2 text-sm text-slate-500 font-medium cursor-pointer" for="remember">
                            Stay signed in
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-4 rounded-2xl text-lg font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 active:scale-[0.98]">
                            Login to MyDrive
                        </button>
                    </div>

                    <div class="text-center mt-6">
                        <p class="text-sm text-slate-500 font-medium">
                            Don't have an account?
                            <a href="{{ route('register') }}"
                                class="text-blue-600 font-bold hover:underline transition-all">Create one now</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>