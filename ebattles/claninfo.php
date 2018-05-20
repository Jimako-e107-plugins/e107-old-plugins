<?php
/**
*claninfo.php
*
* This page is to display a clan information
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");

/*******************************************************************
********************************************************************/
require_once(HEADERF);

/* Clan Name */
$clan_id = intval($_GET['clanid']);
$game_id = intval($_GET['gameid']);

if(!$clan_id)
{
	header("Location: ./clans.php");
    exit();
}

require_once(e_PLUGIN."ebattles/include/ebattles_header.php");
require_once(e_PLUGIN."ebattles/claninfo_process.php");

$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/clan.js"></script>
';

$q = "SELECT ".TBL_CLANS.".*"
." FROM ".TBL_CLANS
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')";
$result = $sql->db_Query($q);
$num_rows = mysql_numrows($result);

$clan_name   = mysql_result($result,0, TBL_CLANS.".Name");

$q = "SELECT ".TBL_CLANS.".*, "
.TBL_DIVISIONS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_CLANS.", "
.TBL_DIVISIONS.", "
.TBL_GAMES
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";
$result = $sql->db_Query($q);
$num_divs = mysql_numrows($result);

if ($num_divs>0)
{
	//$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L35.'</div>';

	// Display list of games icons
	$games_links_list = '<div class="spacer">';
	for($i=0; $i<$num_divs; $i++)
	{
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
		if($game_id=="") $game_id = $gid;
		
		if($gid==$game_id)
		{
			$gname_selected = $gname;
		}

		$games_links_list .= '<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'&amp;gameid='.$gid.'"><img '.getGameIconResize($gicon).' title="'.$gname.'"/></a>';
		$games_links_list .= '&nbsp;';
	}
	$games_links_list .= '<br /><b>'.$gname_selected.'</b></div><br />';
}



$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_CLAN_L2.'</a></li>';
$text .= '<li><a href="#tabs-2">'.EB_CLAN_L3.'</a></li>';
$text .= '<li><a href="#tabs-3">'.EB_CLAN_L4.'</a></li>';
$text .= '<li><a href="#tabs-4">'.EB_CLAN_L31.'</a></li>';
$text .= '</ul>';
/**
* Display Latest Games
*/
$text .= '<div id="tabs-1">';
displayTeamSummary($clan_id);
$text .= '</div>';

/**
* Display Divisions
*/
$text .= '<div id="tabs-2">';
$text .= $games_links_list;
displayTeamDivisions($clan_id, $game_id);
$text .= '</div>';

/**
* Display Events
*/
$text .= '<div id="tabs-3">';
$text .= $games_links_list;
displayTeamEvents($clan_id, $game_id);
$text .= '</div>';

/**
* Display Awards
*/
$text .= '<div id="tabs-4">';
displayTeamAwards($clan_id);
$text .= '</div>';

$text .= '</div>';

$ns->tablerender("$clan_name", $text);
require_once(FOOTERF);
exit;

/***************************************************************************************
Functions
***************************************************************************************/
/**
* displayTeamSummary - Displays ...
*/
function displayTeamSummary($clan_id){
global $sql;
global $text;
global $pref;
global $tp;

$q = "SELECT ".TBL_CLANS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_CLANS.", "
.TBL_USERS
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
." AND (".TBL_USERS.".user_id = ".TBL_CLANS.".Owner)";

$result = $sql->db_Query($q);
$num_rows = mysql_numrows($result);

$clan_name   = mysql_result($result,0, TBL_CLANS.".Name");
$clan_owner  = mysql_result($result,0, TBL_USERS.".user_id");
$clan_owner_name   = mysql_result($result,0, TBL_USERS.".user_name");
$clan_tag    = mysql_result($result,0, TBL_CLANS.".Tag");
$clan_avatar    = mysql_result($result,0, TBL_CLANS.".Image");
$clan_website    = mysql_result($result,0, TBL_CLANS.".websiteURL");
$clan_email    = mysql_result($result,0, TBL_CLANS.".email");
$clan_IM    = mysql_result($result,0, TBL_CLANS.".IM");
$clan_Description    = mysql_result($result,0, TBL_CLANS.".Description");

$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$clan_owner) $can_manage = 1;
if ($can_manage == 1)
$text .= '
<form action="'.e_PLUGIN.'ebattles/clanmanage.php?clanid='.$clan_id.'" method="post">
'.ebImageTextButton('submit', 'page_white_edit.png', EB_CLAN_L8).'
</form>';

