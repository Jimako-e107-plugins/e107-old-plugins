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
|		$Source: ../e107_plugins/sport_league_e107/roster_liga_points.php,v $
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
if($_GET['liga']){$liga=$_GET['liga'];}else{$liga=$pref['lique_my_liga'];}
$ADM = (ADMIN)? true:false;
$z['games']=0;
 		$sql -> db_Select("league_games", "*", "game_league_id=".$liga."");
 		while($row = $sql-> db_Fetch()){
 		$z['games']++;
		}
$z['players']=0;
 		$sql -> db_Select("league_roster", "*", "roster_league_id=".$liga."");
 		while($row = $sql-> db_Fetch()){
 		$z['players']++;
		}
///////////////////////////////////
$expand_autohide = "display:none; ";
$text = "<div style='width:100%; text-align: center;'>";
	
////////////////+++++++++++++++++++++++++////////////////////////////////+++++++++++++++++++++++++////////////////+++++++++++++++++++++++++
if($z['players']==0)
  {
  $title = "<b>Statistik der ".LIGANAME." </b>";	 	
 	$text .= "</br></br></br><b><p align='center'>".LAN_LEAGUE_ROSTER_03."</b></br></br></br>";		
 	}
else
 {
   $qry1="
   SELECT a.*, ae.*, ab.*, ac.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id
   LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_teams AS ac ON ac.team_id=ab.leagueteam_team_id   
   WHERE a.roster_league_id =".$liga." AND a.roster_position<'9' ORDER BY a.roster_position, a.roster_jersy
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
			$player[$count1]['players_id']=$row['players_id'];
			$player[$count1]['players_name_long']=$row['players_name'];
			$player[$count1]['players_name']=player_shortname($row['players_name']);			
			$player[$count1]['players_user_id']=$row['players_user_id'];
			$player[$count1]['players_admin_id']=$row['players_admin_id'];
			$player[$count1]['roster_image'] = ($row['roster_image']!="")?$row['roster_image']:$row['players_image'];
			$player[$count1]['players_burthday']=$row['players_burthday'];
			
			$player[$count1]['team_id']=$row['leagueteam_id'];
			$player[$count1]['team_name']=$row['team_name'];
			$player[$count1]['team_icon']=$row['team_icon'];
			$count1++;   		
     	}
$Summegoals=0;$Summeassis=0;$Summepunkte=0;
for($i=0; $i < $count1 ;$i++)
		{
			$player[$i]['games']=0;// Spiele gespielt
			$sql -> db_Select("league_anw", "*","anw_player_id='".$player[$i]['roster_id']."'");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i]['games']++;
				}
			$player[$i]['goals']=0;// Tore geschoßen
			$sql -> db_Select("league_points", "*","points_player_id='".$player[$i]['roster_id']."' AND points_value= 1");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i]['goals']++;
				}
			$Summegoals=$Summegoals+$player[$i]['goals'];
			$player[$i]['assis']=0;// Assis gemacht
			$sql -> db_Select("league_points", "*","points_player_id='".$player[$i]['roster_id']."' AND points_value= 2");
			while($row = $sql-> db_Fetch())
   			{
   			$player[$i]['assis']++;
				}
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

////////////////Sort P ///////////       
  for($j=0;$j<($count1-1);$j++)
   		{   
      for($i=$j+1;$i<($count1);$i++)
   			{
      	if(($player[$j]['Points']== $player[$i]['Points'])&&(($player[$j]['goals'] < $player[$i]['goals']))||($player[$j]['Points'] < $player[$i]['Points']))
        		{
						$Zwieschen=$player[$j];
						$player[$j]=$player[$i];
						$player[$i]=$Zwieschen;
        		}
  			 }
  		} 
///////////////////////////////////




$text .= "<div style='width:100%; text-align: center;'>
<div id='exp_points' style=''>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), einblenden('exp_points'), ausblenden('exp_assis')\"><b>	Punkten-Tabelle </b></div></td>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"einblenden('exp_goals'), ausblenden('exp_points'), ausblenden('exp_assis')\"><b>	Toren-Tabelle </b></div></td>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), ausblenden('exp_points'), einblenden('exp_assis')\"><b>	Assis-Tabelle </b></div></td>
			</tr>
		</table>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
