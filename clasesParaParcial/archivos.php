<?php

class Archivos{
    
    public static function guardarTxt($texto,$ruta){
        $retorno = false;
        $array = array();
        if(Archivos::leerTxt($ruta, $array))
        {
            array_push($array, $texto);
            $aux = json_encode($array, true);
        }
        else{
            array_push($array, $texto);
            $aux = json_encode($array, true);
        }
        $size = filesize($ruta);
        $archivo = fopen($ruta,'w+');

        if(fwrite($archivo, $aux))
        {
            $retorno = true;
        }

        fclose($archivo);

        return $retorno;

    }
    public static function leerTxt($ruta, $array)
    {
        $size = filesize($ruta);
        $retorno = false;
        if(file_exists($ruta) && $size > 0)
        {
            $archivo = fopen($ruta, 'r');
            $array = fread($archivo, filesize($ruta));

            fclose($archivo);
            $array = json_decode($array, true);
            $retorno = true;
        }
        else
        {
            $array = array();
        }
        return $retorno;
    }

    static function serializar($ruta, $objeto){
        $ar = fopen("./".$ruta, "a");

        fwrite($ar, serialize($objeto).PHP_EOL);
        fclose($ar);


    }

    static function deserializar($ruta){
        $lista = array();
        $ar = fopen("./".$ruta,"r");

        while(!feof($ar)){
            $objeto = unserialize(fgets($ar));
            if($objeto != null){
                array_push($lista, $objeto);
            }
        }
        fclose($ar);
        return $lista;

    }

    /**Guardar en JSON */
    public static function guardarJson($objeto,$ruta){
        // $retorno = false;
        // if(isset($lista)){
        //     $ar = fopen("./".$ruta,"w");
        //     array_push($array,$objeto);
        //     fwrite($ar,json_encode($array));
        //     fclose($ar);
        //     $retorno = true;
        // }
        // else{
        //     $array2 = array();
        //     $ar = fopen("./".$ruta, "w");
        //     array_push($array2,$objeto);
        //     fwrite($ar,json_encode($array2));
        //     fclose($ar);
        //     $retorno = true;
        // }
        // return $retorno;
        $retorno = false;
        if(Archivos::leerJson($ruta, $array))
        {
            array_push($array, $objeto);
            $aux = json_encode($array, true);
        }
        else
        {
            array_push($array, $objeto);
            $aux = json_encode($array, true);
        }
        $archivo = fopen($ruta, 'w');
        if(fwrite($archivo, $aux))
        {
            $retorno = true;
        }
        $cerrar = fclose($archivo);

        return $retorno;

    }

    static function leerJson($ruta,&$array){
        // if (file_exists($ruta)){
        //     $ar = fopen($ruta, "r");

        //     $lista = json_decode(fgets($ar),true); //true para poder manejarlo como array asociativo
        //     fclose($ar);
        //     if(isset($lista)){
        //         return $lista;
        //     }
        //     else{
        //         return null;
        //     }
        // }
        // else{
        //     echo "El archivo no existe";
        // }
        $retorno = false;
        if(file_exists($ruta) && filesize($ruta) > 0)
        {
            $archivo = fopen($ruta, 'r');
            $array = fread($archivo, filesize($ruta));
            fclose($archivo);
            $array = json_decode($array, true);
            $retorno = $array;
        }
        else
        {
            $array = array();
        }
        return $retorno;
    }

    /**Valido si la extension es imagen */
    static function esImagen($extension){
        $extensionesValidas = array(
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml'
        );
        $retorno = false;
        
        foreach ($extensionesValidas as $key => $value) {
            if ($value == $extension) {
                $retorno = true;
                return $retorno;
            }
            else{
                $retorno = false;
            }
        }
        
        return $retorno;


    }
    
    //una es desde el name y otra es a traves de los mime
    //con el explode por que separador el string convierta en array
    //tambien controlar y limitar la cantidad de megas de un archivo

    public static function guardarImagen($_files, $bytes,$path){
        
        //para evitar que se reemplace el archivo por uno que ya exista con el mismo nombre asigno uno aleatorio
        $aleatorio = rand(1000,100000);
        
        //obtengo extension
        $extensionExplode = explode('.',$_files['foto']['name']);
        $extension = $extensionExplode[1];

        $origen = $_files['foto']['tmp_name'];
        $nombreArchivo = $aleatorio .'.' . $extension;
        $destino = $path . $aleatorio .'.' . $extension;
       
        
        if(Archivos::esImagen($_files['foto']['type']) && Archivos::validarBytesImagen($_files,$bytes)){
            $subido = move_uploaded_file($origen,$destino);
            if ($subido) {
                return $nombreArchivo;
            }
            else{
                return "No se pudo guardar la imagen";
            }
        }
        else{
            return "El archivo no es una imagen o supera el tamaño de 3.5MB";
        }
        
    }
    public static function guardarImagenSinAleatorio($_files, $bytes,$path){
        $extensionExplode = explode('.',$_files['foto']['name']);
        $extension = $extensionExplode[1];

        $origen = $_files['foto']['tmp_name'];
        $destino = $path . '.' . $extension;
       
        
        if(Archivos::esImagen($_files['foto']['type']) && Archivos::validarBytesImagen($_files,$bytes)){
            $subido = move_uploaded_file($origen,$destino);
            if ($subido) {
                return "Se guardo la imagen correctamente";
            }
            else{
                return "No se pudo guardar la imagen";
            }
        }
        else{
            echo "El archivo no es una imagen o supera el tamaño de 3.5MB";
        }
    }

    static function validarBytesImagen($_files,$bytes){
        
        if ($_files['foto']['size'] <= $bytes) {
            
            return true;
        }
        else{
            return false;
        }
        
    }
    static function eliminarImagen($origen,$destino){

        rename($origen,$destino);
    }

}



// $fread = fread($archivo,100); //Lee todo el archivo


// $fwrite = fwrite($archivo, $auto . PHP_EOL);

// con a+ deja el cursor al final, por eso no lo lee
//lo imprimo con
// echo "fwrite $fwrite <br>";


/**Recorro la lista */
// foreach ($listaDeAutos as $value) {
//     echo $value->_patente;
// }
//var_dump($listaDeAutos);

// /**Creo una copia del archivo */
// copy($file,'nuevo_archivo.txt');
// /**Elimino el archivo que cree nuevo */
// unlink('nuevo_archivo.txt');


/**cierro el archivo */



?>