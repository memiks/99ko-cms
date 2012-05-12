<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">	
	<title>99ko - Cms</title>
	<!-- meta -->
	<meta name="description" content="Cms hyper léger!">
	<meta name="author" content="Jonathan C.">
	<meta name="generator" content="99Ko">
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
	<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
	<![endif]-->	
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
		header > nav a:hover{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		header > nav a.current{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		#copyright{display:block !important;visibility:visible !important;}
	</style>
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	
	<?php eval(callHook('endAdminHead')); ?>	

</head>

<body>

	<header role="banner">
		<a href="./index.php" id="logo"></a>
		
		<nav role="navigation">
		   <ol>
			<li>
				<a <?php if (!isset($_GET['s']) && !isset($_GET['p']) || isset($_GET['s']) && $_GET['s'] == 'home') echo 'class="current"'; ?> href="index.php">
					Accueil
				</a>
			</li>
			<li><a <?php if (isset($_GET['s']) && $_GET['s'] == 'config') echo 'class="current"'; ?> href="index.php?s=config">Configuration</a></li>
			<li><a <?php if (isset($_GET['s']) && $_GET['s'] == 'plugins') echo 'class="current"'; ?> href="index.php?s=plugins">Plugins</a></li>
			<?php foreach ($data['plugins'] as $plug) {
							if ($plug['target'] && $plug['activate']) { ?>
			<li>
				<a <?php if (isset($_GET['p']) && $_GET['p'] == $plug['id']) echo 'class="current"'; ?> href="index.php?p=<?php echo $plug['id']; ?>">
					<?php echo $plug['name']; ?>
				</a>
			</li>
			<?php 	}
						} ?>						
		   </ol>
	       &nbsp;<a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $data['token']; ?>">Se déconnecter</a>
	       <a class="btn" id="showSite" href="../">Voir le site</a>		   		
		</nav>
		
		<div id="copyright">
		   Propulsé par <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <span class="version"><?php echo $data['99koVersion']; ?></span>.
		</div>
	</header>
	<div id="content">

<?php if (isset($_GET['p'])) { ?>
<section id="<?php echo $plug['id']; ?>">
	<h3><?php echo $data['mainTabTitle']; ?></h3>
	<?php if ($runPlugin->getConfigTemplate()) { ?>
		<img id="pluginConfigButton" src="images/wrench_orange.png" />
	<?php } ?>
	<hr class="notop">
	<?php if ($runPlugin->getConfigTemplate()) { ?>
		<div id="pluginConfig">
			<?php include_once($runPlugin->getConfigTemplate()); ?>
			<hr class="notop">
		</div>
	<?php } ?>
<?php } ?>
