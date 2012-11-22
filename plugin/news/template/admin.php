<?php if(!defined('ROOT')) die();
include_once(ROOT.'admin/header.php') ?>

<?php if($mode == 'list'){ ?>
<p><a class="btn" href="index.php?p=news&action=edit">Ajouter</a></p>
<?php echo $table; ?>
<?php } ?>

<?php if($mode == 'edit'){ ?>
<form method="post" action="index.php?p=news&action=save">
	<?php showAdminTokenField(); ?>
	<input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
	<p><label>Titre</label><br />
	<input type="text" name="name" value="<?php echo $news['name']; ?>" /></p>
	<p><label>Contenu</label><br />
	<?php showAdminEditor('content', $news['content'], '600', '400'); ?></p>
	<p><input type="submit" value="Enregistrer" /></p>
</form>
<?php } ?>

<?php include_once(ROOT.'admin/footer.php') ?>