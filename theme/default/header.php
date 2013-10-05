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
    <ul>
	    <?php foreach($itemsLevel1 as $item){ ?>
	    <?php if($item->get('idParent') == 0){ ?><li><a href="<?php echo $item->get('url'); ?>"><?php echo $item->get('name'); ?></a></li><?php } ?>
	    <ul>
		    <?php foreach($itemsLevel2[$item->get('id')] as $item2){ ?>
		    <li><a href="<?php echo $item2->get('url'); ?>"><?php echo $item2->get('name'); ?></a></li>
		    <?php } ?>
	    </ul>
	    <?php } ?>
    </ul>