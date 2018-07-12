<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org.ru
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     Plugin "my_gallery"
|     Author: Alex ANP alex-anp@ya.ru
+-----------------------------------------------------------------------------------------------+
*/

// The file
$filename = $_GET['img'];
$height = $_GET['h'];
$width= $_GET['w'];

// Content type
header('Content-type: image/jpeg');

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

if ($width>$width_orig) { $width=$width_orig; }
if ($height>$height_orig) { $height=$height_orig; }
if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
// Resample

$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
imagejpeg($image_p, null, 70);

imagedestroy($image_p);
imagedestroy($image);

?>