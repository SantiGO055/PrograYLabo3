<?php

require_once './ejercicio19.php';

$pasajero1 = new Pasajero("perez","juan","123456789",true);
$pasajero2 = new Pasajero("gonzalez","juan","123456789",true);
$pasajero3 = new Pasajero("mulfetti","jacinto","51222333",false);
$pasajero4 = new Pasajero("rodriguez","juan","36985624",true);
$pasajero5 = new Pasajero("luli","victoria","45789651",false);
$pasajero6 = new Pasajero("luli","javier","45678912",false);

$vuelo1 = new Vuelo("lasPerlas",1000,2);
$vuelo2 = new Vuelo("latam",1000,3);
$vuelo3 = new Vuelo("aerolineas",1000,1);

echo "<br>Pasajeros iguales: <br>";
if($pasajero1->Equals($pasajero1,$pasajero2))
echo " " . $pasajero1->MostrarPasajero();

echo "<br><br>Agrego pasajeros al vuelo 1<br>";
echo "<br> " . $vuelo1->AgregarPasajero($pasajero1);
echo "<br> " . $vuelo1->AgregarPasajero($pasajero2);
echo "<br> " . $vuelo1->AgregarPasajero($pasajero3);
echo "<br> " . $vuelo2->AgregarPasajero($pasajero3);
echo $vuelo1->MostrarVuelo();


echo "<br>La suma de los vuelos es de: <br>";
echo $vuelo1->Add($vuelo1,$vuelo2);
Vuelo::Remove($pasajero3,$vuelo1);
echo "<br><br><br><br><br><br><br><br><br>";
echo $vuelo1->MostrarVuelo();

?>