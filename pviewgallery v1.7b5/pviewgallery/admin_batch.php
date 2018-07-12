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
if ($_POST['pv_admin'] == "admin_batch") {
	$sqlOK = $PView -> pviewUpdateDb("pview_config","permBatch",$PView -> getpermClasses("pv_permBatch"));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permExtern",$PView -> getpermClasses("pv_permExtern"));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","batch_use_filename",$_POST['pv_batch_use_filename'],"checkbox");
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// all userclasses
$allUserclasses = $PView -> getUserclasses();

// userclasses with permBatch
$ValidUserclass_Batch = array();
$ValidUserclass_Batch = explode ( ',', $PView -> getPView_config('permBatch') );

// userclasses with permExtern
$ValidUserclass_Extern = array();
$ValidUserclass_Extern = explode ( ',', $PView -> getPView_config('permExtern') );

$out_HTML.= "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_118_1."<br />";
$out_HTML.= "<b>".e_PLUGIN_ABS."pviewgallery/batch_upload</b></p>";
$out_HTML.= "<p>".LAN_ADMIN_118_2." <a href='".e_PLUGIN."pviewgallery/pview_batch.php'>Link</a></p></div>";

// Config Table (Batch Upload)
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_batch'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";

$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_29.LAN_ADMIN_117."</td><td class='forumheader3' width='70%'><input class='tbox' type='checkbox' id='pv_permBatch[member]' name='pv_permBatch[member]' value='on' ";
if ($PView -> getPView_config('permBatch') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permBatch[".$dataset['userclass_id']."]' name='pv_permBatch[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass_Batch)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_125."</td><td class='forumheader3' width='70%'><input class='tbox' type='checkbox' id='pv_batch_use_filename' name='pv_batch_use_filename' value='on' ";
if ($PView -> getPView_config('batch_use_filename')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "</table>";

$ns->tablerender(LAN_ADMIN_117, $out_HTML);

// Config Table (External Upload)
$out_HTML = "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_175."</p></div>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style= margin-top:10px'>";

$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_29.LAN_ADMIN_174."</td><td class='forumheader3' width='70%'><input class='tbox' type='checkbox' id='pv_permExtern[all]' name='pv_permExtern[all]' value='on' ";
if ($PView -> getPView_config('permExtern') == "ALL") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_31."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permExtern[member]' name='pv_permExtern[member]' value='on' ";
if ($PView -> getPView_config('permExtern') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permExtern[".$dataset['userclass_id']."]' name='pv_permExtern[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass_Extern)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td></tr>";
$out_HTML.= "</table>";

$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_174, $out_HTML);

require_once(e_ADMIN."footer.php");