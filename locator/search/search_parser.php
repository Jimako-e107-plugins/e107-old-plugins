<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
	$search_fields = array('locator_client', 'locator_address1', 'locator_address2', 'locator_address3', 'locator_zipcode', 'locator_city', 'locator_county', 'locator_state', 'locator_country');

// basic
$return_fields = 'locator_client, locator_address1, locator_address2, locator_address3, locator_zipcode, locator_city, locator_county, locator_state, locator_country, locator_catid';
$weights = array('1.2', '1.0', '0.1', '0.1', '0.1', '0.1', '0.1', '0.1', '0.1', '0.1');
$no_results = LAN_198;
$where = "locator_active_status=2 AND "; // Thanks Father Barry! (e107 forum topic 140979)
$order = array('locator_id' => DESC);

$ps = $sch -> parsesearch('locator_sites', $return_fields, $search_fields, $weights, 'search_locator', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_locator($row) {
	global $con;
	$res['link'] = e_PLUGIN."locator/locator.php?cat.".$row['locator_catid'];
	$res['pre_title'] = "";
	$res['title'] = $row['locator_client']." ".$row['locator_address1'];
	$res['summary'] = $row['locator_zipcode']." ".$row['locator_city'];
	$res['detail'] = "";
	return $res;
}
?>