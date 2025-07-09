@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0"></h2>

        {{-- Filtro por tipo --}}
        <form method="GET" action="{{ route('eventos.disponibles') }}" class="d-flex">
            <select name="tipo" class="form-select me-2">
                <option value="">Todos</option>
                <option value="cultural" {{ request('tipo') == 'cultural' ? 'selected' : '' }}>Cultural</option>
                <option value="deportivo" {{ request('tipo') == 'deportivo' ? 'selected' : '' }}>Deportivo</option>
                <option value="social" {{ request('tipo') == 'social' ? 'selected' : '' }}>Social</option>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>

    @if($eventos->isEmpty())
        <div class="alert alert-info text-center">No hay eventos disponibles.</div>
    @else
        <div class="row">
            @foreach($eventos as $evento)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        @if($evento->imagen)
                            <img src="{{ asset('storage/' . $evento->imagen) }}" 
                                alt="Imagen del evento" 
                                class="card-img-top" 
                                style="height: 350px; width: 100%; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $evento->titulo }}</h5>
                            <p class="card-text">{{ $evento->descripcion }}</p>
                            <p><strong>Tipo:</strong> {{ ucfirst($evento->tipo) }}</p>
                            <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                            <p><strong>Hora:</strong> {{ $evento->hora }}</p>
                            <p><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
                            <p><strong>Aforo:</strong> {{ $evento->aforo }}</p>
                            <p><strong>Precio:</strong> S/ {{ number_format($evento->precio, 2) }}</p>
                            <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Inscribirse</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
