<?php
/**
*EventProcess.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN.'ebattles/include/event.php');
// Include userclass file
require_once(e_HANDLER."userclass_class.php");

/*******************************************************************
********************************************************************/
echo '
<html>
<head>
<style type="text/css">
<!--
.percents {
background: #FFF;
position:absolute;
text-align: center;
}
-->
</style>
</head>
<body>
';

$event_id = intval($_GET['eventid']);
$action = eb_sanitize($_GET['actionid']);
$event = new Event($event_id);

/* Nbr players */
$q = "SELECT COUNT(*) as NbrPlayers"
." FROM ".TBL_PLAYERS
." WHERE (".TBL_PLAYERS.".Event = '".$event_id."')";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbrplayers = $row['NbrPlayers'];

/* Nbr Teams */
$q = "SELECT COUNT(*) as NbrTeams"
." FROM ".TBL_TEAMS
." WHERE (Event = '".$event_id."')";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbrteams = $row['NbrTeams'];

$update_matchupsfile = 0;

$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$event->getField('Owner')) $can_manage = 1;
if(($action=='create')&&(check_class($pref['eb_events_create_class']))) $can_manage = 1;

if ($can_manage == 0)
{
	header("Location: ./eventinfo.php?eventid=$event_id");
	exit();
}

$event->setFieldDB('IsChanged', 1);

