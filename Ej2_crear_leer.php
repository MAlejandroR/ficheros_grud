<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//
$title = "<span class='titulo'>Ejercicio de crear ficheros y leer\n";
$title .= "Puedes escribir un texto y un nombre de fichero  y se guardará\n";
$title .= "Puedes escribir un nombre de fichero  y se visualizará su contenido\n";
$title .= "Este ejercicio solo trabaja sobre los ficheros de la carpeta ./ficheros\n";
$title .= "</span>";


/**
 * Ejercicio 1:
 * https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/ficheros/ejercicios/ejercicio1
 */
require_once "clases/Fichero.php";


$msj = "Aporta los valores para operar. <br />Se leerá/escribirá en la carpta fichero del dir actual";

if (isset($_POST['submit'])) {
//Leo las variables que necesito
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);


    $opcion = $_POST['submit'];
    switch ($opcion) {
        case "Guardar":
            //Leo las variables que necesito para esta acción
            $mode = filter_input(INPUT_POST, "mode");
            $contenido = filter_input(INPUT_POST, "contenido", FILTER_SANITIZE_STRING);

            $fichero = new Fichero (__DIR__ . "/$name", $mode);

            $fichero->writeln($contenido);


            $fichero->writeln($contenido);
            $msj = $fichero->get_error() ?? "Se ha escrito en $name el texto";
            break;
        case "Leer":
            $fichero = new Fichero (__DIR__ . "/$name", "r");
            $contenido = $fichero->read();
            $msj = $fichero->get_error() ?? "Se ha leído de  $name ";
            break;
    }

    $fichero->close();

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
    <link rel="stylesheet" href="style/estilo.css">
</head>
<h2>Ejercicio de leer y escribir ficheros</h2>
<body>
<pre><?= $title ?></pre>
<fieldset>
    <form action="index.php">
        <input type="submit" value="Volver al index">
    </form>
</fieldset>
<fieldset>
    <legend>Escribir en fichero</legend>
    <form action="Ej2_crear_leer.php" method="post">
        <!-- Mostramos el mensaje -->
        <h2><?php echo($msj ?? "Escritura de ficheros"); ?></h2>
        <label for="fichero">Nombre del fichero
        </label>
        <br/>

        <input type="text" name="name" id="fichero"><br>
        <label for="contendio">
            Contenido del fichero</label><br/>
        <textarea name="contenido" id="contenido" cols="30" rows="10">
            <?= $contenido ??"" ?>
       </textarea>
        <div style="float:right">
            <label for="modo">Especifica el modo</label>
            <br>
            <input type="radio" name="mode" value="w" checked id="modo"> Escritura<br/>
            <input type="radio" name="mode" value="a" id="modo"> Añadir<br/>
        </div>
        <input style="float:right" type="submit" value="Guardar" name="submit">
        <input style="float:right" type="submit" value="Leer" name="submit">

    </form>
</fieldset>

</body>
</html>
