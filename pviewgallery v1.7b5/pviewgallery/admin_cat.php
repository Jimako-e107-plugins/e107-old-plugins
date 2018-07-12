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
if ($_POST['pv_admin'] == "admin_cat") {
	global $sql;
	$sqlOK = "nochanges";
	
	$pviewName = $tp -> toDB($_POST['pv_name']);
	$pviewDesc = $tp -> toDB($_POST['pv_description']);
	$pviewIcon = $tp -> toDB($_POST['pv_icon']);	
	
	if (isset ($_POST['pv_cat_edit'])) {
		$catId = $_POST['pv_cat_edit'];
		// Daten mit übergebener ID ändern
		$catTemp = $PView -> getCatData($catId);
		if ($pviewName <> $catTemp['name'] OR $pviewDescription <> $catTemp['description'] OR $pviewIcon <> $catTemp['icon']) {
			$sqlOK = $sql -> db_Update("pview_cat","name='$pviewName', description='$pviewDesc', icon='$pviewIcon' WHERE catId='$catId'");
		}
		
	} else {
		// Daten insert
		$sqlOK = $sql -> db_Insert("pview_cat","0,'$pviewName', '$pviewDesc', '$pviewIcon'");
	}
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// delete category
$catId = $_GET['delete'];
if ($catId){
	if (!$_GET['confirm']){
	$ns->tablerender(LAN_ADMIN_80, $PView -> getDelConfirm(LAN_ADMIN_79.$catId));
	require_once(e_ADMIN."footer.php");
	exit;
	} else {
		$sql -> db_Delete("pview_cat","catId=$catId");
	}
	
}

// new / edit category
$cat_appl = LAN_ADMIN_81;
$handle = opendir(e_IMAGE."icons");
while ($file = readdir($handle)) {
	if ($file != "." && $file != ".." && $file != "/" && $file != "null.txt" && $file != "CVS") {
		$iconlist[] = $file;
	}
}
closedir($handle);
$category_button = $iconlist[0];

	$out_HTML.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pv_name').value == \"\") {
						alert('".LAN_ACTION_4."');
						return false;
					}
				}
				</script>";
$out_HTML.= "<form action='".e_SELF."' method='post' onsubmit='return frmVerify()'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_cat'>";
if (isset($_GET['edit'])){
	if ($catData = $PView -> getCatData($_GET['edit'])){
		$out_HTML.= "<input type='hidden' name='pv_cat_edit' value='".$_GET['edit']."'>";
		$cat_appl = LAN_ADMIN_82;
		$catName = $catData['name'];
		$catDesc = $catData['description'];
		$catIcon = $catData['icon'];
	}
}
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_83."</td><td class='forumheader3' width='70%'><input class='tbox' type='text' id='pv_name' name='pv_name' value='".$tp -> toForm($catName)."' size='30' maxlength='60'></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_84."</td><td class='forumheader3' width='70%'><textarea class='tbox' id='pv_desription' name='pv_description'cols='60' rows='5'>".$tp -> toForm($catDesc)."</textarea></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_85."</td><td class='forumheader3' width='70%'><input class='tbox' type='text' id='pv_icon' name='pv_icon' value='".$tp -> toForm($catIcon)."' size='60' maxlength='250'><br /><br />";
$out_HTML.= "<input class='button' type ='button' size='30' value='".LAN_ADMIN_86."' onclick='expandit(\"caticn\")' />";
$out_HTML.= "<div id='caticn' style='display:none'>";
while (list($key, $icon) = each($iconlist)) {
	$out_HTML .= "<a href=\"javascript:insertext('$icon','pv_icon','caticn')\"><img src='".e_IMAGE."icons/".$icon."' style='border:0' alt='' /></a>\n ";
}
$out_HTML .= "</div></td></tr>";


$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".$cat_appl."'>&nbsp;";
$out_HTML.= "</form>";

$ns->tablerender($cat_appl, $out_HTML);
// show categories
$out_HTML = "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='fcaption' width='5%'>ID</td><td class='fcaption' style='text-align:center;' width='15%'>".LAN_ADMIN_85."</td><td class='fcaption' width='65%'>".LAN_ADMIN_79."</td><td class='fcaption' width='15%'>".LAN_ADMIN_87."</td></tr>";
$sql->db_Select("pview_cat", "*","ORDER BY catId", "nowhere");
while ($catData = $sql -> db_Fetch()){
	if ($catData['icon']){
		$out_HTML.= "<tr><td class='forumheader3' width='5%'>".$catData['catId']."</td><td class='forumheader3' style='text-align:center;' width='15%'><img src='".e_IMAGE."icons/".$catData['icon']."'></td><td class='forumheader3' width='65%'>".$catData['name']."<br /><span class='smalltext'>".$catData['description']."</span></td><td class='forumheader3' width='15%'><a href='".e_SELF."?edit=".$catData['catId']."'><img src='".e_IMAGE."admin_images/edit_16.png' title='".LAN_ADMIN_49."'></a> <a href='".e_SELF."?delete=".$catData['catId']."'><img src='".e_IMAGE."admin_images/delete_16.png' title='".LAN_ADMIN_50."'></a></td></tr>";
	} else {
		$out_HTML.= "<tr><td class='forumheader3' width='5%'>".$catData['catId']."</td><td class='forumheader3' style='text-align:center;' width='15%'>&nbsp;</td><td class='forumheader3' width='65%'>".$catData['name']."<br /><span class='smalltext'>".$catData['description']."</span></td><td class='forumheader3' width='15%'><a href='".e_SELF."?edit=".$catData['catId']."'><img src='".e_IMAGE."admin_images/edit_16.png' title='".LAN_ADMIN_49."'></a> <a href='".e_SELF."?delete=".$catData['catId']."'><img src='".e_IMAGE."admin_images/delete_16.png' title='".LAN_ADMIN_50."'></a></td></tr>";
	}
}
$out_HTML.= "</table>";

$ns->tablerender(LAN_ADMIN_62, $out_HTML);


require_once(e_ADMIN."footer.php");