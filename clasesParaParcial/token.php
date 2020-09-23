<?php

require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
/**clase creada para manejar el token de  libreria firebase*/
class Token{
    
    //private static $aud = null;

    public static function crearToken($dato){
        //$token = $_SERVER['HTTP_TOKEN'];

        $retorno = false;
        $key = "pro3-parcial";

        $payload = array(
            "email" => $dato['email'],
            "clave" => $dato['clave']
        );
        
        //este metodo devuelve el token
        //entonces en un login el encode lo hago una sola vez
        $retorno = JWT::encode($payload, $key); //encode sirve para codificar un objeto, le paso el array con los datos y la key
        return $retorno;
        
        var_dump($jwt);
        
    }
    public static function VerificarToken($token){
        $retorno = false;
        /**el try catch lo haremos cada vez que hay que autenticar una url */
        try {
            // $token = $_SERVER['HTTP_TOKEN']; //token que obtengo de la cabecera
            
            $retorno = JWT::decode($token, $key, array('HS256')); //decode para decodificarlo
            //print_r($retorno);
        
        } catch (Exception $e) {
            echo "error";
            $retorno = false;
        }
        return $retorno;
    }
}








?>