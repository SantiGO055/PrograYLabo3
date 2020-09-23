<?php


class Fabrica{
    private $_cantMaxOperarios; //int
    private $_operarios; //Operario[]
    private $_razonSocial; //string

    public function __construct($razonSocial = ""){
        if (is_string($razonSocial)) {
            $this->_razonSocial = $razonSocial;
            $this->_cantMaxOperarios = 5;
            $_operarios = [];
            
        }
        else{
            $this->_razonSocial = "razonSocialNoValida";
        }
        
    }
    private function RetornarCostos(){
        $salarioTotal = 0;
        foreach ($this->_operarios as $key => $value) {
            $salarioTotal += $value->getSalario();
        }
        return $salarioTotal;
    }
    private function MostrarOperarios(){
        foreach ($this->_operarios as $key) {
            echo "" . $key->Mostrar() . "<br><br>";
        }
    }
    public function Mostrar($fabrica){
        return $fabrica->MostrarOperarios();
    }
    
    public static function MostrarCosto(Fabrica $fabrica){
        echo $fabrica->RetornarCostos();
    }
    public function Equals($fabrica,$operario){
        if ($fabrica instanceof Fabrica && $operario instanceof Operario) {
            if($fabrica != null && $operario != null){
                foreach ($this->_operarios as $key) {
                    if ($key === $operario) {
                        return true;
                    }
                }
            }else return false;
        }else return false;
        
    }
    public function Add($operario){
        if ($operario instanceof Operario && $operario != null) {
            if ($this->_operarios == null) {
                $this->_operarios[] = $operario;
                return true;
            }
            if (count($this->_operarios) <= $this->_cantMaxOperarios && !($this->Equals($this,$operario))) {
                
                array_push($this->_operarios,$operario);
                return true;
            }
        }
        else return false;
    }
    public function Remove($operario){
        if ($operario instanceof Operario) {
            if($operario != null){
                for ($i=0; $i < count($this->_operarios) ; $i++) {
                    echo count($this->_operarios);
                    echo "<br><br>";
                    var_dump($this->_operarios);
                    echo $i;
                    if ($this->_operarios[$i] === $operario) {
                        unset($this->_operarios[$i]);
                        return true;
                    }
                }
            }else return false;
        }
        else return false;
    }





}






?>