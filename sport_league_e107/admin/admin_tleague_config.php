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
|		$Source: ../e107_plugins/sport_LEAGUE_TEAMS_e107/admin/admin_tleague_config.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_tleague_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_tleague_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageROSTER['PFAD']=e_PLUGIN."sport_league_e107/images/system/roster.png";
$ImageROSTER['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageROSTER['PFAD']."'>";

$ImageFAVORIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/favorit.png";
$ImageFAVORIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_22."' src='".$ImageFAVORIT['PFAD']."'>";

$ImageNOFAVORIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/nofavorit.png";
$ImageNOFAVORIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_21."' src='".$ImageNOFAVORIT['PFAD']."'>";

$favor=0;

if (e_QUERY) {
	list($action, $id, $favor, $team_id) = explode(".", e_QUERY);
	$id = intval($id);
	$favor = intval($favor);
	$team_id = intval($team_id);
	unset($tmp);
}
//////// Vorhandene Teams-ID     +++++++++++++++++++++++++++++++++
	$sql -> db_Select("league_leagueteams", "leagueteam_team_id", "leagueteam_league_id =".$id." ORDER BY leagueteam_team_id");
	$TEAMSCOUNT=0;
	while($row = $sql-> db_Fetch())
		{
		$TEAMSDATA[$TEAMSCOUNT]['leagueteam_team_id']=$row['leagueteam_team_id'];
		$TEAMSCOUNT++;
		}
///////// Team die bereits in der Liste sind werden ausgefiltert!!! ++++++++++++++++++
	$sql -> db_Select("league_teams", "team_id, team_name", "team_name!='' ORDER BY team_name");
	$TEAMSCOUNT2=0;
	while($row = $sql-> db_Fetch())
		{$Flag=0;
		for($i=0; $i< $TEAMSCOUNT ; $i++ )
			{
			if($TEAMSDATA[$i]['leagueteam_team_id']==$row['team_id'])
				{	
				$Flag=1;
				//break;
				}
			}
		if($Flag==0)
			{
			$LISTE1[$TEAMSCOUNT2]['team_id']=$row['team_id'];
			$LISTE1[$TEAMSCOUNT2]['team_name']=$row['team_name'];
			$TEAMSCOUNT2++;	
			}	
		}
//////////////////////  Dropdowm Liste erstellen
$listvalue="";
for($i=0;$i < $TEAMSCOUNT2;$i++)
		{
		$listvalue.="".$LISTE1[$i]['team_id'].":".$LISTE1[$i]['team_name']."";
		if($i< $TEAMSCOUNT2-1)$listvalue.="~";
		}

/////===========================================================================


// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_TEAMS_LEAGUE_ADMIN_1;
    $configtitle .="<b> - ";
		$configtitle .= saison_liga_name($id);
		$configtitle .="</b>";
    $tablename = "league_leagueteams";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "leagueteam_id";   // first column of your table.
    $pageid = "admin_leagueteams";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_2;
    $fieldname[] = "leagueteam_league_id";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_3;
    $fieldname[] = "leagueteam_team_id";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = $listvalue; // [table name,value-field,display-field]

///////////////////////////////////----------------    
    $fieldcapt[] = "";
    $fieldname[] = "leagueteam_my_team";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = "Kader erfasst";
    $fieldname[] = "leagueteam_pref2";
    $fieldtype[] = "checkbox";  // simple text box.
    $fieldvalu[] = "1"; 
    
    $fieldcapt[] = "";
    $fieldname[] = "leagueteam_pref3";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = "";
    $fieldname[] = "leagueteam_pref4";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
// -------- Presets. ------------  // always load before auth.php
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
if($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=1; $i< 2; $i++)
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
		</form><form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_TEAMS_LEAGUE_ADMIN_25."' /></form></td></tr></table></div>";
	
		$configtitle.=" ".LAN_TEAMS_LEAGUE_ADMIN_20."";
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
		  if($i < 2)
		  	{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
				$inputstr .= ($i < ($count -1)) ? "," : "";
				}
			else{
				$inputstr .= "".$fieldname[$i]." = '0'";
				$inputstr .= ($i < ($count -1)) ? "," : "";
				}
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		}
/////////////////////////////////////////////////////
if($action == "list")
{
 /////////////////// Favorit setzen ///////////////////////	
if($favor==1)
	{
	$pruef2=favorit_an($team_id);
	if($pruef2==1){
		$message=LAN_TEAMS_LEAGUE_ADMIN_6; //Ein Favorit wurde gesetzt.
	}
	else{
		$message=LAN_TEAMS_LEAGUE_ADMIN_7;//Fehler!!!   Es konnte ken Favorit gesetzt werden.
		}
	}
/////////////////// Favorit entfernen ///////////////////////		
elseif($favor==2)
	{
	$pruef2=favorit_aus($team_id);
	if($pruef2==1){
		$message=LAN_TEAMS_LEAGUE_ADMIN_23; //Favoritstatus wurde entfernt.
	}
	else{
		$message=LAN_TEAMS_LEAGUE_ADMIN_24;//Fehler!!!   Favoritstatus konnte nicht entfernt werden.
		}
	}
//////////////////////////////////////////////////////////////	
	 $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=ae.team_admin_id  
   WHERE a.leagueteam_league_id =".$id." ORDER BY team_name
   		";
	$sql->db_Select_gen($qry1);
	$TEAMSCOUNT=0;
	while($row = $sql-> db_Fetch())
		{
		$TEAMSDATA[$TEAMSCOUNT]['leagueteam_id']=$row['leagueteam_id'];
		$TEAMSDATA[$TEAMSCOUNT]['team_id']=$row['team_id'];
		$TEAMSDATA[$TEAMSCOUNT]['team_icon']=$row['team_icon'];
		$TEAMSDATA[$TEAMSCOUNT]['team_url']=$row['team_url'];
		$TEAMSDATA[$TEAMSCOUNT]['team_name']=$row['team_name'];
		$TEAMSDATA[$TEAMSCOUNT]['user_name']=$row['user_name'];
		$TEAMSDATA[$TEAMSCOUNT]['leagueteam_league_id']=$row['leagueteam_league_id'];
		$TEAMSDATA[$TEAMSCOUNT]['leagueteam_my_team']=$row['leagueteam_my_team'];
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
	 	<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_9."</td>
		<td class='fcaption' style='text-align:left;'>".LAN_TEAMS_LEAGUE_ADMIN_10."</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_TEAMS_LEAGUE_ADMIN_11."</td>
		<td class='fcaption' style='text-align:center;width:10%'>".LAN_TEAMS_LEAGUE_ADMIN_26."</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_TEAMS_LEAGUE_ADMIN_15."</td>
		<td class='fcaption' style='text-align:center;width:10%'>".LAN_TEAMS_LEAGUE_ADMIN_19."</td>
	</tr>";
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
	 for($i = 0; $i < $TEAMSCOUNT; $i++){
	 	
	 		$count_roster = $sql->db_Count("league_roster", "(*)", "WHERE roster_team_id='".$TEAMSDATA[$i]['leagueteam_id']."'");
	 	
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['leagueteam_id']."</td>";
			$text .="<td class='forumheader3'><a href='admin_teams_config.php?edit.".$TEAMSDATA[$i]['team_id']."'><img border='0' style='width:32px; vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/logos/".$TEAMSDATA[$i]['team_icon']."'></a></td>";
			$text .="<td class='forumheader3'>";
			if($TEAMSDATA[$i]['team_url']!='')
			{$text .="<a href='".$TEAMSDATA[$i]['team_url']."' ><b>".$TEAMSDATA[$i]['team_name']."</b></a></td>";}
			else{$text .="".$TEAMSDATA[$i]['team_name']."</td>";}
			$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['user_name']."</td>";
			$text .="<td class='forumheader3'>".$count_roster."</td>";
			$text .="<td class='forumheader3' style='text-align:center;'><form method='post' action='".e_SELF."?list.".$id."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$TEAMSDATA[$i]['leagueteam_id']."'>
																				<a href='admin_roster_config.php?list.".$TEAMSDATA[$i]['leagueteam_id']."'>".$ImageROSTER['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$TEAMSDATA[$i]['leagueteam_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_TEAMS_LEAGUE_ADMIN_16." [".$TEAMSDATA[$i]['team_name']."]')\"/></form></td>";			
			if($TEAMSDATA[$i]['leagueteam_my_team']=='1'){$text .="<td class='forumheader3' style='text-align:center;'><a href='".e_SELF."?list.".$id.".2.".$TEAMSDATA[$i]['leagueteam_id']."'>".$ImageFAVORIT['LINK']."</a></td>";}
			else{$text .="<td class='forumheader3' style='text-align:center;'><a href='".e_SELF."?list.".$id.".1.".$TEAMSDATA[$i]['leagueteam_id']."'>".$ImageNOFAVORIT['LINK']."</a></td>";}														
			$text .="</tr>";
         }
 $text .= "<tr>
 						<td class='fcaption' style='text-align:center;' colspan='7'>
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
