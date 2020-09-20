<?php 

/**Dadas las siguientes clases:
Pasajero
Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean)
Crear un constructor capaz de recibir los cuatro parámetros.
Crear el método de instancia “Equals” que permita comparar dos objetos Pasajero. Retornará
TRUE cuando los _dni sean iguales.
Agregar un método getter llamado GetInfoPasajero, que retornará una cadena de caracteres
con los atributos concatenados del objeto.
Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página.
Vuelo

Neiner, Maximiliano – Villegas, Octavio PHP- 2017 Página 4

Atributos privados: _fecha (DateTime), _empresa (string) _precio (double), _listaDePasajeros
(array de tipo Pasajero), _cantMaxima (int; con su getter). Tanto _listaDePasajero como
_cantMaxima sólo se inicializarán en el constructor.
Crear el constructor capaz de que de poder instanciar objetos pasándole como parámetros:
i. La empresa y el precio.
ii. La empresa, el precio y la cantidad máxima de pasajeros.
Agregar un método getter, que devuelva en una cadena de caracteres toda la información de
un vuelo: fecha, empresa, precio, cantidad máxima de pasajeros, y toda la información de
todos los pasajeros.
Crear un método de instancia llamado AgregarPasajero, en el caso que no exista en la lista,
se agregará (utilizar Equals). Además tener en cuenta la capacidad del vuelo. El valor de
retorno de este método indicará si se agregó o no.
Agregar un método de instancia llamado MostrarVuelo, que mostrará la información de un
vuelo.
Crear el método de clase “Add” para que permita sumar dos vuelos. El valor devuelto deberá
ser de tipo numérico, y representará el valor recaudado por los vuelos. Tener en cuenta que si
un pasajero es Plus, se le hará un descuento del 20% en el precio del vuelo.
Crear el método de clase “Remove”, que permite quitar un pasajero de un vuelo, siempre y
cuando el pasajero esté en dicho vuelo, caso contrario, informarlo. El método retornará un
objeto de tipo Vuelo. */

class Pasajero{


    private $_apellido; //string
    private $_nombre; //string
    private $_dni; //string
    private $_esPlus; //boolean

    public function __construct($_apellido,$_nombre,$_dni,$_esPlus){
        $this->_apellido = $_apellido;
        $this->_nombre = $_nombre;
        $this->_dni = $_dni;
        $this->_esPlus = $_esPlus;
    }

    public function Equals($pasajero1,$pasajero2){
        if ($pasajero1->_dni == $pasajero2->_dni) {
            return true;
        }
        else{
            return false;
        }
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name,$value){
        $this->$name = $value;
    }

    public function GetInfoPasajero(){
        $mensaje = "";
        $mensaje .= "Info del pasajero:<br>";
        $mensaje .= "Nombre: $this->_nombre<br>";
        $mensaje .= "Apellido: $this->_apellido<br>";
        $mensaje .= "DNI: $this->_dni<br>";
        if($this->_esPlus){
            $mensaje .= "Plus: TRUE <br>";
        }
        else{
            $mensaje .= "Plus: FALSE <br>";
        }

        return $mensaje;
    }
    public function MostrarPasajero(){
        echo $this->GetInfoPasajero();
    }
}

class Vuelo{

    private DateTime $_fecha; //DateTime
    private $_empresa; //string
    private $_precio; //double
    private $_listaDePasajeros; //de tipo Pasajero
    private $_cantMaxima; //int

    public function __construct(string $empresa = "", float $precio = 0, int $cantMax = 0){
        $this->_fecha = new DateTime();
        $this->_empresa = $empresa;
        $this->_precio = $precio;
        $this->_cantMaxima = $cantMax;
        $this->_listaDePasajeros = [];
    }

    public function getCantMaxima(){
        
        return $this->_cantMaxima;
    }
    
    /**Agregar un método getter, que devuelva en una cadena de caracteres toda la información de
    un vuelo: fecha, empresa, precio, cantidad máxima de pasajeros, y toda la información de
    todos los pasajeros.
     */

