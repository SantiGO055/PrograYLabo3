<?php
class Auto
{ //al crear clase por defecto es publico
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;
    private $_patente;

    public function __construct($_patente,$_marca,$_color,$_precio = 0,$_fecha = null)
    {
        $this->_marca = $_marca;
        $this->_color = $_color;
        $this->_precio = $_precio;
        $this->_fecha = $_fecha;
        $this->_patente = $_patente;

    }

    public function AgregarImpuestos($_impuesto){
        if(is_double($_impuesto))
            $this->_precio += $_impuesto;
    }

    static function MostrarAuto($_objAuto){
        return $_objAuto;
    }
    public function Equals($_auto1, $_auto2){
        if ($_auto1->_marca == $_auto2->_marca) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public static function Add($_auto1,$_auto2){
        if($_auto1->Equals($_auto1,$_auto2)){
            if ($_auto1->color == $_auto2->color) {
                return $_auto1->_precio + $_auto2->_precio;
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }
    public function __toString(){


        return $this->_patente . '*' . $this->_marca . '*' . $this->_color . '*' . $this->_precio;
    }

    //no hacemos geters ni setters por que php ya los trae
    
    //todo lo que le llegue como parametro va a ser publico y pasar por aca primero
    //$name es la propiedad a la que estoy accediendo
    public function __get($name){
        return $this->$name; // esto seria similar a echo $this->$_marca;
    }

    //value es el valor que estamos accediendo
    public function __set($name,$value){
        $this->$name = $value;
    }
}

//hacer clase para manejar archivos, index entre metodo y path, ejercicios de la guia de POO




?>