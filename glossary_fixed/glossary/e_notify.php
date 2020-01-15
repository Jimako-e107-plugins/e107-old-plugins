<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_notify.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/14 23:07:30 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

if(defined('ADMIN_PAGE') && ADMIN_PAGE == true)
{
	include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));
	$config_category = LAN_GLOSSARY_NOTIFY_01;
	$config_events = array('wordsub' => LAN_GLOSSARY_NOTIFY_02);
}

if (!function_exists('notify_wordsub'))
{
	function notify_wordsub($data)
	{
		global $nt;

		include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/".e_LANGUAGE."_".basename(__FILE__));
		$username		= $data['username'];
		$ip					= $data['ip'];
		$word_name	= $data['word_name'];
		$word_desc	= $data['word_desc'];
		
		list($uid, $user) = explode(".", $username);
		
		$message  = "<u><i>".LAN_GLOSSARY_NOTIFY_04.":</i></u> ".$user." (".$uid.")";
		$message .= "<br />";
		$message .= "<u><i>".LAN_GLOSSARY_NOTIFY_04.":</i></u> ".$ip;
		$message .= "<br />";
		$message .= "<u><i>".LAN_GLOSSARY_NOTIFY_05.":</i></u> ".$word_name;
		$message .= "<br />";
		$message .= "<u><i>".LAN_GLOSSARY_NOTIFY_06.":</i></u>";
		$message .= "<br />";
		$message .= $word_desc;
		$message .= "<br />";
		
		$nt -> send('wordsub', LAN_GLOSSARY_NOTIFY_03, $message);
	}
}

?>