<?php
// functions for events.
//___________________________________________________________________
require_once(e_PLUGIN.'ebattles/include/main.php');
require_once(e_PLUGIN.'ebattles/include/match.php');
require_once(e_PLUGIN."ebattles/include/updatestats.php");
require_once(e_PLUGIN."ebattles/include/updateteamstats.php");
require_once(e_PLUGIN."ebattles/include/brackets.php");

class Event extends DatabaseTable
{
	protected $tablename = TBL_EVENTS;
	protected $primary_key = "EventID";

	/***************************************************************************************
	Functions
	***************************************************************************************/
	function __construct($primaryID=0) {
		parent::__construct($primaryID);
		
		// Force "Enable fixtures" for tournaments
		if($this->getCompetitionType()=='Tournament') $this->setFieldDB('FixturesEnable', TRUE);
	}
	
	function setDefaultFields()
	{
		$this->setField('Game', 1);
		$this->setField('Type', 'One Player Ladder');
		$this->setField('Format', 'Single Elimination');
		$this->setField('MatchType', '');
		$this->setField('nbr_games_to_rank', '1');
		$this->setField('nbr_team_games_to_rank', '1');
		$this->setField('ELO_default', ELO_DEFAULT);
		$this->setField('ELO_K', ELO_K);
		$this->setField('ELO_M', ELO_M);
		$this->setField('TS_default_mu', floatToSQL(TS_Mu0));
		$this->setField('TS_default_sigma', floatToSQL(TS_sigma0));
		$this->setField('TS_beta', floatToSQL(TS_beta));
		$this->setField('TS_epsilon', floatToSQL(TS_epsilon));
		$this->setField('TS_tau', floatToSQL(TS_tau));
		$this->setField('G2_default_r', floatToSQL(G2_r0));
		$this->setField('G2_default_RD', floatToSQL(G2_RD0));
		$this->setField('G2_default_sigma', floatToSQL(G2_sigma0));
		$this->setField('G2_tau', floatToSQL(G2_tau));
		$this->setField('G2_epsilon', floatToSQL(G2_epsilon));
		$this->setField('rating_period', eb_rating_period);
		$this->setField('next_rating_timestamp', '0');
		$this->setField('IsChanged', '1');
		$this->setField('AllowDraw', '0');
		$this->setField('AllowForfeit', '0');
		$this->setField('ForfeitWinLossUpdate', '0');
		$this->setField('ForfeitWinPoints', PointsPerWin_DEFAULT);
		$this->setField('ForfeitLossPoints', PointsPerDraw_DEFAULT);
		$this->setField('AllowScore', '0');
		$this->setField('PointsPerWin', PointsPerWin_DEFAULT);
		$this->setField('PointsPerDraw', PointsPerDraw_DEFAULT);
		$this->setField('PointsPerLoss', PointsPerLoss_DEFAULT);
		$this->setField('match_report_userclass', eb_UC_EVENT_MODERATOR);
		$this->setField('match_replay_report_userclass', eb_UC_EVENT_PLAYER);
		$this->setField('quick_loss_report', '0');
		$this->setField('hide_ratings_column', '0');
		$this->setField('MatchesApproval', eb_UC_NONE);
		$this->setField('RankingType', 'Classic');
		$this->setField('Visibility', eb_UC_NONE);
		$this->setField('Status', 'draft');
		$this->setField('PlayersApproval', eb_UC_NONE);
		$this->setField('ChallengesEnable', '0');
		$this->setField('MaxDatesPerChallenge', eb_MAX_CHALLENGE_DATES);
		$this->setField('MaxMapsPerMatch', eb_MAX_MAPS_PER_MATCH);
		$this->setField('MaxNumberPlayers', '16');
		$this->setField('MatchupsFile', '');
		$this->setField('FixturesEnable', '0');
		$this->setField('CheckinDuration', '0');
		$this->setField('HideFixtures', '0');
		$this->setField('GoldEntryFee', '0');
		$this->setField('GoldWinningEvent', '0');
		$this->setField('SignupsEnable', '1');
		$this->setField('AllowLateSignups', '1');
	}

	function resetPlayers()
	{
		global $sql;

		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_players = mysql_numrows($result);
		if ($num_players!=0)
		{
			for($j=0; $j< $num_players; $j++)
			{
				$PlayerID  = mysql_result($result,$j, TBL_PLAYERS.".PlayerID");
				$q2 = "UPDATE ".TBL_PLAYERS
				." SET ELORanking = '".$this->fields['ELO_default']."',"
				."     TS_mu = '".floatToSQL($this->fields['TS_default_mu'])."',"
				."     TS_sigma = '".floatToSQL($this->fields['TS_default_sigma'])."',"
				."     G2_r = '".floatToSQL($this->fields['G2_default_r'])."',"
				."     G2_RD = '".floatToSQL($this->fields['G2_default_RD'])."',"
				."     G2_sigma = '".floatToSQL($this->fields['G2_default_sigma'])."',"
				."     GamesPlayed = 0,"
				."     Loss = 0,"
				."     Win = 0,"
				."     Draw = 0,"
				."     Score = 0,"
				."     ScoreAgainst = 0,"
				."     Points = 0,"
				."     Forfeits = 0,"
				."     Rank = 0,"
				."     RankDelta = 0,"
				."     OverallScore = 0,"
				."     Streak = 0,"
				."     Streak_Best = 0,"
				."     Streak_Worst = 0"
				." WHERE (PlayerID = '$PlayerID')";
				$result2 = $sql->db_Query($q2);

				deletePlayerAwards($PlayerID);
			}
		}
	}

	function resetTeams()
	{
		global $sql;
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_teams = mysql_numrows($result);
		if ($num_teams!=0)
		{
			for($j=0; $j< $num_teams; $j++)
			{
				$TeamID  = mysql_result($result,$j, TBL_TEAMS.".TeamID");
				$q2 = "UPDATE ".TBL_TEAMS
				." SET ELORanking = '".$this->fields['ELO_default']."',"
				."     TS_mu = '".floatToSQL($this->fields['TS_default_mu'])."',"
				."     TS_sigma = '".floatToSQL($this->fields['TS_default_sigma'])."',"
				."     G2_r = '".floatToSQL($this->fields['G2_default_r'])."',"
				."     G2_RD = '".floatToSQL($this->fields['G2_default_RD'])."',"
				."     G2_sigma = '".floatToSQL($this->fields['G2_default_sigma'])."',"
				."     GamesPlayed = 0,"
				."     Loss = 0,"
				."     Win = 0,"
				."     Draw = 0,"
				."     Score = 0,"
				."     ScoreAgainst = 0,"
				."     Points = 0,"
				."     Forfeits = 0,"
				."     Streak = 0,"
				."     Streak_Best = 0,"
				."     Streak_Worst = 0"
				." WHERE (TeamID = '$TeamID')";
				$result2 = $sql->db_Query($q2);
			}
		}
	}

	function deleteMatches()
	{
		global $sql;
		$q2 = "SELECT ".TBL_MATCHS.".*"
		." FROM ".TBL_MATCHS
		." WHERE (".TBL_MATCHS.".Event = '".$this->fields['EventID']."')";
		$result2 = $sql->db_Query($q2);
		$num_matches = mysql_numrows($result2);
		if ($num_matches!=0)
		{
			for($j=0; $j<$num_matches; $j++)
			{
				$match_id  = mysql_result($result2,$j, TBL_MATCHS.".MatchID");
				$q3 = "DELETE FROM ".TBL_SCORES
				." WHERE (".TBL_SCORES.".MatchID = '$match_id')";
				$result3 = $sql->db_Query($q3);
				$q3 = "DELETE FROM ".TBL_MATCHS
				." WHERE (".TBL_MATCHS.".MatchID = '$match_id')";
				$result3 = $sql->db_Query($q3);
			}
		}
	}

	function deleteChallenges()
	{
		global $sql;
		$q2 = "DELETE FROM ".TBL_CHALLENGES
		." WHERE (".TBL_CHALLENGES.".Event = '".$this->fields['EventID']."')";
		$result2 = $sql->db_Query($q2);
	}

	function deletePlayers()
	{
		global $sql;
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_players = mysql_numrows($result);
		if ($num_players!=0)
		{
			for($j=0; $j<$num_players; $j++)
			{
				$pID  = mysql_result($result, $j, TBL_PLAYERS.".PlayerID");
				deletePlayer($pID);
			}
		}
	}

	function deleteTeams()
	{
		global $sql;
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_teams = mysql_numrows($result);
		if ($num_teams!=0)
		{
			for($j=0; $j<$num_teams; $j++)
			{
				$tID  = mysql_result($result, $j, TBL_TEAMS.".TeamID");
				deleteTeam($tID);
			}
		}
	}

	function deleteMods()
	{
		global $sql;
		$q3 = "DELETE FROM ".TBL_EVENTMODS
		." WHERE (".TBL_EVENTMODS.".Event = '".$this->fields['EventID']."')";
		$result3 = $sql->db_Query($q3);
	}

	function deleteStatsCats()
	{
		global $sql;
		$q3 = "DELETE FROM ".TBL_STATSCATEGORIES
		." WHERE (".TBL_STATSCATEGORIES.".Event = '".$this->fields['EventID']."')";
		$result3 = $sql->db_Query($q3);
	}

	function deleteEvent()
	{
		global $sql;
		$this->deleteMatches();
		$this->deleteChallenges();
		$this->deletePlayers();
		$this->deleteTeams();
		$this->deleteMods();
		$this->deleteStatsCats();
		$q3 = "DELETE FROM ".TBL_EVENTS
		." WHERE (".TBL_EVENTS.".EventID = '".$this->fields['EventID']."')";
		$result3 = $sql->db_Query($q3);
	}

	/**
	* eventScoresUpdate - Re-calculate the scores and players of an event
	*/
	function eventScoresUpdate($current_match)
	{
		global $sql;
		global $time;

		//echo "dbg: current_match $current_match<br>";

		$numMatchsPerUpdate = 10;

		$q = "SELECT ".TBL_MATCHS.".*"
		." FROM ".TBL_MATCHS
		." WHERE (".TBL_MATCHS.".Event = '".$this->fields['EventID']."')"
		." AND (".TBL_MATCHS.".Status = 'active')"
		." ORDER BY TimeReported";
		$result = $sql->db_Query($q);
		$num_matches = mysql_numrows($result);

		if ($current_match > $num_matches)
		{
			switch($this->fields['Type'])
			{
			case "One Player Ladder":
				updateStats($this->fields['EventID'], $time, true);
				break;
			case "Team Ladder":
				updateStats($this->fields['EventID'], $time, true);
				updateTeamStats($this->fields['EventID'], $time, true);
				break;
			case "Clan Ladder":
				updateTeamStats($this->fields['EventID'], $time, true);
				break;
			case "One Player Tournament":
			case "Clan Tournament":
				break;
			default:
			}
			echo "Done.";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=eventmanage.php?eventid='.$this->fields['EventID'].'">';
		}
		else
		{
			$next_match = 1;
			if ($current_match == 0)
			{
				// Reset players stats
				$this->resetPlayers();
				$this->resetTeams();

				switch($this->fields['Type'])
				{
				case "One Player Ladder":
					updateStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
					break;
				case "Team Ladder":
					updateStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
					updateTeamStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
					break;
				case "Clan Ladder":
					updateTeamStats($this->fields['EventID'], $this->fields['getStartDateTime'], false);
					break;
				case "One Player Tournament":
				case "Clan Tournament":
					break;
				default:
				}
			}
			else
			{
				if (ob_get_level() == 0) {
					ob_start();
				}
				// Output a 'waiting message'
				echo str_pad('Please wait while this task completes... ',4096)."<br />\n";

				// Update matchs scores
				for($j=$current_match - 1; $j < min($current_match + $numMatchsPerUpdate - 1, $num_matches); $j++)
				{
					set_time_limit(10);

					$next_match = $j + 2;
					$match_id  = mysql_result($result,$j, TBL_MATCHS.".MatchID");
					$match = new Match($match_id);

					$time_reported  = mysql_result($result,$j, TBL_MATCHS.".TimeReported");

					//echo "dbg: match: $match_id<br>";
					//echo "dbg: etype: $this->fields['Type']<br>";

					$match->match_scores_update();

					switch($this->fields['Type'])
					{
					case "One Player Ladder":
						$match->match_players_update();
						updateStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
						break;
					case "Team Ladder":
						$match->match_players_update();
						updateStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
						updateTeamStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
						break;
					case "Clan Ladder":
						$match->match_teams_update();
						updateTeamStats($this->fields['EventID'], $this->fields['StartDateTime'], false);
						break;
					case "One Player Tournament":
					case "Clan Tournament":
						break;
					default:
					}

					//echo 'match '.$j.': '.$match_id.'<br>';
					//echo '<div class="percents">match '.$j.': '.$match_id.'</div>';
					echo '<div class="percents">' . number_format(100*($j+1)/$num_matches, 0, '.', '') . '%&nbsp;complete</div>';
					echo str_pad('',4096)."\n";
					ob_flush();
					flush();
				}
			}

			echo '<form name="updateform" action="'.e_PLUGIN.'ebattles/eventprocess.php?eventid='.$this->fields['EventID'].'" method="post">';
			echo '<input type="hidden" name="match" value="'.$next_match.'"/>';
			echo '<input type="hidden" name="eventupdatescores" value="1"/>';
			echo '</form>';
			echo '<script language="javascript">document.updateform.submit()</script>';

			ob_end_flush();
		}
		exit;
	}

