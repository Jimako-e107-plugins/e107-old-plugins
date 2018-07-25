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
if ($sql -> db_Count('macgurublog_main', '(*)', 'where blog_uid='.USERID) != 1) {
	echo '<p align="center">'.MACGURUBLOG_MENU_88.'</p>';
} else {
	if (isset($_POST['mgblog_rectext'])) {
		$entry_title = $tp->toDB($_POST["mgblog_rectitle"]);
		$entry_text = $tp->toDB($_POST["mgblog_rectext"]);
		if ($entry_text == NULL) {
			echo '<p align="center"><b>'.MACGURUBLOG_MENU_19."</b></p>\n";
		} else {
			$t = time();
			$uid = USERID;
			$sql -> db_Insert("macgurublog_rec", "0, $uid, $t, '$entry_title', '$entry_text', ".intval($_POST["mgblog_reccat"]));
			echo '<p align="center"><b>'.MACGURUBLOG_MENU_18."</b></p>\n";
		}
	}
	if ($pref['macgurublog_8'] == true) {
		echo '<p align="center"><b>'.MACGURUBLOG_MENU_96."</b></p>\n";
	}
	$sql -> db_Select("macgurublog_tag", "*", "blogtag_uid=".USERID);
	while($row = $sql-> db_Fetch()){
		$cats[$row['blogtag_id']] = $row['blogtag_text'];
	}
	asort($cats);
	$cats[0] = MACGURUBLOG_MENU_114;
	$ncats = NULL;
	foreach($cats as $cid=>$cat) {
		$ncats .= '<option value="'.$cid.'">'.$cat."</option>\n";
	}
	echo '<p align="center">'.MACGURUBLOG_MENU_15.":<br/>\n";
	echo '<input name="xtitle" maxlength="100"/>'."<br/>\n";
	echo MACGURUBLOG_MENU_16.":<br/>\n";
	echo '<input name="xcont"/>'."<br/>\n";
	echo MACGURUBLOG_MENU_116.":<br/>\n<select name=\"xcat\">\n";
	echo $ncats."</select><br />\n<anchor>\n";
	echo '<go method="post" href="wap_blog_add.php'.$mgbw->rnd.'">'."\n";
	echo '<postfield name="mgblog_rectitle" value="$(xtitle)"/>'."\n";
	echo '<postfield name="mgblog_rectext" value="$(xcont)"/>'."\n";
	echo '<postfield name="mgblog_reccat" value="$(xcat)"/>'."\n";
	echo '</go>'."\n";
	echo MACGURUBLOG_MENU_17."\n";
	echo "</anchor>\n</p>\n";
}
echo("<p><a href=\"wapblog.php\">".$pref['macgurublog_11']."</a><br/>\n");
echo("<a href=\"wap.php?loggout\">".MACGURUBLOG_MENU_93."</a></p>\n");
//----------------------------------------
$mgbw -> foot();
?>