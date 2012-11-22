<?php include('header.php'); ?>
	<div id="Titre_logo">
		<img src="<?php echo $data['siteUrl']; ?>theme/<?php echo $data['theme']; ?>/images/featured.png" alt="featured section" />
	</div><!--/Titre_logo-->
<div id="contact">
	<?php showIf($data['contactMsg'], '<p id="msg">'.$data['contactMsg'].'</p>'); ?>
	<form method="post" action="">
		<div id="author">
			<p><label>Votre nom</label><br />
			<input type="text" name="nom" value="<?php echo $data['contactNom']; ?>" /></p>
			<p><label>Votre prénom</label><br />
			<input type="text" name="prenom" value="<?php echo $data['contactPrenom']; ?>" /></p>
			<p><label>Votre email</label><br />
			<input type="text" name="email" value="<?php echo $data['contactEmail']; ?>" /></p>
		</div>
		<div id="message">
			<p><label>Votre message</label><br />
			<textarea name="message"><?php echo $data['contactMessage']; ?></textarea></p>
			<p><label>Antispam</label><br />
			<?php echo $data['captchaQuestion']; ?> <input type="text" name="captchaReponse" value="" /></p>
			<p><input type="submit" value="Envoyer" /> <span class="compulsory">Tous les champs sont obligatoires.</span><p>
		</div>
	</form>
</div>
<?php include('footer.php'); ?>