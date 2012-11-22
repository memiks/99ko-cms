<?php include(dirname(__FILE__).'/header.php'); # On insère notre haut de page ?>
	<div id="Titre_logo">
		<img src="<?php echo $data['siteUrl']; ?>theme/<?php echo $data['theme']; ?>/images/featured.png" alt="featured section" />
	</div><!--/Titre_logo-->

			<div id="archives">
		<h2>Archives</h2>
		<?php foreach($data['aNavActuArchive'] as $annee=>$aV){ ?>
			<h3><?php echo $annee; ?></h3>
			<ul>
			<?php foreach($aV as $mois=>$v){ ?>
				<li><img src="<?php echo $data['siteUrl']; ?>theme/<?php echo $data['theme']; ?>/images/date.png" alt="Date" class="glyf" />&nbsp;<a class="<?php showIf($v['isFirst'], 'first'); ?> <?php showIf($v['isActif'], 'actif'); ?>" href="<?php echo $v['url']; ?>"><?php showDate($annee.'-'.$mois, '%B'); ?> ( <?php echo $v['nb']; ?> )</a></li>
			<?php } ?>
			</ul>
		<?php } ?>									
			</div><!--/archives-->
		
		<?php foreach($data['aActu'] as $k=>$v){ ?>	
	<div class="actualite">   

			<div id="elem">
				<a name="<?php echo $v['id']; ?>" /></a>
				<h2><?php echo $v['titre']; ?></h2>
				<br />
				<img src="<?php echo $data['siteUrl']; ?>theme/<?php echo $data['theme']; ?>/images/date.png" alt="Date" class="glyf" />&nbsp;<?php showDate($v['date'], '%d %B %Y'); ?>               
						<p><?php echo $v['contenu']; ?></p>
			</div><!--/elem -->
			
	</div><!--/actualite-->
		<?php } ?>
							
	<div class="clear"></div>
                           <span class="plus">Pour lire plus d'actualités, consultez les archives.</span>                            
		
<?php include(dirname(__FILE__).'/footer.php'); # On insère notre bas de page ?>