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

// ============= START OF THE BODY ====================================
if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_roster_lan.php");
}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/league_roster_lan.php");
}
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
			$player[2]=$row['roster_saison_id'];
			$player[3]=$row['roster_player_id'];
			$player[4]=$row['roster_team_id'];
			$player[1]=$row['roster_status'];			
			$player[5]=$row['roster_jersy'];
			$player[6]=$row['roster_imfeld'];
			$player[7]=$row['roster_position'];
			$player[8]=$row['roster_imfeld'];
			$player[9]=$row['roster_description'];

	//		$player[13]=$row['roster_2min'];
	//		$player[14]=$row['roster_5min'];
	//		$player[15]=$row['roster_10min'];
			
			$player[16]=$row['players_id'];
			$player[17]=$row['players_name'];
			$player[18]=$row['players_user_id'];
			$player[19]=$row['players_admin_id'];
			$player[20]=$row['players_url'];
			$player[21]=$row['players_mail'];
			$player[22]=$row['players_location'];
			$player[23]=$row['players_image'];
			$player[24]=$row['players_burthday'];
			$player[25]=$row['players_site'];
			$player[26]=$row['players_wigth'];
			$player[27]=$row['players_height'];
			$player[28]=$row['players_visier'];
			$player[29]=$row['players_description'];    		
     	}  

$player[10]=0;// Spiele gespielt
$sql -> db_Select("lique_anw", "*","anw_player_id='".$player[0]."'");
while($row = $sql-> db_Fetch())
   {
   	$player[10]++;
		}
$player[11]=0;// Tore geschoßen
$sql -> db_Select("lique_points", "*","points_player_id='".$player[0]."' AND points_value= 1");
while($row = $sql-> db_Fetch())
   {
   	$player[11]++;
		}
$player[12]=0;// Assis gemacht
$sql -> db_Select("lique_points", "*","points_player_id='".$player[0]."' AND points_value= 2");
while($row = $sql-> db_Fetch())
   {
   	$player[12]++;
		}
		
if($player[7]==1)
	{
	$player[31]=0;// Gegentore Torman
	$sql -> db_Select("lique_anw", "*","anw_player_id='".$player[0]."'");
	while($row = $sql-> db_Fetch())
   	{
   	$player[31]++;
		}
	}		
				
	
$userN=$player[18];
$adminN=$player[19];
$teamid=$player[4];

if(!$player[24]){$player[24]=LAN_LEAGUE_ROSTER_23;}//Keine Eingaben
	else{
		$player[24]=strftime("%d %B %Y", $player[24]);
		}
if($player[7]=='1'){$pos="".LAN_LEAGUE_ROSTER_10."";}///Torhüter
if($player[7]=='2'){$pos="".LAN_LEAGUE_ROSTER_11."";}///Verteidiger
if($player[7]=='3'){$pos="".LAN_LEAGUE_ROSTER_13."";}///Stürmer
if($player[7]=='4'){$pos="".LAN_LEAGUE_ROSTER_14."";}///Trainer
if($player[7]=='5'){$pos="".LAN_LEAGUE_ROSTER_15."";}///Betreuer
if(!$player[7]){$pos="".LAN_LEAGUE_ROSTER_23."";}///Keine Eingaben
if($player[25]=='1'){$site="".LAN_LEAGUE_ROSTER_156."";}///Links
if($player[25]=='2'){$site="".LAN_LEAGUE_ROSTER_157."";}///Rechts
if(!$player[25]){$site="".LAN_LEAGUE_ROSTER_23."";}//Keine Eingaben
if($player[28]=='1'){$visier="".LAN_LEAGUE_ROSTER_159."";}//Gitter
if($player[28]=='2'){$visier="".LAN_LEAGUE_ROSTER_160."";}//Halbvisier
if($player[28]=='3'){$visier="".LAN_LEAGUE_ROSTER_161."";}//Ohne
if(!$player[28]){$visier="".LAN_LEAGUE_ROSTER_23."";}//Keine Eingaben
if(!$player[29]){$player[29]=LAN_LEAGUE_ROSTER_23;}else{$player[29]= $tp->toHTML($player[29],TRUE);}

if($_GET['Template']){
				$text ="<link rel='stylesheet' type='text/css' media='screen' href='".e_THEME."".$_GET['Template']."/style.css'>";
				}
