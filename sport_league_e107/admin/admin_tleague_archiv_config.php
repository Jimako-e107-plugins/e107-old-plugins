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
|		$Source: ../e107_plugins/sport_LEAGUE_TEAMS_e107/admin/admin_tleague_archiv_config.php $
|		$Revision: 0.829.09.2011 16:17 $
|		$Date: 29.09.2011 16:17 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_tleague_archiv_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_tleague_archiv_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_TEAMS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$favor=0;

if (e_QUERY) {
	list($action, $id, $favor, $team_id) = explode(".", e_QUERY);
	$id = intval($id);
	$favor = intval($favor);
	$team_id = intval($team_id);
	unset($tmp);
}
//////// Vorhandene Saisons-ID     +++++++++++++++++++++++++++++++++
   $qry1="
   SELECT b.*, be.* FROM ".MPREFIX."league_leagues AS b
   LEFT JOIN ".MPREFIX."league_saison AS be ON be.saison_id=b.league_saison_id
   WHERE be.saison_name !='' ORDER BY be.saison_beginn, b.league_name
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
				$teamdata[$teamscount1]['league_id']=$row['league_id'];
  			$teamdata[$teamscount1]['league_name']=$row['league_name'];
  			$teamdata[$teamscount1]['saison_name']=$row['saison_name'];
  			$teamscount1++;
			}
//////////////////////  Dropdowm Liste erstellen
$listvalue="";
for($i=0;$i < $teamscount1;$i++)
		{
		$listvalue.="".$teamdata[$i]['league_id'].":".$teamdata[$i]['league_name']."-(".$teamdata[$i]['saison_name'].")</option>";
		if($i< $teamscount1-1)$listvalue.="~";
		}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_TEAMS_LEAGUE_ADMIN_1;

    $tablename = "league_ligas_arhiv";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "ligas_arhiv_id";   // first column of your table.
    $pageid = "admin_league_arhiv";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_22;
    $fieldname[] = "ligas_arhiv_saison_id";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "league_saison~saison_id~saison_name";
    
    
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_23;
    $fieldname[] = "ligas_arhiv_games";
    $fieldtype[] = "dropdown2";  // simple text box.
    $fieldvalu[] = $listvalue;

///////////////////////////////////----------------    
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_24;
    $fieldname[] = "ligas_arhiv_team_id";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "league_teams~team_id~team_name";
    
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_25;
    $fieldname[] = "ligas_arhiv_games";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_26;
    $fieldname[] = "ligas_arhiv_winn";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_28;
    $fieldname[] = "ligas_arhiv_un";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_29;
    $fieldname[] = "ligas_arhiv_un";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_30;
    $fieldname[] = "ligas_arhiv_points";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
 
    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_31;
    $fieldname[] = "ligas_arhiv_et";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_32;
    $fieldname[] = "ligas_arhiv_gt";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
 
 
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////----------------------------------------------
////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style='text-align:center'>\n";
	$text .= "<form method='post' action='".e_SELF."?list' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='Zurück' /></form></td></tr></table></div>";
	
	$configtitle="<b>".configtitle."</b>";	
	}

////////////////////////////////////////////////////////////////////
if($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i< 10; $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='Abbrechen' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_TEAMS_LEAGUE_ADMIN_20."</b>";
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
		$message .= $inputstr;
		}