	/**
	* eventAddPlayer - add a user to an event
	*/
	function eventAddPlayer($user, $team = 0, $notify)
	{
		global $sql;
		global $time;

		$q = "SELECT ".TBL_USERS.".*"
		." FROM ".TBL_USERS
		." WHERE (".TBL_USERS.".user_id = '$user')";
		$result = $sql->db_Query($q);
		$username = mysql_result($result, 0, TBL_USERS.".user_name");
		$useremail = mysql_result($result, 0, TBL_USERS.".user_email");

		// Find gamer for that user
		$q = "SELECT ".TBL_GAMERS.".*"
		." FROM ".TBL_GAMERS
		." WHERE (".TBL_GAMERS.".Game = '".$this->fields['Game']."')"
		."   AND (".TBL_GAMERS.".User = '$user')";
		$result = $sql->db_Query($q);
		$num_rows = mysql_numrows($result);
		if ($num_rows==0)
		{
			// Need to create gamer before coming here (i.e. when player joins a division.)
			// If the gamer does not exist, create one.
			$gamerID = updateGamer($user, $this->fields['Game'], $username, "");
		}
		else
		{
			$gamerID = mysql_result($result, 0, TBL_GAMERS.".GamerID");
		}
		
		// Find next available seed
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')"
		." ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";
		$result = $sql->db_Query($q);
		$numPlayers = mysql_numrows($result);
		$looking_for_seed = 1;
		$set_seed = true;
		for($player = 0; $player<$numPlayers; $player++)
		{
			$pseed = mysql_result($result, $player, TBL_PLAYERS.".Seed");
			//if(isset($pseed) && ($pseed!=0)) $set_seed  = true;
			if($pseed == $looking_for_seed) $looking_for_seed++;
		}

		// Is the user already signed up for the team?
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')"
		."   AND (".TBL_PLAYERS.".Team = '$team')"
		."   AND (".TBL_PLAYERS.".Gamer = '$gamerID')";
		$result = $sql->db_Query($q);
		$num_rows = mysql_numrows($result);
		echo "num_rows: $num_rows<br>";
		if ($num_rows==0)
		{
			$q = " INSERT INTO ".TBL_PLAYERS."(Event,Gamer,Team,ELORanking,TS_mu,TS_sigma,G2_r,G2_RD,G2_sigma,Joined)
			VALUES (".$this->fields['EventID'].",$gamerID,$team,".$this->fields['ELO_default'].",".$this->fields['TS_default_mu'].",".$this->fields['TS_default_sigma'].",".$this->fields['G2_default_r'].",".$this->fields['G2_default_RD'].",".$this->fields['G2_default_sigma'].",$time)";
			$sql->db_Query($q);
			echo "player created, query: $q<br>";
			$last_id = mysql_insert_id();
			
			if($set_seed == true)
			{
				$q = "UPDATE ".TBL_PLAYERS." SET Seed = '".($looking_for_seed)."' WHERE (PlayerID = '".$last_id."')";
				$sql->db_Query($q);
			}

			if(($this->getField('FixturesEnable') == TRUE)&&($this->getField('Status') == 'active'))
			{
				$this->brackets(true);
			}			
			$this->setFieldDB('IsChanged', 1);
			
			if ($notify)
			{
				$sendto = $user;
				$subject = SITENAME." ".$this->fields['Name'];
				$message = EB_EVENTS_L26.$username.EB_EVENTS_L27.$this->fields['Name'].EB_EVENTS_L29.EB_EVENTS_L31;
				sendNotification($sendto, $subject, $message, $fromid=0);

				// Send email
				//$message = EB_EVENTS_L26.$username.EB_EVENTS_L27.$this->fields['Name'].EB_EVENTS_L30."<a href='".SITEURLBASE.e_PLUGIN_ABS."ebattles/eventinfo.php?eventid=$this->fields['EventID']'>$this->fields['Name']</a>.".EB_EVENTS_L31.USERNAME.EB_EVENTS_L32;
				$message = EB_EVENTS_L26.$username.EB_EVENTS_L27.$this->fields['Name'].EB_EVENTS_L30.SITEURLBASE.e_PLUGIN_ABS."ebattles/eventinfo.php?eventid=".$this->fields['EventID'].EB_EVENTS_L31;
				require_once(e_HANDLER."mail.php");
				sendemail($useremail, $subject, $message);
			}
		}
	}

	/**
	* eventAddDivision - add a division to an event
	*/
	function eventAddDivision($div_id, $notify)
	{
		global $sql;
		global $time;

		// Find next available seed
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')"
		." ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
		$result = $sql->db_Query($q);
		$numTeams = mysql_numrows($result);
		$looking_for_seed = 1;
		$set_seed = true;
		for($team = 0; $team<$numTeams; $team++)
		{
			$tseed = mysql_result($result, $team, TBL_TEAMS.".Seed");
			//if(isset($tseed) && ($tseed!=0)) $set_seed  = true;
			if($tseed == $looking_for_seed) $looking_for_seed++;
		}

		//$add_players = ( $this->fields['Type'] == "Clan Ladder" ? false : true);
		$add_players = true;

		// Is the division signed up
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')"
		." AND (".TBL_TEAMS.".Division = '$div_id')";
		$result = $sql->db_Query($q);
		$numTeams = mysql_numrows($result);
		if($numTeams == 0)
		{
			$q = "INSERT INTO ".TBL_TEAMS."(Event,Division,ELORanking,TS_mu,TS_sigma,G2_r,G2_RD,G2_sigma,Joined)
			VALUES (".$this->fields['EventID'].",$div_id,".$this->fields['ELO_default'].",".$this->fields['TS_default_mu'].",".$this->fields['TS_default_sigma'].",".$this->fields['G2_default_r'].",".$this->fields['G2_default_RD'].",".$this->fields['G2_default_sigma'].",$time)";
			$sql->db_Query($q);
			$team_id =  mysql_insert_id();

			if($set_seed == true)
			{
				$q = "UPDATE ".TBL_TEAMS." SET Seed = '".($looking_for_seed)."' WHERE (TeamID = '".$team_id."')";
				$sql->db_Query($q);
			}

			if(($this->getField('FixturesEnable') == TRUE)&&($this->getField('Status') == 'active'))
			{
				$this->brackets(true);
			}
			$this->setFieldDB('IsChanged', 1);
			
			if ($add_players == true)
			{
				// All members of this division will automatically be signed up to this event
				$q_2 = "SELECT ".TBL_DIVISIONS.".*, "
				.TBL_MEMBERS.".*, "
				.TBL_USERS.".*"
				." FROM ".TBL_DIVISIONS.", "
				.TBL_USERS.", "
				.TBL_MEMBERS
				." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
				." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
				." AND (".TBL_USERS.".user_id = ".TBL_MEMBERS.".User)";
				$result_2 = $sql->db_Query($q_2);
				$num_rows_2 = mysql_numrows($result_2);
				if($num_rows_2 > 0)
				{
					for($j=0; $j<$num_rows_2; $j++)
					{
						$user_id  = mysql_result($result_2,$j, TBL_USERS.".user_id");
						$this->eventAddPlayer($user_id, $team_id, $notify);
					}
				}
			}
		}
	}
	
	function updateResults($results) {
		$new_results = serialize($results);
		$this->setField('Results', $new_results);
	}

	function resetResults()
	{
		$this->setField('Results', '');
	}

	function updateRounds($rounds) {
		$new_rounds = serialize($rounds);
		$this->setField('Rounds', $new_rounds);
	}

	function initRounds() {
		$matchups = $this->getMatchups();
		$nbrRounds = count($matchups);

		if($nbrRounds>0)
		{
			$rounds = unserialize($this->getFieldHTML('Rounds'));
			if (!isset($rounds)) $rounds = array();
			for ($round = 1; $round < $nbrRounds; $round++) {
				if (!isset($rounds[$round])) {
					$rounds[$round] = array();
				}
				if (!isset($rounds[$round]['Title'])) {
					$rounds[$round]['Title'] = EB_EVENTM_L144.' '.$round;
				}
				if (!isset($rounds[$round]['BestOf'])) {
					$rounds[$round]['BestOf'] = 1;
				}
			}
			$this->updateRounds($rounds);
		}
	}

	function updateMapPool($mapPool) {
		$i = 0;
		$mapString = '';
		foreach ($mapPool as $key=>$map)
		{
			if ($i > 0) $mapString .= ',';
			$mapString .= $map;
			$i++;
		}

		$this->setField('MapPool', $mapString);
	}
	
