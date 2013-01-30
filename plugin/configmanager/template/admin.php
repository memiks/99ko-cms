<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>

<form id="configForm" method="post" action="index.php?p=configmanager&action=save">
	<?php showMsg($msg, 'error'); ?>
	<?php showAdminTokenField(); ?>
	<p><a href="javascript:" class="btn" id="advancedConfigurationButton"><?php echo $lang['AdvancedConfiguration']; ?></a></p>
	<div id="advancedConfiguration">
		<?php showMsg($lang['AdvancedConfigurationWarning'], "error"); ?>
		<p><label><?php echo $lang['siteUrl']; ?></label><br />
		<input type="text" name="siteUrl" value="<?php echo $coreConf['siteUrl']; ?>" /></p>
		<p><label><?php echo $lang['urlRewriting']; ?></label><br />
		<input id="urlRewriting" type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($coreConf['urlRewriting']){ ?>checked<?php } ?> name="urlRewriting" /> <?php echo $lang['on']; ?>
		</p>
		<p><label><?php echo $lang['htaccess']; ?></label><br />
		<textarea id="htaccess" name="htaccess"><?php echo $htaccess; ?></textarea>
		</p>
		<p><input type="submit" value="<?php echo $lang['save']; ?>" /></p>
		<hr class="notop">
	</div>
	<p><label><?php echo $lang['siteName']; ?></label><br />
	<input type="text" name="siteName" value="<?php echo $coreConf['siteName']; ?>" /></p>
	<p><label><?php echo $lang['siteDescription']; ?></label><br />
	<input type="text" name="siteDescription" value="<?php echo $coreConf['siteDescription']; ?>" /></p>
	<p><label><?php echo $lang['adminEmail']; ?></label><br />
	<input type="text" name="adminEmail" value="<?php echo $coreConf['adminEmail']; ?>" /></p>
	<p><label><?php echo $lang['theme']; ?></label><br />
		<?php foreach($themes as $k=>$v){ ?>
		<input type="radio" name="theme" <?php if($v['selected']){ ?>checked<?php } ?> value="<?php echo $k; ?>" /> <?php echo $v['name']; ?> <a class="edit-btn aboutTheme" href="javascript:"><?php echo $lang['about']; ?></a>
		<span style="display:none;">
			<b><?php echo $lang['theme']; ?> <?php echo $v['name']; ?></b><br /><br />
			<?php echo $lang['author']; ?> :<br />
			<?php echo $v['author']; ?><br />
			<?php echo $v['authorEmail']; ?><br />
			<a href="<?php echo $v['authorWebsite']; ?>" target="_blank"><?php echo $v['authorWebsite']; ?></a>
		</span><br />
		<?php } ?>
	</p>
	<p><label><?php echo $lang['siteLang']; ?></label><br />
					<select name="siteLang" id="siteLang">
						<?php
							$traductions = utilScanDir(ROOT.'common/lang/', array('.DS_Store'))['file'];
							
							foreach($traductions as $traduction){
							    $langfile = strpos($traduction, '.');
							    $language = substr($traduction, 0, $langfile);			    
								echo '<option value="' . $language . '">' . $language . '</option>';
							}
						?>
					</select>
	</p>		
	<p><label><?php echo $lang['defaultPlugin']; ?></label><br />
	<select name="defaultPlugin">
		<?php foreach($plugins as $k=>$v) if($v['target'] && $v['activate'] && $v['frontFile']){ ?>
		<option <?php if($v['isDefaultPlugin']){ ?>selected<?php } ?> value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
		<?php } ?>
	</select></p>
	<p><label><?php echo $lang['adminPwd']; ?></label><br />
	<input type="password" name="adminPwd" value="" /></p>
	<p><label><?php echo $lang['adminPwd2']; ?></label><br />
	<input type="password" name="adminPwd2" value="" /></p>
	<p><input type="submit" value="<?php echo $lang['save']; ?>" /></p>
</form>

<?php include_once(ROOT.'admin/footer.php') ?>