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
// include_once 'profesor.php';
// include_once 'usuario.php';
// include_once 'materias.php';


session_start();

$request_method = $_SERVER['REQUEST_METHOD'];
// $path_info = $_SERVER['PATH_INFO'];

$listaDeMaterias = array();
$listaDeMateriasProfe = array();

$header = getallheaders();
$listaProfes = [];


$pathAux = explode('/', getenv('REQUEST_URI'));

// var_dump($_SERVER);
// echo "<br>";
// var_dump($pathAux);
// echo "<br>";

$app = AppFactory::create();
$app->setBasePath("/practicaSlimPHP");


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

/**
    * Se debe realizar una aplicación para un estacionamiento de autos.
    *A partir del punto 3 todas las rutas deberán estar autenticadas con un token JWT.
    *La clave para generar el JWT tiene que ser primerparcial.
    *Todas las peticiones se deberán recibir en el archivo index.php.
    *Se debe respetar las peticiones del postman.
    *La hora límite de entrega son las 21:00.
    *
    *1. (POST) registro. Registrar un usuario con los siguientes datos: email, tipo de usuario, password
    *y foto. El tipo de usuario puede ser admin o user. Validar que el mail no esté registrado
    *previamente.
    *2. (POST) login: Los usuarios deberán loguearse y se les devolverá un token con email y tipo en
    *caso de estar registrados, caso contrario se informará el error.
    *3. (POST) vehiculo: Se deben guardar los siguientes datos: marca, modelo, patente y precio. Los
    *datos se guardan en el archivo de texto vehiculos.xxx, tomando la patente como identificador(la
    *patente no puede estar repetida).
    *4. (GET) patente/aaa123: Se ingresa marca, modelo o patente, si coincide con algún registro del
    *archivo se retorna las ocurrencias, si no coincide se debe retornar “No existe xxx” (xxx es lo
    *que se buscó) La búsqueda tiene que ser case insensitive.
    *5. (POST) servicio: Se recibe el nombre del servicio a realizar: id, tipo(de los 10.000km, 20.000km,
    *50.000km), precio y demora, y se guardará en el archivo tiposServicio.xxx.
    *6. (GET) turno: Se recibe patente y fecha (día) y se debe guardar en el archivo turnos.xxx, fecha,
    *patente, marca, modelo, precio y tipo de servicio. Si no hay cupo o la patente no existe informar
    *cada caso particular.
    *7. (POST) stats/: Solo admin. Puede recibir el tipo de servicio, si lo incluye, muestra un listado con
    *los servicios de ese tipo realizados, si no muestra todos los servicios.
 */

new Database();
$app->group('', function (RouteCollectorProxy $group) {
    $group->group('/usuario', function(RouteCollectorProxy $groupUser) {
        $groupUser->post('/altaUsuario', UserController::class . ":altaUsuario");
        $groupUser->post('/login', UserController::class . ":login");

    });

    $group->get('/getAll', UserController::class . ":getAll");
    $group->post('/materia', UserController::class . ":Materia");

    
    $group->put('/{id}', UserController::class . ":update");

    $group->delete('/{id}', UserController::class . ":delete");
}); //primero se ejecuta el ultimo, si no da ok el auth no se ejecuta el userMiddleware
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