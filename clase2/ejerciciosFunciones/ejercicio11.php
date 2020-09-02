<?php

/**Aplicación Nº 11 (Potencias de números)
 * Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 
 * (hacer una funciónque las calcule invocando la función ​pow​). */

function calcularPotencia(){
    for ($i=1; $i < 5; $i++) { 
        $calculo = pow(2,$i);
        echo "<br>";
        echo "$calculo";
    }
}

calcularPotencia();
?>