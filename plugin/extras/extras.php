<?php
if(!defined('ROOT')) die();

/*
** Exécute du code lors de l'installation
** Le code présent dans cette fonction sera exécuté lors de l'installation
** Le contenu de cette fonction est facultatif
*/
function extrasInstall(){
}

/********************************************************************************************************************
** Code relatif au plugin
** La partie ci-dessous est réservé au code du plugin 
** Elle peut contenir des classes, des fonctions, hooks... ou encore du code à exécutter lors du chargement du plugin
********************************************************************************************************************/

function extrasStartShowLinkTags(){
    $temp = "\$data.= str_replace('[file]', ROOT.'plugin/extras/other/normalize.css', \$format);";
    $temp.= "\$data.= str_replace('[file]', ROOT.'plugin/extras/other/tinybox2/style.css', \$format);";
    return $temp;
}

function extrasStartShowScriptTags(){
    $temp = "\$data.= str_replace('[file]', ROOT.'plugin/extras/other/html5.js', \$format);";
    $temp.= "\$data.= str_replace('[file]', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', \$format);";
    $temp.= "\$data.= str_replace('[file]', ROOT.'plugin/extras/other/tinybox2/packed.js', \$format);";
    return $temp;
}
?>