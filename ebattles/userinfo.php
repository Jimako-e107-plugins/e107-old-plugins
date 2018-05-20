<?php
/**
* UserInfo.php
*
* This page is for users to view their account information
* with a link added for them to edit the information.
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/paginator.class.php");
require_once(e_HANDLER."rate_class.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/match.php");
require_once(e_PLUGIN."ebattles/include/challenge.php");

/*******************************************************************
********************************************************************/
require_once(HEADERF);

$pages = new Paginator;
$rater = new rater();

$text .= '';
$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/matchreport.js"></script>
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/event.js"></script>
';
$text .= "
<script type='text/javascript'>
<!--//
function edit_gamer(v)
{
document.getElementById('edit_gamer').value=v;
document.getElementById('gamersform').submit();
}
//-->
</script>
";
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

/* User */
$req_user = intval($_GET['user']);
$game_id = intval($_GET['gameid']);

if(!$req_user)
{
	$text .= '<br />'.EB_ERROR.'<br />';
	$ns->tablerender(EB_USER_L1, $text);
	require_once(FOOTERF);
	exit;
}

$events_link    = e_PLUGIN.'ebattles/events.php';
$teams_link     = e_PLUGIN.'ebattles/clans.php';

/* Logged in user viewing own account */
if(strcmp(USERID,$req_user) == 0){
}
/* Visitor not viewing own account */
else{
}

$q2 = "SELECT ".TBL_USERS.".*"
." FROM ".TBL_USERS
." WHERE (".TBL_USERS.".user_id = $req_user)";
$result2 = $sql->db_Query($q2);
$uid  = mysql_result($result2,0, TBL_USERS.".user_id");
$uname  = mysql_result($result2,0, TBL_USERS.".user_name");

$games_links_list = '';
$q = " SELECT *"
." FROM ".TBL_GAMERS.", "
.TBL_GAMES
." WHERE (".TBL_GAMERS.".User = '$req_user')"
."   AND (".TBL_GAMERS.".Game = ".TBL_GAMES.".GameID)";

$result = $sql->db_Query($q);
$num_gamers = mysql_numrows($result);
if ($num_gamers>0)
{
	//$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L35.'</div>';

	// Display list of games icons
	$games_links_list = '<div class="spacer">';
	for($i=0; $i<$num_gamers; $i++)
	{
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
		if($game_id=="") $game_id = $gid;
		
		if($gid==$game_id)
		{
			$gname_selected = $gname;
		}

		$games_links_list .= '<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$req_user.'&amp;gameid='.$gid.'"><img '.getGameIconResize($gicon).' title="'.$gname.'"/></a>';
		$games_links_list .= '&nbsp;';
	}
	$games_links_list .= '<br /><b>'.$gname_selected.'</b></div><br />';
}


$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_USER_L2.'</a></li>';
$text .= '<li><a href="#tabs-2">'.EB_USER_L3.'</a></li>';
$text .= '<li><a href="#tabs-3">'.EB_USER_L4.'</a></li>';
$text .= '<li><a href="#tabs-4">'.EB_USER_L5.'</a></li>';
$text .= '<li><a href="#tabs-5">'.EB_USER_L6.'</a></li>';
$text .= '</ul>';

/*
---------------------
Player Profile
---------------------
*/
$text .= '<div id="tabs-1">';    // tab-page "Profile"
$text .= $games_links_list;

/* Link to user profile */
$text .= '<p>';
$text .= EB_USER_L7.': <a href="'.e_BASE.'user.php?id.'.$req_user.'">'.$uname.'</a>';
$text .= '</p>';

/* Display list of games for which the user has a profile */
//$text .= '<br /><div class="spacer"><b>'.EB_USER_L34.'</b></div>';


