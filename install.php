<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com) / Frédéric Kaplon
# Copyright (c) 2010-2011 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

session_start();
define('ROOT', './');
include_once(ROOT.'common/core.lib.php');
if (utilPhpVersion() < '5.1.2') {
	die("Vous devez disposer d'un serveur équipé de PHP 5.1.2 ou plus !");
}
utilSetMagicQuotesOff();
$error = false;
$resetPassword = false;
define('DEFAULT_PLUGIN', 'page');
$pluginsManager = new pluginsManager();
$hooks = array();
if (isset($_GET['updateto'])) {
	$coreConf = getCoreConf();
	switch ($_GET['updateto']) {
		case '1.0.9':
			$append['defaultPlugin'] = 'page';
			if(!saveConfig($coreConf, $append)) $error = true;
			break;
		case '1.2.4':
			if (is_dir(ROOT.'data/') && file_exists(ROOT.'data/config.txt')) {
				if(!file_exists(ROOT.'data/.htaccess')){
					if (!@file_put_contents(ROOT.'data/.htaccess', "deny from all", 0666)) {
						$error = true;
					}
				}
				if(!file_exists(ROOT.'data/upload/.htaccess')){
					if (!@file_put_contents(ROOT.'data/upload/.htaccess', "allow from all", 0666)) {
						$error = true;
					}
				}
				$key = uniqid(true);
				if(!file_exists(ROOT.'data/key.php') && !@file_put_contents(ROOT.'data/key.php', "<?php define('KEY', '$key'); ?>", 0666)){
					$error = true;
				}
				include(ROOT.'data/key.php');
				$mdp = rand(1000, 9999);
				$config = utilReadJsonFile(ROOT.'data/config.txt');
				$config['adminPwd'] = encrypt($mdp);
				$config['urlRewriting'] = '0';
				utilWriteJsonFile(ROOT.'data/config.txt', $config);
				
				$resetPassword = true;
			} else {
				$error = true;
				header('location:install.php');
				die();
			}
			break;
		case '1.2.6':
			$append['useCache'] = '0';
			$append['siteLang'] = 'fr';
			if(!saveConfig($coreConf, $append)) $error = true;
			if (!is_dir(ROOT.'data/cache/') && (!@mkdir(ROOT.'data/cache/') || !@chmod(ROOT.'data/cache/', 0777))) {
				$error = true;
			}
			break;
	}
	if ($error) {
		$data['msg'] = "Problème lors de la mise à jour";
		$data['msgType'] = "error";
	} else {
		$data['msg'] = "Mise à jour effectuée";
		$data['msgType'] = "success";
	}
	if ($resetPassword) {
		$data['msg'] .= "\nLe mot de passe admin a été réinitialisé : " . $mdp;
	}
} else {
	if (file_exists(ROOT.'data/config.txt')) {
		die();
	}
	@chmod(ROOT.'.htaccess', 0666);
	$mdp = rand(1000, 9999); //Mot de Passe aléatoire
	if(!file_exists(ROOT.'.htaccess')){
		if (!@file_put_contents(ROOT.'.htaccess', "Options -Indexes", 0666)) {
			$error = true;
		}
	}
	if (!is_dir(ROOT.'data/') && (!@mkdir(ROOT.'data/') || !@chmod(ROOT.'data/', 0777))) {
		$error = true;
	}
	if(!file_exists(ROOT.'data/.htaccess')){
		if (!@file_put_contents(ROOT.'data/.htaccess', "deny from all", 0666)) {
			$error = true;
		}
	}
	if (!is_dir(ROOT.'data/plugin/') && (!@mkdir(ROOT.'data/plugin/') || !@chmod(ROOT.'data/plugin/', 0777))) {
		$error = true;
	}
	if (!is_dir(ROOT.'data/upload/') && (!@mkdir(ROOT.'data/upload/') || !@chmod(ROOT.'data/upload/', 0777))) {
		$error = true;
	}
	if (!is_dir(ROOT.'data/cache/') && (!@mkdir(ROOT.'data/cache/') || !@chmod(ROOT.'data/cache/', 0777))) {
		$error = true;
	}
	if(!file_exists(ROOT.'data/upload/.htaccess')){
		if (!@file_put_contents(ROOT.'data/upload/.htaccess', "allow from all", 0666)) {
			$error = true;
		}
	}
	$key = uniqid(true);
	if(!file_exists(ROOT.'data/key.php') && !@file_put_contents(ROOT.'data/key.php', "<?php define('KEY', '$key'); ?>", 0666)){
		$error = true;
	}
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
		'useCache' => '0',
		'siteLang' => 'fr',
	);
	if(!@file_put_contents(ROOT.'data/config.txt', json_encode($config))
		||	!@chmod('data/config.txt', 0666)) {
		$error = true;
	}
	foreach ($pluginsManager->getPlugins() as $plugin) {
		if ($plugin->getLibFile()) {
			include_once($plugin->getLibFile());
			if (!$plugin->isInstalled()) {
				$pluginsManager->installPlugin($plugin->getName());
			}
		}
		/*foreach ($plugin->getHooks() as $hookName=>$function) {
			$hooks[$hookName][] = $function;
		}*/
	}
	foreach ($pluginsManager->getPlugins() as $plugin) {
		foreach ($plugin->getHooks() as $hookName=>$function) {
			$hooks[$hookName][] = $function;
		}
	}
	if ($error) {
		$data['msg'] = "Problème lors de l'installation";
		$data['msgType'] = "error";
	} else {
		$data['msg'] = "99ko est installé\nLe mot de passe admin par défaut est : $mdp\nModifiez-le dès votre première connexion\nSupprimez également le fichier install.php";
		$data['msgType'] = "success";
		eval(callHook('installSuccess'));

		$_SESSION['msg_install'] = $data['msg'];
		header('location:admin/index.php');
	}
}
?>
<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="fr"><!--<![endif]-->
<head>
       <meta charset="utf-8">  
       <title>99ko - Installation</title>
	<!-- css -->
	<link rel="stylesheet" href="admin/css/style.css" media="all">
	<link rel="stylesheet" href="admin/css/common.css" media="all">
	<!-- Personnalisation des liens, sidebar, contenu -->	
	<link rel="stylesheet" href="admin/css/color_defaut.css" />
</head>
<body>
       <div id="content">      
<section id="home">
       <?php showMsg($data['msg'], $data['msgType']); ?>
</section>
    </div>
</body>
</html>