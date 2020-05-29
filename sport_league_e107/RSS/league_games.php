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
|		$Source: ../e107_plugins/ligue/league_games.php  $
|		$Revision: 0.10 $
|		$Date: 2008/06/14 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");  
$HEADER="";
$FOOTER="";
$CUSTOMHEADER = "";
$CUSTOMFOOTER = "";

if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_games_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_games_lan.php");
}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/league_games_lan.php");}

require_once("".e_PLUGIN."sport_league_e107/functionen.php");
$expand_autohide = "display:none; "; 
// ============= START OF THE BODY ====================================
$MYTEXT = "";

if($_GET['Saison']){$Saison=$_GET['Saison'];}else{$Saison=$pref['lique_my_saison'];}
if($_GET['Team']){$team=$_GET['Team'];}else{$team='*';}

$sql -> db_Select("league_games", "*", "game_home_id is not NULL ");
if(!($row = $sql-> db_Fetch()))
   {
    $MYTEXT = "<br/><br/><br/><b>".LAN_LIQUE_132."</b><br/><br/><br/>";	
   }
else
 {
//include(e_PLUGIN."lique/system_values2.php");
if($team!='*'){
     $sql -> db_Select("league_games", "*", "game_league_id='".$Saison."' AND game_home_id='".$team."' OR game_league_id='".$Saison."' AND game_gast_id='".$team."' ORDER BY game_date");
						}
else{
     $sql -> db_Select("league_games", "*", "game_league_id='".$Saison."' ORDER BY game_date");
		}						
     $UID=$row['game_id'];
      $i=0;
      while($row = $sql-> db_Fetch()){ // start loop		
      $wert[0][$i]=$row[game_id];	
      $wert[1][$i]=$row[game_date];
      $wert[2][$i]=$row[game_time];
      $wert[3][$i]=$row[game_home_id];
      $wert[4][$i]=$row[game_gast_id];
      $wert[5][$i]=$row[game_kuerzel];
      if($row[game_goals_home]==0 && $row[game_goals_gast]==0){$wert[6][$i]="x";$wert[7][$i]="x";}
      else{$wert[6][$i]=$row[game_goals_home];$wert[7][$i]=$row[game_goals_gast];}
      $wert[8][$i]=$row[game_un];
      $wert[9][$i]=$row[game_enable];
      $wert[10][$i]=$row[game_description];
      $wert[21][$i]=$row[game_news_id];
      $i++;	
      }
      $count=$i;


for($i=0;$i< $count; $i++)
	{
////////////// Home Team		
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$wert[3][$i]."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$wert[22][$i]=$row['team_id'];
 		if($pref['sport_league_teamname_table']==2){$wert[11][$i]=$row['team_kurzname'];}
		else{$wert[11][$i]=$row['team_name'];}
 		$wert[12][$i]=$row['team_admin_id'];
 		$wert[13][$i]=$row['team_url'];
 		$wert[14][$i]=$row['team_icon'];
 		$wert[15][$i]=$row['team_description'];
 		$wert[24][$i]=$row['leagueteam_my_team'];
 		
 ////////////// Gast Team					
 		  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$wert[4][$i]."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$wert[23][$i]=$row['team_id'];
 		if($pref['sport_league_teamname_table']==2){$wert[16][$i]=$row['team_kurzname'];}
		else{$wert[16][$i]=$row['team_name'];}
 		$wert[17][$i]=$row['team_admin_id'];
 		$wert[18][$i]=$row['team_url'];
 		$wert[19][$i]=$row['team_icon'];
 		$wert[20][$i]=$row['team_description'];	
		$wert[25][$i]=$row['leagueteam_my_team'];
	}

 
 if($team!='*'){
 	
 	 		  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id 
   	WHERE a.leagueteam_id='".$team."'  LIMIT 1
   			";
 		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 	
 	
 	
 	$sql -> db_Select("league_leagueteams", "*", "leagueteam_id='".$team."'");
 	$row = $sql-> db_Fetch();
 	$id_for_team=$row['liga_team_id']; 	
 	$image=$row['team_icon'];
 	$admin=$row['team_admin_id'];
 	$description=$row['team_description'];
 	$url=$row['team_url'];
 	$name=$row['team_name']; 	


$MYTEXT = "<div style='width:100%; text-align: center;'>";
$MYTEXT .= "";} 	
 
 
  $MYTEXT .= "<div style='width:100%; text-align: center;'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $MYTEXT .="
	  <tr>
		<td class='fcaption' style='align: center; width: 25%;'><b>".LAN_LEAGUE_GAMES_01."</b></td>
		<td class='fcaption' style='align: left; width: 10%;'><b>".LAN_LEAGUE_GAMES_02."</b></td>
		<td class='fcaption' style='align: center;' colspan='3'><b>".LAN_LEAGUE_GAMES_03."</b></td>
		<td class='fcaption' style='align: center; width: 10%;'><b>".LAN_LEAGUE_GAMES_04."</b></td>
		<td class='fcaption' style='align: center; width: 5%;'><b>".LAN_LEAGUE_GAMES_05."</b></td>
	</tr>
	<tr>
	</tr>";	
     for($i=0;$i< $count; $i++) 	
      	{
	$MYTEXT .= "<tr>";
	
	
		if($wert[25][$i]=='1'&&$team=='*'||$wert[24][$i]=='1'&&$team=='*'||$wert[3][$i]==$team&&$team!='*'){$TABELLESTYLE ="forumheader";}else{$TABELLESTYLE ="forumheader3";}		
	
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: center; padding: 4px;'>".strftime("%a. %d %b. %Y",$wert[1][$i])."</td>";
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: center; padding: 4px;'>".strftime("%H:%M",$wert[1][$i])."</td>";
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: right;font-weight: bold;border-right:0px;'>";
		$MYTEXT .="<div style='cursor:pointer' onclick=\"expandit('exp_ges_".$wert[3][$i]."_".$wert[0][$i]."')\">".$wert[11][$i]."&nbsp;&nbsp;<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/logos/".$wert[14][$i]."' height='25'></div>";
		$MYTEXT .="<div id='exp_ges_".$wert[3][$i]."_".$wert[0][$i]."' style='".$expand_autohide."' colspan='10' >";
		$MYTEXT .=team_links($wert[3][$i], $wert[11][$i], $Saison, $wert[13][$i]);
		$MYTEXT .="</div></td><td class='".$TABELLESTYLE."'style='border-left:0px;border-right:0px;text-align:center;'>";
		$MYTEXT .="&nbsp;vs&nbsp;</td>";
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: left;font-weight: bold;border-left:0px;'>";
		
		$MYTEXT .="<div style='cursor:pointer' onclick=\"expandit('exp_ges_".$wert[4][$i]."_".$wert[0][$i]."')\"><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/logos/".$wert[19][$i]."' height='25'>&nbsp;&nbsp;".$wert[16][$i]."</div>";
		$MYTEXT .="<div id='exp_ges_".$wert[4][$i]."_".$wert[0][$i]."' style='".$expand_autohide."' colspan='10' >";
		$MYTEXT .=team_links($wert[4][$i], $wert[16][$i], $Saison, $wert[18][$i]);
		$MYTEXT .="</div></td>";
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: center; padding: 4px;'><b>".$wert[6][$i]." : ".$wert[7][$i]."</b>";
		if($wert[8][$i]=='1')
		  {$MYTEXT .=" n.P.</td>";}
		else{$MYTEXT .="</td>";}
			
		$MYTEXT .="<td class='".$TABELLESTYLE."' style='text-align: center; padding: 4px;'>";
		if($wert[21][$i]!= '0'&& $wert[9][$i]==true)
		  {$MYTEXT .="<a href=http:".e_BASE."news.php?extend.".$wert[21][$i]." title='".LAN_LIQUE_190."'><img border='0' src='images/system/news.png'></a><a target='_blank' href='startseite.php?game_id=".$wert[0][$i]."' title='".LAN_LIQUE_251."'><img border='0' src='images/system/help.png' title='".LAN_LIQUE_251."'></a></td>";}
		else if($wert[9][$i]==true){$MYTEXT .="<img border='0' src='images/system/nonews.png' title='".LAN_LIQUE_191."'><a target='_blank' href='startseite.php?game_id=".$wert[0][$i]."' title='".LAN_LIQUE_251."'><img border='0' src='images/system/help.png' title='".LAN_LIQUE_251."'></a>";}
		    else{$MYTEXT .="&nbsp;";}
	$MYTEXT .="</td></tr>";		
	}
$MYTEXT .="</table>";
$MYTEXT .= "<br/><br/><br/></div>";

}

if($team!='*')
	{ $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$team."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$leagueteam_id=$row['leagueteam_id'];
 		$team_id=$row['team_id'];
 		$team_name=$row['team_name'];
		
		
		$title ="".LAN_LEAGUE_GAMES_06." ".$team_name."";}
else{
//////////////// Liga- Name
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_id =".$Saison."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$saison_id=$row['saison_id'];
 		$saison_name=$row['saison_name'];
 		$league_name=$row['league_name'];
 		
$title ="".LAN_LEAGUE_GAMES_08." ".$league_name." (".$saison_name.")";}

$From = "league_games.php";
if($_GET['Template']){
				$text ="<link rel='stylesheet' type='text/css' media='screen' href='".e_THEME."".$_GET['Template']."/style.css'>";
				}
else{$text ="<link rel='stylesheet' type='text/css' media='screen' href='".THEME."style.css'>";}
$text .="<div style='text-align:right'>";
$text .= druckansicht($From, $Saison, $team);
$text .="</div><div style='text-align:center'> ";
$text .=$MYTEXT;
$text.=powered_by();
$text.="</div>";
// ========= End of the BODY ===================================================
echo "<h1>".$title."</h1><br/><br/> ".$text; 
?>