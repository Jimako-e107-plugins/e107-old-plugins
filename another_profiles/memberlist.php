<?php

if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN."another_profiles/memberlist_template.php");
require_once(e_PLUGIN."another_profiles/memberlist_shortcodes.php");
if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}

$alert_icon = "<img src='images/alert.png' title='!' />";

if (!check_class($pref['profile_memberlist_accept'])) {
	$ns->tablerender($alert_icon,PROFILE_2b);
	require_once(FOOTERF);
	exit;
}

if (!$pref['plug_installed']['another_profiles']) {
	$ns->tablerender($alert_icon,PROFILE_2a);
	require_once(FOOTERF);
	exit;
}

$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM,LIKE);
$sql_codes_count = 0;
foreach($sql_codes as $sql_code) {
	if (preg_match("/".$sql_code."/i", e_QUERY)) {
		$sql_codes_count++;
	}
	if (preg_match("/".$sql_code."/i", preg_replace("'([\S,\d]{2})'e", "chr(hexdec('\\1'))", e_QUERY))) {
		$sql_codes_count++;
	}
}

if ($sql_codes_count >= 2) {
		$ns->tablerender($alert_icon,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

$usrname  = $_GET['usrname'];
$email    = $_GET['email'];
$sort     = $_GET['sort'];
$realname = $_GET['realname'];
$loginname = $_GET['loginname'];
$groupname = $_GET['groupname'];

if(ADMIN && getperms("4")) {
	$ip_address = $_GET['ip_address'];
	$loginname = $_GET['loginname'];
} else {
	$ip_address = "";
	$loginname = "";
}

$sql->db_Select("another_profiles_memberlist", "*");
$row = $sql->db_Fetch();
$search_settings = $row['memberlist_search'];
$columns_settings = $row['memberlist_columns'];

if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
	while($row = $sql->db_Fetch()) {
		$search_value["".$row['user_extended_struct_id'].""] = $_GET["".$row['user_extended_struct_id'].""];
		if ($_GET["".$row['user_extended_struct_id'].""]) {
			$search_string = "".$search_string." AND user_".$row['user_extended_struct_name']." LIKE '%".$_GET["".$row['user_extended_struct_id'].""]."%'";
		}
	}
}

if ($pref['profile_memberlist_direction'] == '') {
	$profile_memberlist_direction = "user_name";
} else {
	$profile_memberlist_direction = $pref['profile_memberlist_direction'];
}

if ($pref['profile_memberlist_order'] == '') {
	$profile_memberlist_order = "ASC";
} else {
	$profile_memberlist_order = $pref['profile_memberlist_order'];
}

if ($_GET['mutat'] == "") $mutat = '30';
if (!$_GET['mutat'] == "") $mutat = intval($_GET['mutat']);
if (!$_POST['mutat'] == "") $mutat  = intval($_POST["mutat"]);

if ($_GET['direction'] == "") $direction = $profile_memberlist_direction;
if (!$_GET['direction'] == "") $direction = $_GET['direction'];
if (!$_POST['direction'] == "") $direction  = $_POST["direction"];

if ($_GET['sorrend'] == "") $sorrend = $profile_memberlist_order;
if (!$_GET['sorrend'] == "") $sorrend = $_GET['sorrend'];
if (!$_POST['sorrend'] == "") $sorrend  = $_POST["sorrend"];

if ($_GET['szures'] == "") $szures = 'all';
if (!$_GET['szures'] == "") $szures = $_GET['szures'];
if (!$_POST['szures'] == "") $szures  = $_POST["szures"];

if ($_GET['adv_spage'] == "") $adv_spage = "";
if ($_GET['adv_spage'] == "ON") $adv_spage = $_GET["adv_spage"];
if ($_POST['adv_spage'] == "ON") $adv_spage = $_POST["adv_spage"];

require_once(HEADERF);
//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE
	if ($adv_spage == "ON") {
	require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
		// Search form
		$text = "<div style='text-align:center'>
			<form action='".e_SELF."' method='get'>
			<table style='".USER_WIDTH."' class='fborder table'>
			<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".PROFILE_3a."</td>
			</tr>";
		// USERNAME
		if (preg_match("/\|username\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_4."</td>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='usrname' value='".$usrname."' /></td>
			</tr>";
		}
		// REALNAME
		if (preg_match("/\|realname\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_372."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='realname' value='".$realname."' /></td>
			</tr>";
		}
		// LOGINNAME
		if (preg_match("/\|loginname\|/", $search_settings) && (ADMIN && getperms("4"))) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_373."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='loginname' value='".$loginname."' /></td>
			</tr>";
		}
		// EMAIL
		if (preg_match("/\|email\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_5.":</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='email' value='".$email."' /></td>
			</tr>";
		}
		if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
			while($row = $sql->db_Fetch()) {
				$pmatch = "/\|s_".$row['user_extended_struct_id']."\|/";
				$row_user_extended_struct_id = $row['user_extended_struct_id'];
				$row_user_extended_struct_name = "user_".$row['user_extended_struct_name']."";
				if (preg_match($pmatch, $search_settings)) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					if ( $row['user_extended_struct_type'] != 2 && $row['user_extended_struct_type'] != 3 && $row['user_extended_struct_type'] != 4) {
						$text .= "
						<tr>
						<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
						<td class='forumheader3' style='vertical-align:top; text-align:center;'>
						<input class='tbox' style='width:220px;' type='text' name='".$row['user_extended_struct_id']."' value='".$search_value["".$row['user_extended_struct_id'].""]."' /></td>
						</tr>";
					}
					if ($row['user_extended_struct_type'] == 2 || $row['user_extended_struct_type'] == 3) {
						$ext_stuct_db = explode(",", $row['user_extended_struct_values']);
						$text .= "
							<tr>
							<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
							<td class='forumheader3' style='vertical-align:top; text-align:center;'>
							<select name='".$row['user_extended_struct_id']."' class='tbox' style='width:225px'>
							<option value='' selected='selected'></option>";
						foreach ($ext_stuct_db as $ext_stuct_db_item) {
							$user_extended_have_db = new db;
							$user_extended_have = $user_extended_have_db->db_Count("user_extended", "(*)", "where ".$row_user_extended_struct_name." = '$ext_stuct_db_item' LIMIT 1");
							if($user_extended_have > 0) {
								$text .= "".
								($search_value["".$row['user_extended_struct_id'].""]  == $ext_stuct_db_item ? "<option value='".$ext_stuct_db_item."' selected='selected'>".$ext_stuct_db_item."</option>" : "<option value='".$ext_stuct_db_item."'>".$ext_stuct_db_item."</option>")."";
							}
						}
						$text .= "
						</select></td>
						</tr>";
					}
					if ($row['user_extended_struct_type'] == 4) {
						$ext_stuct_db = explode(",", $row['user_extended_struct_values']);
						$text .= "
							<tr>
							<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
							<td class='forumheader3' style='vertical-align:top; text-align:center;'>
							<select name='".$row['user_extended_struct_id']."' class='tbox' style='width:225px' >
							<option value='' selected='selected'></option>";
						$ext_sruct_table_type = new db;
						$ext_sruct_table_type->db_Select("".$ext_stuct_db[0]."", "*", "".$ext_stuct_db[1]."!='' ORDER BY ".$ext_stuct_db[3]."");
						while($row = $ext_sruct_table_type->db_Fetch()) {
							$ext_stuct_db_item = $row[$ext_stuct_db[1]];
							$ext_stuct_db_item_2 = $row[$ext_stuct_db[2]];
							$user_extended_have_db1 = new db;
							$user_extended_have1 = $user_extended_have_db1->db_Count("user_extended", "(*)", "where ".$row_user_extended_struct_name." = '$ext_stuct_db_item' LIMIT 1");
							if($user_extended_have1 > 0) {
								$text .= "".
								($search_value["".$row_user_extended_struct_id.""]  == $ext_stuct_db_item ? "<option value='".$ext_stuct_db_item."' selected='selected'>".$ext_stuct_db_item_2."</option>" : "<option value='".$ext_stuct_db_item."'>".$ext_stuct_db_item_2."</option>")."";
							}
						}
						$text .= "
						</select></td>
						</tr>";
					}
				}
			}
		}
		// IP ADDRESS
		if (preg_match("/\|ip_address\|/", $search_settings) && (ADMIN && getperms("4"))) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_374."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='ip_address' value='".$ip_address."' /></td>
			</tr>";
		}
		if (preg_match("/\|groupname\|/", $search_settings) && USER) {
		require_once(e_HANDLER."userclass_class.php");
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_418."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			".r_userclass('groupname',$groupname,"off","public,admin,classes")."</td>
			</tr>";
		}
		$text .="
			<td class='fcaption' style='vertical-align:top; text-align:center;' colspan='2'>
			<input class='button' type='submit' value='".PROFILE_220."' />
			<input type='hidden' name='direction' value='".$direction."'>
			<input type='hidden' name='adv_spage' value='ON'>
			<input type='hidden' name='mutat' value='".$mutat."'>
			<input type='hidden' name='szures' value='".$szures."'>
			</td>
			</tr>
			</table></form></div>";
	} else {
		// Search form
		$text = "<div style='text-align:center'>
			<form action='".e_SELF."' method='get'>
			<table style='width:100%' class='fborder'>
			<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".PROFILE_3."</td>
			</tr>";
		// USERNAME
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_4."</td>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='usrname' value='".$usrname."' /></td>
			</tr>";
		// EMAIL
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_5."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='email' value='".$email."' /></td>
			</tr>
			<tr>";
		$search_colspan = " colspan='2'";
		
		if ($pref['profile_member_ext_search'] == "Yes") {
			$search_colspan = "";
			$text .="
				<td class='fcaption' style='vertical-align:top; text-align:left;'>
				<input class='button'  type='button' value='".PROFILE_371."' onclick = \"location.href='".e_SELF."?".e_QUERY."&adv_spage=ON'\">
				</td>";
		}
		$text .="
			<td style='text-align:center'; ".$search_colspan." class='fcaption'>
			<input class='button' type='submit' value='".PROFILE_220."' />
			<input type='hidden' name='direction' value='".$direction."'>
			<input type='hidden' name='mutat' value='".$mutat."'>
			<input type='hidden' name='szures' value='".$szures."'>
			</td>
			</tr>
			</table></form></div>";
	}
	
	// Paraser - Part 1
	if($sort=="") {
		$records = $mutat;
		$from = 0;
	} else {
		$qs = explode(".", $sort);
		$from = intval($qs[0]);
		$records = intval($qs[1]);
	}
	// Get variables
	$pusr  = ('1'  ? 'usrname='.$usrname.'&':'');
	$prealname  = ('1'  ? 'realname='.$realname.'&':'');
	$ploginname  = ('1'  ? 'loginname='.$loginname.'&':'');
	$pemail  = ('1'  ? 'email='.$email.'&':'');
	$pgroupname  = ('1'  ? 'groupname='.$groupname.'&':'');
	$pip_address  = ('1'  ? 'ip_address='.$ip_address.'&':'');
	$pmutat = ('1'  ? 'mutat='.$mutat.'&':'');
	$pdirection = ('1'  ? 'direction='.$direction.'&':'');
	$psorrend = ('1'  ? 'sorrend='.$sorrend.'&':'');
	$pszures = ('1'  ? 'szures='.$szures.'&':'');
	$psort = 'sort=[FROM].'.$records;
	$padv_spage = ('1'  ? 'adv_spage='.$adv_spage.'&':'');
	$parase = $pusr.$prealname.$ploginname.$pemail.$pgroupname.$ip_address.$pmutat.$pdirection.$psorrend.$pszures.$padv_spage.$psort;
	
	// Search query parts
	$qusrname = "";
	if($usrname && $usrname!=="") {
		$qusrname =" AND user_name LIKE '%".$tp->toDB($usrname)."%'";
	}
	if($realname && $realname!=="") {
		$qrealname =" AND user_login LIKE '%".$tp->toDB($realname)."%'";
	}
	if($loginname && $loginname!=="") {
		$qloginname =" AND user_loginname LIKE '%".$tp->toDB($loginname)."%'";
	}
	if($email && $email!=="") {
		$qemail =" AND user_email LIKE '%".$tp->toDB($email)."%'";
	}
	if($ip_address && $ip_address!=="") {
		$qip_address =" AND user_ip LIKE '%".$tp->toDB($ip_address)."%'";
	}
	if($groupname== "254") {
		$qgroupname =" AND user_admin = 1";
	}
	elseif($groupname && $groupname!== "253") {
		$qgroupname =" AND user_class = ".$tp->toDB($groupname)."";
	}
	$search_string = $qusrname.$qrealname.$qloginname.$qemail.$qgroupname.$qip_address.$search_string;
