@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg">
        <h4 class="text-center fw-bold mb-4 text-uppercase">Editar Evento</h4>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if($evento->imagen)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/eventos/' . $evento->imagen) }}" alt="Imagen actual" class="img-fluid rounded" style="max-height: 250px;">
                    <p class="mt-2 text-muted">Imagen actual</p>
                </div>
            @endif

            <div class="mb-3">
                <label for="imagen" class="form-label fw-semibold">Cambiar Imagen (opcional)</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label fw-semibold">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $evento->titulo) }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label fw-semibold">Tipo</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="cultural" {{ $evento->tipo === 'cultural' ? 'selected' : '' }}>Cultural</option>
                    <option value="deportivo" {{ $evento->tipo === 'deportivo' ? 'selected' : '' }}>Deportivo</option>
                    <option value="social" {{ $evento->tipo === 'social' ? 'selected' : '' }}>Social</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label fw-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $evento->fecha) }}" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label fw-semibold">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $evento->hora) }}" required>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label fw-semibold">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $evento->ubicacion) }}" required>
            </div>

            <div class="mb-3">
                <label for="aforo" class="form-label fw-semibold">Aforo</label>
                <input type="number" name="aforo" id="aforo" class="form-control" value="{{ old('aforo', $evento->aforo) }}" min="1" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label fw-semibold">Precio (S/)</label>
                <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio', $evento->precio) }}" step="0.01" min="0" required>
            </div>

            <div class="mb-4">
                <label for="estado" class="form-label fw-semibold">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="activo" {{ $evento->estado === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $evento->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('eventos.index') }}" class="btn btn-warning rounded-pill px-4 me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 ms-2">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
