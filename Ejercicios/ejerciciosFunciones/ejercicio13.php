<?php

/**Aplicación Nº 13 (Invertir palabra)
 * Crear una función que reciba como parámetro un string (​$palabra​) y un entero (​$max​). 
 * La función validará que la cantidad de caracteres que tiene ​$palabra​ 
 * no supere a ​$max​ y además deberá determinar si ese valor se encuentra dentro
 * del siguiente listado de palabras válidas:“Recuperatorio”, “Parcial” y “Programacion”.
 * Los valores de retorno serán:1 si la palabra pertenece a algún elemento del listado.
 * 0 en caso contrario. */

function validarPalabra($palabra,$max){
    $palabrasValidas = array("Recuperatorio","Parcial","Programacion");
    $cantidad = strlen($palabra);

    if ($cantidad <= $max && ($palabra == $palabrasValidas[0] || $palabra == $palabrasValidas[1] || $palabra == $palabrasValidas[2])) {
            return 1;
        }
        else {
            return 0;
        }

}
echo "<br>";
echo validarPalabra("Parcial",20);

?>