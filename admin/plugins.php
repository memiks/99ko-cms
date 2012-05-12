<?php include_once(ROOT.'admin/header.php') ?>

<section id="plugins" onclick="closeConfig();openPlugins()">
	<h3>Plugins</h3>
	<hr class="notop">

		<form method="post" action="index.php?action=saveplugins" id="pluginsList">
			<?php showMsg($data['msgPlugins'], 'error'); ?>
			<?php showAdminTokenField(); ?>
			<table class="table table-striped table-condensed">
			  <thead>
				<tr>
					<th>Nom</th>
					<th>Description</th>
					<th>Version</th>
					<th>Priorité</th>
					<th>Activer</th>
				</tr>
			  </thead>
			  <tbody>			  	
				<?php foreach($data['plugins'] as $plug){ ?>
				<tr>
					<td>
						<?php if($plug['target'] && $plug['activate']){ ?>
						<a href="<?php echo $plug['target']; ?>"><?php echo $plug['name']; ?></a>
						<?php } else{ 
						echo $plug['name'];
						} ?>
					</td>
					<td><?php echo $plug['description']; ?><br />
					<span class="infos">Par <?php echo $plug['author']; ?> : <?php echo $plug['authorEmail']; ?> <a href="<?php echo $plug['authorWebsite']; ?>" target="_blank"><?php echo $plug['authorWebsite']; ?></a></span></td>
					<td><?php echo $plug['version']; ?></td>
					<td><input class="priority" type="text" name="priority[<?php echo $plug['id']; ?>]" value="<?php echo $plug['priority']; ?>" /></td>
					<td><input <?php if($plug['activate']){ ?>checked<?php } ?> type="checkbox" name="activate[<?php echo $plug['id']; ?>]"<?php if($plug['isDefaultPlugin']){ ?> disabled<?php } ?> /></td>
				</tr>
				<?php } ?>
			  </tbody>					
			</table>
			<p><input type="submit" value="Enregistrer" /></p>
		</form>
</section>

<?php include_once(ROOT.'admin/footer.php') ?>
