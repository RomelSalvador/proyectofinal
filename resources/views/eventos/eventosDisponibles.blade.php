@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Eventos Disponibles</h2>

    @if($eventos->isEmpty())
        <div class="alert alert-info text-center">No hay eventos disponibles.</div>
    @else
        <div class="row">
            @foreach($eventos as $evento)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $evento->titulo }}</h5>
                            <p class="card-text">{{ $evento->descripcion }}</p>
                            <p><strong>Tipo:</strong> {{ ucfirst($evento->tipo) }}</p>
                            <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                            <p><strong>Hora:</strong> {{ $evento->hora }}</p>
                            <p><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
                            <p><strong>Aforo:</strong> {{ $evento->aforo }}</p>
                            <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Inscribirse</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
