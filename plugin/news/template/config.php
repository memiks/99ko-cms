<form method="post" action="index.php?p=news&action=saveconf">
	<?php showAdminTokenField(); ?>
	<p>
		<label>Intitulé du lien</label><br />
		<input type="text" name="label" value="<?php echo $label; ?>" />
	</p>
	<p>
		<label>Nombre d'items par page</label><br />
		<input type="text" name="itemsByPage" value="<?php echo $itemsByPage; ?>" />
	</p>
	<p>
		<label>Intitulé de la liste des années dans la sidebar (laisser ce champ vide pour ne rien afficher dans la sidebar)</label><br />
		<input type="text" name="sidebarTitle" value="<?php echo $sidebarTitle; ?>" />
	</p>
	<p><input type="submit" value="Enregistrer" /></p>
</form>