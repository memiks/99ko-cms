<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2012 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com) / FrŽdŽric Kaplon
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
	
	// DEV CACHE
	if(getCoreConf('useCache') == 1){
		$cacheFile = $runPlugin->getName().'-';
		foreach($urlParams as $k=>$v) $cacheFile.= $k.'-'.$v.'-';
		$cacheFile = trim($cacheFile, '-');
		if(file_exists('data/cache/'.$cacheFile) && ((time() - 60*15) < filemtime('data/cache/'.$cacheFile))){
			include 'data/cache/'.$cacheFile;
			exit();
		}
		ob_start();
	}

	include($runPlugin->getFrontFile());
	include($runPlugin->getPublicTemplate());
	
	// DEV CACHE
	if(getCoreConf('useCache') == 1){
		file_put_contents('data/cache/'.$cacheFile, ob_get_contents());
	}
	
}
// hook
eval(callHook('endFrontIncludePluginFile'));
?>