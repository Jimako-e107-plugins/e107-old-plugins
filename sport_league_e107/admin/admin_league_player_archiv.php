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
|		$Source: ../e107_plugins/sport_LEAGUE_TEAMS_e107/admin/admin_league_player_archiv.php $
|		$Revision: 0,87 $
|		$Date: 29.09.2011 10:24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_league_player_archiv_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_league_player_archiv_lan.php");

require_once("../functionen.php");

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTERARHIV_ADMIN_14."' src='".$ImageDELETE['PFAD']."'>";

$favor=0;

if (e_QUERY) {
	list($action, $id, $liga, $team_id,$Games_in,$Goals_in,$Assist_in) = explode(".", e_QUERY);
	$id = intval($id);
	$favor = intval($liga);
	$team_id = intval($team_id);
	$Games_in = intval($Games_in);
	$Goals_in = intval($Goals_in);
	$Assist_in = intval($Assist_in);
	unset($tmp);
}
/////===========================================================================
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_ROSTERARHIV_ADMIN_15;

    $tablename = "league_player_points";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "player_points_id";   // first column of your table.
    $pageid = "admin_players_arhiv";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_01;
    $fieldname[] = "player_points_saison_id";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "league_leagues~league_id~league_name";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_02;
    $fieldname[] = "player_points_team_id";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "league_leagueteams~leagueteam_id~leagueteam_team_id";

///////////////////////////////////----------------    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_03;
    $fieldname[] = "player_points_roster_id";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "league_roster~roster_id~roster_name";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_04;
    $fieldname[] = "player_points_1";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "".$Games_in."~5";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_05;
    $fieldname[] = "player_points_2";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "".$Goals_in."~5";

    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_06;
    $fieldname[] = "player_points_3";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "".$Assist_in."~5";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_07;
    $fieldname[] = "player_points_4";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";

    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_08;
    $fieldname[] = "player_points_5";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";
 
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_09;
    $fieldname[] = "player_points_6";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_10;
    $fieldname[] = "player_points_7";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";
 
    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_11;
    $fieldname[] = "player_points_8";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";

    $fieldcapt[] = LAN_LEAGUE_ROSTERARHIV_ADMIN_12;
    $fieldname[] = "player_points_9";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "~5";
//--------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////----------------------------------------------
$edit_flag=0;
$table_total = $sql-> db_Select($tablename, "*","player_points_saison_id='".$liga."' AND player_points_team_id='".$team_id."' AND player_points_roster_id='".$id."'");
if($table_total)
{
$edit_flag=1;
}
/////////////////// Aktualisierung /////////////////////////
	if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) {
		$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
		$inputstr .= ($i < ($count -1)) ? "," : "";
		};
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
//////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);//T_ID
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "".$primaryid."='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;	
}
////////////////////// Neu Erstellen ////////////////
elseif(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i< $count; $i++) 
		  {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
				
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		}
////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit" || $edit_flag==1)
	{
	$sql-> db_Select($tablename, "*","player_points_saison_id='".$liga."' AND player_points_team_id='".$team_id."' AND player_points_roster_id='".$id."'");
	$row = $sql-> db_Fetch();
	$text = "<div style='text-align:center'>\n";
	$text .= "<form method='post' action='".e_SELF."?list' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		if($fieldname[$i]=="player_points_saison_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> ".LAN_LEAGUE_ROSTERARHIV_ADMIN_14." ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$liga."' readonly maxlength='20' /> ";
			$text .=	get_liga_name($liga);
			$text .="	</td></tr>";
								continue;
			}
		elseif($fieldname[$i]=="player_points_team_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> ".LAN_LEAGUE_ROSTERARHIV_ADMIN_02." ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$team_id."' readonly maxlength='20' /> ";
			$text .=	get_team_name($team_id);
			$text .="</td></tr>";
								continue;
			}
		elseif($fieldname[$i]=="player_points_roster_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> ".LAN_LEAGUE_ROSTERARHIV_ADMIN_03." ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$id."' readonly maxlength='20' /> ";
			$text .=	get_player_name($id);
			$text .="</td></tr>";
								continue;
			}	
		else{
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
			$text .="
				<tr>
				<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
				<td style=\"width:70%\" class=\"forumheader3\">";
	 		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			$text .="</td></tr>";
			}
		}
		$text .= "<tr>
					<td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
						<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
							<tr>
								<td style='width:50%;text-align:right;padding-right:10px;'><input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
									<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form>
								</td>
							<td style='width:50%;text-align:left;padding-right:10px;'><form method=\"post\" action=\"admin_roster_config.php?list.".$team_id."\" id=\"back\"><form method=\"post\" action=\"admin_roster_config.php?list.".$team_id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_ROSTERARHIV_ADMIN_13."' /></form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>";
	$configtitle=LAN_LEAGUE_ROSTERARHIV_ADMIN_15;	
	}
