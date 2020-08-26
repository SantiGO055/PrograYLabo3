<?php

$array = array(rand(1,20),rand(1,20),rand(1,20),rand(1,20),rand(1,20));
$suma = $array[0] + $array[1] + $array[2] + $array[3] + $array[4];
$promedio = $suma / count($array);
echo "Los numeros son: $array[0], $array[1], $array[2], $array[3], $array[4]";
echo "<br/>";
echo "La suma de los numeros es $suma";
echo "<br/>";
echo "<b>";
if ($promedio > 6) {
    echo "El promedio de los numeros es mayor a 6";
}
elseif ($promedio == 6) {
    echo "El promedio de los numeros es igual a 6";
}
elseif ($promedio < 6) {
    echo "El promedio de los numeros es menor que 6";
}
echo "</b>";
?>