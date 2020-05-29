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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_game_foults.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_game_foults_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_game_foults_lan.php");

require_once("../functionen.php");

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_FOULT_ADMIN_11."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAME_FOULT_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$expand_autohide = "display:none; "; 

if (e_QUERY) {
	list($GAM,$TEAM,$T) = explode(".", e_QUERY);
	$GAM = intval($GAM);
	$TEAM = intval($TEAM);
	$T= intval($T);
	unset($tmp);
}
$text="";
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
$game=$GAM;
$team=$TEAM;


$count=0;
   $qry2="
   SELECT a.*, ae.* FROM ".MPREFIX."league_anw AS a 
   LEFT JOIN ".MPREFIX."league_roster AS ae ON ae.roster_id=a.anw_player_id
   WHERE a.anw_team_id='".$team."' AND a.anw_game_id='".$game."' ORDER BY anw_id
   		";
		$sql->db_Select_gen($qry2);	
	 	while($row = $sql-> db_Fetch())
	 			{
				$wert[$count]['anw_id']=$row['anw_id'];
				$wert[$count]['anw_saison_id']=$row['anw_saison_id'];
				$wert[$count]['anw_game_id']=$row['anw_game_id'];
				$wert[$count]['anw_player_id']=$row['anw_player_id'];
				$wert[$count]['anw_team_id']=$row['anw_team_id'];
				$wert[$count]['roster_imfeld']=$row['roster_imfeld'];
				$wert[$count]['roster_jersy']=$row['roster_jersy'];
				$wert[$count]['roster_player_id']=$row['roster_player_id'];
				$wert[$count]['roster_position']=$row['roster_position'];	
				$wert[$count]['players_name']=$row['roster_name'];
				$count++;
				}
$saison=$wert[0]['anw_saison_id'];

$player_list="<option value='0'></option>";
for($i=0; $i < $count; $i++)
		{
		$player_list.="<option value='".$wert[$i]['anw_player_id']."'>";
		$player_list.="(".$wert[$i]['roster_jersy'].")-".$wert[$i]['players_name']."</option>";
		}
$value_list_arry[3]="2 min";
$value_list_arry[4]="5 min";
$value_list_arry[5]="10 min";
$value_list_arry[6]="20 min";
$value_list_arry[7]="2 min";
$value_list_arry[8]="";

$value_list="<option value='0'></option>";
for($i=3; $i < 7; $i++)
		{
		$value_list.="<option value='".$i."'>";
		$value_list.="".$value_list_arry[$i]."</option>";
		}
////////////////////--------------------------------------------------------------------------------------------
if(IsSet($message)){
		$text="<div style=\"text-align:center\"><b>".$message."</b></div>";
}
if(IsSet($_POST['submitit'])){
	if($_POST['time']=="")
			{$message ="".LAN_LEAGUE_GAME_FOULT_ADMIN_18."";}
	else{
			if($_POST['tor']< 1)
					{$message ="".LAN_LEAGUE_GAME_FOULT_ADMIN_19."";}
			else{
					$times=time_conver($_POST['time'],$T,$_POST['periode']);
					$INPUTSTRING1="0, '".$_POST['foult_value']."', '".$_POST['Saison_ID']."', '".$_POST['Game_ID']."', '".$_POST['tor']."', '".$_POST['Team_ID']."',  '".$times."'";
					$sql -> db_Insert("league_points", $INPUTSTRING1);

					$message ="Datensatz zugefügt: ".$INPUTSTRING1." 1As:".$INPUTSTRING2." 2As:".$INPUTSTRING3."";
					}
			}
	}
if(IsSet($_POST['delete'])){
	$sql -> db_Delete("league_points", "points_game_id='".$_POST['Game_ID']."' AND points_time='".$_POST['time']."'");
	}
///*******************************************
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}	
///*******************************************	
$text.="<div style='width:100%; text-align:center;'><b>".LAN_LEAGUE_GAME_FOULT_ADMIN_13."</b><br/><br/><form action='".e_SELF."?".$game.".".$team.".".$T."' method='post' id='tor'>
<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='fcaption' colspan='5'>
			<div style='cursor:pointer' onclick=\"expandit('exp_infos')\">".LAN_LEAGUE_GAME_FOULT_ADMIN_15."</div>
			<div id='exp_infos' style='".$expand_autohide."'>".LAN_LEAGUE_GAME_FOULT_ADMIN_16."</div>
		</td>
	</tr>	
	<tr>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_4."
		</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_5."
		</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_6."
		</td>
		<td class='fcaption'>
		</td>
	</tr>
	<tr>
		<td class='forumheader'>";
