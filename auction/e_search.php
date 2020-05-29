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
| $Source: e:\_repository\e107_plugins/auction/e_search.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/05 00:11:51 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include auction handlers
require_once(e_PLUGIN."auction/handlers/auction_constants.php");
$search_info[] = array(
   'sfile'     => e_PLUGIN.'auction/handlers/auction_search.php',
   'qtype'     => AUC_LAN_AUCTION,
   'refpage'   => 'auction.php',
	'id'        => 'auction'
);
?>
