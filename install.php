<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2013 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com) / Frédéric Kaplon
# Copyright (c) 2010-2011 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

session_start();
define('ROOT', './');
include_once(ROOT.'common/core.lib.php');
if(utilPhpVersion() < '5.1.2') die(lang('You must have a server equipped with PHP 5.1.2 or more !'));
utilSetMagicQuotesOff();
$error = false;
define('DEFAULT_PLUGIN', 'page');
$pluginsManager = new pluginsManager();
$hooks = array();
if(file_exists(ROOT.'data/config.txt')) die();
@chmod(ROOT.'.htaccess', 0666);
$mdp = rand(1000, 9999);
if(!file_exists(ROOT.'.htaccess')){
	if(!@file_put_contents(ROOT.'.htaccess', "Options -Indexes", 0666)) $error = true;
}
if(!is_dir(ROOT.'data/') && (!@mkdir(ROOT.'data/') || !@chmod(ROOT.'data/', 0777))) $error = true;
if(!file_exists(ROOT.'data/.htaccess')){
	if(!@file_put_contents(ROOT.'data/.htaccess', "deny from all", 0666)) $error = true;
}
if(!is_dir(ROOT.'data/plugin/') && (!@mkdir(ROOT.'data/plugin/') || !@chmod(ROOT.'data/plugin/', 0777))) $error = true;
if(!is_dir(ROOT.'data/upload/') && (!@mkdir(ROOT.'data/upload/') || !@chmod(ROOT.'data/upload/', 0777))) $error = true;
if(!file_exists(ROOT.'data/upload/.htaccess')){
	if(!@file_put_contents(ROOT.'data/upload/.htaccess', "allow from all", 0666)) $error = true;
}
$key = uniqid(true);
if(!file_exists(ROOT.'data/key.php') && !@file_put_contents(ROOT.'data/key.php', "<?php define('KEY', '$key'); ?>", 0666)) $error = true;
include(ROOT.'data/key.php');
$config = array(
	'siteName' => "Démo",
	'siteDescription' => "Un site propulsé par 99Ko",
	'adminPwd' => encrypt($mdp), 
	'theme' => 'defaulthtml5',
	'adminEmail'=> 'you@domain.com',
	'siteUrl' => getSiteUrl(),
	'defaultPlugin' => 'page',
	'urlRewriting' => '0',
	'siteLang' => 'fr',
);
if(!@file_put_contents(ROOT.'data/config.txt', json_encode($config)) ||	!@chmod('data/config.txt', 0666)) $error = true;
foreach($pluginsManager->getPlugins() as $plugin){
	if($plugin->getLibFile()){
		include_once($plugin->getLibFile());
		if(!$plugin->isInstalled()) $pluginsManager->installPlugin($plugin->getName());
	}
}
foreach($pluginsManager->getPlugins() as $plugin){
	foreach($plugin->getHooks() as $hookName=>$function) $hooks[$hookName][] = $function;
}
if($error){
	$data['msg'] = lang('Problem when installing');
	$data['msgType'] = "error";
}
else{
	$data['msg'] = lang('99ko is installed') . '<br />' . lang('The default admin password is : ') . '<span class="pwd">'.$mdp.'</span><br />'.
	lang('The default admin email is : ') . '<span class="pwd">you@domain.com</span><br />'.
	lang('Change it at your first connection') . '<br />' . lang('Also, delete the install.php file');
	$data['msgType'] = "success";
	eval(callHook('installSuccess'));
	$_SESSION['msg_install'] = $data['msg'];
	header('location:admin/index.php');
	die();
}
?>