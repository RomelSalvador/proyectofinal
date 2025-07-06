@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-5 rounded-4 shadow-lg">
        <h4 class="text-center mb-4 text-uppercase fw-bold">Lista de Eventos</h4>

        @if(session('success'))
            <div class="alert alert-success text-center fw-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary text-uppercase">
                    <tr>
                        <th>Imagen</th>
                        <th>#</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                        <th>Aforo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eventos as $evento)
                        <tr>
                            <td>
                                @if($evento->imagen)
                                    <img src="{{ asset('storage/eventos/' . $evento->imagen) }}" alt="Imagen Evento" width="110" height="70" class="rounded">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $evento->titulo }}</td>
                            <td class="text-capitalize">{{ $evento->tipo }}</td>
                            <td>{{ $evento->fecha }}</td>
                            <td>{{ $evento->hora }}</td>
                            <td>{{ $evento->ubicacion }}</td>
                            <td>{{ $evento->aforo }}</td>
                            <td>S/ {{ number_format($evento->precio, 2) }}</td>
                            <td class="text-capitalize">{{ $evento->estado }}</td>
                            <td>
                                <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm btn-primary px-3 rounded-pill me-1">
                                    Editar
                                </a>
                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3 rounded-pill">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-muted text-center py-3">No hay eventos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
