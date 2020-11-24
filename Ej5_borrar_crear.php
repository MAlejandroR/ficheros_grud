<?php
ini_set("display_errors", true);
error_reporting(E_ALL);
//function borra_todos_ficheros(){
//    $ficheros = scandir("./ficheros/");
//    $n=0;
//    foreach ($ficheros as $fichero) {
//        if (!unlink("./ficheros/$fichero"))
//            echo "No se ha podido borrar $fichero<br />";
//        $n++;
//    }
//    return "Se han borrado <span class=resaltado>$n</span> ficheros";
//}
//function borra_fichero($fichero){
//    if (unlink("./ficheros/$fichero"))
//        $msj="El fichero <span class=resaltado>./ficheros/$fichero </span>se ha borrado";
//    else
//        $msj="No se ha podido borrar<span class=resaltado>./ficheros/$fichero </span>";
//    return $msj;
//}
//function crea_ficheros(){
//    for ($n=0; $n<20; $n++){
//        $f= tempnam("./ficheros/","daws_$n"."_");
//    }
//    $c = count(scandir("./ficheros"));
//    return "Se han creado 20 ficheros. En total hay <span class=resaltado>$c</span> ficheros en la carpeta ";
//}
require_once "./clases/Directorio.php";
$msj = null;
$contenido = new Directorio(__DIR__."/ficheros/");

$opcion = $_POST['submit'] ?? null;
switch ($opcion) {

    case "Borrar ficheros":
        echo "<h1>OK</h1>";
        $num_files = $contenido->delete_all_files();
        $msj = $num_files == 0 ? "No se ha borrado ningún fichero" : "Se han borrado $num_files ficheros";
        break;
    case "Crear 20 ficheros":
        $msj = $contenido->create_files(20);
        break;
    case "Elimina fichero seleccionado":
        $fichero = $_POST['fichero'];
        $deleted = $contenido->delete_file($fichero);
        $msj = $deleted ? "Se ha borrado $fichero ": "No se ha podido borrar el fichero $fichero";
        break;
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

<h2 style="text-align:center"><?php echo $msj ?></h2>
</h2>
<fieldset>
    <legend>Borrar y crear ficheros</legend>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="fichero">Nombre del fichero
        </label>
        <select name="fichero" id="fichero">
            <option value=null>Selecciona un fichero para borrar</option>
            <?php
            $ficheros = $contenido->get_ficheros();
            $ficheros = $contenido->quita_puntos();
           if (isset($ficheros)) {
                foreach ($ficheros as $name_fichero) {
                        $check = null;
                        if ($name_fichero == $fichero)
                            $check = "selected";
                        echo "<option $check value='$name_fichero'>$name_fichero </option>\n";

                }
            }
            ?>
        </select>
        <br/>
        <ol>
            <li><span class="resaltado">crear 20 ficheros</span>
                <ul>
                    <li>Creará 20 ficheros vacíos con nombres aleatorios en una subcarpeta del proyecto llamada
                        ficheros
                    </li>
                </ul>
            <li><span class="resaltado">Borrar ficheros</span>
                <ul>
                    <li>borrará todos los ficheros del directorio ficheros</li>
                </ul>
            <li><span class="resaltado">elimnia fichero seleccionado</span>
                <ul>
                    <li> borrará el fichero de la lista que se haya seleccionado.</li>
                </ul>
        </ol>
        <input type="submit" value="Borrar ficheros" name="submit">
        <input type="submit" value="Crear 20 ficheros" name="submit">
        <input type="submit" value="Elimina fichero seleccionado" name="submit">
    </form>
</fieldset>
</body>
</html>
