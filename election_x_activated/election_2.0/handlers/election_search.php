<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/handlers/election_search.php,v $
| $Revision: 1.2 $
| $Date: 2006/12/31 18:42:46 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include election handlers
require_once(e_PLUGIN."election/handlers/election_constants.php");

$advanced_where = "";

$return_fields = "election_id, election_name, election_description, election_owner, election_candidate_id, election_candidate_election_ids, election_candidate_name, election_candidate_title, election_candidate_description, election_candidate_link_url, election_candidate_link_description";
$search_fields = array("election_name", "election_description", "election_candidate_name", "election_candidate_title", "election_candidate_description");
$weights = array("1.2", "0.8", "1.2", "1.0", "0.8");
$no_results = LAN_198;
$where = "";
$where = "1 and".$advanced_where;
$order = array('election_candidate_id' => DESC);
$table = ELECC_CANDIDATES_TABLE." left join #".ELECC_ELECTIONS_TABLE." on election_candidate_election_ids=election_id";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_election', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_election($row) {
   global $pref;
	global $con;

	$res['link'] = e_PLUGIN."election/election.php?".ELECC_CANDIDATE_PAGE.".".$row["election_candidate_id"];
	$res['pre_title'] = "";
	$res['title'] = $row["election_candidate_name"]." : ".$row["election_candidate_title"];
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
	$res['pre_summary'] .= "<a href='".e_PLUGIN."election/election.php'>".ELEC_LAN_ELECTION."</a>";
	$res['pre_summary'] .= $pref["election_separator"];
	$res['pre_summary'] .= "<a href='".e_PLUGIN."election/election.php?".ELECC_CANDIDATES_PAGE.".".$row["election_id"]."'>".$row['election_name']."</a>";
	$res['pre_summary'] .= "</div>";
	$res['summary'] = $row["election_candidate_description"];
	$res['detail'] = "<a href='".$row['election_candidate_link_url']."'>".$row['election_candidate_link_description']."</a>";
	return $res;
}

