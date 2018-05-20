<?php
// functions for matchs score updates.
//___________________________________________________________________
require_once(e_PLUGIN.'ebattles/include/ELO.php');
require_once(e_PLUGIN.'ebattles/include/trueskill.php');
require_once(e_PLUGIN.'ebattles/include/glicko2.php');
require_once(e_PLUGIN.'ebattles/include/event.php');
require_once(e_PLUGIN.'ebattles/include/event.php');
require_once(e_HANDLER."avatar_handler.php");

class Match extends DatabaseTable
{
	protected $tablename = TBL_MATCHS;
	protected $primary_key = "MatchID";

	/***************************************************************************************
	Functions
	***************************************************************************************/
	function match_scores_update()
	{
		global $sql;

		// Get event info
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);

		// Initialize scores ELO/TrueSkill/Glicko2
		$deltaELO = 0;
		$deltaTS_mu = 0;
		$deltaTS_sigma = 1;
		$deltaG2_mu = 0;
		$deltaG2_phi = 1;
		$deltaG2_sigma = 1;
		$G2_r0 = $event->getField('G2_default_r');
		$q = "UPDATE ".TBL_SCORES
		." SET Player_deltaELO = '".floatToSQL($deltaELO)."',"
		."     Player_deltaTS_mu = '".floatToSQL($deltaTS_mu)."',"
		."     Player_deltaTS_sigma = '".floatToSQL($deltaTS_sigma)."',"
		."     Player_deltaG2_mu = '".floatToSQL($deltaG2_mu)."',"
		."     Player_deltaG2_phi = '".floatToSQL($deltaG2_phi)."',"
		."     Player_deltaG2_sigma = '".floatToSQL($deltaG2_sigma)."',"
		."     Player_Win = 0,"
		."     Player_Draw = 0,"
		."     Player_Loss = 0,"
		."     Player_Points = 0"
		." WHERE (MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);

		// Calculate number of players and teams for the match
		$q = "SELECT DISTINCT ".TBL_SCORES.".Player_MatchTeam"
		." FROM ".TBL_SCORES
		." WHERE (".TBL_SCORES.".MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);
		$nbr_teams = mysql_numrows($result);

