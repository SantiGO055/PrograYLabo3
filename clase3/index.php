<?php
/* Index del ejercicio17.php */
require_once './auto.php';
require_once '../clasesParaParcial/archivos.php';


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
$miListaDeAutos = array();
var_dump($method);
echo $method . ' ' . $path;
$retorno = false;
// switch ($path) {
//     case '/auto':
    if ($method == 'POST') {
        $marca =$_POST['marca'] ?? 0;
        $color =$_POST['color'] ?? "";
        $patente =$_POST['patente'] ?? "";
        $precio =$_POST['precio'] ?? 0;
        
        $auto = new Auto($patente,$marca,$color,$precio);
        
        Archivos::serializar("pruebaDeSerializacion.txt",$auto);
        Archivos::guardarJson("guardoJSON.json",$auto);
    }
    else if($method == 'GET'){
        $color =$_GET['color'] ?? "";
        $patente =$_GET['patente'] ?? "";
        $precio =$_GET['precio'] ?? 0;
        $marca =$_GET['marca'] ?? 0;

        $patente2 = $_GET['buscar'] ?? '';
        $arrayJson = Archivos::leerJson("guardoJSON.json");
        
        echo strlen($patente2);
        if(strlen($patente2) >=5 && strlen($patente2) <=10){
            if($arrayJson != null){
                foreach ($arrayJson as $a) {
                    if($a->_patente == $patente2){
                        echo "Se encontro: ".$a->_patente;
                        $retorno = true;
                    }
                    else{
                        echo "no se encontro la patente";
                    }
                }
            }
            else{
                echo "lista vacia";
            }
        }
    }
    else{
        echo "Metodo no permitido";
    }
        //break;
    
    
// }





            
$auto1 = new Auto("asd123","fiat","rojito",123456);
$auto2 = new Auto("asd123","fiat","rojito",123456);

//Archivos::guardarJson("guardoJSON.json",$auto);


//HACER CLASES DE TIPO JSEND PARA MOSTRAR EN EL JSON DE LA MANERA SIGUIENTE:

/**{
    status : "success",
    data : {
        "post" : { "id" : 1, "title" : "A blog post", "body" : "Some useful content" }
     }
} */


?>