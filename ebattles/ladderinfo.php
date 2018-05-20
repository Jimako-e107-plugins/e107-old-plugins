<?php
/**
* ladderinfo.php
*
*/

/* Update */
if ($eneedupdate == 1)
{
	$new_nextupdate = $time + 60*$pref['eb_events_update_delay'];
	$event->setFieldDB('NextUpdate_timestamp', $new_nextupdate);

	$event->setFieldDB('IsChanged', 0);
	$eventIsChanged = 0;

	switch($event->getField('Type'))
	{
	case "One Player Ladder":
		updateStats($event_id, $time, TRUE);
		break;
	case "Team Ladder":
		updateStats($event_id, $time, TRUE);
		updateTeamStats($event_id, $time, TRUE);
	case "Clan Ladder":
		updateTeamStats($event_id, $time, TRUE);
		break;
	default:
	}
}

$nextupdate_timestamp = $event->getField('NextUpdate_timestamp');
$nextupdate_timestamp_local = $nextupdate_timestamp + TIMEOFFSET;
$date_nextupdate = date("d M Y, h:i A",$nextupdate_timestamp_local);

// Put nbrMatches pending in tab header
$q = "SELECT COUNT(DISTINCT ".TBL_MATCHS.".MatchID) as NbrMatches"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES
." WHERE (".TBL_MATCHS.".Event = '$event_id')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_MATCHS.".Status = 'pending')";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbrMatchesPending = $row['NbrMatches'];
if ($nbrMatchesPending == 0) $can_approve = 0;
$match_pending_text = ($can_approve == 1) ? ' <span class="badge1">'.$nbrMatchesPending.'</span>' : '';

$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_EVENT_L35.'</a></li>';
if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "Clan Ladder"))
{
	$text .= '<li><a href="#tabs-2">'.EB_EVENT_L45.'</a></li>';
}
if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "One Player Ladder"))
{
	$text .= '<li><a href="#tabs-3">'.EB_EVENT_L49.'</a></li>';
}
$text .= '<li><a href="#tabs-4">'.EB_EVENT_L58.$match_pending_text.'</a></li>';
$text .= '<li><a href="#tabs-5">'.EB_EVENT_L63.'</a></li>';
$text .= '</ul>';

/*----------------------------------------------------------------------------------------
Display Info
----------------------------------------------------------------------------------------*/
$text .= '<div id="tabs-1">';
$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$eowner) $can_manage = 1;
if ($can_manage == 1)
{
	$text .= '
	<form action="'.e_PLUGIN.'ebattles/eventmanage.php?eventid='.$event_id.'" method="post"><div>
	'.ebImageTextButton('submit', 'page_white_edit.png', EB_EVENT_L40).'
	</div></form>';
}

