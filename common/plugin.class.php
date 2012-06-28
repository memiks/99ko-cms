<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

/************************************************
** Classes responsables de la gestion des plugins
************************************************/

class pluginsManager{

	private $plugins; // liste des plugins (alimentée par la méthode loadPlugin)
	private static $instance = null;
	
	/*
	** Constructeur
	*/
	public function __construct(){
		$this->plugins = $this->listPlugins();
	}
	
	/*
	** Retourne la liste des plugins
	** Si la liste est vide (plugins non chargés) la méthode listPlugins est appelée
	** @return : array (objets plugins)
	*/
	public function getPlugins(){
		return $this->plugins;
	}
	
	/*
	** Retourne un plugin
	** @return : object (plugin)
	*/
	public function getPlugin($name){
		foreach($this->plugins as $plugin){
			if($plugin->getName() == $name) {
				return $plugin;
			}
		}
		return false;
	}
	
	/*
	** Sauvegarde la configuration d'un plugin
	** @param : object (plugin)
	** @return: true / false
	*/
	public function savePluginConfig($obj){
		if($obj->getIsValid() && $path = $obj->getDataPath()){
			if(@file_put_contents($path.'config.txt', json_encode($obj->getConfig()), 0666)) return true;
		}
		return false;
	}
	
	/*
	** Créée un plugin et alimente le tableau des plugins
	** Cette méthode est appelée durant la phase de chargement / installation des plugins
	** Il n'est pas nécessaire de la rappeler !!!!
	** @param : string (nom du plugin), array (configuration du plugin)
	*/
	public function loadPlugin($name){
		$this->plugins[] = $this->createPlugin($name);
	}

	/*
	** Installe un plugin
	** Cette méthode est appelée durant la phase de chargement / installation des plugins
	** Il n'est pas nécessaire de la rappeler !!!!
	** @param : string (nom du plugin)
	** @return : true / false
	*/
	public function installPlugin($name){
		@mkdir(ROOT.'data/plugin/'.$name.'/', 0777);
		@chmod(ROOT.'data/plugin/'.$name.'/', 0777);
		@file_put_contents(ROOT.'data/plugin/'.$name.'/config.txt', file_get_contents(ROOT.'plugin/'.$name.'/param/config.json'), 0666);
		@chmod(ROOT.'data/plugin/'.$name.'/config.txt', 0666);
		if(function_exists($name.'Install')) call_user_func($name.'Install');
		if(!file_exists(ROOT.'data/plugin/'.$name.'/config.txt')) return false;
		return true;
	}
	
	/*
	** Liste le répertoire des plugins et retourne une liste d'objets plugins
	** Les plugins créés sont incomplets (valeurs de configuration uniquement)
	** Cette méthode est appellée par la méthode getPlugins
	** @return : array (objets plugins)
	*/
	private function listPlugins(){
		$data = array();
		$dataNotSorted = array();
		$items = utilScanDir(ROOT.'plugin/');
		
		foreach($items['dir'] as $dir){
			$dataNotSorted[$dir] = json_decode(@file_get_contents(ROOT.'data/plugin/'.$dir.'/config.txt'), true);
		}
		$dataSorted = utilSort2DimArray($dataNotSorted, 'priority', 'num');
		foreach($dataSorted as $plugin=>$config){
			$data[] = $this->createPlugin($plugin);
		}
		return $data;
	}
	
	/*
	** Crée un objet plugin
	** Cette méthode est appellée par la méthode listPlugins ou loadPlugin
	** @param : string (nom du plugin), array (configuration du plugin)
	*/
	private function createPlugin($name){
		$infos = utilReadJsonFile(ROOT.'plugin/'.$name.'/param/infos.json');
		$config = utilReadJsonFile(ROOT.'data/plugin/'.$name.'/config.txt');
		$hooks = utilReadJsonFile(ROOT.'plugin/'.$name.'/param/hooks.json');
		$initConfig = utilReadJsonFile(ROOT.'plugin/'.$name.'/param/config.json');
		if(!is_array($config)) $config = array();
		if(!is_array($hooks)) $hooks = array();
		$plugin = new plugin($name, $config, $infos, $hooks, $initConfig);
		if(!$plugin->isInstalled()) {
			$this->installPlugin($plugin->getName());
		}
		return $plugin;
	}
	
