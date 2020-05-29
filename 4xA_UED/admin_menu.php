<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|		$Revision: 0.87 $
|		$Date: 29.09.2011 10:34
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."4xA_UED/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_UED/languages/German.php");

	$menutitle = LAN_4xA_UED_056; 

	$butname[] = LAN_4xA_UED_057;  // Saisons
	$butlink[] = "admin_config.php";
	$butid[] = "admin_userlist";

	$butname[] = LAN_4xA_UED_058;  // Ligen
	$butlink[] = "admin_config_fields.php";
	$butid[] = "admin_userfields_pref";

//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};
show_admin_menu($menutitle,$pageid, $var );
	
?> 
