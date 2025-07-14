<?php

if (!defined('e107_INIT')) { exit; }

if ($pref['profile_mp3enabled'] == "OFF") {
	Header("Location: newusersettings.php?".$luid." ");
}
$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'><img src='images/music.png'>".PROFILE_166."</td></tr></table>";

$text .= "<form method='POST' enctype='multipart/form-data' action='formhandler.php'>";

$sql->db_Select("another_profiles","user_mp3","user_id=".intval($id)."");
$row = $sql->db_Fetch();

if ($pref['profile_mp3'] == "Both") {
	$text .= "<br /><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'>".PROFILE_154."</td></tr></table>";
	if ($row['user_mp3'] == "") {
		$http = 1;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='usemp3' value='none' checked> ".PROFILE_159."<br/><br/>";
	} elseif(strpos($row['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
		$http = 0;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local' checked> ".PROFILE_153."     <input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159."<br/><br/>";
	} else {
		$http = 1;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote' checked> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159."<br/><br/>";
	}
	$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'>".PROFILE_150."</td></tr></table>";
	if ($row['user_mp3'] != "" && $http == 1) {
		$value = $row['user_mp3'];
	} else {
		$value = "";
	}
	$text .= "<br/><input type='text' class='tbox' size='80' name='remote' placeholder='http://...' value='".$value."'><br/><br/>";
}

if ($pref['profile_mp3'] == "Remote Only") {
	$http = 1;
	$text .= "<input type='hidden' id='select' name='usemp3' value='remote' checked>";
	if(strpos($row['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
	$http = 0;
}
if ($row['user_mp3'] != "" && $http == 1) {
	$value = $row['user_mp3'];
	$text .= "<input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159a."<br/><br/>";
} else {
	$value = "";
}
	$text .= "<br/><table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'>".PROFILE_150a."</td></tr></table>";
	$text .= "<br/><input type='text' class='tbox' size='80' name='remote' placeholder='http://...' value='".$value."'><br/><br/>";
}

if ($pref['profile_mp3'] == "Both") {
	$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'>".PROFILE_155."</td></tr></table>";
}

if ($pref['profile_mp3'] == "Local Only") {
	$text .= "<input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159a."<br/><br/>";
	$text .= "<table style='".USER_WIDTH."' class='fborder table'><tr><td class='fborder table'>".PROFILE_155a."</td></tr></table>";
}
if ($pref['profile_mp3'] == "Both" || $pref['profile_mp3'] == "Local Only") {
	$text .= "<br/>".PROFILE_151."<br/><br/><input type='file' class='tbox' name='file_userfile[]' value='".$lvalue."'>";
}

if ($pref['profile_buttontype'] == "Yes") {
	$text .= "<br/><br/><input type='hidden' value='".$id."' name='uid'><input type='image' name='updatesong' value='".PROFILE_222."' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_update_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_update.gif\"' src='images/buttons/".e_LANGUAGE."_update.gif' ><input type='hidden' name='updatesong'></form>";
} else {
	$text .= "<br/><br/><br/><input type='hidden' value='".$id."' name='uid'><input type='submit' class='button' name='updatesong' value='".PROFILE_222."'></form>";
}

return $text;

?>