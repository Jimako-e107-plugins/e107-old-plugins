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
|		$Source: ../e107_plugins/sport_league_e107/hall_of_fame.php,v $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_roster_lan.php");
require_once("".e_PLUGIN."sport_league_e107/functionen.php");
// ============= START OF THE BODY ====================================
if(e_QUERY)
	{
	list($team, $sort, $richtung) = explode(".", e_QUERY);
	$team = intval($team);
	$sort = intval($sort);
	$richtung = intval($richtung);
	unset($tmp);
	}



 		$sql -> db_Select("league_teams", "*", "team_id=".$team."");
 		$row = $sql-> db_Fetch();
		$my_team=$row;


	  $qry1="
   	SELECT a.*, b.*, c.*, d.* FROM ".MPREFIX."league_players AS a 
   	LEFT JOIN ".MPREFIX."league_roster AS b ON b.roster_player_id=a.players_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS c ON c.leagueteam_id=b.roster_team_id
   	LEFT JOIN ".MPREFIX."league_teams AS d ON d.team_id=c.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_leagues AS e ON e.league_id=c.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_saison AS f ON f.saison_id=e.league_saison_id
   	WHERE d.team_id =".$my_team['team_id']." 
   	GROUP BY a.players_name
   	ORDER BY f.saison_id, e.league_id, a.players_name
   			";
		$sql->db_Select_gen($qry1);$pc=0;
	  while($row = $sql-> db_Fetch())
  		{
 			$player[$pc]=$row;
 			if($row['roster_image']=="" || !$row['roster_image'])
				{$player[$pc]['players_image']=$row['players_image'];}
			else{$player[$pc]['players_image']=$row['roster_image'];}
			$pc++;
     	}
 
 for($i=0; $i < $pc ;$i++)
	{$player[$i]['team_name']=0;$player[$i]['games']=0;$player[$i]['goals']=0;$player[$i]['assists']=0;$player[$i]['points'];
	$qry1="
   	SELECT a.*, c.*, d.* FROM ".MPREFIX."league_roster AS a 
   	LEFT JOIN ".MPREFIX."league_leagueteams AS c ON c.leagueteam_id=a.roster_team_id
   	LEFT JOIN ".MPREFIX."league_teams AS d ON d.team_id=c.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_leagues AS e ON e.league_id=c.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_saison AS f ON f.saison_id=e.league_saison_id
   	WHERE a.roster_player_id =".$player[$i]['roster_player_id']." AND d.team_id='".$my_team['team_id']."'
   	ORDER BY f.saison_id, e.league_id
   			";
		$sql2->db_Select_gen($qry1);
	  while($row = $sql2-> db_Fetch())
  		{
 			$player[$i]['team_name']++;
 			$player_stats=get_statistik($row['roster_id']);
 			$player[$i]['games']=$player[$i]['games']+$player_stats['games'];
 			$player[$i]['goals']=$player[$i]['goals']+$player_stats['goals'];
 			$player[$i]['assists']=$player[$i]['assists']+$player_stats['assists'];
 			$player[$i]['points']=$player[$i]['points']+($player_stats['goals']+$player_stats['assists']);
 			$player[$i]['league_name'].=$row['league_name'].", ";
 			$player[$i]['saison_name'].=$row['saison_name'].", ";
 			$player[$i]['link']=$row['roster_id'];
     	}	
	}

$player2=sortieren($player,$sort,$richtung);
$player=$player2;
if(!$richtung ||$richtung=0){$richtung=1;}
else{$richtung=0;}
 $text="<table style='width:100%' cellspacing='0' cellpadding='0'>
 					<tr>
 						<td class='fcaption'>.</td>
 						<td class='fcaption'>Bild</td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".2.".$richtung."'>Spieler</a></td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".7.".$richtung."'>Runden</a></td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".3.".$richtung."'>S.</a></td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".4.".$richtung."'>T.</a></td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".5.".$richtung."'>A.</a></td>
 						<td class='fcaption'><a href='".e_SELF."?".$team.".6.".$richtung."'>P.</a></td>
 					</tr>";
 for($i=0; $i < $pc ;$i++)
	{
    $text.="<tr><td class='forumheader3' style='text-align:center;border-top:0px;'>".($i+1)."</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    							<img border='0' src='".e_PLUGIN."sport_league_e107/fotos/".$player[$i]['players_image']."' height='12'/>
    						</td>
    						<td class='forumheader3' style='text-align:left;border-top:0px;border-left:0px;'><a href='profil.php?player_id=".$player[$i]['link']."'>
    						".$player[$i]['players_name']."</a>
    						</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    						".$player[$i]['team_name']."
    						</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    						".$player[$i]['games']."
    						</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    						".$player[$i]['goals']."
    						</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    						".$player[$i]['assists']."
    						</td>
    						<td class='forumheader3' style='text-align:center;border-top:0px;border-left:0px;'>
    						".$player[$i]['points']."
    						</td>
  				</tr>";
  }$text.="</table>";
