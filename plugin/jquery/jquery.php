<?php
########## fonctions requises (obligatoires)

// retourne la configuration du plugin
function jquery_config(){
    $config = array(
        'name' => 'jQuery',
        'version' => '1.0',
        'author' => 'http://99ko.tuxfamily.org',
        'priority' => 2,
    );
    return $config;
}

// installe le plugin (le contenu de cette fonction est optionnel)
function jquery_install(){
	if(!file_exists('data/plugin/jquery.json')){
		utilWriteJsonFile('data/plugin/jquery.json', array('src' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'));
	}
}

########## hooks (optionnels)

function jquery_themeHead(){
	$temp = utilReadJsonFile('data/plugin/jquery.json');
    $data = "echo '<script type=\"text/javascript\" src=\"$temp[src]\"></script>';";
    return $data;
}

function jquery_adminHead(){
	$temp = utilReadJsonFile('data/plugin/jquery.json');
    $data = "echo '<script type=\"text/javascript\" src=\"$temp[src]\"></script>';";
    return $data;
}

addHook('jquery_themeHead');
addHook('jquery_adminHead');
?>