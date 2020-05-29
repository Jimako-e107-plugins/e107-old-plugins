<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/playerstats.php,v $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/playerstats_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/playerstats_lan.php");
require_once("functionen.php");
// ============= START OF THE BODY ====================================
$sql -> db_Select("league_players", "*","players_id='".$_GET['player_id']."'");
$row = $sql-> db_Fetch();
$player[0]=$row['players_id'];
$player[1]=$row['players_name'];
$player[2]=$row['players_user_id'];
$player[3]=$row['players_admin_id'];
$player[4]=$row['players_pass'];
$player[7]=$row['players_image'];
$player[8]=$row['players_burthday'];
$player[13]=$row['players_description'];
/////////////-----------------------------------------------------------------
$posvalue[1]=LAN_LEAGUE_PLAYERSTATS_7;///Torhüter
$posvalue[2]=LAN_LEAGUE_PLAYERSTATS_8;///Verteidiger
$posvalue[3]=LAN_LEAGUE_PLAYERSTATS_9;///Stürmer
$posvalue[4]=LAN_LEAGUE_PLAYERSTATS_18;///Mittelstürmer
$posvalue[9]=LAN_LEAGUE_PLAYERSTATS_10;///Trainer
$posvalue[10]=LAN_LEAGUE_PLAYERSTATS_11;///Betreuer
$posvalue[0]=LAN_LEAGUE_PLAYERSTATS_12;///Keine Eingaben

   $qry1="
   SELECT a.*, ae.*, au.*, ao.*, ad.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_teams AS au ON au.team_id=ae.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS ao ON ao.league_id=a.roster_league_id
   LEFT JOIN ".MPREFIX."league_saison AS ad ON ad.saison_id=ao.league_saison_id
   WHERE a.roster_player_id='".$player[0]."' ORDER BY ad.saison_beginn DESC
   		";
	$sql->db_Select_gen($qry1);
$Scount=0;	
while($row = $sql-> db_Fetch())
   {
   	$Saisons[$Scount]['ID']=$row['roster_id'];
   	$Saisons[$Scount]['roster_saison_id']=$row['roster_saison_id'];
   	$Saisons[$Scount]['roster_team_id']=$row['roster_team_id'];
   	$Saisons[$Scount]['roster_position']=$posvalue[$row['roster_position']];
   	$Saisons[$Scount]['liga_team_id']=$row['liga_team_id'];
   	$Saisons[$Scount]['team_name']=$row['team_name'];
   	$Saisons[$Scount]['team_kurzname']=$row['team_kurzname'];
   	$Saisons[$Scount]['team_admin_id']=$row['team_admin_id'];
   	$Saisons[$Scount]['team_url']=$row['team_url'];
   	$Saisons[$Scount]['team_icon']=$row['team_icon'];
   	$Saisons[$Scount]['saison_name']=$row['saison_name'];
   	$Scount++;
		}


for($i=0; $i < $Scount ; $i++)
	{		
	$Saisons[$i]['games']=get_games_count($Saisons[$i]['ID']);
	$Saisons[$i]['goals']=get_goals_count($Saisons[$i]['ID']);
	$Saisons[$i]['assis']=get_assis_count($Saisons[$i]['ID']);
	$Saisons[$i]['punkte']=$Saisons[$i]['goals']+$Saisons[$i]['assis'];
	}

$userN=$player[18];
$adminN=$player[19];
$teamid=$player[4];

if(!$player[24]){$player[24]=LAN_LIQUE_158;}//Keine Eingaben
	else{
		$player[24]=strftime("%d %B %Y", $player[24]);
		}

if(!$player[29]){$player[29]=LAN_LIQUE_158;}else{$player[29]= $tp->toHTML($player[29],TRUE);}

$text= "";
$text .= "<div style='width:100%; text-align: center; vertical-align: top;'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

	$text .= "
				<tr>";
//$text .= "<td class='fcaption' style='text-align: center' >ID</td>";
$text .= "<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_2."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_3."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_4."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_14."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_15."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_16."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_17."</td>
				</tr>";



$SUMME['games']=0;
$SUMME['goals']=0;
$SUMME['assis']=0;
$SUMME['punkte']=0;
for($i=0; $i < $Scount ; $i++)
	{
	$SUMME['games']=$SUMME['games']+$Saisons[$i]['games'];
	$SUMME['goals']=$SUMME['goals']+$Saisons[$i]['goals'];
	$SUMME['assis']=$SUMME['assis']+$Saisons[$i]['assis'];
	$SUMME['punkte']=$SUMME['punkte']+$Saisons[$i]['punkte'];
	
	$text .= "
				<tr>";
//$text .= "<td class='forumheader' style='text-align: left'>".$Saisons[$i]['ID']."</td>";
$text .= "<td class='forumheader' style='text-align: left'>".$Saisons[$i]['saison_name']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['team_name']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['roster_position']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['games']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['goals']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['assis']."</td>
					<td class='forumheader2' style='text-align: center'>".$Saisons[$i]['punkte']."</td>
				</tr>";
	}
$text .= "<td class='forumheader2' style='text-align: left'>Summe</td>
					<td class='forumheader' style='text-align: center'>--</td>
					<td class='forumheader' style='text-align: center'>--</td>
					<td class='forumheader' style='text-align: center'>".$SUMME['games']."</td>
					<td class='forumheader' style='text-align: center'>".$SUMME['goals']."</td>
					<td class='forumheader' style='text-align: center'>".$SUMME['assis']."</td>
					<td class='forumheader' style='text-align: center'>".$SUMME['punkte']."</td>
				</tr>";              
$text .= "</table><br /><a href=profil.php?player_id=".$_GET['roster_id']."><b>".LAN_LEAGUE_PLAYERSTATS_13."</b></a><br/><br/>";   
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$title ="".LAN_LEAGUE_PLAYERSTATS_1." ".$player[1]."";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
///////////////////// Funktionen /////////////////////////////////
function get_games_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_anw", "*","anw_player_id='".$roster_id."'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
function get_goals_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_points", "*","points_player_id='".$roster_id."' AND points_value='1'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
function get_assis_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_points", "*","points_player_id='".$roster_id."' AND points_value='2'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
?>