/* Signup, Join/Quit Event */
$text .= '<table style="width:95%"><tbody>';
$userIsDivisionCaptain = FALSE;
switch($event->getField('Type'))
{
case "Team Ladder":
case "Clan Ladder":
case "Clan Tournament":
	// Team event
	//------------
	// Team joins team event
	//-----------------------
	// Find if user is captain of a division playing that game
	// if yes, propose to have his team join this event
	$q = "SELECT ".TBL_DIVISIONS.".*, "
	.TBL_CLANS.".*, "
	.TBL_GAMES.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_DIVISIONS.", "
	.TBL_CLANS.", "
	.TBL_GAMES.", "
	.TBL_USERS
	." WHERE (".TBL_DIVISIONS.".Game = '$egameid')"
	." AND (".TBL_GAMES.".GameID = '$egameid')"
	." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_USERS.".user_id = ".USERID.")"
	." AND (".TBL_DIVISIONS.".Captain = ".USERID.")";

	$result = $sql->db_Query($q);
	$numDivs = mysql_numrows($result);
	if($numDivs > 0)
	{
		// User is captain
		$userIsDivisionCaptain = TRUE;
		for($i=0;$i < $numDivs;$i++)
		{
			$div_name  = mysql_result($result,$i, TBL_CLANS.".Name");
			$div_id    = mysql_result($result,$i, TBL_DIVISIONS.".DivisionID");

			// Is the division signed up
			$q_2 = "SELECT ".TBL_TEAMS.".*"
			." FROM ".TBL_TEAMS
			." WHERE (".TBL_TEAMS.".Event = '$event_id')"
			." AND (".TBL_TEAMS.".Division = '$div_id')";
			$result_2 = $sql->db_Query($q_2);
			$nbr_teams = mysql_numrows($result_2);

			$text .= '<tr>';
			$text .= '<td>'.EB_EVENT_L7.'&nbsp;'.$div_name.'</td>';
			if($nbr_teams == 0)
			{
				// Division is not signed up.
				if ($can_signup==1)
				{
					if ($event->getField('password') != "")
					{
						$text .= '<td>'.EB_EVENT_L8.'<span class="required">*</span></td>';
						$text .= '<td>
								<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
								<div>
								<input class="tbox required" type="password" title="'.EB_EVENT_L9.'" name="joinEventPassword"/>
								<input type="hidden" name="division" value="'.$div_id.'"/>
								'.ebImageTextButton('teamjoinevent', 'user_add.png', EB_EVENT_L10).'
								</div>
								';
						$text .= '</form>';
						$text .= '</td>';
					}
					else
					{
						$text .= '<td>'.EB_EVENT_L11.'</td>';
						$text .= '<td>
								<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
								<div>
								<input type="hidden" name="joinEventPassword" value=""/>
								<input type="hidden" name="division" value="'.$div_id.'"/>
								'.ebImageTextButton('teamjoinevent', 'user_add.png', EB_EVENT_L12).'
								</div>
								';
						$text .= '</form>';
						$text .= '</td>';
					}
				}
				else
				{
					$text .= '<td>'.$cannot_signup_str.'<td>';
				}
			}
			else
			{
				// Division is signed up.
				$team_id  = mysql_result($result_2, 0 , TBL_TEAMS.".TeamID");
				$team_banned  = mysql_result($result_2,0 , TBL_TEAMS.".Banned");
				$team_checkedin  = mysql_result($result_2,0 , TBL_TEAMS.".CheckedIn");
				
				if ($team_banned)
				{
					// Team is banned
					$text .= '<td>'.EB_EVENT_L20.'<br />
							'.EB_EVENT_L21.'</td>';
				}
				else
				{
					$text .= '<td>'.EB_EVENT_L13.'</td>';
					
					if($can_checkin == 1)
					{
						if($team_checkedin != 1)
						{
							$text .= '<td style="text-align:right">
									<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
									<div>
									<input type="hidden" name="joinEventPassword" value=""/>
									<input type="hidden" name="team" value="'.$team_id.'"/>
									'.ebImageTextButton('teamcheckinevent', 'user_go.ico', EB_EVENT_L91, 'jq-button', '', EB_EVENT_L92).'
									</div>
									</form></td>
									';
						}
						else
						{
							$text .= '<td>'.EB_EVENT_L93.'</td>';
						}
					}
				}
			}
			$text .= '</tr>';
		}
	}

	// Player joins team event
	//-------------------------
	// Is the user a member of a division for that game?
	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_MEMBERS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_GAMES.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_CLANS.", "
	.TBL_MEMBERS.", "
	.TBL_DIVISIONS.", "
	.TBL_GAMES.", "
	.TBL_USERS
	." WHERE (".TBL_DIVISIONS.".Game = '$egameid')"
	." AND (".TBL_GAMES.".GameID = '$egameid')"
	." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_USERS.".user_id = ".USERID.")"
	." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_MEMBERS.".User = ".USERID.")";

	$result = $sql->db_Query($q);
	$numMembers = mysql_numrows($result);
	if(!$result || ( $numMembers == 0))
	{
		// User is not a member of any team for this game
		$text .= '<tr><td>'.EB_EVENT_L14.'</td>';
		$text .= '<td></td></tr>';
	}
	else
	{
		for($i=0;$i < $numMembers;$i++)
		{
			$clan_name  = mysql_result($result,$i , TBL_CLANS.".Name");
			$div_id  = mysql_result($result,$i , TBL_DIVISIONS.".DivisionID");
			$q_2 = "SELECT ".TBL_DIVISIONS.".*, "
			.TBL_USERS.".*"
			." FROM ".TBL_DIVISIONS.", "
			.TBL_USERS
			." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
			." AND (".TBL_USERS.".user_id = ".TBL_DIVISIONS.".Captain)";
			$result_2 = $sql->db_Query($q_2);
			if($result_2)
			{
				$captain_name  = mysql_result($result_2,0, TBL_USERS.".user_name");
				$captain_id  = mysql_result($result_2,0, TBL_USERS.".user_id");
			}

			$q_2 = "SELECT ".TBL_CLANS.".*, "
			.TBL_TEAMS.".*, "
			.TBL_DIVISIONS.".* "
			." FROM ".TBL_CLANS.", "
			.TBL_TEAMS.", "
			.TBL_DIVISIONS
			." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
			." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
			." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
			." AND (".TBL_TEAMS.".Event = '$event_id')";
			$result_2 = $sql->db_Query($q_2);
			if(!$result_2 || (mysql_numrows($result_2) == 0))
			{
				// Division is not signed up
				if ($captain_id != USERID)
				{
					// User is not the captain
					$text .= '<tr><td>'.EB_EVENT_L15.'&nbsp;'.$clan_name.'&nbsp;'.EB_EVENT_L16.'</td>';
					$text .= '<td>'.EB_EVENT_L17.' <a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$captain_id.'">'.$captain_name.'</a>.</td></tr>';
				}
			}
			else
			{
				// Division is signed up
				$team_id  = mysql_result($result_2,0 , TBL_TEAMS.".TeamID");
				$team_banned  = mysql_result($result_2,0 , TBL_TEAMS.".Banned");
				if($team_banned) $cannot_signup_str = EB_EVENTM_L54;

				$text .= '<tr><td>'.EB_EVENT_L15.'&nbsp;'.$clan_name.'&nbsp;'.EB_EVENT_L18.'</td>';

				// Is the user already signed up with that team?
				$q_2 = "SELECT ".TBL_PLAYERS.".*, "
				.TBL_GAMERS.".*"
				." FROM ".TBL_PLAYERS.", "
				.TBL_GAMERS
				." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
				."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
				."   AND (".TBL_GAMERS.".User = ".USERID.")"
				."   AND (".TBL_PLAYERS.".Team = '$team_id')";
				$result_2 = $sql->db_Query($q_2);
				if(!$result_2 || (mysql_numrows($result_2) == 0))
				{
					// User is not signed up
					if(($can_signup==1)&&($team_banned==0))
					{
						$text .= '<td>
								<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
								<div>
								<input type="hidden" name="team" value="'.$team_id.'"/>
								'.ebImageTextButton('jointeamevent', 'user_add.png', EB_EVENT_L19).'
								</div>
								</form></td>
								';
					}
					else
					{
						$text .= $cannot_signup_str;
					}
				}
				else
				{
					// User is signed up
					$player_id  = mysql_result($result_2,0 , TBL_PLAYERS.".PlayerID");
					$player_banned  = mysql_result($result_2,0 , TBL_PLAYERS.".Banned");
					$player_checkedin  = mysql_result($result_2,0 , TBL_PLAYERS.".CheckedIn");
					$player_name  = mysql_result($result_2,0 , TBL_GAMERS.".Name");

					if ($player_banned)
					{
						// User is banned
						$text .= '<td>'.EB_EVENT_L20.'<br />
									'.EB_EVENT_L21.'</td>';
					}
					else
					{
						// User signed up & not banned
						$text .= '<td>'.EB_EVENT_L22.'&nbsp;'.$player_name.'</td>';

						if($can_checkin == 1)
						{
							if($player_checkedin != 1)
							{
								$text .= '<td style="text-align:right">
											<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
											<div>
										<input type="hidden" name="player" value="'.$player_id.'"/>
											'.ebImageTextButton('checkinevent', 'user_go.ico', EB_EVENT_L88, 'jq-button', '', EB_EVENT_L89).'
											</div>
											</form></td>
											';
							}
							else
							{
								$text .= '<td>'.EB_EVENT_L90.'</td>';
							}
						}
						
						// Player can quit an event if he has not played yet
						$q_2 = "SELECT DISTINCT ".TBL_PLAYERS.".*"
						." FROM ".TBL_PLAYERS.", "
						.TBL_SCORES
						." WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')"
						." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
						$result_2 = $sql->db_Query($q_2);
						$nbrscores = mysql_numrows($result_2);
						if (($nbrscores == 0)&&($player_banned==0)&&($event->getField('Type')!="Clan Ladder"))
						{
							$text .= '<td>
										<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
										<div>
									<input type="hidden" name="player" value="'.$player_id.'"/>
										'.ebImageTextButton('quitevent', 'user_delete.ico', EB_EVENT_L23, 'negative jq-button', EB_EVENT_L24).'
										</div>
										</form></td>
										';
						}
						else
						{
							$text .= '<td></td>';
						}
					}
				}
				$text .= '</tr>';
			}
		}
	}
	break;
