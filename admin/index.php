<?php
// on declare ROOT
define('ROOT', '../');
// on inclu le fichier common
include_once(ROOT.'common/common.php');
// on genere le jeton
if(!isset($_SESSION['token'])) $_SESSION['token'] = uniqid();
// on check le jeton
if(in_array(ACTION, array('save', 'del', 'saveconfig', 'saveplugins', 'login', 'logout')) && $_REQUEST['token'] != $_SESSION['token']){
	include_once('login.php');
	die();
}
// Variables de template
$msg = '';
$data['msg'] = ''; // retro compatibilité
$version = VERSION;
$token = $_SESSION['token'];
$data['token'] = $token; // retro compatibilité
$pluginName = $runPlugin->getInfoVal('name');
$data['pluginName'] = $pluginName; // retro compatibilité
$navigation[-1]['label'] = lang('Home');
$navigation[-1]['url'] = './';
$navigation[-1]['name'] = '_default';
$navigation[-1]['isActive'] = (!isset($_GET['p'])) ? true : false;
foreach($pluginsManager->getPlugins() as $k=>$v) if($v->getConfigVal('activate') && $v->getAdminFile()){
	$navigation[$k]['label'] = $v->getInfoVal('name');
	$navigation[$k]['url'] = 'index.php?p='.$v->getName();
	$navigation[$k]['name'] = $v->getName();
	$navigation[$k]['isActive'] = (isset($_GET['p']) && $_GET['p'] == $v->getName()) ? true : false;
}

$pluginConfigTemplate = (!isset($_GET['p'])) ? false :$runPlugin->getConfigTemplate();
$pageTitle = (!isset($_GET['p'])) ? lang('Welcome to 99ko') : $runPlugin->getInfoVal('name');
// Actions
if(ACTION == 'login'){
	$loginAttempt = (isset($_SESSION['loginAttempt'])) ? $_SESSION['loginAttempt'] : 0;
	$loginAttempt++;
	$_SESSION['loginAttempt'] = $loginAttempt;
	if($loginAttempt > 4 || !isset($_SESSION['loginAttempt'])){
		$msg = lang('Please wait before retrying');
	}
	else{
		$pwd = $coreConf['adminPwd'];
		if(encrypt(trim($_POST['adminPwd'])) == $pwd){
			$_SESSION['admin'] = $pwd;
			$_SESSION['loginAttempt'] = 0;
			$_SESSION['token'] = uniqid();
			header('location:index.php');
			die();
		}
		else{
			$msg = lang('Incorrect password');
		}
	}
}
elseif(ACTION == 'logout'){
	unset($_SESSION['admin']);
	unset($_SESSION['loginAttempt']);
	unset($_SESSION['token']);
	header('location:index.php');
	die();
}
// Login mode
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != $coreConf['adminPwd']){
	include_once('login.php');
}
// Homepage mode
elseif(!isset($_GET['p'])){
	if (!file_exists('../.htaccess')) $msg.= lang('The .htaccess file is missing !');
	if (file_exists('../install.php')) $msg.= lang('The install.php file must be deleted !');
	include_once('home.php');
}
// Plugin mode
elseif(isset($_GET['p']) && $runPlugin->getAdminFile()){
	// hook
	eval(callHook('startAdminIncludePluginFile'));
	include($runPlugin->getAdminFile());
	include($runPlugin->getAdminTemplate());
	// hook
	eval(callHook('endAdminIncludePluginFile'));
}
?>
