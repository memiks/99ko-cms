<?php

session_start();

if ((!isset($_SESSION['captcha'])) || ($_SESSION['captcha']=='')) {
	$ops = array('+', '-', '*');
  
  srand();
  
  $op = $ops[mt_rand(0,2)];
	
	switch($op) {
		case '+':
			$leftop = mt_rand(1, 20);
			$rightop = mt_rand(1, 20);
			$_SESSION['captcha'] = $leftop+$rightop;
			break;
		case '-':
			$leftop = mt_rand(10, 20);
			$rightop = mt_rand(1, 9);
			$_SESSION['captcha'] = $leftop-$rightop;
			break;
		case '*':
			$leftop = mt_rand(1, 9);
			$rightop = mt_rand(1, 9);
			$_SESSION['captcha'] = $leftop*$rightop;
			break;
		default:
			echo 'Error : Unknown operation';
			die();
			break;
	}
  
  $_SESSION['question'] = $leftop.' '.$op.' '.$rightop.' = ';
}

echo $_SESSION['question'];

?>

