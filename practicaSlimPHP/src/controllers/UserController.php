<?php
namespace App\Controllers;
use Clases\Usuario;
// use App\Models\User;


class UserController {
    public $datos = array ('datos' => '.');
    public function getAll ($request, $response, $args) {
        // $rta = User::get();
        // $rta = User::find(1);
        // $rta = User::where('id', '>',  0)
        // // ->where('campo', 'operador', 'valor')        
        // ->get();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    // public function getOne($request, $response, $args)
    // {
    //     $response->getBody()->write("getOne!");
    //     return $response;
    // }
    public function altaUsuario($request, $response, $args)
    {
        // $datos = array ('datos' => '.');
        // echo $args['id'];
        $parsedBody = $request->getParsedBody();
        // var_dump( $parsedBody['email']);
        // var_dump( $request);
        // echo "<br>";
        // echo $request['email'];
        // echo "<br>";
        // echo $request['email'];
        // echo "hola";
        $claveEncriptada = Usuario::encriptarContraseña($parsedBody['clave']);
        // var_dump( $datos['datos']);
        if(Usuario::CrearUsuario($parsedBody['email'],$claveEncriptada))
        {
            $datos['datos'] = 'Se creo el usuario correctamente!';
        }
        else
        {
            $datos['datos'] = 'Error al crear usuario. Usuario existente';
        }
        
        $payload = json_encode($datos);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    public function login($request, $response, $args)
    {
        // echo $args['id'];
        $parsedBody = $request->getParsedBody();
        // var_dump( $parsedBody['email']);
        // var_dump( $request);
        // echo "<br>";
        // echo $request['email'];
        // echo "<br>";
        // echo $request['email'];
        // echo "hola";
        $token = Usuario::Login($parsedBody['email'], $parsedBody['clave']);

        if(Usuario::Login($parsedBody['email'], $parsedBody['clave']))
        {
            $datos = 'Login Exitoso. TOKEN: ' . $token;
        }
        else
        {
            $datos = 'Nombre o Clave Incorrectas';                       
        }
        $payload = json_encode($datos);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    public function Materia($request, $response, $args){
        $parsedBody = $request->getParsedBody();
        $token = $request->getHeader('token');
        // $token = $header['token'];
        $nombreMateria = $parsedBody['nombre'];
        $cuatrimestre = $parsedBody['cuatrimestre'];
        // $cuatrimestre = $_POST['cuatrimestre'] ?? "";
        
        $usuarioLogueado = Token::VerificarToken($token);
        
        if (!$usuarioLogueado) {
            $datos = "Usuario no logueado, token incorrecto!";
        }
        else{
            $materia = new Materias($nombreMateria,$cuatrimestre);
            

            if(Archivos::guardarJson($materia,'materias.json')){
                $datos = "Materia guardada correctamente";
            }
            else{
                $datos = "Ocurrio un error al guardar la materia";
            }
        }
        $payload = json_encode($datos);

        $response->getBody()->write($payload);
        return $response
        ->withHeader('Content-Type', 'application/json');
    }
    public function add($request, $response, $args)
    {
        $user = new User;
        $user->name = "Juan";
        $user->email = "Juan@mail.com";
        $user->password = "sdxdsdsds";

        $rta = $user->save();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    public function update($request, $response, $args)
    {
        $id = $args['id'];
        $user = User::find($id);

        $user->name = "Peter";
        $user->email = "nuevo@mail.com";

        $rta = $user->save();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        $user = User::find($id);

        $rta = $user->delete();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    // $respuesta = new stdClass;
    // $respuesta->success = true;

    // $respuesta->data = $datos; 

    
}