<?php
namespace App\Controllers;
use Clases\Usuario;
use App\Models\User;


class UserController {
    public $datos = array ('datos' => '.');
    public function getAll ($request, $response, $args) {
        $rta = User::get(); //select * from users
        // $rta = User::find(1);
        // $rta = User::where('id', '>',  0)
        // ->where('campo', 'operador', 'valor')        
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

        //TODO aca adentro no va a validarse el token

        $parsedBody = $request->getParsedBody();
        $email = $parsedBody['email'];
        
        $tipo = $parsedBody['tipo'];
        $rta = User::where('email', $email)->first();

        // var_dump($rta);


        
        $claveEncriptada = Usuario::encriptarContraseña($parsedBody['clave']);
        // var_dump( $datos['datos']);
        $usuarioCreado = Usuario::CrearUsuario($email,$claveEncriptada,$tipo);
        var_dump($usuarioCreado);
        if(Usuario::CrearUsuario($email,$claveEncriptada,$tipo) && $rta == null)
        {
            $user = new User;
            $user->email = $email;
            $user->password = $claveEncriptada;
            $user->tipo = $tipo;
            $rta = $user->save();
            $datos['datos'] = 'Se creo el usuario correctamente!';
            // var_dump($user);
        }
        else
        {
            $rta = false;
            $datos['datos'] = "Error al crear usuario.";
            
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
    // public function add($request, $response, $args)
    // {
    //     $user = new User;
    //     $user->name = "Juan";
    //     $user->email = "Juan@mail.com";
    //     $user->password = "sdxdsdsds";

    //     $rta = $user->save();

    //     $response->getBody()->write(json_encode($rta));
    //     return $response;
    // }

    public function update($request, $response, $args)
    {
        $params = (array)$request->getQueryParams();

        $id = $args['id'];
        $email = $params['email'];
        $name = $params['name'];
        // var_dump($request);
        // $parsedBody = $request->getParsedBody();
        // var_dump($params);
        // $email = $parsedBody['email'];
        // $name = $parsedBody['name'];

        $user = User::find($id);
        if($user){
            $user->email = $email;
            $user->name = $name;
            
            if($user->save()){

                $datos['datos'] = "Se modifico el usuario correctamente.";
                
            }
            else{
                $datos['datos'] = "Error al modificar datos";
            }
            
        }
        else{
            $datos['datos'] = "Error. ID no encontrado";
        }

        // $rta = $user->save();

        $response->getBody()->write(json_encode($datos));
        return $response;
    }

    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        $parsedBody = $request->getParsedBody();
        
        // $rta = User::where('email', $email)->first();

        $user = User::find($id);
        if($user){
            if($user->delete()){
                $datos['datos'] = "Se elimino el usuario correctamente.";
            }
        }
        else{
            $datos['datos'] = "Error. ID no encontrado";
        }
        

        $response->getBody()->write(json_encode($datos));
        return $response;
        // getAll();
    }
    public function isEmail($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        else{
            return $email;
        }
    }

    // $respuesta = new stdClass;
    // $respuesta->success = true;

    // $respuesta->data = $datos; 

    
}