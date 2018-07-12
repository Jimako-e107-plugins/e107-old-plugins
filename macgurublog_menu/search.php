<?php
$text .= mgbSearch();

function mgbSearch() {
	global $search_info, $key, $pref, $query;
	$sql = new db();
	$gen2 = new convert();
	$result = "";
	if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
		require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
	} else {
		require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
	}
	
	$linkprefix = "<img src=\"".THEME_ABS."images/bullet2.gif\" alt=\"bullet\" /> ";
	$linkprefix .= "<b><a href=\"".e_PLUGIN_ABS."macgurublog_menu/comment.php?rid=";
	
	$search_info[$key]['qtype'] = $pref["macgurublog_11"];
	
	$sql->db_Query("select blogrec_id, blogrec_text, blogrec_title, blogrec_date, user_name from ".MPREFIX."macgurublog_rec left join ".MPREFIX."user on (".MPREFIX."macgurublog_rec.blogrec_uid=".MPREFIX."user.user_id) where blogrec_text regexp('".$query."') or blogrec_title regexp('".$query."') order by blogrec_date desc;");
	if ($sql->db_Rows() != 0) {
		while($row = $sql -> db_Fetch()){
			$long = parsesearch($row['blogrec_text'], $query);
			$result .= $linkprefix.$row['blogrec_id']."\">";
			$result .= $row['blogrec_title']."</a></b><br />";
			$result .= "<span class=\"smalltext\">".$row['user_name'].MACGURUBLOG_MENU_9." (".$gen2->convert_date($row['blogrec_date'], "short").")</span>";
			$result .= "<br />$long<br /><br />";
		}
	} else {
		$result .= LAN_198;//defined in siteroot/e107_languages/*/lan_search.php
	}
	
	return $result;
}
?>