<?php if($data['pageMode'] == 'list'){ ?>
<?php showMsg($data['pageMsg'], $data['pageMsgType']); ?>
<p><a class="btn" href="index.php?p=page&action=edit"><?php echo lang("Add"); ?></a></p>
<table class="table table-striped table-condensed">
  <thead>
	<tr>
		<th></th>
		<th><?php echo lang("Name"); ?></th>
		<th>URL</th>
		<th><?php echo lang("Actions"); ?></th>
	</tr>
  </thead>
  <tbody>
	<?php foreach($data['pageList'] as $pageItem){ ?>
	<tr>
		<td><?php if($pageItem['isHomepage']){ ?><img src="../plugin/page/other/house.png" alt="icon" title="<?php echo lang("Homepage"); ?>" /><?php } ?> <?php if($pageItem['isHidden']){ ?><img src="../plugin/page/other/bullet_orange.png" alt="icon" title="Cette page n'apparait pas dans le menu" /> <?php } ?></td>
		<td><?php echo $pageItem['name']; ?></td>
		<td><input type="text" value="<?php echo $coreConf['siteUrl']; ?>/<?php echo rewriteUrl('page', array('name' => $pageItem['name'], 'id' => $pageItem['id'])); ?>" /></td>
		<td>
			<a class="edit-btn" href="javascript:TINY.box.show({iframe:'<?php echo $coreConf['siteUrl']; ?>/<?php echo rewriteUrl('page', array('name' => $pageItem['name'], 'id' => $pageItem['id'])); ?>',width:990,height:450})"><?php echo lang("Preview"); ?></a>
			<a class="edit-btn" href="index.php?p=page&action=edit&id=<?php echo $pageItem['id']; ?>"><?php echo lang("Edit"); ?></a>
			<?php if(!$pageItem['isHomepage']){ ?> <a class="del-btn" href="index.php?p=page&action=del&id=<?php echo $pageItem['id']; ?>&token=<?php echo $data['token']; ?>" onclick = "if(!confirm('<?php echo lang("Delete this page ?"); ?>')) return false;"><?php echo lang("Delete"); ?></a><?php } ?>
		</td>
	</tr>
	<?php } ?>
  </tbody>
</table>
<?php } elseif($data['pageMode'] == 'edit'){ ?>
<form method="post" action="index.php?p=page&action=save">
	<?php showAdminTokenField(); ?>
	<input type="hidden" name="id" value="<?php echo $data['pageId']; ?>" />
	<p><label><?php echo lang("Name"); ?></label><br />
	<input type="text" name="name" value="<?php echo $data['pageName']; ?>" /></p>
	<p><label><?php echo lang("Page title (optional)"); ?></label><br />
	<input type="text" name="mainTitle" value="<?php echo $data['pageMainTitle']; ?>" /></p>
	<p><label><?php echo lang("Meta description tag (optional)"); ?></label><br />
	<input type="text" name="metaDescriptionTag" value="<?php echo $data['pageMetaDescriptionTag']; ?>" /></p>
	<?php if($data['pageChangeOrder']){ ?>
	<p><label><?php echo lang("link position on the menu"); ?></label><br />
	<input class="small" type="text" name="position" value="<?php echo $data['pagePosition']; ?>" /></p>
	<?php } ?>
	<p><input <?php echo $data['pageIsHomepageChecked']; ?> type="checkbox" name="isHomepage" /> <?php echo lang("use as homepage"); ?><br />
	<input <?php if($data['pageIsHidden']){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <?php echo lang("Don't display in the menu"); ?></p>
	<p><label><?php echo lang("Content"); ?></label><br />
	<?php showAdminEditor('content', $data['pageContent'], '600', '400'); ?></p>
	<p><label><?php echo lang('Include a file instead of content (must be present in %s theme\'s folder)', 'page', $data['pageTheme']); ?></label><br />
		<select name="file">
			<option value="">--</option>
			<?php foreach($data['pageFiles'] as $file){ ?>
			<option <?php if($file == $data['pageFile']){ ?>selected<?php } ?> value="<?php echo $file; ?>"><?php echo $file; ?></option>
			<?php } ?>
		</select>
	</p>
	<p><input type="submit" value="<?php echo lang("Save"); ?>" /></p>
</form>
<?php } ?>