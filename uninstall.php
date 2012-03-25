<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2010-2011 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

define('ROOT', './');

include_once(ROOT.'common/core.lib.php');

if (utilPhpVersion() < '5.1.2') {
	die("Vous devez disposer d'un serveur équipé de PHP 5.1.2 ou plus !");
}

setMagicQuotesOff();
$error = false;
define('DEFAULT_PLUGIN', 'page');

if (file_exists(ROOT.'data/')) {
	$dirs = array();
	$files = array();
	$scan = array();
	
	$dirs[] = array(ROOT.'data/');
	$cursor = 0;
	
	while ($cursor < count($dirs)) {
		foreach ($dirs[$cursor] as $dir) {
			$scan = array(
				'dir' => array(),
				'file' => array()
			);
			
			foreach (scandir($dir) as $file) {
				if ($file[0] != '.') {
					if (is_file($dir.$file)) {
						$scan['file'][] = $dir.$file;
					} else if (is_dir($dir.$file)) {
						$scan['dir'][] = $dir.$file.'/';
					}
				}
			}
			
			$dirs[] = $scan['dir'];
			$files[] = $scan['file'];
		}
		
		$cursor += 1;
	}
	
	$files = array_reverse($files);
	$dirs = array_reverse($dirs);
	
	foreach ($files as $list) {
		foreach ($list as $file) {
			if (!@unlink($file)) {
				$error = true;
			}
		}
	}
	foreach ($dirs as $list) {
		foreach ($list as $dir) {
			if (!@rmdir($dir)) {
				$error = true;
			}
		}
	}
}

if ($error) {
	$data['msg'] = "Problème lors de la désinstallation";
	$data['msgType'] = "error";
} else {
	$data['msg'] = "99ko est désinstallé";
	$data['msgType'] = "success";
	copy('install.back.php', 'install.php');
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
       <title>99ko - Désinstallation</title>
       <!-- meta -->
       <meta name="description" content="Cms hyper léger!">
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
               <div id="copyright">
                  Propulsé par <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> <span class="version"><?php echo $data['99koVersion']; ?></span>.
               </div>
       </aside>
       
       <div id="content">      
<section id="home">
       <h1>Désinstallation</h1>
       <h2><a class="btn" id="logout" href="install.php">Ré-installer</a></h2>
       <hr>
       <?php showMsg($data['msg'], $data['msgType']); ?>
</section>
    </div>
</body>
</html>
