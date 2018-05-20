<?php
/**
* updateteamstats.php
*
*/

require_once(e_HANDLER."avatar_handler.php");
require_once(e_HANDLER."rate_class.php");
require_once(e_PLUGIN."ebattles/include/clan.php");

function updateTeamStats($event_id, $time, $serialize = TRUE)
{
	global $sql;
	global $pref;

	$rater = new rater();
	$file_team = e_PLUGIN.'ebattles/cache/sql_cache_event_team_'.$event_id.'.txt';

	$id = array();
	$uid = array();
	$team = array();
	$clanid = array();
	$clantag = array();
	$name = array();
	$avatar = array();
	$nbr_players = array();
	$games_played = array();
	$ELO = array();
	$Skill = array();
	$G2 = array();
	$win = array();
	$loss = array();
	$draw = array();
	$windrawloss = array();
	$streaks = array();
	$victory_ratio = array();
	$victory_percent = array();
	$unique_opponents = array();
	$opponentsELO = array();
	$score = array();
	$oppscore = array();
	$scorediff = array();
	$points = array();
	$forfeits = array();
	$forfeits_percent = array();
	$banned = array();
	$rating = array();

	$games_played_score = array();
	$ELO_score = array();
	$Skill_score = array();
	$G2_score = array();
	$win_score = array();
	$loss_score = array();
	$draw_score = array();
	$windrawloss_score = array();
	$victory_ratio_score = array();
	$victory_percent_score = array();
	$unique_opponents_score = array();
	$opponentsELO_score = array();
	$streak_score = array();
	$score_score = array();
	$oppscore_score = array();
	$scorediff_score = array();
	$points_score = array();
	$forfeits_score = array();
	$forfeits_percent_score = array();

	/* Event Info */
	$event = new Event($event_id);
	$type = $event->getField('Type');
	$competition_type = $event->getCompetitionType();

	$hide_ratings_column = $event->getField('hide_ratings_column');
	if ($event->getField('RankingType') == "Classic") $hide_ratings_column = TRUE;

	//Update Teams stats
	$q_Teams = "SELECT ".TBL_TEAMS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_CLANS.".*"
	." FROM ".TBL_TEAMS.", "
	.TBL_DIVISIONS.", "
	.TBL_CLANS
	." WHERE (".TBL_TEAMS.".Event = '$event_id')"
	." AND (".TBL_DIVISIONS.".DivisionID = ".TBL_TEAMS.".Division)"
	." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)";

	$result_Teams = $sql->db_Query($q_Teams);
	$numTeams = mysql_numrows($result_Teams);
	$teams_rated = 0;

	for($team=0; $team < $numTeams; $team++)
	{
		$tclan = mysql_result($result_Teams,$team, TBL_CLANS.".ClanID");
		$clan = new Clan($tclan);
		$tid = mysql_result($result_Teams,$team, TBL_TEAMS.".TeamID");
		$tgames_played = mysql_result($result_Teams,$team, TBL_TEAMS.".GamesPlayed");
		$tELO = mysql_result($result_Teams,$team, TBL_TEAMS.".ELORanking");
		$tTS_mu = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_mu");
		$tTS_sigma = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_sigma");
		$tSkill = $tTS_mu - 3*$tTS_sigma;
		$tG2_r = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_r");
		$tG2_RD = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_RD");
		$tG2 = $tG2_r - 2*$tG2_RD;
		$twin = mysql_result($result_Teams,$team, TBL_TEAMS.".Win");
		$tdraw = mysql_result($result_Teams,$team, TBL_TEAMS.".Draw");
		$tloss = mysql_result($result_Teams,$team, TBL_TEAMS.".Loss");
		$tstreak = mysql_result($result_Teams,$team, TBL_TEAMS.".Streak");
		$tstreak_worst = mysql_result($result_Teams,$team, TBL_TEAMS.".Streak_Worst");
		$tstreak_best = mysql_result($result_Teams,$team, TBL_TEAMS.".Streak_Best");
		$twindrawloss = $twin."/".$tdraw."/".$tloss;
		$twinloss = $twin."/".$tloss;
		$tvictory_ratio = ($tloss>0) ? ($twin/$tloss) : $twin; //fm- draw here???
		$tvictory_percent = ($tgames_played>0) ? ((100 * $twin)/($twin+$tloss)) : 0;
		$tscore = mysql_result($result_Teams,$team, TBL_TEAMS.".Score");
		$toppscore = mysql_result($result_Teams,$team, TBL_TEAMS.".ScoreAgainst");
		$tpoints = mysql_result($result_Teams,$team, TBL_TEAMS.".Points");
		$tforfeits = mysql_result($result_Teams,$team, TBL_TEAMS.".Forfeits");
		$tforfeits_percent = ($tgames_played>0) ? ((100 * $tforfeits)/$tgames_played) : 0;
		$tbanned  = mysql_result($result_Teams,$team, TBL_TEAMS.".Banned");

		switch($event->getField('Type'))
		{
		case "Team Ladder":
			$tunique_opponents = 0;
			$topponentsELO = 0;
			$topponents = 0;
			$tplayers = array();

			// Find all players for that event and that team
			$q_Players = "SELECT * "
			." FROM ".TBL_PLAYERS." "
			." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
			." AND (".TBL_PLAYERS.".Team = '$tid')";
			$result_Players = $sql->db_Query($q_Players);
			$tnumPlayers = mysql_numrows($result_Players);
			$tnbrplayers_rated = 0;

			if ($tnumPlayers>0)
			{
				for($player=0; $player < $tnumPlayers; $player++)
				{
					// For each player
					$pid = mysql_result($result_Players,$player, TBL_PLAYERS.".PlayerID");
					$popponentsELO = 0;
					$popponents = 0;
					$prating = 0;
					$prating_votes = 0;
					// Unique Opponents
					// Find all matches played by current player
					$q_Matches = "SELECT ".TBL_MATCHS.".*, "
					.TBL_SCORES.".*, "
					.TBL_PLAYERS.".*"
					." FROM ".TBL_MATCHS.", "
					.TBL_SCORES.", "
					.TBL_PLAYERS
					." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_MATCHS.".Status = 'active')"
					." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
					." AND (".TBL_PLAYERS.".PlayerID = '$pid')";

					$result_Matches = $sql->db_Query($q_Matches);
					$numMatches = mysql_numrows($result_Matches);

					$players = array();
					if ($numMatches>0)
					{
						for($match=0; $match < $numMatches; $match++)
						{
							// For each match played by current player
							$mID  = mysql_result($result_Matches,$match, TBL_MATCHS.".MatchID");
							$mplayermatchteam  = mysql_result($result_Matches,$match, TBL_SCORES.".Player_MatchTeam");

							// Find all scores/players(+users) for that match
							$q_Scores = "SELECT ".TBL_MATCHS.".*, "
							.TBL_SCORES.".*, "
							.TBL_PLAYERS.".*, "
							.TBL_USERS.".*"
							." FROM ".TBL_MATCHS.", "
							.TBL_SCORES.", "
							.TBL_PLAYERS.", "
							.TBL_GAMERS.", "
							.TBL_USERS
							." WHERE (".TBL_MATCHS.".MatchID = '$mID')"
							." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
							." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
							." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
							." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)";

							$result_Scores = $sql->db_Query($q_Scores);
							$numScores = mysql_numrows($result_Scores);
							for($scoreIndex=0; $scoreIndex < $numScores; $scoreIndex++)
							{
								$osid  = mysql_result($result_Scores,$scoreIndex, TBL_SCORES.".ScoreID");
								$ouid  = mysql_result($result_Scores,$scoreIndex, TBL_USERS.".user_id");
								$oplayermatchteam  = mysql_result($result_Scores,$scoreIndex, TBL_SCORES.".Player_MatchTeam");
								$oELO  = mysql_result($result_Scores,$scoreIndex, TBL_PLAYERS.".ELORanking");
								if ($oplayermatchteam != $mplayermatchteam)
								{
									$players[] = "$ouid";
									$tplayers[] = "$ouid";
									$popponentsELO += $oELO;
									$popponents += 1;
								}
								if ($ouid == $puid)
								{
									// Get user rating.
									$rate = $rater->GetRating("ebscores", $osid);

									$prating += $rate[0]*($rate[1] + $rate[2]/10);
									$prating_votes += $rate[0];
								}
							}
						}
					}

					$punique_opponents = count(array_unique($players));

					$topponentsELO += $popponentsELO;
					$topponents += $popponents;
				}

				if ($topponents !=0)
				{
					$topponentsELO /= $topponents;
				}
			}
			$tunique_opponents = count(array_unique($tplayers));

			break;
		case "Clan Ladder":
			$topponentsELO = 0;
			$topponents = 0;
			$trating = 0;
			$trating_votes = 0;
			// Unique Opponents
			// Find all matches played by current player
			$q_Matches = "SELECT ".TBL_MATCHS.".*, "
			.TBL_SCORES.".*, "
			.TBL_TEAMS.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_TEAMS
			." WHERE (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_MATCHS.".Status = 'active')"
			." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
			." AND (".TBL_TEAMS.".TeamID = '$tid')";

			$result_Matches = $sql->db_Query($q_Matches);
			$numMatches = mysql_numrows($result_Matches);

			$players = array();
			if ($numMatches>0)
			{
				for($match=0; $match < $numMatches; $match++)
				{
					// For each match played by current player
					$mID  = mysql_result($result_Matches,$match, TBL_MATCHS.".MatchID");
					$mplayermatchteam  = mysql_result($result_Matches,$match, TBL_SCORES.".Player_MatchTeam");

					// Find all scores/players(+users) for that match
					$q_Scores = "SELECT ".TBL_MATCHS.".*, "
					.TBL_SCORES.".*, "
					.TBL_TEAMS.".*"
					." FROM ".TBL_MATCHS.", "
					.TBL_SCORES.", "
					.TBL_TEAMS
					." WHERE (".TBL_MATCHS.".MatchID = '$mID')"
					." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)";

					$result_Scores = $sql->db_Query($q_Scores);
					$numScores = mysql_numrows($result_Scores);
					for($scoreIndex=0; $scoreIndex < $numScores; $scoreIndex++)
					{
						$osid  = mysql_result($result_Scores,$scoreIndex, TBL_SCORES.".ScoreID");
						$otid  = mysql_result($result_Scores,$scoreIndex, TBL_TEAMS.".TeamID");
						$oplayermatchteam  = mysql_result($result_Scores,$scoreIndex, TBL_SCORES.".Player_MatchTeam");
						$oELO  = mysql_result($result_Scores,$scoreIndex, TBL_TEAMS.".ELORanking");
						if ($oplayermatchteam != $mplayermatchteam)
						{
							$players[] = "$otid";
							$topponentsELO += $oELO;
							$topponents += 1;
						}
						/* no opponent rating for clanwars yet
						if ($ouid == $puid)
						{
						// Get user rating.
						$rate = $rater->GetRating("ebscores", $osid);

						$prating += $rate[0]*($rate[1] + $rate[2]/10);
						$prating_votes += $rate[0];
						}
						*/
					}
				}
			}

			$tunique_opponents = count(array_unique($players));

			if ($topponents !=0)
			{
				$topponentsELO /= $topponents;
			}
			break;
		default:
		}

		// For display
		$id[]  = $tid;
		$name[]  = $clan->getField('Name');
		$clanid[]  = $tclan;
		$clantag[]  = $clan->getField('Tag');
		$avatar[] = $clan->getField('Image');
		$nbr_players[]  = $tnumPlayers;
		$games_played[] = $tgames_played;
		$ELO[] = $tELO;
		$Skill[] = max(0,number_format ($tSkill,0));
		$G2[] = number_format($tG2_r,0)." +/- ".number_format($tG2_RD,0);
		$win[] = $twin;
		$loss[] = $tloss;
		$draw[] = $tdraw;
		$streaks[] = $tstreak."|".$tstreak_best."|".$tstreak_worst;
		$windrawloss[] = $twindrawloss;
		$victory_ratio[] = $twinloss;
		$victory_percent[] = number_format ($tvictory_percent,2)."%";
		$unique_opponents[] = $tunique_opponents;
		$opponentsELO[] = floor($topponentsELO);
		$score[] = ($tgames_played>0) ? number_format($tscore/$tgames_played,2) : 0;
		$oppscore[] = ($tgames_played>0) ? number_format($toppscore/$tgames_played,2) : 0;
		$scorediff[] = ($tgames_played>0) ? number_format(($tscore - $toppscore)/$tgames_played,2) : 0;
		$points[] = $tpoints;
		$forfeits[] = $tforfeits;
		$forfeits_percent[] = number_format($tforfeits_percent,2)."%";
		$banned[] = $tbanned;

		// Actual score (not for display)
		$games_played_score[] = $tgames_played;
		$ELO_score[] = $tELO;
		$Skill_score[] = $tSkill;
		$G2_score[] = $tG2;
		$win_score[] = $twin;
		$loss_score[] = $tloss;
		$draw_score[] = $tdraw;
		$windrawloss_score[] = $twin - $tloss; //fm - ???
		$victory_ratio_score[] = $tvictory_ratio;
		$victory_percent_score[] = $tvictory_percent;
		$unique_opponents_score[] = $tunique_opponents;
		$opponentsELO_score[] = $topponentsELO;
		$streaks_score[] = $tstreak_best; //max(0,$tstreak_best + $tstreak_worst); //fmarc- TBD
		$score_score[] = ($tgames_played>0) ? $tscore/$tgames_played : 0;
		$oppscore_score[] = ($tgames_played>0) ? -$toppscore/$tgames_played : 0;
		$scorediff_score[] = ($tgames_played>0) ? ($tscore - $toppscore)/$tgames_played : 0;
		$points_score[] = $tpoints;
		$forfeits_score[] = -$tforfeits;
		$forfeits_percent_score[] = -$tforfeits_percent;

		if (($tgames_played >= $event->getField('nbr_team_games_to_rank'))&&($tbanned == 0))
		{
			$teams_rated++;
		}
	}

	$rating_max= 0;

	$q_Categories = "SELECT ".TBL_STATSCATEGORIES.".*"
	." FROM ".TBL_STATSCATEGORIES
	." WHERE (".TBL_STATSCATEGORIES.".Event = '$event_id')"
	." ORDER BY ".TBL_STATSCATEGORIES.".CategoryMaxValue DESC";
	$result_Categories = $sql->db_Query($q_Categories);
	$numCategories = mysql_numrows($result_Categories);

	$stat_cat_header = array();
	$stat_min = array();
	$stat_max = array();
	$stat_a = array();
	$stat_b = array();
	$stat_score = array();
	$stat_display = array();
	$cat_index = 0;
	$categories = array();
	for($category=0; $category < $numCategories; $category++)
	{
		$cat_name = mysql_result($result_Categories,$category, TBL_STATSCATEGORIES.".CategoryName");
		$cat_minpoints = mysql_result($result_Categories,$category, TBL_STATSCATEGORIES.".CategoryMinValue");
		$cat_maxpoints = mysql_result($result_Categories,$category, TBL_STATSCATEGORIES.".CategoryMaxValue");
		$cat_InfoOnly = mysql_result($result_Categories,$category, TBL_STATSCATEGORIES.".InfoOnly");

		if ($cat_maxpoints > 0)
		{
			//dbg- echo "$cat_name<br>";
			$display_cat = 1;
			switch ($cat_name)
			{
			case "ELO":
				$cat_header_title = EB_STATS_L1;
				$cat_header_text = EB_STATS_L2;
				$min = min($ELO_score);
				$max = max($ELO_score);
				$stat_score[$cat_index] = $ELO_score;
				$stat_display[$cat_index] = $ELO;
				break;
			case "Skill":
				$cat_header_title = EB_STATS_L3;
				$cat_header_text = EB_STATS_L4;
				$min = min($Skill_score);
				$max = max($Skill_score);
				$stat_score[$cat_index] = $Skill_score;
				$stat_display[$cat_index] = $Skill;
				break;
			case "Glicko2":
				$cat_header_title = EB_STATS_L41;
				$cat_header_text = EB_STATS_L42;
				$min = min($G2_score);
				$max = max($G2_score);
				$stat_score[$cat_index] = $G2_score;
				$stat_display[$cat_index] = $G2;
				break;
			case "GamesPlayed":
				$cat_header_title = EB_STATS_L5;
				$cat_header_text = EB_STATS_L6;
				$min = 0; //min($games_played_score);
				$max = max($games_played);
				$stat_score[$cat_index] = $games_played_score;
				$stat_display[$cat_index] = $games_played;
				break;
			case "VictoryRatio":
				$cat_header_title = EB_STATS_L7;
				$cat_header_text = EB_STATS_L8;
				$min = 0; //min($victory_ratio_score);
				$max = max($victory_ratio_score);
				$stat_score[$cat_index] = $victory_ratio_score;
				$stat_display[$cat_index] = $victory_ratio;
				break;
			case "VictoryPercent":
				$cat_header_title = EB_STATS_L9;
				$cat_header_text = EB_STATS_L10;
				$min = 0; //min($victory_percent_score);
				$max = max($victory_percent_score);
				$stat_score[$cat_index] = $victory_percent_score;
				$stat_display[$cat_index] = $victory_percent;
				break;
			case "WinDrawLoss":
				$cat_header_title = EB_STATS_L11;
				$cat_header_text = EB_STATS_L12;
				$min = min($windrawloss_score);
				$max = max($windrawloss_score);
				$stat_score[$cat_index] = $windrawloss_score;
				$stat_display[$cat_index] = $windrawloss;
				break;
			case "UniqueOpponents":
				$cat_header_title = EB_STATS_L13;
				$cat_header_text = EB_STATS_L14;
				$min = 0; //min($unique_opponents_score);
				$max = max($unique_opponents_score);
				$stat_score[$cat_index] = $unique_opponents_score;
				$stat_display[$cat_index] = $unique_opponents;
				break;
			case "OpponentsELO":
				$cat_header_title = EB_STATS_L15;
				$cat_header_text = EB_STATS_L16;
				$min = min($opponentsELO_score);
				$max = max($opponentsELO_score);
				$stat_score[$cat_index] = $opponentsELO_score;
				$stat_display[$cat_index] = $opponentsELO;
				break;
			case "Streaks":
				switch($event->getField('Type'))
				{
				case "Team Ladder":
					$display_cat = 0;
					break;
				case "Clan Ladder":
					$cat_header_title = EB_STATS_L17;
					$cat_header_text = EB_STATS_L18;
					$min = min($streaks_score);
					$max = max($streaks_score);
					$stat_score[$cat_index] = $streaks_score;
					$stat_display[$cat_index] = $streaks;
					break;
				default:
				}
				break;
			case "Score":
				$cat_header_title = EB_STATS_L19;
				$cat_header_text = EB_STATS_L20;
				$min = min($score_score);
				$max = max($score_score);
				$stat_score[$cat_index] = $score_score;
				$stat_display[$cat_index] = $score;
				break;
			case "ScoreAgainst":
				$cat_header_title = EB_STATS_L21;
				$cat_header_text = EB_STATS_L22;
				$min = min($oppscore_score);
				$max = max($oppscore_score);
				$stat_score[$cat_index] = $oppscore_score;
				$stat_display[$cat_index] = $oppscore;
				break;
			case "ScoreDiff":
				$cat_header_title = EB_STATS_L23;
				$cat_header_text = EB_STATS_L24;
				$min = min($scorediff_score);
				$max = max($scorediff_score);
				$stat_score[$cat_index] = $scorediff_score;
				$stat_display[$cat_index] = $scorediff;
				break;
			case "Points":
				$cat_header_title = EB_STATS_L25;
				$cat_header_text = EB_STATS_L26;
				$min = min($points_score);
				$max = max($points_score);
				$stat_score[$cat_index] = $points_score;
				$stat_display[$cat_index] = $points;
				break;
			case "Forfeits":
				$cat_header_title = EB_STATS_L43;
				$cat_header_text = EB_STATS_L44;
				$min = min($forfeits_score);
				$max = max($forfeits_score);
				$stat_score[$cat_index] = $forfeits_score;
				$stat_display[$cat_index] = $forfeits;
				break;
			case "ForfeitsPercent":
				$cat_header_title = EB_STATS_L45;
				$cat_header_text = EB_STATS_L46;
				$min = min($forfeits_percent_score);
				$max = max($forfeits_percent_score);
				$stat_score[$cat_index] = $forfeits_percent_score;
				$stat_display[$cat_index] = $forfeits_percent;
				break;
			default:
				$display_cat = 0;
			}

			if ($display_cat==1)
			{
				$stat_InfoOnly[$cat_index] = $cat_InfoOnly;

				switch($event->getField('RankingType'))
				{
				case "CombinedStats":
					if (($cat_InfoOnly == TRUE))
					{
						$cat_header = '<b title="'.$cat_header_title.'">'.$cat_header_text.'</b>';
					}
					else
					{
						$categories[] = $cat_index;
						$cat_header = '<b title="'.$cat_header_title.' ['.number_format ($cat_maxpoints,2).' '.EB_STATS_L27.']">'.$cat_header_text.'</b>';
						/*
						$cat_header = '
						<b title="'.$cat_header_title.'">'.$cat_header_text.'</b>
						<br /><div class="smalltext">['.number_format ($cat_maxpoints,2).'&nbsp;'.EB_STATS_L27.']</div>
						';
						*/

						// a = (ymax-ymin)/(xmax-xmin)
						// b = ymin - a.xmin
						if ($max==$min)
						{
							$a = 0;
							$b = $cat_maxpoints;
						}
						else
						{
							$a = ($cat_maxpoints-$cat_minpoints) / ($max-$min);
							$b = $cat_minpoints - $a * $min;
						}

						$stat_min[$cat_index] = $min;
						$stat_max[$cat_index] = $max;
						$stat_a[$cat_index] = $a;
						$stat_b[$cat_index] = $b;

						$rating_max += $cat_maxpoints;
					}
					break;
				case "Classic";
					$cat_header = '<b title="'.$cat_header_title.'">'.$cat_header_text.'</b>';
					if (($cat_InfoOnly == FALSE))
					{
						$categories[] = $cat_index;
					}
					break;
				default:
				}

				$stat_cat_header[$cat_index] = $cat_header;
				$cat_index++;
			}
		}
	}
	$numDisplayedCategories = $cat_index;

	$ranks = getRanking($stat_score, $categories);

	$stats = array
	(
	"0"=>array('header','<b>'.EB_STATS_L28.'</b>','<b>'.EB_STATS_L39.'</b>')
	);

	switch($event->getField('Type'))
	{
	case "Team Ladder":
		$stats[0][] = '<b>'.EB_STATS_L40.'</b>';
		break;
	default:
	}

	// user rating not shown
	// $stats[0][] = '<b>'.EB_STATS_L30.'</b>';

	if ($hide_ratings_column == FALSE)
	$stats[0][] = '<b title="'.EB_STATS_L31.' ['.number_format ($rating_max,2).' '.EB_STATS_L27.']">'.EB_STATS_L32.'</b>';
	//$stats[0][] = '<b title="'.EB_STATS_L31.'">'.EB_STATS_L32.'</b><br /><div class="smalltext">['.number_format ($rating_max,2).'&nbsp;'.EB_STATS_L27.']</div>';

	for ($category=0; $category < $numDisplayedCategories; $category++)
	{
		$stats[0][] = $stat_cat_header[$category];
	}

	// Challenge column
	$stats[0][] = "<b>".EB_CHALLENGE_L1."<b>";
	
	switch($event->getField('RankingType'))
	{
	case "CombinedStats":
		$OverallScoreThreshold = 0;
		$final_score = array();
		for($team=0; $team < $numTeams; $team++)
		{
			$OverallScore[$team]=0;
			if (($games_played[$team] >= $event->getField('nbr_team_games_to_rank'))&&($banned[$team] == 0))
			{
				for ($category=0; $category < $numDisplayedCategories; $category++)
				{
					if ($stat_InfoOnly[$category] == FALSE)
					{
						$final_score[$category][$team] = $stat_a[$category] * $stat_score[$category][$team] + $stat_b[$category];
						$OverallScore[$team]+=$final_score[$category][$team];
					}
				}
			}
			else
			{
				for ($category=0; $category < $numDisplayedCategories; $category++)
				{
					$final_score[$category][$team] = 0;
				}
			}

			$q_update = "UPDATE ".TBL_TEAMS
			." SET OverallScore = '".floatToSQL($OverallScore[$team])."'"
			." WHERE (TeamID = '$id[$team]')"
			."   AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		break;
	case "Classic";
		$OverallScoreThreshold = $numTeams;
		for($team=0; $team < $numTeams; $team++)
		{
			if (($games_played[$team] >= $event->getField('nbr_team_games_to_rank'))&&($banned[$team] == 0))
			{
				$OverallScore[$team] = array_search($team, $ranks, false) + $numTeams + 1;
			}
			else
			{
				$OverallScore[$team] = array_search($team, $ranks, false);
			}
			//dbg: echo "<br>Team $team ($name[$team]), os: $OverallScore[$team]";

			$q_update = "UPDATE ".TBL_TEAMS
			." SET OverallScore = '".floatToSQL($OverallScore[$team])."'"
			." WHERE (TeamID = '$id[$team]')"
			."   AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		break;
	default:
	}

	// Build results table
	//--------------------
	$q_Teams = "SELECT *"
	." FROM ".TBL_TEAMS
	." WHERE (Event = '$event_id')"
	." ORDER BY ".TBL_TEAMS.".OverallScore DESC, ".TBL_TEAMS.".GamesPlayed DESC, ".TBL_TEAMS.".ELORanking DESC, ".TBL_TEAMS.".Banned ASC";
	$result_Teams = $sql->db_Query($q_Teams);
	$ranknumber = 1;
	for($team=0; $team < $numTeams; $team++)
	{
		$tid = mysql_result($result_Teams,$team, TBL_TEAMS.".TeamID");
		$trank = mysql_result($result_Teams,$team, TBL_TEAMS.".Rank");
		$trankdelta = mysql_result($result_Teams,$team, TBL_TEAMS.".RankDelta");

		// Find index of team
		$index = array_search($tid,$id);

		$trank_side_image = "";
		if($banned[$index]==1)
		{
			$rank = '<span title="'.EB_STATS_L33.'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/user_delete.ico" alt="'.EB_STATS_L34.'" title="'.EB_STATS_L34.'"/></span>';
			$prankdelta_string = "";
			$q_update = "UPDATE ".TBL_TEAMS." SET Rank = 0 WHERE (TeamID = '$tid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		elseif($OverallScore[$index] <= $OverallScoreThreshold)
		{
			$rank = '<span title="'.EB_STATS_L35.'">'.EB_STATS_L36.'</span>';
			$trankdelta_string = "";
			$q_update = "UPDATE ".TBL_TEAMS." SET Rank = 0 WHERE (TeamID = '$tid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		else
		{
			$rank = $ranknumber;
			$ranknumber++; // increases $ranknumber by 1
			$q_update = "UPDATE ".TBL_TEAMS." SET Rank = $rank WHERE (TeamID = '$tid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);

			$new_rankdelta = $trank - $rank;
			if ($new_rankdelta != 0)
			{
				$trankdelta += $new_rankdelta;
				$q_update = "UPDATE ".TBL_TEAMS." SET RankDelta = $trankdelta WHERE (TeamID = '$tid') AND (Event = '$event_id')";
				$result_update = $sql->db_Query($q_update);
			}

			if (($new_rankdelta != 0)&&($rank==1)&&($competition_type == 'Ladder'))
			{
				// Award: player took 1st place
				$q_Awards = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
				VALUES ($tid,'TeamTookFirstPlace',$time)";
				$result_Awards = $sql->db_Query($q_Awards);
			}
			if (($new_rankdelta != 0)&&(($prank>10)||($prank==0))&&($rank<=10)&&($competition_type == 'Ladder'))
			{
				// Award: player enters top 10
				$q_Awards = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
				VALUES ($tid,'TeamInTopTen',$time)";
				$result_Awards = $sql->db_Query($q_Awards);
			}

			$q_Awards = "SELECT ".TBL_AWARDS.".*, "
			.TBL_TEAMS.".*"
			." FROM ".TBL_AWARDS.", "
			.TBL_TEAMS
			." WHERE (".TBL_AWARDS.".Team = ".TBL_TEAMS.".TeamID)"
			." AND (".TBL_TEAMS.".TeamID = '$tid')"
			." ORDER BY ".TBL_AWARDS.".timestamp DESC";
			$result_Awards = $sql->db_Query($q_Awards);
			$numAwards = mysql_numrows($result_Awards);
			if ($numAwards > 0)
			{
				$taward  = mysql_result($result_Awards,0, TBL_AWARDS.".AwardID");
				$tawardType  = mysql_result($result_Awards,0, TBL_AWARDS.".Type");
			}

			if ($rank==1)
			{
				$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/award_star_gold_3.png" alt="'.EB_AWARD_L3.'" title="'.EB_AWARD_L3.'"/>';
			}
			else if (($rank<=10)&&(($rank+$trankdelta>min(10,$numTeams))||($rank+$trankdelta==0)))
			{
				$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/award_star_bronze_3.png" alt="'.EB_AWARD_L5.'" title="'.EB_AWARD_L5.'"/>';
			}
			else if (($numAwards>0)&&($tawardType!='TeamTookFirstPlace')&&($tawardType!='TeamInTopTen')&&($tstreak>=5))
			{
				switch ($tawardType)
				{
				case 'TeamStreak5':
					if ($tstreak>=5)
					{
						$award = EB_AWARD_L6;
						$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_bronze_3.png" alt="'.EB_AWARD_L7.'" title="'.EB_AWARD_L7.'"/>';
					}
					break;
				case 'TeamStreak10':
					if ($tstreak>=10)
					{
						$award = EB_AWARD_L8;
						$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_silver_3.png" alt="'.EB_AWARD_L9.'" title="'.EB_AWARD_L9.'"/>';
					}
					break;
				case 'TeamStreak25':
					if ($tstreak>=25)
					{
						$award = EB_AWARD_L10;
						$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_gold_3.png" alt="'.EB_AWARD_L11.'" title="'.EB_AWARD_L11.'"/>';
					}
					break;
				}
			}
			else if ($trankdelta>0)
			{
				$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_up.gif" alt="+'.$trankdelta.'" title="+'.$trankdelta.'"/>';
			}
			else if (($trankdelta<0)&&($rank+$trankdelta!=0))
			{
				$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_down.gif" alt="'.$trankdelta.'" title="'.$trankdelta.'"/>';
			}
			else if ($rank+$trankdelta==0)
			{
				$trank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_up.gif" alt="Up" title="'.EB_STATS_L37.'"/>';
			}
		}

		$q_Players = "SELECT *"
		." FROM ".TBL_PLAYERS.", "
		.TBL_GAMERS
		." WHERE (".TBL_PLAYERS.".Team = '$tid')"
		." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		." AND (".TBL_GAMERS.".User = ".USERID.")";
		$result_Players = $sql->db_Query($q_Players);
		$num_rows_2 = mysql_numrows($result_Players);
		if($num_rows_2 > 0)
		{
			$stats_row = array
			(
			"row_highlight"
			);
		}
		else
		{
			$stats_row = array
			(
			"row"
			);
		}

		$stats_row[] = "<b>$rank</b> $trank_side_image";

		$image = "";
		if ($pref['eb_avatar_enable_teamsstandings'] == 1)
		{
			if($avatar[$index])
			{
				$image = '<img '.getAvatarResize(getImagePath($avatar[$index], 'team_avatars')).'/>';
			} else if ($pref['eb_avatar_default_team_image'] != ''){
				$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>';
			}
		}

		$stats_row[] = $image.'&nbsp;<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clanid[$index].'"><b>'.$name[$index].' ('.$clantag[$index].')</b></a>';
		//  ('.$clantag[$index].')

		switch($event->getField('Type'))
		{
		case "Team Ladder":
			$stats_row[] = "$nbr_players[$index]";
			break;
		default:
		}
		if ($hide_ratings_column == FALSE)
		$stats_row[] = number_format ($OverallScore[$index],2);

		for ($category=0; $category < $numDisplayedCategories; $category++)
		{
			if (($stat_InfoOnly[$category] == TRUE)||($event->getField('RankingType') == "Classic"))
			{
				$stats_row[] = $stat_display[$category][$index];
			}
			else
			{
				$stats_row[] = $stat_display[$category][$index].'<br /><div class="smalltext">['.number_format ($final_score[$category][$index],2).']</div>';
			}
		}
		
		// Add challenge button here
		$challenge_text = ' <a href="javascript:challenge_team_js(\''.$tid.'\');" title="'.EB_CHALLENGE_L1.' '.$pclantag.$name[$index].'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/challenge.png" alt="'.EB_CHALLENGE_L1.' '.$name[$index].'"/></a>';
		$stats_row[] = $challenge_text;
		
		$stats[] = $stats_row;
	}

	/*
	// debug print array
	require_once(e_PLUGIN."ebattles/include/show_array.php");
	echo "<br />";
	html_show_table($stats, $numTeams+1, 7);
	echo "<br />";
	*/

	if ($serialize)
	{
		// Serialize results array
		$OUTPUT = serialize($stats);
		$fp = fopen($file_team,"w"); // open file with Write permission

		if ($fp == FALSE) {
			// handle error
			$error .= EB_STATS_L38;
			echo $error;
			exit();
		}

		fputs($fp, $OUTPUT);
		fclose($fp);
		/*
		$stats = unserialize(implode('',file($file_team)));
		foreach ($stats as $id=>$row)
		{
		print $row['category_name']."<br />";
		}
		*/
	}
}
?>
