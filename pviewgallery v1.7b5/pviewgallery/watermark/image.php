<?php
require_once("../../../class2.php");
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;
global $tp;
global $pref;

// collect data

$imgId = $_GET['id'];

// check permission!!! and image exist!!!
if (!$PView ->getPermission("image",$imgId,"view") OR !$PView ->getExist("image",$imgId)) {
    header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
    exit;
}

// select imagesize
$imgSize = $_GET['size'];

switch ($imgSize) {
    case "thumb":
        $img_pview = $PView -> getThumbPath($imgId,"REL",1);
        break;
    case "resize":
        $img_pview = $PView -> getResizePath($imgId,"REL",1);
        break;
    case "orig":
        $img_pview = $PView -> getOrigPath($imgId,"REL",1);
        break;
    default:
        $img_pview = $PView -> getResizePath($imgId,"REL",1);
}

// adjust color, if black
if ($PView -> getPView_config("wm_color") == "000000") {
    $textColor = "010101";
} else {
    $textColor = $PView -> getPView_config("wm_color");
}

// replace stringtemplates
// your Sitename replaces SITENAME 
$text_string = $tp -> toText($PView -> getPView_config("wm_text"));
if (strpos($text_string,"SITENAME") !== false) {
    $text_string = str_replace("SITENAME", $pref['sitename'], $text_string);
}
// Uploaddate replaces DATE
if (strpos($text_string,"DATE") !== false) {
    $imageData = $PView -> getImageData($imgId);
    $text_string = str_replace("DATE", date('d.m.y',$imageData['uploadDate']), $text_string);
}

// Username from Uploader replaces USERNAME
if (strpos($text_string,"USERNAME") !== false) {
    $imageData = $PView -> getImageData($imgId);
    $text_string = str_replace("USERNAME", $PView -> getUserName($imageData['uploaderUserId']), $text_string);
}


$font_ttf = $PView -> getPView_config("wm_font");
$font_size = $PView -> getPView_config("wm_fontsize");
$font_color = "#".$textColor;
$text_angle = $PView -> getPView_config("wm_angle");
$text_padding = $PView -> getPView_config("wm_padding"); // Img padding - around text, aus DB
$img_wm = e_PLUGIN."pviewgallery/watermark/". $PView -> getPView_config("wm_image");;
$wm_typ = $PView -> getPView_config("wm_typ");
$iTransparency = 100 - $PView -> getPView_config("wm_opacity");
$wm_pos = $PView -> getPView_config("wm_pos");
$decrWatermark = $PView -> getPView_config("wm_decr");



// --------------------------------------------------------------------------------------------------------------------
// if you have problems with special characters, use this workaround (known issue of some gdlib versions in PHP > 5.3.0)
//$text_string = text_convert ($text_string);
// --------------------------------------------------------------------------------------------------------------------

// reset header for image output
ob_clean();

// read data from saved image
list ( $iDestinationWidth, $iDestinationHeight, $iDestinationType ) = getimagesize ( $img_pview );

