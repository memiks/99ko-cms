<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
	<title><?php echo $metaTitle; ?></title>
        <meta name="description" content="<?php echo $metaDescription; ?>" />
	<base href="<?php echo $url; ?>" />
        <?php eval(callHook('themeHead')); ?>
    </head>
    <body>
    <?php echo $menuHtml; ?>