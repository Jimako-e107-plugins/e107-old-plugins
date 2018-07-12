<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$blognewlist = "\n".MACGURUBLOG_MENU_77." <br />\n";

$c = $sql -> db_Count('macgurublog_rec', '(*)', 'where blogrec_date>='.USERLV);
if ($c == 0) {
	$blognewlist .= ''.MACGURUBLOG_MENU_78.' '.MACGURUBLOG_MENU_79." <br />\n";
} elseif ($c == 1) {
	$blognewlist .= ''.MACGURUBLOG_MENU_83.' 1 '.MACGURUBLOG_MENU_79.($pref['macgurublog_4']?":":"")." <br />\n";
} else {
	$blognewlist .= ''.MACGURUBLOG_MENU_84.' '.$c.' '.MACGURUBLOG_MENU_80.($pref['macgurublog_4']?":":"")." <br />\n";
}
if ($c > 0 && $pref['macgurublog_4']) {
	$sql -> db_Select('macgurublog_rec', '*', 'blogrec_date>='.USERLV.' group by blogrec_uid');
	$nsql = new db;
	while ($row = $sql-> db_Fetch()) {
		extract($row);
		$nsql -> db_Select("user", "user_name", "user_id=".$row['blogrec_uid']);
		$nrow = $nsql-> db_Fetch();
		extract($nrow);
		$name = $nrow['user_name'];
		$blognewlist .= '<a href="'.($wapmode ? 'wapblog.php' : e_PLUGIN.'macgurublog_menu/macgurublog.php').'?uid='.$row['blogrec_uid'].'">'.$name."</a>, \n";
	}
	$blognewlist = substr($blognewlist, 0, -4)." <br />\n";
}

$c = $sql -> db_Count('macgurublog_com', '(*)', 'where blogcom_date>='.USERLV);
if ($c == 0) {
	$blognewlist .= ''.MACGURUBLOG_MENU_78.' '.MACGURUBLOG_MENU_81." <br />\n";
} elseif ($c == 1) {
	$blognewlist .= ''.MACGURUBLOG_MENU_83.' 1 '.MACGURUBLOG_MENU_81.($pref['macgurublog_4']?":":"")." <br />\n";
} else {
	$blognewlist .= ''.MACGURUBLOG_MENU_84.' '.$c.' '.MACGURUBLOG_MENU_82.($pref['macgurublog_4']?":":"")." <br />\n";
}
if ($c > 0 && $pref['macgurublog_4']) {
	$p = MPREFIX;
	$sql -> db_Query("select ${p}macgurublog_com.blogcom_rid, ${p}macgurublog_rec.blogrec_title, ${p}user.user_name, count(*) as cnt from ${p}macgurublog_com left join ${p}macgurublog_rec on (blogcom_rid=blogrec_id) left join ${p}user on (blogrec_uid=user_id) where blogcom_date>=".USERLV." group by blogcom_rid;");
	while ($row = $sql-> db_Fetch()) {
		$blognewlist .= '<a href="'.($wapmode ? "wap_comment.php" : e_PLUGIN.'macgurublog_menu/comment.php').'?rid='.$row['blogcom_rid']."\">${row['blogrec_title']} (${row['user_name']})".($row['cnt']>1?"(${row['cnt']})":"")."</a>, \n";
	}
	$blognewlist = substr($blognewlist, 0, -4)."\n";
}

?>