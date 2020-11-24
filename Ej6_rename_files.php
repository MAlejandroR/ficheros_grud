<?php
ini_set("display_errors", true);
error_reporting(E_ALL);


require_once "./clases/Directorio.php";

$msj = null;

$dir = new Directorio(__DIR__ . "/ficheros");

if (isset($_POST['submit'])) {

    $origen = filter_input(INPUT_POST, 'origen');
    $destino = filter_input(INPUT_POST, 'destino');
    $copied = $dir->renombrar($origen, $destino);

    $msj = $copied ? "Se ha movido <span class=resaltado>$origen</span> a <span class=resaltado>$destino</span>" : "No se ha podido mover <span class=resaltado>$origen</span> a <span class=resaltado>$destino</span>";
}

$ficheros = $dir->get_ficheros();
$ficheros = $dir->quita_puntos()

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/estilo.css" type="text/css">
    <title>Renombrado ficheros</title>
</head>
<body>
<fieldset>
    <form action="index.php">
        <input type="submit" value="Volver al index">
    </form>
</fieldset>
<h2 style="text-align:center"><?php echo $msj ?></h2>
</h2>
<fieldset>
    <legend>mover o renombrar ficheros</legend>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="fichero">Nombre del fichero original
        </label>
        <select name="origen" id="fichero">
            <option value=null>Selecciona un fichero para mover</option>
            <?php
            if (isset($ficheros)) {
                foreach ($ficheros as $fichero) {
                    echo "<option  value='$fichero'>$fichero </option>\n";
                }
            }
            ?>
        </select>
        <label for="fichero">Nombre del fichero destino
        </label>

        <input type="text" name="destino" id=""><br/>
        <input type="submit" value="copiar" name="submit">
        <fieldset class="in">
            <legend>Listado de ficheros Actuales</legend>
            <?php
            echo "<ol>";
            $destino = $destino ?? "";
            foreach ($ficheros as $fichero) {
                if ($fichero == $destino)
                    echo "<li> <span style='color: blue'>$fichero</span> (fichero actualmente copiado)</li>";
                else
                    echo "<li>$fichero</li>";
            }
            echo "</ol>"
            ?>
        </fieldset>

    </form>
</fieldset>
</body>
</html>
