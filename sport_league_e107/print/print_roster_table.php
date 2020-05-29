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
|		$Source: ../e107_plugins/sport_league_e107/print_roster_table.php,v $
|		$Revision: 0.10 $
|		$Date: 2008/06/16 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");  

$HEADER="";
$FOOTER="";
$CUSTOMHEADER = "";
$CUSTOMFOOTER = "";

if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php");
}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/league_roster_lan.php");}

require_once("".e_PLUGIN."sport_league_e107/functionen.php");
$expand_autohide = "display:none; "; 
// ============= START OF THE BODY ====================================

if($_GET['Team']){$team=$_GET['Team'];}else{$team=$pref['lique_my_team'];}

$z['games']=0;
 		$sql -> db_Select("league_games", "*", "game_home_id=".$team." OR game_gast_id=".$team." ");
 		while($row = $sql-> db_Fetch()){
 		$z['games']++;
		}

	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$team."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();

		$mannschaft_ID=$row['leagueteam_id'];
		$Liga_ID=$row['leagueteam_league_id'];
 		$team_ID=$row['team_id'];
 		$team_Name=$row['team_name'];
 		$team_admin=$row['team_admin_id'];
 		$team_url=$row['team_url'];
 		$team_icon=$row['team_icon'];
 		$team_description=$row['team_description'];

if($_GET['Saison']){$Saison=$_GET['Saison'];}else{$Saison=$Liga_ID;}


$z['players']=0;
 		$sql -> db_Select("league_roster", "*", "roster_team_id=".$team."");
 		while($row = $sql-> db_Fetch()){
 		$z['players']++;
		}

///////////////////////////////////

$expand_autohide = "display:none; ";
if($_GET['Template']){
				$text ="<link rel='stylesheet' type='text/css' media='screen' href='".e_THEME."".$_GET['Template']."/style.css'>";
				}
else{$text ="<link rel='stylesheet' type='text/css' media='screen' href='".THEME."style.css'>";}
$text .= "<link rel='stylesheet' type='text/css' 
	media='screen' href='".THEME."style.css'> <div style='width:100%; text-align: center;'>";
$text .= "
				<table style='width:100%' cellspacing='0' cellpadding='0'>
		  		<tr>
						<td style='text-align: center; width: 40%; vertical-align: top;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_icon."' height='140'/></td>
						<td style='text-align: left; width: 60%; vertical-align: top;'>
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
				</tr>
			</table>
"; 		
////////////////+++++++++++++++++++++++++////////////////////////////////+++++++++++++++++++++++++////////////////+++++++++++++++++++++++++
$sql -> db_Select("league_roster", "*", "roster_team_id=".$team."");
if(!($row = $sql-> db_Fetch()))
  { 	
 	$text .= "</br></br></br><b><p align='center'>".LAN_LEAGUE_ROSTER_03."</b></br></br></br>";		
 	}
