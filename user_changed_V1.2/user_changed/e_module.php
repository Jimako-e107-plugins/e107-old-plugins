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
// thanks to Steved for the enhancements to specify which fields to notify on.
include_lan(e_PLUGIN . 'user_changed/languages/admin/' . e_LANGUAGE . '.php');
if (!defined('e107_INIT'))
{
    exit;
}

$e_event->register("postuserset", "user_changed_postuserset");

function user_changed_postuserset($data)
{

    global $tp, $sql, $e107cache,$e_event, $currentUser, $pref;

    if (is_array($data))
    {
// if not an array then skip it
		if (isset($pref['user_changed_fields']) && is_array($pref['user_changed_fields']))
		{

			$changes = array();
			foreach($pref['user_changed_fields'] as $k => $v)
			{
				if (substr($k,0,3) == 'ue#')
				{
					$newData  = $tp->toDB($data['ue'][substr($k,3)]);
				}
				else
				{
					$newData = $tp->toDB($data[$k]);
				}
				if ($newData <> $currentUser[$v])
				{
					$changes[$v] = $newData;
//				$logfp = fopen(e_FILE.'cache/user_change.txt', 'a+'); fwrite($logfp, 'Changed: '.$currentUser[$v].'=>'.$newData."\n"); fclose($logfp);
				}
			}
			if (count($changes))
			{
//				$logfp = fopen(e_FILE.'cache/user_change.txt', 'a+');	fwrite($logfp, serialize($data)."\n"); fclose($logfp);
				$changes['changed_UID'] = USERID;
				$changes['changed_user'] = USERNAME;
				if (USERID != $data['user_id'])
				{
					$changes['user_id'] = $data['user_id'];
					$changes['user_name'] = $data['username'];
				}
				$e_event->trigger('user_changed', $changes);
			}
		}
		else
		{	// Trigger on all changes
			$e_event->trigger('user_changed', $data);
		}
    }
}
?>