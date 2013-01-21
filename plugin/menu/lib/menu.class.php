<?php

class menu {
	public static function createLink($label, $url, $plugin, $target = '_self') {
		$newlink = new menuLink();

		$newlink->setLabel($label);
		$newlink->setUrl($url);
		$newlink->setTarget($target);
		$newlink->setPlugin($plugin);

		$newlink->save();
		
		return $newlink;
	}
	
	public static function getLinks($plugin = '') {
		$links = array();

		if ($plugin == '') {
			$index = utilReadJsonFile(MENU_LINKS.'index.json');
		
			foreach ($index['links'] as $link) {
				$links[] = new menuLink($link['id']);
			}
		} else {
			$index = utilReadJsonFile(MENU_LINKS.'index.json');
		
			foreach ($index['links'] as $link) {
				if ($link['plugin'] == $plugin) {
					$links[] = new menuLink($link['id']);
				}
			}
		}

		return $links;
	}
	
	public static function getMenu() {
		return utilReadJsonFile(MENU_DATAPATH.'menu.json');
	}
	
	public static function deleteLink($link) {
		if (is_file(MENU_LINKS.$link->getId().'.json')) {
			unlink(MENU_LINKS.$link->getId().'.json');
		}

		$index = utilReadJsonFile(MENU_LINKS.'index.json');

		foreach ($index['links'] as $position=>$currentlink) {
			if ($currentlink['id'] == $link->getId()) {
				unset($index['links'][$position]);
				$index['links'] = array_values($index['links']);
				break;
			}
		}

		utilWriteJsonFile(MENU_LINKS.'index.json', $index);
	}
	
	public static function updateLink($id, $label, $url, $plugin, $target = '_self') {
		$link = new menuLink($id);

		$link->setLabel($label);
		$link->setUrl($url);
		$link->setTarget($target);
		$link->setPlugin($plugin);

		$link->save();
		
		return $link;
	}
	
	public static function updateLinks($plugin, $links) {
		$currentlinks = menu::getLinks($plugin);
		$newlinks = array();
		$changed = false;
		
		foreach ($links as $link) {
			$new = true;
			$id = -1;
			foreach ($currentlinks as $k=>$currentlink) {
				if ($link['label'] == $currentlink->getLabel()) {
					if ($link['target'] != $currentlink->getUrl()) {
						$currentlink->setUrl($link['target']);
						$currentlink->save();
						$changed = true;
					}
					$new = false;
					$id = $k;
				} else if ($link['target'] == $currentlink->getUrl()) {
					$currentlink->setLabel($link['label']);
					$currentlink->save();
					$changed = true;
					$new = false;
					$id = $k;
				}
			}

			if ($new) {
				$newlinks[] = menu::createLink($link['label'], $link['target'], $plugin);
				$changed = true;
			} else {
				unset($currentlinks[$id]);
			}
		}
		
		foreach ($currentlinks as $currentlink) {
			menu::deleteLink($currentlink);
			$changed = true;
		}
		
		menu::saveLinks($plugin, $newlinks);
		
		return $changed;
	}
	
	public static function saveLinks($plugin, $links) {
		$index = utilReadJsonFile(MENU_LINKS.'index.json');
		
		foreach ($links as $link) {
			$index['links'][] = array(
				'id' => $link->getId(),
				'plugin' => $plugin
			);
		}
		
		utilWriteJsonFile(MENU_LINKS.'index.json', $index);
	}
	
	public static function saveMenu() {
		$index = utilReadJsonFile(MENU_LINKS.'index.json');
		$menu = array();
		
		foreach ($index['links'] as $link) {
			$link = new menuLink($link['id']);
			$menu[] = array(
				'label' => $link->getLabel(),
				'url' => $link->getUrl(),
				'target' => $link->getTarget()
			);
		}
		
		utilWriteJsonFile(MENU_DATAPATH.'menu.json', $menu);
	}
}

?>
