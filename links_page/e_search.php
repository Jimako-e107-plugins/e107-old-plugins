<?php
if (!defined('e107_INIT')) { exit; }

	if (file_exists(e_PLUGIN."links_page/languages/".e_LANGUAGE.".php")) {
		include_once(e_PLUGIN."links_page/languages/".e_LANGUAGE.".php");
	} else {
		include_once(e_PLUGIN."links_page/languages/English.php");
	}
$search_info[] = array('sfile' => e_PLUGIN.'links_page/search/search_parser.php', 'qtype' => LCLAN_ADMIN_14, 'refpage' => 'links.php', 'advanced' => e_PLUGIN.'links_page/search/search_advanced.php');

?>