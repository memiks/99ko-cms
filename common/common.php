<?php
error_reporting(E_ALL);
if(!defined('ROOT')) die();


/*
** Préchauffage
*/


session_start();
// on check le fichier de configuration
if(!file_exists(ROOT.'data/config.txt')){
	header('location:'.ROOT.'install.php');
	die();
}
// constantes
define('VERSION', '1.2.0.4 b');
define('ACTION', ((isset($_GET['action'])) ? $_GET['action'] : ''));
// tableau des hooks
$hooks = array();
// on inclu les librairies
include_once(ROOT.'common/core.lib.php');
// on charge la config du core
$coreConf = getCoreConf();
// Chargement des thèmes
$themes = listThemes();
//constantes
define('DEFAULT_PLUGIN', $coreConf['defaultPlugin']);
define('PLUGIN', ((isset($_GET['p'])) ? $_GET['p'] : DEFAULT_PLUGIN)); // voir $runPlugin
// fix magic quotes
setMagicQuotesOff();


/*
** Phase de traitement des plugins (chargement, installation, hooks...)
*/


// On créé le manager de plugins via la méthode getInstance (singleton)
$pluginsManager = pluginsManager::getInstance();
// on boucle les plugins pour charger les lib et les installer
foreach($pluginsManager->getPlugins() as $plugin){
	// on inclu la librairie
	include_once($plugin->getLibFile());
	// si le plugin n'est pas installé on l'installe
	if(!$plugin->isInstalled()) $pluginsManager->installPlugin($plugin->getName());
	// On charge le plugin dans sa version complète et on le garde en mémoire
	$pluginsManager->loadPlugin($plugin->getName(), $plugin->getConfig());
}
// on boucle les plugins actifs pour alimenter le tableau des hooks
foreach($pluginsManager->getPlugins() as $plugin) if($plugin->getConfigVal('activate')){
	// on update le tableau des hooks
	foreach($plugin->getHooks() as $hookName=>$function) $hooks[$hookName][] = $function;
}


/*
** Création de l'objet $runPLugin (plugin solicité)
*/


// hook
eval(callHook('startCreatePlugin'));
// on cree l'instance du plugin solicite
$runPlugin = $pluginsManager->getPlugin(PLUGIN);
// hook
eval(callHook('endCreatePlugin'));
// si le plugin solicite est inactif on stop
if($runPlugin->getConfigVal('activate') < 1) die();
?>