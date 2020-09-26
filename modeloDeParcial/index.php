<?php

include_once 'profesor.php';
include_once 'usuario.php';
include_once 'materias.php';


session_start();

$request_method = $_SERVER['REQUEST_METHOD'];
$path_info = $_SERVER['PATH_INFO'];

$listaDeMaterias = array();
$listaDeMateriasProfe = array();

$header = getallheaders();
$listaProfes = [];


$pathAux = explode('/', getenv('REQUEST_URI'));

// var_dump($_SERVER);
// echo "<br>";
// var_dump($pathAux);
// echo "<br>";

echo "<br>";
switch($request_method)
{
    case 'POST':
        switch ($pathAux[3]) 
        {
            
            case 'usuario'://PUNTO 1
                if (isset($pathAux[4])) {
                    // echo $pathAux[4];
                    $foto = $_POST['foto'] ?? "";

                    if(Usuario::asignarFotoNueva($pathAux[4],$foto)){
                        
                        $datos = "Se asigno la foto al usuario correctamente";
                    }
                    else{
                        $datos = "Error al asignar la foto";
                    }

                }
                else{
                
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
                        $datos = 'Error al crear usuario. Email no valido';
                    }
                }
                break;
            case 'login'://PUNTO 2
                $email = $_POST['email'] ?? "";
                $clave = $_POST['clave'] ?? "";
                $token = Usuario::Login($email, $clave);
                if(Usuario::Login($email, $clave))
                {
                    $datos = 'Login Exitoso. TOKEN: ' . $token;
                }
                else
                {
                    $datos = 'Nombre o Clave Incorrectas';                       
                }
                break;
            case 'materia'://PUNTO 3
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
                        $datos = "Materia guardada correctamente";
                    }
                    else{
                        $datos = "Ocurrio un error al guardar la materia";
                    }
                }

                break;
            case 'profesor'://PUNTO 4
                $header = getallheaders();
                $token = $header['token'];
                $nombre = $_POST['nombre'] ?? "";
                $legajo = $_POST['legajo'] ?? 0;

                $usuarioLogueado = Token::VerificarToken($token);

                $profesor = new Profesor($nombre,$legajo);

                if(Archivos::guardarJson($profesor,'profesores.json')){
                    $datos = "Profesor dado de alta";
                }
                else{
                    $datos = "Profesor no dado de alta";
                }

                break;
            default:
            $datos = 'faltan datos';
            break;

            case 'asignacion': //PUNTO 5
                $header = getallheaders();
                $token = $header['token'];
                $legajo = $_POST['legajo'] ?? "";
                $idMateria = $_POST['idMateria'] ?? 0;
                $turno = $_POST['turno'] ?? "";
                $usuarioLogueado = Token::VerificarToken($token);

                if (!$usuarioLogueado) {
                    $datos = "token incorrecto";
                }
                else{
                    //Leo json de materias
                    $listaDeMaterias = Archivos::leerJson('materias.json', $listaDeMaterias);

                    //Leo json de profesores
                    $listaProfes = Archivos::leerJson('profesores.json', $listaProfes);
                    
                    //leo json de materias-profesores
                    $listaDeMateriasProfe = Archivos::leerJson('materias-profesores.json', $listaDeMateriasProfe);
                    $profesorMateria = Profesor::asignarMateria($listaDeMaterias,$listaProfes,$listaDeMateriasProfe, $legajo,$idMateria,$turno);
                    
                    if($profesorMateria instanceof Profesor && $profesorMateria != null){
                        Archivos::guardarJson($profesorMateria,'materias-profesores.json');
                        $datos = "Se agrego el profesor a la materia}";
                    }
                    else{
                        $datos = $profesorMateria;
                    }
                }
            break;
            
        }
    break;
    
    case 'GET':
        //$datos = Usuario::Mostrar($token);
        $token = $header['token'];
        $usuarioLogueado = Token::VerificarToken($token);

        if (!$usuarioLogueado) {
            $datos = "token incorrecto";
        }
        else{
            
            switch ($path_info){
            case '/materias':
                $datos = Materias::mostrarMaterias();
                if ($datos === "") {
                    $datos = 'Faltan datos';
                }
                
                break;
            case '/profesor'://PUNTO 6
                $datos = Profesor::mostrarProfesores();
                if($datos === "")
                {
                    $datos = 'Faltan datos';
                }
                //echo json_encode($respuesta);
                break;
            case '/asignacion':
                $datos = Profesor::mostrarMateriasAsignadas();
                if($datos === "")
                {
                    $datos = 'Faltan datos';
                }
                //echo json_encode($respuesta);
                break;
            
            default:
            $datos = 'faltan datos';
            break;
            }
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