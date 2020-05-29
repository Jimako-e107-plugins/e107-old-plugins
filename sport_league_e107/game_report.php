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
|		$Source: ../e107_plugins/sport_league_e107/game_report.php  $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once("league_stats_count.php");                                                                                
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_games_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_games_lan.php");
require_once("functionen.php");
// ============= START OF THE BODY ====================================
	$sql -> db_Select("league_games", "*", "game_id=".$_GET['game_id']."");
  $count1=0;
  while($row = $sql-> db_Fetch())
     	{
 			$game[0]=$row['game_id'];
			$game[1]=$row['game_kuerzel'];
			$game[2]=$row['game_saison_id'];
			$game[3]=$row['game_week'];
			$game[4]=$row['game_date'];
			$game[5]=$row['game_time'];
			$game[6]=$row['game_home_id'];
			$game[7]=$row['game_gast_id'];
			$game[8]=$row['game_goals_home'];
			$game[9]=$row['game_goals_gast'];
			$game[10]=$row['game_un'];
			$game[11]=$row['game_enable'];
			$game[12]=$row['game_news_id'];
			$game[13]=$row['game_description'];
			$count1++;
     	}    	
///++++++++++++++++++++Heim Mannschaft++++++++++++++++++++++++++++++++++++++++++++++
$qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_id=".$game[6]."
   		";
	$sql->db_Select_gen($qry1); 
 	$row = $sql-> db_Fetch();
 	 	$game[16]=$row['liga_team_id'];
 		//$game[    8]=$row['team_id'];       	// Home Mannschaft  ID                                                                     
 		$game[21]=$row['team_icon'];     	// Home Mannschaft  Logo                                                                    
 		$game[20]=$row['team_url'];     	// Home Mannschaft  URL                                                                       
 		$game[17]=$row['team_name'];    	// Home Mannschaft  Name   
 		$game[22]=$row['team_description'];  	     	
///+++++++++++++++++++++Gast Mannschaft+++++++++++++++++++++++++++++++++++++++++++++     	
 $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_id=".$game[7]."
   		";
	$sql->db_Select_gen($qry1); 
 	$row = $sql-> db_Fetch();
 	 	$game[23]=$row['liga_team_id'];
 		//$game[    8]=$row['team_id'];       	// Gast Mannschaft  ID                                                                     
 		$game[28]=$row['team_icon'];     	// Gast Mannschaft  Logo                                                                    
 		$game[27]=$row['team_url'];     	// Gast Mannschaft  URL                                                                       
 		$game[24]=$row['team_name'];    	// Gast Mannschaft  Name   
 		$game[29]=$row['team_description']; 
 		$game[25]=$row['team_kurzname'];
 		$game[26]=$row['team_admin_id'];    
///+++++++++++++++++++++Tore+++++++++++++++++++++++++++++++++++++++++++++
$point['home'][1]=0;
$point['home'][2]=0;
$point['home'][3]=0;
$point['gast'][1]=0;
$point['gast'][2]=0;
$point['gast'][3]=0;

$POSITION_TEXT[1]['text']=LAN_LEAGUE_GAMES_30;
$POSITION_TEXT[1]['zaehler']=0;
$POSITION_TEXT[2]['text']=LAN_LEAGUE_GAMES_31;
$POSITION_TEXT[2]['zaehler']=0;
$POSITION_TEXT[3]['text']=LAN_LEAGUE_GAMES_32;
$POSITION_TEXT[3]['zaehler']=0;
$POSITION_TEXT[9]['text']=LAN_LEAGUE_GAMES_33;
$POSITION_TEXT[9]['zaehler']=0;
$POSITION_TEXT[10]['text']=LAN_LEAGUE_GAMES_33a;
$POSITION_TEXT[10]['zaehler']=0;
$POSITION_TEXT[11]['text']=LAN_LEAGUE_GAMES_34;
$POSITION_TEXT[11]['zaehler']=0;
$POSITION_TEXT[4]['text']=LAN_LEAGUE_GAMES_35;
$POSITION_TEXT[4]['zaehler']=0;
$POSITION_TEXT[7]['text']="";
$POSITION_TEXT[7]['zaehler']=0;

$PERIOD1=$pref['sport_league_times'];
$PERIOD1.=":00";
$PERIOD2=$pref['sport_league_times']*2;
$PERIOD2.=":00";



