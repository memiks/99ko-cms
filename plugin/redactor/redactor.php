<?php
if(!defined('ROOT')) die();

function redactorInstall(){}

function redactorInclude(){
	$temp = "include(ROOT.'plugin/redactor/other/include.php');";
	return $temp;
}
?>