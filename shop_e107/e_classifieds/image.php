<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Father Barry
|
|        v2.00 modifications foodisfunagain.com allergy support
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2010
|
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

#require_once("../../class2.php");
#if (!defined('e107_INIT')) {
 #   exit;
#}
#if (!is_object($eclassf_obj)) {
  #  require_once('includes/eclassifieds_class.php');
  #  $eclassf_obj = new classifieds;
#}
error_reporting(0);
$picture = $_GET['eclassf_picture'];
$height = $_GET['eclassf_height'];
$width = $_GET['eclassf_width'];
$watermark=$_GET['eclassf_watermark'];
$eclassf_picloc = "images/classifieds/" . $picture;

$imageclass = new SimpleImage;
$imageclass->load($eclassf_picloc);
if ($width > 0 && $height > 0) {
    $imageclass->resize($width, $height);
} elseif ($width > 0 && $height == 0) {
    $imageclass->resizeToWidth($width);
} elseif ($width == 0 && $height > 0) {
    $imageclass->resizeToHeight($height);
}
if (!empty($watermark)) {
    $imageclass->watermark($watermark);
}
$imageclass->output();
/*
   * File: SimpleImage.php
   * Author: Simon Jarvis
   * Copyright: 2006 Simon Jarvis
   * Date: 08/11/06
   * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
   *
   * This program is free software; you can redistribute it and/or
   * modify it under the terms of the GNU General Public License
   * as published by the Free Software Foundation; either version 2
   * of the License, or (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   * GNU General Public License for more details:
   * http://www.gnu.org/licenses/gpl.html
   *
*/

class SimpleImage {
    var $image;
    var $image_type;

    function load($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }
    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }
    function output($image_type = IMAGETYPE_JPEG)
    {
        // set up expiry caching
        $expires = 60 * 60 * 24 * 366;
        header("Pragma: public");
        header("Cache-Control:public maxage=" . $expires);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
        if ($image_type == IMAGETYPE_JPEG) {
            header('Content-Type: image/jpeg');
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            header('Content-Type: image/gif');
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            header('Content-Type: image/png');
            imagepng($this->image);
        }
    }
    function getWidth()
    {
        return imagesx($this->image);
    }
    function getHeight()
    {
        return imagesy($this->image);
    }
    function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }
    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }
    function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }
    function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
    function watermark($WaterMarkText)
    {
        // this bit added by me
        $black = imagecolorallocate($this->image, 0, 0, 0);
        $white = imagecolorallocate($this->image, 255, 255, 255);
        $font =  "./includes/arial.ttf";
        $font_size = $this->getWidth() / 25;
        if ($font_size > 20) {
            $font_size = 20;
        }
        // $font_size = $fontsize;
        $base = $font_size + 3;
        imagettftext($this->image, $font_size, 0, 6, $base, $white, $font, $WaterMarkText);
        imagettftext($this->image, $font_size, 0, 7, $base + 1, $black, $font, $WaterMarkText);
    }
}