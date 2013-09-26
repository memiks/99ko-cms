<?php if(!defined('ROOT')) die(); ?>
<form id="configForm" method="post" action="index.php?p=configmanager&action=save">
    <?php showMsg($msg, 'error'); ?>
    <?php showAdminTokenField(); ?>
    <p><label>Nom du site</label><br />
    <input type="text" name="siteName" value="<?php echo $config['siteName']; ?>" /></p>
    <p><label>Description du site</label><br />
    <input type="text" name="siteDescription" value="<?php echo $config['siteDescription']; ?>" /></p>
    <p><label>Email admin</label><br />
    <input type="text" name="adminEmail" value="<?php echo $config['adminEmail']; ?>" /></p>
    <p><label>Thème</label><br />
	    <?php foreach($themes as $k=>$v){ ?>
	    <input type="radio" name="theme" <?php if($v['selected']){ ?>checked<?php } ?> value="<?php echo $k; ?>" /> <?php echo $v['name']; ?> <a class="edit-btn aboutTheme" href="javascript:">A propos</a>
	    <span style="display:none;">
		    <b>Thème <?php echo $v['name']; ?></b><br /><br />
		    Auteur :<br />
		    <?php echo $v['author']; ?><br />
		    <?php echo $v['authorEmail']; ?><br />
		    <a href="<?php echo $v['authorWebsite']; ?>" target="_blank"><?php echo $v['authorWebsite']; ?></a>
	    </span><br />
	    <?php } ?>
    </p>
    <p><label>Plugin par défaut</label><br />
    <select name="defaultPlugin">
	    <?php foreach($plugins as $k=>$v) if($v['target'] && $v['activate'] && $v['frontFile']){ ?>
	    <option <?php if($v['isDefaultPlugin']){ ?>selected<?php } ?> value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
	    <?php } ?>
    </select></p>
    <p><label>Nouveau mot de passe admin</label><br />
    <input type="password" name="adminPwd" value="" /></p>
    <p><label>confirmation</label><br />
    <input type="password" name="adminPwd2" value="" /></p>
    <p><input type="submit" value="Enregistrer" /></p>