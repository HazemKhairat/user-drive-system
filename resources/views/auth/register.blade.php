<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Branding/Illustration (Hidden on Mobile) -->
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-700 via-indigo-600 to-blue-800 text-white p-12 flex-col justify-between relative overflow-hidden">
            <!-- Decorative shapes -->
            <div class="absolute -bottom-24 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-0 left-0 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <a href="/" class="text-3xl font-extrabold tracking-tighter flex items-center">
                    <div
                        class="w-10 h-10 bg-white text-indigo-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
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
                    Your files, everywhere.
                </h1>
                <p class="text-xl text-indigo-100/90 leading-relaxed">
                    Create an account to experience the most intuitive way to store, organize, and share your digital
                    assets.
                </p>
            </div>

            <div class="relative z-10">
                <p class="text-sm text-indigo-200/80">
                    Developed by <span class="text-white font-semibold">Hazem Khayrat</span>
                </p>
            </div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-10 lg:hidden text-center">
                    <h2 class="text-3xl font-extrabold text-blue-600">MyDrive</h2>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-slate-800">Create Account</h2>
                    <p class="text-slate-500 mt-2">Join MyDrive and start managing your files</p>
                </div>

                <form enctype="multipart/form-data" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="John Doe"
                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="john@example.com"
                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Profile Image --}}
                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Profile Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image"
                                class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all group overflow-hidden">
                                <div class="flex items-center space-x-3 p-4">
                                    <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <div class="text-left">
                                        <p class="text-sm text-slate-500"><span class="font-bold">Click to upload</span>
                                        </p>
                                        <p class="text-xs text-slate-400 text-center">PNG, JPG or GIF</p>
                                    </div>
                                </div>
                                <input type="file" id="image" name="image" class="hidden" />
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Password --}}
                        <div>
                            <label for="password"
                                class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                            <input type="password" id="password" name="password" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-slate-700 mb-1">Confirm</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                autocomplete="new-password" placeholder="••••••••"
                                class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('password_confirmation') border-red-500 @enderror">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-4 rounded-2xl text-lg font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 active:scale-[0.98]">
                            Register for MyDrive
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-sm text-slate-500 font-medium">
                            Already have an account?
                            <a href="{{ route('login') }}"
                                class="text-blue-600 font-bold hover:underline transition-all">Sign in here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>