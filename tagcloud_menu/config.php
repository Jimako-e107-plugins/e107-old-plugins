<?php
/*
+---------------------------------------------------------------+
| e107 Tag Cloud Menu v-1.1
| /tagcloud_menu.php
|
| Compatible with the e107 content management system
|  http://e107.org
| $Source: /cvsroot/e107/e107_0.7/e107_plugins/tagcloud_menu/tagcloud_menu.php,v $
| $Date: 2008/05/05  $
| $Author: Jeez! jeez73@ya.ru  http://www.4goodluck.org $
+---------------------------------------------------------------+
*/
$eplug_admin = TRUE;
require_once("../../class2.php");
if (!getperms("1")) {
	header("location:".e_BASE."index.php");
	 exit ;
}
require_once(e_ADMIN."auth.php");
@include_once(e_PLUGIN."tagcloud_menu/languages/admin/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."tagcloud_menu/languages/admin/English.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
	
if (isset($_POST['update_menu'])) {
	while (list($key, $value) = each($_POST)) {
		if ($key != "update_menu") { $menu_pref[$key] = $value; }
}
	$tmp = addslashes(serialize($menu_pref));
	$sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
	$ns->tablerender("", "<div style=\"text-align:center\"><b>".CLOUD_AD_L1."</b></div>");

}
$text .= "<div style='text-align:center'>
	<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"menu_conf_form\">
	<table style=\"width:85%\" class=\"fborder\">";
	
//  Title
$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L2.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"cloud_caption\" size=\"20\" value=\"".$menu_pref['cloud_caption']."\" maxlength=\"100\" />
	</td>
	</tr>";
	
//  Min size
$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L9.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"cloud_mins\" size=\"10\" value=\"".$menu_pref['cloud_mins']."\" maxlength=\"3\" />
	<br /></td>
	</tr>";

//  Max size
$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L10.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"cloud_maxs\" size=\"10\" value=\"".$menu_pref['cloud_maxs']."\" maxlength=\"3\" />
	<br /></td>
	</tr>";
	
//  Cloud size in px or pt or %
$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L14.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"cloud_pts\" size=\"10\" value=\"".$menu_pref['cloud_pts']."\" maxlength=\"3\" />
	<br /><b class='smalltext'>".CLOUD_AD_L12."</b></td>
	</tr>";
	
// Align
$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L11.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"cloud_align\" size=\"10\" value=\"".$menu_pref['cloud_align']."\" maxlength=\"10\" />
	<br /><b class='smalltext'>".CLOUD_AD_L13."</b></td>
	</tr>";
	
// Tag Cloud Words
	$text .= "<tr>
	<td style=\"width:40%\" class='forumheader3'>".CLOUD_AD_L15.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<textarea class=\"tbox\" name=\"cloud_words\" cols='55' rows='8'>".$menu_pref['cloud_words']."</textarea>
	<br /><b class='smalltext'>".CLOUD_AD_L16."</b></td>
	</tr>";
	
$text .= "<tr style=\"vertical-align:top\">
	<td colspan=\"2\"  style=\"text-align:center\" class='forumheader'>
	<input class=\"button\" type=\"submit\" name=\"update_menu\" value=\"".CLOUD_AD_L3."\" />
	</td>
	</tr>
	</table>
	</form>
	</div>";
$ns->tablerender(CLOUD_AD_L4, $text);
require_once(e_ADMIN."footer.php");
?>