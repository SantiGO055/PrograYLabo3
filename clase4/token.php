<?php

/**clase creada para manejar el token de  libreria firebase*/

require __DIR__ . '/vendor/autoload.php';

use \Firebase\JWT\JWT;


$token = $_SERVER['HTTP_TOKEN'];

$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000,
    "email" => "user@mail.com",
    "tipo" => "user"
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */

//este metodo devuelve el token
//entonces en un login el encode lo hago una sola vez
$jwt = JWT::encode($payload, $key); //encode sirve para codificar un objeto, le paso el array con los datos y la key



/**al pegar el $jwt en la web va a mostar los datos pero no sera verificado si no le ponemos la key (contraseña) 
 * el token lo envia el usuario en la cabecera
*/

/**el try catch lo haremos cada vez que hay que autenticar una url */
try {
    $token = $_SERVER['HTTP_TOKEN']; //token que obtengo de la cabecera
    $decoded = JWT::decode($token, $key, array('HS256')); //decode para decodificarlo
    print_r($decoded);

} catch (\Throwable $th) {
    echo "error";
}


?>