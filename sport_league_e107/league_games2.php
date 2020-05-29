<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the  
|        GNU General Public License (http://gnu.org).
|														league_games2.php
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_games_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_games_lan.php");
require_once("".e_PLUGIN."sport_league_e107/functionen.php");
$expand_autohide = "display:none; "; 
// ============= START OF THE BODY ====================================
$myteam=$pref['lique_my_team'];
$MYTEXT = "";
$Pro_site=$pref['league_count_gamestermine'];
$TO_SITE_LINK="";
////++++++++++++++++++++++++++++++++++++++++
if($_GET['Saison'])
{
	$Saison=$_GET['Saison'];
	$TO_SITE_LINK.="Saison=".$_GET['Saison']."&";
}else{
	$Saison=$pref['league_my_saison'];
	$TO_SITE_LINK.="Saison=".$pref['league_my_saison']."&";}
////////////////////////////////////////////
if($_GET['Liga'])
{
	$Liga=$_GET['Liga'];
	$TO_SITE_LINK.="Liga=".$_GET['Liga']."";
}else{$Liga='*';}
////////////////////////////////////////////

$sql -> db_Select("league_games", "*", "game_home_id is not NULL ");
if(!($row = $sql-> db_Fetch()))
   {
    $MYTEXT = "<br/><br/><br/><b>".LAN_LEAGUE_GAMES_10."</b><br/><br/><br/>";	
   }
else
 {

	if($Liga=='*'){
			  $qry1="
   	SELECT a.*, ac.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_games AS ac ON ac.game_league_id=a.league_id  
   	WHERE a.league_saison_id='".$Saison."' AND a.league_saison_id!='0' ORDER BY game_date
   			";	
		$sql->db_Select_gen($qry1);
		}
	else{
     $sql -> db_Select("league_games", "*", "game_league_id='".$Liga."' ORDER BY game_date");
		 }
				
     $UID=$row['game_id'];
      $i=0;
      while($row = $sql-> db_Fetch()){ // start loop		
      $wert[0][$i]=$row['game_id'];	
      $wert[1][$i]=$row['game_date'];
      $wert[2][$i]=$row['game_time'];
      $wert[3][$i]=$row['game_home_id'];
      $wert[4][$i]=$row['game_gast_id'];
      $wert[5][$i]=$row['game_kuerzel'];
      if($row['game_goals_home']==0 && $row['game_goals_gast']==0 && $row['game_enable']==0){$wert[6][$i]="x";$wert[7][$i]="x";}
      else{$wert[6][$i]=$row['game_goals_home'];$wert[7][$i]=$row['game_goals_gast'];}
      $wert[8][$i]=$row['game_un'];
      $wert[9][$i]=$row['game_enable'];
      $wert[10][$i]=$row['game_description'];
      $wert[21][$i]=$row['game_news_id'];
      if($row['game_date'] < (time()-302400) && $row['game_date'] > (time()-604800)
      ||$row['game_date'] > (time()) && $row['game_date'] < (time()+52400))
      	{
      	$My_Site = $i;
      	}
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




 ////////////// Teams-List
 $TCC=0;
 				
 		  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_league_id =".$Liga." ORDER BY ae.team_name
   			";
		$sql->db_Select_gen($qry1);
		 while($row = $sql-> db_Fetch()){
 		$team_list[$TCC]['team_id']=$row['team_id'];
 		$team_list[$TCC]['leagueteam_id']=$row['leagueteam_id'];
 		if($pref['sport_league_teamname_table']==2){$team_list[$TCC]['team_kurzname']=$row['team_kurzname'];}
		else{$team_list[$TCC]['team_kurzname']=$row['team_name'];}
 		$team_list[$TCC]['team_admin_id']=$row['team_admin_id'];
 		$team_list[$TCC]['team_url']=$row['team_url'];
 		$team_list[$TCC]['team_icon']=$row['team_icon'];
 		$team_list[$TCC]['team_description']=$row['team_description'];	
		$team_list[$TCC]['leagueteam_my_team']=$row['leagueteam_my_team'];
		$TCC++;
		}



 
$MYTEXT .= "<div style='width:100%; text-align: center;'>".$LINKS_TEXT."<br/>
						<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' border='1'>";
$MYTEXT .="<tr><td class='fcaption'></td>";
   	for($j=0;$j< $TCC; $j++) 	
     		{
				$MYTEXT .="<td class='forumheader' style='text-align:center;'><a href='league_games.php?Liga=".$Liga."&&team=".$team_list[$j]['leagueteam_id']."'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_08." ".$team_list[$j]['team_kurzname']."' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_list[$j]['team_icon']."' height='50'></a></td>";
				}
	$MYTEXT .="</tr>";
   for($i=0;$i< $TCC; $i++)
      	{
      	$MYTEXT .="<td class='forumheader' style='text-align:center;'><a href='league_games.php?Liga=".$Liga."&&team=".$team_list[$i]['leagueteam_id']."'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_08." ".$team_list[$j]['team_kurzname']."' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_list[$i]['team_icon']."' height='50'></a></td>";
      	for($j=0;$j< $TCC; $j++) 	
      		{
					$a=$j%2+$i%2;
					//$MYTEXT .="<td>".$team_list[$i]['leagueteam_id']."|".$team_list[$j]['leagueteam_id']."</td>";
					$MYTEXT .=get_gamecell($team_list[$i]['leagueteam_id'],$team_list[$j]['leagueteam_id'],$wert,$a);
					}
					
				$MYTEXT .="</tr><tr>";	
				}
$MYTEXT .="</table>";
}
//////////////// Liga- Name
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_id =".$Liga."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$saison_id=$row['saison_id'];
 		$saison_name=$row['saison_name'];
 		$league_name=$row['league_name']; 		
$title ="".LAN_LEAGUE_GAMES_08." ".$league_name." (".$saison_name.")";

$text ="<script type=\"text/javascript\" src=\"".e_PLUGIN."sport_league_e107/handler/wz_tooltip.js\"></script>";
$text .="<div style='text-align:right'>";
$text .= druckansicht($From, $Liga, $team);
$text .="</div><div style='text-align:center'> ";
$text .=$MYTEXT;
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .= "<br/>".$LINKS_TEXT."<br/><br/><b><a href='".e_PLUGIN."sport_league_e107/league_teams.php?".$saison_id."' title='".LAN_LEAGUE_GAMES_40."'>".LAN_LEAGUE_GAMES_40."</a></b><br/><br/></div>";

$text .=powered_by();
/// =========================================================================================
$text.="</div>";
$ns -> tablerender($title, $text);  
// ========= End of the BODY ===================================================
require_once(FOOTERF);
//////////////////////////////////

function get_gamecell($home,$gast,$games,$styl_class)
{
$styl[0]="forumheader3";
$styl[1]="forumheader2";
if($home == $gast)
	{
	return 	"<td class='fcaption'> </td>";
	}

$games_cc=count($games[1]);	
for($i=0; $i< $games_cc ; $i++)
		{if($games[8][$i]==1){$Betext=LAN_LEAGUE_GAMES_45;}else{$Betext="";}
		if($games[3][$i]==$home && $games[4][$i]==$gast)
			{
			return 	"<td class='".$styl[$styl_class]."' style='text-align:center;font-size:150%;font-weight:bold;'><a href=\"".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$games[0][$i]."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:5px;\'><table style=\'width:100%\' class=\'\' cellspacing=\'0\' cellpadding=\'0\' border=\'0\'><tr><td style=\'padding:5px;text-align:right;\'><img src=\'".e_PLUGIN."sport_league_e107/logos/big/".$games[14][$i]."\' width=\'150\'></td><td style=\'text-align:center;font-size:150%;font-weight:bold;\'>".$games[6][$i]." : ".$games[7][$i]."</td><td style=\'padding:5px;text-align:left;\'><img src=\'".e_PLUGIN."sport_league_e107/logos/big/".$games[19][$i]."\' width=\'150\'></td></tr><tr><td style=\'padding:5px;text-align:right;\'><font color=\'#800000\' size=\'4\'><b>".$games[11][$i]."</b></font></td><td style=\'padding:5px;text-align:center;\'> V.S.</td><td style=\'padding:5px;text-align:left;\'><font size=\'4\' color=\'#000080\'><b>".$games[16][$i]."</b></font></td></tr><tr><td colspan=\'3\' style=\'padding:5px;text-align:center;\'>am: <b>".strftime("%a. %d %b. %Y",$games[1][$i])."</b><br/>um: <b>".strftime("%H:%M",$games[1][$i])."</b> Uhr<br/><br/><br/></td><td></tr></table></td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\">".$games[6][$i]." : ".$games[7][$i]."</a><div style='font-size:50%;'>".$Betext."</div></td>";
			}
		}
return "<td class='forumheader2'>?</td>";
}

///<table style=\"width:300\" class=\"fborder\" cellspacing=\"0\" cellpadding=\"0\" border=\"\"><tr><td><img src=\"".e_PLUGIN."sport_league_e107/logos/big/".$games[14][$i]."\" width=\"80\"></td><td>-</td><td><img src=\"".e_PLUGIN."sport_league_e107/logos/big/".$games[149][$i]."\" width=\"80\"></td></tr><tr><td>".$games[11][$i]."</td><td> V.S.</td><td>".$games[16][$i]."</td></tr><tr><td colspan=\"3\">".strftime("%d.%M.%y",$games[1][$i])."<br/>".strftime("%H:%M",$games[1][$i])."<br/></td><td></tr></table>
?>
