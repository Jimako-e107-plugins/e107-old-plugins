<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Admin Menu Plugin File :  e107_plugins/lightbox/admin_menu.php
|        Email: support@free-source.net
|        $Revision: 292 $
|        $Date: 2007-02-12 23:22:29 +0200 (Mon, 12 Feb 2007) $
|        $Author: secretr $
|        Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Support Sites : http://www.free-source.net/ | http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/

	$menutitle = IM_LAN_5;//"Menu Title";

	$butname[] = IM_LAN_6;//config
	$butlink[] = "admin_config.php";  
	$butid[] = "config"; 
	
	$butname[] = IM_LAN_7;//help
	$butlink[] = "admin_readme.php";  
	$butid[] = "help"; 

global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);

?>
