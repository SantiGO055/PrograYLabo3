<?php
require_once '../ejerciciosPOO/ejercicio17.php';


$auto = new Auto('ABC 987','FIAT','AZUL',100000);
$file = 'archivo.txt';
$modo = 'r';
// $fread = fread($archivo,100); //Lee todo el archivo
// echo $fread;


//como no se conoce la cantidad de lineas a leer en el archivo, se realiza un bucle
$size = filesize($file);
$archivo = fopen($file,$modo);
$linea = fgets($archivo,$size);
// $fwrite = fwrite($archivo, $auto . PHP_EOL);


$listaDeAutos = array();
// con a+ deja el cursor al final, por eso no lo lee
//lo imprimo con
// echo "fwrite $fwrite <br>";
while(!feof($archivo)){
    $linea = fgets($archivo);
    $datos = explode('*',$linea); //verifico los espacios de cada dato y los separo

    if(count($datos) >3){ //si este dato es igual o mayor a 4
        $nuevoAuto = new Auto($datos[0],$datos[1],$datos[2],$datos[3]);
        array_push($listaDeAutos, $nuevoAuto);
    }

    //echo $linea;
    echo "<br>";
}
foreach ($listaDeAutos as $value) {
    echo $value->_patente;
}


//var_dump($listaDeAutos);

copy($file,'nuevo_archivo.txt');
unlink('nuevo_archivo.txt');



$close = fclose($archivo);



class Archivos{

    static function serializarAuto($ruta, $objeto){
        $ar = fopen("./".$ruta, "a");

        fwrite($ar, serialize($objeto).PHP_EOL);
        fclose($ar);


    }
}



?>