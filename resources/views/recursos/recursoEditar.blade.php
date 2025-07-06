@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h4 class="text-center mb-5 text-uppercase fw-bold">Editar Recurso</h4>

        <form action="{{ route('recursos.update', $recurso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $recurso->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripcion:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $recurso->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label fw-bold">Tipo:</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="{{ old('tipo', $recurso->tipo) }}" required>
            </div>

            <div class="mb-4">
                <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="{{ old('cantidad', $recurso->cantidad) }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success px-4 rounded-pill">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
