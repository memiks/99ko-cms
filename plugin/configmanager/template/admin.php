<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>

<form id="configForm" method="post" action="index.php?p=configmanager&action=save">
	<?php showMsg($msg, 'error'); ?>
	<?php showAdminTokenField(); ?>
	<p><a href="javascript:" class="btn" id="advancedConfigurationButton"><?php echo $lang['AdvancedConfiguration']; ?></a></p>
	<div id="advancedConfiguration">
		<?php showMsg($lang['AdvancedConfigurationWarning'], "error"); ?>
		<p><label><?php echo $lang['SiteUrl']; ?></label><br />
		<input type="text" name="siteUrl" value="<?php echo $coreConf['siteUrl']; ?>" /></p>
		<p><label>Réécriture d'URL</label><br />
		<input id="urlRewriting" type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($coreConf['urlRewriting']){ ?>checked<?php } ?> name="urlRewriting" /> Activer
		</p>
		<p><label>.htaccess</label><br />
		<textarea id="htaccess" name="htaccess"><?php echo $htaccess; ?></textarea>
		</p>
		<p><input type="submit" value="Enregistrer" /></p>
		<hr class="notop">
	</div>
	<p><label>Nom du site</label><br />
	<input type="text" name="siteName" value="<?php echo $coreConf['siteName']; ?>" /></p>
	<p><label>Description du site</label><br />
	<input type="text" name="siteDescription" value="<?php echo $coreConf['siteDescription']; ?>" /></p>
	<p><label>Email admin</label><br />
	<input type="text" name="adminEmail" value="<?php echo $coreConf['adminEmail']; ?>" /></p>
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
	<p><label>Language</label><br />
					<select name="siteLang" id="siteLang">
						<?php
							$langs = scandir(ROOT.'common/lang');
							array_shift($langs);
							array_shift($langs);
							unset($langs[array_search('.DS_Store', $langs)]);
							
							foreach($langs as $lang){
							    $langfile = strpos($lang, '.');
							    $language = substr($lang, 0, $langfile);			    
								echo '<option value="' . $language . '">' . $language . '</option>';
							}
						?>
					</select>
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
</form>

<?php include_once(ROOT.'admin/footer.php') ?>