	function displayEventSettingsForm($create=false)
	{
		global $sql;
		global $pref;
		
		if (e_WYSIWYG)
		{
			$insertjs = "rows='15'";
		}
		else
		{
			require_once(e_HANDLER."ren_help.php");
			$insertjs = "rows='5' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
		}
		
		if($create==true)
		{
			$event_str='';
			$action_str='actionid=create';
		}
		else
		{
			$event_str='eventid='.$this->getField('EventID');
			$action_str='&amp;actionid=edit';
		}

		/* Nbr players */
		$q = "SELECT COUNT(*) as NbrPlayers"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$row = mysql_fetch_array($result);
		$nbrplayers = $row['NbrPlayers'];
		
		/* Nbr Teams */
		$q = "SELECT COUNT(*) as NbrTeams"
		." FROM ".TBL_TEAMS
		." WHERE (Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$row = mysql_fetch_array($result);
		$nbrteams = $row['NbrTeams'];
		
		$competition_type = $this->getCompetitionType();

		$text .= "
		<script type='text/javascript'>
		<!--//
		// Forms
		$(function() {
		$( '#radio2' ).buttonset();
		$('.timepicker').datetimepicker({
		ampm: true,
		timeFormat: 'hh:mm TT',
		stepHour: 1,
		stepMinute: 10,
		minDate: 0
		});
		});
		//-->
		</script>
		";

		$text .= '
		<script type="text/javascript">
		<!--//
		function clearStartDate(frm)
		{
		frm.startdate.value = ""
		}
		function clearEndDate(frm)
		{
		frm.enddate.value = ""
		}
		//-->
		</script>
		';

		$text .= "
		<script type='text/javascript'>
		<!--//
		function kick_player(v)
		{
		document.getElementById('kick_player').value=v;
		document.getElementById('playersform').submit();
		}
		function ban_player(v)
		{
		document.getElementById('ban_player').value=v;
		document.getElementById('playersform').submit();
		}
		function unban_player(v)
		{
		document.getElementById('unban_player').value=v;
		document.getElementById('playersform').submit();
		}
		function del_player_games(v)
		{
		document.getElementById('del_player_games').value=v;
		document.getElementById('playersform').submit();
		}
		function del_player_awards(v)
		{
		document.getElementById('del_player_awards').value=v;
		document.getElementById('playersform').submit();
		}
		function checkin_player(v)
		{
		document.getElementById('checkin_player').value=v;
		document.getElementById('playersform').submit();
		}
		function replace_player(v)
		{
		document.getElementById('replace_player').value=v;
		document.getElementById('playersform').submit();
		}		
		function kick_team(v)
		{
		document.getElementById('kick_team').value=v;
		document.getElementById('teamsform').submit();
		}
		function ban_team(v)
		{
		document.getElementById('ban_team').value=v;
		document.getElementById('teamsform').submit();
		}
		function unban_team(v)
		{
		document.getElementById('unban_team').value=v;
		document.getElementById('teamsform').submit();
		}
		function del_team_games(v)
		{
		document.getElementById('del_team_games').value=v;
		document.getElementById('teamsform').submit();
		}
		function del_team_awards(v)
		{
		document.getElementById('del_team_awards').value=v;
		document.getElementById('teamsform').submit();
		}
		function checkin_team(v)
		{
		document.getElementById('checkin_team').value=v;
		document.getElementById('teamsform').submit();
		}
		function replace_team(v)
		{
		document.getElementById('replace_team').value=v;
		document.getElementById('teamsform').submit();
		}		
		//-->
		</script>
		";

		$text .= '<form id="form-event-settings" action="'.e_PLUGIN.'ebattles/eventprocess.php?'.$event_str.$action_str.'" method="post">';
		$text .= '
		<table class="eb_table" style="width:95%">
		<tbody>
		';
		//<!-- Event Name -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L15.'<span class="required">*</span></td>
		<td class="eb_td">
		<div><input class="tbox required" type="text" size="40" name="eventname" value="'.$this->getField('Name').'"/></div>
		</td>
		</tr>
		';

		//<!-- Event Password -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L16.'</td>
		<td class="eb_td">
		<div><input class="tbox" type="text" size="40" name="eventpassword" value="'.$this->getField('password').'"/></div>
		</td>
		</tr>
		';
		//<!-- Event Game -->
		// Can change only if no players are signed up
		$disabled_str = ($nbrplayers+$nbrteams==0) ? '' : 'disabled="disabled"';

		$q = "SELECT ".TBL_GAMES.".*"
		." FROM ".TBL_GAMES
		." WHERE (GameID = '".$this->getField('Game')."')";
		$result = $sql->db_Query($q);
		$gIcon  = mysql_result($result,$i, TBL_GAMES.".Icon");

		$q = "SELECT ".TBL_GAMES.".*"
		." FROM ".TBL_GAMES
		." ORDER BY Name";
		$result = $sql->db_Query($q);
		/* Error occurred, return given name by default */
		$numGames = mysql_numrows($result);
		$text .= '<tr>';
		$text .= '<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L17.'</td>';
		$text .= '<td class="eb_td">';
		$text .= '<img '.getGameIconResize($gIcon).'/>&nbsp;';
		$text .= '<select class="tbox" name="eventgame" '.$disabled_str.'>';
		for($i=0; $i<$numGames; $i++){
			$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
			$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
			if ($this->getField('Game') == $gid)
			{
				$text .= '<option value="'.$gid.'" selected="selected">'.htmlspecialchars($gname).'</option>';
				$ematchtypes = explode(",", preg_replace('/\s+/', '', mysql_result($result,$i, TBL_GAMES.".MatchTypes")));
			}
			else
			{
				$text .= '<option value="'.$gid.'">'.htmlspecialchars($gname).'</option>';
			}
		}
		$text .= '</select>';
		$text .= '</td></tr>';

		//<!-- Type -->
		$disabled_str = ($create==true) ? '' : 'disabled="disabled"';
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L18.'</td>
		<td class="eb_td"><select class="tbox" name="eventtype" '.$disabled_str.'>';
		$text .= '<option value="One Player Ladder" '.($this->getField('Type') == "One Player Ladder" ? 'selected="selected"' : '').'>'.EB_EVENTS_L22.'</option>';
		$text .= '<option value="Team Ladder" '.($this->getField('Type') == "Team Ladder" ? 'selected="selected"' : '').'>'.EB_EVENTS_L23.'</option>';
		$text .= '<option value="Clan Ladder" '.($this->getField('Type') == "Clan Ladder" ? 'selected="selected"' : '').'>'.EB_EVENTS_L25.'</option>';
		$text .= '<option value="One Player Tournament" '.($this->getField('Type') == "One Player Tournament" ? 'selected="selected"' : '').'>'.EB_EVENTS_L33.'</option>';
		$text .= '<option value="Clan Tournament" '.($this->getField('Type') == "Clan Tournament" ? 'selected="selected"' : '').'>'.EB_EVENTS_L35.'</option>';
		$text .= '</select>
		</td>
		</tr>
		';

		if ($create==false)
		{
			//<!-- Match Type -->
			// Can change only if no players are signed up
			$disabled_str = ($nbrplayers+$nbrteams==0) ? '' : 'disabled="disabled"';
			$text .= '
			<tr>
			<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L132.'</td>
			<td class="eb_td">
			<div>
			';
			$text .= '<select class="tbox" name="eventmatchtype" '.$disabled_str.'>';
			$text .= '<option value="" '.($this->getField('MatchType') == "" ? 'selected="selected"' : '') .'>-</option>';
			foreach($ematchtypes as $matchtype)
			{
				if ($matchtype!='') {
					$text .= '<option value="'.$matchtype.'" '.(($this->getField('MatchType') == $matchtype) ? 'selected="selected"' : '') .'>'.$matchtype.'</option>';
				}
			}
			$text .= '</select>
			</div>
			</td>
			</tr>';
		}

		if ($create==false)
		{
			//<!-- Rating Type -->
			switch($competition_type)
			{
			case "Ladder":
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40" title="'.EB_EVENTM_L118.'">'.EB_EVENTM_L117.'</td>
				<td class="eb_td">
				<div id="radio2">
				';
				$text .= '<input class="tbox" type="radio" id="radio21" size="40" name="eventrankingtype" '.($this->getField('RankingType') == "Classic" ? 'checked="checked"' : '').' value="Classic" /><label for="radio21">'.EB_EVENTM_L119.'</label>';
				$text .= '<input class="tbox" type="radio" id="radio22" size="40" name="eventrankingtype" '.($this->getField('RankingType') == "CombinedStats" ? 'checked="checked"' : '').' value="CombinedStats" /><label for="radio22">'.EB_EVENTM_L120.'</label>';
				$text .= '
				</div>
				</td>
				</tr>
				';
				break;
			}
		}

		//<!-- Match report userclass -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L21.'</td>
		<td class="eb_td"><select class="tbox" name="eventmatchreportuserclass">';
		$text .= '<option value="'.eb_UC_MATCH_WINNER.'" '.($this->getField('match_report_userclass') == eb_UC_MATCH_WINNER ? 'selected="selected"' : '') .'>'.EB_EVENTM_L211.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_PLAYER.'" '.($this->getField('match_report_userclass') == eb_UC_EVENT_PLAYER ? 'selected="selected"' : '') .'>'.EB_EVENTM_L22.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_MODERATOR.'" '.($this->getField('match_report_userclass') == eb_UC_EVENT_MODERATOR ? 'selected="selected"' : '') .'>'.EB_EVENTM_L23.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_OWNER.'" '.($this->getField('match_report_userclass') == eb_UC_EVENT_OWNER ? 'selected="selected"' : '') .'>'.EB_EVENTM_L24.'</option>';
		$text .= '</select>
		</td>
		</tr>
		';

		//<!-- Match replay report userclass -->
		/*
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L134.'</td>
		<td class="eb_td"><select class="tbox" name="eventmatchreplayreportuserclass">';
		$text .= '<option value="'.eb_UC_EVENT_PLAYER.'" '.($this->getField('match_replay_report_userclass') == eb_UC_EVENT_PLAYER ? 'selected="selected"' : '') .'>'.EB_EVENTM_L22.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_MODERATOR.'" '.($this->getField('match_replay_report_userclass') == eb_UC_EVENT_MODERATOR ? 'selected="selected"' : '') .'>'.EB_EVENTM_L23.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_OWNER.'" '.($this->getField('match_replay_report_userclass') == eb_UC_EVENT_OWNER ? 'selected="selected"' : '') .'>'.EB_EVENTM_L24.'</option>';
		$text .= '</select>
		</td>
		</tr>
		';
		*/

		if ($create==false)
		{
			//<!-- Allow Quick Loss Report -->
			switch($competition_type)
			{
			case "Ladder":
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L25.'</td>
				<td class="eb_td">
				<div>
				';
				$text .= '<input class="tbox" type="checkbox" name="eventallowquickloss"';
				if ($this->getField('quick_loss_report') == true)
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
				break;
			}
		}
		//<!-- Allow Score -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L26.'</td>
		<td class="eb_td">
		<div>
		';
		$text .= '<input class="tbox" type="checkbox" name="eventallowscore"';
		if ($this->getField('AllowScore') == true)
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
		</tr>';

		//<!-- Match Approval -->
		$q = "SELECT COUNT(DISTINCT ".TBL_MATCHS.".MatchID) as NbrMatches"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES
		." WHERE (".TBL_MATCHS.".Event = '".$this->getField('EventID')."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_MATCHS.".Status = 'pending')";
		$result = $sql->db_Query($q);
		$row = mysql_fetch_array($result);
		$nbrMatchesPending = $row['NbrMatches'];


		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40" title="'.EB_EVENTM_L109.'">'.EB_EVENTM_L108.'</td>
		<td class="eb_td">
		<div>';
		$text .= '<select class="tbox" name="eventmatchapprovaluserclass">';
		$text .= '<option value="'.eb_UC_NONE.'" '.(($this->getField('MatchesApproval') == eb_UC_NONE) ? 'selected="selected"' : '') .'>'.EB_EVENTM_L113.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_PLAYER.'" '.((($this->getField('MatchesApproval') & eb_UC_EVENT_PLAYER)!=0) ? 'selected="selected"' : '') .'>'.EB_EVENTM_L112.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_MODERATOR.'" '.((($this->getField('MatchesApproval') & eb_UC_EVENT_MODERATOR)!=0) ? 'selected="selected"' : '') .'>'.EB_EVENTM_L111.'</option>';
		$text .= '<option value="'.eb_UC_EVENT_OWNER.'" '.((($this->getField('MatchesApproval') & eb_UC_EVENT_OWNER)!=0) ? 'selected="selected"' : '') .'>'.EB_EVENTM_L110.'</option>';
		$text .= '</select>';
		$text .= ($nbrMatchesPending>0) ? '<div><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/exclamation.png" alt="'.EB_MATCH_L13.'" title="'.EB_MATCH_L13.'"/>&nbsp;'.$nbrMatchesPending.'&nbsp;'.EB_EVENT_L64.'</div>' : '';
		$text .= '
		</div>
		</td>
		</tr>
		';

		if ($create==false)
		{
			//<!-- Allow Draws -->
			switch($competition_type)
			{
			case "Ladder":
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L27.'</td>
				<td class="eb_td">
				<div>';
				$text .= '<input class="tbox" type="checkbox" name="eventallowdraw"';
				if ($this->getField('AllowDraw') == true)
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

				//<!-- Points -->
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L28.'</td>
				<td class="eb_td">
				<table class="table_left">
				<tr>
				<td>'.EB_EVENTM_L29.'</td>
				<td>'.EB_EVENTM_L30.'</td>
				<td>'.EB_EVENTM_L31.'</td>
				</tr>
				<tr>
				<td>
				<div><input class="tbox" type="text" name="eventpointsperwin" value="'.$this->getField('PointsPerWin').'"/></div>
				</td>
				<td>
				<div><input class="tbox" type="text" name="eventpointsperdraw" value="'.$this->getField('PointsPerDraw').'"/></div>
				</td>
				<td>
				<div><input class="tbox" type="text" name="eventpointsperloss" value="'.$this->getField('PointsPerLoss').'"/></div>
				</td>
				</tr>
				</table>
				</td>
				</tr>
				';
				break;
			}
		}
		if ($create==false)
		{
			//<!-- Allow Forfeits -->
			$text .= '
			<tr>
			<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L127.'</td>
			<td class="eb_td">
			<div>';
			$text .= '<input class="tbox" type="checkbox" name="eventallowforfeit"';
			if ($this->getField('AllowForfeit') == true)
			{
				$text .= ' checked="checked"/>';
			}
			else
			{
				$text .= '/>';
			}
			$text .= '&nbsp;'.EB_EVENTM_L128;
			$text .= '</div>';
			switch($competition_type)
			{
			case "Ladder":
				$text .= '<div>';
				$text .= '<input class="tbox" type="checkbox" name="eventForfeitWinLossUpdate"';
				if ($this->getField('ForfeitWinLossUpdate') == true)
				{
					$text .= ' checked="checked"/>';
				}
				else
				{
					$text .= '/>';
				}
				$text .= EB_EVENTM_L129;
				$text .= '</div>';
				$text .= '
				<div>
				<table class="table_left">
				<tr>
				<td>'.EB_EVENTM_L130.'</td>
				<td>'.EB_EVENTM_L131.'</td>
				</tr>
				<tr>
				<td>
				<div><input class="tbox" type="text" name="eventforfeitwinpoints" value="'.$this->getField('ForfeitWinPoints').'"/></div>
				</td>
				<td>
				<div><input class="tbox" type="text" name="eventforfeitlosspoints" value="'.$this->getField('ForfeitLossPoints').'"/></div>
				</td>
				</tr>
				</table>
				</div>
				';
				break;
			}
			$text .= '
			</td>
			</tr>
			';

			//<!-- Maps -->
			$text .= '
			<tr>
			<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L125.'</td>
			<td class="eb_td">
			<div>
			';
			$text .= '<input class="tbox" type="text" name="eventmaxmapspermatch" size="2" value="'.$this->getField('MaxMapsPerMatch').'"/>';
			$text .= '
			</div>
			</td>
			</tr>
			';

			//<!-- Gold -->
			if(is_gold_system_active() && (check_class($pref['eb_gold_userclass'])))
			{
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L175.'</td>
				<td class="eb_td">
				<div>
				';
				$text .= '<input class="tbox" type="text" name="event_gold_entry_fee" size="4" value="'.$this->getField('GoldEntryFee').'"/>';
				$text .= '
				</div>
				</td>
				</tr>
				';
				$text .= '
				<tr>
				<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L176.'</td>
				<td class="eb_td">
				<div>
				';
				$text .= '<input class="tbox" type="text" name="event_gold_winning_event" size="4" value="'.$this->getField('GoldWinningEvent').'"/>';
				$text .= '
				</div>
				</td>
				</tr>
				';
			}
		}

		//<!-- Start Date -->
		if($this->getField('StartDateTime')!=0)
		{
			$startdatetime_local = $this->getField('StartDateTime') + TIMEOFFSET;
			$date_start = date("m/d/Y h:i A", $startdatetime_local);
		}
		else
		{
			$date_start = "";
		}

		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L32.'<span class="required">*</span></td>
		<td class="eb_td">
		<table class="table_left">
		<tr>
		<td>
		<div><input class="eb_button" type="button" value="'.EB_EVENTM_L34.'" onclick="clearStartDate(this.form);"/></div>
		</td>
		<td>
		<div><input class="tbox timepicker required" type="text" name="startdate" id="f_date_start" value="'.$date_start.'" readonly="readonly" /></div>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		';

		//<!-- End Date -->
		if($this->getField('EndDateTime')!=0)
		{
			$enddatetime_local = $this->getField('EndDateTime') + TIMEOFFSET;
			$date_end = date("m/d/Y h:i A", $enddatetime_local);
		}
		else
		{
			$date_end = "";
		}
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L35.'</td>
		<td class="eb_td">
		<table class="table_left">
		<tr>
		<td>
		<div><input class="eb_button" type="button" value="'.EB_EVENTM_L34.'" onclick="clearEndDate(this.form);"/></div>
		</td>
		<td>
		<div><input class="tbox timepicker" type="text" name="enddate" id="f_date_end"  value="'.$date_end.'" readonly="readonly" /></div>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		';

		//<!-- Checkin Duration -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L169.'</td>
		<td class="eb_td">
		<div>
		';
		$text .= '<input class="tbox" type="text" name="checkin_duration" size="5" value="'.$this->getField('CheckinDuration').'"/>';
		$text .= '
		</div>
		</td>
		</tr>
		';

		//<!-- Signups Enable -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L177.'</td>
		<td class="eb_td">
		<div>
		';
		$text .= '<input class="tbox" type="checkbox" name="eventsignupsenable"';
		if ($this->getField('SignupsEnable') == true)
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
		</tr>';		

		//<!-- Allow Late Signups -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L178.'</td>
		<td class="eb_td">
		<div>
		';
		$text .= '<input class="tbox" type="checkbox" name="eventallowlatesignups"';
		if ($this->getField('AllowLateSignups') == true)
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
		</tr>';
		
