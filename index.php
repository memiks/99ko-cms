<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2011 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

$time = microtime(true);
// on declare ROOT
define('ROOT', './');
// on inclu le fichier common
include_once(ROOT.'common/common.php');

// variables de template
$data['99koVersion'] = VERSION;
$data['titleTag'] = '';
$data['siteDescription'] = $coreConf['siteDescription'];
$data['metaDescriptionTag'] = '';
$data['linkTags'][] = ROOT.'common/normalize.css';
$data['scriptTags'][] = ROOT.'common/jquery.js';
$data['siteName'] = $coreConf['siteName'];
$data['siteUrl'] = $coreConf['siteUrl'];
$data['mainTitle'] = '';
$data['mainNavigation'] = array();
$data['theme'] = $coreConf['theme'];
$data['themeName'] = $themes[$coreConf['theme']]['name'];
$data['themeAuthor'] = $themes[$coreConf['theme']]['author'];
$data['themeAuthorWebsite'] = $themes[$coreConf['theme']]['authorWebsite'];
$data['sidebarItems'] = array();

foreach ($pluginsManager->getPlugins() as $k=>$plugin) {
	if ($plugin->getConfigVal('activate')) {
		if ($plugin->getCssFile()) {
			$data['linkTags'][] = $plugin->getCssFile();
		}
		
		if ($plugin->getJsFile()) {
			$data['scriptTags'][] = $plugin->getJsFile();
		}
		
		if ($plugin->getConfigVal('sidebarTitle') != '' 
		 && $plugin->getConfigVal('sidebarCallFunction') != '') {
			$data['sidebarItems'][$k]['id'] = 'sidebaritem-'.$plugin->getName();
			$data['sidebarItems'][$k]['title'] = $plugin->getConfigVal('sidebarTitle');
			$data['sidebarItems'][$k]['content'] = call_user_func($plugin->getConfigVal('sidebarCallFunction'));
		}
	}
}

$data['linkTags'][] = ROOT.'theme/'.$coreConf['theme'].'/styles.css';

// hook
eval(callHook('startFrontIncludePluginFile'));

// on inclu les fichiers du plugin courant
if($runPlugin->getFrontFile()){
	include($runPlugin->getFrontFile());
	include($runPlugin->getPublicTemplate());
}

// hook
eval(callHook('endFrontIncludePluginFile'));

?>
