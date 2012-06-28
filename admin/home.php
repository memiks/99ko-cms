<?php include_once(ROOT.'admin/header.php') ?>

<section id="content">
	<h3>99ko</h3>
	<hr>
	<?php showMsg($data['msgSecurity'], 'error'); ?>
	<!--<ul>
	  <li>Dernières Actus: 09/19/2011</li>
	  <li>Par: Jonathan</li>
	  <li><a href=""></a></li>
	  <li>Email: <a href="mailto:&#97;&#100;&#109;&#105;&#110;&#64;&#57;&#57;&#46;&#111;&#114;&#103;">&#97;&#100;&#109;&#105;&#110;&#64;&#57;&#57;&#46;&#111;&#114;&#103;</a></li>
	</ul>-->
	<p>Vous utilisez la version <span class="version"><?php echo $data['99koVersion']; ?></span> de 99ko.<br />
    <a target="_blank" href="http://99ko.tuxfamily.org">Téléchargez</a> une version plus récente, des plugins et des thèmes sur le site de 99ko.</p>
    <script type="text/javascript">
    showTabs();
    </script>

</section>

<?php include_once(ROOT.'admin/footer.php') ?>
