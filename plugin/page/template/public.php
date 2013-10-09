<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/header.php') ?>
<?php
if($data['pageFile']) include_once($data['pageFile']);
else echo $data['pageContent'];
?>
<?php if($hideTitles){ ?>
<script type="text/javascript">
    $(".page h1").hide();
</script>
<?php } ?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/footer.php') ?>