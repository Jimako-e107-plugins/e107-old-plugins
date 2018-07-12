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
// position selector
$posArray = array("ul" => LAN_ADMIN_262,"ur" => LAN_ADMIN_263, "ll" => LAN_ADMIN_264, "lr" => LAN_ADMIN_265, "ctr" => LAN_ADMIN_266);

// Save values
if ($_POST['pv_admin'] == "admin_config") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","watermark",$_POST['pv_watermark'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_usergal",$_POST['pv_wm_usergal'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_adminmode",$_POST['pv_wm_adminmode'],"checkbox");    
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_thumb",$_POST['pv_wm_thumb'],"checkbox"); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_resize",$_POST['pv_wm_resize'],"checkbox"); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_orig",$_POST['pv_wm_orig'],"checkbox"); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_opacity",$_POST['pv_wm_opacity']); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_pos",$_POST['pv_wm_pos']);
    $sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_decr",$_POST['pv_wm_decr'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_typ",$_POST['pv_wm_typ']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_image",$_POST['pv_wm_image']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_text",$_POST['pv_wm_text'],"text");	
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_color",$_POST['pv_wm_color']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_font",$_POST['pv_wm_font']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_fontsize",$_POST['pv_wm_fontsize']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_angle",$_POST['pv_wm_angle']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","wm_padding",$_POST['pv_wm_padding']);

	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}
	
// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_config'>";
$out_HTML.= "<div style='width:95%; margin:auto; padding:20px 0px 10px 0px;'>".LAN_ADMIN_241."</div>";

$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_144.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_242."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_watermark' name='pv_watermark' value='on' ";
if ($PView -> getPView_config('watermark')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_243."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_wm_usergal' name='pv_wm_usergal' value='on' ";
if ($PView -> getPView_config('wm_usergal')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_244."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_wm_adminmode' name='pv_wm_adminmode' value='on' ";
if ($PView -> getPView_config('wm_adminmode')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_245."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_wm_thumb' name='pv_wm_thumb' value='on' ";
if ($PView -> getPView_config('wm_thumb')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_273."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_wm_resize' name='pv_wm_resize' value='on' ";
if ($PView -> getPView_config('wm_resize')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_274."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_wm_orig' name='pv_wm_orig' value='on' ";
if ($PView -> getPView_config('wm_orig')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_275;
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_246."</td><td class='forumheader3'><input class='tbox' id='pv_wm_opacity' name='pv_wm_opacity' type='text' size='3' maxlength='3' value='".$tp -> toForm($PView -> getPView_config('wm_opacity'))."' /> %</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_247."</td><td class='forumheader3'><select class='tbox' id='pv_wm_pos' name='pv_wm_pos'>";
foreach ($posArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('wm_pos')) {
		$out_HTML.= "<option value='".$key."' selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option value='".$key."' >".$dataset."</option>";
	}
}
$out_HTML.= "</select>";
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_248."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_wm_decr' name='pv_wm_decr' value='on' ";
if ($PView -> getPView_config('wm_decr')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/><br />".LAN_ADMIN_259."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_249."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' id='pv_wm_typ' name='pv_wm_typ' type='radio' value='img'";
if ($PView -> getPView_config('wm_typ') == "img") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_260."<br />";
$out_HTML.= "<input class='tbox' id='pv_wm_typ' name='pv_wm_typ' type='radio' value='text'";
if ($PView -> getPView_config('wm_typ') == "text") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_261;
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_250.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_251."</td><td class='forumheader3'>.../pviewgallery/watermark/ <input class='tbox' id='pv_wm_image' name='pv_wm_image' type='text' size='30' maxlength='60' value='".$tp -> toForm($PView -> getPView_config('wm_image'))."' /></td></tr>";
$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_252.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_253."</td><td class='forumheader3'><input class='tbox' id='pv_wm_text' name='pv_wm_text' type='text' size='40' maxlength='60' value='".$tp -> toForm($PView -> getPView_config('wm_text'))."' /><br />";
$out_HTML.= "<p>".LAN_ADMIN_267."</p>";
$out_HTML.= "<table align='left' style='width:300px; border:0px;'>";
$out_HTML.= "<tr><td style='width:100px; text-align:left;'>- SITENAME</td><td style='width:200px; text-align:left;'>".LAN_ADMIN_268."</td></tr>";
$out_HTML.= "<tr><td style='width:100px; text-align:left;'>- USERNAME</td><td style='width:200px; text-align:left;'>".LAN_ADMIN_269."</td></tr>";
$out_HTML.= "<tr><td style='width:100px; text-align:left;'>- DATE</td><td style='width:200px; text-align:left;'>".LAN_ADMIN_270."</td></tr>";
$out_HTML.= "<tr><td colspan='2' style='width:300px; text-align:left;'>".LAN_ADMIN_271."</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_254."</td><td class='forumheader3'><script type='text/javascript' src='".e_PLUGIN."pviewgallery/ext_js/jscolor/jscolor.js'></script>#<input class='color' id='pv_wm_color' name='pv_wm_color' value='".$tp -> toForm($PView -> getPView_config('wm_color'))."'></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_255."</td><td class='forumheader3'>.../pviewgallery/watermark/ <input class='tbox' id='pv_wm_font' name='pv_wm_font' type='text' size='30' maxlength='60' value='".$tp -> toForm($PView -> getPView_config('wm_font'))."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_256."</td><td class='forumheader3'><input class='tbox' id='pv_wm_fontsize' name='pv_wm_fontsize' type='text' size='3' maxlength='3' value='".$tp -> toForm($PView -> getPView_config('wm_fontsize'))."' /> px</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_257."</td><td class='forumheader3'><input class='tbox' id='pv_wm_angle' name='pv_wm_angle' type='text' size='3' maxlength='3' value='".$tp -> toForm($PView -> getPView_config('wm_angle'))."' /> ".LAN_ADMIN_272."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_258."</td><td class='forumheader3'><input class='tbox' id='pv_wm_padding' name='pv_wm_padding' type='text' size='3' maxlength='3' value='".$tp -> toForm($PView -> getPView_config('wm_padding'))."' /> px</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_240, $out_HTML);

require_once(e_ADMIN."footer.php");
?>