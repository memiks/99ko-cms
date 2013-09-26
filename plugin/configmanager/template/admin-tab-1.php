    <?php if(!defined('ROOT')) die(); ?>
    <?php showMsg("Ne modifiez pas les paramètres avancés si vous n'êtes pas sur de ce que vous faites. ", "error"); ?>
    <p><label>URL du site (sans slash final)</label><br />
    <input type="text" name="siteUrl" value="<?php echo $config['siteUrl']; ?>" /></p>
    <p><label>Réécriture d'URL</label><br />
    <input id="urlRewriting" type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($config['urlRewriting']){ ?>checked<?php } ?> name="urlRewriting" /> Activer
    </p>
    <p><label>.htaccess</label><br />
    <textarea id="htaccess" name="htaccess"><?php echo $htaccess; ?></textarea>
    </p>
    <p><label>Cache HTML (bêta)</label><br />
    <input type="checkbox" <?php if($config['useCache']){ ?>checked<?php } ?> name="useCache" /> Activer
    </p>
    <p><input type="submit" value="Enregistrer" /></p>
</form>