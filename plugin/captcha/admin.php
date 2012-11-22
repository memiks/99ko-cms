<?php
if(!defined('ROOT')) die();
switch(ACTION){
	case 'save':
		$runPlugin->setConfigVal('method', $_POST['method']);
		pluginsManager::savePluginConfig($runPlugin);
		header('location:index.php?p=captcha');
		die();
		break;
	default:
		$data['method'] = $runPlugin->getConfigVal('method');
}
?>