$DURCHSCH=0;
$ANTEIL=0;$SG=0;
 $text .= "<tr>
		<td class='fcaption' style='width: 2%; text-align: center'><b>.</b></td>
		<td class='fcaption' style='width: 3%; text-align: center'><b>".LAN_LEAGUE_ROSTER_04."</b></td>
		<td class='fcaption'5><b>".LAN_LEAGUE_ROSTER_05."</b></td>
		<td class='fcaption' style='width: 5%; text-align: center'><b>Pos.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>SP.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>P</b></td>
		<td class='fcaption' style='width: 20%; text-align: center'><b>Pro Sp.</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>%</b></td>
	</tr>";
  for($i=0;$i < $count1; $i++)     	
    {								///	$NUMMBER,													$PLAYERID,										$PLAYERNAME							,$GAMES,							$POINTS
    $WERT=player_row(($i+1),$player[$i]['roster_jersy'], $player[$i]['roster_id'], $player[$i]['players_name'], $player[$i]['players_name_long'],$PosText[$player[$i]['roster_position']], $player[$i]['games'], $player[$i]['Points'], $Summepunkte, $player[$i]['roster_image'],$liga,$player[$i]['team_id'],$player[$i]['team_name'],$player[$i]['team_icon'],$ADM);
    $text .=$WERT['text'];
    $DURCHSCH+=$WERT['durchsch'];
    $ANTEIL +=$WERT['anteil'];
    $SG +=$player[$i]['games'];
    }
  $DURCHSCH= round(($DURCHSCH/$count1),2);
  $SGDurch=round(($SG/$count1),0);
  $ANTEIL = round($ANTEIL,0);
$text .="
		<td class='forumheader' colSpan='4'><b>Summen:</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$SGDurch."</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$Summepunkte."</b></td>
		<td class='forumheader' style='text-align:right;'><b>".$DURCHSCH."</b> je. pro Sp.</td>
		<td class='forumheader' style='text-align:right;'><b>".$ANTEIL." %</b></td>
	</tr>
</table></div>";
/////// Nach tore
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

$text .= "<div id='exp_goals' style='$expand_autohide'>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), einblenden('exp_points'), ausblenden('exp_assis')\"><b>	Punkten-Tabelle </b></div></td>
				<td class='forumheader' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"einblenden('exp_goals'), ausblenden('exp_points'), ausblenden('exp_assis')\"><b>	Toren-Tabelle </b></div></td>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), ausblenden('exp_points'), einblenden('exp_assis')\"><b>	Assis-Tabelle </b></div></td>
			</tr>
		</table>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
$DURCHSCH=0;
$ANTEIL=0;$SG=0;
 $text .= "<tr>
		<td class='fcaption' style='width: 2%; text-align: center'><b>.</b></td>
		<td class='fcaption' style='width: 3%; text-align: center'><b>".LAN_LEAGUE_ROSTER_04."</b></td>
		<td class='fcaption'5><b>".LAN_LEAGUE_ROSTER_05."</b></td>
		<td class='fcaption' style='width: 5%; text-align: center'><b>Pos.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>SP.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>T</b></td>
		<td class='fcaption' style='width: 20%; text-align: center'><b>Pro Sp.</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>%</b></td>
	</tr>";
  for($i=0;$i < $count1; $i++)     	
    {								///	$NUMMBER,													$PLAYERID,										$PLAYERNAME																										,$GAMES,									$POINTS
    $WERT=player_row(($i+1),$player[$i]['roster_jersy'], $player[$i]['roster_id'], $player[$i]['players_name'], $player[$i]['players_name_long'], $PosText[$player[$i]['roster_position']], $player[$i]['games'], $player[$i]['goals'], $Summegoals, $player[$i]['roster_image'], $liga, $player[$i]['team_id'],$player[$i]['team_name'],$player[$i]['team_icon'],$ADM);
    $text .=$WERT['text'];
    $DURCHSCH+=$WERT['durchsch'];
    $ANTEIL +=$WERT['anteil'];
    $SG +=$player[$i]['games'];
    }
  $DURCHSCH= round(($DURCHSCH/$count1),2);
  $SGDurch=round(($SG/$count1),0);
  $ANTEIL = round($ANTEIL,0);
$text .="
		<td class='forumheader' colSpan='4'><b>Summen:</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$SGDurch."</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$Summegoals."</b></td>
		<td class='forumheader' style='text-align:right;'><b>".$DURCHSCH."</b> je. pro Sp.</td>
		<td class='forumheader' style='text-align:right;'><b>".$ANTEIL." %</b></td>
	</tr>
</table></div>";
////////////    nach Assis
////////////////Sort T ///////////       
  for($j=0;$j<($count1-1);$j++)
   		{   
      for($i=$j+1;$i<($count1);$i++)
   			{
      	if(($player[$j]['assis']== $player[$i]['assis'])&&(($player[$j]['Points'] < $player[$i]['Points']))||($player[$j]['assis'] < $player[$i]['assis']))
        		{
						$Zwieschen=$player[$j];
						$player[$j]=$player[$i];
						$player[$i]=$Zwieschen;
        		}
  			 }
  		} 
///////////////////////////////////
$text .= "<div id='exp_assis' style='$expand_autohide'>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), einblenden('exp_points'), ausblenden('exp_assis')\"><b>	Punkten-Tabelle </b></div></td>
				<td class='forumheader2' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"einblenden('exp_goals'), ausblenden('exp_points'), ausblenden('exp_assis')\"><b>	Toren-Tabelle </b></div></td>
				<td class='forumheader' style='width: 33%; text-align: center'><div style='cursor:pointer' onclick=\"ausblenden('exp_goals'), ausblenden('exp_points'), einblenden('exp_assis')\"><b>	Assis-Tabelle </b></div></td>
			</tr>
		</table>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
