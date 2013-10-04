<?php include('header.php'); ?>

<?php foreach($newsList as $news){ ?>
<h2><?php echo $news->get('name'); ?></h2>
<?php echo $news->get('content'); ?>
<p><?php echo $news->get('date'); ?></p>
<?php } ?>

<?php include('footer.php'); ?>