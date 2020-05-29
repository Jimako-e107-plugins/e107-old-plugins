<?php
$advanced_where = "";

// The fields that will be returned by the SQL
$return_fields = "players_id, players_name, players_description
";

// The fields that can be search for matches
$search_fields = array("players_name", 
                       "players_description", 
                       "players_admin_id", 
                       "players_burthday", 
                       "players_name");

// A weighting for the importance of finding a match in each of the search fields
$weights = array("1.2", "0.8", "1.2", "1.0", "0.8");

// Message to be displayed when no matches found
$no_results = LAN_198;

// The SQL WHERE clause, if any
$where = "1 and".$advanced_where;

// The SQL ORDER BY columns as a keyed array
$order = array('players_name' => DESC);

// The table(s) to be searched
$table = "league_players 
   left join #".ELECC_ELECTIONS_TABLE." on election_candidate_election_ids=election_id";

// Perform the search
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 
                        'search_election', $no_results, $where, $order);

// Assign the results to specific variables
$text .= $ps['text'];
$results = $ps['results'];

// A callback function (name is passed to the parsesearch() function above)
// It is passed a single row from the DB result set
function search_election($row) {
   global $pref;
   global $con;

   // Populate as many of the $res array keys as is sensible for the plugin
   $res['link'] = e_PLUGIN."sport_league_e107/election.php?".ELECC_CANDIDATE_PAGE.".".$row["election_candidate_id"];
   $res['pre_title'] = "";
   $res['title'] = $row["election_candidate_name"]." : ".$row["election_candidate_title"];
   $res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
   $res['pre_summary'] .= "<a href='".e_PLUGIN."sport_league_e107/election.php'>".ELEC_LAN_ELECTION."</a>";
   $res['pre_summary'] .= $pref["election_separator"];
   $res['pre_summary'] .= "<a href='".e_PLUGIN."sport_league_e107/election.php?".ELECC_CANDIDATES_PAGE.".".$row["election_id"]."'>".$row['election_name']."</a>";
   $res['pre_summary'] .= "</div>";
   $res['summary'] = $row["election_candidate_description"];
   $res['detail'] = "<a href='".$row['election_candidate_link_url']."'>".$row['election_candidate_link_description']."</a>";
   return $res;
}
?> 