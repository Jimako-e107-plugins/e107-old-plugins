<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_search.php,v $
| $Revision: 1.1.2.3 $
| $Date: 2006/11/12 20:02:55 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include bugtracker handlers
require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_constants.php");

$advanced_where = "";

$return_fields = "bugtracker3_bugs_id, bugtracker3_bugs_timestamp, bugtracker3_bugs_summary, bugtracker3_bugs_poster, bugtracker3_bugs_description, bugtracker3_apps_id, bugtracker3_apps_name";
$search_fields = array("bugtracker3_bugs_summary", "bugtracker3_bugs_description");
$weights = array("1.2", "0.6");
$no_results = LAN_198;
$where = "";
$where = "(bugtracker3_apps_owner = ".USERID." or bugtracker3_apps_userclass REGEXP '".e_CLASS_REGEXP."' or bugtracker3_apps_editclass REGEXP '".e_CLASS_REGEXP."' or bugtracker3_apps_postclass REGEXP '".e_CLASS_REGEXP."') and".$advanced_where;
$order = array('bugtracker3_bugs_update_timestamp' => DESC);
$table = BUGC_BUGS_TABLE." left join #".BUGC_APPS_TABLE." on bugtracker3_bugs_application_id=bugtracker3_apps_id";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_bugtracker3', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_bugtracker3($row) {
   global $pref;
	global $con;

	//$user = getx_user_data($row["bugtracker3_bugs_poster"]);
	$user = e107::user($row["bugtracker3_bugs_poster"]);
	$datestamp = $con->convert_date($row['bugtracker3_bugs_timestamp'], "long");

	$res['link'] = e_PLUGIN."bugtracker3/bugtracker3.php?".BUGC_BUG_PAGE.".".$row["bugtracker3_bugs_id"];
	$res['pre_title'] = "";
	$res['title'] = $row["bugtracker3_bugs_summary"];
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
	$res['pre_summary'] .= "<a href='".e_PLUGIN."bugtracker3/bugtracker3.php'>".$pref["bugtracker3_pagetitle"]."</a>";
	$res['pre_summary'] .= $pref["bugtracker3_separator"];
	$res['pre_summary'] .= "<a href='".e_PLUGIN."bugtracker3/bugtracker3.php?".BUGC_BUGS_PAGE.".".$row["bugtracker3_apps_id"]."'>".$row['bugtracker3_apps_name']."</a>";
	$res['pre_summary'] .= "</div>";
	$res['summary'] = $row["bugtracker3_bugs_description"];
	$res['detail'] = LAN_SEARCH_7."<a href='user.php?id.".$row['bugtracker3_bugs_poster']."'>".$user['user_name']."</a>".LAN_SEARCH_8.$datestamp;
	return $res;
}

?>