	/*
	** Static
	** Singleton pluginsManager
	*/
	public static function getInstance(){
		if(is_null(self::$instance)) {
			self::$instance = new pluginsManager();
		}
		return self::$instance;
	}
	
	/*
	** Static
	** Retourne la valeur de configuration ciblée d'un plugin
	*/
	public static function getPluginConfVal($pluginName, $kConf){
		$instance = self::getInstance();
		$plugin = $instance->getPlugin($pluginName);
		return $plugin->getConfigVal($kConf);
	}
	
	/*
	** Static
	** Détermine si le plugin ciblé est présent et actif
	** @param : string (nom du plugin)
	*/
	public static function isActivePlugin($pluginName){
		$instance = self::getInstance();
		$plugin = $instance->getPlugin($pluginName);
		if($plugin && $plugin->isInstalled() && $plugin->getConfigval('activate')) return true;
		return false;
	}

}

class plugin{
	private $infos;
	private $config;
	private $name;
	private $hooks;
	private $isValid;
	private $isDefaultPlugin;
	private $titleTag;
	private $metaDescriptionTag;
	private $mainTitle;
	private $libFile;
	private $publicFile;
	private $adminFile;
	private $cssFile;
	private $jsFile;
	private $breadcrumb;
	private $dataPath;
	private $publicTemplate;
	private $adminTemplate;
	private $configTemplate;
	private $initConfig;
	private $navigation;

	/*
	** Constructeur
	*/
	public function __construct($name, $config = array(), $infos = array(), $hooks = array(), $initConfig = array()){
		$this->name = $name;
		$this->config = $config;
		$this->infos = $infos;
		$this->hooks = $hooks;
		$this->isValid = true;
		$this->isDefaultPlugin = ($name == DEFAULT_PLUGIN) ? true : false;
		$this->setTitleTag($infos['name']);
		$this->setMainTitle($infos['name']);
		$this->libFile = (file_exists(ROOT.'plugin/'.$this->name.'/'.$this->name.'.php')) ? ROOT.'plugin/'.$this->name.'/'.$this->name.'.php' : false;
		$this->publicFile = (file_exists(ROOT.'plugin/'.$this->name.'/public.php')) ? ROOT.'plugin/'.$this->name.'/public.php' : false;
		$this->adminFile = (file_exists(ROOT.'plugin/'.$this->name.'/admin.php')) ? ROOT.'plugin/'.$this->name.'/admin.php' : false;
		$this->cssFile = (file_exists(ROOT.'plugin/'.$this->name.'/other/'.$this->name.'.css')) ? ROOT.'plugin/'.$this->name.'/other/'.$this->name.'.css' : false;
		$this->jsFile = (file_exists(ROOT.'plugin/'.$this->name.'/other/'.$this->name.'.js')) ? ROOT.'plugin/'.$this->name.'/other/'.$this->name.'.js' : false;
		$this->addToBreadcrumb($infos['name'], 'index.php?p='.$this->name);
		if($this->isDefaultPlugin) $this->initBreadcrumb();
		$this->dataPath = (is_dir(ROOT.'data/plugin/'.$this->name)) ? ROOT.'data/plugin/'.$this->name.'/' : false;
		//$this->setPlublicTemplate('public');
		if(file_exists('theme/'.getCoreConf('theme').'/'.$this->name.'.php')) $this->publicTemplate = 'theme/'.getCoreConf('theme').'/'.$this->name.'.php';
		else $this->publicTemplate = ROOT.'plugin/'.$this->name.'/template/public.php';
		$this->setAdminTemplate('admin');
		$this->configTemplate = (file_exists(ROOT.'plugin/'.$this->name.'/template/config.php')) ? ROOT.'plugin/'.$this->name.'/template/config.php': false;
		$this->initConfig = $initConfig;
		$this->navigation = array();
	}

