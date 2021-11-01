<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/comment_menu/config.php $
|     $Revision: 11678 $
|     $Id: config.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
$eplug_admin = TRUE;
require_once("../../class2.php");
if (!getperms("1")) {
	header("location:".e_BASE."index.php");
	 exit ;
}

require_once(e_HANDLER."userclass_class.php");
	
include_lan(e_PLUGIN."comment_menu/languages/".e_LANGUAGE.".php");

require_once(e_ADMIN."auth.php");
	
if (isset($_POST['update_menu'])) {
	while (list($key, $value) = each($_POST)) {
		if ($value != CM_L9) {
			$menu_pref[$key] = $value;
		}
	}
	if (!$_POST['comment_title']) {
		$menu_pref['comment_title'] = 0;
	}
	$tmp = addslashes(serialize($menu_pref));
	$sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
	$ns->tablerender("", "<div style=\"text-align:center\"><b>".CM_L10."</b></div>");
}
	
$text = "<div style='text-align:center'>
	<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"menu_conf_form\">
	<table style=\"width:85%\" class=\"fborder\" >
	 
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".CM_L3.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"comment_caption\" size=\"20\" value=\"".$menu_pref['comment_caption']."\" maxlength=\"100\" />
	</td>
	</tr>
	 
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".CM_L4.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"comment_display\" size=\"20\" value=\"".$menu_pref['comment_display']."\" maxlength=\"2\" />
	</td>
	</tr>
	 
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".CM_L5.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"comment_characters\" size=\"20\" value=\"".$menu_pref['comment_characters']."\" maxlength=\"4\" />
	</td>
	</tr>
	 
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".CM_L6.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"comment_postfix\" size=\"30\" value=\"".$menu_pref['comment_postfix']."\" maxlength=\"200\" />
	</td>
	</tr>
	 
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".CM_L7.": </td>
	<td style=\"width:60%\" class='forumheader3'>
	<input type=\"checkbox\" name=\"comment_title\" value=\"1\"";
if ($menu_pref['comment_title']) {
	$text .= " checked ";
}
$text .= " />
	</td>
	</tr>
	 
	<tr>
	<td colspan=\"2\" class='forumheader' style=\"text-align:center\"><input class=\"button\" type=\"submit\" name=\"update_menu\" value=\"".CM_L9."\" /></td>
	</tr>
	</table>
	</form>
	</div>";
$ns->tablerender(CM_L8, $text);
require_once(e_ADMIN."footer.php");
?>