<?php

include_once '../clasesParaParcial/token.php';
include_once '../clasesParaParcial/archivos.php';


class Usuario{
    public $email;
    public $clave;
    public $imagenNombre;

    public function __construct($email, $clave, $imagenNombre)
    {
        $this->setEmail($email);
        $this->clave = $clave;
        $this->imagenNombre = $imagenNombre;
    }
    
    public function setEmail($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = "emailNoValido";
        }
        else{
            $this->email = $email;
            
        }
    }

    public static function Login($email,$clave){
        $retorno = false;
        $lista = Archivos::leerJson('users.json',$listaUsuarios);

        
        // var_dump($lista);
        
        if(isset($lista)){
            foreach ($lista as $usuario) {
                //$usuario['clave'] es la clave encriptada del json que levanto
                if ($usuario['email'] == $email && Usuario::verificarContraseña($clave,$usuario['clave'])) {
                    
                    //Usuario::verificarContraseña($clave,$usuario['clave']);

                    $token = Token::crearToken($usuario);
                    

                    var_dump($token);
                    return $token;
                break;
                }
            }
        }
    }

    public static function encriptarContraseña($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public static function verificarContraseña($clave,$hash){
        return password_verify($clave, $hash);
    }

    

    public static function CrearUsuario($email,$claveEncriptada){
        $retorno = false;
        if(!Usuario::buscarUsuario($email)){

            
            
            // $claveEncriptada = Usuario::encriptarContraseña($clave);

            $imagenNombre = Archivos::guardarImagen($_FILES,3670016,'./imagenes/imagen');
            
            $usuario = new Usuario($email,$claveEncriptada,$imagenNombre);
            if ($usuario->email != "emailNoValido") {
                if(Archivos::guardarJson($usuario,'users.json')){
                    $retorno = true;
                }
                if (isset($listaUsuarios)) {
                    
                    array_push($listaUsuarios);
                }
                else{
                    
                    $listaUsuarios = $usuario;
                }
            }
            else{
                $retorno = false;
            }

            
        }
        else
        {
            echo "Usuario ya existente!";
        }
        return $retorno;
    }


    public function buscarUsuario($email)
    {   
        $retorno = false;
        if(isset( $listaUsuarios)){
            if(Archivos::leerTxt('usuario.txt', $listaUsuarios))
            {
                foreach ($listaUsuarios as $auxUr)
                {
                    if($email == $auxUr['email'])
                    {
                        $retorno = true;
                        break;
                    }
                }
            }
        return $retorno;
        }
        
    }



}


?>