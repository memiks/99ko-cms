<?php if (pluginsManager::getPluginConfVal('captcha', 'method') == 'image') { ?>
	<p id="form-captcha"><img src="plugin/captcha/template/image.php" /> <input type="text" name="captcha" /></p>
<?php } else if (pluginsManager::getPluginConfVal('captcha', 'method') == 'question') { ?>
	<p id="form-captcha"><?php include("question.php"); ?> <input type="text" name="captcha" /></p>
<?php } ?>
