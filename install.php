<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2011 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

define('ROOT', './');

include_once(ROOT.'common/core.lib.php');

// On détecte la langue du navigateur est charge la langue du core
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($language){
    case "fr":
        // Langue Française
        $lang = utilReadJsonFile(ROOT.'common/lang/fr.json');
        break;
    case "en":
        // Langue Anglaise
        $lang = utilReadJsonFile(ROOT.'common/lang/en.json');
        break;        
    default:
        // Langue par défaut si pas listé
        $lang = utilReadJsonFile(ROOT.'common/lang/fr.json');
        break;
}

if (utilPhpVersion() < '5.1.2') {
	die($lang['PhpVersion']);
}

utilSetMagicQuotesOff();
$error = false;
$resetPassword = false;
define('DEFAULT_PLUGIN', 'page');

$pluginsManager = new pluginsManager();

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
				$mdp = rand(100000, 999999);
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
	}
	
	if ($error) {
		$data['msg'] = $lang['UpdateFail'];
		$data['msgType'] = "error";
	} else {
		$data['msg'] = $lang['UpdateSuccess'];
		$data['msgType'] = "success";
	}
	
	if ($resetPassword) {
		$data['msg'] .= $lang['resetPassword']. $mdp;
	}
} else {
	if (file_exists(ROOT.'data/config.txt')) {
		die();
	}
	
	//@unlink(ROOT.'.htaccess');
	@chmod(ROOT.'.htaccess', 0666);
	$mdp = rand(100000, 999999); //Mot de Passe aléatoire
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
		//'adminPwd' => sha1($mdp),
		'adminPwd' => encrypt($mdp), 
		'theme' => 'defaulthtml5',
		'adminEmail'=> 'you@domain.com',
		'siteUrl' => getSiteUrl(),
		'siteLang' => 'fr',
		'defaultPlugin' => 'page',
		'urlRewriting' => '0',
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
	}
	
	if ($error) {
		$data['msg'] = $lang['InstallFail'];
		$data['msgType'] = "error";
	} else {
		$data['msg'] = $lang['InstallSuccess']. '<b>' .$mdp. '</b><br />'.$lang['ChangePwd'].'<br /><br /><a class="btn" href="index.php">'.$lang['BackToWebsite'].'</a><a class="btn" href="admin/">'.$lang['Backend'].'</a>';
		$data['msgType'] = "success";
		// On supprime le fichier d'installation et on redirige sur la page d'accueil.
		//unlink('install.php');
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
       <title>99ko - <?php echo $lang['Install']; ?></title>
       <!-- css -->
       <link rel="stylesheet" href="admin/css/install.css" media="all">
</head>
<body>	   
       <div id="container">      
          <section id="home">
             <?php showMsg($data['msg'], $data['msgType']); ?>
          </section>
       </div>
</body>
</html>
