<?php
/**
* matchreport.php
*
* This page is for users to edit their account information
* such as their password, email address, etc. Their
* usernames can not be edited. When changing their
* password, they must first confirm their current password.
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN.'ebattles/include/match.php');
require_once(e_PLUGIN."ebattles/include/event.php");
require_once(e_PLUGIN."ebattles/include/clan.php");

/*******************************************************************
********************************************************************/
// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg = "match_comment";  // set $e_wysiwyg before including HEADERF

$event_id = intval($_GET['eventid']);
$match_id = intval($_GET['matchid']);
$action = eb_sanitize($_GET['actionid']);
if(!$event_id)
{
	header("Location: ./events.php");
	exit();
}

$event = new Event($event_id);
$type = $event->getField('Type');
$competition_type = $event->getCompetitionType();
$matchtype = $event->getField('MatchType');

//------------ event permissions --------------
$event_permissions = $event->get_permissions(USERID);
$userclass = $event_permissions['userclass'];
$can_report = $event_permissions['can_report'];
$can_schedule = $event_permissions['can_schedule'];

switch($event->getMatchPlayersType())
{
case 'Players':
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*, "
	.TBL_GAMERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	." AND (".TBL_PLAYERS.".Banned != 1)"
	." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	." ORDER BY ".TBL_GAMERS.".UniqueGameID";

	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
	
	$user_player = 0;
	$players_id[0] = EB_MATCHR_L1;
	$players_uid[0] = EB_MATCHR_L1;
	$players_name[0] = EB_MATCHR_L1;
	for($i=0; $i<$num_rows; $i++){
		$pid  = mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
		$puid  = mysql_result($result,$i, TBL_USERS.".user_id");
		$prank  = mysql_result($result,$i, TBL_PLAYERS.".Rank");
		$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
		$gamer = new Gamer($gamer_id);
		$pname = $gamer->getField('Name');
		$pteam  = mysql_result($result,$i, TBL_PLAYERS.".Team");
		list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
		if($competition_type == 'Tournament')
		{
			$prank_txt = '';
		}
		else
		{
			if ($prank==0)
			$prank_txt = EB_EVENT_L54;
			else
			$prank_txt = "#$prank";
			
			$prank_txt = " ($prank_txt)";
		}

		$players_id[$i+1] = $pid;
		$players_uid[$i+1] = $puid;
		$players_name[$i+1] = $pclantag.$pname.$prank_txt;

		if($puid == USERID)
		{
			$user_player = $pid;
		}
	}
	break;
case 'Teams':
	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_DIVISIONS.".* "
	." FROM ".TBL_CLANS.", "
	.TBL_TEAMS.", "
	.TBL_DIVISIONS
	." WHERE (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_TEAMS.".Event = '$event_id')"
	." ORDER BY ".TBL_CLANS.".Name";

	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);

	$players_id[0] = EB_MATCHR_L1;
	$players_uid[0] = EB_MATCHR_L1;
	$players_name[0] = EB_MATCHR_L1;
	for($i=0; $i<$num_rows; $i++){
		$pid  = mysql_result($result,$i, TBL_TEAMS.".TeamID");
		$puid  = mysql_result($result,$i, TBL_TEAMS.".TeamID");
		$prank  = mysql_result($result,$i, TBL_TEAMS.".Rank");
		$pname  = mysql_result($result,$i, TBL_CLANS.".Name");
		if($competition_type == 'Tournament')
		{
			$prank_txt = '';
		}
		else
		{
			if ($prank==0)
			$prank_txt = EB_EVENT_L54;
			else
			$prank_txt = "#$prank";
			
			$prank_txt = " ($prank_txt)";
		}

		$players_id[$i+1] = $pid;
		$players_uid[$i+1] = $puid;
		$players_name[$i+1] = $pname.$prank_txt;
	}
	break;
default:
}

$text .= '
<div class="spacer" id="matchreportcontainer">
';

