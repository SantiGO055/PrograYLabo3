<?php
require __DIR__ . '/vendor/autoload.php';
use Clases\Profesor;
use Clases\Materias;
use Clases\Token;
use Clases\Usuario;
use Config\Database;
use \Firebase\JWT\JWT;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Slim\Exception\HttpNotFoundException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use Slim\Middleware\ErrorMiddleware;
use Slim\Exception\NotFoundException;

use App\Controllers\UserController;
use App\Middlewares\JsonMiddleware;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\UserMiddleware;
use App\Middlewares\AdminMiddleware;


session_start();

$app = AppFactory::create();
$app->setBasePath("/modeloParcial2");


$app->addRoutingMiddleware();

//para cuando utilice el token
// $headers = $request->getHeaders();
// $headerValueArray = $request->getHeader('Accept');

// $app->get('/usuario/{name}', function (Request $request, Response $response, $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
    
//     $datos = $response;
//     return $response;
// });

new Database();
// $app->post('/altaUsuario', function (Request $request, Response $response, $args) {
//     echo "hola";
//     return $response;
// });
$app->group('', function (RouteCollectorProxy $group) {
    $group->post('/altaUsuario', UserController::class . ":altaUsuario");
    $group->post('/login', UserController::class . ":login");

    $group->group('', function(RouteCollectorProxy $groupUser) {
        $groupUser->post('/vehiculo', UserController::class . ":Vehiculo");
        $groupUser->get('/patente/{patente}', UserController::class . ":getVehiculo");
        $groupUser->post('/servicio', UserController::class . ":altaServicio");
        $groupUser->post('/turno', UserController::class . ":altaTurno")->add(new UserMiddleware);
        
    })->add(new AuthMiddleware);
    $group->get('/getStats[/{tipo}]', UserController::class . ":getStats")->add(new AdminMiddleware);

    $group->get('/getAllUsers', UserController::class . ":getAllUsers");
    $group->get('/getAllVehiculos', UserController::class . ":getAllVehiculos");
    $group->get('/getServicios/{id}', UserController::class . ":getServicios");

    

    
    $group->put('/{id}', UserController::class . ":update");

    $group->delete('/{id}', UserController::class . ":delete");
});
// ->add(new UserMiddleware)->add(new AuthMiddleware); //primero se ejecuta el ultimo, si no da ok el auth no se ejecuta el userMiddleware
$app->add(new JsonMiddleware);
// ->add(function ($request, $handler) {
//     $response = $handler->handle($request);
//     $response->getBody()->write('AFTER');
//     return $response;
// });



// $app->post('/materia', UserController::class . ":Materia");









// echo $pathAux[3];

// echo "<br>";
// switch($request_method)
// {
//     case 'POST':
//         switch ($pathAux[3]) 
//         {
            
//             case 'usuario'://PUNTO 1
//                 if (isset($pathAux[4])) {
//                     // echo $pathAux[4];
//                     $foto = $_POST['foto'] ?? "";

//                     if(Usuario::asignarFotoNueva($pathAux[4],$foto)){
                        
//                         $datos = "Se asigno la foto al usuario correctamente";
//                     }
//                     else{
//                         $datos = "Error al asignar la foto";
//                     }

//                 }
//                 else{
                
//                     $email =$_POST['email'] ?? "";
//                     $clave =$_POST['clave'] ?? "";
//                     // $foto = $_POST['foto'] ?? "";
                    
//                     $claveEncriptada = Usuario::encriptarContraseña($clave);
//                     if(Usuario::CrearUsuario($email,$claveEncriptada))
//                     {
//                         $datos = 'Se creo el usuario correctamente!';
//                     }
//                     else
//                     {
//                         $datos = 'Error al crear usuario. Email no valido';
//                     }
//                 }
//                 break;
//             case 'login'://PUNTO 2
//                 $email = $_POST['email'] ?? "";
//                 $clave = $_POST['clave'] ?? "";
//                 $token = Usuario::Login($email, $clave);
//                 if(Usuario::Login($email, $clave))
//                 {
//                     $datos = 'Login Exitoso. TOKEN: ' . $token;
//                 }
//                 else
//                 {
//                     $datos = 'Nombre o Clave Incorrectas';                       
//                 }
//                 break;
//             case 'materia'://PUNTO 3
//                 $header = getallheaders();
//                 $token = $header['token'];
//                 $nombre = $_POST['nombre'] ?? "";
//                 $cuatrimestre = $_POST['cuatrimestre'] ?? "";
                
