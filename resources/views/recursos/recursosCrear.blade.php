<h1>Registrar Recurso</h1>

<form action="/recursos/crear" method="POST">
    @csrf

    <input type= "text" name="nombre"placeholder="Ingrese nombre del recurso"><br>
    <input type= "text" name="descripcion"placeholder="Ingrese descripcion del recurso"><br>
    <input type= "number" name="cantidad" placeholder="Ingrese cantidad disponible"><br>

    <h1>Tipo de recursos</h1>
    <select name="tipoRecurso">
        <option> value="materiales">Materiales</option>
        <option> value="r.r.h.h">R.R.H.H</option>
        <option> value="inmoviliario">Inmoviliario</option>
    </select><br><br>

    <input type="submit" value="Crear Recurso">
</form>