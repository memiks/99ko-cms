<!doctype html>  
<!--[if IE 6 ]><html lang="fr" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="fr" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="fr" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">	
	<title>99ko - Cms</title>
	<!-- meta -->
	<meta name="description" content="Cms hyper légé!">
	<meta name="author" content="Jonathan C.">
	<meta name="generator" content="99Ko">
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/common.css" media="all">
	<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
	<![endif]-->	
	<!-- Personnalisation des liens, sidebar, contenus -->
	<style>
		html{background-color:#FFFFFF;color:#383838;}
		::-moz-selection{background:#DBE6EC;color:#111111;}
		::selection{background:#DBE6EC;color:#111111;}
		header #logo{background-image:url(images/logo.png);}
		a{color:#A26F6F;}
		hr{border-top:1px solid #D7E1E6;border-bottom:1px solid #EFFAFF;}
		header, header > nav a{background-color:#77A2A8;color:#222222;}
		header > nav a{-webkit-text-shadow:1px 1px 0px #DBE5E8;-moz-text-shadow:1px 1px 0px #DBE5E8;text-shadow:1px 1px 0px #DBE5E8;}
		header > nav a:hover{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		header > nav a.current{background:#DBE6EC;color:#111111;border-top:1px solid #DBE6EC;}
		#copyright{display:block !important;visibility:visible !important;}
	</style>
	<?php showLinkTags(); ?>
	<?php showScriptTags(); ?>
	<script type="text/javascript">
	function openPlugins(){
		var obj = document.getElementById('pluginsList');
		obj.style.display = 'block';
	}
	function closePlugins(){
		var obj = document.getElementById('pluginsList');
		obj.style.display = 'none';
	}
	function openConfig(){
		var obj = document.getElementById('configForm');
		obj.style.display = 'block';
	}
	function closeConfig(){
		var obj = document.getElementById('configForm');
		obj.style.display = 'none';
	}
	function showTabs(){
		var obj = document.getElementById('plugins');
		obj.style.display = 'block';
		var obj = document.getElementById('config');
		obj.style.display = 'block';
		var obj = document.getElementById('<?php echo $plug['id']; ?>');
		obj.style.display = 'block';		
	}
	</script>
	<?php eval(callHook('endAdminHead')); ?>	
</head>
<body>

	<header role="banner">
		<a href="./#home" id="logo"></a>
		
		<nav role="navigation">
		   <ol>
			<li><a class="current" href="./#home">Accueil</a></li>
			<li><a href="./#config">Configuration</a></li>
			<li><a href="./#plugins">Plugins</a></li>
			<?php foreach($data['plugins'] as $plug) if($plug['target'] && $plug['activate']){ ?>
			<li><a href="index.php?p=<?php echo $plug['id']; ?>#<?php echo $plug['id']; ?>"><?php echo $plug['name']; ?></a></li>
			<?php } ?>						
		   </ol>		
		</nav>
		
		<div id="copyright">
		   Propulsé par <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> <span class="version"><?php echo $data['99koVersion']; ?></span>.
		</div>
	</header>
	<div id="content">
	
<section id="home">
	<h1>99ko</h1>
	<h2><a class="btn" id="logout" href="index.php?action=logout&token=<?php echo $data['token']; ?>">Se déconnecter</a>
	<a class="btn" id="showSite" href="../">Voir le site</a></h2>
	<hr>
	<?php showMsg($data['msgSecurity'], 'error'); ?>
	<ul>
	  <li>Dernières Actus: 09/19/2011</li>
	  <li>Par: Jonathan</li>
	  <li><a href=""></a></li>
	  <li>Email: <a href="mailto:&#97;&#100;&#109;&#105;&#110;&#64;&#57;&#57;&#46;&#111;&#114;&#103;">&#97;&#100;&#109;&#105;&#110;&#64;&#57;&#57;&#46;&#111;&#114;&#103;</a></li>
	</ul>
	<p>Vous utilisez la version <span class="version"><?php echo $data['99koVersion']; ?></span> de 99ko.<br />
    <a target="_blank" href="http://99ko.tuxfamily.org">Téléchargez</a> une version plus récente, des plugins et des thèmes sur le site de 99ko.</p>
    <script type="text/javascript">
    showTabs();
    </script>

</section>

<section id="config" onclick="closePlugins();openConfig()">
	<h3>Configuration</h3>
	<hr class="notop">

		<form id="configForm" method="post" action="index.php?action=saveconfig&opentab=config">
			<?php showMsg($data['msgConfig'], 'error'); ?>
			<?php showAdminTokenField(); ?>
			<p><label>Nom du site</label><br />
			<input type="text" name="siteName" value="<?php echo $data['configSiteName']; ?>" /></p>
			<p><label>Description du site</label><br />
			<input type="text" name="siteDescription" value="<?php echo $data['configSiteDescription']; ?>" /></p>
			<p><label>Email admin</label><br />
			<input type="text" name="adminEmail" value="<?php echo $data['configAdminEmail']; ?>" /></p>
			<p><label>Thème</label><br />
				<?php foreach($data['configThemes'] as $k=>$theme){ ?>
				<input type="radio" name="theme" <?php if($theme['selected']){ ?>checked<?php } ?> value="<?php echo $k; ?>" /> <?php echo $theme['name']; ?> <span class="infos">Par <?php echo $theme['author']; ?> : <?php echo $theme['authorEmail']; ?> <a href="<?php echo $theme['authorWebsite']; ?>" target="_blank"><?php echo $theme['authorWebsite']; ?></a></span><br />
				<?php } ?>
			</p>
			<p><label>Plugin par défaut</label><br />
			<select name="defaultPlugin">
				<?php foreach($data['plugins'] as $plug) if($plug['target'] && $plug['activate'] && $plug['frontFile']){ ?>
				<option <?php if($plug['isDefaultPlugin']){ ?>selected<?php } ?> value="<?php echo $plug['id']; ?>"><?php echo $plug['name']; ?></option>
				<?php } ?>
			</select></p>
			
			<p><label>URL du site</label><br />
			<input type="text" name="siteUrl" value="<?php echo $data['configSiteUrl']; ?>" /> (sans slash final)</p>
			<p><label>Nouveau mot de passe admin</label><br />
			<input type="password" name="adminPwd" value="" /> confirmation : <input type="password" name="adminPwd2" value="" /></p>
			<p><input type="submit" value="Enregistrer" /></p>
		</form>
</section>

<section id="plugins" onclick="closeConfig();openPlugins()">
	<h3>Plugins</h3>
	<hr class="notop">

		<form method="post" action="index.php?action=saveplugins&opentab=plugins" id="pluginsList">
			<?php showMsg($data['msgPlugins'], 'error'); ?>
			<?php showAdminTokenField(); ?>
			<table>
				<tr>
					<th>Nom</th>
					<th>Description</th>
					<th>Version</th>
					<th>Priorité</th>
					<th>Activer</th>
				</tr>
				<?php foreach($data['plugins'] as $plug){ ?>
				<tr>
					<td>
						<?php if($plug['target'] && $plug['activate']){ ?>
						<a href="<?php echo $plug['target']; ?>"><?php echo $plug['name']; ?></a>
						<?php } else{ 
						echo $plug['name'];
						} ?>
					</td>
					<td><?php echo $plug['description']; ?><br />
					<span class="infos">Par <?php echo $plug['author']; ?> : <?php echo $plug['authorEmail']; ?> <a href="<?php echo $plug['authorWebsite']; ?>" target="_blank"><?php echo $plug['authorWebsite']; ?></a></span></td>
					<td><?php echo $plug['version']; ?></td>
					<td><input class="priority" type="text" name="priority[<?php echo $plug['id']; ?>]" value="<?php echo $plug['priority']; ?>" /></td>
					<td><input <?php if($plug['isDefaultPlugin']){ ?>style="display:none;"<?php } ?> <?php if($plug['activate']){ ?>checked<?php } ?> type="checkbox" name="activate[<?php echo $plug['id']; ?>]" /></td>
				</tr>
				<?php } ?>
			</table>
			<p><input type="submit" value="Enregistrer" /></p>
		</form>
</section>

<section id="<?php echo $plug['id']; ?>" onclick="closePlugins();closeConfig();">
	<h3><?php echo $data['mainTabTitle']; ?></h3>
	<hr class="notop">