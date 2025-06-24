<h1>Inscribirse a un evento</h1>

<form action="/inscripciones/crear" method="POST">
    @csrf

    <h1>Seleccionar evento</h1>
    <select name="evento_id">
        @foreach($eventos as $evento)
            <option value="{{$evento->id}}">{{$evento->titulo}}</option>
        @endforeach
        </select><br><br>

        <h1>Seleccionar fecha</h1>
        <input type="date" name="fecha"><br>

        <h1>Estado de inscripcion</h1>
        <select name="estadoInscripcion">
            <option value="pendiente">Pendiente</option>
            <option value="aceptado">Aceptado</option>
            <option value="rechazado">Rechazado</option>
        </select><br><br>

        
        <input type="submit" value="Crear Inscripcion">
</form>