$sql -> db_Select("league_points", "*", "points_game_id=".$game[0]." AND points_team_id='".$game[6]."' AND points_value=1 ORDER BY points_time");
  $pointcount=0;
  while($row = $sql-> db_Fetch())
     	{
     		if($row['points_time']< $PERIOD1 )
     			{
     			$point['home'][1]++;
     			}
     		if($row['points_time']< $PERIOD2 && $row['points_time']> $PERIOD1)
     			{
     			$point['home'][2]++;
     			}
     		if($row['points_time']> $PERIOD2 )
     			{
     			$point['home'][3]++;
     			}
			$pointcount++;
     	}
/////----------------------------------
$sql -> db_Select("league_points", "*", "points_game_id=".$game[0]." AND points_team_id='".$game[7]."' AND points_value=1 ORDER BY points_time");
  $pointcount=0;
  while($row = $sql-> db_Fetch())
     	{
     		if($row['points_time']< $PERIOD1 )
     			{
     			$point['gast'][1]++;
     			}
     		if($row['points_time']< $PERIOD2 && $row['points_time']> $PERIOD1)
     			{
     			$point['gast'][2]++;
     			}
     		if($row['points_time']> $PERIOD2 )
     			{
     			$point['gast'][3]++;
     			}
			$pointcount++;
     	}
////////////////// Verlauf Tore+++++++++++++++++++++++++++++
 $qry1="
   SELECT a.*, au.*, ae.* FROM ".MPREFIX."league_points AS a
   LEFT JOIN ".MPREFIX."league_roster AS au ON au.roster_id=a.points_player_id 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=au.roster_player_id   
   WHERE a.points_game_id=".$game[0]." AND points_value < '3'  ORDER BY points_time
   		";
	$sql->db_Select_gen($qry1);
	$goalscount=0;
 	while($row = $sql-> db_Fetch())
  	{	
			$goals[0][$goalscount]=$row['points_id'];//ID
			$goals[1][$goalscount]=$row['points_time']; 
			$goals[2][$goalscount]=$row['points_value'];
			$goals[3][$goalscount]=$row['points_team_id'];
			$goals[4][$goalscount]=$row['roster_id'];
			$goals[5][$goalscount]=$row['roster_jersy'];
			$goals[6][$goalscount]=$row['roster_imfeld'];
			$goals[7][$goalscount]=$row['roster_position'];
			if($row['players_name']==''){$goals[8][$goalscount]="".LAN_LEAGUE_GAMES_14."".$row['points_player_id']."".LAN_LEAGUE_GAMES_15."".$row['points_id']."";}
			else{$goals[8][$goalscount]=player_shortname($row['players_name']);}
			$goals[9][$goalscount]=$row['players_user_id'];
			$goals[10][$goalscount] = ($row['roster_image']!="")?$row['roster_image']:$row['players_image'];
			$goals[10][$goalscount] = ($goals[10][$goalscount]!="")? $goals[10][$goalscount]:"default.jpg";
			$goals[11][$goalscount]=$row['players_site'];
			$goalscount++;
		}
$P=0;
for($i=0; $i < $goalscount; $i++)
	{
	$ereigniss[$P][0]=0;
	$ereigniss[$P][1]=0;
	$ereigniss[$P][2]=0;
	$ereigniss[$P][3]=0;
	$ereigniss[$P][4]=0;
	$ereigniss[$P][5]=0;
	$ereigniss[$P][6]=0;
	$ereigniss[$P][7]=0;
	$ereigniss[$P][8]=0;
	$ereigniss[$P][9]=0;
	$ereigniss[$P][10]=0;
	$ereigniss[$P][11]=0;
	$ereigniss[$P][12]=0;
	$ereigniss[$P][13]=0;
	$ereigniss[$P][14]=0;
	
	
	 if($goals[2][$i]==1)
	 		{
	 		 $ereigniss[$P][0]=$goals[1][$i];/// Zeit
	 		 $ereigniss[$P][1]=$goals[4][$i];/// Roster ID
	 		 $ereigniss[$P][2]=$goals[5][$i];/// roster_jersy
	 		 $ereigniss[$P][3]=$goals[7][$i];/// roster_position
	 		 $ereigniss[$P][4]=$goals[8][$i];/// players_name
	 		 $ereigniss[$P][13]=$goals[3][$i];// Team ID
	 		 $ereigniss[$P][14]=10;// points_value
	 		 $ereigniss[$P][15]=$goals[10][$i];
	 		 $P++; 
	 		}
	}

