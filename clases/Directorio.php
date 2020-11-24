<?php


class Directorio
{
    private $contenido_dir;
    private $error;
    private $ruta;

    public function quita_puntos()
    {
        $ficheros = $this->contenido_dir;
        $pos_punto = array_search(".", $ficheros);
        if ($pos_punto !== FALSE)
            unset ($ficheros[$pos_punto]);
        $pos_punto_punto = array_search("..", $ficheros);
        if ($pos_punto_punto !== FALSE)
            unset ($ficheros[$pos_punto_punto]);
        return $ficheros;
    }


    /**
     * Directorio constructor.
     * @param string $ruta directorio del que quiero obtener su contendio
     */
    public function __construct(string $ruta = __DIR__)
    {
        $this->ruta = $ruta;
        //Debo gestionar el dir actual (.) y el dir padre (..) si quiere aquí en la ruta
        $this->actualiza_dir_punto();
        if (file_exists($ruta))
            $this->contenido_dir = scandir($ruta);
        else {
            $this->contenido_dir = [];
            $this->error = "No existe el dir $ruta";
        }

//        $this->quita_puntos();
//        var_dump($this);
    }


    /**
     * @return array los ficheros del contenido del directorio actual
     */
    public function get_ficheros(): array
    {
        $listado_ficheros = [];
        foreach ($this->contenido_dir as $fichero)
            if (!is_dir("$this->ruta/$fichero"))
                $listado_ficheros[] = "$this->ruta/$fichero";
        return $listado_ficheros;
    }

    /**
     * @return array los ficheros del contenido del directorio actual
     */
    public function get_directorios(): array
    {
//        var_dump($this);
        $listado_directorios = [];
        foreach ($this->contenido_dir as $dir)
            if (is_dir("$this->ruta/$dir"))
                $listado_directorios[] = "$this->ruta/$dir";

//        var_dump($listado_directorios);
        return $listado_directorios;
    }

    public function get_ruta()
    {
        return $this->ruta;
    }


    /**
     * Si el dir está especificado con punto o punto punto, lo actualizo
     */
    private function actualiza_dir_punto(): void
    {
        $ficheros = explode("/", $this->ruta);
        $pos_punto = array_search(".", $ficheros);
        if ($pos_punto !== false) {
            unset ($ficheros[$pos_punto]);
            $this->ruta = implode("/", $ficheros);
        }
        $pos_punto_punto = array_search("..", $ficheros);
        if ($pos_punto_punto !== false) {
            unset ($ficheros[$pos_punto_punto]);
            unset ($ficheros[$pos_punto_punto - 1]);
            $this->ruta = implode("/", $ficheros);
        }

    }

    /**
     * @return bool si el dir de la ruta está vacío o no
     */
    private function vacio()
    {
        if (scandir($this->ruta) == 2)
            return true;
        else
            return false;

    }

    /**
     * @return int número de ficheros borrados
     * Borra los ficheros que haya en el dir actual
     */
    public function delete_all_files()
    {
        //Situaciones de seguridad para el método
        //Código claramente mejorable
        if (!$this->vacio()) {
            //Parte funcional del método
            $number_files_delete = 0;
            $error = "";
            $ficheros = $this->quita_puntos();
            foreach ($ficheros as $fichero) {
                if (!unlink("$this->ruta/$fichero"))
                    $error .= "No se ha podido borrar $fichero<br />";
                $number_files_delete++;
            }

            $this->error .= $error;
            $this->actualiza_contenido();
            return $number_files_delete;
        }
    }

    /**
     * @return int número de ficheros borrados
     * Borra los ficheros que haya en el dir actual
     */
    public function delete_file($file)
    {
        //Situaciones de seguridad para el método
        //Código claramente mejorable
        $deleted = false;
        if (file_exists("$this->ruta/$file")) {
            if (!unlink("$this->ruta/$file"))
                $this->error .= "No se ha podido borrar $file<br />";
            else
                $deleted = true;
        }
        $this->actualiza_contenido();
        return $deleted;
    }


    public function create_files(int $num_files)
    {
        for ($n = 0; $n < $num_files; $n++) {
            $f = tempnam("$this->ruta", "daws_{$n}_");
        }
        $c = count(scandir("./ficheros"));
        $this->actualiza_contenido();
        return "Se han creado $num_files ficheros. En total hay <span class=resaltado>$c</span> ficheros en la carpeta ";
    }

    private function actualiza_contenido()
    {
        $this->contenido_dir = scandir($this->ruta);
    }


    /**
     *
     * @param $origen nombre del fichero original
     * @param $destino nombre del fichero destino
     * @return bool si ha renombrado o no el fichero
     */
    public function renombrar($origen, $destino)
    {
        $renamed = false;

        if (file_exists("$this->ruta/$origen"))
            if (rename("$this->ruta/$origen", "$this->ruta/$destino"))
                $renamed = true;
        $this->actualiza_contenido();
        return $renamed;


    }

}