$q = " SELECT *"
." FROM ".TBL_GAMERS.", "
.TBL_GAMES
." WHERE (".TBL_GAMERS.".User = '$req_user')"
."   AND (".TBL_GAMERS.".Game = ".TBL_GAMES.".GameID)"
."   AND (".TBL_GAMES.".GameID = '$game_id')";
$result = $sql->db_Query($q);
$num_gamers = mysql_numrows($result);
if ($num_gamers>0)
{
	/* Display table contents */
	$text .= '<form id="gamersform" action="'.e_PLUGIN.'ebattles/userprocess.php?userid='.$req_user.'" method="post">';
	$text .= '<div><input type="hidden" id="edit_gamer" name="edit_gamer" value=""/></div>';
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L36;
	//$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L37;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L38;
	$text .= '</th>';
	$text .= '</tr>';

	for($i=0; $i<$num_gamers; $i++)
	{
		$gName  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gIcon = mysql_result($result,$i , TBL_GAMES.".Icon");
		$gid = mysql_result($result,$i , TBL_GAMES.".GameID");
		$pID = mysql_result($result, $i , TBL_GAMERS.".GamerID");
		$pName = mysql_result($result, $i , TBL_GAMERS.".Name");
		$pGamer = mysql_result($result, $i , TBL_GAMERS.".UniqueGameID");
		$text .= '<tr>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($gIcon).'/> '.$gName;
		//$text .= '</td>';
		if(strcmp(USERID,$req_user) == 0){
			$text .= '<td class="eb_td">';
			$text .= '<input class="tbox" type="text" name="gamername'.$pID.'" size="20" value="'.$pName.'" maxlength="64"/>';
			$text .= '</td>';
			$text .= '<td class="eb_td">';
			$text .= '<input class="tbox" type="text" name="gameruniqueid'.$pID.'" size="40" value="'.$pGamer.'" maxlength="64"/>';
			$text .= '</td>';
			$text .= '<td class="eb_td">';
			$text .= '<a href="javascript:edit_gamer(\''.$pID.'\');" title="'.EB_USER_L39.'"><img src="'.e_PLUGIN.'ebattles/images/page_white_edit.png" alt="'.EB_USER_L39.'"/></a>';
			$text .= '</td>';
		}
		/* Visitor not viewing own account */
		else{
			$text .= '<td class="eb_td">';
			$text .= $pName;
			$text .= '</td>';
			$text .= '<td class="eb_td">';
			$text .= $pGamer;
			$text .= '</td>';
		}
		$text .= '</tr>';
	}
	$text .= '</table>';
	$text .= '</form>';
}
else
{
	if(strcmp(USERID,$req_user) == 0){
		$text .= '<div>'.EB_USER_L40.'</div>';
	}
	/* Visitor not viewing own account */
	else{
		$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L41.'</div>';
	}
}	

$text .= '</div>';    // tab-page "Profile"

$text .= '<div id="tabs-2">';    // tab-page "Events"
// Display list of games icons
$text .= $games_links_list;

if((strcmp(USERID,$req_user) == 0)&&(check_class($pref['eb_events_create_class'])))
{
	$text .= '<table class="table_left">';
	$text .= '<tr>';
	$text .= '<td>';
	$text .= '<form action="'.e_PLUGIN.'ebattles/eventcreate.php" method="post">';
	$text .= '<div>';
	$text .= '<input type="hidden" name="userid" value="'.$req_user.'"/>';
	$text .= '<input type="hidden" name="username" value="'.$uname.'"/>';
	$text .= ebImageTextButton('createevent', 'add.png', EB_EVENTS_L20);
	$text .= '</div>';
	$text .= '</form>';
	$text .= '</td>';
	$text .= '</tr>';	
	$text .= '</table>';
}

$text .= '<div class="spacer">';
$text .= '<a href="'.$events_link.'">';
$text .= EB_MENU_L2;
$text .= '</a>';
$text .= '</div>';

/* Display list of events where the user is the owner */
$q = " SELECT *"
." FROM ".TBL_EVENTS.", "
.TBL_GAMES
." WHERE (".TBL_EVENTS.".Owner = '$req_user')"
."   AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
."   AND (".TBL_GAMES.".GameID = '$game_id')";

