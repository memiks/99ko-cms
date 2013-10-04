<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
	<title>TITLE EN / FR</title>
        <meta name="description" content="" />
	<base href="" />
        <?php eval(callHook('adminHead')); ?>
    </head>
    <body>
	
	<ul>
	    <li><a href="admin.php"><?php echo lang('Home'); ?> </a></li>
	    <li><a href="admin.php?p=configuration"><?php echo lang('Configuration'); ?> </a></li>
		<li><a href="admin.php?p=menu"><?php echo lang('Menu'); ?> </a></li>
	    <li><a href="admin.php?p=articles"><?php echo lang('Articles'); ?> </a></li>
	    <?php foreach($plugins as $plugin) if($plugin->adminPage()){ ?>
	    <li><a href="admin.php?p=plugin&id=<?php echo $plugin->get('id'); ?>"><?php echo $plugin->get('name'); ?> </a></li>
	    <?php } ?>
	</ul>