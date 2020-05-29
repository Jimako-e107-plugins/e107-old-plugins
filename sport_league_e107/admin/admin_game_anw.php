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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_game_anw.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_game_anw_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_game_anw_lan.php");
require_once("../functionen.php");
$expand_autohide = "display:none; "; 

if (e_QUERY) {
	list($GAM,$TEAM, $T) = explode(".", e_QUERY);
	$GAM = intval($GAM);
	$T= intval($T);
	unset($tmp);
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $tablename = "league_anw";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "anw_id";   // first column of your table.
    $pageid = "";  // unique name that matches the one used in admin_menu.php.
		$show_preset = TRUE; // allow e107 presets to be saved for use in the form.

    $fieldcapt[] = "".LAN_LEAGUE_GAME_ANW_ADMIN_200."";
    $fieldname[] = "anw_saison_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "lique_saison~saison_id~saison_name"; // [table name,value-field,display-field]

    $fieldcapt[] = "".LAN_LEAGUE_GAME_ANW_ADMIN_200."";
    $fieldname[] = "anw_game_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "lique_games~games_id~games_kuerzel"; // [table name,value-field,display-field]

    $fieldcapt[] = "".LAN_LEAGUE_GAME_ANW_ADMIN_200."";
    $fieldname[] = "anw_player_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "lique_roster~roster_id~roster_name"; // [table name,value-field,display-field]

    $fieldcapt[] = "".LAN_LEAGUE_GAME_ANW_ADMIN_200."";
    $fieldname[] = "anw_team_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "lique_liga~liga_id~liga_name"; // [table name,value-field,display-field]
 //---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
////---------------------------

if(!$GAM)
	{
	$GAME_ID=$GAM;
	}
else
	{$GAME_ID=$GAM;}
if(!$TEAM)
	{
	$TEAM_TD=$TEAM;
	}
else
	{$TEAM_TD=$TEAM;}
	
if(isset($_POST['submitit']))
	{
	$count = count($fieldname);
	$zahler=$_POST['zaeler'];
	$Del="";$inse="";
	for($i=0; $i < $zahler; $i++)
		{
		$sql -> db_Select("league_anw", "anw_id", "anw_game_id='".$_POST['Game_ID_'.$i.'']."'AND anw_player_id='".$_POST['Roster_ID_'.$i.'']."'");
		if(!($row = $sql-> db_Fetch())&& ($_POST['anwes_'.$i.'']=="on"))
			{
			$inputstr ="'', '".$_POST['Saison_ID_'.$i.'']."', '".$_POST['Game_ID_'.$i.'']."', '".$_POST['Roster_ID_'.$i.'']."', '".$_POST['Team_ID']."'";
			$inse .=($sql -> db_Insert("league_anw", "".$inputstr."")) ? "datensatz zugefügt: ".$inputstr."<br/>" : "fehler:".$inputstr."<br/>";
			}
		if(!$_POST['anwes_'.$i.'']=="on"){
			$inputstr ="anw_game_id='".$_POST['Game_ID_'.$i.'']."'AND anw_player_id='".$_POST['Roster_ID_'.$i.'']."'";			
			$Del .=($sql -> db_Delete("league_anw", "".$inputstr."")) ? "datensatz gelöscht: ".$inputstr."<br/>" : "fehler:".$inputstr."<br/>";
			}
		}
	}
if(IsSet($_POST['edit']))
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$_POST['existing']."' ");
	$row = $sql-> db_Fetch();
	}
