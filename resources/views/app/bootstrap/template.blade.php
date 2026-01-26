<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">
        <!-- directiva -->
        <title>
            @yield('title', 'Barber Shop')
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
        @yield('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">@yield('navbar', 'Barber Shop App')</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('about') }}">About</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peinado.create') }}">Add hairstyle</a>
                        </li>
                        @endauth
                        @if(Auth::user() != null && Auth::user()->rol == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">Listado</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.create') }}">Crear usuario</a></li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Peinado
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('peinado.index') }}">Peinados</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('peinado.create') }}">Create</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="get" action="{{ route('main') }}">
                        @foreach(request()->except(['page', 'q']) as $item => $value)
                            <input type="hidden" name="{{ $item }}" value="{{ $value }}" >
                        @endforeach
                        <input name="q" value="{{ $q ?? '' }}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="#" id="logout-link">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('home') }}">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container my-5">

            <!-- mostrar mensajes de éxito -->
            @if(session('mensajeTexto'))
                <div class="alert alert-success">
                    {{ session('mensajeTexto') }}
                </div>
            @endif

            <!-- mostrar mensajes de error -->
            @error('mensajeTexto')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            @yield('modalcontent')

            @yield('content')

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/main.js') }}"></script>
        @yield('scritps')
    </body>
</html>