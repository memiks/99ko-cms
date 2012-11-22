<?php include_once(ROOT.'admin/header.php') ?>

<section id="home">
	<h2>Bienvenue dans 99ko</h2>
	<hr>
	<?php showMsg($data['msgSecurity'], 'error'); ?>
	<p>Vous utilisez la version <span class="version"><?php echo $data['99koVersion']; ?></span> de 99ko.<br />
    Téléchargez une version plus récente, des plugins et des thèmes sur le site officiel.<br />
	En cas de problème avec 99ko, rendez-vous sur le forum d'entraide.</p>
	<p><a class="btn" href="http://99ko.tuxfamily.org" target="_blank">Site officiel</a> <a class="btn" href="http://99ko.tuxfamily.org/forum" target="_blank">Forum</a></p>
</section>

<?php include_once(ROOT.'admin/footer.php') ?>
>
