<?php

$rankShort= $_GET['rank'];
$imagedir = "../images/ranks/uniforms/" . $_GET['gender'] . "/";

header ("Content-type: image/png");

$uniform = array();
$uniform['rank'] = strtolower($_GET['rank']);

$uniform['uniform'] =  @imagecreatefrompng($imagedir . "rank-" . $uniform['rank'] . ".png") or die ("Cannot Create image");
$uniform['nametag'] = imageCreateFromPNG ($imagedir . "name-tag.png");
$uniform['name'] = $_GET['name'];
imagecopy  ( $uniform['uniform']  , $uniform['nametag']  , 76  , 154  , 0  , 0  ,47 , 16  );
$uniform['namecolor'] = ImageColorAllocate ($uniform['uniform'], 255, 255, 255);
$uniform['font'] = imageloadfont('font.gdf');
list($x,$y) = pc_ImageStringCenter($uniform['nametag'], $uniform['name'], $uniform['font']);
ImageString ($uniform['uniform'], $uniform['font'], $x+76, $y+154, $uniform['name'], $uniform['namecolor']);

function pc_ImageStringCenter($image, $text, $font) {
    
    // font sizes
	$width = imagefontwidth($font);
	$height = imagefontheight($font);

    // find the size of the image
    $xi = ImageSX($image);
    $yi = ImageSY($image);

    // find the size of the text
    $xr = $width * strlen($text);
    $yr = $height;

    // compute centering
    $x = intval(($xi - $xr) / 2);
    $y = intval(($yi - $yr) / 2);

    return array($x, $y);
}
ImagePng ($uniform['uniform']);
?>