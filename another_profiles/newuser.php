<?php

if(!defined("e107_INIT")) {
	require_once("../../class2.php");
} 

/////// V2 compatible
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."comment_class.php");
$user_shortcodes = e107::getScBatch('user');
///////

//e107_0.8 compatible 
 if(file_exists(e_FILE."shortcode/batch/user_shortcodes.php")){
	require_once(e_FILE."shortcode/batch/user_shortcodes.php");
} else {
	require_once(e_CORE."shortcodes/batch/user_shortcodes.php");
} 
//
if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}
require_once(e_LANGUAGEDIR."/".e_LANGUAGE."/lan_user.php");
define("e_PAGETITLE", TITLE_PROFILE_1);
$WYSIWYG = $pref['wysiwyg'];
if ($_GET['page'] == comments) {
$e_wysiwyg = "user_comment";
}
if ($_GET['page'] == images) {
$e_wysiwyg = "user_picture_comment";
}
if ($_GET['page'] == videos) {
$e_wysiwyg = "user_video_comment";
}
require_once(HEADERF);
//global $user_shortcodes, $pref;
global $user_shortcodes, $pref, $user;

$alert_icon = "<img src='images/alert.png' title='!' />";

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

if (isset($_GET['id'])) {
	if ($_GET['id'] != USERID && !check_class($pref['profile_allowguests'])) {
		$ns->tablerender($alert_icon,PROFILE_2);
		require_once(FOOTERF);
		exit;
	}
	$id = intval($_GET['id']);
	$sql -> db_Select("user", "*", "user_id=".$id."");
	$found = $sql->db_rows();
	if (!$found) {
		$ns->tablerender($alert_icon,PROFILE_2a);
		require_once(FOOTERF);
		exit;
	}
	$user = $sql -> db_Fetch();
	$username = $_GET['usrname'];

	// ONLINE NOW
	$sql-> db_Select("user","user_name","user_id = '$id'");
	while($row = $sql -> db_Fetch()) {
		$user_name = $row['user_name'];
	}

	$on_name = "".$id.".".$user_name."";
	$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
	if( $check > 0 ) {
		$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: bottom;' />";
		$onlinetextleft = "Online";
		$onlinetext = PROFILE_96;
	} else {
		$online = "<img src='images/noonline.png' title='".PROFILE_97."' style='vertical-align: bottom;' />";
		$onlinetextleft = "";
		$onlinetext = PROFILE_97;
	}
	unset($check,$on_name);

	// GET AVATAR
	if ($pref['profile_avatarwidth'] == '') {
		$avwidth = "";
	} else {
		$avwidth = "width='".$pref['profile_avatarwidth']."' ";
	}
	if ($pref['profile_avatarheight'] == '') {
		$avheight = '';
	} else {
		$avheight = "height='".$pref['profile_avatarheight']."' ";
	}
	if ($user['user_image'] == "") {
		$user_image = "".e_PLUGIN."another_profiles/images/noavatar.png";
	//	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." />";
	//	$avatar .= "".$user_image."";
		$avatar .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
		
	} else {
		$user_image = $user['user_image'];
		require_once(e_HANDLER."avatar_handler.php");
		$user_image = avatar($user_image);
	//	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." />";
	//	$avatar .= "".$user_image."";
		$avatar .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
	}


	//GET PROFIL_IMAGE
	if ($pref['profile_imagewidth'] == '') {
		$imagewidth = "width = '200'";
	} else {
		$imagewidth = "width='".$pref['profile_imagewidth']."' ";
	}
	if ($pref['profile_imageheight'] == '') {
		$imageheight = "";
	} else {
		$imageheight = "height='".$pref['profile_imageheight']."' ";
	}
	if ($user['user_image'] == "") {
		$user_image = "".e_PLUGIN."another_profiles/images/noavatar.png";
	//	$profil_image .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." />";
	//	$profil_image .= "".$user_image."";
		$profil_image .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
	} else {
		$user_image = str_replace("/thumbs/", "/", $user['user_image']);
		$another_profiles_link = "".SITEURL.e_PLUGIN."another_profiles/";
		$another_profiles_link = str_replace("../../", "", $another_profiles_link);
		$user_image1 = str_replace("$another_profiles_link", "./", $user_image);
		$kepmeret = getimagesize($user_image1);
		$profilkep_sz = $kepmeret[0];
		$profilkep_m = $kepmeret[1];

		if ($profilkep_sz <= $pref['profile_imagewidth'] && $pref['profile_imagewidth'] != "" && $profilkep_sz != "") {
			$imagewidth = $profilkep_sz;
		}
		if ($profilkep_m <= $pref['profile_imageheight'] && $pref['profile_imageheight'] != "" && $profilkep_m != "") {
			$imageheight = $profilkep_m;
		}
		require_once(e_HANDLER."avatar_handler.php");
		$user_image = avatar($user_image);
		if ($user_image != str_replace("/thumbs/", "/", $user['user_image'])) {
			$imagewidth = $avwidth;
			$imageheight = $avheight;
		}
	//	$profil_image .= "<img src='".$user_image."' border='1' ".$imagewidth." ".$imageheight." />";
		$profil_image .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
	}

	$username = $user['user_name'];
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='prof'");
	$comnumrows = $sql->db_Rows();
	$EXTENDED_CATEGORY_START = "<tr><td colspan='2' class='forumheader' style='text-align:left'>{EXTENDED_NAME}</td></tr>";
	$EXTENDED_CATEGORY_TABLE = "
		<tr><td class='forumheader3'>{EXTENDED_ICON}&nbsp;{EXTENDED_NAME}</td><td class='forumheader3'>{EXTENDED_VALUE}</td></tr>
		";
	$EXTENDED_END = ""; 
	
	$sc_style['USER_COMMENTS_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_COMMENTS_LINK']['post'] = "</td></tr>";
	$sc_style['USER_FORUM_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_FORUM_LINK']['post'] = "</td></tr>";
	$sc_style['USER_UPDATE_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:center'>";
	$sc_style['USER_UPDATE_LINK']['post'] = "</td></tr>";

	if ($pref['profile_bgimage'] == 'Yes') {
		$sql->mySQLresult = @mysql_query("SELECT user_background FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$bg = $sql->db_Fetch();
		if ($bg['user_background'] != '') {
			if (eregi('http', $bg['user_background'])) {
			$text .= "<body background='".$bg['user_background']."'>";
			} else {
			$text .= "<body bgcolor='".$bg['user_background']."'>";
			}
		}
	}

	// MENU
	$text .="<div class='main_caption'><b>{$username} ".PROFILE_162."</div></b>";
	$text .= "<div style='text-align:center'>";
	$text .= "<table style='".USER_WIDTH."' class='fborder table'>";
	$text .= "<tr>";
	$text .= "<td colspan='2' style='text-align:center'>";
	$text .= "| <a href='newuser.php?id=".$id."'>".PROFILE_11."</a> | ";
	if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
		$text .= "<a href='newuser.php?id=".$id."&page=friends'>" .PROFILE_13."</a> | ";
	}
	if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
		$text .= "<a href='newuser.php?id=".$id."&page=images'>" .PROFILE_14."</a> | ";
	}
	if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
		$text .= "<a href='newuser.php?id=".$id."&page=videos'>" .PROFILE_113."</a> | ";
	}
	if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
		$text .= "<a href='newuser.php?id=".$id."&page=comments'>".PROFILE_15."</a> | "; 
	} 
	// USER COMMENTS?
	if ((($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") || ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "")|| ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "")) && $id == USERID) {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."another_profiles_com WHERE com_by='".$id."' ");
			$comment_all = $sql->db_Rows();
			if ($comment_all > 0) {
				$text .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=comments'>".PROFILE_336."</a> | ";
			}
	}
	/* if (!$sql -> db_Select("user", "user_id user_comments", "user_id='".$id."' AND user_forums='0' ")) {
		$text .= "<a href='../../userposts.php?0.forums.".$id."'>".PROFILE_213."</a> | ";
	} 
	if (!$sql -> db_Select("user", "user_id user_comments", "user_id='".$id."' AND user_comments='0' ")) {
		$text .= "<a href='../../userposts.php?0.comments.".$id."'>".PROFILE_214."</a> | ";
	}
	if ($sql -> db_Select("macgurublog_main", "*", "blog_uid='".$id."' AND blog_enable='1' ")) {
		$text .= "<a href='../macgurublog_menu/macgurublog.php?uid=".$id."'>".PROFILE_215."</a> | ";
	}
	if ($pref['userjournals_active'] == "1") {
		$text .= "<a href='../userjournals_menu/userjournals.php?blogger.".$id."'>".PROFILE_216."</a> | ";
	} */
	$text .= "</td>";
	$text .= "</tr>";
	$text .= "<tr>
		<td colspan='2'><br></td>
		</tr>";
	$text .= "<tr>
		<td colspan='2' class='fcaption' style='text-align:center'>".$username."{USER_LOGINNAME} ".PROFILE_12."</td>
		</tr>";


	if ($pref['profile_user_warn_support'] == "Yes" AND $sql->db_Select("user_extended", "*", "user_extended_id='$id' AND user_warn!='null' AND user_warn!=''")) {
		$profil_image_rowspan = 9;
	} else {
		$profil_image_rowspan = 8;
	}
	$text .= "<TR>
		<td rowspan = $profil_image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>";
	$text .= "{USER_RATING}<br/><br/>";
	if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
		if ($pref['user_tracking'] == "session") {
			$ulang = $_SESSION['e107language_'.$pref['cookie_name']];
		} else {
			$ulang = $_COOKIE['e107language_'.$pref['cookie_name']];
		}
		if ($pref['user_tracking'] == "session") {
			$ulang = $_SESSION['e107_language'];
		} else {
			$ulang = $_COOKIE['e107_language'];
		}
		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$settings = $sql->db_Fetch();
		$friendb = explode("|", $settings['user_friends']);
		$friendb1 = explode("|", $settings['user_friends_request']);
		if (USER && $id != USERID && !in_array(USERID, $friendb) && !in_array(USERID, $friendb1)) {
			$text .= "<a href='newuser.php?id=".$id."&add' style=\"text-decoration: none;\" title='".PROFILE_16."'><img src='images/buttons/".e_LANGUAGE."_addfriend.png' border='0'></a>";
		}
	}
	$text .= "</center></td></TR>";
	$text .= "<TR>
		<td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".$online."&nbsp; $onlinetextleft</span><span style='float:right; text-align:right'>$onlinetext!</span></td>
		</TR>";
	$text .= "<TR>
		<td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>{USER_REALNAME_ICON}&nbsp; ".PROFILE_350."</span><span style='float:right; text-align:right'>{USER_REALNAME}</span></td>
		</TR>";
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>{USER_EMAIL_ICON}&nbsp; ".PROFILE_351."</span><span style='float:right; text-align:right'>{USER_EMAIL}{USER_EMAIL_LINK}</span></td>
		</TR>";
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_352.":</span><span style='float:right; text-align:right'>{USER_LEVEL}</span></td>
		</TR>";
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_353.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_LASTVISIT}<br />{USER_LASTVISIT_LAPSE}</span></td>
		</TR>";
	if ($pref['profile_user_warn_support'] == "Yes" AND $sql->db_Select("user_extended", "*", "user_extended_id='$id' AND user_warn!='null' AND user_warn!=''")) {
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_311.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_WARN}</span></td>
		</TR>";
	}
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_354.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_JOIN}<br />{USER_DAYSREGGED}</td>
		</TR>";
			
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_138.":</span><span style='float:right; text-align:right' ><a href='".e_PLUGIN."pm/pm.php?send.$id'><img src='".e_PLUGIN."pm/images/pm.png' title='".PROFILE_138."' alt='' border='0'></a></span></td>
		</TR></td></TR>";
	$sql_signo = new db;
	$signo = $sql_signo->db_Count("user","(*)","where user_id = '$id' && user_signature !='' LIMIT 1");
	if ($signo == 1) {
	$text .= "<TR>
		<td colspan='2'  style='width:100%' class='forumheader3'><center>{USER_SIGNATURE}</center></td>
		</tr>";
	}
	$text .= "</table></div><table></table>";
	

	// Check member settings - NO Admin & NO Friends
	if (!USERID == ADMIN || !USER) {
		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$settings = $sql->db_Fetch();
		$break = explode("|",$settings['user_settings']);
		$friendb = explode("|", $settings['user_friends']);
		if ((!USER && $break[0] == 1) || ($break[0] == 1 && $id != USERID && !isset($_GET['add']))) {
			//----------- Only friends
			if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
				$text .= "<br/>".$username." ".PROFILE_104;
				$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
				$ns->tablerender("",$display);
				require_once(FOOTERF);
				exit;
			} else if ($pref['profile_friends'] != "ON") {
				$text .= "<br/>".$username." ".PROFILE_104a;
				$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
				$ns->tablerender("",$display);
				require_once(FOOTERF);
				exit;
			}
		}
	}

	if(!isset($_GET['add'])) {
		if ($_GET['page'] == "") {
			$text .= "<br/><table style='".USER_WIDTH."' class='fborder table'>";
			$text .= "<TR><td style='width:25%'></td></TR>";
			$text .= "{USER_EXTENDED_ALL}";
			$text .= "</table>";
			$text .= "<br/><table width='100%' class='fborder'>";
			$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader'><span style='float:left'></span></td></tr>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_356."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_CHATPOSTS} ( {USER_CHATPER}% )</td></TR>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_357."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_COMMENTPOSTS} ( {USER_COMMENTPER}% )</td></TR>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_358."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_FORUMPOSTS} ( {USER_FORUMPER}% )</td></TR>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_359."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_VISITS}</td></TR>";
			// CHECK TO SEE IF USING GOLD SYSTEM
			if (function_exists('gold')) {
				$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader'><span style='float:left'>Kredit rendszer</span></td></tr>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_218."<br><a href='".e_BASE.e_PLUGIN."gold_system/donate.php?{USER_NAME}'><i>".PROFILE_217."</i></a>&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_GOLD}</td></TR>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_28."&nbsp;".$pref['gold_currency_name']."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_SPENT}</td></TR>";
			}
			// Profil zene
			$sql->mySQLresult = @mysql_query("SELECT user_mp3 FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$mp3 = $sql->db_Fetch();
			if ($mp3['user_mp3'] != "" && $pref['profile_mp3enabled'] == "ON" && !isset($_GET['page'])) {
				$type = substr(strrchr($mp3['user_mp3'], '.'), 1);
				if(strpos($mp3['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
					$mp3file = "usermp3/".$id.".".$type;
					$mp3display = str_replace("_", " ", $mp3['user_mp3']);
				} else {
					$mp3file = $mp3['user_mp3'];
					$mp3break = explode("/", $mp3['user_mp3']);
					$mp3display = str_replace("_", " ", end($mp3break));
				}
				// Zene lejatszasa
				if (!USERID == ADMIN || !USER) {
					$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
					$settings = $sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					$friendb = explode("|", $settings['user_friends']);
					if ((!USER && $break[10] == 1) || ($break[10] == 1 && $id != USERID && !isset($_GET['add']))) {
						//----------- Only friends
						if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
							$text .= "</table>";
							$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
							$ns->tablerender("",$display);
							require_once(FOOTERF);
							exit;
						} else if ($pref['profile_friends'] != "ON") {
							$text .= "</table>";
							$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
							$ns->tablerender("",$display);
							require_once(FOOTERF);
							exit;
						}
					}
				}
				if ($pref['profile_mp3_autoplay'] == "Yes") {
					$profile_mp3_autoplay = "&autoplay=1";
				}
				if ($pref['profile_mp3_loop'] == "Yes") {
					$profile_mp3_loop = "&loop=1";
				}
				if ($pref['profile_mp3_volume']) {
					$profile_mp3_volume = $pref['profile_mp3_volume'];
					if ($profile_mp3_volume > 200) $profile_mp3_volume = 200;
					$profile_mp3_volume = "&volume=".$profile_mp3_volume."";
				}
				$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_416.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>
					<object type='application/x-shockwave-flash' data='player_mp3_maxi.swf' width='150' height='16'>
					<param name='wmode' value='transparent' />
					<param name='movie' value='player_mp3_maxi.swf' />
					<param name='FlashVars' value='mp3=".$mp3file.$profile_mp3_autoplay.$profile_mp3_loop.$profile_mp3_volume."' />
					</object></span></td></tr>";
			}
			// Profil Szerkesztő link
			if (USERID == $id && ADMIN) {
				$text .= "{USER_UPDATE_LINK}";
			} else {
				if (USERID == $id) {
					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='".e_BASE."usersettings.php'>".PROFILE_360."</a></center></td></tr>";
				} elseif (ADMIN && getperms("4")) {
					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='newusersettings.php?uid=".$id."'>".PROFILE_29."</a></center></td></tr>";
				}
			}
			$text .= "</td></tr></table>";
		}
	}

	if (isset($_GET['page'])) {
		if ($_GET['page'] == friends) {
			// Check member settings - NO Admin & NO Friends
			if (!USERID == ADMIN || !USER) {
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
				if ((!USER && $break[6] == 1) || ($break[6] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
					if (!in_array(USERID, $friendb) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_252;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
				}
			}
			if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
				if ($pref['profile_frcol'] == '') {
					$frcolumn = '6';
				} elseif ($pref['profile_frcol'] > '8') {
					$frcolumn = '8';
				} else {
					$frcolumn = $pref['profile_frcol'];
				}

				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$list = $sql->db_Fetch();
				$friend = explode("|", $list['user_friends']);
				$num = count($friend) - 2;
				if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
					$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><img src='images/friends.png'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
				} else {
					$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><img src='images/friends.png'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr></table>";
					$text .= "<table width='100%'>";
					$column = 1;
					foreach ($friend as $fr) {
						if ($column==1) {
						$text .="<tr>";
						}
						if ($fr == '') {
						// DO NOTHING
						} else {
							$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$fr."' ");
							$fname = $sql->db_Fetch();
							$user_name = $fname['user_name'];
							$frnames[] = $user_name;
							array_multisort ($frnames, SORT_ASC);
						}
					}
					foreach ($frnames as $frname) {
						$sql->mySQLresult = @mysql_query("SELECT user_id, user_name, user_image FROM ".MPREFIX."user WHERE user_name='".$frname."' ");
						$name = $sql->db_Fetch();
						$user_name = $name['user_name'];
						$fr = $name['user_id'];
						$on_name = "".$fr.".".$user_name."";
						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width = '10%'><div align='center'><a href='newuser.php?id=".$fr."'>";
						if($name[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."another_profiles/images/noavatar.png' border='1' width='64' alt='' />";
						}else{
							$user_image = $name[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
						//	$text .= "<img src='".$user_image."' border='1' width='64' alt='' />";
							$text .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
						}
						$text .= "<br/></a>".$online." ".$name['user_name']."</div></td>";
						$column++;
						if ($column == $frcolumn + 1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
					$text .= "</table>";
					$text .= "<br/><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
				}
			}

		} elseif ($_GET['page'] == videos) {
			// Check member settings - NO Admin & NO Friends
			if (!USERID == ADMIN || !USER) {
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
				if ((!USER && $break[7] == 1) || ($break[7] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_251;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else if ($pref['profile_friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_251a;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
				}
			}
			if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
				require_once("videos.php");
			}

		} elseif ($_GET['page'] == comments) {
			// Check member settings - NO Admin & NO Friends
			if (!USERID == ADMIN || !USER) {
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
				if ((!USER && $break[9] == 1) || ($break[9] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_253;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else if ($pref['profile_friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_253a;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
				}
			}
			if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
				// MULTIPAGES INFO
				if ($pref['profile_apcomments'] != '') {
					$rowsPerPage = $pref['profile_apcomments'];
				} else {
					$rowsPerPage = 5;
				}
				$pageNum = 1;
				if(isset($_GET['pgnum'])) {
					$pageNum = intval($_GET['pgnum']);
				}
				$offset = ($pageNum - 1) * $rowsPerPage;
				if(isset($_GET['comment_order'])) {
					if($_GET['comment_order'] == "ASC" || $_GET['comment_order'] == "DESC") {
						$comment_order = $_GET['comment_order'];
					}
				}
				if (!$comment_order == ASC || !$comment_order == DESC) {
					$comment_order = "DESC";
				}
				$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='prof' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
				$comm = $sql->db_Rows();
				$maxPage = ceil($comnumrows/$rowsPerPage);
				$self = $_SERVER['PHP_SELF'];
				$nav  = '';
				for($page = 1; $page <= $maxPage; $page++) {
					if ($page == $pageNum) {
						$nav .= "";
					} else {
						$nav .= " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
					}
				}
				if ($pageNum > 1) {
					$page  = $pageNum - 1;
					$prev  = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";
					$first = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
				} else {
					$prev  = ''; // we're on page one, don't print previous link
					$first = '&nbsp;'; // nor the first page link
				}
				if ($pageNum < $maxPage) {
					$page = $pageNum + 1;
					$next = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";
					$last = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
				} else {
					$next = ''; // we're on the last page, don't print next link
					$last = '&nbsp;'; // nor the last page link
				}
					if ($pref['profile_maxpcomment'] != '') {
						$maxpcomment = $pref['profile_maxpcomment'];
					} else {
						$maxpcomment = 100;
					}
				if ($comm == 0) {
					$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><img src='images/comments.png'><i>".PROFILE_32."</i></td></tr></table>";
				} else {
					$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>

						<tr>
							<td style='width:20%; text-align:left' class='fborder table' colspan='2'><img src='images/comments.png'><i>".PROFILE_36a." (".$comnumrows."):</i></td>";
							if ($comment_order == DESC) {
							$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=comments&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
							} else {
							$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=comments&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
							}
							$text .= "</tr>
					</table>";


					$text .= "<br/>";					//Profil hozzászólások listája indul
					for ($i = 0; $i < $comm; $i++) {
						$com = $sql->db_Fetch();
						$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
						$from = mysql_fetch_assoc($from);
						$date = date("Y m d - H:i", $com['com_date']);
						$comid = $com['com_id'];
						$user_name = $from['user_name'];
						$on_name = "".$com['com_by'].".".$user_name."";
						$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
						$checkonline = mysql_num_rows($checkonline);
						//e107_0.8 compatible
						if(file_exists(e_HANDLER."level_handler.php")){
							require_once(e_HANDLER."level_handler.php");
							$ldata = get_level($from['user_id'], $from['user_forums'], $from['user_comments'], $from['user_chats'], $from['user_visits'], $from['user_join'], $from['user_admin'], $from['user_perms'], $pref);
						} else {
							//
						}
						if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
							$from_level = "".PROFILE_276."<br/>$ldata[1]";
						}
						else if(strstr($ldata[0], "IMAGE")) {
							$from_level = "".PROFILE_277."<br/>$ldata[1]<br/>";
						} else {
							$from_level = $ldata[1];
						}
						$gen = new convert;
						$from_join = $gen->convert_date($from['user_join'], "forum");
						$from_signature = $from['user_signature'] ? $tp->toHTML($from['user_signature'], TRUE) : "";
						$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
						$fromext = mysql_fetch_assoc($fromext);
						if( $checkonline > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
						} else {
							$online = "";
						}
						unset($checkonline,$on_name);
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>
						<tr>
							<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
							<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
							<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
						</tr>
							<td class='forumheader'>&nbsp;".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
							<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
							<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
						<tr>
							<td class='forumheader3' style='vertical-align: top; width='20%;' />";
						// GET COMMENTERS AVATAR
						if($from[user_image] == "") {
							$av = "".e_PLUGIN."another_profiles/images/noavatar.png";
							$text .= "".$from['user_customtitle']."<br/><br/><a href='newuser.php?id=".$com['com_by']."'>{SETIMAGE: w=120}{USER_AVATAR: shape=circle}</a>";
						} else {
							$av = $from[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$av = avatar($av);
							$text .= "".$from['user_customtitle']."<br/><br/><a href='newuser.php?id=".$com['com_by']."'>{SETIMAGE: w=120}{USER_AVATAR: shape=circle}</a>";
						}
						if ($pref['profile_user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
							$text .= "<br/><img src=\"".THEME_ABS."images/warn/".$fromext['user_warn'].".png\">";
						}
						$text .= "<br/>$from_level<br/><div class='smallblacktext'>".PROFILE_270."<br/>$from_join<br/>".PROFILE_272.$fromext['user_location']."</div></td>";
						$message = $tp -> toHTML($com['com_message'], true, 'parse_sc, constants');
						$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>";
						$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#header' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td>";
						if (USER) {
							if ($comnumrows < $maxpcomment) {
								$text .= "<td colspan='2'  class='forumheader' style='vertical-align: middle; text-align:right' /><div class='smallblacktext'>| <a href='".e_SELF."?".e_QUERY."#newprofilecomment'>".PROFILE_414."</a> | <a href='".e_SELF."?".e_QUERY."&vtoname=".$from['user_name']."&vtodate=".$date."&vtoid=".$comid."#newprofilecomment'>".PROFILE_415."</a> |</td></div></tr></table><br/><br/>";
							} else {
								$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
							}
						} else {
							$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
						}
					}
				}
				$text .= "<br/><center>".$prev.$nav.$next."</center><br/><br/>";
				// Hozzászólások listázásának vége
				if (USER) {

					if ($comnumrows < $maxpcomment) {
						if (isset($_GET['vtoname']) && isset($_GET['vtodate']) && isset($_GET['vtoid'])) {
							$vtoname = $_GET['vtoname'];
							$vtodate = $_GET['vtodate'];
							$vtoid = $_GET['vtoid'];
							$vtomessage = "[blockquote]".PROFILE_279."".$vtoname." #".$vtoid."".PROFILE_280."[/blockquote]";
						}
						$text .= "<a name='newprofilecomment'></a>";
						$text .= "<form method='post' action='formhandler.php'><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' style='vertical-align: middle;' /><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></td>";
						if (!e_WYSIWYG) {
							require_once(e_HANDLER."ren_help.php");
						}
						$cbox = "<tr><td><textarea class='e-wysiwyg tbox' id='data' name='user_comment' cols='50' rows='10' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea></td></tr><tr><td>";
						if (!e_WYSIWYG) {
							$cbox .= display_help("helpb", "body");
						}
						$cbox .= "</td></tr>";
						// Check member settings
						if ($break[1] == 1 && $id != USERID) {
							if ((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) {
								$text .= "<tr><td>".$username." ".PROFILE_105."</td></tr></form>";
							} else if ($pref['profile_friends'] != "ON") {
								$text .= "<tr><td>".$username." ".PROFILE_105a."</td></tr></form>";
							} else {
								$text .= $cbox;
								$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'>";
								if ($pref['profile_buttontype'] == "Yes") {
									$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
								} else {
									$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
								}
							}
						} else {
							$text .= $cbox;
							$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'>";
							if ($pref['profile_buttontype'] == "Yes") {
								$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
							} else {
								$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
							}
						}

					} else {
						$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td><div class='forumheader'>".PROFILE_237." ($maxpcomment".PROFILE_236.").</div>";
					}
					$text .= "</td></tr></table></form>";
				}
			}
			// Images
		} elseif ($_GET['page'] == images) {
			// Check member settings - NO Admin & NO Friends
			if (!USERID == ADMIN || !USER) {
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
				if ((!USER && $break[8] == 1) || ($break[8] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_250;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else	if ($pref['profile_friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_250a;
						$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
				}
			}
			if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
				$picdir = "userimages/".$id."/";
				$picthumbdir = "userimages/".$id."/thumbs";

				function countpicFiles($strDirName) {
					if ($hndDir = opendir($strDirName)){
						$intCount = 0;
						while (false !== ($strFilename = readdir($hndDir))){
							if ($strFilename != "." && $strFilename != ".."){
								$intCount++;
							}
						}
						closedir($hndDir);
					} else {
						$intCount = -1;
					}
					return $intCount;
				}

				$kepekszama = countpicFiles($picdir);
				if(file_exists($picthumbdir)){
					if ($kepekszama < 3) {
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
				}
				if(!file_exists($picthumbdir)){
					if ($kepekszama < 2) {
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
				}
				if (isset($_GET['album']) && isset($_GET['pic'])) {
					if ($_GET['album'] != "root") {
						$dir = "userimages/".$id."/".$_GET['album']."/";
					} else {
						$dir = "userimages/".$id."/";
					}
//MOD_20120418
//								$dirHandle = opendir($dir);
					if ($handle = opendir($dir)) {
						$filenames = array();
						while (false !== ($filename = readdir($handle))) {
							$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
						}
if ($pref['profile_userpic_order'] == 'ASC' || $pref['profile_userpic_order'] == '') {
						usort($file_list, create_function('$a, $b', "return strcmp(\$a['mtime'], \$b['mtime']);"));
} else {
						usort($file_list, create_function('$b, $a', "return strcmp(\$a['mtime'], \$b['mtime']);"));
}
						closedir($handle);
					}
$np =0;
foreach($file_list as $one_file) {
 $file = $one_file['name'];
 if (!is_dir($dir.$file)){
  if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "only_friends" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
   if ($np == 1) {
     $next_pic = $file;
     break;
   }
   if ($file == $_GET['pic']) $np = 1;
   if (!$np ==1) $prev_pic = $file;
  }
 }
}



					$aof = 0;
					if (file_exists($dir."/only_friends")) $aof = 1;
					if ((in_array(USERID, $friendb) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $id == USERID || (ADMIN && getperms("4"))) {
						$split = explode(".", $_GET['pic']);
						$counter=0;
						foreach($split as $string) {
							$counter++;
							if ($string == '') {
								$split_id = $split[$counter];
								$id = $split_id;
								$lnk=true;
								break;
							}
						}
						$kiterjesztes = $split[$counter - 1];
						$picname = str_replace(".".$split[$counter - 1]."", "", $_GET['pic']);
						$myFile = $dir.$picname.".txt";
/*
						if ($_GET['album'] != "root") {
							$text .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_", " ", $_GET['album'])."\"</a><br/><br/>";
						} else {
							$text .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><br/>";
						}
*/

						$kepmeret = getimagesize("".$dir.$_GET['pic']."");
						$kep_sz = $kepmeret[0]+30;
						$kep_m = $kepmeret[1]+30;
						if ($pref['profile_picviewsize'] == '') {
							$picviewsize = '600';
						} else {
							$picviewsize = $pref['profile_picviewsize'];
						}

if ($prev_pic) {
$prev .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$prev_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='prev' title='".PROFILE_426."' src='images/prev.png'></a>";
}
if ($next_pic) {
$next .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$next_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_427."' src='images/next.png'></a>";
}

if ($_GET['album'] != "root") {
$up_pic .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34a." ".$_GET['album']."' src='images/up.png'></a>";
} else {
$up_pic .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34."' src='images/up.png'></a>";
}

$text .= '<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="3" rowspan="1" style="vertical-align: top;"><br>
';




						if ($pref['profile_lightview'] == 'Yes' && $pref['cl_widget_ver'] != ''){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightview\" title='".$username.": ::".str_replace("_", " ", $picname)."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."a</center>";
							}
						} else if ($pref['profile_lightwindowbox'] == 'Yes' && (file_exists(e_PLUGIN."lightwindow/js/lightwindow.js"))){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightwindow\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($pref['profile_lightbox'] == 'Yes' && $pref['lightb_enabled'] == '1'){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"lightbox[roadtrip]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($pref['profile_clearbox'] == 'Yes'){
							echo '
								<script language="JavaScript" src="clearbox/js/clearbox.js" type="text/javascript" charset="iso-8859-2"></script>
								<link rel="stylesheet" href="clearbox/css/clearbox.css" rel="stylesheet" type="text/css"/>
							';





if ($kep_sz<$picviewsize+31) {
//	$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
	$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox[gallery=gallery]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."'></a><br/>".str_replace("_", " ", $picname)."</center>";

} else {
	$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox[gallery=gallery]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
}
foreach($file_list as $one_file) {
 $file = $one_file['name'];
 if (!is_dir($dir.$file)){
  if ($file != "." && $file != $_GET['pic'] && $file != ".." && $file != "Thumbs.db" && $file != "only_friends" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
//	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]"><img src="'.$dir.$file.'"></a>';
 if (is_file($dir."thumbs/".$file)) {
	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]" tnhref="'.$dir."thumbs/".$file.'"></a>';
} else {
	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]" tnhref="'.$dir.$file.'"></a>';
}
  }
 }
}


 

/*
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
*/
						} else {
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='#' title='".PROFILE_167."' onClick=\"window.open('".$dir.$_GET['pic']."','','menubar=no,titlebar=no,resizable=no,scrollbars=yes,width=$kep_sz,height=$kep_m')\"><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						}

$text .= '</td>
</tr>
<tr>
<td style="vertical-align: top; text-align: center; width: 10%;">'.$prev.'<br>
</td>
<td style="vertical-align: top; text-align: center; width: 10%;"><br/><br/>'.$up_pic.'
</td>
<td style="vertical-align: top; text-align: center; width: 10%;">'.$next.'<br>
</td>
</tr>
</tbody>
</table>';







						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date DESC");
						$piccomm = $sql->db_Rows();
						// Kép hozzászólások listázása
						$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."'");
						$picnumrows = $sql->db_Rows();
						// MULTIPAGES INFO
						if ($pref['profile_apcomments'] != '') {
							$rowsPerPage = $pref['profile_apcomments'];
						} else {
							$rowsPerPage = 5;
						}
						$pageNum = 1;
						if(isset($_GET['pgnum'])) {
							$pageNum = intval($_GET['pgnum']);
						}
						$offset = ($pageNum - 1) * $rowsPerPage;
						if(isset($_GET['comment_order'])) {
							if($_GET['comment_order'] == "ASC" || $_GET['comment_order'] == "DESC") {
								$comment_order = $_GET['comment_order'];
							}
						}
						if (!$comment_order == ASC || !$comment_order == DESC) {
							$comment_order = "DESC";
						}
						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
						$piccomm = $sql->db_Rows();
						$maxPage = ceil($picnumrows/$rowsPerPage);
						$self = $_SERVER['PHP_SELF'];
						$nav  = '';
						for($page = 1; $page <= $maxPage; $page++) {
							if ($page == $pageNum) {
								$nav .= ""; // no need to create a link to current page
							} else {
								$nav .= " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
							}
						}
						if ($pageNum > 1) {
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";
							$first = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
						} else {
							$prev  = ''; // we're on page one, don't print previous link
							$first = '&nbsp;'; // nor the first page link
						}
						if ($pageNum < $maxPage) {
							$page = $pageNum + 1;
							$next = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";
							$last = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
						} else {
							$next = ''; // we're on the last page, don't print next link
							$last = '&nbsp;'; // nor the last page link
						}
						// END OF MULTIPAGES
	
						if ($pref['profile_maxpiccomment'] != '') {
							$maxpiccomment = $pref['profile_maxpiccomment'];
						} else {
							$maxpiccomment = 50;
						}
						if ($piccomm == 0) {
							$text .= "<br/><br/><i>".PROFILE_36."</i>";
						} else {
						$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>
								<tr>
									<td style='width:20%; text-align:left' class='fborder table' colspan='2'><img src='images/comments.png'><i>".PROFILE_36a." (".$picnumrows."):</i></td>";
									if ($comment_order == DESC) {
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
									} else {
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
									}
									$text .= "</tr>
							</table>";
							$text .= "<br/>";
							// Kép hozzászólások indul
							for ($i = 0; $i < $piccomm; $i++) {
								$com = $sql->db_Fetch();
								$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
								$from = mysql_fetch_assoc($from);
								$date = date("Y m d - H:i", $com['com_date']);
								$comid = $com['com_id'];
								$user_name = $from['user_name'];
								$on_name = "".$com['com_by'].".".$user_name."";
								$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
								$checkonline = mysql_num_rows($checkonline);
								//e107_0.8 compatible
								if(file_exists(e_HANDLER."level_handler.php")){
									require_once(e_HANDLER."level_handler.php");
									$ldata = get_level($from['user_id'], $from['user_forums'], $from['user_comments'], $from['user_chats'], $from['user_visits'], $from['user_join'], $from['user_admin'], $from['user_perms'], $pref);
								} else {
									//
								}
								if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
									$from_level = "".PROFILE_276."<br/>$ldata[1]";
								}
								else if(strstr($ldata[0], "IMAGE")) {
									$from_level = "".PROFILE_277."<br/>$ldata[1]<br/>";
								} else {
									$from_level = $ldata[1];
								}
								$gen = new convert;
								$from_join = $gen->convert_date($from['user_join'], "forum");
								$from_signature = $from['user_signature'] ? $tp->toHTML($from['user_signature'], TRUE) : "";
								$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
								$fromext = mysql_fetch_assoc($fromext);
								if( $checkonline > 0 ) {
									$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
								} else {
									$online = "";
								}
								unset($checkonline,$on_name);
								$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>
								<tr>
									<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
									<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
									<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
								</tr>
									<td class='forumheader'>&nbsp;".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
									<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
									<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
								<tr>
									<td class='forumheader3' style='vertical-align: top; width='20%;' />";
								// GET COMMENTERS AVATAR
								if($from[user_image] == "") {
									$av = "".e_PLUGIN."another_profiles/images/noavatar.png";
									$text .= "".$from['user_customtitle']."<br/><br/><a href='newuser.php?id=".$com['com_by']."'>{SETIMAGE: w=120}{USER_AVATAR: shape=circle}</a>";
								} else {
									$av = $from[user_image];
									require_once(e_HANDLER."avatar_handler.php");
									$av = avatar($av);
									$text .= "".$from['user_customtitle']."<br/><br/><a href='newuser.php?id=".$com['com_by']."'>{SETIMAGE: w=120}{USER_AVATAR: shape=circle}</a>";
								}
								if ($pref['profile_user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
									$text .= "<br/><img src=\"".THEME_ABS."images/warn/".$fromext['user_warn'].".png\">";
								}
								$text .= "<br/>$from_level<br/><div class='smallblacktext'>".PROFILE_270."$from_join<br/>".PROFILE_272.$fromext['user_location']."</div></td>";
								$message = $tp -> toHTML($com['com_message'], true, 'parse_sc, constants');
								$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>";
								$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#header' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td>";
								if (USER) {
									if ($picnumrows < $maxpiccomment) {
										$text .= "<td colspan='2'  class='forumheader' style='vertical-align: middle; text-align:right' /><div class='smallblacktext'>| <a href='".e_SELF."?".e_QUERY."#newprofilecomment'>".PROFILE_414."</a> | <a href='".e_SELF."?".e_QUERY."&vtoname=".$from['user_name']."&vtodate=".$date."&vtoid=".$comid."#newprofilecomment'>".PROFILE_415."</a> |</td></div></tr></table><br/><br/>";
									} else {
										$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
									}
								} else {
									$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
								}
							}
						}
						$text .= "<br/><center>".$prev.$nav.$next."</center><br/><br/>";
						// Kép hozzászólások listázásának vége
						if (USER) {
							if ($picnumrows < $maxpiccomment) {
								if (isset($_GET['vtoname']) && isset($_GET['vtodate']) && isset($_GET['vtoid'])) {
									$vtoname = $_GET['vtoname'];
									$vtodate = $_GET['vtodate'];
									$vtoid = $_GET['vtoid'];
									$vtomessage = "[blockquote]".PROFILE_279."".$vtoname." #".$vtoid."".PROFILE_280."[/blockquote]";
								}
								$text .= "<a name='newprofilecomment'></a>";
								$text .= "<form method='post' action='formhandler.php'><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' style='vertical-align: middle;' /><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></td>";
								if (!e_WYSIWYG) {
									require_once(e_HANDLER."ren_help.php");
								}
								$cpbox = "<tr><td><input type='hidden' name='album' value='".$_GET['album']."'><textarea class='e-wysiwyg tbox' id='data' name='user_picture_comment' cols='50' rows='10' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea></td></tr><tr><td>";
								if (!e_WYSIWYG) {
									$cpbox .= display_help("helpb", "body");
								}
								$cpbox .= "</td></tr>";
								// Check member settings
								if ($break[2] == 1 && $id != USERID) {
									if ((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) {
										$text .= "<tr><td>".$username." ".PROFILE_107b."</td></tr></table></form>";
									} else if ($pref['profile_friends'] != "ON") {
										$text .= "<tr><td>".$username." ".PROFILE_107c."</td></tr></table></form>";
									} else {
										$text .= $cpbox;
										///comment küldése
										$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
										if ($pref['profile_buttontype'] == "Yes") {
											$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
										} else {
										$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
										}
									}
								} else {
									$text .= $cpbox;
									///comment küldése
									$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
									if ($pref['profile_buttontype'] == "Yes") {
										$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
									} else {
										$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
									}
								}
							} else {
								$text .= "<table width='100%'><tr><td><div class='forumheader'>".PROFILE_238." ($maxpiccomment".PROFILE_236.").</div>";
							}
								$text .= "</td></tr></table></form>";
						}
					}
				} elseif (isset($_GET['album']) && !isset($_GET['pic'])) {
					$text .= "<a href='newuser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/>";
					$dir = "userimages/".$id."/".$_GET['album']."/";
					if ((in_array(USERID, $friendb) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $id == USERID || (ADMIN && getperms("4"))) {
						if (file_exists($dir)) {
							// IF glob has been disabled by your host then uncomment the above function and comment out the next 2 lines.
							$empty = (count(glob("$dir/*")) === 0) ? 'TRUE' : 'FALSE';
							if ($empty == "TRUE") {
								// Comment out until here - when uncommenting above, just remove the /* and */ from function to if.
								$text .= "<br/><i>".PROFILE_123."</i>";
							} else {
								$column = 1;
								if ($pref['profile_piccol']) {
									$profile_piccol = $pref['profile_piccol'];
								} else {
									$profile_piccol = 3;
								}
								$profile_piccol_p = intval(100/$profile_piccol);
								$text .= "<br/><table width='100%'>";
//MOD_20120418
//								$dirHandle = opendir($dir);
					if ($handle = opendir($dir)) {
						$filenames = array();
						while (false !== ($filename = readdir($handle))) {
							$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
						}
if ($pref['profile_userpic_order'] == 'ASC' || $pref['profile_userpic_order'] == '') {
						usort($file_list, create_function('$a, $b', "return strcmp(\$a['mtime'], \$b['mtime']);"));
} else {
						usort($file_list, create_function('$b, $a', "return strcmp(\$a['mtime'], \$b['mtime']);"));
}
						closedir($handle);
//								while ($file = readdir($dirHandle)) {

foreach($file_list as $one_file) {
$file = $one_file['name'];
		// Get the file size.
		$fs = $one_file['size'];
		
if (e_LANGUAGE == "English") {
		$ft = date ('F j, Y  H:i', $one_file['mtime']);
} else {
		$ft = date("Y m j - H:i", $one_file['mtime']);
}

									$pos = strrpos($file, '.');
									$str = substr($file, $pos, strlen($file));
									$filetypes = ".jpg|.gif|.png|.jpeg|.JPG|.GIF|.PNG|.JPEG";
									$filetypes = explode("|", $filetypes);
									if(!is_dir($file) && in_array($str, $filetypes)) {
										$split = explode(".", $file);
										$counter=0;
										foreach($split as $string) {
											$counter++;
											if ($string == '') {
												$split_id = $split[$counter];
												$id = $split_id;
												$lnk=true;
												break;
											}
										}
										$kiterjesztes = $split[$counter - 1];
										$name = str_replace(".".$split[$counter - 1]."", "", $file);
										$newname = wordwrap($name, 17, "<br />\n");
										if ($column==1) {
											$text .="<tr>";
										}
										//Album pictures:
										if (file_exists($dir."/thumbs/".$file)) {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
											$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
											$pic_all = mysql_num_rows($query);
											if ($pic_all > 0) {
												$text .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
											} else {
												$text .= "</center></td>";
											}
										} else {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
											$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
											$pic_all = mysql_num_rows($query);
											if ($pic_all > 0) {
												$text .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
											} else {
												$text .= "</center></td>";
											}
										}
										$column++;
										if ($column == $profile_piccol + 1) {
											$text .= "</tr><tr><td><br/></td></tr>";
											$column = 1;
										}
									}
								}
//								closedir($dirHandle);
}
								$text .= "</table>";
							$text .= "<br/><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
							}
						} else {
							$text .= "<i>".PROFILE_123."</i>";
						}
					}

				} else {
					$dir = "userimages/".$id."/";
//MOD_20120418
					if ($handle = opendir($dir)) {
						$filenames = array();
						while (false !== ($filename = readdir($handle))) {
							$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
						}
if ($pref['profile_userpic_order'] == 'ASC' || $pref['profile_userpic_order'] == '') {
						usort($file_list, create_function('$a, $b', "return strcmp(\$a['mtime'], \$b['mtime']);"));
} else {
						usort($file_list, create_function('$b, $a', "return strcmp(\$a['mtime'], \$b['mtime']);"));
}
						closedir($handle);

//					}

					$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr>"; // <br/><br/>
//					if ($handle = opendir($dir)) {
						$col = 0;
						$piccol = 0;
						if ($pref['profile_piccol']) {
							$profile_piccol = $pref['profile_piccol'];
						} else {
							$profile_piccol = 3;
						}
						$profile_piccol_p = intval(100/$profile_piccol);
//						while (false !== ($file = readdir($handle))) {

foreach($file_list as $one_file) {
$file = $one_file['name'];
		// Get the file size.
		$fs = $one_file['size'];
		
		// Get the file's modification date.
if (e_LANGUAGE == "English") {
		$ft = date ('F j, Y  H:i', $one_file['mtime']);
} else {
		$ft = date("Y m d - H:i", $one_file['mtime']);
}

							if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
								if (substr(strrchr($file, '.'), 1) != "") {
									$split = explode(".", $file);
									$counter=0;
									foreach($split as $string) {
										$counter++;
										if ($string == '') {
											$split_id = $split[$counter];
											$id = $split_id;
											$lnk=true;
											break;
										}
									}
									$kiterjesztes = $split[$counter - 1];
									$name = str_replace(".".$split[$counter - 1]."", "", $file);
									$newname = wordwrap($name, 17, "<br />\n");
									//Pictures:
									if (file_exists($dir."thumbs/".$file)) {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=images&album=root&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
										$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$pic_all = mysql_num_rows($query);
										if ($pic_all > 0) {
											$pic .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
										} else {
											$pic .= "</center></td>";
										}
									} else {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=images&album=root&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
										$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$pic_all = mysql_num_rows($query);
										if ($pic_all > 0) {
											$pic .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
										} else {
											$pic .= "</center></td>";
										}
									}
									$piccol++;
									if ($piccol == $profile_piccol) {
										$pic .= "</tr><tr><td><br/></td></tr><tr>";
										$piccol = 0;
									}
								} else {
									$count = 0;
									$firstimage="";
									if ($subhandle = opendir($dir.$file)) {
										$aof = 0;
										while (false !== ($subfile = readdir($subhandle))) {
											if ($subfile=="only_friends") $aof = 1;
											if ($subfile != "only_friends" && $subfile != "." && $subfile != ".." && $subfile != "Thumbs.db" && $subfile != "thumbs"  && $subfile != "index.htm" ) {
												if ($firstimage == "") {
													$firstimage = $subfile;
												}
												$count = $count + 1;
											}
										}
									}
									if (file_exists($dir.$file."/thumbs/".$firstimage)) {
										$imageurl = "src='userimages/".$id."/".$file."/thumbs/".$firstimage."' ";
									} else {
										$imageurl = "src='userimages/".$id."/".$file."/".$firstimage."' width='100' ";
									}
									//Albums:
									if ((in_array(USERID, $friendb) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") && USER) || $aof != 1 || $id == USERID || (ADMIN && getperms("4"))) {
										if ($count == 0) {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img src='images/folder.png' width='64' style='padding:5px;border-style:outset;border-width:1px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
										} else {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='newuser.php?id=".$id."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img ".$imageurl." style='padding:5px;border-style:outset;border-width:3px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
										}
									}



									$col++;
									if ($col == $profile_piccol) {
										$text .= "</tr><tr><td><br/></td></tr><tr>";
										$col = 0;
									}
								}
							}
						}
//						closedir($handle);
					}
					$text .= "</tr><tr>".$pic."</tr></table>";

					if ($kepekszama > 2) {
						$text .= "<br/><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
					}
				}
			}
		}
		//MINDENNEK VÉGE

	} else {
		// Update profile views and last visitors
		if (USERID != $id && $pref['profile_stats'] == "ON" && mysql_query("SELECT user_lastviewed FROM ".MPREFIX."another_profiles LIMIT 0") && USER) {
			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$getdata = $sql->db_Fetch();
			$data = unserialize($getdata['user_lastviewed']);
			$newarray = Array();
			$count = 1;
			array_push($newarray, USERID."|".time());
			foreach ($data as $d) {
				$break = explode("|", $d);
				if ($count != 10 && USERID != $break[0]) {
					array_push($newarray, $d);
					$count++;
				}
			}
			$array = serialize($newarray);
			$sql -> db_Update("another_profiles", "user_lastviewed='".$array."', user_totalviews=user_totalviews + 1 WHERE user_id='".$id."' ");
		}
		if (isset($_GET['add'])) {
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$list = $sql->db_Fetch();
			$friend = explode("|", $list['user_friends']);
			$megjelolt = explode("|", $list['user_friends_request']);

			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".USERID."' ");
			$te_list = $sql->db_Fetch();
			$megjeloltek = explode("|", $te_list['user_friends_request']);

			$sql->mySQLresult = @mysql_query("SELECT user_id, user_name FROM ".MPREFIX."user WHERE user_id='".$id."' ");
			$ures = $sql->db_Fetch();
			$uresek = ($ures['user_name']);

			// Saját magad nem:
			if (USERID == $id) {
				$text .= "<br/>".PROFILE_100;
				//Csak tagok
			} elseif (!USER) {
				$text .= "<br/>".PROFILE_161;
				//Már barátod
			} elseif (in_array(USERID, $friend)) {
				$text .= "<br/>".PROFILE_140;
				//Már megjelölted
			} elseif (in_array(USERID, $megjelolt)) {
				$text .= "<br/>".PROFILE_140a;
				//Már megjelölt
			} elseif (in_array($id, $megjeloltek)) {
				$text .= "<br/>".PROFILE_140b;
				// Trükközés:
			} elseif ($uresek == '') {
				$text .= "<br/>".PROFILE_140c;
			} else {
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."another_profiles WHERE user_id='".USERID."' ");
				$yourows = $sql->db_Rows();
				$you = $sql->db_Fetch();
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$themrows = $sql->db_Rows();
				$them = $sql->db_Fetch();
				if ($_POST['add_no']) {
					header("Location: newuser.php?id=".$id."");
				} elseif ($_POST['add_yes']) {
					if ($them['user_friends_request'] != '') {
						$new = "".USERID."|";
						$request = $them['user_friends_request'].$new;
					} else {
						$request = "|".USERID."|";
					}
					if ($yourows != 0) {
					// DO NOTHING
					} else {
						$sql -> db_Insert("another_profiles", "'".USERID."', '', '', '', '', '', '', '', '0', '0', ''  ");
					}
						if ($themrows != 0) {
						$sql -> db_Update("another_profiles", "user_friends_request='".$request."' WHERE user_id='".$id."' ");
					} else {
						$sql -> db_Insert("another_profiles", "'".$id."', '', '', '', '".$request."', '', '', '', '0', '0', ''  ");
					}

					$sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
					$settings = $sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					if ($pref['profile_fr_req_sendpm'] == 'Yes') {
						if ($break[5] == 1 || !$settings[0] || $pref['profile_fr_req_sendpm_all'] == 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."another_profiles/newuser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."another_profiles/newusersettings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."another_profiles/newusersettings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					} else {
						if ($break[5] == 1 && $pref['profile_fr_req_sendpm_all'] != 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."another_profiles/newuser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."another_profiles/newusersettings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."another_profiles/newusersettings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					}
					//EMAIL TO USER
					if ($pref['profile_fr_req_sendemail'] == 'Yes') {
						if ($break[11] == 1 || !$settings[0] || $pref['profile_fr_req_sendemail_all'] == 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."another_profiles/newusersettings.php?page=friends";
							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
						}
					} else {
						if ($break[11] == 1 && $pref['profile_fr_req_sendemail_all'] != 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."another_profiles/newusersettings.php?page=friends";
							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
						}
					}
					$text .= "<br/>".PROFILE_40." ".$username." ".PROFILE_41."";
				} else {
					$text .= "<br/><center><b>".PROFILE_42." ".$username." ".PROFILE_43."</b><br/><br/><form method='post'><input class='button' type='submit' name='add_yes' value='".PROFILE_44."' />&nbsp;<input class='button' type='submit' name='add_no' value='".PROFILE_45."' /></form></center>";
				}
			}
		} else {
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_simple FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$rows = $sql->db_Rows();
			$profile = $sql->db_Fetch();
			$custompage = $profile['user_custompage'];
			$info = unserialize($custompage);
			$html .= $tp -> toHTML($custompage, true);
			$break = explode("[||]", $html);
		}
	}
		$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
		$ns->tablerender("",$display);
} else {
	require_once("memberlist.php");
}
require_once(FOOTERF);

?>