@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold mb-4">Registrar Usuario</h2>
    <form action="#" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-4">
            <label for="apellido" class="block font-medium">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-4">
            <label for="correo" class="block font-medium">Correo</label>
            <input type="email" name="correo" id="correo" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-4">
            <label for="telefono" class="block font-medium">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-6">
            <label for="rol" class="block font-medium">Rol</label>
            <select name="rol" id="rol" class="w-full border rounded-lg p-2">
                <option value="administrador">Administrador</option>
                <option value="participante">Participante</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Registrar</button>
    </form>
</div>
@endsection

