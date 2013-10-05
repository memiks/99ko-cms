<?php include('header.php'); ?>

<h1><?php echo lang('Management menu'); ?></h1>
<form method="post" action="">
	<ul>
		<?php foreach($itemsLevel1 as $item){ ?>
		<?php if($item->get('idParent') == 0){ ?>
		<li><?php echo $item->get('name'); ?> <a href="admin.php?p=menu&up=<?php echo $item->get('id'); ?>">up</a> <a href="admin.php?p=menu&down=<?php echo $item->get('id'); ?>">down</a></li>
		<?php } ?>
		<ul>
			<?php foreach($itemsLevel2[$item->get('id')] as $item2){ ?>
			<li><?php echo $item2->get('name'); ?> <a href="admin.php?p=menu&up=<?php echo $item->get('id'); ?>">up</a> <a href="admin.php?p=menu&down=<?php echo $item->get('id'); ?>">down</a></li>
			<?php } ?>
		</ul>
		<?php } ?>
	</ul>
</form>

<?php include('footer.php'); ?>