<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Gestión de Eventos'))</title>

    <!-- Fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts y estilos compilados -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Menú izquierdo -->
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->rol === 'administrador')
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('eventos/create') ? 'fw-bold' : '' }}" href="{{ route('eventos.create') }}">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('inscripciones/create') ? 'fw-bold' : '' }}" href="{{ route('inscripciones.create') }}">Inscripciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('recursos/create') ? 'fw-bold' : '' }}" href="{{ route('recursos.create') }}">Recursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('asignarRecursos/create') ? 'fw-bold' : '' }}" href="{{ route('asignarRecursos.create') }}">Asignar Recursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('recursos/create') ? 'fw-bold' : '' }}" href="{{ route('inscripciones.index') }}">Mostrar Inscripciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('recursos/create') ? 'fw-bold' : '' }}" href="{{ route('eventos.index') }}">Mostrar Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('recursos/create') ? 'fw-bold' : '' }}" href="{{ route('recursos.index') }}">Mostrar Recursos</a>
                            </li>
                        @elseif(Auth::user()->rol === 'participante')
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('inscripciones/create') ? 'fw-bold' : '' }}" href="{{ route('inscripciones.create') }}">Inscribirse a Evento</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Request::is('inscripciones/create') ? 'fw-bold' : '' }}" href="{{ route('eventos.index') }}">Eventos Disponibles</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Menú derecho -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                {{-- <a class="dropdown-item" href="#">Mi perfil</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
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

    <!-- Contenido principal -->
    <main class="py-4 container">
        @yield('content')
    </main>
</div>
</body>
</html>
