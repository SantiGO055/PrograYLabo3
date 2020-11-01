<?php

// include_once './profesor.php';
// include_once './usuario.php';
// include_once './materias.php';
// include_once './AccesoDatos.php';

require __DIR__.'./vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

use Clases\Usuario;
use Clases\Materias;
use Clases\Archivos;
use Clases\Profesor;


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


$tablaMaterias = 'materias';
switch($request_method)
{
    case 'POST':
        switch ($pathAux[3]) 
        {
            
            case 'usuario'://PUNTO 1
                
                // echo $pathAux[4];
                $foto = $_POST['foto'] ?? "";
                $id = $_POST['id'] ?? 0;
                $email = $_POST['email'] ?? "";
                $nombreMateria = $_POST['nombreDeMateria'] ?? "";
                $clave = $_POST['clave'] ?? 0;


                // var_dump(manejoSql::obtenerId(1,'envios'));
                
                //TODO continuar practicando SQL
                
                if ($pathAux[4]== 'update') {

                    $objetoCelda = AccesoDatos::dameUnObjetoAcceso();
                    $resultadoUpdate = $objetoCelda->updateDatos($tablaMaterias,'Nombre',$nombreMateria,$id);
                    // var_dump($resultadoUpdate);
                    if (isset($resultadoUpdate)) {
                        // echo "encontre el id y lo modifique correctamente";
                        $datos .= "Se modificaron los siguientes datos en la base: ID: " . $objetoCelda->id . ' Nombre: ' . $objetoCelda->nombre . ' cuatrimestre ' . $objetoCelda->cuatrimestre;
                    }
                    else{
                        $datos = "No existe el id buscado";
                    }
                    
                }
                else if ($pathAux[4]== 'alta'){
                    // $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();
                    // $celda = $objetoAcceso->obtenerCelda(0,'usuarios');
                    
                    //FIXME hacer esto dentro de la clase Usuario
                    
                    if(Usuario::CrearUsuario($email,$clave))
                    {
                        $datos = 'Se creo el usuario correctamente!';
                    }
                    else
                    {
                        $datos = 'Error al crear usuario. Email no valido o existente';
                    }
                    // $imagenNombre = Archivos::guardarImagen($_FILES,3670016,'\imagenes',true);
                    
                    // $objetoAcceso->insertDatosUsuario('usuarios',3,$email,$clave,$imagenNombre);
                    
                    // if(Usuario::CrearUsuario($email,$claveEncriptada){

                    // }
                    
                    // var_dump($objetoAcceso);
                    // $datos .= "ID: " . $celda['id'] . ' Nombre: ' . $celda['nombre'] . ' cuatrimestre ' . $celda['cuatrimestre'];
                    
                }
                // if(Usuario::asignarFotoNueva($pathAux[4],$foto)){
                    
                //     $datos = "Se asigno la foto al usuario correctamente";
                // }
                // else{
                //     $datos = "Error al asignar la foto";
                // }

                
                // else{
                
                //     $email =$_POST['email'] ?? "";
                //     $clave =$_POST['clave'] ?? "";
                //     // $foto = $_POST['foto'] ?? "";
                //     $claveEncriptada = Usuario::encriptarContraseña($clave);
                //     if(Usuario::CrearUsuario($email,$claveEncriptada))
                //     {
                //         $datos = 'Se creo el usuario correctamente!';
                //     }
                //     else
                //     {
                //         $datos = 'Error al crear usuario. Email no valido';
                //     }
                // }
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