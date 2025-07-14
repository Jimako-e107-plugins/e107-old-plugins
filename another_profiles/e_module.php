<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if ($pref['plug_installed']['another_profiles']) {
  if ($pref['profile_redirect_usersettings'] == "Yes" && e_PAGE == "usersettings.php" && e_QUERY != "update") {
  $_uid = is_numeric(e_QUERY) ? intval(e_QUERY) : "";
	if ($_uid != '') {
		header("Location: ".e_PLUGIN."another_profiles/newusersettings.php?uid=".$_uid."");
	} else {
		header("Location: ".e_PLUGIN."another_profiles/newusersettings.php?page=settings");
	}
  }

  if ($pref['profile_redirect_usersettings'] == "Yes" && e_PAGE == "user.php") {
	$url = $_SERVER["REQUEST_URI"];
	$user = explode(".", $url);
	$counter=0;
	foreach($user as $string) {
		$counter++;
		if ($string == 'php?id') {
			$uid = $user[$counter];
			header("Location: ".e_PLUGIN."another_profiles/newuser.php?id=".$uid."");
			$lnk=true;
			break;
		}
	} if ($pref['profile_memberlist'] == "Yes" && !$lnk) {
		header("Location: ".e_PLUGIN."another_profiles/newuser.php");
	}
  }

  // Check if new user and then redirect and prompt them to fill in profile info.
  if (USER && $pref['profile_redirect_usersettings'] == "Yes" && $pref['profile_redirect'] == "Yes" && e_PAGE != "newusersettings.php" && e_QUERY != "update") {
	$sql -> db_Select("another_profiles", "*", "user_id='".USERID."'");
	$count = $sql -> db_Rows();
		if ($count == 0) {
			header("Location: ".e_PLUGIN."another_profiles/newusersettings.php?first");
		}
  }

  if (e_PAGE == "users.php") {
	if ($_POST['useraction'] == "deluser") {
		header("Location: ".e_PLUGIN."another_profiles/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid'])."");
	} else if (varset($_POST['useraction'])) {
		foreach ($_POST['useraction'] as $key => $val) {
			if ($val) {
				$_POST['useraction'] = $val;
				$_POST['userid'] = $key;
				break;
			}
		}
		if ($_POST['useraction'] == "deluser") {
			header("Location: ".e_PLUGIN."another_profiles/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid'])."");
		}
	}
  }
}
?>