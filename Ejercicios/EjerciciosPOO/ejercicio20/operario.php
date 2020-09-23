<?php


class Operario{
    private $_apellido; //string
    private $_nombre; //string
    private $_legajo; //int
    private $_salario; //double


    public function __construct($legajo,$apellido,$nombre,$salario){
        if (is_int($legajo) && is_string($apellido) && is_string($nombre) && is_double($salario)){
            $this->_legajo = $legajo;
            $this->_apellido = $apellido;
            $this->_nombre = $nombre;
            $this->_salario = $salario;
            
        }
        else{
            $this->_legajo = 0;
            $this->_apellido = "ApellidoNoValido";
            $this->_nombre = "NombreNoValido";
        }
        //return void
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
    public function SetAumentarSalario($porcentaje){
        
        if (is_int($porcentaje)) {
            $aumento = $this->_salario * ($porcentaje / 100);
            $this->_salario += $aumento;
        }
        else{
            echo "El porcentaje no es correcto";
        }
    }
    
    /**Metodo de instancia donde $name es el nombre de la funcion en este caso Mostrar, $arguments no tiene uso */
    public function Mostrar(){

        $retorno = "";
        $retorno .= "DATOS DEL OPERARIO: <br>";
        $retorno .= "Nombre y Apellido: ". $this->getNombreApellido() . "<br>";
        $retorno .= "Legajo: $this->_legajo <br>";
        $retorno .= "Salario: $this->_salario <br>";
        return $retorno;
        
    }
    /**Metodo de clase donde recibo en $name el nombre del metodo, $arguments sera el objeto de tipo Operario para mostrar sus datos */
    public static function MostrarOp($operario){
        if ($operario instanceof Operario && $operario != null) {
            return $operario->Mostrar();
        
        }
    }
    /**Retronará un booleano informando si el nombre, apellido y el legajo de los operarios
        coinciden al mismo tiempo. */
    public function Equals($op1,$op2){
        if ($op1 instanceof Operario && $op1 != null && $op2 instanceof Operario && $op2 != null){
            if ($op1->_nombre == $op2->_nombre && $op1->_apellido == $op2->_apellido && $op1->_legajo == $op2->_legajo) {
                return true;
            }
            else{
                return false;
            }
        }
    }

}



?>