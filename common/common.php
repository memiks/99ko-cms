<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

//error_reporting(E_ALL);
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
define('VERSION', '1.2.2 b');
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
utilSetMagicQuotesOff();


/*
** Phase de traitement des plugins (chargement, installation, hooks...)
*/


// On créé le manager de plugins via la méthode getInstance (singleton)
$pluginsManager = pluginsManager::getInstance();

// on boucle les plugins pour charger les lib et les installer
foreach($pluginsManager->getPlugins() as $plugin){
	// on inclu la librairie
	include_once($plugin->getLibFile());
	// on update le tableau des hooks
	if ($plugin->getConfigVal('activate')) {
		foreach ($plugin->getHooks() as $hookName=>$function) {
			$hooks[$hookName][] = $function;
		}
	}
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
