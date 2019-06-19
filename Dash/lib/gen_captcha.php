<?php
//generates a string of random letters and numbers of length 5
function random_text($count){
	 //creating list
	 $chars=array_flip(array_merge(range(0, 9),range("A", "Z")));
    for($i=0,$text=''; $i<$count; $i++){
    	$text.=array_rand($chars);
    }

    return $text;
}
if(!isset($_SESSION)){
	session_start();
	header('Cache-control:private');
}
$image=imagecreate(80, 40);  //creating image
$bg_color = imagecolorallocate($image, 0x33, 0x66, 0xFF); // fill the image background color
imagefilledrectangle($image, 0, 0, 80, 40, $bg_color);
$text = random_text(5);

// determine x and y coordinates for centering text
$font = 5;
$x = imagesx($image) / 2 - strlen($text) * imagefontwidth($font) / 2;
$y = imagesy($image) / 2 - imagefontheight($font) / 2;

// write text on image
$fg_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
imagestring($image, $font, $x, $y, $text, $fg_color);

// save the CAPTCHA string for later comparison
$_SESSION['captcha'] = $text;

// output the image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

?>