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
require_once("../../class2.php");
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;
global $tp;


// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
    include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

// Include page header stuff for admin pages
require_once(e_ADMIN."auth.php");

// predefine static arrays
// selectbox text
$pageArray = array("classic" => LAN_ADMIN_171,"advanced" => LAN_ADMIN_172);
// options text (1: latest, 2: random, 3: not used in this moment)
$optionArray = array("1"=>LAN_ADMIN_190,"2"=>LAN_ADMIN_191);


// Save values and clear related cache
if ($_POST['pv_admin'] == "admin_startpage") {
	// clear cache for adv. startpage
	$e107cache -> clear("pview_stat");
	// database save
	$sqlOK = $PView -> pviewUpdateDb("pview_config","start_page",$_POST['pv_start_page'],$pageArray);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_short",$_POST['pv_stat_short'][0]."|".$_POST['pv_stat_short'][1]."|".$_POST['pv_stat_short'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_album",$_POST['pv_stat_album'][0]."|".$_POST['pv_stat_album'][1]."|".$_POST['pv_stat_album'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_cat",$_POST['pv_stat_cat'][0]."|".$_POST['pv_stat_cat'][1]."|".$_POST['pv_stat_cat'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_comm",$_POST['pv_stat_comm'][0]."|".$_POST['pv_stat_comm'][1]."|".$_POST['pv_stat_comm'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_img",$_POST['pv_stat_img'][0]."|".$_POST['pv_stat_img'][1]."|".$_POST['pv_stat_img'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_imgRating",$_POST['pv_stat_imgRating'][0]."|".$_POST['pv_stat_imgRating'][1]."|".$_POST['pv_stat_imgRating'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_imgViews",$_POST['pv_stat_imgViews'][0]."|".$_POST['pv_stat_imgViews'][1]."|".$_POST['pv_stat_imgViews'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_Uploader",$_POST['pv_stat_Uploader'][0]."|".$_POST['pv_stat_Uploader'][1]."|".$_POST['pv_stat_Uploader'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_userComm",$_POST['pv_stat_userComm'][0]."|".$_POST['pv_stat_userComm'][1]."|".$_POST['pv_stat_userComm'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_userGals",$_POST['pv_stat_userGals'][0]."|".$_POST['pv_stat_userGals'][1]."|".$_POST['pv_stat_userGals'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_FeatureImg",$_POST['pv_stat_FeatureImg'][0]."|".$_POST['pv_stat_FeatureImg'][1]."|".$_POST['pv_stat_FeatureImg'][2],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","stat_FeatureAlbum",$_POST['pv_stat_FeatureAlbum'][0]."|".$_POST['pv_stat_FeatureAlbum'][1]."|".$_POST['pv_stat_FeatureAlbum'][2],"text");

	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}
// prepare list order
$listArray = $PView->getFrontpageArray();
// prepare admin panel view
if ($PView -> getPView_config('start_page') == "advanced") {
	$divStyle = "block";
} else {
	$divStyle = "none";
}


// Config Table
$out_HTML.= "<script type='text/javascript' src='pview.js'></script>";
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_startpage'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_170."</td><td class='forumheader3'><select class='tbox' id='pv_start_page' name='pv_start_page' onchange='javascript:pv_frontpageswitcher()'>";
foreach ($pageArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('start_page')) {
		$out_HTML.= "<option value='".$key."' selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option value='".$key."' >".$dataset."</option>";
	}
}
$out_HTML.= "</select></td></tr>";
$out_HTML.= "</table><br />";

// frontpage values
$out_HTML.= "<div id='pview_start_advanced' style='display:".$divStyle."'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='fcaption'>".LAN_ADMIN_186."</td><td class='fcaption'>".LAN_ADMIN_187."</td><td class='fcaption'>".LAN_ADMIN_188."</td><td class='fcaption'>".LAN_ADMIN_189."</td></tr>";

foreach ($listArray as $key => $dataset) {
	$elementArray = explode("|",$dataset);
	$out_Option = "";
	if ($elementArray[2]) {
		// prepare options:
		
		$out_Option = "<select class='tbox' id='pv_".$key."[2]' name='pv_".$key."[2]'>";
		foreach ($optionArray as $optionKey=>$optionValue) {
			if ($elementArray[2] == $optionKey) {
				$selText = " selected";
			} else {
				$selText = "";
			}
			$out_Option.= "<option value='".$optionKey."'".$selText.">".$optionValue."</option>";
		}
		
		$out_Option.= "</select>";
	}
	if ($key == "stat_short") {
		// activation/deactivation via checkbox
		if ($elementArray[1]) {
			$shortStatSelect = "checked='checked' ";
		}
		$out_HTML.= "<tr><td class='forumheader3'>".getModuleDescription($key)."</td><td class='forumheader3'>".$out_Option."</td><td class='forumheader3'><input class='tbox' id='pv_".$key."[1]' name='pv_".$key."[1]' type='checkbox' value='1'".$shortStatSelect." /></td><td class='forumheader3'>".$PView->getOrderSelector($key."[0]",12,$elementArray[0])."</td></tr>";

	} else {
		$out_HTML.= "<tr><td class='forumheader3'>".getModuleDescription($key)."</td><td class='forumheader3'>".$out_Option."</td><td class='forumheader3'><input class='tbox' id='pv_".$key."[1]' name='pv_".$key."[1]' type='text' size='2' maxlength='2' value='".$elementArray[1]."' /></td><td class='forumheader3'>".$PView->getOrderSelector($key."[0]",12,$elementArray[0])."</td></tr>";
	}
}

$out_HTML.= "</table>";
$out_HTML.= "</div>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_169, $out_HTML);

function getModuleDescription($listIndex){
	switch ($listIndex) {
    case "stat_short":
        return LAN_ADMIN_176;
    case "stat_album":
        return LAN_ADMIN_177;
    case "stat_cat":
        return LAN_ADMIN_178;
    case "stat_comm":
        return LAN_ADMIN_179;
    case "stat_img":
        return LAN_ADMIN_180;
    case "stat_imgRating":
        return LAN_ADMIN_181;
    case "stat_imgViews":
        return LAN_ADMIN_182;
    case "stat_Uploader":
        return LAN_ADMIN_183;
    case "stat_userComm":
        return LAN_ADMIN_184;
    case "stat_userGals":
        return LAN_ADMIN_185;
    case "stat_FeatureImg":
        return LAN_ADMIN_229;
    case "stat_FeatureAlbum":
        return LAN_ADMIN_230;
	}

}

require_once(e_ADMIN."footer.php");