else
 {
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id   
   WHERE a.roster_team_id =".$team." ORDER BY roster_id
   		";
	$sql->db_Select_gen($qry1);
	$count1=0;
  while($row = $sql-> db_Fetch())
  		{
 			$player[$count1][0]=$row['roster_id'];
			$player[$count1][2]=$row['roster_saison_id'];
			$player[$count1][3]=$row['roster_player_id'];
			$player[$count1][4]=$row['roster_team_id'];
			$player[$count1][1]=$row['roster_status'];			
			$player[$count1][5]=$row['roster_jersy'];
			$player[$count1][6]=$row['roster_imfeld'];
			$player[$count1][7]=$row['roster_position'];
			$player[$count1][8]=$row['roster_imfeld'];
			$player[$count1][9]=$row['roster_description'];			
			$player[$count1][16]=$row['players_id'];
			$player[$count1][17]=$row['players_name'];
			$player[$count1][18]=$row['players_user_id'];
			$player[$count1][19]=$row['players_admin_id'];
			$player[$count1][20]=$row['players_url'];
			$player[$count1][21]=$row['players_mail'];
			$player[$count1][22]=$row['players_location'];
			$player[$count1][23]=$row['players_icon'];
			$player[$count1][24]=$row['players_burthday'];
			$player[$count1][25]=$row['players_site'];
			$player[$count1][26]=$row['players_wigth'];
			$player[$count1][27]=$row['players_height'];
			$player[$count1][28]=$row['players_visier'];
			$player[$count1][29]=$row['players_description'];
			$count1++;   		
     	}
$Summegoals=0;$Summeassis=0;$Summepunkte=0;
for($i=0; $i < $count1 ;$i++)
		{
			$player[$i][10]=0;// Spiele gespielt
			$sql -> db_Select("lique_anw", "*","anw_player_id='".$player[$i][0]."'");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i][10]++;
				}
			$player[$i][11]=0;// Tore geschoßen
			$sql -> db_Select("lique_points", "*","points_player_id='".$player[$i][0]."' AND points_value= 1");
			while($row = $sql-> db_Fetch())
   			{
   			$player[11][$i]++;
				}
			$Summegoals=$Summegoals+$player[11][$i];
			$player[$i][12]=0;// Assis gemacht
			$sql -> db_Select("lique_points", "*","points_player_id='".$player[$i][0]."' AND points_value= 2");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i][12]++;
				}
			$Summeassis=$Summeassis+$player[$i][12];
		$Summepunkte=$Summeassis+$Summegoals;
		$player[$i][30]=$player[$i][11]+$player[$i][12];
		}
/////////////////////////////////////////////////////////		
for($i=0; $i < $count1 ;$i++)
		{	$player[$i][31]=0;// Strafminuten auf null
			$player[$i][11]=0;// 2 min
			
			$sql -> db_Select("lique_foults", "*","foults_player_id='".$player[$i][0]."' AND foults_value= 1");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i][11]=$player[$i][11]+2;
				}
			$Summe2=$Summe2+$player[$i][11];
			$player[$i][12]=0;// 5 min
			
			$sql -> db_Select("lique_foults", "*","foults_player_id='".$player[$i][0]."' AND foults_value= 2");
			while($row = $sql-> db_Fetch())
   			{
   			$player[12][$i]=$player[12][$i]+5;
				}
		$Summe5=$Summe5+$player[$i][12];
			$player[$i][13]=0;// 10 min
			
			$sql -> db_Select("lique_foults", "*","foults_player_id='".$player[$i][0]."' AND foults_value= 3");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i][13]=$player[$i][13]+10; 
				}
		$Summe10=$Summe10+$player[$i][31];		
		
		$Summestrafen=$Summe2+$Summe5+$Summe10;
		$player[$i][31]=$player[$i][11]+$player[$i][12]+$player[$i][13];
		}
