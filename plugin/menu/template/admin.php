<?php include_once(ROOT.'admin/header.php'); ?>

<?php if ($data['menuMode'] == 'list') { ?>
<button class="btn" id="addLink" onclick="addLink()">Ajouter un lien</button>
<form method="post" action="index.php?p=menu&action=save">
	<?php showAdminTokenField(); ?>
	<table id="linksList" class="table table-striped">
		<thead>
			<tr>
				<th>Label</th>
				<th>Url</th>
				<th>Cible</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['menuLinks'] as $position=>$link) { ?>
			<tr id="<?php echo $position; ?>">
				<input type="hidden" name="id<?php echo $position; ?>" value="<?php echo $link->getId(); ?>" />
				<input type="hidden" name="plugin<?php echo $position; ?>" value="<?php echo $link->getPlugin(); ?>" />
				<td class="label">
					<?php if ($link->getPlugin() == 'menu') {?>
						<input type="text" name="label<?php echo $position; ?>" value="<?php echo $link->getLabel(); ?>" />
					<?php } else { ?>
						<input type="hidden" name="label<?php echo $position; ?>" value="<?php echo $link->getLabel(); ?>" />
						<?php echo $link->getLabel(); ?>
					<?php } ?>
				</td>
				<td class="url">
					<?php if ($link->getPlugin() == 'menu') {?>
						<input type="text" name="url<?php echo $position; ?>" value="<?php echo $link->getUrl(); ?>" />
					<?php } else { ?>
						<input type="hidden" name="url<?php echo $position; ?>" value="<?php echo $link->getUrl(); ?>" />
						<?php echo $link->getUrl(); ?>
					<?php } ?>
				</td>
				<td class="target">
					<?php if ($link->getPlugin() == 'menu') {?>
						<select name="target<?php echo $position; ?>">
							<option value="_self" <?php echo ($link->getTarget() == '_self' ? 'selected' : ''); ?>>Fenêtre courante</option>
							<option value="_blank" <?php echo ($link->getTarget() == '_blank' ? 'selected' : ''); ?>>Nouvelle fenêtre</option>
						</select>
					<?php } else { ?>
						<input type="hidden" name="target<?php echo $position; ?>" value="<?php echo $link->getTarget(); ?>" />
						<?php echo ($link->getTarget() == '_self' ? 'Fenêtre courante' : 'Nouvelle fenêtre'); ?>
					<?php } ?>
				</td>
				<td class="up">
					<?php if ($position > 0) {?>
						<img src="<?php echo MENU_PLUGINPATH; ?>img/up.png" alt="monter" onclick="upLink(<?php echo $position; ?>)" />
					<?php } ?>
				</td>
				<td class="down">
					<?php if ($position < count($data['menuLinks']) - 1) {?>
						<img src="<?php echo MENU_PLUGINPATH; ?>img/down.png" alt="descendre" onclick="downLink(<?php echo $position; ?>)" />
					<?php } ?>
				</td>
				<td class="delete">
					<?php if ($link->getPlugin() == 'menu') {?>
						<img src="<?php echo MENU_PLUGINPATH; ?>img/delete.png" alt="supprimer" onclick="deleteLink(<?php echo $position; ?>)" />
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<input type="hidden" name="number" value="<?php echo count($data['menuLinks']); ?>" />
	<div class="buttons">
		<input type="submit" value="Enregistrer" />
		<button class="btn" onclick="window.location.reload();return false;">Annuler les modifications</button>
	</div>
</form>
<?php } ?>

<?php include_once(ROOT.'admin/footer.php'); ?>