$DURCHSCH=0;
$ANTEIL=0;$SG=0;
 $text .= "<tr>
		<td class='fcaption' style='width: 2%; text-align: center'><b>.</b></td>
		<td class='fcaption' style='width: 3%; text-align: center'><b>".LAN_LEAGUE_ROSTER_04."</b></td>
		<td class='fcaption'5><b>".LAN_LEAGUE_ROSTER_05."</b></td>
		<td class='fcaption' style='width: 5%; text-align: center'><b>Pos.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>SP.</b></td>
		<td class='fcaption' style='width: 10%; text-align: center'><b>A</b></td>
		<td class='fcaption' style='width: 20%; text-align: center'><b>Pro Sp.</b></td>
		<td class='fcaption' style='width: 15%; text-align: center'><b>%</b></td>
	</tr>";
  for($i=0;$i < $count1; $i++)     	
    {								///	$NUMMBER,													$PLAYERID,										$PLAYERNAME																										,$GAMES,									$POINTS
    $WERT=player_row(($i+1),$player[$i]['roster_jersy'], $player[$i]['roster_id'], $player[$i]['players_name'], $player[$i]['players_name_long'], $PosText[$player[$i]['roster_position']], $player[$i]['games'], $player[$i]['assis'], $Summeassis, $player[$i]['roster_image'], $liga, $player[$i]['team_id'],$player[$i]['team_name'],$player[$i]['team_icon'],$ADM);
    $text .=$WERT['text'];
    $DURCHSCH+=$WERT['durchsch'];
    $ANTEIL +=$WERT['anteil'];
    $SG +=$player[$i]['games'];
    }
  $DURCHSCH= round(($DURCHSCH/$count1),2);
  $SGDurch=round(($SG/$count1),0);
  $ANTEIL = round($ANTEIL,0);
$text .="
		<td class='forumheader' colSpan='4'><b>Summen:</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$SGDurch."</b></td>
		<td class='forumheader' style='text-align:center;'><b>".$Summeassis."</b></td>
		<td class='forumheader' style='text-align:right;'><b>".$DURCHSCH."</b> je. pro Sp.</td>
		<td class='forumheader' style='text-align:right;'><b>".$ANTEIL." %</b></td>
	</tr>
</table></div>";
//////////////////////////////
$text .="</div>";

$title = "<b>Statistik der ".$team_Name." </b>";

$text .= "<br /><div style='text-align:center'>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_LEAGUE_ROSTER_16."</b></div><br/>";
}
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$ns -> tablerender($title, $text);


// ========= End of the BODY ===================================================
// use FOOTERF for USER PAGES and e_ADMIN."footer.php" for Admin pages.
require_once(FOOTERF);
////////////////////////  Functionen ////////////////////////////////////////////////////////////////////////////
function player_row($INDEX,$NUMMBER,$PLAYERID,$PLAYERNAME,$PLAYERNAME_LONG,$POSI,$GAMES,$POINTS,$GESAMMT,$IMAGE, $Liga_ID,$team_ID,$team_NAME,$team_ICO,$ADM)
	{
	$ROWTEXT['durchsch']=round(($POINTS / $GAMES),2);
	$ROWTEXT['anteil']= round(($POINTS/($GESAMMT/100)),2);
 	$ROWTEXT['text'] = "<tr>";
 	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:right;'>".$INDEX."</td>";  	 
 	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:right;'><b>&nbsp;".$NUMMBER."</b></td>"; 
 	$ROWTEXT['text'] .= "<td class='forumheader3'>";
 	$ROWTEXT['text'] .= ($ADM)? "<a href='admin/admin_league_player_archiv.php?neu.".$PLAYERID.".".$Liga_ID.".".$team_ID."' ><img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>":"";
 	
 	$ROWTEXT['text'] .= "<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$team_ICO."' width='40' title='".$team_NAME."'>";
 	$ROWTEXT['text'] .= "<b><a href=\"".e_PLUGIN."sport_league_e107/profil.php?player_id=".$PLAYERID."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><img src=\'".e_PLUGIN."sport_league_e107/fotos/".$IMAGE."\' width=\'120\'><br/>".$PLAYERNAME_LONG."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"> ".$PLAYERNAME."</b></td>"; 
	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:center;'><b>".$POSI."</b></td>"; 
 	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:center;'><b>".$GAMES."</b></td>"; 
 	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:center;'><b>".$POINTS."</b></td>";
	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:right;'><b>".$ROWTEXT['durchsch']."</b> pro Sp.</td>";
	$ROWTEXT['text'] .= "<td class='forumheader3' style='text-align:right;'><b>".$ROWTEXT['anteil']." %</b></td>"; 
 	$ROWTEXT['text'] .= "</tr>"; 
	return $ROWTEXT;	
	}
function player_shortname($longname)
{
$array = explode(", ",$longname);	
$Vorname=substr($array[1],0,1);
$Vorname .=". ";
$Vorname .= $array[0];
return $Vorname;
}
?>