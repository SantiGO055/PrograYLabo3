<?php
namespace Clases;

//incluir namespace para utilizar token y archivos
use \Clases\Token;
use \Clases\Archivos;
// include_once '../clasesParaParcial/archivos.php';


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
            

            $imagenNombre = Archivos::guardarImagen($_FILES,3670016,'./imagenes/imagen',true);
            
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


    public static function buscarUsuario($email)
    {   
        $retorno = false;
        Archivos::leerJson('./users.json',$listaUsuarios);
        //var_dump($listaUsuarios);

        foreach ($listaUsuarios as $usuario) {
            if ($usuario['email'] === $email) {
                $retorno = true;
            }
            else{
                $retorno = false;
            }
        }
        return $retorno;
        // if(isset( $listaUsuarios)){
        //     if(Archivos::leerTxt('usuario.txt', $listaUsuarios))
        //     {
        //         foreach ($listaUsuarios as $auxUr)
        //         {
        //             if($email == $auxUr['email'])
        //             {
        //                 $retorno = true;
        //                 break;
        //             }
        //         }
        //     }
        // return $retorno;
        // }
        
    }
    public static function asignarFotoNueva($email,$foto){
        Archivos::leerJson('./users.json',$listaUsuarios);
        //var_dump($listaUsuarios);
        $nombreFoto = $_FILES["foto"]["name"];
        for ($i=0; $i < count($listaUsuarios); $i++) { 
            if ($listaUsuarios[$i]['email'] === $email) {
                //var_dump($nombreFoto);
                //$pathMover = "./imagenes/" . $listaUsuarios[$i]['imagenNombre'];

                Archivos::moverImagen("./imagenes/imagen" . $listaUsuarios[$i]['imagenNombre'] , "./backup/".$listaUsuarios[$i]['imagenNombre']);
                $usuarioAux = new Usuario($email,$listaUsuarios[$i]['clave'],$nombreFoto);
                
                Archivos::modificarJson("./users.json",$i,"imagenNombre",$nombreFoto);
                $retorno = true;
                return $retorno;
            }
            else{
                $retorno = false;
            }
        }
        // foreach ($listaUsuarios as $usuario) {
            
        // }

        
    }



}


?>