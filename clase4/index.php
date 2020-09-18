<?php

include_once './auto.php';
include_once '../clasesParaParcial/archivos.php';
include_once './token.php';

$miListaDeAutos = array();







//EJERCICIO 
/**Subir una imagen
 * Validar que sea imagen
 * Validar menor a 3.5mb
 * Cambiarle el nombre por nombre unico.
 */


 

echo Archivos::guardarImagen($_FILES,3670016,'./img/');
Token::manejarToken();

//para eliminar voy a pasarle por el metodo get el nombre del archivo
//Archivos::eliminarImagen('./img/7935.png','./backup/7935.png');

/**vamos a dar permiso a determinadas peticiones, para entrar a la peticion debe tener permiso y sino no pasa */
/**Seguiremos arquitectura de peticiones php, las peticiones que llegan no guardamos el estado de ellas, no las vamos a usar */
/**Autenticaremos sin estado, sin guardar informacion del usuario que hace las peticiones
 * obligamos en cada peticion a que nos envien todos los datos para autenticarse
 * para autenticar y dejar autenticado usaremos jwt.io para no consultar con servidor de nuevo usuario y pass
 * con composer en consola dentro del proyecto puedo ejecutar comandos para instalar librerias
 * cualquier libreria se instala dentro de la carpeta vendor, incluimos un archivo definido en la documentacion de la libreria
 */

#region esto lo pase a la clase archivos de la carpeta clasesParaParcial
// $extensionExplode = explode('.',$_FILES['archivo']['name']);
// $extension = $extensionExplode[1];
// echo "<br>";
// echo "<br>";
// echo "<br>";
// echo "<br>";


// //$extension = ".png"; //hardcodeada pero realizar funcion para saber la extension que llega
// $aleatorio = rand(1000,100000);
// $origen = $_FILES['archivo']['tmp_name'];
// $destino = "img/" . $aleatorio .'.' . $extension;// $_FILES['archivo']['name'];

/**
 * array de imagenes images
            
 */

/**Al borrar la imagen lo que hacemos es moverla a una ubicacion llamada backup pero no del move_uploaded_file sino de otra manera
 * Tambien realizar marca de agua para pegarle una imagen a otra - php watermark image
 */

// if(Archivos::esImagen($extension)){
//     $subido = move_uploaded_file($origen,$destino);
//     echo "paso";
// }
// else{
//     echo " no paso";
//     $subido = false;
// }
// echo "$origen <br> $destino";
// if($subido){
//     echo "Se movio";
// }
// else{
//     echo "No se movio";
// }
#endregion

#region MetodosPostYGet

$method = $_SERVER["REQUEST_METHOD"];
$path = $_SERVER['PATH_INFO'] ?? 0;
// switch ($path) {
//     case '/auto':
    if ($method == 'POST') {
        $marca =$_POST['marca'] ?? 0;
        $color =$_POST['color'] ?? "";
        $patente =$_POST['patente'] ?? "";
        $precio =$_POST['precio'] ?? 0;
        
        //$auto = new Auto($patente,$marca,$color,$precio);
        
        // Archivos::serializar("pruebaDeSerializacion.txt",$auto);
        // Archivos::guardarJson("guardoJSON.json",$auto);
    }
    else if($method == 'GET'){
        $color =$_GET['color'] ?? "";
        $patente =$_GET['patente'] ?? "";
        $precio =$_GET['precio'] ?? 0;
        $marca =$_GET['marca'] ?? 0;


        

        //APACHE MANEJA LOS ARCHIVOS Y CREA UN ARCHIVO TEMPORAL CON EL ARCHIVO RECIBIDO


        #region coment
        // $patente2 = $_GET['buscar'] ?? '';
        // $arrayJson = Archivos::leerJson("guardoJSON.json");


        
        // echo strlen($patente2);
        // if(strlen($patente2) >=5 && strlen($patente2) <=10){
        //     if($arrayJson != null){
        //         foreach ($arrayJson as $a) {
        //             if($a->_patente == $patente2){
        //                 echo "Se encontro: ".$a->_patente;
        //                 $retorno = true;
        //             }
        //             else{
        //                 echo "no se encontro la patente";
        //             }
        //         }
        //     }
        //     else{
        //         echo "lista vacia";
        //     }
        // }
        #endregion
    }
    else{
        echo "Metodo no permitido";
    }
        //break;
    
    
// }

#endregion
?>