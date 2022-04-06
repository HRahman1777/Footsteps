<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (Request::is('/'))
        <title>{{ config('app.name') }}</title>
    @endif
    @if (!Request::is('/'))
        <title> {{ Request::path() }} | {{ config('app.name') }}</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body style="background-color: white">
    <div id="app">

        <!-- top navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light nav-footer-bg fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                    aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Footsteps</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <div class="d-flex">
                        @guest
                            @if (Route::has('login') || Route::has('register'))
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                </ul>
                            @endif
                        @else
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-bell-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="#">Notification title</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">See More</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">{{ Auth::user()->username }}</a></li>
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
        <!-- top navigation bar -->
        <!-- offcanvas -->
        <div class="offcanvas offcanvas-start sidebar-nav bg-light" tabindex="-1" id="sidebar">
            <div class="offcanvas-body p-0">
                <nav class="navbar-light">
                    <ul class="navbar-nav mx-1">
                        <li class="mt-2">
                            <a href="{{ route('home') }}"
                                class="btn btn-outline-secondary px-3 rounded {{ Request::is('home') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                                <h1 class="pt-1"><i class="bi bi-house-fill"></i></h1>
                            </a>
                        </li>
                        <li class="mt-2">
                            <a href="{{ route('all.post') }}"
                                class="btn btn-outline-secondary px-3 rounded {{ Request::is('explore') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" data-bs-placement="right" title="All Post">
                                <h1 class="pt-2"><i class="bi bi-card-list"></i></h1>
                            </a>
                        </li>
                        <li class="my-4">
                            <hr class="dropdown-divider bg-dark" />
                        </li>
                        <li>
                            <a href="{{ route('about') }}"
                                class="btn btn-outline-secondary px-3 rounded {{ Request::is('about') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" data-bs-placement="right" title="About">
                                <h1 class="pt-2"><i class="bi bi-info-circle-fill"></i></h1>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- offcanvas -->

        <main class="mt-2 mb-4 pb-4">
            <div class="container-fluid" style="margin-top: 4rem">
                @yield ('content')
            </div>
        </main>

        <!-- footer -->
        <footer
            class="px-4 pt-4 text-center nav-footer-bg {{ Request::is('/') || Request::is('login') || Request::is('register') ? 'fixed-bottom' : '' }}">
            <div class="container">
                <h3>Footsteps | Lets Grow Together</h3>
                <hr />
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <a class="nav-link" href="#">
                                    <span>Privacy Policy</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="#">
                                    <span>Terms of Use</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-muted">Footsteps © HRahman1777</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer -->

    </div>


    @yield ('script')
</body>

</html>