    public function GetCantMax(){
        return $this->_cantMaxima;
    }
    
    
    /**Crear un método de instancia llamado AgregarPasajero, en el caso que no exista en la lista,
    se agregará (utilizar Equals). Además tener en cuenta la capacidad del vuelo. El valor de
    retorno de este método indicará si se agregó o no.
    Agregar un método de instancia llamado MostrarVuelo, que mostrará la información de un
    vuelo.
    Crear el método de clase “Add” para que permita sumar dos vuelos. El valor devuelto deberá
    ser de tipo numérico, y representará el valor recaudado por los vuelos. Tener en cuenta que si
    un pasajero es Plus, se le hará un descuento del 20% en el precio del vuelo.
    Crear el método de clase “Remove”, que permite quitar un pasajero de un vuelo, siempre y
    cuando el pasajero esté en dicho vuelo, caso contrario, informarlo. El método retornará un
    objeto de tipo Vuelo. */
    public function AgregarPasajero($_pasajero){
        $mensaje = "";
        $countPasajeros = count($this->_listaDePasajeros);
        if ($_pasajero instanceof Pasajero && $_pasajero !== null) {
           if ($countPasajeros < $this->_cantMaxima) {
               
           
                $countPasajeros = count($this->_listaDePasajeros);
                
                if ($countPasajeros === 0) {
                    array_push($this->_listaDePasajeros,$_pasajero);
                    $mensaje .= "<br> Pasajero agregado con exito! </br>";
                }
                else if($countPasajeros !== 0){
                    foreach ($this->_listaDePasajeros as $key){
                        if($_pasajero->Equals($_pasajero,$key)){
                            $mensaje .= "<br> El pasajero ya se encuentra en la lista. </br>";
                        }
                        else{
                            array_push($this->_listaDePasajeros,$_pasajero);
                            $mensaje .= "</br>Pasajero agregado con exito!</br></br>";
                            break;
                        }
                    }
                }
            
            }
            else{
                $mensaje .= "Se superó la cantidad máxima de pasajeros.</br></br>";
            }
        }
        else{
            $mensaje .= "El pasajero es null.</br></br>";
        }
        return $mensaje;
        
    }

    
    public function MostrarVuelo(){
        echo $this->getInfoVuelo();
    }
    public function getInfoVuelo(){
        $i = 0;
        $mensaje = "";
        $mensaje .= "Info del vuelo:<br>";
        $mensaje .= "Empresa: $this->_empresa<br>";
        $mensaje .= "Fecha: {$this->_fecha->format('Y-m-d')}<br>";
        
        $mensaje .= "Precio: $this->_precio<br>";
        $mensaje .= "Cantidad maxima de pasajeros: $this->_cantMaxima<br>";

        foreach ($this->_listaDePasajeros as $key) {
            $mensaje .= "</br>Pasajero nº {$i}:</br>";
            $mensaje .= $key->getInfoPasajero();
            $i++;
        }
        return $mensaje;

    }

    public static function Add($vuelo1,$vuelo2){
        $precioAuxVuelo1 = 0;
        $precioAuxVuelo2 = 0;
        if ($vuelo1 instanceof Vuelo && $vuelo2 instanceof Vuelo) {
            foreach ($vuelo1->_listaDePasajeros as $key) {
                if($key->_esPlus){
                    $precioAuxVuelo1 += ($vuelo1->_precio - ($vuelo1->_precio * 0.20));
                }
                else{
                    $precioAuxVuelo1 += $vuelo1->_precio;
                }
            }
            foreach ($vuelo2->_listaDePasajeros as $value) {
                if($key->_esPlus){
                    
                    $precioAuxVuelo2 += ($vuelo2->_precio - ($vuelo2->_precio * 0.20));
                }
                else{
                    $precioAuxVuelo2 += $vuelo2->_precio;
                }
            }
            return ($precioAuxVuelo1 + $precioAuxVuelo2 );
        }
        else{
            return 0;
        } 
        
    }
    public static function buscarPasajero($pasajero, $vuelo){
        foreach ($vuelo->_listaDePasajeros as $value) {
            if ($value == $pasajero) {
                return true;
            }
            else{
                return false;
            }
        }
    }
    public static function Remove($pasajero,$vuelo){
        if ($pasajero instanceof Pasajero && $vuelo instanceof Vuelo) {
            if (buscarPasajero($pasajero,$vuelo)) {

                unset($pasajero);
                return $vuelo;
            }
            else{
                return " no se encontro el pasajero en el vuelo";
            }
        }
    }


}



?>