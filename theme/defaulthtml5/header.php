<!DOCTYPE html>
<html lang="<?php showSiteLang(); ?>">
    <head>
        <meta charset="utf-8" />
	<title><?php showTitleTag(); ?></title>
        <meta name="description" content="<?php showMetaDescriptionTag(); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<base href="<?php showSiteUrl(); ?>/" />
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	<?php eval(callHook('endFrontHead')); ?>
    </head>
    <body>
        <div id="container">
            <header id="header">
                <p id="siteName"><a title="<?php showSiteDescription(); ?>" href="<?php showSiteUrl(); ?>"><?php showSiteName(); ?></a></p>
            </header>
            <section id="content" class="<?php showPluginId(); ?>">
		<header>
			<?php showBreadcrumb(); ?>
			<h1><?php showMainTitle(); ?></h1>
		</header>