<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>

<form method="post" action="index.php?p=pluginsmanager&action=save" id="pluginsmanagerForm">
	<?php showMsg($msg, $msgType); ?>
	<?php showAdminTokenField(); ?>
	<table class="table table-striped table-condensed">
	  <thead>
		<tr>
			<th><?php echo lang("Name"); ?></th>
			<th></th>
			<th><?php echo lang("Version"); ?></th>
			<th><?php echo lang("Priority"); ?></th>
			<th><?php echo lang("Enable"); ?></th>
		</tr>
	  </thead>
	  <tbody>			  	
		<?php foreach($plugins as $k=>$v){ ?>
		<tr>
			<td>
				<?php echo $v['name']; ?>
			</td>
			<td>
			<?php if($v['target'] && $v['activate']){ ?><a class="edit-btn" href="<?php echo $v['target']; ?>"><?php echo lang("Go to plugin"); ?></a><?php } ?> 
			<a class="edit-btn aboutPlugin" href="javascript:"><?php echo lang("About"); ?></a>
			<span style="display:none;">
			<b><?php echo lang("Plugin"); ?> : <?php echo lang($v['name']); ?></b><br />
			<?php echo lang($v['description']); ?><br /><br />
			<?php echo lang("Author"); ?> :<br />
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
</form>

<?php include_once(ROOT.'admin/footer.php') ?>