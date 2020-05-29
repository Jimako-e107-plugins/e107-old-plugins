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
|		$Source: ../e107_plugins/sport_league_e107/admins/admin_game_config.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!USER){ header("location:".e_BASE."index.php"); exit; }
define("MAINTHEME", e_THEME.$pref['sitetheme']."/");
define("THEME", e_THEME.$pref['sitetheme']."/");


$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_game_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_game_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

define("ADMIN_EDIT_ICON", "<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_18."' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'>");

$ImageCALENDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/termine.png";
$ImageCALENDER['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_21."' src='".$ImageCALENDER['PFAD']."'>";

//$ImageTEAMS['PFAD']=e_PLUGIN."sport_league_e107/images/system/teams.png";
//$ImageTEAMS['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_ADMIN_13."' src='".$ImageTEAMS['PFAD']."'>";


$expand_autohide = "display:none; "; 

if (e_QUERY) {
	list($action, $GAM, $T) = explode(".", e_QUERY);
	$GAM = intval($GAM);
	$T= intval($T);
	unset($tmp);
}




   $qry2="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_id='".$GAM."'
   		";
		$sql->db_Select_gen($qry2);	
	 	$row = $sql-> db_Fetch();
	 	$home_admin=$row['team_admin_id'];

   $qry2="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_gast_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_id='".$GAM."'
   		";
		$sql->db_Select_gen($qry2);	
	 	$row = $sql-> db_Fetch();
	 	$gast_admin=$row['team_admin_id'];

$flag=false;
if(USERID==$home_admin || USERID==$gast_admin){$flag=true;}
if(!$flag){ header("location:".e_BASE."index.php"); exit; }




//---------------------------------------------------------------
//require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;

if(!$_GET['ID']){$GAME_ID=$_POST['ID'];}
else{$GAME_ID=$_GET['ID'];}

$count=0;

 $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_id=a.game_league_id
   LEFT JOIN ".MPREFIX."league_saison AS ab ON ab.saison_id=ae.league_saison_id
   WHERE a.game_id='".$GAM."'
   		";
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
				$game['league_id']=$row['game_league_id'];	
				$game['id']=$row['game_id'];
				$game['games_date']=$row['game_date'];
				$game['games_time']=$row['game_time'];
				$game['home_id']=$row['game_home_id'];
				$game['gast_id']=$row['game_gast_id'];
				$game['goals_home']=$row['game_goals_home'];
				$game['goals_gast']=$row['game_goals_gast'];
				$game['games_un']=$row['game_un'];
				$game['games_enable']=$row['game_enable'];
				$game['games_news_id']=$row['game_news_id'];
				$game['games_description']=$row['game_description'];
				$game['league_id']=$row['game_league_id'];
				$game['league_name']=$row['league_name'];
				$game['saison_Name']=$row['saison_name'];
				$count++;
				}


////////////////////// Team 1 Data
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   WHERE a.leagueteam_id='".$game['home_id']."'
   		";
		$sql->db_Select_gen($qry1);	
	 	$row = $sql-> db_Fetch();

		$game['home_team_Name']=$row['team_name'];
		$game['home_team_icon']=$row['team_icon'];

////////////////////// Team 2 Data
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   WHERE a.leagueteam_id='".$game['gast_id']."'
   		";
		$sql->db_Select_gen($qry1);	
	 	$row = $sql-> db_Fetch();

		$game['gast_team_Name']=$row['team_name'];
		$game['gast_team_icon']=$row['team_icon'];

//**********************************
$text = "<link rel='stylesheet' href='".MAINTHEME."style.css' />\n";
$text .= "<script type=\"text/javascript\" src=\"../../../../e107_files/e107.js\"></script>";
$text .= "<div style='width:100%;text-align:center;'>";


$text .= "<table style='width:1000px' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='forumheader'><div style='cursor:pointer' onclick=\"expandit('exp_infos')\">".LAN_LEAGUE_GAME_ADMIN_36."</div>
<div id='exp_infos' style='".$expand_autohide."'>".LAN_LEAGUE_GAME_ADMIN_37."</div></td>
	</tr>
	<tr>
		<td>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td align='center' width='50%' valign='top'>";
$text.= get_team_date($game['id'], $game['home_team_Name'], $game['home_id']);	
$text.="</td>
				<td align='center' width='50%' valign='top'>";
$text.= get_team_date($game['id'], $game['gast_team_Name'], $game['gast_id']);					
$text.="</td>
			</tr>
		</table>
	</td>
</tr>
</table>
<br/>
<form action='admin_games_config.php?list.".$game['league_id']."' method='post' id='back'>
			<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAME_ADMIN_22."'/></form>
			<br/><br/><br/>";		
$text.=powered_by();
$text.="</div>";
	
$configtitle = "".LAN_LEAGUE_GAME_ADMIN_11." <b>".$game['home_team_Name']."</b> ".LAN_LEAGUE_GAME_ADMIN_12." <b>".$game['gast_team_Name']."</b> ".LAN_LEAGUE_GAME_ADMIN_12." <b>".strftime("%A %d %b %Y",$game['games_date'])."</b> ".LAN_LEAGUE_GAME_ADMIN_18."";

$ns -> tablerender($configtitle, $text);

//require_once(e_ADMIN."footer.php");




////------------------------------------------------------------------------------
function get_team_date($game_id, $team_Name, $team_id)
	{
require_once("../../../class2.php");

$position[0]=LAN_LEAGUE_GAME_ADMIN_29;
$position[1]=LAN_LEAGUE_GAME_ADMIN_30;
$position[2]=LAN_LEAGUE_GAME_ADMIN_31;
$position[3]=LAN_LEAGUE_GAME_ADMIN_32;
$position[4]=LAN_LEAGUE_GAME_ADMIN_33;
$position[5]=LAN_LEAGUE_GAME_ADMIN_34;
$position[6]=LAN_LEAGUE_GAME_ADMIN_35;

$im_feld[0]=LAN_LEAGUE_GAME_ADMIN_13;
$im_feld[1]=LAN_LEAGUE_GAME_ADMIN_14;

$foul_text[0]="";
$foul_text[3]=LAN_LEAGUE_GAME_ADMIN_19;
$foul_text[4]=LAN_LEAGUE_GAME_ADMIN_20;
$foul_text[5]=LAN_LEAGUE_GAME_ADMIN_21;

	$sqldat =& new db;
	
		$INHALT_TEXT ="	
				<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
						<td class='fcaption'>".LAN_LEAGUE_GAME_ADMIN_1." <b>".$team_Name."</b> <a href='admin_game_anw.php?ID=".$game_id."&Team_ID=".$team_id."' title='".LAN_LEAGUE_GAME_ADMIN_1." <b>".$team_Name."</b> ".LAN_LEAGUE_GAME_ADMIN_244."'>".ADMIN_EDIT_ICON."</a></td>
					</tr>
					<tr>
						<td>
						<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
							<tr>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_4."</td>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_16."</td>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_4."</td>
							</tr>";
	$anw_count=0;

   $qry2="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_anw AS a 
   LEFT JOIN ".MPREFIX."league_roster AS ae ON ae.roster_id=a.anw_player_id
   LEFT JOIN ".MPREFIX."league_players AS ab ON ab.players_id=ae.roster_player_id
   WHERE a.anw_game_id='".$game_id."' AND a.anw_team_id='".$team_id."'
   		";
		$sqldat->db_Select_gen($qry2);	
	 	while($row = $sqldat-> db_Fetch())
	 			{
				$anw_player[$anw_count][1]=$row['anw_id'];
				$anw_player[$anw_count][2]=$row['anw_name'];/// !!!
				$anw_player[$anw_count][3]=$row['anw_saison_id'];
				$anw_player[$anw_count][4]=$row['anw_game_id'];
				$anw_player[$anw_count][5]=$row['anw_player_id'];
				$anw_player[$anw_count][6]=$row['anw_team_id'];
				$anw_player[$anw_count][7]=$row['roster_player_id'];
				$anw_player[$anw_count][8]=$row['roster_jersy'];
				$anw_player[$anw_count][9]=$row['roster_imfeld'];
				$anw_player[$anw_count][10]=$row['roster_position'];
				$anw_player[$anw_count][11]=$row['players_id'];
				$anw_player[$anw_count][12]=$row['players_name'];
				$anw_player[$anw_count][13]=$row['anw_player_id'];
				if($anw_player[$anw_count][12]=="")
					{$anw_player[$anw_count][12]="<div style='color:#f00'>Roster_id:".$anw_player[$anw_count][13]."</div>";}
				$anw_count++;
				}

////////////////Sort ///////////
       
  for($j=0;$j<($anw_count-1);$j++)
   		{   
      for($i=$j+1;$i<($anw_count);$i++)
   			{
      	if(($anw_player[$j][10]== $anw_player[$i][10])&&(($anw_player[$j][12]> $anw_player[$i][12]))||($anw_player[$j][10]> $anw_player[$i][10]))
        		{
         		for($k=0;$k< 14;$k++)
           		{
           		$zwisch[$k]=$anw_player[$j][$k];
           		}
        		for($k=0;$k< 14;$k++)
           		{
           		$anw_player[$j][$k]=$anw_player[$i][$k];
           		}
        		for($k=0;$k< 14;$k++)
           		{
           		$anw_player[$i][$k]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
///////////////////////////////////
	for($i=0; $i < $anw_count; $i++){					
		$INHALT_TEXT .= "<tr>
								<td class='forumheader3'>#".$anw_player[$i]['8']."</td>
								<td class='forumheader3'>".$POSIT=$position[$anw_player[$i]['10']]."</td>
								<td class='forumheader3'><a href='admin_roster_config.php?edit.".$anw_player[$i][13].".".$team_id."' title='Roster ID:".$anw_player[$i][13]." \nAnw ID: ".$anw_player[$i][1]."' style='text-decoration:none;'>".$anw_player[$i]['12']."</a></td>
							</tr>";
						}	
						
	$INHALT_TEXT .= "</table>
						</td>
					</tr>
					<tr>
						<td class='fcaption'>".LAN_LEAGUE_GAME_ADMIN_2." <b>".$team_Name."</b> <a href='".e_PLUGIN."sport_league_e107/admins/admin_game_tore.php?ID=".$game_id."&Team_ID=".$team_id."' title='".LAN_LEAGUE_GAME_ADMIN_2." <b>".$team_Name."</b> ".LAN_LEAGUE_GAME_ADMIN_244."'>".ADMIN_EDIT_ICON."</a></td>
					</tr>
					<tr>
						<td>";					
////////-----------------------Spieler Daten --------------------------------
$count2=0;
   $qry2="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_roster AS ae ON ae.roster_id=a.points_player_id
   LEFT JOIN ".MPREFIX."league_players AS ab ON ab.players_id=ae.roster_player_id
   WHERE a.points_team_id='".$team_id."' AND a.points_game_id='".$game_id."' ORDER BY a.points_time
   		";
		$sqldat->db_Select_gen($qry2);	
	 	while($row = $sqldat-> db_Fetch())
	 			{
				$ausgabe[$count2]['points_id']=$row['points_id'];
				$ausgabe[$count2]['points_value']=$row['points_value'];
				$ausgabe[$count2]['points_game_id']=$row['points_game_id'];
				$ausgabe[$count2]['points_player_id']=$row['points_player_id'];
				$ausgabe[$count2]['points_team_id']=$row['points_team_id'];
				$ausgabe[$count2]['points_time']=$row['points_time'];
				$ausgabe[$count2]['roster_id']=$row['points_player_id'];
				$ausgabe[$count2]['roster_player_id']=$row['roster_player_id'];
				$ausgabe[$count2]['roster_jersy']=$row['roster_jersy'];
				$ausgabe[$count2]['roster_position']=$row['roster_position'];
				$ausgabe[$count2]['players_name']="(".$ausgabe[$count2]['roster_jersy'].")-".$row['players_name']."";
				if($row['players_name']=="")
					{$ausgabe[$count2]['players_name']="<div style='color:#f00'>Roster_id:".$ausgabe[$count2]['roster_id']."</div>";}
				$count2++;
				}

//Tor Daten
$torcount=0;		
for($i=0; $i < $count2; $i++)
		{
		if($ausgabe[$i]['points_value']=='1')
			{
			$tor[$torcount]['time']=$ausgabe[$i]['points_time'];
			$tor[$torcount]['tor_scuetzer']=$ausgabe[$i]['players_name'];
			$tor[$torcount]['tor_scuetzer_id']=$ausgabe[$i]['points_id'];
			$tor[$torcount]['rost_id']=$ausgabe[$i]['roster_id'];
			$torcount++;
			}
		}
/// Assist daten		
for($j=0; $j < $torcount; $j++)
		{
		for($i=0;$i< $count2; $i++)	
		if($ausgabe[$i]['points_time']==$tor[$j]['time']&&$ausgabe[$i]['points_value']=='2')
			{
			if($tor[$j]['Assis1']!=""){
			$tor[$j]['Assis2']=$ausgabe[$i]['players_name'];
			$tor[$j]['Assis2_id']=$ausgabe[$i]['points_id'];
			$tor[$j]['rost2_id']=$ausgabe[$i]['roster_id'];
					}else{
					$tor[$j]['Assis1']=$ausgabe[$i]['players_name'];
					$tor[$j]['Assis1_id']=$ausgabe[$i]['points_id'];
					$tor[$j]['rost1_id']=$ausgabe[$i]['roster_id'];
					}
			}
		}
/// Foults Daten
$foul_count=0;
for($i=0; $i < $count2; $i++)
		{
		if($ausgabe[$i]['points_value']>2)
			{
			$fouls_text[$foul_count]['time']=$ausgabe[$i]['points_time'];
			$fouls_text[$foul_count]['foulplayer']=$ausgabe[$i]['players_name'];
			if($ausgabe[$i]['players_name']==""){$fouls_text[$foul_count]['foulplayer']="<div style='color:#f00'>Roster_id:".$ausgabe[$i]['roster_id']."</div>";}
			$fouls_text[$foul_count]['foults_value']=$ausgabe[$i]['points_value'];
			$fouls_text[$foul_count]['points_id']=$ausgabe[$i]['points_id'];
			$fouls_text[$foul_count]['play_id']=$ausgabe[$i]['roster_id'];
			$fouls_text[$foul_count]['points_id']=$ausgabe[$i]['points_id'];
			$foul_count++;
			}
		}	

	$INHALT_TEXT .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_4."</td>
		<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_6."</td>
		<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_7."</td>
		<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_8."</td>
		<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_9."</td>
	</tr>";
for($i=0; $i < $torcount; $i++)
		{
		$INHALT_TEXT.="<tr>
		<td class='forumheader3'>".$A=($i+1)."</td>
		<td class='forumheader3'>".$tor[$i]['time']."</td>
		<td class='forumheader3'><a href='admin_roster_config.php?edit.".$tor[$i]['rost_id'].".".$team_id."' title='Roster ID:".$tor[$i]['rost_id']." \nPoint ID: ".$tor[$i]['tor_scuetzer_id']."' style='text-decoration:none;'>".$tor[$i]['tor_scuetzer']."</a></td>
		<td class='forumheader3'><a href='admin_roster_config.php?edit.".$tor[$i]['rost1_id'].".".$team_id."' title='Roster ID:".$tor[$i]['rost1_id']." \nPoint ID: ".$tor[$i]['Assis1_id']."' style='text-decoration:none;'>".$tor[$i]['Assis1']."</a></td>
		<td class='forumheader3'><a href='admin_roster_config.php?edit.".$tor[$i]['rost2_id'].".".$team_id."' title='Roster ID:".$tor[$i]['rost2_id']." \nPoint ID: ".$tor[$i]['Assis2_id']."' style='text-decoration:none;'>".$tor[$i]['Assis2']."</a></td>
	</tr>";
	}
$INHALT_TEXT.="</table>
						</td>
					</tr>
					<tr>";					
///////////////// Strafen !!! ////////////////////////					
							
$INHALT_TEXT.="<td class='fcaption'>".LAN_LEAGUE_GAME_ADMIN_3." <b>".$team_Name."</b> <a href='".e_PLUGIN."sport_league_e107/admins/admin_game_foults.php?ID=".$game_id."&Team_ID=".$team_id."' title='".LAN_LEAGUE_GAME_ADMIN_3." <b>".$team_Name."</b> ".LAN_LEAGUE_GAME_ADMIN_244."'>".ADMIN_EDIT_ICON."</a></td>
					</tr>
					<tr>
						<td>
						<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
							<tr>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_6."</td>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_4."-".LAN_LEAGUE_GAME_ADMIN_5."</td>
								<td class='forumheader'>".LAN_LEAGUE_GAME_ADMIN_10."</td>
							</tr>";
							
for($i=0; $i < $foul_count; $i++)
		{
			$INHALT_TEXT.="<tr>
								<td class='forumheader3'>".$fouls_text[$i]['time']."</td>
								<td class='forumheader3'><a href='admin_roster_config.php?edit.".$fouls_text[$i]['play_id'].".".$team_id."' title='Roster ID:".$fouls_text[$i]['play_id']." \nPoint ID: ".$fouls_text[$i]['points_id']."' style='text-decoration:none;'>".$fouls_text[$i]['foulplayer']."</a></td>
								<td class='forumheader3'>".$foul_text[$fouls_text[$i]['foults_value']]."</td>
							</tr>";
			}

////===================================================================================================================
			$INHALT_TEXT.="</table>
						</td>
					</tr>
				</table>";
				return $INHALT_TEXT;
	}

?>
