<?php include_once(ROOT.'admin/header.php') ?>
<form method="post" action="index.php?p=captcha&action=save">
	<?php showAdminTokenField(); ?>
	<p>Méthode : <br />
			<label><input type="radio" name="method" value="none" <?php echo $data['method'] == 'none' ? 'checked' : '' ?> /> Désactivé </label><br />
			<label><input type="radio" name="method" value="question" <?php echo $data['method'] == 'question' ? 'checked' : '' ?> /> Maths</label><br />
			<label><input type="radio" name="method" value="image" <?php echo $data['method'] == 'image' ? 'checked' : '' ?> /> Image (requiert GD)</label>
		</p>
	<p><input type="submit" value="Enregistrer" /></p>
</form>
<?php include_once(ROOT.'admin/footer.php') ?>