		if ($create==false)
		{
			switch($competition_type)
			{
			case "Tournament":
				//<!-- Map Pool -->
				if ($this->getID() != 0)
				{
					$mapPool = explode(",", $this->getField('MapPool'));
					$nbrMapsInPool = count($mapPool);

					$text .= '
					<tr>
					<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L147.'</td>
					<td class="eb_td">';
					$text .= '<table class="table_left">';
					foreach($mapPool as $key=>$map)
					{
						if ($map!='')
						{
							$mapID = $map;
							$q_Maps = "SELECT ".TBL_MAPS.".*"
							." FROM ".TBL_MAPS
							." WHERE (".TBL_MAPS.".MapID = '$mapID')";
							$result_Maps = $sql->db_Query($q_Maps);
							$mapName  = mysql_result($result_Maps,0, TBL_MAPS.".Name");
							$text .= '<tr>';
							$text .= '<td>'.$mapName.'</td>';
							$text .= '<td>';
							$text .= '<div>';
							$text .= ebImageTextButton('eventdeletemap', 'delete.png', EB_EVENTM_L150, 'negative jq-button', '', '', 'value="'.$key.'"');
							$text .= '</div>';
							$text .= '</td>';
							$text .= '</tr>';
						} else {
							$text .= '<tr>';
							$text .= '<td><div>';
							$text .= EB_EVENTM_L148;
							$text .= '</div></td>';
							$text .= '</tr>';
						}
					}
					$text .= '</table>';

					// List of all Maps
					$q_Maps = "SELECT ".TBL_MAPS.".*"
					." FROM ".TBL_MAPS
					." WHERE (".TBL_MAPS.".Game = '".$this->getField('Game')."')";
					$result_Maps = $sql->db_Query($q_Maps);
					$numMaps = mysql_numrows($result_Maps);
					if ($numMaps > $nbrMapsInPool)
					{
						$text .= '
						<table class="table_left">
						<tr>';
						$text .= '<td><select class="tbox" name="map">';
						for($map=0;$map < $numMaps;$map++)
						{
							$mID = mysql_result($result_Maps,$map , TBL_MAPS.".MapID");
							$mImage = mysql_result($result_Maps,$map , TBL_MAPS.".Image");
							$mName = mysql_result($result_Maps,$map , TBL_MAPS.".Name");
							$mDescrition = mysql_result($result_Maps,$map , TBL_MAPS.".Description");

							$isMapInMapPool = false;
							foreach($mapPool as $poolmap)
							{
								if ($mID==$poolmap) {
									$isMapInMapPool = true;
								}
							}

							if($isMapInMapPool == false) {
								$text .= '<option value="'.$mID.'"';
								$text .= '>'.$mName.'</option>';
							}
						}
						$text .= '</select></td>';

						$text .= '
						<td>
						<div>
						'.ebImageTextButton('eventaddmap', 'add.png', EB_EVENTM_L149).'
						</div>
						</td>
						</tr>
						</table>
						';
					}
					$text .= '</td></tr>';
				}
				break;
			}
		}
		//<!-- Description -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L36.'</td>
		<td class="eb_td">
		';
		$text .= '<textarea class="tbox" id="eventdescription" name="eventdescription" cols="70" '.$insertjs.'>'.$this->getField('Description').'</textarea>';
		if (!e_WYSIWYG)
		{
			$text .= '<br />'.display_help("helpb",1);
		}
		$text .= '
		</td>
		</tr>';

		//<!-- Rules -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_EVENTM_L38.'</td>
		<td class="eb_td">
		';
		$text .= '<textarea class="tbox" id="eventrules" name="eventrules" cols="70" '.$insertjs.'>'.$this->getField('Rules').'</textarea>';
		if (!e_WYSIWYG)
		{
			$text .= '<br />'.display_help("helpb",1);
		}
		$text .= '
		</td>
		</tr>
		</tbody>
		</table>
		';

		//<!-- Save Button -->
		$text .= '
		<table><tbody><tr><td>
		<div>
		'.ebImageTextButton('eventsettingssave', 'disk.png', EB_EVENTM_L37).'
		</div>
		</td></tr></tbody></table>
		</form>';

