<?php include('header.php'); ?>

<h1><?php echo lang('General configuration'); ?></h1>
<form method="post" action="">
    <p>
        <label><?php echo lang('Website name'); ?></label><br>
        <input type="text" name="name" value="<?php echo $name; ?>" />
    </p>
    <p>
        <label><?php echo lang('Website URL'); ?></label><br>
        <input type="text" name="url" value="<?php echo $url; ?>" />
    </p>
    <p>
        <label><?php echo lang('Website lang'); ?></label><br>
        <select name="lang">
            <?php foreach($langs as $k=>$v){ ?>
            <option <?php if($lang == $k){ ?>selected<?php } ?> value="<?php echo $k; ?>"><?php echo $k; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label><?php echo lang('Theme'); ?></label><br>
        <select name="theme">
            <option value="default">default</option>
        </select>
    </p>
    <p>
        <input type="submit" value="<?php echo lang('Save'); ?>" />
    </p>
</form>

<?php include('footer.php'); ?>