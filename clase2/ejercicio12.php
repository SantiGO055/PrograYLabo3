<?php

/**Aplicación Nº 12 (Invertir palabra)
 * Realizar el desarrollo de una función que reciba un Array de caracteres
 *  y que invierta el ordende las letras del Array.
 * Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH” */

function invertirString($array){
    $cantidad = count($array);
    $nuevoArray = array();
    for ($i=0; $i < $cantidad; $i++) { 
        if ($cantidad != 0) {
            array_push($nuevoArray,$array[$cantidad-($i+1)]);
        }
    }
    
    return $nuevoArray;

}
$arrayPrueba = array("p","a","l","a","b","r","a");
$nuevoArray = array();
$nuevoArray = invertirString($arrayPrueba);

echo "Palabra original:";
foreach ($arrayPrueba as $value) {
    echo $value;
}
echo "<br>";

echo "Palabra original:";
foreach ($nuevoArray as $value) {
    echo $value;
}

?>