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
$speedArray = array("0" => LAN_ADMIN_70,"5" => LAN_ADMIN_71,"20" => LAN_ADMIN_72,"50" => LAN_ADMIN_73,"100" => LAN_ADMIN_74);
$CommViewArray	= array("img" => LAN_ADMIN_276,"imgcomm" => LAN_ADMIN_277,"comm" => LAN_ADMIN_278);

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
if ($_POST['pv_admin'] == "admin_menuconfig") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","menu_display",$_POST['pv_menu_display'],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","menu_pics",$_POST['pv_menu_pics'].",".$_POST['pv_menu_pics_active']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","menu_dir",$_POST['pv_menu_dir']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","feature_dir",$_POST['pv_feature_dir']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","menu_allGal",$_POST['pv_menu_allGal'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_menu_extJS",$_POST['pv_img_Link_menu_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","scroll_speed",array_search($_POST['pv_scroll_speed'],$speedArray));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","comViewMenu",array_search($_POST['pv_comViewMenu'],$CommViewArray));    
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","force_imageSize",$_POST['pv_force_imageSize'],"checkbox");
	if (!$_POST['pv_force_Width'] && $_POST['pv_force_imageSize'] == "on") {
		$pviewSave = "80"; // default
	} else {
		$pviewSave = $_POST['pv_force_Width'];
	}
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","force_Width",$pviewSave);
	if (!$_POST['pv_force_Height'] && $_POST['pv_force_imageSize'] == "on") {
		$pviewSave = "80"; // default
	} else {
		$pviewSave = $_POST['pv_force_Height'];
	}
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","force_Height",$pviewSave);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","menu_comm_count",$_POST['pv_menu_comm_count']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","menu_comm_length",$_POST['pv_menu_comm_length']);
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

$menuPics = explode(",",$tp -> toForm($PView -> getPView_config('menu_pics')));

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_menuconfig'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_144."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_201."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_menu_extJS' name='pv_img_Link_menu_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_menu_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_208.LAN_ADMIN_204."</p>";
$out_HTML.= "<p>".LAN_ADMIN_209."</p>";
$out_HTML.= "</td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_76."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_force_imageSize' name='pv_force_imageSize' value='on' ";
if ($PView -> getPView_config('force_imageSize')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_77."</td><td class='forumheader3'><input class='tbox' id='pv_force_Width' name='pv_force_Width' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('force_Width')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' style='padding-left:10px'>".LAN_ADMIN_78."</td><td class='forumheader3'><input class='tbox' id='pv_force_Height' name='pv_force_Height' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('force_Height')."' /></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_213."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_63."</td><td class='forumheader3'><input class='tbox' id='pv_menu_display' name='pv_menu_display' type='radio' value='latest'";
if ($PView -> getPView_config('menu_display') == "latest") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_MENU_1."<br />";
$out_HTML.= "<input class='tbox' id='pv_menu_display' name='pv_menu_display' type='radio' value='random'";
if ($PView -> getPView_config('menu_display') == "random") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_MENU_2."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_64."</td><td class='forumheader3'><input class='tbox' id='pv_menu_pics' name='pv_menu_pics' type='text' size='2' maxlength='2' value='".$menuPics[0]."' /> ".LAN_ADMIN_122."<br /><br />";
$out_HTML.= "<input class='tbox' id='pv_menu_pics_active' name='pv_menu_pics_active' type='text' size='2' maxlength='2' value='".$menuPics[1]."' /> ".LAN_ADMIN_123."<br /><br />";
$out_HTML.= LAN_ADMIN_124_1.LAN_ADMIN_124_2."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_65."</td><td class='forumheader3'><input class='tbox' id='pv_menu_dir' name='pv_menu_dir' type='radio' value='vert'";
if ($PView -> getPView_config('menu_dir') == "vert") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_66."<br />";
$out_HTML.= "<input class='tbox' id='pv_menu_dir' name='pv_menu_dir' type='radio' value='hor'";
if ($PView -> getPView_config('menu_dir') == "hor") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_67."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_68."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_menu_allGal' name='pv_menu_allGal' value='on' ";
if ($PView -> getPView_config('menu_allGal')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_69."</td></tr>";



$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_75."</td><td class='forumheader3'><select class='tbox' id='pv_scroll_speed' name='pv_scroll_speed'>";
foreach ($speedArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('scroll_speed')) {
		$out_HTML.= "<option selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option>".$dataset."</option>";
	}
}
$out_HTML.= "</select></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_214."</td></tr>";

// jetzt und hier
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_63."</td><td class='forumheader3'><select class='tbox' id='pv_comViewMenu' name='pv_comViewMenu'>";
foreach ($CommViewArray as $key => $dataset) {
	if ($key == $PView -> getPView_config('comViewMenu')) {
		$out_HTML.= "<option selected>".$dataset."</option>";
	} else {
		$out_HTML.= "<option>".$dataset."</option>";
	}
}
$out_HTML.= "</select></td></tr>";


$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_110."</td><td class='forumheader3'><input class='tbox' id='pv_menu_comm_count' name='pv_menu_comm_count' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('menu_comm_count')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_111."</td><td class='forumheader3'><input class='tbox' id='pv_menu_comm_length' name='pv_menu_comm_length' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('menu_comm_length')."' /></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_215."</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_65."</td><td class='forumheader3'><input class='tbox' id='pv_feature_dir' name='pv_feature_dir' type='radio' value='vert'";
if ($PView -> getPView_config('feature_dir') == "vert") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_66."<br />";
$out_HTML.= "<input class='tbox' id='pv_feature_dir' name='pv_feature_dir' type='radio' value='hor'";
if ($PView -> getPView_config('feature_dir') == "hor") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_67."</td></tr>";

$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_6, $out_HTML);

require_once(e_ADMIN."footer.php");