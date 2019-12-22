<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/

if (!defined('e107_INIT')) { exit; }

if(defined('ADMIN_PAGE') && ADMIN_PAGE === true)
{
	include_lan(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
	$config_category = NT_LAN_CB2_1;
	$config_events = array('cbox2post' => NT_LAN_CB2_2);
}


if (!function_exists('notify_cbox2post')) {
	function notify_cbox2post($data) {
		global $nt;
		include_lan(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
		$message = NT_LAN_CB2_3.': '.USERNAME.' ('.NT_LAN_CB2_4.': '.$data['ip'].' )<br />';
		$message .= NT_LAN_CB2_5.':<br />'.$data['cmessage'].'<br /><br />';
		$nt -> send('cbox2post', NT_LAN_CB2_6, $message);
	}
}

?>