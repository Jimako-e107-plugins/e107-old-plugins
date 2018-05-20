<?php
/**
* EventManage.php
*
*
*/

require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/event.php");
require_once(e_PLUGIN."ebattles/include/paginator.class.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/brackets.php");
require_once(e_PLUGIN."ebattles/include/gamer.php");

// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg	= "eventdescription,eventrules";  // set $e_wysiwyg before including HEADERF
require_once(HEADERF);
// Include userclass file
require_once(e_HANDLER."userclass_class.php");

/*******************************************************************
********************************************************************/
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");
$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/matchreport.js"></script>
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/event.js"></script>
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/slider.js"></script>
';

$event_id = intval($_GET['eventid']);
if (!$event_id)
{
	header("Location: ./events.php");
	exit();
}

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

$egame = mysql_result($result,0 , TBL_GAMES.".Name");
$egameid = mysql_result($result,0 , TBL_GAMES.".GameID");
$egameicon  = mysql_result($result,0 , TBL_GAMES.".Icon");
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

if($event->getField('FixturesEnable') == TRUE)
{
	$paginate = false;
	if($event->getField('Status')=='active')
	{
		$show_seeds_players = true;
		$can_change_seeds_players = false;
		$can_replace_player = true;

		$show_seeds_teams = true;
		$can_change_seeds_teams = false;
		$can_replace_team = true;
	}	
	else
	{
		$show_seeds_players = true;
		$can_change_seeds_players = true;
		$can_replace_player = false;

		$show_seeds_teams = true;
		$can_change_seeds_teams = true;
		$can_replace_team = false;
	}
}
else
{
	$paginate = true;
	$show_seeds_players = false;
	$can_change_seeds_players = false;
	$can_replace_player = false;

	$show_seeds_teams = false;
	$can_change_seeds_teams = false;
	$can_replace_team = false;
}

if($event->getField('Type')=='Team Ladder')
{
	$show_seeds_teams = false;
	$can_change_seeds_teams = false;
}

$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$eowner) $can_manage = 1;
if ($can_manage == 0)
{
	header("Location: ./eventinfo.php?eventid=$event_id");
	exit();
}

$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_EVENTM_L2.'</a></li>';
$text .= '<li><a href="#tabs-2">'.EB_EVENTM_L3.'</a></li>';
$text .= '<li><a href="#tabs-3">'.EB_EVENTM_L164.'</a></li>';
$text .= '<li><a href="#tabs-4">'.EB_EVENTM_L5.'</a></li>';
$text .= '<li><a href="#tabs-5">'.EB_EVENTM_L6.'</a></li>';
switch($competition_type)
{
case 'Ladder':
	$text .= '<li><a href="#tabs-6">'.EB_EVENTM_L7.'</a></li>';
	$text .= '<li><a href="#tabs-7">'.EB_EVENTM_L121.'</a></li>';
	if($event->getField('FixturesEnable') == TRUE)
	{
		$text .= '<li><a href="#tabs-8">'.EB_EVENTM_L143.'</a></li>';
	}
	break;
case 'Tournament':
	$text .= '<li><a href="#tabs-6">'.EB_EVENTM_L143.'</a></li>';
	break;
}
$text .= '</ul>';

//***************************************************************************************
// tab-page "Event Summary"
$text .= '<div id="tabs-1">';

$text .= '<table class="eb_table" style="width:95%">';
$text .= '<tbody>';
$text .= '<tr><td>';
$text .= '
<form action="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'" method="post">
'.ebImageTextButton('submit', 'magnify.png', EB_EVENTM_L133).'
</form>';
$text .= '</td></tr>';
$text .= '</tbody>';
$text .= '</table>';

$text .= '
<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">
<table class="eb_table" style="width:95%">
<tbody>
';

$text .= '<!-- Event Status -->';
$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L135.'<br />';
$text .= '</td>';
$text .= '<td class="eb_td">';

$text .= '<table class="table_left">';
$text .= '<tr>';
$text .= '<td>'.$event->eventStatusToString().'</td>';

if($eventStatus == 'draft')
{
	$text .= '<td>'.ebImageTextButton('eventpublish', 'thumb_up.png', EB_EVENTM_L137).'</td>';
}

$text .= '</tr>';
$text .= '</table>';

$text .= '</td>';
$text .= '</tr>';

$text .= '<!-- Event Owner -->';
$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L9.'<br />';
$text .= '<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$eowner.'">'.$eownername.'</a>';
$text .= '</td>';

$q_2 = "SELECT ".TBL_USERS.".*"
." FROM ".TBL_USERS;
$result_2 = $sql->db_Query($q_2);
$row = mysql_fetch_array($result_2);
$num_rows_2 = mysql_numrows($result_2);

$text .= '<td class="eb_td">';
$text .= '<table class="table_left">';
$text .= '<tr>';
$text .= '<td><select class="tbox" name="eventowner">';
for($j=0; $j<$num_rows_2; $j++)
{
	$uid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
	$uname  = mysql_result($result_2,$j, TBL_USERS.".user_name");

	if ($eowner == $uid)
	{
		$text .= '<option value="'.$uid.'" selected="selected">'.$uname.'</option>';
	}
	else
	{
		$text .= '<option value="'.$uid.'">'.$uname.'</option>';
	}
}
$text .= '</select>';
$text .= '</td>';
$text .= '<td>';
$text .= ebImageTextButton('eventchangeowner', 'user_go.ico', EB_EVENTM_L10);
$text .= '</td>';
$text .= '</tr>';
$text .= '</table>';
$text .= '</td>';
$text .= '</tr>';

