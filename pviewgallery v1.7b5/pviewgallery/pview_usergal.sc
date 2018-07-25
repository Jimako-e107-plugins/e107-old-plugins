//<?php
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else {
	include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

$pv_query = array();
$pv_query = explode(".",e_QUERY);
if ($pv_query[0] == "id") {
	$pv_uid = $pv_query[1];
} else {
	return "";
}
if ($PView -> getGalleryName($pv_uid)) {
	$pv_galLink = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?gallery=".$pv_uid."'>".LAN_PVIEW_SC_1."</a>";
} else {
	$pv_galLink = LAN_PVIEW_SC_2;
}

if($parm == "inline") {
	// create tablrow <tr></tr> for usage inside userdata-table
	$pview_usergal = "<tr><td class='forumheader3' style='width:30%'>".LAN_PVIEW_SC_3."</td><td class='forumheader3' style='width:70%'>".$pv_galLink."</td></tr>";
} else {
	// create table below userdata-table
	$pview_usergal = "<br /><table style='".USER_WIDTH."' class='fborder'><tr>";
	$pview_usergal.= "<td class='forumheader3' style='width:40%'>".LAN_PVIEW_SC_3."</td><td class='forumheader3' style='width:60%'>".$pv_galLink."</td>";
	$pview_usergal.= "</tr></table>";	
}
return $pview_usergal;

//?>