<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
	    <title><?php showTitleTag(); ?></title>
	    <base href="<?php showSiteUrl(); ?>/" />
        <meta name="description" content="<?php showMetaDescriptionTag(); ?>" />
        <!--[if lt IE 9]>
        <script src="theme/<?php echo $coreConf['theme']; ?>/html5.js"></script>
        <![endif]-->
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	<?php eval(callHook('endFrontHead')); ?>
    </head>
	<body>
	
		<header>
		  <nav>
			<ul>
			    <li class="logo"><a title="<?php showSiteDescription(); ?>" href="<?php showSiteUrl(); ?>"><?php showSiteName(); ?></a></li>
			    <?php showMainNavigation(); ?>
			</ul>
		  </nav>			
		</header>
		
		<section>
			<div class="content">
				<div id="page">
				    <?php showBreadcrumb(); ?>
					<h1><?php showMainTitle(); ?></h1>		