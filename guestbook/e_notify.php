<?php

if (!defined('e107_INIT')) { exit; }
if(e_LANGUAGE != "English" && file_exists(e_PLUGIN . "guestbook/languages/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."guestbook/languages/English.php");
}
$config_category = GB_LAN_NT_1;
$config_events = array('guestbookpost' => GB_LAN_NT_2);

if (!function_exists('notify_guestbookpost')) {
	function notify_guestbookpost($data) {
		global $nt;
		include_lan(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
		$message = GB_LAN_NT_3.': '.$data['name'].' ('.GB_LAN_NT_4.': '.$data['ip'].' )<br />';
		$message .= GB_LAN_NT_5.':<br />'.$data['gmessage'].'<br /><br />';
		$nt -> send('guestbookpost', GB_LAN_NT_6, $message);
	}
}

?>