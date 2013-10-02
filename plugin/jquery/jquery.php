<?php
function jquery_config(){
    $config = array(
        'name' => 'jQuery',
        'version' => '1.0',
        'author' => 'http://99ko.tuxfamily.org',
        'priority' => 2,
    );
    return $config;
}

function jquery_themeHead(){
    $data = "echo '<script type=\"text/javascript\" src=\"plugin/jquery/jquery.js\"></script>';";
    return $data;
}

addHook('jquery_themeHead');
?>