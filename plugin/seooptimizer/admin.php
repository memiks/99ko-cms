<?php
if(!defined('ROOT')) die();

switch(ACTION){
    case 'save':
        $runPlugin->setConfigVal('metaTitle', $_POST['metaTitle']);
        $runPlugin->setConfigVal('metaDescription', $_POST['metaDescription']);
        $runPlugin->setConfigVal('analyticsId', $_POST['analyticsId']);
        $runPlugin->setConfigVal('gWebId', $_POST['gWebId']);
        $pluginsManager->savePluginConfig($runPlugin);
        header('location:index.php?p=seooptimizer');
	die();
        break;
    default:
        $metaTitle = $runPlugin->getConfigVal('metaTitle');
        $metaDescription = $runPlugin->getConfigVal('metaDescription');
        $analyticsId = $runPlugin->getConfigVal('analyticsId');
        $gWebId = $runPlugin->getConfigVal('gWebId');
	if($metaTitle == ''){
	    $msg1 = "Balise meta Title : Le contenu n'est pas renseigné";
	    $msg1Type = "error";
	}
	else{
	    $msg1 = "Balise meta Title : Aucun problème détecté";
	    $msg1Type = "success";
	}
	if($metaDescription == ''){
	    $msg2 = "Balise meta Description : Le contenu n'est pas renseigné";
	    $msg2Type = "error";
	}
	else{
	    $msg2 = "Balise meta Description : Aucun problème détecté";
	    $msg2Type = "success";
	}
	if($analyticsId == ''){
	    $msg3 = "Identifiant Analytics : Le contenu n'est pas renseigné";
	    $msg3Type = "error";
	}
	else{
	    $msg3 = "Identifiant Analytics : Aucun problème détecté";
	    $msg3Type = "success";
	}
	if($gWebId == ''){
	    $msg4 = "Identifiant Google Webmaster : Le contenu n'est pas renseigné";
	    $msg4Type = "error";
	}
	else{
	    $msg4 = "Identifiant Google Webmaster : Aucun problème détecté";
	    $msg4Type = "success";
	}
        break;
}

?>