// RATE
}
if (($szures == "rate_forums" && $pref['profile_top_forums'] != "ON") || ($szures == "rate_comments" && $pref['profile_top_comments'] != "ON") || ($szures == "rate_chatbox" && $pref['profile_top_chatbox'] != "ON") || ($szures == "rate_user" && $pref['profile_top_rate'] != "ON") || ($szures == "rate_friends" && $pref['profile_top_friends'] != "ON") || ($szures == "rate_profiles" && $pref['profile_top_profile'] != "ON") || ($szures == "rate_level" && $pref['profile_top_level'] != "ON")) {
		$ns->tablerender($alert_icon,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//RATE
$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM);

$count = 0;
foreach($sql_codes as $sql_code) {
	if (preg_match("/".$sql_code."/i", $search_string)) {
		echo $sql_code;
		echo ", ";
echo "<br/>";
		$count++;
	}
}
if ($count >= 2) {
		$ns->tablerender($alert_icon,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE

	// Search query
	// ALL
	if ($szures == "all") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// PIC LIMIT
	if ($szures == "pic") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		if($sql->db_rows() > 0) {
			$picuser_id ="|";
			while($row=$sql->db_Fetch()) {
				$picdir = "userimages/".$row[user_id]."/";
				if ($hndDir = opendir($picdir)){
					$intCount = 0;
					while (false !== ($strFilename = readdir($hndDir))){
						if ($strFilename != "." && $strFilename != ".." && $strFilename != "index.htm" && $strFilename != "thumbs"){
							$intCount++;
							$picuser_id = "".$picuser_id."".$row[user_id]."|";
						}
						if ($intCount > 0) break;
					}
					closedir($hndDir);
				} else {
					$intCount = -1;
				}
			}
		}
		$picuser_id = explode("|", $picuser_id);
		global $picuser_id;
		$found = count($picuser_id) - 2;
	}
	// Search query
	// COMMENT LIMIT
	if ($szures == "comm") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #another_profiles_com AS ap ON ap.com_to=u.user_id
			WHERE user_ban = '0' AND com_type = 'prof' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// VIDEO LIMIT
	if ($szures == "vid") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #another_profiles_vids AS ap ON ap.vid_uid=u.user_id
			WHERE user_ban = '0' AND vid_id != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// AUDIO LIMIT
	if ($szures == "mp3") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #another_profiles AS ap ON ap.user_id=u.user_id
			WHERE user_ban = '0' AND user_mp3 != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	// FORUM LIMIT
	if ($szures == "forum") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_forums != '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	//COMMENT_1 LIMIT
	if ($szures == "comment_1") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_comments != '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	// ALL
	if ($szures == "all") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	// COMMENT LIMIT
	if ($szures == "comm") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #another_profiles_com AS ap ON ap.com_to=u.user_id
			WHERE user_ban = '0' AND com_type = 'prof' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	// PIC LIMIT
	if ($szures == "pic") {
		if ($picuser_id[1] != '') {
			$i=$from + 1;
			$picuser_string = "user_id='".$picuser_id[$i]."'";
			while ($i <= $from + $records -1) {
				if ($picuser_id[$i+1] =="") {
					break;
				}
				$picuser_string = "".$picuser_string." or user_id='".$picuser_id[$i+1]."'";
				$i++;
			}
			$qry ="
				SELECT u.*, ue.*
				FROM #user AS u
				LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
				WHERE user_ban = '0' AND $picuser_string ".$search_string."
				ORDER by $direction $sorrend";
		}
	}
	// VIDEO LIMIT
	if ($szures == "vid") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #another_profiles_vids AS ap ON ap.vid_uid=u.user_id
			WHERE user_ban = '0' AND vid_id != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	// AUDIO LIMIT
	if ($szures == "mp3") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			RIGHT JOIN #another_profiles AS ap ON ap.user_id=u.user_id
			WHERE user_ban = '0' AND user_mp3 != '' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	// FORUM LIMIT
	if ($szures == "forum") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_forums != '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	//COMMENT_1 LIMIT
	if ($szures == "comment_1") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_comments != '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
//RATE
}
//RATE
$top_x = $pref['profile_top_x'];
if ($pref['profile_top_noadmin'] == "No") {
	$profile_top_noadmin = "AND user_admin !=1";
}
if ($top_x < 1 || $top_x > 200) $top_x = 20;
if ($szures == "rate_forums") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_forums >= '1' ".$profile_top_noadmin."
		ORDER by user_forums DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_level") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' ".$profile_top_noadmin."
		ORDER by ((user_forums * 5) + (user_comments * 5) + (user_chats * 2) + user_visits)/4 DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_comments") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_comments >= '1' ".$profile_top_noadmin."
		ORDER by user_comments DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_chatbox") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_chats >= '1' ".$profile_top_noadmin."
		ORDER by user_chats DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_profiles") {
	$qry ="
		SELECT u.*, ap.*
		FROM #user AS u
		LEFT JOIN #another_profiles AS ap ON ap.user_id=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_totalviews >= '1' ".$profile_top_noadmin."
		ORDER by user_totalviews DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_user") {
	$qry ="
		SELECT u.*, ra.*
		FROM #user AS u
		LEFT JOIN #rate AS ra ON ra.rate_itemid=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND rate_table >= 'user' ".$profile_top_noadmin."
		ORDER by rate_rating/rate_votes DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_friends") {
	$qry ="
		SELECT u.*, ap.*
		FROM #user AS u
		LEFT JOIN #another_profiles AS ap ON ap.user_id=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_friends != '' AND user_friends !='|' ".$profile_top_noadmin."
		ORDER by CHAR_LENGTH(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(user_friends, '0', ''), '1', ''), '2', ''), '3', ''), '4', ''), '5', ''), '6', ''), '7', ''), '8', ''), '9', '')) DESC, user_visits DESC
		LIMIT $top_x";
}

