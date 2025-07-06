@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h4 class="text-center mb-5 text-uppercase fw-bold">Registrar Evento</h4>

        <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="titulo" class="form-label fw-bold">TÍTULO:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">DESCRIPCIÓN:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label fw-bold">TIPO:</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="cultural">Cultural</option>
                    <option value="deportivo">Deportivo</option>
                    <option value="social">Social</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label fw-bold">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label fw-bold">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label fw-bold">Ubicación:</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="aforo" class="form-label fw-bold">Aforo:</label>
                <input type="number" name="aforo" id="aforo" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label fw-bold">Precio (S/):</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" min="0" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label fw-bold">Estado:</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="imagen" class="form-label fw-bold">Imagen del Evento:</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 rounded-pill">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
