<?php
if (!defined('e107_INIT')) { exit; }    
require_once(e_PLUGIN."ebattles/include/main.php");

$advanced_where = "";

// The fields that will be returned by the SQL
$return_fields = 'ClanID, Name';
// The fields that can be search for matches
$search_fields = array('Name');
// A weighting for the importance of finding a match in each of the search fields
$weights = array('1.2', '0.8');
// Message to be displayed when no matches found
$no_results = LAN_198;
// The SQL WHERE clause, if any
$where = "1 AND";
// The SQL ORDER BY columns as a keyed array
$order = array('ClanID' => DESC);
// The table(s) to be searched
$table = TBL_CLANS_SHORT;

// Perform the search
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_ebattles', $no_results, $where, $order);
// Assign the results to specific variables
$text .= $ps['text'];
$results = $ps['results'];

// A callback function (name is passed to the parsesearch() function above)
// It is passed a single row from the DB result set
function search_ebattles($row) {
	$res['link'] = e_PLUGIN."ebattles/claninfo.php?clanid=".$row['ClanID'];
	$res['pre_title'] = "";
	$res['title'] = $row['Name'];
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
	$res['pre_summary'] .= "pre summary here";
	$res['pre_summary'] .= "</div>";
	$res['summary'] = "summary here";
	$res['detail'] = "details here";
	return $res;
}
?> 

 
