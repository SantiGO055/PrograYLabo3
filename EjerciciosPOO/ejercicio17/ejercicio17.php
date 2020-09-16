<?php
/* Index del ejercicio17.php */
require_once './auto.php';
require_once '../clase2/archivos/archivos.php';


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

var_dump($method);
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
            $auto = new Auto($patente,$marca,$color,$precio);
        }
        else{
            echo "Metodo no permitido";
        }
        break;
    
    default:
        # code...
        break;
}

Archivos::serializarAuto("pruebaDeSerializacion.txt",$auto);

// var_dump($_GET);

// var_dump($_POST); //es mas seguro usar metodo post por que no es visible en la url, envia los datos por body
// $marca =$_POST['marca'] ?? 0;
// $color =$_POST['color'] ?? "";
// $patente =$_POST['patente'] ?? "";
// $precio =$_POST['precio'] ?? 0;
//si pongo @ adelante de algo no envio el error a pantalla
//si no envio por ejemplo el precio desde postman va a dar error

/**uso isset para preguntar si esta definido tal valor
 * en este caso si el string 'color' viene por el metodo get
 */
// if (isset($_GET['color'])) {
//     $color =$_GET['color'];
// }
// else {
//     $color = "";
// }
// //una manera mas facil de hacer esto es:
// $patente =$_GET['patente'] ?? "";
// $precio =$_GET['precio'] ?? 0;


// $marca =$_GET['marca'] ?? 0;



// $auto = new Auto($patente,$marca,$color,$precio);
// echo $auto;

// echo "<br/>";
// $auto->_marca = "fiat";
// echo $auto->_marca;
?>