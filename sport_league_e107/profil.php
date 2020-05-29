<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/profil.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");                                                                                       
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_roster_lan.php");
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/playerstats_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/playerstats_lan.php");
require_once("".e_PLUGIN."sport_league_e107/functionen.php");
// ============= START OF THE BODY ====================================
 $qry1="
   			SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
				LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id   
				WHERE a.roster_id =".$_GET['player_id']."
   		";
	$sql->db_Select_gen($qry1);	
  while($row = $sql-> db_Fetch())
  		{
 			$player[0]=$row['roster_id'];
			$player[2]=$row['roster_league_id'];
			$player[3]=$row['roster_player_id'];
			$player[4]=$row['roster_team_id'];
			$player[1]=$row['roster_status'];			
			$player[5]=$row['roster_jersy'];
			$player[6]=$row['roster_imfeld'];
			$player[7]=$row['roster_position'];
			$player[8]=$row['roster_imfeld'];
			$player[9]=$row['roster_description'];
			$player[16]=$row['players_id'];
			$player[17]=$row['players_name'];
			$player[18]=$row['players_user_id'];
			$player[19]=$row['players_admin_id'];
			$player[20]=$row['players_url'];
			$player[21]=$row['players_mail'];
			$player[22]=$row['players_location'];
			if($row['roster_image']=="" || !$row['roster_image'])
				{$player[23]=$row['players_image'];}
			else{$player[23]=$row['roster_image'];}
			$player[24]=$row['players_burthday'];
			$player[25]=$row['players_site'];
			$player[26]=$row['players_wigth'];
			$player[27]=$row['players_height'];
			$player[28]=$row['players_visier'];
			$player[29]=$row['players_description'];    		
     	}  
$player[10]=0;// Spiele gespielt
$sql -> db_Select("league_anw", "*","anw_player_id='".$player[0]."'");
while($row = $sql-> db_Fetch())
   {
   	$player[10]++;
		}
if($player[7]< 7)
{
$player[11]=0;// Tore geschoޥn
$sql -> db_Select("league_points", "*","points_player_id='".$player[0]."' AND points_value= 1");
while($row = $sql-> db_Fetch())
   {
   	$player[11]++;
		}
$player[12]=0;// Assis gemacht
$sql -> db_Select("league_points", "*","points_player_id='".$player[0]."' AND points_value= 2");
while($row = $sql-> db_Fetch())
   {
   	$player[12]++;
		}
if($player[7]==1)
	{
	$player[31]=0;// Gegentore Torman
	$sql -> db_Select("league_anw", "*","anw_player_id='".$player[0]."'");
	while($row = $sql-> db_Fetch())
   	{
   	$player[31]++;
		}
	}
$Points_aus_archiv=get_archiv_data($player[0]);		
if($Points_aus_archiv['player_points_1'] > $player[10]){$player[10]=$Points_aus_archiv['player_points_1'];}
if($Points_aus_archiv['player_points_2'] > $player[11]){$player[11]=$Points_aus_archiv['player_points_2'];}
if($Points_aus_archiv['player_points_3'] > $player[12]){$player[12]=$Points_aus_archiv['player_points_3'];}	
$player[13]=$player[11]+$player[12];
}
else{$player[11]="-/-";$player[12]="-/-";$player[13]="-/-";}

$userN=$player[18];
$adminN=$player[19];
$teamid=$player[4];
$postext[0]=LAN_LEAGUE_ROSTER_23;		
$postext[1]=LAN_LEAGUE_ROSTER_10;		
$postext[2]=LAN_LEAGUE_ROSTER_11;		
$postext[3]=LAN_LEAGUE_ROSTER_13;		
$postext[4]="M";		
$postext[9]=LAN_LEAGUE_ROSTER_14;		
$postext[10]=LAN_LEAGUE_ROSTER_15;	



$STATEN[0]=LAN_LEAGUE_ROSTER_23;
$STATEN[1]="<div style='color:#22aa22'>".LAN_LEAGUE_ROSTER_39."</div>";
$STATEN[2]="<div style='color:#aaaa00'>".LAN_LEAGUE_ROSTER_40."</div>";
$STATEN[3]="<div style='color:#ff0000'>".LAN_LEAGUE_ROSTER_41."</div>";
$STATEN[4]="<div style='color:#ff0000'>".LAN_LEAGUE_ROSTER_41a."</div>";
$STATEN[5]="<div style='color:#ff0000'>".LAN_LEAGUE_ROSTER_41b."</div>";
$STATEN[6]="<div style='color:#ff0000'>".LAN_LEAGUE_ROSTER_41c."</div>";
$STATUS=$STATEN[$player[1]];


