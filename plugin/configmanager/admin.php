<?php
if(!defined('ROOT')) die();

$msg = '';
$error = false;

$htaccess = @file_get_contents(ROOT.'.htaccess');
$htaccess = htmlspecialchars($htaccess, ENT_QUOTES, 'UTF-8');
$temp = str_replace('http://', '', getCoreConf('siteUrl'));
$temp = substr(strrchr($temp, '/'), 1);
if($temp == '') $temp = '/';
else $temp = '/'.$temp.'/';
$rewriteBase = $temp;
$themes = array();
foreach(listThemes() as $k=>$theme){
	$themes[$k]['name'] = $theme['name'];
	$themes[$k]['author'] = $theme['author'];
	$themes[$k]['authorEmail'] = $theme['authorEmail'];
	$themes[$k]['authorWebsite'] = $theme['authorWebsite'];
	$themes[$k]['selected'] = ($k == getCoreConf('theme')) ? true : false;
}
$plugins = array();
foreach($pluginsManager->getPlugins() as $k=>$v){
	$plugins[$k]['id'] = $v->getName();
	$plugins[$k]['isDefaultPlugin'] = $v->getIsDefaultPlugin();
	$plugins[$k]['name'] = $v->getInfoVal('name');
	$plugins[$k]['target'] = ($v->getAdminFile()) ? 'index.php?p='.$v->getName() : false;
	$plugins[$k]['activate'] = ($v->getConfigVal('activate')) ? true : false;
	$plugins[$k]['frontFile'] = $v->getPublicFile();
}
$config = $coreConf;

switch(ACTION){
	case 'save':
		$config = array(
			'siteName' => (trim($_POST['siteName']) != '') ? trim($_POST['siteName']) : 'Démo',
			'siteDescription' => (trim($_POST['siteDescription']) != '') ? trim($_POST['siteDescription']) : 'Un site propulsé par 99Ko',
			'adminEmail' => (utilIsEmail(trim($_POST['adminEmail']))) ? trim($_POST['adminEmail']) : 'you@domain.com',
			'siteUrl' => (trim($_POST['siteUrl']) != '') ? trim($_POST['siteUrl']) : getSiteUrl(),
			'theme' => $_POST['theme'],
			'defaultPlugin' => $_POST['defaultPlugin'],
			'urlRewriting' => (isset($_POST['urlRewriting'])) ? '1' : '0',
			'siteLang' => $_POST['lang'],
			'hideTitles' => (isset($_POST['hideTitles'])) ? '1' : '0',
		);
		if(trim($_POST['adminPwd']) != ''){
			if(trim($_POST['adminPwd']) == trim($_POST['adminPwd2'])) {
				$config['adminPwd'] = encrypt(trim($_POST['adminPwd']));
				$_SESSION['admin'] = $config['adminPwd'];
			} else {
				$msg = lang("The password is different from his confirmation.");
				$error = true;
			}
		}
		if(!saveConfig($config)){
			$msg = lang("An error occurred while saving the changes.");
			$error = true;
		}
		@file_put_contents(ROOT.'.htaccess', str_replace('¶m', '&param', $_POST['htaccess']));
		if(!$error){
			header('location:index.php?p=configmanager');
			die();
		}
		break;
}
?>