case "One Player Tournament":
case "One Player Ladder":
	// One player event
	//------------
	// Find gamer for that user
	$q = "SELECT ".TBL_GAMERS.".*"
	." FROM ".TBL_GAMERS
	." WHERE (".TBL_GAMERS.".Game = '".$event->getField('Game')."')"
	."   AND (".TBL_GAMERS.".User = ".USERID.")";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if ($num_rows!=0)
	{
		$gamerID = mysql_result($result,0 , TBL_GAMERS.".GamerID");
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

	// Is the user already signed up?
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_GAMERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_GAMERS.".User = ".USERID.")";
	$result = $sql->db_Query($q);
	if(!$result || (mysql_numrows($result) < 1))
	{
		// User is not signed up
		if ($can_signup==1)
		{
			$hide_password = ($event->getField('password') == "") ?  'hide ignore' : '';

			$text .= '<tr><td style="text-align:right">
					<div>
					'.ebImageTextButton('joinevent', 'user_add.png', EB_EVENT_L19, '', '', EB_EVENT_L28).'
					</div>
					';

			$text .= gamerEventSignupModalForm($event_id, $gamerID, $gamerName, $gamerUniqueGameID, $hide_password);
			$text .= '</td></tr>';
		}
		else
		{
			$text .= $cannot_signup_str;
		}
	}
	else
	{
		// User is signed up
		$player_id  = mysql_result($result,0 , TBL_PLAYERS.".PlayerID");
		$player_banned  = mysql_result($result,0 , TBL_PLAYERS.".Banned");
		$player_checkedin  = mysql_result($result,0 , TBL_PLAYERS.".CheckedIn");
		$player_name  = mysql_result($result,0 , TBL_GAMERS.".Name");

		if ($player_banned)
		{
			// User is banned
			$text .= '<tr><td>'.EB_EVENT_L29.'<br />
						'.EB_EVENT_L30.'</td><td></td></tr>';
		}
		else
		{
			// User is signed up & not banned
			$text .= '<tr><td>'.EB_EVENT_L31.'&nbsp;'.$player_name.'</td>';

			if($can_checkin == 1)
			{
				if($player_checkedin != 1)
				{
					$text .= '<td style="text-align:right">
								<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
								<div>
							<input type="hidden" name="player" value="'.$player_id.'"/>
								'.ebImageTextButton('checkinevent', 'user_go.ico', EB_EVENT_L88, 'jq-button', '', EB_EVENT_L89).'
								</div>
								</form></td>
								';
				}
				else
				{
					$text .= '<td>'.EB_EVENT_L90.'</td>';
				}
			}
			
			// Player can quit an event if he has not played yet
			$q = "SELECT DISTINCT ".TBL_PLAYERS.".*"
			." FROM ".TBL_PLAYERS.", "
			.TBL_SCORES
			." WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')"
			." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
			$result = $sql->db_Query($q);
			$nbrscores = mysql_numrows($result);
			if ($nbrscores == 0)
			{
				$text .= '<td style="text-align:right">
							<form action="'.e_PLUGIN.'ebattles/eventinfo_process.php?eventid='.$event_id.'" method="post">
							<div>
						<input type="hidden" name="player" value="'.$player_id.'"/>
							'.ebImageTextButton('quitevent', 'user_delete.ico', EB_EVENT_L32, 'negative jq-button', EB_EVENT_L33).'
							</div>
							</form></td></tr>
							';
			}
			else
			{
				$text .= '<td></td></tr>';
			}
		}
	}
	break;
default:
}
$text .= '</tbody></table>';


/* Info */
$text .= '<table class="eb_table" style="width:95%"><tbody>';

