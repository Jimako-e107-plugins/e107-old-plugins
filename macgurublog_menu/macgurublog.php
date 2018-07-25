<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
// ============= START OF THE BODY ====================================
$buid = intval($_GET['uid']);
$gpf = intval($_GET['gpf']);
if (IsSet($_GET['cid'])) {
	$scat = intval($_GET['cid']);
	$scatsql = ' and blogrec_tag='.$scat;
	$catlinkpf = '&cid='.$scat;
}
if (!isset($buid)) {
	//list
	require(e_PLUGIN."macgurublog_menu/macgurublog_menu.php");
} else {
	//the users blog
	$sql -> db_Select("macgurublog_main", "*", "blog_uid=".$buid);
	$row = $sql-> db_Fetch();
	$title = $row['blog_title'];
	$visible = $row['blog_enable'];
	
	if (IsSet($scat)) {
		if ($scat == 0) {
			$row["blogtag_text"] = MACGURUBLOG_MENU_114;
		} else {
			$sql -> db_Select("macgurublog_tag", "blogtag_text", "blogtag_id=".$scat);
			$row = $sql-> db_Fetch();
		}
		$ctxt = MACGURUBLOG_MENU_124.' '.$row["blogtag_text"]."\n";
	}
	$sql -> db_Select("user", "user_name, user_image", "user_id=".$buid);
	$row = $sql-> db_Fetch();
	$name = $row['user_name'];
	unset($text);
	if ($pref['macgurublog_10']) {
		require_once(e_HANDLER."avatar_handler.php");
		$text = '<div style="text-align:center;"><img src="'.avatar($row['user_image']).'" alt="" /></div>';
	}
	$text .= "\n<div style='text-align:center;'>$title</div>\n";
	$text .= "<div style='text-align:center;'><span class='smalltext'>$ctxt</span><br /><span class='smalltext'><a href='".e_PLUGIN."macgurublog_menu/rss2feed.php?id=".$buid."'>".MACGURUBLOG_MENU_111."</a></span></div>\n";
	$ns -> tablerender($name.MACGURUBLOG_MENU_9, $text);
	$visible = ($visible == 1 || getperms("P") || ($buid == USERID));
	if ($visible == false) {
		$text = '<div style="text-align:center;">'.MACGURUBLOG_MENU_10.'</div>';
		$ns -> tablerender('', $text);
	} else {
		//entries
		$ae = $sql -> db_Count("macgurublog_rec", '(*)', 'where blogrec_uid='.$buid.$scatsql);
		$grm = intval($pref['macgurublog_1']);
		$grp = ' LIMIT '.(sprintf('%01d', $gpf)).',';
		$grpm = NULL;
		switch ($grm) {
			case 0:
				$grp .= '10';
				$stp = 10;
			break;
			case 1:
				$grp .= '15';
				$stp = 15;
			break;
			case 2:
				$grp .= '20';
				$stp = 20;
			break;
			default:
				$grp = '';
				$stp = $ae;
		}
		$cp = ceil($ae / $stp);
		$text = '';
		if ($cp > 1) {
			for ($i = 1; $i <= $cp; $i++) {
				$text .= (($i-1) * $stp != $gpf) ? '<a href="'.e_SELF.'?uid='.$buid.'&gpf='.(($i-1) * $stp).$catlinkpf.'">'.$i."</a> \n" : $i." \n";
			}
			$ns -> tablerender(MACGURUBLOG_MENU_75,'<div style="text-align:center">'.$text.'</div>');
		} elseif ($grm == 3) {
			$sql -> db_Select('macgurublog_rec', "min(blogrec_date) as lk, max(blogrec_date) as ln", "blogrec_uid=".$buid.$scatsql);
			$row = $sql -> db_Fetch();
			$lk = $row['lk'];
			$ln = $row['ln'];
			if ($mgb -> isdif($lk, $ln)) {
				$lnnm = $mgb -> nextm($mgb -> toym($ln));
				$ats = $mgb -> toym($lk);
				if ($gpf == NULL) {
					$gpf = $mgb -> toym($ln);
				}
				do {
					if ($mgb -> istham($ats, $scatsql)) {
						if (substr($ats, 0, 4) != $cury) {
							$cury = substr($ats, 0, 4);
							$text .= "<br />\n".$cury.": \n";
						}
						$text .= ($gpf != $ats) ? '<a href="'.e_SELF.'?uid='.$buid.'&gpf='.$ats.$catlinkpf.'">'.$mgb -> getm($mgb -> tots($ats), true)."</a> \n" : $mgb -> getm($mgb -> tots($ats), true)." \n";
					}
					$ats = $mgb -> toym($mgb -> nextm($ats));
				} while ($mgb -> nextm($ats) <= $lnnm);
				$ns -> tablerender(MACGURUBLOG_MENU_75,'<div style="text-align:center">'.substr($text,6).'</div>');
				
				$grpm = ' and blogrec_date>='.$mgb -> tots($gpf).' and blogrec_date<'.$mgb -> nextm($gpf);
			}
		}
		/////
		$sql -> db_Select("macgurublog_rec", "*", "blogrec_uid=".$buid.$grpm.$scatsql." ORDER BY blogrec_date DESC".$grp);
		if ($ae == 0) {
			$text = '<div style="text-align:center;">'.MACGURUBLOG_MENU_11.'</div>';
			$ns -> tablerender('', $text);
		} else {
			$nsql = new db();
			$nsql -> db_Select("macgurublog_tag", "*", "blogtag_uid=".$buid);
			$cats = array(0 => MACGURUBLOG_MENU_114);
			while($row = $nsql-> db_Fetch()){
				$cats[$row['blogtag_id']] = $row['blogtag_text'];
			}
			while($row = $sql-> db_Fetch()){
				$title = $tp->toHTML($row['blogrec_title'], true);
				$text = '<div>'.($tp->toHTML($row['blogrec_text'], true))."</div>\n";
				$text .= '<hr /><div style="text-align:right;">';
				if ($buid == USERID || getperms("P")) { //own
					$text .= '<a href="'.e_PLUGIN."macgurublog_menu/delete.php?rid=".$row['blogrec_id'].'">'.MACGURUBLOG_MENU_14."</a> | \n";
					$text .= '<a href="'.e_PLUGIN."macgurublog_menu/edit.php?rid=".$row['blogrec_id'].'">'.MACGURUBLOG_MENU_13."</a> | \n";
				}
				$text .= '<a href="'.e_SELF.'?uid='.$buid.'&cid='.$row['blogrec_tag'].'">'.$cats[$row['blogrec_tag']]."</a> | \n";
				$cc = $nsql -> db_Count('macgurublog_com', '(*)', 'where blogcom_rid='.$row['blogrec_id']);
				$text .= '<a href="'.e_PLUGIN."macgurublog_menu/comment.php?rid=".$row['blogrec_id'].'">'.MACGURUBLOG_MENU_12." (".$cc.")</a> | \n";
				if ($pref['macgurublog_13']) {
					require_once(e_HANDLER."rate_class.php");
					$rater = new rater;
					$rat = $rater->getrating('macgurublog',$row['blogrec_id']);
					$text .= '<a href="'.e_PLUGIN."macgurublog_menu/comment.php?rid=".$row['blogrec_id'].'">'.MACGURUBLOG_MENU_126.": ".($rat[0]==0?RATELAN_4:$rat[1])."</a> | \n";
				}
				$text .= $mgb -> dt(1, $row['blogrec_date']);
				$text .= "</div>\n";
				$ns -> tablerender($title, $text);
			}
		}
	}
}

// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>