$result = $sql->db_Query($q);
$num_events = mysql_numrows($result);

if ($num_events>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L18.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L19.'</div>';

	/* Display table contents */
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L10;
	$text .= '</th>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L33;
	//$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L14;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L31;
	$text .= '</th>';
	$text .= '</tr>';

	for($i=0; $i<$num_events; $i++)
	{
		$event_id  = mysql_result($result,$i, TBL_EVENTS.".EventID");
		$event = new Event($event_id);
		$gName  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gIcon = mysql_result($result,$i , TBL_GAMES.".Icon");

		$q_pending = "SELECT COUNT(*) as nbrMatchesPending"
		." FROM ".TBL_MATCHS
		." WHERE (".TBL_MATCHS.".Event = '$event_id')"
		."   AND (".TBL_MATCHS.".Status = 'pending')";
		$result_pending = $sql->db_Query($q_pending);
		$row = mysql_fetch_array($result_pending);
		$nbrMatchesPending = $row['nbrMatchesPending'];

		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>';
		$text .= '</td>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($gIcon).'/> '.$gName;
		//$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $event->eventStatusToString();
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		if ($event->getField('Owner') == USERID)
		{
			$text .= ' <a href="'.e_PLUGIN.'ebattles/eventmanage.php?eventid='.$event_id.'">'.EB_USER_L16.'</a>';
		}
		$text .= ($nbrMatchesPending>0) ? '<div><img src="'.e_PLUGIN.'ebattles/images/exclamation.png" alt="'.EB_MATCH_L13.'" title="'.EB_MATCH_L13.'" style="vertical-align:text-top;"/>&nbsp;<b>'.$nbrMatchesPending.'&nbsp;'.EB_EVENT_L64.'</b></div>' : '';
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '</table>';
}

/* Display list of events where the user is a moderator */
$q = " SELECT *"
." FROM ".TBL_EVENTMODS.", "
.TBL_EVENTS.", "
.TBL_GAMES
." WHERE (".TBL_EVENTMODS.".User = '$req_user')"
."   AND (".TBL_EVENTMODS.".Event = ".TBL_EVENTS.".EventID)"
."   AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
."   AND (".TBL_GAMES.".GameID = '$game_id')";

$result = $sql->db_Query($q);
$num_events = mysql_numrows($result);

if ($num_events>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L20.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L21.'</div>';

	/* Display table contents */
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L10;
	$text .= '</th>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L33;
	//$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L14;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L31;
	$text .= '</th>';
	$text .= '</tr>';

	for($i=0; $i<$num_events; $i++)
	{
		$event_id  = mysql_result($result,$i, TBL_EVENTS.".EventID");
		$event = new Event($event_id);
		$gName  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gIcon = mysql_result($result,$i , TBL_GAMES.".Icon");

		$q_pending = "SELECT COUNT(*) as nbrMatchesPending"
		." FROM ".TBL_MATCHS
		." WHERE (".TBL_MATCHS.".Event = '$event_id')"
		."   AND (".TBL_MATCHS.".Status = 'pending')";
		$result_pending = $sql->db_Query($q_pending);
		$row = mysql_fetch_array($result_pending);
		$nbrMatchesPending = $row['nbrMatchesPending'];

		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>';
		$text .= '</td>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($gIcon).'/> '.$gName;
		//$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $event->eventStatusToString();
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= ($nbrMatchesPending>0) ? '<div><img src="'.e_PLUGIN.'ebattles/images/exclamation.png" alt="'.EB_MATCH_L13.'" title="'.EB_MATCH_L13.'" style="vertical-align:text-top;"/>&nbsp;<b>'.$nbrMatchesPending.'&nbsp;'.EB_EVENT_L64.'</b></div>' : '';
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '</table>';
}

/* Display list of events where the user is a player */
$q = " SELECT *"
." FROM ".TBL_PLAYERS.", "
.TBL_GAMERS.", "
.TBL_EVENTS.", "
.TBL_GAMES
." WHERE (".TBL_GAMERS.".User = '$req_user')"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
."   AND (".TBL_PLAYERS.".Event = ".TBL_EVENTS.".EventID)"
."   AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
."   AND (".TBL_GAMES.".GameID = '$game_id')";

$result = $sql->db_Query($q);
$num_events = mysql_numrows($result);

if ($num_events>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L8.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L9.'</div>';

	/* Display table contents */
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L10;
	$text .= '</th>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L33;
	//$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L11;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L12;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L13;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L14;
	$text .= '</th>';
	$text .= '</tr>';

	for($i=0; $i<$num_events; $i++)
	{
		$event_id = mysql_result($result,$i, TBL_EVENTS.".EventID");
		$event = new Event($event_id);
		$gName  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gIcon = mysql_result($result,$i , TBL_GAMES.".Icon");
		$player_id =  mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
		$pRank  = mysql_result($result,$i, TBL_PLAYERS.".Rank");
		$pWinLoss  = mysql_result($result,$i, TBL_PLAYERS.".Win")."/".mysql_result($result,$i, TBL_PLAYERS.".Draw")."/".mysql_result($result,$i, TBL_PLAYERS.".Loss");
		
		$q_Scores = "SELECT ".TBL_SCORES.".*, "
		.TBL_PLAYERS.".*"
		." FROM ".TBL_SCORES.", "
		.TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".PlayerID = '$player_id')";

		$result_Scores = $sql->db_Query($q_Scores);
		$numScores = mysql_numrows($result_Scores);
		$prating = 0;
		$prating_votes = 0;
		for($scoreIndex=0; $scoreIndex<$numScores; $scoreIndex++)
		{
			$sid  = mysql_result($result_Scores,$scoreIndex, TBL_SCORES.".ScoreID");

			// Get user rating.
			$rate = $rater->GetRating("ebscores", $sid);

			$prating += $rate[0]*($rate[1] + $rate[2]/10);
			$prating_votes += $rate[0];
		}
		if ($prating_votes !=0)
		{
			$prating /= $prating_votes;
		}
		$rating = displayRating($prating, $prating_votes);

		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>';
		$text .= '</td>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($gIcon).'/> '.$gName;
		//$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $pRank;
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $pWinLoss;
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $rating;
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		$text .= $event->eventStatusToString();
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '</table>';
}

$text .= '</div>';   // tab-page"Events"

/*
---------------------
Teams
---------------------
*/
$text .= '<div id="tabs-3">';   // tab-page "Teams"
// Display list of games icons
$text .= $games_links_list;

if((strcmp(USERID,$req_user) == 0)&&(check_class($pref['eb_teams_create_class'])))
{
	$text .= '<table class="table_left">';
	$text .= '<tr>';
	$text .= '<td>';
	$text .= '<form action="'.e_PLUGIN.'ebattles/clancreate.php" method="post">';
	$text .= '<div>';
	$text .= '<input type="hidden" name="userid" value="'.$req_user.'"/>';
	$text .= '<input type="hidden" name="username" value="'.$uname.'"/>';
	$text .= '</div>';
	$text .= ebImageTextButton('createteam', 'add.png', EB_CLANS_L7);
	$text .= '</form>';
	$text .= '</td>';
	$text .= '</tr>';	
	$text .= '</table>';	
}

$text .= '<div class="spacer">';
$text .= '<a href="'.$teams_link.'">';
$text .= EB_MENU_L3;
$text .= '</a>';
$text .= '</div>';

/* Display list of teams where the user is the owner */
$q = "SELECT ".TBL_CLANS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_CLANS.", "
.TBL_USERS
." WHERE (".TBL_CLANS.".Owner = ".TBL_USERS.".user_id)"
." AND (".TBL_USERS.".user_id = '$req_user')";

$result = $sql->db_Query($q);
$num_teams = mysql_numrows($result);

if ($num_teams>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L26.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L27.'</div>';

	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th style="width:40%" class="eb_th2">';
	$text .= EB_USER_L28;
	$text .= '</th>';
	$text .= '<th class="eb_th2">';
	$text .= EB_USER_L31;
	$text .= '</th>';
	$text .= '</tr>';
	/* Display table contents */
	for($i=0; $i<$num_teams; $i++)
	{
		$clan_id  = mysql_result($result,$i, TBL_CLANS.".ClanID");
		$clan = new Clan($clan_id);
		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'">'.$clan->getField('Name').'</a>';
		$text .= '</td>';
		$text .= '<td class="eb_td">';
		if ($clan->getField('Owner') == USERID)
		{
			$text .= ' <a href="'.e_PLUGIN.'ebattles/clanmanage.php?clanid='.$clan_id.'">'.EB_USER_L16.'</a>';
		}
		$text .= '</td>';
		$text .= '</tr>';

	}
	$text .= '</table>';
}

/* Display list of divisions where the user is the captain */
$q = "SELECT ".TBL_CLANS.".*, "
.TBL_DIVISIONS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_CLANS.", "
.TBL_DIVISIONS.", "
.TBL_GAMES
." WHERE (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
." AND (".TBL_GAMES.".GameId = ".TBL_DIVISIONS.".Game)"
." AND (".TBL_DIVISIONS.".Captain = '$req_user')"
." AND (".TBL_GAMES.".GameID = '$game_id')";

$result = $sql->db_Query($q);
$num_divs = mysql_numrows($result);

if ($num_divs>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L29.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L30.'</div>';

	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th style="width:40%" class="eb_th2">';
	$text .= EB_USER_L24;
	$text .= '</th>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L33;
	//$text .= '</th>';
	$text .= '</tr>';
	/* Display table contents */
	for($i=0; $i<$num_divs; $i++)
	{
		$clan_id  = mysql_result($result,$i, TBL_CLANS.".ClanID");
		$clan = new Clan($clan_id);
		$dcaptain  = mysql_result($result,$i, TBL_DIVISIONS.".Captain");
		$dgame  = mysql_result($result,$i, TBL_GAMES.".Name");
		$dgameicon = mysql_result($result,$i , TBL_GAMES.".Icon");
		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'">'.$clan->getField('Name').'</a>';
		$text .= '</td>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($dgameicon).'/> '.$dgame;
		//$text .= '</td>';
		$text .= '</tr>';

	}
	$text .= '</table>';
}

/* Display list of divisions where the user is a member */
$q = "SELECT ".TBL_CLANS.".*, "
.TBL_DIVISIONS.".*, "
.TBL_MEMBERS.".*, "
.TBL_USERS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_CLANS.", "
.TBL_DIVISIONS.", "
.TBL_USERS.", "
.TBL_MEMBERS.", "
.TBL_GAMES
." WHERE (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
." AND (".TBL_MEMBERS.".User = ".TBL_USERS.".user_id)"
." AND (".TBL_USERS.".user_id = '$req_user')"
." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)"
."   AND (".TBL_GAMES.".GameID = '$game_id')";
$result = $sql->db_Query($q);
$num_divs = mysql_numrows($result);

if ($num_divs>0)
{
	$text .= '<br /><div class="spacer"><b>'.EB_USER_L22.'</b></div>';
	$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L23.'</div>';

	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tr>';
	$text .= '<th style="width:40%" class="eb_th2">';
	$text .= EB_USER_L24;
	$text .= '</th>';
	//$text .= '<th class="eb_th2">';
	//$text .= EB_USER_L33;
	//$text .= '</th>';
	$text .= '</tr>';
	/* Display table contents */
	for($i=0; $i<$num_divs; $i++)
	{
		$dgame  = mysql_result($result,$i, TBL_GAMES.".Name");
		$dgameicon = mysql_result($result,$i , TBL_GAMES.".Icon");
		$clan_id  = mysql_result($result,$i, TBL_CLANS.".ClanID");
		$clan = new Clan($clan_id);
		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= '<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'">'.$clan->getField('Name').'</a>';
		$text .= '</td>';
		//$text .= '<td class="eb_td">';
		//$text .= '<img '.getGameIconResize($dgameicon).'/> '.$dgame;
		//$text .= '</td>';
		$text .= '</tr>';

	}
	$text .= '</table>';
}
$text .= '</div>';   // tab-page "Divisions"

/*
---------------------
Matches
---------------------
*/
$text .= '<div id="tabs-4">';   // tab-page "Matches"
// Display list of games icons
$text .= $games_links_list;

/* Display Active Matches */
/* set pagination variables */
$q = "SELECT count(*) "
." FROM ".TBL_MATCHS.", "
.TBL_SCORES.", "
.TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_MATCHS.".Status = 'active')"
." AND ((".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
." OR   ((".TBL_PLAYERS.".Team = ".TBL_SCORES.".Team)"
." AND   (".TBL_PLAYERS.".Team != 0)))"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = '$req_user')"
." AND (".TBL_GAMERS.".Game = '$game_id')";

$result = $sql->db_Query($q);
$totalItems = mysql_result($result, 0);
$pages->items_total = $totalItems;
$pages->mid_range = eb_PAGINATION_MIDRANGE;
$pages->paginate();

$text .= '<p><b>';
$text .= $totalItems.'&nbsp;'.EB_EVENT_L59;
$text .= '</b></p>';
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES.", "
.TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_MATCHS.".Status = 'active')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = '$req_user')"
." AND (".TBL_GAMERS.".Game = '$game_id')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC"
." $pages->limit";
$result = $sql->db_Query($q);

$num_matchs = mysql_numrows($result);
if ($num_matchs>0)
{
	// Paginate
	$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
	$text .= '<span style="float:right">';
	// Go To Page
	$text .= $pages->display_jump_menu();
	$text .= '&nbsp;&nbsp;&nbsp;';
	// Items per page
	$text .= $pages->display_items_per_page();
	$text .= '</span><br /><br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i<$num_matchs; $i++)
	{
		$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
		$match = new Match($match_id);
		$text .= $match->displayMatchInfo();
	}
	$text .= '</table>';
}
/* Display Pending Matches */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES.", "
.TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_MATCHS.".Status = 'pending')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND ((".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
." OR   ((".TBL_PLAYERS.".Team = ".TBL_SCORES.".Team)"
." AND   (".TBL_PLAYERS.".Team != 0)))"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = '$req_user')"
." AND (".TBL_GAMERS.".Game = '$game_id')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC";
$result = $sql->db_Query($q);
$numMatches = mysql_numrows($result);
if ($numMatches>0)
{
	$text .= '<p><b>';
	$text .= '<span class="badge">'.$numMatches.'</span>&nbsp;'.EB_EVENT_L64;
	$text .= '</b></p>';
	$text .= '<br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i < $numMatches; $i++)
	{
		$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
		$match = new Match($match_id);
		$text .= $match->displayMatchInfo();
	}
	$text .= '</table>';
}

/* Display Scheduled Matches */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES.", "
.TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_MATCHS.".Status = 'scheduled')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND ((".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
." OR   ((".TBL_PLAYERS.".Team = ".TBL_SCORES.".Team)"
." AND   (".TBL_PLAYERS.".Team != 0)))"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = '$req_user')"
." AND (".TBL_GAMERS.".Game = '$game_id')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC";
$result = $sql->db_Query($q);
$numMatches = mysql_numrows($result);
if ($numMatches>0)
{
	$text .= '<p><b>';
	$text .= '<span class="badge">'.$numMatches.'</span>&nbsp;'.EB_EVENT_L70;
	$text .= '</b></p>';
	$text .= '<br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i < $numMatches; $i++)
	{
		$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
		$match = new Match($match_id);
		$text .= $match->displayMatchInfo(eb_MATCH_SCHEDULED);
	}
	$text .= '</table>';
}
/* Display Requested Challenges */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_CHALLENGES.".*"
." FROM ".TBL_CHALLENGES
." WHERE (".TBL_CHALLENGES.".Status = 'requested')"
." AND (".TBL_CHALLENGES.".ReportedBy = '$req_user')"
." ORDER BY ".TBL_CHALLENGES.".TimeReported DESC";
$result = $sql->db_Query($q);
$numChallenges = mysql_numrows($result);
if ($numChallenges>0)
{
	$text .= '<p><b>';
	$text .= '<span class="badge">'.$numChallenges.'</span>&nbsp;'.EB_EVENT_L66;
	$text .= '</b></p>';
	$text .= '<br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i < $numChallenges; $i++)
	{
		$challenge_id  = mysql_result($result,$i, TBL_CHALLENGES.".ChallengeID");
		$challenge = new Challenge($challenge_id);
		$text .= $challenge->displayChallengeInfo();
	}
	$text .= '</table>';
}

