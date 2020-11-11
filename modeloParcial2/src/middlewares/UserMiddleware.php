<?php
namespace App\Middlewares;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Slim\Psr7\Response;

class UserMiddleware{

    public function __invoke($request, $handler){
        
        $jwt = !true; //Validar el token;
        //tomar del header el token, llamar a clase que valida el token y respondemos

        if(!$jwt){
            $response = new Response();
            //podria lanzar una excepcion, manejarla de otro lado
            $rta = array("rta"=> "No tiene permisos");
            $response->getBody()->write(json_encode($rta));
            return $response;
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