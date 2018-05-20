<?php
/**
* EventInfo.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/paginator.class.php");
require_once(e_PLUGIN."ebattles/include/show_array.php");
require_once(e_PLUGIN."ebattles/include/event.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/match.php");
require_once(e_PLUGIN."ebattles/include/gamer.php");
require_once(e_PLUGIN."ebattles/include/challenge.php");
require_once(e_PLUGIN."ebattles/include/brackets.php");

/*******************************************************************
********************************************************************/
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

$pages = new Paginator;

$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/matchreport.js"></script>
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/event.js"></script>
';

$text .= "
<script type='text/javascript'>
<!--//
function challenge_player_js(v)
{
document.getElementById('challenged_player_choice').value=v;
document.getElementById('challenge_player_form').submit();
}
function challenge_team_js(v)
{
document.getElementById('challenged_team_choice').value=v;
document.getElementById('challenge_team_form').submit();
}
//-->
</script>
";

if (!isset($_GET['orderby'])) $_GET['orderby'] = 1;
$orderby= intval($_GET['orderby']);

$sort = "DESC";
if(isset($_GET["sort"]) && !empty($_GET["sort"]))
{
	$sort = ($_GET["sort"]=="ASC") ? "DESC" : "ASC";
	$sort_type = ($_GET["sort"]=="ASC") ? SORT_ASC : SORT_DESC;
}

/* Event Name */
$event_id = intval($_GET['eventid']);

if (!$event_id)
{
	header("Location: ./events.php");
	exit();
}

$file = e_PLUGIN.'ebattles/cache/sql_cache_event_'.$event_id.'.txt';
$file_team = e_PLUGIN.'ebattles/cache/sql_cache_event_team_'.$event_id.'.txt';

$q = "SELECT ".TBL_EVENTS.".*, "
.TBL_GAMES.".*, "
.TBL_USERS.".*"
." FROM ".TBL_EVENTS.", "
.TBL_GAMES.", "
.TBL_USERS
." WHERE (".TBL_EVENTS.".EventID = '$event_id')"
."   AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
."   AND (".TBL_USERS.".user_id = ".TBL_EVENTS.".Owner)";
$result = $sql->db_Query($q);

$event = new Event($event_id);

//------------ permissions --------------
$permissions = $event->get_permissions(USERID);
$userclass = $permissions['userclass'];
$can_approve = $permissions['can_approve'];
$can_report = $permissions['can_report'];
$can_schedule = $permissions['can_schedule'];
$can_report_quickloss = $permissions['can_report_quickloss'];
$can_submit_replay = $permissions['can_submit_replay'];
$can_challenge = $permissions['can_challenge'];

$egame = mysql_result($result,0 , TBL_GAMES.".Name");
$egameid = mysql_result($result,0 , TBL_GAMES.".GameID");
$egameicon = mysql_result($result,0 , TBL_GAMES.".Icon");
$eowner = mysql_result($result,0 , TBL_USERS.".user_id");
$eownername = mysql_result($result,0 , TBL_USERS.".user_name");

$eventIsChanged = $event->getField('IsChanged');
$eventStatus = $event->getField('Status');
$rounds = unserialize($event->getFieldHTML('Rounds'));
$eMaxNumberPlayers = $event->getField('MaxNumberPlayers');

$type = $event->getField('Type');
$competition_type = $event->getCompetitionType();

/* Nbr players */
$q = "SELECT COUNT(*) as NbrPlayers"
." FROM ".TBL_PLAYERS
." WHERE (".TBL_PLAYERS.".Event = '$event_id')";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbr_players = $row['NbrPlayers'];

$q = "SELECT ".TBL_PLAYERS.".*"
." FROM ".TBL_PLAYERS
." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
." AND (".TBL_PLAYERS.".CheckedIn = '1')"
." AND (".TBL_PLAYERS.".Seed <= '$eMaxNumberPlayers')";
$result = $sql->db_Query($q);
$nbr_players_checked_in = mysql_numrows($result);

/* Nbr Teams */
$q = "SELECT COUNT(*) as NbrTeams"
." FROM ".TBL_TEAMS
." WHERE (Event = '$event_id')";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbr_teams = $row['NbrTeams'];

