<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://chronodev.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

session_start();
function draw() {
	$fontSize = 14;
	$turingCode = '';
	$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','n','o','p','q','r','s','t','u','v','w','x','y','z');
	for($i=0;$i<6;$i++) {		switch(rand(1,2)) {			case 1:
               	$turingCode .= $letters[array_rand($letters)];
			break;
			case 2:
				$turingCode .= rand(0,9);
			break;
		}
	}
	session_register('_ste_ccode');
	$_SESSION['_ste_ccode'] = $turingCode;
	$fontPath = 'images/verdana.ttf';
	$NewImageInfo = imagettfbbox($fontSize, 0,$fontPath,4);
	$width = abs($NewImageInfo[0]) + abs($NewImageInfo[2]);
	$heigh = abs($NewImageInfo[1]) + abs($NewImageInfo[7]);
	$imgWidth = 120;
	$imgHeigh = 20;
	$xPos = ($imgWidth-$width)/2.2;
	$yPos = $imgHeigh - ($imgHeigh-$heigh)/2;

	$imgFontNew = ImageCreate($imgWidth,$imgHeigh);
	$red =	rand(180,255);
	$blue =	rand(180,255);
	$green = rand(180,255);

	$white = ImageColorAllocate($imgFontNew, 255, 255, 255);

 	$nextXPos = 10;
	for($i=0;$i<strlen($turingCode);$i++) {		$fontcolor = ImageColorAllocate($imgFontNew, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
		$angle = mt_rand(-10,10);
		if ( $angle < 0) $angle = 360+$angle;
		imageTTFText($imgFontNew, $fontSize-mt_rand(0,2),$angle, $nextXPos, $heigh+2, $fontcolor, $fontPath, $turingCode[$i]);
		$nextXPos = $nextXPos + $width+5;
	}
	imagejpeg($imgFontNew,null,100);
	return $imgFontNew;
}
header("Content-Type: image/jpeg");
echo draw();
?>
