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
// selectbox for cache interval
$intArray = array("0" => LAN_ADMIN_284,"1" => "1 ".LAN_ADMIN_285, "2" => "2 ".LAN_ADMIN_286, "3" => "3 ".LAN_ADMIN_286,"4" => "4 ".LAN_ADMIN_286, "5" => "5 ".LAN_ADMIN_286,"6" => "6 ".LAN_ADMIN_286, "7" => "7 ".LAN_ADMIN_286);

// Clear selected caches
if ($_POST['pv_admin'] == "admin_cache_clear") {
    if ($_POST['pv_gal_clear'] == "on") { $e107cache->clear("pview_gal_"); }
	if ($_POST['pv_stat_clear'] == "on") { $e107cache->clear("pview_stat"); }
	if ($_POST['pv_album_clear'] == "on") { $e107cache->clear("pview_album_"); }
	if ($_POST['pv_cat_clear'] == "on") { $e107cache->clear("pview_cat_"); }
	if ($_POST['pv_user_clear'] == "on") { $e107cache->clear("pview_user_"); }
	if ($_POST['pv_menu_clear'] == "on") { $e107cache->clear("nq_pview_menu"); }
    
    $ns->tablerender(LAN_ADMIN_55, LAN_ADMIN_293);
}


// Save values
if ($_POST['pv_admin'] == "admin_config") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","cacheON",$_POST['pv_cacheON'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","cacheInt",$_POST['pv_cacheInt']);

	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}
	
// help text
	$out_HTML.= "<div style='width:95%; margin:auto;'>".LAN_HELP_28."</div>";

// e107cache status
	global $pref;
	if ($pref['cachestatus']) {
		$out_HTML.= "<div style='width:95%; margin:auto; color:green;'>".LAN_ADMIN_294.".</div>";
	} else {
		$out_HTML.= "<div style='width:95%; margin:auto; color:red;'>".LAN_ADMIN_295."! <a href='../../e107_admin/cache.php'>".LAN_ADMIN_296."</a></div>";
	}
	
// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_config'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_280."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_cacheON' name='pv_cacheON' value='on' ";
if ($PView -> getPView_config('cacheON')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /></td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_281."</td><td class='forumheader3'><select class='tbox' id='pv_cacheInt' name='pv_cacheInt'>";
foreach ($intArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('cacheInt')) {
		$out_HTML.= "<option value='".$key."' selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option value='".$key."' >".$dataset."</option>";
	}
}
$out_HTML.= "</select> ";
$out_HTML.= "</td></tr>";

$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;</div>";
$out_HTML.= "</form>";

$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_cache_clear'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:20px'>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_282."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_gal_clear' name='pv_gal_clear' value='on' /> ".LAN_ADMIN_287."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_stat_clear' name='pv_stat_clear' value='on' /> ".LAN_ADMIN_291."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_album_clear' name='pv_album_clear' value='on' /> ".LAN_ADMIN_288."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_cat_clear' name='pv_cat_clear' value='on' /> ".LAN_ADMIN_289."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_user_clear' name='pv_user_clear' value='on' /> ".LAN_ADMIN_290."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_menu_clear' name='pv_menu_clear' value='on' /> ".LAN_ADMIN_292."<br />";

$out_HTML.= "</td></tr>";

$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_283."'>&nbsp;</div>";
$out_HTML.= "</form>";


$ns->tablerender(LAN_ADMIN_279, $out_HTML);

require_once(e_ADMIN."footer.php");
?>