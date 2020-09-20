<?php

include_once "./operario.php";
include_once "./fabrica.php";

/**Alta de operarios */
$op1 = new Operario(13456,"gonzalez","santiago",15000.00);
$op2 = new Operario(13456,"gonzalez","santiago",15000.00);
$op3 = new Operario(456,"pipi","cucu",10000.00);
$op4 = new Operario(78,"asd","dsa",11000.00);
/**Alta de fabrica */
$fabrica1 = new Fabrica("LaFabricaDePastas");
/**Le aumento el salario al operario1 */
$op1->SetAumentarSalario(10);
/**Muestro datos del operario1 */
echo "<br>" . Operario::MostrarOp($op1) . "<br>";

/**Operarios iguales, los muestro con metodo de instancia */
if ($op1->Equals($op1,$op2)) {
    echo "El operador " . $op1->Mostrar() . " es igual al operador " . $op2->Mostrar() . "<br>";
}
/**Prueba de metodo de clase mostrar */
echo "Prueba de metodo de clase mostrar <br>";
echo Operario::MostrarOp($op1);

echo "<br><br>";
/**Agrego operarios a la fabrica */
$fabrica1->Add($op1);
$fabrica1->Add($op3);
$fabrica1->Add($op4);
/**Cantidad total de pago de salarios:  */
echo Fabrica::MostrarCosto($fabrica1);

/**Elimino operario de la fabrica */
$fabrica1->Remove($op3);
/**Muestro datos de la fabrica */
echo "Muestro datos de la fabrica<br>";
$fabrica1->Mostrar($fabrica1);

?>