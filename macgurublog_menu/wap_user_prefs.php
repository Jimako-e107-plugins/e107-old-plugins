<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('mgbwap.php');
$mgbw -> head(true);
//----------------------------------------
if (isset($_POST['enable'])) {
	$macgurublog_enable = intval($_POST['enable']);
	$sql -> db_Update("macgurublog_main", "blog_enable=$macgurublog_enable WHERE blog_uid=".USERID);
	echo '<p align="center"><b>'.MACGURUBLOG_MENU_28."</b></p>\n";
}

$sql -> db_Select('macgurublog_main', 'blog_enable', 'blog_uid='.USERID);
$row = $sql -> db_Fetch();;
extract($row);

echo '<p align="center">'.MACGURUBLOG_MENU_7.":<br/>\n";
echo "<select name=\"xvisible\">\n";
if ($row['blog_enable'] == 1) {
	echo '<option value="1">'.MACGURUBLOG_MENU_94."</option>\n";
	echo '<option value="0">'.MACGURUBLOG_MENU_95."</option>\n";
} else {
	echo '<option value="0">'.MACGURUBLOG_MENU_95."</option>\n";
	echo '<option value="1">'.MACGURUBLOG_MENU_94."</option>\n";
}
echo "</select><br/>\n";
echo "<anchor>\n";
echo '<go method="post" href="wap_user_prefs.php'.$mgbw->rnd.'">'."\n";
echo '<postfield name="enable" value="$(xvisible)"/>'."\n";
echo '</go>'."\n";
echo MACGURUBLOG_MENU_8."\n";
echo "</anchor>\n</p>\n";

echo("<p><a href=\"wapblog.php\">".$pref['macgurublog_11']."</a><br/>\n");
echo("<a href=\"wap.php?loggout\">".MACGURUBLOG_MENU_93."</a></p>\n");
//----------------------------------------
$mgbw -> foot();
?>