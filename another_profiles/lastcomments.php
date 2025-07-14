<?php

if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
//require_once(e_FILE."shortcode/batch/user_shortcodes.php");
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

if (!check_class($pref['profile_comments_spy']) && (($_GET['page'] == "all_comments") || ($_GET['page'] == "all_pic_comments") || ($_GET['page'] == "all_vid_comments"))) 
{
	$ns->tablerender($alert_icon,PROFILE_186a);
	require_once(FOOTERF);
	exit;
}

if (($_GET['page'] == "all_comments") || ($_GET['page'] == "all_pic_comments") || ($_GET['page'] == "all_vid_comments")) {
	$allcomments = "on";
}
if ($pref['profile_comments_spy_num'] == "" ) {
	$profile_comments_spy_num = 100;
} else {
	$profile_comments_spy_num = $pref['profile_comments_spy_num'];
}
if (($_GET['page'] == "comments") || ($_GET['page'] == "pic_comments") || ($_GET['page'] == "vid_comments")) {
	$profile_comments_spy_num = 1000;
}
if ($_GET['page'] == "comments" || $_GET['page'] == "all_comments") {
	$comment_type = "prof";
} else if ($_GET['page'] == "pic_comments" || $_GET['page'] == "all_pic_comments") {
	$comment_type = "pics";
} else if ($_GET['page'] == "vid_comments" || $_GET['page'] == "all_vid_comments") {
	$comment_type = "vids";
}
if ($pref['profile_comments_spy_pic_size']) {
$pic_td_width = $pref['profile_comments_spy_pic_size'] + 5;
} else {
$pic_td_width = 150;
}
$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr>";
if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
	if ($allcomments == "on") {
		$text .= "<td class='forumheader'><img src='images/comments.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_comments'>".PROFILE_328."</a>";
	} else {
		$text .= "<td class='forumheader'><img src='images/comments.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=comments'>".PROFILE_328."</a>";
	}
	if ($comment_type == "prof") {
		$text .= "&nbsp;&nbsp;&nbsp;<img src='images/green.png'>";
	} else { $text .= "&nbsp;&nbsp;&nbsp;<img src='images/gray.png'>";
	}
	$text .= "</td>";
}
	if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
	if ($allcomments == "on") {
		$text .= "<td class='forumheader'><img src='images/pict.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_pic_comments'>".PROFILE_329."</a>";
	} else {
		$text .= "<td class='forumheader'><img src='images/pict.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=pic_comments'>".PROFILE_329."</a>";
	}
	if ($comment_type == "pics") {
		$text .= "&nbsp;&nbsp;&nbsp;<img src='images/green.png'>";
	} else { $text .= "&nbsp;&nbsp;&nbsp;<img src='images/gray.png'>";
	}
	$text .= "</td>";
}
	if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
	if ($allcomments == "on") {
		$text .= "<td class='forumheader'><img src='images/vid.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_vid_comments'>".PROFILE_330."</a>";
	} else {
		$text .= "<td class='forumheader'><img src='images/vid.png'>&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=vid_comments'>".PROFILE_330."</a>";
	}
	if ($comment_type == "vids") {
		$text .= "&nbsp;&nbsp;&nbsp;<img src='images/green.png'>";
	} else { $text .= "&nbsp;&nbsp;&nbsp;<img src='images/gray.png'>";
	}
	$text .= "</td>";
}
$text .= "</tr></table>";
$sql -> db_Select("user", "*", "user_id=".USERID."");
$user = $sql -> db_Fetch();
$userlastvisit = $user['user_lastvisit'];
if ($allcomments != "on") {
	$com_by = "com_by='".USERID."' AND ";
} else {
	$com_by = "";
}
if (($pref['profile_commentson'] == "ON" && $comment_type == "prof") || ($pref['profile_pics'] == "ON" && $comment_type == "pics") || ($pref['profile_videos'] == "ON" && $comment_type == "vids")) {
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE ".$com_by." com_type='".$comment_type."' ");
	$comnumrows_all = $sql->db_Rows();
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE ".$com_by." com_type='".$comment_type."' LIMIT $profile_comments_spy_num ");
	$comnumrows = $sql->db_Rows();
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
	$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by, com_to, com_extra FROM ".MPREFIX."another_profiles_com WHERE ".$com_by." com_type='".$comment_type."' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
	$comm = $sql->db_Rows();
	$maxPage = ceil($comnumrows/$rowsPerPage);
	$self = $_SERVER['PHP_SELF'];
	$nav  = '';
	if ($comment_type == "prof") {
		$felirat1 = PROFILE_328;
		$pagelink = "comments";
	} else if ($comment_type == "pics") {
		$felirat1 = PROFILE_329;
		$pagelink = "pic_comments";
	} else if ($comment_type == "vids") {
		$felirat1 = PROFILE_330;
		$pagelink = "vid_comments";
	}
	for($page = 1; $page <= $maxPage; $page++) {
		if ($page == $pageNum) {
			 $nav .= "";
		} else {
			if ($allcomments == "on") {
				$nav .= " <a href=\"$self?page=all_".$pagelink."&pgnum=".$page."\">$page</a> ";
			} else {
				$nav .= " <a href=\"$self?page=comments&pgnum=".$page."\">$page</a> ";
			}
		}
	}
	if ($pageNum > 1) {
		$page  = $pageNum - 1;
		if ($allcomments == "on") {
			$prev  = " <a href=\"$self?page=all_".$pagelink."&pgnum=".$page."\">".PROFILE_204."</a> ";
			$first = " <a href=\"$self?page=all_".$pagelink."&pgnum=".$page."\">".PROFILE_205."</a> ";
		} else {
			$prev  = " <a href=\"$self?page=".$pagelink."&pgnum=".$page."\">".PROFILE_204."</a> ";
			$first = " <a href=\"$self?page=".$pagelink."&pgnum=".$page."\">".PROFILE_205."</a> ";
		}
	} else {
		$prev  = '';
		$first = '&nbsp;';
	}
	if ($pageNum < $maxPage) {
		$page = $pageNum + 1;
		if ($allcomments == "on") {
			$next = " <a href=\"$self?page=all_".$pagelink."&pgnum=".$page."\">".PROFILE_202."</a> ";
			$last = " <a href=\"$self?page=all_".$pagelink."&pgnum=".$page."\">".PROFILE_203."</a> ";
		} else {
			$next = " <a href=\"$self?page=".$pagelink."&pgnum=".$page."\">".PROFILE_202."</a> ";
			$last = " <a href=\"$self?page=".$pagelink."&pgnum=".$page."\">".PROFILE_203."</a> ";
		}
	} else {
		$next = '';
		$last = '&nbsp;';
	}
	if ($comm == 0) {
		if ($allcomments == "on") {
			$text .= "<br/><i>".PROFILE_68."</i>";
		} else {
			$text .= "<br/><i>".PROFILE_338."</i>";
		}
	} else {
		$text .= "<br/>";
		if ($comment_type == "prof") {
			$felirat1 = PROFILE_328;
		} else if ($comment_type == "pics") {
			$felirat1 = PROFILE_329;
		} else if ($comment_type == "vids") {
			$felirat1 = PROFILE_330;
		}

		$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table' colspan='4'><i>".$felirat1." (".$comnumrows_all."):</i></td></tr></table>";
		for ($i = 0; $i < $comm; $i++) {
			$com = $sql->db_Fetch();
			$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
			$from = mysql_fetch_assoc($from);
			$to_from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_to']." ");
			$to_from = mysql_fetch_assoc($to_from);
			$comid = $com['com_id'];
			$user_name = $from['user_name'];
			$on_name = "".$com['com_by'].".".$user_name."";
			$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
			$checkonline = mysql_num_rows($checkonline);
			$no_user_friend_comm = "";
			$no_user_friend_vids = "";
			$no_user_friend_pics = "";
			if (!ADMIN && USERID != $to_from['user_id']) {
				$friend_db = new db();
				$friend_db->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".$to_from['user_id']."' ");
				$settings = $friend_db->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
			}
			if ($comment_type == "prof") {
				if ((!USER && $break[9] == 1) || ($break[9] == 1 && USERID != $to_from['user_id'])) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$no_user_friend_comm = 1;
					} else if ($pref['profile_friends'] != "ON") {
						$no_user_friend_comm = 2;
					}
				}
			}
			if ($comment_type == "vids") {
				if ((!USER && $break[7] == 1) || ($break[7] == 1 && USERID != $to_from['user_id'])) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$no_user_friend_vids = 1;
					} else if ($pref['profile_friends'] != "ON") {
						$no_user_friend_vids = 2;
					}
				}
				$video_query = mysql_query("SELECT * FROM ".MPREFIX."another_profiles_vids WHERE vid_id=".$com['com_extra']." ");
				$video_query = mysql_fetch_assoc($video_query);
				$video_neve = $video_query['vid_name'];
				$vidpic = str_replace("<", "", $video_query['vid_embed']);
				$break_vid = explode("/", $vidpic);
				$break2_vid = explode("&", $break_vid[4]);
				$embed_db = explode(" ", $video_query['vid_embed']);
				$video = $embed_db[1];
				$share_site = $embed_db[0];
				if ($break_vid[2] == "www.youtube.com") {
					$video_kep = "http://img.youtube.com/vi/".$break2_vid[0]."/default.jpg";
				} elseif($share_site != "") {
					require_once("videohandler.php");
					$video_kep = pic_url($share_site,$video);
				} else {
					$video_kep = "images/nopreview.png";
				}
			}
			if ($comment_type == "pics") {
				if ((!USER && $break[8] == 1) || ($break[8] == 1 && USERID != $to_from['user_id'])) {
					//----------- Only friends
					if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
						$no_user_friend_pics = 1;
					} else if ($pref['profile_friends'] != "ON") {
						$no_user_friend_pics = 2;
					}
				}
