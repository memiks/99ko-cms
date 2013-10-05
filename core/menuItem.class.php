<?php
class menuItem{
    
    private $id;
    private $name;
    private $idParent;
    private $url;
    private $position;
    
    public function __construct(){
    }
    
    public function get($attr){
        return $this->$attr;
    }
    
    public function set($attr, $val){
        $this->$attr = $val;
    }
    
    public function up(){
        $this->position--;
    }
    
    public function down(){
        $this->position++;
    }
    
}
?>