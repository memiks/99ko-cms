</div><!--Fin de Taille-Fixe--> 

<div id="PiedDePage"></div><!--/footer-->

<div id="PiedDePage_Milieu">
<div class="Taille-Fixe">
<p class="PiedDePage_Copy">
Copyright &copy; <?php echo date('Y'); ?> , tous droits r&eacute;serv&eacute;s  - Just using <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> | Thème <?php showTheme(); ?> | <a rel="nofollow" href="admin/">Administration</a> | <?php showExecTime(); ?>s.
</p>
</div><!--/Taille-Fixe-->
</div><!--/footer r-->

<div id="PiedDePage_Fin"></div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="theme/<?php echo $coreConf['theme']; ?>/js/sliding_effect.js"></script>
<script type="text/javascript" src="theme/<?php echo $coreConf['theme']; ?>/js/jquery.roundabout-1.0.min.js"></script> 
<script type="text/javascript" src="theme/<?php echo $coreConf['theme']; ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="theme/<?php echo $coreConf['theme']; ?>/js/vtip.js"></script>
<script type="text/javascript">		
	$(document).ready(function() { //Démarrage du carroussel
		$('#featured ul').roundabout({
			easing: 'easeOutInCirc',
			duration: 600
		});
	});
</script>  
<?php eval(callHook('endFrontBody')); ?>
</body>
</html>