/* Display Unconfirmed Challenges */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_CHALLENGES.".*"
." FROM ".TBL_CHALLENGES.", "
.TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_CHALLENGES.".Status = 'requested')"
."   AND ((".TBL_PLAYERS.".PlayerID = ".TBL_CHALLENGES.".ChallengedPlayer)"
."    OR  ((".TBL_PLAYERS.".Team = ".TBL_CHALLENGES.".ChallengedTeam)"
."   AND   (".TBL_PLAYERS.".Team != 0)))"
."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
."   AND (".TBL_GAMERS.".User = '$req_user')"
."   AND (".TBL_GAMERS.".Game = '$game_id')"
." ORDER BY ".TBL_CHALLENGES.".TimeReported DESC";
$result = $sql->db_Query($q);
$numChallenges = mysql_numrows($result);
if ($numChallenges>0)
{
	$text .= '<p><b>';
	$text .= $numChallenges.'&nbsp;'.EB_EVENT_L67;
	$text .= '</b></p>';
	$text .= '<br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i < $numChallenges; $i++)
	{
		$challenge_id  = mysql_result($result,$i, TBL_CHALLENGES.".ChallengeID");
		$challenge = new Challenge($challenge_id);
		$text .= $challenge->displayChallengeInfo();
	}
	$text .= '</table>';
}