$text .= '<b>'.$clan_name.' ('.$clan_tag.')</b><br />';

$image = "";
if($clan_avatar)
{
	$image = '<img '.getAvatarResize(getImagePath($clan_avatar, 'team_avatars')).'/>';
} else if ($pref['eb_avatar_default_team_image'] != ''){
	$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>';
}
$text .= '<div>'.$image.'</div>';

$text .= '<table class="eb_table table_left"><tbody>';

$text .= '<tr><td class="eb_td eb_tdc1">'.EB_CLAN_L7.':</td>';
$text .= '<td class="eb_td"><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$clan_owner.'">'.$clan_owner_name.'</a></td>';
$text .= '</tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_CLAN_L27.':</td>';
$text .= '<td class="eb_td"><a href="http://'.$clan_website.'" rel="external">'.$clan_website.'</a></td>';
$text .= '</tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_CLAN_L28.':</td>';
$text .= '<td class="eb_td"><a href="mailto:'.$clan_email.'">'.$clan_email.'</a></td>';
$text .= '</tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_CLAN_L29.':</td>';
$text .= '<td class="eb_td">'.$clan_IM.'</td>';
$text .= '</tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_CLAN_L30.':</td>';
$text .= '<td class="eb_td">'.$tp->toHTML($clan_Description, true).'</td>';
$text .= '</tr>';
$text .= '</tbody></table>';

}

