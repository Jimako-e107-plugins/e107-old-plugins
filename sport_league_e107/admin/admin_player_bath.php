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
|		$Source: ../e107_plugins/lique/admin_player_bath.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 10:47 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_player_bath_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_player_bath_lan.php");
require_once("../functionen.php");

$POS_TEXT[0]=LAN_LEAGUE_PAYERS_ADMIN_21;
$POS_TEXT[1]=LAN_LEAGUE_PAYERS_ADMIN_11;
$POS_TEXT[2]=LAN_LEAGUE_PAYERS_ADMIN_12;
$POS_TEXT[3]=LAN_LEAGUE_PAYERS_ADMIN_13;
$POS_TEXT[9]=LAN_LEAGUE_PAYERS_ADMIN_19;
$POS_TEXT[10]=LAN_LEAGUE_PAYERS_ADMIN_20;

if (e_QUERY) {
	list($action, $id, $s, $ric, $p) = explode(".", e_QUERY);
	$id = intval($id);
	$s = intval($s);
	$ric = intval($ric);
	$p = intval($p);
	unset($tmp);
}
/// Sortierungsrichtung auslesen oder Standart wert zuweisen +++++++++++++++++++
if($_POST['richtung']!='')$richt=$_POST['richtung'];
elseif($ric){$richt=$ric;}
else {$richt="DESC";}
/// Nach was soll sortiert werden auslesen oder Standart wert zuweisen +++++++++++++++++++
if($_POST['sort_nach']!='')$sortierung=$_POST['sort_nach'];
elseif($s){$sortierung=$s;}
else {$sortierung="players_name";}
/// Anzahl pro Seite auslesen oder Standart wert zuweisen +++++++++++++++++++
if($_POST['proseite']!='')$pro_seite=$_POST['proseite'];
elseif($p){$pro_seite=$p;}
else {$pro_seite=10;}
////////===========================================
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_PAYERS_ADMIN_10;
    $pageid = "admin_player";  // unique name that matches the one used in admin_menu.php.

//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
///////////////----------------------------------------------
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
if($action == "neu")
	{
	$expand_autohide = "display:none; ";
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='".e_SELF."?list' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
						
$text .= teams_list();				
$text .= "<textarea name='importtext' cols='80' rows='35'></textarea>";

$text .= "</table>
						</div>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";		
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='".e_SELF."?list' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_ADMIN_8."' /></form></td></tr></table></div>";
		$configtitle="<b>".LAN_LEAGUE_PAYERS_ADMIN_7."</b>";

	}
////////////////////// Neu Erstellen ////////////////
	if(isset($_POST['submitit']))
		{
		list($team_id, $liga_id) = explode("-", $_POST['teams_id']);
			$team_id = intval($team_id);
			$liga_id = intval($liga_id);
			
		$imput=	$_POST['importtext'];
		$players = explode("\n", $imput);
		$counter=count($players);

$text="Team ID=".$team_id."  Liga ID=".$liga_id." Übergabe= ".$_POST['teams_id']."";		

$text.="<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	
	for($i=0; $i < $counter ; $i++)
		{
		$text .= "<tr><td  class='forumheader' style='text-align:center'>".($i+1)."</td>";	
		$player = explode(";", $players[$i]);	
			
		$text .="<td  class='forumheader' style='text-align:center'>".$player[0]."</td>";	

		$player_id=check_player($player[0]);
		if($player_id)
			{
			$text .="<td  class='forumheader' style='text-align:center;color:#f00;'>".$player_id."</td>";			
			$roster_id=check_roster($player_id,$team_id);
				if($roster_id)
								{
								$text .="<td  class='forumheader' style='text-align:center;color:#f00;'>".$roster_id."</td>";
								$roster_arhiv_id=check_roster_points($roster_id);
								if($roster_arhiv_id)
									{
									$text .="<td  class='forumheader' style='text-align:center;color:#f00;'>";
									$text .=roster_get_arhiv_data($roster_arhiv_id);
									$text .="</td>";	
									}
								else{
										$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>";
										$text .=roster_new_arhiv_data($roster_id,$liga_id,$team_id,$player[5],$player[6],$player[7],$player[8]);
										$text .="</td>";
										}
								}
				else{
						$roster_id=new_roster_create($player[0],$liga_id,$player_id,$team_id,$player[2],$player[3],$player[4]);
						$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$roster_id."</td>";
						$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>";
						$text .=roster_new_arhiv_data($roster_id,$liga_id,$team_id,$player[5],$player[6],$player[7],$player[8]);
						$text .="</td>";
						}
			}
		else{
				$player_id=new_player_create($player[0],$player[1]);
				$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$player_id."</td>";
				$roster_id=new_roster_create($player[0],$liga_id,$player_id,$team_id,$player[2],$player[3],$player[4]);
				$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$roster_id."</td>";
				$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>";
				$text .=roster_new_arhiv_data($roster_id,$liga_id,$team_id,$player[5],$player[6],$player[7],$player[8]);
				$text .="</td>";
				}
		$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$player[1]."</td>";
		$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$player[2]."</td>";
		$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$POS_TEXT[$player[3]]."</td>";
		$text .="<td  class='forumheader' style='text-align:center;color:#00a651;'>".$player[4]."</td>";
		$text .="</tr>";
		}
$text .="</table>";
	}
//////////////// direkt zu den Roster zufügen!!!
if($action == "list")
{
}
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");

