<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>

<form method="post" action="index.php?p=pluginsmanager&action=save" id="pluginsmanagerForm">
	<?php showMsg($msg, $msgType); ?>
	<?php showAdminTokenField(); ?>
	<table class="table table-striped table-condensed">
	  <thead>
		<tr>
			<th><?php echo lang('Name', 'pluginsmanager'); ?></th>
			<th></th>
			<th><?php echo lang('Version', 'pluginsmanager'); ?></th>
			<th><?php echo lang('Priority', 'pluginsmanager'); ?></th>
			<th><?php echo lang('Enable', 'pluginsmanager'); ?></th>
		</tr>
	  </thead>
	  <tbody>			  	
		<?php foreach($plugins as $k=>$v){ ?>
		<tr>
			<td>
				<?php echo lang($v['name'], $v['id']); ?>
			</td>
			<td>
			<?php if($v['target'] && $v['activate']){ ?><a class="edit-btn" href="<?php echo $v['target']; ?>"><?php echo lang('Go to plugin', 'pluginsmanager'); ?></a><?php } ?> 
			<a class="edit-btn aboutPlugin" href="javascript:"><?php echo lang('About', 'pluginsmanager'); ?></a>
			<span style="display:none;">
			<b>Plugin <?php echo lang($v['name'], $v['id']); ?></b><br />
			<?php echo lang($v['description'], $v['id']); ?><br /><br />
			<?php echo lang('Author', 'pluginsmanager'); ?> :<br />
			<?php echo $v['author']; ?><br />
			<?php echo $v['authorEmail']; ?><br />
			<a href="<?php echo $v['authorWebsite']; ?>" target="_blank"><?php echo $v['authorWebsite']; ?></a>
			</span>
			</td>
			<td><?php echo $v['version']; ?></td>
			<td><?php echo utilHtmlSelect($priority, $v['priority'], 'name="priority['.$v['id'].']" onchange="document.getElementById(\'pluginsmanagerForm\').submit();"'); ?></td>
			<td><input onchange="document.getElementById('pluginsmanagerForm').submit();" <?php if($v['activate']){ ?>checked<?php } ?> type="checkbox" name="activate[<?php echo $v['id']; ?>]"<?php if($v['locked']){ ?> style="display:none;"<?php } ?> /></td>
		</tr>
		<?php } ?>
	  </tbody>					
	</table>
	<!--<p><input type="submit" value="Enregistrer" /></p>-->
</form>

<?php include_once(ROOT.'admin/footer.php') ?>