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