/*
///////////////////////////////////
$expand_autohide = "display:none; ";
$text = "<div style='width:100%; text-align: center;'>";
$text .= "
				<table style='width:100%' cellspacing='0' cellpadding='0'>
		  		<tr>
						<td style='text-align: center; width: 40%; vertical-align: top;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_icon."' height='140'/></td>
						<td style='text-align: left; width: 50%; vertical-align: top;'>
							<table style='width:100%' cellspacing='0' cellpadding='0'>
		  					<tr>
		  					<td style='text-align: left; padding: 4px; font-size: 16px; font-weight: bold;'>".LAN_LEAGUE_ROSTER_26."<br/>";		  					
		 $text .= team_links_H($team, $team_Name, $Saison);	
		 $text .= "</td>
		  					</tr>
		  					<tr>
		  						<td>
		  					</td></tr>
						</table>
				</td>
				<td style='text-align: rigth; width: 10%; vertical-align: top;'>";
		$text .= druckansicht("roster.php", 0, $team);
			if(ADMIN){
		$text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_roster_config.php?list.".$mannschaft_ID."' title='".LAN_LEAGUE_ROSTER_17."'>
						<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}			
		$text .="</td>
				</tr>
			</table>
";
$value_list_arry[3]['text']="2 min";
$value_list_arry[4]['text']="5 min";
$value_list_arry[5]['text']="10 min";
$value_list_arry[6]['text']="20 min";
$value_list_arry[7]['text']="2 min";
$value_list_arry[8]['text']="";

$value_list_arry[3]['value']=2;
$value_list_arry[4]['value']=5;
$value_list_arry[5]['value']=10;
$value_list_arry[6]['value']=20;
$value_list_arry[7]['value']=2;
$value_list_arry[8]['value']=0;		
////////////////+++++++++++++++++++++++++////////////////////////////////+++++++++++++++++++++++++////////////////+++++++++++++++++++++++++
$sql -> db_Select("league_roster", "*", "roster_team_id=".$team."");
if(!($row = $sql-> db_Fetch()))
  {
  $title = "<b>".LAN_LEAGUE_ROSTER_02." ".$team_Name." </b>";	
 	$text .= "</br></br></br><b><p align='center'>".LAN_LEAGUE_ROSTER_03."</b></br></br></br>";		
 	}
else
 {
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id   
   WHERE a.roster_team_id =".$team." ORDER BY a.roster_position, a.roster_jersy
   		";
	$sql->db_Select_gen($qry1);
	$count1=0;
  while($row = $sql-> db_Fetch())
  		{
 			$player[$count1]=$row;
			$count1++;   		
     	}
$Summegoals=0;$Summeassis=0;$Summepunkte=0;$Summestraffen=0;
for($i=0; $i < $count1 ;$i++)
		{
		$player[$i]['games']=player_games_count($player[$i]['roster_id']);// Spiele gespielt
		$player[$i]['goals']=player_games_count($player[$i]['roster_id']);// Tore geschoßen
		$Summegoals=$Summegoals+$player[$i]['goals'];					
		$player[$i]['assis']=player_assist_count($player[$i]['roster_id']);// Assis gemacht	
		$player[$i]['strafen']=player_strafe_count($player[$i]['roster_id']);// Strafen gemacht
		$Summeassis=$Summeassis+$player[$i]['assis'];
		$Summepunkte=$Summeassis+$Summegoals;
		$Summestraffen=$Summestraffen+$player[$i]['strafen'];
		$player[$i]['Points']=$player[$i]['goals']+$player[$i]['assis'];
		}
$straffe_D=$Summestraffen/$count1;
for($i=0; $i < $count1 ;$i++)
	{
	if($player[$i]['roster_position']>6)
		{
		$player[$i]['Points']="-/-";
		$player[$i]['color']="-/-";
		continue;
		}	
	if($player[$i]['strafen']>$straffe_D)	
		{
		$player[$i]['color']="<font style='color:#CC0000'>".$player[$i]['strafen']." min</font>";
		}
	else
		{
		$player[$i]['color']=$player[$i]['strafen']."  min";
		}
	}
/////////////////////////////////////////////////////////		
$text .= "<div style='width:100%; text-align: center;'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$STATIS[]="";
$STATIS[1]="<div style='color:#22aa22'>".LAN_LEAGUE_ROSTER_39."</div>";
$STATIS[2]="<div style='color:#aaaa00'>".LAN_LEAGUE_ROSTER_40."</div>";
$STATIS[3]="<div style='color:#ff0000'>".LAN_LEAGUE_ROSTER_41."</div";
$STATIS[4]="";

$POSTEXT[1]['text']=LAN_LEAGUE_ROSTER_10;
$POSTEXT[1]['zaehler']=0;
$POSTEXT[2]['text']=LAN_LEAGUE_ROSTER_11;
$POSTEXT[2]['zaehler']=0;
$POSTEXT[3]['text']=LAN_LEAGUE_ROSTER_13;
$POSTEXT[3]['zaehler']=0;
$POSTEXT[4]['text']=LAN_LEAGUE_ROSTER_12;
$POSTEXT[4]['zaehler']=0;
$POSTEXT[9]['text']=LAN_LEAGUE_ROSTER_14;
$POSTEXT[9]['zaehler']=0;
$POSTEXT[10]['text']=LAN_LEAGUE_ROSTER_15;
$POSTEXT[10]['zaehler']=0;
for($i=0;$i < $count1; $i++)     	
   {
   	$POSTEXT[$player[$i]['roster_position']]['zaehler']++;
  } 
$text .= "<tr>
		<td class='fcaption' style='width: 5%; text-align: center'><b>".LAN_LEAGUE_ROSTER_04."</b></td>
		<td class='fcaption'5><b>".LAN_LEAGUE_ROSTER_05."</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>".LAN_LEAGUE_ROSTER_38."</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>".LAN_LEAGUE_ROSTER_07."</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>".LAN_LEAGUE_ROSTER_08."</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>".LAN_LEAGUE_ROSTER_09."</b></td>
	</tr>";
	if(ADMIN){$ADM=true;}else{$ADM=false;}
	for($ZPOS=1;$ZPOS<11;$ZPOS++)
	{
	if($POSTEXT[$ZPOS]['zaehler']!=0)
	{
	$text .= "<tr>
		<td class='forumheader' colSpan='6'><b>".$POSTEXT[$ZPOS]['text']."</b></td>
	</tr>";
  for($i=0;$i < $count1; $i++)     	
    {
  if($player[$i]['roster_position']==$ZPOS)
     	{
     	$text .=player_row($player[$i]['roster_jersy'], $player[$i]['roster_id'], $player[$i]['players_name'], $STATIS[$player[$i]['roster_status']], $player[$i]['games'], $player[$i]['Points'],$player[$i]['color'],$mannschaft_ID,$ADM);
     	}
   else{continue;}
    } 	     	
   }
  else {continue;}
  }


$Lose=0;
for($i=0;$i < $count1; $i++)
 {if(!$player[7][$i]){$Lose++;}}
if($Lose >=1)  
  {
   $text .= "<tr>
  				<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_23."</b></td>
  			 </tr>";
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if(!$player[$i]['roster_position'])
     	{
     	$text .=player_row($player[$i]['roster_jersy'],$player[$i]['roster_id'],$player[$i]['players_name'],$STATIS[$player[$i]['roster_status']],$player[$i]['games'],$player[$i]['Points'],$player[$i]['color'],$mannschaft_ID,$ADM);
     	}
   else{continue;}
    }
 }   
$text .="</table></div>";
$Saison_liga=saison_liga_name($Liga_ID);
$title = "<b>".LAN_LEAGUE_ROSTER_02." ".$team_Name."  - ".$Saison_liga."</b>";

$text .= "<br /><div style='text-align:center'>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_LEAGUE_ROSTER_16."</b></div><br/>";
}

*/
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$title="Hall of Fame der ".$my_team['team_name'];
$ns -> tablerender($title, $text);
require_once(FOOTERF);
////////////////////////  Functionen ////////////////////////////////////////////////////////////////////////////
function get_statistik($roster_id)
{
$AUSGABE['games']=player_games_count($roster_id);
$AUSGABE['goals']=player_goals_count($roster_id);
$AUSGABE['assists']=player_assist_count($roster_id);
$Points_aus_archiv=get_archiv_data($roster_id);		
		if($Points_aus_archiv['player_points_1'] > $AUSGABE['games']){$AUSGABE['games']=$Points_aus_archiv['player_points_1'];}
		if($Points_aus_archiv['player_points_2'] > $AUSGABE['goals']){$AUSGABE['goals']=$Points_aus_archiv['player_points_2'];}
		if($Points_aus_archiv['player_points_3'] > $AUSGABE['assists']){$AUSGABE['assists']=$Points_aus_archiv['player_points_3'];}
return $AUSGABE;
}
//////////////////////// 
function sortieren($player,$sort,$richtung)
{
switch ($sort) {
		case 2:
		$sort_value="players_name";
    break;
  //---------------------
  	case 3:
		$sort_value="games";
    break;
  //---------------------
  		case 4:
		$sort_value="goals";
    break;
  //---------------------
  	case 5:
		$sort_value="assists";
    break;
  //---------------------
   	case 6:
		$sort_value="points";
    break;
  //---------------------
   	case 7:
		$sort_value="team_name";
    break;
  //---------------------
  default:
  	$sort_value="players_name";
			}
$anzahl=count($player);
for($i=0; $i < ($anzahl-1) ; $i++)
	{
	for($j=$i; $j < $anzahl ; $j++)
		{
		if($richtung==0)
			{
			if($player[$j][$sort_value] > $player[$i][$sort_value] )
				{
				$temp =	$player[$j];$player[$j]=$player[$i];$player[$i]=$temp;
				}
			}
		else
			{
			if($player[$j][$sort_value] < $player[$i][$sort_value] )
				{
				$temp =	$player[$j];$player[$j]=$player[$i];$player[$i]=$temp;
				}
			}
		}
	}
return $player;
}
?>