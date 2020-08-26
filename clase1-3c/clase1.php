<?php
include './utils/funciones.php';
include_once './utils/funciones.php'; //con include_once se fija si el archivo ya esta cargado no lo carga

// require './utils/funciones.php';
// require_once './utils/funciones2.php'; //tira un error fatal y no se va a seguir ejecutando todo lo demas

$nombre = "SantiGO";
$edad = 99;
$sueldo = 999.99;

echo "Hola" . strtoupper($nombre);
echo "<br/>";

print("Edad: $edad");

echo "<br/>";

printf("Sueldo: %.02f",$sueldo);

echo "<br/>";
echo "<b>ARRAYS!!</b>";
$array = array(1,2,'33');

$array[5] = 55; //puedo agregar indices al array

array_push($array,666);
echo "<br/>";

$array_asoc = array("Lucas" => 4,"Martin" => 6, "Fernando" => 8);

echo "<br/>";
print_r($array); #muestra el indice y el dato almacenado en el array
echo "<br/>";
var_dump($array); //muestra el array con indice, el tipo de dato y el dato almacenado
echo "<br/>";
print_r($array_asoc); #muestra el indice y el dato almacenado en el array
echo "<br/>";
var_dump($array_asoc);

echo "<br/>";
foreach($array as $value){
    echo $value;
    echo "<br/>";
}

foreach($array as $value){
    var_dump($value);
    echo "<br/>";
}

foreach($array_asoc as $key => $value){
    echo "$key => $value";
    echo "<br/>";
}
echo "<br/>";
echo "<br/>";
echo "<br/>";
ksort($array_asoc);
foreach($array_asoc as $key => $value){
    echo "$key => $value";
    echo "<br/>";
}

echo "<br/>";
echo "<br/>";
echo "<br/>";
krsort($array_asoc);
foreach($array_asoc as $key => $value){
    echo "$key => $value";
    echo "<br/>";
}
echo "<br/>";
echo "<br/>";
echo "<br/>";

for($i=0; $i < 1000; $i++) {
    echo " - ";
    echo $i + 1;
    
}
echo "<br/>";
echo "<br/>";
echo "<br/>";


echo "<b>Funciones!!</b>";

echo "<br/>";
echo saludar('PEPE');
echo "<br/>";
echo saludar("pepe","sasdasd");

?>


