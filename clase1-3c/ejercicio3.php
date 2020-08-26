<?php

$a = 1;
$b = 1;
$c = 9;

echo "<br/>";
echo "Numeros: $a, $b, $c";

echo "<br/>";
echo "Numero del medio: ";
echo "<br/>";
if($a > $b && $a < $c || $a < $b && $a < $c)
{
    echo $a;
}
elseif ($b > $a && $b < $c || $b < $a && $b > $c)
{
    echo $b;
}
elseif ($c > $a && $c < $b || $c < $a && $c > $b) {
    echo $c;
}
else
{
    echo "No hay valor del medio";
}


?>