<b>
<?php

/*

Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.

*/
$resultado = 0;
for($i=1; $resultado +$i < 1000; $i++) {
    echo "<br/>";
    $resultado += $i;
    echo "$resultado";
}
echo "<br/>";
echo $resultado;


echo "<br/>";
echo "Se sumaron $resultado numeros";

?>

<b>