$q = "SELECT ".TBL_TEAMS.".*"
." FROM ".TBL_TEAMS
." WHERE (".TBL_TEAMS.".Event = '$event_id')"
." AND (".TBL_TEAMS.".CheckedIn = '1')"
." AND (".TBL_TEAMS.".Seed <= '$eMaxNumberPlayers')";
$result = $sql->db_Query($q);
$nbr_teams_checked_in = mysql_numrows($result);

if ($pref['eb_events_update_delay_enable'] == 1)
{
	$eneedupdate = 0;
}
else
{
	// Force always update
	$eneedupdate = 1;
}

if (
	(($time > $event->getField('NextUpdate_timestamp')) && ($eventIsChanged == 1))
	||(file_exists($file) == FALSE)
	||((file_exists($file_team) == FALSE) && (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "Clan Ladder")))
)
{
	$eneedupdate = 1;
}

if($event->getField('StartDateTime')!=0)
{
	$startdatetime_local = $event->getField('StartDateTime') + TIMEOFFSET;
	$date_start = date("d M Y, h:i A",$startdatetime_local);
}
else
{
	$date_start = "-";
}
if($event->getField('EndDateTime')!=0)
{
	$enddatetime_local = $event->getField('EndDateTime') + TIMEOFFSET;
	$date_end = date("d M Y, h:i A",$enddatetime_local);
}
else
{
	$date_end = "-";
}

/* Update event "status" */
$checkinDuration = INT_MINUTE*$event->getField('CheckinDuration');

