<?php
/**
* tournamentinfo.php
*
*/

/* Update */
if ($eventIsChanged == 1)
{
	$new_nextupdate = $time + 60*$pref['eb_events_update_delay'];
	$event->setFieldDB('NextUpdate_timestamp', $new_nextupdate);

	$event->setFieldDB('IsChanged', 0);
	$eventIsChanged = 0;
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
$text .= '<li><a href="#tabs-3">'.EB_EVENT_L76.'</a></li>';
$text .= '<li><a href="#tabs-4">'.EB_EVENT_L58.$match_pending_text.'</a></li>';
$text .= '<li><a href="#tabs-5">'.$tab_title.'</a></li>';
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
$text .= '<tr><td class="eb_td eb_tdc1"></td><td class="eb_td">'.$time_comment.'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENTM_L36.'</td><td class="eb_td">'.$tp->toHTML($event->getField('Description'), true).'</td></tr>';
$text .= '<tr><td class="eb_td eb_tdc1">'.EB_EVENT_L44.'</td><td class="eb_td">'.$tp->toHTML($event->getField('Rules'), true).'</td></tr>';
$text .= '</tbody></table>';
$text .= '</div>';    // tabs-1 "Info"

/* Players Standings */
$text .= '<div id="tabs-3">';

if($hide_fixtures == 0)
{
	list($bracket_html) = $event->brackets(false, 0, 'elimination');
	$text .= $bracket_html;
}
else
{
	$text .= EB_EVENT_L94;
}

$text .= '</div>';    // tabs-3 "Brackets"

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
$text .= '</div>';    // tabs-4 "Matches"

$text .= '<div id="tabs-5">';
switch($event->getMatchPlayersType())
{
case 'Players':
	// Show list of players
	$q_Players = "SELECT DISTINCT ".TBL_PLAYERS.".*, "
	.TBL_GAMERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	." ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";
	$result = $sql->db_Query($q_Players);
	$nbr_players = mysql_numrows($result);
	if ($nbr_players>0)
	{
		$text .= '<table id="players_list" class="eb_table" style="width:90%"><thead>';
		$text .= '<tr>';
		if($show_seeds_players == true)
		{
			// Column "Seed"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L154.'</th>';
		}
		//sc2:	$text .= '<th class="eb_th2">'.EB_EVENT_L78.'</th>';
		// Column "Player"
		$text .= '<th class="eb_th2">'.EB_EVENT_L79.'</th>';
		// Column "Joined"
		$text .= '<th class="eb_th2">'.EB_EVENTM_L56.'</th>';
		if($event->getField('CheckinDuration') > 0)
		{
			// Column "Checked in"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L170.'</th>';
		}
		$text .= '</tr></thead>';
		$text .= '<tbody>';
		
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

			$image = "";
			// TBD: player image

			$text .= '<tr id="player_'.$pid.'">';
			if($show_seeds_players == true)
			{
				// Column "Seed"
				$text .= '<td class="eb_td">'.$pseed;
				if($waiting_list == true)
				{
					// Not seeded
					$text .= EB_EVENT_L103;
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
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';
	}
	break;
case 'Teams':
	// Show list of teams here
	$q_Teams = "SELECT ".TBL_CLANS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_DIVISIONS.".* "
	." FROM ".TBL_CLANS.", "
	.TBL_TEAMS.", "
	.TBL_DIVISIONS
	." WHERE (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_TEAMS.".Event = '$event_id')"
	." ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
	$result = $sql->db_Query($q_Teams);
	$nbr_teams = mysql_numrows($result);
	if($nbr_teams>0)
	{
		$text .= '<table id="teams_list" class="eb_table" style="width:90%"><thead>';
		$text .= '<tr>';
		if($show_seeds_teams == true)
		{
			// Column "Seed"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L154.'</th>';
		}
		// Column "Team"
		$text .= '<th class="eb_th2">'.EB_CLANS_L5.'</th>';
		// Column "Joined"
		$text .= '<th class="eb_th2">'.EB_CLANS_L6.'</th>';
		if($event->getField('CheckinDuration') > 0)
		{
			// Column "Checked in"
			$text .= '<th class="eb_th2">'.EB_EVENTM_L170.'</th>';
		}
		$text .= '</tr></thead>';
		$text .= '<tbody>';

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
				$text .= '<td class="eb_td">'.$tseed;
				if($waiting_list == true)
				{
					// Not seeded
					$text .= EB_EVENT_L103;
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
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';
	}
	break;
default:
}


$text .= '<br />';

$text .= '</div>';    // tabs-5 "Players"
$text .= '</div>';    // tabs

$text .= disclaimer();

?>

