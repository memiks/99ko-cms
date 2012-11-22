<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/header.php') ?>

<?php foreach($news as $k=>$v){ ?>
<div class="post">
	<h1 class="title"><?php echo $v['name']; ?></h1>
	<span class="meta">
		<span class="date">Le <?php echo $v['date']; ?></span>
		<!--span class="author"></span>
		<span class="comment-count"></span-->
	</span>	
	<p><?php echo $v['content']; ?></p>
</div>
<?php } ?>

<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/footer.php') ?>