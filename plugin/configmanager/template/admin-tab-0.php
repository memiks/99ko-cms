<?php if(!defined('ROOT')) die(); ?>
<form id="configForm" method="post" action="index.php?p=configmanager&action=save">
    <?php showMsg($msg, 'error'); ?>
    <?php showAdminTokenField(); ?>
    <p><label><?php echo lang("Lang"); ?></label><br />
    <select name="lang">
	    <?php foreach($langs as $k=>$v){ ?>
	    <option <?php if($v == $config['siteLang']){ ?>selected<?php } ?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
	    <?php } ?>
    </select></p>
    <p><label><?php echo lang("Site name"); ?></label><br />
    <input type="text" name="siteName" value="<?php echo $config['siteName']; ?>" /></p>
    <p><label><?php echo lang("Site description"); ?></label><br />
    <input type="text" name="siteDescription" value="<?php echo $config['siteDescription']; ?>" /></p>
    <p><label><?php echo lang("Admin mail"); ?></label><br />
    <input type="text" name="adminEmail" value="<?php echo $config['adminEmail']; ?>" /></p>
    <p><label><?php echo lang("Theme"); ?></label><br />
	    <?php foreach($themes as $k=>$v){ ?>
	    <input type="radio" name="theme" <?php if($v['selected']){ ?>checked<?php } ?> value="<?php echo $k; ?>" /> <?php echo $v['name']; ?> <a class="edit-btn aboutTheme" href="javascript:"><?php echo lang("About"); ?></a>
	    <span style="display:none;">
		    <b><?php echo lang("Theme"); ?> <?php echo $v['name']; ?></b><br /><br />
		    <?php echo lang("Author"); ?> :<br />
		    <?php echo $v['author']; ?><br />
		    <?php echo $v['authorEmail']; ?><br />
		    <a href="<?php echo $v['authorWebsite']; ?>" target="_blank"><?php echo $v['authorWebsite']; ?></a>
	    </span><br />
	    <?php } ?>
    </p>
    <p><label><?php echo lang("Default plugin"); ?></label><br />
    <select name="defaultPlugin">
	    <?php foreach($plugins as $k=>$v) if($v['target'] && $v['activate'] && $v['frontFile']){ ?>
	    <option <?php if($v['isDefaultPlugin']){ ?>selected<?php } ?> value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
	    <?php } ?>
    </select></p>
    <p><label><?php echo lang("New admin password"); ?></label><br />
    <input type="password" name="adminPwd" value="" /></p>
    <p><label><?php echo lang("Confirmation"); ?></label><br />
    <input type="password" name="adminPwd2" value="" /></p>
    <p><input type="submit" value="<?php echo lang("Save"); ?>" /></p>