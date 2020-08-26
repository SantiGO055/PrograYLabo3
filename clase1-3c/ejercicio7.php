<?php
/* 
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.
*/

$array = array();
for ($i=0; $i < 10; $i++) { 

    if($i % 2 != 0){
        array_push($array,$i);
    }
}
echo "<b> Utilizo foreach: </b>";

foreach ($array as $key => $value) {
    echo "<br/>";
    echo $value;
}
echo "<br/>";
echo "<b> Utilizo for: </b>";

for ($i=0; $i < count($array); $i++) { 
    echo "<br/>";
    echo $array[$i];
}
echo "<br/>";
echo "<b> Utilizo for: </b>";

for ($i=0; $i < count($array); $i++) { 
    echo "<br/>";
    echo $array[$i];
}
echo "<br/>";
echo "<b> Utilizo While: </b>";

$indiceParaWhile = 0;
while ($indiceParaWhile < count($array)) {
    echo "<br/>";
    echo $array[$indiceParaWhile];
    $indiceParaWhile++;
}

?>