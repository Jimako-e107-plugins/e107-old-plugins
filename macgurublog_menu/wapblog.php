<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('mgbwap.php');
//----------------------------------------
if (!isset($_GET['uid'])) {
	$mgbw -> head();
	//list
	$text = '';
	$count = $sql->db_Count("macgurublog_main");
	if ($count == 0) {
		echo '<p align="center">'.MACGURUBLOG_MENU_1.'</p>';
	} else {
		$sql -> db_Select("macgurublog_main");
		$nsql = new db;
		$nil = true;
		while($row = $sql-> db_Fetch()){
			extract($row);
			$nsql -> db_Select("user", "user_name", "user_id=".$row['blog_uid']);
			$xrow = $nsql-> db_Fetch();
			$name = $xrow['user_name'];
			if ($row['blog_enable'] == 1) {
				$bindex[strtolower($name)] = '<a href="wapblog.php?uid='.$row['blog_uid'].$mgbw->rndp.'">'.$name."</a><br/>\n";
			} elseif (getperms("P")) {
				$bindex[strtolower($name)] = '<i>!(<a href="wapblog.php?uid='.$row['blog_uid'].$mgbw->rndp.'">'.$name."</a>)</i><br/>\n";
			}
			if ($row['blog_uid'] == USERID) {
				$nil = false;
				if ($row['blog_enable'] == 0) {
					$obhidden = true;
				}
			}
		}
		//order
		if (is_array($bindex)) {
			ksort($bindex);
			reset($bindex);
			foreach($bindex as $row) {
				$text .= $row;
			}
		}
		//
		require(e_PLUGIN."macgurublog_menu/blognew.php");
		if (!$pref['macgurublog_3']) {
			$text .= "\n<p align=\"center\">======</p>\n";
			$text .= '<p>'.$blognewlist."</p>\n";
		}
		
		if (($nil && !$pref['macgurublog_2']) || !$nil || getperms("P")) {
			$text .= "\n<p align=\"center\">======</p>\n";
		}
		if (!$nil) {
			if ($obhidden) {
				$text .= MACGURUBLOG_MENU_20;
				$text .='<br/><a href="wapblog.php?uid='.USERID.$mgbw->rndp.'">'.MACGURUBLOG_MENU_21."</a><br/>\n";
			}
			$text .= '<a href="wap_blog_add.php'.$mgbw->rnd.'">'.MACGURUBLOG_MENU_5."</a><br/>\n";
			$text .= '<a href="wap_user_prefs.php'.$mgbw->rnd.'">'.MACGURUBLOG_MENU_4."</a>\n";
			$it = true;
		}
		
		if ($pref['macgurublog_3']) {
			$text .= "\n<p align=\"center\">======</p>\n";
			$text .= '<p>'.$blognewlist."</p>\n";
		}
		echo $text;
	}
} else {
	$mgbw -> head(true);
	//blog
	$buid = intval($_GET['uid']);
	$sql -> db_Select("macgurublog_main", "*", "blog_uid=".$buid);
	$row = $sql-> db_Fetch();
	extract($row);
	$title = $row['blog_title'];
	$visible = $row['blog_enable'];
	
	$sql -> db_Select("user", "user_name", "user_id=".$buid);
	$row = $sql-> db_Fetch();
	extract($row);
	$name = $row['user_name'];
	
	$text = '<p align="center"><b>'.$name.MACGURUBLOG_MENU_9.'</b>';
	$text .= ($title != NULL ? '<br/>'.$title : '')."</p>\n<p align=\"center\">======</p>\n";
	echo $text;
	$visible = ($visible == 1 || getperms("P") || ($buid == USERID));
	if ($visible == false) {
		echo '<p align="center">'.MACGURUBLOG_MENU_10."</p>\n";
	} else {
		$ae = $sql -> db_Count("macgurublog_rec", '(*)', 'where blogrec_uid='.$buid);
		if ($ae > 3) {
			//page select
			$text = '<p align="center">'.MACGURUBLOG_MENU_75.': <select name="xpage">'."\n";
			for ($i = 1; $i <= ceil($ae/3); $i++) {
				$text .= '<option value="'.(sprintf($i-1)*3).'">'.$i."</option>\n";
			}
			$text .= "</select>\n";
			$text .= "<anchor>\n";
			$text .= '<go method="get" href="wapblog.php'.$mgbw->rnd.'">'."\n";
			$text .= '<postfield name="uid" value="'.$buid.'"/>'."\n";
			$text .= '<postfield name="gpf" value="$(xpage)"/>'."\n";
			$text .= '</go>'."\n";
			$text .= MACGURUBLOG_MENU_92."\n";
			$text .= "</anchor>\n</p>\n";
			echo $text;
			$gpf = intval($_GET['gpf']);
			$grp = ' LIMIT '.(sprintf('%01d', $gpf)).',3';
		}
		if ($ae == 0) {
			echo "<b>".MACGURUBLOG_MENU_11."</b>\n";
		} else {
			/////
			$sql -> db_Select("macgurublog_rec", "*", "blogrec_uid=".$buid." ORDER BY blogrec_date DESC".$grp);
			$nsql = new db;
			while($row = $sql-> db_Fetch()){
				extract($row);
				$title = $tp->toHTML($row['blogrec_title'], true);
				$text = ($tp->toHTML($row['blogrec_text'], true))."<br/>-----<br/>\n";
				//link correction to WML standard
				$text = str_replace(array("<a href='", "' rel='external'>"), array('<a href="', '">'), $text);
				$cc = $nsql -> db_Count('macgurublog_com', '(*)', 'where blogcom_rid='.$row['blogrec_id']);
				$text .= '<a href="'."wap_comment.php?rid=".$row['blogrec_id'].'">'.MACGURUBLOG_MENU_12." (".$cc.")</a> | \n";
				$text .= $mgb -> dt(4, $row['blogrec_date']);
				$text .= "<br/>=======</p>\n";
				echo '<p>'.($title != NULL ? $title."<br/>-----<br/>\n" : NULL).$text;
			}
			
		}
	}
}
echo("<p>".($buid != NULL ? "<a href=\"wapblog.php\">".$pref['macgurublog_11']."</a><br/>\n" : NULL));
echo("<a href=\"wap.php?loggout\">".MACGURUBLOG_MENU_93."</a></p>\n");
//----------------------------------------
$mgbw -> foot();
?>