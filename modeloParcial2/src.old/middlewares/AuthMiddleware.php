<?php
namespace App\Middlewares;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Slim\Psr7\Response;

class AuthMiddleware{

    public function __invoke($request, $handler){

        $jwt = true; //Validar el token;
        //tomar del header el token, llamar a clase que valida el token y respondemos

        if(!$jwt){
            $response = new Response();
            //como retornamos el new response se ejecuta antes
            
            //podria lanzar una excepcion, manejarla de otro lado
            $rta = array("rta"=> "Prohibido pasar, no esta autenticado");
            $response->getBody()->write(json_encode($rta));
            return $response->withStatus(403); //puedo responder un status o lanzar excepcion
        }
        else{
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $resp = new Response();
            $response->getBody()->write($existingContent);
        }

        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        

        return $response;
    }





}


?>