// Set rank/draw based on result
if(isset($_POST['result']))
{
	switch($_POST['result'])
	{
	case "1":
		// T1 won
		if (!isset($_POST['rank1'])) $_POST['rank1'] = 'Team #1';
		if (!isset($_POST['rank2'])) $_POST['rank2'] = 'Team #2';
		break;
	case "2":
		// T2 won
		if (!isset($_POST['rank1'])) $_POST['rank1'] = 'Team #2';
		if (!isset($_POST['rank2'])) $_POST['rank2'] = 'Team #1';
		break;
	case "3":
		// draw
		if (!isset($_POST['rank1'])) $_POST['rank1'] = 'Team #1';
		if (!isset($_POST['rank2'])) $_POST['rank2'] = 'Team #2';
		if (!isset($_POST['draw2'])) $_POST['draw2'] = 1;
		break;
	case "4":
		// T1 forfeit
		if (!isset($_POST['rank1'])) $_POST['rank1'] = 'Team #2';
		if (!isset($_POST['rank2'])) $_POST['rank2'] = 'Team #1';
		if (!isset($_POST['forfeit2'])) $_POST['forfeit2'] = 1;
		break;
	case "5":
		// T2 forfeit
		if (!isset($_POST['rank1'])) $_POST['rank1'] = 'Team #1';
		if (!isset($_POST['rank2'])) $_POST['rank2'] = 'Team #2';
		if (!isset($_POST['forfeit2'])) $_POST['forfeit2'] = 1;
		break;
	}
}