		return $text;
	}

	function initStats()
	{
		global $sql;

		$last_id = $this->id;
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'ELO')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName, CategoryMaxValue)
		VALUES ('$last_id', 'Skill', 4)";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'Glicko2')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName, CategoryMaxValue, InfoOnly)
		VALUES ('$last_id', 'GamesPlayed', 1, 1)";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName, CategoryMaxValue)
		VALUES ('$last_id', 'VictoryRatio', 3)";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'WinDrawLoss')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'VictoryPercent')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'UniqueOpponents')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'OpponentsELO')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName, CategoryMaxValue, InfoOnly)
		VALUES ('$last_id', 'Streaks', 2, 1)";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'Score')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'ScoreAgainst')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'ScoreDiff')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'Points')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'Forfeits')";
		$result = $sql->db_Query($q);
		$q =
		"INSERT INTO ".TBL_STATSCATEGORIES."(Event, CategoryName)
		VALUES ('$last_id', 'ForfeitsPercent')";
		$result = $sql->db_Query($q);
	}

	/*
	function brackets()
	inputs:
	- format: 'Single elimination', ...
	- maxNbrPlayers: max number of players
	- teams[player]
	 . Name
	 . PlayerID
	- results[round][matchup]
	 . winner: not played/top/bottom
	 . bye: true/false
	 . topWins
	 . bottomWins
	 . matchs[match]
	  . winner: not played/top/bottom
	  . match_id
	- rounds[round]
	 . Title
	 . BestOf

	variables:
	- $matchup[round][matchup][0(top)-1(bottom)] unserialized from file
	. '': empty
	. 'T1-16': team index
	. 'Wr,m': winner of matchup r/m
	. 'Lr,m': loser of matchup r/m
	. 'Pr,m': loser of matchup r/m if necessary
	- brackets[row][column] -> actual html content of a table cell
	- content[round][matchup][0(top)-1(bottom)]: content of the top/bottom cells for a matchup
	. same as $matchup
	. 'E': empty
	. 'N': not needed
	*/
	function brackets($scheduleNextMatches = false, $delete_match_id = 0, $style='') {
		global $sql;
		global $time;
		global $pref;
		global $tp;
		global $gold_obj;

		$this->updateFields();

		$type = $this->fields['Type'];
		$competition_type = $this->getCompetitionType();
		
		$format = $this->fields['Format'];
		$event_id = $this->fields['EventID'];
		$teams = $this->getTeams();
		
		//var_dump($teams);
		
		$results = unserialize($this->getFieldHTML('Results'));
		$update_results = false;
		
		// TODO: check for error (return false)
		$rounds = unserialize($this->getFieldHTML('Rounds'));

		$matchups = $this->getMatchups();
		$nbrRounds = count($matchups);
		$nbrRows = 4*count($matchups[1]);

		/* */
		$brackets = array();
		$content= array();
		// Initialize grid
		for ($row = 1; $row <= $nbrRows; $row ++){
			for ($column = 1; $column <= $nbrRounds; $column++){
				$brackets[$row][2*$column-1] = '<td class="grid empty"></td>';
				$brackets[$row][2*$column] = '<td class="grid border-none"></td>';
			}
		}
		
		$rowspan = 1;
		for ($round = 1; $round <= $nbrRounds; $round++){
			$nbrMatchups = count($matchups[$round]);
			$rounds[$round]['nbrMatchups'] = 0;

			if ($round < $nbrRounds)	// all but last
			{
				for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
					if (!isset($results[$round][$matchup]['matchs']))
					{
						$results[$round][$matchup]['winner'] = 'not played';
						$results[$round][$matchup]['bye'] = false;
					}
					if (!isset($results[$round][$matchup]['winner'])) $results[$round][$matchup]['winner'] = 'not played';
					if (!isset($results[$round][$matchup]['bye'])) $results[$round][$matchup]['bye'] = false;
					if (!isset($matchups[$round][$matchup]['deleted'])) $matchups[$round][$matchup]['deleted'] = false;
					
					/* Nbr of matches in the matchup */
					$nbr_matchs = count($results[$round][$matchup]['matchs']);

					$matchup_deleted = false;
					for($match = 0; $match < 2; $match++){
						$matchupString = $matchups[$round][$matchup][$match];
						$content[$round][$matchup][$match] = ($matchupString == '') ? 'E' : $matchupString;
						if ($matchupString == '')
						{
							$row = findRow($round, $matchup, $match, $style);
							$matchupsRows[$round][$matchup][$match] = $row;
						} else
						{
							if ($matchupString[0]=='T') {
								$row = findRow($round, $matchup, $match, $style);
								$matchupsRows[$round][$matchup][$match] = $row;
								$team = substr($matchupString,1);
								if (empty($teams[$team-1])) {
									$content[$round][$matchup][$match] = 'E';
								}
							}
							if ($matchupString[0]=='W') {
								$matchupArray = explode(',',substr($matchupString,1));
								$matchupRound = $matchupArray[0];
								$matchupMatchup = $matchupArray[1];

								// Get result of matchup
								$winner = $results[$matchupRound][$matchupMatchup]['winner'];
								$bye = $results[$matchupRound][$matchupMatchup]['bye'];
								$deleted = $matchups[$matchupRound][$matchupMatchup]['deleted'];

								$rowTop    = $matchupsRows[$matchupRound][$matchupMatchup][0];
								$rowBottom = $matchupsRows[$matchupRound][$matchupMatchup][1];
								$row = ($rowBottom - $rowTop)/2 + $rowTop;

								// If result is not a bye, we draw the grid
								if($bye != true){
									$brackets[$rowTop][2*$round-2] = '<td class="grid border-top"></td>';
									$brackets[$rowBottom][2*$round-2] = '<td class="grid border-bottom"></td>';
									for ($i = $rowTop+1; $i < $rowBottom; $i++){
										$brackets[$i][2*$round-2] = '<td class="grid border-vertical"></td>';
									}
									for ($i = $rowTop+2; $i < $rowBottom; $i++){
										$brackets[$i][2*$round-3] = '';
									}
									$brackets[$row][2*$round-2] = '<td class="grid border-middle"></td>';
								}
								
								$matchupsRows[$round][$matchup][$match] = $row;
								if ($winner == 'top') {
									$content[$round][$matchup][$match] = $content[$matchupRound][$matchupMatchup][0];
								}
								else if ($winner == 'bottom') {
									$content[$round][$matchup][$match] = $content[$matchupRound][$matchupMatchup][1];
								} else {
									// Not played
									// Detect if match has been previously scheduled and needs to be deleted
									if($nbr_matchs > 0)
									{
										$deleted = true;
									}
								}

								if($deleted == true){
									$matchup_deleted = true;
								}
							}
							if (($matchupString[0]=='L')||($matchupString[0]=='P')) {
								$matchupArray = explode(',',substr($matchupString,1));
								$matchupRound = $matchupArray[0];
								$matchupMatchup = $matchupArray[1];

								// Get result of matchup
								$winner = $results[$matchupRound][$matchupMatchup]['winner'];
								$bye = $results[$matchupRound][$matchupMatchup]['bye'];
								$deleted = $matchups[$matchupRound][$matchupMatchup]['deleted'];

								$row = findRow($round, $matchup, $match, $style);

								$matchupsRows[$round][$matchup][$match] = $row;
								if ($winner == 'top') {
									$loser = $content[$matchupRound][$matchupMatchup][1];
									if ($loser[0] == 'T')
									{
										$team = substr($loser,1);
										//echo "M$round,$matchup: L2: $team,".$teams[$team-1]['loss'].'<br>';
										if ($teams[$team-1]['loss'] > 1)
										{
											$content[$round][$matchup][$match] = 'N';
										}
										else
										{
											$content[$round][$matchup][$match] = $loser;
										}
									}
									else
									{
										$content[$round][$matchup][$match] = 'E';
									}
								}
								else if ($winner == 'bottom') {
									$loser = $content[$matchupRound][$matchupMatchup][0];
									if ($loser[0] == 'T')
									{
										$team = substr($loser,1);
										//echo "M$round,$matchup: L2: $team,".$teams[$team-1]['loss'].'<br>';
										if ($teams[$team-1]['loss'] > 1)
										{
											$content[$round][$matchup][$match] = 'N';
										}
										else
										{
											$content[$round][$matchup][$match] = $loser;
										}
									}
									else
									{
										$content[$round][$matchup][$match] = 'E';
									}
								}
								else {
									// Not played
									// Detect if match has been previously scheduled and needs to be deleted
									if($nbr_matchs > 0)
									{
										$deleted = true;
									}
								}

								if($deleted == true){
									$matchup_deleted = true;
								}
							}
						}

						switch ($content[$round][$matchup][$match])
						{
						case 'E':
							$results[$round][$matchup]['winner'] = ($match==0) ? 'bottom' : 'top';
							$results[$round][$matchup]['bye'] = true;
							break;
						case 'N':
							$results[$round][$matchup]['winner'] = ($match==0) ? 'bottom' : 'top';
							break;
						case 'F':
							$results[$round][$matchup]['winner'] = ($match==0) ? 'bottom' : 'top';
							break;
						}
					}	// for(match)
					
					/* Match deletion*/
					if($nbr_matchs > 0)
					{
						$match_deleted = false;
						for($match = 0;$match < $nbr_matchs; $match++)
						{
							if(($results[$round][$matchup]['matchs'][$match]['match_id'] == $delete_match_id)
									||($match_deleted == true)
									||($matchup_deleted == true))
							{
								/*
								var_dump($results[$round][$matchup]);
								var_dump($delete_match_id);
								var_dump($match_deleted);
								var_dump($matchup_deleted);
								*/
								$update_results = true;
								
								$current_match_id = $results[$round][$matchup]['matchs'][$match]['match_id'];
								echo "match ".$current_match_id." deleted (M$round,$matchup,$match)<br>";

								$current_match = new Match($current_match_id);
								$current_match->deleteMatchScores();
								
								$results[$round][$matchup]['winner'] = 'not played';
								$results[$round][$matchup]['topWins'] = 0;
								$results[$round][$matchup]['bottomWins'] = 0;
								$results[$round][$matchup]['winner'] = 'not played';
								unset($results[$round][$matchup]['matchs'][$match]);
								
								$match_deleted = true;
							
								if(($this->getField('Status')=='finished')&&($competition_type == 'Tournament'))
								{
									// if tournament was finished, we need to remove awards
									$this->setFieldDB('Status', 'active');
								
									// Find who got the award for winning the tournament
									switch($type)
									{
									case "One Player Tournament":
										$q = "SELECT ".TBL_PLAYERS.".*, "
										.TBL_GAMERS.".*, "
										.TBL_EVENTS.".*, "
										.TBL_AWARDS.".*"
										." FROM ".TBL_PLAYERS.", "
										.TBL_GAMERS.", "
										.TBL_EVENTS.", "
										.TBL_AWARDS
										." WHERE (".TBL_PLAYERS.".PlayerID = ".TBL_AWARDS.".Player)"
										."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
										."   AND (".TBL_PLAYERS.".Event = '$event_id')"
										."   AND (".TBL_AWARDS.".Type = 'PlayerWonTournament')";
										$result = $sql->db_Query($q);
										$pid = mysql_result($result, 0 , TBL_PLAYERS.".PlayerID");
										$uid = mysql_result($result, 0 , TBL_GAMERS.".User");
										$aid = mysql_result($result, 0 , TBL_AWARDS.".AwardID");
										
										$q = "DELETE FROM ".TBL_AWARDS
										." WHERE (".TBL_AWARDS.".AwardID = '$aid')";
										$result = $sql->db_Query($q);
										
										// gold
										if(is_gold_system_active() && ($this->getField('GoldWinningEvent')>0)) {												
											$gold_param['gold_user_id'] = $uid;
											$gold_param['gold_who_id'] = 0;
											$gold_param['gold_amount'] = $this->getField('GoldWinningEvent');
											$gold_param['gold_type'] = EB_L1;
											$gold_param['gold_action'] = "debit";
											$gold_param['gold_plugin'] = "ebattles";
											$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
											$gold_param['gold_forum'] = 0;
											$gold_obj->gold_modify($gold_param);
										}
										break;
									case "Clan Tournament":
										$q = "SELECT ".TBL_TEAMS.".*, "
										.TBL_DIVISIONS.".*, "
										.TBL_EVENTS.".*, "
										.TBL_AWARDS.".*"
										." FROM ".TBL_TEAMS.", "
										.TBL_DIVISIONS.", "
										.TBL_EVENTS.", "
										.TBL_AWARDS
										." WHERE (".TBL_TEAMS.".TeamID = ".TBL_AWARDS.".Team)"
										."   AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
										."   AND (".TBL_TEAMS.".Event = '$event_id')"
										."   AND (".TBL_AWARDS.".Type = 'TeamWonTournament')";
										$result = $sql->db_Query($q);
										$pid = mysql_result($result, 0 , TBL_TEAMS.".TeamID");
										$uid = mysql_result($result, 0 , TBL_DIVISIONS.".Captain");
										$aid = mysql_result($result, 0 , TBL_AWARDS.".AwardID");
										
										$q = "DELETE FROM ".TBL_AWARDS
										." WHERE (".TBL_AWARDS.".AwardID = '$aid')";
										$result = $sql->db_Query($q);

										// gold
										if(is_gold_system_active() && ($this->getField('GoldWinningEvent')>0)) {
											$gold_param['gold_user_id'] = $uid;
											$gold_param['gold_who_id'] = 0;
											$gold_param['gold_amount'] = $this->getField('GoldWinningEvent');
											$gold_param['gold_type'] = EB_L1;
											$gold_param['gold_action'] = "debit";
											$gold_param['gold_plugin'] = "ebattles";
											$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
											$gold_param['gold_forum'] = 0;
											$gold_obj->gold_modify($gold_param);
										}
										break;
									default:
									}								
								}	// remove awards
							}	// delete
						}	// for(match)
					}	// if(nbr_matchs>0)
					
					if ($match_deleted==true)
					{
						$matchups[$round][$matchup]['deleted'] = true;
						$nbr_matchs = count($results[$round][$matchup]['matchs']);
					}
					
					// If we try to replace an empty spot by a player, we need to reset the byes
					if(($content[$round][$matchup][0][0]=='T')
					 &&($content[$round][$matchup][1][0]=='T')
					 &&($results[$round][$matchup]['bye'] == true)) {
						$results[$round][$matchup]['winner'] = 'not played';
						$results[$round][$matchup]['bye'] = false;
					}

					/* Update results */
					if(($scheduleNextMatches == true)
							&&($content[$round][$matchup][0][0]=='T')
							&&($content[$round][$matchup][1][0]=='T')
							&&($results[$round][$matchup]['winner'] == 'not played')) {
						// Matchup not finished yet
						/* Calculate:
						$results[$round][$matchup]['topWins']
						$results[$round][$matchup]['bottomWins']
						$results[$round][$matchup]['matchs'][$match]['winner']
						$results[$round][$matchup]['winner']
						*/
						$update_results = true;

						$results[$round][$matchup]['topWins'] = 0;
						$results[$round][$matchup]['bottomWins'] = 0;
						if ($nbr_matchs > 0)
						{
							for($match = 0; $match < $nbr_matchs; $match++)
							{
								$current_match_id =  $results[$round][$matchup]['matchs'][$match]['match_id'];
								$current_match_winner =  $results[$round][$matchup]['matchs'][$match]['winner'];
								
								if ($current_match_winner == 'not played')
								{
									$current_match = new Match($current_match_id);
									if ($current_match->getField('Status') == 'active')
									{
										// The match has been reported
										// Need to check who won.
										// Get the scores for this match
										switch($this->getMatchPlayersType())
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
											." WHERE (".TBL_MATCHS.".MatchID = '$current_match_id')"
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
											." WHERE (".TBL_MATCHS.".MatchID = '$current_match_id')"
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
										
										if ($numScores>0)
										{
											for($i = 0; $i<$numScores; $i++) {
											
												switch($this->getMatchPlayersType())
												{
												case 'Players':
													$pid  = mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
													break;
												case 'Teams':
													$pid  = mysql_result($result,$i, TBL_TEAMS.".TeamID");
													break;
												default:
												}
												$pscoreid  = mysql_result($result,$i, TBL_SCORES.".ScoreID");
												$prank  = mysql_result($result,$i, TBL_SCORES.".Player_Rank");
												$pscore  = mysql_result($result,$i, TBL_SCORES.".Player_Score");
												$pMatchTeam  = mysql_result($result,$i, TBL_SCORES.".Player_MatchTeam");
												
												$teamTop    = substr($content[$round][$matchup][0],1);
												$teamBottom = substr($content[$round][$matchup][1],1);
												
												$results[$round][$matchup]['matchs'][$match]['scores'][$i] = $pscore;
												
												if($i==0)
												{
													$teamTopID = $teams[$teamTop-1]['PlayerID'];
													$teamBottomID = $teams[$teamBottom-1]['PlayerID'];

													if ($teamTopID == $pid)
													{
														$current_match_winner = 'top';
													}
													else
													{
														$current_match_winner = 'bottom';
													}
													$results[$round][$matchup]['matchs'][$match]['winner'] = $current_match_winner;
												}
											}
										}
									}										
								}	// match not played
								
								$matchupWinnerID = 0;
								if($current_match_winner == 'top')
								{
									$results[$round][$matchup]['topWins'] += 1;
									if ($results[$round][$matchup]['topWins'] == ($rounds[$round]['BestOf'] + 1)/2)
									{
										$results[$round][$matchup]['winner'] = 'top';
										$matchupWinnerID = $teamTopID;
										//echo "Match $matchs, top won<br>";
									}
								}	// winner==top
								if($current_match_winner == 'bottom')
								{
									$results[$round][$matchup]['bottomWins'] += 1;
									if ($results[$round][$matchup]['bottomWins'] == ($rounds[$round]['BestOf'] + 1)/2)
									{
										$results[$round][$matchup]['winner'] = 'bottom';
										$matchupWinnerID= $teamBottomID;
										//echo "Match $matchs, bottom won<br>";
									}
								}	// winner==bottom
								
								if($matchupWinnerID != 0) {
									if(($round == $nbrRounds-1)&&($competition_type == 'Tournament'))
									{
										// player has won the tournament
										$this->setFieldDB('Status', 'finished');

										// Award: player wins tournament
										switch($type)
										{
										case "One Player Tournament":
											$q_Award = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
											VALUES ($matchupWinnerID,'PlayerWonTournament',$time)";
											$result_Award = $sql->db_Query($q_Award);

											// gold
											if(is_gold_system_active() && ($this->getField('GoldWinningEvent')>0)) {												
												// find player's user_id
												$q = "SELECT ".TBL_PLAYERS.".*, "
												.TBL_GAMERS.".*"
												." FROM ".TBL_PLAYERS.", "
												.TBL_GAMERS
												." WHERE (".TBL_PLAYERS.".PlayerID = '$matchupWinnerID')"
												."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)";
												$result = $sql->db_Query($q);
												$uid = mysql_result($result, 0 , TBL_GAMERS.".User");

												$gold_param['gold_user_id'] = $uid;
												$gold_param['gold_who_id'] = 0;
												$gold_param['gold_amount'] = $this->getField('GoldWinningEvent');
												$gold_param['gold_type'] = EB_L1;
												$gold_param['gold_action'] = "credit";
												$gold_param['gold_plugin'] = "ebattles";
												$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
												$gold_param['gold_forum'] = 0;
												$gold_obj->gold_modify($gold_param);
											}
											break;
										case "Clan Tournament":
											$q_Award = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
											VALUES ($matchupWinnerID,'TeamWonTournament',$time)";
											$result_Award = $sql->db_Query($q_Award);

											// gold
											if(is_gold_system_active() && ($this->getField('GoldWinningEvent')>0)) {
												// find team captain
												$q = "SELECT ".TBL_TEAMS.".*, "
												.TBL_DIVISIONS.".*"
												." FROM ".TBL_TEAMS.", "
												.TBL_DIVISIONS
												." WHERE (".TBL_TEAMS.".TeamID = '$matchupWinnerID')"
												."   AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)";
												$result = $sql->db_Query($q);
												$uid = mysql_result($result, 0 , TBL_DIVISIONS.".Captain");

												$gold_param['gold_user_id'] = $uid;
												$gold_param['gold_who_id'] = 0;
												$gold_param['gold_amount'] = $this->getField('GoldWinningEvent');
												$gold_param['gold_type'] = EB_L1;
												$gold_param['gold_action'] = "credit";
												$gold_param['gold_plugin'] = "ebattles";
												$gold_param['gold_log'] = EB_GOLD_L8.": event=".$event_id.", user=".$uid;
												$gold_param['gold_forum'] = 0;
												$gold_obj->gold_modify($gold_param);
											}
											break;
										default:
										}
									}	// last round
								}	// if(matchupWinner!=0)
							}	// for(match)
						}	// if(nbr_matchs>0)
					}	// update results

					$topWins = $results[$round][$matchup]['topWins'];
					$bottomWins = $results[$round][$matchup]['bottomWins'];
					if($topWins > $bottomWins)
					{
						$topWins .= '+';
						$bottomWins .= '-';
					}
					if($topWins < $bottomWins)
					{
						$topWins .= '-';
						$bottomWins .= '+';
					}

					if (($content[$round][$matchup][0]!='E')&&($content[$round][$matchup][1]!='E')) {
						if ($results[$round][$matchup]['winner'] == 'top') {
							$brackets[$matchupsRows[$round][$matchup][0]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][0], $topWins, 'winner');
							$brackets[$matchupsRows[$round][$matchup][1]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][1], $bottomWins, 'loser');
							$loser = $content[$round][$matchup][1];
							if ($loser[0] == 'T')
							{
								$team = substr($loser,1);
								$teams[$team-1]['loss'] += 1;
								//echo "M$round,$matchup: L1: $team,".$teams[$team-1]['loss'].'<br>';
							}
						} else if ($results[$round][$matchup]['winner'] == 'bottom') {
							$brackets[$matchupsRows[$round][$matchup][0]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][0], $topWins, 'loser');
							$brackets[$matchupsRows[$round][$matchup][1]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][1], $bottomWins, 'winner');
							$loser = $content[$round][$matchup][0];
							if ($loser[0] == 'T')
							{
								$team = substr($loser,1);
								$teams[$team-1]['loss'] += 1;
								//echo "M$round,$matchup: L1: $team,".$teams[$team-1]['loss'].'<br>';
							}
						} else {
							$brackets[$matchupsRows[$round][$matchup][0]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][0], $topWins);
							$brackets[$matchupsRows[$round][$matchup][1]][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][1], $bottomWins);
						}

						$matchup_string = '';
						
						if($nbr_matchs>0) {
							$tbl = array();
							for($match = 0; $match < $nbr_matchs; $match++) {
								$match_id = $results[$round][$matchup]['matchs'][$match]['match_id'];
								$match_winner = $results[$round][$matchup]['matchs'][$match]['winner'];
								$score_0 = $results[$round][$matchup]['matchs'][$match]['scores'][0];
								$score_1 = $results[$round][$matchup]['matchs'][$match]['scores'][1];
								
								$score_0_str = '&nbsp;';
								$score_1_str = '&nbsp;';
								if ($this->getField('AllowScore') == TRUE)
								{
									if(isset($score_0)) $score_0_str = $score_0;
									if(isset($score_1)) $score_1_str = $score_1;
								}

								switch($match_winner)
								{
									case 'top':
										$class_str = 'match-winner';
										$score_str = $score_0_str;
										$match_link_str = '<a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><div class="'.$class_str .'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$score_str.'</div></a>';
										$tbl[$match][0] = '<td>'.$match_link_str.'</td>';

										$class_str = 'match-loser';
										$score_str = $score_1_str;
										$match_link_str = '<a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><div class="'.$class_str .'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$score_str.'</div></a>';
										$tbl[$match][1] = '<td>'.$match_link_str.'</td>';
									break;
									case 'bottom':
										$class_str = 'match-loser';
										$score_str = $score_1_str;
										$match_link_str = '<a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><div class="'.$class_str .'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$score_str.'</div></a>';
										$tbl[$match][0] = '<td>'.$match_link_str.'</td>';

										$class_str = 'match-winner';
										$score_str = $score_0_str;
										$match_link_str = '<a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><div class="'.$class_str .'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$score_str.'</div></a>';
										$tbl[$match][1] = '<td>'.$match_link_str.'</td>';
									break;
									default:
										$class_str = 'match-not-played';
										$matchObj = new Match($match_id);
										$permissions = $matchObj->get_permissions(USERID);
										$userclass = $permissions['userclass'];
										$can_report = $permissions['can_report'];
										$can_approve = $permissions['can_approve'];
										$can_delete = $permissions['can_delete'];
										$can_edit = $permissions['can_edit'];
										$match_link_str = '';
										$tbl[$match][0] = '';

										if ($can_approve == 1)
										{
											$match_link_str = ' <a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/exclamation.png" alt="'.EB_MATCH_L13.'" title="'.EB_MATCH_L13.'"/></a>';
											$tbl[$match][0] .= '<td rowspan="2" class="'.$class_str.'"><div class="'.$class_str.'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$match_link_str.'</div></td>';
										}
										/*
										if($can_edit == 1)
										{
											if($matchObj->getField('Status') == 'scheduled')
											{
												$match_link_str = ebImageLink('matchschedulededit', EB_MATCHR_L46, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchschedulededit&amp;userclass='.$userclass, 'page_white_edit.png', '', 'matchreport_link', '', EB_MATCHR_L46.' '.($match+1));
												$tbl[$match][0] .= '<td rowspan="2" class="'.$class_str.'"><div class="'.$class_str.'">'.$match_link_str.'</div></td>';
											}
											else
											{
												$match_link_str = ebImageLink('matchedit', EB_MATCHR_L46, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchedit&amp;userclass='.$userclass, 'page_white_edit.png', '', 'matchreport_link', '', EB_MATCHR_L46.' '.($match+1));
												$tbl[$match][0] .= '<td rowspan="2" class="'.$class_str.'"><div class="'.$class_str.'">'.$match_link_str.'</div></td>';
											}		
										}
										*/
										if($can_report == 1)
										{
											$match_link_str = ebImageLink('matchscheduledreport', EB_MATCHR_L32, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchscheduledreport&amp;userclass='.$userclass, 'report.png', '', 'matchreport_link', '', EB_MATCHR_L32.' '.($match+1));
											$tbl[$match][0] .= '<td rowspan="2" class="'.$class_str.'"><div class="'.$class_str.'" title="'.EB_MATCH_L1.' '.($match+1).'">'.$match_link_str.'</div></td>';
										}										
										
										$tbl[$match][1] = '';
									break;
								}
							}							
						
							$matchup_string = '<table class="brackets-matchup"><tbody>';
							$matchup_string .= '<tr>';
							for($match = 0; $match < $nbr_matchs; $match++) {
								$matchup_string .= $tbl[$match][0];
							}
							$matchup_string .= '</tr>';
							$matchup_string .= '<tr>';
							for($match = 0; $match < $nbr_matchs; $match++) {
								$matchup_string .= $tbl[$match][1];
							}
							$matchup_string .= '</tr>';
							$matchup_string .= '</tbody></table>';
							
							//echo $tbl_str;
						}

						switch($style)
						{
						case 'elimination':
							$brackets[$matchupsRows[$round][$matchup][0]+1][2*$round-1] = '<td rowspan="'.$rowspan.'" class="match-details" title="'.EB_EVENT_L102.' '.$round.','.$matchup.'">
							'.$matchup_string.'
							</td>';
							break;
						case 'round-robin':
							$brackets[$matchupsRows[$round][$matchup][1]+1][2*$round-1] = '<td rowspan="1" class="match-details" title="'.EB_EVENT_L102.' '.$round.','.$matchup.'">
							'.$matchup_string.'
							</td>';
							break;
						}
						$rounds[$round]['nbrMatchups']++;
						
					}	// if(content!='E')


					if(($scheduleNextMatches == true)
							&&($content[$round][$matchup][0][0]=='T')
							&&($content[$round][$matchup][1][0]=='T')
							&&($results[$round][$matchup]['winner'] == 'not played')) {
						$update_results = true;
						
						$current_match = $results[$round][$matchup]['matchs'][$nbr_matchs-1];
						//var_dump($current_match);

						if((!isset($current_match)) || ($current_match['winner'] != 'not played'))
						{
							/*
							echo 'M'.$round.','.$matchup.':<br>';
							var_dump($results[$round][$matchup]);
							var_dump($content[$round][$matchup]);
							*/

							// Need to schedule the next match
							// Create Match ------------------------------------------
							$reported_by = $this->getField('Owner');
							$time_reported = $time;
							$comments = '';
							$time_scheduled = $time_reported;

							$q =
							"INSERT INTO ".TBL_MATCHS."(Event,ReportedBy,TimeReported, Comments, Status, TimeScheduled)
							VALUES ($event_id,'$reported_by', $time_reported, '$comments', 'scheduled', $time_scheduled)";
							$result = $sql->db_Query($q);

							$last_id = mysql_insert_id();
							$match_id = $last_id;

							// Create Scores ------------------------------------------
							$teamTop    = substr($content[$round][$matchup][0],1);
							$teamBottom = substr($content[$round][$matchup][1],1);

							switch($this->getMatchPlayersType())
							{
							case 'Players':
								$playerTopID = $teams[$teamTop-1]['PlayerID'];
								$playerBottomID = $teams[$teamBottom-1]['PlayerID'];
								$teamTopID = 0;
								$teamBottomID = 0;
								break;
							case 'Teams':
								$playerTopID = 0;
								$playerBottomID = 0;
								$teamTopID = $teams[$teamTop-1]['PlayerID'];
								$teamBottomID = $teams[$teamBottom-1]['PlayerID'];
								break;
							}
							$q =
							"INSERT INTO ".TBL_SCORES."(MatchID,Player,Team,Player_MatchTeam,Player_Rank)
							VALUES ($match_id,$playerTopID,$teamTopID,1,1)
							";
							$result = $sql->db_Query($q);

							$q =
							"INSERT INTO ".TBL_SCORES."(MatchID,Player,Team,Player_MatchTeam,Player_Rank)
							VALUES ($match_id,$playerBottomID,$teamBottomID,2,2)
							";
							$result = $sql->db_Query($q);

							$match_array = array();
							$match_array['winner'] = 'not played';
							$match_array['match_id'] = $match_id;
							$results[$round][$matchup]['matchs'][$nbr_matchs] = $match_array;

							if($nbr_matchs == 0)
							{
								// Send notification to all the players.
								$fromid = 0;
								$subject = SITENAME." ".EB_MATCHR_L52;

								switch($this->getMatchPlayersType())
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
									$numPlayers = mysql_numrows($result_Players);
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
									$numPlayers = mysql_numrows($result_Players);
									break;
								default:
								}

								if($numPlayers > 0)
								{
									for($j=0; $j < $numPlayers; $j++)
									{
										$pname = mysql_result($result_Players, $j, TBL_USERS.".user_name");
										$pemail = mysql_result($result_Players, $j, TBL_USERS.".user_email");
										$message = EB_MATCHR_L53.$pname.EB_MATCHR_L54.EB_MATCHR_L55.$this->getField('Name').EB_MATCHR_L56;
										$sendto = mysql_result($result_Players, $j, TBL_USERS.".user_id");
										$sendtoemail = mysql_result($result_Players, $j, TBL_USERS.".user_email");
										if (check_class($pref['eb_pm_notifications_class']))
										{
											// Send PM
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
							}	// if(nbr_matchs==0)
						}	// create match
					}	// schedule next match
					
					/*
					echo 'M'.$round.','.$matchup.':<br>';
					var_dump($results[$round][$matchup]);
					var_dump($content[$round][$matchup]);
					echo '- matchup: top='.$matchups[$round][$matchup][0].', bottom='.$matchups[$round][$matchup][1].'<br>';
					echo '- content: top='.$content[$round][$matchup][0].', bottom='.$content[$round][$matchup][1].'<br>';
					echo '- winner='.$results[$round][$matchup]['winner'].', bye='.$results[$round][$matchup]['bye'].'<br>';
					*/
				}	// for(matchup)
			}
			else
			{
				/* Last round, no match */
				for ($matchup = 1; $matchup <= $nbrMatchups; $matchup ++){
					if (!isset($results[$round][$matchup]['winner'])) $results[$round][$matchup]['winner'] = '';
					if (!isset($results[$round][$matchup]['bye'])) $results[$round][$matchup]['bye'] = false;
					$match = 0;
					$matchupString = $matchups[$round][$matchup][$match];
					$content[$round][$matchup][$match] = ($matchupString == '') ? 'E' : $matchupString;
					if ($matchupString[$match]='W') {

						$matchupArray = explode(',',substr($matchupString,1));
						$matchupRound = $matchupArray[0];
						$matchupMatchup = $matchupArray[1];

						$winner = $results[$matchupRound][$matchupMatchup]['winner'];
						$bye = $results[$matchupRound][$matchupMatchup]['bye'];

						$rowTop    = $matchupsRows[$matchupRound][$matchupMatchup][0];
						$rowBottom = $matchupsRows[$matchupRound][$matchupMatchup][1];
						$row = ($rowBottom - $rowTop)/2 + $rowTop;

						if($bye != true){
							$brackets[$rowTop][2*$round-2] = '<td class="grid border-top"></td>';
							$brackets[$rowBottom][2*$round-2] = '<td class="grid border-bottom"></td>';
							for ($i = $rowTop+1; $i < $rowBottom; $i++){
								$brackets[$i][2*$round-2] = '<td class="grid border-vertical"></td>';
							}
							for ($i = $rowTop+2; $i < $rowBottom; $i++){
								$brackets[$i][2*$round-3] = '';
							}
							$brackets[$row][2*$round-2] = '<td class="grid border-middle"></td>';
						}

						$matchupsRows[$round][$matchup][$match] = $rowTop;
						if ($winner == 'top') {
							$content[$round][$matchup][$match] = $content[$matchupRound][$matchupMatchup][0];
						} else if ($winner == 'bottom') {
							$content[$round][$matchup][$match] = $content[$matchupRound][$matchupMatchup][1];
						}

						$topWins = $results[$round][$matchup]['topWins'];
						$bottomWins = $results[$round][$matchup]['bottomWins'];
						if($topWins > $bottomWins)
						{
							$topWins .= '+';
							$bottomWins .= '-';
						}
						if($topWins < $bottomWins)
						{
							$topWins .= '-';
							$bottomWins .= '+';
						}
						if ($content[$round][$matchup][0][0] != 'E') {
							$brackets[$row][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][$match], $topWins, 'victor');
						} else {
							$brackets[$row][2*$round-1] = html_bracket_team_cell($teams, $content[$round][$matchup][$match], $bottomWins);
						}
					}
				}	// for(matchup)
			}
			$rowspan = 2*$rowspan + 1;
		}

		$bracket_html = '<div id="panel_brackets">';
		$bracket_html .= '<div id="brackets_frame" style="height: 400px;">';
		$bracket_html .= '<div id="brackets">';
		$bracket_html .= '<table class="brackets">';

		$bracket_html .= '<thead><tr>';
		for ($i = 1; $i < $nbrRounds; $i++) {
			if ($rounds[$i]['nbrMatchups'] != 0)
			{
				$bracket_html .= '<th colspan="2" title="'.EB_EVENTM_L146.' '.$rounds[$i]['BestOf'].'">';
				$bracket_html .= $rounds[$i]['Title'].'<br />';
				$bracket_html .= '<div class="smalltext">'.EB_EVENTM_L146.' '.$rounds[$i]['BestOf'].'</div>';
				$bracket_html .= '</th>';
			}
			else
			{
				$bracket_html .= '<th colspan="2"></th>';
			}
		}
		$bracket_html .= '</tr></thead>';

		$bracket_html .= '<tbody>';
		for ($row = 1; $row <= $nbrRows; $row ++){
			$bracket_html .= '<tr>';
			for ($column = 1; $column <= 2*$nbrRounds; $column++){
				$bracket_html .= $brackets[$row][$column];
			}
			$bracket_html .= '</tr>';
		}
		$bracket_html .= '</tbody>';
		$bracket_html .= '</table>';
		$bracket_html .= '</div>'; // brackets
		$bracket_html .= '</div>'; // brackets_frame
		$bracket_html .= '<div class="clearer"></div>';
		$bracket_html .= '</div>'; // panel-brackets

		/*
		echo "rounds:<br>";
		var_dump($rounds);
		echo "matchups:<br>";
		var_dump($matchups);
		echo "results:<br>";
		var_dump($results);
		echo "content:<br>";
		var_dump($content);
		echo "teams:<br>";
		var_dump($teams);
		*/
		if($update_results == true) {
			$this->updateResults($results);
			$this->updateFieldDB('Results');
		}
		
		return array($bracket_html);

	}

	function eventTypeToString()
	{
		switch($this->getField('Type'))
		{
		case "One Player Ladder":
			$text = EB_EVENTS_L22;
			break;
		case "Team Ladder":
			$text = EB_EVENTS_L23;
			break;
		case "Clan Ladder":
			$text = EB_EVENTS_L25;
			break;
		case "One Player Tournament":
			$text = EB_EVENTS_L33;
			break;
		case "Clan Tournament":
			$text = EB_EVENTS_L35;
			break;
		default:
			$text = $type;
		}
		return $text;
	}

	function eventStatusToString()
	{
		$status = $this->getField('Status');
		switch($status)
		{
		case 'draft':
			$text = EB_EVENTM_L136;
			break;
		case 'signup':
			$text = EB_EVENTM_L138;
			break;
		case 'checkin':
			$text = EB_EVENTM_L139;
			break;
		case 'active':
			$text = EB_EVENTM_L140;
			break;
		case 'finished':
			$text = EB_EVENTM_L141;
			break;
		default:
			$text = $status;
		}
		return $text;
	}

	function eventStatusToTimeComment()
	{
		global $time;

		$time_comment = '';
		switch($this->getField('Status'))
		{
		case 'draft':
			break;
		case 'signup':
			if($this->getField('CheckinDuration') == 0)
			{
				$time_comment = EB_EVENT_L2.'&nbsp;'.get_formatted_timediff($time, $this->getField('StartDateTime'));
			}
			else
			{
				$time_comment = EB_EVENT_L87.'&nbsp;'.get_formatted_timediff($time, $this->getField('StartDateTime') - INT_MINUTE*$this->getField('CheckinDuration'));
			}
			break;
		case 'checkin':
			$time_comment = EB_EVENT_L2.'&nbsp;'.get_formatted_timediff($time, $this->getField('StartDateTime'));
			break;
		case 'active':
			if ($this->getField('EndDateTime') != 0)
			{
				$time_comment = EB_EVENT_L3.'&nbsp;'.get_formatted_timediff($time, $this->getField('EndDateTime'));
			}
			break;
		case 'finished':
			$time_comment = EB_EVENT_L4;
			break;
		}
		return $time_comment;
	}
	
	function getCompetitionType()
	{
		switch($this->getField('Type'))
		{
		case 'One Player Ladder':
		case 'Team Ladder':
		case 'Clan Ladder':
			$competition_type = 'Ladder';
			break;
		case 'One Player Tournament':
		case 'Clan Tournament':
			$competition_type = 'Tournament';
			break;
		default:
		}
		return $competition_type;
	}

	function getMatchPlayersType()
	{
		switch($this->getField('Type'))
		{
		case 'One Player Ladder':
		case 'One Player Tournament':
		case 'Team Ladder':
			$match_players_type = 'Players';
			break;
		case 'Clan Tournament':
		case 'Clan Ladder':
			$match_players_type = 'Teams';
			break;
		default:
		}
		return $match_players_type;
	}	
	
	function getTeams()
	{
		global $sql;
		
		$teams = array();
		$checkedin_str = '';
		switch($this->getMatchPlayersType())
		{
		case 'Players':
			$q_Players = "SELECT ".TBL_GAMERS.".*, "
			.TBL_PLAYERS.".*, "
			.TBL_USERS.".*"
			." FROM ".TBL_GAMERS.", "
			.TBL_PLAYERS.", "
			.TBL_USERS
			." WHERE (".TBL_PLAYERS.".Event = '".$this->getField('EventID')."')"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
			.$checkedin_str
			." ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";			
			$result = $sql->db_Query($q_Players);
			$nbrPlayers = mysql_numrows($result);
			for ($player = 0; $player < $nbrPlayers; $player++)
			{
				$playerID = mysql_result($result, $player, TBL_PLAYERS.".PlayerID");
				$gamerID = mysql_result($result, $player, TBL_GAMERS.".GamerID");
				$gamer = new Gamer($gamerID);

				$pname = $gamer->getField('Name');
				$pugid = $gamer->getField('UniqueGameID');
				$pavatar = mysql_result($result,$player, TBL_USERS.".user_image");
				$pteam  = mysql_result($result,$player , TBL_PLAYERS.".Team");
				list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
				$pseed = mysql_result($result, $player, TBL_PLAYERS.".Seed");
				if($pseed == 0) $pseed = $player+1;

				$teams[$pseed-1]['PlayerID'] = $playerID;
				$teams[$pseed-1]['Name'] = $pname;
				$teams[$pseed-1]['UniqueGameID'] = $pugid;
				$teams[$pseed-1]['Avatar'] = $pavatar;
				$teams[$pseed-1]['seed'] = $pseed;
			}
			break;
		case 'Teams':
			$q_Teams = "SELECT ".TBL_CLANS.".*, "
			.TBL_TEAMS.".*, "
			.TBL_DIVISIONS.".* "
			." FROM ".TBL_CLANS.", "
			.TBL_TEAMS.", "
			.TBL_DIVISIONS
			." WHERE (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
			." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
			." AND (".TBL_TEAMS.".Event = '".$this->getField('EventID')."')"
			.$checkedin_str
			." ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
			$result = $sql->db_Query($q_Teams);
			$nbrTeams = mysql_numrows($result);
			for ($team = 0; $team < $nbrTeams; $team++)
			{
				$pteam  = mysql_result($result,$team, TBL_TEAMS.".TeamID");
				$pavatar = '';	// TODO: no team avatar for now
				list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
				$pseed = mysql_result($result,$team, TBL_TEAMS.".Seed");
				if($pseed == 0) $pseed = $team+1;

				$teams[$pseed-1]['PlayerID'] = $pteam;
				$teams[$pseed-1]['Name'] = $pclan;
				$teams[$pseed-1]['UniqueGameID'] = '';
				$teams[$pseed-1]['Avatar'] = $pavatar;
				$teams[$pseed-1]['seed'] = $pseed;
			}
			break;
		}
		//var_dump($teams);
		return $teams;
	}

	function shuffleSeeds()
	{
		global $sql;

		switch($this->getMatchPlayersType())
		{
		case 'Players':
			$q_Players = "SELECT ".TBL_GAMERS.".*, "
			.TBL_PLAYERS.".*"
			." FROM ".TBL_GAMERS.", "
			.TBL_PLAYERS.", "
			.TBL_USERS
			." WHERE (".TBL_PLAYERS.".Event = '".$this->getField('EventID')."')"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
			." ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";
			$result = $sql->db_Query($q_Players);
			$nbrPlayers = mysql_numrows($result);

			$array_sort = array();
			for ($player = 0; $player < $nbrPlayers; $player++)
			{
				$array_sort[$player] = $player + 1;
			}
			shuffle($array_sort);
			for ($player = 0; $player < $nbrPlayers; $player++)
			{
				$pid  = mysql_result($result,$player, TBL_PLAYERS.".PlayerID");
				$q_2 = "UPDATE ".TBL_PLAYERS." SET Seed = '".$array_sort[$player]."' WHERE (PlayerID = '".$pid."')";
				$result_2 = $sql->db_Query($q_2);
			}
			break;
		case 'Teams':
			$q_Teams = "SELECT ".TBL_CLANS.".*, "
			.TBL_TEAMS.".*, "
			.TBL_DIVISIONS.".* "
			." FROM ".TBL_CLANS.", "
			.TBL_TEAMS.", "
			.TBL_DIVISIONS
			." WHERE (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
			." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
			." AND (".TBL_TEAMS.".Event = '".$this->getField('EventID')."')"
			." ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
			$result = $sql->db_Query($q_Teams);
			$nbrTeams = mysql_numrows($result);

			$array_sort = array();
			for ($team = 0; $team < $nbrTeams; $team++)
			{
				$array_sort[$team] = $team + 1;
			}
			shuffle($array_sort);
			for ($team = 0; $team < $nbrTeams; $team++)
			{
				$tid  = mysql_result($result,$team, TBL_TEAMS.".TeamID");
				$q_2 = "UPDATE ".TBL_TEAMS." SET Seed = '".$array_sort[$team]."' WHERE (TeamID = '".$tid."')";
				$result_2 = $sql->db_Query($q_2);
			}
			break;
		}
	}
	
	function updateSeeds()
	{
		global $sql;

		switch($this->getMatchPlayersType())
		{
		case 'Players':
			$q = "SELECT ".TBL_PLAYERS.".*"
			." FROM ".TBL_PLAYERS
			." WHERE (".TBL_PLAYERS.".Event = '".$this->getField('EventID')."')"
			." ORDER BY ".TBL_PLAYERS.".Seed, ".TBL_PLAYERS.".Joined";
			$result = $sql->db_Query($q);
			$num_players = mysql_numrows($result);
			for($i=0; $i<$num_players; $i++)
			{
				$pID  = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
				$q2 = "UPDATE ".TBL_PLAYERS." SET Seed = '".($i+1)."' WHERE (PlayerID = '$pID')";
				$result2 = $sql->db_Query($q2);
			}
			break;
		case 'Teams':
			$q = "SELECT ".TBL_TEAMS.".*"
			." FROM ".TBL_TEAMS
			." WHERE (".TBL_TEAMS.".Event = '".$this->getField('EventID')."')"
			." ORDER BY ".TBL_TEAMS.".Seed, ".TBL_TEAMS.".Joined";
			$result = $sql->db_Query($q);
			$num_teams = mysql_numrows($result);
			for($i=0; $i<$num_teams; $i++)
			{
				$tID  = mysql_result($result, $i, TBL_TEAMS.".TeamID");
				$q2 = "UPDATE ".TBL_TEAMS." SET Seed = '".($i+1)."' WHERE (TeamID = '$tID')";
				$result2 = $sql->db_Query($q2);
			}
			break;
		}
	}
	
	function getMatchups()
	{
		$file = $this->getField('MatchupsFile');
		if($file=='')
		{
			$maxNbrPlayers = $this->getField('MaxNumberPlayers');
			switch ($this->getField('Format'))
			{
			case 'Double Elimination':
				$file = e_PLUGIN.'ebattles/include/brackets/de-'.$maxNbrPlayers.'.txt';
				break;
			case 'Single Elimination':
			default:
				$file = e_PLUGIN.'ebattles/include/brackets/se-'.$maxNbrPlayers.'.txt';
				break;
			case 'Round-robin':
				$file = e_PLUGIN.'ebattles/include/brackets/rr-'.$maxNbrPlayers.'.txt';
				break;
			case 'Double Round-robin':
				$file = e_PLUGIN.'ebattles/include/brackets/drr-'.$maxNbrPlayers.'.txt';
				break;
			}
		}
		$lines = file($file);
		if($lines) {
			$matchups = unserialize(implode('', $lines));
			return $matchups;
		}
		else
		{
			echo "[getMatchups] error openig file $file<br>";
			return FALSE;
		}
	}
	
	function get_permissions($user_id)
	{
		global $sql;
		global $pref;
		
		$can_approve = 0;
		$can_report = 0;
		$can_schedule = 0;
		$can_report_quickloss = 0;
		$can_submit_replay = 0;
		$can_challenge = 0;
		$userclass = 0;
		
		$event_id = $this->fields['EventID'];
		$eowner = $this->fields['Owner'];
		
		// Check if user can report
		// Is the user admin?
		if (check_class($pref['eb_mod_class']))
		{
			$userclass |= eb_UC_EB_MODERATOR;
			$can_report = 1;
			$can_submit_replay = 1;
			$can_schedule = 1;
			$can_approve = 1;
		}

		// Is the user event owner?
		if ($user_id==$eowner)
		{
			$userclass |= eb_UC_EVENT_OWNER;
			$can_report = 1;
			$can_submit_replay = 1;
			$can_schedule = 1;
			$can_approve = 1;
		}
		// Is the user a moderator?
		$q = "SELECT ".TBL_EVENTMODS.".*"
		." FROM ".TBL_EVENTMODS
		." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
		."   AND (".TBL_EVENTMODS.".User = ".$user_id.")";
		$result = $sql->db_Query($q);
		$numMods = mysql_numrows($result);
		if ($numMods>0)
		{
			$userclass |= eb_UC_EVENT_MODERATOR;
			$can_report = 1;
			$can_submit_replay = 1;
			$can_schedule = 1;
			$can_approve = 1;
		}
		/*
		if ($userIsDivisionCaptain == TRUE)
		{
		$userclass |= eb_UC_EVENT_PLAYER;
		$can_report = 1;
		}
		*/

		// Is the user a player?
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		."   AND (".TBL_GAMERS.".User = ".$user_id.")";
		$result = $sql->db_Query($q);

		$pbanned=0;
		if(mysql_numrows($result) > 0)
		{
			$userclass |= eb_UC_EVENT_PLAYER;
			$row = mysql_fetch_array($result);
			$pbanned = $row['Banned'];

			// Is the event started, and not ended
			if ($this->getField('Status') == 'active')
			{
				$can_report = 1;
				$can_report_quickloss = 1;
				$can_submit_replay = 1;
				$can_challenge = 1;
			}
		}
		
		/* Nbr players */
		$q = "SELECT COUNT(*) as NbrPlayers"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Banned != 1)";
		$result = $sql->db_Query($q);
		$row = mysql_fetch_array($result);
		$nbrplayersNotBanned = $row['NbrPlayers'];
		
		/* Nbr Teams */
		$q = "SELECT COUNT(*) as NbrTeams"
		." FROM ".TBL_TEAMS
		." WHERE (Event = '$event_id')"
		."   AND (".TBL_TEAMS.".Banned != 1)";
		$result = $sql->db_Query($q);
		$row = mysql_fetch_array($result);
		$nbrteamsNotBanned = $row['NbrTeams'];
		switch($this->getMatchPlayersType())
		{
		case 'Players':
			if (($nbrplayersNotBanned < 2)||($pbanned))
			{
				$can_report = 0;
				$can_schedule = 0;
				$can_report_quickloss = 0;
				$can_challenge = 0;
			}
			break;
		case 'Teams':
			if ($nbrteamsNotBanned < 2)
			{
				$can_report = 0;
				$can_schedule = 0;
				$can_report_quickloss = 0;
				$can_challenge = 0;
			}
			break;
		default:
		}

		//sc2:
		$can_submit_replay = 0;

		if($this->getField('FixturesEnable') == TRUE)
		{
			$can_report = 0;
			$can_schedule = 0;
			$can_report_quickloss = 0;
			$can_challenge = 0;
		}

		// check if only 1 player with this userid
		$q = "SELECT DISTINCT ".TBL_PLAYERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
		."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
		."   AND (".TBL_USERS.".user_id = ".$user_id.")";
		$result = $sql->db_Query($q);
		$numPlayers = mysql_numrows($result);
		if ($numPlayers>1)
		$can_report_quickloss = 0;

		// Check if AllowScore is set
		if ($this->getField('AllowScore')==TRUE)
		$can_report_quickloss = 0;

		$match_report_userclass = $this->getField('match_report_userclass');
		if($match_report_userclass==eb_UC_MATCH_WINNER) $match_report_userclass = eb_UC_EVENT_PLAYER;
		
		if($this->getField('Type') == "Clan Ladder") $can_report_quickloss = 0;  // Disable quick loss report for clan wars for now
		if($this->getField('quick_loss_report')==FALSE) $can_report_quickloss = 0;
		if($userclass < $match_report_userclass) $can_report = 0;
		if($userclass < $this->getField('match_replay_report_userclass')) $can_submit_replay = 0;

		if($userclass < $this->getField('MatchesApproval')) $can_approve = 0;
		if($this->getField('MatchesApproval') == eb_UC_NONE) $can_approve = 0;

		if($this->getField('ChallengesEnable')==FALSE) $can_challenge= 0;		

		//echo "e($event_id).perm.can_report=$can_report<br>";
		$permissions = array();
		$permissions['userclass'] = $userclass;
		$permissions['can_approve'] = $can_approve;
		$permissions['can_report'] = $can_report;
		$permissions['can_schedule'] = $can_schedule;
		$permissions['can_report_quickloss'] = $can_report_quickloss;
		$permissions['can_submit_replay'] = $can_submit_replay;
		$permissions['can_challenge'] = $can_challenge;
		
		/*
		echo "event $event_id permissions:<br>";
		var_dump($permissions);
		*/
		
		return $permissions;
	}
	
	function replacePlayer($player_id, $new_seed)
	{
		global $sql;
		global $time;
		
		$error = 0;
		
		// Get player's old seed
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')";
		$result = $sql->db_Query($q);
		$old_seed = mysql_result($result, 0, TBL_PLAYERS.".Seed");
		echo "old_seed: $old_seed<br>";
		
		// Find player_target
		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')"
		." AND (".TBL_PLAYERS.".Seed = '$new_seed')";
		$result = $sql->db_Query($q);
		$numPlayers = mysql_numrows($result);
		if($numPlayers == 1)
		{
			$player_target_id = mysql_result($result, 0, TBL_PLAYERS.".PlayerID");
			echo "player_target_id: $player_target_id<br>";
			
			$q_2 = "SELECT count(*) "
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_PLAYERS
			." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_MATCHS.".Status = 'active')"
			." AND ((".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
			." OR   ((".TBL_PLAYERS.".Team = ".TBL_SCORES.".Team)"
			." AND   (".TBL_PLAYERS.".Team != 0)))"
			." AND (".TBL_PLAYERS.".PlayerID = '$player_target_id')";
			$result_2 = $sql->db_Query($q_2);
			$pmatches = mysql_result($result_2, 0);
			echo "pmatches: $pmatches<br>";
			
			if($pmatches > 0)
			{
				// Cannot switch with a player_target who has played already ???
				$error = 1;
			}
			else
			{
				// Delete player_target matches
				// And then change his seed.
				deletePlayerMatches($player_target_id);
				
				// Update player's seed
				$q = "UPDATE ".TBL_PLAYERS." SET Seed = '".($old_seed)."' WHERE (PlayerID = '".$player_target_id."')";
				$sql->db_Query($q);
			}
		}
		
		if($error==0)
		{
			// Update player's seed
			$q = "UPDATE ".TBL_PLAYERS." SET Seed = '".($new_seed)."' WHERE (PlayerID = '".$player_id."')";
			$sql->db_Query($q);
			if(($this->getField('FixturesEnable') == TRUE)&&($this->getField('Status') == 'active'))
			{
				$this->brackets(true);
			}			
			$this->setFieldDB('IsChanged', 1);
		}
		
		return $error;
	}
	
	function replaceTeam($team_id, $new_seed)
	{
		global $sql;
		global $time;
		
		$error = 0;
		
		// Get team's old seed
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".TeamID = '$team_id')";
		$result = $sql->db_Query($q);
		$old_seed = mysql_result($result, 0, TBL_TEAMS.".Seed");
		echo "old_seed: $old_seed<br>";
		
		// Find team_target
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')"
		." AND (".TBL_TEAMS.".Seed = '$new_seed')";
		$result = $sql->db_Query($q);
		$numTeams = mysql_numrows($result);
		if($numTeams == 1)
		{
			$team_target_id = mysql_result($result, 0, TBL_TEAMS.".TeamID");
			echo "team_target_id: $team_target_id<br>";
			
			$q_2 = "SELECT count(*) "
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_TEAMS
			." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_MATCHS.".Status = 'active')"
			." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
			." AND (".TBL_TEAMS.".TeamID = '$team_target_id')";
			$result_2 = $sql->db_Query($q_2);
			$tmatches = mysql_result($result_2, 0);
			echo "tmatches: $tmatches<br>";
			
			if($tmatches > 0)
			{
				// Cannot switch with a team_target who has played already ???
				$error = 1;
			}
			else
			{
				// Delete team_target matches
				// And then change his seed.
				deleteTeamMatches($team_target_id);
				
				// Update team's seed
				$q = "UPDATE ".TBL_TEAMS." SET Seed = '".($old_seed)."' WHERE (TeamID = '".$team_target_id."')";
				$sql->db_Query($q);
			}
		}
		
		if($error==0)
		{
			// Update team's seed
			$q = "UPDATE ".TBL_TEAMS." SET Seed = '".($new_seed)."' WHERE (TeamID = '".$team_id."')";
			$sql->db_Query($q);
			if(($this->getField('FixturesEnable') == TRUE)&&($this->getField('Status') == 'active'))
			{
				$this->brackets(true);
			}			
			$this->setFieldDB('IsChanged', 1);
		}
		
		return $error;
	}
	
	function rating_period_update()
	{
		global $sql;

		$q = "SELECT ".TBL_PLAYERS.".*"
		." FROM ".TBL_PLAYERS
		." WHERE (".TBL_PLAYERS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_players = mysql_numrows($result);
		if ($num_players!=0)
		{
			for($j=0; $j< $num_players; $j++)
			{
				$PlayerID  = mysql_result($result,$j, TBL_PLAYERS.".PlayerID");
				$pG2_RD = mysql_result($result,$j, TBL_PLAYERS.".G2_RD");
				$pG2_sigma = mysql_result($result,$j, TBL_PLAYERS.".G2_sigma");
				$pG2_phi = g2_from_g1_deviation($pG2_RD, G2_qinv);
				
				// Glicko 2 rating deviation periodic update
				$pG2_phi = g2_rating_period($pG2_phi, $pG2_sigma);
				$pG2_RD = g2_to_g1_deviation($pG2_phi, G2_qinv);

				$q2 = "UPDATE ".TBL_PLAYERS
				." SET G2_RD = '".floatToSQL($pG2_RD)."'"
				." WHERE (PlayerID = '$PlayerID')";
				$result2 = $sql->db_Query($q2);
			}
		}
		$q = "SELECT ".TBL_TEAMS.".*"
		." FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Event = '".$this->fields['EventID']."')";
		$result = $sql->db_Query($q);
		$num_teams = mysql_numrows($result);
		if ($num_teams!=0)
		{
			for($j=0; $j< $num_teams; $j++)
			{
				$TeamID  = mysql_result($result,$j, TBL_TEAMS.".TeamID");
				$tG2_RD = mysql_result($result,$j, TBL_TEAMS.".G2_RD");
				$tG2_sigma = mysql_result($result,$j, TBL_TEAMS.".G2_sigma");
				$tG2_phi = g2_from_g1_deviation($pG2_RD, G2_qinv);
				
				// Glicko 2 rating deviation periodic update
				$tG2_phi = g2_rating_period($tG2_phi, $tG2_sigma);
				$tG2_RD = g2_to_g1_deviation($tG2_phi, G2_qinv);
				
				$q2 = "UPDATE ".TBL_TEAMS
				." SET G2_RD = '".floatToSQL($tG2_RD)."'"
				." WHERE (TeamID = '$TeamID')";
				$result2 = $sql->db_Query($q2);
			}
		}
	}
}

