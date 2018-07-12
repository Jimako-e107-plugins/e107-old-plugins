<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
header("Content-type: application/xml");
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<rss version=\"2.0\">\n<channel>\n");
// ============= START OF THE RSS Construction ========================
$buid = intval($_GET['id']);
$sql -> db_Select("user", "user_name, user_image", "user_id=".$buid);
$row = $sql-> db_Fetch();
$rsstitle = $row['user_name'].MACGURUBLOG_MENU_9;
$rsslinkbase = SITEURL.substr(e_PLUGIN,6)."macgurublog_menu/";
$rsslink = $rsslinkbase."macgurublog.php?uid=".$buid;
echo('<title>'.$rsstitle."</title>\n");	
echo('<link>'.$rsslink."</link>\n");

if ($row['user_image'] != NULL) {
	require_once(e_HANDLER."avatar_handler.php");
	echo("<image>\n<url>".SITEURLBASE.substr(avatar($row['user_image']),5)."</url>\n<title>".$rsstitle."</title>\n");
	echo("<link>".$rsslink."</link>\n</image>\n");
}	

$sql -> db_Select("macgurublog_main", "*", "blog_uid=".$buid);
$row = $sql-> db_Fetch();
echo('<description>'.$row['blog_title']."</description>\n");

if ($row['blog_enable'] == 0) {
	echo("\n<item>\n<title>".$rsstitle."</title>\n<link>".$rsslink."</link>\n<description>".MACGURUBLOG_MENU_10."</description>\n</item>\n");
} else {
	$c = $sql -> db_Count("macgurublog_rec", '(*)', 'where blogrec_uid='.$buid);
	if ($c == 0) {
		echo("\n<item>\n<title>".$rsstitle."</title>\n<link>".$rsslink."</link>\n<description>".MACGURUBLOG_MENU_11."</description>\n</item>\n");
	} else {
		$sql -> db_Select("macgurublog_rec", "*", "blogrec_uid=".$buid." ORDER BY blogrec_date DESC LIMIT 10".$grp);
		while($row = $sql-> db_Fetch()){
			echo("\n<item>\n<title>".$tp->toHTML($row['blogrec_title'], true, "emotes_off")."</title>\n");
			$rsslink = $rsslinkbase."comment.php?rid=".$row['blogrec_id'];
			echo("<link>".$rsslink."</link>\n<description>".$tp->toHTML($row['blogrec_text'], true, "emotes_off")."</description>\n</item>\n");
		}
	}
}
// ====================================================================
echo("</channel>\n</rss>");
?>