$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1">'.EB_EVENT_L36.'</td>';
$text .= '<td class="eb_td" style="font-variant:small-caps"><b>'.$event->getField('Name').'</b></td>';
$text .= '</tr>';

$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1">'.EB_EVENT_L37.'</td>';
$text .= '<td class="eb_td">'.(($event->getField('MatchType')!='') ? $event->getField('MatchType').' - ' : '').$event->eventTypeToString().'</td>';
$text .= '</tr>';

$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1">'.EB_EVENT_L38.'</td>';
$text .= '<td class="eb_td"><img '.getGameIconResize($egameicon).'/> '.$egame.'</td>';
$text .= '</tr>';

$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1">'.EB_EVENT_L39.'</td>';
$text .= '<td class="eb_td"><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$eowner.'">'.$eownername.'</a>';
$text .= '</td></tr>';

$text .= '<tr>';
$q = "SELECT ".TBL_EVENTMODS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_EVENTMODS.", "
.TBL_USERS
." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
."   AND (".TBL_USERS.".user_id = ".TBL_EVENTMODS.".User)";
$result = $sql->db_Query($q);
$numMods = mysql_numrows($result);
$text .= '<td class="eb_td eb_tdc1">'.EB_EVENT_L41.'</td>';
$text .= '<td class="eb_td">';
if ($numMods>0)
{
	$text .= '<ul>';
	for($i=0; $i< $numMods; $i++){
		$modid  = mysql_result($result,$i, TBL_USERS.".user_id");
		$modname  = mysql_result($result,$i, TBL_USERS.".user_name");
		$text .= '<li><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$modid.'">'.$modname.'</a></li>';
	}
	$text .= '</ul>';
}
$text .= '</td></tr>';

$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L82.'</td><td class="eb_td">'.$event->eventStatusToString().'</td></tr>';

// Gold
if(is_gold_system_active())
{
	if($event->getField('GoldEntryFee') > 0)
	{
		$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L96.'</td><td class="eb_td">'.$gold_obj->formation($event->getField('GoldEntryFee')).'</td></tr>';
	}
	if($event->getField('GoldWinningEvent') > 0)
	{
		$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L97.'</td><td class="eb_td">'.$gold_obj->formation($event->getField('GoldWinningEvent')).'</td></tr>';
	}
}

$time_comment = $event->eventStatusToTimeComment();
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L42.'</td><td class="eb_td">'.$date_start.'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L43.'</td><td class="eb_td">'.$date_end.'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1"></td><td class="eb_td">'.$time_comment.'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENTM_L36.'</td><td class="eb_td">'.$tp->toHTML($event->getField('Description'), true).'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L44.'</td><td class="eb_td">'.$tp->toHTML($event->getField('Rules'), true).'</td></tr>';
$text .= '</tbody></table>';
$text .= '</div>';    // tabs-1 "Info"

/* Teams Standings */
// Is the user a player?
$q = "SELECT ".TBL_PLAYERS.".*"
." FROM ".TBL_PLAYERS.", "
.TBL_GAMERS
." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
."   AND (".TBL_GAMERS.".User = ".USERID.")";
$result = $sql->db_Query($q);

$pbanned=0;
if(mysql_numrows($result) == 1)
{
	$row = mysql_fetch_array($result);
	$prank = $row['Rank'];
	$pbanned = $row['Banned'];

	/* My Position */
	if ($prank==0)
	$prank_txt = EB_EVENT_L54;
	else
	$prank_txt = "#$prank";

	$search_user = array_searchRecursive( 'user='.USERID.'"', $stats, false);

	($search_user) ? $link_page = ceil($search_user[0]/$pages->items_per_page) : $link_page = 1;

	$myPosition_txt = '<p>';
	$myPosition_txt .= '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'&amp;page='.$link_page.'&amp;ipp='.$pages->items_per_page.$pages->querystring.'">'.EB_EVENT_L55.': '.$prank_txt.'</a><br />';
	$myPosition_txt .= '</p>';
}

//fm: Need userclass for match scheduling

