<?php
/*
Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
*/
$array_asociativo = array(1 => 90, 30 => 7,'e' => 99,'hola' => 'mundo');

foreach ($array_asociativo as $key => $value) {
    echo "<br/>";
    echo "$key => $value";
}

?>