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
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $                                                                                         
+---------------------------------------------------------------+                                                       
*/                                                                                                                                                                                                                                             
require_once("../../class2.php");                                                                                       
require_once(HEADERF);                                                                                                  
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/game_days_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/game_days_lan.php");
$LIGA=0;
if($_GET['Liga']){$LIGA=$_GET['Liga'];}
elseif($_POST['Liga']){$LIGA=$_POST['Liga'];}
else{
$LIGA=$pref['league_my_saison'];
}
if($_GET['Liga']){$LIGA=$_GET['Liga'];}                                                                                                
// ============= START OF THE BODY ====================================                                                 
//////////////////////////////////////////// Next Games  /////////////////////////////////////
require_once("functionen.php");  
$expand_autohide = "display:none; ";    
$text = "";
	  $lasg_qry="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_saison_id='".$LIGA."'";
 if($LIGA!=0){$lasg_qry.=" AND a.league_id='".$LIGA."'";}	
$sql->db_Select_gen($lasg_qry);
$saisoncount=0;
while($row = $sql-> db_Fetch())
	 		{
			$SAISON[$saisoncount]['league_name']=$row['league_name'];
			$SAISON[$saisoncount]['saison_name']=$row['saison_name'];
			$SAISON[$saisoncount]['saison_id']=$row['saison_id'];
			$SAISON[$saisoncount]['league_id']=$row['league_id'];
			$SAISON[$saisoncount]['saison_id']=$row['saison_id'];
			$SAISON[$saisoncount]['saison_id']=$row['saison_id'];
			$saisoncount++;
			}
