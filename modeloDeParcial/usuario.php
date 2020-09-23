<?php

include_once '../clasesParaParcial/token.php';
include_once '../clasesParaParcial/archivos.php';


class Usuario{
    public $email;
    public $clave;
    public $imagenNombre;

    public function __construct($email, $clave, $imagenNombre)
    {
        $this->email = $email;
        $this->clave = $clave;
        $this->imagenNombre = $imagenNombre;
    }
    

    public static function Login($email,$clave){
        $retorno = false;
        $lista = Archivos::leerJson('users.json');
        // var_dump($lista);
        echo "<br>";
        if(isset($lista)){
            foreach ($lista as $usuario) {
                if ($usuario['email'] == $email && $usuario['clave'] == $clave) {
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

    public static function CrearUsuario($email,$clave){
        $retorno = false;
        if(!Usuario::buscarUsuario($email)){

            
            //TODO Al realizar el guardado de la clave hay que guardarla encriptada
            $claveEncriptada = Usuario::encriptarContraseña($clave);
            echo $clave . "<br>" . $claveEncriptada;
            $imagenNombre = Archivos::guardarImagen($_FILES,3670016,'./imagenes/imagen');

            $usuario = new Usuario($email,$claveEncriptada,$imagenNombre);
            if (Usuario::verificarContraseña($clave,$claveEncriptada) ) {
                echo "la clave es correcta";
            }
            else{
                echo "clave incorrecta";
            }
            
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