/**
* displayTeamDivisions - Displays ...
*/
function displayTeamDivisions($clan_id, $game_id){
	global $sql;
	global $text;

	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_USERS.".*, "
	.TBL_GAMES.".*"
	." FROM ".TBL_CLANS.", "
	.TBL_DIVISIONS.", "
	.TBL_USERS.", "
	.TBL_GAMES
	." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
	." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
	." AND (".TBL_USERS.".user_id = ".TBL_DIVISIONS.".Captain)"
	." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";

	$result = $sql->db_Query($q);
	$num_divs = mysql_numrows($result);
	for($i=0; $i<$num_divs; $i++)
	{
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
		$div_id  = mysql_result($result,$i, TBL_DIVISIONS.".DivisionID");
		$div_captain  = mysql_result($result,$i, TBL_USERS.".user_id");
		$div_captain_name  = mysql_result($result,$i, TBL_USERS.".user_name");
		$clan_password   = mysql_result($result,$i, TBL_CLANS.".password");
		$clan_id   = mysql_result($result,$i, TBL_CLANS.".ClanID");

		if($gid == $game_id)
		{
			$text .= '<div class="spacer">';
			$text .= '<p>'.EB_CLAN_L9.': <a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$div_captain.'">'.$div_captain_name.'</a></p>';

			if(check_class(e_UC_MEMBER))
			{
				// Find gamer for that user
				$q_2 = "SELECT ".TBL_GAMERS.".*"
				." FROM ".TBL_GAMERS
				." WHERE (".TBL_GAMERS.".Game = '".$gid."')"
				."   AND (".TBL_GAMERS.".User = ".USERID.")";
				$result_2 = $sql->db_Query($q_2);
				$num_Gamers = mysql_numrows($result_2);
				if ($num_Gamers!=0)
				{
					$gamerID = mysql_result($result_2,0 , TBL_GAMERS.".GamerID");
					$gamer = new Gamer($gamerID);
					$gamerName = $gamer->getField('Name');
					$gamerUniqueGameID = $gamer->getField('UniqueGameID');
				}
				else
				{
					$gamerID = 0;
					$gamerName = '';
					$gamerUniqueGameID = '';
				}

				$q_2 = "SELECT ".TBL_MEMBERS.".*"
				." FROM ".TBL_MEMBERS
				." WHERE (".TBL_MEMBERS.".Division = '$div_id')"
				." AND (".TBL_MEMBERS.".User = ".USERID.")";
				$result_2 = $sql->db_Query($q_2);
				if(!$result_2 || (mysql_numrows($result_2) < 1))
				{
					$hide_password = ($clan_password == "") ?  'hide ignore' : '';

					$text .= '
					<div>
					<input type="hidden" name="division" value="'.$div_id.'"/>
					</div>
					'.ebImageTextButton('joindivision', 'user_add.png', EB_CLAN_L12);

					$text .= gamerDivisionSignupModalForm($clan_id, $div_id, $gamerID, $gamerName, $gamerUniqueGameID, $hide_password);
				}
				else
				{
					// Check that the member has made no games with this division
					$q_MemberScores = "SELECT ".TBL_MEMBERS.".*, "
					.TBL_TEAMS.".*, "
					.TBL_PLAYERS.".*, "
					.TBL_SCORES.".*"
					." FROM ".TBL_MEMBERS.", "
					.TBL_TEAMS.", "
					.TBL_PLAYERS.", "
					.TBL_SCORES
					." WHERE (".TBL_MEMBERS.".User = ".USERID.")"
					." AND (".TBL_MEMBERS.".Division = '$div_id')"
					." AND (".TBL_TEAMS.".Division = '$div_id')"
					." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
					." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
					$result_MemberScores = $sql->db_Query($q_MemberScores);
					$numMemberScores = mysql_numrows($result_MemberScores);
					if ($numMemberScores == 0)
					{
						$text .= '
						<form action="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'" method="post">
						<div>
						<input type="hidden" name="division" value="'.$div_id.'"/>
						</div>
						'.ebImageTextButton('quitdivision', 'user_delete.ico', EB_CLAN_L13, 'negative jq-button', EB_CLAN_L25).'
						</form>';
					}
				}
			}

			$q_2 = "SELECT ".TBL_CLANS.".*, "
			.TBL_DIVISIONS.".*, "
			.TBL_MEMBERS.".*, "
			.TBL_USERS.".*, "
			.TBL_GAMES.".*"
			." FROM ".TBL_CLANS.", "
			.TBL_DIVISIONS.", "
			.TBL_USERS.", "
			.TBL_MEMBERS.", "
			.TBL_GAMES
			." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
			." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
			." AND (".TBL_DIVISIONS.".DivisionID = '$div_id')"
			." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
			." AND (".TBL_USERS.".user_id = ".TBL_MEMBERS.".User)"
			." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";
			$result_2 = $sql->db_Query($q_2);
			if(!$result_2 || (mysql_numrows($result_2) < 1))
			{
				$text .= '<p>'.EB_CLAN_L14.'</p>';
			}
			else
			{
				$row = mysql_fetch_array($result_2);
				$numMembers = mysql_numrows($result_2);

				$text .= '<p>'.$numMembers.'&nbsp;'.EB_CLAN_L15.'</p>';

				$text .= '<table class="eb_table" style="width:95%"><tbody>';
				$text .= '<tr>
				<th class="eb_th2">'.EB_CLAN_L16.'</th>
				<th class="eb_th2">'.EB_CLAN_L17.'</th>
				<th class="eb_th2">'.EB_CLAN_L18.'</th>
				</tr>';

				// Captain
				for($j=0; $j < $numMembers; $j++)
				{
					$mid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
					$mname  = mysql_result($result_2,$j, TBL_USERS.".user_name");
					$mjoined  = mysql_result($result_2,$j, TBL_MEMBERS.".timestamp");
					$mjoined_local = $mjoined + TIMEOFFSET;
					$date = date("d M Y",$mjoined_local);

					if ($mid == $div_captain)
					{
						$status =  EB_CLAN_L9;

						$text .= '<tr>';
						$text .= '<td class="eb_td"><b><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$mid.'">'.$mname.'</a></b></td>
						<td class="eb_td">'.$status.'</td>
						<td class="eb_td">'.$date.'</td></tr>';
					}
				}

				// Other members
				for($j=0; $j < $numMembers; $j++)
				{
					$mid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
					$mname  = mysql_result($result_2,$j, TBL_USERS.".user_name");
					$mjoined  = mysql_result($result_2,$j, TBL_MEMBERS.".timestamp");
					$mjoined_local = $mjoined + TIMEOFFSET;
					$date = date("d M Y",$mjoined_local);

					if ($mid != $div_captain)
					{
						$status =  EB_CLAN_L26;

						$text .= '<tr>';
						$text .= '<td class="eb_td"><b><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$mid.'">'.$mname.'</a></b></td>
						<td class="eb_td">'.$status.'</td>
						<td class="eb_td">'.$date.'</td></tr>';
					}
				}
				$text .= '</tbody></table>';
			}
			$text .= '<br /></div>';
		}
	}
}

