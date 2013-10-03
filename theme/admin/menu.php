<?php include('header.php'); ?>

<h1><?php echo lang('Management menu'); ?></h1>
<form method="post" action="">
	<ul>
		<?php foreach($items as $item){ ?>
		<!-- niveau 1 -->
		<?php if($item->get('idParent') == 0){ ?><li><?php echo $item->get('name'); ?></li><?php } ?>
		<ul>
			<!-- niveau 2 -->
			<?php foreach($items as $k2=>$item2) if($item->get('idParent') == $item2->get('id')){ ?>
			<li><?php echo $item->get('name'); ?></li>
			<?php } ?>
			<!-- // niveau 2 -->
		</ul>
		<!-- // niveau 1 -->
		<?php } ?>
	</ul>
</form>

<?php include('footer.php'); ?>