function deletePlayerMatches($player_id)
{
	global $sql;

	$q = "SELECT ".TBL_MATCHS.".*, "
	.TBL_SCORES.".*"
	." FROM ".TBL_MATCHS.", "
	.TBL_SCORES
	." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
	." AND (".TBL_SCORES.".Player = '$player_id')";
	$result = $sql->db_Query($q);
	$num_matches = mysql_numrows($result);
	echo "<br>player_id $player_id";
	echo "<br>num_matches $num_matches";
	if ($num_matches!=0)
	{
		for($j=0; $j<$num_matches; $j++)
		{
			set_time_limit(10);
			$match_id = mysql_result($result,$j, TBL_MATCHS.".MatchID");
			$match = new Match($match_id);
			$match->delete();
		}
	}
}

function deletePlayer($player_id)
{
	global $sql;
	
	deletePlayerAwards($player_id);
	deletePlayerMatches($player_id);
	$q = "DELETE FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')";
	$result = $sql->db_Query($q);
}
		
function deletePlayerAwards($player_id)
{
	global $sql;
	$q = "DELETE FROM ".TBL_AWARDS
	." WHERE (".TBL_AWARDS.".Player = '$player_id')";
	$result = $sql->db_Query($q);
}

function checkinPlayer($player_id)
{
	global $sql;
	$q = "UPDATE ".TBL_PLAYERS." SET CheckedIn = '1' WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')";
	$result = $sql->db_Query($q);
}

