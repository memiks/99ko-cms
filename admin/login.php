<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<html lang="<?php showSiteLang(); ?>">
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
		<div id="login_panel">
			<?php showMsg($msg, 'error'); ?>
			<form method="post" action="index.php?action=login">
				<div class="login_fields">			
					<div class="field">
					    <?php showAdminTokenField(); ?>
						<label for="adminEmail"><?php echo lang('Email'); ?></label>
						<input type="text" name="adminEmail" id="adminEmail" tabindex="1" />			
					</div>
					<div class="field">
					    <?php showAdminTokenField(); ?>
						<label for="adminPwd"><?php echo lang('Password'); ?></label>
						<input type="password" name="adminPwd" id="adminPwd" tabindex="1" />			
					</div>
				</div>
				
				<div class="login_actions">
					<input type="submit" class="btn" tabindex="2" value="<?php echo lang('Go'); ?>" />
					<em><?php echo lang('Just using'); ?> <a target="_blank" title="<?php echo lang('Just using'); ?>" href="http://99ko.tuxfamily.org/">99ko</a></em>
				</div>
			</form>
		</div>		
	</section>
</body>
</html>