$text .= '</div>';   // tab-page "Matches"

/*
---------------------
Awards
---------------------
*/
$text .= '<div id="tabs-5">';   // tab-page "Awards"
// Display list of games icons
$text .= $games_links_list;

/* Stats/Results */
$q = "SELECT ".TBL_AWARDS.".*, "
.TBL_EVENTS.".*, "
.TBL_PLAYERS.".*, "
.TBL_GAMES.".*, "
.TBL_USERS.".*"
." FROM ".TBL_AWARDS.", "
.TBL_PLAYERS.", "
.TBL_GAMERS.", "
.TBL_EVENTS.", "
.TBL_GAMES.", "
.TBL_USERS
." WHERE (".TBL_USERS.".user_id = $req_user)"
." AND (".TBL_AWARDS.".Player = ".TBL_PLAYERS.".PlayerID)"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = ".TBL_USERS.".user_id)"
." AND (".TBL_PLAYERS.".Event = ".TBL_EVENTS.".EventID)"
." AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
." AND (".TBL_GAMES.".GameID = '$game_id')"
." ORDER BY ".TBL_AWARDS.".timestamp DESC";

$result = $sql->db_Query($q);
$num_awards = mysql_numrows($result);

if ($num_awards>0)
{
	$text .= '<table class="table_left">';
	/* Display table contents */
	for($i=0; $i<$num_awards; $i++)
	{
		$aID  = mysql_result($result,$i, TBL_AWARDS.".AwardID");
		$aUser  = mysql_result($result,$i, TBL_USERS.".user_id");
		$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
		$gamer = new Gamer($gamer_id);
		$aUserNickName = $gamer->getField('Name');
		$aEventID  = mysql_result($result,$i, TBL_EVENTS.".EventID");
		$aEventName  = mysql_result($result,$i, TBL_EVENTS.".Name");
		$aEventgame = mysql_result($result,$i , TBL_GAMES.".Name");
		$aEventgameicon = mysql_result($result,$i , TBL_GAMES.".Icon");
		$aType  = mysql_result($result,$i, TBL_AWARDS.".Type");
		$aTime  = mysql_result($result,$i, TBL_AWARDS.".timestamp");
		$aTime_local = $aTime + TIMEOFFSET;
		$date = date("d M Y, h:i A",$aTime_local);

		switch ($aType) {
		case 'PlayerTookFirstPlace':
			$award = EB_AWARD_L2;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/award_star_gold_3.png").' alt="'.EB_AWARD_L3.'" title="'.EB_AWARD_L3.'"/> ';
			break;
		case 'PlayerInTopTen':
			$award = EB_AWARD_L4;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/award_star_bronze_3.png").' alt="'.EB_AWARD_L5.'" title="'.EB_AWARD_L5.'"/> ';
			break;
		case 'PlayerStreak5':
			$award = EB_AWARD_L6;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_bronze_3.png").' alt="'.EB_AWARD_L7.'" title="'.EB_AWARD_L7.'"/> ';
			break;
		case 'PlayerStreak10':
			$award = EB_AWARD_L8;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_silver_3.png").' alt="'.EB_AWARD_L9.'" title="'.EB_AWARD_L9.'"/> ';
			break;
		case 'PlayerStreak25':
			$award = EB_AWARD_L10;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_gold_3.png").' alt="'.EB_AWARD_L11.'" title="'.EB_AWARD_L11.'"/> ';
			break;
		case 'PlayerWonTournament':
			$award = EB_AWARD_L12;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/trophy_gold.png").' alt="'.EB_AWARD_L13.'" title="'.EB_AWARD_L13.'"/> ';
			break;
		case 'PlayerRankFirst':
			$award = EB_AWARD_L14;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_gold_1.png").' alt="'.EB_AWARD_L15.'" title="'.EB_AWARD_L15.'"/> ';
			break;
		case 'PlayerRankSecond':
			$award = EB_AWARD_L16;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_silver_1.png").' alt="'.EB_AWARD_L17.'" title="'.EB_AWARD_L17.'"/> ';
			break;
		case 'PlayerRankThird':
			$award = EB_AWARD_L18;
			$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_bronze_1.png").' alt="'.EB_AWARD_L19.'" title="'.EB_AWARD_L19.'"/> ';
			break;
		}

		$award_string = '<tr><td style="vertical-align:top">'.$icon.'</td>';
		$award_string .= '<td><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$aUser.'">'.$aUserNickName.'</a>';
		$award_string .= ' '.$award;
		$award_string .= ' '.EB_MATCH_L12.' <a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$aEventID.'">'.$aEventName.'</a>'; // ('.$aEventgame.')';

		$award_string .= ' <div class="smalltext">';
		if (($time-$aTime) < INT_MINUTE )
		{
			$award_string .= EB_MATCH_L7;
		}
		else if (($time-$aTime) < INT_DAY )
		{
			$award_string .= get_formatted_timediff($aTime, $time).'&nbsp;'.EB_MATCH_L8;
		}
		else
		{
			$award_string .= $date;
		}
		$award_string .= '</div></td></tr>';

		$text .= $award_string;
	}
	$text .= '</table><br />';
}
$text .= '<br />';
$text .= '</div>';   // tab-page "Awards"

$text .= '</div>';

$ns->tablerender(EB_USER_L1, $text);
require_once(FOOTERF);
exit;
?>