else{$text ="<link rel='stylesheet' type='text/css' media='screen' href='".THEME."style.css'>";}
$text .= "<link rel='stylesheet' type='text/css' 
	media='screen' href='".THEME."style.css'> <div style='width:100%; text-align: center;'>";
$text .= "<div style='width:100%; text-align: center; vertical-align: top;'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .="
			<tr>
			<td class='forumheader3'style='width: 40%; text-align: center' ><a href=roster.php?team=".$player[4]."><img border='0', src='../fotos/".$player[23]."'/></a></td>
			<td class='forumheader3'style='vertical-align:top;  width: 80%'>
			<table style='width:100%', height='100%', class='fborder', cellspacing='0', cellpadding='0'>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_05.":</td>
			<td class='forumheader2' style='width: 70%'>".$player[17]."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_35.":</td>
			<td class='forumheader2' style='width: 70%'>".$player[5]."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_31.":</td>
			<td class='forumheader2' style='width: 70%'>".$pos."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_32.":</td>
			<td class='forumheader2' style='width: 70%'>";if($player[24]==""){$text .="".LAN_LEAGUE_ROSTER_23."";}else{$text .="".$player[24]."";} $text .="</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_33.":</td>
			<td class='forumheader2' style='width: 70%'>".$player[17]."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_34.":</td>
			<td class='forumheader2' style='width: 70%'>";if($player[22]==0){$text .="".LAN_LEAGUE_ROSTER_23."";}else{$text .=strftime("%a %d %b %Y",$player[22]);} $text .="</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_35.":</td>
			<td class='forumheader2' style='width: 70%'>".$player[5]."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width: 30%'>".LAN_LEAGUE_ROSTER_38.":</td>
			<td class='forumheader2' style='width: 70%'>";if($player[21]==""){$text .="".LAN_LEAGUE_ROSTER_23."";}else{$text .="".$player[21]."";} $text .="</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td colspan='2'>
			<table style='width:100%', cellspacing='0', cellpadding='0'>
			<tr>
			<td class='forumheader3', style='width:50%; vertical-align:top; text-align: center;'>
			<table style='width:100%', height='100%', class='fborder', cellspacing='0', cellpadding='0'>
			<tr>
			<td class='fcaption' style='width: 50%'>".LAN_LEAGUE_ROSTER_36."</td>
			</tr>
			<tr>
			<td class='forumheader3' style='width: 50%'>".$player[29]."</td>
			</tr>
			</table>
			</td>
			<td class='forumheader3', style='width:50%; vertical-align:top; text-align: center;'>
			<table style='width:100%' height='100%', class='fborder', cellspacing='0', cellpadding='0'>
			<tr>";
			$text .= "
			<td class='fcaption' style='text-align: center'>".LAN_LEAGUE_ROSTER_27."</td>
			<td class='fcaption' style='text-align: center''>".LAN_LEAGUE_ROSTER_28."</td>
			<td class='fcaption' style='text-align: center'>".LAN_LEAGUE_ROSTER_29."</td>
			<td class='fcaption' style='text-align: center'>".LAN_LEAGUE_ROSTER_30."</td>
			</tr>
			<tr>
			<td class='forumheader3' style='text-align: center'>".$player[10]."</td>
			<td class='forumheader3' style='text-align: center'>".$player[11]."</td>
			<td class='forumheader3' style='text-align: center'>".$player[12]."</td>
			<td class='forumheader3' style='text-align: center'>".$A=$player[11]+$player[12]."</td>";
			$text .= "
			</tr>
			</table><br/><a href=playerstats.php?player_id=".$player[16]."&&roster_id=".$player[0].">".LAN_LEAGUE_ROSTER_37."</a>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>";			
$text .="<div style='text-align:right'>";
$title ="# ";
$title .=$player[5];
$title .=" ";
$title .=$player[17];
if(ADMIN){
	$text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_roster_config.php?edit.".$player[0].".".$player[4]."' title='".LAN_LEAGUE_ROSTER_17."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}
$text .="</div>";            
$text .= "<br/>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_LEAGUE_ROSTER_16."</b></div><br/>";
$text .=powered_by();
$text .="</div>";
echo $ns -> tablerender($title, $text); 
////////////////////////  Functionen ////////////////////////////////////////////////////////////////////////////

?>