<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2013 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com) / Frédéric Kaplon
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
	if($msg != '') $data = '<div id="msg" class="'.$class[$type].'"><p>'.nl2br($msg).'</p></div>';
	eval(callHook('endShowMsg'));
	echo $data;
}

/*
** Affiche les balises links
** @param : $format (format)
*/
function showLinkTags($format = '<link href="[file]" rel="stylesheet" type="text/css" />'){
	global $pluginsManager;
	$data = '';
	eval(callHook('startShowLinkTags'));
	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
		if($plugin->getConfigVal('activate') && $plugin->getCssFile()) $data.= str_replace('[file]', $plugin->getCssFile(), $format);
	}
	if(ROOT == './') $data.= str_replace('[file]', ROOT.'theme/'.getCoreConf('theme').'/styles.css', $format);
	eval(callHook('endShowLinkTags'));
	echo $data;
}

/*
** Affiche les balises script
** @param : $format (format)
*/
function showScriptTags($format = '<script type="text/javascript" src="[file]"></script>') {
	global $pluginsManager;
	$data = '';
	eval(callHook('startShowScriptTags'));
	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
		if($plugin->getConfigVal('activate') && $plugin->getJsFile()) $data.= str_replace('[file]', $plugin->getJsFile(), $format);
	}
	if(ROOT == './') $data.= str_replace('[file]', ROOT.'theme/'.getCoreConf('theme').'/scripts.js', $format);
	eval(callHook('endShowScriptTags'));
	echo $data;
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
	eval(callHook('startShowtitleTag'));
	$data = $runPlugin->getTitleTag();
	eval(callHook('endShowtitleTag'));
	echo $data;
}

/*
** Affiche le contenu de la meta description
*/
function showMetaDescriptionTag() {
	global $runPlugin;
	eval(callHook('startShowMetaDescriptionTag'));
	$data = $runPlugin->getMetaDescriptionTag();
	eval(callHook('endShowMetaDescriptionTag'));
	echo $data;
}

/*
** Affiche le titre H1
*/
function showMainTitle($format = '<h1>[mainTitle]</h1>') {
	global $runPlugin;
	eval(callHook('startShowMainTitle'));
	if(getCoreConf('hideTitles') == 0 && $runPlugin->getMainTitle() != ''){
		$data = $format;
		$data = str_replace('[mainTitle]', $runPlugin->getMainTitle(), $data);
	}
	else $data = '';
	eval(callHook('endShowMainTitle'));
	echo $data;
}

/*
** Affiche le nom du site
*/
function showSiteName() {
	eval(callHook('startShowSiteName'));
	$data = getCoreConf('siteName');
	eval(callHook('endShowSiteName'));
	echo $data;
}

/*
** Affiche la description du site
*/
function showSiteDescription() {
	eval(callHook('startShowSiteDescription'));
	$data = getCoreConf('siteDescription');
	eval(callHook('endShowSiteDescription'));
	echo $data;
}

/*
** Affiche l'url du site
*/
function showSiteUrl() {
	eval(callHook('startShowSiteUrl'));
	$data = getCoreConf('siteUrl');
	eval(callHook('endShowSiteUrl'));
	echo $data;
}

/*
** Affiche la langue du site
*/
function showSiteLang() {
	eval(callHook('startShowSiteLang'));
	$data = getCoreConf('siteLang');
	eval(callHook('endShowSiteLang'));
	echo $data;
}

/*
** Affiche le temps de génération
*/
function showExecTime() {
	global $time;
	eval(callHook('startShowExecTime'));
	$data = round(microtime(true) - $time, 3);
	eval(callHook('endShowExecTime'));
	echo $data;
}

/*
** Affiche le menu principal
** @param : $format (format)
*/
function showMainNavigation($format = '<li><a target="[targetAttribut]" href="[target]">[label]</a></li>') {
	global $pluginsManager;
	$data = '';
	eval(callHook('startShowMainNavigation'));
	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
		foreach($plugin->getNavigation() as $k2=>$item){
			$temp = $format;
			$temp = str_replace('[target]', $item['target'], $temp);
			$temp = str_replace('[label]', $item['label'], $temp);
			$temp = str_replace('[targetAttribut]', $item['targetAttribut'], $temp);
			$data.= $temp;
		}
	}
	eval(callHook('endShowMainNavigation'));
	echo $data;
}

/*
** Affiche le fil d'Ariane
*/
function showBreadcrumb() {
	global $runPlugin;
	$data = '';
	eval(callHook('startShowBreadcrumb'));
	if(count($runPlugin->getBreadcrumb()) > 0) {
		$data.= '<p id="breadcrumb"><a href="'.getCoreConf('siteUrl').'">Accueil</a>';
		foreach($runPlugin->getBreadcrumb() as $item) $data.= ' >> <a href="'.$item['target'].'">'.$item['label'].'</a>';
		$data.= '</p>';
	}
	eval(callHook('endShowBreadcrumb'));
	echo $data;
}

/*
** Affiche le nom du thème
*/
function showTheme($format = '<a target="_blank" href="[authorWebsite]">[name]</a>') {
	global $themes;
	eval(callHook('startShowTheme'));
	$data = $format;
	$data = str_replace('[authorWebsite]', $themes[getCoreConf('theme')]['authorWebsite'], $data);
	$data = str_replace('[author]', $themes[getCoreConf('theme')]['author'], $data);
	$data = str_replace('[name]', $themes[getCoreConf('theme')]['name'], $data);
	eval(callHook('endShowTheme'));
	echo $data;
}

/*
** Affiche le contenu de la sidebar
*/
function showSidebarItems($format = '<div class="item" id="[id]"><p class="title">[title]</p>[content]</div>') {
	global $pluginsManager;
	$data = '';
	eval(callHook('startShowSidebarItems'));
	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
		if($plugin->getConfigVal('sidebarTitle') != '' && $plugin->getConfigVal('sidebarCallFunction') != ''){
			$temp = $format;
			$temp = str_replace('[id]', 'sidebaritem-'.$plugin->getName(), $temp);
			$temp = str_replace('[title]', $plugin->getConfigVal('sidebarTitle'), $temp);
			$temp = str_replace('[content]', call_user_func($plugin->getConfigVal('sidebarCallFunction')), $temp);
			$data.= $temp;
		}
	}
	eval(callHook('endShowSidebarItems'));
	echo $data;
}

function showPluginId(){
	global $runPlugin;
	eval(callHook('startShowPluginId'));
	$data = $runPlugin->getName();
	eval(callHook('endShowPluginId'));
	echo $data;
}
?>