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
|		$Source: ../e107_plugins/sport_league_e107/league_my_roster_goals_menu.php  $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_points_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_roster_points_menu_lan.php");
require_once(e_PLUGIN."sport_league_e107/functionen.php");
// ============= START OF THE BODY ====================================
	  $qry1="
   	SELECT a.*, ab.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_league_id=a.league_id
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=ab.leagueteam_team_id
   	WHERE a.league_saison_id =".$pref['league_my_saison']." AND ab.leagueteam_my_team='1' LIMIT 1
   			";
		$sql->db_Select_gen($qry1);
		$row = $sql-> db_Fetch();
		$SAISON=$row['leagueteam_id'];
		$LIGA=$row['league_id'];
		$MY_TEAM=$row['leagueteam_id'];
		$team_Name=$row['team_name'];
		$team_Short_Name=$row['team_kurzname'];
 		$team_admin=$row['team_admin_id'];
 		$team_url=$row['team_url'];
 		$team_icon=$row['team_icon'];
 		$team_description=$row['team_description'];

$z['games']=0;
 		$sql -> db_Select("league_games", "*", "game_home_id=".$MY_TEAM." OR game_gast_id=".$MY_TEAM." ");
 		while($row = $sql-> db_Fetch()){
 		$z['games']++;
		}
		
$z['players']=0;
 		$sql -> db_Select("league_roster", "*", "roster_team_id=".$MY_TEAM."");
 		while($row = $sql-> db_Fetch()){
 		$z['players']++;
		}

///////////////////////////////////

$MAXIMUM=$pref['sport_league_top_scorer'];
$expand_autohide = "display:none; ";
$text = "<div style='width:100%; text-align: center;'>";


////////////////+++++++++++++++++++++++++////////////////////////////////+++++++++++++++++++++++++////////////////+++++++++++++++++++++++++
$sql -> db_Select("league_roster", "*", "roster_team_id=".$MY_TEAM."");
if(!($row = $sql-> db_Fetch()))
  { 	
 	$text = "</br></br></br><b><p align='center'>".LAN_LEAGUE_ROSTER_POINTS_MENU_05."</b></br></br></br>";		
 	}
