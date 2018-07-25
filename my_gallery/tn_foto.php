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
$blank_tn = "images/tn_blank.jpg";
$filename = $_GET['img'];
$height = $_GET['h']; 
$width= $_GET['w'];
 
// Content type
header('Content-type: image/jpeg');

// Get new dimensions
list($width_blank, $height_blank) = getimagesize($blank_tn);
list($width_orig, $height_orig) = getimagesize($filename);

if ($width>$width_orig) { $width=$width_orig; }
if ($height>$height_orig) { $height=$height_orig; }
if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }

// Resample
$dist_x = ($width_blank - $width)/2;
$dist_y = ($height_blank*0.9 - $height)/2;

$image_p = imagecreatefromjpeg($blank_tn);

// Print Image size
$color = imagecolorallocate($image_p, 90, 90, 90);
$string = "".$width_orig."x".$height_orig."";
imagestring($image_p, 1, 11, $height_blank - 14, $string, $color);

$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, $dist_x, $dist_y, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
imagejpeg($image_p, null, 70);

imagedestroy($image_p);
imagedestroy($image);

?>