<?php
if(isset($_POST['src'])){
	utilWriteJsonFile('data/plugin/jquery.json', array('src' => $_POST['src']));
}
$temp = utilReadJsonFile('data/plugin/jquery.json');
$src = $temp['src'];
?>

<?php include('theme/admin/header.php'); ?>

<h1>jQuery</h1>
<form method="post" action="">
	<p>
		<label><?php echo lang('Source'); ?></label><br>
		<input type="text" name="src" value="<?php echo $src; ?>" />
	</p>
	<p><input type="submit" value="<?php echo lang('Save'); ?>" /></p>
</form>

<?php include('theme/admin/footer.php'); ?>