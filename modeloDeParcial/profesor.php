<?php

class Profesor{
    public $legajo;
    public $nombre;

    public function __construct($nombre, $legajo){
        $this->nombre = $nombre;
        $this->legajo = $legajo;

    }
    public static function validarLegajo(){
        
    }

}


?>