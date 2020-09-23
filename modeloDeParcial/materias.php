<?php

class Materias{
    public $_nombre;
    public $_cuatrimestre;
    public $_id;
    
    public function __construct($nombre,$cuatrimestre){
        $this->_nombre = $nombre;
        $this->_cuatrimestre = $cuatrimestre;
        $this->_id = rand(1,100);
    }



}


?>