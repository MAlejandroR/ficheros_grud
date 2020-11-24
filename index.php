<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


//
require_once("clases/Fichero.php");

/**Levamos un log de las acciones realizadas */
$log = new Fichero("log.txt");
require_once "clases/Fichero.php";

$opcion = $_POST['submit'] ?? null;
$hora = date("D-m-Y  H:i:s");

$log->writeln($hora);
$log->writeln("Opción selecconada $opcion");
$log->close();

switch ($opcion) {
    case  "Ej1: Escribir fichero":
        header("location:Ej1_crear.php");
        exit();
    case  "Ej2: Escribir y Leer fichero":
        header("location:Ej2_crear_leer.php");
        exit();
    case  "Ej3: Directorios":
        header("location:Ej3_directorios.php");
        exit();
    case  "Ej4: Lectura Fichero":
        header("location:Ej4_lectura_ficheros.php");
        exit();
    case  "Ej5: Borrar y crear ficheros":
        header("location:Ej5_borrar_crear.php");
        exit();
    case  "Ej6: Renombrar ficheros":
        header("location:Ej6_rename_files.php");
        exit();
   default:

}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>práctica ficheros</title>
    <link rel="stylesheet" href="style/estilo.css">

</head>
<body>

<fieldset>
    <legend>Opciones de ejercicios</legend>
    <form action="index.php" method="POST">
        <input type="submit" value="Ej1: Escribir fichero" name="submit">
        <input type="submit" value="Ej2: Escribir y Leer fichero" name="submit">
        <input type="submit" value="Ej3: Directorios" name="submit">
        <input type="submit" value="Ej4: Lectura Fichero" name="submit">
        <input type="submit" value="Ej5: Borrar y crear ficheros" name="submit">
        <input type="submit" value="Ej6: Renombrar ficheros" name="submit">
   </form>


</fieldset>

</body>
</html>
