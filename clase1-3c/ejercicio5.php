<?php

/*
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
*/

$num = 402;

if ($num == 20) {
    echo "veinte";
}
elseif ($num > 20 && $num<30) {
    echo "veinti ";
}
elseif ($num == 30) {
    echo "trinta";
}
elseif ($num >= 30 && $num < 40) {
    echo "trinta y ";
}
elseif ($num == 40) {
    echo "cuarenta";
}
elseif ($num > 40 && $num < 50) {
    echo "cuarenta y ";
}
elseif ($num == 50) {
    echo "cincuenta";
}
elseif ($num>50 && $num < 60) {
    echo "cincuenta y ";
}
elseif ($num == 60) {
    echo "sesenta";
}
$unidad = substr($num, -1);
switch ($unidad) {
    case '1':
        echo "uno";
        break;
    case '2':
        echo "dos";
        break;
    case '3':
        echo "tres";
        break;
    case '4':
        echo "cuatro";
        break;
    case '5':
        echo "cinco";
        break;
    case '6':
        echo "seis";
        break;
    case '7':
        echo "siete";
        break;
    case '8':
        echo "ocho";
        break;
    case '9':
        echo "nueve";
        break;
}

?>