if(isset($_POST['eventpublish']))
{
	/* Event Status */
	$event->setFieldDB('Status', 'signup');

	//echo "-- eventpublish --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventchangeowner']))
{
	$event_owner = $_POST['eventowner'];

	/* Event Owner */
	$event->setFieldDB('Owner', $event_owner);

	//echo "-- eventchangeowner --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventdeletemod']))
{
	$eventmod = $_POST['eventmod'];
	$q2 = "DELETE FROM ".TBL_EVENTMODS
	." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
	."   AND (".TBL_EVENTMODS.".User = '$eventmod')";
	$result2 = $sql->db_Query($q2);

	//echo "-- eventdeletemod --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventaddmod']))
{
	$eventmod = $_POST['mod'];

	$q2 = "SELECT ".TBL_EVENTMODS.".*"
	." FROM ".TBL_EVENTMODS
	." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
	."   AND (".TBL_EVENTMODS.".User = '$eventmod')";
	$result2 = $sql->db_Query($q2);
	$num_rows_2 = mysql_numrows($result2);
	if ($num_rows_2==0)
	{
		$eventmod = $tp->toDB($eventmod);
		$q2 = "INSERT INTO ".TBL_EVENTMODS."(Event,User,Level)"
		." VALUES ('$event_id','$eventmod',1)";
		$result2 = $sql->db_Query($q2);
	}
	//echo "-- eventaddmod --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}

if(isset($_POST['eventsettingssave']))
{
	/* Event Name */
	$new_eventname = $_POST['eventname'];
	if ($new_eventname != '')
	{
		$event->setField('Name', $new_eventname);
	}

	/* Event Password */
	$event->setField('password', $_POST['eventpassword']);

	/* Event Game */
	$new_eventgame = $_POST['eventgame'];
	if ($_POST['eventgame'] != 0)
	{
		$event->setField('Game', $_POST['eventgame']);
		$event->setField('MatchType', $_POST['eventmatchtype']);
	}

	/* Event Type */
	// Can change only if no players are signed up
	if($nbrplayers+$nbrteams==0)
	{
		$new_eventtype = $_POST['eventtype'];

		switch($new_eventtype)
		{
		case 'One Player Ladder':
			$event->setField('Type', 'One Player Ladder');
			break;
		case 'Team Ladder':
			$event->setField('Type', 'Team Ladder');
			break;
		case 'Clan Ladder':
			$event->setField('Type', 'Clan Ladder');
			break;
		case 'One Player Tournament':
			$event->setField('Type', 'One Player Tournament');
			$event->setField('Format', 'Single Elimination');
			$event->setField('FixturesEnable', TRUE);
			$maxNbrPlayers = 16;
			$event->setField('MaxNumberPlayers', $maxNbrPlayers);
			$path = 'include/brackets/';
			$file = $path.'se-'.$maxNbrPlayers.'.txt';
			$event->setField('MatchupsFile', $file);
			$event->initRounds();
			break;
		case 'Clan Tournament':
			$event->setField('Type', 'Clan Tournament');
			$event->setField('Format', 'Single Elimination');
			$event->setField('FixturesEnable', TRUE);
			$maxNbrPlayers = 16;
			$event->setField('MaxNumberPlayers', $maxNbrPlayers);
			$path = 'include/brackets/';
			$file = $path.'se-'.$maxNbrPlayers.'.txt';
			$event->setField('MatchupsFile', $file);
			$event->initRounds();
		default:
		}
	}

	/* Event MatchType */
	// Can change only if no players are signed up
	if($nbrplayers+$nbrteams==0)
	{
		$event->setField('MatchType', $_POST['eventmatchtype']);
	}

	/* Event Ranking Type */
	if ($_POST['eventrankingtype'] != "")
	{
		$event->setField('RankingType', $_POST['eventrankingtype']);
	}

	/* Event Match report userclass */
	$event->setField('match_report_userclass', $_POST['eventmatchreportuserclass']);

	/* Event Match replay report userclass */
	$event->setField('match_replay_report_userclass', $_POST['eventmatchreplayreportuserclass']);

	/* Event Quick Loss Report */
	if ($_POST['eventallowquickloss'] != "")
	{
		$event->setField('quick_loss_report', 1);
	}
	else
	{
		$event->setField('quick_loss_report', 0);
	}

	/* Event Allow Score */
	if ($_POST['eventallowscore'] != "")
	{
		$event->setField('AllowScore', 1);
	}
	else
	{
		$event->setField('AllowScore', 0);
	}

	/* Event Allow Draw */
	if ($_POST['eventallowdraw'] != "")
	{
		$event->setField('AllowDraw', 1);
	}
	else
	{
		$event->setField('AllowDraw', 0);
	}

	/* Event Forfeit */
	if ($_POST['eventallowforfeit'] != "")
	{
		$event->setField('AllowForfeit', 1);
	}
	else
	{
		$event->setField('AllowForfeit', 0);
	}
	if ($_POST['eventForfeitWinLossUpdate'] != "")
	{
		$event->setField('ForfeitWinLossUpdate', 1);
	}
	else
	{
		$event->setField('ForfeitWinLossUpdate', 0);
	}
	$new_eventforfeitwinpoints = htmlspecialchars($_POST['eventforfeitwinpoints']);
	if (preg_match("/^\d+$/", $new_eventforfeitwinpoints))
	{
		$event->setField('ForfeitWinPoints', $new_eventforfeitwinpoints);
	}
	$new_eventforfeitlosspoints = htmlspecialchars($_POST['eventforfeitlosspoints']);
	if (preg_match("/^-?\d+$/", $new_eventforfeitlosspoints))
	{
		$event->setField('ForfeitLossPoints', $new_eventforfeitlosspoints);
	}

	/* Event Match Approval */
	$event->setField('MatchesApproval', $_POST['eventmatchapprovaluserclass']);

	/* Points */
	$new_eventpointsperwin = htmlspecialchars($_POST['eventpointsperwin']);
	if (preg_match("/^\d+$/", $new_eventpointsperwin))
	{
		$event->setField('PointsPerWin', $new_eventpointsperwin);
	}
	$new_eventpointsperdraw = htmlspecialchars($_POST['eventpointsperdraw']);
	if (preg_match("/^\d+$/", $new_eventpointsperdraw))
	{
		$event->setField('PointsPerDraw', $new_eventpointsperdraw);
	}
	$new_eventpointsperloss = htmlspecialchars($_POST['eventpointsperloss']);
	if (preg_match("/^-?\d+$/", $new_eventpointsperloss))
	{
		$event->setField('PointsPerLoss', $new_eventpointsperloss);
	}

	/* Event Max number of Maps Per Match */
	$new_eventmaxmapspermatch = htmlspecialchars($_POST['eventmaxmapspermatch']);
	if (preg_match("/^\d+$/", $new_eventmaxmapspermatch))
	{
		$event->setField('MaxMapsPerMatch', $new_eventmaxmapspermatch);
	}

	/* Gold */
	$new_event_gold_entry_fee = htmlspecialchars($_POST['event_gold_entry_fee']);
	if (preg_match("/^\d+$/", $new_event_gold_entry_fee))
	{
		$event->setField('GoldEntryFee', $new_event_gold_entry_fee);
	}		
	$new_event_gold_winning_event = htmlspecialchars($_POST['event_gold_winning_event']);
	if (preg_match("/^\d+$/", $new_event_gold_winning_event))
	{
		$event->setField('GoldWinningEvent', $new_event_gold_winning_event);
	}	
	
	/* Event Start Date */
	$new_eventstartdate = $_POST['startdate'];
	if ($new_eventstartdate != '')
	{
		$new_eventstart_local = strtotime($new_eventstartdate);
		$new_eventstart = $new_eventstart_local - TIMEOFFSET;	// Convert to GMT time
	}
	else
	{
		$new_eventstart = 0;
	}
	$event->setField('StartDateTime', $new_eventstart);

	/* Event End Date */
	$new_eventenddate = $_POST['enddate'];
	if ($new_eventenddate != '')
	{
		$new_eventend_local = strtotime($new_eventenddate);
		$new_eventend = $new_eventend_local - TIMEOFFSET;	// Convert to GMT time

		if ($new_eventend < $new_eventstart)
		{
			$new_eventend = $new_eventstart;
		}
	}
	else
	{
		$new_eventend = 0;
	}
	$event->setField('EndDateTime', $new_eventend);
	
	/* Event Checkin Duration */
	$new_checkin_duration = $_POST['checkin_duration'];
	if (preg_match("/^\d+$/", $new_checkin_duration))
	{
		$event->setField('CheckinDuration', $new_checkin_duration);
	}
	
	/* Event Signups Enable */
	if ($_POST['eventsignupsenable'] != "")
	{
		$event->setField('SignupsEnable', 1);
	}
	else
	{
		$event->setField('SignupsEnable', 0);
	}

	/* Event Allow Late Signups */
	if ($_POST['eventallowlatesignups'] != "")
	{
		$event->setField('AllowLateSignups', 1);
	}
	else
	{
		$event->setField('AllowLateSignups', 0);
	}
	
	/* Event Description */
	$event->setField('Description', $_POST['eventdescription']);

	/* Event Rules */
	$event->setField('Rules', $_POST['eventrules']);

	if ($event_id) {
		// Need to update the event in database
		$event->updateDB();
	} else {
		// Need to create an event.
		$event->setField('Owner', USERID);
		$event_id = $event->insert();
		// TODO: only for ladders?
		$event->initStats();
	}

	//echo "-- eventsettingssave --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventdeletemap']))
{
	$eventmap = $_POST['eventdeletemap'];
	$mapPool = explode(",", $event->getField('MapPool'));
	unset($mapPool[$eventmap]);
	$event->updateMapPool($mapPool);
	$event->updateFieldDB('MapPool');

	//echo "-- eventdeletemap --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventaddmap']))
{
	$eventmap = $_POST['map'];
	$maps = $event->getField('MapPool');
	$mapPool = array();
	if ($maps)	$mapPool = explode(",", $event->getField('MapPool'));
	if (!in_array($eventmap, $mapPool)) {
		array_push($mapPool, $eventmap);
		$event->updateMapPool($mapPool);
		$event->updateFieldDB('MapPool');
	}
	//echo "-- eventaddmap --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventaddplayer']))
{
	$player = $_POST['player'];
	$notify = (isset($_POST['eventaddplayernotify'])? TRUE: FALSE);
	$event->eventAddPlayer($player, 0, $notify);

	//echo "-- eventaddplayer --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventadduserclass_submit']))
{
	$userclass = $_POST['eventadduserclass'];
	$notify = (isset($_POST['eventaddplayernotify'])? TRUE: FALSE);
	
	$tolist = get_users_inclass($userclass);
	//var_dump($tolist);
	set_time_limit(10);
	foreach($tolist as $u)
	{
		$event->eventAddPlayer($u['user_id'], 0, $notify);
	}

	//echo "-- eventadduserclass --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventaddteam']))
{
	$division = $_POST['division'];
	$notify = (isset($_POST['eventaddteamnotify'])? TRUE: FALSE);
	$event->eventAddDivision($division, $notify);

	//echo "-- eventaddteam --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['ban_player']) && $_POST['ban_player']!="")
{
	$playerid = $_POST['ban_player'];
	banPlayer($playerid);
	// TODO: only for ladders?
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['unban_player']) && $_POST['unban_player']!="")
{
	$playerid = $_POST['unban_player'];
	unbanPlayer($playerid);
	// TODO: only for ladders?
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['kick_player']) && $_POST['kick_player']!="")
{
	$playerid = $_POST['kick_player'];
	deletePlayer($playerid);
	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['del_player_games']) && $_POST['del_player_games']!="")
{
	$playerid = $_POST['del_player_games'];
	deletePlayerMatches($playerid);
	if($event->getField('FixturesEnable') == TRUE)
	{
		$event->brackets(true);
	}
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['del_player_awards']) && $_POST['del_player_awards']!="")
{
	$playerid = $_POST['del_player_awards'];
	deletePlayerAwards($playerid);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['checkin_player']) && $_POST['checkin_player']!="")
{
	$playerid = $_POST['checkin_player'];
	checkinPlayer($playerid);
	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}			
	$event->setFieldDB('IsChanged', 1);

	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['replace_player']) && $_POST['replace_player']!="")
{
	$playerid = $_POST['replace_player'];
	$new_seed = $_POST['replace_player_'.$playerid];
	$event->replacePlayer($playerid, $new_seed);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['ban_team']) && $_POST['ban_team']!="")
{
	$teamid = $_POST['ban_team'];
	banTeam($teamid);
	// TODO: only for ladders?
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['unban_team']) && $_POST['unban_team']!="")
{
	$teamid = $_POST['unban_team'];
	unbanTeam($teamid);
	// TODO: only for ladders?
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['kick_team']) && $_POST['kick_team']!="")
{
	$teamid = $_POST['kick_team'];
	deleteTeam($teamid);
	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['del_team_games']) && $_POST['del_team_games']!="")
{
	$teamid = $_POST['del_team_games'];
	deleteTeamMatches($teamid);
	if($event->getField('FixturesEnable') == TRUE)
	{
		$event->brackets(true);
	}
	updateStats($event_id, $time, TRUE);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['del_team_awards']) && $_POST['del_team_awards']!="")
{
	$teamid = $_POST['del_team_awards'];
	deleteTeamAwards($teamid);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['checkin_team']) && $_POST['checkin_team']!="")
{
	$teamid = $_POST['checkin_team'];
	checkinTeam($teamid);
	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}			
	$event->setFieldDB('IsChanged', 1);

	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['replace_team']) && $_POST['replace_team']!="")
{
	$teamid = $_POST['replace_team'];
	$new_seed = $_POST['replace_team_'.$teamid];
	$event->replaceTeam($teamid, $new_seed);
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventplayersshuffle']))
{
	$event->shuffleSeeds();

	//echo "-- eventplayersshuffle --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventteamsshuffle']))
{
	$event->shuffleSeeds();

	//echo "-- eventteamsshuffle --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}	

if(isset($_POST['eventresetscores']))
{
	$event->resetPlayers();
	$event->resetTeams();
	$event->deleteMatches();
	$event->resetResults();
	$event->updateFieldDB('Results');
	$event->setFieldDB('Status', 'draft');

	//echo "-- eventresetscores --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventresetevent']))
{
	$event->deleteMatches();
	$event->deleteChallenges();
	$event->deletePlayers();
	$event->deleteTeams();
	$event->resetResults();
	$event->updateFieldDB('Results');
	$event->setFieldDB('Status', 'draft');

	//echo "-- eventresetevent --<br />";
	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventdelete']))
{
	$event->deleteEvent();

	//echo "-- eventdelete --<br />";
	header("Location: events.php");
	exit();
}
if(isset($_POST['eventupdatescores']))
{
	if (!isset($_POST['match'])) $_POST['match'] = 0;
	$current_match = $_POST['match'];
	$event->eventScoresUpdate($current_match);
}

if(isset($_POST['eventfixturessave']))
{
	//var_dump($_POST);
	/* Event Fixtures enable/disable */
	if($_POST['eventfixturesenable'] != "")
	{
		if($event->getField('FixturesEnable')!=TRUE)
		{
			$event->setField('FixturesEnable', TRUE);
			$event->setField('Format', 'Round-robin');
			$_POST['eventmaxnumberplayers'] = 8;
		}
	}
	else
	{
		$event->setField('FixturesEnable', FALSE);
	}
	
	/* Event Format */
	if(($_POST['eventformat'] != "")&&($_POST['eventformat'] != $event->getField('Format')))
	{
		$event->setField('Format', $_POST['eventformat']);
		$_POST['eventmaxnumberplayers'] = 8;
		$update_matchupsfile = 1;
		//TODO: if format changes, rounds should change too
	}


	/* Hide Fixtures */
	$new_hide_fixtures = $_POST['hide_fixtures'];
	if ($new_hide_fixtures != '')
	{
		$event->setField('HideFixtures', $new_hide_fixtures);
	}

	/* Event Max Number of Players */
	$new_eventmaxnumberplayers = htmlspecialchars($_POST['eventmaxnumberplayers']);
	if (preg_match("/^\d+$/", $new_eventmaxnumberplayers))
	{
		$event->setField('MaxNumberPlayers', $new_eventmaxnumberplayers);
		$update_matchupsfile = 1;
	}		

	if($update_matchupsfile!=0)
	{
		$path = e_PLUGIN.'ebattles/include/brackets/';
		$maxNbrPlayers = $event->getField('MaxNumberPlayers');
		$format = $event->getField('Format');
		
		switch ($format)
		{
		case 'Double Elimination':
			switch ($maxNbrPlayers)
			{
			case 4:
				$file = $path.'de-4.txt';
				break;
			case 8:
				$file = $path.'de-8-1.txt';
				break;
			default:
				$file = $path.'de-8-1.txt';
				break;
			}
			break;
		case 'Single Elimination':
			$file = $path.'se-'.$maxNbrPlayers.'.txt';
			break;
		case 'Round-robin':
			$file = $path.'rr-'.$maxNbrPlayers.'.txt';
			break;
		case 'Double Round-robin':
			$file = $path.'drr-'.$maxNbrPlayers.'.txt';
			break;
		default:
			$file = $path.'se-'.$maxNbrPlayers.'.txt';
			break;
		}
		$event->setField('MatchupsFile', $file);
	}

	/* Event Rounds */
	$matchups = $event->getMatchups();
	$nbrRounds = count($matchups);

	$rounds = unserialize($event->getFieldHTML('Rounds'));
	
	if (!isset($rounds)) $rounds = array();
	for ($round = 1; $round < $nbrRounds; $round++) {
		if (!isset($rounds[$round])) {
			$rounds[$round] = array();
		}
		if (!isset($_POST['round_title_'.$round])) {
			$_POST['round_title_'.$round] = EB_EVENTM_L144.' '.$round;
		}
		if (!isset($_POST['round_bestof_'.$round])) {
			$_POST['round_bestof_'.$round] = 1;
		}
		$rounds[$round]['Title'] = $tp->toDB($_POST['round_title_'.$round]);
		$rounds[$round]['BestOf'] = $tp->toDB($_POST['round_bestof_'.$round]);
	}

	$event->updateRounds($rounds);		

	// Need to update the event in database
	$event->updateDB();

	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}	

if(isset($_POST['eventstatssave']))
{
	//echo "-- eventstatssave --<br />";
	$cat_index = 0;

	/* Event Min games to rank */
	if ($event->getField('Type') != "Clan Ladder")
	{
		$new_eventGamesToRank = htmlspecialchars($_POST['sliderValue'.$cat_index]);
		if (is_numeric($new_eventGamesToRank))
		{
			$event->setFieldDB('nbr_games_to_rank', $new_eventGamesToRank);
		}
		$cat_index++;
	}

	if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "Clan Ladder"))
	{
		/* Event Min Team games to rank */
		$new_eventTeamGamesToRank = htmlspecialchars($_POST['sliderValue'.$cat_index]);
		if (is_numeric($new_eventTeamGamesToRank))
		{
			$event->setFieldDB('nbr_team_games_to_rank', $new_eventTeamGamesToRank);
		}
		$cat_index++;
	}

	$q_1 = "SELECT ".TBL_STATSCATEGORIES.".*"
	." FROM ".TBL_STATSCATEGORIES
	." WHERE (".TBL_STATSCATEGORIES.".Event = '$event_id')";

	$result_1 = $sql->db_Query($q_1);
	$numCategories = mysql_numrows($result_1);

	for($i=0; $i<$numCategories; $i++)
	{
		$cat_name = mysql_result($result_1,$i, TBL_STATSCATEGORIES.".CategoryName");

		$new_eventStat = htmlspecialchars($_POST['sliderValue'.$cat_index]);
		if (is_numeric($new_eventStat))
		{
			$q2 = "UPDATE ".TBL_STATSCATEGORIES." SET CategoryMaxValue = '$new_eventStat' WHERE (Event = '$event_id') AND (CategoryName = '$cat_name')";
			$result2 = $sql->db_Query($q2);
		}

		// Display Only
		if ($_POST['infoonly'.$i] != "")
		$q2 = "UPDATE ".TBL_STATSCATEGORIES." SET InfoOnly = 1 WHERE (Event = '$event_id') AND (CategoryName = '$cat_name')";
		else
		$q2 = "UPDATE ".TBL_STATSCATEGORIES." SET InfoOnly = 0 WHERE (Event = '$event_id') AND (CategoryName = '$cat_name')";
		$result2 = $sql->db_Query($q2);

		$cat_index ++;
	}

	// Hide ratings column
	$event->setFieldDB('hide_ratings_column', ($_POST['hideratings'] != "") ? 1 : 0);

	
	// Advanced settings
	$new_eventELO_default = htmlspecialchars($_POST['eventELO_default']);
	if (preg_match("/^\d+$/", $new_eventELO_default))
	{
		$event->setFieldDB('ELO_default', $new_eventELO_default);
	}
	$new_eventELO_K = htmlspecialchars($_POST['eventELO_K']);
	if (preg_match("/^\d+$/", $new_eventELO_K))
	{
		$event->setFieldDB('ELO_K', $new_eventELO_K);
	}
	$new_eventELO_M = htmlspecialchars($_POST['eventELO_M']);
	if (preg_match("/^\d+$/", $new_eventELO_M))
	{
		$event->setFieldDB('ELO_M', $new_eventELO_M);
	}

	$new_eventTS_default_mu = htmlspecialchars($_POST['eventTS_default_mu']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventTS_default_mu))
	{
		$event->setFieldDB('TS_default_mu', floatToSQL($new_eventTS_default_mu));
	}
	$new_eventTS_default_sigma = htmlspecialchars($_POST['eventTS_default_sigma']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventTS_default_sigma))
	{
		$event->setFieldDB('TS_default_sigma', floatToSQL($new_eventTS_default_sigma));
	}
	$new_eventTS_beta = htmlspecialchars($_POST['eventTS_beta']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventTS_beta))
	{
		$event->setFieldDB('TS_beta', floatToSQL($new_eventTS_beta));
	}
	$new_eventTS_epsilon = htmlspecialchars($_POST['eventTS_epsilon']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventTS_epsilon))
	{
		$event->setFieldDB('TS_epsilon', floatToSQL($new_eventTS_epsilon));
	}
	$new_eventTS_tau = htmlspecialchars($_POST['eventTS_tau']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventTS_tau))
	{
		$event->setFieldDB('TS_tau', floatToSQL($new_eventTS_tau));
	}

	$new_eventG2_default_r = htmlspecialchars($_POST['eventG2_default_r']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventG2_default_r))
	{
		$event->setFieldDB('G2_default_r', floatToSQL($new_eventG2_default_r));
	}
	$new_eventG2_default_RD = htmlspecialchars($_POST['eventG2_default_RD']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventG2_default_RD))
	{
		$event->setFieldDB('G2_default_RD', floatToSQL($new_eventG2_default_RD));
	}
	$new_eventG2_default_sigma = htmlspecialchars($_POST['eventG2_default_sigma']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventG2_default_sigma))
	{
		$event->setFieldDB('G2_default_sigma', floatToSQL($new_eventG2_default_sigma));
	}
	$new_eventG2_tau = htmlspecialchars($_POST['eventG2_tau']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventG2_tau))
	{
		$event->setFieldDB('G2_tau', floatToSQL($new_eventG2_tau));
	}
	$new_eventG2_epsilon = htmlspecialchars($_POST['eventG2_epsilon']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventG2_epsilon))
	{
		$event->setFieldDB('G2_epsilon', floatToSQL($new_eventG2_epsilon));
	}

	$new_eventrating_period = htmlspecialchars($_POST['eventrating_period']);
	if (preg_match("/^\d+\.*\d*$/", $new_eventrating_period))
	{
		$event->setFieldDB('rating_period', floatToSQL($new_eventrating_period));
	}
	
	$event->setFieldDB('IsChanged', 1);

	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}
if(isset($_POST['eventchallengessave']))
{
	/* Event Challenges enable/disable */
	$event->setFieldDB('ChallengesEnable', ($_POST['eventchallengesenable'] != "") ? 1 : 0);

	/* Event Max Dates per Challenge */
	$new_eventdatesperchallenge = htmlspecialchars($_POST['eventdatesperchallenge']);
	if (preg_match("/^\d+$/", $new_eventdatesperchallenge))
	{
		$event->setFieldDB('MaxDatesPerChallenge', $new_eventdatesperchallenge);
	}

	header("Location: eventmanage.php?eventid=$event_id");
	exit();
}

header("Location: eventmanage.php?eventid=$event_id");
exit;

?>
