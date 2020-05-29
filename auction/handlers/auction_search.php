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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_search.php,v $
| $Revision: 1.2 $
| $Date: 2006/12/06 00:00:31 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include auction handlers
require_once(e_PLUGIN."auction/handlers/auction_constants.php");

$advanced_where = "";

$return_fields = "auction_lot_id, auction_lot_auction_id, auction_lot_title, auction_lot_description, auction_lot_update_timestamp, auction_lot_poster_id, auction_id, auction_name";
$search_fields = array("auction_lot_title", "auction_lot_description");
$weights = array("1.2", "0.8");
$no_results = LAN_198;
$where = "";
$where = "1 and".$advanced_where;
$order = array('auction_lot_update_timestamp' => DESC);
$table = AUCC_LOTS_TABLE." left join #".AUCC_AUCTIONS_TABLE." on auction_lot_auction_id=auction_id";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_auction', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_auction($row) {
   global $pref;
	global $con;

	$user = get_user_data($row["auction_lot_poster_id"]);
	$datestamp = $con->convert_date($row['auction_lot_update_timestamp'], "long");

	$res['link'] = e_PLUGIN."auction/auction.php?".AUCC_LOT_PAGE.".".$row["auction_lot_id"];
	$res['pre_title'] = "";
	$res['title'] = $row["auction_lot_title"];
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
	$res['pre_summary'] .= "<a href='".e_PLUGIN."auction/auction.php'>".AUC_LAN_AUCTION."</a>";
	$res['pre_summary'] .= $pref["auction_separator"];
	$res['pre_summary'] .= "<a href='".e_PLUGIN."auction/auction.php?".AUCC_LOTS_PAGE.".".$row["auction_id"]."'>".$row['auction_name']."</a>";
	$res['pre_summary'] .= "</div>";
	$res['summary'] = $row["auction_lot_description"];
	$res['detail'] = LAN_SEARCH_7."<a href='user.php?id.".$row['auction_lot_poster_id']."'>".$user['user_name']."</a>".LAN_SEARCH_8.$datestamp;
	return $res;
}

?>