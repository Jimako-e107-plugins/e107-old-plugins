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
if ($_POST['pv_admin'] == "admin_emailprint") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","print",$_POST['pv_print'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","email",$_POST['pv_email'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","pdf",$_POST['pv_pdf'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permPrint",$PView -> getpermClasses("pv_permPrint"));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permEmail",$PView -> getpermClasses("pv_permEmail"));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permPdf",$PView -> getpermClasses("pv_permPdf"));
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// all userclasses
$allUserclasses = $PView -> getUserclasses();

// userclasses with permEmail
$ValidUserclass_email = array();
$ValidUserclass_email = explode ( ',', $PView -> getPView_config('permEmail') );
// userclasses with permPrint
$ValidUserclass_print = array();
$ValidUserclass_print = explode ( ',', $PView -> getPView_config('permPrint') );
// userclasses with permPdf
$ValidUserclass_pdf = array();
$ValidUserclass_pdf = explode ( ',', $PView -> getPView_config('permPdf') );

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_emailprint'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='fcaption'>&nbsp;</td><td class='fcaption'>".LAN_ADMIN_114."</td><td class='fcaption'>".LAN_ADMIN_115."</td><td class='fcaption'>".LAN_ADMIN_116."</td></tr>";
// print active?
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_48."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_print' name='pv_print' value='on' ";
if ($PView -> getPView_config('print')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td>";
// email active?
$out_HTML.= "<td class='forumheader3'><input class='tbox' type='checkbox' id='pv_email' name='pv_email' value='on' ";
if ($PView -> getPView_config('email')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td>";
// pdf active?
$out_HTML.= "<td class='forumheader3'><input class='tbox' type='checkbox' id='pv_pdf' name='pv_pdf' value='on' ";
if ($PView -> getPView_config('pdf')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td>";
$out_HTML.= "</tr>";

// print permission
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_29."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_permPrint[all]' name='pv_permPrint[all]' value='on' ";
if ($PView -> getPView_config('permPrint') == "ALL") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_31."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permPrint[member]' name='pv_permPrint[member]' value='on' ";
if ($PView -> getPView_config('permPrint') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permPrint[".$dataset['userclass_id']."] ' name='pv_permPrint[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass_print)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td>";
// email permission
$out_HTML.= "<td class='forumheader3'><input class='tbox' type='checkbox' id='pv_permEmail[all]' name='pv_permEmail[all]' value='on' ";
if ($PView -> getPView_config('permEmail') == "ALL") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_31."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permEmail[member]' name='pv_permEmail[member]' value='on' ";
if ($PView -> getPView_config('permEmail') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permEmail[".$dataset['userclass_id']."] ' name='pv_permEmail[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass_email)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td>";

// pdf permission
$out_HTML.= "<td class='forumheader3'><input class='tbox' type='checkbox' id='pv_permPdf[all]' name='pv_permPdf[all]' value='on' ";
if ($PView -> getPView_config('permPdf') == "ALL") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_31."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permPdf[member]' name='pv_permPdf[member]' value='on' ";
if ($PView -> getPView_config('permPdf') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permPdf[".$dataset['userclass_id']."] ' name='pv_permPdf[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass_pdf)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td>";

$out_HTML.= "</tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_113, $out_HTML);

require_once(e_ADMIN."footer.php");