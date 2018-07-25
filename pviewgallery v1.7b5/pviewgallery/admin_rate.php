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


// Save values
if ($_POST['pv_admin'] == "admin_ratings") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","Rating",$_POST['pv_Rating'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permRating",$PView -> getpermClasses("pv_permRating"));
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// all userclasses
$allUserclasses = $PView -> getUserclasses();

// userclasses with permRating
$ValidUserclass = array();
$ValidUserclass = explode ( ',', $PView -> getPView_config('permRating') );

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_ratings'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_45."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_Rating' name='pv_Rating' value='on' ";
if ($PView -> getPView_config('Rating')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_29.LAN_ADMIN_46."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_permRating[member]' name='pv_permRating[member]' value='on' ";
if ($PView -> getPView_config('permRating') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permRating[".$dataset['userclass_id']."] ' name='pv_permRating[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_4, $out_HTML);

require_once(e_ADMIN."footer.php");