<?php

session_start();

if ((!isset($_SESSION['captcha'])) || ($_SESSION['captcha']=='')) {
    $str = "";
    $length = 0;
    srand();
    for ($i = 0; $i < 7; $i++) {
        // this numbers refer to numbers of the ascii table (small-caps)
        $str .= chr(mt_rand(97, 122));
    }
    $_SESSION['captcha'] = $str;
}


$imgX = 100;
$imgY = 40;
$image = imagecreatetruecolor(100, 40);

$backgr_col = imagecolorallocate($image, 238,239,239);
$border_col = imagecolorallocate($image, 208,208,208);
$text_col = imagecolorallocate($image, 46,60,31);
$trait_col = imagecolorallocate($image, 46,60,31);

imagefilledrectangle($image, 0, 0, 100, 40, $backgr_col);
imagerectangle($image, 0, 0, 99, 39, $border_col);
imageline($image, 0, 0, 100, 40, $trait_col);
imageellipse($image, 50, 20, 75, 30, $trait_col);

putenv('GDFONTPATH=' . realpath('..'));
$font = "arial.ttf"; 
$font_size = 15;
$angle = 10;
$box = imagettfbbox($font_size, $angle, $font, $_SESSION['captcha']);
$x = (int)($imgX - $box[4]) / 2;
$y = (int)($imgY - $box[5]) / 2;
imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, $_SESSION['captcha']);

header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);

?>
