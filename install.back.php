<?php
define('ROOT', './');
include_once(ROOT.'common/core.lib.php');
if(utilPhpVersion() < '5.1.2') die("Vous devez disposer d'un serveur équipé de PHP 5.1.2 ou plus !");
setMagicQuotesOff();
$error = false;
define('DEFAULT_PLUGIN', 'page');
$pluginsManager = new pluginsManager();
if(isset($_GET['updateto'])){
	$coreConf = getCoreConf();
	switch($_GET['updateto']){
		case '1.0.9':
			$append['defaultPlugin'] = 'page';
			if(!saveConfig($coreConf, $append)) $error = true;
			break;
	}
	if($error){
		$data['msg'] = "Problème lors de la mise à jour";
		$data['msgType'] = "error";
	}
	else{
		$data['msg'] = "Mise à jour effectuée";
		$data['msgType'] = "success";
	}
}
else{
	if(file_exists(ROOT.'data/config.txt')){
		die();
	}
	@unlink(ROOT.'.htaccess');
	if(!@file_put_contents(ROOT.'.htaccess', "Options -Indexes", 0666)) $error = true;
	if(!@mkdir('data/', 0777)) $error = true;
	if(!@chmod('data/', 0777)) $error = true;
	if(!@mkdir('data/plugin/', 0777)) $error = true;
	if(!@chmod('data/plugin/', 0777)) $error = true;
	if(!@mkdir('data/upload/', 0777)) $error = true;
	if(!@chmod('data/upload/', 0777)) $error = true;
	$mdp = rand(100000, 999999); //Mot de Passe aléatoire
	$config = array(
		'siteName' => "Démo",
		'siteDescription' => "Un site propulsé par 99Ko",
		'adminPwd' => sha1($mdp),
		'theme' => 'defaulthtml5',
		'adminEmail'=> 'you@domain.com',
		'siteUrl' => getSiteUrl(),
		'defaultPlugin' => 'page',
	);
	if(!@file_put_contents(ROOT.'data/config.txt', json_encode($config), 0666)) $error = true;
	if(!@chmod('data/config.txt', 0666)) $error = true;
	foreach($pluginsManager->getPlugins() as $plugin){
		if($plugin->getLibFile()){
			include_once($plugin->getLibFile());
			if(!$plugin->isInstalled()) $pluginsManager->installPlugin($plugin->getName());
		}
	}
	if($error){
		$data['msg'] = "Problème lors de l'installation";
		$data['msgType'] = "error";
	}
	else{
		$data['msg'] = "99ko est installé\nLe mot de passe admin par défaut est : $mdp\nModifiez-le dès votre première connexion\nSupprimez également le fichier install.php";
		$data['msgType'] = "success";
        // On supprime le fichier d'installation et on redirige sur la page d'accueil.
        unlink('install.php');		
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
	<!-- meta -->
	<meta name="description" content="Cms hyper légé!">
	<meta name="author" content="Jonathan C.">
	<meta name="generator" content="99Ko">
	<!-- css -->
	<link rel="stylesheet" href="admin/css/style.css" media="all">
	<link rel="stylesheet" href="admin/css/common.css" media="all">
	<!-- Personnalisation des liens, sidebar, contenus -->
	<style>
		html{background-color:#FFFFFF;color:#383838;}
		::-moz-selection{background:#DBE6EC;color:#111111;}
		::selection{background:#DBE6EC;color:#111111;}
		aside #logo{background-image:url(admin/images/logo.png);}
		a{color:#A26F6F;}
		hr{border-top:1px solid #D7E1E6;border-bottom:1px solid #EFFAFF;}
		aside, aside ol a{background-color:#77A2A8;color:#222222;}
		aside ol a{-webkit-text-shadow:1px 1px 0px #DBE5E8;-moz-text-shadow:1px 1px 0px #DBE5E8;text-shadow:1px 1px 0px #DBE5E8;}
		aside ol{border-top:1px solid #B4BCBF;}
		aside ol a{border-top:1px solid #DBE5E8;border-bottom:1px solid #B4BCBF;color:#222222;}
		aside ol a:hover{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		aside ol a.current{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		#copyright{display:block !important;visibility:visible !important;}
	</style>
</head>
<body>

	<aside>
		<a href="#home" id="logo"></a>		
		<ol id="nav">
			<li><a class="current" href="./#home">Installation</a></li>			
		</ol>
		<div id="copyright">
		   Propulsé par <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> <span class="version"><?php echo $data['99koVersion']; ?></span>.
		</div>
	</aside>
	
	<div id="content">	
<section id="home">
	<h1>Installation</h1>
	<h2><a class="btn" id="logout" href="./admin/">Administration</a>
	<a class="btn" id="showSite" href="./">Voir le site</a></h2>
	<hr>
	<?php showMsg($data['msg'], $data['msgType']); ?>
</section>
    </div>

</body>
</html>