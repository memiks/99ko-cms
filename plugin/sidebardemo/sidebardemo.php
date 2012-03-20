<?php
if(!defined('ROOT')) die();

/*******************************************************************************************************
** Partie obligatoire
** Les fonctions ci-dessous sont obligatoires !
** Les fonctions ci-dessous doivent être nommées de cette façon : nomdupluginConfig, nomdupluginInfos...
*******************************************************************************************************/

/*
** Retourne la configuration par défaut du plugin
** @return : array
*/
function sidebardemoConfig(){
	return array(
		'priority' => 2, // Obligatoire
		'activate' => 1, // Obligatoire
                'sidebarTitle' => "Hello world", // Facultatif
                'sidebarCallFunction' => "sidebardemoGetSidebarContent", // Facultatif
		// Ajoutez ci-dessous vos propres valeurs...
	);
}

/*
** Retourne les informations relatives au plugin
** @return : array
*/
function sidebardemoInfos(){
	return array(
		// Toute les valeurs sont obligatoires
		'name' => 'Sidebar Demo',
		'description' => "Plugin de démonstration d'utilisation de la sidebar",
		'author' => 'Jonathan Coulet',
		'authorEmail' => 'j.coulet@gmail.com',
		'authorWebsite' => 'http://99ko.tuxfamily.org',
		'version' => '1.0'
	);
}

/*
** Retourne les hooks à exécuter
** @return : array
*/
function sidebardemoHooks(){
	// si votre plugin n'utilise pas de hooks un array vide doit être retourné
	return array();	
}

/*
** Exécute du code lors de l'installation
** Le code présent dans cette fonction sera exécuté lors de l'installation
** Le contenu de cette fonction est facultatif
*/
function sidebardemoInstall(){
}

/********************************************************************************************************************
** Code relatif au plugin
** La partie ci-dessous est réservé au code du plugin 
** Elle peut contenir des classes, des fonctions, hooks... ou encore du code à exécutter lors du chargement du plugin
********************************************************************************************************************/

function sidebardemoGetSidebarContent(){
    $output = "<p>Ceci est un test d'utilisation de la sidebar.</p>";
    return $output;
}
?>