if($match_id)
{
	$match = new Match($match_id);

	//------------ event permissions --------------
	$match_permissions = $match->get_permissions(USERID);
	$can_report_scheduled = $match_permissions['can_report'];
	$can_edit = $match_permissions['can_edit'];

	// If match_id is not null, fill up the form information from the database
	switch($event->getMatchPlayersType())
	{
	case 'Players':
		$q = "SELECT ".TBL_MATCHS.".*, "
		.TBL_SCORES.".*, "
		.TBL_PLAYERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS.", "
		.TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
		." ORDER BY ".TBL_SCORES.".Player_Rank, ".TBL_SCORES.".Player_MatchTeam";
		break;
	case 'Teams':
		$q = "SELECT ".TBL_MATCHS.".*, "
		.TBL_SCORES.".*, "
		.TBL_CLANS.".*, "
		.TBL_TEAMS.".*, "
		.TBL_DIVISIONS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_CLANS.", "
		.TBL_TEAMS.", "
		.TBL_DIVISIONS
		." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
		." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
		." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
		." ORDER BY ".TBL_SCORES.".Player_Rank, ".TBL_SCORES.".Player_MatchTeam";
		break;
	default:
	}

	$result = $sql->db_Query($q);
	$numScores = mysql_numrows($result);

	if (!isset($_POST['nbr_players']))   $_POST['nbr_players'] = $numScores;
	if (!isset($_POST['reported_by'])&&($action!='matchscheduledreport'))   $_POST['reported_by'] = mysql_result($result,0, TBL_MATCHS.".ReportedBy");
	if (!isset($_POST['match_comment'])) $_POST['match_comment'] = mysql_result($result,0, TBL_MATCHS.".Comments");
	if (!isset($_POST['time_reported'])) $_POST['time_reported'] = mysql_result($result,0, TBL_MATCHS.".TimeReported");

	$time_scheduled = mysql_result($result,0, TBL_MATCHS.".TimeScheduled");
	$time_scheduled_local = $time_scheduled + TIMEOFFSET;
	$date_scheduled = date("m/d/Y h:i A",$time_scheduled_local);
	if (!isset($_POST['date_scheduled'])) $_POST['date_scheduled'] = $date_scheduled;
	
	$matchMaps = explode(",", mysql_result($result,0, TBL_MATCHS.".Maps"));
	$map = 0;
	foreach($matchMaps as $matchMap)
	{
		if (!isset($_POST['map'.$map]))           $_POST['map'.$map] = $matchMap;
		$map++;
	}

	$index = 1;
	$rank = 0;
	$matchteam = 0;
	$nbr_teams = 0;
	for($score=0;$score < $numScores;$score++)
	{
		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$pid  = mysql_result($result,$score, TBL_PLAYERS.".PlayerID");
			$puid  = mysql_result($result,$score, TBL_USERS.".user_id");
			$gamer_id = mysql_result($result,$score, TBL_PLAYERS.".Gamer");
			$gamer = new Gamer($gamer_id);
			$pname = $gamer->getField('Name');
			$pavatar = mysql_result($result,$score, TBL_USERS.".user_image");
			$pteam  = mysql_result($result,$score, TBL_PLAYERS.".Team");
			list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
			break;
		case 'Teams':
			$pid  = mysql_result($result,$score, TBL_TEAMS.".TeamID");
			$pname  = mysql_result($result,$score, TBL_CLANS.".Name");
			$pavatar = mysql_result($result,$score, TBL_CLANS.".Image");
			$pteam  = mysql_result($result,$score, TBL_TEAMS.".TeamID");
			list($pclan, $pclantag, $pclanid) = getClanInfo($pteam); // Use this function to get other clan info like clan id?
			break;
		default:
		}
		$pscoreid  = mysql_result($result,$score, TBL_SCORES.".ScoreID");
		$prank  = mysql_result($result,$score, TBL_SCORES.".Player_Rank");
		$pMatchTeam  = mysql_result($result,$score, TBL_SCORES.".Player_MatchTeam");
		$pdeltaELO  = mysql_result($result,$score, TBL_SCORES.".Player_deltaELO");
		$pdeltaTS_mu  = mysql_result($result,$score, TBL_SCORES.".Player_deltaTS_mu");
		$pdeltaTS_sigma  = mysql_result($result,$score, TBL_SCORES.".Player_deltaTS_sigma");
		$pdeltaG2_mu  = mysql_result($result,$score, TBL_SCORES.".Player_deltaG2_mu");
		$pdeltaG2_phi  = mysql_result($result,$score, TBL_SCORES.".Player_deltaG2_phi");
		$pdeltaG2_sigma  = mysql_result($result,$score, TBL_SCORES.".Player_deltaG2_sigma");
		$pscore  = mysql_result($result,$score, TBL_SCORES.".Player_Score");
		$pOppScore  = mysql_result($result,$score, TBL_SCORES.".Player_ScoreAgainst");
		$ppoints  = mysql_result($result,$score, TBL_SCORES.".Player_Points");
		$pfaction  = mysql_result($result,$score, TBL_SCORES.".Faction");
		$pforfeit  = mysql_result($result,$score, TBL_SCORES.".Player_Forfeit");

		if ($pMatchTeam > $nbr_teams) $nbr_teams = $pMatchTeam;
		
		if($puid == USERID)
		{
			$user_player = $pid;
			$user_rank = $prank;
		}

		$i = $score + 1;
		if (!isset($_POST['team'.$i]))    $_POST['team'.$i] = 'Team #'.$pMatchTeam;
		if (!isset($_POST['player'.$i]))  $_POST['player'.$i] = $pid;
		if (!isset($_POST['score'.$i]))   $_POST['score'.$i] = $pscore;
		if (!isset($_POST['faction'.$i])) $_POST['faction'.$i] = $pfaction;
		
		//echo "$pname $i: ".$_POST['team'.$i]."<br>";

		if ($pMatchTeam != $matchteam)
		{
			if (!isset($_POST['rank'.$index])) $_POST['rank'.$index] = 'Team #'.$pMatchTeam;
			if(($prank == $rank)&&($prank!=0))
			{
				if (!isset($_POST['draw'.$index])) $_POST['draw'.$index] = 1;
			}
			else
			{
				$rank++;
			}
			if($pforfeit == 1)
			{
				if (!isset($_POST['forfeit'.$index])) $_POST['forfeit'.$index] = 1;
			}
			$matchteam = $pMatchTeam;
			$index++;
		}
	}
	if (!isset($_POST['nbr_teams'])) $_POST['nbr_teams'] = $nbr_teams;
}
//[dbg]$text .= "--$matchtype--";

