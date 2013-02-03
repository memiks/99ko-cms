<!doctype html>  
<!--[if IE 6 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="<?php echo $coreConf['siteLang']; ?>" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="<?php echo $coreConf['siteLang']; ?>"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>99ko - <?php echo lang('Login'); ?></title>
	<link rel="stylesheet" href="css/login.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
</head>
<body>
	<?php if (isset($_SESSION['msg_install'])) { ?>
	<div id="content">      
		<section id="home">
		       <?php showMsg($_SESSION['msg_install'], 'success'); ?>
		</section>
		<br />
	</div>
	<?php } ?>

	<section id="login">
		<!--<h2>Connexion</h2>-->
    
		<div id="login_panel">
			<?php showMsg($msg, 'error'); ?>
			<form method="post" action="index.php?action=login">
				<div class="login_fields">			
					<div class="field">
					    <?php showAdminTokenField(); ?>
					<label for="adminPwd"><?php echo lang('Password'); ?><!-- <small><a href="#GetPassword" class="openModal">Mot de Passe oublié ?</a></small>--></label>
						<input type="password" name="adminPwd" id="adminPwd" tabindex="1" />			
					</div>
				</div> <!-- login_fields -->
				
				<div class="login_actions">
				<input type="submit" class="btn" tabindex="2" value="<?php echo lang('Go'); ?>" />
				<em><?php echo lang('Just using'); ?> <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a></em>
				</div>
			</form>
		</div> <!-- #login_panel -->		
	</section> <!-- #login -->

<!-- Modal  -->
	<!--<aside id="GetPassword" class="modal">
		<div>
			<h2>Récupération du mot de passe</h2>
			<form>
			   <label for="getpass">E-mail: </label>
			   <input type="mail" name="getpass" id="getpass" tabindex="1" placeholder="Insérez votre mail" />
			   <button type="submit" class="btn" tabindex="2">Envoyer</button>
			</form>
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
	
</div>-->
</body>
</html>