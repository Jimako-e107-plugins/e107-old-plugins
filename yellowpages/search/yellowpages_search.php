<?php
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/search/yellowpages_search.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:14 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
$advanced_where = "1=1";

switch ($_GET['match']) {
   case 1  : $search_fields = array("yell_name"); break;
   case 2  : $search_fields = array("yell_description"); break;
   default : $search_fields = array("yell_name", "yell_description"); break;
}

$return_fields = "yell_id, yell_name, yell_description, yell_cat_id, yell_cat_name";
$weights = array("0.8", "1.2");
$no_results = LAN_198;
$where = "";
$order = array('yell_name' => DESC);
$table = YELP_CATEGORIES_TABLE." left join #".YELP_ITEMS_TABLE." on yell_cat_id=yell_category";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_yellowpages', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_yellowpages($row) {
	global $con, $pref, $tp;

	$res['link'] = e_PLUGIN."yellowpages/yellowpages.php?".YELP_ITEM_PAGE.".".$row["yell_id"];
	$res['pre_title'] = "";
	$res['title'] = $row["yell_name"];
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
	$res['pre_summary'] .= "<a href='".e_PLUGIN."yellowpages/yellowpages.php'>".YELP_LAN_YELLOWPAGES."</a>";
	$res['pre_summary'] .= $pref["yellowpages_separator"];
	$res['pre_summary'] .= "<a href='".e_PLUGIN."yellowpages/yellowpages.php?".YELP_CATEGORIES_PAGE.".".$row["yell_cat_id"]."'>".$row['yell_cat_name']."</a>";
	$res['pre_summary'] .= "</div>";
	$res['summary'] = $row["yell_description"];
	$res['detail'] = "";
	return $res;
}

?>