//ATW error correction:
				$dir_neve = explode("/", $com['com_extra']);
				$kep_minusz = array("/", ".jpg", ".JPG", ".png", ".PNG", ".gif", ".GIF", ".svg", ".SVG", "_");
				$kep_even_dir = str_replace($dir_neve[0], "", $com['com_extra']);
				$kep_even_dir = str_replace("/", "", $kep_even_dir);
				$kep_neve = str_replace($kep_minusz, " ", $kep_even_dir);
			}
			if ((!USER && $break[0] == 1) || ($break[0] == 1 && USERID != $to_from['user_id'])) {
				//----------- Only friends
				if (((!in_array(USERID, $friendb)) && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) || !USER) {
					$no_user_friend_comm = 1;
					$no_user_friend_vids = 1;
					$no_user_friend_pics = 1;
				} else if ($pref['profile_friends'] != "ON") {
					$no_user_friend_comm = 2;
					$no_user_friend_vids = 2;
					$no_user_friend_pics = 2;
				}
			}
			$no_user_friend_album = "0";
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
					<td style='text-align:left' class='fcaption'>".PROFILE_327."";
					if ($comment_type == "prof") {
						$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=comments'>".$to_from['user_name']."</a></td>";
					} else if ($comment_type == "pics") {
						$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=images'>".$to_from['user_name']."</a></td>";
						$cucc = PROFILE_332;
					} else if ($comment_type == "vids") {
						$text .= "<a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=videos'>".$to_from['user_name']."</a>";
						$cucc = PROFILE_333;
					}
					$text .= "<td style='width:".$pic_td_width."px; text-align:right' class='fcaption'>id: #".$comid."</td>
				</tr>
				<td class='forumheader'> ".$newcom."<br>".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
				<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
				<td class='forumheader' style='vertical-align: middle;' />".$cucc."</td></tr>
				<tr><td class='forumheader3' style='vertical-align: top; width='20%;' />";

			if ($pref['profile_avatarwidth'] == '') {
				$avwidth = $pref['im_width'];
			} else {
				$avwidth = "width='".$pref['profile_avatarwidth']."' ";
			}
			if ($pref['profile_avatarheight'] == '') {
				$avheight = $pref['im_height'];
			} else {
				$avheight = "height='".$pref['profile_avatarheight']."' ";
			}

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
			$aof = 0;
			$no_user_friend_album == "";
			if (file_exists("userimages/".$to_from['user_id']."/".$dir_neve[0]."/only_friends")) $aof = 1;
			if (ADMIN && getperms("4")) $aof = 0;
			if ($no_user_friend_comm == "1" || $no_user_friend_pics == "1" ||$no_user_friend_vids == "1") {
				$message = "".PROFILE_345."".$to_from['user_name']."".PROFILE_346."";
			} else if ($no_user_friend_comm == "2" || $no_user_friend_pics == "2" ||$no_user_friend_vids == "2") {
				$message = "".PROFILE_347."".$to_from['user_name']."".PROFILE_348."";
			} else if ((!in_array(USERID, $friendb) && $aof == 1 && USERID != $to_from['user_id']) || ($pref['profile_friends'] == "OFF" && $aof == 1 && USERID != $to_from['user_id']) || ($aof == 1 && !USER)) {
				$no_user_friend_album = "1";
				if($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
					$message = "".PROFILE_345."".$to_from['user_name']."".PROFILE_346."";
				} else {
					$message = "".PROFILE_347a."".$to_from['user_name']."".PROFILE_348a."";
				}
			} else {
				$message = $tp -> toHTML($com['com_message'], true, 'parse_sc, constants');
			}
			if ($comment_type == "prof") {
				$colspan = "colspan='2'";
			} else {
				$colspan = "";
			}
			$text .= "<td class='forumheader3' ".$colspan." style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>";
			if ($no_user_friend_comm == "1") {
				$text .= "</td>";
			} else if ($no_user_friend_comm == "2") {
				$text .= "</td>";
			} else if ($no_user_friend_album == "1") {
				$text .= "</td>";
			} else {
				$text .= "$from_signature</td>";
			}
			if ($comment_type == "pics") {
				$link_dir_neve = $dir_neve[0];
				if($dir_neve[0] == "root") $dir_neve[0]= "";
				$pic_width = $pref['profile_comments_spy_pic_size'];
				if ($pic_width == "") $pic_width = 145;
				$kepmeret = getimagesize(e_PLUGIN."another_profiles/userimages/".$to_from['user_id']."/".$dir_neve[0]."/".$kep_even_dir);
				if ($kepmeret[0] > $pic_width) {
					$pic_width = "width = '".$pic_width."'";
				}
				if ($no_user_friend_pics == "1" || $no_user_friend_album == "1") {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=images'><img src='".e_PLUGIN."another_profiles/images/kview.png' border='1' ".$pic_width." title='".$to_from['user_name']."".PROFILE_349."' alt='' /></a><br/>".$to_from['user_name']."".PROFILE_349."</td></td>";
				} else if ($no_user_friend_pics == "2") {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=images'><img src='".e_PLUGIN."another_profiles/images/kview.png' border='1' ".$pic_width." title='".$to_from['user_name']."".PROFILE_349."' alt='' /></a><br/>".$to_from['user_name']."".PROFILE_349."</td></td>";
				} else {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=images&album=".$link_dir_neve."&pic=".$kep_even_dir."'><img src='".e_PLUGIN."another_profiles/userimages/".$to_from['user_id']."/".$dir_neve[0]."/".$kep_even_dir."' border='1' ".$pic_width." title='".$kep_neve."' alt='' /></a><br/>".$kep_neve."</td></tr>";
				}
				}
			if ($comment_type == "vids") {
				$pic_width = $pref['profile_comments_spy_pic_size'];
				if ($pic_width == "") $pic_width = 145;
				$pic_height = $pic_width * 0.7;
				if ($no_user_friend_vids == "1") {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=videos'><img src='".e_PLUGIN."another_profiles/images/movie_pr.png' border='1' width='".$pic_width."' title='".$to_from['user_name']."".PROFILE_349."' alt='' /></a><br/>".$to_from['user_name']."".PROFILE_349."</td>";
				} else if ($no_user_friend_vids == "2") {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=videos'><img src='".e_PLUGIN."another_profiles/images/movie_pr.png' border='1' width='".$pic_width."' title='".$to_from['user_name']."".PROFILE_349."' alt='' /></a><br/>".$to_from['user_name']."".PROFILE_349."</td>";
				} else {
					$text .= "<td class='forumheader3' style='text-align: center;'><a href='".e_PLUGIN."another_profiles/newuser.php?id=".$to_from['user_id']."&page=videos&vid=".$com['com_extra']."'><img src=".$video_kep." width='".$pic_width."' height='".$pic_height."' alt='' title='".$video_neve."' /></a><br/>".$video_neve."</td></tr>";
				}
			}
			$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td><td class='forumheader' colspan='2'>";
			if ($allcomments == "on") {
				$text .= "<div align='right' class='smallblacktext'><a href='newuser.php?id=".$com['com_by']."&page=comments'>".PROFILE_137a."".$from['user_name']."".PROFILE_137b."</a>";
				$splitfr = explode("|", $friends['user_friends']);
				if ($pref['profile_friends'] == "ON" && !in_array($com['com_by'], $splitfr)) {
					$text .= " | <a href='newuser.php?id=".$com['com_by']."&add'>".PROFILE_139."</a>";
				}
			}
			$text .= "</div></td></tr></table><br/><br/>";
		}
	}
$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td>";
$text .= "</td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
}
$display = $tp->parseTemplate($text);
if ($allcomments == "on") {
	$title = MENU_PROFILE_6;
} else {
	$title = PROFILE_337;
}
$ns->tablerender($title,$display);
require_once(FOOTERF);
?>