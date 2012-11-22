<?php
# ----------------------- BEGIN LICENSE BLOCK -----------------------
#
# Project is a Fork on Goolog: https://github.com/taylorchu/goolog
# This file is part of 1ClickEdit : http://1clickedit.org/
#
# Copyright © 2011-2012 Frédéric Kaplon and contributors
#
# ------------------------ END LICENSE BLOCK ------------------------
$out['self'] = 'upload';
require '../../header.php';

$plugin = 'redactor';
$data = readEntry('plugin', $plugin);


# Upload Image
if(isGET('image'))
{
    $dir = $data['upload_pic'];
 
    $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
 
    if ($_FILES['file']['type'] == 'image/png' 
    || $_FILES['file']['type'] == 'image/jpg' 
    || $_FILES['file']['type'] == 'image/gif' 
    || $_FILES['file']['type'] == 'image/jpeg'
    || $_FILES['file']['type'] == 'image/pjpeg')
    {	
    	// даем файлу загадочное имя
    	$file = $dir.md5(date('YmdHis')).'.jpg'; 
    	// копируем
    	copy($_FILES['file']['tmp_name'], $file);	
    	// отображаем файл
    	echo '<img src="/tmp/images/'.$file.'" />';
    }
} 
# Upload Image link
else if(isGET('link'))
{

} 
# Upload File
else if(isGET('file'))
{
    copy($_FILES['file']['tmp_name'], '/files/'.$_FILES['file']['name']);				
    echo '<a href="/files/'.$_FILES['file']['name'].'">'.$_FILES['file']['name'].'</a>';
} 
?>