<?php
if(!defined('ROOT')) die();

###### declaration
define('CAPTCHA_PLUGINPATH', ROOT.'plugin/captcha/');

###### library
function captchaShow() {
	include(CAPTCHA_PLUGINPATH.'template/captcha.php');
}

function captchaCheck() {
	$check = isset($_SESSION['captcha']) && isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha'];
	return (pluginsManager::getPluginConfVal('captcha', 'method') == 'none') || $check;
}

function showCaptcha() {
	include(CAPTCHA_PLUGINPATH.'template/captcha.php');
}

function checkCaptcha() {
	$check = isset($_SESSION['captcha']) && isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha'];
	return (pluginsManager::getPluginConfVal('captcha', 'method') == 'none') || $check;
}

function captchaClearSession() {
	unset($_SESSION['captcha']);
}

?>
