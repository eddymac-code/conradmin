<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- @auth
                    <a data-bs-toggle="offcanvas" href="#admin-menu"><i class="fa-solid fa-bars" style="color: #222020;"></i></a>
                @endauth --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            DASHBOARD
                        </a>
                        @can('services.access')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell-concierge"></i> SERVICES
                            </a>
                            <ul class="dropdown-menu">
                              @can('bars.access')
                              <li><a class="dropdown-item" href="{{ route('bars') }}">Bars and Lounge</a></li>
                              @endcan
                              @can('restaurants.access')
                              <li><a class="dropdown-item" href="">Restaurant</a></li>
                              @endcan
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="">Conference Facilities</a></li>
                              <li><a class="dropdown-item" href="{{ route('rooms') }}">Rooms</a></li>
                              @can ('roomtypes.access')
                              <li><a class="dropdown-item" href="{{ route('rooms.types') }}">Room Types</a></li>
                              <li><a class="dropdown-item" href="{{ route('amenities') }}">Amenities</a></li>
                              @endcan
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="">Grounds</a></li>
                              <li><a class="dropdown-item" href="">Swimming Pool</a></li>
                            </ul>
                        </li>
                        @endcan
                        @can('users.access')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-users"></i> USERS
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('users') }}">View</a></li>
                              <li><a class="dropdown-item" href="{{ route('users.create') }}">Create New</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="{{ route('roles') }}">Roles</a></li>
                              <li><a class="dropdown-item" href="{{ route('permissions') }}">Permissions</a></li>
                            </ul>
                        </li>
                        @endcan
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @can('settings.access')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-gears mr-3"></i> SETTINGS
                                </a>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('settings') }}">Details</a></li>
                                @can('pages.access')
                                    <li><a class="dropdown-item" href="{{ route('pages') }}">Page Settings</a></li>
                                @endcan
                                </ul>
                            </li>
                            @endcan
                        @endauth
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- @include('left-menu.admin') --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('footer-scripts')
</body>
</html>
