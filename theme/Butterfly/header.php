<?php $template = 'theme/'.$coreConf['theme']; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="utf-8" />
    <title><?php showTitleTag(); ?></title>
    <meta name="description" content="<?php showMetaDescriptionTag(); ?>" />
    <base href="<?php showSiteUrl(); ?>/" />
    <!--[if lt IE 9]>
      <script src="theme/<?php echo $coreConf['theme']; ?>/js/html5.js"></script>
    <![endif]-->
	<?php showLinkTags(); ?>
	<link href='http://fonts.googleapis.com/css?family=Montserrat|Dancing+Script:700' rel='stylesheet' type='text/css'>
	<script src="<?php echo $template; ?>/js/jquery.js"></script> 
	<script src="<?php echo $template; ?>/js/twitter.js"></script> 
	<script src="<?php echo $template; ?>/js/modernizr.custom.79639.js"></script> 
	<!--[if lte IE 10]><link rel="stylesheet" type="text/css" href="theme/<?php echo $template; ?>/css/fallback.css" /><![endif]-->
	<!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
	<?php showScriptTags(); ?>
	<?php eval(callHook('endFrontHead')); ?>
    </head>
    <body>
        <div class="container">
		
			<!-- top bar -->
            <div class="ribbon-top">
                <span class="right">
                    <a rel="nofollow" href="admin/">
                        Administration
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ top bar -->
<div id="wrap">

<header role="banner">
    <h1><?php showSiteName(); ?> <span><?php showSiteDescription(); ?></span></h1>
</header>   

    <nav role="navigation">
    <ul class="cf">
        <?php showMainNavigation('<li><a href="[target]">[label]</a></li>'); ?>
        <li class="button"><a class="dropdown" href="#">Menu Déroulant</a>
            <ul>
                <li><a href="#">Sous-menu 1</a></li>
                <li><a href="#">Sous-menu 2</a></li>
                <li><a href="#">Sous-menu 3</a></li>
            </ul>
        </li>
    </ul>    
    </nav>
    
    <input type="checkbox" id="width_sidebar" role="button">
    <label for="width_sidebar"><span>Masquer la sidebar</span><span>&raquo;</span><span>&laquo;</span></label>    

    <div role="main" class="<?php showPluginId(); ?>">    
        <article class="post">
        <?php showBreadcrumb(); ?>
            <h1 itemprop="headline"><?php showMainTitle(); ?></h1>   