if($player[24]=="" || $player[24]<=0){$player[24]=LAN_LEAGUE_ROSTER_23;}//Keine Eingaben
	else{
		$player[24]=strftime("%Y-%m-%d", $player[24]);
		}

$pos=$postext[$player[7]];

if(!$player[29]){$player[29]=LAN_LEAGUE_ROSTER_23;}else{$player[29]= $tp->toHTML($player[29],TRUE);}


$user_burtd=$player[24];
if(!$player[24] ||$player[24]==0 ||$player[24]=="0000-00-00")
	{$user_user_alter=0;
	 $player[24]=0;
	}
else{$user_user_alter =alter_ermittel($player[24]);
		$usergeb = explode("-", $player[24]);
		$player[24]=$usergeb[2].".".$usergeb[1].".".$usergeb[0];
		}

$MYTEXT ="";
$MYTEXT .= "<div style='width:100%;text-align:center;vertical-align:top;'>
							<table class='fborder' style='width:100%' cellspacing='0' cellpadding='0'>";
$MYTEXT .="
			<tr>
			<td class='forumheader3'style='vertical-align:midle;text-align:center;width:20%'>
						<a href='fotos/big/".$player[23]."' rel='shadowbox' title='' style='border:0px #bbb solid;cursor: url(images/system/lupe.cur), pointer;'>
							<img class='dl_image' border='0' src='fotos/big/".$player[23]."' alt='' style='width:150px; border:#900 3px solid;' /></a></td>
			<td class='forumheader3' style='padding:0px;text-align:left;vertical-align:top;width:80%'>
				<table class='fborder' style='width:100%;border:0px;height:100%;' cellspacing='0' cellpadding='0'>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_05.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".$player[17]."</td>
					</tr>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_35.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".(($player[5]==""||$player[5]==0)?LAN_LEAGUE_ROSTER_23 : $player[5])."</td>
					</tr>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_31.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".$pos."</td>
					</tr>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_32.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".(($player[24]==""||$player[24]==0)?LAN_LEAGUE_ROSTER_23 : $player[24])."</td>
					</tr>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_44.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".(($user_user_alter!=0)? $user_user_alter." ".LAN_LEAGUE_ROSTER_45 : LAN_LEAGUE_ROSTER_23)."</td>
					</tr>
					<tr>
						<td class='forumheader' style='width:30%;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_38.":</td>
						<td class='forumheader3' style='width:70%;border-left:0px;border-right:0px;border-top:0px;'>".$STATUS."</td>
					</tr>
					<tr>
						<td class='forumheader3' colspan='2' style='width:100%;border-left:0px;border-right:0px;border-top:0px;'>in  ";
						
$MYTEXT .=saison_liga_name($player[2]);
$MYTEXT .="</td>
					</tr>
				</table>
				<table class='fborder' style='width:100%;border:0px;height:100%;' cellspacing='0' cellpadding='0'>
									<tr>";
			$MYTEXT .= "
			<td class='fcaption' style='text-align: center;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_27."</td>
			<td class='fcaption' style='text-align: center;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_28."</td>
			<td class='fcaption' style='text-align: center;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_29."</td>
			<td class='fcaption' style='text-align: center;border-left:0px;border-top:0px;'>".LAN_LEAGUE_ROSTER_30."</td>
			</tr>
			<tr>
			<td class='forumheader3' style='text-align: center;border-left:0px;border-top:0px;'>".$player[10]."</td>
			<td class='forumheader3' style='text-align: center;border-left:0px;border-top:0px;'>".$player[11]."</td>
			<td class='forumheader3' style='text-align: center;border-left:0px;border-top:0px;'>".$player[12]."</td>
			<td class='forumheader3' style='text-align: center;border-left:0px;border-top:0px;'>".$player[13]."</td>";
			$MYTEXT .= "
			</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td colspan='2'>
					<table style='width:100%' height='100%', class='fborder', cellspacing='0', cellpadding='0'>
						<tr>
							<td class='fcaption' style='width: 100%'>".LAN_LEAGUE_ROSTER_36."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width:100%'>".$player[29]."</td>
						</tr>
					</table>
				</td>
			</td>
			</tr>
			</table><br/>";
