<?php include('header.php'); ?>

<h1><?php echo lang('Management articles'); ?></h1>
<?php if($edit){ ?>
<form method="post" action="admin.php?p=article">
	<input type="hidden" name="id" value="<?php echo $article->get('id'); ?>" />
        <input type="hidden" name="type" value="<?php echo $article->get('type'); ?>" />
	<p>
		<label><?php echo lang('Title'); ?></label><br>
		<input type="text" name="name" value="<?php echo $article->get('name'); ?>" />
	</p>
	<p>
		<label><?php echo lang('Content'); ?></label><br>
		<textarea name="content"><?php echo $article->get('content'); ?></textarea>
	</p>
	<p>
		<label><?php echo lang('Homepage'); ?> ?</label><br>
		<select name="homepage">
			<option value="0"><?php echo lang('No'); ?></option>
			<option <?php if($article->get('homepage')){ ?>selected<?php } ?> value="1"><?php echo lang('Yes'); ?></option>
		</select>
	</p>
	<p><input type="submit" value="<?php echo lang('Save'); ?>" /></p>
</form>
<?php } else{ ?>
<form name="article" method="post" action="admin.php?p=article&edit=0">
	<p>
		<select name="type" onchange="document.forms['article'].submit();">
			<option value=""><?php echo lang('Add article'); ?>...</option>
                        <option value="page"><?php echo lang('Page'); ?></option>
			<option value="news"><?php echo lang('News'); ?></option>
		</select>
	</p>
	<ul>
                <li>Pages
                <ul>
		<?php foreach($pages as $article){ ?>
		<li><?php echo $article->get('name'); ?> <a href="admin.php?p=article&edit=<?php echo $article->get('id'); ?>"><?php echo lang('Edit'); ?></a> <a href="admin.php?p=article&del=<?php echo $article->get('id'); ?>"><?php echo lang('Delete'); ?></a></li>
		<?php } ?>
                </ul></li>
                <li>News
                <ul>
		<?php foreach($news as $article){ ?>
		<li><?php echo $article->get('name'); ?> <a href="admin.php?p=article&edit=<?php echo $article->get('id'); ?>"><?php echo lang('Edit'); ?></a> <a href="admin.php?p=article&del=<?php echo $article->get('id'); ?>"><?php echo lang('Delete'); ?></a></li>
		<?php } ?>
                </ul></li>
	</ul>
</form>
<?php } ?>

<?php include('footer.php'); ?>