if(IsSet($_POST['delete']))
	{
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$_POST['ID']."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
if(IsSet($message))
	{
	$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
	}
// =================================================================
$text = "<div style='text-align:center'>";
$text .= "<form method='post' action='".e_SELF."?".$GAME_ID.".".$TEAM_TD.".".$T."' id='adminform'>";

$status[0]=LAN_LEAGUE_GAME_ANW_ADMIN_23;
$status[1]="<div style='color:#0a6;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_20."</div>"; //
$status[2]="<div style='color:#cc0;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_21."</div>"; // 
$status[3]="<div style='color:#cc0;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_22."</div>"; // 
$status[4]="<div style='color:#a00;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_26."</div>"; // 
$status[5]="<div style='color:#a00;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_27."</div>"; // 
$status[6]="<div style='color:#0a6;font-weight: bold;text-align: center'>".LAN_LEAGUE_GAME_ANW_ADMIN_28."</div>"; // 

$position[0]=LAN_LEAGUE_GAME_ANW_ADMIN_23;
$position[1]=LAN_LEAGUE_GAME_ANW_ADMIN_11;
$position[2]=LAN_LEAGUE_GAME_ANW_ADMIN_12;
$position[3]=LAN_LEAGUE_GAME_ANW_ADMIN_13;
$position[4]=LAN_LEAGUE_GAME_ANW_ADMIN_14;
$position[5]=LAN_LEAGUE_GAME_ANW_ADMIN_15;
$position[6]=LAN_LEAGUE_GAME_ANW_ADMIN_17;

$im_feld[0]="".LAN_LEAGUE_GAME_ANW_ADMIN_18."";
$im_feld[1]="".LAN_LEAGUE_GAME_ANW_ADMIN_19."";

$count=0;
 $qry1="
   SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_teams AS ac ON ac.team_id=ab.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS ad ON ad.league_id=ab.leagueteam_league_id
   WHERE a.roster_team_id='".$TEAM_TD."' ORDER BY a.roster_position, a.roster_jersy ASC
   		";
		$sql->db_Select_gen($qry1);
	 	while($row = $sql-> db_Fetch())
	 			{
				$wert[$count]['id']=$row['roster_id'];
				$wert[$count]['saison_ID']=$row['roster_league_id'];
				$wert[$count]['players_name']=$row['roster_name'];
				$wert[$count]['roster_player_id']=$row['roster_player_id'];
				$wert[$count]['roster_team_id']=$row['roster_team_id'];
				$wert[$count]['roster_status']=$row['roster_status'];
				$wert[$count]['roster_jersy']=$row['roster_jersy'];
				$wert[$count]['roster_imfeld']=$im_feld[$row['roster_imfeld']];
				$wert[$count]['roster_position']=$position[$row['roster_position']];
				$wert[$count]['team_name']=$row['team_name'];
				$wert[$count]['team_icon']=$row['team_icon'];
				$wert[$count]['liga_team_id']=$row['leagueteam_team_id'];
				$wert[$count]['saison_ID']=$row['league_saison_id'];
				$count++;
				}
for($i=0; $i < $count; $i++){$a=false;
		     $sql -> db_Select("league_anw", "*", "anw_player_id='".$wert[$i]['id']."'AND anw_game_id='".$GAME_ID."'");
        	while($row = $sql-> db_Fetch()){
					$a=true;
					}
				$wert[$i]['anw']=$a;
				}
$text .= "<div style='width:100%'><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="
	 				<tr>
	 					<td class='forumheader', colspan='7', width='100%'>
	 						<div style='cursor:pointer' onclick=\"expandit('exp_infos')\">".LAN_LEAGUE_GAME_ANW_ADMIN_24."</div>
							<div id='exp_infos' style='".$expand_autohide."'>".LAN_LEAGUE_GAME_ANW_ADMIN_25."</div>
						</td>
	 				</tr>	
	 				<tr>
	 					<td class='forumheader', width='25px'>".LAN_LEAGUE_GAME_ANW_ADMIN_1."</td>
	 					<td class='forumheader', width='25px'>".LAN_LEAGUE_GAME_ANW_ADMIN_2."</td>
	 					<td class='forumheader'>".LAN_LEAGUE_GAME_ANW_ADMIN_3."</td>
	 					<td class='forumheader'>".LAN_LEAGUE_GAME_ANW_ADMIN_4."</td>
	 					<td class='forumheader'>".LAN_LEAGUE_GAME_ANW_ADMIN_5."</td>
	 					<td class='forumheader'>".LAN_LEAGUE_GAME_ANW_ADMIN_17."</td>
	 					<td class='forumheader'>".LAN_LEAGUE_GAME_ANW_ADMIN_6."</td>
	 				</tr>";
for($i=0; $i < $count; $i++){
			$index=$i+1;
			$text .="<tr>";
			$text .="<td class='forumheader3' width='20px'>".$index."</td>";
			$text .="<td class='forumheader3' width='20px'>".$wert[$i]['id']."</td>";
			$text .="<td class='forumheader3' >#".$wert[$i]['roster_jersy']."</td>";
			$text .="<td class='forumheader3' >".$wert[$i]['roster_position']."</td>";
			$text .="<td class='forumheader3' ><a href='admin_roster_config.php?edit.".$wert[$i]['id'].".".$TEAM_TD."' title='Roster ID:".$wert[$i]['id']."' style='text-decoration:none;'>".$wert[$i]['players_name']."</a></td>";
			$text .="<td class='forumheader3' >".$status[$wert[$i]['roster_status']]."</td>";
			$text .="<td class='forumheader3' ><input type='hidden' name='Game_ID_".$i."' value='".$GAME_ID."'><input type='hidden' name='Team_ID_".$i."' value='".$TEAM_TD."'><input type='hidden' name='Saison_ID_".$i."' value='".$wert[$i]['saison_ID']."'><input type='hidden' name='Roster_ID_".$i."' value='".$wert[$i]['id']."'><input type='checkbox' name='anwes_".$i."' id='".$i."' ";
			if($wert[$i]['anw']){$text .="checked";}
			$text .="><br></td>";
			}
      $text .= "<tr></td></tr></table><br/><br/>
      <input type='hidden' name='Team_ID' value='".$TEAM_TD."'><input type='hidden' name='ID' value='".$GAME_ID."'><input type='hidden' name='zaeler' value='".$count."'><input class='button' type='submit' id='submitit' name='submitit' value='".LAN_LEAGUE_GAME_ANW_ADMIN_9."' />
      </form><form action='admin_game_config.php?list.".$GAME_ID.".".$T."' method='post' id='back'>
			<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAME_ANW_ADMIN_7."'/></form></div><br/><br/>";		
$text.=powered_by();
$text.="</div>";		
$configtitle = "".LAN_LEAGUE_GAME_ANW_ADMIN_8." <a href=''><b>".$wert[0]['team_name']."</b></a> ".LAN_LEAGUE_GAME_ANW_ADMIN_10."";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>