if(preg_match("/^\d+v\d+$/", $matchtype)||
   ($event->getField('FixturesEnable') == TRUE))
{
	$matchreport_type = 'versus';
	$nbr_teams = 2;
	if (!isset($_POST['nbr_teams'])) $_POST['nbr_teams'] = $nbr_teams;
	
	$nbr_players = 2;
	if(preg_match("/^\d+v\d$/", $matchtype))
	{
		$array = explode('v', $matchtype);
		
		if($array[0] == $array[1])
		{
			$nbr_players = 2*$array[0];
		}
	}
	if (!isset($_POST['nbr_players'])) $_POST['nbr_players'] = $nbr_players;
	require_once(e_PLUGIN.'ebattles/matchreport_versus_form.php');
}
else if(preg_match("/FFA/", $matchtype))
{
	$matchreport_type = 'FFA';
	require_once(e_PLUGIN.'ebattles/matchreport_ffa_form.php');
}
else
{
	$matchreport_type = 'ranked';
	require_once(e_PLUGIN.'ebattles/matchreport_functions.php');
}

// has the form been submitted?
if (isset($_POST['submit_match']))
{
	// the form has been submitted
	// perform data checks.
	$error_str = ''; // initialise $error_str as empty

	$reported_by = $_POST['reported_by'];
	$userclass = $_POST['userclass'];
	$time_reported = $_POST['time_reported'];

	//$text .= "reported by: $reported_by<br />";

	$comments = $tp->toDB($_POST['match_comment']);

	$nbr_players = $_POST['nbr_players'];
	$nbr_teams = $_POST['nbr_teams'];
	$reporterIsPlaying = 0;
	$reporterIsCaptain = 0;
	$reporterIsTeamMember = 0;
	// Map
	// List of all Maps
	$q_Maps = "SELECT ".TBL_MAPS.".*"
	." FROM ".TBL_MAPS
	." WHERE (".TBL_MAPS.".Game = '".$event->getField('Game')."')";
	$result_Maps = $sql->db_Query($q_Maps);
	$numMaps = mysql_numrows($result_Maps);
	$map = '';
	for ($matchMap = 0; $matchMap<min($numMaps, $event->getField('MaxMapsPerMatch')); $matchMap++)
	{
		if (!isset($_POST['map'.$matchMap])) $_POST['map'.$matchMap] = '0';
		if ($matchMap > 0) $map .= ',';
		$map .= $_POST['map'.$matchMap];
	}

	for($i=1;$i<=$nbr_players;$i++)
	{
		$pid = $_POST['player'.$i];
		$pMatchTeam = $_POST['team'.$i];

		// Check if a player is not selected
		if ($pid == $players_name[0])
		$error_str .= '<li>'.EB_MATCHR_L2.$i.'&nbsp;'.EB_MATCHR_L3.'</li>';

		// Check if a score is not a number
		if (!isset($_POST['score'.$i])) $_POST['score'.$i] = 0;
		if(!preg_match("/^\d+$/", $_POST['score'.$i]))
		$error_str .= '<li>'.EB_MATCHR_L12.$i.'&nbsp;'.EB_MATCHR_L13.'&nbsp;'.$_POST['score'.$i].'</li>';

		// Faction
		if (!isset($_POST['faction'.$i])) $_POST['faction'.$i] = 0;

		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$q =
			"SELECT ".TBL_USERS.".*, "
			.TBL_PLAYERS.".*"
			." FROM ".TBL_USERS.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS
			." WHERE (".TBL_PLAYERS.".PlayerID = '$pid')"
			."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			."   AND (".TBL_GAMERS.".User     = ".TBL_USERS.".user_id)";
			$result = $sql->db_Query($q);
			$row = mysql_fetch_array($result);
			$puid = $row['user_id'];
			$pTeam = $row['Team'];

			if ($puid == $reported_by) $reporterIsPlaying = 1;
			
			// If winner report, check if reporter's rank is 1
			// Note: not if reporter is owner/mods/admins
			if(($event->getField('match_report_userclass') == eb_UC_MATCH_WINNER)
			&& ($userclass == eb_UC_EVENT_PLAYER)
			&& ($puid == $reported_by))
			{
				if($_POST['rank1'] != $pMatchTeam)
					$error_str .= '<li>'.EB_MATCHR_L72.'</li>'.$_POST['rank1']." ".$pMatchTeam;
			}

			// Check if 2 players are the same user
			// Check if 2 players of same team are playing against each other
			for($j=$i+1;$j<=$nbr_players;$j++)
			{
				//if ($_POST['player'.$i] == $_POST['player'.$j])
				$pjid = $_POST['player'.$j];
				$q =
				"SELECT ".TBL_USERS.".*, "
				.TBL_PLAYERS.".*"
				." FROM ".TBL_USERS.", "
				.TBL_PLAYERS.", "
				.TBL_GAMERS
				." WHERE (".TBL_PLAYERS.".PlayerID = '$pjid')"
				." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
				."   AND (".TBL_GAMERS.".User   = ".TBL_USERS.".user_id)";
				$result = $sql->db_Query($q);
				$row = mysql_fetch_array($result);
				$pjuid = $row['user_id'];
				$pjTeam = $row['Team'];
				$pjMatchTeam = $_POST['team'.$j];

				if ($puid == $pjuid)
				$error_str .= '<li>'.EB_MATCHR_L4.$i.'&nbsp;'.EB_MATCHR_L5.$j.'</li>';
				if (($pTeam == $pjTeam)&&($pMatchTeam != $pjMatchTeam)&&($pTeam != 0))
				$error_str .= '<li>'.EB_MATCHR_L6.$i.'&nbsp;'.EB_MATCHR_L7.$j.' '.EB_MATCHR_L8.'</li>';
			}
			break;
		case 'Teams':
			// Check if user is the team captain
			// Check if user is a team's member
			$q = "SELECT ".TBL_DIVISIONS.".*, "
			.TBL_MEMBERS.".*, "
			.TBL_TEAMS.".*"
			." FROM ".TBL_DIVISIONS.", "
			.TBL_MEMBERS.", "
			.TBL_TEAMS
			." WHERE (".TBL_DIVISIONS.".DivisionID = ".TBL_TEAMS.".Division)"
			." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
			." AND (".TBL_TEAMS.".TeamID = '$pid')";
			$result = $sql->db_Query($q);
			$numMembers = mysql_numrows($result);
			for($member=0; $member < $numMembers; $member++)
			{
				$muid  = mysql_result($result,$member, TBL_MEMBERS.".User");
				$dcaptain  = mysql_result($result,$member, TBL_DIVISIONS.".Captain");

				if ($dcaptain == $reported_by) $reporterIsCaptain = 1;
				if ($muid == $reported_by) $reporterIsTeamMember = 1;
			}

			// Check if 2 teams are the same
			for($j=$i+1;$j<=$nbr_players;$j++)
			{
				if ($_POST['player'.$i] == $_POST['player'.$j])
				$error_str .= '<li>'.EB_MATCHR_L39.$i.'&nbsp;'.EB_MATCHR_L40.$j.'</li>';
			}
			break;
		default:
		}
	}

	if($action=='matchschedule' || $action=='matchschedulededit')
	{
		if($_POST['date_scheduled'] == '')
		{
			$error_str .= '<li>'.EB_CHALLENGE_L10.'&nbsp;'.EB_CHALLENGE_L11.'</li>';
		}
		else
		{
			$date_scheduled = $_POST['date_scheduled'];
			$time_scheduled_local = strtotime($date_scheduled);
			$time_scheduled = $time_scheduled_local - TIMEOFFSET;	// Convert to GMT time
		}
	}

	if($action!='matchschedule'&&$action!='matchschedulededit')
	{
		switch($event->getMatchPlayersType())
		{
		case 'Players':
			// Check if the reporter played in the match
			if (($userclass == eb_UC_EVENT_PLAYER) && ($reporterIsPlaying == 0))
			$error_str .= '<li>'.EB_MATCHR_L9.'</li>';
			break;
		case 'Teams':
			// Check if the reporter's team played in the match
			if (($userclass == eb_UC_EVENT_PLAYER) && ($reporterIsCaptain == 0) && ($reporterIsTeamMember == 0))
			$error_str .= '<li>'.EB_MATCHR_L37.'</li>';
			break;
		default:
		}
	}
	
	for($i=1;$i<=$nbr_teams;$i++)
	{
		if (!isset($_POST['rank'.$i])) $_POST['rank'.$i] = 'Team #'.$i;
	}

	// Check if a team has no player
	if($action!='matchschedule'&&$action!='matchschedulededit')
	{
		for($i=1;$i<=$nbr_teams;$i++)
		{
			$team_players = 0;
			for($j=1;$j<=$nbr_players;$j++)
			{
				if ($_POST['team'.$j] == 'Team #'.$i)
				$team_players ++;
			}
			if ($team_players == 0)
			$error_str .= '<li>'.EB_MATCHR_L10.$i.'&nbsp;'.EB_MATCHR_L11.'</li>';
		}
	}
	// we could do more data checks, but you get the idea.
	// we could also strip any HTML from the variables, convert it to entities, have a maximum character limit on the values, etc etc, but this is just an example.
	// now, have any of these errors happened? We can find out by checking if $error_str is empty

	//$error_str = 'test';

	if (!empty($error_str)) {
		// show form again
		user_form($action, $players_id, $players_name, $event_id, $match_id, $event->getField('AllowDraw'), $event->getField('AllowForfeit'), $event->getField('AllowScore'),$userclass, $date_scheduled, $user_player);
		// errors have occured, halt execution and show form again.
		$text .= '<div class="eb_errors">'.EB_MATCHR_L14;
		$text .= '<ul>'.$error_str.'</ul></div>';
	}
	else
	{
		$text .= "no errors<br />";
		$nbr_players = $_POST['nbr_players'];

		$actual_rank[1] = 1;
		for($i=1;$i<=$nbr_teams;$i++)
		{
			$text .= 'Rank #'.$i.': '.$_POST['rank'.$i];
			$text .= '<br />';
			// Calculate actual rank based on draws checkboxes
			if ($_POST['draw'.$i] != "")
			$actual_rank[$i] = $actual_rank[$i-1];
			else
			$actual_rank[$i] = $i;
		}

		$text .= '--------------------<br />';

		$text .= 'Comments: '.$tp->toHTML($comments).'<br />';

		$create_scores = 0;
		
		if($action=='matchschedulededit')
		{
			$q =
			"UPDATE ".TBL_MATCHS
			." SET ReportedBy = '$reported_by',"
			."       TimeScheduled = '$time_scheduled',"
			."       Comments = '$comments',"
			."       Status= 'scheduled',"
			."       Maps = '$map'"
			." WHERE (MatchID = '$match_id')";
			$result = $sql->db_Query($q);
		}
		if($action=='matchedit'||$action=='matchscheduledreport')
		{
			// Need to delete the match scores and re-create new ones.
			$match->deleteMatchScores();
			$q =
			"UPDATE ".TBL_MATCHS
			." SET ReportedBy = '$reported_by',"
			."       TimeReported = '$time_reported',"
			."       Comments = '$comments',"
			."       Status= 'pending',"
			."       Maps = '$map'"
			." WHERE (MatchID = '$match_id')";

			$result = $sql->db_Query($q);
			$create_scores = 1;
		}
		if($action=='matchschedule')
		{
			// Create Match ------------------------------------------
			$q =
			"INSERT INTO ".TBL_MATCHS."(Event,ReportedBy,TimeReported, Comments, Status, TimeScheduled, Maps)
			VALUES ($event_id,'$reported_by', $time_reported, '$comments', 'scheduled', $time_scheduled, '$map')";
			$result = $sql->db_Query($q);
			$create_scores = 1;
			$last_id = mysql_insert_id();
			$match_id = $last_id;
			$match = new Match($match_id);
		}
		if($action=='matchreport')
		{
			// Create Match ------------------------------------------
			$q =
			"INSERT INTO ".TBL_MATCHS."(Event,ReportedBy,TimeReported,Comments, Status, Maps)
			VALUES ($event_id,'$reported_by', '$time_reported', '$comments', 'pending', '$map')";
			$result = $sql->db_Query($q);
			$create_scores = 1;
			$last_id = mysql_insert_id();
			$match_id = $last_id;
			$match = new Match($match_id);
		}

		if($create_scores == 1)
		{
			// Create Scores ------------------------------------------
			for($i=1;$i<=$nbr_players;$i++)
			{
				$pid = $_POST['player'.$i];
				$pteam = str_replace("Team #","",$_POST['team'.$i]);

				$pforfeit = 0;
				for($j=1;$j<=$nbr_teams;$j++)
				{
					if( $_POST['rank'.$j] == "Team #".$pteam) {
						$prank = $actual_rank[$j];
						if ($_POST['forfeit'.$j] != "") {
							$pforfeit = 1;
						}
					}
				}

				$pscore = $_POST['score'.$i];
				$pfaction = $_POST['faction'.$i];

				switch($event->getMatchPlayersType())
				{
				case 'Players':
					$q =
					"INSERT INTO ".TBL_SCORES."(MatchID,Player,Player_MatchTeam,Player_Score,Player_Rank,Player_Forfeit, Faction)
					VALUES ($match_id,$pid,$pteam,$pscore,$prank,$pforfeit,$pfaction)
					";
					break;
				case 'Teams':
					$q =
					"INSERT INTO ".TBL_SCORES."(MatchID,Team,Player_MatchTeam,Player_Score,Player_Rank,Player_Forfeit, Faction)
					VALUES ($match_id,$pid,$pteam,$pscore,$prank,$pforfeit,$pfaction)
					";
					break;
				default:
				}
				$result = $sql->db_Query($q);
			}
			$text .= '--------------------<br />';

			// Update scores stats
			if($action=='matchschedule')
			{
				// Send notification to all the players.
				$fromid = 0;
				$subject = SITENAME." ".EB_MATCHR_L52;

				switch($event->getMatchPlayersType())
				{
				case 'Players':
					$q_Players = "SELECT DISTINCT ".TBL_USERS.".*"
					." FROM ".TBL_MATCHS.", "
					.TBL_SCORES.", "
					.TBL_PLAYERS.", "
					.TBL_GAMERS.", "
					.TBL_USERS
					." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
					." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
					." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
					." AND (".TBL_GAMERS.".User = ".TBL_USERS.".user_id)";
					$result_Players = $sql->db_Query($q_Players);
					$nbr_players = mysql_numrows($result_Players);
					break;
				case 'Teams':
					$q_Players = "SELECT DISTINCT ".TBL_USERS.".*"
					." FROM ".TBL_MATCHS.", "
					.TBL_SCORES.", "
					.TBL_TEAMS.", "
					.TBL_PLAYERS.", "
					.TBL_GAMERS.", "
					.TBL_USERS
					." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
					." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
					." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
					." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
					." AND (".TBL_GAMERS.".User = ".TBL_USERS.".user_id)";
					$result_Players = $sql->db_Query($q_Players);
					$nbr_players = mysql_numrows($result_Players);
					break;
				default:
				}

				if($nbr_players > 0)
				{
					for($j=0; $j < $nbr_players; $j++)
					{
						$pname = mysql_result($result_Players, $j, TBL_USERS.".user_name");
						$pemail = mysql_result($result_Players, $j, TBL_USERS.".user_email");
						$message = EB_MATCHR_L53.$pname.EB_MATCHR_L54.EB_MATCHR_L55.$event->getField('Name').EB_MATCHR_L56;
						$sendto = mysql_result($result_Players, $j, TBL_USERS.".user_id");
						$sendtoemail = mysql_result($result_Players, $j, TBL_USERS.".user_email");
						if (check_class($pref['eb_pm_notifications_class']))
						{
							sendNotification($sendto, $subject, $message, $fromid);
						}
						if (check_class($pref['eb_email_notifications_class']))
						{
							// Send email
							require_once(e_HANDLER."mail.php");
							sendemail($sendtoemail, $subject, $message);
						}
					}
				}

				//header("Location: eventinfo.php?eventid=$event_id");
			}
			else
			{
				$match->match_scores_update();

				// Automatically Update Players stats only if Match Approval is Disabled
				if ($event->getField('MatchesApproval') == eb_UC_NONE)
				{
					switch($event->getMatchPlayersType())
					{
					case 'Players':
						$match->match_players_update();
						break;
					case 'Teams':
						$match->match_teams_update();
						break;
					default:
					}
					if($event->getField('FixturesEnable') == TRUE)
					{
						$event->brackets(true);
					}
					$event->setFieldDB('IsChanged', 1);
				}
				//header("Location: matchinfo.php?matchid=$match_id");
			}
		}
		else
		{
			//header("Location: matchinfo.php?matchid=$match_id");
		}

		echo "match reported";
		exit();
	}
	// if we get here, all data checks were okay, process information as you wish.
} else {
	$show_report_form = 0;
	switch($action)
	{
	case 'matchreport':
		if($can_report == 1) $show_report_form = 1;
		break;
	case 'matchscheduledreport':
		if($can_report_scheduled == 1) $show_report_form = 1;
		break;
	case 'matchedit':
		if($can_edit == 1) $show_report_form = 1;
		break;
	case 'matchschedulededit':
		if($can_edit == 1) $show_report_form = 1;
		break;
	case 'matchschedule':
		if($can_schedule == 1) $show_report_form = 1;
		break;
	}
		switch($action)
	{
	case 'matchreport':
	case 'matchscheduledreport':
	case 'matchedit':
	case 'matchschedulededit':
	case 'matchschedule':
		if (!check_class(e_UC_MEMBER))
		{
			$text .= '<p>'.EB_MATCHR_L36.'</p>';
			$text .= '<p>'.EB_MATCHR_L34.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>]</p>';
		}
		else
		{
			if($show_report_form == 1)
			{
				$userclass = $_POST['userclass'];
				// the form has not been submitted, let's show it
				user_form($action, $players_id, $players_name, $event_id, $match_id, $event->getField('AllowDraw'), $event->getField('AllowForfeit'), $event->getField('AllowScore'),$userclass, $date_scheduled, $user_player);
			}
			else
			{
				$text .= '<p>'.EB_MATCHR_L33.'</p>';
				//dbg:$text .= 'userlass='.$userclass;
				//$text .= '<p>'.EB_MATCHR_L34.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>]</p>';
			}
		}
		break;
	default:
		$text .= '<p>'.EB_MATCHR_L33.'</p>';
		//$text .= '<p>'.EB_MATCHR_L34.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>]</p>';
		break;
	}
}

$text .= '</div>';  /* spacer */

echo $text;


?>
