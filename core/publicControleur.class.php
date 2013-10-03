<?php
class publicControleur{
    
    private $p;
    private $template;
    private $manager;
    
    public function __construct(){
        session_start();
        // creation de l'instance manager
        $this->manager = new manager();
        // analyse de la requete client
        if(!file_exists('data/')) $this->p = 'install';
        elseif(isset($_GET['article'])) $this->p = 'article';
        elseif(isset($_GET['news'])) $this->p = 'newsList';
        else $this->p = (isset($_GET['p'])) ? $_GET['p'] : 'article';
        // set template
        $this->template = $this->p;
        $p = $this->p;
        // hook
        eval(callHook('publicControleurConstruct'));
        // appel de la methode correspondante a la requete client
        $this->$p();
    }
    
    public function install(){
        $this->manager->install();
    }
    
    // affiche un article
    public function article(){
        // get article
        if(isset($_GET['article'])) $article = $this->manager->getArticle($_GET['article']);
        else $article = $this->manager->getArticleHomepage();
        // version de 99ko
        $version = $this->manager->getVersion();
        // url du site
        $url = $this->manager->getConfigItem('url');
        // menu
        $menuHtml = $this->manager->menuHtml();
        // metas
        $metaTitle = $article->get('name').' - '.$this->manager->getConfigItem('name');
        $metaDescription = '';
        // hook
        eval(callHook('publicControleurArticle'));
        include('theme/'.$this->manager->getConfigItem('theme').'/'.$this->template.'.php');
    }
    
    // affiche le listing des articles de type "news"
    public function newsList(){
        // get news
        $newsList = $this->manager->listArticles('news');
        // version de 99ko
        $version = $this->manager->getVersion();
        // url du site
        $url = $this->manager->getConfigItem('url');
        // menu
        $menuHtml = $this->manager->menuHtml();
        // metas
        $metaTitle = 'News - '.$this->manager->getConfigItem('name');
        $metaDescription = '';
        // hook
        eval(callHook('publicControleurNewsList'));
        include('theme/'.$this->manager->getConfigItem('theme').'/'.$this->template.'.php');
    }
	
	// affiche la page d'un plugin
    public function plugin(){
        // version de 99ko
        $version = $this->manager->getVersion();
        // url du site
        $url = $this->manager->getConfigItem('url');
        // menu
        $menuHtml = $this->manager->menuHtml();
        include('plugin/'.$_GET['id'].'/public.php');
    }
    
}
?>