<?php /** @noinspection PhpDeprecationInspection */

class Fichero
{

    /**
     * @var es el manejador de fichero
     */
    private $handler;
    private $error;
    private $name;
    private $ruta;

    /**
     * Fichero constructor.
     * @param string $file_name_absoluto es el nombre absoluta (con ruta) del fichero
     * @param string $modo
     */
    public function __construct(string $file_name_absoluto, string $modo = "a")
    {
        $this->name = basename($file_name_absoluto);
        $this->ruta = dirname($this->name);
        $this->error = null;
        // si fopen falla, se genera un warning
        //para evitarlo se pone  @ delante de la función
        $ruta =
        $this->handler = @fopen("$file_name_absoluto", $modo);
        if ($this->handler == FALSE)
            $this->error = "No se ha podido abrir el fichero <span style='color: darkred'>$this->name</span>,  revisa permisos\n<br />";

    }

    public function writeln($contenido)
    {
        if ($this->handler) {
            $rtdo = fwrite($this->handler, $contenido . PHP_EOL);
            if ($rtdo === FALSE)
                $this->error .= "No se ha podidio escribir $contenido en el fichero\n<br />";
        }
    }

    public function read_fgets()
    {
        $lineas = "";
        if ($this->handler) {
            $linea = fgets($this->handler);
            while ($linea !== FALSE) {
                $lineas .= $linea;
                $linea = fgets($this->handler);
            }
            return $lineas;
        }
    }

    public function read_fgetss()
    {
        $lineas = "";
        if ($this->handler) {
            $linea = @fgetss($this->handler);

            while ($linea !== FALSE) {
                $lineas .= $linea;
                $linea = @fgetss($this->handler);

            }
            return $lineas;
        }
    }


    public function read_fgetc()
    {
        $lineas = "";
        if ($this->handler) {
            $caracter = fgetc($this->handler)."<br />";

            while ($caracter !== FALSE) {
                $lineas .= $caracter."<br />";
                $caracter= fgetc($this->handler);

            }
            return $lineas;
        }
    }

    public function read_file()
    {
        if ($this->name) {
            $contenido = file($this->name);
            foreach ($contenido as $linea) {
                $lineas .= "$linea<br />";
            }
        }
        return $lineas;
    }

    public function read_file_get_content()
    {
        if ($this->name) {
            $lineas = file_get_contents($this->name);

        }
        return $lineas;
    }


    /**
     * @return string contendio de un fichero o msj si no se ha podido leer de él
     */
    public function read(): string
    {
        if ($this->handler) {
            $size = filesize("$this->ruta/$this->name");
            fseek($this->handler, 0);//Por si está abierto en modo apend, me pongo al prinpcio del fichero
            $contenido = fread($this->handler, $size);
        } else {
            $contenido = "No se ha podido leer del fichero";
            $this->error .= "No se ha podidio leer del fichero $this->name\n<br />";
        }
        return $contenido;
    }


    public function close()
    {
        if (!(($this->handler) and (fclose($this->handler))))
            $this->error .= "Error intentando cerrar el fichero\n<br />";
    }


    public function get_error()
    {
        return $this->error;
    }

}