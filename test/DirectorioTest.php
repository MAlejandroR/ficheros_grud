<?php

require_once "./../vendor/autoload.php";
use PHPUnit\Framework\TestCase;


class DirectorioTest extends PHPUnit\Framework\TestCase{


    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

    }


    protected function tearDown(): void
    {
    parent::tearDown(); // TODO: Change the autogenerated stub
    }



    public function testdelete_all_file()
    {
        /*PAra esta prueba, creo un directorio con 10 ficheros y los borro*/

        $dir ="no_existe";// Probamos con el directorio actual
        $dir_class = new Directorio($dir);
        $num_files_deleted = $dir_class->delete_all_file();
        $this->assertEquals(FALSE,$num_files_deleted);

    }

}