function banPlayer($player_id)
{
	global $sql;
	$q = "UPDATE ".TBL_PLAYERS." SET Banned = '1' WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')";
	$result = $sql->db_Query($q);
}

function unbanPlayer($player_id)
{
	global $sql;
	$q = "UPDATE ".TBL_PLAYERS." SET Banned = '0' WHERE (".TBL_PLAYERS.".PlayerID = '$player_id')";
	$result = $sql->db_Query($q);
}

function deleteTeamMatches($team_id)
{
	global $sql;

	$q = "SELECT ".TBL_MATCHS.".*, "
	.TBL_SCORES.".*"
	." FROM ".TBL_MATCHS.", "
	.TBL_SCORES
	." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
	." AND (".TBL_SCORES.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$num_matches = mysql_numrows($result);
	echo "<br>team_id $team_id";
	echo "<br>num_matches $num_matches";
	if ($num_matches!=0)
	{
		for($j=0; $j<$num_matches; $j++)
		{
			set_time_limit(10);
			$match_id  = mysql_result($result,$j, TBL_MATCHS.".MatchID");
			$match = new Match($match_id);
			$match->delete();
		}
	}
}

function deleteTeam($team_id)
{
	global $sql;
	
	deleteTeamAwards($team_id);
	deleteTeamMatches($team_id);

	// delete all the players of that team
	$q = "SELECT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$numPlayers = mysql_numrows($result);
	for($i=0; $i<$numPlayers; $i++)
	{		
		$player_id = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
		deletePlayer($player_id);
	}

	$q = "DELETE FROM ".TBL_TEAMS
	." WHERE (".TBL_TEAMS.".TeamID = '$team_id')";
	$result = $sql->db_Query($q);
}

