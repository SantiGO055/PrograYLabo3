<?php

class Archivos{
    
    static function guardarTxt($ruta,$texto,$modo){
        $size = filesize($ruta);
        $archivo = fopen($ruta,$modo);

        while(!feof($archivo)){
            $linea = fgets($archivo,$size);
            $datos = explode('*',$linea); //verifico los espacios de cada dato y los separo con *
        
            if(count($datos) == 4){
                return $datos;
                //instancio un nuevo objeto
                //$nuevoAuto = new Auto($datos[0],$datos[1],$datos[2],$datos[3]);
                /* *Lo agrego a una lista */
                //array_push($listaDeAutos, $nuevoAuto);
            }
        }
        fclose($archivo);

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

    /**lo que guarda json es un string, no guarda objetos */
    public static function guardarJson($ruta, $objeto){

        if(isset($lista)){
            $ar = fopen("./".$ruta,"w");
            array_push($array,$objeto);
            fwrite($ar,json_encode($array));
            fclose($ar);
        }
        else{
            $array2 = array();
            $ar = fopen("./".$ruta, "w");
            array_push($array2,$objeto);
            fwrite($ar,json_encode($array2));
            fclose($ar);
        }


    }

    static function leerJson($ruta){
        if (file_exists($ruta)){
            $ar = fopen($ruta, "r");

            $lista = json_decode(fgets($ar));
            fclose($ar);
            if(isset($lista)){
                return $lista;
            }
            else{
                return null;
            }
        }
        else{
            echo "El archivo no existe";
        }
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
            if ($key == $extension) {
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

    function guardarImagen($_files, $bytes,$path){
        
        //para evitar que se reemplace el archivo por uno que ya exista con el mismo nombre tengo que asignarle otro nombre
        $aleatorio = rand(1000,100000);
        
        /**o tambien usar fecha para el nombre del archivo */
        
        //saber en que extension vino la imagen
        //obtengo extension
        $extensionExplode = explode('.',$_files['archivo']['name']);
        $extension = $extensionExplode[1];

        //$extension = ".png"; //hardcodeada pero realizar funcion para saber la extension que llega
        
        $origen = $_files['archivo']['tmp_name'];
        $destino = $path . $aleatorio .'.' . $extension;
       
        
        if(Archivos::esImagen($extension) && Archivos::validarBytesImagen($_files,$bytes)){
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
        
        if ($_files['archivo']['size'] <= $bytes) {
            echo "imagen menor a 3.5mb";
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