if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "Clan Ladder"))
{
	$text .= '<div id="tabs-2">';

	if(($can_challenge != 0)&&($event->getField('Type') == "Clan Ladder"))
	{
		$list_challenge_teams = array();
		$text .= '<form action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';
		$text .= '<table>';
		$text .= '<tr>';
		// "Challenge team" form
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		."   AND (".TBL_GAMERS.".User = '".USERID."')";
		$result = $sql->db_Query($q);
		$uteam = mysql_result($result,0 , TBL_PLAYERS.".Team");

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

		$text .= '<td><div>
		<select class="tbox" name="Challenged">
		';
		for($i=0; $i<$num_rows; $i++)
		{
			$tid  = mysql_result($result,$i, TBL_TEAMS.".TeamID");
			$trank  = mysql_result($result,$i, TBL_TEAMS.".Rank");
			$tname  = mysql_result($result,$i, TBL_CLANS.".Name");

			if(($uteam == 0)||($uteam != $tid))
			{
				if ($trank==0)
				$trank_txt = EB_EVENT_L54;
				else
				$trank_txt = "#$trank";
				$text .= '<option value="'.$tid.'">'.$tname.' ('.$trank_txt.')</option>';
				$list_challenge_teams[] = $tid;
			}
		}
		$text .= '
		</select>
		</div></td>
		';
		$Challenger = USERID;
		$text .= '<td><div>';
		$text .= '<input type="hidden" name="EventID" value="'.$event_id.'"/>';
		$text .= '<input type="hidden" name="submitted_by" value="'.$Challenger.'"/>';
		$text .= '</div></td>';

		$text .= '<td>';
		$text .= '<div>';
		$text .= '<input type="hidden" name="userclass" value="'.$userclass.'"/>';
		$text .= ebImageTextButton('challenge_team', 'challenge.png', EB_EVENT_L71);
		$text .= '</div>';
		$text .= '</td>';
		$text .= '</tr>';
		$text .= '</table>';
		$text .= '</form>';

		// Challenger team form
		$text .= '<form id="challenge_team_form" action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';
		$text .= '<div>';
		$text .= '<input type="hidden" name="challenged_team_choice" id="challenged_team_choice" value=""/>';
		$text .= '<input type="hidden" name="EventID" value="'.$event_id.'"/>';
		$text .= '<input type="hidden" name="submitted_by" value="'.$Challenger.'"/>';
		$text .= '</div>';
		$text .= '</form>';
	}

	if (($time < $nextupdate_timestamp) && ($eventIsChanged == 1))
	{
		$text .= EB_EVENT_L46.'&nbsp;'.$date_nextupdate.'<br />';
	}
	if(($rating_period > 0)&&($eventStatus == 'active'))
	{
		$text .= EB_EVENT_L104.'&nbsp;'.$date_next_rating.'<br />';
	}
	$text .= '<div class="spacer">';
	$text .= '<p>';
	$text .= $nbr_teams.'&nbsp;'.EB_EVENT_L95.'<br />';
	$text .= EB_EVENT_L47.'&nbsp;'.$event->getField('nbr_team_games_to_rank').'&nbsp;'.EB_EVENT_L48.'<br /><br />';
	$text .= '</p>';

	// Teams standings stats
	$lines = file($file_team);
	if($lines) {
		$stats = unserialize(implode('', $lines));
	}
	else
	{
		echo "Error openig file $file<br>";	// [fm] LANGUAGE
	}
	//print_r($stats);
	
	// Sorting the stats table
	$header = $stats[0];

	$new_header = array();
	$column = 0;
	foreach ($header as $header_cell)
	{
		//fm echo "column $column: $header_cell<br>";
		$pieces = explode("<br />", $header_cell);

		$new_header[] = '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'&amp;orderby='.$column.'&amp;sort='.$sort.'">'.$pieces[0].'</a>'.$pieces[1];
		$column++;
	}
	$header = array($new_header);
	$header[0][0] = "header";

	array_splice($stats,0,1);
	multi2dSortAsc($stats, $orderby, $sort_type);
	$stats = array_merge($header, $stats);
	//print_r($stats);

	$num_columns = count($stats[0]) - 1;
	$nbr_rows = count($stats);

	if($can_challenge == 0)
	{
		// Remove "challenges" header (last column)
		$stats[0][$num_columns] = "";
	}
	$stats_edited = array($stats[0]);
	
	for ($i = 1; $i <= $nbr_rows; $i++)
	{
		if($can_challenge == 0)
		{
			// Remove "challenges" column (last column)
			$stats[$i][$num_columns] = "";
		}
		else
		{
			// Remove challenge button if you are not allowed to challenge
			if(!check_can_challenge($stats[$i][$num_columns], $list_challenge_teams, "challenge_team_js"))
			{
				$stats[$i][$num_columns] = "";
			}
		}
		$stats_edited[] = $stats[$i];
	}

	$text .= html_show_table($stats_edited, $nbr_rows, $num_columns);
	$text .= '</div>';    // spacer
	$text .= '</div>';    // tabs-2 "Teams Standings"
}