$text =$MYTEXT;
$text .=player_stats($player[16]);

$text .="<div style='text-align:right'>";
$From="profil.php?player_id=".$_GET['player_id']."";
$title ="# ";
$title .=$player[5];
$title .=" ";
$title .=$player[17];
$text .= druckansicht($title, $MYTEXT, $From);
if(ADMIN){
	$text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_roster_config.php?edit.".$player[0].".".$player[4]."' title='".LAN_LEAGUE_ROSTER_24."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/roster_edit.png'></a>&nbsp;&nbsp;
					<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_player_list.php?edit.".$player[16]."' title='".LAN_LEAGUE_ROSTER_43."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>				
								";
					}
$text .="</div>";            
$text .= "<br/>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_LEAGUE_ROSTER_16."</b></div><br/>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$ns -> tablerender($title, $text);
require_once(FOOTERF);

/////////////////////////////////////////////////////////////////
function player_stats($id)
{
global $sql;
$posvalue[1]=LAN_LEAGUE_PLAYERSTATS_7;///Torhüter
$posvalue[2]=LAN_LEAGUE_PLAYERSTATS_8;///Verteidiger
$posvalue[3]=LAN_LEAGUE_PLAYERSTATS_9;///Stürmer
$posvalue[4]=LAN_LEAGUE_PLAYERSTATS_18;///Mittelstürmer
$posvalue[9]=LAN_LEAGUE_PLAYERSTATS_10;///Trainer
$posvalue[10]=LAN_LEAGUE_PLAYERSTATS_11;///Betreuer
$posvalue[0]=LAN_LEAGUE_PLAYERSTATS_12;///Keine Eingaben
/////////////-----------------------------------------------------------------
   $qry1="
   SELECT a.*, ae.*, au.*, ao.*, ad.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_teams AS au ON au.team_id=ae.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS ao ON ao.league_id=a.roster_league_id
   LEFT JOIN ".MPREFIX."league_saison AS ad ON ad.saison_id=ao.league_saison_id
   WHERE a.roster_player_id='".$id."' ORDER BY ad.saison_order DESC, a.roster_id DESC
   		";
	$sql->db_Select_gen($qry1);
$Scount=0;	
while($row = $sql-> db_Fetch())
   {
   	$Saisons[$Scount]['ID']=$row['roster_id'];
   	$Saisons[$Scount]['roster_saison_id']=$row['roster_saison_id'];
   	$Saisons[$Scount]['roster_team_id']=$row['roster_team_id'];
   	$Saisons[$Scount]['leagueteam_id']=$row['leagueteam_id'];
   	$Saisons[$Scount]['league_id']=$row['league_id'];
   	
   	$Saisons[$Scount]['roster_position']=$posvalue[$row['roster_position']];
   	$Saisons[$Scount]['position']=$row['roster_position'];
   	$Saisons[$Scount]['liga_team_id']=$row['liga_team_id'];
   	$Saisons[$Scount]['team_name']=$row['team_name'];
   	$Saisons[$Scount]['team_kurzname']=$row['team_kurzname'];
   	$Saisons[$Scount]['team_admin_id']=$row['team_admin_id'];
   	$Saisons[$Scount]['team_url']=$row['team_url'];
   	$Saisons[$Scount]['team_icon']=$row['team_icon'];
   	$Saisons[$Scount]['saison_name']=$row['saison_name'];
   		$Saisons[$Scount]['saison_id']=$row['saison_id'];
   	$Scount++;
		}
if($Scount==0)
	{
		return "";
	}
for($i=0; $i < $Scount ; $i++)
	{
	$Saisons[$i]['games']=player_games_count($Saisons[$i]['ID']);	
	if($Saisons[$i]['position']< 7)
		{
			$Saisons[$i]['goals']=player_goals_count($Saisons[$i]['ID']);
			$Saisons[$i]['assis']=player_assist_count($Saisons[$i]['ID']);
			$Saisons[$i]['punkte']=$Saisons[$i]['goals']+$Saisons[$i]['assis'];
		}
	else{
			$Saisons[$i]['goals']="-/-";
			$Saisons[$i]['assis']="-/-";
			$Saisons[$i]['punkte']="-/-";
			}
	}

$ausgabe = "<div style='width:100%; text-align: center; vertical-align: top;'>".LAN_LEAGUE_PLAYERSTATS_1."<br/><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

	$ausgabe .= "
				<tr>";
//$ausgabe .= "<td class='fcaption' style='text-align: center' >ID</td>";
$ausgabe .= "<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_2."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_3."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_4."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_14."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_15."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_16."</td>
					<td class='fcaption' style='text-align: center' >".LAN_LEAGUE_PLAYERSTATS_17."</td>
				</tr>";

for($i=0; $i < $Scount ; $i++)
	{				
	$Points_aus_archiv=get_archiv_data($Saisons[$i]['ID']);
	if($Points_aus_archiv['player_points_1'] > $Saisons[$i]['games']){$Saisons[$i]['games']=$Points_aus_archiv['player_points_1'];}
	if($Points_aus_archiv['player_points_2'] > $Saisons[$i]['goals']){$Saisons[$i]['goals']=$Points_aus_archiv['player_points_2'];}
	if($Points_aus_archiv['player_points_3'] > $Saisons[$i]['assis']){$Saisons[$i]['assis']=$Points_aus_archiv['player_points_3'];}
	if(($Points_aus_archiv['player_points_3']+$Points_aus_archiv['player_points_2']) > $Saisons[$i]['punkte']){$Saisons[$i]['punkte']=($Points_aus_archiv['player_points_2']+$Points_aus_archiv['player_points_3']);}
	}
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
	$ausgabe .= "
				<tr>";
//$text .= "<td class='forumheader2' style='text-align: left'>".$Saisons[$i]['ID']."</td>";
$ausgabe .= "<td class='forumheader2' style='text-align: left'><a href='league_table.php?".$Saisons[$i]['saison_id'].".".$Saisons[$i]['league_id']."' title='Liga-Tabelle ansehen'>".$Saisons[$i]['saison_name']."</a></td>
					<td class='forumheader3' style='text-align: center;padding:1px;'><a href='roster.php?team=".$Saisons[$i]['roster_team_id']."' title='".$Saisons[$i]['team_name']."'><img class='dl_image' src='logos/".$Saisons[$i]['team_icon']."' alt='".$Saisons[$i]['team_name']."' style='border:0px;' height='20' /></a></td>
					<td class='forumheader3' style='text-align: center'>".$Saisons[$i]['roster_position']."</td>
					<td class='forumheader3' style='text-align: center'>".$Saisons[$i]['games']."</td>
					<td class='forumheader3' style='text-align: center'>".$Saisons[$i]['goals']."</td>
					<td class='forumheader3' style='text-align: center'>".$Saisons[$i]['assis']."</td>
					<td class='forumheader3' style='text-align: center'>".$Saisons[$i]['punkte']."</td>
				</tr>";
	}
