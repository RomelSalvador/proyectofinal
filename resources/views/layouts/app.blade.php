<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Gestión de Eventos'))</title>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts y estilos compilados (Vite) -->
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
                                <a class="nav-link text-white" href="{{ route('eventos.create') }}">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('eventos.index') }}">Mostrar Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('inscripciones.index') }}">Ver Inscripciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('recursos.index') }}">Mostrar Recursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('asignarRecursos.create') }}">Asignar Recursos</a>
                            </li>
                        @elseif(Auth::user()->rol === 'participante')
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('eventos.disponibles') }}">Eventos Disponibles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('inscripciones.index') }}">Ver mis inscripciones</a>
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
                        <!-- Notificaciones -->
                        <li class="nav-item dropdown">
                            <a id="notificationsDropdown" class="nav-link text-white position-relative" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-bell-fill fs-5"></i>
                                @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @forelse(Auth::user()->notifications->take(5) as $notification)
                                    <a class="dropdown-item" href="#">
                                        {{ $notification->data['mensaje'] ?? 'Nueva notificación' }}
                                        <br>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </a>
                                @empty
                                    <span class="dropdown-item text-muted">No tienes notificaciones.</span>
                                @endforelse
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-primary" href="#">Ver todas</a>
                            </div>
                        </li>

                        <!-- Usuario -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-4"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
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

<!-- Librerías al final del body -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script adicional desde cada página -->
@yield('scripts')
</body>
</html>