/* Players Standings */
if (($event->getField('Type') == "Team Ladder")||($event->getField('Type') == "One Player Ladder"))
{
	$text .= '<div id="tabs-3">';

	if($can_challenge == 1)
	{
		$list_challenge_players = array();
		$text .= '<form action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';
		$text .= '<table>';
		$text .= '<tr>';
		// "Challenge player" form
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		."   AND (".TBL_GAMERS.".User = '".USERID."')";
		$result = $sql->db_Query($q);
		$uteam = mysql_result($result,0 , TBL_PLAYERS.".Team");

		$q = "SELECT ".TBL_PLAYERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Banned != 1)"
		."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
		." ORDER BY ".TBL_USERS.".user_name";
		$result = $sql->db_Query($q);
		$num_rows = mysql_numrows($result);

		$text .= '<td><div>
		<select class="tbox" name="Challenged">
		';
		for($i=0; $i<$num_rows; $i++)
		{
			$pid  = mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
			$puid  = mysql_result($result,$i, TBL_USERS.".user_id");
			$prank  = mysql_result($result,$i, TBL_PLAYERS.".Rank");
			$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
			$gamer = new Gamer($gamer_id);
			$pname = $gamer->getField('Name');
			$pteam  = mysql_result($result,$i, TBL_PLAYERS.".Team");
			list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);

			if(($puid != USERID)&&(($uteam == 0)||($uteam != $pteam)))
			{
				if ($prank==0)
				$prank_txt = EB_EVENT_L54;
				else
				$prank_txt = "#$prank";
				$text .= '<option value="'.$pid.'">'.$pclantag.$pname.' ('.$prank_txt.')</option>';
				
				$list_challenge_players[] = $pid;
			}
		}
		//fm:var_dump($list_challenge_players);
		$text .= '
		</select>
		</div></td>
		';
		$Challenger = USERID;
		$text .= '<td><div>';
		$text .= '<input type="hidden" name="EventID" value="'.$event_id.'"/>';
		$text .= '<input type="hidden" name="submitted_by" value="'.$Challenger.'"/>';
		$text .= '</div></td>';

		$text .= '<td>';
		$text .= '<div>';
		$text .= '<input type="hidden" name="userclass" value="'.$userclass.'"/>';
		$text .= ebImageTextButton('challenge_player', 'challenge.png', EB_EVENT_L65);
		$text .= '</div>';
		$text .= '</td>';
		$text .= '</tr>';
		$text .= '</table>';
		$text .= '</form>';
		
		// Challenger player form
		$text .= '<form id="challenge_player_form" action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';
		$text .= '<div>';
		$text .= '<input type="hidden" name="challenged_player_choice" id="challenged_player_choice" value=""/>';
		$text .= '<input type="hidden" name="EventID" value="'.$event_id.'"/>';
		$text .= '<input type="hidden" name="submitted_by" value="'.$Challenger.'"/>';
		$text .= '</div>';
		$text .= '</form>';		
	}

	if (($time < $nextupdate_timestamp) && ($eventIsChanged == 1))
	{
		$text .= EB_EVENT_L50.'&nbsp;'.$date_nextupdate.'<br />';
	}
	if(($rating_period > 0)&&($eventStatus == 'active'))
	{
		$text .= EB_EVENT_L104.'&nbsp;'.$date_next_rating.'<br />';
	}
	
	$text .= '<div class="spacer">';
	$text .= '<p>';
	$text .= $nbr_players.'&nbsp;'.EB_EVENT_L51.'<br />';
	$text .= EB_EVENT_L52.'&nbsp;'.$event->getField('nbr_games_to_rank').'&nbsp;'.EB_EVENT_L53.'<br />';
	$text .= '</p>';

	$text .= $myPosition_txt;

	$text .= '<br />';

	// Players standings stats
	$lines = file($file);
	if($lines) {
		$stats = unserialize(implode('', $lines));
	}
	else
	{
		echo "Error openig file $file<br>";	// [fm] LANGUAGE
	}
	//print_r($stats);

	// Sorting the stats table
	$header = $stats[0];

	$new_header = array();
	$column = 0;
	foreach ($header as $header_cell)
	{
		//fm echo "column $column: $header_cell<br>";
		$pieces = explode("<br />", $header_cell);

		$new_header[] = '<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'&amp;orderby='.$column.'&amp;sort='.$sort.'">'.$pieces[0].'</a>'.$pieces[1];
		$column++;
	}
	$header = array($new_header);
	$header[0][0] = "header";

	array_splice($stats,0,1);
	multi2dSortAsc($stats, $orderby, $sort_type);
	$stats = array_merge($header, $stats);
	//print_r($stats);

	/* set pagination variables */
	$totalItems = $nbr_players;
	$pages->items_total = $totalItems;
	$pages->mid_range = eb_PAGINATION_MIDRANGE;
	$pages->paginate();

	// Paginate
	$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
	$text .= '<span style="float:right">';
	// Go To Page
	$text .= $pages->display_jump_menu();
	$text .= '&nbsp;&nbsp;&nbsp;';
	// Items per page
	$text .= $pages->display_items_per_page();
	$text .= '</span><br /><br />';

	// Paginate the statistics array
	$max_row = count($stats);
	$num_columns = count($stats[0]) - 1;
	$nbr_rows = 1;

	if($can_challenge == 0)
	{
		// Remove "challenges" header (last column)
		$stats[0][$num_columns] = "";
	}
	$stats_paginate = array($stats[0]);
	
	for ($i = $pages->low + 1; $i <= $pages->high + 1; $i++)
	{
		if ($i < $max_row)
		{
			if($can_challenge == 0)
			{
				// Remove "challenges" column (last column)
				$stats[$i][$num_columns] = "";
			}
			else
			{
				// Remove challenge button if you are not allowed to challenge
				if(!check_can_challenge($stats[$i][$num_columns], $list_challenge_players, "challenge_player_js"))
				{
					$stats[$i][$num_columns] = "";
				}
			}
			$stats_paginate[] = $stats[$i];
			$nbr_rows ++;
		}
	}
	$text .= html_show_table($stats_paginate, $nbr_rows, $num_columns);
	$text .= '</div>';    // spacer
	$text .= '</div>';    // tabs-3 "Players Standings"
}

