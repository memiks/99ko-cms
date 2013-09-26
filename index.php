<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2013 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com) / Frdric Kaplon
# Copyright (c) 2010-2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# Copyright (c) 2010 Jonathan Coulet (j.coulet@gmail.com)
##########################################################################################################

$time = microtime(true);
// on declare ROOT
define('ROOT', './');
// on inclu le fichier common
include_once(ROOT.'common/common.php');
// hook
eval(callHook('startFrontIncludePluginFile'));
// on inclu les fichiers du plugin courant
if($runPlugin->getFrontFile()){
	include($runPlugin->getFrontFile());
	include($runPlugin->getPublicTemplate());
	// Cache
	if(getCoreConf('useCache') == 1 && !$readCache){
		$buffer = preg_replace(array('/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'), array(' ', ''), ob_get_contents());
		file_put_contents('data/cache/'.$cacheFile, $buffer);
	}
}
// hook
eval(callHook('endFrontIncludePluginFile'));
?>