$ausgabe .= "<td class='forumheader3' style='text-align: left'>".LAN_LEAGUE_ROSTER_51."</td>
					<td class='forumheader2' style='text-align: center'>--</td>
					<td class='forumheader2' style='text-align: center'>--</td>
					<td class='forumheader2' style='text-align: center'>".$SUMME['games']."</td>
					<td class='forumheader2' style='text-align: center'>".$SUMME['goals']."</td>
					<td class='forumheader2' style='text-align: center'>".$SUMME['assis']."</td>
					<td class='forumheader2' style='text-align: center'>".$SUMME['punkte']."</td>
				</tr>";              
$ausgabe .= "</table><br />";

return $ausgabe;
}
///////////////////// Funktionen /////////////////////////////////
function alter_ermittel($Geburtstag)
{
$jetzt['dat'] = date("d");
$jetzt['mon'] = date("m"); 
$jetzt['year'] = date("Y");
$Heute=$jetzt['year']."-".$jetzt['mon']."-".$jetzt['dat'];
$Geb = explode("-", $Geburtstag);
$Alt=$jetzt['year']-$Geb[0];
if($jetzt['mon'] < $Geb[1] || $jetzt['mon']== $Geb[1] && $jetzt['dat'] < $Geb[2] )
	{$Alt=$Alt-1;}
return $Alt;
}
?>
