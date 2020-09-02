<?php
/* Index del ejercicio17.php */
require_once './clases/ejercicio17.php';

/**
 * METODOS
 * GET: OBTENER RECURSOS.
 * POST: CREAR RECURSOS.
 * PUT: MODIFICAR RECURSOS.
 * DELETE: BORRAR RECURSOS.
 */


//var_dump($_SERVER);
$method = $_SERVER["REQUEST_METHOD"];
$path = $_SERVER['PATH_INFO'] ?? 0;

echo $method . ' ' . $path;
switch ($path) {
    case '/auto':
        if ($method == 'POST') {
            $marca =$_POST['marca'] ?? 0;
            $color =$_POST['color'] ?? "";
            $patente =$_POST['patente'] ?? "";
            $precio =$_POST['precio'] ?? 0;
            
            $auto = new Auto($patente,$marca,$color,$precio);
        }
        else if($method == 'GET'){
            $color =$_GET['color'] ?? "";
            $patente =$_GET['patente'] ?? "";
            $precio =$_GET['precio'] ?? 0;
            $marca =$_GET['marca'] ?? 0;
        }
        else{
            echo "Metodo no permitido";
        }
        break;
    
    default:
        # code...
        break;
}


var_dump($_GET);

var_dump($_POST); //es mas seguro usar metodo post por que no es visible en la url, envia los datos por body
$marca =$_POST['marca'] ?? 0;
$color =$_POST['color'] ?? "";
$patente =$_POST['patente'] ?? "";
$precio =$_POST['precio'] ?? 0;
//si pongo @ adelante de algo no envio el error a pantalla
//si no envio por ejemplo el precio desde postman va a dar error


if (isset($_GET['color'])) {
    $color =$_GET['color'];
}
else {
    $color = "";
}
$patente =$_GET['patente'] ?? "";
$precio =$_GET['precio'] ?? 0;

//una manera mas facil de hacer esto es:
$marca =$_GET['marca'] ?? 0;



// $auto = new Auto($patente,$marca,$color,$precio);
// echo $auto;

// echo "<br/>";
// $auto->_marca = "fiat";
// echo $auto->_marca;
?>