function deleteTeamAwards($team_id)
{
	global $sql;

	// delete all the awards of players of that team
	$q = "SELECT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$numPlayers = mysql_numrows($result);
	for($i=0; $i<$numPlayers; $i++)
	{		
		$player_id = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
		deletePlayerAwards($player_id);
	}
	
	$q = "DELETE FROM ".TBL_AWARDS
	." WHERE (".TBL_AWARDS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
}

function checkinTeam($team_id)
{
	global $sql;
	global $time;
	
	$q = "UPDATE ".TBL_TEAMS." SET CheckedIn = '1' WHERE (".TBL_TEAMS.".TeamID = '$team_id')";
	$result = $sql->db_Query($q);
	
	// Checkin all the players of that team
	$q = "SELECT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$numPlayers = mysql_numrows($result);
	for($i=0; $i<$numPlayers; $i++)
	{		
		$player_id = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
		checkinPlayer($player_id);
	}
}

function banTeam($team_id)
{
	global $sql;
	global $time;
	
	$q = "UPDATE ".TBL_TEAMS." SET Banned = '1' WHERE (".TBL_TEAMS.".TeamID = '$team_id')";
	$result = $sql->db_Query($q);
	
	// Checkin all the players of that team
	$q = "SELECT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$numPlayers = mysql_numrows($result);
	for($i=0; $i<$numPlayers; $i++)
	{		
		$player_id = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
		banPlayer($player_id);
	}
}

function unbanTeam($team_id)
{
	global $sql;
	global $time;
	
	$q = "UPDATE ".TBL_TEAMS." SET Banned = '0' WHERE (".TBL_TEAMS.".TeamID = '$team_id')";
	$result = $sql->db_Query($q);
	
	// Checkin all the players of that team
	$q = "SELECT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS
	." WHERE (".TBL_PLAYERS.".Team = '$team_id')";
	$result = $sql->db_Query($q);
	$numPlayers = mysql_numrows($result);
	for($i=0; $i<$numPlayers; $i++)
	{		
		$player_id = mysql_result($result, $i, TBL_PLAYERS.".PlayerID");
		unbanPlayer($player_id);
	}
}
?>
