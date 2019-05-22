<?php

$eplug_admin = TRUE;
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(e_HANDLER."userclass_class.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}
require_once(e_ADMIN."auth.php");

include_lan(e_PLUGIN."what/languages/".e_LANGUAGE.".php");

if (isset($_POST['updatesettings'])) {
	//general
	$pref['what_slim_viewaccess'] = $_POST['slim_access'];
	$pref['what_fatty_viewaccess'] = $_POST['fatty_access'];
	$pref['what_twobyfour_viewaccess'] = $_POST['twobyfour_access'];

	//fatty
	$pref['what_fatty_timeframe'] = $_POST['timeframe'];
	$pref['what_fatty_layer'] = $_POST['layer'];
	$pref['what_fatty_layerheight'] = $_POST['layerheight'];
	$pref['what_fatty_notify'] = $_POST['notify'];
	save_prefs();
	$message = "Settings saved successfully";
}

if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$text = "<div style='text-align:center'>
<form action='".e_SELF."' method='post'>
<table style='width:85%' class='fborder'>
<tr>
<td colspan='2' class='forumheader' style='text-align:center; font-weight:bold;'>
General Configuration
</td>
</tr>
<tr>
<td style='width:50%' class='forumheader3'>Slim Menu View Access</td>
<td style='width:50%; text-align:right' class='forumheader3'>
".r_userclass('slim_access', $pref['what_slim_viewaccess'], 'off', 'nobody,public,guest,member,admin,classes')."
</td>
</tr>
<tr>
<td style='width:50%' class='forumheader3'>Fatty Menu View Access</td>
<td style='width:50%; text-align:right' class='forumheader3'>
".r_userclass('fatty_access', $pref['what_fatty_viewaccess'], 'off', 'nobody,public,guest,member,admin,classes')."
</td>
</tr>
<tr>
<td style='width:50%' class='forumheader3'>Twobyfour Menu View Access</td>
<td style='width:50%; text-align:right' class='forumheader3'>
".r_userclass('twobyfour_access', $pref['what_twobyfour_viewaccess'], 'off', 'nobody,public,guest,member,admin,classes')."
</td>
</tr>
<tr>
<td colspan='2' class='forumheader' style='text-align:center; font-weight:bold;'>
Fatty Configuration
</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Time frame, in seconds, to gather data from:</td>
<td style='width:70%' class='forumheader3'>
<input type='text' class='tbox' name='timeframe' value='".$pref['what_fatty_timeframe']."' />
</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Place the menu contents in a scrolling layer?</td>
<td style='width:70%' class='forumheader3'>
<input type='checkbox' name='layer' value='1'".($pref['what_fatty_layer'] == 1 ? " checked='checked'" : "")." /> If so; height (in pixels): <input type='text' class='tbox' name='layerheight' value='".$pref['what_fatty_layerheight']."' />
</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Notification type:<br /><span class='smalltext'>Can be <i>date</i> or <i>day</i>. Any other value disables the message.</span></td>
<td style='width:70%' class='forumheader3'>
<input type='text' class='tbox' name='notify' value='".$pref['what_fatty_notify']."' />
</td>
</tr>

<tr>
<td colspan='2' class='forumheader' style='text-align: center;'><input class='button' type='submit' name='updatesettings' value='Save Settings' /></td>
</tr>
</table>
</form>
</div>";

$ns->tablerender("Configure What", $text);

require_once(e_ADMIN."footer.php");

?>
