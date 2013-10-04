<?php
class plugin{
    
    private $id;
    private $name;
    private $version;
    private $author;
    private $priority;
    
    public function __construct(){
        
    }
    
    public function set($p, $v){
        $this->$p = $v;
    }
    
    public function get($p){
        return $this->$p;
    }
	
	public function install(){
		call_user_func($this->id.'_install');
	}
    
    public function getConfigArray(){
        return $temp = call_user_func($this->id.'_config');
    }
    
    public function adminPage(){
        return file_exists('plugin/'.$this->id.'/admin.php');
    }
    
}