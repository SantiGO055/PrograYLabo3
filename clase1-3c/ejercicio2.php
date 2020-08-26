<?php

/*

Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.

*/


$fecha = date("d/m/Y");
$mes = date("m");

echo "Hoy es " . $fecha . "<br>";

echo "Estacion del año: ";

switch ($mes) {
    case '12':
    case '1':
    case '2':
    case '3':
        echo "Verano";
    break;
    case '4':
    case '5':
    case '6':
        echo "Otoño";
    break;
    case '7':
    case '8':
    case '9':
        echo "Invierno";
    break;
    case '10':
    case '11':
        echo "Primavera";
    break;
}
?>