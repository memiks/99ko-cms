<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">	
	<title>99ko - Administration</title>
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
	<link rel="stylesheet" href="js/tinybox2/style.css" />
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../common/jquery.js"></script>	
	<script type="text/javascript" src="js/plugin-config.js"></script>	
	<script type="text/javascript" src="js/tinybox2/packed.js"></script>
	<!-- Personnalisation des liens, sidebar, contenus -->
	<style>
		html{background-color:#FFFFFF;color:#383838;}
		::-moz-selection{background:#DBE6EC;color:#111111;}
		::selection{background:#DBE6EC;color:#111111;}
		header #logo{background-image:url(images/logo.png);}
		a{color:#A26F6F;}
		hr{border-top:1px solid #D7E1E6;border-bottom:1px solid #EFFAFF;}
		header, header > nav a{background-color:#77A2A8;color:#222222;}
		header > nav a{-webkit-text-shadow:1px 1px 0px #DBE5E8;-moz-text-shadow:1px 1px 0px #DBE5E8;text-shadow:1px 1px 0px #DBE5E8;}
		header > nav a:hover{background:#DBE6EC;color:#111111}
		header > nav a.current{background:#DBE6EC;color:#111111}
		#copyright{display:block !important;visibility:visible !important;}
		#pluginConfigButton{border-color:#D7E1E6}
	</style>
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	
	<?php eval(callHook('endAdminHead')); ?>	

</head>

<body>

	<header role="banner">
		<a href="./" id="logo"></a>
		
		<nav role="navigation">
		   <ol>
			<?php foreach($navigation as $k=>$v){ ?>
			<li><a class="<?php if($v['isActive']){ ?>current<?php } ?>" href="<?php echo $v['url']; ?>"><?php echo $v['label']; ?></a></li>
			<?php } ?>
		   </ol>
	       &nbsp;<a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $token; ?>">Se déconnecter</a>
	       <a target="_blank" class="btn" id="showSite" href="../">Voir le site</a>		   		
		</nav>
		
		<div id="copyright">
		   Just using <a target="_blank" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <span class="version"><?php echo $version; ?></span>.
		</div>
	</header>


<section id="content" class="<?php echo $pluginName; ?>-admin">
	<h3><?php echo $pageTitle; ?></h3>
	<?php if($pluginConfigTemplate){ ?>
		<a href="javascript:" class="btn" id="pluginConfigButton">Configuration du plugin</a>
	<?php } ?>
	<hr class="notop">
	<?php if($pluginConfigTemplate){ ?>
		<div id="pluginConfig">
			<?php include_once($pluginConfigTemplate); ?>
			<hr class="notop">
		</div>
	<?php } ?>