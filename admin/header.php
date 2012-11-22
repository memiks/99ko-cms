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
	<!-- Personnalisation des liens, sidebar, contenus -->	
	<link rel="stylesheet" href="css/color_defaut.css" />
	<link rel="stylesheet" href="js/tinybox2/style.css" />
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../common/jquery.js"></script>	
	<script type="text/javascript" src="js/plugin-config.js"></script>	
	<script type="text/javascript" src="js/tinybox2/packed.js"></script>

	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	
	<?php eval(callHook('endAdminHead')); ?>	

</head>

<body>

	<header role="banner">
		<a href="./index.php" id="logo" title="Accueil du panel">99Ko</a>
		
		<nav role="navigation">
		   <ol>
			<li>
				<a <?php if (!isset($_GET['s']) && !isset($_GET['p']) || isset($_GET['s']) && $_GET['s'] == 'home') echo 'class="current"'; ?> href="index.php">
					Accueil
				</a>
			</li>
			<!--<li><a <?php if (isset($_GET['s']) && $_GET['s'] == 'config') echo 'class="current"'; ?> href="index.php?s=config">Configuration</a></li>
			<li><a <?php if (isset($_GET['s']) && $_GET['s'] == 'plugins') echo 'class="current"'; ?> href="index.php?s=plugins">Plugins</a></li>-->
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
	       <a target="_blank" class="btn" id="showSite" href="../">Voir le site</a>		   		
		</nav>
		
		<div id="copyright">
		   Just using <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <span class="version"><?php echo $data['99koVersion']; ?></span>.
		</div>
	</header>

<?php if (isset($_GET['p'])) { ?>
<section class="<?php echo $runPlugin->getName(); ?>-admin">
	<h3><?php echo $data['mainTabTitle']; ?></h3>
	<?php if ($runPlugin->getConfigTemplate()) { ?>
		<!--<img id="pluginConfigButton" src="images/wrench_orange.png" />-->
		<a href="javascript:" class="btn" id="pluginConfigButton">Configuration du plugin</a>
	<?php } ?>
	<hr />
	<?php if ($runPlugin->getConfigTemplate()) { ?>
		<div id="pluginConfig">
			<?php include_once($runPlugin->getConfigTemplate()); ?>
			<hr class="notop">
		</div>
	<?php } ?>
<?php } ?>
r class="notop">
		</div>
	<?php } ?>
<?php } ?>
