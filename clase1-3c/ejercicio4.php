<?php
/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.

*/
$operador = array('+','-','*','/');
$op1 = 5;
$op2 = 8;

echo "<br/>";
foreach ($operador as $key => $value) {
    switch ($value) {
        
        case '+':
            echo "$op1 + $op2: ";
            echo $op1 + $op2;
            echo "<br/>";
            break;
        case '-':
            echo "$op1 - $op2: ";
            echo $op1 - $op2;
            echo "<br/>";
            break;
        case '*':
            echo "$op1 * $op2: ";
            echo $op1 * $op2;
            echo "<br/>";
            break;
        case '/':
            if ($op2 == 0){
                echo "No se puede dividir por 0";
                echo "<br/>";
            }
            else{
                echo "$op1 / $op2: ";
                echo $op1 / $op2;
                echo "<br/>";
            }
            break;
    }
}

?>