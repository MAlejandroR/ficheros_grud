<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./clases/Fichero.php";
$opcion = $_POST['submit'] ?? "";
$file = new Fichero("./nombres.txt", "r");

$contenido =null;
switch ($opcion) {

    case "Leer con fgets" :
        $contenido = $file->read_fgets();
        break;
        case "Leer con fgetc" :
        $contenido = $file->read_fgetc();
        break;
    case "Leer con fgetss" :
        $contenido = $file->read_fgetss();
        break;
    case "Leer con fread"  :
        $contenido = $file->read();
        break;
    case "Leer con file"  :
        $contenido = $file->read_file();
        break;
    case "Leer con file_get_content"  :
        $contenido = $file->read_file_get_content();
        break;
}
$msj = "<span style='color: blue'>$opcion</span><br />$contenido"

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ej4 Lectura</title>
    <link rel="stylesheet" href="style/estilo.css">

</head>
<body>
<fieldset>
    <form action="index.php">
        <input type="submit" value="Volver al index">
    </form>
</fieldset>

<fieldset>
    <legend>Opciones de ejercicios</legend>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="submit" value="Leer con fgets" name="submit">
        <input type="submit" value="Leer con fgetc" name="submit">
        <input type="submit" value="Leer con fgetss" name="submit">
        <input type="submit" value="Leer con fread" name="submit">
        <input type="submit" value="Leer con file" name="submit">
        <input type="submit" value="Leer con file_get_content" name="submit">
    </form>
</fieldset>
<?php if (isset($contenido)): ?>
<fieldset>
    <legend>Escribir en fichero</legend>
    <?=$contenido?>

</fieldset>
<?php endif;?>

</body>
</html>

