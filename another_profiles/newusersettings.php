<?php

if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
//e107_0.8 compatible
if(file_exists(e_FILE."shortcode/batch/user_shortcodes.php")){
	require_once(e_FILE."shortcode/batch/user_shortcodes.php");
} else {
	require_once(e_CORE."shortcodes/batch/user_shortcodes.php");
}

if(file_exists(e_FILE."shortcode/batch/usersettings_shortcodes.php")){
	require_once(e_FILE."shortcode/batch/usersettings_shortcodes.php");
} else {
	require_once(e_CORE."shortcodes/batch/usersettings_shortcodes.php");
}
//
if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}
require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_usersettings.php");
require_once(e_HANDLER."ren_help.php");
define("e_PAGETITLE", TITLE_PROFILE_2);
require_once(HEADERF);
global $user_shortcodes, $pref;

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

if (!USER) {
	$ns->tablerender($alert_icon,PROFILE_186);
	require_once(FOOTERF);
	exit;
}

if (isset($_GET['uid'])) {
	// ADMIN IS EDITING THEIR PROFILE
	$id = intval($_GET['uid']);
	$luid = "&uid=".$id."";
	if (!ADMIN || !getperms("4")) {
		header("location:".e_BASE."index.php");
		exit() ;
	}
} else {
	$id = USERID;
}
$sql -> db_Select("user", "*", "user_id=".$id."");
$user = $sql -> db_Fetch();
$userlastvisit = $user['user_lastvisit'];
// GET AVATAR
if ($pref['profile_avatarwidth'] == '') {
	$avwidth = "width='100'";
} else {
	$avwidth = "width='".$pref['profile_avatarwidth']."' ";
}
if ($pref['profile_avatarheight'] == '') {
	$avheight = '';
} else {
	$avheight = "height='".$pref['profile_avatarheight']."' ";
}
if($user['user_image'] == "") {
	$user_image = "".e_PLUGIN."another_profiles/images/noavatar.png";
//	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
	$avatar .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
} else {
	$user_image = $user['user_image'];
	require_once(e_HANDLER."avatar_handler.php");
	$user_image = avatar($user_image);
//	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />";
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
//	$profil_image .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
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
//	$profil_image .= "<img src='".$user_image."' border='1' ".$imagewidth." ".$imageheight." alt='' />";
//	$profil_image .= "".$user_image."";
	$profil_image .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
}

$text .= "<script langauge=\"JavaScript\" type=\"text/javascript\">
obj.style.display=\"block\";
function doMenu(item) {
	obj=document.getElementById(item);
	col=document.getElementById(\"x\" + item);
	if (obj.style.display==\"none\") {
		obj.style.display=\"block\";
	} else {
	obj.style.display=\"none\";
	}
}
</script>";
$username = $user['user_name'];
if (USER) {
	$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
	$friends = $sql->db_Fetch();
	// NEW COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT user_lastvisit FROM ".MPREFIX."user WHERE user_id='".$id."' ");
	$lastvisit = $sql->db_Fetch();
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='prof' ");
	$comnumrows = $sql->db_Rows();
	// NEW PIC COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='pics' ");
	$picnumrows = $sql->db_Rows();
	// NEW VID COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='vids' ");
	$vidnumrows = $sql->db_Rows();
	if ($friends['user_friends_request'] == "") {
		$count = 0;
	} else {
		$break = explode("|", $friends['user_friends_request']);
		$count = count($break) - 2;
	}
}
// MAX_PIC_FILESIZE
if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
	$post_max_info = intval(ini_get('upload_max_filesize'));
} else {
	$post_max_info = intval(ini_get('post_max_size'));
}
$maxkepmeret = $pref['profile_indmaxuploadsize']/1024;
if ($maxkepmeret >= $post_max_info) {
	$maxkepmeret = $post_max_info;
}
$maxkepmeret_kb = $maxkepmeret * 1024;
// MAX_MP3_FILESIZE
$maxmp3meret = $pref['profile_mp3size']/1024;
if ($maxmp3meret >= $post_max_info) {
	$maxmp3meret = $post_max_info;
}
$maxmp3meret_kb = $maxmp3meret * 1024;
// NAVIGATION
$image_rowspan = 8;
if ($pref['profile_friends'] != "ON") {$image_rowspan --;}
if ($pref['profile_pics'] != "ON") {$image_rowspan --;}
if ($pref['profile_videos'] != "ON") {$image_rowspan --;}
if ($pref['profile_mp3enabled'] != "ON") {$image_rowspan --;}
if ($pref['profile_commentson'] != "ON") {$image_rowspan --;}

$text .="<div class='main_caption'><b>".PROFILE_46."</div></b><br/>";
$text .="<table style='".USER_WIDTH."' class='fborder table'>";
$text .="<tr><td colspan='3'><br></td></tr>";
$text .="<tr><td colspan='3' class='fcaption' style='text-align:center'>".$id." {USER_ID}".PROFILE_169."".$username."{USER_NAME}</td></tr>";
$text .="<tr><td rowspan=$image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>".$username."</center></td></tr>";
// Hozzaferesi beallitasok
$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$text .= "<img src ='images/key.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=settings".$luid."'>".PROFILE_141."</a><br/>";
	$text .= "</td><td class='forumheader3'>".PROFILE_170."</td></tr>";
// Barátok
if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newfriends = $count." ".($count == 1 ? PROFILE_65 : PROFILE_65a);
	$text .= "<img src ='images/fr.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=friends".$luid."'>".PROFILE_60."</a>";
	$text .= "</td><td class='forumheader3'>".PROFILE_171."</td></tr>";
}
// Képek
if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
	$kvota = $pref['profile_maxuploadsize']/1024;
	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if ($pref['profile_maxpicnumber'] == '') {
		$maxpicnumber = '10';
	} else {
		$maxpicnumber = $pref['profile_maxpicnumber'];
	}
	if ($pref['profile_maxalbumnumber'] == '') {
		$maxalbumnumber = '6';
	} else {
		$maxalbumnumber = $pref['profile_maxalbumnumber'];
	}
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newpiccoms = $picnumrows." ".($picnumrows == 1 ? PROFILE_120 : PROFILE_120a)."";
	$text .= "<img src ='images/pict.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=images".$luid."'>".PROFILE_61."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_173."".sprintf("%01.1f", $kvota)."".PROFILE_174."$maxalbumnumber".PROFILE_174a."$maxpicnumber".PROFILE_174b." ".sprintf("%01.1f", $maxkepmeret)."".PROFILE_175."</span></td></tr>";
}
// Videok
$maxvideok = $pref['profile_maxnovids'];
if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newvidcoms = $vidnumrows." ".($picnumrows == 1 ? PROFILE_121 : PROFILE_121a)."";
	$text .= "<img src ='images/vid.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=videos".$luid."'>".PROFILE_165."</a><br>";
	if ($maxvideok > 0) {
		$text .= "</td><td class='forumheader3'>".PROFILE_177."$maxvideok".PROFILE_178."</span></td></tr>";
	} else {
		$text .= "</td><td class='forumheader3'>".PROFILE_177a."</span></td></tr>";
	}
}
// MP3
if ($pref['profile_mp3enabled'] == "ON" || $pref['profile_mp3enabled'] == "") {
	$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_background, user_simple, user_mp3 FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
	$rows = $sql->db_Rows();
	$profile = $sql->db_Fetch();
	if ($profile['user_mp3'] == "") {
		$mp3file = "<i>".PROFILE_278."</i>";
	} else {
		if(strpos($profile['user_mp3'], "http://") === false) {
		$mp3file = $profile['user_mp3'];
		} else {
			$mp3break = explode("/", $profile['user_mp3']);
			$mp3file = end($mp3break);
		}
	}
	$currentmp3 = " ".PROFILE_158." ".str_replace("_", " ", $mp3file);
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$text .= "<img src ='images/mp3.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=mp3".$luid."'>".PROFILE_166."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181."$currentmp3</span></td></tr>";
}
// Profil hozzászólások
if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newcoms = $comnumrows." ".($comnumrows == 1 ? PROFILE_64 : PROFILE_64a)."";
	$text .= "<img src ='images/comnt.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='newusersettings.php?page=comments".$luid."'>".PROFILE_62."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_183."</td></tr>";
}

