<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/header.php') ?>
<?php
if($data['pageFile']) include_once($data['pageFile']);
else echo $data['pageContent'];
?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/footer.php') ?>
