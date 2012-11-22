<form method="post" action="index.php?p=seooptimizer&action=save">
	<?php showAdminTokenField(); ?>
        <p><label>Contenu de la balise meta Title principale</label><br />
	<input type="text" name="metaTitle" value="<?php echo $metaTitle; ?>" /></p>
        <p><label>Contenu de la balise meta Description principale</label><br />
	<input type="text" name="metaDescription" value="<?php echo $metaDescription; ?>" /></p>
        <p><label>Code de suivi Analytics (exemple : UA-00000000-0)</label><br />
	<input type="text" name="analyticsId" value="<?php echo $analyticsId; ?>" /></p>
        <p><label>Code de vérification Google Webmaster (contenu de la balise meta google-site-verification)</label><br />
	<input type="text" name="gWebId" value="<?php echo $gWebId; ?>" /></p>
        <p><input type="submit" value="Enregistrer" /></p>
</form>