///////-----------------------------------------------
function name($ID)
{
global $pref,$key,$sql2,$user_pref;$_POST;	
$sql2->db_Select("user", "user_name", "user_id='".$ID."'");
	while($row = $sql2-> db_Fetch()){
		$name=$row['user_name'];
		}
return $name;
}
/////////-------------------------------------------------
function teams_list()
{
global $sql;
$AUSGABE="<select name='teams_id' size='1'>";
$qry1="
   SELECT b.*, be.*, bm.*, bl.* FROM ".MPREFIX."league_leagueteams AS b 
   LEFT JOIN ".MPREFIX."league_teams AS be ON be.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS bm ON bm.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS bl ON bl.saison_id=bm.league_saison_id
   WHERE b.leagueteam_id !='' ORDER BY be.team_name, bm.league_id, bl.saison_id
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
				$teamdata[$teamscount1]['leagueteam_id']=$row['leagueteam_id'];
  			$teamdata[$teamscount1]['saison_id']=$row['saison_id'];
  			$teamdata[$teamscount1]['league_id']=$row['league_id'];
  			$teamdata[$teamscount1]['saison_name']=$row['saison_name'];
  			$teamdata[$teamscount1]['liga_name']=$row['league_name'];
  			$teamdata[$teamscount1]['team_name']=$row['team_name'];
  			$teamscount1++;
			}
for($i=0; $i < $teamscount1; $i++)
	{
	$AUSGABE.="<option value='".$teamdata[$i]['leagueteam_id']."-".$teamdata[$i]['league_id']."'>[".$teamdata[$i]['leagueteam_id'].",".$teamdata[$i]['league_id']."]".$teamdata[$i]['team_name']." -> ".$teamdata[$i]['liga_name']."(".$teamdata[$i]['saison_name'].")</option>";	
	}
$AUSGABE.="</select>";
return $AUSGABE;
}
/////////-------------------------------------------------
function check_player($payer_name)
{global $sql2;
$sql2->db_Select("league_players", "players_id", "players_name='".$payer_name."'");
	while($row = $sql2-> db_Fetch()){
		$payer_id=$row['players_id'];
		}
if($payer_id==0 || !$payer_id || $payer_id==""){return false;}
else{return $payer_id;}
}
/////////-------------------------------------------------

function new_player_create($name,$burt)
{
global $sql2,$tp;

list($day,$mon,$year) = explode(".", burt);
$datum = mktime (0,0,0,$mon,$day,$year);

$inputstr = " '".$tp->toDB($name)."', '', '', '1', '', '".$datum."', ''";
$sql2 -> db_Insert("league_players", "0, ".$inputstr." ");

$sql2->db_Select("league_players", "players_id", "players_name='".$name."'");
$row = $sql2-> db_Fetch();
return $row['players_id'];
}
/////////-------------------------------------------------
function new_roster_create($name,$liga_id,$player_id,$teams_id,$jersey,$position,$im_feld)
{
global $sql2,$tp;

$inputstr = " '".$tp->toDB($name)."', '".$liga_id."', '".$player_id."', '".$teams_id."', '1', '".$jersey."', '".$im_feld."', '".$position."', '', '', '', '', ''";
$sql2 -> db_Insert("league_roster", "0, ".$inputstr." ");

$sql2->db_Select("league_roster", "roster_id", "roster_player_id='".$player_id."' AND roster_team_id='".$teams_id."'");
$row = $sql2-> db_Fetch();
return $row['roster_id'];
}
/////////------------------------------------------------
function check_roster($player_id,$team_id)
{global $sql2;
$sql2->db_Select("league_roster", "roster_id", "roster_player_id='".$player_id."' AND roster_team_id='".$team_id."'");
$row = $sql2-> db_Fetch();
$roster_id=$row['roster_id'];

if($roster_id==0 || !$roster_id || $roster_id==""){return false;}
else{return $roster_id;}
}
/////////------------------------------------------------
function check_roster_points($roster_id)
{
global $sql2;
$sql2->db_Select("league_player_points", "player_points_id", "player_points_roster_id='".$roster_id."'");
$row = $sql2-> db_Fetch();
$roster_point_id=$row['player_points_id'];

if($roster_id==0 || !$roster_id || $roster_id==""){return false;}
else{return $roster_point_id;}	
}
/////////------------------------------------------------
function roster_get_arhiv_data($roster_arhiv_id)
{
global $sql2;
$sql2->db_Select("league_player_points", "*", "player_points_id='".$roster_arhiv_id."'");
$row = $sql2-> db_Fetch();
$roster_points=$row['player_points_1']." | ".$row['player_points_2']." | "." | ".$row['player_points_3']." | "." | ".$row['player_points_4']." ";
return $roster_points;
}
/////////------------------------------------------------
function roster_new_arhiv_data($roster_id,$liga_id,$team_id,$games,$goals,$assist,$min)
{
global $sql2,$tp;
$inputstr = " '".$liga_id."', '".$team_id."', '".$roster_id."', '".$games."', '".$goals."', '".$assist."', '".$min."', '', '', '', '', ''";
$sql2 -> db_Insert("league_player_points", "0, ".$inputstr." ");

$sql2->db_Select("league_player_points", "*", "player_points_roster_id='".$roster_id."'");
$row = $sql2-> db_Fetch();
$roster_points=$row['player_points_1']." | ".$row['player_points_2']." | ".$row['player_points_3']." | ".$row['player_points_4']." ";
return $roster_points;
}
?>
