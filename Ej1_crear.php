<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Ejercicio 1:
 * https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/ficheros/ejercicios/ejercicio1
 */
require_once "clases/Fichero.php";


$msj="Aporta los valores para operar";
if (isset($_POST['submit'])) {

    //Leo las variables que necesito
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $mode = filter_input(INPUT_POST, "mode");
    $contenido = filter_input(INPUT_POST, "contenido", FILTER_SANITIZE_STRING);

    $fichero = new Fichero ($name);

    $fichero->writeln($contenido);

    $fichero->close();

    $msj = $fichero->get_error() ?? "Se ha escrito en $name el texto";
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css" type="text/css">
    <title>Document</title>
    <link rel="stylesheet" href="style/estilo.css">
</head>
<body>
<fieldset>
    <form action="index.php">
        <input type="submit" value="Volver al index">
    </form>
</fieldset>
<fieldset>
    <legend>Escribir en fichero</legend>
    <form action="Ej1_crear.php" method="post">
        <!-- Mostramos el mensaje -->
        <h2><?php echo($msj ?? "Escritura de ficheros"); ?></h2>
        <label for="fichero">Nombre del fichero
        </label>
        <br/>

        <input type="text" name="name" id="fichero"><br>
        <label for="contendio">
            Contenido del fichero</label><br/>
        <textarea name="contenido" id="contenido" cols="30" rows="10">
       </textarea>
        <div style="float:right">
            <label for="modo">Especifica el modo</label>
            <br>
            <input type="radio" name="mode" value="w" checked id="modo"> Escritura<br/>
            <input type="radio" name="mode" value="a" id="modo"> Añadir<br/>
        </div>
        <br />
        <input style="float:left" type="submit" value="Guardar" name="submit">

    </form>
</fieldset>

</body>
</html>