else
 {
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id   
   WHERE a.roster_team_id =".$MY_TEAM." AND a.roster_position<'9' ORDER BY a.roster_position, a.roster_jersy
   		";
	$sql->db_Select_gen($qry1);
	$count1=0;
  while($row = $sql-> db_Fetch())
  		{
 			$player[$count1]['roster_id']=$row['roster_id'];
			$player[$count1]['roster_saison_id']=$row['roster_saison_id'];
			$player[$count1]['roster_player_id']=$row['roster_player_id'];
			$player[$count1]['roster_team_id']=$row['roster_team_id'];
			$player[$count1]['roster_status']=$row['roster_status'];			
			$player[$count1]['roster_jersy']=$row['roster_jersy'];
			$player[$count1]['roster_imfeld']=$row['roster_imfeld'];
			$player[$count1]['roster_position']=$row['roster_position'];
			$player[$count1]['roster_description']=$row['roster_description'];			
			$player[$count1]['players_id']=$row['players_id'];
			$player[$count1]['players_name']=$row['players_name'];
			$player[$count1]['players_user_id']=$row['players_user_id'];
			$player[$count1]['players_admin_id']=$row['players_admin_id'];
			$player[$count1]['players_url']=$row['players_url'];
			$player[$count1]['players_mail']=$row['players_mail'];
			$player[$count1]['players_location']=$row['players_location'];
			if($row['roster_image']=="" || !$row['roster_image'])
				{$player[$count1]['players_image']=$row['players_image'];}
			else{$player[$count1]['players_image']=$row['roster_image'];}
			$player[$count1]['players_burthday']=$row['players_burthday'];

			$player[$count1]['players_description']=$row['players_description'];
			$count1++;   		
     	}
$Summegoals=0;$Summeassis=0;$Summepunkte=0;
for($i=0; $i < $count1 ;$i++)
		{
		$player[$i]['games']=player_games_count($player[$i]['roster_id']);// Spiele gespielt
		$player[$i]['goals']=player_goals_count($player[$i]['roster_id']);// Tore geschoßen							
		$player[$i]['assis']=player_assist_count($player[$i]['roster_id']);// Assis gemacht	
		$player[$i]['strafen']=player_strafe_count($player[$i]['roster_id']);// Strafen gemacht
		
		$Points_aus_archiv=get_archiv_data($player[$i]['roster_id']);		
		if($Points_aus_archiv['player_points_1'] > $player[$i]['games']){$player[$i]['games']=$Points_aus_archiv['player_points_1'];}
		if($Points_aus_archiv['player_points_2'] > $player[$i]['goals']){$player[$i]['goals']=$Points_aus_archiv['player_points_2'];}
		if($Points_aus_archiv['player_points_3'] > $player[$i]['assis']){$player[$i]['assis']=$Points_aus_archiv['player_points_3'];}
	
		$Summeassis=$Summeassis+$player[$i]['assis'];
		$Summepunkte=$Summeassis+$Summegoals;
		$player[$i]['Points']=$player[$i]['goals']+$player[$i]['assis'];
		}
/////////////////////////////////////////////////////////		

$PosText[0]="";
$PosText[1]="T";
$PosText[2]="V";
$PosText[3]="S";
$PosText[4]="M";
$PosText[9]="B";
$PosText[10]="Tr";

////////////////Sort T ///////////       
  for($j=0;$j<($count1-1);$j++)
   		{   
      for($i=$j+1;$i<($count1);$i++)
   			{
      	if(($player[$j]['goals']== $player[$i]['goals'])&&(($player[$j]['Points'] < $player[$i]['Points']))||($player[$j]['goals'] < $player[$i]['goals']))
        		{
						$Zwieschen=$player[$j];
						$player[$j]=$player[$i];
						$player[$i]=$Zwieschen;
        		}
  			 }
  		} 
///////////////////////////////////
$text ="<script type=\"text/javascript\" src=\"".e_PLUGIN."sport_league_e107/handler/wz_tooltip.js\"></script>";
$text .="
<table cellpadding='0' cellspacing='0' width='100%'>";
if($pref['sport_league_menu_scorer_first']=="0")
	{
	$text .="	<tr>
							<td style='vertical-align:top;padding:0px;padding-bottom:4px;'>
								<table cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td class='' style='width:30%;border:0px;text-align:center;vertical-align:top;font-size:10px;padding:0px;'><a href='".e_PLUGIN."sport_league_e107/profil.php?player_id=".$player[0]['roster_id']."' title='".$player[0]['players_name']."'><img border='0' src='".e_PLUGIN."sport_league_e107/fotos/".$player[0]['players_image']."' height='100px'></a></td>
									<td class='' style='width:30%;border:0px;text-align:right;vertical-align:top;font-size:12px;padding:1px;'>
										<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$team_icon."' width='50px'>
										<br/>&nbsp;".$player[0]['players_team']."
										<br/><a href='".e_PLUGIN."sport_league_e107/profil.php?player_id=".$player[0]['roster_id']."' title='".LAN_LEAGUE_ROSTER_POINTS_MENU_04." ".$player[0]['players_name']."'>".$player[0]['players_name']."</a><br/>".LAN_LEAGUE_ROSTER_POINTS_MENU_11.":&nbsp;<b>".$player[0]['games']."</b><br/>&nbsp;".LAN_LEAGUE_ROSTER_POINTS_MENU_13.":&nbsp;<b>".$player[0]['goals']."</b>
										<div style='font-size:12px;'><b>".LAN_LEAGUE_ROSTER_POINTS_MENU_10." 1.</b></div>
									</td>
								</tr>
							 </table>
							</td>
						</tr>";
	$Start_Table=1;
	}
else{
	$Start_Table=0;
	}
 $text .="	<tr>
							<td>	
								<table cellpadding='0' cellspacing='0' width='100%'>
									<tr>
										<td class='fcaption' colspan='2'>".LAN_LEAGUE_ROSTER_POINTS_MENU_06."</td>
										<td class='fcaption'>".LAN_LEAGUE_ROSTER_POINTS_MENU_07."</td>
										<td class='fcaption'>".LAN_LEAGUE_ROSTER_POINTS_MENU_08."</td>
									</tr>";


  for($i=$Start_Table;$i < $MAXIMUM; $i++)     	
    {						
 		$text .="<tr>"; 
 		$text .="<td class='forumheader3' style='padding:1px;border-top:0px;font-size:11px;text-align:right;'>".($i+1).".</td>"; 
 //		$text .="<td class='forumheader3' style='padding:1px;border-top:0px;border-left:0px;font-size:8px;text-align:left;'>#".$player[$i]['roster_jersy']."</td>"; 
$text .="<td class='forumheader3' style='color:#444;padding:1px;border-top:0px;border-left:0px;font-size:12px;text-align:left;'>";
$text.="<a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$player[$i]['roster_id']."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$player[$i]['players_image']."\' width=\'120\'><br/>".$player[$i]['players_name']."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"' style='color:#444'> ".$player[$i]['players_name']."</a>";
$text.="&nbsp;</td>";
 		$text .="<td class='forumheader3' style='padding:1px;border-right:0px;border-top:0px;border-left:0px;font-size:11px;text-align:center;'>".$player[$i]['games']."</td>"; 
 		$text .="<td class='forumheader3' style='padding:1px;border-top:0px;font-size:11px;text-align:center;'>".$player[$i]['goals']."</td>";
 		$text .="</tr>";
		}																	
$text .="				</table>
							</td>
						</tr>
					</table>";	
$title = "<b>".LAN_LEAGUE_ROSTER_POINTS_MENU_02." ".$team_Short_Name." </b>";

$text .= "<a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$MY_TEAM."'>".LAN_LEAGUE_ROSTER_POINTS_MENU_03."</a><br/><br/>";
}
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$ns -> tablerender($title, $text);
?>