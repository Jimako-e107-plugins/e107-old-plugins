<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
    include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 

$pv_images = $sql->db_Count("pview_image", "(*)");
if (empty($pv_images))
{
    $pv_images = 0;
}
if (!$pv_FeaturedImg = $sql->db_Count("pview_featured", "(*)", "WHERE imageid<>0 AND calDay='0' AND isFeatured=1")) {
	$pv_FeaturedImg = 0;
}
if (!$pv_FeaturedAlbum = $sql->db_Count("pview_featured", "(*)", "WHERE albumid<>0 AND calDay='0' AND isFeatured=1")) {
	$pv_FeaturedAlbum = 0;
}

$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "pviewgallery/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' />
".LAN_ADMIN_39.": ".$pv_images."</div>";
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "pviewgallery/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' />
".LAN_ADMIN_229.": ".$pv_FeaturedImg."</div>";
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "pviewgallery/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' />
".LAN_ADMIN_230.": ".$pv_FeaturedAlbum."</div>";

?>