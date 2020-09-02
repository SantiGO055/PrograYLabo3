<?php
/*
Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos privados:
_color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)
Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.
Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.

Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
En testAuto.php:

● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)

*/

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
        echo "Color: $_objAuto->_color";
        echo "<br/>";
        echo "Precio: $_objAuto->_precio";
        echo "<br/>";
        echo "Marca: $_objAuto->_marca";
        echo "<br/>";
        echo "Fecha: $_objAuto->_fecha";
    }
    public function Equals($_auto1, $_auto2){
        if ($_auto1->_marca == $_auto2->_marca) {
            return true;
        }
        else {
            return false;
        }
    }
    
    static function Add($_auto1,$_auto2){
        if(Auto::Equals($_auto1,$_auto2)){
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