for($i=0; $i < $P; $i++)
	{
	for($j=0; $j < $goalscount; $j++)
		{
		if($goals[1][$j]==$ereigniss[$i][0] && $goals[2][$j]==2)
			{
			 if($ereigniss[$i][5]!="")
			 		{
			 		$ereigniss[$i][9]=$goals[4][$j];/// Roster ID
	 				$ereigniss[$i][10]=$goals[5][$j];/// roster_jersy
	 				$ereigniss[$i][11]=$goals[7][$j];/// roster_position
	 				$ereigniss[$i][12]=$goals[8][$j];/// players_name
	 				$ereigniss[$i][13]=$goals[3][$j];// Team ID
	 				$ereigniss[$i][17]=$goals[10][$j];
			 		}
			 	else{
			 		$ereigniss[$i][5]=$goals[4][$j];/// Roster ID
	 				$ereigniss[$i][6]=$goals[5][$j];/// roster_jersy
	 				$ereigniss[$i][7]=$goals[7][$j];/// roster_position
	 				$ereigniss[$i][8]=$goals[8][$j];/// players_name
	 				$ereigniss[$i][13]=$goals[3][$j];// Team ID
	 				$ereigniss[$i][16]=$goals[10][$j];
			 	}
			}
		}
	}
////////////////// Verlauf Strafen+++++++++++++++++++++++++++++
 $qry1="
   SELECT a.*, au.*, ae.* FROM ".MPREFIX."league_points AS a
   LEFT JOIN ".MPREFIX."league_roster AS au ON au.roster_id=a.points_player_id 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=au.roster_player_id   
   WHERE a.points_game_id=".$game[0]." AND points_value >'2' ORDER BY points_time
   		";
	$sql->db_Select_gen($qry1);
	$foultcount=0;
 	while($row = $sql-> db_Fetch())
  	{	
			$foult[0][$foultcount]=$row['points_id'];//ID
			$foult[1][$foultcount]=$row['points_time']; 
			$foult[2][$foultcount]=$row['points_value'];
			$foult[3][$foultcount]=$row['points_team_id'];
			$foult[4][$foultcount]=$row['roster_id'];
			$foult[5][$foultcount]=$row['roster_jersy'];
			$foult[6][$foultcount]=$row['roster_imfeld'];
			$foult[7][$foultcount]=$row['roster_position'];
			if($row['players_name']==''){$foult[8][$foultcount]="".LAN_LEAGUE_GAMES_14."".$row['points_player_id']."".LAN_LEAGUE_GAMES_15."".$row['points_id']."";}
			else{$foult[8][$foultcount]=player_shortname($row['players_name']);}
			$foult[9][$foultcount]=$row['players_user_id'];
			$foult[10][$foultcount] = ($row['roster_image']!="")? $row['roster_image']:$row['players_image'];
			$foult[10][$foultcount] = ($foult[10][$foultcount]!="")? $foult[10][$foultcount]:"default.jpg";
			$foult[11][$foultcount]=$row['players_site'];
			$foultcount++;
		}
$Z=0;
for($i=0; $i < $foultcount; $i++)
	{
	 $ereigniss[$P+$i][0]=$foult[1][$i];/// Zeit
	 $ereigniss[$P+$i][1]=$foult[4][$i];/// Roster ID
	 $ereigniss[$P+$i][2]=$foult[5][$i];/// roster_jersy
	 $ereigniss[$P+$i][3]=$foult[7][$i];/// roster_position
	 $ereigniss[$P+$i][4]=$foult[8][$i];/// players_name
	 $ereigniss[$P+$i][13]=$foult[3][$i];// Team ID
	 $ereigniss[$P+$i][14]=$foult[2][$i];// foult_value
	 $ereigniss[$P+$i][15]=$foult[10][$i];// bild
	 $Z++;
	}
$EreigCount=$P+$Z;
////////////////// Sortierung-----
  for($j=0;$j<($EreigCount-1);$j++)
   		{   
      for($i=$j+1;$i<($EreigCount);$i++)
   			{
      	if(($ereigniss[$j][0]==$ereigniss[$i][0]&&$ereigniss[$j][1]>$ereigniss[$i][1])||($ereigniss[$j][0]> $ereigniss[$i][0]))
        		{
           	$zwisch=$ereigniss[$j];
           	$ereigniss[$j]=$ereigniss[$i];
           	$ereigniss[$i]=$zwisch;
        		}
  			 }
  		}
 /////////////////////////////////// Straffen zusammen rechnen ---------------
