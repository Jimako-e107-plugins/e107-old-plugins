<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/sites/AGB.php $
|		$Revision: 1.00 $
|		$Date: 2008/07/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/produktlist_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."my_little_shop/languages/German/produktlist_lan.php");

// ============= START OF THE BODY ====================================

		$text ="<div style='width:100%;padding:10px;'>";
		$text.=	$tp->toHTML($pref['my_little_shop_AGB'], TRUE);
		$text.=	"</div>";
    $title= "Algemeine Geschäftsbedinungen";    
    $ns -> tablerender($title, $text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
/// Eigene Functionen ----------------------------------
?>
