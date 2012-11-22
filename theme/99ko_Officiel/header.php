<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php showTitleTag(); ?></title>
<meta name="description" content="<?php showMetaDescriptionTag(); ?>" />
<base href="<?php showSiteUrl(); ?>/" />

<link rel="stylesheet" media="screen" href="theme/<?php echo $coreConf['theme']; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="theme/<?php echo $coreConf['theme']; ?>/css/vtip.css" />
<link rel="stylesheet" type="text/css" href="theme/<?php echo $coreConf['theme']; ?>/css/actus.css" />
<?php //showLinkTags(); ?>
<?php //showScriptTags(); ?>
<?php eval(callHook('endFrontHead')); ?>
</head>
<body>
<div id="navigation-block">
    <ul id="sliding-navigation">
        <li class="sliding-element"><h3>Navigation</h3></li>
        <?php showMainNavigation('<li class="sliding-element"><a class="scroll" href="[target]">[label]</a></li>'); ?>  
    </ul>
</div><!--/Navigation Block-->

<div id="Taille-Fixe">

	<div id="logo">
		<h1><a href="<?php showSiteUrl(); ?>"><?php showSiteName(); ?></a></h1>
		<!-- <?php showSiteDescription(); ?> -->
	</div>