//////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message =delete_liga_team($del_id);
}
////////////////////// Neu Erstellen ////////////////
	elseif(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		$inputstr = "'".$id."', ";
		for ($i=1; $i<$count; $i++) 
		  {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
				
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		$message.=$inputstr;
		}
///////////////////////////Tabelle mit vorhandenen Teams zeigen. Ersmal Überschrift...///////////////
if($action == "list")
{
//////////////////////////////////////////////////////////////	
	 $qry1="
   SELECT a.*, ae.*, ac.*, ab.* FROM ".MPREFIX."league_ligas_arhiv AS a 
   LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_id=a.ligas_arhiv_league_id
   LEFT JOIN ".MPREFIX."league_saison AS ac ON ac.saison_id=a.ligas_arhiv_saison_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=a.ligas_arhiv_team_id  
   WHERE a.ligas_arhiv_id !='' ORDER BY a.ligas_arhiv_saison_id, ligas_arhiv_points DESC, ligas_arhiv_winn DESC
   		";
	$sql->db_Select_gen($qry1);
	$TEAMSCOUNT=0;
	while($row = $sql-> db_Fetch())
		{
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_id']=$row['ligas_arhiv_id'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_saison_id']=$row['ligas_arhiv_saison_id'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_league_id']=$row['ligas_arhiv_league_id'];
		$TEAMSDATA[$TEAMSCOUNT]['league_name']=$row['league_name'];
		$TEAMSDATA[$TEAMSCOUNT]['team_name']=$row['team_name'];
		$TEAMSDATA[$TEAMSCOUNT]['saison_name']=$row['saison_name'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_team_id']=$row['ligas_arhiv_team_id'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_games']=$row['ligas_arhiv_games'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_winn']=$row['ligas_arhiv_winn'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_lost']=$row['ligas_arhiv_lost'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_un']=$row['ligas_arhiv_un'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_points']=$row['ligas_arhiv_points'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_et']=$row['ligas_arhiv_et'];
		$TEAMSDATA[$TEAMSCOUNT]['ligas_arhiv_gt']=$row['ligas_arhiv_gt'];	
		$TEAMSCOUNT++;
		}
//////////////////////+++++++++++++++++++++++++++++++++++++++++++
 $liste2="<select name='my_team' size='1' style='width:50%;font-weight: bold;' onChange='this.form.submit()'><option value='0'></option>";
	 for($i = 0; $i < $TEAMSCOUNT; $i++)
		{
		$liste2.="<option ";
		if($TEAMSDATA[$i]['leagueteam_my_team']=='1')
			{
			$liste2.="selected ";
			}
		$liste2.="value='".$TEAMSDATA[$i]['leagueteam_id']."'>";
		$liste2.="".$TEAMSDATA[$i]['team_name']."</option>";
		}
$liste2.="</select>";			
//////////////////////+++++++++++++++++++++++++++++++++++++++++++
 $text = "<div style=\"text-align:center\">
 						<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
 							<tr>
 								<td class='fcaption' style='width:100%;text-align:right'>
 								 	<form method='post' action='".e_SELF."' id='neu'>
 								 		<div style='font-size: 14px;color:#00b42a;font-weight: bold;text-align: center'>
 											<a href='".e_SELF."?neu.".$id."'>".$ImageNEW['LINK']."  ".LAN_TEAMS_LEAGUE_ADMIN_14."</a>
 										</div>
 									</form>
 								</td>";
 	 $text .= "	</tr>
 						</table>
 					<br/>
 					<br/>
 				<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_8."</td>
	 	<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_2."</td>
		<td class='fcaption' style='text-align:left;'>".LAN_TEAMS_LEAGUE_ADMIN_3."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_TEAMS_LEAGUE_ADMIN_5."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_6."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_7."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_9."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_10."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_11."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_12."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_12."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_15."</td>
	</tr>";
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
	 for($i = 0; $i < $TEAMSCOUNT; $i++){
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_id']."</td>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['saison_name']."</td>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['league_name']."</td>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['team_name']."</td>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_games']."</td>";
			
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_winn']."</td>";					
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_lost']."</td>";									
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_un']."</td>";												
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_points']."</td>";															
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_et']."</td>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['ligas_arhiv_gt']."</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$TEAMSDATA[$i]['ligas_arhiv_id']."'>
																				<a href='".e_SELF."?edit.".$TEAMSDATA[$i]['ligas_arhiv_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$TEAMSDATA[$i]['ligas_arhiv_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_TEAMS_LEAGUE_ADMIN_21."')\"/></form></td></tr>";
         }
 $text .= "<tr>
 						<td class='fcaption' style='text-align:center;' colspan='12'>
 							<form method='post' action='admin_league_config.php' id='back'>
 							<input class='button' type='submit' id='back' name='back' value='".LAN_TEAMS_LEAGUE_ADMIN_4."' /></form>
 						</td>
 					</tr></table>";
 }
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
/////////////////////////////// Funktionen +++++++++++++++++++++++++++++++
function favorit_aus($id)
	{
	 $sqlMY =& new db;
	 $sqlMY -> db_Select("league_leagueteams", "*", "leagueteam_id=".$id." LIMIT 1");
	 $row = $sqlMY-> db_Fetch();

	 $inputstr = "leagueteam_id='".$row['leagueteam_id']."', leagueteam_league_id='".$row['leagueteam_league_id']."', leagueteam_team_id='".$row['leagueteam_team_id']."', ";
	 $inputstr .= "leagueteam_my_team='0', leagueteam_pref2='".$row['leagueteam_pref2']."', leagueteam_pref3='".$row['leagueteam_pref3']."', leagueteam_pref4='".$row['leagueteam_pref4']."'";	
	 $A= ($sqlMY -> db_Update("league_leagueteams", "".$inputstr." WHERE leagueteam_id='".$id."' ")) ? 1 : 0 ;
	 return $A;
	}
/////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function favorit_an($id)
	{
	 $sqlMY2 =& new db;
	 $sqlMY2 -> db_Select("league_leagueteams", "*", "leagueteam_id=".$id." LIMIT 1");
	 $row = $sqlMY2-> db_Fetch();

	 $inputstr = "leagueteam_id='".$row['leagueteam_id']."', leagueteam_league_id='".$row['leagueteam_league_id']."', leagueteam_team_id='".$row['leagueteam_team_id']."', ";
	 $inputstr .= "leagueteam_my_team='1', leagueteam_pref2='".$row['leagueteam_pref2']."', leagueteam_pref3='".$row['leagueteam_pref3']."', leagueteam_pref4='".$row['leagueteam_pref4']."'";	
	 $A= ($sqlMY2 -> db_Update("league_leagueteams", "".$inputstr." WHERE leagueteam_id='".$id."' ")) ? 1 : 0 ;
	 return $A;
	}
?>
