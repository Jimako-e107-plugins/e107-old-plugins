<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/aacgc_mp/e_notify.php $
|     $Revision: 11678 $
|     $Id: e_notify.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if(defined('ADMIN_PAGE') && ADMIN_PAGE === true)
{
	include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");
	$config_category = NT_1;
	$config_events = array('ecalnew' => NT_2, 'ecaledit' => NT_3);
}

if (!function_exists('notify_ecalnew'))
{
	function notify_ecalnew($data) {
		global $nt;
		include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");
		$message = NT_9.': '.USERNAME.' <br />';
		$message .= NT_10.': '.$data['meet_title'].' <br />';
		$message .= NT_5.': '.$data['meet_subj'].' <br />';
		$message .= NT_6.':<br />'.$data['meet_det'].'<br /><br />';
		$message .= NT_12.'<br /><br />';
		$nt -> send('ecalnew', NT_7, $message);
	}
}

if (!function_exists('notify_ecaledit')) {
	function notify_ecaledit($data) {
		global $nt;
		include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");
		$message = NT_4.': '.USERNAME.'  <br />';
		$message .= NT_10.': '.$data['meet_title'].' <br />';
		$message .= NT_5.': '.$data['meet_subj'].' <br />';
		$message .= NT_6.':<br />'.$data['meet_det'].'<br /><br />';
		$message .= NT_11.'<br /><br />';
		$nt -> send('ecaledit', NT_8, $message);
	}
}

?>