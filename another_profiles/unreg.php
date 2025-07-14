<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6
| unreg.php
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}

if ($pref['profile_unreg'] == "No" || $pref['profile_unreg'] == "") {
	Header("Location: newusersettings.php?".$luid." ");
}
if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}
require_once(HEADERF);
$text .="<div class='main_caption'><b>".PROFILE_281."</div></b><br/>";

$alert_icon = "<img src='images/alert.png' title='!' />";

if (!$pref['plug_installed']['another_profiles']) {
	$ns->tablerender($alert_icon,PROFILE_2a);
	require_once(FOOTERF);
	exit;
}

if (ADMIN) {
$text .= PROFILE_283;
} else if (USER) {
$text .= "<br />".PROFILE_308."<br /><br />";
	//Make New Secure Image
	require_once(e_HANDLER . "secure_img_handler.php");
	$sec_img = new secure_image;
	$text .= "
	<form id='uchange' method='post' action='" . e_SELF . "' >
	<table style ='" . USER_WIDTH . "' class='fborder' >";
	//Display menu
      	$text .= "
		<tr>
			<td  class = 'forumheader3' style='width:25%;' >" . PROFILE_286 . "</td><td  class = 'forumheader3' style='width:75%;' >" . USERNAME . "</td>
		</tr>
		<tr>
			<td  class = 'forumheader3'>" . PROFILE_287 . "</td>
			<td  class = 'forumheader3'><input class='tbox' type='password' name='userpass' size='25' value='' maxlength='20' /></td>
		</tr>
		<tr>
			<td  class = 'forumheader3'>" . PROFILE_288 . "</td>
			<td  class = 'forumheader3'><input class='tbox' name='unreg_email' size='25' value='' maxlength='50' /></td>
		</tr>";
	$text .= "
		<tr>
			<td  style='width:15%;vertical-align:top;' class = 'forumheader3'>" . PROFILE_289 . "</td>
			<td  class = 'forumheader3' style='width:85%;vertical-align:top;'>
			<input type = 'hidden' name = 'rand_num' value ='" . $sec_img->random_number . "' />" . $sec_img->r_image() . "<br />
			<input type = 'text' name = 'code_verify' class = 'tbox' size = '10' /></td>
		</tr>";
	$text .= "
		<tr>
			<td  class = 'forumheader3' colspan = '2'>
				<input type = 'submit' name = 'user_unreg' class = 'button' value = '" . PROFILE_284 . "' />&nbsp;&nbsp;
				<input type = 'checkbox' name='unreg_check' value = '1' class = 'tbox' style='border:0;' />" . PROFILE_285 . "
				<input type = 'hidden' name = 'unreg_action' value = 'unreg_accept' />
				<input type = 'hidden' name='unreg_id' value = '" . USERID . "' />
			</td>
		</tr>
	</table>
	</form>";
}
//Unreg Start
$unreg_action = $_REQUEST['unreg_action'];
$unreg_check = $_REQUEST['unreg_check'];
$code_ok = false;
$unreg_ok = false;
$unreg_id = intval($_REQUEST['unreg_id']);
if ($unreg_action == "unreg_accept") {
	if ($sec_img->verify_code($_POST['rand_num'], $_POST['code_verify'])) {
		$code_ok = true;
	}
	if ($code_ok && $unreg_check && ($unreg_id == USERID)) {
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_join, user_ip FROM ".MPREFIX."user WHERE user_id=$unreg_id ");
		$new = $sql->db_Fetch();
		$unreg_join = date("Y.m.d. H:i", $new['user_join']);
		$unreg_user_ip = $new['user_ip'];
		$unreg_db = new DB;
		if ($unreg_db->db_Delete("user", "user_id = '" . $unreg_id . "' and user_email = '" . $_POST['unreg_email'] . "' and user_password = '" . md5($_POST['userpass']) . "'")) {
		
		//Delete User Friends
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."another_profiles WHERE user_id='".$unreg_id."' ");
		$new = $sql->db_Fetch();
		$check = explode("|", $new['user_friends']);
		$unreg_user_friends = $new['user_friends'];
		foreach($check as $tick) {
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$tick."' ");
			$new = $sql->db_Fetch();
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$unreg_id."' ");
			$new2 = $sql->db_Fetch();
			$newfriends = str_replace("|".$unreg_id."|" , "|", $new['user_friends']);
			$newfriends = str_replace("  " , " ", $newfriends);
			if($newfriends == ' 0') {
				$newfriends = '';
			}
			$newfriends2 = str_replace("|".$tick."|" , "|", $new2['user_friends']);
			$newfriends2 = str_replace("  " , " ", $newfriends2);
			if($newfriends2 == ' 0') {
				$newfriends2 = '';
			}
			$sql -> db_Update("another_profiles", "user_friends='".$newfriends."' WHERE user_id='".$tick."' ");
			$sql -> db_Update("another_profiles", "user_friends='".$newfriends2."' WHERE user_id='".$unreg_id."' ");
		}

		//Delete Friend Requests
		$friend = "|";
		$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_friends_request like '%|".$unreg_id."|%' ";
		$result = mysql_query($query);
		while($noticia = mysql_fetch_array($result)) {
			$friend = $friend.$noticia["user_id"]."|";
		}
		$friend = explode("|", $friend);
		if ($friend[1] == '') {
		} else {
			foreach ($friend as $fr) {
				if ($fr == '') {
				} else {
					$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$fr."' ");
					$new = $sql->db_Fetch();
					$newfriends = str_replace("|".$unreg_id."|" , "|", $new['user_friends_request']);
					$newfriends = str_replace("  " , " ", $newfriends);
					if($newfriends == ' 0') {
						$newfriends = '';
					}
					$sql -> db_Update("another_profiles", "user_friends_request='".$newfriends."' WHERE user_id='".$fr."' ");
				}

			}
		}
		//Delete User Tables
		$unreg_db->db_Delete("another_profiles", "user_id = '" . $unreg_id . "'");
		$unreg_db->db_Delete("another_profiles_com", "com_by = '" . $unreg_id . "'");
		$unreg_db->db_Delete("another_profiles_com", "com_to = '" . $unreg_id . "'");
		$unreg_db->db_Delete("another_profiles_vids", "vid_uid = '" . $unreg_id . "'");
		$unreg_db->db_Delete("user", "user_id = '" . $unreg_id . "'");
		$unreg_db->db_Delete("user_extended", "user_extended_id = '" . $unreg_id . "'");
		//Move Or Delete User Pictures
		$userimagedir = "userimages/".$unreg_id."";
		if ($pref['profile_unreg_save'] == 'Yes') {
			if (is_dir($userimagedir)) {
				$new_imagedir = "userimages/unreg_".$_POST['code_verify']."_". $unreg_id ."";
				rename($userimagedir, $new_imagedir);
				function unlinkIndex($dir) {
					if (preg_match("/\/index.htm/", $dir)) {
						unlink($dir);
					}
					if(!$dh = @opendir($dir)) {
						return;
					}
					while (false !== ($obj = readdir($dh))) {
						if($obj == '.' || $obj == '..') {
							continue;
						}
						unlinkIndex($dir.'/'.$obj);
					}
					closedir($dh);
					return;
				}
				unlinkIndex($new_imagedir);
			}
		} else {
			function delete_directory($userimagedir) {
				if (is_dir($userimagedir)) $dir_handle = opendir($userimagedir);
				if (!$dir_handle) return false;
				while($file = readdir($dir_handle)) {
					if ($file != "." && $file != "..") {
						if (!is_dir($userimagedir."/".$file)) unlink($userimagedir."/".$file);
						else delete_directory($userimagedir.'/'.$file);          
					}
				}
				closedir($dir_handle);
				rmdir($userimagedir);
				return true;
			}
			delete_directory($userimagedir);
		}
		//Move Or Delete User MP3
		$usermp3file = "usermp3/".$unreg_id.".mp3";
		if (file_exists($usermp3file)) {
			if ($pref['profile_unreg_save'] == 'Yes') {
				$newusermp3file = "usermp3/unreg_".$_POST['code_verify']."_".$unreg_id.".mp3";
				rename($usermp3file, $newusermp3file);
			} else {
				unlink($usermp3file);
			}
		}
		if ($pref['profile_unreg_save'] == 'Yes') {
			if ($new_imagedir) {
				$pmimagedir = "".PROFILE_295."<a href=\'".e_PLUGIN."another_profiles/".$new_imagedir."\'>Link</a>.";
				$email_imagedir = "".PROFILE_306."another_profiles/".$new_imagedir."".PROFILE_307."";
			} else {
				$pmimagedir = "".PROFILE_300."";
				$email_imagedir = "".PROFILE_300."";
			}
			if ($newusermp3file) {
				$pmmp3file = "".PROFILE_296."<a href=\'".e_PLUGIN."another_profiles/".$newusermp3file."\'>Link</a>.";
				$email_mp3file = "".PROFILE_296."another_profiles/".$newusermp3file.".";
			} else {
				$pmmp3file = "".PROFILE_301."";
				$email_mp3file = "".PROFILE_301."";
			}
		}
		$unreg_ok = true;
		//Private Message For Site Admin
		$userfrom = get_user_data($unreg_id);
		$userfrom = $userfrom['user_name'];
		$unreg_user_friends = str_replace("|", " #", $unreg_user_friends);
		if ($unreg_user_friends != "" && $unreg_user_friends != " #") {
			$unreg_friends = "".PROFILE_294."".$unreg_user_friends."";
			$unreg_friends = "".substr($unreg_friends, 0, -1).".<br>";
		} else {
			$unreg_friends = "";
		}
		$unreg_date = date("Y.m.d. H:i", intval(time()));
		$msg = "<b>".PROFILE_291."<br><br>".$userfrom."</b><br><br>".PROFILE_292."#".$unreg_id.".<br>".PROFILE_293."".$_POST['unreg_email'].".<br>".PROFILE_304."".$unreg_join.".<br>".PROFILE_305."".$unreg_user_ip.".<br><hr>".$unreg_friends."".$pmimagedir."<br>".$pmmp3file."<br>".$unreg_date."";
		$email_msg = "<b>".PROFILE_291."<br><br>".$userfrom."</b><br><br>".PROFILE_292."#".$unreg_id.".<br>".PROFILE_293."[".$_POST['unreg_email']."].<br>".PROFILE_304."".$unreg_join.".<br>".PROFILE_305."".$unreg_user_ip.".<br><hr>".$unreg_friends."".$email_imagedir."<br>".$email_mp3file."<br>".$unreg_date."";
		$size = strlen($msg);
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_perms FROM ".MPREFIX."user WHERE user_perms='0' ");
		$new = $sql->db_Fetch();
		$stadmid = $new['user_id'];
		$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".$stadmid."', '".$stadmid."', '".intval(time())."', '0', '".PROFILE_290."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
		//Email To SiteAdmin
		require_once(e_HANDLER . "mail.php");
		sendemail(SITEADMINEMAIL, PROFILE_302, $email_msg, ADMIN, SITEADMINEMAIL, SITENAME);
		}
	}
	if (!$unreg_check) {
		$text .= PROFILE_297;
	} else if (!$code_ok) {
		$text .= PROFILE_298;
	} else if (!$unreg_ok) {
		$text .= PROFILE_299;
	} else if ($unreg_ok) {
		header("Location: ".e_BASE."index.php?logout");
	}
}
$display = $tp->parseTemplate($text, TRUE, $user_shortcodes);
$ns->tablerender("",$display);
require_once(FOOTERF);
?>