$sql->db_Select_gen($qry);

//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE
	if($sql->db_rows()==0) {
		$results = "
		<table style='".USER_WIDTH."' class='fborder table'>
		<tr>
		<td class='forumheader3' style='text-align:center'><b>".PROFILE_6."</b></td>
		</tr>
		</table>";
	} else {
		$results = "";
	}
	
	if($found==0) {
		$found ='0';
	}
	if(e_QUERY=="") {
		$text .= "<br/><div style='text-align:center;'>".PROFILE_7." ".$found."</div><br/>";
	} else {
		$text .= "<br/><div style='text-align:center;'>".PROFILE_8." ".$found."</div><br/>";
	}
	$text .= "<div style='text-align:center'>
		<form method='post' action='".e_SELF."?".e_QUERY."'>
		<table style='".USER_WIDTH."' class='fborder table'>
		<tr>
		<td colspan='7' style='text-align:center' class='forumheader'>";
	if (check_class($pref['profile_top_class'])) {
		if ($pref['profile_top_level'] == "ON") {
			$top_link = "rate_level";
		}else if ($pref['profile_top_forums'] == "ON") {
			$top_link = "rate_forums";
		}else if ($pref['profile_top_comments'] == "ON") {
			$top_link = "rate_comments";
		}else if ($pref['profile_top_chatbox'] == "ON") {
			$top_link = "rate_chatbox";
		}else if ($pref['profile_top_rate'] == "ON") {
			$top_link = "rate_user";
		}else if ($pref['profile_top_profile'] == "ON") {
			$top_link = "rate_profiles";
		}else if ($pref['profile_top_friends'] == "ON") {
			$top_link = "rate_friends";
		}else {
			$top_link = "";
		}
		if ($top_link != "") {
			$text .= "<div style='text-align:left;'><a href='newuser.php?szures=".$top_link."'><img src='".e_PLUGIN."another_profiles/images/friends.png' style='border: 0px solid black; width: 24px; height: 24px; float: left;' title='".PROFILE_384."' /></a></div>";
		}
	}
		if ($sort == "") {
		$text .= "<span class='defaulttext'>".PROFILE_266."</span>
		<select name='mutat' class='tbox'>".
			($mutat  == "10" ? "<option value='10' selected='selected'>10</option>" : "<option value='10'>10</option>").
			($mutat  == "30" ? "<option value='30' selected='selected'>30</option>" : "<option value='30'>30</option>").
			($mutat  == "50" ? "<option value='50' selected='selected'>50</option>" : "<option value='50'>50</option>").
			($mutat  == "70" ? "<option value='70' selected='selected'>70</option>" : "<option value='70'>70</option>")."
		</select>
		&nbsp;";
		}
		if (check_class($pref['profile_memberlist_filter']) && (($pref['profile_commentson'] == "ON") || ($pref['profile_pics'] == "ON") || ($pref['profile_videos'] == "ON") || ($pref['profile_mp3enabled'] == "ON")) ) {
			if ($sort == "") {
				$text .= "&nbsp;&nbsp;
				<span class='defaulttext'>".PROFILE_339."</span>
				<select name='szures' class='tbox'>".
					($szures == "all" ? "<option value='all' selected='selected'>".PROFILE_340."</option>" : "<option value='all'>".PROFILE_340."</option>")."";
					$text .= ($szures == "forum" ? "<option value='forum' selected='selected'>".PROFILE_365."</option>" : "<option value='forum'>".PROFILE_365."</option>")."";
					$text .= ($szures == "comment_1" ? "<option value='comment_1' selected='selected'>".PROFILE_366."</option>" : "<option value='comment_1'>".PROFILE_366."</option>")."";
					if ($pref['profile_commentson'] == "ON") {
						$text .= ($szures == "comm" ? "<option value='comm' selected='selected'>".PROFILE_341."</option>" : "<option value='comm'>".PROFILE_341."</option>")."";
					}
					if ($pref['profile_pics'] == "ON") {
						$text .= ($szures == "pic" ? "<option value='pic' selected='selected'>".PROFILE_342."</option>" : "<option value='pic'>".PROFILE_342."</option>")."";
					}
					if ($pref['profile_videos'] == "ON") {
						$text .= ($szures == "vid" ? "<option value='vid' selected='selected'>".PROFILE_343."</option>" : "<option value='vid'>".PROFILE_343."</option>")."";
					}
					if ($pref['profile_mp3enabled'] == "ON") {
						$text .= ($szures == "mp3" ? "<option value='mp3' selected='selected'>".PROFILE_344."</option>" : "<option value='mp3'>".PROFILE_344."</option>")."";
					}
				$text .= "</select>&nbsp;";
			}
		}
		if ($sort == "") {
			$text .= "<input type='hidden' name='direction' value='".$direction."'><input class='button' type='submit' value='".PROFILE_265."' />";
		} else {
			$text .= "<input class='button'  type='button' value='".PROFILE_375."' onclick = \"location.href='".e_SELF."'\">";
		}
			$text .= "</td></tr></table></form>";

		if ($pref['profile_memberlist_bcard'] == "line" || $pref['profile_memberlist_bcard'] == "" ) {
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr>";
			if ($pref['profile_memberlist_class']) {
				$profile_memberlist_class = $pref['profile_memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($pref['profile_memberlist_color_up']) {
				$up_pic =" style='color: #".$pref['profile_memberlist_color_up']."'";
			}
			if ($pref['profile_memberlist_color_down']) {
				$down_pic =" style='color: #".$pref['profile_memberlist_color_down']."'";
			}
			if ($pref['profile_memberlist_column_avatar'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><center><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_id'>";
				if ($sorrend == "ASC" && $direction == "user_id") {	$ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_id") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
				$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4a."' /></center></form></td>";
			}
			if ($pref['profile_memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_ip'>";
				if ($sorrend == "ASC" && $direction == "user_ip") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_ip") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_369."' /></form></td>";
			}
			$memberlist_extended_column = new db;
			if($memberlist_extended_column->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
				require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
				while($row = $memberlist_extended_column->db_Fetch()) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					$user_extended_struct_name = $row['user_extended_struct_name'];
					$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
					if (preg_match($pmatch, $columns_settings)) {
						$ord = "";
						$ord_color = "";
						$text .= "
						<td class='fcaption' style='width:20%'><form method='post' action='".e_SELF."?".e_QUERY."'>
						<input type='hidden' name='direction' value='user_".$user_extended_struct_name."'>";
						if ($sorrend == "ASC" && $direction == "user_".$user_extended_struct_name."") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_".$user_extended_struct_name."") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
						$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".$user_extended_struct_text."' />
						</form></td>";
					}
				}
			}
			$text .= "</form></tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
			}
		} else {
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr>";
			if ($pref['profile_memberlist_class']) {
				$profile_memberlist_class = $pref['profile_memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($pref['profile_memberlist_color_up']) {
				$up_pic =" style='color: #".$pref['profile_memberlist_color_up']."'";
			}
			if ($pref['profile_memberlist_color_down']) {
				$down_pic =" style='color: #".$pref['profile_memberlist_color_down']."'";
			}
			if ($pref['profile_memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($pref['profile_memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_ip'>";
				if ($sorrend == "ASC" && $direction == "user_ip") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_ip") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_369."' /></form></td>";
			}
			$memberlist_extended_column = new db;
			if($memberlist_extended_column->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
				require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
				while($row = $memberlist_extended_column->db_Fetch()) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					$user_extended_struct_name = $row['user_extended_struct_name'];
					$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
					if (preg_match($pmatch, $columns_settings)) {
						$ord = "";
						$ord_color = "";
						$text .= "
						<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
						<input type='hidden' name='direction' value='user_".$user_extended_struct_name."'>";
						if ($sorrend == "ASC" && $direction == "user_".$user_extended_struct_name."") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_".$user_extended_struct_name."") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
						$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".$user_extended_struct_text."' />
						</form></td>";
					}
				}
			}
			$text .= "</form></tr></table>";
			$pref['profile_bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $pref['profile_bcard_css'];
			$pref['profile_bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table style='".USER_WIDTH."' class='fborder table' id='card_table'><tr>";
			if ($pref['profile_bcard_column'] == '') {
				$userlist_column = '3';
			} elseif ($pref['profile_bcard_column'] > '8') {
				$userlist_column = '8';
			} else {
				$userlist_column = $pref['profile_bcard_column'];
			}
			$userlist_num=1;
			$text .= "<tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
				$userlist_num++;
				if ($userlist_num == $userlist_column +1) {
					$text .= "</tr>";
					$userlist_num = 1;
				}
			}
			$text .= "</td></tr>";
		}
	$text .= "</table>\n</div>";
	$text .= $results;
	$ns->tablerender("".PROFILE_10."", $text);
//RATE
} else {
if (!check_class($pref['profile_top_class'])) {
	$ns->tablerender($alert_icon,PROFILE_385);
	require_once(FOOTERF);
	exit;
}
//RATE

	if($sql->db_rows()==0) {
		$results = "
		<table style='".USER_WIDTH."' class='fborder table'>
		<tr>
		<td class='forumheader3' style='text-align:center'><b>".PROFILE_6."</b></td>
		</tr>
		</table>";
	} else {
		$results = "";
	}
	if($pref['profile_stats'] =="ON" && $pref['profile_top_level'] == "ON"){
		if ($szures == "rate_level") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_level'>".PROFILE_391."</a><br/>";
	}
	if($pref['profile_top_forums'] == "ON"){
		if ($szures == "rate_forums") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_forums'>".PROFILE_388."</a><br/>";
	}
	if(!$pref['comments_disabled'] && $pref['profile_top_comments'] == "ON"){
		if ($szures == "rate_comments") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_comments'>".PROFILE_387."</a><br/>";
	}
	if($pref['profile_top_chatbox'] == "ON"){
		if ($szures == "rate_chatbox") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_chatbox'>".PROFILE_393."</a><br/>";
	}
	if($pref['profile_rate'] && $pref['profile_top_rate'] == "ON"){
		if ($szures == "rate_user") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_user'>".PROFILE_377."</a><br/>";
	}
	if($pref['profile_stats'] =="ON" && $pref['profile_top_profile'] == "ON"){
		if ($szures == "rate_profiles") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_profiles'>".PROFILE_378."</a><br/>";
	}
	if ($pref['profile_friends'] == "ON" && $pref['profile_top_friends'] == "ON") {
		if ($szures == "rate_friends") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?szures=rate_friends'>".PROFILE_379."</a><br/>";
	}
	$text .= "<br/><br/><table style='".USER_WIDTH."' class='fborder table'><tr>";
	$text .= "<td colspan= 3 class='forumheader'>".PROFILE_380.$pref['profile_top_x']."</td>";
	$text .= "</tr>";
	if ($pref['profile_memberlist_bcard'] == "line" || $pref['profile_memberlist_bcard'] == "" ) {
		while($row=$sql->db_Fetch()) {
			$text .= renderuser($row, "short");
		}
	} else {
			$pref['profile_bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $pref['profile_bcard_css'];
			$pref['profile_bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table id='card_table'><tr>";
			if ($pref['profile_top_bcard_column'] == '') {
				$userlist_top_column = '1';
			} elseif ($pref['profile_top_bcard_column'] > '8') {
				$userlist_top_column = '8';
			} else {
				$userlist_top_column = $pref['profile_top_bcard_column'];
			}
			$userlist_num=1;
			$text .= "<tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
				$userlist_num++;
				if ($userlist_num == $userlist_top_column +1) {
					$text .= "</tr>";
					$userlist_num = 1;
				}
			}
			$text .= "</td></tr>";
	}
	$text .= "</table>\n";
	$text .= $results;
	$ns->tablerender("".PROFILE_376."", $text);
//RATE
}
//RATE

// Paraser - Part 2


if($found > $mutat) {
	$parms = $found.",".$records.",".$from.",".e_SELF.'?'.$parase;
	echo "<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
}
//
function renderuser($uid) {
	global $sql, $tp, $ml_shortcodes;
	global $ML_SHORT_TEMPLATE;
	global $ML_TOPLIST_USER;
	global $ML_TOPLIST_FORUMS;
	global $ML_TOPLIST_LEVEL;
	global $ML_TOPLIST_COMMENTS;
	global $ML_TOPLIST_CHATBOX;
	global $ML_TOPLIST_FRIENDS;
	global $ML_TOPLIST_PROFILES;
	global $user;
	global $szures;
	global $comments_top;
	global $chatbox_top;
	global $forums_top;
	global $level_top;
	global $profile_top;
	global $friends_top;
	global $comments_top_number;
	global $chatbox_top_number;
	global $forums_top_number;
	global $level_top_number;
	global $profile_top_number;
	global $friends_top_number;
	if(is_array($uid)) {
		$user = $uid;
	} else {
		if(!$user = get_user_data($uid)) {
			return FALSE;
		}
	}

	if($comments_top > $comments_top_number) $comments_top_number = $comments_top;
	if($chatbox_top > $chatbox_top_number) $chatbox_top_number = $chatbox_top;
	if($forums_top > $forums_top_number) $forums_top_number = $forums_top;
	if($level_top > $level_top_number) $level_top_number = $level_top;
	if($profile_top > $profile_top_number) $profile_top_number = $profile_top;
	if($friends_top > $friends_top_number) $friends_top_number = $friends_top;

	//RATE
	if ($szures == "rate_user") {
		return $tp->parseTemplate($ML_TOPLIST_USER, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_forums") {
		return $tp->parseTemplate($ML_TOPLIST_FORUMS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_level") {
		return $tp->parseTemplate($ML_TOPLIST_LEVEL, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_comments") {
		return $tp->parseTemplate($ML_TOPLIST_COMMENTS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_chatbox") {
		return $tp->parseTemplate($ML_TOPLIST_CHATBOX, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_friends") {
		return $tp->parseTemplate($ML_TOPLIST_FRIENDS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_profiles") {
		return $tp->parseTemplate($ML_TOPLIST_PROFILES, FALSE, $ml_shortcodes);
	} else {
		return $tp->parseTemplate($ML_SHORT_TEMPLATE, FALSE, $ml_shortcodes);
	}
}
require_once(FOOTERF);

?>