////////////////////////////////////////////////////////////////////
elseif($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?edit.".$id.".".$liga.".".$team_id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$count = count($fieldname);
	for ($i=0; $i< $count; $i++)
		{
		if($fieldname[$i]=="player_points_saison_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> Liga ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$liga."' readonly maxlength='20' />";
			$text .=	get_liga_name($liga);
			$text .="	</td></tr>";
								continue;
			}
		elseif($fieldname[$i]=="player_points_team_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> Team ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$team_id."' readonly maxlength='20' />";
			$text .=	get_team_name($team_id);
			$text .="</td></tr>";
								continue;
			}
		elseif($fieldname[$i]=="player_points_roster_id")
			{$text .="
							<tr>
								<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
								<td style=\"width:70%\" class=\"forumheader3\"> Spieler ID= 
								<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".$id."' readonly maxlength='20' />";
			$text .=	get_player_name($id);
			$text .="</td></tr>";
								continue;
			}
		else{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
			}
		};
		$text .= "<tr>
					<td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
						<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
							<tr>
								<td style='width:50%;text-align:right;padding-right:10px;'><input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
									</form>
								</td>
								<td style='width:50%;text-align:left;padding-left:10px;'><form method=\"post\" action=\"admin_roster_config.php?list.".$team_id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_ROSTERARHIV_ADMIN_13."'/></form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>";
		$configtitle=LAN_LEAGUE_ROSTERARHIV_ADMIN_16;
	}

///////////////////////////Tabelle mit vorhandenen Teams zeigen. Ersmal Überschrift...///////////////
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}


$text .="<div style=\"text-align:center\"><br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
$sql-> db_Select($tablename, "*","player_points_saison_id='".$liga."' AND player_points_team_id='".$team_id."' AND player_points_roster_id='".$id."'");
$count = count($fieldcapt);
$text.="<tr><td class='fcaption'>id</td>";
			for($i=0; $i < $count; $i++)
				{
				$text.="<td class='fcaption'>".$fieldcapt[$i]."</td>";
				}
	$text.="<td class='fcaption'>Opt</td></tr>";

while($row = $sql-> db_Fetch())
 		{
		$text.="<tr><td class='forumheader'>".$row[$primaryid]."</td>";
			for($i=0; $i < $count; $i++)
				{
				$text.="<td class='forumheader'>".$row[$fieldname[$i]]."</td>";
				}
		$text.="<td class='forumheader'>
		<form method='post' action='".e_SELF."?edit.".$id.".".$liga.".".$team_id."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row[$primaryid]."'>
																				<input type='image' title='".LAN_DELETE."' name='delete[point_".$row[$primaryid]."]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_ROSTERARHIV_ADMIN_17." [".$row[$primaryid]."] ')\"/>
																				</form>
		</td></tr>";
		}

$text.="</table><br/></div>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";$configtitle .="<b>";
$configtitle .=get_player_name($id);
$configtitle .="</b>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
/////////////////////////////// Funktionen +++++++++++++++++++++++++++++++
function get_liga_name($id)
{
global $sql;

$qry="
   	SELECT a.*, b.* FROM ".MPREFIX."league_leagues AS a
   	LEFT JOIN ".MPREFIX."league_saison AS b ON b.saison_id=a.league_saison_id
   	WHERE a.league_id ='".$id."'
		";
$sql->db_Select_gen($qry);
$row = $sql-> db_Fetch();
return $row['league_name']." ( ".$row['saison_name']." )";
}
////////////////
function get_team_name($id)
{
global $sql;
$qry="
   	SELECT a.*, b.* FROM ".MPREFIX."league_leagueteams AS a
   	LEFT JOIN ".MPREFIX."league_teams AS b ON b.team_id=a.leagueteam_team_id
   	WHERE a.leagueteam_id ='".$id."'
		";
$sql->db_Select_gen($qry);
$row = $sql-> db_Fetch();
return $row['team_name'];
}
////////////////
function get_player_name($id)
{
global $sql;
$qry="
   	SELECT a.*, b.* FROM ".MPREFIX."league_roster AS a
   	LEFT JOIN ".MPREFIX."league_players AS b ON b.players_id=a.roster_player_id
   	WHERE a.roster_id ='".$id."'
		";
$sql->db_Select_gen($qry);
$row = $sql-> db_Fetch();
return $row['players_name'];
}
?>
