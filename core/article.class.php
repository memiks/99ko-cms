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
        // todo : gestion des ID par $manager->saveArticle ???
        if($p == 'id' && $v == '') $v = uniqid();
        $this->$p = $v;
    }
    
    public function get($p){
        return $this->$p;
    }
}
?>