$text .= '<!-- Event Mods -->';
$q = "SELECT ".TBL_EVENTMODS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_EVENTMODS.", "
.TBL_USERS
." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
."   AND (".TBL_USERS.".user_id = ".TBL_EVENTMODS.".User)";
$result = $sql->db_Query($q);
$numMods = mysql_numrows($result);
$text .= '
<tr>
';
$text .= '<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L11.'</td>';
$text .= '<td class="eb_td">';
if ($numMods>0)
{
	$text .= '<table class="table_left">';
	for($i=0; $i<$numMods; $i++){
		$modid  = mysql_result($result,$i, TBL_USERS.".user_id");
		$modname  = mysql_result($result,$i, TBL_USERS.".user_name");
		$text .= '<tr>';
		$text .= '<td><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$modid.'">'.$modname.'</a></td>';
		$text .= '<td>';
		$text .= '<div>';
		$text .= '<input type="hidden" name="eventmod" value="'.$modid.'"/>';
		$text .= ebImageTextButton('eventdeletemod', 'user_delete.ico', EB_EVENTM_L12, 'negative jq-button', EB_EVENTM_L13);
		$text .= '</div>';
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '</table>';
}
$q = "SELECT ".TBL_USERS.".*"
." FROM ".TBL_USERS;
$result = $sql->db_Query($q);
/* Error occurred, return given name by default */
$numUsers = mysql_numrows($result);
$text .= '
<table class="table_left">
<tr>
<td>
<select class="tbox" name="mod">
';
for($i=0; $i<$numUsers; $i++)
{
	$uid  = mysql_result($result,$i, TBL_USERS.".user_id");
	$uname  = mysql_result($result,$i, TBL_USERS.".user_name");
	$text .= '<option value="'.$uid.'">'.$uname.'</option>';
}
$text .= '
</select>
</td>
<td>
<div>
'.ebImageTextButton('eventaddmod', 'user_add.png', EB_EVENTM_L14).'
</div>
</td>
</tr>
</table>
';
$text .= '
</td>
</tr>
</tbody>
</table>
</form>
</div>
';  // tab-page "Event Summary"

//***************************************************************************************
// tab-page "Event Settings"
$text .= '<div id="tabs-2">';

$text .= $event->displayEventSettingsForm();

$text .= '
</div>
';  // tab-page "Event Settings"

//***************************************************************************************
// tab-page "Event Fixtures"
$text .= '<div id="tabs-3">';
$text .= '<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
$text .= '
<table class="eb_table" style="width:95%">
<tbody>
';
//<!-- Enable/Disable Fixtures -->
$disabled_str = '';
if(($competition_type=='Tournament') ||
		($event->getField('Status')=='active'))
{
	$disabled_str = 'disabled="disabled"';
}
$text .= '
<tr>
<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L165.'</td>
<td class="eb_td">
<div>
';
$text .= '<input class="tbox" type="checkbox" name="eventfixturesenable" '.$disabled_str.' ';
if($event->getField('FixturesEnable') == TRUE)
{
	$text .= ' checked="checked"/>';
}
else
{
	$text .= '/>';
}
$text .= '
</div>
</td>
</tr>
';

//<!-- Hide Fixtures -->
$text .= '
<tr>
<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L172.'</td>
<td class="eb_td"><select class="tbox" name="hide_fixtures">';
$text .= '<option value="0" '.($event->getField('HideFixtures') == "0" ? 'selected="selected"' : '').'>'.EB_EVENTM_L173.'</option>';
$text .= '<option value="1" '.($event->getField('HideFixtures') == "1" ? 'selected="selected"' : '').'>'.EB_EVENTM_L174.'</option>';
$text .= '</select>
</td>
</tr>
';		

//<!-- Max Number of Players -->
$text .= '
<tr>
<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L126.'</td>
<td class="eb_td">
<div>
';

if($event->getField('FixturesEnable') == TRUE)
{
	$disabled_str = ($event->getField('Status')!='active') ? '' : 'disabled="disabled"';
	$text .= '<select class="tbox" name="eventmaxnumberplayers" '.$disabled_str.'>';
	switch ($event->getField('Format'))
	{
	case 'Double Elimination':
		$text .= '<option value="4" '.($event->getField('MaxNumberPlayers') == "4" ? 'selected="selected"' : '') .'>4</option>';
		$text .= '<option value="8" '.($event->getField('MaxNumberPlayers') == "8" ? 'selected="selected"' : '') .'>8</option>';
		break;
	case 'Single Elimination':
		$text .= '<option value="2" '.($event->getField('MaxNumberPlayers') == "2" ? 'selected="selected"' : '') .'>2</option>';
		$text .= '<option value="4" '.($event->getField('MaxNumberPlayers') == "4" ? 'selected="selected"' : '') .'>4</option>';
		$text .= '<option value="8" '.($event->getField('MaxNumberPlayers') == "8" ? 'selected="selected"' : '') .'>8</option>';
		$text .= '<option value="16" '.($event->getField('MaxNumberPlayers') == "16" ? 'selected="selected"' : '') .'>16</option>';
		$text .= '<option value="32" '.($event->getField('MaxNumberPlayers') == "32" ? 'selected="selected"' : '') .'>32</option>';
		$text .= '<option value="64" '.($event->getField('MaxNumberPlayers') == "64" ? 'selected="selected"' : '') .'>64</option>';
		$text .= '<option value="128" '.($event->getField('MaxNumberPlayers') == "128" ? 'selected="selected"' : '') .'>128</option>';
		break;
	case 'Round-robin':
		$text .= '<option value="4" '.($event->getField('MaxNumberPlayers') == "4" ? 'selected="selected"' : '') .'>4</option>';
		$text .= '<option value="8" '.($event->getField('MaxNumberPlayers') == "8" ? 'selected="selected"' : '') .'>8</option>';
		$text .= '<option value="16" '.($event->getField('MaxNumberPlayers') == "16" ? 'selected="selected"' : '') .'>16</option>';
		break;
	case 'Double Round-robin':
		$text .= '<option value="4" '.($event->getField('MaxNumberPlayers') == "4" ? 'selected="selected"' : '') .'>4</option>';
		$text .= '<option value="8" '.($event->getField('MaxNumberPlayers') == "8" ? 'selected="selected"' : '') .'>8</option>';
		break;
	default:
		break;
	}

	$text .= '</select>';
}
else
{
	$text .= '<input class="tbox" type="text" name="eventmaxnumberplayers" size="2" value="'.$event->getField('MaxNumberPlayers').'"/>';
}

$text .= '
</div>
</td>
</tr>';

if($event->getField('FixturesEnable') == TRUE)
{
	switch($competition_type)
	{
		//<!-- Format -->
	case "Ladder":
		$disabled_str = '';
		if(($event->getField('Status')=='active')||
		   ($event->getField('FixturesEnable')==FALSE))
		{
			$disabled_str = 'disabled="disabled"';
		}
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L152.'</td>
		<td class="eb_td"><select class="tbox" name="eventformat" '.$disabled_str.'>';
		$text .= '<option value="Round-robin" '.($event->getField('Format') == "Round-robin" ? 'selected="selected"' : '').'>'.EB_EVENTM_L167.'</option>';
		$text .= '<option value="Double Round-robin" '.($event->getField('Format') == "Double Round-robin" ? 'selected="selected"' : '').'>'.EB_EVENTM_L168.'</option>';
		$text .= '</select>
		</td>
		</tr>
		';
		break;
	case "Tournament":
		$disabled_str = ($event->getField('Status')!='active') ? '' : 'disabled="disabled"';
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L152.'</td>
		<td class="eb_td"><select class="tbox" name="eventformat" '.$disabled_str.'>';
		$text .= '<option value="Single Elimination" '.($event->getField('Format') == "Single Elimination" ? 'selected="selected"' : '').'>'.EB_EVENTM_L153.'</option>';
		$text .= '<option value="Double Elimination" '.($event->getField('Format') == "Double Elimination" ? 'selected="selected"' : '').'>'.EB_EVENTM_L158.'</option>';
		$text .= '</select>
		</td>
		</tr>
		';
		break;
	}

	//<!-- Rounds -->
	$matchups = $event->getMatchups();
	$nbrRounds = count($matchups);
	// work around for events without rounds
	$event->initRounds();

	if($nbrRounds>0)
	{
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.($nbrRounds - 1).' '.EB_EVENTM_L4.'</td>
		<td class="eb_td">';

		$rounds = unserialize($event->getFieldHTML('Rounds'));
		$text .= '<table class="table_left"><tbody>';
		$text .= '<tr>';
		$text .= '<th>'.EB_EVENTM_L144.'</th>';
		$text .= '<th>'.EB_EVENTM_L145.'</th>';
		$text .= '<th>'.EB_EVENTM_L146.'</th>';
		$text .= '</tr>';
		for ($round = 1; $round < $nbrRounds; $round++) {
			$text .= '<tr>';
			$text .= '<td>'.EB_EVENTM_L144.' '.$round.'</td>';
			$text .= '<td><input class="tbox" type="text" size="40" name="round_title_'.$round.'" value="'.$rounds[$round]['Title'].'"/></td>';
			$text .= '<td><select class="tbox" name="round_bestof_'.$round.'">';
			$text .= '<option value="1" '.($rounds[$round]['BestOf'] == "1" ? 'selected="selected"' : '') .'>1</option>';
			$text .= '<option value="3" '.($rounds[$round]['BestOf'] == "3" ? 'selected="selected"' : '') .'>3</option>';
			$text .= '<option value="5" '.($rounds[$round]['BestOf'] == "5" ? 'selected="selected"' : '') .'>5</option>';
			$text .= '<option value="7" '.($rounds[$round]['BestOf'] == "7" ? 'selected="selected"' : '') .'>7</option>';
			$text .= '</select></td>';
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';
		$text .= '</td></tr>';
		//var_dump($rounds);
	}
}
// ------------------------------
$text .= '
</tbody>
</table>
';

//<!-- Save Button -->
$text .= '
<table><tr><td>
<div>
'.ebImageTextButton('eventfixturessave', 'disk.png', EB_EVENTM_L166).'
</div>
</td></tr></table>

</form>
</div>
';  // tab-page "Event Fixtures"

//***************************************************************************************
// tab-page "Event Players/Teams"
$text .= '<div id="tabs-4">';

$pages = new Paginator;

$array = array(
'name'   => array(EB_EVENTM_L55, TBL_USERS.'.user_name'),
'joined' => array(EB_EVENTM_L56, TBL_PLAYERS.'.Joined')
);

if (!isset($_GET['orderby'])) $_GET['orderby'] = 'joined';
$orderby= eb_sanitize($_GET['orderby']);

$sort = "DESC";
if(isset($_GET["sort"]) && !empty($_GET["sort"]))
{
	$sort = ($_GET["sort"]=="ASC") ? "DESC" : "ASC";
}

$totalItems = $nbr_players;
$pages->items_total = $totalItems;
$pages->mid_range = eb_PAGINATION_MIDRANGE;
$pages->paginate();

/* Number of teams */
switch($event->getField('Type'))
{
case "Team Ladder":
case "Clan Ladder":
case "Clan Tournament":
	$text .= '<div class="spacer">';
	$text .= '<p>';
	$text .= $nbr_teams.' '.EB_EVENTM_L114.'<br />';
	$text .= '</p>';
	$text .= '</div>';
	break;
default:
}

/* Number of players */
switch($event->getField('Type'))
{
case "One Player Ladder":
case "Team Ladder":
case "One Player Tournament":
	$text .= '<div class="spacer">';
	$text .= '<p>';
	$text .= $nbr_players.' '.EB_EVENTM_L40.'<br />';
	$text .= '</p>';
	$text .= '</div>';
	break;
default:
}

/* Add Team/Player */
$can_signup = 0;
$cannot_signup_str = EB_EVENT_L75;
$can_checkin = 0;
$kick_enable = 1;
$del_player_games_enable = 1;
$del_team_games_enable = 1;

$max_num_players_reached = 0;
switch($event->getMatchPlayersType())
{
case 'Players':
	if(($eMaxNumberPlayers != 0)&&($nbr_players >= $eMaxNumberPlayers))	$max_num_players_reached = 1;
	break;
case 'Teams':
	if(($eMaxNumberPlayers != 0)&&($nbr_teams >= $eMaxNumberPlayers))	$max_num_players_reached = 1;
	break;
default:
}

if($event->getField('FixturesEnable') == TRUE)
{
	switch($event->getField('Status'))
	{
	case 'draft':
		$can_signup = 1;
		break;
	case 'signup':
		// Do not close signup when max players limit is reached
		$can_signup = 1;
		break;
	case 'checkin':
		$can_checkin = 1;
		$can_signup = 1;
		break;
	case 'active':
		// late-signups ok.
		$can_signup = 1;
		$can_checkin = 1;
		break;
	case 'finished':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L83;
		break;
	}
}
if($event->getField('FixturesEnable') == FALSE)
{
	switch($event->getField('Status'))
	{
	case 'draft':
		$can_signup = 1;
		break;
	case 'signup':
	case 'checkin':
	case 'active':
		$can_signup = 1;
		$can_checkin = 1;
		break;
	case 'finished':
		$can_signup = 0;
		$cannot_signup_str = EB_EVENT_L83;
		break;
	}
}

if($can_signup == 1)
{
	switch($event->getField('Type'))
	{
	case "Team Ladder":
	case "Clan Ladder":
	case "Clan Tournament":
		// Form to add a team's division to the event
		$q = "SELECT ".TBL_DIVISIONS.".*, "
		.TBL_CLANS.".*"
		." FROM ".TBL_DIVISIONS.", "
		.TBL_CLANS
		." WHERE (".TBL_DIVISIONS.".Game = '$egameid')"
		."   AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)";
		$result = $sql->db_Query($q);
		/* Error occurred, return given name by default */
		$numDivisions = mysql_numrows($result);

		$text .= '<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
		$text .= '
		<table class="eb_table" style="width:95%">
		<tbody>
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L41.'</td>
		<td class="eb_td">
		<table class="table_left">
		<tr>
		<td><div><select class="tbox" name="division">
		';
		for($i=0; $i<$numDivisions; $i++)
		{
			$did  = mysql_result($result,$i, TBL_DIVISIONS.".DivisionID");
			$dname  = mysql_result($result,$i, TBL_CLANS.".Name");

			$q_Teams = "SELECT COUNT(*) as nbrTeams"
			." FROM ".TBL_TEAMS
			." WHERE (".TBL_TEAMS.".Event = '$event_id')"
			." AND (".TBL_TEAMS.".Division = '$did')";
			$result_Teams = $sql->db_Query($q_Teams);
			$row = mysql_fetch_array($result_Teams);
			$nbrTeams = $row['nbrTeams'];
			if ($nbrTeams==0)
			{
				$text .= '<option value="'.$did.'">'.$dname.'</option>';
			}
		}
		$text .= '
		</select></div></td>
		<td>'.ebImageTextButton('eventaddteam', 'user_add.png', EB_EVENTM_L42).'</td>
		<td><div><input class="tbox" type="checkbox" name="eventaddteamnotify"/>'.EB_EVENTM_L43.'</div></td>
		</tr>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		</form>
		';
		break;
	case "One Player Ladder":
	case "One Player Tournament":
		// Form to add a player to the event
		$q = "SELECT ".TBL_GAMERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_GAMERS.".Game = '$egameid')"
		."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)";
		$result = $sql->db_Query($q);
		$numUsers = mysql_numrows($result);
		$text .= '<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
		$text .= '
		<table class="eb_table" style="width:95%">
		<tbody>
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L44.'</td>
		<td class="eb_td">
		<table class="table_left">
		<tr>
		<td><div><select class="tbox" name="player">
		';
		for($i=0; $i<$numUsers; $i++)
		{
			$uid  = mysql_result($result,$i, TBL_USERS.".user_id");
			$uname  = mysql_result($result,$i, TBL_GAMERS.".Name");

			// fm: can we do this in 1 query?
			$q_Players = "SELECT COUNT(*) as NbrPlayers"
			." FROM ".TBL_PLAYERS.", "
			.TBL_GAMERS
			." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = '$uid')";
			$result_Players = $sql->db_Query($q_Players);
			$row = mysql_fetch_array($result_Players);
			$nbrPlayers = $row['NbrPlayers'];
			if ($nbrPlayers==0)
			{
				$text .= '<option value="'.$uid.'">'.$uname.'</option>';
			}
		}
		$text .= '
		</select></div></td>
		<td>'.ebImageTextButton('eventaddplayer', 'user_add.png', EB_EVENTM_L45).'</td>
		</tr>
		</table>
		</td>
		</tr>';
		if ($event->getField('Type') == "One Player Ladder")
		{
			$text .= '
			<tr>
			<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L159.'</td>
			<td class="eb_td">
			<table class="table_left">
			<tr>
			<td>'.r_userclass("eventadduserclass", $eventadduserclass, 'off', "member, classes").'</td>
			<td>'.ebImageTextButton('eventadduserclass_submit', 'user_add.png', EB_EVENTM_L160).'</td>
			</tr>
			</table>
			</td>
			</tr>';
		}
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40"></td>
		<td class="eb_td">
		<div><input class="tbox" type="checkbox" name="eventaddplayernotify"/>'.EB_EVENTM_L46.'</div>
		</td>
		</tr>
		</tbody>
		</table>
		</form>
		';
		break;
	default:
	}
}
else
{
	$text .= $cannot_signup_str.'<br />';
}

$text .= '<br />';
$text .= '<table class="table_left">';
$text .= '<tr><td style="vertical-align:top">'.EB_EVENTM_L47.':&nbsp;</td>';
$text .= '<td>'.EB_EVENTM_L48.'</td></tr>';
$text .= '<tr><td style="vertical-align:top">'.EB_EVENTM_L49.':&nbsp;</td>';
$text .= '<td>'.EB_EVENTM_L50.'</td></tr>';
$text .= '</table>';

switch($event->getField('Type'))
{
case "Team Ladder":
case "Clan Ladder":
case "Clan Tournament":
	// Show list of teams here
	if($show_seeds_teams == true)
	{
		$order_by_str = " ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
	}
	else
	{
		$order_by_str = " ORDER BY ".TBL_CLANS.".Name";
	}

	$q_Teams = "SELECT ".TBL_CLANS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_DIVISIONS.".* "
	." FROM ".TBL_CLANS.", "
	.TBL_TEAMS.", "
	.TBL_DIVISIONS
	." WHERE (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_TEAMS.".Event = '$event_id')"
	.$order_by_str;
	$result = $sql->db_Query($q_Teams);
	$nbr_teams = mysql_numrows($result);
	if(!$result || ($nbr_teams < 0)){
		$text .= EB_EVENTM_L51.'<br />';
	} else if ($nbr_teams == 0){
		$text .= EB_EVENTM_L115.'<br />';
	}
	else
	{
		if($can_change_seeds_teams == true)
		{
			$text .= '<table class="table_left">';
			$text .= '<tr>';
			$text .= '<td>'.EB_EVENTM_L156.'</td>';
			$text .= '<td><form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
			$text .= ebImageTextButton('eventteamsshuffle', '', EB_EVENTM_L155);
			$text .= '</form></td>';
			$text .='<td>
			<div id="ajaxSpinnerContainer">
			<img src="'.e_PLUGIN.'ebattles/images/ajax-loader.gif" title="working..." alt="working..."/>
			'.EB_EVENTM_L157.'
			</div>
			</td>';
			$text .= '</tr>';
			$text .= '</table>';
		}

		$teams_list_id = ($can_change_seeds_teams == true) ? 'teams_list_sortable' : 'teams_list';

		$text .= '<form id="teamsform" action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
		$text .= '<table id="'.$teams_list_id.'" class="eb_table" style="width:90%"><thead>';
		$text .= '<tr>';
		if($show_seeds_teams == true)
		{
			// Column "Seed"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L154.'</th>';
		}
		// Column "Team"
		$text .= '<th class="eb_th2">'.EB_CLANS_L5.'</th>';
		// Column "Joined"
		$text .= '<th class="eb_th2">'.EB_EVENTM_L56.'</th>';
		if($event->getField('CheckinDuration') > 0)
		{
			// Column "Checked in"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L170.'</th>';
		}
		// Column "Actions"
		$text .= '<th class="eb_th2">'.EB_EVENTM_L59;
		$text .= '<input type="hidden" id="ban_team" name="ban_team" value=""/>';
		$text .= '<input type="hidden" id="unban_team" name="unban_team" value=""/>';
		$text .= '<input type="hidden" id="kick_team" name="kick_team" value=""/>';
		$text .= '<input type="hidden" id="del_team_games" name="del_team_games" value=""/>';
		$text .= '<input type="hidden" id="del_team_awards" name="del_team_awards" value=""/>';
		$text .= '<input type="hidden" id="checkin_team" name="checkin_team" value=""/>';
		$text .= '<input type="hidden" id="replace_team" name="replace_team" value=""/>';
		$text .= '</th>';
		$text .= '</tr></thead>';
		$text .= '<tbody>';

		$can_replace_seed = array();
		for($seed=1; $seed<=$eMaxNumberPlayers; $seed++){
			$can_replace_seed[$seed] = true;
		}
		
		$can_replace = false;
		for($team=0; $team < $nbr_teams; $team++)
		{
			$clan_id  = mysql_result($result,$team, TBL_CLANS.".ClanID");
			$clan = new Clan($clan_id);
			$tid  = mysql_result($result,$team, TBL_TEAMS.".TeamID");
			$tjoined  = mysql_result($result,$team, TBL_TEAMS.".Joined");
			$tjoined_local = $tjoined + TIMEOFFSET;
			$date  = date("d M Y",$tjoined_local);
			$waiting_list = FALSE;
			$tseed  = mysql_result($result,$team, TBL_TEAMS.".Seed");
			if($tseed == 0) $tseed = $team+1;
			if($tseed>$eMaxNumberPlayers)
			{
				$tseed = '';
				// Waiting list
				$waiting_list = true;
			}

			$tbanned = mysql_result($result,$team, TBL_TEAMS.".Banned");
			$tgames = mysql_result($result,$team, TBL_TEAMS.".GamesPlayed");
			$tcheckedin = mysql_result($result,$team, TBL_TEAMS.".CheckedIn");

			$q_2 = "SELECT DISTINCT ".TBL_TEAMS.".*"
				." FROM ".TBL_TEAMS.", "
				.TBL_SCORES
				." WHERE (".TBL_TEAMS.".TeamID = '$tid')"
				." AND (".TBL_SCORES.".Team = ".TBL_TEAMS.".TeamID)";
			$result_2 = $sql->db_Query($q_2);
			$tscores = mysql_numrows($result_2);

			$q_2 = "SELECT count(*) "
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_TEAMS
			." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_MATCHS.".Status = 'active')"
			." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
			." AND (".TBL_TEAMS.".TeamID = '$tid')";
			$result_2 = $sql->db_Query($q_2);
			$tmatches = mysql_result($result_2, 0);
			// Can replace only if the team has not played a match yet
			if($tmatches > 0) $can_replace_seed[$tseed] = false;

			$q_2 = "SELECT DISTINCT ".TBL_AWARDS.".*"
				." FROM ".TBL_AWARDS.", "
				.TBL_TEAMS
				." WHERE (".TBL_TEAMS.".TeamID = '$tid')"
				." AND (".TBL_AWARDS.".Team = ".TBL_TEAMS.".TeamID)";
			$result_2 = $sql->db_Query($q_2);
			$tawards = mysql_numrows($result_2);

			$image = "";
			if ($pref['eb_avatar_enable_teamslist'] == 1)
			{
				if($clan->getField('Image'))
				{
					$image = '<img '.getAvatarResize(getImagePath($clan->getField('Image'), 'team_avatars')).'/>';
				} else if ($pref['eb_avatar_default_team_image'] != ''){
					$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>';
				}
			}

			$text .= '<tr id="team_'.$tid.'">';
			if($show_seeds_teams == true)
			{
				// Column "Seed"
				if($can_replace_seed[$tseed] == true) $can_replace = true;

				$text .= '<td class="eb_td">'.$tseed;
				if($waiting_list == true)
				{
					if(($can_replace_team == true)&&($can_replace==true))
					{
						$text .= '<select class="tbox" name="replace_team_'.$tid.'">';
						for($seed=1; $seed<=$eMaxNumberPlayers; $seed++){
							if($can_replace_seed[$seed] == true)
							{
								$text .= '<option value="'.$seed.'">'.htmlspecialchars($seed).'</option>';
							}
						}
						$text .= '</select>';
						$text .= ' <a href="javascript:replace_team(\''.$tid.'\');" title="'.EB_EVENTM_L191.'""><img src="'.e_PLUGIN.'ebattles/images/arrow_refresh.png" alt="'.EB_EVENTM_L191.'"/></a>';
					}
					else
					{
						// Not seeded
						$text .= EB_EVENT_L103;
					}
				}
				$text .= '</td>';
			}
			// Column "Team"
			$text .= '<td class="eb_td">'.$image.'&nbsp;<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'">'.$clan->getField('Name').' ('.$clan->getField('Tag').')</a></td>';
			// Column "Joined"
			$text .= '<td class="eb_td">'.(($tbanned) ? EB_EVENTM_L54 : $date).'</td>';

			if($event->getField('CheckinDuration') > 0)
			{
				// Column "Checked in"
				$img = ($tcheckedin) ? '<img src="'.e_PLUGIN.'ebattles/images/tick.png" alt="'.EB_EVENTM_L64.'"/>' : '';
				$text .= '<td class="eb_td">'.$img.'</td>';
			}

			// Column "Actions"
			$text .= '<td class="eb_td">';
			if ($tbanned)
			{
				$text .= ' <a href="javascript:unban_team(\''.$tid.'\');" title="'.EB_EVENTM_L180.'" onclick="return confirm(\''.EB_EVENTM_L181.'\')"><img src="'.e_PLUGIN.'ebattles/images/user_go.ico" alt="'.EB_EVENTM_L60.'"/></a>';
			}
			else
			{
				$text .= ' <a href="javascript:ban_team(\''.$tid.'\');" title="'.EB_EVENTM_L182.'" onclick="return confirm(\''.EB_EVENTM_L183.'\')"><img src="'.e_PLUGIN.'ebattles/images/user_delete.ico" alt="'.EB_EVENTM_L62.'"/></a>';
			}
			if ($kick_enable==1)
			{
				$text .= ' <a href="javascript:kick_team(\''.$tid.'\');" title="'.EB_EVENTM_L184.'" onclick="return confirm(\''.EB_EVENTM_L185.'\')"><img src="'.e_PLUGIN.'ebattles/images/cross.png" alt="'.EB_EVENTM_L64.'"/></a>';
			}
			if (($del_team_games_enable==1)&&($tscores != 0))
			{
				$text .= ' <a href="javascript:del_team_games(\''.$tid.'\');" title="'.EB_EVENTM_L186.'" onclick="return confirm(\''.EB_EVENTM_L187.'\')"><img src="'.e_PLUGIN.'ebattles/images/controller_delete.ico" alt="'.EB_EVENTM_L66.'"/></a>';
			}
			if ($tawards != 0)
			{
				$text .= ' <a href="javascript:del_team_awards(\''.$tid.'\');" title="'.EB_EVENTM_L188.'" onclick="return confirm(\''.EB_EVENTM_L189.'\')"><img src="'.e_PLUGIN.'ebattles/images/award_star_delete.ico" alt="'.EB_EVENTM_L68.'"/></a>';
			}
			if($event->getField('CheckinDuration') > 0)
			{
				if(($tcheckedin != 1)&&($can_checkin==1))
				{
					$text .= ' <a href="javascript:checkin_team(\''.$tid.'\');" title="'.EB_EVENTM_L190.'""><img src="'.e_PLUGIN.'ebattles/images/tick.png" alt="'.EB_EVENTM_L190.'"/></a>';
				}
			}
			$text .= '</td>';
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';
		$text .= '</form>';
	}
	break;
default:
}
switch($event->getMatchPlayersType())
{
case 'Players':
	// Show list of players
	$orderby_array = $array["$orderby"];
	if($show_seeds_players == true)
	{
		$order_by_str = " ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";
	}
	else
	{
		$order_by_str = " ORDER BY $orderby_array[1] $sort";
	}

	$q_Players = "SELECT DISTINCT ".TBL_PLAYERS.".*, "
	.TBL_GAMERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	.$order_by_str
	.(($paginate==true)?" $pages->limit":'');
	$result = $sql->db_Query($q_Players);
	$nbr_players = mysql_numrows($result);
	if(!$result || ($nbr_players < 0)){
		$text .= EB_EVENTM_L51.'<br />';
	} else if($nbr_players == 0){
		$text .= EB_EVENTM_L52.'<br />';
	}
	else
	{
		if($paginate == true)
		{
			// Paginate
			$text .= '<br />';
			$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
			$text .= '<span style="float:right">';
			// Go To Page
			$text .= $pages->display_jump_menu();
			$text .= '&nbsp;&nbsp;&nbsp;';
			// Items per page
			$text .= $pages->display_items_per_page();
			$text .= '</span><br /><br />';
		}
		/* Display table contents */
		if($can_change_seeds_players == true)
		{
			$text .= '<table class="table_left">';
			$text .= '<tr>';
			$text .= '<td>'.EB_EVENTM_L156.'</td>';
			$text .= '<td><form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
			$text .= ebImageTextButton('eventplayersshuffle', '', EB_EVENTM_L155);
			$text .= '</form></td>';
			$text .='<td>
			<div id="ajaxSpinnerContainer">
			<img src="'.e_PLUGIN.'ebattles/images/ajax-loader.gif" title="working..." alt="working..."/>
			'.EB_EVENTM_L157.'
			</div>
			</td>';
			$text .= '</tr>';
			$text .= '</table>';
		}

		$players_list_id = ($can_change_seeds_players == true) ? 'players_list_sortable' : 'players_list';

		$text .= '<form id="playersform" action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
		$text .= '<table id="'.$players_list_id.'" class="eb_table" style="width:90%"><thead>';
		$text .= '<tr>';
		if($show_seeds_players == true)
		{
			// Column "Seed"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L154.'</th>';
		}
		// Columns Player/Joined
		foreach($array as $opt=>$opt_array)
		{
			$text .= '<th class="eb_th2"><a href="'.e_PLUGIN.'ebattles/eventmanage.php?eventid='.$event_id.'&amp;orderby='.$opt.'&amp;sort='.$sort.'">'.$opt_array[0].'</a></th>';
		}

		if($event->getField('CheckinDuration') > 0)
		{
			// Column "Checked in"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L170.'</th>';
		}
		// Column "Actions"
		$text .= '<th class="eb_th2">'.EB_EVENTM_L59;
		$text .= '<input type="hidden" id="ban_player" name="ban_player" value=""/>';
		$text .= '<input type="hidden" id="unban_player" name="unban_player" value=""/>';
		$text .= '<input type="hidden" id="kick_player" name="kick_player" value=""/>';
		$text .= '<input type="hidden" id="del_player_games" name="del_player_games" value=""/>';
		$text .= '<input type="hidden" id="del_player_awards" name="del_player_awards" value=""/>';
		$text .= '<input type="hidden" id="checkin_player" name="checkin_player" value=""/>';
		$text .= '<input type="hidden" id="replace_player" name="replace_player" value=""/>';
		$text .= '</th>';
		$text .= '</tr></thead>';
		$text .= '<tbody>';

		$can_replace_seed = array();
		for($seed=1; $seed<=$eMaxNumberPlayers; $seed++){
			$can_replace_seed[$seed] = true;
		}

		$can_replace = false;
		for($player=0; $player < $nbr_players; $player++)
		{
			/* sc2:
			$pFactionIcon = mysql_result($result, $player , TBL_FACTIONS.".Icon");
			$pFactionName = mysql_result($result, $player , TBL_FACTIONS.".Name");
			if($pFactionName){
			$pFactionImage = ' <img '.getFactionIconResize($fIcon).' title="'.$fName.'"/>';
			} else {
			$pFactionImage = '';
			}
			*/
			$pid  = mysql_result($result, $player, TBL_PLAYERS.".PlayerID");
			$puid = mysql_result($result, $player, TBL_GAMERS.".User");
			$pname  = mysql_result($result, $player, TBL_GAMERS.".Name");
			$puniquegameid  = mysql_result($result, $player, TBL_GAMERS.".UniqueGameID");
			$pjoined  = mysql_result($result, $player, TBL_PLAYERS.".Joined");
			$pjoined_local = $pjoined + TIMEOFFSET;
			$date  = date("d M Y",$pjoined_local);
			$waiting_list = FALSE;
			$pseed  = mysql_result($result, $player, TBL_PLAYERS.".Seed");
			if($pseed == 0) $pseed = $player+1;
			if($pseed>$eMaxNumberPlayers)
			{
				$pseed = '';
				// Waiting list
				$waiting_list = true;
			}

			$pbanned = mysql_result($result, $player, TBL_PLAYERS.".Banned");
			$pgames = mysql_result($result, $player, TBL_PLAYERS.".GamesPlayed");
			$pteam = mysql_result($result, $player, TBL_PLAYERS.".Team");
			$pcheckedin = mysql_result($result, $player, TBL_PLAYERS.".CheckedIn");
			list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
			
			$q_2 = "SELECT DISTINCT ".TBL_PLAYERS.".*"
				." FROM ".TBL_PLAYERS.", "
				.TBL_SCORES
				." WHERE (".TBL_PLAYERS.".PlayerID = '$pid')"
				." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
			$result_2 = $sql->db_Query($q_2);
			$pscores = mysql_numrows($result_2);
			
			$q_2 = "SELECT count(*) "
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_PLAYERS
			." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_MATCHS.".Status = 'active')"
			." AND ((".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
			." OR   ((".TBL_PLAYERS.".Team = ".TBL_SCORES.".Team)"
			." AND   (".TBL_PLAYERS.".Team != 0)))"
			." AND (".TBL_PLAYERS.".PlayerID = '$pid')";
			$result_2 = $sql->db_Query($q_2);
			$pmatches = mysql_result($result_2, 0);
			// Can replace only if the player has not played a match yet
			if($pmatches > 0) $can_replace_seed[$pseed] = false;
			
			$q_2 = "SELECT DISTINCT ".TBL_AWARDS.".*"
				." FROM ".TBL_AWARDS.", "
				.TBL_PLAYERS
				." WHERE (".TBL_PLAYERS.".PlayerID = '$pid')"
				." AND (".TBL_AWARDS.".Player = ".TBL_PLAYERS.".PlayerID)";
			$result_2 = $sql->db_Query($q_2);
			$pawards = mysql_numrows($result_2);

			$image = "";
			// TBD: player image

			$text .= '<tr id="player_'.$pid.'">';
			if($show_seeds_players == true)
			{
				// Column "Seed"
				if($can_replace_seed[$pseed] == true) $can_replace = true;

				$text .= '<td class="eb_td">'.$pseed;
				if($waiting_list == true)
				{
					if(($can_replace_player == true)&&($can_replace==true))
					{
						$text .= '<select class="tbox" name="replace_player_'.$pid.'">';
						for($seed=1; $seed<=$eMaxNumberPlayers; $seed++){
							if($can_replace_seed[$seed] == true)
							{
								$text .= '<option value="'.$seed.'">'.htmlspecialchars($seed).'</option>';
							}
						}
						$text .= '</select>';
						$text .= ' <a href="javascript:replace_player(\''.$pid.'\');" title="'.EB_EVENTM_L191.'""><img src="'.e_PLUGIN.'ebattles/images/arrow_refresh.png" alt="'.EB_EVENTM_L191.'"/></a>';
					}
					else
					{
						// Not seeded
						$text .= EB_EVENT_L103;
					}
				}
				$text .= '</td>';
			}
			//sc2: $text .= '<td class="eb_td">'.$pFactionImage.'</td>';
			// Column "Player"
			$text .= '<td class="eb_td">'.$image.'&nbsp;<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$puid.'">'.$pclantag.$pname.(($puniquegameid!='')?'&nbsp;['.$puniquegameid.']':'').'</a></td>';
			// Column "Joined"
			$text .= '<td class="eb_td">'.(($pbanned) ? EB_EVENTM_L54 : $date).'</td>';
			if($event->getField('CheckinDuration') > 0)
			{
				// Column "Checked in"
				$img = ($pcheckedin) ? '<img src="'.e_PLUGIN.'ebattles/images/tick.png" alt="'.EB_EVENTM_L64.'"/>' : '';
				$text .= '<td class="eb_td">'.$img.'</td>';
			}

			// Column "Actions"
			$text .= '<td class="eb_td">';
			if ($pbanned)
			{
				$text .= ' <a href="javascript:unban_player(\''.$pid.'\');" title="'.EB_EVENTM_L60.'" onclick="return confirm(\''.EB_EVENTM_L61.'\')"><img src="'.e_PLUGIN.'ebattles/images/user_go.ico" alt="'.EB_EVENTM_L60.'"/></a>';
			}
			else
			{
				$text .= ' <a href="javascript:ban_player(\''.$pid.'\');" title="'.EB_EVENTM_L62.'" onclick="return confirm(\''.EB_EVENTM_L63.'\')"><img src="'.e_PLUGIN.'ebattles/images/user_delete.ico" alt="'.EB_EVENTM_L62.'"/></a>';
			}
			if ($kick_enable==1)
			{
				$text .= ' <a href="javascript:kick_player(\''.$pid.'\');" title="'.EB_EVENTM_L64.'" onclick="return confirm(\''.EB_EVENTM_L65.'\')"><img src="'.e_PLUGIN.'ebattles/images/cross.png" alt="'.EB_EVENTM_L64.'"/></a>';
			}
			if (($del_player_games_enable==1)&&($pscores != 0))
			{
				$text .= ' <a href="javascript:del_player_games(\''.$pid.'\');" title="'.EB_EVENTM_L66.'" onclick="return confirm(\''.EB_EVENTM_L67.'\')"><img src="'.e_PLUGIN.'ebattles/images/controller_delete.ico" alt="'.EB_EVENTM_L66.'"/></a>';
			}
			if ($pawards != 0)
			{
				$text .= ' <a href="javascript:del_player_awards(\''.$pid.'\');" title="'.EB_EVENTM_L68.'" onclick="return confirm(\''.EB_EVENTM_L69.'\')"><img src="'.e_PLUGIN.'ebattles/images/award_star_delete.ico" alt="'.EB_EVENTM_L68.'"/></a>';
			}
			if($event->getField('CheckinDuration') > 0)
			{
				if(($pcheckedin != 1)&&($can_checkin==1))
				{
					$text .= ' <a href="javascript:checkin_player(\''.$pid.'\');" title="'.EB_EVENTM_L171.'""><img src="'.e_PLUGIN.'ebattles/images/tick.png" alt="'.EB_EVENTM_L171.'"/></a>';
				}
			}
			$text .= '</td>';
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';
		$text .= '</form>';
	}
	break;
default:
}

$text .= '
</div>
';  // tab-page "Event Players/Teams"

//***************************************************************************************
// tab-page "Event Reset"
$text .= '<div id="tabs-5">';
$text .= '<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
$text .= '
<table class="eb_table" style="width:95%">
<tbody>
';
switch($competition_type)
{
case 'Ladder':
case 'Tournament':
	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L70.'<div class="smalltext">'.EB_EVENTM_L71.'</div></td>
	<td class="eb_td">
	';
	$text .= ebImageTextButton('eventresetscores', 'bin_closed.png', EB_EVENTM_L72, '', EB_EVENTM_L73);
	$text .= '
	</td>
	</tr>
	';
	break;
}
$text .= '
<tr>
<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L74.'<div class="smalltext">'.EB_EVENTM_L75.'</div></td>
<td class="eb_td">
';
$text .= ebImageTextButton('eventresetevent', 'bin_closed.png', EB_EVENTM_L76, '', EB_EVENTM_L77);
$text .= '
</td>
</tr>
';
$text .= '
<tr>
<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L78.'<div class="smalltext">'.EB_EVENTM_L79.'</div></td>
<td class="eb_td">
';
$text .= ebImageTextButton('eventdelete', 'delete.png', EB_EVENTM_L80, 'negative jq-button', EB_EVENTM_L81);
$text .= '
</td>
</tr>
';
switch($competition_type)
{
case 'Ladder':
	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L82.'<div class="smalltext">'.EB_EVENTM_L83.'</div></td>
	<td class="eb_td">
	';
	$text .= ebImageTextButton('eventupdatescores', 'chart_curve.png', EB_EVENTM_L84, '', EB_EVENTM_L85);
	$text .= '
	</td>
	</tr>
	';
	break;
}
$text .= '
</tbody>
</table>
</form>
</div>
';  // tab-page "Event Reset"

switch($competition_type)
{
case 'Ladder':
	//***************************************************************************************
	// tab-page "Event Stats"
	$cat_index = 0;
	$text .= '<div id="tabs-6">';
	$text .= EB_EVENTM_L86;
	$text .= "
	<script type='text/javascript'>
	var A_TPL = {
	'b_vertical' : false,
	'b_watch': true,
	'n_controlWidth': 100,
	'n_controlHeight': 16,
	'n_sliderWidth': 17,
	'n_sliderHeight': 16,
	'n_pathLeft' : 0,
	'n_pathTop' : 0,
	'n_pathLength' : 83,
	's_imgControl': 'images/slider/sldr3h_bg.gif',
	's_imgSlider': 'images/slider/sldr3h_sl.gif',
	'n_zIndex': 1
	}
	</script>
	";

	$text .= '<form id="eventstatsform" action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
	$text .= '
	<table class="eb_table" style="width:95%"><tbody>';

	$text .= '
	<tr>
	<th class="eb_th2">'.EB_EVENTM_L87.'</th>
	<th class="eb_th2" colspan="2">'.EB_EVENTM_L88.'</th>
	<th class="eb_th2">'.EB_EVENTM_L89.'</th>
	</tr>';
	if ($event->getField('Type') != "Clan Ladder")
	{
		$text .= '
		<tr>
		<td class="eb_td">'.EB_EVENTM_L90.'</td>
		<td class="eb_td">
		<input name="sliderValue'.$cat_index.'" id="sliderValue'.$cat_index.'" class="tbox" type="text" size="3" onchange="A_SLIDERS['.$cat_index.'].f_setValue(this.value)"/>
		</td>
		<td class="eb_td">
		';
		$text .= "
		<script type='text/javascript'>
		var A_INIT = {
		's_form' : 'eventstatsform',
		's_name': 'sliderValue".$cat_index."',
		'n_minValue' : 0,
		'n_maxValue' : 10,
		'n_value' : ".$event->getField('nbr_games_to_rank').",
		'n_step' : 1
		}

		new slider(A_INIT, A_TPL);
		</script>
		";
		$text .= '
		</td>
		<td class="eb_td"></td>
		</tr>
		';
		$cat_index ++;
	}

	if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "Clan Ladder"))
	{
		$text .= '
		<tr>
		<td class="eb_td">'.EB_EVENTM_L91.'</td>
		<td class="eb_td">
		<input name="sliderValue'.$cat_index.'" id="sliderValue'.$cat_index.'" class="tbox" type="text" size="3" onchange="A_SLIDERS['.$cat_index.'].f_setValue(this.value)"/>
		</td>
		<td class="eb_td">
		';
		$text .= "
		<script type='text/javascript'>
		var A_INIT = {
		's_form' : 'eventstatsform',
		's_name': 'sliderValue".$cat_index."',
		'n_minValue' : 0,
		'n_maxValue' : 10,
		'n_value' : ".$event->getField('nbr_team_games_to_rank').",
		'n_step' : 1
		}

		new slider(A_INIT, A_TPL);
		</script>
		";
		$text .= '
		</td>
		<td class="eb_td"></td>
		</tr>
		';
		$cat_index ++;
	}

	$q_1 = "SELECT ".TBL_STATSCATEGORIES.".*"
	." FROM ".TBL_STATSCATEGORIES
	." WHERE (".TBL_STATSCATEGORIES.".Event = '$event_id')";

	$result_1 = $sql->db_Query($q_1);
	$numCategories = mysql_numrows($result_1);

	$rating_max=0;
	for($i=0; $i<$numCategories; $i++)
	{
		$cat_name = mysql_result($result_1,$i, TBL_STATSCATEGORIES.".CategoryName");
		$cat_min = mysql_result($result_1,$i, TBL_STATSCATEGORIES.".CategoryMinValue");
		$cat_max = mysql_result($result_1,$i, TBL_STATSCATEGORIES.".CategoryMaxValue");
		$cat_InfoOnly = mysql_result($result_1,$i, TBL_STATSCATEGORIES.".InfoOnly");

		switch ($cat_name)
		{

		case "ELO":
			$cat_name_display = EB_EVENTM_L92;
			break;
		case "GamesPlayed":
			$cat_name_display = EB_EVENTM_L93;
			break;
		case "VictoryRatio":
			$cat_name_display = EB_EVENTM_L94;
			break;
		case "VictoryPercent":
			$cat_name_display = EB_EVENTM_L95;
			break;
		case "WinDrawLoss":
			$cat_name_display = EB_EVENTM_L96;
			break;
		case "UniqueOpponents":
			$cat_name_display = EB_EVENTM_L97;
			break;
		case "OpponentsELO":
			$cat_name_display = EB_EVENTM_L98;
			break;
		case "Streaks":
			$cat_name_display = EB_EVENTM_L99;
			break;
		case "Skill":
			$cat_name_display = EB_EVENTM_L100;
			break;
		case "Glicko2":
			$cat_name_display = EB_EVENTM_L192;
			break;
		case "Score":
			$cat_name_display = EB_EVENTM_L101;
			break;
		case "ScoreAgainst":
			$cat_name_display = EB_EVENTM_L102;
			break;
		case "ScoreDiff":
			$cat_name_display = EB_EVENTM_L103;
			break;
		case "Points":
			$cat_name_display = EB_EVENTM_L104;
			break;
		case "Forfeits":
			$cat_name_display = EB_EVENTM_L212;
			break;
		case "ForfeitsPercent":
			$cat_name_display = EB_EVENTM_L213;
			break;
		default:
		}

		//---------------------------------------------------
		$text .= '
		<tr>
		<td class="eb_td">'.$cat_name_display.'</td>
		<td class="eb_td">
		<input name="sliderValue'.$cat_index.'" id="sliderValue'.$cat_index.'" class="tbox" type="text" size="3" onchange="A_SLIDERS['.$cat_index.'].f_setValue(this.value)"/>
		</td>
		<td class="eb_td">
		';
		$text .= "
		<script type='text/javascript'>
		var A_INIT = {
		's_form' : 'eventstatsform',
		's_name': 'sliderValue".$cat_index."',
		'n_minValue' : 0,
		'n_maxValue' : 100,
		'n_value' : ".$cat_max.",
		'n_step' : 1
		}

		new slider(A_INIT, A_TPL);
		</script>
		";
		$text .= '</td>';

		$text .= '
		<td class="eb_td">
		<input class="tbox" type="checkbox" name="infoonly'.$i.'" value="1"
		';
		if ($cat_InfoOnly == TRUE)
		{
			$text .= ' checked="checked"';
		}
		else
		{
			$rating_max+=$cat_max;

		}
		$text .= '/></td>';

		$text .= '</tr>';
		//----------------------------------------

		$cat_index++;
	}

	$text .= '
	<tr>
	<td class="eb_td">'.EB_EVENTM_L105.'</td>
	<td class="eb_td">'.$rating_max.'</td>
	<td class="eb_td" colspan="2">
	<input class="tbox" type="checkbox" name="hideratings" value="1"
	';
	if ($event->getField('hide_ratings_column') == TRUE)
	{
		$text .= ' checked="checked"';
	}
	$text .= '/>&nbsp;'.EB_EVENTM_L106.'</td>';

	$text .= '
	</tr></tbody></table><br/>';
	
	//<!-- Advanced settings -->
	$text .= EB_EVENTM_L193.'<br/>';
	
	$text .= '
	<table class="eb_table" style="width:95%">
	<tbody>
	';
	//<!-- ELO -->
	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L194.'</td>
	<td class="eb_td">
	<table class="table_left">
	<tr>
	<td>'.EB_EVENTM_L195.'</td>
	<td>'.EB_EVENTM_L196.'</td>
	<td>'.EB_EVENTM_L197.'</td>
	</tr>
	<tr>
	<td>
	<div><input class="tbox" type="text" name="eventELO_default" value="'.$event->getField('ELO_default').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventELO_K" value="'.$event->getField('ELO_K').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventELO_M" value="'.$event->getField('ELO_M').'"/></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	';
	
	//<!-- TrueSkill -->
	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L198.'</td>
	<td class="eb_td">
	<table class="table_left">
	<tr>
	<td>'.EB_EVENTM_L199.'</td>
	<td>'.EB_EVENTM_L200.'</td>
	<td>'.EB_EVENTM_L201.'</td>
	<td>'.EB_EVENTM_L202.'</td>
	<td>'.EB_EVENTM_L203.'</td>
	</tr>
	<tr>
	<td>
	<div><input class="tbox" type="text" name="eventTS_default_mu" value="'.$event->getField('TS_default_mu').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventTS_default_sigma" value="'.$event->getField('TS_default_sigma').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventTS_beta" value="'.$event->getField('TS_beta').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventTS_epsilon" value="'.$event->getField('TS_epsilon').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventTS_tau" value="'.$event->getField('TS_tau').'"/></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	';
	
	//<!-- Glicko 2 -->
	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L204.'</td>
	<td class="eb_td">
	<table class="table_left">
	<tr>
	<td>'.EB_EVENTM_L205.'</td>
	<td>'.EB_EVENTM_L206.'</td>
	<td>'.EB_EVENTM_L207.'</td>
	<td>'.EB_EVENTM_L208.'</td>
	<td>'.EB_EVENTM_L209.'</td>
	</tr>
	<tr>
	<td>
	<div><input class="tbox" type="text" name="eventG2_default_r" value="'.$event->getField('G2_default_r').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventG2_default_RD" value="'.$event->getField('G2_default_RD').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventG2_default_sigma" value="'.$event->getField('G2_default_sigma').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventG2_tau" value="'.$event->getField('G2_tau').'"/></div>
	</td>
	<td>
	<div><input class="tbox" type="text" name="eventG2_epsilon" value="'.$event->getField('G2_epsilon').'"/></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	';

	$text .= '
	<tr>
	<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L210.'</td>
	<td class="eb_td">
	<table class="table_left">
	<tr>
	<td>
	<div><input class="tbox" type="text" name="eventrating_period" value="'.$event->getField('rating_period').'"/></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	';
	
	$text .= '
	</tbody>
	</table>
	';
	
	$text .= '
	<!-- Save Button -->
	<table><tr><td>
	<div>
	'.ebImageTextButton('eventstatssave', 'disk.png', EB_EVENTM_L107).'
	</div>
	</td></tr></table>
	</form>
	</div>';   // tab-page "Event Stats"

	//***************************************************************************************
	// tab-page "Event Challenges"
	$text .= '<div id="tabs-7">';
	$text .= '<form action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$event_id.'" method="post">';
	$text .= '
	<table class="eb_table" style="width:95%">
	<tbody>
	';
	//<!-- Enable/Disable Challenges -->
	$text .= '
	<tr>
	<td class="eb_td"><b>'.EB_EVENTM_L122.'</b></td>
	<td class="eb_td">
	<div>
	';
	$text .= '<input class="tbox" type="checkbox" name="eventchallengesenable"';
	if ($event->getField('ChallengesEnable') == TRUE)
	{
		$text .= ' checked="checked"/>';
	}
	else
	{
		$text .= '/>';
	}
	$text .= '
	</div>
	</td>
	</tr>
	';

	//<!-- Max number of Dates per Challenge -->
	$text .= '
	<tr>
	<td class="eb_td"><b>'.EB_EVENTM_L124.'</b></td>
	<td class="eb_td">
	<div>
	';
	$text .= '<input class="tbox" type="text" name="eventdatesperchallenge" size="2" value="'.$event->getField('MaxDatesPerChallenge').'"/>';
	$text .= '
	</div>
	</td>
	</tr>
	';

	// ------------------------------
	$text .= '
	</tbody>
	</table>
	';

	//<!-- Save Button -->
	$text .= '
	<table><tr><td>
	<div>
	'.ebImageTextButton('eventchallengessave', 'disk.png', EB_EVENTM_L123).'
	</div>
	</td></tr></table>

	</form>
	</div>
	';  // tab-page "Event Challenges"
	if($event->getField('FixturesEnable') == TRUE)
	{
		// tab-page "Brackets"
		$text .= '<div id="tabs-8">';

		list($bracket_html) = $event->brackets(false, 0, 'round-robin');
		$text .= $bracket_html;

		$text .= '</div>';  // tab-page "Brackets"
	}
	break;
case 'Tournament':
	//***************************************************************************************
	// tab-page "Brackets"
	$text .= '<div id="tabs-6">';

	list($bracket_html) = $event->brackets(false, 0, 'elimination');
	$text .= $bracket_html;

	$text .= '</div>';  // tab-page "Brackets"
	break;
}
$text .= '</div>';

$ns->tablerender($event->getField('Name')." ($egame - ".$event->eventTypeToString().") - ".EB_EVENTM_L1, $text);
require_once(FOOTERF);
exit;
?>
