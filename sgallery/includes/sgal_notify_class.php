<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery User Notify Class: e107_plugins/sgallery/includes/sgal_notify_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
		
include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');

class sgal_notify_class {
	function send($userid=0, $subject, $data, $useremail='') {
		global $sql,$tp;
		if(!$useremail && !$userid) return false;
		$userid = intval($userid);
		e107_require_once(e_HANDLER.'mail.php');
		$subject = SITENAME.': '.$subject;

		$message = '';
		foreach ($data as $value) {
			$message .= $value.'<br />';
		}
		
		if(!$useremail && $sql -> db_Select('user', 'user_email', "user_id='{$userid}'")) {
            $tmp = $sql -> db_Fetch();
            $useremail = $tmp['user_email'];
        }
        
        if(!$useremail) return false;
		
		return sendemail($useremail, $tp->toEmail($subject), $tp->toEmail($message));
	}
}

?>