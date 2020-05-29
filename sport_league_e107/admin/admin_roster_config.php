<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_LEAGUE_TEAMS_e107/admin/admin_roster_config.php $
|		$Revision: 0.87 $
|		$Date: 2012/05/25 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_roster_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_roster_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageEXPL['PFAD']=e_PLUGIN."sport_league_e107/images/system/Left.png";
$ImageEXPL['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageEXPL['PFAD']."'>";

$ImageEXPR['PFAD']=e_PLUGIN."sport_league_e107/images/system/Right.png";
$ImageEXPR['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageEXPR['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_59."' src='".$ImageEDIT['PFAD']."'>";

$ImageDATA['PFAD']=e_PLUGIN."sport_league_e107/images/system/archiv_on.png";
$ImageDATA['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_57."' src='".$ImageDATA['PFAD']."'>";

$ImageDATA2['PFAD']=e_PLUGIN."sport_league_e107/images/system/archiv_off.png";
$ImageDATA2['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_58."' src='".$ImageDATA2['PFAD']."'>";


if (e_QUERY) {
	list($action, $id, $team_id) = explode(".", e_QUERY);
	$id = intval($id);
	$team_id = intval($team_id);
	unset($tmp);
}

 $qry1="
   SELECT a.*, b.*, c.* FROM ".MPREFIX."league_leagueteams AS a
   LEFT JOIN ".MPREFIX."league_leagues AS b ON b.league_id=a.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS c ON c.saison_id=b.league_saison_id
   WHERE a.leagueteam_id='".$id."'
   		";
$sql->db_Select_gen($qry1);
while($row = $sql-> db_Fetch())
	{
	$FOR_CAPT = "<b>".$row['league_name']." (".$row['saison_name'].")</b>";
	}

 $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   WHERE a.leagueteam_id =".$id." ORDER BY a.leagueteam_id
   		";
	$sql->db_Select_gen($qry1);
	$DATATEMP = $sql-> db_Fetch();
	$LIGAID=$DATATEMP['leagueteam_league_id'];
	$LIGATEAMNAME=$DATATEMP['team_name'];
	$LIGATEAMID=$DATATEMP['leagueteam_id'];
	$LIGATEAMIMAGE=$DATATEMP['team_icon'];
	$TEAMIMAGE="<img border='0' style='vertical-align:middle;width:40px;' title='' src='".e_PLUGIN."sport_league_e107/logos/big/".$LIGATEAMIMAGE."'>";

//////// Vorhandene Spieler     +++++++++++++++++++++++++++++++++
	$sql -> db_Select("league_roster", "roster_player_id", "roster_team_id =".$id." ORDER BY roster_player_id");
	$TEAMSCOUNT=0;
	while($row = $sql-> db_Fetch())
		{
		$TEAMSDATA[$TEAMSCOUNT]['roster_player_id']=$row['roster_player_id'];
		$TEAMSCOUNT++;
		}
///////// Spieler die bereits in der Liste sind werden ausgefiltert!!! ++++++++++++++++++
	$sql -> db_Select("league_players", "players_id, players_name", "players_name!='' ORDER BY players_name");
	$TEAMSCOUNT2=0;
	while($row = $sql-> db_Fetch())
		{$Flag=0;
		for($i=0; $i< $TEAMSCOUNT ; $i++ )
			{
			if($TEAMSDATA[$i]['roster_player_id']==$row['players_id'])
				{	
				$Flag=1;
				//break;
				}
			}
		if($Flag==0)
			{
			$LISTE1[$TEAMSCOUNT2]['players_id']=$row['players_id'];
			$LISTE1[$TEAMSCOUNT2]['players_name']=$row['players_name'];
			$TEAMSCOUNT2++;	
			}	
		}
//////////////////////  Dropdowm Liste erstellen
$listvalue="";
for($i=0;$i < $TEAMSCOUNT2;$i++)
		{
		$listvalue.="".$LISTE1[$i]['players_id'].":".$LISTE1[$i]['players_name']."";
		if($i< $TEAMSCOUNT2-1)$listvalue.="~";
		}
/////===========================================================================


// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_ROSTER_ADMIN_1."<b>".$LIGATEAMNAME."</b>".LAN_LEAGUE_ROSTER_ADMIN_1_2.$FOR_CAPT.LAN_LEAGUE_ROSTER_ADMIN_1_1;

    $tablename = "league_roster";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "roster_id";   // first column of your table.
    $e_wysiwyg = "roster_description";
    
    $pageid = "admin_roster";  // unique name that matches the one used in admin_menu.php.


    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_34;
    $fieldname[] = "roster_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = "roster_league_id";
    $fieldname[] = "roster_league_id";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_3;
    $fieldname[] = "roster_player_id";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = $listvalue; // [table name,value-field,display-field]

///////////////////////////////////----------------    
    $fieldcapt[] = "roster_team_id";
    $fieldname[] = "roster_team_id";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_5;
    $fieldname[] = "roster_status";
    $fieldtype[] = "dropdown2";    // radio buttons
	  $fieldvalu[] = "1:".LAN_LEAGUE_ROSTER_ADMIN_38."~2:".LAN_LEAGUE_ROSTER_ADMIN_39."~3:".LAN_LEAGUE_ROSTER_ADMIN_40."~4:".LAN_LEAGUE_ROSTER_ADMIN_41."~5:".LAN_LEAGUE_ROSTER_ADMIN_41a.""; // [value:display-text, value2:display-text2 etc]
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_6;
    $fieldname[] = "roster_jersy";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_7;
    $fieldname[] = "roster_imfeld";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";
 
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_12;
    $fieldname[] = "roster_position";
    $fieldtype[] = "dropdown2";    // radio buttons
	  $fieldvalu[] = "1:".LAN_LEAGUE_ROSTER_ADMIN_19."~2:".LAN_LEAGUE_ROSTER_ADMIN_20."~3:".LAN_LEAGUE_ROSTER_ADMIN_21."~4:".LAN_LEAGUE_ROSTER_ADMIN_22."~9:".LAN_LEAGUE_ROSTER_ADMIN_23."~10:".LAN_LEAGUE_ROSTER_ADMIN_25."~11:".LAN_LEAGUE_ROSTER_ADMIN_24.""; // [value:display-text, value2:display-text2 etc]
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_30.$TEAMIMAGE;
    $fieldname[] = "roster_description";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "~100%~200px";  // [default-text,width,height] 
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_31;
    $fieldname[] = "roster_pref1";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_32;
    $fieldname[] = "roster_pref2";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_33;
    $fieldname[] = "roster_pref3";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";    

    $fieldcapt[] = LAN_LEAGUE_ROSTER_ADMIN_54;
    $fieldname[] = "roster_image";
    $fieldtype[] = "image";
    $fieldvalu[] = "../fotos/";
    
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php

require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////----------------------------------------------
//////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message =delete_player_roster($del_id);
}
///////////////////////Update ///////////////////// 
if(IsSet($_POST['nameaktual']))
{
 $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id
   WHERE a.roster_team_id='".$_POST['Team_ID']."' ORDER BY a.roster_position, a.roster_jersy
   		";	
		$sql->db_Select_gen($qry1);	
	 	$count2=0;
	 	while($row = $sql-> db_Fetch()){
		$ROSTERPLAYERNAME[$count2]=$row['players_name'];
		$ROSTERID[$count2]=$row['roster_id'];
	  $temp_league_id[$count2] =$row['roster_league_id'];
  	$temp_player_id[$count2] =$row['roster_player_id'];
  	$temp_team_id[$count2] =$row['roster_team_id'];
  	$temp_status[$count2] =$row['roster_status'];
	  $temp_jersy[$count2] =$row['roster_jersy'];
 		$temp_imfeld[$count2] =$row['roster_imfeld'];
 	 	$temp_position[$count2] =$row['roster_position'];
  	$temp_description[$count2] =$row['roster_description'];
  	$temp_pref1[$count2] =$row['roster_pref1'];
  	$temp_pref2[$count2] =$row['roster_pref2'];
  	$temp_pref3[$count2] =$row['roster_pref3'];
  	$count2++;
		}
		
$message = "Anzahl der Speiler= ".$count2.":::";
for($i=0; $i< $count2; $i++)
		{
$werte ="roster_name='".$ROSTERPLAYERNAME[$i]."', roster_league_id='".$temp_league_id[$i]."', roster_player_id='".$temp_player_id[$i]."', roster_team_id='".$temp_team_id[$i]."', roster_status='".$temp_status[$i]."', roster_jersy='".$temp_jersy[$i]."', roster_imfeld='".$temp_imfeld[$i]."', roster_position='".$temp_position[$i]."', roster_description='".$temp_description[$i]."', roster_pref1='".$temp_pref1[$i]."', roster_pref2='".$temp_pref2[$i]."', roster_pref3='".$temp_pref3[$i]."'";
		
$message .=	$werte;	
$message .=	($sql -> db_Update("league_roster", "".$werte." WHERE roster_id='".$ROSTERID[$i]."'"));	
		}

} 
///////////////////////Update /////////////////////  
if(IsSet($_POST['update']))
{
//	$sql -> db_Select("league_roster", "*", "roster_id='".$_POST['table_id']."' ");
//	$row = $sql-> db_Fetch();
//	$ROSTERPLAYERNAME=$row['roster_name'];	
//	$ROSTERLIGAID=$row['roster_league_id'];
//	$ROSTERTEAMID=$row['roster_team_id'];
//	$ROSTERPLAYERID=$row['roster_player_id'];
	
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id
   WHERE a.roster_id='".$_POST['table_id']."'
   		";	
		$sql->db_Select_gen($qry1);	
	 	$row = $sql-> db_Fetch();
	 	 	
//	$ROSTERPLAYERNAME=$row['roster_name'];	
//	if($ROSTERPLAYERNAME==''){
	$ROSTERPLAYERNAME=$row['players_name'];
	//}
	$ROSTERLIGAID=$row['roster_league_id'];
	$ROSTERTEAMID=$row['roster_team_id'];
	$ROSTERPLAYERID=$row['roster_player_id'];
	
	
	$count = count($fieldname);
	for ($i=0; $i<$count; $i++) 
		{
		if($fieldname[$i]=='roster_name')
			{
			$inputstr .=" ".$fieldname[$i]." = '".$ROSTERPLAYERNAME."',";
			continue;
			}
		elseif($fieldname[$i]=='roster_league_id')
			{
			$inputstr .=" ".$fieldname[$i]." = '".$ROSTERLIGAID."',";
			continue;
			}
		elseif($fieldname[$i]=='roster_player_id')
			{
			$inputstr .=" ".$fieldname[$i]." = '".$ROSTERPLAYERID."',";
			continue;
			}
		elseif($fieldname[$i]=='roster_team_id')
			{
			$inputstr .=" ".$fieldname[$i]." = '".$ROSTERTEAMID."',";
			continue;
			}
		else{
			$inputstr .=" ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		}
	$message = ($sql -> db_Update("league_roster", "".$inputstr." WHERE roster_id='".$_POST['table_id']."'")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
////////////////////// Neu Erstellen ////////////////
elseif(isset($_POST['uebernahme'])){
$newRostercount=0;
$sql -> db_Select("league_roster", "*","roster_team_id='".$_POST['teams']."'");
			while($row = $sql-> db_Fetch())
   			{
 				$newRoster[$newRostercount]['roster_id']=$row['roster_id'];
  			$newRoster[$newRostercount]['roster_name']=$row['roster_name'];
  			$newRoster[$newRostercount]['roster_league_id']=$row['roster_league_id'];
  			$newRoster[$newRostercount]['roster_player_id']=$row['roster_player_id'];
  			$newRoster[$newRostercount]['roster_team_id']=$row['roster_team_id'];
  			$newRoster[$newRostercount]['roster_status']=$row['roster_status'];
				$newRoster[$newRostercount]['roster_jersy']=$row['roster_jersy'];
				$newRoster[$newRostercount]['roster_imfeld']=$row['roster_imfeld'];
  			$newRoster[$newRostercount]['roster_position']=$row['roster_position'];
				$newRoster[$newRostercount]['roster_description']=$row['roster_description'];
				$newRoster[$newRostercount]['roster_pref1']=$row['roster_pref1'];
				$newRoster[$newRostercount]['roster_pref2']=$row['roster_pref2'];
				$newRoster[$newRostercount]['roster_pref3']=$row['roster_pref3'];
   			$newRostercount++;
				}
$Ubern=0;
for($i=0; $i< $newRostercount; $i++)
		{
		$querie=" '".$newRoster[$i]['roster_name']."', '".$_POST['ID']."', '".$newRoster[$i]['roster_player_id']."', '".$_POST['Team_ID']."', '".$newRoster[$i]['roster_status']."', '".$newRoster[$i]['roster_jersy']."', '".$newRoster[$i]['roster_imfeld']."', '".$newRoster[$i]['roster_position']."', '".$newRoster[$i]['roster_description']."', '".$newRoster[$i]['roster_pref1']."', '".$newRoster[$i]['roster_pref2']."', '".$newRoster[$i]['roster_pref3']."', ''";
		if($sql -> db_Insert("league_roster", "0, ".$querie.""))
				{$Ubern++;}
		}
$message="[".$Ubern."] ".LAN_LEAGUE_ROSTER_ADMIN_49." [".$newRostercount."] ".LAN_LEAGUE_ROSTER_ADMIN_50."";
}
///////////////////////////////////////
	elseif(isset($_POST['submitit']))
		{
		$sql -> db_Select("league_players", "players_name", "players_id='".$_POST['roster_player_id']."'");	
		$DATATEMP=$sql-> db_Fetch();
		$PLAYERNAME=$DATATEMP['players_name'];
			
		$count = count($fieldname);
		$inputstr = "";
		for ($i=0; $i<$count; $i++) 
		  {
			if($fieldname[$i]=='roster_name')
				{
				$inputstr .= " '".$PLAYERNAME."',";	
				}
			elseif($fieldname[$i]=='roster_league_id')
				{
				$inputstr .= " '".$LIGAID."',";	
				}
			elseif($fieldname[$i]=='roster_team_id')
				{
				$inputstr .= " '".$id."',";	
				}
			else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
				$inputstr .= ($i < ($count -1)) ? "," : "";
				}
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		}

/////////////////// Aktualisierung /////////////////////////
if($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list.".$team_id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		if($fieldname[$i]=='roster_league_id' || $fieldname[$i]=='roster_player_id' || $fieldname[$i]=='roster_team_id')
				{
				continue;
				}
		else{	
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
			}
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($fieldname[$i]=='roster_name')
			{$text .="<div style='font-size:14px;font-weight:bold;'>".$row['roster_name']."</div>";}
		else{
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
				}
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
						<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
 								<tr>
 									<td style='width:50%;text-align:right;padding:4px;'>
 										<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
										<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form></form>
 									</td>
 									<td style='width:50%text-align:left;padding:4px;'>
 										<form method=\"post\" action=\"".e_SELF."?list.".$team_id."\" id=\"back\">
 										<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_ROSTER_ADMIN_4."' />
 										</form>
 									</td>
 								</tr>
 							</table>
						</td>
					</tr>
				</table>
			</div>";
	
	$configtitle="<b>".LAN_LEAGUE_ROSTER_ADMIN_18."</b>";	
	}

///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$count = count($fieldname);
	for ($i=2; $i<$count; $i++)
		{
		if($i==3){continue;}
			
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($i<=1||$i==3){continue;}
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">		
		 					<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
 								<tr>
 									<td style='width:50%;text-align:right;padding:4px;'>
 										<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' /></form>
 									</td>
 									<td style='width:50%text-align:left;padding:4px;'>
 										<form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_ROSTER_ADMIN_2."' /></form>
 									</td>
 								</tr>
 							</table>
						</td>
					</tr>
				</table>
				</div>";
	
		$configtitle="<b>".LAN_LEAGUE_ROSTER_ADMIN_16."</b>";
	}

//////////////////////+++++++++++++++++++++++++++++++++++++++++++
elseif($action == "list")
	{
$POSITIONEN[1]=LAN_LEAGUE_ROSTER_ADMIN_19;
$POSITIONEN[2]=LAN_LEAGUE_ROSTER_ADMIN_20;
$POSITIONEN[3]=LAN_LEAGUE_ROSTER_ADMIN_21;
$POSITIONEN[9]=LAN_LEAGUE_ROSTER_ADMIN_23;
$POSITIONEN[10]=LAN_LEAGUE_ROSTER_ADMIN_25;
$POSITIONEN[4]=LAN_LEAGUE_ROSTER_ADMIN_22;
$POSITIONEN[0]="";
$POSITIONEN[11]=LAN_LEAGUE_ROSTER_ADMIN_24;
$POSITIONEN[8]=LAN_LEAGUE_ROSTER_ADMIN_26;

$STATEN[1]="<div style='color:#0a6;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_38."</div>"; //Aktiv
$STATEN[2]="<div style='color:#cc0;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_39."</div>"; // Verletzt
$STATEN[3]="<div style='color:#cc0;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_40."</div>"; // Ruehezustand
$STATEN[4]="<div style='color:#a00;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_41."</div>"; // gesp
$STATEN[5]="<div style='color:#a00;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_41a."</div>"; // Ruehezustand
$STATEN[6]="<div style='color:#a00;font-weight: bold;text-align: center'>".LAN_LEAGUE_ROSTER_ADMIN_41b."</div>"; // Ausleihspieler
//////////////////////+++++++++++++++++++++++++++++++++++++++++++
	
	 $qry1="
   SELECT a.*, ae.*, c.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_players AS ae ON ae.players_id=a.roster_player_id
   LEFT JOIN ".MPREFIX."league_player_points AS c ON c.player_points_roster_id=a.roster_id 
   WHERE a.roster_team_id =".$id." ORDER BY a.roster_position, a.roster_jersy
   		";
	$sql->db_Select_gen($qry1);
	$TEAMSCOUNT=0;
	while($row = $sql-> db_Fetch())
		{
		$TEAMSDATA[$TEAMSCOUNT]=$row;
		if($row['roster_image']=="" || !$row['roster_image'])
				{$TEAMSDATA[$TEAMSCOUNT]['players_image']=$row['players_image'];}
		else{$TEAMSDATA[$TEAMSCOUNT]['players_image']=$row['roster_image'];}
		if($row['player_points_id']=="" || !$row['player_points_id'] || $row['player_points_id']==0)
				{$TEAMSDATA[$TEAMSCOUNT]['arhiv']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_57."' src='".e_PLUGIN."sport_league_e107/images/system/no.gif'>";
				 $TEAMSDATA[$TEAMSCOUNT]['arhiv2']=$ImageDATA2['LINK'];
				}	
		else{$TEAMSDATA[$TEAMSCOUNT]['arhiv']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_ROSTER_ADMIN_58."' src='".e_PLUGIN."sport_league_e107/images/system/ok.gif'>";
				$TEAMSDATA[$TEAMSCOUNT]['arhiv2']=$ImageDATA['LINK'];
				}
		$TEAMSCOUNT++;
		}
/////////////////////////////////////////////////
   $qry1="
   SELECT b.*, be.*, bm.*, bl.* FROM ".MPREFIX."league_leagueteams AS b 
   LEFT JOIN ".MPREFIX."league_teams AS be ON be.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS bm ON bm.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS bl ON bl.saison_id=bm.league_saison_id
   WHERE b.leagueteam_id !='' ORDER BY bl.saison_id, bm.league_id, be.team_name
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
				$teamdata[$teamscount1]['liga_id']=$row['leagueteam_id'];
  			$teamdata[$teamscount1]['saison_id']=$row['league_id'];
  			$teamdata[$teamscount1]['saison_name']=$row['saison_name'];
  			$teamdata[$teamscount1]['liga_name']=$row['league_name'];
  			$teamdata[$teamscount1]['team_name']=$row['team_name'];
  			$teamscount1++;
			}
$team_list2="<option value='0'></option>";
for($i=0; $i < $teamscount1; $i++)
		{
		$team_list2.="<option value='".$teamdata[$i]['liga_id']."'>";
		$team_list2.="(".$teamdata[$i]['saison_name']."-".$teamdata[$i]['liga_name'].")-".$teamdata[$i]['team_name']."</option>";
		}			

//////////////////////+++++++++++++++++++++++++++++++++++++++++++
$expand_autohide = "display:none; ";
//////////////////////+++++++++++++++++++++++++++++++++++++++++++
 $text = "<div style=\"text-align:center\">
 						<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
 							<tr>
 								<td class='fcaption' style='width:50%;text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>
 								 	<form method='post' action='".e_SELF."' id='neu'>
 								 		<div style='font-size: 14px;color:#00b42a;font-weight: bold;text-align: center'>
 											<a href='".e_SELF."?neu.".$id."'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_ROSTER_ADMIN_14."  ".$TEAMIMAGE."</a>
 										</div>
 									</form>
 								</td>
 								<td class='fcaption' style='width:50%;text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>
									<div style='cursor:pointer;font-size: 14px;color:#00b42a;font-weight: bold;text-align: center' onclick=\"expandit('exp_import')\">
									".$ImageEXPL['LINK']." ".LAN_LEAGUE_ROSTER_ADMIN_43." ".$ImageEXPR['LINK']." 
									</div>
									<div id='exp_import' style='$expand_autohide'><br/>
									<div style='text-align:center;border:2px #f00 solid;background:#fcc;padding:10px;'>
										<div style='font-weight:bold;font-size:14px;color:#f00;'>
											".LAN_LEAGUE_ROSTER_ADMIN_47."
										</div>
									".LAN_LEAGUE_ROSTER_ADMIN_48."
									</div>
									<br/><br/>
  									".LAN_LEAGUE_ROSTER_ADMIN_44."".$teamscount1."".LAN_LEAGUE_ROSTER_ADMIN_45." <br/><br/>
									<form method='post' action='".e_SELF."?list.".$id."' id='uebernahme'>
										<input type='hidden' name='Team_ID' value='".$LIGATEAMID."'>
										<input type='hidden' name='ID' value='".$LIGAID."'>
										<select class='tbox' name='teams' size='1' width='15'>".$team_list2."</select>
										<input class='button'type='submit' id='ueber' name='uebernahme' value='".LAN_LEAGUE_ROSTER_ADMIN_46."'/><br/>
									</form>
								</div>
								<br/>	
									<form method='post' action='".e_SELF."?list.".$id."' id='nameaktual'>
										<input type='hidden' name='Team_ID' value='".$LIGATEAMID."'>
										<input class='button'type='submit' id='nameaktual' name='nameaktual' value='".LAN_LEAGUE_ROSTER_ADMIN_52."'/><br/>
									</form>
									
									
 								</td>
 							</tr>
 						</table>
 					<br/>
 					<br/>
 				<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center;width:5%'>".LAN_LEAGUE_ROSTER_ADMIN_8."</td>
	 	<td class='fcaption' style='text-align:center;width:5%'>".LAN_LEAGUE_ROSTER_ADMIN_9."</td>
		<td class='fcaption' style='text-align:left;width:5%'>".LAN_LEAGUE_ROSTER_ADMIN_10."</td>
		<td class='fcaption' style='text-align:left;width:5%'>".LAN_LEAGUE_ROSTER_ADMIN_53."</td>
		<td class='fcaption' style='text-align:center;'>".LAN_LEAGUE_ROSTER_ADMIN_11."</td>
		<td class='fcaption' style='text-align:center;width:5%'>".LAN_LEAGUE_ROSTER_ADMIN_13."</td>
		<td class='fcaption' style='text-align:center;width:10%'>".LAN_LEAGUE_ROSTER_ADMIN_42."</td>
		<td class='fcaption' style='text-align:center;width:20%'>".LAN_LEAGUE_ROSTER_ADMIN_15."</td>
	</tr>";
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
if($TEAMSCOUNT > 0)
	{
	 for($i = 0; $i < $TEAMSCOUNT; $i++)
	 			{
	 			if($TEAMSDATA[$i]['roster_position']!=$TEAMSDATA[$i-1]['roster_position']||$i==0)
	 				{
	 				$text .="<tr><td class='fcaption' colspan='8' style='font-weight: bold;text-align:left;width:100%'>".$POSITIONEN[$TEAMSDATA[$i]['roster_position']]."</td></tr>";
	 				}		
				$text .="<tr>";
				$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['roster_id']."</td>";
				$text .="<td class='forumheader3'><a href='admin_player_list.php?edit.".$TEAMSDATA[$i]['roster_player_id']."' title='".LAN_LEAGUE_ROSTER_ADMIN_55."".$TEAMSDATA[$i]['roster_name']." ".LAN_LEAGUE_ROSTER_ADMIN_56."'><img border='0' style='width:32px; vertical-align: middle' src='".e_PLUGIN."sport_league_e107/fotos/".$TEAMSDATA[$i]['players_image']."'></a></td>";
				$text .="<td class='forumheader3'><b>#".$TEAMSDATA[$i]['roster_jersy']."</b></td>";
				$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['arhiv']."</td>";
				$text .="<td class='forumheader3'>".$TEAMSDATA[$i]['roster_name']."</td>";
				$text .="<td class='forumheader3'>".$POSITIONEN[$TEAMSDATA[$i]['roster_position']]."</td>";
				$text .="<td class='forumheader3'>".$STATEN[$TEAMSDATA[$i]['roster_status']]."</td>";
				$text .="<td class='forumheader3' style='text-align:center;'><form method='post' action='".e_SELF."?list.".$id."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$TEAMSDATA[$i]['roster_id']."'>
																				<a href='".e_SELF."?edit.".$TEAMSDATA[$i]['roster_id'].".".$TEAMSDATA[$i]['roster_team_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<a href='admin_league_player_archiv.php?neu.".$TEAMSDATA[$i]['roster_id'].".".$TEAMSDATA[$i]['roster_league_id'].".".$TEAMSDATA[$i]['roster_team_id']."'>".$TEAMSDATA[$i]['arhiv2']."</a> |
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$TEAMSDATA[$i]['roster_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_ROSTER_ADMIN_35." [".$TEAMSDATA[$i]['roster_name']."] ".LAN_LEAGUE_ROSTER_ADMIN_36."')\"/>
																				</form>
																				</td>";			
											
				$text .="</tr>";
         }
   }
else{
$text .= "<tr>
 						<td class='forumheader3' style='text-align:center;vertical-align: middle;' colspan='8'>
 							<br/><br/>
 								".LAN_LEAGUE_ROSTER_ADMIN_51."
 							<br/><br/>
 						</td>
 					</tr>";
		}
 $text .= "<tr>
 						<td class='fcaption' style='text-align:center;vertical-align: middle;' colspan='8'>
 							<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
 								<tr>
 									<td style='width:50%;text-align:right;padding:4px;'>
 										<form method='post' action='admin_tleague_config.php?list.".$LIGAID."' id='back'><input class='button' style='vertical-align: middle;' type='submit' id='back' name='back' value='".LAN_LEAGUE_ROSTER_ADMIN_37."' /></form>
 									</td>
 									<td style='width:30%;text-align:left;padding:4px;'>
 										<form method='post' action='admin_league_config.php' id='back2'><input class='button' style='vertical-align: middle;' type='submit' id='back2' name='back2' value='".LAN_LEAGUE_ROSTER_ADMIN_4."' /></form>
 									</td>
 									<td style='width:20%;text-align:left;padding:4px;'>
 										<form method='post' action='admin_player_stats_import.php' id='archiv_all'><input class='button' style='vertical-align: middle;' type='submit' id='archiv_all' name='archiv_all' value='".LAN_LEAGUE_ROSTER_ADMIN_60."' /></form>
 									</td>
 								</tr>
 							</table>
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
?>
