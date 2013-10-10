<form method="post" action="index.php?p=page&action=saveconfig">
	<?php showAdminTokenField(); ?>
	<p><input <?php if($hideTitles){ ?>checked<?php } ?> type="checkbox" name="hideTitles" /> <?php echo lang("Hide pages titles"); ?><br />
	<p><input type="submit" value="<?php echo lang("Save"); ?>" /></p>
</form>