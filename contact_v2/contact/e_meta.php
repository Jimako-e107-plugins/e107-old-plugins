<?php
/*
+---------------------------------------------------------------+
|        Inbox Email - v 2 by Mohamed Anouar Achoukhy
|        only for e107 website system
|        http://e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

	if ($pref['contact_plugin_enable'] == 1) 
	{ 
		if(isset($_POST['send-contactus'])) 
			{
			$FOOTER  .= "{CONTACT}";
			}
	}			
?>