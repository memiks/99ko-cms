<?php
class article{
    
    private $id;
    private $name;
    private $content;
    private $date;
    private $type;
    private $homepage;
    
    public function __construct(){
        
    }
    
    public function set($p, $v){
        $this->$p = $v;
    }
    
    public function get($p){
        return $this->$p;
    }
}
?>