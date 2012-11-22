<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>
<?php 

foreach($pluginsManager->getPlugins() as $k=>$plugin){
	if (isset($data['allplugins'][$plugin->getName()])){
	  unset($data['allplugins'][$plugin->getName()]);
	}
	$data['plugins'][$k]['id'] = $plugin->getName();
	$data['plugins'][$k]['isDefaultPlugin'] = $plugin->getIsDefaultPlugin();
	$data['plugins'][$k]['name'] = $plugin->getInfoVal('name');
	$data['plugins'][$k]['description'] = $plugin->getInfoVal('description');
	$data['plugins'][$k]['target'] = ($plugin->getAdminFile()) ? 'index.php?p='.$plugin->getName() : false;
	$data['plugins'][$k]['activate'] = ($plugin->getConfigVal('activate')) ? true : false;
	$data['plugins'][$k]['priority'] = $plugin->getConfigVal('priority');
	$data['plugins'][$k]['version'] = $plugin->getInfoVal('version');
	$data['plugins'][$k]['author'] = $plugin->getInfoVal('author');
	$data['plugins'][$k]['authorEmail'] = $plugin->getInfoVal('authorEmail');
	$data['plugins'][$k]['authorWebsite'] = $plugin->getInfoVal('authorWebsite');
	$data['plugins'][$k]['frontFile'] = $plugin->getFrontFile();
	$data['plugins'][$k]['installed'] = true; 
}
?>

<form method="post" action="index.php?p=gemsetmanager&action=save" id="pluginsmanagerForm">
	<?php showMsg($msg, $msgType); ?>
	<?php showAdminTokenField(); ?>
	<table class="table table-striped table-condensed">
	  <thead>
		<tr>
			<th>Nom</th>
			<th></th>
			<th>Version</th>
			<th>Priorité</th>
			<th>Activer</th>
			<th>Installer</th>
		</tr>
	  </thead>
	  <tbody>			
	    <?php $allplugins = array_merge($data['plugins'] ,$data['allplugins'] ) ?>  	
		<?php foreach($allplugins as $k=>$v){ ?>
		<tr>
			<td>
				<?php echo $v['name']; ?>
			</td>
			<td>
			<?php if($v['target'] && $v['activate']){ ?><a class="edit-btn" href="<?php echo $v['target']; ?>">Aller au plugin</a><?php } ?> 
			<a class="edit-btn aboutPlugin" href="javascript:">A propos</a>
			<span style="display:none;">
			<b>Plugin <?php echo $v['name']; ?></b><br />
			<?php echo $v['description']; ?><br /><br />
			Auteur :<br />
			<?php echo $v['author']; ?><br />
			<?php echo $v['authorEmail']; ?><br />
			<a href="<?php echo $v['authorWebsite']; ?>" target="_blank"><?php echo $v['authorWebsite']; ?></a>
			</span>
			</td>
			<td><?php echo $v['version']; ?></td>
			<td><input class="priority" type="text" name="priority[<?php echo $v['id']; ?>]" value="<?php echo $v['priority']; ?>" /></td>
			<td><?php if ($v['installed']){ ?><input <?php if($v['activate']){ ?>checked<?php } ?> type="checkbox" name="activate[<?php echo $v['id']; ?>]"<?php if($v['isDefaultPlugin']){ ?> disabled<?php }?> /><?php }?></td>
			<td><input type ="checkbox" name="installed[<?php echo $v['id']; ?>]" <?php if ($v['installed']) echo "checked"; ?> <?php if($v['isDefaultPlugin']){ ?> disabled<?php }?> /></td>
		 
		</tr>
		<?php } ?>
	  </tbody>					
	</table>
<p><input type="submit" value="Enregistrer" /></p>
</form>

<?php include_once(ROOT.'admin/footer.php') ?>