/**
* displayTeamEvents - Displays ...
*/
function displayTeamEvents($clan_id, $game_id){
	global $sql;
	global $text;
	global $time;

	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_GAMES.".*"
	." FROM ".TBL_CLANS.", "
	.TBL_DIVISIONS.", "
	.TBL_GAMES
	." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
	." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
	." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";

	$result = $sql->db_Query($q);
	$num_divs = mysql_numrows($result);

	for($i=0; $i<$num_divs; $i++)
	{
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
		$div_id  = mysql_result($result,$i, TBL_DIVISIONS.".DivisionID");

		if($gid == $game_id)
		{
			$text .= '<div class="spacer">';

			$q_2 = "SELECT ".TBL_TEAMS.".*, "
			.TBL_EVENTS.".*"
			." FROM ".TBL_TEAMS.", "
			.TBL_EVENTS
			." WHERE (".TBL_TEAMS.".Division = '$div_id')"
			." AND (".TBL_TEAMS.".Event = ".TBL_EVENTS.".EventID)"
			." AND (".TBL_EVENTS.".Status != 'finished')";

			$result_2 = $sql->db_Query($q_2);
			if(!$result_2 || (mysql_numrows($result_2) < 1))
			{
				$text .= '<p>'.EB_CLAN_L19.'</p>';
			}
			else
			{
				$row = mysql_fetch_array($result_2);
				$numEvents = mysql_numrows($result_2);

				$text .= '<p>'.$numEvents.'&nbsp;'.EB_CLAN_L20.'</p>';

				$text .= '<table class="eb_table" style="width:95%"><tbody>';
				$text .= '<tr>
				<th class="eb_th2">'.EB_CLAN_L21.'</th>
				<th class="eb_th2">'.EB_CLAN_L22.'</th>
				</tr>';
				for($j=0; $j < $numEvents; $j++)
				{
					$event_id  = mysql_result($result_2,$j, TBL_EVENTS.".EventID");
					$eName  = mysql_result($result_2,$j, TBL_EVENTS.".Name");
					$eRank  = mysql_result($result_2,$j, TBL_TEAMS.".Rank");

					$text .= '<tr>';
					$text .= '<td class="eb_td"><b><a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$eName.'</a></b></td>
					<td class="eb_td">'.$eRank.'</td></tr>';
				}
				$text .= "</tbody></table>\n";
			}

			$q_2 = "SELECT ".TBL_TEAMS.".*, "
			.TBL_EVENTS.".*"
			." FROM ".TBL_TEAMS.", "
			.TBL_EVENTS
			." WHERE (".TBL_TEAMS.".Division = '$div_id')"
			." AND (".TBL_TEAMS.".Event = ".TBL_EVENTS.".EventID)"
			." AND (".TBL_EVENTS.".Status = 'finished')";

			$result_2 = $sql->db_Query($q_2);
			if(!$result_2 || (mysql_numrows($result_2) < 1))
			{
				$text .= '<p>'.EB_CLAN_L23.'</p>';
			}
			else
			{
				$row = mysql_fetch_array($result_2);
				$numEvents = mysql_numrows($result_2);

				$text .= '<p>'.$numEvents.'&nbsp;'.EB_CLAN_L24.'</p>';

				$text .= '<table class="eb_table" style="width:95%"><tbody>';
				$text .= '<tr>
				<th class="eb_th2">'.EB_CLAN_L21.'</th>
				<th class="eb_th2">'.EB_CLAN_L22.'</th>
				</tr>';
				for($j=0; $j<$numEvents; $j++)
				{
					$event_id  = mysql_result($result_2,$j, TBL_EVENTS.".EventID");
					$eName  = mysql_result($result_2,$j, TBL_EVENTS.".Name");
					$eRank  = mysql_result($result_2,$j, TBL_TEAMS.".Rank");

					$text .= '<tr>';
					$text .= '<td class="eb_td"><b><a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$eName.'</a></b></td>
					<td class="eb_td">'.$eRank.'</td></tr>';
				}
				$text .= '</tbody></table>';
			}
			$text .= '</div><br />';
		}
	}
}

