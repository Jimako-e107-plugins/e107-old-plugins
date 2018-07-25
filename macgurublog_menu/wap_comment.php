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
if (isset($_POST['rid'])) {
	$rid = intval($_POST['rid']);
} else {
	$rid = intval($_GET['rid']);
}
$sql -> db_Select('macgurublog_rec', 'blogrec_uid', 'blogrec_id='.$rid);
if ($sql -> db_Rows() == NULL) {
	echo '<p align="center"><b>'.MACGURUBLOG_MENU_32."</b></p>\n";
} else {
	$row = $sql -> db_Fetch();
	extract($row);
	$uid = $row['blogrec_uid'];
	$sql -> db_Select('macgurublog_main', 'blog_enable', 'blog_uid='.$uid);
	$row = $sql -> db_Fetch();
	extract($row);
	if ($row['blog_enable'] == 1 || $mgb -> own($rid) || getperms("P")) {
		//
		if (isset($_POST['mgblog_comtext'])) {
			$comment_text = $tp->toDB($_POST["mgblog_comtext"]);
			if ($comment_text == NULL) {
				echo '<p align="center"><b>'.MACGURUBLOG_MENU_26."</b></p>\n";
			} else {
				$t = time();
				$uid = USERID;
				$sql -> db_Insert("macgurublog_com", "0, $rid, $t, $uid, '$comment_text'");
				echo '<p align="center"><b>'.MACGURUBLOG_MENU_25."</b></p>\n";
			}
		}
		//
		$sql -> db_Select("macgurublog_com", "*", "blogcom_rid=".$rid);
		if ($sql -> db_Rows() != 0) {
			$nsql = new db;
			while($row = $sql-> db_Fetch()){
				extract($row);
				if ($row['blogcom_uid'] != 0) {
					$nsql -> db_Select("user", "user_name", "user_id=".$row['blogcom_uid']);
					$nrow = $nsql -> db_Fetch();
					extract($nrow);
					$text .= '<p><b>'.$nrow['user_name'].":</b><br/>\n";
					$text .= $tp->toHTML($row['blogcom_text'], true)."<br/>\n";
				} else {
					$tmp = unserialize($row['blogcom_text']);
					$text .= '<p><b>'.$tmp['gname']." (".MACGURUBLOG_MENU_110."):</b><br/>\n";
					$text .= $tp->toHTML($tmp['commenttext'], true)."<br/>\n";
				}
				$text .= $mgb -> dt(4, $row['blogcom_date'])."<br/>-----</p>\n";
			}
			echo $text;
		}
		//
		if ($pref['macgurublog_8'] == true) {
			echo '<p align="center"><b>'.MACGURUBLOG_MENU_96."</b></p>\n";
		}
		echo '<p align="center">'.MACGURUBLOG_MENU_23.":<br/>\n";
		echo '<input name="xcont"/>'."<br/>\n";
		echo "<anchor>\n";
		echo '<go method="post" href="wap_comment.php'.$mgbw->rnd.'">'."\n";
		echo '<postfield name="mgblog_comtext" value="$(xcont)"/>'."\n";
		echo '<postfield name="rid" value="'.$rid.'"/>'."\n";
		echo '</go>'."\n";
		echo MACGURUBLOG_MENU_24."\n";
		echo "</anchor>\n</p>\n";
		//
	} else {
		echo '<p align="center"><b>'.MACGURUBLOG_MENU_10."</b></p>\n";
	}
}

echo("<p><a href=\"wapblog.php\">".$pref['macgurublog_11']."</a><br/>\n");
echo("<a href=\"wap.php?loggout\">".MACGURUBLOG_MENU_93."</a></p>\n");
//----------------------------------------
$mgbw -> foot();
?>