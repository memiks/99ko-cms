<?php
if(!defined('ROOT')) die();

$msg = '';
$msgType = '';

switch(ACTION){
	case '':
		$plugins = array();
		foreach($pluginsManager->getPlugins() as $k=>$v){
			$plugins[$k]['id'] = $v->getName();
			$plugins[$k]['locked'] = ($v->getIsDefaultPlugin() || $v->getName() == 'pluginsmanager') ? true : false;
			$plugins[$k]['name'] = $v->getInfoVal('name');
			$plugins[$k]['description'] = $v->getInfoVal('description');
			$plugins[$k]['target'] = ($v->getAdminFile()) ? 'index.php?p='.$v->getName() : false;
			$plugins[$k]['activate'] = ($v->getConfigVal('activate')) ? true : false;
			$plugins[$k]['priority'] = $v->getConfigVal('priority');
			$plugins[$k]['version'] = $v->getInfoVal('version');
			$plugins[$k]['author'] = $v->getInfoVal('author');
			$plugins[$k]['authorEmail'] = $v->getInfoVal('authorEmail');
			$plugins[$k]['authorWebsite'] = $v->getInfoVal('authorWebsite');
			$plugins[$k]['frontFile'] = $v->getFrontFile();
		}
		$priority = array(
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
			6 => 6,
			7 => 7,
			8 => 8,
			9 => 9,
		);
		break;
	case 'save':
		$error = false;

		foreach ($pluginsManager->getPlugins() as $k=>$plug) {
			if (!$plug->getIsDefaultPlugin()) {
				if (isset($_POST['activate'][$plug->getName()])) {
					$plug->setConfigVal('activate', 1);
				} else {
					$plug->setConfigVal('activate', 0);
				}
			}
			# Désinstalle les plugins déja installés
			if (!isset($_POST['installed'][$plug->getName()]) && !$plug->getIsDefaultPlugin()) {
			  if (is_dir(ROOT.'plugin/'.strtolower($plug->getName()))) {
    			rrmdir(ROOT.'plugin/'.strtolower($plug->getName()));
			  }
			  if (is_dir(ROOT.'data/plugin/'.strtolower($plug->getName()))) {
    			rrmdir(ROOT.'data/plugin/'.strtolower($plug->getName()));
			  }
			}
			else {
			  $plug->setConfigVal('priority', intval($_POST['priority'][$plug->getName()]));
			
			  if (!$pluginsManager->savePluginConfig($plug)) {
			    $error = true;
				$data['msgPlugins'] = "Erreur d'enregistrement de la configuration du plugin";
			  }
			}
		}
		# Installe les nouveaux plugins
		if (isset($_POST['installed']) && is_array($_POST['installed'])){
		  foreach ($_POST['installed'] as $key => $value){
		  	if (!is_dir(ROOT.'data/plugin/'.strtolower($key))) {
		  	  $url = $data['allplugins'][strtolower($key)]['url'];
		  	  $names = explode("/", $url);
			  $name = end($names);
		  	  $ziptmp = ROOT.'data/upload/'.$name;
		  	  if ($gemsetmanager->download($ziptmp,$url)){
		  	  	$zip = new ZipArchive;
			    $res = $zip->open($ziptmp);
	     		if ($res === TRUE) {
			      $zip->extractTo(ROOT.'plugin/');
			      @rename(ROOT.'plugin/'.str_replace("/","",$zip->getNameIndex(0)),ROOT.'plugin/'.strtolower($key));
			      $zip->close();
			      unlink($ziptmp);
			    }
			    else {
			      $error = true;
			      $data['msgPlugins'] = "Erreur d'extraction de l'archive du plugin";
			    }
		  	  }
		  	}
		  }
		}
		if (!$error) {
			header('location:index.php?p=gemsetmanager');
			die();
		}
		break;
}
?>