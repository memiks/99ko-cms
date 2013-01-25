<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="<?php echo $coreConf['siteLang']; ?>"><!--<![endif]-->
<head>
	<meta charset="utf-8">	
	<title>99ko - <?php echo $lang['Backend']; ?></title>
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
	<!-- Personnalisation des liens, sidebar, contenu -->	
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
		<a href="./" class="logo"></a>
		
		<nav role="navigation">
		   <ol>
			<?php foreach($navigation as $k=>$v){ ?>
			<li><a class="<?php if($v['isActive']){ ?>current<?php } ?>" href="<?php echo $v['url']; ?>"><?php echo $v['label']; ?></a></li>
			<?php } ?>
		   </ol>
	       &nbsp;<a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $token; ?>"><?php echo $lang['Logout']; ?></a>
	       <a target="_blank" class="btn" id="showSite" href="../"><?php echo $lang['BackToWebsite']; ?></a>		   		
		</nav>
		
		<div id="copyright">
		   <?php echo $lang['JustUsing']; ?> <a target="_blank" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <?php echo $version; ?>
		</div>
	</header>


<section id="content" class="<?php echo $pluginName; ?>-admin">
	<h2><?php echo $pageTitle; ?></h2>
	<?php if($pluginConfigTemplate){ ?>
		<a href="javascript:" class="btn" id="pluginConfigButton"><?php echo $lang['PluginConfiguration']; ?></a>
	<?php } ?>
	<hr class="notop">
	<?php if($pluginConfigTemplate){ ?>
		<div id="pluginConfig">
			<?php include_once($pluginConfigTemplate); ?>
			<hr class="notop">
		</div>
	<?php } ?>