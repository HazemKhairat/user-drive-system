<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container px-3">
        <!-- Logo and Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="{{ route('dashboard') }}">
            <img src="https://cdn-icons-png.flaticon.com/512/3771/3771391.png" alt="Logo" width="30" height="30" class="me-2">
            MyDrive
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Content -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @php
                    $navItems = [
                        ['Dashboard', 'dashboard'],
                        ['Your Drives', 'drive.index'],
                        ['Public Drives', 'drive.publicDrive'],
                        ['All Users', 'listUsers'],
                        ['Users Rule', 'rule.index'],
                    ];
                @endphp
                @foreach ($navItems as [$label, $route])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($route) ? 'active fw-bold text-primary' : '' }}"
                           href="{{ route($route) }}">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="Avatar" width="32" height="32" class="rounded-circle me-2">
                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
