<?php if(!defined('ROOT')) die(); ?>
<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/header.php') ?>

<?php if($mode == 'list'){ ?>
<?php foreach($news as $k=>$v){ ?>
<div class="item">
	<h2><?php echo $v['name']; ?></h2>
	<p class="date"><?php echo $v['date']; ?></p>
	<?php echo $v['content']; ?>
	<p><a href="<?php echo $v['url']; ?>">Lire</a></p>
</div>
<?php } ?>
<ul class="pagination">
	<?php foreach($pagination as $k=>$v){ ?>
	<li><a href="<?php echo $v['url']; ?>"><?php echo $v['num']; ?></a></li>
	<?php } ?>
</ul>
<?php } ?>

<?php if($mode == 'read'){ ?>
<div class="item">
	<p class="date"><?php echo $news['date']; ?></p>
	<?php echo $news['content']; ?>
</div>
<?php } ?>

<?php include_once(ROOT.'theme/'.$coreConf['theme'].'/footer.php') ?>