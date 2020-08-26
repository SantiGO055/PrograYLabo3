<?php
/*
Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

//$lapiceras = array('color'=>'color','marca' => 'marca','trazo' => 'trazo', 'precio' => 'precio');


$arrayDeArrays = array(
    'lapicera1' => array('color'=>'color','marca' => 'marca','trazo' => 'trazo', 'precio' => 'precio'),
    'lapicera2' => array('color'=>'color','marca' => 'marca','trazo' => 'trazo', 'precio' => 'precio'),
    'lapicera3' => array('color'=>'color','marca' => 'marca','trazo' => 'trazo', 'precio' => 'precio')
);

$arrayDeArrays['lapicera1']['color'] = 'rojo';
$arrayDeArrays['lapicera1']['marca'] = 'bic';
$arrayDeArrays['lapicera1']['trazo'] = 'fino';
$arrayDeArrays['lapicera1']['precio'] = '$4';

$arrayDeArrays['lapicera2']['color'] = 'azul';
$arrayDeArrays['lapicera2']['marca'] = 'bic';
$arrayDeArrays['lapicera2']['trazo'] = 'grueso';
$arrayDeArrays['lapicera2']['precio'] = '$3';

$arrayDeArrays['lapicera3']['color'] = 'negro';
$arrayDeArrays['lapicera3']['marca'] = 'bic';
$arrayDeArrays['lapicera3']['trazo'] = 'fino';
$arrayDeArrays['lapicera3']['precio'] = '$6';

foreach ($arrayDeArrays as $key1 => $value) {
    foreach ($value as $key2 => $valor) {
        echo "<br/>";
        echo "$key2: $valor";
    }
}
?>