<?php include('header.php'); ?>

<h1><?php echo lang('Management menu'); ?></h1>
<?php if($edit){ ?>
<form method="post" action="admin.php?p=menu">
	<p>
		<label><?php echo lang('Label'); ?></label><br>
		<input type="text" name="name" value="<?php echo $item->get('name'); ?>" />
	</p>
	<p>
		<label><?php echo lang('URL'); ?></label><br>
		<input type="text" name="url" value="<?php echo $item->get('url'); ?>" />
	</p>
	<p>
		<label><?php echo lang('Parent'); ?></label><br>
		<select name="idParent">
			<option value="0"><?php echo lang('None'); ?></option>
			<?php foreach($itemsLevel1 as $item2) if($item2->get('idParent') == 0){ ?>
			<option <?php if($item->get('idParent') == $item2->get('id')){ ?>selected<?php } ?> value="<?php echo $item2->get('id'); ?>"><?php echo $item2->get('name'); ?></option>
			<?php } ?>
		</select>
	</p>
</form>
<?php } else{ ?>
<form name="menu" method="post" action="admin.php?p=menu&edit=0">
	<p>
		<select name="url" onchange="document.forms['menu'].submit();">
			<option value=""><?php echo lang('Add item to'); ?>...</option>
			<option value="?news"><?php echo lang('News'); ?></option>
			<?php foreach($articles as $article){ ?>
			<option value="?article=<?php echo $article->get('id'); ?>"><?php echo $article->get('name'); ?></option>
			<?php } ?>
		</select>
	</p>
	<ul>
		<?php foreach($itemsLevel1 as $item){ ?>
		<?php if($item->get('idParent') == 0){ ?>
		<li><?php echo $item->get('name'); ?> <a href="admin.php?p=menu&up=<?php echo $item->get('id'); ?>">up</a> <a href="admin.php?p=menu&down=<?php echo $item->get('id'); ?>">down</a> <a href="admin.php?p=menu&edit=<?php echo $item->get('id'); ?>"><?php echo lang('Edit'); ?></a></li>
		<?php } ?>
		<ul>
			<?php foreach($itemsLevel2[$item->get('id')] as $item2){ ?>
			<li><?php echo $item2->get('name'); ?> <a href="admin.php?p=menu&up=<?php echo $item2->get('id'); ?>">up</a> <a href="admin.php?p=menu&down=<?php echo $item2->get('id'); ?>">down</a> <a href="admin.php?p=menu&edit=<?php echo $item2->get('id'); ?>"><?php echo lang('Edit'); ?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>
	</ul>
</form>
<?php } ?>

<?php include('footer.php'); ?>