/* Matches */
$text .= '<div id="tabs-4">';
/* Display Match Report buttons */
if(($can_report_quickloss == 1)||($can_report == 1)||($can_submit_replay == 1)||($can_schedule == 1))
{
	$text .= '<table>';
	$text .= '<tr>';
	if($can_submit_replay == 1)
	{
		$text .= '<td>';
		$text .= '<form action="'.e_PLUGIN.'ebattles/submitreplay.php?eventid='.$event_id.'" method="post"><div>';
		$text .= ebImageTextButton('submitreplay', 'flag_red.png', EB_EVENT_L81);
		$text .= '</div></form>';
		$text .= '</td>';
	}
	if($can_report_quickloss == 1)
	{
		$text .= '<td>';
		$text .= '<form action="'.e_PLUGIN.'ebattles/quickreport.php?eventid='.$event_id.'" method="post"><div>';
		$text .= ebImageTextButton('quicklossreport', 'flag_red.png', EB_EVENT_L56);
		$text .= '</div></form>';
		$text .= '</td>';
	}
	if($can_report == 1)
	{
		$text .= '<td>';
		$text .= '<div>';
		$text .= ebImageLink('matchreport', EB_MATCHR_L32, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;actionid=matchreport&amp;userclass='.$userclass, 'report.png', EB_EVENT_L57, 'matchreport_link jq-button');
		$text .= '</div>';
		$text .= '</td>';
	}
	if($can_schedule == 1)
	{
		$text .= '<td>';
		$text .= '<div>';
		$text .= ebImageLink('matchschedule', EB_MATCHR_L32, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;actionid=matchschedule&amp;userclass='.$userclass, 'add.png', EB_EVENT_L72, 'matchreport_link jq-button');
		$text .= '</div>';
		$text .= '</td>';
		}
	$text .= '</tr>';
	$text .= '</table>';
}
$text .= '<br />';

/* Display Active Matches */
$rowsPerPage = $pref['eb_default_items_per_page'];

$q = "SELECT COUNT(DISTINCT ".TBL_MATCHS.".MatchID) as NbrMatches"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES
." WHERE (Event = '$event_id')"
." AND (".TBL_MATCHS.".Status = 'active')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)";
$result = $sql->db_Query($q);

$row = mysql_fetch_array($result);
$numMatches = $row['NbrMatches'];

$text .= '<p><b>';
$text .= $numMatches.'&nbsp;'.EB_EVENT_L59;
if ($numMatches>$rowsPerPage)
{
	$text .= ' [<a href="'.e_PLUGIN.'ebattles/eventmatchs.php?eventid='.$event_id.'">'.EB_EVENT_L60.'</a>]';
}
$text .= '</b></p>';
$text .= '<br />';

if($event->getField('FixturesEnable') == FALSE)
{
	$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
	." FROM ".TBL_MATCHS.", "
	.TBL_SCORES.", "
	.TBL_USERS
	." WHERE (".TBL_MATCHS.".Event = '$event_id')"
	." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
	." AND (".TBL_MATCHS.".Status = 'active')"
	." ORDER BY ".TBL_MATCHS.".TimeReported DESC"
	." LIMIT 0, $rowsPerPage";
	$result = $sql->db_Query($q);
	$numMatches = mysql_numrows($result);

	if ($numMatches>0)
	{
		/* Display table contents */
		$text .= '<table class="table_left">';
		for($i=0; $i < $numMatches; $i++)
		{
			$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
			$match = new Match($match_id);
			$text .= $match->displayMatchInfo(eb_MATCH_NOEVENTINFO);
		}
		$text .= '</table>';
	}
}
else
{
	$matchups = $event->getMatchups();
	$results = unserialize($event->getFieldHTML('Results'));
	$rounds = unserialize($event->getFieldHTML('Rounds'));
	$nbrRounds = count($matchups);
	for ($round = $nbrRounds; $round > 0; $round--){
		$nbrMatchups = count($matchups[$round]);
		$found_match = 0;
		for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
			$nbrMatchs = count($results[$round][$matchup]['matchs']);
			for ($match = 0; $match < $nbrMatchs; $match++) {
				$current_match = $results[$round][$matchup]['matchs'][$match];
				$match_id  = $current_match['match_id'];
				$matchObj = new Match($match_id);
				if($matchObj->getField('Status') == 'active')
				{
					$found_match = 1;
				}
			}
		}
		
		if ($found_match == 1)
		{
			$text .= '<b>'.$rounds[$round]['Title'].'</b>';
			$text .= ' ('.EB_EVENTM_L146.' '.$rounds[$round]['BestOf'].')';
			$text .= '<table class="table_left">';
			for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
				$nbrMatchs = count($results[$round][$matchup]['matchs']);
				$text_add = '';
				$nbrMatchsActive = 0;
				for ($match = 0; $match < $nbrMatchs; $match++) {
					$current_match = $results[$round][$matchup]['matchs'][$match];
					$match_id  = $current_match['match_id'];
					$matchObj = new Match($match_id);
					if($matchObj->getField('Status') == 'active')
					{
						$nbrMatchsActive++;
						$text_add .= $matchObj->displayMatchInfo(eb_MATCH_NOEVENTINFO, EB_MATCH_L1.'&nbsp;'.($match+1).'&nbsp;');
					}
				}
				if($nbrMatchsActive>0)	$text .= '<tr><td><b>'.EB_EVENT_L102.' '.$matchup.'</b></td></tr>';
				$text .= $text_add;

			}
			$text .= '</table>';
			$text .= '<br />';
		}
	}
}
$text .= '<br />';

/* Display Pending Matches */
$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES.", "
.TBL_USERS
." WHERE (".TBL_MATCHS.".Event = '$event_id')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_MATCHS.".Status = 'pending')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC";
$result = $sql->db_Query($q);
$numMatches = mysql_numrows($result);

if ($numMatches>0)
{
	$text .= '<p><b>';
	$text .= $numMatches.'&nbsp;'.EB_EVENT_L64;
	$text .= '</b></p>';
	$text .= '<br />';

	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i < $numMatches; $i++)
	{
		$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
		$match = new Match($match_id);
		$text .= $match->displayMatchInfo(eb_MATCH_NOEVENTINFO);
	}
	$text .= '</table>';
}

