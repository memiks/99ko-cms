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
    
    public function home(){
        $version = $this->manager->getVersion();
        $plugins = $this->manager->listPlugins();
        include('theme/admin/'.$this->template.'.php');
    }
    
    public function configuration(){
        // sauvegarde
        if(isset($_POST['name'])){
            foreach($_POST as $key=>$val){
                $item = new configItem();
                $item->set('key', $key);
                $item->set('val', $val);
                $this->manager->saveConfigItem($item);
            }
            header('location:'.$_SERVER['REQUEST_URI']);
        }
        // formulaire
        else{
            $name = $this->manager->getConfigItem('name');
            $theme = $this->manager->getConfigItem('theme');
            $url = $this->manager->getConfigItem('url');
            $lang = $this->manager->getConfigItem('lang');
            $langs = $this->manager->listLangs();
            $version = $this->manager->getVersion();
            $plugins = $this->manager->listPlugins();
            include('theme/admin/'.$this->template.'.php');
        }
    }
	
    public function menu(){
        $edit = false;
        // sauvegarde
        if(isset($_POST['name'])){
            $item = new menuItem();
            $item->set('id', $_POST['id']);
            $item->set('name', $_POST['name']);
            $item->set('idParent', $_POST['idParent']);
            $item->set('url', $_POST['url']);
            $item->set('position', 0);
            $this->manager->saveMenuItem($item);
            header('location:admin.php?p=menu');
        }
        // supression
        elseif(isset($_GET['del'])){
            $item = $this->manager->getMenuItem($_GET['del']);
            $this->manager->delMenuItem($item);
            header('location:admin.php?p=menu');
        }
        // changement position (up)
        elseif(isset($_GET['up'])){
            $item = $this->manager->getMenuItem($_GET['up']);
            $item->up();
            $this->manager->saveMenuItem($item);
            header('location:admin.php?p=menu');
        }
        // changement position (down)
        elseif(isset($_GET['down'])){
            $item = $this->manager->getMenuItem($_GET['down']);
            $item->down();
            $this->manager->saveMenuItem($item);
            header('location:admin.php?p=menu');
        }
        // formulaire
        elseif(isset($_GET['edit'])){
            $edit = true;
            if($_GET['edit'] != 0) $item = $this->manager->getMenuItem($_GET['edit']);
            else{
                $item = new menuItem();
                $item->set('url', $_POST['url']);
            }
            $itemsLevel1 = $this->manager->listMenuItems();
        }
        // liste
        else{
            $itemsLevel1 = $this->manager->listMenuItems();
            foreach($itemsLevel1 as $item){
                $temp = $this->manager->listMenuItems('level2');
                $itemsLevel2[$item->get('id')] = $temp[$item->get('id')];
            }
            $articles = $this->manager->listArticles();
        }
        $version = $this->manager->getVersion();
        $plugins = $this->manager->listPlugins();
        include('theme/admin/'.$this->template.'.php');
    }
    
    public function article(){
        $edit = false;
        // sauvegarde
        if(isset($_POST['name'])){
            $article = new article();
            $article->set('id', $_POST['id']);
            $article->set('name', $_POST['name']);
            $article->set('content', $_POST['content']);
            $article->set('homepage', $_POST['homepage']);
            $article->set('date', date('Y-m-d H:i:s'));
            $article->set('type', $_POST['type']);
            $this->manager->saveArticle($article);
        }
        // supression
        elseif(isset($_GET['del'])){
        }
        // formulaire
        elseif(isset($_GET['edit'])){
            $edit = true;
            if($_GET['edit'] != 0) $article = $this->manager->getArticle($_GET['edit']);
            else{
                $article = new article();
                $article->set('type', $_POST['type']);
            }
        }
        // liste
        else{
            $pages = $this->manager->listArticles('page');
            $news = $this->manager->listArticles('news');
        }
        $version = $this->manager->getVersion();
        $plugins = $this->manager->listPlugins();
        include('theme/admin/'.$this->template.'.php');
    }
    
    // affiche la page admin d'un plugin
    public function plugin(){
        $version = $this->manager->getVersion();
        $plugins = $this->manager->listPlugins();
        include('plugin/'.$_GET['id'].'/admin.php');
    }
    
}
?>