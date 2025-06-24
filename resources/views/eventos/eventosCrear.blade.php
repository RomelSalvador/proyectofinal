<h1>Crear Evento</h1>

<form action="/eventos/crear" method="POST">
    @csrf
    <input type="text" name="titulo" placeholder="Ingrese titulo del Evento"><br>
    <input type="text" name="ubicacion" placeholder="Ingrese ubicacion del Evento"><br>
    <input type="date" name="fecha"><br>
    <input type="time" name="hora"><br>
    <input type="number" name="aforo" placeholder="ingrese el aforo"><br>
    <input type="text" name="lugar" placeholder="Lugar del Evento">

    <h1>Tipo de evento</h1>
    <select name="tipoEvento">
        <option> value="cultural">Cultutral</option>
        <option> value="deportivo">Deportivo</option>
        <option> value="social">Social</option>
    </select><br><br>

    <h1>Estado de evento
    <select name="estadoEvento">
        <option> value="en curso">En Curso</option>
        <option> value="cancelado">Cancelado</option>
        <option> value="completado">Completado</option>
    </select><br><br>
    <input type="submit" value="Crear Evento">



</form>