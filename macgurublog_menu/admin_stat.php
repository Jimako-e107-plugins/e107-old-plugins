<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
$pageid = "stat";
// ------------------------------
$count = $sql -> db_Count("macgurublog_main");
if ($count != 0) {
	$sql -> db_Select("macgurublog_main");
	$nsql = new db;
	$text = "<div style='text-align:center'>
	<table style='width:94%' class='fborder'>";
	$text .="<tr>
	<td style=\"width:40%; vertical-align:top\" class=\"forumheader\">".MACGURUBLOG_MENU_59."</td>
	<td style=\"width:20%; vertical-align:top\" class=\"forumheader\">".MACGURUBLOG_MENU_60."</td>
	<td style=\"width:20%; vertical-align:top\" class=\"forumheader\">".MACGURUBLOG_MENU_61."</td>
	<td style=\"width:20%; vertical-align:top\" class=\"forumheader\">".MACGURUBLOG_MENU_4."</td>
	</tr>";
	while($row = $sql-> db_Fetch()){
		extract($row);
		$nsql -> db_Select("user", "user_name", "user_id=".$row['blog_uid']);
		$xrow = $nsql-> db_Fetch();
		extract($xrow);
		$name = $xrow['user_name'];
		$recs = $nsql -> db_Count('macgurublog_rec', '(*)', 'where blogrec_uid='.$row['blog_uid']);
		$nsql -> db_Select('macgurublog_rec, '.MPREFIX.'macgurublog_com', 'count(*) as darab', MPREFIX.'macgurublog_com.blogcom_rid='.MPREFIX.'macgurublog_rec.blogrec_id and '.MPREFIX.'macgurublog_rec.blogrec_uid='.$row['blog_uid']);
		$xrow = $nsql-> db_Fetch();
		extract($xrow);
		$coms = $xrow['darab'];
		$text .="<tr>
        <td style=\"width:40%; vertical-align:top\" class=\"forumheader3\">".$name."</td>
		<td style=\"width:20%; vertical-align:top\" class=\"forumheader3\">".$recs."</td>
		<td style=\"width:20%; vertical-align:top\" class=\"forumheader3\">".$coms."</td>
		<td style=\"width:20%; vertical-align:top\" class=\"forumheader3\"><a href='user_prefs.php?fuid=".$row['blog_uid']."'>".MACGURUBLOG_MENU_13."</a></td>
		</tr>";
	}
	$text .= '</table></div>';
	$ns -> tablerender(MACGURUBLOG_MENU_53, $text);
} else {
	$ns -> tablerender(MACGURUBLOG_MENU_53, MACGURUBLOG_MENU_1);
}
// ------------------------------
require_once(e_ADMIN."footer.php");

?>