		if ($nbr_teams != 0)
		{
			// Update scores ELO and TS
			for($i=1;$i<=$nbr_teams-1;$i++)
			{
				for($j=($i+1);$j<=$nbr_teams;$j++)
				{
					$output .= "Team $i vs. Team $j<br />";

					switch($event->getMatchPlayersType())
					{
					case 'Players':
						$q = "SELECT ".TBL_MATCHS.".*, "
						.TBL_SCORES.".*, "
						.TBL_PLAYERS.".*"
						." FROM ".TBL_MATCHS.", "
						.TBL_SCORES.", "
						.TBL_PLAYERS
						." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
						." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
						." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
						." AND (".TBL_SCORES.".Player_MatchTeam = '$i')";
						$resultA = $sql->db_Query($q);

						$q = "SELECT ".TBL_MATCHS.".*, "
						.TBL_SCORES.".*, "
						.TBL_PLAYERS.".*"
						." FROM ".TBL_MATCHS.", "
						.TBL_SCORES.", "
						.TBL_PLAYERS
						." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
						." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
						." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
						." AND (".TBL_SCORES.".Player_MatchTeam = '$j')";
						$resultB = $sql->db_Query($q);

						$NbrPlayersTeamA = mysql_numrows($resultA);
						$teamA_Rank= mysql_result($resultA,0, TBL_SCORES.".Player_Rank");
						$teamA_Forfeit= mysql_result($resultA,0, TBL_SCORES.".Player_Forfeit");
						$teamA_ELO=0;
						$teamA_TS_mu=0;
						$teamA_TS_sigma2=0;
						$teamA_G2_r=0;
						$teamA_G2_RD2=0;
						$teamA_G2_sigma2=0;
						for ($k=0;$k<$NbrPlayersTeamA;$k++)
						{
							$teamA_ELO += mysql_result($resultA,$k, TBL_PLAYERS.".ELORanking");
							$teamA_TS_mu += mysql_result($resultA,$k, TBL_PLAYERS.".TS_mu");
							$teamA_TS_sigma2 += pow(mysql_result($resultA,$k, TBL_PLAYERS.".TS_sigma"),2);
							$teamA_G2_r += mysql_result($resultA,$k, TBL_PLAYERS.".G2_r");
							$teamA_G2_RD2 += pow(mysql_result($resultA,$k, TBL_PLAYERS.".G2_RD"),2);
							$teamA_G2_sigma2 += pow(mysql_result($resultA,$k, TBL_PLAYERS.".G2_sigma"),2);
						}
						$teamA_TS_sigma = sqrt($teamA_TS_sigma2);
						$teamA_G2_RD = sqrt($teamA_G2_RD2);
						$teamA_G2_sigma = sqrt($teamA_G2_sigma2);
						$teamA_G2_mu = g2_from_g1_rating($teamA_G2_r, $G2_r0, G2_qinv);
						$teamA_G2_phi = g2_from_g1_deviation($teamA_G2_RD, G2_qinv);
						
						$output .= "Team $i ELO: $teamA_ELO, rank: $teamA_Rank<br />";
						$output .= "Team $i TS: mu = $teamA_TS_mu, sigma= $teamA_TS_sigma<br />";
						$output .= "Team $i TS: mu = $teamA_TS_mu, sigma= $teamA_TS_sigma<br />";
						$output .= "Team $i G2: mu = $teamA_G2_mu, phi= $teamA_G2_phi, sigma= $teamA_G2_sigma<br />";

						$NbrPlayersTeamB = mysql_numrows($resultB);
						$teamB_Rank= mysql_result($resultB,0, TBL_SCORES.".Player_Rank");
						$teamB_Forfeit= mysql_result($resultB,0, TBL_SCORES.".Player_Forfeit");
						$teamB_ELO=0;
						$teamB_TS_mu=0;
						$teamB_TS_sigma2=0;
						$teamB_G2_r=0;
						$teamB_G2_RD2=0;
						$teamB_G2_sigma2=0;
						for ($k=0;$k<$NbrPlayersTeamB;$k++)
						{
							$teamB_ELO += mysql_result($resultB,$k, TBL_PLAYERS.".ELORanking");
							$teamB_TS_mu += mysql_result($resultB,$k, TBL_PLAYERS.".TS_mu");
							$teamB_TS_sigma2 += pow(mysql_result($resultB,$k, TBL_PLAYERS.".TS_sigma"),2);
							$teamB_G2_r += mysql_result($resultB,$k, TBL_PLAYERS.".G2_r");
							$teamB_G2_RD2 += pow(mysql_result($resultB,$k, TBL_PLAYERS.".G2_RD"),2);
							$teamB_G2_sigma2 += pow(mysql_result($resultB,$k, TBL_PLAYERS.".G2_sigma"),2);
						}
						$teamB_TS_sigma = sqrt($teamB_TS_sigma2);
						$teamB_G2_RD = sqrt($teamB_G2_RD2);
						$teamB_G2_sigma = sqrt($teamB_G2_sigma2);
						$teamB_G2_mu = g2_from_g1_rating($teamB_G2_r, $G2_r0, G2_qinv);
						$teamB_G2_phi = g2_from_g1_deviation($teamB_G2_RD, G2_qinv);
						$output .= "Team $j ELO: $teamB_ELO, rank: $teamB_Rank<br />";
						$output .= "Team $j TS: mu = $teamB_TS_mu, sigma= $teamB_TS_sigma<br />";
						$output .= "Team $j G2: mu = $teamB_G2_mu, phi= $teamB_G2_phi, sigma= $teamB_G2_sigma<br />";
						break;
					case 'Teams':
						$q = "SELECT ".TBL_MATCHS.".*, "
						.TBL_SCORES.".*, "
						.TBL_TEAMS.".*"
						." FROM ".TBL_MATCHS.", "
						.TBL_SCORES.", "
						.TBL_TEAMS
						." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
						." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
						." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
						." AND (".TBL_SCORES.".Player_MatchTeam = '$i')";
						$resultA = $sql->db_Query($q);

						$q = "SELECT ".TBL_MATCHS.".*, "
						.TBL_SCORES.".*, "
						.TBL_TEAMS.".*"
						." FROM ".TBL_MATCHS.", "
						.TBL_SCORES.", "
						.TBL_TEAMS
						." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
						." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
						." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
						." AND (".TBL_SCORES.".Player_MatchTeam = '$j')";
						$resultB = $sql->db_Query($q);

						$NbrPlayersTeamA = mysql_numrows($resultA);
						$teamA_Rank= mysql_result($resultA,0, TBL_SCORES.".Player_Rank");
						$teamA_Forfeit= mysql_result($resultA,0, TBL_SCORES.".Player_Forfeit");
						$teamA_ELO=0;
						$teamA_TS_mu=0;
						$teamA_TS_sigma2=0;
						$teamA_G2_r=0;
						$teamA_G2_RD2=0;
						$teamA_G2_sigma2=0;
						for ($k=0;$k<$NbrPlayersTeamA;$k++)
						{
							$teamA_ELO += mysql_result($resultA,$k, TBL_TEAMS.".ELORanking");
							$teamA_TS_mu += mysql_result($resultA,$k, TBL_TEAMS.".TS_mu");
							$teamA_TS_sigma2 += pow(mysql_result($resultA,$k, TBL_TEAMS.".TS_sigma"),2);
							$teamA_G2_r += mysql_result($resultA,$k, TBL_TEAMS.".G2_r");
							$teamA_G2_RD2 += pow(mysql_result($resultA,$k, TBL_TEAMS.".G2_RD"),2);
							$teamA_G2_sigma2 += pow(mysql_result($resultA,$k, TBL_TEAMS.".G2_sigma"),2);
						}
						$teamA_TS_sigma = sqrt($teamA_TS_sigma2);
						$teamA_G2_RD = sqrt($teamA_G2_RD2);
						$teamA_G2_sigma = sqrt($teamA_G2_sigma2);
						$teamA_G2_mu = g2_from_g1_rating($teamA_G2_r, $G2_r0, G2_qinv);
						$teamA_G2_phi = g2_from_g1_deviation($teamA_G2_RD, G2_qinv);						
						$output .= "Team $i ELO: $teamA_ELO, rank: $teamA_Rank<br />";
						$output .= "Team $i TS: mu = $teamA_TS_mu, sigma= $teamA_TS_sigma<br />";
						$output .= "Team $i G2: mu = $teamA_G2_mu, phi= $teamA_G2_phi, sigma= $teamA_G2_sigma<br />";
						
						$NbrPlayersTeamB = mysql_numrows($resultB);
						$teamB_Rank= mysql_result($resultB,0, TBL_SCORES.".Player_Rank");
						$teamB_Forfeit= mysql_result($resultB,0, TBL_SCORES.".Player_Forfeit");
						$teamB_ELO=0;
						$teamB_TS_mu=0;
						$teamB_TS_sigma2=0;
						$teamB_G2_r=0;
						$teamB_G2_RD2=0;
						$teamB_G2_sigma2=0;
						for ($k=0;$k<$NbrPlayersTeamB;$k++)
						{
							$teamB_ELO += mysql_result($resultB,$k, TBL_TEAMS.".ELORanking");
							$teamB_TS_mu += mysql_result($resultB,$k, TBL_TEAMS.".TS_mu");
							$teamB_TS_sigma2 += pow(mysql_result($resultB,$k, TBL_TEAMS.".TS_sigma"),2);
							$teamB_G2_r += mysql_result($resultB,$k, TBL_TEAMS.".G2_r");
							$teamB_G2_RD2 += pow(mysql_result($resultB,$k, TBL_TEAMS.".G2_RD"),2);
							$teamB_G2_sigma2 += pow(mysql_result($resultB,$k, TBL_TEAMS.".G2_sigma"),2);
						}
						$teamB_TS_sigma = sqrt($teamB_TS_sigma2);
						$teamB_G2_RD = sqrt($teamB_G2_RD2);
						$teamB_G2_sigma = sqrt($teamB_G2_sigma2);
						$teamB_G2_mu = g2_from_g1_rating($teamB_G2_r, $G2_r0, G2_qinv);
						$teamB_G2_phi = g2_from_g1_deviation($teamB_G2_RD, G2_qinv);
						$output .= "Team $j ELO: $teamB_ELO, rank: $teamB_Rank<br />";
						$output .= "Team $j TS: mu = $teamB_TS_mu, sigma= $teamB_TS_sigma<br />";
						$output .= "Team $j G2: mu = $teamB_G2_mu, phi= $teamB_G2_phi, sigma= $teamB_G2_sigma<br />";
						break;
					default:
					}

					$teamA_win = 0;
					$teamA_loss = 0;
					$teamA_draw = 0;
					$teamB_win = 0;
					$teamB_loss = 0;
					$teamB_draw = 0;
					// Wins/Losses/Draws
					if($teamA_Rank < $teamB_Rank)
					{
						$teamA_win = 1;
						$teamB_loss = 1;
					}
					else if ($teamA_Rank > $teamB_Rank)
					{
						$teamA_loss = 1;
						$teamB_win = 1;
					}
					else
					{
						$teamA_draw = 1;
						$teamB_draw = 1;
					}

					/* Forfeit */
					$teamA_fwin  = 0;
					$teamA_floss = 0;
					$teamB_fwin  = 0;
					$teamB_floss = 0;
					if($event->getField('AllowForfeit')==1)
					{
						if($teamA_Forfeit == 1)
						{
							$teamA_floss = 1;
							$teamB_fwin = 1;
							$teamA_loss = 0;
							$teamB_win = 0;
						}
						else if ($teamB_Forfeit == 1)
						{
							$teamB_floss = 1;
							$teamA_fwin = 1;
							$teamB_loss = 0;
							$teamA_win = 0;
						}
					}

					$teamA_Points = $teamA_win*$event->getField('PointsPerWin') + $teamA_draw*$event->getField('PointsPerDraw') + $teamA_loss*$event->getField('PointsPerLoss') + $teamA_fwin*$event->getField('ForfeitWinPoints') + $teamA_floss*$event->getField('ForfeitLossPoints');
					$teamB_Points = $teamB_win*$event->getField('PointsPerWin') + $teamB_draw*$event->getField('PointsPerDraw') + $teamB_loss*$event->getField('PointsPerLoss') + $teamB_fwin*$event->getField('ForfeitWinPoints') + $teamB_floss*$event->getField('ForfeitLossPoints');
					$output .= "Team A: $teamA_Points, $teamA_win, $teamA_draw, $teamA_loss, <br />";
					$output .= "Team B: $teamB_Points, $teamB_win, $teamB_draw, $teamB_loss, <br />";

					if ($event->getField('ForfeitWinLossUpdate') == 1)
					{
						$teamA_win += $teamA_fwin;
						$teamB_win += $teamB_fwin;
						$teamA_loss += $teamA_floss;
						$teamB_loss += $teamB_floss;
					}

					// New ELO ------------------------------------------
					$M=min($NbrPlayersTeamA,$NbrPlayersTeamB)*$event->getField('ELO_M');      // Span
					$K=$event->getField('ELO_K');	// Max adjustment per game
					if (($teamA_Forfeit == 1)||($teamB_Forfeit == 1))
					{
						$deltaELO=0;
					}
					else
					{
						$deltaELO = ELO($M, $K, $teamA_ELO, $teamB_ELO, $teamA_Rank, $teamB_Rank);
					}
					$output .= "deltaELO: $deltaELO<br />";

					// New TrueSkill ------------------------------------------
					$beta=$event->getField('TS_beta');          // beta
					$epsilon=$event->getField('TS_epsilon');    // draw probability
					$tau=$event->getField('TS_tau');        // dynamics factor
					if (($teamA_Forfeit == 1)||($teamB_Forfeit == 1))
					{
						$update = array(0,1,0,1);
					}
					else
					{
						$update = Trueskill_update($epsilon, $beta, $tau, $teamA_TS_mu, $teamA_TS_sigma, $teamA_Rank, $teamB_TS_mu, $teamB_TS_sigma, $teamB_Rank);
					}

					$teamA_deltaTS_mu = $update[0];
					$teamA_deltaTS_sigma = $update[1];
					$teamB_deltaTS_mu = $update[2];
					$teamB_deltaTS_sigma = $update[3];
					$output .= "Team $i TS: delta mu = $teamA_deltaTS_mu, delta sigma= $teamA_deltaTS_sigma<br />";
					$output .= "Team $j TS: delta mu = $teamB_deltaTS_mu, delta sigma= $teamB_deltaTS_sigma<br />";

					// New Glicko 2 ------------------------------------------
					$epsilon=$event->getField('G2_epsilon');    // 
					$tau=$event->getField('G2_tau');            // volatility variance
					if (($teamA_Forfeit == 1)||($teamB_Forfeit == 1))
					{
						$update_A = array(0,1,1,0,1,1);
						$update_B = array(0,1,1,0,1,1);
					}
					else
					{
						$update_A = glicko2_update($teamA_G2_mu, $teamA_G2_phi, $teamA_G2_sigma, $teamA_Rank, $teamB_G2_mu, $teamB_G2_phi, $teamB_G2_sigma, $teamB_Rank, $tau, $epsilon);
						$update_B = glicko2_update($teamB_G2_mu, $teamB_G2_phi, $teamB_G2_sigma, $teamB_Rank, $teamA_G2_mu, $teamA_G2_phi, $teamA_G2_sigma, $teamA_Rank, $tau, $epsilon);
					}
					$teamA_deltaG2_mu = $update_A[0];
					$teamA_deltaG2_phi = $update_A[1];
					$teamA_deltaG2_sigma = $update_A[2];
					$teamB_deltaG2_mu = $update_B[0];
					$teamB_deltaG2_phi = $update_B[1];
					$teamB_deltaG2_sigma = $update_B[2];
					$output .= "Team $i G2: delta mu = $teamA_deltaG2_mu, delta phi= $teamA_deltaG2_phi, delta sigma= $teamA_deltaG2_sigma<br />";
					$output .= "Team $j G2: delta mu = $teamB_deltaG2_mu, delta phi= $teamB_deltaG2_phi, delta sigma= $teamB_deltaG2_sigma<br />";					

					// Update Scores ------------------------------------------
					for ($k=0;$k<$NbrPlayersTeamA;$k++)
					{
						$scoreELO = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaELO");
						$scoreTS_mu = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaTS_mu");
						$scoreTS_sigma = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaTS_sigma");
						$scoreG2_mu = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaG2_mu");
						$scoreG2_phi = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaG2_phi");
						$scoreG2_sigma = mysql_result($resultA,$k, TBL_SCORES.".Player_deltaG2_sigma");
						$scoreWin = mysql_result($resultA,$k, TBL_SCORES.".Player_Win");
						$scoreDraw = mysql_result($resultA,$k, TBL_SCORES.".Player_Draw");
						$scoreLoss = mysql_result($resultA,$k, TBL_SCORES.".Player_Loss");
						$scorePoints = mysql_result($resultA,$k, TBL_SCORES.".Player_Points");

						$scoreELO += $deltaELO/$NbrPlayersTeamA;
						$scoreTS_mu += $teamA_deltaTS_mu/$NbrPlayersTeamA;
						$scoreTS_sigma *= $teamA_deltaTS_sigma;
						$scoreG2_mu += $teamA_deltaG2_mu/$NbrPlayersTeamA;
						$scoreG2_phi *= $teamA_deltaG2_phi;
						$scoreG2_sigma *= $teamA_deltaG2_sigma;
						$scoreWin += $teamA_win;
						$scoreDraw += $teamA_draw;
						$scoreLoss += $teamA_loss;
						$scorePoints += $teamA_Points;

						switch($event->getMatchPlayersType())
						{
						case 'Players':
							$pid = mysql_result($resultA,$k, TBL_PLAYERS.".PlayerID");
							$q = "UPDATE ".TBL_SCORES
							." SET Player_deltaELO = '".floatToSQL($scoreELO)."',"
							."     Player_deltaTS_mu = '".floatToSQL($scoreTS_mu)."',"
							."     Player_deltaTS_sigma = '".floatToSQL($scoreTS_sigma)."',"
							."     Player_deltaG2_mu = '".floatToSQL($scoreG2_mu)."',"
							."     Player_deltaG2_phi = '".floatToSQL($scoreG2_phi)."',"
							."     Player_deltaG2_sigma = '".floatToSQL($scoreG2_sigma)."',"
							."     Player_Win = $scoreWin,"
							."     Player_Draw = $scoreDraw,"
							."     Player_Loss = $scoreLoss,"
							."     Player_Points = $scorePoints"
							." WHERE (MatchID = '".$this->fields['MatchID']."')"
							."   AND (Player = '$pid')";
							break;
						case 'Teams':
							$pid = mysql_result($resultA,$k, TBL_TEAMS.".TeamID");
							$q = "UPDATE ".TBL_SCORES
							." SET Player_deltaELO = '".floatToSQL($scoreELO)."',"
							."     Player_deltaTS_mu = '".floatToSQL($scoreTS_mu)."',"
							."     Player_deltaTS_sigma = '".floatToSQL($scoreTS_sigma)."',"
							."     Player_deltaG2_mu = '".floatToSQL($scoreG2_mu)."',"
							."     Player_deltaG2_phi = '".floatToSQL($scoreG2_phi)."',"
							."     Player_deltaG2_sigma = '".floatToSQL($scoreG2_sigma)."',"
							."     Player_Win = $scoreWin,"
							."     Player_Draw = $scoreDraw,"
							."     Player_Loss = $scoreLoss,"
							."     Player_Points = $scorePoints"
							." WHERE (MatchID = '".$this->fields['MatchID']."')"
							."   AND (Team = '$pid')";
							break;
						default:
						}
						$result = $sql->db_Query($q);
						$output .= "team A, Player $pid query: $q<br />";
					}
					for ($k=0;$k<$NbrPlayersTeamB;$k++)
					{
						$scoreELO = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaELO");
						$scoreTS_mu = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaTS_mu");
						$scoreTS_sigma = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaTS_sigma");
						$scoreG2_mu = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaG2_mu");
						$scoreG2_phi = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaG2_phi");
						$scoreG2_sigma = mysql_result($resultB,$k, TBL_SCORES.".Player_deltaG2_sigma");
						$scoreWin = mysql_result($resultB,$k, TBL_SCORES.".Player_Win");
						$scoreDraw = mysql_result($resultB,$k, TBL_SCORES.".Player_Draw");
						$scoreLoss = mysql_result($resultB,$k, TBL_SCORES.".Player_Loss");
						$scorePoints = mysql_result($resultB,$k, TBL_SCORES.".Player_Points");

						$scoreELO -= $deltaELO/$NbrPlayersTeamB;
						$scoreTS_mu += $teamB_deltaTS_mu/$NbrPlayersTeamB;
						$scoreTS_sigma *= $teamB_deltaTS_sigma;
						$scoreG2_mu += $teamB_deltaG2_mu/$NbrPlayersTeamB;
						$scoreG2_phi *= $teamB_deltaG2_phi;
						$scoreG2_sigma *= $teamB_deltaG2_sigma;
						$scoreWin += $teamB_win;
						$scoreDraw += $teamB_draw;
						$scoreLoss += $teamB_loss;
						$scorePoints += $teamB_Points;

						switch($event->getMatchPlayersType())
						{
						case 'Players':
							$pid = mysql_result($resultB,$k, TBL_PLAYERS.".PlayerID");
							$q = "UPDATE ".TBL_SCORES
							." SET Player_deltaELO = '".floatToSQL($scoreELO)."',"
							."     Player_deltaTS_mu = '".floatToSQL($scoreTS_mu)."',"
							."     Player_deltaTS_sigma = '".floatToSQL($scoreTS_sigma)."',"
							."     Player_deltaG2_mu = '".floatToSQL($scoreG2_mu)."',"
							."     Player_deltaG2_phi = '".floatToSQL($scoreG2_phi)."',"
							."     Player_deltaG2_sigma = '".floatToSQL($scoreG2_sigma)."',"
							."     Player_Win = $scoreWin,"
							."     Player_Draw = $scoreDraw,"
							."     Player_Loss = $scoreLoss,"
							."     Player_Points = $scorePoints"
							." WHERE (MatchID = '".$this->fields['MatchID']."')"
							."   AND (Player = '$pid')";
							break;
						case 'Teams':
							$tid = mysql_result($resultB,$k, TBL_TEAMS.".TeamID");
							$q = "UPDATE ".TBL_SCORES
							." SET Player_deltaELO = '".floatToSQL($scoreELO)."',"
							."     Player_deltaTS_mu = '".floatToSQL($scoreTS_mu)."',"
							."     Player_deltaTS_sigma = '".floatToSQL($scoreTS_sigma)."',"
							."     Player_deltaG2_mu = '".floatToSQL($scoreG2_mu)."',"
							."     Player_deltaG2_phi = '".floatToSQL($scoreG2_phi)."',"
							."     Player_deltaG2_sigma = '".floatToSQL($scoreG2_sigma)."',"
							."     Player_Win = $scoreWin,"
							."     Player_Draw = $scoreDraw,"
							."     Player_Loss = $scoreLoss,"
							."     Player_Points = $scorePoints"
							." WHERE (MatchID = '".$this->fields['MatchID']."')"
							." AND (Team = '$tid')";
							break;
						default:
						}
						$result = $sql->db_Query($q);
					}
				}
			}
			$output .= '<br />';

			// Update scores score against
			switch($event->getMatchPlayersType())
			{
			case 'Players':
				$q =
				"SELECT ".TBL_SCORES.".*, "
				.TBL_PLAYERS.".*"
				." FROM ".TBL_SCORES.", "
				.TBL_PLAYERS
				." WHERE (".TBL_SCORES.".MatchID = '".$this->fields['MatchID']."')"
				."   AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
				break;
			case 'Teams':
				$q =
				"SELECT ".TBL_SCORES.".*, "
				.TBL_TEAMS.".*"
				." FROM ".TBL_SCORES.", "
				.TBL_TEAMS
				." WHERE (".TBL_SCORES.".MatchID = '".$this->fields['MatchID']."')"
				."   AND (".TBL_SCORES.".Team = ".TBL_TEAMS.".TeamID)";
				break;
			default:
			}

			$result = $sql->db_Query($q);
			$nbr_players = mysql_numrows($result);
			for($i=0;$i<$nbr_players;$i++)
			{
				switch($event->getMatchPlayersType())
				{
				case 'Players':
					$pid= mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
					break;
				case 'Teams':
					$pid= mysql_result($result,$i, TBL_TEAMS.".TeamID");
					break;
				default:
				}
				$scoreid= mysql_result($result,$i, TBL_SCORES.".ScoreID");
				$prank= mysql_result($result,$i, TBL_SCORES.".Player_Rank");
				$pteam= mysql_result($result,$i, TBL_SCORES.".Player_MatchTeam");
				$pOppScore = 0;
				$pnbrOpps = 0;

				for($j=0;$j<$nbr_players;$j++)
				{
					$opprank= mysql_result($result,$j, TBL_SCORES.".Player_Rank");
					$oppteam= mysql_result($result,$j, TBL_SCORES.".Player_MatchTeam");
					$oppscore= mysql_result($result,$j, TBL_SCORES.".Player_Score");

					if ($pteam != $oppteam)
					{
						$pOppScore += $oppscore;
						$pnbrOpps ++;
					}
				}
				$pOppScore /= $pnbrOpps;

				switch($event->getMatchPlayersType())
				{
				case 'Players':
					$q_1 = "UPDATE ".TBL_SCORES
					." SET Player_ScoreAgainst = $pOppScore"
					." WHERE (MatchID = '".$this->fields['MatchID']."')"
					." AND (Player = '$pid')";
					break;
				case 'Teams':
					$q_1 = "UPDATE ".TBL_SCORES
					." SET Player_ScoreAgainst = $pOppScore"
					." WHERE (MatchID = '".$this->fields['MatchID']."')"
					." AND (Team = '$pid')";
					break;
				default:
				}

				$result_1 = $sql->db_Query($q_1);
			}
			$output .= '<br />';
			//echo $output;
			//exit;
		}
	}

	function match_players_update()
	{
		global $sql;
		global $gold_obj;
		global $pref;

		// Get event info
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);
		$type = $event->getField('Type');
		$competition_type = $event->getCompetitionType();
		$G2_r0 = $event->getField('G2_default_r');

		// Update Teams with scores
		$tdeltaELO         = array();
		$tdeltaTS_mu       = array();
		$tdeltaTS_sigma    = array();
		$tdeltaG2_mu       = array();
		$tdeltaG2_phi      = array();
		$tdeltaG2_sigma    = array();
		$tdeltaGamesPlayed = array();
		$tdeltaWins        = array();
		$tdeltaDraws       = array();
		$tdeltaLosses      = array();
		$tdeltaScore       = array();
		$tdeltaOppScore    = array();
		$tdeltaPoints      = array();
		$tdeltaForfeits    = array();
		$tnbrPlayers       = array();

		$q = "SELECT DISTINCT ".TBL_PLAYERS.".Team"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".Team > 0)";
		$result_Teams = $sql->db_Query($q);

		$numTeams = mysql_numrows($result_Teams);
		for($team=0;$team<$numTeams;$team++)
		{
			$tid = mysql_result($result_Teams,$team, TBL_PLAYERS.".Team");

			$tdeltaELO[$tid] = 0;
			$tdeltaTS_mu[$tid] = 0;
			$tdeltaTS_sigma[$tid] = 0;
			$tdeltaG2_mu[$tid] = 0;
			$tdeltaG2_phi[$tid] = 0;
			$tdeltaG2_sigma[$tid] = 0;
			$tdeltaGamesPlayed[$tid] = 0;
			$tdeltaWins[$tid] = 0;
			$tdeltaDraws[$tid] = 0;
			$tdeltaLosses[$tid] = 0;
			$tdeltaScore[$tid] = 0;
			$tdeltaOppScore[$tid] = 0;
			$tdeltaPoints[$tid] = 0;
			$tdeltaForfeits[$tid] = 0;
			$tnbrPlayers[$tid] = 0;
		}

		// Update Players with scores
		$q = "SELECT ".TBL_MATCHS.".*, "
		.TBL_SCORES.".*, "
		.TBL_PLAYERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS.", "
		.TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)";
		$result = $sql->db_Query($q);
		$numPlayers = mysql_numrows($result);
		for($i=0;$i < $numPlayers;$i++)
		{
			$time_reported = mysql_result($result,$i, TBL_MATCHS.".TimeReported");
			$mStatus       = mysql_result($result,$i, TBL_MATCHS.".Status");

			$pid           = mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
			$puid          = mysql_result($result,$i, TBL_USERS.".user_id");
			$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
			$gamer = new Gamer($gamer_id);
			$pName = $gamer->getField('Name');
			$pteam         = mysql_result($result,$i, TBL_PLAYERS.".Team");
			$pELO          = mysql_result($result,$i, TBL_PLAYERS.".ELORanking");
			$pTS_mu        = mysql_result($result,$i, TBL_PLAYERS.".TS_mu");
			$pTS_sigma     = mysql_result($result,$i, TBL_PLAYERS.".TS_sigma");
			$pG2_r         = mysql_result($result,$i, TBL_PLAYERS.".G2_r");
			$pG2_RD        = mysql_result($result,$i, TBL_PLAYERS.".G2_RD");
			$pG2_sigma     = mysql_result($result,$i, TBL_PLAYERS.".G2_sigma");
			$pG2_mu        = g2_from_g1_rating($pG2_r, $G2_r0, G2_qinv);
			$pG2_phi       = g2_from_g1_deviation($pG2_RD, G2_qinv);
			$pGamesPlayed  = mysql_result($result,$i, TBL_PLAYERS.".GamesPlayed");
			$pWins         = mysql_result($result,$i, TBL_PLAYERS.".Win");
			$pDraws        = mysql_result($result,$i, TBL_PLAYERS.".Draw");
			$pLosses       = mysql_result($result,$i, TBL_PLAYERS.".Loss");
			$pStreak       = mysql_result($result,$i, TBL_PLAYERS.".Streak");
			$pStreak_Best  = mysql_result($result,$i, TBL_PLAYERS.".Streak_Best");
			$pStreak_Worst = mysql_result($result,$i, TBL_PLAYERS.".Streak_Worst");
			$pScore        = mysql_result($result,$i, TBL_PLAYERS.".Score");
			$pOppScore     = mysql_result($result,$i, TBL_PLAYERS.".ScoreAgainst");
			$pPoints       = mysql_result($result,$i, TBL_PLAYERS.".Points");
			$pForfeits     = mysql_result($result,$i, TBL_PLAYERS.".Forfeits");

			$scoreid           = mysql_result($result,$i, TBL_SCORES.".ScoreID");
			$pdeltaELO         = mysql_result($result,$i, TBL_SCORES.".Player_deltaELO");
			$pdeltaTS_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_mu");
			$pdeltaTS_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_sigma");
			$pdeltaG2_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_mu");
			$pdeltaG2_phi      = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_phi");
			$pdeltaG2_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_sigma");
			$pdeltaGamesPlayed = 1;
			$pdeltaWins        = mysql_result($result,$i, TBL_SCORES.".Player_Win");
			$pdeltaDraws       = mysql_result($result,$i, TBL_SCORES.".Player_Draw");
			$pdeltaLosses      = mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			$pdeltaScore       = mysql_result($result,$i, TBL_SCORES.".Player_Score");
			$pdeltaOppScore    = mysql_result($result,$i, TBL_SCORES.".Player_ScoreAgainst");
			$pdeltaPoints      = mysql_result($result,$i, TBL_SCORES.".Player_Points");
			$pdeltaForfeits    = mysql_result($result,$i, TBL_SCORES.".Player_Forfeit");
			
			$pELO         += $pdeltaELO;
			$pTS_mu       += $pdeltaTS_mu;
			$pTS_sigma    *= $pdeltaTS_sigma;
			$pG2_mu       += $pdeltaG2_mu;
			$pG2_phi      *= $pdeltaG2_phi;
			$pG2_sigma    *= $pdeltaG2_sigma;
			$pG2_r         = g2_to_g1_rating($pG2_mu, $G2_r0, G2_qinv);
			$pG2_RD        = g2_to_g1_deviation($pG2_phi, G2_qinv);
			$pGamesPlayed += $pdeltaGamesPlayed;
			$pWins        += $pdeltaWins;
			$pDraws       += $pdeltaDraws;
			$pLosses      += $pdeltaLosses;
			$pScore       += $pdeltaScore;
			$pOppScore    += $pdeltaOppScore;
			$pPoints      += $pdeltaPoints;
			$pForfeits    += $pdeltaForfeits;

			if ($pteam != 0)
			{
				$tdeltaELO[$pteam]         += $pdeltaELO;
				$tdeltaTS_mu[$pteam]       += $pdeltaTS_mu;
				$tdeltaTS_sigma[$pteam]    += $pdeltaTS_sigma;
				$tdeltaG2_mu[$pteam]       += $pdeltaG2_mu;
				$tdeltaG2_phi[$pteam]      += $pdeltaG2_phi;
				$tdeltaG2_sigma[$pteam]    += $pdeltaG2_sigma;
				$tdeltaGamesPlayed[$pteam] += 1;
				$tdeltaWins[$pteam]        += $pdeltaWins;
				$tdeltaDraws[$pteam]       += $pdeltaDraws;
				$tdeltaLosses[$pteam]      += $pdeltaLosses;
				$tdeltaScore[$pteam]       += $pdeltaScore;
				$tdeltaOppScore[$pteam]    += $pdeltaOppScore;
				$tdeltaPoints[$pteam]      += $pdeltaPoints;
				$tdeltaForfeits[$pteam]    += $pdeltaForfeits;
				$tnbrPlayers[$pteam]       += 1;
			}

			$output .= "Player: $pName - $pid, new ELO: $pELO<br />";
			$output .= "Games played: $pGamesPlayed<br>";
			$output .= "Match id: ".$this->fields['MatchID']."<br />";

			$gain = mysql_result($result,$i, TBL_SCORES.".Player_Win") - mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			if ($gain * $pStreak >= 0)
			{
				// same sign
				$pStreak += $gain;
			}
			else
			{
				// opposite sign
				$pStreak = $gain;
			}

			if ($pStreak > $pStreak_Best) $pStreak_Best = $pStreak;
			if ($pStreak < $pStreak_Worst) $pStreak_Worst = $pStreak;

			if($competition_type == 'Ladder')
			{
				if ($pStreak == 5)
				{
					// Award: player wins 5 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
					VALUES ($pid,'PlayerStreak5',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
				if ($pStreak == 10)
				{
					// Award: player wins 10 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
					VALUES ($pid,'PlayerStreak10',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
				if ($pStreak == 25)
				{
					// Award: player wins 25 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Player,Type,timestamp)
					VALUES ($pid,'PlayerStreak25',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
			}

			// Update database.
			// Reset rank delta after a match.
			$q_3 = "UPDATE ".TBL_PLAYERS
			." SET ELORanking = '".floatToSQL($pELO)."',"
			."     TS_mu = '".floatToSQL($pTS_mu)."',"
			."     TS_sigma = '".floatToSQL($pTS_sigma)."',"
			."     G2_r = '".floatToSQL($pG2_r)."',"
			."     G2_RD = '".floatToSQL($pG2_RD)."',"
			."     G2_sigma = '".floatToSQL($pG2_sigma)."',"
			."     GamesPlayed = $pGamesPlayed,"
			."     Loss = $pLosses,"
			."     Win = $pWins,"
			."     Draw = $pDraws,"
			."     Score = $pScore,"
			."     ScoreAgainst = $pOppScore,"
			."     Points = $pPoints,"
			."     Forfeits = $pForfeits,"
			."     Streak = $pStreak,"
			."     Streak_Best = $pStreak_Best,"
			."     Streak_Worst = $pStreak_Worst,"
			."     RankDelta = 0"
			." WHERE (PlayerID = '$pid')";
			$result_3 = $sql->db_Query($q_3);
			
			// gold
			if(is_gold_system_active() && ($pref['eb_gold_playmatch'] > 0)) {												
				$gold_param['gold_user_id'] = $puid;
				$gold_param['gold_who_id'] = 0;
				$gold_param['gold_amount'] = $pref['eb_gold_playmatch'];
				$gold_param['gold_type'] = EB_L1;
				$gold_param['gold_action'] = "credit";
				$gold_param['gold_plugin'] = "ebattles";
				$gold_param['gold_log'] = EB_GOLD_L9.": event=".$event_id.", user=".$puid;
				$gold_param['gold_forum'] = 0;
				$gold_obj->gold_modify($gold_param);
			}
		}

		$q = "SELECT DISTINCT ".TBL_PLAYERS.".Team, "
		.TBL_TEAMS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS.", "
		.TBL_TEAMS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_TEAMS.".TeamID = ".TBL_PLAYERS.".Team)"
		." AND (".TBL_PLAYERS.".Team > 0)";
		$result_Teams = $sql->db_Query($q);

		$numTeams = mysql_numrows($result_Teams);
		for($team=0;$team<$numTeams;$team++)
		{
			$tid = mysql_result($result_Teams,$team, TBL_PLAYERS.".Team");

			$tPoints      = mysql_result($result_Teams,$team, TBL_TEAMS.".Points");
			$tForfeits    = mysql_result($result_Teams,$team, TBL_TEAMS.".Forfeits");
			$tELO         = mysql_result($result_Teams,$team, TBL_TEAMS.".ELORanking");
			$tTS_mu       = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_mu");
			$tTS_sigma    = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_sigma");
			$tG2_r        = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_r");
			$tG2_RD       = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_RD");
			$tG2_sigma    = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_sigma");
			$tG2_mu       = g2_from_g1_rating($tG2_r, $G2_r0, G2_qinv);
			$tG2_phi      = g2_from_g1_deviation($tG2_RD, G2_qinv);
			$tGamesPlayed = mysql_result($result_Teams,$team, TBL_TEAMS.".GamesPlayed");
			$tWins        = mysql_result($result_Teams,$team, TBL_TEAMS.".Win");
			$tDraws       = mysql_result($result_Teams,$team, TBL_TEAMS.".Draw");
			$tLosses      = mysql_result($result_Teams,$team, TBL_TEAMS.".Loss");
			$tScore       = mysql_result($result_Teams,$team, TBL_TEAMS.".Score");
			$tOppScore    = mysql_result($result_Teams,$team, TBL_TEAMS.".ScoreAgainst");

			$tdeltaELO[$tid]         /= $tnbrPlayers[$tid];
			$tdeltaTS_mu[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaTS_sigma[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaG2_mu[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaG2_phi[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaG2_sigma[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaGamesPlayed[$tid] /= $tnbrPlayers[$tid];
			$tdeltaWins[$tid]        /= $tnbrPlayers[$tid];
			$tdeltaDraws[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaLosses[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaScore[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaOppScore[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaPoints[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaForfeits[$tid]    /= $tnbrPlayers[$tid];

			$tELO         += $tdeltaELO[$tid];
			$tTS_mu       += $tdeltaTS_mu[$tid];
			$tTS_sigma    *= $tdeltaTS_sigma[$tid];
			$tG2_mu       += $tdeltaG2_mu[$tid];
			$tG2_phi      *= $tdeltaG2_phi[$tid];
			$tG2_sigma    *= $tdeltaG2_sigma[$tid];
			$tG2_r         = g2_to_g1_rating($tG2_mu, $G2_r0, G2_qinv);
			$tG2_RD        = g2_to_g1_deviation($tG2_phi, G2_qinv);
			$tGamesPlayed += $tdeltaGamesPlayed[$tid];
			$tWins        += $tdeltaWins[$tid];
			$tDraws       += $tdeltaDraws[$tid];
			$tLosses      += $tdeltaLosses[$tid];
			$tScore       += $tdeltaScore[$tid];
			$tOppScore    += $tdeltaOppScore[$tid];
			$tPoints      += $tdeltaPoints[$tid];
			$tForfeits    += $tdeltaForfeits[$tid];

			$output .= "Team: $tid<br />";
			$output .= "delta ELO: $tdeltaELO[$tid]<br />";
			$output .= "delta TS mu: $tdeltaTS_mu[$tid]<br />";
			$output .= "delta TS sigma: $tdeltaTS_sigma[$tid]<br />";
			$output .= "delta G2 mu: $tdeltaG2_mu[$tid]<br />";
			$output .= "delta G2 phi: $tdeltaG2_phi[$tid]<br />";
			$output .= "delta G2 sigma: $tdeltaG2_sigma[$tid]<br />";
			$output .= "Games played: $tdeltaGamesPlayed[$tid]<br />";
			$output .= "Match id: ".$this->fields['MatchID']."<br />";

			$q_update = "UPDATE ".TBL_TEAMS
			." SET ELORanking = '".floatToSQL($tELO)."',"
			."     TS_mu = '".floatToSQL($tTS_mu)."',"
			."     TS_sigma = '".floatToSQL($tTS_sigma)."',"
			."     G2_r = '".floatToSQL($tG2_r)."',"
			."     G2_RD = '".floatToSQL($tG2_RD)."',"
			."     G2_sigma = '".floatToSQL($tG2_sigma)."',"
			."     GamesPlayed = $tGamesPlayed,"
			."     Loss = $tLosses,"
			."     Win = $tWins,"
			."     Draw = $tDraws,"
			."     Score = $tScore,"
			."     ScoreAgainst = $tOppScore,"
			."     Points = $tPoints,"
			."     Forfeits = $tForfeits,"
			."     RankDelta = 0"
			." WHERE (TeamID = '$tid')";
			$result_update = $sql->db_Query($q_update);
		}

		$q = "UPDATE ".TBL_MATCHS." SET Status = 'active' WHERE (MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);

		//echo "$output";
		//exit;
	}

	function match_teams_update()
	{
		global $sql;

		// Get event info
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);
		$type = $event->getField('Type');
		$competition_type = $event->getCompetitionType();
		$G2_r0 = $event->getField('G2_default_r');

		// Update Teams with scores
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
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
		." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
		." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)";

		$result = $sql->db_Query($q);
		$numTeams = mysql_numrows($result);
		for($i=0;$i < $numTeams;$i++)
		{
			$time_reported = mysql_result($result,$i, TBL_MATCHS.".TimeReported");

			$tclanid       = mysql_result($result,$i, TBL_CLANS.".ClanID");
			$clan = new Clan($tclanid);
			$tid           = mysql_result($result,$i, TBL_TEAMS.".TeamID");
			$tELO          = mysql_result($result,$i, TBL_TEAMS.".ELORanking");
			$tTS_mu        = mysql_result($result,$i, TBL_TEAMS.".TS_mu");
			$tTS_sigma     = mysql_result($result,$i, TBL_TEAMS.".TS_sigma");
			$tG2_r         = mysql_result($result,$i, TBL_TEAMS.".G2_r");
			$tG2_RD        = mysql_result($result,$i, TBL_TEAMS.".G2_RD");
			$tG2_sigma     = mysql_result($result,$i, TBL_TEAMS.".G2_sigma");
			$tG2_mu        = g2_from_g1_rating($tG2_r, $G2_r0, G2_qinv);
			$tG2_phi       = g2_from_g1_deviation($tG2_RD, G2_qinv);
			$tGamesPlayed  = mysql_result($result,$i, TBL_TEAMS.".GamesPlayed");
			$tWins         = mysql_result($result,$i, TBL_TEAMS.".Win");
			$tDraws        = mysql_result($result,$i, TBL_TEAMS.".Draw");
			$tLosses       = mysql_result($result,$i, TBL_TEAMS.".Loss");
			$tScore        = mysql_result($result,$i, TBL_TEAMS.".Score");
			$tOppScore     = mysql_result($result,$i, TBL_TEAMS.".ScoreAgainst");
			$tPoints       = mysql_result($result,$i, TBL_TEAMS.".Points");
			$tForfeits     = mysql_result($result,$i, TBL_TEAMS.".Forfeits");
			$tStreak       = mysql_result($result,$i, TBL_TEAMS.".Streak");
			$tStreak_Best  = mysql_result($result,$i, TBL_TEAMS.".Streak_Best");
			$tStreak_Worst = mysql_result($result,$i, TBL_TEAMS.".Streak_Worst");

			$tdeltaELO         = mysql_result($result,$i, TBL_SCORES.".Player_deltaELO");
			$tdeltaTS_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_mu");
			$tdeltaTS_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_sigma");
			$tdeltaG2_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_mu");
			$tdeltaG2_phi      = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_phi");
			$tdeltaG2_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_sigma");
			$tdeltaGamesPlayed = 1;
			$tdeltaWins        = mysql_result($result,$i, TBL_SCORES.".Player_Win");
			$tdeltaDraws       = mysql_result($result,$i, TBL_SCORES.".Player_Draw");
			$tdeltaLosses      = mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			$tdeltaPoints      = mysql_result($result,$i, TBL_SCORES.".Player_Points");
			$tdeltaForfeits    = mysql_result($result,$i, TBL_SCORES.".Player_Forfeit");
			$tdeltaScore       = mysql_result($result,$i, TBL_SCORES.".Player_Score");
			$tdeltaOppScore    = mysql_result($result,$i, TBL_SCORES.".Player_ScoreAgainst");

			$tELO         += $tdeltaELO;
			$tTS_mu       += $tdeltaTS_mu;
			$tTS_sigma    *= $tdeltaTS_sigma;
			$tG2_mu       += $tdeltaG2_mu;
			$tG2_phi      *= $tdeltaG2_phi;
			$tG2_sigma    *= $tdeltaG2_sigma;
			$tG2_r         = g2_to_g1_rating($tG2_mu, $G2_r0, G2_qinv);
			$tG2_RD        = g2_to_g1_deviation($tG2_phi, G2_qinv);
			$tGamesPlayed += $tdeltaGamesPlayed;
			$tWins        += $tdeltaWins;
			$tDraws       += $tdeltaDraws;
			$tLosses      += $tdeltaLosses;
			$tScore       += $tdeltaScore;
			$tOppScore    += $tdeltaOppScore;
			$tPoints      += $tdeltaPoints;
			$tForfeits    += $tdeltaForfeits;

			$output .= "Team: $clan->getField('Name') - $tid, new ELO: $tELO<br />";
			$output .= "Games played: $tGamesPlayed<br>";
			$output .= "Match id: ".$this->fields['MatchID']."<br>";

			$gain = mysql_result($result,$i, TBL_SCORES.".Player_Win") - mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			if ($gain * $tStreak >= 0)
			{
				// same sign
				$tStreak += $gain;
			}
			else
			{
				// opposite sign
				$tStreak = $gain;
			}

			if ($tStreak > $tStreak_Best) $tStreak_Best = $tStreak;
			if ($tStreak < $tStreak_Worst) $tStreak_Worst = $tStreak;

			if($competition_type == 'Ladder')
			{
				if ($tStreak == 5)
				{
					// Award: team wins 5 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
					VALUES ($tid,'TeamStreak5',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
				if ($tStreak == 10)
				{
					// Award: team wins 10 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
					VALUES ($tid,'TeamStreak10',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
				if ($tStreak == 25)
				{
					// Award: player wins 25 games in a row
					$q4 = "INSERT INTO ".TBL_AWARDS."(Team,Type,timestamp)
					VALUES ($tid,'TeamStreak25',$time_reported)";
					$result4 = $sql->db_Query($q4);
				}
			}

			// Update database.
			// Reset rank delta after a match.
			$q_3 = "UPDATE ".TBL_TEAMS
			." SET ELORanking = '".floatToSQL($tELO)."',"
			."     TS_mu = '".floatToSQL($tTS_mu)."',"
			."     TS_sigma = '".floatToSQL($tTS_sigma)."',"
			."     G2_r = '".floatToSQL($tG2_r)."',"
			."     G2_RD = '".floatToSQL($tG2_RD)."',"
			."     G2_sigma = '".floatToSQL($tG2_sigma)."',"
			."     GamesPlayed = $tGamesPlayed,"
			."     Loss = $tLosses,"
			."     Win = $tWins,"
			."     Draw = $tDraws,"
			."     Score = $tScore,"
			."     ScoreAgainst = $tOppScore,"
			."     Points = $tPoints,"
			."     Forfeits = $tForfeits,"
			."     Streak = $tStreak,"
			."     Streak_Best = $tStreak_Best,"
			."     Streak_Worst = $tStreak_Worst,"
			."     RankDelta = 0"
			." WHERE (TeamID = '$tid')";
			$result_3 = $sql->db_Query($q_3);
		}

		$q = "UPDATE ".TBL_MATCHS." SET Status = 'active' WHERE (MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);

		//echo $output;
		//exit;
	}

	function delete()
	{
		global $sql;

		/* Event Info */
		$match_id = $this->fields['MatchID'];
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);

		if($event->getField('FixturesEnable') == TRUE)
		{
			$event->brackets(false, $match_id);
		}
		else
		{
			$this->deleteMatchScores();
		}

		$event->setFieldDB('IsChanged', 1);
	}

	function deleteMatchScores()
	{
		global $sql;

		/* Event Info */
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);

		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$this->deletePlayersMatchScores();
			break;
		case 'Teams':
			$this->deleteTeamsMatchScores();
			break;
		default:
		}

		$event->setFieldDB('IsChanged', 1);
	}

	function deletePlayersMatchScores()
	{
		global $sql;

		// Get event info
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);
		$G2_r0 = $event->getField('G2_default_r');

		// Update Teams with scores
		$tdeltaELO         = array();
		$tdeltaTS_mu       = array();
		$tdeltaTS_sigma    = array();
		$tdeltaG2_mu       = array();
		$tdeltaG2_phi      = array();
		$tdeltaG2_sigma    = array();
		$tdeltaGamesPlayed = array();
		$tdeltaWins        = array();
		$tdeltaDraws       = array();
		$tdeltaLosses      = array();
		$tdeltaScore       = array();
		$tdeltaOppScore    = array();
		$tdeltaPoints      = array();
		$tdeltaForfeits    = array();
		$tnbrPlayers       = array();

		$q = "SELECT DISTINCT ".TBL_PLAYERS.".Team"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".Team > 0)";
		$result_Teams = $sql->db_Query($q);

		$numTeams = mysql_numrows($result_Teams);
		for($team=0;$team<$numTeams;$team++)
		{
			$tid = mysql_result($result_Teams,$team, TBL_PLAYERS.".Team");

			$tdeltaELO[$tid]         = 0;
			$tdeltaTS_mu[$tid]       = 0;
			$tdeltaTS_sigma[$tid]    = 0;
			$tdeltaG2_mu[$tid]       = 0;
			$tdeltaG2_phi[$tid]      = 0;
			$tdeltaG2_sigma[$tid]    = 0;
			$tdeltaGamesPlayed[$tid] = 0;
			$tdeltaWins[$tid]        = 0;
			$tdeltaDraws[$tid]       = 0;
			$tdeltaLosses[$tid]      = 0;
			$tdeltaScore[$tid]       = 0;
			$tdeltaOppScore[$tid]    = 0;
			$tdeltaPoints[$tid]      = 0;
			$tdeltaForfeits[$tid]    = 0;
			$tnbrPlayers[$tid]       = 0;
		}

		// Update Players with scores
		$q = "SELECT ".TBL_MATCHS.".*, "
		.TBL_SCORES.".*, "
		.TBL_PLAYERS.".*, "
		.TBL_USERS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS.", "
		.TBL_GAMERS.", "
		.TBL_USERS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
		." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)";
		$result = $sql->db_Query($q);
		$numPlayers = mysql_numrows($result);
		for($i=0;$i < $numPlayers;$i++)
		{
			$mStatus = mysql_result($result,$i, TBL_MATCHS.".Status");

			$pid           = mysql_result($result,$i, TBL_PLAYERS.".PlayerID");
			$puid          = mysql_result($result,$i, TBL_USERS.".user_id");
			$gamer_id = mysql_result($result,$i, TBL_PLAYERS.".Gamer");
			$gamer = new Gamer($gamer_id);
			$pname = $gamer->getField('Name');
			$pteam         = mysql_result($result,$i, TBL_PLAYERS.".Team");
			$pELO          = mysql_result($result,$i, TBL_PLAYERS.".ELORanking");
			$pTS_mu        = mysql_result($result,$i, TBL_PLAYERS.".TS_mu");
			$pTS_sigma     = mysql_result($result,$i, TBL_PLAYERS.".TS_sigma");
			$pG2_r         = mysql_result($result,$i, TBL_PLAYERS.".G2_r");
			$pG2_RD        = mysql_result($result,$i, TBL_PLAYERS.".G2_RD");
			$pG2_sigma     = mysql_result($result,$i, TBL_PLAYERS.".G2_sigma");
			$pG2_mu        = g2_from_g1_rating($pG2_r, $G2_r0, G2_qinv);
			$pG2_phi       = g2_from_g1_deviation($pG2_RD, G2_qinv);
			$pGamesPlayed  = mysql_result($result,$i, TBL_PLAYERS.".GamesPlayed");
			$pWins         = mysql_result($result,$i, TBL_PLAYERS.".Win");
			$pDraws        = mysql_result($result,$i, TBL_PLAYERS.".Draw");
			$pLosses       = mysql_result($result,$i, TBL_PLAYERS.".Loss");
			$pStreak       = mysql_result($result,$i, TBL_PLAYERS.".Streak");
			$pStreak_Best  = mysql_result($result,$i, TBL_PLAYERS.".Streak_Best");
			$pStreak_Worst = mysql_result($result,$i, TBL_PLAYERS.".Streak_Worst");
			$pScore        = mysql_result($result,$i, TBL_PLAYERS.".Score");
			$pOppScore     = mysql_result($result,$i, TBL_PLAYERS.".ScoreAgainst");
			$pPoints       = mysql_result($result,$i, TBL_PLAYERS.".Points");
			$pForfeits     = mysql_result($result,$i, TBL_PLAYERS.".Forfeits");

			$scoreid           = mysql_result($result,$i, TBL_SCORES.".ScoreID");
			$pdeltaELO         = mysql_result($result,$i, TBL_SCORES.".Player_deltaELO");
			$pdeltaTS_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_mu");
			$pdeltaTS_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_sigma");
			$pdeltaG2_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_mu");
			$pdeltaG2_phi      = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_phi");
			$pdeltaG2_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_sigma");
			$pdeltaGamesPlayed = 1;
			$pdeltaWins        = mysql_result($result,$i, TBL_SCORES.".Player_Win");
			$pdeltaDraws       = mysql_result($result,$i, TBL_SCORES.".Player_Draw");
			$pdeltaLosses      = mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			$pdeltaScore       = mysql_result($result,$i, TBL_SCORES.".Player_Score");
			$pdeltaOppScore    = mysql_result($result,$i, TBL_SCORES.".Player_ScoreAgainst");
			$pdeltaPoints      = mysql_result($result,$i, TBL_SCORES.".Player_Points");
			$pdeltaForfeits    = mysql_result($result,$i, TBL_SCORES.".Player_Forfeit");

			$pELO         -= $pdeltaELO;
			$pTS_mu       -= $pdeltaTS_mu;
			$pTS_sigma    /= $pdeltaTS_sigma;
			$pG2_mu       -= $pdeltaG2_mu;
			$pG2_phi      /= $pdeltaG2_phi;
			$pG2_sigma    /= $pdeltaG2_sigma;
			$pG2_r         = g2_to_g1_rating($pG2_mu, $G2_r0, G2_qinv);
			$pG2_RD        = g2_to_g1_deviation($pG2_phi, G2_qinv);
			$pGamesPlayed -= $pdeltaGamesPlayed;
			$pWins        -= $pdeltaWins;
			$pDraws       -= $pdeltaDraws;
			$pLosses      -= $pdeltaLosses;
			$pScore       -= $pdeltaScore;
			$pOppScore    -= $pdeltaOppScore;
			$pPoints      -= $pdeltaPoints;
			$pForfeits    -= $pdeltaForfeits;

			$output .= "<br>pid:$pid, pname $pname, pscore: $pdeltaScore, pelo: $pELO, pteam: $pteam<br />";

			if ($pteam != 0)
			{
				$tdeltaELO[$pteam]         += $pdeltaELO;
				$tdeltaTS_mu[$pteam]       += $pdeltaTS_mu;
				$tdeltaTS_sigma[$pteam]    += $pdeltaTS_sigma;
				$tdeltaG2_mu[$pteam]       += $pdeltaG2_mu;
				$tdeltaG2_phi[$pteam]      += $pdeltaG2_phi;
				$tdeltaG2_sigma[$pteam]    += $pdeltaG2_sigma;
				$tdeltaGamesPlayed[$pteam] += 1;
				$tdeltaWins[$pteam]        += $pdeltaWins;
				$tdeltaDraws[$pteam]       += $pdeltaDraws;
				$tdeltaLosses[$pteam]      += $pdeltaLosses;
				$tdeltaScore[$pteam]       += $pdeltaScore;
				$tdeltaOppScore[$pteam]    += $pdeltaOppScore;
				$tdeltaPoints[$pteam]      += $pdeltaPoints;
				$tdeltaForfeits[$pteam]    += $pdeltaForfeits;
				$tnbrPlayers[$pteam]       += 1;
			}

			if ($mStatus == 'active')
			{
				$q = "UPDATE ".TBL_PLAYERS
				." SET ELORanking = '".floatToSQL($pELO)."',"
				."     TS_mu = '".floatToSQL($pTS_mu)."',"
				."     TS_sigma = '".floatToSQL($pTS_sigma)."',"
				."     G2_r = '".floatToSQL($pG2_r)."',"
				."     G2_RD = '".floatToSQL($pG2_RD)."',"
				."     G2_sigma = '".floatToSQL($pG2_sigma)."',"
				."     GamesPlayed = $pGamesPlayed,"
				."     Loss = $pLosses,"
				."     Win = $pWins,"
				."     Draw = $pDraws,"
				."     Score = $pScore,"
				."     ScoreAgainst = $pOppScore,"
				."     Points = $pPoints,"
				."     Forfeits = $pForfeits"
				." WHERE (PlayerID = '$pid')";
				$result2 = $sql->db_Query($q);
				$output .= "$q<br>";
			}

			// fmarc- Can not reverse "streak" information here :(

			// Delete Score
			$q = "DELETE FROM ".TBL_SCORES." WHERE (ScoreID = '$scoreid')";
			$result2 = $sql->db_Query($q);
			$output .= "$q<br>";

		}
		$q = "SELECT DISTINCT ".TBL_PLAYERS.".Team, "
		.TBL_TEAMS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_PLAYERS.", "
		.TBL_TEAMS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
		." AND (".TBL_TEAMS.".TeamID = ".TBL_PLAYERS.".Team)"
		." AND (".TBL_PLAYERS.".Team > 0)";
		$result_Teams = $sql->db_Query($q);

		$numTeams = mysql_numrows($result_Teams);
		for($team=0;$team<$numTeams;$team++)
		{
			$tid = mysql_result($result_Teams,$team, TBL_PLAYERS.".Team");

			$tPoints      = mysql_result($result_Teams,$team, TBL_TEAMS.".Points");
			$tForfeits    = mysql_result($result_Teams,$team, TBL_TEAMS.".Forfeits");
			$tELO         = mysql_result($result_Teams,$team, TBL_TEAMS.".ELORanking");
			$tTS_mu       = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_mu");
			$tTS_sigma    = mysql_result($result_Teams,$team, TBL_TEAMS.".TS_sigma");
			$tG2_r        = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_r");
			$tG2_RD       = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_RD");
			$tG2_sigma    = mysql_result($result_Teams,$team, TBL_TEAMS.".G2_sigma");
			$tG2_mu       = g2_from_g1_rating($tG2_r, $G2_r0, G2_qinv);
			$tG2_phi      = g2_from_g1_deviation($tG2_RD, G2_qinv);
			$tGamesPlayed = mysql_result($result_Teams,$team, TBL_TEAMS.".GamesPlayed");
			$tWins        = mysql_result($result_Teams,$team, TBL_TEAMS.".Win");
			$tDraws       = mysql_result($result_Teams,$team, TBL_TEAMS.".Draw");
			$tLosses      = mysql_result($result_Teams,$team, TBL_TEAMS.".Loss");
			$tScore       = mysql_result($result_Teams,$team, TBL_TEAMS.".Score");
			$tOppScore    = mysql_result($result_Teams,$team, TBL_TEAMS.".ScoreAgainst");

			$tdeltaELO[$tid]         /= $tnbrPlayers[$tid];
			$tdeltaTS_mu[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaTS_sigma[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaG2_mu[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaG2_phi[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaG2_sigma[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaGamesPlayed[$tid] /= $tnbrPlayers[$tid];
			$tdeltaWins[$tid]        /= $tnbrPlayers[$tid];
			$tdeltaDraws[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaLosses[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaScore[$tid]       /= $tnbrPlayers[$tid];
			$tdeltaOppScore[$tid]    /= $tnbrPlayers[$tid];
			$tdeltaPoints[$tid]      /= $tnbrPlayers[$tid];
			$tdeltaForfeits[$tid]    /= $tnbrPlayers[$tid];

			$tPoints      -= $tdeltaPoints[$tid];
			$tForfeits    -= $tdeltaForfeits[$tid];
			$tELO         -= $tdeltaELO[$tid];
			$tTS_mu       -= $tdeltaTS_mu[$tid];
			$tTS_sigma    /= $tdeltaTS_sigma[$tid];
			$tG2_mu       -= $tdeltaG2_mu[$tid];
			$tG2_phi      /= $tdeltaG2_phi[$tid];
			$tG2_sigma    /= $tdeltaG2_sigma[$tid];
			$tG2_r         = g2_to_g1_rating($tG2_mu[$tid], $G2_r0, G2_qinv);
			$tG2_RD        = g2_to_g1_deviation($tG2_phi[$tid], G2_qinv);
			$tGamesPlayed -= $tdeltaGamesPlayed[$tid];
			$tWins        -= $tdeltaWins[$tid];
			$tDraws       -= $tdeltaDraws[$tid];
			$tLosses      -= $tdeltaLosses[$tid];
			$tScore       -= $tdeltaScore[$tid];
			$tOppScore    -= $tdeltaOppScore[$tid];

			$output .= "Team: $tid, new ELO: $tdeltaELO[$tid]<br />";
			$output .= "Team: $tid, Games played: $tdeltaGamesPlayed[$tid]<br>";
			$output .= "Match id: ".$this->fields['MatchID']."<br>";

			if ($mStatus == 'active')
			{
				$q_update = "UPDATE ".TBL_TEAMS
				." SET ELORanking = '".floatToSQL($tELO)."',"
				."     TS_mu = '".floatToSQL($tTS_mu)."',"
				."     TS_sigma = '".floatToSQL($tTS_sigma)."',"
				."     G2_r = '".floatToSQL($tG2_r)."',"
				."     G2_RD = '".floatToSQL($tG2_RD)."',"
				."     G2_sigma = '".floatToSQL($tG2_sigma)."',"
				."     GamesPlayed = $tGamesPlayed,"
				."     Loss = $tLosses,"
				."     Win = $tWins,"
				."     Draw = $tDraws,"
				."     Score = $tScore,"
				."     ScoreAgainst = $tOppScore,"
				."     Points = $tPoints,"
				."     Forfeits = $tForfeits,"
				."     RankDelta = 0"
				." WHERE (TeamID = '$tid')";
				$result_update = $sql->db_Query($q_update);
				$output .= "<br>$q";
			}
		}

		// The match itself is kept in database, only the scores are deleted.
		$q = "UPDATE ".TBL_MATCHS." SET Status = 'deleted' WHERE (MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);

		//echo $output;
		//exit;
	}

	function deleteTeamsMatchScores()
	{
		global $sql;

		// Get event info
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);
		$G2_r0 = $event->getField('G2_default_r');

		// Update Players with scores
		$q = "SELECT ".TBL_MATCHS.".*, "
		.TBL_SCORES.".*, "
		.TBL_TEAMS.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_TEAMS
		." WHERE (".TBL_MATCHS.".MatchID = '".$this->fields['MatchID']."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)";
		$result = $sql->db_Query($q);
		$numTeams = mysql_numrows($result);

		for($i=0;$i < $numTeams;$i++)
		{
			$mStatus = mysql_result($result,$i, TBL_MATCHS.".Status");

			$tid          = mysql_result($result,$i, TBL_TEAMS.".TeamID");
			$tELO         = mysql_result($result,$i, TBL_TEAMS.".ELORanking");
			$tTS_mu       = mysql_result($result,$i, TBL_TEAMS.".TS_mu");
			$tTS_sigma    = mysql_result($result,$i, TBL_TEAMS.".TS_sigma");
			$tG2_r        = mysql_result($result,$i, TBL_TEAMS.".G2_r");
			$tG2_RD       = mysql_result($result,$i, TBL_TEAMS.".G2_RD");
			$tG2_sigma    = mysql_result($result,$i, TBL_TEAMS.".G2_sigma");
			$tG2_mu       = g2_from_g1_rating($tG2_r, $G2_r0, G2_qinv);
			$tG2_phi      = g2_from_g1_deviation($tG2_RD, G2_qinv);
			$tGamesPlayed = mysql_result($result,$i, TBL_TEAMS.".GamesPlayed");
			$tWins        = mysql_result($result,$i, TBL_TEAMS.".Win");
			$tDraws       = mysql_result($result,$i, TBL_TEAMS.".Draw");
			$tLosses      = mysql_result($result,$i, TBL_TEAMS.".Loss");
			$tScore       = mysql_result($result,$i, TBL_TEAMS.".Score");
			$tOppScore    = mysql_result($result,$i, TBL_TEAMS.".ScoreAgainst");
			$tPoints      = mysql_result($result,$i, TBL_TEAMS.".Points");
			$tForfeits    = mysql_result($result,$i, TBL_TEAMS.".Forfeits");

			$scoreid           = mysql_result($result,$i, TBL_SCORES.".ScoreID");
			$tdeltaELO         = mysql_result($result,$i, TBL_SCORES.".Player_deltaELO");
			$tdeltaTS_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_mu");
			$tdeltaTS_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaTS_sigma");
			$tdeltaG2_mu       = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_mu");
			$tdeltaG2_phi      = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_phi");
			$tdeltaG2_sigma    = mysql_result($result,$i, TBL_SCORES.".Player_deltaG2_sigma");
			$tdeltaGamesPlayed = 1;
			$tdeltaWins        = mysql_result($result,$i, TBL_SCORES.".Player_Win");
			$tdeltaDraws       = mysql_result($result,$i, TBL_SCORES.".Player_Draw");
			$tdeltaLosses      = mysql_result($result,$i, TBL_SCORES.".Player_Loss");
			$tdeltaScore       = mysql_result($result,$i, TBL_SCORES.".Player_Score");
			$tdeltaOppScore    = mysql_result($result,$i, TBL_SCORES.".Player_ScoreAgainst");
			$tdeltaPoints      = mysql_result($result,$i, TBL_SCORES.".Player_Points");
			$tdeltaForfeits    = mysql_result($result,$i, TBL_SCORES.".Player_Forfeit");

			$tELO           -= $tdeltaELO;
			$tTS_mu         -= $tdeltaTS_mu;
			$tTS_sigma      /= $tdeltaTS_sigma;
			$tG2_mu         -= $tdeltaG2_mu;
			$tG2_phi        /= $tdeltaG2_phi;
			$tG2_sigma      /= $tdeltaG2_sigma;
			$tG2_r           = g2_to_g1_rating($tG2_mu, $G2_r0, G2_qinv);
			$tG2_RD          = g2_to_g1_deviation($tG2_phi, G2_qinv);
			$tGamesPlayed   -= $tdeltaGamesPlayed;
			$tWins          -= $tdeltaWins;
			$tDraws         -= $tdeltaDraws;
			$tLosses        -= $tdeltaLosses;
			$tScore         -= $tdeltaScore;
			$tOppScore      -= $tdeltaOppScore;
			$tPoints        -= $tdeltaPoints;
			$tForfeits      -= $tdeltaForfeits;

			$output .= "<br>tid: $tid, tscore: $tsScore, telo: $tELO<br />";

			if ($mStatus == 'active')
			{
				$q_update = "UPDATE ".TBL_TEAMS
				." SET ELORanking = '".floatToSQL($tELO)."',"
				."     TS_mu = '".floatToSQL($tTS_mu)."',"
				."     TS_sigma = '".floatToSQL($tTS_sigma)."',"
				."     G2_r = '".floatToSQL($tG2_r)."',"
				."     G2_RD = '".floatToSQL($tG2_RD)."',"
				."     G2_sigma = '".floatToSQL($tG2_sigma)."',"
				."     GamesPlayed = $tGamesPlayed,"
				."     Loss = $tLosses,"
				."     Win = $tWins,"
				."     Draw = $tDraws,"
				."     Score = $tScore,"
				."     ScoreAgainst = $tOppScore,"
				."     Points = $tPoints,"
				."     Forfeits = $tForfeits,"
				."     RankDelta = 0"
				." WHERE (TeamID = '$tid')";
				$result_update = $sql->db_Query($q_update);
				$output .= "<br>$q";
			}

			// fmarc- Can not reverse "streak" information here :(

			// Delete Score
			$q = "DELETE FROM ".TBL_SCORES." WHERE (ScoreID = '$scoreid')";
			$result2 = $sql->db_Query($q);
			$output .= "$q<br>";
		}

		// The match itself is kept in database, only the scores are deleted.
		$q = "UPDATE ".TBL_MATCHS." SET Status = 'deleted' WHERE (MatchID = '".$this->fields['MatchID']."')";
		$result = $sql->db_Query($q);

		//echo $output;
		//exit;
	}

	function displayMatchInfo($type = 0, $header='')
	{
		global $time;
		global $sql;
		global $pref;
		
		$match_id = $this->fields['MatchID'];

		$string ='';
		// Get info about the match
		$q = "SELECT DISTINCT ".TBL_MATCHS.".*, "
		.TBL_USERS.".*, "
		.TBL_EVENTS.".*, "
		.TBL_GAMES.".*"
		." FROM ".TBL_MATCHS.", "
		.TBL_SCORES.", "
		.TBL_USERS.", "
		.TBL_EVENTS.", "
		.TBL_GAMES
		." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
		." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
		." AND (".TBL_USERS.".user_id = ".TBL_MATCHS.".ReportedBy)"
		." AND (".TBL_MATCHS.".Event = ".TBL_EVENTS.".EventID)"
		." AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)";

		$result = $sql->db_Query($q);
		$numMatchs = mysql_numrows($result);
		if ($numMatchs > 0)
		{
			$mReportedBy  = mysql_result($result, 0, TBL_USERS.".user_id");
			$mReportedByNickName  = mysql_result($result, 0, TBL_USERS.".user_name");
			$mEventgame = mysql_result($result, 0, TBL_GAMES.".Name");
			$mEventgameicon = mysql_result($result, 0, TBL_GAMES.".Icon");
			$mStatus  = mysql_result($result,0, TBL_MATCHS.".Status");
			$mTime  = mysql_result($result, 0, TBL_MATCHS.".TimeReported");
			$mTime_local = $mTime + TIMEOFFSET;
			$date = date("d M Y, h:i A",$mTime_local);
			$mTimeScheduled  = mysql_result($result, 0, TBL_MATCHS.".TimeScheduled");
			$mTimeScheduled_local = $mTimeScheduled + TIMEOFFSET;
			$dateScheduled = date("d M Y, h:i A",$mTimeScheduled_local);
			$mComments = mysql_result($result, 0, TBL_MATCHS.".Comments");
			$event_id  = mysql_result($result, 0, TBL_EVENTS.".EventID");
			$event = new Event($event_id);

			// Calculate number of players and teams for the match
			$q = "SELECT DISTINCT ".TBL_SCORES.".Player_MatchTeam"
			." FROM ".TBL_SCORES
			." WHERE (".TBL_SCORES.".MatchID = '".$match_id."')";
			$result = $sql->db_Query($q);
			$nbr_teams = mysql_numrows($result);

			// Check if the match has several ranks
			$q = "SELECT DISTINCT ".TBL_MATCHS.".*, "
			.TBL_SCORES.".Player_Rank"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES
			." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)";
			$result = $sql->db_Query($q);
			$numRanks = mysql_numrows($result);
			if ($numRanks > 0)
			{
				//------------ permissions --------------
				$permissions = $this->get_permissions(USERID);
				$userclass = $permissions['userclass'];
				$can_approve = $permissions['can_approve'];
				$can_report = $permissions['can_report'];
				$can_schedule = $permissions['can_schedule'];
				$can_delete = $permissions['can_delete'];
				$can_edit = $permissions['can_edit'];
				
				$orderby_str = " ORDER BY ".TBL_SCORES.".Player_Rank, ".TBL_SCORES.".Player_MatchTeam";
				if($nbr_teams==2) $orderby_str = " ORDER BY ".TBL_SCORES.".Player_MatchTeam";

				switch($event->getMatchPlayersType())
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
					." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
					." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
					." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
					." AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
					.$orderby_str;
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
					." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
					." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
					." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
					." AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)"
					." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
					.$orderby_str;
					break;
				default:
				}

				$result = $sql->db_Query($q);
				$numPlayers = mysql_numrows($result);
				$pname = '';
				$string .= '<tr>';
				if($header) $string .= '<td>'.$header.'</td>';
				$scores = '';

				if (($type & eb_MATCH_NOEVENTINFO) == 0)
				{
					$string .= '<td style="vertical-align:top">';
					$string .= '<img '.getActivityGameIconResize($mEventgameicon).' title="'.$mEventgame.'"/>';
					$string .= '</td>';
				}

				$string .= '<td>';
				$matchteam = 0;
				for ($index = 0; $index < $numPlayers; $index++)
				{
					switch($event->getMatchPlayersType())
					{
					case 'Players':
						$puid  = mysql_result($result,$index , TBL_USERS.".user_id");
						$gamer_id = mysql_result($result,$index, TBL_PLAYERS.".Gamer");
						$gamer = new Gamer($gamer_id);
						$pname = $gamer->getField('Name');
						$pavatar = mysql_result($result,$index, TBL_USERS.".user_image");
						$pteam  = mysql_result($result,$index , TBL_PLAYERS.".Team");
						break;
					case 'Teams':
						$pname  = mysql_result($result,$index, TBL_CLANS.".Name");
						$pavatar = mysql_result($result,$index, TBL_CLANS.".Image");
						$pteam  = mysql_result($result,$index, TBL_TEAMS.".TeamID");
						break;
					default:
					}
					list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);
					$prank  = mysql_result($result,$index , TBL_SCORES.".Player_Rank");
					$pmatchteam  = mysql_result($result,$index , TBL_SCORES.".Player_MatchTeam");
					$pscore = mysql_result($result,$index , TBL_SCORES.".Player_Score");
					$pfaction  = mysql_result($result,$index, TBL_SCORES.".Faction");

					$pfactionIcon = "";
					//if (($pfaction!=0)&&($type!=0))
					if ($pfaction!=0)
					{
						$q_Factions = "SELECT ".TBL_FACTIONS.".*"
						." FROM ".TBL_FACTIONS
						." WHERE (".TBL_FACTIONS.".FactionID = '$pfaction')";
						$result_Factions = $sql->db_Query($q_Factions);
						$numFactions = mysql_numrows($result_Factions);
						if ($numFactions>0)
						{
							$fIcon = mysql_result($result_Factions,0 , TBL_FACTIONS.".Icon");
							$fName = mysql_result($result_Factions,0 , TBL_FACTIONS.".Name");

							$pfactionIcon = ' <img '.getFactionIconResize($fIcon).' title="'.$fName.'"/>';
						}
					}

					/* takes too long
					$image = '';
					if ($pref['eb_avatar_enable_playersstandings'] == 1)
					{
					switch($event->getMatchPlayersType())
					{
					case 'Players':
					if($pavatar)
					{
					$image = '<img '.getAvatarResize(avatar($pavatar)).'/>';
					} else if ($pref['eb_avatar_default_image'] != ''){
					$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_image'], 'avatars')).'/>';
					}
					break;
					case 'Teams':
					if($pavatar)
					{
					$image = '<img '.getAvatarResize(getImagePath($pavatar, 'team_avatars')).'/>';
					} else if ($pref['eb_avatar_default_image'] != ''){
					$image = '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>';
					}
					break;
					default:
					}
					}
					*/

					if($index>0)
					{
						$scores .= "-".$pscore;
						if ($pmatchteam == $matchteam)
						{
							$string .= ' &amp; ';
						}
						else
						{
							if (($type & eb_MATCH_SCHEDULED) != 0)
							{
								$str = ' vs. ';

							}
							else if ($prank == $rank)
							{
								$str = ' '.EB_MATCH_L2.' ';
							}
							else if ($prank > $rank)
							{
								$str = ' '.EB_MATCH_L3.' ';
							}
							else
							{
								$str = ' '.EB_MATCH_L14.' ';
							}

							$string .= $str;
							$matchteam = $pmatchteam;
							$rank = $prank;
						}
					}
					else
					{
						$rank = $prank;
						$matchteam = $pmatchteam;
						$scores .= $pscore;
					}
					/*
					echo "rank: $rank, prank: $prank<br>";
					echo "mt: $matchteam, pmt $pmatchteam<br>";
					*/

					$string .= $pfactionIcon.' ';

					switch($event->getMatchPlayersType())
					{
					case 'Players':
						$string .= '<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$puid.'">'.$pclantag.$pname.'</a>';
						break;
					case 'Teams':
						$string .= '<a href="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$pclanid.'">'.$pclan.'</a>';
						break;
					default:
					}

				}

				//score here
				if (($event->getField('AllowScore') == TRUE)
						&&(($type & eb_MATCH_SCHEDULED) == 0))
				{
					$string .= ' ('.$scores.') ';
				}

				if (($type & eb_MATCH_NOEVENTINFO) == 0)
				{
					$string .= ' '.EB_MATCH_L12.' <a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>';
				}
				if ($can_approve == 1)
				{
					$string .= ' <a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/exclamation.png" alt="'.EB_MATCH_L13.'" title="'.EB_MATCH_L13.'"/></a>';
				}
				else
				{
					if((($type & eb_MATCH_SCHEDULED) == 0)||($can_schedule == 1))
					{
						$string .= ' <a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'"><img class="eb_image" src="'.e_PLUGIN.'ebattles/images/magnify.png" alt="'.EB_MATCH_L5.'" title="'.EB_MATCH_L5.'"/></a>';
					}
				}

				if (($type & eb_MATCH_SCHEDULED) == 0)
				{
					$string .= ' <div class="smalltext">';
					$string .= EB_MATCH_L6.' <a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$mReportedBy.'">'.$mReportedByNickName.'</a> ';

					if (($time-$mTime) < INT_MINUTE )
					{
						$string .= EB_MATCH_L7;
					}
					else if (($time-$mTime) < INT_DAY )
					{
						$string .= get_formatted_timediff($mTime, $time).'&nbsp;'.EB_MATCH_L8;
					}
					else
					{
						$string .= EB_MATCH_L9.'&nbsp;'.$date.'.';
					}
					$nbr_comments = ebGetCommentTotal("ebmatches", $match_id);
					$nbr_comments += ($mComments == '') ? 0 : 1 ;
					$string .= ' <a href="'.e_PLUGIN.'ebattles/matchinfo.php?matchid='.$match_id.'" title="'.EB_MATCH_L4.'&nbsp;'.$match_id.'">'.$nbr_comments.'&nbsp;';
					$string .= ($nbr_comments > 1) ? EB_MATCH_L10 : EB_MATCH_L11;
					$string .= '</a>';
					$string .= '</div></td>';
				}
				else
				{
					$string .= ' <div class="smalltext">';
					$string .= EB_MATCH_L16.'&nbsp;';
					$string .= EB_MATCH_L17.'&nbsp;'.$dateScheduled.'.';

					$string .= '</div></td>';
				}
				
				if(($type & eb_MATCH_NO_EDIT_ICONS) == 0)
				{
					if($can_delete == 1)
					{
						$delete_text = ($competition_type == 'Tournament') ? EB_MATCHD_L29 : EB_MATCHD_L5;
						
						$string .= '<td>';
						$string .= '<form action="'.e_PLUGIN.'ebattles/matchdelete.php?eventid='.$event_id.'" method="post">';
						$string .= '<div>';
						$string .= '<input type="hidden" name="eventid" value="'.$event_id.'"/>';
						$string .= '<input type="hidden" name="matchid" value="'.$match_id.'"/>';
						$string .= '</div>';
						$string .= ebImageTextButton('deletematch', 'cross.png', '', 'simple', $delete_text, EB_MATCHD_L4);
						$string .= '</form>';
						$string .= '</td>';
					}
					if($can_approve == 1)
					{
						$string .= '<td>';
						$string .= '<form id="approvematch_form" action="'.e_PLUGIN.'ebattles/matchprocess.php" method="post">';
						$string .= '<div>';
						$string .= '<input type="hidden" name="eventid" value="'.$event_id.'"/>';
						$string .= '<input type="hidden" name="matchid" value="'.$match_id.'"/>';
						$string .= '</div>';
						$string .= ebImageTextButton('approvematch', 'accept.png', '', 'simple', '', EB_MATCHD_L17);
						$string .= '</form>';
						$string .= '</td>';
					}
					if($can_edit == 1)
					{
						if($this->getField('Status') == 'scheduled')
						{
							$string .= '<td>';
							$string .= ebImageLink('matchschedulededit', EB_MATCHR_L46, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchschedulededit&amp;userclass='.$userclass, 'page_white_edit.png', '', 'matchreport_link', '', EB_MATCHD_L27);
							$string .= '</td>';
						}
						else
						{
							$string .= '<td>';
							$string .= ebImageLink('matchedit', EB_MATCHR_L46, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchedit&amp;userclass='.$userclass, 'page_white_edit.png', '', 'matchreport_link', '', EB_MATCHD_L27);
							$string .= '</td>';
						}		
					}	
					if ($can_report == 1)
					{
						$string .= '<td>';
						$string .= '<div>';
						$string .= ebImageLink('matchscheduledreport', EB_MATCHR_L32, '', e_PLUGIN.'ebattles/matchreport.php?eventid='.$event_id.'&amp;matchid='.$match_id.'&amp;actionid=matchscheduledreport&amp;userclass='.$userclass, 'report.png', '', 'matchreport_link', '', EB_MATCHD_L30);
						$string .= '</div>';
						$string .= '</td>';
					}
				}

				$string .= '</tr>';
			}
		}
		return $string;
	}

	function add_media($submitter, $media_path, $media_type)
	{
		global $sql;
		global $tp;
		$submitter = $tp->toDB($submitter);
		$media_path = $tp->toDB($media_path);
		$media_type = $tp->toDB($media_type);

		$q = "INSERT INTO ".TBL_MEDIA."(MatchID,Submitter,Path,Type)
		VALUES ('".$this->fields['MatchID']."','$submitter','$media_path','$media_type')";
		$sql->db_Query($q);

		//dbg: echo "$this->fields['MatchID'], $submitter, $media_path, $media_type";
	}
	
	function get_permissions($user_id)
	{
		global $sql;
		global $pref;
		
		$userclass = 0;
		$can_edit = 0;
		$can_approve = 0;
		$can_report = 0;
		$can_schedule = 0;
		$can_delete = 0;
		$can_submit_media = 0;
		$can_delete_media = 0;
		
		$match_id = $this->fields['MatchID'];
		$event_id = $this->fields['Event'];
		$event = new Event($event_id);

		$type = $event->getField('Type');
		$competition_type = $event->getCompetitionType();
		$mStatus = $this->fields['Status'];
		$reported_by = $this->fields['ReportedBy'];
		
		// Is the user a moderator?
		$q_Mods = "SELECT ".TBL_EVENTMODS.".*"
		." FROM ".TBL_EVENTMODS
		." WHERE (".TBL_EVENTMODS.".Event = '$event_id')"
		."   AND (".TBL_EVENTMODS.".User = ".$user_id.")";
		$result_Mods = $sql->db_Query($q_Mods);
		$numMods = mysql_numrows($result_Mods);
		
		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$reporter_matchteam = 0;
			$q_Reporter = "SELECT DISTINCT ".TBL_SCORES.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS.", "
			.TBL_USERS
			." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = '$reported_by')";
			$result_Reporter = $sql->db_Query($q_Reporter);
			$numRows = mysql_numrows($result_Reporter);
			if ($numRows>0)
			{
				$reporter_matchteam = mysql_result($result_Reporter,0, TBL_SCORES.".Player_MatchTeam");
			}

			// Is the user an opponent of the reporter?
			$q_Opps = "SELECT DISTINCT ".TBL_SCORES.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS.", "
			.TBL_USERS
			." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
			." AND (".TBL_SCORES.".Player_MatchTeam != '$reporter_matchteam')"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = ".$user_id.")";
			$result_Opps = $sql->db_Query($q_Opps);
			$numOpps = mysql_numrows($result_Opps);
			break;
		case 'Teams':
			$reporter_matchteam = 0;
			$q_Reporter = "SELECT DISTINCT ".TBL_SCORES.".*"
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
			." AND (".TBL_GAMERS.".User = '$reported_by')";
			$result_Reporter = $sql->db_Query($q_Reporter);
			$numRows = mysql_numrows($result_Reporter);
			if ($numRows>0)
			{
				$reporter_matchteam = mysql_result($result_Reporter,0, TBL_SCORES.".Player_MatchTeam");
			}

			// Is the user an opponent of the reporter?
			$q_Opps = "SELECT DISTINCT ".TBL_SCORES.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_TEAMS.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS.", "
			.TBL_USERS
			." WHERE (".TBL_MATCHS.".MatchID = '$match_id')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_SCORES.".Player_MatchTeam != '$reporter_matchteam')"
			." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
			." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = ".$user_id.")";
			$result_Opps = $sql->db_Query($q_Opps);
			$numOpps = mysql_numrows($result_Opps);
			//dbg: echo "numOpps: $numOpps, mt: $reporter_matchteam<br />";
			break;
		default:
		}

		// Is the user a player in the match & not banned?
		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$q_UserPlayers = "SELECT DISTINCT ".TBL_SCORES.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS.", "
			.TBL_USERS
			." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_PLAYERS.".PlayerID = ".TBL_SCORES.".Player)"
			." AND (".TBL_PLAYERS.".Banned != 1)"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = ".$user_id.")";
			$result_UserPlayers = $sql->db_Query($q_UserPlayers);
			$numUserPlayers = mysql_numrows($result_UserPlayers);
			//dbg: echo "numUserPlayers: $numUserPlayers<br>";

			break;
		case 'Teams':
			$q_UserPlayers = "SELECT DISTINCT ".TBL_SCORES.".*"
			." FROM ".TBL_MATCHS.", "
			.TBL_SCORES.", "
			.TBL_TEAMS.", "
			.TBL_PLAYERS.", "
			.TBL_GAMERS.", "
			.TBL_USERS
			." WHERE (".TBL_MATCHS.".MatchID = '".$match_id."')"
			." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
			." AND (".TBL_TEAMS.".TeamID = ".TBL_SCORES.".Team)"
			." AND (".TBL_TEAMS.".Banned != 1)"
			." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
			." AND (".TBL_PLAYERS.".Banned != 1)"
			." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
			." AND (".TBL_GAMERS.".User = ".$user_id.")";
			$result_UserPlayers = $sql->db_Query($q_UserPlayers);
			$numUserPlayers = mysql_numrows($result_UserPlayers);
			//dbg: echo "numUserPlayers: $numUserPlayers<br>";

			break;
		default:
		}
		
		if (($user_id==$reported_by)&&($mStatus == 'pending')) $can_edit = 1;

		if (check_class($pref['eb_mod_class']))  $can_delete = 1;
		if ($user_id==$event->getField('Owner'))
		{
			$userclass |= eb_UC_EVENT_OWNER;
			$can_delete = 1;
			$can_approve = 1;
			$can_report = 1;
			$can_schedule = 1;
			$can_edit = 1;
			$can_submit_media = 1;
			$can_delete_media = 1;
		}
		if ($numMods>0)
		{
			$userclass |= eb_UC_EB_MODERATOR;
			$can_delete = 1;
			$can_approve = 1;
			$can_report = 1;
			$can_schedule = 1;
			$can_edit = 1;
			$can_submit_media = 1;
			$can_delete_media = 1;
		}
		if (check_class($pref['eb_mod_class']))
		{
			$userclass |= eb_UC_EB_MODERATOR;
			$can_approve = 1;
			$can_report = 1;
			$can_schedule = 1;
			$can_edit = 1;
			$can_submit_media = 1;
			$can_delete_media = 1;
		}
		if ($numOpps>0)
		{
			$userclass |= eb_UC_EVENT_PLAYER;
			$can_approve = 1;
		}
		if ($numUserPlayers > 0)
		{
			$can_report = 1;
		}
		if (($numPlayed>0)&&(check_class($pref['eb_media_submit_class'])))
		{
			$can_submit_media = 1;
		}

		if($userclass < $event->getField('MatchesApproval')) $can_approve = 0;
		if($event->getField('MatchesApproval') == eb_UC_NONE) $can_approve = 0;
		if ($mStatus != 'pending') $can_approve = 0;
		if ($mStatus != 'scheduled') $can_report = 0;
		
		if($can_edit==1)
		{
			if(($competition_type == 'Tournament') && ($mStatus != 'scheduled'))
			{
				$can_edit = 0;
			}
		}
		
		//echo "m($match_id).perm.can_report=$can_report<br>";
		$permissions = array();
		$permissions['userclass'] = $userclass;
		$permissions['can_edit'] = $can_edit;
		$permissions['can_approve'] = $can_approve;
		$permissions['can_report'] = $can_report;
		$permissions['can_schedule'] = $can_schedule;
		$permissions['can_delete'] = $can_delete;
		$permissions['can_submit_media'] = $can_submit_media;
		$permissions['can_delete_media'] = $can_delete_media;
		
		//echo "match $match_id permissions:<br>";
		//var_dump($permissions);
		
		return $permissions;
	}
}

function delete_media($media)
{
	global $sql;

	$q = "DELETE FROM ".TBL_MEDIA." WHERE (MediaID = '$media')";
	$result = $sql->db_Query($q);
}
?>
