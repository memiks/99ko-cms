<?php include_once(ROOT.'admin/header.php') ?>
	<?php showMsg($msg, 'error'); ?>
	<p><?php echo lang('You are using the version'); ?> <span class="version"><?php echo $version; ?></span><br />
        <?php echo lang('Download a more recent version, plugins and themes on the site official.'); ?><br />
	<?php echo lang('In case of problem with 99ko, go to the support forum.'); ?></p>
	<p><a class="btn" href="http://99ko.tuxfamily.org" target="_blank"><?php echo lang('Official site'); ?></a> <a class="btn" href="http://99ko.tuxfamily.org/forum" target="_blank"><?php echo lang('Board support'); ?></a></p>
<?php include_once(ROOT.'admin/footer.php') ?>