<!doctype html>  
<!--[if IE 6 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="<?php echo $coreConf['siteLang']; ?>"><!--<![endif]-->
<head>
	<meta charset="utf-8">	
	<title>99ko - <?php echo lang('Backend'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" media="all" />
	<link rel="stylesheet" href="css/common.css" media="all" />	
	<link rel="stylesheet" href="css/defaut.css" />
	<link rel="stylesheet" href="js/tinybox2/style.css" />
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
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
			<li><a class="<?php if($v['isActive']){ ?>current<?php } ?>" href="<?php echo $v['url']; ?>"><?php echo lang($v['label'], $v['name']); ?></a></li>
			<?php } ?>
		   </ol>
	       &nbsp;<a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $token; ?>"><?php echo lang('Logout'); ?></a>
	       <a target="_blank" class="btn" id="showSite" href="../"><?php echo lang('Back to website'); ?></a>
		</nav>
		
		<div id="copyright">
		   <?php echo lang('Just using'); ?> <a target="_blank" href="http://99ko.tuxfamily.org/"><b>99ko</b></a> <?php echo $version; ?>
		</div>
	</header>

<section id="content" class="<?php echo $pluginName; ?>-admin">
	<h2><?php echo $pageTitle; ?></h2>
	<?php if($pluginConfigTemplate){ ?>
		<a href="javascript:" class="btn" id="pluginConfigButton"><?php echo lang('Plugin configuration'); ?></a>
	<?php } ?>
	<hr class="notop">
	<?php if($pluginConfigTemplate){ ?>
		<div id="pluginConfig">
			<?php include_once($pluginConfigTemplate); ?>
			<hr class="notop">
		</div>
	<?php } ?>