$Straffen_Home['2min']=0;
$Straffen_Home['Disz']=0;
$Straffen_Gast['2min']=0;
$Straffen_Gast['Disz']=0;
 for($w=0;$w<($EreigCount);$w++)
   		{  
			if($ereigniss[$w][14]!=10)			//////  Ist Ereigniss kein Tor.....
				{
				if($ereigniss[$w][13]==$game[6]) ///// Ist es Heim Team....
					{
					switch ($ereigniss[$w][14]) 
								{
								case 3:
										$Straffen_Home['2min']=$Straffen_Home['2min']+2;	///  2 Min
                    break;
                case 4:
										$Straffen_Home['Disz']=$Straffen_Home['Disz']+5;	///  5 Min
                    break;
                case 5:
										$Straffen_Home['Disz']=$Straffen_Home['Disz']+10;	///  10 Min
                    break;
                case 6:
										$Straffen_Home['Disz']=$Straffen_Home['Disz']+20;	///  20 Min
                    break;      
                }      						
					}
			elseif($ereigniss[$w][13]==$game[7])	///// Ist es Gast Team....
					{
					switch ($ereigniss[$w][14]) 
								{
								case 3:
										$Straffen_Gast['2min']=$Straffen_Gast['2min']+2; ///  2 Min
                    break;
                case 4:
										$Straffen_Gast['Disz']=$Straffen_Gast['Disz']+5; ///  5 Min
                    break;
                case 5:
										$Straffen_Gast['Disz']=$Straffen_Gast['Disz']+10; ///  10 Min
                    break;
                case 6:
										$Straffen_Gast['Disz']=$Straffen_Gast['Disz']+20; ///  20 Min
                    break;       
                }
					}
			else continue;
				}
			}
//////////////////
$Value[3]="2 Min";
$Value[4]="5 Min";
$Value[5]="10 Min";
$Value[6]="20 Min";
$Value[10]="<b>".LAN_LEAGUE_GAMES_44."</b>"; 
/////----------------------------------
////////////////// Spieler Home+++++++++++++++++++++++++++++
 $qry1="
   SELECT a.*, au.*, ae.* FROM ".MPREFIX."league_anw AS a
   LEFT JOIN ".MPREFIX."league_roster AS au ON au.roster_id=a.anw_player_id 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=au.roster_player_id   
   WHERE a.anw_team_id=".$game[6]." AND a.anw_game_id=".$game[0]."
   		";
	$sql->db_Select_gen($qry1);
	$homecount=0;
 	while($row = $sql-> db_Fetch())
  	{	
			$player_Home[0][$homecount]=$row['roster_id'];//ID
			$player_Home[1][$homecount]=$row['roster_saison_id']; 
			$player_Home[2][$homecount]=$row['roster_player_id'];
			$player_Home[3][$homecount]=$row['roster_team_id'];
			$player_Home[4][$homecount]=$row['roster_status'];
			$player_Home[5][$homecount]=$row['roster_jersy'];
			$player_Home[6][$homecount]=$row['roster_imfeld'];
			$player_Home[7][$homecount]=$row['roster_position'];
			$player_Home[8][$homecount]=$row['roster_description'];
			$player_Home[9][$homecount]=$row['players_name'];
			$player_Home[11][$homecount] = ($row['roster_image']!="")?$row['roster_image']:$row['players_image'];
			$player_Home[11][$homecount] = ($player_Home[11][$homecount]!="")? $player_Home[11][$homecount]:"default.jpg";
			$player_Home[10][$homecount]=$row['players_user_id'];
			$player_Home[12][$homecount]=$row['players_site'];
			$homecount++;
		}

