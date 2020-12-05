<?php

header("Content-type: image/png");

$image = imagecreate(45, 23) or die ("Ha ocurrido un errr");
$color_fondo = imagecolorallocate($image, 0, 0, 0);
$color_text = imagecolorallocate($image, 250, 250, 250);

function generar($chars, $length){
	$captcha = null;
	for ($i=0; $i < $length; $i++) { 
		# code...

		$rand = rand(0, count($chars)-1);
		$captcha .= $chars[$rand];
	}
return $captcha;

}

$captcha = generar(array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'), 4);
setcookie('captcha', sha1($captcha), time()+60*3);
imagestring($image, 5, 5, 5, $captcha, $color_text);
imagepng($image);



?>
