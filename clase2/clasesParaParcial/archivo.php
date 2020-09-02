<?php

require_once './clases/ejercicio17.php';

$file = 'archivo.txt';
$modo = 'r';
$size = filesize($file);
$archivo = fopen($file,$modo);


// $fread = fread($archivo,100); //Lee todo el archivo

// echo fgets($archivo);
// echo fgets($archivo);
// echo fgets($archivo);
//como no se conoce la cantidad de lineas a leer en el archivo, se realiza un bucle
// $fwrite = fwrite($archivo, $auto . PHP_EOL);

// con a+ deja el cursor al final, por eso no lo lee
//lo imprimo con
// echo "fwrite $fwrite <br>";
while(!feof($archivo)){
    $linea = fgets($archivo,$size);
    $datos = explode('*',$linea); //verifico los espacios de cada dato y los separo con *

    if(count($datos) == 4){
        //instancio un nuevo objeto
        //$nuevoAuto = new Auto($datos[0],$datos[1],$datos[2],$datos[3]);
        /* *Lo agrego a una lista */
        //array_push($listaDeAutos, $nuevoAuto);
    }
}

/**Recorro la lista */
// foreach ($listaDeAutos as $value) {
//     echo $value->_patente;
// }
//var_dump($listaDeAutos);

/**Creo una copia del archivo */
copy($file,'nuevo_archivo.txt');
/**Elimino el archivo que cree nuevo */
unlink('nuevo_archivo.txt');


/**cierro el archivo */
$close = fclose($archivo);


?>