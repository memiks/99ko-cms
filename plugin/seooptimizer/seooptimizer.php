<?php
if(!defined('ROOT')) die();

function seooptimizerInstall(){
}

function seooptimizerShowTitleTag(){
    global $urlParams, $pluginsManager, $runPlugin;
    if($runPlugin->getIsDefaultPlugin() && (count($urlParams) == 0 || $urlParams[0] == '')){
        $temp = $pluginsManager->getPlugin('seooptimizer')->getConfigVal('metaTitle');
        if($temp != '') return '$data = "'.$temp.'";';
    }
}

function seooptimizerShowMetaDescriptionTag(){
    global $urlParams, $pluginsManager, $runPlugin;
    if($runPlugin->getIsDefaultPlugin() && (count($urlParams) == 0 || $urlParams[0] == '')){
        $temp = $pluginsManager->getPlugin('seooptimizer')->getConfigVal('metaDescription');
        if($temp != '') return '$data = "'.$temp.'";';
    }
}

function seooptimizerEndFrontHead(){
    global $pluginsManager;
    $temp = $pluginsManager->getPlugin('seooptimizer')->getConfigVal('analyticsId');
    if($temp != ''){
        echo "
        <script type='text/javascript'>
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '".$temp."']);
          _gaq.push(['_trackPageview']);
          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>";
    }
    $temp = $pluginsManager->getPlugin('seooptimizer')->getConfigVal('gWebId');
    if($temp != '') echo '<meta name="google-site-verification" content="'.$temp.'" />';
}
?>