<?php
/**
* updatestats.php
*
*/

require_once(e_HANDLER."avatar_handler.php");
require_once(e_HANDLER."rate_class.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/gamer.php");

function updateStats($event_id, $time, $serialize = TRUE)
{
	global $sql;
	global $pref;

	$rater = new rater();
	$file = e_PLUGIN.'ebattles/cache/sql_cache_event_'.$event_id.'.txt';

	$id = array();
	$uid = array();
	$team = array();
	$name = array();
	$avatar = array();
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

	// Update Players stats
	$q_Players = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)";
	$result_Players = $sql->db_Query($q_Players);
	$numPlayers = mysql_numrows($result_Players);

	$players_rated = 0;
	for($player=0; $player < $numPlayers; $player++)
	{
		// For each player
		$pid  = mysql_result($result_Players,$player, TBL_PLAYERS.".PlayerID");
		$puid  = mysql_result($result_Players,$player, TBL_USERS.".user_id");
		$gamer_id = mysql_result($result_Players,$player, TBL_PLAYERS.".Gamer");
		$gamer = new Gamer($gamer_id);
		$pname = $gamer->getField('Name');
		$pavatar = mysql_result($result_Players,$player, TBL_USERS.".user_image");
		$pteam = mysql_result($result_Players,$player, TBL_PLAYERS.".Team");
		$pgames_played = mysql_result($result_Players,$player, TBL_PLAYERS.".GamesPlayed");
		$pELO = mysql_result($result_Players,$player, TBL_PLAYERS.".ELORanking");
		$pTS_mu = mysql_result($result_Players,$player, TBL_PLAYERS.".TS_mu");
		$pTS_sigma = mysql_result($result_Players,$player, TBL_PLAYERS.".TS_sigma");
		$pSkill = $pTS_mu - 3*$pTS_sigma;
		$pG2_r = mysql_result($result_Players,$player, TBL_PLAYERS.".G2_r");
		$pG2_RD = mysql_result($result_Players,$player, TBL_PLAYERS.".G2_RD");
		$pG2 = $pG2_r - 2*$pG2_RD;
		$pwin = mysql_result($result_Players,$player, TBL_PLAYERS.".Win");
		$pdraw = mysql_result($result_Players,$player, TBL_PLAYERS.".Draw");
		$ploss = mysql_result($result_Players,$player, TBL_PLAYERS.".Loss");
		$pstreak = mysql_result($result_Players,$player, TBL_PLAYERS.".Streak");
		$pstreak_worst = mysql_result($result_Players,$player, TBL_PLAYERS.".Streak_Worst");
		$pstreak_best = mysql_result($result_Players,$player, TBL_PLAYERS.".Streak_Best");
		$pwindrawloss = $pwin."/".$pdraw."/".$ploss;
		$pwinloss = $pwin."/".$ploss;
		$pvictory_ratio = ($ploss>0) ? ($pwin/$ploss) : $pwin; //fm- draw here???
		$pvictory_percent = (($pwin+$pdraw+$ploss)>0) ? ((100 * $pwin)/($pwin+$pdraw+$ploss)) : 0;
		$pscore = mysql_result($result_Players,$player, TBL_PLAYERS.".Score");
		$poppscore = mysql_result($result_Players,$player, TBL_PLAYERS.".ScoreAgainst");
		$ppoints = mysql_result($result_Players,$player, TBL_PLAYERS.".Points");
		$pforfeits = mysql_result($result_Players,$player, TBL_PLAYERS.".Forfeits");
		$pforfeits_percent = ($pgames_played>0) ? ((100 * $pforfeits)/$pgames_played) : 0;
		$pbanned  = mysql_result($result_Players,$player, TBL_PLAYERS.".Banned");

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
		if ($popponents !=0)
		{
			$popponentsELO /= $popponents;
		}
		if ($prating_votes !=0)
		{
			$prating /= $prating_votes;
		}

		// For display
		$id[]  = $pid;
		$uid[]  = $puid;
		$name[]  = $pname;
		$avatar[] = $pavatar;
		$team[] = $pteam;
		$games_played[] = $pgames_played;
		$ELO[] = $pELO;
		$Skill[] = max(0,number_format($pSkill,0));
		$G2[] = number_format($pG2_r,0)." +/- ".number_format($pG2_RD,0);
		$win[] = $pwin;
		$loss[] = $ploss;
		$draw[] = $pdraw;
		$streaks[] = $pstreak."|".$pstreak_best."|".$pstreak_worst;
		$windrawloss[] = $pwindrawloss;
		$victory_ratio[] = $pwinloss;
		$victory_percent[] = number_format($pvictory_percent,2)."%";
		$unique_opponents[] = $punique_opponents;
		$opponentsELO[] = floor($popponentsELO);
		$score[] = ($pgames_played>0) ? number_format($pscore/$pgames_played,2) : 0;
		$oppscore[] = ($pgames_played>0) ? number_format($poppscore/$pgames_played,2) : 0;
		$scorediff[] = ($pgames_played>0) ? number_format(($pscore - $poppscore)/$pgames_played,2) : 0;
		$points[] = $ppoints;
		$forfeits[] = $pforfeits;
		$forfeits_percent[] = number_format($pforfeits_percent,2)."%";
		$banned[] = $pbanned;
		$rating[] = displayRating($prating, $prating_votes);

		// Actual score (not for display)
		$games_played_score[] = $pgames_played;
		$ELO_score[] = $pELO;
		$Skill_score[] = $pSkill;
		$G2_score[] = $pG2;
		$win_score[] = $pwin;
		$loss_score[] = $ploss;
		$draw_score[] = $pdraw;
		$windrawloss_score[] = $pwin - $ploss; //fm - ???
		$victory_ratio_score[] = $pvictory_ratio;
		$victory_percent_score[] = $pvictory_percent;
		$unique_opponents_score[] = $punique_opponents;
		$opponentsELO_score[] = $popponentsELO;
		$streaks_score[] = $pstreak_best; //max(0,$pstreak_best + $pstreak_worst); //fmarc- TBD
		$score_score[] = ($pgames_played>0) ? $pscore/$pgames_played : 0;
		$oppscore_score[] = ($pgames_played>0) ? -$poppscore/$pgames_played : 0;
		$scorediff_score[] = ($pgames_played>0) ? ($pscore - $poppscore)/$pgames_played : 0;
		$points_score[] = $ppoints;
		$forfeits_score[] = -$pforfeits;
		$forfeits_percent_score[] = -$pforfeits_percent;

		if (($pgames_played >= $event->getField('nbr_games_to_rank'))&&($pbanned == 0))
		{
			$players_rated++;
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
				$cat_header_title = EB_STATS_L17;
				$cat_header_text = EB_STATS_L18;
				$min = min($streaks_score);
				$max = max($streaks_score);
				$stat_score[$cat_index] = $streaks_score;
				$stat_display[$cat_index] = $streaks;
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
					if (($cat_InfoOnly == TRUE))
					{
						$cat_header = '<span title="'.$cat_header_title.'">'.$cat_header_text.'</span>';
					}
					else
					{
						$cat_header = '<b title="'.$cat_header_title.'">'.$cat_header_text.'</b>';
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
	"0"=>array('header','<b>'.EB_STATS_L28.'</b>','<b>'.EB_STATS_L29.'</b>')
	);

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
		for($player=0; $player < $numPlayers; $player++)
		{
			$OverallScore[$player] = 0;
			if (($games_played[$player] >= $event->getField('nbr_games_to_rank'))&&($banned[$player] == 0))
			{
				for ($category=0; $category < $numDisplayedCategories; $category++)
				{
					if ($stat_InfoOnly[$category] == FALSE)
					{
						$final_score[$category][$player] = $stat_a[$category] * $stat_score[$category][$player] + $stat_b[$category];
						$OverallScore[$player]+=$final_score[$category][$player];
					}
				}
			}
			else
			{
				for ($category=0; $category < $numDisplayedCategories; $category++)
				{
					$final_score[$category][$player] = 0;
				}
			}

			$q_update = "UPDATE ".TBL_PLAYERS." SET OverallScore = '".floatToSQL($OverallScore[$player])."' WHERE (PlayerID = '$id[$player]') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		break;
	case "Classic";
		$OverallScoreThreshold = $numPlayers;
		for($player=0; $player < $numPlayers; $player++)
		{
			if (($games_played[$player] >= $event->getField('nbr_games_to_rank'))&&($banned[$player] == 0))
			{
				$OverallScore[$player] = array_search($player, $ranks, false) + $numPlayers + 1;
			}
			else
			{
				$OverallScore[$player] = array_search($player, $ranks, false);
			}
			//dbg: echo "<br>Player $player ($name[$player]), os: $OverallScore[$player]";

			$q_update = "UPDATE ".TBL_PLAYERS." SET OverallScore = '".floatToSQL($OverallScore[$player])."' WHERE (PlayerID = '$id[$player]') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		break;
	default:
	}

	// Build results table
	//--------------------
	$q_Players = "SELECT *"
	." FROM ".TBL_PLAYERS
	." WHERE (Event = '$event_id')"
	." ORDER BY ".TBL_PLAYERS.".OverallScore DESC, ".TBL_PLAYERS.".GamesPlayed DESC, ".TBL_PLAYERS.".ELORanking DESC, ".TBL_PLAYERS.".Banned ASC";
	$result_Players = $sql->db_Query($q_Players);
	$ranknumber = 1;
	for($player=0; $player < $numPlayers; $player++)
	{
		$pid = mysql_result($result_Players,$player, TBL_PLAYERS.".PlayerID");
		$puid = mysql_result($result_Players,$player, TBL_PLAYERS.".User");
		$prank = mysql_result($result_Players,$player, TBL_PLAYERS.".Rank");
		$prankdelta = mysql_result($result_Players,$player, TBL_PLAYERS.".RankDelta");
		$pstreak = mysql_result($result_Players,$player, TBL_PLAYERS.".Streak");

		// Find index of player
		$index = array_search($pid,$id);

		$prank_side_image = "";
		if($banned[$index]==1)
		{
			$rank = '<span title="'.EB_STATS_L33.'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/user_delete.ico" alt="'.EB_STATS_L34.'" title="'.EB_STATS_L34.'"/></span>';
			$prankdelta_string = "";
			$q_update = "UPDATE ".TBL_PLAYERS." SET Rank = 0 WHERE (PlayerID = '$pid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		elseif($OverallScore[$index] <= $OverallScoreThreshold)
		{
			$rank = '<span title="'.EB_STATS_L35.'">'.EB_STATS_L36.'</span>';
			$prankdelta_string = "";
			$q_update = "UPDATE ".TBL_PLAYERS." SET Rank = 0 WHERE (PlayerID = '$pid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);
		}
		else
		{
			$rank = $ranknumber;
			$ranknumber++; // increases $ranknumber by 1
			$q_update = "UPDATE ".TBL_PLAYERS." SET Rank = $rank WHERE (PlayerID = '$pid') AND (Event = '$event_id')";
			$result_update = $sql->db_Query($q_update);

			$new_rankdelta = $prank - $rank;
			if ($new_rankdelta != 0)
			{
				$prankdelta += $new_rankdelta;
				$q_update = "UPDATE ".TBL_PLAYERS." SET RankDelta = $prankdelta WHERE (PlayerID = '$pid') AND (Event = '$event_id')";
				$result_update = $sql->db_Query($q_update);
			}

			if (($new_rankdelta != 0)&&($rank==1)&&($competition_type == 'Ladder'))
			{
				// Award: player took 1st place
				$q_Awards = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
				VALUES ($pid,'PlayerTookFirstPlace',$time)";
				$result_Awards = $sql->db_Query($q_Awards);
			}
			if (($new_rankdelta != 0)&&(($prank>10)||($prank==0))&&($rank<=10)&&($competition_type == 'Ladder'))
			{
				// Award: player enters top 10
				$q_Awards = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
				VALUES ($pid,'PlayerInTopTen',$time)";
				$result_Awards = $sql->db_Query($q_Awards);
			}

			$q_Awards = "SELECT ".TBL_AWARDS.".*, "
			.TBL_PLAYERS.".*"
			." FROM ".TBL_AWARDS.", "
			.TBL_PLAYERS
			." WHERE (".TBL_AWARDS.".Player = ".TBL_PLAYERS.".PlayerID)"
			." AND (".TBL_PLAYERS.".PlayerID = '$pid')"
			." ORDER BY ".TBL_AWARDS.".timestamp DESC";
			$result_Awards = $sql->db_Query($q_Awards);
			$numAwards = mysql_numrows($result_Awards);
			if ($numAwards > 0)
			{
				$paward  = mysql_result($result_Awards,0, TBL_AWARDS.".AwardID");
				$pawardType  = mysql_result($result_Awards,0, TBL_AWARDS.".Type");
			}

			if ($rank==1)
			{
				$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/award_star_gold_3.png" alt="'.EB_AWARD_L3.'" title="'.EB_AWARD_L3.'"/>';
			}
			else if (($rank<=10)&&(($rank+$prankdelta>min(10,$numPlayers))||($rank+$prankdelta==0)))
			{
				$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/award_star_bronze_3.png" alt="'.EB_AWARD_L5.'" title="'.EB_AWARD_L5.'"/>';
			}
			else if (($numAwards>0)&&($pawardType!='PlayerTookFirstPlace')&&($pawardType!='PlayerInTopTen')&&($pstreak>=5))
			{
				switch ($pawardType)
				{
				case 'PlayerStreak5':
					if ($pstreak>=5)
					{
						$award = EB_AWARD_L6;
						$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_bronze_3.png" alt="'.EB_AWARD_L7.'" title="'.EB_AWARD_L7.'"/>';
					}
					break;
				case 'PlayerStreak10':
					if ($pstreak>=10)
					{
						$award = EB_AWARD_L8;
						$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_silver_3.png" alt="'.EB_AWARD_L9.'" title="'.EB_AWARD_L9.'"/>';
					}
					break;
				case 'PlayerStreak25':
					if ($pstreak>=25)
					{
						$award = EB_AWARD_L10;
						$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/awards/medal_gold_3.png" alt="'.EB_AWARD_L11.'" title="'.EB_AWARD_L11.'"/>';
					}
					break;
				}
			}
			else if ($prankdelta>0)
			{
				$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_up.gif" alt="+'.$prankdelta.'" title="+'.$prankdelta.'"/>';
			}
			else if (($prankdelta<0)&&($rank+$prankdelta!=0))
			{
				$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_down.gif" alt="'.$prankdelta.'" title="'.$prankdelta.'"/>';
			}
			else if ($rank+$prankdelta==0)
			{
				$prank_side_image = '<img class="eb_image" src="'.e_PLUGIN.'ebattles/images/arrow_up.gif" alt="Up" title="'.EB_STATS_L37.'"/>';
			}
		}

		list($pclan, $pclantag, $pclanid) = getClanInfo($team[$index]);

		if(strcmp(USERID,$puid) == 0)
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

		$stats_row[] = "<b>$rank</b> $prank_side_image";


		$image = "";
		if ($pref['eb_avatar_enable_playersstandings'] == 1)
		{
			if($avatar[$index])
			{
				$image = '<img '.getAvatarResize(avatar($avatar[$index])).'/>';
			} else if ($pref['eb_avatar_default_image'] != ''){
				$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_image'], 'avatars')).'/>';
			}
		}

		$stats_row[] = $image.'&nbsp;<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$uid[$index].'"><b>'.$pclantag.$name[$index].'</b></a>';

		// user rating not shown
		//$stats_row[] = $rating[$index];

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
		$challenge_text = ' <a href="javascript:challenge_player_js(\''.$pid.'\');" title="'.EB_CHALLENGE_L1.' '.$pclantag.$name[$index].'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/challenge.png" alt="'.EB_CHALLENGE_L1.' '.$pclantag.$name[$index].'"/></a>';
		$stats_row[] = $challenge_text;
		
		$stats[] = $stats_row;
	}

	/*
	// debug print array
	print_r($stats);
	print_r($stat_score);
	echo "<br>";
	print_r($ranks);
	*/

	if ($serialize)
	{
		// Serialize results array
		$OUTPUT = serialize($stats);
		$fp = fopen($file,"w"); // open file with Write permission

		if ($fp == FALSE) {
			// handle error
			$error .= EB_STATS_L38;
			echo $error;
			exit();
		}

		fputs($fp, $OUTPUT);
		fclose($fp);
		/*
		$stats = unserialize(implode('',file($file)));
		foreach ($stats as $id=>$row)
		{
		print $row['category_name']."<br />";
		}
		*/
	}
}
?>
