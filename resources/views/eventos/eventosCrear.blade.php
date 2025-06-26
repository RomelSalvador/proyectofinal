@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold mb-4">Registrar Inscripción</h2>
    <form action="#" method="POST">
        @csrf
        <div class="mb-4">
            <label for="usuario_id" class="block font-medium">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="w-full border rounded-lg p-2">
                <option>Seleccionar usuario</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="evento_id" class="block font-medium">Evento</label>
            <select name="evento_id" id="evento_id" class="w-full border rounded-lg p-2">
                <option>Seleccionar evento</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="fecha" class="block font-medium">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-6">
            <label for="estado" class="block font-medium">Estado</label>
            <select name="estado" id="estado" class="w-full border rounded-lg p-2">
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Registrar</button>
    </form>
</div>
@endsection
