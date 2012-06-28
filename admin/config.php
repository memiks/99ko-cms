<?php include_once(ROOT.'admin/header.php') ?>

<section id="content">
	<h3>Configuration</h3>
	<hr class="notop">

		<form id="configForm" method="post" action="index.php?action=saveconfig">
			<?php showMsg($data['msgConfig'], 'error'); ?>
			<?php showAdminTokenField(); ?>
			<p><label>Nom du site</label><br />
			<input type="text" name="siteName" value="<?php echo $data['configSiteName']; ?>" /></p>
			<p><label>Description du site</label><br />
			<input type="text" name="siteDescription" value="<?php echo $data['configSiteDescription']; ?>" /></p>
			<p><label>Email admin</label><br />
			<input type="text" name="adminEmail" value="<?php echo $data['configAdminEmail']; ?>" /></p>
			<p><label>Thème</label><br />
				<?php foreach($data['configThemes'] as $k=>$theme){ ?>
				<input type="radio" name="theme" <?php if($theme['selected']){ ?>checked<?php } ?> value="<?php echo $k; ?>" /> <?php echo $theme['name']; ?> <span class="infos">Par <?php echo $theme['author']; ?> : <?php echo $theme['authorEmail']; ?> <a href="<?php echo $theme['authorWebsite']; ?>" target="_blank"><?php echo $theme['authorWebsite']; ?></a></span><br />
				<?php } ?>
			</p>
			<p><label>Plugin par défaut</label><br />
			<select name="defaultPlugin">
				<?php foreach($data['plugins'] as $plug) if($plug['target'] && $plug['activate'] && $plug['frontFile']){ ?>
				<option <?php if($plug['isDefaultPlugin']){ ?>selected<?php } ?> value="<?php echo $plug['id']; ?>"><?php echo $plug['name']; ?></option>
				<?php } ?>
			</select></p>
			
			<p><label>URL du site</label><br />
			<input type="text" name="siteUrl" value="<?php echo $data['configSiteUrl']; ?>" /> (sans slash final)</p>
			<p><label>Nouveau mot de passe admin</label><br />
			<input type="password" name="adminPwd" value="" /></p>
			<p><label>confirmation</label><br />
			<input type="password" name="adminPwd2" value="" /></p>
			<p><input type="submit" value="Enregistrer" /></p>
		</form>
</section>

<?php include_once(ROOT.'admin/footer.php') ?>
