<?php
require_once './ejercicio18.php';

$autoUno = new Auto('acs123','fiat','rojo',123456);
$autoDos = new Auto('aaa131','ford','verde',4567);
$autoTres = new Auto('asdsad123','fiat','azul',9789);
$autoCuatro = new Auto('bbb999','fiat','blanco',98795);
$autoCuatro = new Auto('bbb999','fiat','blanco',98795);

$MiGarage = new Garage('SantiGarages',150.5);

$MiGarage->Add($autoUno);

if ($MiGarage->Equals($autoCuatro)) {
    echo "<br>";
    echo "<br>";
    echo "el auto 4 esta en la lista y es equals";
}


$MiGarage->MostrarGarage();

$MiGarage->Remove($autoDos);

$MiGarage->getArray();


?>