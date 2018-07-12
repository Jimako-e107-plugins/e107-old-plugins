<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
if (!function_exists("mgb_ctmenu")) {
	function mgb_ctmenu() {
		global $ns, $sql;
		if (strstr(e_SELF, 'macgurublog.php') != false) {
			$uid = intval($_GET['uid']);
			$cats = array();
			$text = '';
			$sql -> db_Query("select ".MPREFIX."macgurublog_tag.blogtag_id, ".MPREFIX."macgurublog_tag.blogtag_text, count(".MPREFIX."macgurublog_rec.blogrec_id) as cnt from 
			".MPREFIX."macgurublog_tag left join ".MPREFIX."macgurublog_rec on (".MPREFIX."macgurublog_rec.blogrec_tag=".MPREFIX."macgurublog_tag.blogtag_id) 
			where ".MPREFIX."macgurublog_tag.blogtag_uid=".$uid." group by ".MPREFIX."macgurublog_tag.blogtag_id");
			$cttl = 0;
			while($row = $sql-> db_Fetch()){
				$cats[$row['blogtag_id']] = $row['blogtag_text'].' ('.$row['cnt'].')';
				$cttl += $row['cnt'];
			}
			asort($cats);
			foreach($cats as $cid=>$cat) {
				$text .= '<a href="'.e_SELF.'?uid='.$uid.'&cid='.$cid.'">'.$cat."</a><br />\n";
			}
			$cnt = $sql -> db_Count('macgurublog_rec', '(*)', "where blogrec_uid=${uid} and blogrec_tag=0");
			if ($cnt > 0) {
				$text .= '<a href="'.e_SELF.'?uid='.$uid.'&cid=0">'.MACGURUBLOG_MENU_114.' ('.$cnt.")</a><br />\n";
				$cttl += $cnt;
			}
			$text .= '<hr /><a href="'.e_SELF.'?uid='.$uid.'">'.MACGURUBLOG_MENU_74.' ('.$cttl.")</a>\n";
			$ns -> tablerender(MACGURUBLOG_MENU_115, $text);
		}
	}
}

if ($pref['macgurublog_12'] && IsSet($_GET['uid'])) {
	mgb_ctmenu();
}
?>