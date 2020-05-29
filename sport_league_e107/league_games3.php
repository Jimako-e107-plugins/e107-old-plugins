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
if($_GET['team'])
{
	$team=$_GET['team'];
	$TO_SITE_LINK.="&team=".$_GET['team']."";	
	}else{$team='*';}

$sql -> db_Select("league_games", "*", "game_home_id is not NULL ");
if(!($row = $sql-> db_Fetch()))
   {
    $MYTEXT = "<br/><br/><br/><b>".LAN_LEAGUE_GAMES_10."</b><br/><br/><br/>";	
   }
else
 {
if($team!='*'){ECHO "b";
     $sql -> db_Select("league_games", "*", "game_league_id='".$Liga."' AND game_home_id='".$team."' OR game_league_id='".$Liga."' AND game_gast_id='".$team."' ORDER BY game_date");
						}
else{
	if($Liga=='*'){	
			  $qry1="
   	SELECT a.*, ac.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_games AS ac ON ac.game_league_id=a.league_id  
   	WHERE a.league_saison_id='".$Saison."' ORDER BY game_date
   			";	
		$sql->db_Select_gen($qry1);
		}
	else{
     $sql -> db_Select("league_games", "*", "game_league_id='".$Liga."' ORDER BY game_date");
		 }
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

if($count > $Pro_site)
{
$Sites=intval(($count/$Pro_site));
if($count-($Sites*$Pro_site) >0){$Sites++;}
}
$My_Site=intval(($My_Site/$Pro_site));
$von=0;
if($_GET['Seite'])
	{
	$My_Site=$_GET['Seite'];
	}
elseif($_GET['Seite']=="0")
	{
	$My_Site=0;
	}
else{$My_Site=0;}
$von=$My_Site*$Pro_site;
$bis=$von+$Pro_site;
$LINKS_TEXT="";
echo $count."-".$Pro_site."-".$My_Site;



if($count > $Pro_site)
{
for($i=0;$i< $Sites; $i++)
	{
	if(($i >$My_Site-4 && $i < $My_Site) || ($i < $My_Site+4 && $i > $My_Site))
		{
		$LINKS_TEXT .="<a href='".e_SELF."?".$TO_SITE_LINK."&Seite=".$i."' title='".LAN_LEAGUE_GAMES_36."".($i+1)."'>".($i+1)."</a>&nbsp;";
		}
	elseif($i ==0 && $My_Site >= 4)
		{
		$LINKS_TEXT .="<a href='".e_SELF."?".$TO_SITE_LINK."&Seite=".$i."' title='".LAN_LEAGUE_GAMES_37."'><b>".($i+1)."<<</b></a>&nbsp;";
		}
	elseif(($i == $Sites-1 && $My_Site <= $Sites-4))
		{
		$LINKS_TEXT .="<a href='".e_SELF."?".$TO_SITE_LINK."&Seite=".$i."' title='".LAN_LEAGUE_GAMES_38."'><b>>>".($i+1)."</b></a>";
		}
	elseif($i==$My_Site)
		{
		$LINKS_TEXT .="[<a href='".e_SELF."?".$TO_SITE_LINK."&Seite=".$i."' title='".LAN_LEAGUE_GAMES_39."'><b>".($i+1)."</a></b>]&nbsp;";	
		}	
	else $LINKS_TEXT .=".";
	}
 }
if($bis >$count)
	{
	$bis=$count;	
	}
for($i=$von;$i< $bis; $i++)
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
 		$wert[26][$i]=$row['team_admin_id'];
 		
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
		$wert[27][$i]=$row['team_admin_id'];
	}
 if($team!='*'){	
 	 		  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id 
   	WHERE a.leagueteam_id='".$team."'
   			";
 		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$id_for_team=$row['liga_team_id']; 	
 		$image=$row['team_icon'];
 		$admin=$row['team_admin_id'];
 		$description=$row['team_description'];
 		$url=$row['team_url'];
 		$name=$row['team_name']; 	

$MYTEXT = "<div style='width:100%; text-align: center;'>";
$MYTEXT .= "
				<table style='width:100%' cellspacing='0' cellpadding='0'>
		  		<tr>
						<td style='text-align: center; width: 40%; vertical-align: top;'>
							<img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$image."' height='140'/></td>
						<td style='text-align: left; width: 50%; vertical-align: top;'>
							<table style='width:100%' cellspacing='0' cellpadding='0'>
		  					<tr>
		  					<td style='text-align: left; padding: 4px; font-size: 16px; font-weight: bold;'>".LAN_LEAGUE_GAMES_09."<br/>";		  					
		 $MYTEXT .= team_links_H($team, $name, $Liga);	
		 $MYTEXT .= "</td>
		  					</tr>
		  					<tr>
		  						<td>
		  					</td></tr>
						</table>
				</td>
				<td style='text-align:rigth;width:10%;vertical-align:top;'>";
	if(ADMIN){
		$MYTEXT .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_roster_config.php?edit.".$player[0].".".$player[4]."' title='".LAN_LEAGUE_ROSTER_17."'>
						<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}
	elseif(USERID==$wert[26][$i] || USERID==$wert[27][$i])
				{
				$MYTEXT .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admins/admin_roster_config.php?edit.".$player[0].".".$player[4]."' title='".LAN_LEAGUE_ROSTER_17."'>
				<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";	
				}
		$MYTEXT .="</td>
				</tr>
			</table>
";		
} 	
 
$MYTEXT .= "<table style='width:100%;height:auto;'>
							<tr>
								<td style='text-align:center;vertical-align:top'>".$LINKS_TEXT."<br/>
								";
   for($i=$von;$i< $bis; $i++) 	
      	{
if($wert[25][$i]=='1'&&$team=='*'||$wert[24][$i]=='1'&&$team=='*'||$wert[3][$i]==$team&&$team!='*'){$TABELLESTYLE ="forumheader";}else{$TABELLESTYLE ="forumheader2";}			

if($wert[9][$i] !='1')
	{$infolink="<a href='".e_PLUGIN."sport_league_e107/league_stats.php?team_a=".$wert[3][$i]."&&team_b=".$wert[4][$i]."' title='Mannschaften vergleichen'>";}
else
	{$infolink="<a href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$wert[0][$i]."' title='Spielbericht'>";}



$MYTEXT.="<div class='".$TABELLESTYLE."' style='width:auto; margin:5px;float:left;text-align:left;border: 2px #777 solid;border-radius:7px;-moz-border-radius:7px;-webkit-border-radius:7px;padding:0px'>
	<div class='forumcaption' style='margin:0px;text-align:left;border:0px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:5px;color:#fff;background:#777;border-radius-bottom:0px;-moz-border-radius-bottom:0px;-webkit-border-radius-bottom:0px;'>
		".$infolink." am: <b>".strftime("%a. %d %b. %Y",$wert[1][$i])."</b> um: <b>".strftime("%H:%M",$wert[1][$i])."</b> </a>";
		if($wert[8][$i]=='1')
		  {$MYTEXT.="&nbsp;OT";}
		else{$MYTEXT.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
		
		if(ADMIN){$MYTEXT .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$Liga.".".$wert[0][$i]."' title='".LAN_LEAGUE_GAMES_42."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";}
	elseif(USERID==$wert[26][$i] || USERID==$wert[27][$i])
					{
					$MYTEXT .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admins/admin_games_config.php?edit.".$Liga.".".$wert[0][$i]."' title='".LAN_LEAGUE_GAMES_42."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";}
$MYTEXT.="
	</div>
	<div style='margin:0px;text-align:left;border:0px;border-radius:7px;-moz-border-radius:7px;-webkit-border-radius:7px;padding:5px;'>
		<table class='fborder' cellspacing='0' cellpadding='0' style='border:0px;width:100%'>
			<tr>
				<td style='text-align:left;border-bottom: 1px #aaa solid;'>
					<div style='cursor:pointer' onclick=\"expandit('exp_ges_".$wert[3][$i]."_".$wert[0][$i]."')\"><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/logos/".$wert[14][$i]."' height='25'>&nbsp;&nbsp;".$wert[11][$i]."</div>";
		$MYTEXT.="<div id='exp_ges_".$wert[3][$i]."_".$wert[0][$i]."' style='".$expand_autohide."' colspan='10' >";
		$MYTEXT.=team_links($wert[3][$i], $wert[11][$i], $Liga, $wert[13][$i]);
		$MYTEXT.="</div>
				</td>
				<td style='text-align:center;border-bottom: 1px #aaa solid;padding-left:8px;'>
					".$wert[6][$i]."
				</td>
			</tr>
			<tr>
				<td style='text-align:left;'>
					<div style='cursor:pointer' onclick=\"expandit('exp_ges_".$wert[4][$i]."_".$wert[0][$i]."')\"><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/logos/".$wert[19][$i]."' height='25'>&nbsp;&nbsp;".$wert[16][$i]."</div>";
		$MYTEXT.="<div id='exp_ges_".$wert[4][$i]."_".$wert[0][$i]."' style='".$expand_autohide."' colspan='10' >";
		$MYTEXT.=team_links($wert[4][$i], $wert[16][$i], $Liga, $wert[18][$i]);
		$MYTEXT.="</div>
				<td style='text-align:center;padding-left:8px;'>
					".$wert[7][$i]."
				</td>
			</tr>
		</table>	
	</div>
</div>";	
	}
$MYTEXT .= "</td></tr></table>";	
}
if($team!='*')
	{ $qry1="
   	SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_leagues AS ab ON ab.league_id=a.leagueteam_league_id  
   	WHERE a.leagueteam_id =".$team."  LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
 		$leagueteam_id=$row['leagueteam_id'];
 		$team_id=$row['team_id'];
 		$saison_id=$row['league_saison_id'];
 		$team_name=$row['team_name'];
		$title ="".LAN_LEAGUE_GAMES_06." ".$team_name."";}
else{
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
$title ="".LAN_LEAGUE_GAMES_08." ".$league_name." (".$saison_name.")";}
$From = "league_games.php";
$text ="<div style='text-align:right'>";
$text .= druckansicht($From, $Liga, $team);
$text .="</div><div style='text-align:center'> ";
$text .=$MYTEXT;
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .= "<br/>".$LINKS_TEXT."<br/><br/><b><a href='".e_PLUGIN."sport_league_e107/league_teams.php?".$saison_id."' title='".LAN_LEAGUE_GAMES_40."'>".LAN_LEAGUE_GAMES_40."</a></b><br/><br/></div>";

$text .=powered_by();
/// =========================================================================================
$text.="</div>";
$ns -> tablerender($title, $text);  
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>