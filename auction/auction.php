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
| $Source: e:\_repository\e107_plugins/auction/auction.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/05 00:11:51 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

// Check global permissions before doing anything
if (!(check_class($pref["auction_view_class"]))) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}

// Required files
require_once(e_PLUGIN."auction/handlers/auction_class.php");
require_once(AUCC_HANDLERS_DIR."/auction_utils.php");

// Generate the page
$page = $auction->generatePage();
require_once(HEADERF);
echo "<div id='auction_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = e_PLUGIN_ABS."auction/auction.js";
require_once(FOOTERF);
?>