if($T==2||$T==4)
{
$text.="<select class='tbox' style='width:40px'  name='periode'>";
                            for ($i=1; $i < ($pref["sport_league_periods"]+1); $i++) {             
                            $text .="<option value='$i' $checked >".$i."</option />\n";
                            };
                            $text .="</select>";
}
$text.=" / <input name='time' type='textarea' size='6' maxlength='5'>
		</td>
		<td class='forumheader'><select class='tbox' name='tor' size='1' width='15'>".$player_list."</select></td>
		<td class='forumheader'><select class='tbox' name='foult_value' size='1' width='15'>".$value_list."</select></td>
		<td class='forumheader' style='text-align:center;'><input class='button' type='submit' id='submitit' name='submitit' value='".LAN_LEAGUE_GAME_FOULT_ADMIN_10."'/>
		</td>
	</tr>
</table>
<input type='hidden' name='Saison_ID' value='".$saison."'>
<input type='hidden' name='Team_ID' value='".$team."'>
<input type='hidden' name='Game_ID' value='".$game."'></form>";

$count2=0;
$qry2="
   SELECT a.*, ae.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_roster AS ae ON ae.roster_id=a.points_player_id
   WHERE a.points_team_id='".$team."' AND a.points_game_id='".$game."' AND a.points_value > 2 ORDER BY a.points_time
   		";
		$sql->db_Select_gen($qry2);	
	 	while($row = $sql-> db_Fetch())
	 			{
				$ausgabe[$count2]['points_id']=$row['points_id'];
				$ausgabe[$count2]['points_value']=$row['points_value'];
				$ausgabe[$count2]['points_game_id']=$row['points_game_id'];
				$ausgabe[$count2]['points_player_id']=$row['points_player_id'];
				$ausgabe[$count2]['points_team_id']=$row['points_team_id'];
				$ausgabe[$count2]['points_time']=$row['points_time'];
				$ausgabe[$count2]['roster_jersy']=$row['roster_jersy'];
				$ausgabe[$count2]['roster_id']=$row['points_player_id'];
				$ausgabe[$count2]['players_name']=$row['roster_name'];
				if($ausgabe[$count2]['players_name']=="")
			 {$ausgabe[$count2]['players_name']="<div style='color:#f00'>Point_id:".$ausgabe[$count2]['points_id']."</div>";}
				
				$count2++;
				}		
$text.="<br/><br/><b>".LAN_LEAGUE_GAME_FOULT_ADMIN_14."</b><br/><br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_8."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_4."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_5."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_6."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_GAME_FOULT_ADMIN_9."</td>
	</tr>";
for($i=0; $i < $count2; $i++)
		{
		$text.="<tr>
		<td class='forumheader'>".$A=($i+1)."</td>
		<td class='forumheader' style='text-align:center;'>".$ausgabe[$i]['points_time']."</td>
		<td class='forumheader'><a href='admin_roster_config.php?edit.".$ausgabe[$i]['points_player_id'].".".$$team."' title='Roster ID:".$ausgabe[$i]['points_player_id']." \nPoint ID: ".$ausgabe[$i]['points_id']."' style='text-decoration:none;'>".$ausgabe[$i]['players_name']."</a></td>
		<td class='forumheader'>".$value_list_arry[$ausgabe[$i]['points_value']]."</td>
		<td class='fcaption' style='text-align:center;'> <form action='".e_SELF."?".$game.".".$team.".".$T."' method='post' id='edit'>
			<input type='hidden' name='Saison_ID' value='".$saison."'>
			<input type='hidden' name='Team_ID' value='".$team."'>
			<input type='hidden' name='Game_ID' value='".$game."'>
			<input type='hidden' name='time' value='".$ausgabe[$i]['points_time']."'>
			<a href='".e_SELF."?edit.".$game.".".$team."'>".$ImageEDIT['LINK']."</a> | 
			<input type='image' title='".LAN_DELETE."' name='delete[team_{$OLD_GAMES_DATAS[$i]['game_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_GAME_FOULT_ADMIN_17."')\"/>
			</form>
		</td>
	</tr>";
		}
$text.="</table><br/><br/>
<form action='admin_game_config.php?list.".$game.".".$T."' method='post' id='back'>
<input type='hidden' name='ID' value='".$game."'>
<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAME_FOULT_ADMIN_12."'/></form><br/><br/><br/>";

$sql -> db_Select("league_games", "*", "games_id='".$game."'");
         while($row = $sql-> db_Fetch()){
				$game_wert['games_id']=$row['anw_id'];
				$game_wert['games_date']=$row['games_date'];
					}				
$sql -> db_Select("league_liga", "*", "liga_id='".$team."'");
$row = $sql-> db_Fetch();
$game_wert['liga_team_id']=$row['liga_team_id'];

$sql -> db_Select("league_teams", "*", "team_id='".$game_wert['liga_team_id']."'");
$row = $sql-> db_Fetch();
$game_wert['team_name']=$row['team_name'];

$text.=powered_by();
$text.="</div>";
$configtitle = "".LAN_LEAGUE_GAME_FOULT_ADMIN_1." <b>".$game_wert['team_name']."</b> ".LAN_LEAGUE_GAME_FOULT_ADMIN_2." <b>".strftime("%a %d %b %Y",$game_wert['games_date'])."</b> ".LAN_LEAGUE_GAME_FOULT_ADMIN_3."</b>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>