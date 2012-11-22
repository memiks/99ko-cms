<?php include(dirname(__FILE__).'/header.php'); # On insre notre haut de page ?>
	<div id="Titre_logo">
		<img src="theme/<?php echo $coreConf['theme']; ?>/images/featured.png" alt="featured section" />
	</div><!--/Titre_logo-->
<?php
if($data['pageFile']) include_once($data['pageFile']);
else echo $data['pageContent'];
?>
<?php include(dirname(__FILE__).'/footer.php'); # On insre notre bas de page ?>