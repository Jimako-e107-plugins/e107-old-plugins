<?php
if (!defined('e107_INIT')) { exit; }

if (file_exists(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/lan_chatbox2_search.php")) {
	include_once(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/lan_chatbox2_search.php");
} else {
	include_once(e_PLUGIN."chatbox2_menu/languages/English/lan_chatbox2_search.php");
}

$search_info[] = array('sfile' => e_PLUGIN.'chatbox2_menu/search/search_parser.php', 'qtype' => CB2_SCH_LAN_1, 'refpage' => 'chat2.php', 'advanced' => e_PLUGIN.'chatbox2_menu/search/search_advanced.php');
?>