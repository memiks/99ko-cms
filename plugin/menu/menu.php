<?php
if(!defined('ROOT')) die();

###### Déclaration
define('MENU_DATAPATH', ROOT.'data/plugin/menu/');
define('MENU_LINKS', ROOT.'data/plugin/menu/links/');
define('MENU_PLUGINPATH', ROOT.'plugin/menu/');

###### Classes
require_once(MENU_PLUGINPATH.'lib/menu.class.php');
require_once(MENU_PLUGINPATH.'lib/menuLink.class.php');

###### Installation
function menuInstall() {
	$index = array("current" => 0, "links" => array());
	
	mkdir(MENU_LINKS);
	utilWriteJsonFile(MENU_LINKS.'index.json', $index);
	utilWriteJsonFile(MENU_DATAPATH.'menu.json', array());
	
	menuCheckLinks('menu');
}

###### Hooks
function menuCheckLinks($check = '') {
	global $runPlugin;
	global $pluginsManager;

	if ($check == '') {
		if (isset($_GET['p'])) {
			$check = $runPlugin->getName();
		} else {
			$check = 'menu';
		}
	}
	
	if ($check == 'menu' || $check == 'pluginsmanager') {
		foreach ($pluginsManager->getPlugins() as $plugin) {
			if ($plugin->getName() != 'menu' && $plugin->getName() != 'pluginsmanager') {
				menuCheckLinks($plugin->getName());
			}
		}
	} else {
		if ($pluginsManager->isActivePlugin($check)) {
			$plugin = $pluginsManager->getPlugin($check);
			$links = $plugin->getNavigation();
		
			if (menu::updateLinks($check, $links)) {
				menu::saveMenu();
			}
		} else {
			$plugin = $pluginsManager->getPlugin($check);
			$links = array();
		
			if (menu::updateLinks($check, $links)) {
				menu::saveMenu();
			}
		}
	}
}

function menuModify() {
	global $pluginsManager;

	if (pluginsManager::isActivePlugin('menu')) {
		if (ROOT != '../') {
			foreach ($pluginsManager->getPlugins() as $plugin) {
				$plugin->initNavigation();
			}
		
			$plugin = $pluginsManager->getPlugin('menu');

			foreach (menu::getLinks() as $link) {
				$plugin->addToNavigation($link->getLabel(), $link->getUrl(), $link->getTarget());
			}
		} else {
			menuCheckLinks();
		}
	}
}