/**
* displayTeamAwards - Displays ...
*/
function displayTeamAwards($clan_id){
	global $sql;
	global $text;
	global $time;

	/* Stats/Results */
	$q = "SELECT ".TBL_AWARDS.".*, "
	.TBL_EVENTS.".*, "
	.TBL_CLANS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_GAMES.".*"
	." FROM ".TBL_AWARDS.", "
	.TBL_EVENTS.", "
	.TBL_CLANS.", "
	.TBL_TEAMS.", "
	.TBL_DIVISIONS.", "
	.TBL_GAMES
	." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
	." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_AWARDS.".Team = ".TBL_TEAMS.".TeamID)"
	." AND (".TBL_TEAMS.".Event = ".TBL_EVENTS.".EventID)"
	." AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)"
	." ORDER BY ".TBL_AWARDS.".timestamp DESC";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);

	if ($num_rows>0)
	{
		$text .= '<table class="eb_table table_left">';
		/* Display table contents */
		for($i=0; $i<$num_rows; $i++)
		{
			$aID  = mysql_result($result,$i, TBL_AWARDS.".AwardID");
			$aEventID  = mysql_result($result,$i, TBL_EVENTS.".EventID");
			$aEventName  = mysql_result($result,$i, TBL_EVENTS.".Name");
			$aEventgame = mysql_result($result,$i , TBL_GAMES.".Name");
			$aEventgameicon = mysql_result($result,$i , TBL_GAMES.".Icon");
			$aType  = mysql_result($result,$i, TBL_AWARDS.".Type");
			$aTime  = mysql_result($result,$i, TBL_AWARDS.".timestamp");
			$aTime_local = $aTime + TIMEOFFSET;
			$date = date("d M Y, h:i A",$aTime_local);

			$aClanTeam  = mysql_result($result,$i, TBL_TEAMS.".TeamID");
			list($tclan, $tclantag, $tclanid) = getClanInfo($aClanTeam);


			switch ($aType) {
				case 'TeamTookFirstPlace':
				$award = EB_AWARD_L2;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/award_star_gold_3.png").' alt="'.EB_AWARD_L3.'" title="'.EB_AWARD_L3.'"/> ';
				break;
				case 'TeamInTopTen':
				$award = EB_AWARD_L4;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/award_star_bronze_3.png").' alt="'.EB_AWARD_L5.'" title="'.EB_AWARD_L5.'"/> ';
				break;
				case 'TeamStreak5':
				$award = EB_AWARD_L6;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_bronze_3.png").' alt="'.EB_AWARD_L7.'" title="'.EB_AWARD_L7.'"/> ';
				break;
				case 'TeamStreak10':
				$award = EB_AWARD_L8;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_silver_3.png").' alt="'.EB_AWARD_L9.'" title="'.EB_AWARD_L9.'"/> ';
				break;
				case 'TeamStreak25':
				$award = EB_AWARD_L10;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_gold_3.png").' alt="'.EB_AWARD_L11.'" title="'.EB_AWARD_L11.'"/> ';
				break;
				case 'TeamWonTournament':
				$award = EB_AWARD_L12;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/trophy_gold.png").' alt="'.EB_AWARD_L13.'" title="'.EB_AWARD_L13.'"/> ';
				break;
				case 'TeamRankFirst':
				$award = EB_AWARD_L14;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_gold_1.png").' alt="'.EB_AWARD_L15.'" title="'.EB_AWARD_L15.'"/> ';
				break;
				case 'TeamRankSecond':
				$award = EB_AWARD_L16;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_silver_1.png").' alt="'.EB_AWARD_L17.'" title="'.EB_AWARD_L17.'"/> ';
				break;
				case 'TeamRankThird':
				$award = EB_AWARD_L18;
				$icon = '<img '.getActivityIconResize(e_PLUGIN."ebattles/images/awards/medal_bronze_1.png").' alt="'.EB_AWARD_L19.'" title="'.EB_AWARD_L19.'"/> ';
				break;
			}

			$award_string = '<tr><td style="vertical-align:top">'.$icon.'</td>';
			$award_string .= '<td><a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$tclanid.'">'.$tclan.'</a>';
			$award_string .= ' '.$award;
			$award_string .= ' '.EB_MATCH_L12.' <a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$aEventID.'">'.$aEventName.'</a> ('.$aEventgame.')';

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
}
?>
