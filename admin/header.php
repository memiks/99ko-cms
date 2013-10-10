<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<html lang="<?php showSiteLang(); ?>">
<head>
	<meta charset="utf-8">	
	<title>99ko - Administration</title>	
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	<link rel="stylesheet" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
	<link rel="stylesheet" href="css/color_defaut.css" />	
	<script type="text/javascript" src="js/scripts.js"></script>
	<?php eval(callHook('endAdminHead')); ?>	
</head>
<body>
	<header role="banner">
		<a href="./" id="logo"></a>
		<nav role="navigation">
		   <ol>
			<?php foreach($navigation as $k=>$v){ ?>
			<li><a class="<?php if($v['isActive']){ ?>current<?php } ?>" href="<?php echo $v['url']; ?>"><?php echo lang($v['label']); ?></a></li>
			<?php } ?>
			<li><a href="index.php?action=logout&token=<?php echo $token; ?>"><?php echo lang('Logout'); ?></a></li>
			<li><a href="../"><?php echo lang('Back to website'); ?></a></li>
		   </ol>
	       <!--&nbsp;<a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $token; ?>"><?php echo lang('Logout'); ?></a>
	       <a target="_blank" class="btn" id="showSite" href="../"><?php echo lang('Back to website'); ?></a>-->		   		
		</nav>
		<div id="copyright">
		   <?php echo lang('Just using'); ?> <a target="_blank" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <span class="version"><?php echo $version; ?></span>.
		</div>
	</header>
	<section id="content" class="<?php echo $pluginName; ?>-admin">
		<h2><?php echo lang($pageTitle); ?></h2>
		<hr class="notop">
		<?php if($pluginConfigTemplate){ ?>
			<div id="pluginConfig">
				<?php include_once($pluginConfigTemplate); ?>
				<hr class="notop">
			</div>
		<?php } ?>
		<?php if($tabs){ ?>
		<div id="tabs">
		<ul class="tabs">
			<?php foreach($tabs as $k=>$v){ ?>
			<li><a href="<?php echo $v['url']; ?>"><?php echo lang($v['label']); ?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>