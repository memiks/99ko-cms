<?php include_once(ROOT.'admin/header.php') ?>


	<?php showMsg($msg, 'error'); ?>
	<p><?php echo lang('Version %s', $version); ?></p>
    <p><?php echo $lang['99koInfos']; ?></p>
	<p><a class="btn" href="http://99ko.tuxfamily.org" target="_blank"><?php echo $lang['OfficialSite']; ?></a> <a class="btn" href="http://99ko.tuxfamily.org/forum" target="_blank"><?php echo $lang['Board']; ?></a></p>


<?php include_once(ROOT.'admin/footer.php') ?>
