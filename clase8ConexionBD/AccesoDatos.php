<?php
class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try {
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=utn;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
        } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }
     public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }

    public function obtenerCelda($id,$tabla){
        try {
            
            $query = $this->RetornarConsulta('select * from utn.' . $tabla . ' where id = :id');
            
            
            $query->bindParam(':id', $id, PDO:: PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 5);
            // var_dump($resultado);
            $resultado = $query->execute();
            $resultado = $query->fetch(PDO::FETCH_LAZY);
            return $resultado;
            // var_dump($objetoAcceso);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
    }
    public function updateDatos($tabla,$clave,$valor,$id){
        try { 

            // echo 'update utn.'. $tabla .' SET ' . $clave . ' = '. '"'. $valor.'"' . ' where id = :id';
            $query = $this->RetornarConsulta('update utn.'. $tabla .' SET ' . $clave . ' = '. '"'. $valor.'"' . ' where id = :id');
            
            $query->bindParam(':id', $id, PDO:: PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 5);
            // var_dump($resultado);
            $resultado = $query->execute();
            $resultado = $query->fetch(PDO::FETCH_LAZY);
            return $resultado;
            // var_dump($objetoAcceso);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }
}
?>