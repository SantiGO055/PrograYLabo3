<?php

include_once 'profesor.php';
include_once 'usuario.php';

// $method = $_SERVER["REQUEST_METHOD"];
// $path = $_SERVER['PATH_INFO'] ?? 0;
// // switch ($path) {
// //     case '/auto':
//     if ($method == 'POST') {
//         $email =$_POST['email'] ?? 0;
//         $clave =$_POST['clave'] ?? "";
//         $foto =$_POST['foto'] ?? "";
//         Usuario::CrearUsuario($email,$clave);

//         //$auto = new Auto($patente,$marca,$color,$precio);
        
//         // Archivos::serializar("pruebaDeSerializacion.txt",$auto);
//         // Archivos::guardarJson("guardoJSON.json",$auto);
//     }
//     else if($method == 'GET'){
//         $email =$_POST['email'] ?? 0;
//         $clave =$_POST['clave'] ?? "";
//         $foto =$_POST['foto'] ?? "";


//     }
//     else{
//         echo "Metodo no permitido";
//     }

session_start();

$request_method = $_SERVER['REQUEST_METHOD'];
$path_info = $_SERVER['PATH_INFO'];


$header = getallheaders();

$pathImg = '/imagenes';
$id= mt_rand();

switch($request_method)
{
    case 'POST':
        switch ($path_info) 
        {
            case '/usuario'://PUNTO 1
                $email =$_POST['email'] ?? 0;
                $clave =$_POST['clave'] ?? "";
                // $foto = $_POST['foto'] ?? "";

                if(Usuario::CrearUsuario($email,$clave))
                {
                    $datos = 'Se creo el usuario correctamente!';
                }
                else
                {
                    $datos = 'Error al crear usuario.';
                }
                break;
            case '/login'://PUNTO 2
                $email =$_POST['email'] ?? 0;
                $clave =$_POST['clave'] ?? "";

                    if(Usuario::Login($email, $clave))
                    {
                        $datos = 'Login Exitoso';
                    }
                    else
                    {
                        $datos = 'Nombre o Clave Incorrectas';                       
                    }
                
                //echo json_encode($respuesta);
                break;
            case '/stock'://PUNTO 3
                $header = getallheaders();
                $token = $header['token'];

                $auxUsu = ValidadorJWT::VerificarToken($token);
                $tipoUsuario = Usuario::EsAdmin($auxUsu);
                if($tipoUsuario)//true admin / false user
                {
                    if(isset($_POST['producto']) && isset($_POST['marca']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_FILES['foto']))
                    {
                        //var_dump($_FILES['foto']);
                        $producto = new Producto($_POST['producto'], $_POST['marca'], $_POST['precio'], $_POST['stock'], $id , $_FILES['foto']['tmp_name']);
                        //var_dump($producto);
                        move_uploaded_file($_FILES['foto']['tmp_name'], 'imagenes/' . $_FILES['foto']['name']);
                        GuardarJson($producto, 'producto.json');
                        $datos = 'post stock ok';
                    }
                    else
                    {                        
                        $datos = 'Faltan datos';
                    }
                }
                else
                {       
                    $datos = 'Debe ser usuario tipo Admin';
                }
                //echo json_encode($respuesta);
                break;
            case '/Ventas'://PUNTO 5
                $token = $header['token'];
                $auxUsu = ValidadorJWT::VerificarToken($token);
                $tipoUsuario = Usuario::EsAdmin($auxUsu);
                if($tipoUsuario ==  false)//true admin / false user
                {
                    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && isset($_POST['usuario']))
                    {
                        $datos = Producto::VerificarStock($_POST['id_producto'], $_POST['cantidad']);
                        
                        if($datos != 0)
                        {
                            $venta = new Venta($_POST['id_producto'], $_POST['cantidad'], $_POST['usuario']);
                            //guardo venta seralizada
                            GuardarSerializado($venta, 'ventas.txt');
                            //modifico stock
                            if(Producto::ModificarStock($_POST['id_producto'], $_POST['cantidad']))
                            {
                                $datos = 'Monto Venta: '. $datos;

                            }
                        }
                        else
                        {
                            $datos = 'venta no realizada, no alcanza el stock';
                        }
                    }
                }
                else
                {
                    $datos = 'Debe ser usuario tipo User';                   
                }
                //echo json_encode($respuesta);
                break;
            default:
            $datos = 'faltan datos';
            // 
                break;
        }
    break;
    
    case 'GET':
        //$datos = Usuario::Mostrar($token);
        $token = $header['token'];
        $auxUsu = ValidadorJWT::VerificarToken($token);
        $tipoUsuario = Usuario::EsAdmin($auxUsu);
        
        switch ($path_info) 
        {
            case '/stock'://PUNTO 4
                $datos = Producto::MostrarProductos();
                $datos != '' ??  $datos = 'Faltan datos';
                //echo json_encode($respuesta);
                break;
            case '/ventas'://PUNTO 6
                if(isset($token))
                {
                    if($tipoUsuario)//admin
                    {
                        //mostrar todas las ventas
                        $datos = Venta::MostrarVentas();
                    }
                    else//user
                    {
                        //mostrar ventas del usuario
                        $datos = Venta::MostrarVenta($auxUsu);
                    }
                }
                else
                {
                    $datos = 'Faltan datos';    
                }
                //echo json_encode($respuesta);
                break;
            default:
                $datos = 'faltan datos';
                break;
    }
    break;  
    default:
    break;
}



?>