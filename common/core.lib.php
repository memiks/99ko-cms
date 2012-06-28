<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

if(!defined('ROOT')) die();
include_once('util.lib.php');
include_once('plugin.class.php');
include_once('show.lib.php');

/*
** Fonctions internes
*/

/*
** Renvoie la configuration complète du core ou une valeur précise
** @return : array
*/
function getCoreConf($k = ''){
	global $coreConf;
	$data = ($coreConf) ? $coreConf : json_decode(@file_get_contents(ROOT.'data/config.txt'), true);
	if($k != '') return $data[$k];
	else return $data;
}

/*
** Enregistre la configuration du core
** @param : $val (valeur a updater), $append (tableau de nouvelles valeurs)
*/
function saveConfig($val, $append = array()){
	$config = json_decode(@file_get_contents(ROOT.'data/config.txt'), true);
	$config = array_merge($config, $append);
	foreach($config as $k=>$v){
		if(isset($val[$k])) $config[$k] = $val[$k];
	}
	if(@file_put_contents(ROOT.'data/config.txt', json_encode($config), 0666)) return true;
	return false;
}

/*
** Appelle un hook
** @param : $hook
** @return : string (PHP)
*/
function callHook($hookName){
	global $hooks;
	$return = '';
	if(isset($hooks[$hookName])) foreach($hooks[$hookName] as $function){
		$return.= call_user_func($function);
	}
	return $return;
}

/*
** Ajoute un hook
** @param : $hookName (nom du hook), $function (fonction a executer)
*/
function addHook($hookName, $function){
	global $hooks;
	$hooks[$hookName][] = $function;
}

/*
** liste le dossier theme
** @return : array
*/
function listThemes(){
	$data = array();
	$items = utilScanDir(ROOT.'theme/');
	foreach($items['dir'] as $file){
		$data[$file] = getThemeInfos($file);
	}
	return $data;
}

/*
** Détecte l'url de base
** @return : string (URL de base)
*/
function getSiteUrl(){
	$siteUrl = str_replace(array('install.php', '/admin/index.php'), array('', ''), $_SERVER['SCRIPT_NAME']);
	$siteUrl = 'http://'.$_SERVER['HTTP_HOST'].$siteUrl;
	$pos = mb_strlen($siteUrl)-1;
	if($siteUrl[$pos] == '/') $siteUrl = substr($siteUrl, 0, -1);
	return $siteUrl;
}

/*
** Renvois les infos d'un thème
** @param : string (nom du thème)
** @return : array
*/
function getThemeInfos($name){
	$data = json_decode(@file_get_contents(ROOT.'theme/'.$name.'/infos.json'), true);
	return $data;
}
?>
