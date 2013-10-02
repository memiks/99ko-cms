<?php
class configItem{
    
    private $key;
    private $val;
    
    public function __construct(){
        
    }
    
    public function set($k, $v){
        $this->$k = $v;
    }
    
    public function get($k){
        return $this->$k;
    }
    
}
?>