<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'admin/header.php') ?>
<?php if($data['pageMode'] == 'list'){ ?>
<?php showMsg($data['pageMsg'], $data['pageMsgType']); ?>
<p><a class="btn" href="index.php?p=page&action=edit">Ajouter</a></p>
<table>
	<tr>
		<th>Nom</th>
		<th>Adresse</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($data['pageList'] as $pageItem){ ?>
	<tr>
		<td><?php echo $pageItem['name']; ?></td>
		<td><?php echo $data['configSiteUrl']; ?>/index.php?p=page&id=<?php echo $pageItem['id']; ?></td>
		<td><?php if($pageItem['isHomepage']){ ?><img src="../plugin/page/house.png" alt="icon" title="Page d'accueil" /><?php } ?> <?php if($pageItem['isHidden']){ ?><img src="../plugin/page/bullet_orange.png" alt="icon" title="Cette page n'apparait pas dans le menu" /> <?php } ?></td>
		<td>
			<a class="edit-btn" href="index.php?p=page&action=edit&id=<?php echo $pageItem['id']; ?>">editer</a>
			<?php if(!$pageItem['isHomepage']){ ?> <a class="del-btn" href="index.php?p=page&action=del&id=<?php echo $pageItem['id']; ?>&token=<?php echo $data['token']; ?>" onclick = "if(!confirm('Supprimer cette page ?')) return false;">supprimer</a><?php } ?>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } elseif($data['pageMode'] == 'edit'){ ?>
<form method="post" action="index.php?p=page&action=save">
	<?php showAdminTokenField(); ?>
	<input type="hidden" name="id" value="<?php echo $data['pageId']; ?>" />
	<p><label>Nom</label><br />
	<input type="text" name="name" value="<?php echo $data['pageName']; ?>" /></p>
	<p><label>Titre de la page (facultatif)</label><br />
	<input type="text" name="mainTitle" value="<?php echo $data['pageMainTitle']; ?>" /></p>
	<p><label>Balise meta description (facultatif)</label><br />
	<input type="text" name="metaDescriptionTag" value="<?php echo $data['pageMetaDescriptionTag']; ?>" /></p>
	<p><label>Position du lien dans la navigation</label><br />
	<input type="text" name="position" value="<?php echo $data['pagePosition']; ?>" /></p>
	<p><input <?php echo $data['pageIsHomepageChecked']; ?> type="checkbox" name="isHomepage" /> Utiliser comme page d'accueil<br />
	<input <?php if($data['pageIsHidden']){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> Ne pas afficher de lien vers cette page dans le menu</p>
	<p><label>Contenu</label><br />
	<?php showAdminEditor('content', $data['pageContent'], '600', '400'); ?></p>
	<p><label>Inclure un fichier à la place du contenu</label><br />
		./theme/<?php echo $data['pageTheme']; ?>/ <select name="file">
			<option value="">--</option>
			<?php foreach($data['pageFiles'] as $file){ ?>
			<option <?php if($file == $data['pageFile']){ ?>selected<?php } ?> value="<?php echo $file; ?>"><?php echo $file; ?></option>
			<?php } ?>
		</select>
	</p>
	<p><input type="submit" value="Enregistrer" /></p>
</form>
<?php } ?>
<?php include_once(ROOT.'admin/footer.php') ?>
