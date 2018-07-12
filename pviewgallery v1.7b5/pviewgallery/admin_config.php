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

// Templates
$templates = $PView -> getTemplates();

// predefine static arrays
// selectbox text
$scriptArray = array("noscript" => LAN_ADMIN_235,"lightbox" => "LIGHTBOX", "shadowbox" => "SHADOWBOX", "highslide" => "HIGHSLIDE","lightbox26" => "LIGHTBOX NEW");

// GD Check
if (!function_exists('gd_info')) {
$out_HTML.= "<span style='font-weight:bold; color:red;'>".LAN_ADMIN_36."</span>";
}
// Save values and clear all caches
if ($_POST['pv_admin'] == "admin_config") {
	// clear all caches
	$e107cache -> clear("pview");
	$e107cache -> clear("nq_pview");
	// database save
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","pview_name",$_POST['pv_pview_name'],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","name",$_POST['pv_maingallery_name'],"text",0);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","active",$_POST['pv_main_gallery'],"checkbox",0);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","template",$_POST['pv_template']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_extJS_pview",$_POST['pv_img_Link_extJS_pview'],"checkbox",0);    
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_gal_extJS",$_POST['pv_img_Link_gal_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_search_extJS",$_POST['pv_img_Link_search_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_profileCom_extJS",$_POST['pv_img_Link_profileCom_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_profileImg_extJS",$_POST['pv_img_Link_profileImg_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_menu_extJS",$_POST['pv_img_Link_menu_extJS'],"checkbox",0); 
    $sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_extJS",$_POST['pv_img_Link_extJS']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","admin_Mode",$_POST['pv_admin_Mode'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","approval",$_POST['pv_approval'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","seo_links",$_POST['pv_seo_links'],"checkbox");	
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","keep_original_image",$_POST['pv_keep_original_image'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","create_thumb",$_POST['pv_create_thumb'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","thumb_width",$_POST['pv_thumb_width']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","thumb_height",$_POST['pv_thumb_height']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","resize_images",$_POST['pv_resize_images'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","max_image_width",$_POST['pv_max_image_width']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","max_image_height",$_POST['pv_max_image_height']);
	if ($_POST['pv_viewControl']) {
		$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","viewControl_by",$_POST['pv_viewControl_by'],"text");
	} else {
		$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","viewControl_by","0");
	}
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","ip_valid_time",$_POST['pv_ip_valid_time']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","file_limit",$_POST['pv_file_limit']);
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}
	
// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_config'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_7."</td><td class='forumheader3'><input class='tbox' id='pv_pview_name' name='pv_pview_name' type='text' size='30' maxlength='30' value='".$tp -> toForm($PView -> getPView_config('pview_name'))."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_14."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_main_gallery' name='pv_main_gallery' value='on' ";
if ($PView -> getGalleryActive(0)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$galData = $PView -> getGalleryData(0);
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_8."</td><td class='forumheader3'><input class='tbox' id='pv_maingallery_name' name='pv_maingallery_name' type='text' size='30' maxlength='30' value='".$tp -> toForm($galData['name'])."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_15."</td><td class='forumheader3'><select class='tbox' id='pv_template' name='pv_template'>";
for ($i = 0; $i < count($templates); $i++) {
	if ($templates[$i] == $PView -> getPView_config('template')) {
		$out_HTML.= "<option selected>".$templates[$i]."</option>";
	} else {
		$out_HTML.= "<option>".$templates[$i]."</option>";
	}
}
$out_HTML.= "</select>";
$out_HTML.= "<div name='tmp_info' id='tmp_info'>".$PView->getTemplateInfo()."</div>";
$out_HTML.= "</td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_201."</td><td class='forumheader3'><p>".LAN_ADMIN_203_1."</p><p>".LAN_ADMIN_203_2."<br />".LAN_ADMIN_203_3."<br />".LAN_ADMIN_203_4."</p><select class='tbox' id='pv_img_Link_extJS' name='pv_img_Link_extJS'>";
foreach ($scriptArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('img_Link_extJS')) {
		$out_HTML.= "<option value='".$key."' selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option value='".$key."' >".$dataset."</option>";
	}
}
$out_HTML.= "</select> ".LAN_ADMIN_211;
$out_HTML.= "<p><input class='tbox' type='checkbox' id='pv_img_Link_extJS_pview' name='pv_img_Link_extJS_pview' value='on' ";
if ($PView -> getPView_config('img_Link_extJS_pview')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_202."</p>";
$out_HTML.= "<p><input class='tbox' type='checkbox' id='pv_img_Link_gal_extJS' name='pv_img_Link_gal_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_gal_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_205.LAN_ADMIN_204."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_search_extJS' name='pv_img_Link_search_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_search_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_206.LAN_ADMIN_204."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_profileImg_extJS' name='pv_img_Link_profileImg_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_profileImg_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_207.LAN_ADMIN_204."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_profileCom_extJS' name='pv_img_Link_profileCom_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_profileCom_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_210.LAN_ADMIN_204."<br />";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_menu_extJS' name='pv_img_Link_menu_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_menu_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_208.LAN_ADMIN_204."</p>";
$out_HTML.= "</td></tr>";
/*
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_119."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_search_lightbox' name='pv_search_lightbox' value='on' ";
if ($PView -> getPView_config('search_lightbox')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/><br />";
//if (isset($pref['plug_installed']['lightbox'])){ for e107 version > 0.78
if ($lightbox = $sql->db_Select("plugin", "*", "plugin_path = 'lightbox' AND plugin_installflag = 1")) {
	$out_HTML.= LAN_ADMIN_120_1.LAN_ADMIN_120_2;
} else {
	$out_HTML.= "<span style='color:red;'>".LAN_ADMIN_120_1.LAN_ADMIN_120_3."</span>";
}
$out_HTML.= "</td></tr>";
*/
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_19."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_admin_Mode' name='pv_admin_Mode' value='on' ";
if ($PView -> getPView_config('admin_Mode')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_47."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_approval' name='pv_approval' value='on' ";
if ($PView -> getPView_config('approval')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_163."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_seo_links' name='pv_seo_links' value='on' ";
if ($PView -> getPView_config('seo_links')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_13."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_keep_original_image' name='pv_keep_original_image' value='on' ";
if ($PView -> getPView_config('keep_original_image')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_10.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_create_thumb' name='pv_create_thumb' value='on' ";
if ($PView -> getPView_config('create_thumb')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_12."</td><td class='forumheader3'><input class='tbox' id='pv_thumb_width' name='pv_thumb_width' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('thumb_width')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_11."</td><td class='forumheader3'><input class='tbox' id='pv_thumb_height' name='pv_thumb_height' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('thumb_height')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_9.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_resize_images' name='pv_resize_images' value='on' ";
if ($PView -> getPView_config('resize_images')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_12."</td><td class='forumheader3'><input class='tbox' id='pv_max_image_width' name='pv_max_image_width' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('max_image_width')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_11."</td><td class='forumheader3'><input class='tbox' id='pv_max_image_height' name='pv_max_image_height' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('max_image_height')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_20.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_viewControl' name='pv_viewControl' value='on' ";
if ($PView -> getPView_config('viewControl_by')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_21."</td><td class='forumheader3'><input class='tbox' id='pv_viewControl_by' name='pv_viewControl_by' type='radio' value='cookie'";
if ($PView -> getPView_config('viewControl_by') == "cookie") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_22."</td><td class='forumheader3'><input class='tbox' id='pv_viewControl_by' name='pv_viewControl_by' type='radio' value='session'";
if ($PView -> getPView_config('viewControl_by') == "session") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_24."</td><td class='forumheader3'><input class='tbox' id='pv_viewControl_by' name='pv_viewControl_by' type='radio' value='ip'";
if ($PView -> getPView_config('viewControl_by') == "ip") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /><input style='margin-left:20px' class='tbox' id='pv_ip_valid_time' name='pv_ip_valid_time' type='text' size='6' maxlength='5' value='".$PView -> getPView_config('ip_valid_time')."' /> ".LAN_ADMIN_25."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_59."</td><td class='forumheader3'><input class='tbox' id='pv_file_limit' name='pv_file_limit' type='text' size='4' maxlength='6' value='".$PView -> getPView_config('file_limit')."' /> kB ".LAN_ADMIN_60."</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_2, $out_HTML);

require_once(e_ADMIN."footer.php");
?>