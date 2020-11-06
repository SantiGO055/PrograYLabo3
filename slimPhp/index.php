<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__.'./vendor/autoload.php';

$app = AppFactory::create();

/**si utilizo subdirectorios declaro setBasePath */
$app->setBasePath("/slimphp");







// $app->group('/users',function(RouteCollectorProxy $group)){
//     $group->get('/{id}',UserController::class . ":getOne");


// }


// $app->post('/usuario/{id}',function (Request $request, Response $response, $args) {
//     // $id = $args['id'];
    
//     $response->getBody()->write("Hello world!");
//     return $response;
// });
// /**puedo manejar get y post con una misma ruta */
// $app->map(['GET', 'POST'], '/books', function ($request, $response, array $args) {
//     // Create new book or list all books
// });

// /**group lo uso para poder usar post o get con misma ruta */
// $app->group('/users/{id:[0-9]+}', function (RouteCollectorProxy $group) {
//     $group->map(['GET', 'DELETE', 'PATCH', 'PUT'], '', function ($request, $response, array $args) {
//         // Find, delete, patch or replace user identified by $args['id']
//         // ...
        
//         return $response;
//     })->setName('user');
    
//     $group->get('/reset-password', function ($request, $response, array $args) {
//         // Route for /users/{id:[0-9]+}/reset-password
//         // Reset the password for user identified by $args['id']
//         // ...
        
//         return $response;
//     })->setName('user-password-reset');
// });

/**metodo getheaders obtengo token y demas cosas de cabecera
 * getParsedBody va a permitir parsear y leer las prop que envian por peticion json
 * 
 */
/**[/] es para dar opcion de poner con o sin barra */
// $app->get('/hello[/]{name}', function (Request $request, Response $response, $args) {
//     //PARAMETRO EN LA RUTA EN ARGS
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });

/**request toda la info que venga, desde ip, que navegador
 * response devolvera la respuesta
 * 
 *  */
// $app->get('/', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//     return $response;
// });

$app->run();

// use Clases\Usuario;
// $usuario = new Usuario("sapeeeeeeeeeeeee");

// echo $usuario->name;

?>