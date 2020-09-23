<?php

include_once 'profesor.php';
include_once 'usuario.php';
include_once 'materias.php';


session_start();

$request_method = $_SERVER['REQUEST_METHOD'];
$path_info = $_SERVER['PATH_INFO'];

$listaDeMaterias = array();

$header = getallheaders();

$pathImg = '/imagenes';
$id= mt_rand();

switch($request_method)
{
    case 'POST':
        switch ($path_info) 
        {
            case '/usuario'://PUNTO 1
                $email =$_POST['email'] ?? "";
                $clave =$_POST['clave'] ?? "";
                // $foto = $_POST['foto'] ?? "";
                $claveEncriptada = Usuario::encriptarContraseña($clave);
                if(Usuario::CrearUsuario($email,$claveEncriptada))
                {
                    $datos = 'Se creo el usuario correctamente!';
                }
                else
                {
                    $datos = 'Error al crear usuario.';
                }
                break;
            case '/login'://PUNTO 2
                $email = $_POST['email'] ?? "";
                $clave = $_POST['clave'] ?? "";
                // if (Usuario::verificarContraseña($clave,$claveEncriptada)) {
                //     echo "contraseña correcta";
                // }
                // else{
                //     echo "contraseña incorrecta";
                // }

                if(Usuario::Login($email, $clave))
                {
                    $datos = 'Login Exitoso';
                }
                else
                {
                    $datos = 'Nombre o Clave Incorrectas';                       
                }
                break;
            case '/materia'://PUNTO 3
                $header = getallheaders();
                $token = $header['token'];
                $nombre = $_POST['nombre'] ?? "";
                $cuatrimestre = $_POST['cuatrimestre'] ?? "";
                
                $usuarioLogueado = Token::VerificarToken($token);
                
                if (!$usuarioLogueado) {
                    $datos = "Usuario no logueado, token incorrecto!";
                }
                else{
                    $materia = new Materias($nombre,$cuatrimestre);
                    
    
                    if(Archivos::guardarJson($materia,'materias.json')){
                        $datos = "Archivo guardado correctamente";
                    }
                    else{
                        $datos = "Ocurrio un error al guardar el archivo";
                    }
                }

                break;
            case '/profesor'://PUNTO 4
                $header = getallheaders();
                $token = $header['token'];
                $nombre = $_POST['nombre'] ?? "";
                $legajo = $_POST['legajo'] ?? 0;
                $listaProfes = [];
                //TODO terminar de hacer el alta del profesor si existe o no el legajo
                /**Si ya hay un archivo de profesores reviso si el legajo ya existe */
                $listaProfes = Archivos::leerJson('profesores.json',$listaProfesores);
                if(is_array($listaProfes)){
                    foreach ($listaProfes as $key => $value) {
                        if ($legajo == $value['legajo']) {
                            $datos = "Legajo existente";
                            $retorno = true;
                        }
                        else{
                            $retorno = false;
                        }
                    }
                }
                else{
                    $profesor = new Profesor($nombre,$legajo);
                    $listaProfes = $profesor;
                    if(Archivos::guardarJson($profesor,'profesores.json')){
                        $datos = "Profesor dado de alta";
                    }
                }
                if(Archivos::guardarJson($profesor,'profesores.json')){
                    $datos = "Profesor dado de alta";
                }

                
                //TODO leer json para ver si el legajo ya existe
                
                //$venta = new Venta($_POST['id_producto'], $_POST['cantidad'], $_POST['usuario']);
                //guardo venta seralizada
                // GuardarSerializado($venta, 'ventas.txt');
                // //modifico stock
                // if(Producto::ModificarStock($_POST['id_producto'], $_POST['cantidad']))
                // {
                //     $datos = 'Monto Venta: '. $datos;

                // }
            
            
            
                break;
            default:
            $datos = 'faltan datos';
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
            case '/stock':
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


$respuesta = new stdClass;
$respuesta->success = true;
$respuesta->data = $datos; 

echo json_encode($respuesta);
?>