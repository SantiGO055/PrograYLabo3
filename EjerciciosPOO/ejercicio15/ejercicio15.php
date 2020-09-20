<?php

/**Aplicación Nº 15 (Figuras geométricas)
 * La clase ​FiguraGeometrica​ posee: todos sus atributos protegidos, 
 * un constructor por defecto,un método getter y setter para el atributo ​_color​,
 * un método virtual (​ToString​) y dosmétodos abstractos:
 *  ​Dibujar​ (público) y ​CalcularDatos​ (protegido).
 * CalcularDatos será invocado en el constructor de la clase derivada que corresponda, 
 * su funcionalidad será la de inicializar los atributos _superficie y _perimetro.
 * Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
 * objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
 * Ejemplo:    
 *     *
 *    ***
 *   ****  
 * 
 *      *******
 *      *******
 *      *******
 * Utilizar el método ToString para obtener toda la información completa del objeto, 
 * y luego dibujarlo por pantalla. */

abstract class FiguraGeometrica{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    public function __construct($_color,$_perimetro,$_superficie){
        $this->_color = $_color;
        $this->_perimetro = $_perimetro;
        $this->_superficie = $_superficie;

    }

    public function __get($name)
    {
        return $this->name;
    }
    public function __set($name,$value)
    {
        $this->name = $value;
    }


    /**Consultar si este metodo esta hecho bien */
    /**La consulta es si definiendo el __get o el __set en la clase puedo usarlo en cualquier variable de la clase haciendo $this->_color por ejemplo */
    public function GetColor(){
        return $this->_color;
    }
    public function SetColor($color){
        $this->_color = $color;
    }


    public function __toString(){
        return $this->_color . ' ' . $this->_perimetro . ' ' . $this->_superficie;
    }
    abstract public function Dibujar();
    abstract protected function CalcularDatos();

}

class Rectangulo extends FiguraGeometrica{
    public $_ladoUno;
    public $_ladoDos;

    public function __construct($l1, $l2,$color)
    {
        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;
        $this->_color = $color;
        $this->CalcularDatos();
    }
    public function Dibujar(){
        for ($i=0; $i < $this->_ladoDos; $i++) { 
            echo "<br>";
            for ($j=0; $j < $this->_ladoUno; $j++) { 
                echo "*";
            }
        }
        
    }
    protected function CalcularDatos(){
        $this->_superficie = $this->_ladoUno*$this->_ladoDos;
        $this->_perimetro = ($this->_ladoUno*2) + ($this->_ladoDos*2);
    }
    public function __toString(){

        return "<br>" . "" . $this->Dibujar() . 'Color: ' . $this->_color . '. Perimetro: ' . $this->_perimetro . ' .Superficie: ' . $this->_superficie . "<br>" ;
    }


}
class Triangulo extends FiguraGeometrica{
    public $_altura;
    public $_base;

    public function __construct($_base, $_altura,$_color)
    {
        $this->_base = $_base;
        $this->_altura = $_altura;
        $this->_color = $_color;
        $this->CalcularDatos();
    }
    public function Dibujar(){
        for ($i=0; $i < $this->_altura; $i++) { 
            echo '      *';
            echo "<br>";
        }
        
    }
    protected function CalcularDatos(){
        $this->_superficie = ($this->_base*$this->_altura) / 2;
        $_cateto1 = $this->_base / 2;
        $_cateto2 = $this->_altura;
        $_sumaCatetos = pow($_cateto1,2) + pow($_cateto2,2);

        $_hipotenusa = sqrt($_sumaCatetos);
        
        $this->_perimetro = ($_hipotenusa * 2) + $this->_base;

    }

    public function __toString()
    {
        return "<br>" . "" . $this->Dibujar() . 'Color: ' . $this->_color . '. Perimetro: ' . $this->_perimetro . ' .Superficie: ' . $this->_superficie . "<br>" ;
    }

}

$f1 = new Rectangulo(2,4,"Rojo");
echo $f1;
$t1 = new Triangulo(2,3,"Verde");
echo $t1;

?>