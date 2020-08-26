<?php

/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
*/

$lapicera = array('color'=>'color','marca' => 'marca','trazo' => 'trazo', 'precio' => 'precio');

$lapicera['color'] = 'rojo';
$lapicera['marca'] = 'bic';
$lapicera['trazo'] = 'fino';
$lapicera['precio'] = '$3';

echo "<br/>";
echo "<b> Lapicera 1: </b>";
foreach ($lapicera as $key => $value) {
    echo "<br/>";
    echo "$key: $value";
}
$lapicera['color'] = 'azul';
$lapicera['marca'] = 'bic';
$lapicera['trazo'] = 'grueso';
$lapicera['precio'] = '$6';

echo "<br/>";
echo "<b> Lapicera 2: </b>";
foreach ($lapicera as $key => $value) {
    echo "<br/>";
    echo "$key: $value";
}

$lapicera['color'] = 'negro';
$lapicera['marca'] = 'faber castel';
$lapicera['trazo'] = 'medio';
$lapicera['precio'] = '$7';

echo "<br/>";
echo "<b> Lapicera 3: </b>";
foreach ($lapicera as $key => $value) {
    echo "<br/>";
    echo "$key: $value";
}


?>