//////////////////////////Sortieren nach Position & Nr
  for($j=0;$j<($homecount-1);$j++)
   		{   
      for($i=$j+1;$i<($homecount);$i++)
   			{
      	if(($player_Home[7][$j]== $player_Home[7][$i])&&(($player_Home[5][$j]> $player_Home[5][$i]))||($player_Home[7][$j]< $player_Home[7][$i]))
        		{
         		for($k=0;$k< 13;$k++)
           		{
           		$zwisch[$k]=$player_Home[$k][$j];
           		}
        		for($k=0;$k< 13;$k++)
           		{
           		$player_Home[$k][$j]=$player_Home[$k][$i];
           		}
        		for($k=0;$k< 13;$k++)
           		{
           		$player_Home[$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 

////////////////// Spieler Gast+++++++++++++++++++++++++++++

 $qry1="
   SELECT a.*, au.*, ae.* FROM ".MPREFIX."league_anw AS a
   LEFT JOIN ".MPREFIX."league_roster AS au ON au.roster_id=a.anw_player_id 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=au.roster_player_id   
   WHERE a.anw_team_id=".$game[7]." AND a.anw_game_id=".$game[0]."
   		";
	$sql->db_Select_gen($qry1);
	$gastcount=0;
 	while($row = $sql-> db_Fetch())
  	{	
			$player_Gast[0][$gastcount]=$row['roster_id'];//ID
			$player_Gast[1][$gastcount]=$row['roster_saison_id']; 
			$player_Gast[2][$gastcount]=$row['roster_player_id'];
			$player_Gast[3][$gastcount]=$row['roster_team_id'];
			$player_Gast[4][$gastcount]=$row['roster_status'];
			$player_Gast[5][$gastcount]=$row['roster_jersy'];
			$player_Gast[6][$gastcount]=$row['roster_imfeld'];
			$player_Gast[7][$gastcount]=$row['roster_position'];
			$player_Gast[8][$gastcount]=$row['roster_description'];
			$player_Gast[9][$gastcount]=$row['players_name'];
			$player_Gast[10][$gastcount]=$row['players_user_id'];
			$player_Gast[11][$gastcount] = ($row['roster_image']!="")?$row['roster_image']:$row['players_image'];
			$player_Gast[11][$gastcount] = ($player_Gast[11][$gastcount]!="")? $player_Gast[11][$gastcount]:"default.jpg";
			$player_Gast[12][$gastcount]=$row['players_site'];
			$gastcount++;
		}
//////////////////////////Sortieren nach Position & Nr
  for($j=0;$j<($gastcount-1);$j++)
   		{   
      for($i=$j+1;$i<($gastcount);$i++)
   			{
      	if(($player_Gast[7][$j]== $player_Gast[7][$i])&&(($player_Gast[5][$j]> $player_Gast[5][$i]))||($player_Gast[7][$j]< $player_Gast[7][$i]))
        		{
         		for($k=0;$k< 13;$k++)
           		{
           		$zwisch[$k]=$player_Gast[$k][$j];
           		}
        		for($k=0;$k< 13;$k++)
           		{
           		$player_Gast[$k][$j]=$player_Gast[$k][$i];
           		}
        		for($k=0;$k< 13;$k++)
           		{
           		$player_Gast[$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
///////////////////   Spieldaten   ------------------------------------------
$text ="<script type=\"text/javascript\" src=\"".e_PLUGIN."sport_league_e107/handler/wz_tooltip.js\"></script>
<table class='fborder' style='WIDTH: 100%' cellSpacing='0' cellPadding='0'>
	<tr>
		<td width='100%' valign='top'>
			<table class='fborder' style='WIDTH: 100%' cellSpacing='0' cellPadding='0'>
				<tr>
					<td style='text-align:right;width:45%;'>".LAN_LEAGUE_GAMES_16." ".$Straffen_Home['2min']." ".LAN_LEAGUE_GAMES_17." + ".$Straffen_Home['Disz']." ".LAN_LEAGUE_GAMES_18.".</td>
					<td style='text-align:center;width:10%;'>&nbsp;</td>
					<td style='text-align:left;width:45%;'>".LAN_LEAGUE_GAMES_16." ".$Straffen_Gast['2min']." ".LAN_LEAGUE_GAMES_17." + ".$Straffen_Gast['Disz']." ".LAN_LEAGUE_GAMES_18.".</td>
				</tr>
				<tr>
					<td style='text-align:right;width:45%;'><img border='0' src='logos/big/".$game[21]."' width='80%'>&nbsp;&nbsp;
					</td>
					<td style='text-align:center;width:10%;'>&nbsp;</td>
					<td style='text-align:left;width:45%;'>&nbsp;&nbsp;<img border='0' src='logos/big/".$game[28]."' width='80%'>
					</td>
				</tr>
				<tr>
					<td style='text-align:right;width:45%;'><font color='#800000'><b><font size='4'>".$game[17]."</font></b></font></td>
					<td style='text-align:center;width:10%;'>".LAN_LEAGUE_GAMES_19."</td>
					<td style='text-align:left;width:45%;'><b><font size='4' color='#000080'>".$game[24]."</font></b></td></tr>
				<tr>
					<td style='text-align:right;width:45%;'><b><font size='6'>".$game[8]."</font></b></td>
					<td style='text-align:center;width:10%;'><b><font size='6'>:</font></b></td>
					<td style='text-align:left;width:45%;'><b><font size='6'>".$game[9]."</font>";
if($game[10]==1)
	{
	$text .=LAN_LEAGUE_GAMES_ADMIN_32;	
	}					
	$text .="</b></td>
				</tr>
				<tr>
					<td style='text-align:center;width:100%;' colspan='3'>(".$point['home'][1].":".$point['gast'][1]."";
					if($pref['sport_league_periods']>1){
					$text .=" / ".$point['home'][2].":".$point['gast'][2]." ";}
					if($pref['sport_league_periods']>2){
					$text .=" / ".$point['home'][3].":".$point['gast'][3]."";}
					$text .=")</td>
				</tr>
				</table>
		</td>
	</tr>
	</table>";
//////////////////////////////////////////////////////////////
$expand_autohide = "display:none; ";

///////////////////-----------------------------------------------------------------------
$text.= "<div id='exp_Aufstellung'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:50%; height: 40px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_Aufstellung'), expandit('exp_Spielverlauf')\"><b>".LAN_LEAGUE_GAMES_20."</b></div>
						</td>	
					</tr>
				</table>
				<br/>			
				<div style='width:100%; text-align: center; vertical-align: top;'><b>".LAN_LEAGUE_GAMES_21."</b><br/>
				<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='width:50%; vertical-align:top;'>";
if($homecount > 0)
	 {$text .="<table style='width:100%;height:100%;' class='fborder' cellspacing='0' cellpadding='0'>";	
		for($i=0; $i< $homecount; $i++)
			{
			$POSITION_TEXT[$player_Home[7][$i]]['zaehler']++;
			}				
			
		for($j=1; $j< 11; $j++)
					{
					if($POSITION_TEXT[$j]['zaehler']!=0)
					{										
						$text .="<tr><td class='fcaption' style='text-align: center; width: 10%;'>".LAN_LEAGUE_GAMES_22."</td>
										<td class='fcaption' style='text-align: center; width: 90%;'>".$POSITION_TEXT[$j]['text']."</td>
									</tr>
									";
					for($i=0; $i< $homecount; $i++)
						{
						if($player_Home[7][$i]==$j)
								{
									$text .="<tr>
														<td class='forumheader3'><a href='profil.php?player_id=".$player_Home[0][$i]."' style='color:#800000'>".$player_Home[5][$i]."</a></td>
														<td class='forumheader3'><a href='profil.php?player_id=".$player_Home[0][$i]."' style='color:#800000'>";
									$text .="		<a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$player_Home[0][$i]."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$player_Home[11][$i]."\' width=\'120\'><br/>".$player_Home[9][$i]."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"> ".$player_Home[9][$i]."</a>";														
									$text .="</td>
													</tr>";
								}
							}
						}
					 }
				$text .="</table>";	
					}
		else
			{
			$text .="<div style='height:100%;text-align:center;vertical-align:middle;' colspan='2'>".LAN_LEAGUE_GAMES_43."</div>";
			}
/////////// Anzahl auf 0 wieder setzen	
for($j=1; $j< 11; $j++)
					{
					$POSITION_TEXT[$j]['zaehler']=0;
					}

	$text .="
				</td><td style='text-align: center; width: 5px;'></td>
				<td style='width:50%; vertical-align:top;'>";
if($gastcount > 0)
	 {$text .="<table style='width:100%;height:100%;' class='fborder' cellspacing='0' cellpadding='0'>";
	for($i=0; $i< $gastcount; $i++)
		{
		$POSITION_TEXT[$player_Gast[7][$i]]['zaehler']++;
		}					
 
	for($j=1; $j< 11; $j++)
					{
		if($POSITION_TEXT[$j]['zaehler']!=0)
					{										
		$text .="<tr/>
						<td class='fcaption' style='text-align: center; width: 20%;'>".LAN_LEAGUE_GAMES_22."</td>
						<td class='fcaption' style='text-align: center; width: 80%;'>".$POSITION_TEXT[$j]['text']."</td>
									";
				for($i=0; $i< $gastcount; $i++)
						{
						if($player_Gast[7][$i]==$j)
								{
									$text .="<tr>
														<td class='forumheader3'><a href='profil.php?player_id=".$player_Gast[0][$i]."' style='color:#000080'>".$player_Gast[5][$i]."</a></td>
														<td class='forumheader3'><a href='profil.php?player_id=".$player_Gast[0][$i]."' style='color:#000080'>";
									$text .="		<a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$player_Gast[0][$i]."\" style=\"color:#000080\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$player_Gast[11][$i]."\' width=\'120\'><br/>".$player_Gast[9][$i]."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"> ".$player_Gast[9][$i]."</a>";														
									$text .="</td>
													</tr>";
								}
							}
						}
					 }
				$text .="</table>";	
					}
		else
			{
			$text .="<div style='height:100%;text-align:center;vertical-align:middle;' colspan='2'>".LAN_LEAGUE_GAMES_43."</div>";
			}													
	$text .="</td>
					</tr>
				</table>
				</div></div>
					";
//////////////////---------------------------------------------------------------
$text.= "<div id='exp_Spielverlauf' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:50%; height: 40px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_Spielverlauf'), expandit('exp_Aufstellung')\"><b>".LAN_LEAGUE_GAMES_23."</b></div>
						</td>	
					</tr>
				</table>				
				<br/>
				<div style='width:100%; text-align: center; vertical-align: top;'><b>".LAN_LEAGUE_GAMES_24."</b><br/>
				 <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
				 		<td class='fcaption'>".LAN_LEAGUE_GAMES_25."</td>
								<td class='fcaption'>".LAN_LEAGUE_GAMES_26."</td>
								<td class='fcaption'>".LAN_LEAGUE_GAMES_27."</td>
							</tr>";

		for($i=0; $i< $EreigCount; $i++)
			{if($ereigniss[$i][13]==$game[6]){$color="800000";}else{$color="000080";}
			if($ereigniss[$i][14]==10){$style="forumheader3";}else{$style="forumheader4";}
			$text .="<tr>
								<td class='".$style."' style='color:#".$color.";text-align:center'>".$ereigniss[$i][0]."	</td>
								<td class='".$style."' style='color:#".$color.";text-align:center'>".$Value[$ereigniss[$i][14]]."</td>
								<td class='".$style."' style='color:#".$color.";text-align:left'>								
								<a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$ereigniss[$i][1]."\" style=\"color:#".$color."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$ereigniss[$i][15]."\' width=\'120\'><br/>".$ereigniss[$i][4]."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\">(".$ereigniss[$i][2].") ".$ereigniss[$i][4]."</a>";
								if($ereigniss[$i][5]){$text .=", <a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$ereigniss[$i][5]."\" style=\"color:#".$color."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$ereigniss[$i][16]."\' width=\'120\'><br/>".$ereigniss[$i][8]."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\">(".$ereigniss[$i][6].") ".$ereigniss[$i][8]."</a>";}
								if($ereigniss[$i][9]){$text .=", <a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$ereigniss[$i][9]."\" style=\"color:#".$color."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$ereigniss[$i][17]."\' width=\'120\'><br/>".$ereigniss[$i][12]."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\">(".$ereigniss[$i][10].") ".$ereigniss[$i][12]."</a>";}
					$text .="</td>
							</tr>
							";
			}
$text .="</table>	
</div></br></br>
</div>				
";
////////////////----------------------------------------------------------
$title ="".LAN_LEAGUE_GAMES_28."".strftime('%a %d %b %Y',$game[4])."".LAN_LEAGUE_GAMES_29."".strftime('%H:%M',$game[4])."</b>";
if(ADMIN){
	$title .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_game_config.php?list.".$game[0]."' title=''>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$ns -> tablerender($title, $text);
require_once(FOOTERF);
////////////////////********************************+++
function player_shortname($longname)
{
$array = explode(", ",$longname);	
$Vorname=substr($array[1],0,1);
$Vorname .=". ";
$Vorname .= $array[0];
return $Vorname;
}

?>

