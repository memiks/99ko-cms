<?php
class adminControleur{
    
    private $p;
    private $template;
    private $manager;
    
    public function __construct(){
        session_start();
        // creation de l'instance manager
        $this->manager = new manager();
        // analyse de la requete client
        $this->p = (isset($_GET['p'])) ? $_GET['p'] : 'home';
        // set template
        $this->template = $this->p;
        $p = $this->p;
        // appel de la methode correspondante a la requete client
        $this->$p();
    }
    
    // affiche la home
    public function home(){
        // version de 99ko
        $version = $this->manager->getVersion();
        // plugins
        $plugins = $this->manager->listPlugins();
        include('theme/admin/'.$this->template.'.php');
    }
    
    // affiche la configuration
    public function configuration(){
        // action
        if(isset($_POST['name'])){
            foreach($_POST as $key=>$val){
                $item = new configItem();
                $item->set('key', $key);
                $item->set('val', $val);
                $this->manager->saveConfigItem($item);
            }
            header('location:'.$_SERVER['REQUEST_URI']);
        }
        // configuration
        $name = $this->manager->getConfigItem('name');
        $theme = $this->manager->getConfigItem('theme');
        $url = $this->manager->getConfigItem('url');
        $lang = $this->manager->getConfigItem('lang');
        // version de 99ko
        $version = $this->manager->getVersion();
        // plugins
        $plugins = $this->manager->listPlugins();
        // langs
        $langs = $this->manager->listLangs();
        include('theme/admin/'.$this->template.'.php');
    }
	
    public function menu(){
        if(isset($_GET['up'])){
            $item = $this->manager->getMenuItem($_GET['up']);
            $item->up();
            $this->manager->saveMenuItem($item);
        }
        if(isset($_GET['down'])){
            $item = $this->manager->getMenuItem($_GET['down']);
            $item->down();
            $this->manager->saveMenuItem($item);
        }
	// version de 99ko
        $version = $this->manager->getVersion();
        // plugins
        $plugins = $this->manager->listPlugins();
        // items menu
        $itemsLevel1 = $this->manager->listMenuItems();
        foreach($itemsLevel1 as $item){
            $temp = $this->manager->listMenuItems('level2');
            $itemsLevel2[$item->get('id')] = $temp[$item->get('id')];
        }
        include('theme/admin/'.$this->template.'.php');
    }
    
    // affiche la page d'un plugin
    public function plugin(){
        // version de 99ko
        $version = $this->manager->getVersion();
        // plugins
        $plugins = $this->manager->listPlugins();
        include('plugin/'.$_GET['id'].'/admin.php');
    }
    
}
?>