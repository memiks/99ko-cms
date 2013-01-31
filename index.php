<?php
##########################################################################################################
# 99ko http://99ko.tuxfamily.org/
#
# Copyright (c) 2012-2013 Florent Fortat (florent.fortat@maxgun.fr) / Jonathan Coulet (j.coulet@gmail.com)
# / Frédéric Kaplon (frederic@kaplon.fr)
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
}
// hook
eval(callHook('endFrontIncludePluginFile'));
?>