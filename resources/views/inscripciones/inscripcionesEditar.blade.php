@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg">
        <h4 class="text-center fw-bold mb-4 text-uppercase">Editar Inscripción</h4>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="fecha" class="form-label fw-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $inscripcion->fecha) }}" required>
            </div>

            <div class="mb-4">
                <label for="estado" class="form-label fw-semibold">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="pendiente" {{ $inscripcion->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ $inscripcion->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ $inscripcion->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('inscripciones.index') }}" class="btn btn-warning rounded-pill px-4 me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 ms-2">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
