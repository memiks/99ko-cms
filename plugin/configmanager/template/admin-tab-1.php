    <?php if(!defined('ROOT')) die(); ?>
    <?php showMsg(lang("Do not change advanced settings if you're not on what you're doing."), "error"); ?>
    <p><label><?php echo lang("URL of the site (no trailing slash)"); ?></label><br />
    <input type="text" name="siteUrl" value="<?php echo $config['siteUrl']; ?>" /></p>
    <p><label>URL rewriting</label><br />
    <input id="urlRewriting" type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($config['urlRewriting']){ ?>checked<?php } ?> name="urlRewriting" /> <?php echo lang("Enable"); ?>
    </p>
    <p><label>.htaccess</label><br />
    <textarea id="htaccess" name="htaccess"><?php echo $htaccess; ?></textarea>
    </p>
    <p><input type="submit" value="<?php echo lang("Save"); ?>" /></p>
</form>