// watermark made from text
if ($wm_typ == "text") {
	$the_box = calculateTextBox($text_string, $font_ttf, $font_size, $text_angle);
    
    $rgbColor = html2rgb($font_color);
	
	$imgWidth = $the_box["width"] + $text_padding + round($font_size / 3);
	$imgHeight = $the_box["height"] + $text_padding;   
	
	$watermark = imagecreatetruecolor($imgWidth,$imgHeight);
    $color = imagecolorallocate($watermark, $rgbColor[0], $rgbColor[1], $rgbColor[2]);
	$bkgr = imagecolorallocate($watermark, 0, 0, 0);
	imagecolortransparent($watermark,$bkgr);
	
	imagettftext($watermark,
	    $font_size,
	    $text_angle,
	    $the_box["left"] + ($imgWidth / 2) - ($the_box["width"] / 2),
	    $the_box["top"] + ($imgHeight / 2) - ($the_box["height"] / 2),
	    $color * (-1),
	    $font_ttf,
	    $text_string);
        
	$rWatermark = $watermark; 

    // decrease watermark, do not increase
    if ($decrWatermark) {
        if ($imgWidth > $iDestinationWidth OR $imgHeight > $iDestinationHeight) {
            // observe imageratio and save current dimensions
            $ImageRatio = $imgWidth / $imgHeight;
            $currWidth = $imgWidth;
            $currHeight = $imgHeight;
            
    		if ($imgHeight * $ImageRatio <= $iDestinationWidth) {
    			$imgWidth = $imgHeight * $ImageRatio;
    		} else {
    			$imgHeight = $iDestinationWidth / $ImageRatio;
                $imgWidth = $imgHeight * $ImageRatio;
    		}
            
    		if ($imgWidth / $ImageRatio <= $iDestinationHeight) {
    			$imgHeight = $imgWidth / $ImageRatio;
    		} else {
    			$imgWidth = $iDestinationHeight * $ImageRatio;
                $imgHeight = $imgWidth / $ImageRatio;
    		}        
    
        	$imgWidth = round($imgWidth);
        	$imgHeight = round($imgHeight);
            
            $resize_wm = ImageCreateTrueColor($imgWidth, $imgHeight);
            imagecolortransparent($resize_wm,$bkgr);
            imagecopyresampled($resize_wm, $watermark, 0, 0, 0, 0, $imgWidth , $imgHeight, $currWidth, $currHeight);    
            $rWatermark = $resize_wm;            
    
        }
    }

	$iWatermarkWidth = $imgWidth;
	$iWatermarkHeight = $imgHeight;
	
// watermark made from image
} else {
	list ( $imgWidth, $imgHeight, $iWatermarkType ) = getimagesize ( $img_wm );
	
	switch ( $iWatermarkType ) {
		case 1:
		  $rWatermark = imagecreatefromgif ( $img_wm );
		  break;
		case 2:
		  $rWatermark = imagecreatefromjpeg ( $img_wm );
		  break;
		case 3:
		  $rWatermark = imagecreatefrompng ( $img_wm );
	}

// decrease watermark
    if ($decrWatermark) {
        if ($imgWidth > $iDestinationWidth OR $imgHeight > $iDestinationHeight) {
            // observe imageratio and save current dimensions
            $ImageRatio = $imgWidth / $imgHeight;
            $currWidth = $imgWidth;
            $currHeight = $imgHeight;
            
    		if ($imgHeight * $ImageRatio <= $iDestinationWidth) {
    			$imgWidth = $imgHeight * $ImageRatio;
    		} else {
    			$imgHeight = $iDestinationWidth / $ImageRatio;
                $imgWidth = $imgHeight * $ImageRatio;
    		}
            
    		if ($imgWidth / $ImageRatio <= $iDestinationHeight) {
    			$imgHeight = $imgWidth / $ImageRatio;
    		} else {
    			$imgWidth = $iDestinationHeight * $ImageRatio;
                $imgHeight = $imgWidth / $ImageRatio;
    		}        
    
        	$imgWidth = round($imgWidth);
        	$imgHeight = round($imgHeight);
            
            $resize_wm = ImageCreateTrueColor($imgWidth, $imgHeight);
            imagecolortransparent($resize_wm,$bkgr);
            imagecopyresampled($resize_wm, $rWatermark, 0, 0, 0, 0, $imgWidth , $imgHeight, $currWidth, $currHeight);    
            $rWatermark = $resize_wm;            
    
        }
    }

	$iWatermarkWidth = $imgWidth;
	$iWatermarkHeight = $imgHeight;

}

switch ( $iDestinationType ) {
	case 1:
	  $rDestination = imagecreatefromgif ( $img_pview );
	  break;
	case 2:
	  $rDestination = imagecreatefromjpeg ( $img_pview );
	  break;
	case 3:
	  $rDestination = imagecreatefrompng ( $img_pview );
}

/*
* Position of watermark (1 - 5).
* ul = top left.
* ur = top right.
* ll = bottom left.
* lr = bottom right.
* ctr = centered.
*/
switch ($wm_pos) {
	case "ul":
	  $iPositionX = 0;
	  $iPositionY = 0;
	  break;
	case "ur":
	  $iPositionX = $iDestinationWidth - $iWatermarkWidth;
	  $iPositionY = 0;
	  break;
	case "ll":
	  $iPositionX = 0;
	  $iPositionY = $iDestinationHeight - $iWatermarkHeight;
	  break;
	case "lr":
	  $iPositionX = $iDestinationWidth - $iWatermarkWidth;
	  $iPositionY = $iDestinationHeight - $iWatermarkHeight;
	  break;
	case "ctr":
	  $iPositionX = ceil ( ( $iDestinationWidth / 2 ) );
	  $iPositionX -= ceil ( ( $iWatermarkWidth / 2 ) );
	
	  $iPositionY = ceil ( ( $iDestinationHeight / 2 ) );
	  $iPositionY -= ceil ( ( $iWatermarkHeight / 2 ) );
}

$iTransparency = 100 - $iTransparency;

imagecopymerge ( $rDestination, $rWatermark, $iPositionX,$iPositionY, 0, 0, $iWatermarkWidth,$iWatermarkHeight, $iTransparency );


//header("Content-Type: image/jpeg");
//imagejpeg($rDestination,NULL,80);
header("Content-Type: image/png");
imagepng($rDestination);
imagedestroy($rDestination);


function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) {
    /************
    simple function that calculates the *exact* bounding box (single pixel precision).
    The function returns an associative array with these keys:
    left, top:  coordinates you will pass to imagettftext
    width, height: dimension of the image you have to create
    *************/
    $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text);
    $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
    $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
    $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
    $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));
   
    return array(
     "left"   => abs($minX) - 1,
     "top"    => abs($minY) - 1,
     "width"  => $maxX - $minX,
     "height" => $maxY - $minY,
     "box"    => $rect
    );
}
function html2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}
function text_convert($text) {
    $res = '';
    for ($i = 0; $i < strlen($text); $i++)
    {
        $cc = ord(substr($text,$i,1));
        $res .= "&#".$cc.";";
    }
    return $res;
}

?>