if($saisoncount > 0)
	{
	for($JS=0; $JS < $saisoncount;$JS++ )
		{
 $lasg_qry="
 	SELECT a.*, ab.* FROM ".MPREFIX."league_leagues AS a
 	LEFT JOIN ".MPREFIX."league_games AS ab ON ab.game_league_id=a.league_id
 	WHERE a.league_saison_id='".$SAISON[$JS]['saison_id']."' AND a.league_id='".$SAISON[$JS]['league_id']."' ORDER BY ab.game_date
	";
 $sql->db_Select_gen($lasg_qry);		
 $gamecount[$JS]=0;
 while($row = $sql-> db_Fetch())
		{
		$game[$JS][18][$gamecount[$JS]]=$row['game_id'];
		$game[$JS][0][$gamecount[$JS]]=$row['game_date'];
		$game[$JS][20][$gamecount[$JS]]=$row['game_league_id'];
///		$game[$JS][1][$gamecount[$JS]]=$row['game_time'];
		$game[$JS][2][$gamecount[$JS]]=$row['game_home_id'];
		$game[$JS][3][$gamecount[$JS]]=$row['game_gast_id'];
		$game[$JS][4][$gamecount[$JS]]=$row['game_goals_home'];
		$game[$JS][5][$gamecount[$JS]]=$row['game_goals_gast'];
		$game[$JS][6][$gamecount[$JS]]=$row['game_un'];
		$game[$JS][7][$gamecount[$JS]]=$row['game_enable'];										
		$gamecount[$JS]++;
		}
/// Home Mannschaft Date hollen
for($i=0; $i < $gamecount[$JS]; $i++)
		{ 
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_id=".$game[$JS][2][$i]."
   		";
	$sql->db_Select_gen($qry1); 
 	$row = $sql-> db_Fetch();
 $game[$JS][16][$i]=$row['liga_team_id'];
 $game[$JS][8][$i]=$row['team_id'];       	// Home Mannschaft  ID                                                                     
 $game[$JS][9][$i]=$row['team_icon'];     	// Home Mannschaft  Logo                                                                    
 $game[$JS][10][$i]=$row['team_url'];     	// Home Mannschaft  URL                                                                       
 $game[$JS][11][$i]=$row['team_name'];    	// Home Mannschaft  Name    
 	}
/// Gast Mannschaft Date hollen
for($i=0; $i < $gamecount[$JS]; $i++)
		{ 
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_id=".$game[$JS][3][$i]."
   		";
	$sql->db_Select_gen($qry1); 
 	$row = $sql-> db_Fetch();
 	$game[$JS][17][$i]=$row['liga_team_id'];
 	$game[$JS][12][$i]=$row['team_id'];        // Gast Mannschaft  ID                                                                          
 	$game[$JS][13][$i]=$row['team_icon'];      // Gast Mannschaft  Logo                                                                        
 	$game[$JS][14][$i]=$row['team_url'];       // Gast Mannschaft  URL                                                                         
  $game[$JS][15][$i]=$row['team_name'];      // Gast Mannschaft  Name      
 	}
//// Woche zuweisen
$weekcount=0;
$weekarea[$weekcount]['begin']=false;
$weekarea[$weekcount]['end']=false;
for($i=0; $i < ($gamecount[$JS]); $i++)
		{
		if(!$weekarea[$weekcount]['begin'])
			{$weekarea[$weekcount]['begin']=$game[$JS][0][$i];}
		
		$game[$JS][19][$i]=$weekcount+1; // Spielwoche
		if((($game[$JS][0][($i+1)])-($game[$JS][0][$i])) > 302400)
				{
				$weekarea[$weekcount]['end']=$game[$JS][0][$i];
				$weekcount++;
				}
		}
//// aktuelle Woche
for($i=0; $i < ($gamecount[$JS]); $i++)
		{
		if($game[$JS][0][$i]>(time()-302400)&&$game[$JS][0][$i]<(time()+302400))
			{$myweek=$game[$JS][19][$i];break;}
		}
if(!$myweek){$myweek=1;}
if($_GET['week']){$myweek=$_GET['week'];}
if($_POST['week']){$myweek=$_POST['week'];}
//////////////////
$Anfang=strftime("%d.%m.%Y",$weekarea[$myweek-1]['begin']);
$Ende=strftime("%d.%m.%Y",$weekarea[$myweek-1]['end']);                                                                            
$tabelletext[$JS] .= "<br/>".LAN_LEAGUE_GAME_DAYS_11."<b>".$Anfang."</b> ".LAN_LEAGUE_GAME_DAYS_12." <b>".$Ende." ".$SAISON[$JS]['league_name']."-(".$SAISON[$JS]['saison_name'].")</b>"; 

//////////////////
$liste2="<select name='week' size='1' style='width:100%;font-weight: bold;' onChange='this.form.submit()'>";
for($i=1; $i < $weekcount+2; $i++)
		{
		$liste2.="<option ";
		if($i==$myweek)
			{
			$liste2.="selected ";
			}
		$liste2.="value='".$i."'>";
		$liste2.="".$i."".LAN_LEAGUE_GAME_DAYS_5."</option>";
		}
$liste2.="</select>";
/////////////////////
$tabelletext[$JS] .= "<div style='text-align:center'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
$tabelletext[$JS] .="<tr>                                                                                                        
					<td class='fcaption' style='text-align: center; width: 15%; border-top: 0px'>".LAN_LEAGUE_GAME_DAYS_1."</td>       
					<td class='fcaption' style='text-align: center; width: 5%; border-top: 0px'>".LAN_LEAGUE_GAME_DAYS_2."</td>     
					<td class='fcaption' style='text-align: center; width: 70%; border-top: 0px' colspan='3'>".LAN_LEAGUE_GAME_DAYS_3."</td>  
					<td class='fcaption' style='text-align: center; width: 10%; border-top: 0px'>".LAN_LEAGUE_GAME_DAYS_4."</td>      
				</tr>";
$myweekcounter[$JS]=0;			
for($i=0; $i < $gamecount[$JS]; $i++) 
		{
		if($game[$JS][19][$i]==$myweek){
		$myweekcounter[$JS]++;
	  $tabelletext[$JS] .= "<tr>";
		$tabelletext[$JS] .="<td class='forumheader3' style='text-align: center;'>".strftime("%a %d.%m ",$game[$JS][0][$i])."</td>";
		$tabelletext[$JS] .="<td class='forumheader3' style='text-align: center;'><p align='center'>".strftime("%H:%M ",$game[$JS][0][$i])."</td>";		
		$tabelletext[$JS] .="<td class='forumheader3' style='text-align: right;border-right:0px;'>
										<table style='width:100%' cellspacing='0' cellpadding='0'>
											<tr>
												<td style=''>";
$tabelletext[$JS] .="<div style='cursor:pointer' onclick=\"expandit('exp_ges".$game[$JS][18][$i]."_".$game[$JS][8][$i]."')\"><b>".$game[$JS][11][$i]."</b></div>
<div id='exp_ges".$game[$JS][18][$i]."_".$game[$JS][8][$i]."' style='".$expand_autohide."'>";
$tabelletext[$JS] .=team_links($game[$JS][2][$i], $game[$JS][11][$i],$game[$JS][20][$i] , $game[$JS][10][$i]);
$tabelletext[$JS] .="</div>";		
$tabelletext[$JS] .="</td>
		<td style='width:30px;'><img border='0' src='logos/".$game[$JS][9][$i]."' height='20'></td>
	</tr>
</table></td>";
		$tabelletext[$JS] .="<td class='forumheader3' style='text-align: center;padding:0px;border-left:0px;border-right:0px;'>&nbsp;<a href='".e_PLUGIN."lique/lique_stats.php?team_a=".$game[$JS][2][$i]."&&team_b=".$game[$JS][3][$i]."'>".LAN_LEAGUE_GAME_DAYS_7."</a>&nbsp;";
		$tabelletext[$JS] .="<td class='forumheader3' style='text-align: left;border-left:0px;'>
										<table style='width:100%' cellspacing='0' cellpadding='0'>
											<tr>
												<td style='width:30px;'><img border='0' src='logos/".$game[$JS][13][$i]."' height='20'></td>
												<td style=''>";
$tabelletext[$JS] .="<div style='cursor:pointer' onclick=\"expandit('exp_ges".$game[$JS][18][$i]."_".$game[$JS][12][$i]."')\"><b>".$game[$JS][15][$i]."</b></div>
<div id='exp_ges".$game[$JS][18][$i]."_".$game[$JS][12][$i]."' style='".$expand_autohide."'>";
$tabelletext[$JS] .=team_links($game[$JS][3][$i], $game[$JS][15][$i], $game[$JS][20][$i], $game[$JS][14][$i]);
$tabelletext[$JS] .="</div>";		
$tabelletext[$JS] .="</td>
	</tr>
</table></td>"; 
		$tabelletext[$JS] .="<td class='forumheader' style='text-align: center;'><b><a target='_blank' href='".e_PLUGIN."lique/gameinfo.php?game_id=".$game[$JS][18][$i]."' title='".LAN_LEAGUE_GAME_DAYS_8."'>".$game[$JS][4][$i].":".$game[$JS][5][$i]."</a></b>";
		if($game[$JS][6][$i]==true){$tabelletext[$JS] .=LAN_LEAGUE_GAME_DAYS_9;}
		if(ADMIN){$tabelletext[$JS] .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME[0]['leagueteam_league_id'].".".$GAME[0]['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";}		
		$tabelletext[$JS] .="</td></tr>";
	  	}  
	 }
if($myweekcounter[$JS] < 1)
	{
	$tabelletext[$JS] .="<tr><td class='forumheader2' colspan='6' style='text-align: center;'>".LAN_LEAGUE_GAME_DAYS_14."</td></tr>";
		}	
$tabelletext[$JS] .="
				<tr>
					<td class='fcaption' style='height:10px;padding:0px; text-align: center; width: 20%; border-top: 0px' colspan='2'>".LAN_LEAGUE_GAME_DAYS_10."</td>  
					<td class='fcaption' style='height:10px;padding:0px; text-align: center; width: 80%; border-top: 0px'colspan='4'><form action='".e_SELF."' method='post' id='neu'>".$liste2." <input type='hidden' name='Saison' value='".$LIGA."'></form></td>      
				</tr>
</table></div>";
$text .=$tabelletext[$JS];
	}
}
//////////////////////////////////////Überschrieft/////////////////////////////////////////
$sql -> db_Select("league_saison", "*", "saison_id=".$LIGA."");
		 $row = $sql-> db_Fetch();
		 $saisonName=$row['saison_name'];
$Anfang=strftime("%d.%m",$weekarea[$myweek-1]['begin']);
$Ende=strftime("%d.%m",$weekarea[$myweek-1]['end']);                                                                            
$title = "<b>".LAN_LEAGUE_GAME_DAYS_13."</b>";                                                                            
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$ns -> tablerender($title, $text);                                                                              
// ========= End of the BODY ===================================================                                                                              
require_once(FOOTERF);                                                                                                  
?>