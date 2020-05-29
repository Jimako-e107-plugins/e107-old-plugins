<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/auction_summary_menu.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/05 00:11:51 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Required files
require_once(e_PLUGIN."auction/handlers/auction_class.php");
require_once(AUCC_HANDLERS_DIR."/auction_utils.php");

global $auction;
unset($text);
$text = $auction->getMenu();
$text[1] = "<div id='auction_summary_menu_content'>".$text[1]."</div>";
$ns->tablerender($text[0], $text[1]);
unset($text);
?>