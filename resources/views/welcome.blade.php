<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Beautiful File Uploading</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 font-sans text-slate-900">
    <div class="relative min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <span
                            class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            MyDrive
                        </span>
                    </div>
                    <div class="hidden sm:flex space-x-8 items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-blue-600 text-white px-5 py-2.5 rounded-full font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">Get
                                        Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-20 pb-32 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute -top-24 -left-20 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
                <div class="absolute top-1/2 -right-20 w-80 h-80 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
                    Manage Your Files with <br />
                    <span class="text-blue-600">Style & Ease</span>
                </h1>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                    The modern, secure, and lightning-fast way to store and share your documents. Built for individuals
                    and teams who value design as much as functionality.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-8 py-4 rounded-2xl text-lg font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 flex items-center justify-center">
                        Start Uploading Free
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#features"
                        class="bg-white text-slate-700 border border-slate-200 px-8 py-4 rounded-2xl text-lg font-semibold hover:bg-slate-50 transition-all shadow-sm flex items-center justify-center">
                        Learn More
                    </a>
                </div>
            </div>
        </header>

        <!-- Features Grid -->
        <section id="features" class="py-24 bg-white border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4">Everything you need</h2>
                    <p class="text-slate-500">Powerful features to keep your digital life organized.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-3xl bg-slate-50 hover:bg-blue-50 transition-colors group">
                        <div
                            class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Instant Uploads</h3>
                        <p class="text-slate-600">Drag and drop any file type. Our system handles processing in the
                            background while you work.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-3xl bg-slate-50 hover:bg-blue-50 transition-colors group">
                        <div
                            class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Bank-Grade Security</h3>
                        <p class="text-slate-600">Your files are encrypted at rest and in transit. Only you decide who
                            gets access.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-3xl bg-slate-50 hover:bg-blue-50 transition-colors group">
                        <div
                            class="w-12 h-12 bg-purple-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Version Control</h3>
                        <p class="text-slate-600">Never lose a draft again. Access previous versions of your documents
                            anytime.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-br from-blue-600 to-indigo-700 text-white text-center">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-extrabold mb-8">Ready to simplify your storage?</h2>
                <a href="{{ route('register') }}"
                    class="inline-block bg-white text-blue-600 px-10 py-4 rounded-2xl text-xl font-bold hover:bg-slate-100 transition-all shadow-xl">
                    Create Your Account
                </a>
                <p class="mt-6 text-blue-100 opacity-80">Free 2GB for all new accounts. No credit card required.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-auto py-12 bg-slate-900 text-slate-400">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>© {{ date('Y') }} MyDrive. Built with ❤️ by <span class="text-white font-semibold">Hazem
                        Khayrat</span></p>
            </div>
        </footer>
    </div>
</body>

</html>