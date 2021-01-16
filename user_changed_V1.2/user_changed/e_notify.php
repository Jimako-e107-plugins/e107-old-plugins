<?php
/*
+---------------------------------------------------------------+
|        User Settings Change Notification
|		 for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'user_changed/languages/admin/' . e_LANGUAGE . '.php');
$config_category = UCHANGE_A08;
$config_events = array('user_changed' => UCHANGE_A01);
if (!function_exists('notify_user_changed'))
{
    function notify_user_changed($data)
    {
        global $nt;
		$message = UCHANGE_A01 . '<br /><br />' ;
		if (isset($data['changed_UID']))
		{	// Send changes in message
			if (isset($data['user_id']))
			{	// Admin changed settings
				$message .= UCHANGE_A13.' <b>'. $data['changed_user'].'</b> (ID: '.$data['changed_UID'].')<br /><br />';
				$message .= UCHANGE_A14.' <b>'. $data['user_name'].'</b> (ID: '.$data['user_id'].')<br /><br />';
				unset($data['user_id']);
				unset($data['user_name']);
			}
			else
			{	// User changed own settings
				$message .= UCHANGE_A02.' <b>'.$data['changed_user'].'</b> (ID: '.$data['changed_UID'].')<br /><br />';
			}
			unset($data['changed_user']);
			unset($data['changed_UID']);
			foreach ($data as $k => $v)
			{
				$message .= $k.'=>'.$v.'<br />';
			}
		}
		else
		{
			$message .= UCHANGE_A02 . ' <b>' . $data['username'] . '</b><br /><br /><a href="' . SITEURL . 'user.php?id.' . $data['user_id'] . '">' . UCHANGE_A03 . '</a>';
		}
        $nt->send('user_changed', UCHANGE_A01, $message);
    }
}
?>