<?php

if (!defined('e107_INIT')) { exit; }
require_once("videohandler.php");
$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'><img src='images/videos.png'>&nbsp;".PROFILE_165."</td></tr></table>";
//$text .= "<br/><form method='POST' action='formhandler.php'>";

$text .= "<script langauge=\"JavaScript\" type=\"text/javascript\">
function disp_help_text()
{
   var w = document.share_form.share_site.selectedIndex;
   var selected_text = document.share_form.share_site.options[w].text;
	var vhelp = document.getElementById(\"helpBar\");
	if (selected_text=='YouTube (http://www.youtube.com/)')
  	{
	  var selected_text = '<b>".PROFILE_115."</b>';
  	}
	if (selected_text=='Vimeo (http://vimeo.com/)')
	{
	  var selected_text = '<b>".PROFILE_115a."</b>';
	}
	if (selected_text=='Indavideo (http://indavideo.hu/)')
	{
	  var selected_text = '<b>".PROFILE_115b."</b>';
	}
	if (selected_text=='Metacafe (http://www.metacafe.com/)')
	{
	  var selected_text = '<b>".PROFILE_115d."</b>';
	}
	vhelp.innerHTML = selected_text; 
}
</script>";

if ($_GET['error'] == 1) {
	$error_message = PROFILE_115c;
}

$id = intval($id);

if (isset($_GET['addnew'])) {
	$sql->mySQLresult = @mysql_query("SELECT vid_name FROM ".MPREFIX."another_profiles_vids WHERE vid_uid='".$id."'");
	$count = $sql->db_Rows();

	if ($pref['profile_maxnovids'] == "" || $pref['profile_maxnovids'] == 0) {
	// Set as unlimited
		$max = "UN";
	} else {
		$max = $pref['profile_maxnovids'];
	}

	$text .= "<a href='newusersettings.php?page=videos".$luid."'>".PROFILE_233."</a><br/><br/>";
	if ($max != "UN" && $count >= $max) {
		$text .= PROFILE_114." ".$pref['profile_maxnovids'].PROFILE_236;
	} else {
		$text .= $error_message;
		$text .= "<form method='post' name='share_form' action='formhandler.php'><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' colspan='2'>".PROFILE_225."</td></tr>";
		$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_226."</td><td class='forumheader3'><input type='text' style='width:225px' class='tbox' name='title' value=''></td></tr>";
		$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_227."</td><td class='forumheader3'><textarea rows='5' style='width: 99%;' name='description' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'></textarea></td></tr>";
		$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_423."</td><td class='forumheader3'>
			<select name='share_site' onChange='disp_help_text()' class='fborder table' style='width:225px'>".
			($pref['profile_youtube'] == "ON" ? "<option value='youtube' selected='selected'>YouTube (http://www.youtube.com/)</option>" : "").
			($pref['profile_vimeo'] == "ON" ? "<option value='vimeo'>Vimeo (http://vimeo.com/)</option>" : "").
			($pref['profile_indavideo'] == "ON" ? "<option value='indavideo'>Indavideo (http://indavideo.hu/)</option>" : "").
			($pref['profile_metacafe'] == "ON" ? "<option value='metacafe'>Metacafe (http://www.metacafe.com/)</option>" : "")."		
			";
/*
			<option value='break'>Break (http://www.break.com/)</option>
			<option value='google'>Google (http://video.google.com/)</option>
			<option value='dailymotion'>Dailymotion (http://www.dailymotion.com/)</option>
			<option value='yahoo'>Yahoo! (http://video.yahoo.com/)</option>
			<option value='revver'>Revver (http://revver.com/)</option>
			<option value='vidilife'>Vidilife (http://www.vidilife.com/)</option>
			<option value='stickam'>Stickam (http://www.stickam.com/)</option>
			<option value='pinkbike'>Pinkbike (http://www.pinkbike.com/)</option>
*/
		$text .= "
		</select>
		</td></tr>";
		if($pref['profile_youtube'] == "ON") {
			$defvidtext = PROFILE_115;
		} elseif($pref['profile_vimeo'] == "ON") {
			$defvidtext = PROFILE_115a;
		} elseif($pref['profile_indavideo'] == "ON") {
			$defvidtext = PROFILE_115b;
		} elseif($pref['profile_metacafe'] == "ON") {
			$defvidtext = PROFILE_115d;
		} else {
			$defvidtext = "";
		}
		$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_422."<br></td><td class='forumheader3'><input type='text' class='tbox' style='width:220px;' name='embed' value=''><br/><span id='helpBar'>".$defvidtext."<br></span></td></tr>";
//		$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_228."<br><br><a href=\"javascript:doMenu('help');\" id='xhelp'>".PROFILE_232."</a></td><td class='forumheader3'><textarea rows='10' style='width: 99%;' name='embed' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'></textarea><br/></td></tr>";
		$text .= "<tr><td class='forumheader3' colspan='2'><center><input type='hidden' name='uid' value='".$id."'><input type='submit' class='button' name='addnewvideos' value='".PROFILE_229."'></center></td></tr></table></form>";
	}

		$text .= "";



} elseif (isset($_GET['vid'])) {
	if ($_GET['error'] == 1) {
		$error_message = PROFILE_115c;
	}
	$sql->mySQLresult = @mysql_query("SELECT vid_name, vid_desc, vid_embed FROM ".MPREFIX."another_profiles_vids WHERE vid_id='".intval($_GET['vid'])."'");
	$vid = $sql->db_Fetch();
	$text .= "<form method='post' name='share_form' action='formhandler.php'><a href='newusersettings.php?page=videos".$luid."'>".PROFILE_233."</a><br/><br/>";
	$embed_db = $tp -> toHTML($vid['vid_embed']);
	$desc = $tp -> toHTML($vid['vid_desc']);
	$name = $tp -> toHTML($vid['vid_name']);
	$embed_db = explode(" ", $embed_db);
	$video = $embed_db[1];
	$share_site = $embed_db[0];

	$vidpic_yt = str_replace("<", "", $vid['vid_embed']);
	$break_yt = explode("/", $vidpic_yt);
	$break2_yt = explode("&", $break_yt[4]);
	if ($break_yt[2] == "www.youtube.com") {
		$break_yt = explode("/", $vidpic_yt);
		$break2_yt = explode("&", $break_yt[4]);
		$video = $break2_yt[0];
	}

	$text .= $error_message;
	$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' colspan='2'>".PROFILE_221."</td></tr>";
	$text .= "<tr><td class='forumheader3'>".PROFILE_226."</td><td class='forumheader3'>";
			if ($break_yt[2] == "www.youtube.com") {
				$text .= "<img src='http://img.youtube.com/vi/".$break2_yt[0]."/default.jpg' width='100'><br/><br/>";
///!!!
			} elseif($share_site != "") {
				$pic_url = pic_url($share_site,$video);
				$text .=  "<img src='$pic_url' width='100'><br/><br/>";
			} else {
				$text .= "<img src='images/nopreview.png' title='".PROFILE_267."' width='100'><br/>";
			}
				$text .= "<input type='text' class='tbox' name='title' style='width:225px' value='".$name."'>";



	$text .= "</td></tr>";
	$text .= "<tr><td class='forumheader3'>".PROFILE_227."</td><td class='forumheader3'><textarea rows='5' style='width: 99%;' name='description' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>".$desc."</textarea></td></tr>";
	$text .= "<tr><td class='forumheader3'>".PROFILE_423."</td><td class='forumheader3'>
	<select name='share_site' onChange='disp_help_text()' class='border table' style='width:225px'>";
	if($share_site  == "youtube" && $pref['profile_youtube'] == "ON") {
		$text .= "<option value='youtube' selected='selected'>YouTube (http://www.youtube.com/)</option>";
	} elseif($pref['profile_youtube'] == "ON") {
		$text .= "<option value='youtube'>YouTube (http://www.youtube.com/)</option>";
	}
	if($share_site  == "vimeo" && $pref['profile_vimeo'] == "ON") {
		$text .= "<option value='vimeo' selected='selected'>Vimeo (http://vimeo.com/)</option>";
	} elseif($pref['profile_vimeo'] == "ON") {
		$text .= "<option value='vimeo'>Vimeo (http://vimeo.com/)</option>";
	}
	if($share_site  == "indavideo" && $pref['profile_indavideo'] == "ON") {
		$text .= "<option value='indavideo' selected='selected'>Indavideo (http://indavideo.hu/)</option>";
	} elseif($pref['profile_indavideo'] == "ON") {
		$text .= "<option value='indavideo'>Indavideo (http://indavideo.hu/)</option>";
	}
	if($share_site  == "metacafe" && $pref['profile_metacafe'] == "ON") {
		$text .= "<option value='metacafe' selected='selected'>Metacafe (http://www.metacafe.com/)</option>";
	} elseif($pref['profile_metacafe'] == "ON") {
		$text .= "<option value='metacafe'>Metacafe (http://www.metacafe.com/)</option>";
	}
/*
		($share_site  == "youtube" ? "<option value='youtube' selected='selected'>YouTube (http://www.youtube.com/)</option>" : "<option value='youtube'>YouTube (http://www.youtube.com/)</option>").
		($share_site == "vimeo" ? "<option value='vimeo' selected='selected'>Vimeo (http://vimeo.com/)</option>" : "<option value='vimeo'>Vimeo (http://vimeo.com/)</option>").
		($share_site == "indavideo" ? "<option value='indavideo' selected='selected'>Indavideo (http://indavideo.hu/)</option>" : "<option value='indavideo'>Indavideo (http://indavideo.hu/)</option>").
		($share_site  == "metacafe" ? "<option value='metacafe' selected='selected'>Metacafe (http://www.metacafe.com/)</option>" : "<option value='metacafe'>Metacafe (http://www.metacafe.com/)</option>")."
*/
	$text .= "</select>
	</td></tr>";
/*
		($share_site == "break" ? "<option value='break' selected='selected'>Break (http://www.break.com/)</option>" : "<option value='break'>Break (http://www.break.com/)</option>").
		($share_site == "google" ? "<option value='google' selected='selected'>Google (http://video.google.com/)</option>" : "<option value='google'>Google (http://video.google.com/)</option>").
		($share_site == "dailymotion" ? "<option value='dailymotion' selected='selected'>Dailymotion (http://www.dailymotion.com/)</option>" : "<option value='dailymotion'>Dailymotion (http://www.dailymotion.com/)</option>").
		($share_site == "yahoo" ? "<option value='yahoo' selected='selected'>Yahoo! (http://video.yahoo.com/)</option>" : "<option value='yahoo'>Yahoo! (http://video.yahoo.com/)</option>").
		($share_site == "revver" ? "<option value='revver' selected='selected'>Revver (http://revver.com/)</option>" : "<option value='revver'>Revver (http://revver.com/)</option>").
		($share_site == "vidilife" ? "<option value='vidilife' selected='selected'>Vidilife (http://www.vidilife.com/)</option>" : "<option value='vidilife'>Vidilife (http://www.vidilife.com/)</option>").
		($share_site == "stickam" ? "<option value='stickam' selected='selected'>Stickam (http://www.stickam.com/)</option>" : "<option value='stickam'>Stickam (http://www.stickam.com/)</option>").
		($share_site == "pinkbike" ? "<option value='pinkbike' selected='selected'>Pinkbike (http://www.pinkbike.com/)</option>" : "<option value='pinkbike'>Pinkbike (http://www.pinkbike.com/)</option>").
*/

	$text .= "<tr><td style='width: 1%;' class='forumheader3'>".PROFILE_422."</td><td class='forumheader3'><input type='text' class='tbox' style='width:220px;' name='embed' value='".$video."'><br/><span id='helpBar'><br></span></td></tr>";

//	$text .= "<tr><td class='forumheader3'>".PROFILE_228."<br><a href=\"javascript:doMenu('help');\" id='xhelp'>".PROFILE_232."</a></td><td class='forumheader3'><textarea rows='10' style='width: 99%;' name='embed' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>".$video."</textarea><br/></td></tr>";
	$text .= "<tr><td class='forumheader3' colspan='2'><center><input type='hidden' name='vidid' value='".$_GET['vid']."'><input type='hidden' name='uid' value='".$id."'><input type='submit' class='button' name='updatevideos' value='".PROFILE_222."'></center></td></tr></table></form>";
	$text .= "<div id='help' style='display:none'><br><br>".PROFILE_115."</div>";
	$text .= "<br/><br/><b>".PROFILE_230."</b><br/><br/><form method='post' action='formhandler.php'>";
	$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='vids' AND com_extra='".intval($_GET['vid'])."' ORDER BY com_date DESC");
	$comm = $sql->db_Rows();

// Videó hozzászólások listázása
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='vids' AND com_extra='".intval($_GET['vid'])."'");
	$vidnumrows = $sql->db_Rows();
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
	$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='vids' AND com_extra='".intval($_GET['vid'])."' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
	$vidcomm = $sql->db_Rows();
	$maxPage = ceil($vidnumrows/$rowsPerPage);
	$self = $_SERVER['PHP_SELF'];
	$nav  = '';
	for($page = 1; $page <= $maxPage; $page++) {
   		if ($page == $pageNum) {
     		 $nav .= ""; // no need to create a link to current page
   		} else {
     		 $nav .= " <a href=\"$self?page=videos&vid=".$_GET['vid']."&pgnum=".$page."\">$page</a> ";
   		}
	}
	if ($pageNum > 1) {
		$page  = $pageNum - 1;
	   	$prev  = " <a href=\"$self?page=videos&vid=".$_GET['vid']."&pgnum=".$page."\">".PROFILE_204."</a> ";
  		$first = " <a href=\"$self?page=videos&vid=".$_GET['vid']."&pgnum=".$page."\">".PROFILE_205."</a> ";
	} else {
   		$prev  = ''; // we're on page one, don't print previous link
   		$first = '&nbsp;'; // nor the first page link
	}
	if ($pageNum < $maxPage) {
   		$page = $pageNum + 1;
   		$next = " <a href=\"$self?page=videos&vid=".$_GET['vid']."&pgnum=".$page."\">".PROFILE_202."</a> ";
  		$last = " <a href=\"$self?page=videos&vid=".$_GET['vid']."&pgnum=".$page."\">".PROFILE_203."</a> ";
	} else {
   		$next = ''; // we're on the last page, don't print next link
   		$last = '&nbsp;'; // nor the last page link
	}
// END OF MULTIPAGES
	if ($vidcomm == 0) {
		$text .= "<br/><i>".PROFILE_68."</i>";
	} else {
		$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader' colspan='4'><i>".PROFILE_36a." (".$vidnumrows."):</i></td></tr></table>";
		$text .= "<br/>";
		$text .= "<br/><form action='formhandler.php' method='post'>";

		for ($i = 0; $i < $vidcomm; $i++) {
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
		$text .= "<br><table width='100%' class='fborder'>
			<tr>
				<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
				<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
				<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
			</tr>
			<td class='forumheader'> ".$newcom."<br>&nbsp;<input type='checkbox' name='delvidcom[]' value='".$com['com_id']."'>&nbsp;".$online."&nbsp;&nbsp;<a href='newuser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
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
// Hozzászólások vége
		if ($pref['profile_buttontype'] == "Yes") {
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td>
			<input type='hidden' name='uid' value='".$id."'>
			<input type='hidden' name='vidid' value='".$_GET['vid']."'>
			<input type='image' name='comment_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' >";
		} else {
			$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td>
			<input type='hidden' name='uid' value='".$id."'>
			<input type='hidden' name='vidid' value='".$_GET['vid']."'>
			<input type='submit' name='comment_delete' value='".PROFILE_192."' class='button'>";
		}
		$text .= "</form></td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
	}

} else {
	$sql->mySQLresult = @mysql_query("SELECT vid_id, vid_name, vid_desc, vid_embed FROM ".MPREFIX."another_profiles_vids WHERE vid_uid='".$id."' ORDER BY vid_added DESC");
	$vids = $sql->db_Rows();
	$text .= "<a href='newusersettings.php?page=videos".$luid."&addnew'>".PROFILE_225."</a><br/><hr><br/>";

	if ($vids == 0) {
		$text .= "<br/><i>".PROFILE_119."</i>";
	} else {
		$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='forumheader'><i>".PROFILE_273."</i></td></tr></table>";
		$text .= "<br><table style='".USER_WIDTH."' class='fborder table'><tr>";
		$count = 1;
		for ($i = 0; $i < $vids; $i++) {
			$vid = $sql->db_Fetch();
			$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='vids' AND com_extra='".$vid['vid_id']."' AND com_date > '".$userlastvisit."' ");
			$crows = mysql_num_rows($query);

			if ($crows > 0) {
				$new = " <font color='#FF0000'>".$crows." ".($crows == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
			} else {
				$query = mysql_query("SELECT com_id FROM ".MPREFIX."another_profiles_com WHERE com_to='".$id."' AND com_type='vids' AND com_extra='".$vid['vid_id']."' ");
				$crows_all = mysql_num_rows($query);
				if ($crows_all > 0) {
					$new = "".$crows_all." ".($crows_all == 1 ? PROFILE_315 : PROFILE_315)."";
				} else {
					$new = "";
				}
			}
			// Youtube kép
			$vidpic = str_replace("<", "", $vid['vid_embed']);

			if (!$break_a[2] == "www.youtube.com") {
				$embed_db = explode(" ", $vid['vid_embed']);
				$video_code = $embed_db[1];
				$share_site = $embed_db[0];
			}

			$break = explode("/", $vidpic);
			$break2 = explode("&", $break[4]);
			$text .= "<td width='33%'><center>";
			if ($break[2] == "www.youtube.com") {
				$text .= "<a href='newusersettings.php?page=videos".$luid."&vid=".$vid['vid_id']."' alt='Edit Video'><img src='http://img.youtube.com/vi/".$break2[0]."/default.jpg' width='145' height='100'></a><br>";
			} elseif($share_site != "") {
				$pic_url = pic_url($share_site,$video_code);
				$text .= "<a href='newusersettings.php?page=videos".$luid."&vid=".$vid['vid_id']."' alt='Edit Video'><img src='$pic_url' width='145' height='100'></a><br>";
			} else {
				$text .= "<a href='newusersettings.php?page=videos".$luid."&vid=".$vid['vid_id']."' alt='Edit Video'><img src='images/nopreview.png' title='".PROFILE_267."'  width='145' height='100'></a><br>";
			}
			$text .= "<form method='post' action='formhandler.php'>".$new."<br><input type='checkbox' name='viddel[]' value='".$vid['vid_id']."'> <a href='newusersettings.php?page=videos".$luid."&vid=".$vid['vid_id']."' alt=''>".$tp -> toHTML($vid['vid_name'], true)."</a><br/>".$tp -> toHTML($vid['vid_desc'], true)."<br/><br/><br/>";
			if ($count == 3) {
				$text .= "</tr><tr><td></td></tr>";
				$count = 1;
			} else {
				$count++;
			}
		}
		$text .= "</table>";
		$text .= "<hr>";
		if ($pref['profile_buttontype'] == "Yes") {
			$text .= "<br/><input type='hidden' name='uid' value='".$id."'>
			<input type='image' name='delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' >
			</form>";
		} else {
			$text .= "<br/><input type='hidden' name='uid' value='".$id."'>
			<input type='submit' name='delete' value='".PROFILE_192a."' class='button'>
			</form>";
		}
	}

}

return $text;

?>