<?php


class Operario{
    private $_apellido; //string
    private $_nombre; //string
    private $_legajo; //int
    private $_salario; //double


    public function __construct($legajo,$apellido,$nombre){
        if (is_int($legajo) && is_string($this->apellido) && is_string($this->nombre)){
            $this->_legajo = $legajo;
            $this->_apellido = $apellido;
            $this->_nombre = $nombre;
        }
        else{
            $this->_legajo = 0;
            $this->_apellido = "ApellidoNoValido";
            $this->_nombre = "NombreNoValido";
        }
        //return void
    }


    public function __get($name){
        return $this->name;
    }

    public function __set($name,$value){
        $this->name = $value;
    }

    public function getNombreApellido(){
            $retorno = "";
            $retorno .= "$this->_nombre";
            $retorno .= ", $this->_apellido";
            return $retorno;
        
    }

    public function getSalario(){
        return $this->_salario;
    }
    public function aumentarSalario($porcentaje){

        if (is_int($porcentaje)) {
            $aumento = $this->_salario * 1 . $porcentaje;
            echo $aumento;
            $this->_salario = $aumento;
        }
        else{
            echo "El porcentaje no es correcto";
        }
    }
    public function Mostrar(){
        $retorno = "";
        $retorno .= "DATOS DEL OPERARIO: ";
        $retorno .= "Nombre y Apellido: {$this->getNombreApellido()}";
        $retorno .= "Legajo: $this->_legajo";
        $retorno .= "Salario: $this->_salario";
        return $retorno;
    }

    public static function Mostrar($op){
        $retorno = "";
        return $retorno;
    }
}





?>