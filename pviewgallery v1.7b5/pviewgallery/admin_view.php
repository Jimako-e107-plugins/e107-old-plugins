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

$sortArray = $PView->getSortArray();

// Save values and clear all caches
if ($_POST['pv_admin'] == "admin_views") {
	// clear all caches
	$e107cache -> clear("pview");
	$e107cache -> clear("nq_pview");
	// database save
	if (!$_POST['pv_pics_per_row']){$_POST['pv_pics_per_row'] = "4";} //default for unvalid value
	$sqlOK = $PView -> pviewUpdateDb("pview_config","pics_per_row",$_POST['pv_pics_per_row']);
	if (!$_POST['pv_pics_per_page']){$_POST['pv_pics_per_page'] = "16";} //default for unvalid value
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","pics_per_page",$_POST['pv_pics_per_page']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","album_dir",$_POST['pv_album_dir']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","viewer_sort",$_POST['pv_viewer_sort'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","details_link",$_POST['pv_details_link'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","center_thumbs",$_POST['pv_center_thumbs'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_details",$_POST['pv_img_details'],"text");
	if (!$_POST['pv_gal_cols']){$_POST['pv_gal_cols'] = "1";} //default for unvalid value
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","gal_cols",$_POST['pv_gal_cols']);	
	
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","album_details",$_POST['pv_album_details'],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","cat_details",$_POST['pv_cat_details'],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","user_details",$_POST['pv_user_details'],"text");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","gal_details",$_POST['pv_gal_details'],"text");
	
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","album_sort",array_search($_POST['pv_album_sort'],$sortArray));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","cat_sort",array_search($_POST['pv_cat_sort'],$sortArray));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","user_sort",array_search($_POST['pv_user_sort'],$sortArray));
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_views'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_144.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_17."</td><td class='forumheader3'><input class='tbox' id='pv_pics_per_row' name='pv_pics_per_row' type='text' size='4' maxlength='3' value='".$PView -> getPView_config('pics_per_row')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_18."</td><td class='forumheader3'><input class='tbox' id='pv_pics_per_page' name='pv_pics_per_page' type='text' size='4' maxlength='4' value='".$PView -> getPView_config('pics_per_page')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_145."&nbsp;".LAN_ADMIN_108.":</td><td class='forumheader3'><input class='tbox' id='pv_album_dir' name='pv_album_dir' type='radio' value='ASC'";
if ($PView -> getPView_config('album_dir') == "ASC") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_145."&nbsp;".LAN_ADMIN_109.":</td><td class='forumheader3'><input class='tbox' id='pv_album_dir' name='pv_album_dir' type='radio' value='DESC'";
if ($PView -> getPView_config('album_dir') == "DESC") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_146."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_viewer_sort' name='pv_viewer_sort' value='on' ";
if ($PView -> getPView_config('viewer_sort')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_160."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_details_link' name='pv_details_link' value='on' ";
if ($PView -> getPView_config('details_link')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_168."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_center_thumbs' name='pv_center_thumbs' value='on' ";
if ($PView -> getPView_config('center_thumbs')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";


$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_164.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_167."</td><td class='forumheader3'><input class='tbox' id='pv_gal_details' name='pv_gal_details' type='text' size='60' maxlength='60' value='".$PView -> getPView_config('gal_details')."' /> <a href='#' onclick='javascript:document.getElementById(\"gal_viewhelp\").style.display = \"block\"'>".LAN_ADMIN_26."</a></td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_165."</td><td class='forumheader3'><input class='tbox' id='pv_gal_cols' name='pv_gal_cols' type='text' size='4' maxlength='3' value='".$PView -> getPView_config('gal_cols')."' /></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_162.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_161."</td><td class='forumheader3'><input class='tbox' id='pv_img_details' name='pv_img_details' type='text' size='60' maxlength='60' value='".$PView -> getPView_config('img_details')."' /> <a href='#' onclick='javascript:document.getElementById(\"img_viewhelp\").style.display = \"block\"'>".LAN_ADMIN_26."</a></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_149.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_147."</td><td class='forumheader3'>";
$out_HTML.= $PView->getSortBox("album");
$out_Form.= "</td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_148."</td><td class='forumheader3'><input class='tbox' id='pv_album_details' name='pv_album_details' type='text' size='60' maxlength='60' value='".$PView -> getPView_config('album_details')."' /> <a href='#' onclick='javascript:document.getElementById(\"viewhelp\").style.display = \"block\"'>".LAN_ADMIN_26."</a></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_151.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_147."</td><td class='forumheader3'>";
$out_HTML.= $PView->getSortBox("cat");
$out_Form.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_148."</td><td class='forumheader3'><input class='tbox' id='pv_cat_details' name='pv_cat_details' type='text' size='60' maxlength='60' value='".$PView -> getPView_config('cat_details')."' /> <a href='#' onclick='javascript:document.getElementById(\"viewhelp\").style.display = \"block\"'>".LAN_ADMIN_26."</a></td></tr>";

$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_153.":</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_147."</td><td class='forumheader3'>";
$out_HTML.= $PView->getSortBox("user");
$out_Form.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_148."</td><td class='forumheader3'><input class='tbox' id='pv_user_details' name='pv_user_details' type='text' size='60' maxlength='60' value='".$PView -> getPView_config('user_details')."' /> <a href='#' onclick='javascript:document.getElementById(\"viewhelp\").style.display = \"block\"'>".LAN_ADMIN_26."</a></td></tr>";

$out_HTML.= "</table>";

$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
// div container for helptext, hidden by default
$out_HTML.= "<div id='viewhelp'  class='fcaption' style='display:none; text-align:left; width:60%; margin:auto; margin-top:20px;'>";
$out_HTML.= "<p>".LAN_HELP_16."</p>";
$out_HTML.= "<p><a href='#' onclick='javascript:document.getElementById(\"viewhelp\").style.display = \"none\"'>".LAN_ADMIN_155."</a></p>";
$out_HTML.= "</div>";
$out_HTML.= "<div id='img_viewhelp'  class='fcaption' style='display:none; text-align:left; width:60%; margin:auto; margin-top:20px;'>";
$out_HTML.= "<p>".LAN_HELP_17."</p>";
$out_HTML.= "<p><a href='#' onclick='javascript:document.getElementById(\"img_viewhelp\").style.display = \"none\"'>".LAN_ADMIN_155."</a></p>";
$out_HTML.= "</div>";
$out_HTML.= "<div id='gal_viewhelp'  class='fcaption' style='display:none; text-align:left; width:60%; margin:auto; margin-top:20px;'>";
$out_HTML.= "<p>".LAN_HELP_18."</p>";
$out_HTML.= "<p><a href='#' onclick='javascript:document.getElementById(\"gal_viewhelp\").style.display = \"none\"'>".LAN_ADMIN_155."</a></p>";
$out_HTML.= "</div>";

$ns->tablerender(LAN_ADMIN_143, $out_HTML);

require_once(e_ADMIN."footer.php");
?>