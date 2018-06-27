<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Notify: e107_plugins/sgallery/e_notify.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/

/*!!! UNDER CONSTRUCTION !!!*/
if(!defined('e107_INIT')) exit;

if(defined('ADMIN_PAGE') && ADMIN_PAGE === true) {
    include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');

    $config_category = SGAL_NOTIFY_1;
    //'sgal_picsbm' => SGAL_NOTIFY_3, 'sgal_itemsapp' => SGAL_NOTIFY_4
    $config_events = array('sgal_albumsbm' => SGAL_NOTIFY_2);
}

if (!function_exists('notify_sgal_albumsbm')) {
	function notify_sgal_albumsbm($data) {
		global $nt;
		include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');
		$message = '';
		foreach ($data as $value) {
			$message .= $value.'<br />';
		}
		
        $nt -> send('sgal_albumsbm', SGAL_NOTIFY_5, $message);
	}
}
/* - mail on every picture upload?! TO DO - think out something clever here
if (!function_exists('notify_sgal_picsbm')) {
	function notify_sgal_picsbm(&$data) {
		global $nt;
		include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');
		foreach ($data as $key => $value) {
			$message .= $key.': '.$value.'<br />';
		}
		$nt -> send('sgal_picsbm', SGAL_NOTIFY_6, $message);
	}
}
*/

?>