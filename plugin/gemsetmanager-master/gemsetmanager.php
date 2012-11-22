<?php
if(!defined('ROOT')) die();

/*
** Exécute du code lors de l'installation
** Le code présent dans cette fonction sera exécuté lors de l'installation
** Le contenu de cette fonction est facultatif
*/
function gemsetmanagerInstall(){
}

/********************************************************************************************************************
** Code relatif au plugin
** La partie ci-dessous est réservé au code du plugin 
** Elle peut contenir des classes, des fonctions, hooks... ou encore du code à exécutter lors du chargement du plugin
********************************************************************************************************************/


/*
** Efface un répertoire
*/
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

$allplugins = json_decode(@file_get_contents(ROOT.'/plugin/gemsetmanager/param/allplugins.json'), true);
foreach($allplugins as $value){
	$data['allplugins'][strtolower($value['name'])] = $value;
	$data['allplugins'][strtolower($value['name'])]['id'] = strtolower($value['name']);
}

$gemsetmanager = new gemsetmanager();

class gemsetmanager {

	public function __construct(){}

	/*
	** Donwload with curl or file_get_content
	*/
	public function download ($ziptmp , $url){
	    if (ini_get('allow_url_fopen') == '1'){
	    	if (file_put_contents($ziptmp,file_get_contents($url))){
	    		return true;
	    	}
	    	else {
	    		return false;
	    	}
	    } elseif (in_array ('curl', get_loaded_extensions())){
		      $ch = curl_init($url);
    		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 			  $data = curl_exec($ch);
 	          curl_close($ch);
 			  if (file_put_contents($ziptmp, $data)){
 			  	return true;
 			  }
	    }
	    else {
	    	return false;
	    }

	}
}

?>