if($eventStatus=='signup')
{
	if($time > ($event->getField('StartDateTime') - $checkinDuration))
	{
		$eventStatus = 'checkin';
	}
}
if($eventStatus=='checkin')
{
	$checkin_end = false;
	
	if($event->getField('CheckinDuration') > 0)
	{
		// End 'checkin' at the beginning of the event, or when we've reached enough checkins
		if(($time > $event->getField('StartDateTime')) ||
		   (($eMaxNumberPlayers != 0)&&($nbr_teams_checked_in >= $eMaxNumberPlayers)))
		{
			$checkin_end = true;
		}

		if(($time > $event->getField('StartDateTime')) ||
		   (($eMaxNumberPlayers != 0)&&($nbr_players_checked_in >= $eMaxNumberPlayers)))
		{
			$checkin_end = true;
		}
	}
	else
	{
		// no checkin
		if($time > $event->getField('StartDateTime'))
		{
			$checkin_end = true;
		}
	}
	
	if($checkin_end == true)
	{
		$eventStatus = 'active';
		if($event->getField('FixturesEnable') == TRUE)
		{
			$event->brackets(true);
		}			
		$event->setFieldDB('IsChanged', 1);
	}
}
if(($time > $event->getField('EndDateTime')) && ($event->getField('EndDateTime') != 0) && ($eventStatus!='finished'))
{
	$eventStatus = 'finished';
	if (($type == "One Player Ladder") || ($type == "Team Ladder") )
	{
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Rank = '1')";
		$result = $sql->db_Query($q);
		$nbr_players_rank_1 = mysql_numrows($result);
		//echo "nbr_players_rank_1: $nbr_players_rank_1<br>";			
		if($nbr_players_rank_1 == 1)
		{	
			$pid = mysql_result($result,0 , TBL_PLAYERS.".PlayerID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
			VALUES ($pid,'PlayerRankFirst',$time+2)";
			$result_Awards = $sql->db_Query($q_Awards);
			
			// gold
			if(is_gold_system_active() && ($event->getField('GoldWinningEvent')>0)) {
				$q = "SELECT ".TBL_PLAYERS.".*, "
				.TBL_GAMERS.".*"
				." FROM ".TBL_PLAYERS.", "
				.TBL_GAMERS
				." WHERE (".TBL_PLAYERS.".PlayerID = '$pid')"
				."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)";
				$result = $sql->db_Query($q);
				$uid = mysql_result($result, 0 , TBL_GAMERS.".User");

				$gold_param['gold_user_id'] = $uid;
				$gold_param['gold_who_id'] = 0;
				$gold_param['gold_amount'] = $event->getField('GoldWinningEvent');
				$gold_param['gold_type'] = EB_L1;
				$gold_param['gold_action'] = "credit";
				$gold_param['gold_plugin'] = "ebattles";
				$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
				$gold_param['gold_forum'] = 0;
				$gold_obj->gold_modify($gold_param);
			}
		}
		
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		. "AND (".TBL_PLAYERS.".Rank = '2')";
		$result = $sql->db_Query($q);
		$nbr_players_rank_2 = mysql_numrows($result);
		if($nbr_players_rank_2 == 1)
		{				
			$pid = mysql_result($result,0 , TBL_PLAYERS.".PlayerID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
			VALUES ($pid,'PlayerRankSecond',$time+1)";
			$result_Awards = $sql->db_Query($q_Awards);
		}

		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		. "AND (".TBL_PLAYERS.".Rank = '3')";
		$result = $sql->db_Query($q);
		$nbr_players_rank_3 = mysql_numrows($result);
		if($nbr_players_rank_3 == 1)
		{				
			$pid = mysql_result($result,0 , TBL_PLAYERS.".PlayerID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
			VALUES ($pid,'PlayerRankThird',$time)";
			$result_Awards = $sql->db_Query($q_Awards);
		}
	}			
	if (($type == "Clan Ladder") || ($type == "Team Ladder") )
	{
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '$event_id')"
		. "AND (".TBL_TEAMS.".Rank = '1')";
		$result = $sql->db_Query($q);
		$nbr_teams_rank_1 = mysql_numrows($result);
		if($nbr_teams_rank_1 == 1)
		{				
			$pid = mysql_result($result,0 , TBL_TEAMS.".TeamID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
			VALUES ($pid,'TeamRankFirst',$time+2)";
			$result_Awards = $sql->db_Query($q_Awards);

			// gold
			if(is_gold_system_active() && ($event->getField('GoldWinningEvent')>0)) {
				// find team captain
				$q = "SELECT ".TBL_TEAMS.".*, "
				.TBL_DIVISIONS.".*"
				." FROM ".TBL_TEAMS.", "
				.TBL_DIVISIONS
				." WHERE (".TBL_TEAMS.".TeamID = '$pid')"
				."   AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)";
				$result = $sql->db_Query($q);
				$uid = mysql_result($result, 0 , TBL_DIVISIONS.".Captain");

				$gold_param['gold_user_id'] = $uid;
				$gold_param['gold_who_id'] = 0;
				$gold_param['gold_amount'] = $event->getField('GoldWinningEvent');
				$gold_param['gold_type'] = EB_L1;
				$gold_param['gold_action'] = "credit";
				$gold_param['gold_plugin'] = "ebattles";
				$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
				$gold_param['gold_forum'] = 0;
				$gold_obj->gold_modify($gold_param);
			}	
		}
		
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '$event_id')"
		. "AND (".TBL_TEAMS.".Rank = '2')";
		$result = $sql->db_Query($q);
		$nbr_teams_rank_2 = mysql_numrows($result);
		if($nbr_teams_rank_2 == 1)
		{				
			$pid = mysql_result($result,0 , TBL_TEAMS.".TeamID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
			VALUES ($pid,'TeamRankSecond',$time+1)";
			$result_Awards = $sql->db_Query($q_Awards);
		}

		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '$event_id')"
		. "AND (".TBL_TEAMS.".Rank = '3')";
		$result = $sql->db_Query($q);
		$nbr_teams_rank_3 = mysql_numrows($result);
		if($nbr_teams_rank_3 == 1)
		{				
			$pid = mysql_result($result,0 , TBL_TEAMS.".TeamID");
			$q_Awards = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
			VALUES ($pid,'TeamRankThird',$time)";
			$result_Awards = $sql->db_Query($q_Awards);
		}
	}
}

$event->setFieldDB('Status', $eventStatus);

// Rating Period
$rating_period = $event->getField('rating_period');
$next_rating_timestamp = $event->getField('next_rating_timestamp');
if(($rating_period > 0)&&($eventStatus == 'active'))
{
	if($next_rating_timestamp == 0) $next_rating_timestamp = $event->getField('StartDateTime') + INT_DAY * $rating_period;

	while($time > $next_rating_timestamp)
	{
		$event->rating_period_update();
		$next_rating_timestamp += INT_DAY * $rating_period;
	}
	$event->setFieldDB('next_rating_timestamp', $next_rating_timestamp);
}
$next_rating_timestamp_local = $next_rating_timestamp + TIMEOFFSET;
$date_next_rating = date("d M Y, h:i A",$next_rating_timestamp_local);

$can_signup = 0;
$cannot_signup_str = EB_EVENT_L75;
$can_checkin = 0;

$max_num_players_reached = 0;
switch($event->getMatchPlayersType())
{
case 'Players':
	if(($eMaxNumberPlayers != 0)&&($nbr_players >= $eMaxNumberPlayers))	$max_num_players_reached = 1;
	$tab_title = EB_EVENT_L77;
	break;
case 'Teams':
	if(($eMaxNumberPlayers != 0)&&($nbr_teams >= $eMaxNumberPlayers))	$max_num_players_reached = 1;
	$tab_title = EB_EVENT_L84;
	break;
default:
}

if($event->getField('FixturesEnable') == TRUE)
{
	$show_seeds_players = true;
	$show_seeds_teams = true;
	switch($event->getField('Status'))
	{
	case 'draft':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L75;
		break;
	case 'signup':
		// Do not close signup when max players limit is reached (wait list for non seeded players)
		$can_signup = 1;
		break;
	case 'checkin':
		$can_checkin = 1;
		$can_signup = 1;
		break;
	case 'active':
		// late signups ok, until a game has been played.
		$can_signup = 1;
		$can_checkin = 1;
		if($event->getField('AllowLateSignups') == FALSE)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENT_L75;
			$can_checkin = 0;
		}
		// Check if one game has been played
		$q = "SELECT COUNT(DISTINCT ".TBL_MATCHS.".MatchID) as NbrMatches"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES
		." WHERE (Event = '$event_id')"
		." AND (".TBL_MATCHS.".Status = 'active')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)";
		$result = $sql->db_Query($q);

		$row = mysql_fetch_array($result);
		$numMatches = $row['NbrMatches'];
		if($numMatches > 0)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENT_L75;
			$can_checkin = 0;
		}
		break;
	case 'finished':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L83;
		$can_checkin = 0;
		break;
	}
}
if($event->getField('FixturesEnable') == FALSE)
{
	$show_seeds_players = false;
	$show_seeds_teams = false;
	switch($event->getField('Status'))
	{
	case 'draft':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L75;
		break;
	case 'signup':
		$can_signup = 1;
		if($max_num_players_reached == 1)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENTM_L161;
		}
		break;
	case 'checkin':
		$can_signup = 1;
		$can_checkin = 1;
		if($max_num_players_reached == 1)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENTM_L161;
		}
		break;
	case 'active':
		$can_signup = 1;
		$can_checkin = 1;
		if($max_num_players_reached == 1)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENTM_L161;
		}
		if($event->getField('AllowLateSignups') == FALSE)
		{
			$can_signup = 0;
			$cannot_signup_str = EB_EVENT_L75;
		}
		break;
	case 'finished':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L83;
		$can_checkin = 0;
		break;
	}
}

if($event->getField('CheckinDuration') == 0) $can_checkin = 0;

$hide_fixtures = 0;
if(($event->getField('HideFixtures') == 1) &&
   (($event->getField('Status') == 'draft') ||
    ($event->getField('Status') == 'checkin') ||
    ($event->getField('Status') == 'signup')))
{
	$hide_fixtures = 1;
}

if($event->getField('SignupsEnable') == FALSE)
{
	$can_signup = 0;
	$cannot_signup_str = EB_EVENT_L75;
}

if(!check_class(e_UC_MEMBER))
{
	$can_signup = 0;
	$cannot_signup_str = EB_EVENT_L34;
}

switch($competition_type)
{
case 'Tournament':
	require_once(e_PLUGIN."ebattles/tournamentinfo.php");
	break;
case 'Ladder':
	require_once(e_PLUGIN."ebattles/ladderinfo.php");
	break;
}

$ns->tablerender($event->getField('Name')." ($egame - ".$event->eventTypeToString().")", $text);
require_once(FOOTERF);
exit;

?>