/* Display Scheduled Matches */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES
." WHERE (".TBL_MATCHS.".Event = '$event_id')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_MATCHS.".Status = 'scheduled')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC";
$result = $sql->db_Query($q);
$numMatches = mysql_numrows($result);
if ($numMatches>0)
{
	$text .= '<p><b>';
	$text .= $numMatches.'&nbsp;'.EB_EVENT_L70;
	$text .= '</b></p>';
	$text .= '<br />';

	if($event->getField('FixturesEnable') == FALSE)
	{
		/* Display table contents */
		$text .= '<table class="table_left">';
		for($i=0; $i < $numMatches; $i++)
		{
			$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
			$match = new Match($match_id);
			$text .= $match->displayMatchInfo(eb_MATCH_NOEVENTINFO|eb_MATCH_SCHEDULED);
		}
		$text .= '</table>';
	}
	else
	{
		for ($round = 0; $round < $nbrRounds; $round++){
			$nbrMatchups = count($matchups[$round]);
			$found_match = 0;
			for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
				$nbrMatchs = count($results[$round][$matchup]['matchs']);
				for ($match = 0; $match < $nbrMatchs; $match++) {
					$current_match = $results[$round][$matchup]['matchs'][$match];
					$match_id  = $current_match['match_id'];
					$matchObj = new Match($match_id);
					if($matchObj->getField('Status') == 'scheduled')
					{
						$found_match = 1;
					}
				}
			}
			
			if ($found_match == 1)
			{
				$text .= '<b>'.$rounds[$round]['Title'].'</b>';
				$text .= ' ('.EB_EVENTM_L146.' '.$rounds[$round]['BestOf'].')';
				$text .= '<table class="table_left">';
				for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
					$nbrMatchs = count($results[$round][$matchup]['matchs']);
					$text_add = '';
					$nbrMatchsScheduled = 0;
					for ($match = 0; $match < $nbrMatchs; $match++) {
						$current_match = $results[$round][$matchup]['matchs'][$match];
						$match_id  = $current_match['match_id'];
						$matchObj = new Match($match_id);
						if($matchObj->getField('Status') == 'scheduled')
						{
							$nbrMatchsScheduled++;
							$text_add .= $matchObj->displayMatchInfo(eb_MATCH_NOEVENTINFO|eb_MATCH_SCHEDULED, EB_MATCH_L1.'&nbsp;'.($match+1).'&nbsp;');
						}
					}
					if($nbrMatchsScheduled>0)	$text .= '<tr><td><b>'.EB_EVENT_L102.' '.$matchup.'</b></td></tr>';
					$text .= $text_add;
				}
				$text .= '</table>';
			}
		}	
	}
}



/* Display Unconfirmed Challenges */
$text .= '<br />';

$q = "SELECT DISTINCT ".TBL_CHALLENGES.".*"
." FROM ".TBL_CHALLENGES.", "
.TBL_PLAYERS
." WHERE (".TBL_CHALLENGES.".Event = '".$event_id."')"
."   AND (".TBL_CHALLENGES.".Status = 'requested')"
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
		$text .= $challenge->displayChallengeInfo(eb_MATCH_NOEVENTINFO);
	}
	$text .= '</table>';
}

$text .= '</div>';    // tabs-4 "Matches"

$text .= '<div id="tabs-5">';

$rowsPerPage = $pref['eb_default_items_per_page'];

$awards = array();
$nbr_awards = 0;

/* Latest awards */
$q = "SELECT ".TBL_AWARDS.".*, "
.TBL_PLAYERS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_AWARDS.", "
.TBL_PLAYERS.", "
.TBL_GAMERS.", "
.TBL_USERS
." WHERE (".TBL_AWARDS.".Player = ".TBL_PLAYERS.".PlayerID)"
." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
." AND (".TBL_GAMERS.".User = ".TBL_USERS.".user_id)"
." AND (".TBL_PLAYERS.".Event = '$event_id')"
." ORDER BY ".TBL_AWARDS.".timestamp DESC"
." LIMIT 0, $rowsPerPage";

$result = $sql->db_Query($q);
$numAwards = mysql_numrows($result);

if ($numAwards>0)
{
	/* Display table contents */
	for($i=0; $i < $numAwards; $i++)
	{
		$aID  = mysql_result($result,$i, TBL_AWARDS.".AwardID");
		$aUser  = mysql_result($result,$i, TBL_USERS.".user_id");
		$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
		$gamer = new Gamer($gamer_id);
		$aUserNickName = $gamer->getField('Name');
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
		$award_string .= '&nbsp;'.$award;

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

		$awards[$nbr_awards][0] = $aTime;
		$awards[$nbr_awards][1] = $award_string;
		$nbr_awards ++;
	}
}

$q = "SELECT ".TBL_AWARDS.".*, "
.TBL_TEAMS.".*"
." FROM ".TBL_AWARDS.", "
.TBL_TEAMS
." WHERE (".TBL_AWARDS.".Team = ".TBL_TEAMS.".TeamID)"
." AND (".TBL_TEAMS.".Event = '$event_id')"
." ORDER BY ".TBL_AWARDS.".timestamp DESC"
." LIMIT 0, $rowsPerPage";

$result = $sql->db_Query($q);
$numAwards = mysql_numrows($result);

if ($numAwards>0)
{
	/* Display table contents */
	for($i=0; $i < $numAwards; $i++)
	{
		$aID  = mysql_result($result,$i, TBL_AWARDS.".AwardID");
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
		}

		$award_string = '<tr><td style="vertical-align:top">'.$icon.'</td>';
		$award_string .= '<td><a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$tclanid.'">'.$tclan.'</a>';
		$award_string .= '&nbsp;'.$award;

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

		$awards[$nbr_awards][0] = $aTime;
		$awards[$nbr_awards][1] = $award_string;
		$nbr_awards ++;
	}
}

if ($nbr_awards>0)
{
	$text .= '<table class="table_left">';
	multi2dSortAsc($awards, 0, SORT_DESC);
	for ($index = 0; $index<min($nbr_awards, $rowsPerPage); $index++)
	{
		$text .= $awards[$index][1];
	}
	$text .= '</table>';
}

$text .= '</div>';    // tabs-5 "Latest Awards"
$text .= '</div>';    // tabs

$text .= disclaimer();


function check_can_challenge($stat, $list_challenge, $str)
{
	//echo "test: $stat<br>";
	$regex = "/".$str."\(\'([a-zA-Z0-9_]*)\'\)/";
	preg_match_all($regex, $stat, $matches);
	$val = $matches[1][0];
	
	foreach($list_challenge as $player)
	{
		if($player == $val) return 1;
	}
	return 0;
}
?>