//                 $usuarioLogueado = Token::VerificarToken($token);
                
//                 if (!$usuarioLogueado) {
//                     $datos = "Usuario no logueado, token incorrecto!";
//                 }
//                 else{
//                     $materia = new Materias($nombre,$cuatrimestre);
                    
    
//                     if(Archivos::guardarJson($materia,'materias.json')){
//                         $datos = "Materia guardada correctamente";
//                     }
//                     else{
//                         $datos = "Ocurrio un error al guardar la materia";
//                     }
//                 }

//                 break;
//             case 'profesor'://PUNTO 4
//                 $header = getallheaders();
//                 $token = $header['token'];
//                 $nombre = $_POST['nombre'] ?? "";
//                 $legajo = $_POST['legajo'] ?? 0;

//                 $usuarioLogueado = Token::VerificarToken($token);

//                 $profesor = new Profesor($nombre,$legajo);

//                 if(Archivos::guardarJson($profesor,'profesores.json')){
//                     $datos = "Profesor dado de alta";
//                 }
//                 else{
//                     $datos = "Profesor no dado de alta";
//                 }

//                 break;
//             default:
//             $datos = 'faltan datos';
//             break;

//             case 'asignacion': //PUNTO 5
//                 $header = getallheaders();
//                 $token = $header['token'];
//                 $legajo = $_POST['legajo'] ?? "";
//                 $idMateria = $_POST['idMateria'] ?? 0;
//                 $turno = $_POST['turno'] ?? "";
//                 $usuarioLogueado = Token::VerificarToken($token);

//                 if (!$usuarioLogueado) {
//                     $datos = "token incorrecto";
//                 }
//                 else{
//                     //Leo json de materias
//                     $listaDeMaterias = Archivos::leerJson('materias.json', $listaDeMaterias);

//                     //Leo json de profesores
//                     $listaProfes = Archivos::leerJson('profesores.json', $listaProfes);
                    
//                     //leo json de materias-profesores
//                     $listaDeMateriasProfe = Archivos::leerJson('materias-profesores.json', $listaDeMateriasProfe);
//                     $profesorMateria = Profesor::asignarMateria($listaDeMaterias,$listaProfes,$listaDeMateriasProfe, $legajo,$idMateria,$turno);
                    
//                     if($profesorMateria instanceof Profesor && $profesorMateria != null){
//                         Archivos::guardarJson($profesorMateria,'materias-profesores.json');
//                         $datos = "Se agrego el profesor a la materia}";
//                     }
//                     else{
//                         $datos = $profesorMateria;
//                     }
//                 }
//             break;
            
//         }
//     break;
    
//     case 'GET':
//         //$datos = Usuario::Mostrar($token);
//         $token = $header['token'];
//         $usuarioLogueado = Token::VerificarToken($token);

//         if (!$usuarioLogueado) {
//             $datos = "token incorrecto";
//         }
//         else{
            
//             switch ($path_info){
//             case '/materias':
//                 $datos = Materias::mostrarMaterias();
//                 if ($datos === "") {
//                     $datos = 'Faltan datos';
//                 }
                
//                 break;
//             case '/profesor'://PUNTO 6
//                 $datos = Profesor::mostrarProfesores();
//                 if($datos === "")
//                 {
//                     $datos = 'Faltan datos';
//                 }
//                 //echo json_encode($respuesta);
//                 break;
//             case '/asignacion':
//                 $datos = Profesor::mostrarMateriasAsignadas();
//                 if($datos === "")
//                 {
//                     $datos = 'Faltan datos';
//                 }
//                 //echo json_encode($respuesta);
//                 break;
            
//             default:
//             $datos = 'faltan datos';
//             break;
//             }
//         }
        
        
//     break;  
//     default:
//     break;
// }


// $respuesta = new stdClass;
// $respuesta->success = true;

// $respuesta->data = $datos; 

// echo json_encode($respuesta);

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->run();
?>