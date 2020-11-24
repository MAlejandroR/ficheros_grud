<?php
ini_set("display_errors", true);
error_reporting(E_ALL);

require_once("./clases/Directorio.php");
require_once("./clases/Fichero.php");

//Obtenglo los ficheros y directorios del directorio actual


$opcion = $_POST['submit'] ?? null;
$dir_base = $_POST['dir_base']?? __DIR__;
$dir = $dir_base;
//var_dump($dir_base);


switch ($opcion) {
    case 'Leer':
        $file_name= $_POST['fichero'];
        $file = new Fichero($file_name, "r");
        $contenido = htmlspecialchars($file->read());
        $file->close();
        break;
    case 'Actualizar directorio':
        $dir = $_POST['dir'];
//        var_dump($dir);
        break;
    default: //Vengo del index
        $dir=__DIR__;

        //En esta caso no hago nada.
        break;

}

//Recogo valores para rellenar los select
//var_dump($dir);
$listado = new Directorio($dir);
$ficheros = $listado->get_ficheros();
$directorios = $listado->get_directorios();
//var_dump($directorios);



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css" type="text/css">
    <title>Leer directorio</title>
    <link rel="stylesheet" href="style/estilo.css">
</head>
<body>
<h2 style="text-align:center"></h2>
</h2>
<fieldset>
    <form action="index.php">
    <input type="submit" value="Volver al index">
    </form>
</fieldset>
<fieldset>
    <legend>Leer fichero</legend>

    <form action="Ej3_directorios.php" method="post">
        <label for="fichero">Directorios de <span style="color: blue"><?= $listado->get_ruta()?>
            </span>
        </label>
        <select name="dir">
            <option value=null>Selecciona un directorio</option>
            <?php foreach ($directorios as $dir)
                echo "<option value='$dir'>$dir</option>\n";
            ?>
        </select>
<br />
        <label for="fichero">Ficheros de <span style="color: blue"><?= $listado->get_ruta()?>
            </span>
        </label>
        <select name="fichero" id="fichero">
            <option value=null>Selecciona un fichero</option>
            <?php //Visualizo los ficheros del dir actual
            foreach ($ficheros as $fichero)
                echo "<option value='$fichero'>$fichero</option>\n";
            ?>

            visualizando ficheros <br/>


        </select>
        <br/>
        <hr/>
        <input type="submit" value="Leer" name="submit">
        <input type="submit" value="Actualizar directorio" name="submit">
        <input type="hidden" value="<?=$dir?>" name="dir_base">
    </form>
    <?php if (isset($contenido)):?>
        <label for="contendio">
            Contenido del fichero</label><br/>
        <textarea name="contenido" id="contenido" cols="30" rows="10">
        <?= $contenido ?>
       </textarea>
    <?php endif; ?>
</fieldset>
</body>
</html>