	/*
	** getters
	*/
	public function getConfigVal($val){
		return $this->config[$val];
	}
	public function getConfig(){
		return $this->config;
	}
	public function getInfoVal($val){
		return $this->infos[$val];
	}
	public function getName(){
		return $this->name;
	}
	public function getHooks(){
		return $this->hooks;
	}
	public function getIsDefaultPlugin(){
		return $this->isDefaultPlugin;
	}
	public function getTitleTag(){
		return $this->titleTag;
	}
	public function getMetaDescriptionTag(){
		return $this->metaDescriptionTag;
	}
	public function getMainTitle(){
		return $this->mainTitle;
	}
	public function getLibFile(){
		return $this->libFile;
	}
	public function getPublicFile(){
		return $this->publicFile;
	}
	public function getAdminFile(){
		return $this->adminFile;
	}
	public function getCssFile(){
		return $this->cssFile;
	}
	public function getJsFile(){
		return $this->jsFile;
	}
	public function getBreadcrumb(){
		return $this->breadcrumb;
	}
	public function getDataPath(){
		return $this->dataPath;
	}
	public function getPublicTemplate(){
		return $this->publicTemplate;
	}
	public function getAdminTemplate(){
		return $this->adminTemplate;
	}
	public function getConfigTemplate(){
		return $this->configTemplate;
	}
	public function getIsValid(){
		return $this->isValid;
	}
	public function getNavigation(){
		return $this->navigation;
	}

	/*
	** setters
	*/
	public function setConfigVal($k, $v){
		$this->config[$k] = $v;
		if($k == 'activate' && $v < 1 && $this->isDefaultPlugin) $this->isValid = false;
	}
	public function setTitleTag($val){
		if($this->isDefaultPlugin) $val = getCoreConf('siteName').' | '.trim($val);
		else $val = $val.' | '.getCoreConf('siteName');
		if(mb_strlen($val) > 50) $val = mb_strcut($val, 0, 50).'...';
		$this->titleTag = $val;
	}
	public function setMetaDescriptionTag($val){
		$val = trim($val);
		if(mb_strlen($val) > 150) $val = mb_strcut($val, 0, 150).'...';
		$this->metaDescriptionTag = $val;
	}
	public function setMainTitle($val){
		$val = trim($val);
		$this->mainTitle = $val;
	}
	/*public function setPlublicTemplate($fileName){
		if(file_exists('theme/'.getCoreConf('theme').'/'.$fileName.'.php')) $this->publicTemplate = 'theme/'.getCoreConf('theme').'/'.$fileName.'.php';
		else $this->publicTemplate = ROOT.'plugin/'.$this->name.'/template/'.$fileName.'.php';
	}*/
	public function setAdminTemplate($fileName){
		$this->adminTemplate = ROOT.'plugin/'.$this->name.'/template/'.$fileName.'.php';
	}

	/*
	** Ajoute un élément au fil d'Ariane
	** @param : string (intitulé du lien), string (URL du lien)
	*/
	function addToBreadcrumb($label, $target){
		$this->breadcrumb[] = array('label' => $label, 'target' => $target);
	}

	/*
	** Supprime un élément du fil d'Ariane
	** @param : int (clé à supprimer)
	*/
	function removeToBreadcrumb($k){
		unset($this->breadcrumb[$k]);
	}

	/*
	** Initialise le fil d'Ariane
	*/
	function initBreadcrumb(){
		$this->breadcrumb = array();
	}
	
	/*
	** Ajoute un élément dans la navigation
	** @param : string (intitulé du lien), string (URL du lien)
	*/
	function addToNavigation($label, $target){
		$this->navigation[] = array('label' => $label, 'target' => $target);
	}

	/*
	** Détermine si le plugin est installé / updaté
	** @return : true / false
	*/
	public function isInstalled(){
		$currentConfig = implode(',', array_keys($this->config));
		$initConfig = implode(',', array_keys($this->initConfig));
		if(count($this->config) < 1 || $currentConfig != $initConfig) return false;
		return true;
	}
	
	/*
	** Alias de getPublicFile
	*/
	public function getFrontFile(){
		return $this->getPublicFile();
	}
}
?>
