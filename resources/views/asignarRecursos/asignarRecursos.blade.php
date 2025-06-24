<h1>Asignar Recursos a un Evento</h1>
<form action="/asignarRecursos/crear" method="POST">
    @csrf

    <h1>Seleccionar evento</h1>
    <select name="evento_id">
        @foreach($eventos as $evento)
            <option value="{{$evento->id}}">{{$evento->titulo}}</option>
        @endforeach
        </select><br><br>

    <h1>Seleccionar recursos</h1>
    <select name="recurso_id">
        @foreach($recursos as $recurso)
            <option value="{{$recurso->id}}">{{$recurso->nombre}}</option>
        @endforeach
        </select><br><br>

        <input type="number" name="cantidad" placeholder="Ingrese cantidad a asignar"><br>

        <input type="submit" value="Asignar Recursos">
</form>
