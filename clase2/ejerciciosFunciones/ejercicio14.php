<?php

/**Aplicación Nº 14 (Par e impar)
 * Crear una función llamada ​esPar​ que reciba un valor entero como parámetro y 
 * devuelva ​TRUEsi este número es par ó ​FALSE​ si es impar.
 * Reutilizando el código anterior, crear la función ​esImpar​. */

function esPar($num){
    if ($num % 2 == 0) {
        return true;
    }
    else {
        return false;
    }
}

function esImpar($num){
    if (!esPar($num)) {
        return true;
    }
    else {
        return false;
    }
}

if (esImPar(3)) {
    echo "es impar";
}
else {
    echo "no es impar";
}



?>