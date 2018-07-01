<?php
/*
--------------------------------------------------------------------------------

	Title: ClanSystem
	$Author: kamers $
	$Date: 2007-03-21 23:33:09 -0400 (Wed, 21 Mar 2007) $
	Version: 0.1
	$Revision: 7 $
	Description: Complete Clan Management Plugin

--------------------------------------------------------------------------------
*/

require_once("clansystem_def.php");
require_once(e_ADMIN."auth.php");

include(CS_DEF_LANFILE);

$buttons = array();

$buttons['index']['link'] = "admin_index.php";
$buttons['index']['text'] = CS_ADM_MENU_2;

$buttons['perms']['link'] = "admin_perms.php";
$buttons['perms']['text'] = CS_ADM_MENU_3;

$currFile = basename($_SERVER['REQUEST_URI']);
foreach ($buttons as $pageID => $pageInfo)
{
	if (basename($pageInfo['link']) == $currFile)
	{
		$currPageID = $pageID;
		break;
	}
}

show_admin_menu(CS_ADM_MENU_1, $currPageID, $buttons);

?>
