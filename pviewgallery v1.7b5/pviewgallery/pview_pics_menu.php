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
} else {
	include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;
include_once(e_PLUGIN."pviewgallery/templates/menu_template.php");
$Menu = new Menu;

$menu_SQL =& new db;
$imgArray = array();
$menuPics = array();
$menuPics = explode(",",$PView -> getPView_config("menu_pics"));
if (!$menuPics[1]){
	$menuPics[1] = $menuPics[0]+1;
}

if ($PView -> getPView_config("menu_display") == "latest"){
	$pv_header = LAN_MENU_1;
	$menu_SQL -> db_Select("pview_image", "*", "ORDER BY uploadDate DESC", "nowhere");
	while($findImage = $menu_SQL -> db_Fetch() ) {
		if($PView -> getPermission("image",$findImage['imageId'],"View") && $imageCount < intval($menuPics[1])) {
			// check gallery restriction
			$albumData = $PView -> getAlbumData($findImage['albumId']);
			if ($PView -> getPView_config("menu_allGal") OR !$albumData['galleryId']) {
				array_push($imgArray,$findImage);
				$imageCount++;
			}
		}
	}
}
if ($PView -> getPView_config("menu_display") == "random"){
	$pv_header = LAN_MENU_2;
	$menu_SQL -> db_Select("pview_image", "*", "ORDER BY RAND()", "nowhere");
	while($findImage = $menu_SQL -> db_Fetch() ) {
		if($PView -> getPermission("image",$findImage['imageId'],"View") && $imageCount < intval($menuPics[1]) && !in_array($findImage['imageId'],$checkArray)) {
			// Prüfen ob Gallery Einschränkung und Ergebnis
			$albumData = $PView -> getAlbumData($findImage['albumId']);
			if ($PView -> getPView_config("menu_allGal") OR !$albumData['galleryId']) {
				array_push($imgArray,$findImage);
				array_push($checkArray, $findImage['imageId']);
				$imageCount++;
			}
		}
	}
}
if (!$imageCount) {
	$ns->tablerender($pv_header, LAN_MENU_4,'pview');
} else {
	$ns->tablerender($pv_header, $Menu -> getScroller($imgArray),'pview');
}

?>