$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
$text .= "<img src ='images/reg.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='usersettingshandler.php?".$luid."'>".PROFILE_59."</a>";
$text .= "</td><td class='forumheader3'>".PROFILE_185."</span></td></tr>";
$text .="<tr><td colspan='3' class='forumheader' style='text-align:center'>";
if (($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") || ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") || ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") || ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) {
$text .="| ";
}
if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
	if (!$comnumrows==0) {
		$text .="<b><a href='newusersettings.php?page=comments".$luid."'> $newcoms</a></b> | ";
	} else {
		$text .="<a href='newusersettings.php?page=comments".$luid."'> $newcoms</a> | ";
	}
}
if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
	if (!$picnumrows==0) {
		$text .="<b><a href='newusersettings.php?page=images".$luid."'>$newpiccoms</a></b> | ";
	} else {
		$text .="<a href='newusersettings.php?page=images".$luid."'>$newpiccoms</a> | ";
	}
}
if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
	if (!$vidnumrows==0) {
		$text .="<b><a href='newusersettings.php?page=videos".$luid."'>$newvidcoms</a></b> | ";
	} else {
		$text .="<a href='newusersettings.php?page=videos".$luid."'>$newvidcoms</a> | ";
	}
}
if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
	if (!$count==0) {
		$text .="<b><a href='newusersettings.php?page=friends".$luid."'> $newfriends</a></b> |</td></tr>";
	} else {
		$text .="<a href='newusersettings.php?page=friends".$luid."'> $newfriends</a> |</td></tr>";
	}
}
$text .="</table>";
if (isset($_GET['page'])) {
	if ($_GET['page'] == "friends") {
		if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
			if ($pref['profile_frcol'] == '') {
				$frcolumn = '6';
			} elseif ($pref['profile_frcol'] > '8') {
				$frcolumn = '8';
			} elseif ($pref['profile_frcol'] < '2') {
				$frcolumn = '2';
			} else {
				$frcolumn = $pref['profile_frcol'];
			}
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader'><img src='images/friends.png'>&nbsp;".PROFILE_60."</td></tr></table>";
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$list = $sql->db_Fetch();
			if (isset($_GET['acceptadd'])) {
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".intval($_GET['acceptadd'])."' ");
				$friend = $sql->db_Fetch();
				$check = explode("|", $friend['user_friends']);

				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
				$te_list = $sql->db_Fetch();
				$megjeloltek = explode("|", $te_list['user_friends_request']);

				if (in_array($id, $check)) {
					$text .= "<br/>".PROFILE_160."<br/>";
				} elseif (!in_array($_GET['acceptadd'], $megjeloltek)) {
					$text .= "<br/>".PROFILE_160a."<br/>";
				} else {
					$newrequests = str_replace("|".$_GET['acceptadd']."|" , "|", $list['user_friends_request']);
					if ($list['user_friends'] == '') {
						$newlist = "|".$_GET['acceptadd']."|";
					} else {
						$newlist = "".$list['user_friends']."".$_GET['acceptadd']."|";
					}
					if ($friend['user_friends'] == '') {
						$newfriend = "|".$id."|";
					} else {
						$newfriend = "".$friend['user_friends']."".$id."|";
					}
					$sql -> db_Update("another_profiles", "user_friends='".$newlist."' WHERE user_id='".$id."' ");
					$sql -> db_Update("another_profiles", "user_friends_request='".$newrequests."' WHERE user_id='".$id."' ");
					$sql -> db_Update("another_profiles", "user_friends='".$newfriend."' WHERE user_id='".intval($_GET['acceptadd'])."' ");
					header("Location: newusersettings.php?page=friends".$luid."");
				}

			} elseif (isset($_GET['rejectadd'])) {
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".intval($_GET['rejectadd'])."' ");
				$friend = $sql->db_Fetch();
				$newrequests = str_replace("|".intval($_GET['rejectadd'])."|" , "|", $list['user_friends_request']);
				$sql -> db_Update("another_profiles", "user_friends_request='".$newrequests."' WHERE user_id='".$id."' ");
				header("Location: newusersettings.php?page=friends".$luid."");
			}
			$friend = explode("|", $list['user_friends']);
			if ($list['user_friends_request'] == '' or $list['user_friends_request'] == '|') {
				// DO NOTHING
			} else {
				if ($frcolumn > '6') {	$frcolumn_1 = '5';
				} elseif ($frcolumn > '2') {	$frcolumn_1 = '4';
				} else {	$frcolumn_1 = '3';
				}
				$frcolumn_2 = $frcolumn_1 * 2 - 2;
				$requests = explode("|", $list['user_friends_request']);
				$text .= "<br/><table width='100%' class='fborder'><tr><td class='forumheader' colspan=$frcolumn_2>".PROFILE_65b."</td></tr>";
				$column = 1;
				foreach ($requests as $req) {
					if ($column==1) {
						$text .="<tr>";
					}
					if ($req == '') {
						// DO NOTHING
			  		} else {
						$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$req."' ");
						$frname = $sql->db_Fetch();
						$user_name = $frname['user_name'];
						$on_name = "".$req.".".$user_name."";
						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width='10%'><a href='newuser.php?id=".$req."'>";
						if($frname[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."another_profiles/images/noavatar.png' border='1' width='64'  alt='' />";
						}else{
							$user_image = $frname[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
							$text .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
						}
						$text .= "</a></td><td class='forumheader3'>".$online." <b>".$frname['user_name']."</b><br/><br/><a href='newusersettings.php?page=friends".$luid."&acceptadd=".$req."'>".PROFILE_66."</a> | <a href='newusersettings.php?page=friends".$uid."&rejectadd=".$req."'>".PROFILE_67."</a></td>";
						$column++;
						if ($column == $frcolumn_1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
				}
				$text .= "</table><br/>";
			}
			if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
				$text .= "<br/><i>".PROFILE_30b."";
			} else {
				$column=1;
				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'><tr><td class='forumheader' colspan=$frcolumn>".PROFILE_31a."</td></tr>";
				if ($column==1) {
					$text .="<tr>";
				}
				foreach ($friend as $fr) {
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
					$text .= "<td class='forumheader3' width = '10%'><a href='newuser.php?id=".$fr."'>";
					if($name[user_image] == "") {
						$text .= "<img src='".e_PLUGIN."another_profiles/images/noavatar.png' border='1' width='64' alt='' />";
					}else{
						$user_image = $name[user_image];
						require_once(e_HANDLER."avatar_handler.php");
						$user_image = avatar($user_image);
						$text .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
					}
					$text .= "<br/></a><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='box[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
					$column++;
					if ($column == $frcolumn + 1) {
						$text .= "</tr>";
						$column = 1;
					}
				}
				if ($pref['profile_buttontype'] == "Yes") {
					$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
				} else {
					$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_187."' class='button'></form>";
				}
			}

			$friend = "|";
			$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_friends_request like '%|".$id."|%' ";
			$result = mysql_query($query);
			while($noticia = mysql_fetch_array($result)) {
				$friend = $friend.$noticia["user_id"]."|";
			}
			$friend = explode("|", $friend);
			if ($friend[1] == '') {
			} else {
				$column=1;
				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'><tr><td class='forumheader' colspan=$frcolumn>".PROFILE_31b."</td></tr>";
				if ($column==1) {
					$text .="<tr>";
				}
				foreach ($friend as $fr) {
					if ($fr == '') {
					} else {
						$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$fr."' ");
						$name = $sql->db_Fetch();
						$user_name = $name['user_name'];
						$on_name = "".$fr.".".$user_name."";
						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width='10%'><a href='newuser.php?id=".$fr."'>";
						if($name[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."another_profiles/images/noavatar.png' border='1' width='64' alt='' />";
						}else{
							$user_image = $name[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
							$text .= "{SETIMAGE: w=120}{USER_AVATAR: shape=circle}";
						}
						$text .= "<br/></a><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='boxfr[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
						$column++;
						if ($column == $frcolumn + 1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
				}
				if ($pref['profile_buttontype'] == "Yes") {
					$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
				} else {
					$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_188."' class='button'></form>";
				}
			}
		}

	} elseif ($_GET['page'] == "settings") {
		$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader'><img src='images/settings.png'>&nbsp;".PROFILE_141a."</td></tr></table>";
		$sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$settings = $sql->db_Fetch();
		$break = explode("|",$settings['user_settings']);
		if ($break[0] == 1) {
			$friendsonly = "checked='yes'";
		}
		if ($break[1] == 1) {
			$friendscomonly = "checked='yes'";
		}
		if ($break[2] == 1) {
			$friendspiccomonly = "checked='yes'";
		}
		if ($break[3] == 1) {
			$forumadd = "checked='yes'";
		}
		if ($break[4] == 1) {
			$friendsvidcomonly = "checked='yes'";
		}
		if ($pref['profile_fr_req_sendpm'] == 'Yes') {
			if ($break[5] == 1 || !$settings[0]) {
				$sendpmonfriend = "checked='yes'";
			}
		} else {
			if ($break[5] == 1) {
				$sendpmonfriend = "checked='yes'";
			}
		}
		if ($break[6] == 1) {
			$sendpmonfriendfriends = "checked='yes'";
		}
		if ($break[7] == 1) {
			$sendpmonfriendvideos = "checked='yes'";
		}
		if ($break[8] == 1) {
			$sendpmonfriendpictures = "checked='yes'";
		}
		if ($break[9] == 1) {
			$sendpmonfriendprofilecomments = "checked='yes'";
		}
		if ($break[10] == 1) {
			$sendpmonfriendmp3 = "checked='yes'";
		}
		if ($pref['profile_fr_req_sendemail'] == 'Yes') {
			if ($break[11] == 1 || !$settings[0]) {
				$sendemailonfriend = "checked='yes'";
			}
		} else {
			if ($break[11] == 1) {
				$sendemailonfriend = "checked='yes'";
			}
		}
		// Beállítások
		$text .= "<table style='".USER_WIDTH."' class='fborder table'>";
		$text .= "<form method='POST' action='formhandler.php'>";
		$text .= "<tr>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='friendsonly' ".$friendsonly."> ".PROFILE_102."<br/>";
			if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendprofilecomments' ".$sendpmonfriendprofilecomments."> ".PROFILE_254."<br/>";
				$text .= "<input type='checkbox' name='friendscomonly' ".$friendscomonly."> ".PROFILE_103."<br/>";
			}
			if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendpictures' ".$sendpmonfriendpictures."> ".PROFILE_247."<br/>";
				$text .= "<input type='checkbox' name='friendspiccomonly' ".$friendspiccomonly."> ".PROFILE_106."<br/>";
			}
			if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendvideos' ".$sendpmonfriendvideos."> ".PROFILE_248."<br/>";
				$text .= "<input type='checkbox' name='friendsvidcomonly' ".$friendsvidcomonly."> ".PROFILE_116."<br/>";
			}
			$text .= "<input type='checkbox' name='sendpmonfriendfriends' ".$sendpmonfriendfriends."> ".PROFILE_249."<br/>";
			if ($pref['profile_mp3enabled'] == "ON" || $pref['profile_mp3enabled'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendmp3' ".$sendpmonfriendmp3."> ".PROFILE_255."<br/>";
			}
		} else {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='friendsonly' ".$friendsonly."> ".PROFILE_102a."<br/>";
			if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendprofilecomments' ".$sendpmonfriendprofilecomments."> ".PROFILE_254a."<br/>";
				$text .= "<input type='checkbox' name='friendscomonly' ".$friendscomonly."> ".PROFILE_103a."<br/>";
			}
			if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendpictures' ".$sendpmonfriendpictures."> ".PROFILE_247a."<br/>";
				$text .= "<input type='checkbox' name='friendspiccomonly' ".$friendspiccomonly."> ".PROFILE_106a."<br/>";
			}
			if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendvideos' ".$sendpmonfriendvideos."> ".PROFILE_248a."<br/>";
				$text .= "<input type='checkbox' name='friendsvidcomonly' ".$friendsvidcomonly."> ".PROFILE_116a."<br/>";
			}
			if ($pref['profile_mp3enabled'] == "ON" || $pref['profile_mp3enabled'] == "") {
				$text .= "<input type='checkbox' name='sendpmonfriendmp3' ".$sendpmonfriendmp3."> ".PROFILE_255a."<br/>";
			}
		}
		$text .= "</td>";
		// Profil statisztika
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		if ($pref['profile_stats'] == "ON" || $pref['profile_stats'] == "") {
			$text .= "<br/><div class='forumheader3'><img src ='images/stat.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_148."</b></div><br/>";
			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed, user_totalviews FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
			$getdata = $sql->db_Fetch();
			$data = unserialize($getdata['user_lastviewed']);
			$total = count($data);
			$place = 1;
			$text .= "<b>".PROFILE_142."</b><br/>";
			if ($total == 0 || $data == "") {
				$text .= "<i>".PROFILE_143."</i>";
			} else {
				foreach ($data as $d) {
				$spldata = explode("|", $d);
				$userdata = get_user_data($spldata[0]);
				$text .= $place.". ".PROFILE_412.": <a href='".e_BASE."user.php?id.".$userdata['user_id']."'>".$userdata['user_name']."</a> ".PROFILE_413.": ".date("Y/m/d. H:i", $spldata[1])."<br/>";
				$place++;
				}
			}
			if (!$getdata['user_totalviews'] == 0) {
				$text .= "<br/>".PROFILE_144." ".($getdata['user_totalviews'] == 1 ? $getdata['user_totalviews']." ".PROFILE_146." ".PROFILE_147 : $getdata['user_totalviews']."".PROFILE_145." ".PROFILE_147a)."";
			}
		} else {
			$text .= "<i>".PROFILE_148a."</i>";
		}
		$text .= "</td>";
		$text .= "</tr>";
		$text .= "<tr>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		$text .= "<br/><div class='forumheader3'><img src ='images/otherset.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_189."</b></div>";
		if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
			if ($pref['profile_fr_req_sendpm_all'] != 'on') {
				$text .= "<input type='checkbox' name='sendpmonfriend' ".$sendpmonfriend."> ".PROFILE_122."<br/>";
			}
			if ($pref['profile_fr_req_sendemail_all'] != 'on') {
				$text .= "<input type='checkbox' name='sendemailonfriend' ".$sendemailonfriend."> ".PROFILE_122a."<br/>";
			}
			$text .= "<input type='checkbox' name='forumadd' ".$forumadd."> ".PROFILE_111."<br/>";
		}
		$text .= "<input type='checkbox' name='setavatar' unchecked ".$setavatar."> ".PROFILE_110."<br/>";
		$text .= "</td>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		if ($pref['profile_unreg'] == "Yes") {
			$text .= "<br/><div class='forumheader3'><img src ='images/unreg.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_281."</b></div>";
			$text .= "<input type='checkbox' name='unreg' unchecked ".$unreg."> ".PROFILE_282."<br/>";
		} else {
			$text .= "<br/><div class='forumheader3'><img src ='images/blank.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''></div>";
			$text .= "<br/><center><img src ='images/logo.png' style='border: 0px solid black; alt = ''></center>";
			}
		$text .= "<br/><input type='hidden' name='update_settings' value='".$id."'>";
		$text .= "</td>";
		$text .= "</tr>";
		$text .= "<tr>";
		$text .= "<td colspan = 2 class='forumheader3'>";
		if ($pref['profile_buttontype'] == "Yes") {
			$text .= "<input type='image' name='update'  onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_update_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_update.gif\"' src='images/buttons/".e_LANGUAGE."_update.gif' >";
		} else {
			$text .= "<input type='submit' name='update' value='".PROFILE_191."' class='button'>";
		}
		$text .= "</td>";
		$text .= "</tr></form></table>";
	} elseif ($_GET['page'] == "videos") {
		if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
			require_once("editvideos.php");
		}
	} elseif ($_GET['page'] == "mp3") {
		require_once("editmp3.php");
	} elseif ($_GET['page'] == "comments") {
		if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
			$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/comments.png'>&nbsp;".PROFILE_62."</td></tr></table>";
			// MULTIPAGES INFO
			$text .= "</center>";
			// Profil hozzászólások listázása
			$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='prof'");
			$comnumrows = $sql->db_Rows();
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
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='prof' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
			$comm = $sql->db_Rows();
			$maxPage = ceil($comnumrows/$rowsPerPage);
			$self = $_SERVER['PHP_SELF'];
			$nav  = '';
			for($page = 1; $page <= $maxPage; $page++) {
				if ($page == $pageNum) {
					 $nav .= "";
				} else {
					$nav .= " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">$page</a> ";
				}
			}
			if ($pageNum > 1) {
				$page  = $pageNum - 1;
				$prev  = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_204."</a> ";
				$first = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_205."</a> ";
			} else {
				$prev  = '';
				$first = '&nbsp;';
			}
			if ($pageNum < $maxPage) {
				$page = $pageNum + 1;
				$next = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_202."</a> ";
				$last = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_203."</a> ";
			} else {
				$next = ''; // we're on the last page, don't print next link
				$last = '&nbsp;'; // nor the last page link
			}
			// END OF MULTIPAGES
			if ($comm == 0) {
				$text .= "<br/><i>".PROFILE_68."</i>";
			} else {
				$text .= "<br/><form action='formhandler.php' method='post'>";
				$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><i>".PROFILE_62." (".$comnumrows."):</i></td></tr></table>";
				//Profil hozzászólások listája indul
				for ($i = 0; $i < $comm; $i++) {
				$com = $sql->db_Fetch();
				$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
				$from = mysql_fetch_assoc($from);
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
				$date = date("Y m d - H:i", $com['com_date']);
				if ($com['com_date'] >= $userlastvisit) {
					$newcom = "<font color='#FF0000'>".PROFILE_200."</font>";
				} else {
					$newcom = "";
				}
				$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>
					<tr>
						<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
						<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
						<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
					</tr>
					<td class='forumheader'> ".$newcom."<br>&nbsp;<input type='checkbox' name='cbox[]' value='".$com['com_id']."'>&nbsp;".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
					<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
					<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
					<tr><td class='forumheader3' style='vertical-align: top; width='20%;' />";
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
				$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>
				<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td><td class='forumheader' colspan='2'><div align='right' class='smallblacktext'><a href='newuser.php?id=".$com['com_by']."&page=comments'>".PROFILE_137a."".$from['user_name']."".PROFILE_137b."</a>";

				$splitfr = explode("|", $friends['user_friends']);
				if ($pref['profile_friends'] == "ON" && !in_array($com['com_by'], $splitfr)) {
					$text .= " | <a href='newuser.php?id=".$com['com_by']."&add'>".PROFILE_139."</a>";
				}
				$text .= "</div></td></tr></table><br/><br/>";
			}
		}
		// Profil hozzászólások
		$text .= "<table width='100%'><tr><td><input type='hidden' name='uid' value='".$id."'>";
		if (!$comnumrows==0) {
			if ($pref['profile_buttontype'] == "Yes") {
				$text .= "<input type='image' name='comment_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
			} else {
				$text .= "<input type='submit' name='comment_delete' value='".PROFILE_192."' class='button'>";
			}
		}
		$text .= "</form></td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
		}
	} elseif ($_GET['page'] == "images") {
		if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'><img src='images/images.png'>".PROFILE_61."</td></tr></table>";
			// IMAGE GALLERY FUNCTIONS
			define ("MAX_SIZE","100");
			if ($pref['im_width'] != "") {
				define ("WIDTH", $pref['im_width']);
			} else {
				define ("WIDTH","100");
			}
			if ($pref['im_height'] != "") {
				define ("HEIGHT", $pref['im_height']);
			} else {
				define ("HEIGHT","150");
			}
			function getExtension($str) {
				$i = strrpos($str,".");
				if (!$i) { return ""; }
				$l = strlen($str) - $i;
				$ext = substr($str,$i+1,$l);
				return $ext;
			}
			if ($pref['profile_imagick_support'] == "Yes" && extension_loaded('imagick')) {
				define ("IMAGICK", "1");
			}
			// THUMBNAIL GENERATION
			function make_thumb($img_name,$filename,$new_w,$new_h){
				$gd_kepmeret = getimagesize($img_name);
				$gd_kep_res = $gd_kepmeret[0] * $gd_kepmeret[1];
				if ($gd_kepmeret[0] > WIDTH || $gd_kepmeret[1] > HEIGHT) {
				// IMAGICK
					if (IMAGICK == 1) {
						$im_picture = new Imagick($img_name);
						$imfit = (($new_w/$gd_kepmeret[0])<($new_h/$gd_kepmeret[1])) ?true:false;
						if ($im_picture->getNumberImages() > 1) {
							foreach($im_picture as $frame){
								if($imfit){
									$im_frame_w = $frame->getimagewidth()*($new_w/$gd_kepmeret[0]);
									$image_page = $frame->getimagepage();
									$x = $image_page['x']*($new_w/$gd_kepmeret[0]);
									$y = $image_page['y']*($new_w/$gd_kepmeret[0]);
									$frame->thumbnailImage($im_frame_w, 0, false);
									$frame->setimagepage($new_w,$image_page['height']*($new_w/$gd_kepmeret[0]),$x,$y);
								}else{
									$im_frame_h = $frame->getimageheight()*($new_h/$gd_kepmeret[1]);
									$image_page = $frame->getimagepage();
									$x = $image_page['x']*($new_h/$gd_kepmeret[1]);
									$y = $image_page['y']*($new_h/$gd_kepmeret[1]);
									$frame->thumbnailImage(0, $im_frame_h, false);
									$frame->setimagepage($image_page['width']*($new_h/$gd_kepmeret[1]),$new_h,$x,$y);
								}
							}
							$im_picture->writeImages($filename, true);
						}else{
							if($imfit){
								$im_picture->thumbnailImage($new_w, 0, false);
							}else{
								$im_picture->thumbnailImage(0, $new_h, false);
							}
							$im_picture->writeImage($filename);
						}
						imagedestroy($im_picture);
					// GD
					}else {
						$gd_resolution = round(ini_get('memory_limit') / 1.8 / 3 * 1024000);
						if (extension_loaded('gd') && function_exists('gd_info') && $gd_kep_res <= $gd_resolution) {
							$ext=getExtension($img_name);
							if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
								$src_img = imagecreatefromjpeg($img_name);
							if(!strcmp("png",$ext))
								$src_img=imagecreatefrompng($img_name);
							if(!strcmp("gif",$ext))
								$src_img=imagecreatefromgif($img_name);
								$old_x=imageSX($src_img);
								$old_y=imageSY($src_img);
								$ratio1=$old_x/$new_w;
								$ratio2=$old_y/$new_h;
							if($ratio1>$ratio2) {
								$thumb_w=$new_w;
								$thumb_h=$old_y/$ratio1;
							} else {
								$thumb_h=$new_h;
								$thumb_w=$old_x/$ratio2;
							}
							$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
							if(strcmp("png",$ext) || strcmp("gif",$ext)){
								imagealphablending($dst_img, false);
								imagesavealpha($dst_img,true);
								$transparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
								imagefilledrectangle($dst_img, 0, 0, $thumb_w, $thumb_h, $transparent);
								imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
							}
							if($ext = "gif" || $ext = "GIF") {
								if(function_exists('imagegif')) {
									imagegif($dst_img,$filename);
								}
							}
							if($ext = "png" || $ext = "PNG") {
								if(function_exists('imagepng')) {
									imagepng($dst_img,$filename);
								}
							} else {
								if(function_exists('imagejpeg')) {
									imagejpeg($dst_img,$filename);
								}
							}
							imagedestroy($dst_img);
							imagedestroy($src_img);
						}
					}
				} else {
					if (!copy($img_name, $filename)) {
						echo "failed to copy $filename...\n";
					}
				}
			}
			// END OF THUMBNAIL GENERATION
			// GET DIRECTORY SIZE
			function getDirectorySize($path) {
				$totalsize = 0;
				$totalcount = 0;
				$dircount = 0;
				if ($handle = opendir ($path)) {
					while (false !== ($file = readdir($handle))) {
						$nextpath = $path . '/' . $file;
						if ($file != '.' && $file != '..' && !is_link ($nextpath)) {
							if (is_dir ($nextpath)) {
								$dircount++;
								$result = getDirectorySize($nextpath);
								$totalsize += $result['size'];
								$totalcount += $result['count'];
								$dircount += $result['dircount'];
							} elseif (is_file ($nextpath)) {
								$totalsize += filesize ($nextpath);
								$totalcount++;
							}
						}
					}
				}
				closedir ($handle);
				$total['size'] = $totalsize;
				$total['count'] = $totalcount;
				$total['dircount'] = $dircount;
				return $total;
			}
			function sizeFormat($size) {
				$size=round($size/1024,0);
				return $size."";
			}
			// END OF IMAGE GALLERY FUNCTIONS
			if (isset($_GET['album']) && isset($_GET['pic'])) {
				if ($_GET['album'] != "root") {
					$dir = "userimages/".$id."/".$_GET['album']."/";
				} else {
					$dir = "userimages/".$id."/";
				}
				$text .= "<br/><br/><a href='newusersettings.php?page=images".$luid."'><< ".PROFILE_69."</a><br/>";
				if ($_GET['album'] != "root") {
					$text .= "<a href='newusersettings.php?page=".$_GET['page']."".$luid."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_"," ", $_GET['album'])."\"</a><br/><br/>";
				} else {
					$text .= "<br/>";
				}
				if (isset($_GET['setasdp'])) {
					$albumneve = $_GET['album'];
					if ($_GET['album'] == "root") {
						$albumneve = "";
					}
					$k_nev = "userimages/".$id."/".$albumneve."/thumbs/";
					if (is_dir($k_nev)) {
						if ($k_azon = opendir($k_nev)) {
							while (($fajl = readdir($k_azon)) !== false) {
								if ($fajl == $_GET['pic']){ 
									$darab = 1;
								}
        						}
        						closedir($k_azon);
    						}
					}
					if (extension_loaded('gd') && function_exists('gd_info') && $darab !=0) {
						if ($_GET['album'] != "root") {
							$pic = $_GET['album']."/thumbs/".$_GET['pic'];
						} else {
							$pic = "thumbs/".$_GET['pic'];
						}
					} else {
						if ($_GET['album'] != "root") {
							$pic = $_GET['album']."/".$_GET['pic'];
						} else {
							$pic = $_GET['pic'];
						}
					}
					$sql -> db_Update("user", "user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".$id."/".mysql_real_escape_string($pic)."' WHERE user_id='".$id."' ");
					if ($_GET['album'] != "root") {
						header("Location: newusersettings.php?page=images".$luid."&album=".mysql_real_escape_string($_GET['album'])."");
					} else {
						header("Location: newusersettings.php?page=images".$luid."");
					}
				}
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
				// Kép megjelenítése
				$kepmeret = getimagesize("".$dir.$_GET['pic']."");
				$kep_sz = $kepmeret[0]+30;
				$kep_m = $kepmeret[1]+30;
				if ($pref['profile_picviewsize'] == '') {
					$picviewsize = '600';
				} else {
					$picviewsize = $pref['profile_picviewsize'];
				}
				if ($kep_sz<$picviewsize+31) {
					$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($pref['profile_lightview'] == 'Yes' && $pref['cl_widget_ver'] != '') {
					$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightview\" title='".str_replace("_", " ", $picname)."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($pref['profile_lightwindowbox'] == 'Yes' && (file_exists(e_PLUGIN."lightwindow/js/lightwindow.js"))) {
					$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightwindow\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($pref['profile_lightbox'] == 'Yes' && $pref['lightb_enabled'] == '1'){
					$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"lightbox[roadtrip]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";

				} else if ($pref['profile_clearbox'] == 'Yes'){
					echo '
						<script language="JavaScript" src="clearbox/js/clearbox.js" type="text/javascript" charset="iso-8859-2"></script>
						<link rel="stylesheet" href="clearbox/css/clearbox.css" rel="stylesheet" type="text/css"/>
					';
					$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else {
					$text .= "<center><a href='#' title='".PROFILE_167."' onClick=\"window.open('".$dir.$_GET['pic']."','','menubar=no,titlebar=no,resizable=no,scrollbars=yes,width=$kep_sz,height=$kep_m')\"><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				}
				if (isset($_GET['renameerror'])) {
					if ($pref['profile_kepekezet'] == "Yes") {
						$text .= "<br/><br/>".PROFILE_125d;
					} else {
						$text .= "<br/><br/>".PROFILE_125b;
					}
				}
				$text .= "<br/><br/><div id='renameimage' style='display:none'><form enctype='multipart/form-data' method='POST' action='formhandler.php'>
				".PROFILE_131." <input name='newname' class='tbox' type='text' value='".str_replace("_", " ", $picname)."'>
				<input name='origname' type='hidden' value='".$_GET['pic']."'><input type='hidden' name='album' value='".$_GET['album']."'><input name='uid' type='hidden' value='".$id."'><input type='submit' value='".PROFILE_132."' name='renameimage' class='button'>
				</form></div>";
				$text .= "</center>";
				// Kép hozzászólások listázása
				$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."'");
				$picnumrows = $sql->db_Rows();
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
				$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
				$comm = $sql->db_Rows();
				$maxPage = ceil($picnumrows/$rowsPerPage);
				$self = $_SERVER['PHP_SELF'];
				$nav  = '';
				for($page = 1; $page <= $maxPage; $page++) {
					if ($page == $pageNum) {
					 $nav .= "";
					} else {
						$nav .= " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">$page</a> ";
					}
				}
				if ($pageNum > 1) {
					$page  = $pageNum - 1;
					$prev  = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_204."</a> ";
					$first = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_205."</a> ";
				} else {
					$prev  = ''; // we're on page one, don't print previous link
					$first = '&nbsp;'; // nor the first page link
				}
				if ($pageNum < $maxPage) {
					$page = $pageNum + 1;
					$next = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_202."</a> ";
					$last = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_203."</a> ";
				} else {
					$next = ''; // we're on the last page, don't print next link
					$last = '&nbsp;'; // nor the last page link
				}
				// END OF MULTIPAGES
				if ($comm == 0) {
					$text .= "<br/><i>".PROFILE_68."</i>";
				} else {
					$text .= "<br/><form action='formhandler.php' method='post'>";
					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><i>".PROFILE_36a." (".$picnumrows."):</i></td></tr></table>";
					//Kép hozzászólások listája indul
					for ($i = 0; $i < $comm; $i++) {
						$com = $sql->db_Fetch();
						$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
						$from = mysql_fetch_assoc($from);
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
				}				if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
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
				$date = date("Y m d - H:i", $com['com_date']);
				if ($com['com_date'] >= $userlastvisit) {
					$newcom = "<font color='#FF0000'>".PROFILE_200."</font>";
				} else {
					$newcom = "";
				}
				$text .= "<br><table style='".USER_WIDTH."' class='fborder table'>
					<tr>
						<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
						<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
						<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
					</tr>
					<td class='forumheader'> ".$newcom."<br>&nbsp;<input type='checkbox' name='combox[]' value='".$com['com_id']."'><input type='hidden' name='album' value='".$_GET['album']."'>&nbsp;".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
					<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
					<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png'title='".PROFILE_138."'></a></td></tr>
					<tr><td class='forumheader3' style='vertical-align: top; width='20%;' />";
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
				$message = $tp -> toHTML($com['com_message'], true,  'parse_sc, constants');
				$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>
				<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td><td class='forumheader' colspan='2'><div align='right' class='smallblacktext'><a href='newuser.php?id=".$com['com_by']."&page=comments'>".PROFILE_137a."".$from['user_name']."".PROFILE_137b."</a>";
				if ($pref['profile_friends'] == "ON") {
					$text .= " | <a href='newuser.php?id=".$com['com_by']."&add'>".PROFILE_139."</a>";
				}
				$text .= "</div></td></tr>";
				$text .= "</table><br/><br/>";
			}
			// Hozzászólások listázásának vége
			$text .= "<table width='100%'><tr><td><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='image' value='".$_GET['pic']."'>";
			if ($pref['profile_buttontype'] == "Yes") {
				$text .= "<input type='image' name='comment_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
			} else {
				$text .= "<input type='submit' name='comment_delete' value='".PROFILE_192."' class='button'>";
			}
				$text .= "</form></td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
				}
			} elseif (isset($_GET['album']) && !isset($_GET['pic'])) {
				if ($pref['profile_piccol']) {
					$profile_piccol = $pref['profile_piccol'];
				} else {
					$profile_piccol = 3;
				}
				$profile_piccol_p = intval(100/$profile_piccol);
				$text .= "<br/><br/><a href='newusersettings.php?page=".$_GET['page']."".$luid."'><< ".PROFILE_69."</a> | <a href=\"javascript:doMenu('renamealbum');\" id='xrenamealbum'>".PROFILE_129."</a> | <a href=\"javascript:doMenu('upload');\" id='xupload'>".PROFILE_130."</a>";
				$text .= "<br/><br/>";
				$path = "userimages/".$id."/";
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($pref['profile_maxuploadsize'] == '') {
					$upsize = '1024';
				} else {
					$upsize = $pref['profile_maxuploadsize'];
				}
				if ($totalsize >= ($upsize - 200) ) {
					$text .= "".PROFILE_243."<span style='color:red'>$totalsize ".PROFILE_244."</span>";
				} else {
					$text .= "".PROFILE_243." $totalsize ".PROFILE_244."";
				}
				$root_path = "userimages/".$id."/";
				$target_path = "userimages/".$id."/".$_GET['album']."/";
				$path = $root_path;
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($pref['profile_maxpicnumber'] == '') {
					$maxpicnumber = '10';
				} else {
					$maxpicnumber = $pref['profile_maxpicnumber'];
				}
				$path = "userimages/".$id."/".$_GET['album']."/";
				$album_kepekszama = count(glob($path . '*.*'));
				if ($totalsize > $upsize) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_70."$kvota".PROFILE_70a."</div>";
				} else if ($album_kepekszama > $maxpicnumber) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_245."$maxpicnumber".PROFILE_246."</div>";
				} else {
					$text .= "<div id='upload' style='display:none'><br/><form enctype='multipart/form-data' method='POST'>
					".PROFILE_126." <input name='file_userfile[]' class='tbox' type='file'>
					<input type='submit' value='".PROFILE_71."' name='submitupload' class='button'>
					</form></div>";
				}
				$text .= "<div id='renamealbum' style='display:none'><br/><form enctype='multipart/form-data' method='POST' action='formhandler.php'>
				".PROFILE_131." <input name='newname' class='tbox' type='text' value='".str_replace("_", " ", $_GET['album'])."'>
				<input name='origname' type='hidden' value='".$_GET['album']."'><input name='uid' type='hidden' value='".$id."'><input type='submit' value='".PROFILE_132."' name='renamealbum' class='button'>
				</form></div>";
				$text .= "<br/><hr>";
				if (isset($_GET['renameerror'])) {
					if ($pref['profile_kepekezet'] == "Yes") {
						$text .= "<br/>".PROFILE_125c."<br/>";
					} else {
						$text .= "<br/>".PROFILE_125a."<br/>";
					}
				}
				if (isset($_POST['submitupload'])) {
					require_once(e_HANDLER."upload_handler.php");
					$uploaded = file_upload("userimages/".$id."/".$_GET['album']."/", "unique");
					$file = $uploaded[0]['name'];
					$filetype = $uploaded[0]['type'];
					$filesize = $uploaded[0]['size'];
					$newname="userimages/".$id."/".$_GET['album']."/".$file;
					$thumb_name = "userimages/".$id."/".$_GET['album']."/thumbs/".$file;
					$thumb = make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
					if ((($filetype == "image/gif") || ($filetype == "image/jpeg") || ($filetype == "image/png") || ($filetype == "image/pjpeg") || ($filetype == "image/x-png") || ($filetype == ""))  && (($filesize * 0.0009765625) < $maxkepmeret_kb) && $file != "" && $pref['upload_enabled']) {
						new_user_row($id);
						$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
						$sql -> db_Update("another_profiles", "user_custompage='upload_album_image' WHERE user_id='".$id."' ");
						header("Location: newusersettings.php?page=images".$luid."&album=".$_GET['album']."&uploaded=".$file."");
					} else {
					unlink("userimages/".$id."/".$_GET['album']."/".$file."");
					unlink("userimages/".$id."/".$_GET['album']."/thumbs/".$file."");
					header("Location: newusersettings.php?page=images".$luid."&album=".$_GET['album']."&failed=true");
					}
				}
				if (isset($_GET['failed'])) {
					$text .= "<br/>".PROFILE_136." ".$maxkepmeret_kb." kB.";
				}
				$text .= "<br/>";
				if (isset($_GET['uploaded'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_75." ".$_GET['uploaded']." ".PROFILE_76.".<br/><br/>";
				}
				if (isset($_GET['del'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_77.".<br/><br/>";
				}

				// GALLERY
				$dir = "userimages/".$id."/".$_GET['album']."/";
				$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader'><i>".$_GET['album']."".PROFILE_275."</i></td></tr></table>";

				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'>";
				$column = 1;
				$dirHandle = opendir($dir);
				while ($file = readdir($dirHandle)) {
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
						$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' AND com_date > '".$userlastvisit."' ");
						$piccomm = $sql->db_Rows();
						if ($piccomm > 0) {
							$newpiccom = "<br/><font color='#FF0000'> ".$piccomm." ".($piccomm == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
						} else {
							$newpiccom = "";
							$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
							$piccomm_all = $sql->db_Rows();
							if ($piccomm_all > 0) {
								$newpiccom = "<br/>".$piccomm_all." ".($piccomm_all == 1 ? PROFILE_315 : PROFILE_315)."";
							} else {
								$newpiccom = "";
							}
						}
						if ($column==1) { $text .="<tr>"; }
						//Album pictures
						if (file_exists($dir."thumbs/".$file)) {
							$text .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='album' value='".$_GET['album']."'><input type='checkbox' name='chbox[]' value='".$_GET['album']."/".$file."'>".str_replace("_", " ", $newname).$newpiccom."<br/><a href='newusersettings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
						} else {
							$text .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir.$file."' width='100' ></a><br/><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='album' value='".$_GET['album']."'><input type='checkbox' name='chbox[]' value='".$_GET['album']."/".$file."'>".str_replace("_", " ", $newname).$newpiccom."<br/><a href='newusersettings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
						}
						$column++;
						if ($column == $profile_piccol+1) {
							$text .= "</tr><tr><td><br/></td></tr>";
							$column = 1;
						}
					}
				}
				closedir($dirHandle);

				$text .= "</table><br/><br/><input type='hidden' name='delimages'>";
				if ($pref['profile_buttontype'] == "Yes") {
					$text .= "<input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' >";
				} else {
					$text .= "<input type='submit' name='submit_delete' value='".PROFILE_193."' class='button'>";
				}
				$text .= "</form>";
			} else {
				if ($pref['profile_piccol']) {
					$profile_piccol = $pref['profile_piccol'];
				} else {
					$profile_piccol = 3;
				}
				$profile_piccol_p = intval(100/$profile_piccol);
				$dir = "userimages/".$id."";
				if (is_dir('$dir')) {
					$ans = "yes";
					chmod($dir, 0755);
				} else {
					mkdir($dir, 0755);
					mkdir($dir."/thumbs", 0755);
					chmod($dir, 0755);
					chmod($dir."/thumbs", 0755);
					fopen($dir."/index.htm",'a');
					fopen($dir."/thumbs/index.htm",'a');
				}
				$dir = "userimages/".$id."/";
				$text .= "<br/><a href=\"javascript:doMenu('album');\" id='xalbum'>".PROFILE_194."</a> | <a href=\"javascript:doMenu('upload');\" id='xupload'>".PROFILE_195."</a>";
				if ($pref['profile_maxalbumnumber'] == '') {
					$maxalbumnumber = '6';
				} else {
					$maxalbumnumber = $pref['profile_maxalbumnumber'];
				}
				$dir_path="userimages/".$id."/";
				$dir_kezelo=@opendir($dir_path)or die("Unable to open $dir_path");
				$dir_counter = 0;
				while($dir_num = readdir($dir_kezelo)) {
					if($dir_num == "." || $dir_num == ".." || $dir_num == "thumbs" )
					continue;
					if(is_dir($dir_path."/".$dir_num)) {
						$dir_counter = $dir_counter + 1;
					}
				}
				$path = "userimages/".$id."/";
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($pref['profile_maxuploadsize'] == '') {
					$upsize = '1024';
				} else {
					$upsize = $pref['profile_maxuploadsize'];
				}
				$text .= "<br/><br/>";
				if ($dir_counter >= ($maxalbumnumber - 1) ) {
					$text .= "".PROFILE_242."<span style='color:red'>$dir_counter ".PROFILE_236.". </span>";
				} else {
					$text .= "".PROFILE_242." $dir_counter ".PROFILE_236.". ";
				}
				if ($totalsize >= ($upsize - 200) ) {
					$text .= "".PROFILE_243."<span style='color:red'>$totalsize ".PROFILE_244."</span>";
				} else {
					$text .= "".PROFILE_243." $totalsize ".PROFILE_244."";
				}
				if ($dir_counter > ($maxalbumnumber - 1) ) {
					$text .= "<div id='album' style='display:none'><br/>".PROFILE_241."(".$dir_counter."".PROFILE_236.").</div>";
				} else {
					$text .= "<div id='album' style='display: none'><br/><form method='POST' action='formhandler.php'>".PROFILE_124." <input type='hidden' name='id' value='".$id."'><input type='text' name='newalbum'> <input type='submit' class='button' value='".PROFILE_196."'></form></div>";
				}
				if ($pref['profile_maxpicnumber'] == '') {
					$maxpicnumber = '10';
				} else {
					$maxpicnumber = $pref['profile_maxpicnumber'];
				}
				$path = "userimages/".$id."/";
				$album_kepekszama = count(glob($path . '*.*'));
				if ($totalsize > $upsize) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_70."$kvota".PROFILE_70a."</div>";
				} else if ($album_kepekszama > $maxpicnumber) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_245."$maxpicnumber".PROFILE_246."</div>";
				} else {
					$text .= "<div id='upload' style='display: none'><br/><form enctype='multipart/form-data' method='POST' >
					".PROFILE_126." <input name='file_userfile[]' type='file'>
					<input type='submit' value='".PROFILE_71."' name='submitupload' class='button'>
					</form></div>";
				}
				$text .= "<br/><hr>";
				if (isset($_POST['submitupload'])) {
					require_once(e_HANDLER."upload_handler.php");
					$uploaded = file_upload("userimages/".$id."/", "unique");
					$file = $uploaded[0]['name'];
					$filetype = $uploaded[0]['type'];
					$filesize = $uploaded[0]['size'];
					$newname="userimages/".$id."/".$file;
					$thumb_name = "userimages/".$id."/thumbs/".$file;
					$thumb = make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
					echo $uploaded[0]['extension'];
					if ((($filetype == "image/gif") || ($filetype == "image/jpeg") || ($filetype == "image/png") || ($filetype == "image/pjpeg") || ($filetype == "image/x-png") || ($filetype == ""))  && (($filesize * 0.0009765625) < $maxkepmeret_kb) && $file != "" && $pref['upload_enabled']) {
						new_user_row($id);
						$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
						$sql -> db_Update("another_profiles", "user_custompage='upload_image' WHERE user_id='".$id."' ");
						header("Location: newusersettings.php?page=images".$luid."&uploaded=".$file."");
					} else {
						unlink("userimages/".$id."/".$file."");
						unlink("userimages/".$id."/thumbs/".$file."");
						header("Location: newusersettings.php?page=images".$luid."&failed=true");
					}
				}
				if (isset($_GET['failed'])) {
					$text .= "".PROFILE_136." ".$maxkepmeret_kb." kB.";
				}
				$text .= "<br/>";
				if (isset($_GET['uploaded'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_75." ".$_GET['uploaded']." ".PROFILE_76."<br/><br/>";
				}
				if (isset($_GET['del'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_77.".<br/><br/>";
				}
				if (isset($_GET['error'])) {
					if ($pref['profile_kepekezet'] == "Yes") {
						$text .= "".PROFILE_125c."<br/><br/>";
					} else {
						$text .= "".PROFILE_125a."<br/><br/>";
					}
				}
				if ($totalsize > 0 || $dir_counter > 0){
					$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader'><i>".PROFILE_274."</i></td></tr></table>";
					$text .= "<br/><br/><form method='post' action='formhandler.php'><table width='100%'><tr>";
					if ($handle = opendir($dir)) {
						$col = 0;
						$piccol = 0;
						while (false !== ($file = readdir($handle))) {
							if ($file != "." && $file != ".." && $file != "Thumbs.db"  && $file != "thumbs"  && substr(strrchr($file, '.'), 1) != "txt"  && substr(strrchr($file, '.'), 1) != "htm" ) {
								if (substr(strrchr($file, '.'), 1) != "") {
									$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' AND com_date > '".$userlastvisit."' ");
									$piccomm = $sql->db_Rows();
									if ($piccomm > 0) {
										$newpiccom = "<br/><font color='#FF0000'> ".$piccomm." ".($piccomm == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
									} else {
										$newpiccom = "";
										$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$piccomm_all = $sql->db_Rows();
										if ($piccomm_all > 0) {
											$newpiccom = "<br/>".$piccomm_all." ".($piccomm_all == 1 ? PROFILE_315 : PROFILE_315)."";
										} else {
											$newpiccom = "";
										}
									}
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
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images".$luid."&album=root&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delrootpic[]' value='".$file."'> ".str_replace("_", " ", $newname).$newpiccom."<br/><a href='newusersettings.php?page=images".$luid."&album=root&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
									} else {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images".$luid."&album=root&pic=".$file."'><img src='".$dir.$file."' width='100' ></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delrootpic[]' value='".$file."'> ".str_replace("_", " ", $newname).$newpiccom."<br/><a href='newusersettings.php?page=images".$luid."&album=root&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
									}
									$piccol++;
									if ($piccol == $profile_piccol) {
										$pic .= "</tr><tr><td><br/></td></tr><tr>";
										$piccol = 0;
									}
								} else {

									if (isset($_GET['setasonlyfriends']) && $pref['profile_private_albums'] == "Yes") {
										$albumneve = $_GET['priv_album'];
										$only_friends_file = "userimages/".$id."/".$albumneve."/only_friends";
										if(!file_exists($only_friends_file)) {
											$fh = fopen($only_friends_file,'a') or die("can't open file: ".$only_friends_file);
											$only_friends_file_data = "Please don't remove this file";
											fwrite($fh, $only_friends_file_data);
											fclose($fh);
										}
									}
									if (isset($_GET['setasnofriends'])) {
										$albumneve = $_GET['priv_album'];
										$only_friends_file = "userimages/".$id."/".$albumneve."/only_friends";
										if (file_exists($only_friends_file)) {
											unlink($only_friends_file);
										}
									}
									$count = 0;
									$firstimage="";
									$newcomcount = 0;
									if ($subhandle = opendir($dir.$file)) {
										$aof = 0;
										while (false !== ($subfile = readdir($subhandle))) {
										if ($subfile=="only_friends") $aof = 1;
											if ($subfile != "only_friends" && $subfile != "." && $subfile != ".." && $subfile != "Thumbs.db" && $subfile != "thumbs"  && $subfile != "index.htm" ) {
												if ($firstimage == "") {
													$firstimage = $subfile;
												}
												$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($file)."/".mysql_real_escape_string($subfile)."' AND com_date > '".$userlastvisit."' ");
												$piccomm = $sql->db_Rows();
												if ($piccomm > 0) {
													$newcomcount = $newcomcount + $piccomm;
												} else {
													$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($file)."/".mysql_real_escape_string($subfile)."' ");
													$piccomm_all = $sql->db_Rows();
													if ($piccomm_all > 0) {
													$newcomcount_all = $newcomcount_all + $piccomm_all;
													}
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
									if ($newcomcount > 0) {
										$newpiccom = "<br/><font color='#FF0000'> ".$newcomcount." ".($newcomcount == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
									} else {
										$newpiccom = "";
										if ($newcomcount_all > 0) {
											$newpiccom = "".$newcomcount_all." ".($newcomcount_all == 1 ? PROFILE_315 : PROFILE_315)."";
										} else {
											$newpiccom = "";
										}
									}
									if (($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") && $pref['profile_private_albums'] == "Yes") {
										$priv_alb = PROFILE_419;
									} else if ($pref['profile_private_albums'] == "Yes") {
										$priv_alb = PROFILE_421;
									}
									if ($count == 0) {
										//Empty albums:
										$text .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images&album=".$file.$luid."'><img src='images/folder.png' width='64' height='64' style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:1px'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delal[]' value='".$file."'> <b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
										".($aof == 1 ? "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
									} else {
										//Albums:
										if ($count > 0) {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images&album=".$file.$luid."'><img ".$imageurl." style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:2px'></a><br/><input type='hidden' name='uid' value='".$id."'><b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
											".($aof == 1 ? "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
										} else {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='newusersettings.php?page=images&album=".$file.$luid."'><img ".$imageurl." style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:3px'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delal[]' value='".$file."'> <b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
											".($aof == 1 ? "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='newusersettings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
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
						closedir($handle);
					}
					$text .= "</tr><tr>".$pic."</tr></table><br/><br/><input type='hidden' name='delalbum'>";
					$text .= "<hr>";
					if ($pref['profile_buttontype'] == "Yes") {
						$text .= "<input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
					} else {
						$text .= "<input type='submit' name='submit_delete' value='".PROFILE_197."' class='button'>";
					}
					$text .= "</form>";
				}
			}
		}
	}
		// MINDENNEK VÉGE
} else {
	if ($pref['profile_custdisplay'] == 'Advanced Version') {
	} elseif ($pref['profile_custdisplay'] == 'Both Versions') {
	}
}

$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
if (isset($_GET['mp3done'])) {
	$ns->tablerender("",PROFILE_156);
} elseif (isset($_GET['mp3failed'])) {
	$ns->tablerender("",PROFILE_157);
}

if (isset($_GET['first'])) {
	$ns->tablerender(PROFILE_127.SITENAME.PROFILE_201,PROFILE_128);
	$sql -> db_Select("another_profiles", "*", "user_id='".USERID."'");
	$count = $sql -> db_Rows();
	if ($count == 0) {
		$sql -> db_Insert("another_profiles", "'".USERID."', '', '', '', '', '', '', '', '', '', ''");
	}
}

if (isset($_GET['uid'])) {
	$title = ADMIN_PROFILE_15;
} else {
	$title = "";
}

function new_user_row($member_id) {
	global $sql;
	$sql -> db_Select("another_profiles", "*", "user_id='".$member_id."'");
	$count = $sql -> db_Rows();
	if ($count == 0) {
	return	$sql -> db_Insert("another_profiles", "'".$member_id."', '', '', '', '', '', '', '', '', '', ''");
	}
}

$ns->tablerender($title,$display);
require_once(FOOTERF);
?>