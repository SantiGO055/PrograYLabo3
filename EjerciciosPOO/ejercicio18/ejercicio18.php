<?php
/**Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:
_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
i. La razón social.
ii. La razón social, y el precio por hora.
Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos. */

require_once '../clase3/auto.php';

class Garage{

    private $_razonSocial;
    private $_precioPorHora;
    
    public $_autos = array();

    public function __construct($_razonSocial,$_precioPorHora = 0){

        if (is_string($_razonSocial) && is_double($_precioPorHora)) {
            if ($_precioPorHora != 0) {
                $this->_razonSocial = $_razonSocial;
                $this->_precioPorHora = $_precioPorHora;
            }
            else{
                $this->_razonSocial = $_razonSocial;
                $this->_precioPorHora = 0;
            }
        }
        
    }
    //todo lo que le llegue como parametro va a ser publico y pasar por aca primero
    //$name es la propiedad a la que estoy accediendo
    public function __get($name){
        return $this->$name; // esto seria similar a echo $this->$_razonSocial;
    }

    public function __set($name,$value){
        $this->$name = $value;
    }

    public function getArray(){
        var_dump($this->_autos);
    }

    public function MostrarGarage(){
        echo "<br>";
        echo "Razon social: $this->_razonSocial - Precio por hora: $this->_precioPorHora";
    }
    public function Equals($_objAuto){
        $retorno = false;
        if ($_objAuto instanceof Auto) {
            if (isset($this->_autos)) {
                $this->_autos[] = $_objAuto;
            }
            
            for ($i=0; $i < count($this->_autos); $i++) { 
                if ($this->_autos[$i] == $_objAuto) {
                    $retorno = true;
                    return $retorno;
                }
                else{
                    $retorno = false;
                }
                
            }
        }
    }
    public function Add($_objAuto){
        //si el auto que recibo es de tipo Auto
        if ($_objAuto instanceof Auto) {

            if ($this->Equals($_objAuto)) {
                echo "<br>";
                echo "el auto Marca: $_objAuto->_marca y Patente: $_objAuto->_patente ya se encuentra en la lista";
            }
            else{
                array_push($_objAuto);
            }
            
        }
    }
    public function Remove($_objAuto){
        if ($_objAuto instanceof Auto) {
            if($this->Equals($_objAuto)){
                echo "Se elimino el auto patente: $_objAuto->_patente - marca: $_objAuto->_marca";
                unset($_objAuto);
                echo "<br>";
                
            }


        }
    }

}


?>