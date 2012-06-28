<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

/************************************************
** Fonction chargées de l'affichage (public & admin)
************************************************/

/*
** Affiche un message (error/success) système
** @param : $msg (message), $type (error/success)
** @return : string HTML
*/
function showMsg($msg, $type) {
	$class = array(
		'error' => 'error',
		'success' => 'success',
	);
	$data = '';
	eval(callHook('startShowMsg'));
	if ($msg != '') {
		$data = '<div id="msg" class="'.$class[$type].'"><p>'.nl2br($msg).'</p></div>';
	}
	eval(callHook('endShowMsg'));
	echo $data;
}

/*
** Affiche les balises links
** @param : $format (format)
*/
function showLinkTags($format = '<link href="[file]" rel="stylesheet" type="text/css" />'){
	global $pluginsManager, $coreConf;
	foreach($pluginsManager->getPlugins() as $k=>$plugin){
		if ($plugin->getConfigVal('activate') && $plugin->getCssFile()){
			echo str_replace('[file]', $plugin->getCssFile(), $format);
		}
	}
	if(ROOT == './') echo str_replace('[file]', ROOT.'theme/'.$coreConf['theme'].'/styles.css', $format);
}

/*
** Affiche les balises script
** @param : $format (format)
*/
function showScriptTags($format = '<script type="text/javascript" src="[file]"></script>') {
	global $pluginsManager, $coreConf;
	echo str_replace('[file]', ROOT.'common/jquery.js', $format);
	foreach($pluginsManager->getPlugins() as $k=>$plugin){
		if ($plugin->getConfigVal('activate') && $plugin->getJsFile()){
			echo str_replace('[file]', $plugin->getJsFile(), $format);
		}
	}
}

/************************************************
** Fonction chargées de l'affichage (admin)
************************************************/

/*
** Affiche l'editeur HTML
** @param : $name (attribut name), $content, $width, $height, $id (attribut id), $class (attribut class)
** @return : string HTML
*/
function showAdminEditor($name, $content, $width, $height, $id = 'editor', $class = 'editor') {
	eval(callHook('startShowAdminEditor'));
	$data = '<textarea style="width:'.$width.'px;height:'.$height.'px" name="'.$name.'" id="'.$id.'" class="'.$class.'">'.$content.'</textarea>';
	eval(callHook('endShowAdminEditor'));
	echo $data;
}

/*
** Affiche un input hidden contenant le token en session (admin)
** @return : string HTML
*/
function showAdminTokenField() {
	global $data;
	eval(callHook('startShowAdminTokenField'));
	$output = '<input type="hidden" name="token" value="'.$data['token'].'" />';
	eval(callHook('endShowAdminTokenField'));
	echo $output;
}

/************************************************
** Fonction chargées de l'affichage (public)
************************************************/

/*
** Affiche le contenu de la meta title
*/
function showTitleTag() {
	global $runPlugin;
	echo $runPlugin->getTitleTag();
}

/*
** Affiche le contenu de la meta description
*/
function showMetaDescriptionTag() {
	global $runPlugin;
	echo $runPlugin->getMetaDescriptionTag();
}

/*
** Affiche le titre H1
*/
function showMainTitle() {
	global $runPlugin;
	echo $runPlugin->getMainTitle();
}

/*
** Affiche le nom du site
*/
function showSiteName() {
	global $coreConf;
	echo $coreConf['siteName'];
}

/*
** Affiche la description du site
*/
function showSiteDescription() {
	global $coreConf;
	echo $coreConf['siteDescription'];
}

/*
** Affiche l'url du site
*/
function showSiteUrl() {
	global $coreConf;
	echo $coreConf['siteUrl'];
}

/*
** Affiche le temps de génération
*/
function showExecTime() {
	global $time;
	echo round(microtime(true) - $time, 3);
}

/*
** Affiche le menu principal
** @param : $format (format)
*/
function showMainNavigation($format = '<li><a href="[target]">[label]</a></li>') {
	global $pluginsManager;
	foreach($pluginsManager->getPlugins() as $k=>$plugin){
		foreach($plugin->getNavigation() as $k2=>$item){
			$output = $format;
			$output = str_replace('[target]', $item['target'], $output);
			$output = str_replace('[label]', $item['label'], $output);
			echo $output;
		}
	}
}

/*
** Affiche le fil d'Ariane
*/
function showBreadcrumb() {
	global $runPlugin, $coreConf;
	if (count($runPlugin->getBreadcrumb()) > 0) {
		echo '<p id="breadcrumb"><a href="'.$coreConf['siteUrl'].'">Accueil</a>';
		foreach ($runPlugin->getBreadcrumb() as $item) {
			echo ' >> <a href="'.$item['target'].'">'.$item['label'].'</a>';
		}
		echo '</p>';
	}
}

/*
** Affiche le nom du thème
*/
function showTheme($format = '<a target="_blank" href="[authorWebsite]">[name]</a>') {
	global $themes, $coreConf;
	$output = $format;
	$output = str_replace('[authorWebsite]', $themes[$coreConf['theme']]['authorWebsite'], $output);
	$output = str_replace('[author]', $themes[$coreConf['theme']]['author'], $output);
	$output = str_replace('[name]', $themes[$coreConf['theme']]['name'], $output);
	echo $output;
}

/*
** Affiche le contenu de la sidebar
*/
function showSidebarItems($format = '<div class="item" id="[id]"><p class="title">[title]</p>[content]</div>') {
	global $pluginsManager;
	foreach($pluginsManager->getPlugins() as $k=>$plugin){
		if($plugin->getConfigVal('sidebarTitle') != '' && $plugin->getConfigVal('sidebarCallFunction') != ''){
			$output = $format;
			$output = str_replace('[id]', 'sidebaritem-'.$plugin->getName(), $output);
			$output = str_replace('[title]', $plugin->getConfigVal('sidebarTitle'), $output);
			$output = str_replace('[content]', call_user_func($plugin->getConfigVal('sidebarCallFunction')), $output);
			echo $output;
		}
	}
}

function showPluginId(){
	global $runPlugin;
	echo $runPlugin->getName();
}
?>