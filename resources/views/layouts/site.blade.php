<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? '' }} | {{ config('app.name') }}</title>

    <link rel="icon" href="{{ asset('/img/favicon.ico') }}" type="image/x-icon"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}"
        rel="stylesheet" type="text/css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
        type="text/css">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- JS Loaded First -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    @yield('head')
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}"
                        href="{{ url('/') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Calendar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/calendar') }}">View Calendar</a>
                            <a class="dropdown-item" href="{{ url('/calendar/edit') }}">Edit Calendar</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('gallery')) ? 'active' : '' }}"
                            href="{{ url('/gallery') }}">Gallery</a>
                    </li>
                @endauth
            </ul>
            <div class="float-right">
                @guest
                    <a class="btn btn-outline-primary" href="{{ url('login') }}">Login</a>
                    <a class="btn btn-outline-primary" href="{{ url('register') }}">Register</a>
                @endguest
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}!
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="content">
            @yield('content')
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer bg-light mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item">
                            <a href="#">About</a>
                        </li>
                        <li class="list-inline-item">&sdot;</li>
                        <li class="list-inline-item">
                            <a href="#">Contact</a>
                        </li>
                        <li class="list-inline-item">&sdot;</li>
                        <li class="list-inline-item">
                            <a href="#">Terms of Use</a>
                        </li>
                        <li class="list-inline-item">&sdot;</li>
                        <li class="list-inline-item">
                            <a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">Copyright &copy; Joe Alderdice {{ now()->year }}</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="{{ url('/truckersmp')}}">
                                <i class="fas fa-question fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="{{ url('/discord') }}">
                                <i class="fab fa-discord fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="{{ url('/twitter') }}">
                                <i class="fab fa-twitter fa-2x fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
</body>

</html>
