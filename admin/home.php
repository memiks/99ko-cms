<?php include_once(ROOT.'admin/header.php') ?>


	<?php showMsg($msg, 'error'); ?>
	<p>99Ko v. <?php echo $version; ?></p>
    <p><?php $translate->__('Download a more recent version, plugins and themes on the site official.<br />In case of problem with 99ko, go to the support forum.'); ?></p>
	<p><a class="btn" href="http://99ko.tuxfamily.org" target="_blank"><?php $translate->__('Official site'); ?></a> <a class="btn" href="http://99ko.tuxfamily.org/forum" target="_blank"><?php $translate->__('Board'); ?></a></p>


<?php include_once(ROOT.'admin/footer.php') ?>