////////////////Sort ///////////       
  for($j=0;$j<($count1-1);$j++)
   		{   
      for($i=$j+1;$i<($count1);$i++)
   			{
      	if(($player[$j][5]== $player[$i][5])&&(($player[$j][17] > $player[$i][17]))||($player[$j][5] > $player[$i][5]))
        		{
         		for($k=0;$k< 32;$k++)
           		{
           		$zwisch[$k]=$player[$j][$k];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$player[$j][$k]=$player[$i][$k];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$player[$i][$k]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
///////////////////////////////////
$text .= "<div style='width:100%; text-align: center;'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

 $text .= "	<tr>
		<td class='fcaption' style='width: 5%; text-align: center'><b>".LAN_LEAGUE_ROSTER_04."</b></td>
		<td class='fcaption'5><b>".LAN_LEAGUE_ROSTER_05."</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>".LAN_LEAGUE_ROSTER_06."</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>".LAN_LEAGUE_ROSTER_07."</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>".LAN_LEAGUE_ROSTER_08."</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>".LAN_LEAGUE_ROSTER_09."</b></td>
	</tr>
	<tr>
		<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_10."</b></td>
	</tr>";
	
  for($i=0;$i < $count1; $i++)     	
    {
  if($player[$i][7]=='1')
     	{	
     	$text .=player_row($player[$i][5], $player[$i][0], $player[$i][17], $player[$i][27], $player[$i][26], $player[$i][30], $player[$i][31]);
     	}
   else{continue;}
    } 	     	
  $text .= "<tr>                                                         
  						<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_11."</b></td>
  					</tr>";
	
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if($player[$i][7]=='2')
     	{	
     	$text .=player_row($player[$i][5], $player[$i][0], $player[$i][17], $player[$i][27], $player[$i][26], $player[$i][30], $player[$i][31]);
     	}
   else{continue;}
    }

if($pref['lique_sport']==2)
  {
  $text .= "<tr>                                                         
  						<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_12."</b></td>
  					</tr>";
	
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if($player[$i][7]=='6')
     	{	
     	$text .=player_row($player[$i][5],$player[$i][0],$player[$i][17],$player[$i][27],$player[$i][26],$player[$i][30],$player[$i][31]);
     	}
   else{continue;}
    }                                                      
  }
  $text .= "<tr>                                                         
  						<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_13."</b></td>
  					</tr>";

	
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if($player[$i][7]=='3')
     	{	
     	$text .=player_row($player[$i][5],$player[$i][0],$player[$i][17],$player[$i][27],$player[$i][26],$player[$i][30],$player[$i][31]);
     	}
   else{continue;}
    } 
     	
     	
     	  $text .= "<tr>                                                         
  						<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_14."</b></td>
  					</tr>";
	
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if($player[$i][7]=='4')
     	{	
     	$text .=player_row($player[$i][5],$player[$i][0],$player[$i][17],$player[$i][27],$player[$i][26],$player[$i][30],$player[$i][31]);
     	}
   else{continue;}
    }  
     	  $text .= "<tr>                                                         
  						<td class='forumheader' colSpan='6'><b>".LAN_LEAGUE_ROSTER_15."</b></td>
  					</tr>";
  for($i=0;$i < $count1; $i++)     	
    { 	    	
  if($player[$i][7]=='5')
     	{	
     	$text .=player_row($player[$i][5],$player[$i][0],$player[$i][17],$player[$i][27],$player[$i][26],$player[$i][30],$player[$i][31]);
     	}
   else{continue;}
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
  if(!$player[$i][7])
     	{	
     	$text .=player_row($player[$i][5],$player[$i][0],$player[$i][17],$player[$i][27],$player[$i][26],$player[$i][30],$player[$i][31]);
     	}
   else{continue;}
    }
 }   
$text .="</table></div>";

$title = "<b>".LAN_LEAGUE_ROSTER_02." ".$team_Name." </b>";

$text .= "<br /><div style='text-align:center'>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_LEAGUE_ROSTER_16."</b></div><br/>";
}
$text .=powered_by();
$text .="</div>";
echo $ns -> tablerender($title, $text); 


////////////////////////  Functionen ////////////////////////////////////////////////////////////////////////////
function player_row($NUMMBER,$PLAYERID,$PLAYERNAME,$PLAYERFIELD1,$PLAYERFIELD2,$PLAYERPOINTS,$PLAYERPENALTY)
	{
 	$ROWTEXT = "<tr>"; 
 	$ROWTEXT .= "<td class='forumheader3' style='width:5%; text-align:right;'><b>&nbsp;".$NUMMBER."</b></td>"; 
 	$ROWTEXT .= "<td class='forumheader3'><b><a href='print_profil.php?player_id=".$PLAYERID."'>".$PLAYERNAME."</a></b></td>"; 
 	$ROWTEXT .= "<td class='forumheader3' style='width:15%; text-align:center;'><b>".$PLAYERFIELD1."</b></td>"; 
 	$ROWTEXT .= "<td class='forumheader3' style='width:10%; text-align:center;'><b>".$PLAYERFIELD2."</b></td>"; 
 	$ROWTEXT .= "<td class='forumheader3' style='width:10%; text-align:center;'><b>".$PLAYERPOINTS."</b></td>"; 
 	$ROWTEXT .= "<td class='forumheader3' style='width:10%; text-align:center;";
 	//if($PLAYERPENALTY>($Summestrafen/$count1)){$ROWTEXT .= "color:#ff0000;";}
	$ROWTEXT .= "'><b>".$PLAYERPENALTY." min</b></td>"; 
 	$ROWTEXT .= "</tr>"; 
	return $ROWTEXT;	
	} 
?>