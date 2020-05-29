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
|		$Source: ../e107_plugins/sport_league_e107/admins/admin_games_config.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
require_once(e_PLUGIN."sport_league_e107/ecal_class.php");
global $ecal_class;
$ecal_class = new ecal_class2;

require_once(e_HANDLER."calendar/calendar_class.php");
$SELCAL = new DHTML_Calendar(true);
function headerjs(){
  	global $SELCAL;
    $js = $SELCAL->load_files();
   return $js;
}
define("MAINTHEME", e_THEME.$pref['sitetheme']."/");
define("THEME", e_THEME.$pref['sitetheme']."/");
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_games_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_games_lan.php");

require_once("../functionen.php");


$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align:middle;padding:2px;' title='".LAN_LEAGUE_GAMES_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align:middle;padding:2px;' title='".LAN_LEAGUE_GAMES_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$ImageCALENDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/report.png";
$ImageCALENDER['LINK']="<img border='0' style='vertical-align:middle;padding:2px;' title='".LAN_LEAGUE_GAMES_ADMIN_21."' src='".$ImageCALENDER['PFAD']."'>";

//$ImageTEAMS['PFAD']=e_PLUGIN."sport_league_e107/images/system/teams.png";
//$ImageTEAMS['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_13."' src='".$ImageTEAMS['PFAD']."'>";


if (e_QUERY) {
	list($action, $LIGid, $GAM) = explode(".", e_QUERY);
	$LIGid = intval($LIGid);
	$GAM = intval($GAM);
	unset($tmp);
}

$teamscount=0;
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   WHERE a.leagueteam_league_id='".$LIGid."' ORDER BY ae.team_name
   		";
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
				$team[$teamscount]['id']=$row['leagueteam_id'];
				$team[$teamscount]['TeamName']=$row['team_name'];
				$teamscount++;
				}


$Teamlist="";
for($i=0; $i< $teamscount; $i++)
		{
		$Teamlist.="".$team[$i]['id'].":".$team[$i]['TeamName']."~ ";
		}


// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_GAMES_ADMIN_1;

    $tablename = "league_games";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "game_id";   // first column of your table.
    $e_wysiwyg = "game_description"; // commas seperated list of textareas to use wysiwyg with.
//    $pageid = "admin_games";  // unique name that matches the one used in admin_menu.php.

 
 
    $fieldcapt[] = "game_league_id";
    $fieldname[] = "game_league_id";
    $fieldtype[] = "text";  // pulldown menu from a db table.
    $fieldvalu[] = ""; 
 
    $fieldcapt[] = "game_week";
    $fieldname[] = "game_week";
    $fieldtype[] = "text";  // pulldown menu from a db table.
    $fieldvalu[] = ""; 
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_2;
    $fieldname[] = "game_date";
    $fieldtype[] = "DateTime"; // unix datestamp format.
    $fieldvalu[] = "2006~2010"; // [start-year,end-year] (optional)  
 
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_3;
    $fieldname[] = "game_time";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
 
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_4;
    $fieldname[] = "game_home_id";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = $Teamlist;
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_5;
    $fieldname[] = "game_gast_id";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = $Teamlist;
 
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_6;
    $fieldname[] = "game_goals_home";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
   
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_7;
    $fieldname[] = "game_goals_gast";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
 
 		$fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_8;//;
    $fieldname[] = "game_un";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";
    
   	$fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_9;//;
    $fieldname[] = "game_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";
 
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_10;
    $fieldname[] = "game_news_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "news~news_id~news_title"; // [table name,value-field,display-field]
 
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_11;
    $fieldname[] = "game_description";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "~100%~250px";  // [default-text,width,height]

//////////////////////////////////////////////////////////
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref1";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref2";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref3";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref4";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref5";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_GAMES_ADMIN_12;
    $fieldname[] = "game_pref6";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
   
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php

///require_once(HEADERF);
require_once("../form_handler.php");
$rs = new form;
///////////////----------------------------------------------

////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
//////////////////////////////////////////////////////////////
if(isset($_POST['textinput']))
{$message="";
	$file = fopen("".e_PLUGIN."sport_league_e107/import/test_text.txt","r"); 
	if ($file) 
		{ 
			while(!feof($file)) 
				{ 
				$FileInhalt .= fgets($file); 
			  }
				$IMPORTGAMES = explode("|",$FileInhalt);
				$GAM_ANZ= count($IMPORTGAMES);
				for($i=0; $i < $GAM_ANZ; $i++ )
					{
					$GAM = explode(";",$IMPORTGAMES[$i]);
					$HI= $GAM[0];/// Home-ID
					$GI= $GAM[1];/// Gast-ID
					$GD= $GAM[2];/// Datum
					$DT= $GAM[3];/// Spielzei
					$HT= $GAM[4];/// Home- Tore
					$GT= $GAM[5];/// Gast-Tore
					$GU= $GAM[6];/// Unentschieden
					$GE= $GAM[7];/// Enable
					$DAT=explode(".",$GD);
					$TIM=explode(":",$DT);
					$UNIXZEIT= mktime($TIM[0],$TIM[1],0,$DAT[1],$DAT[0],$DAT[2]);						
					$inputstr = "'".$_POST['ligaid']."', '', '".$UNIXZEIT."', '".$DT."', '".$HI."', '".$GI."','".$HT."', '".$GT."', '".$GU."', '".$GE."', '', '', '', '', '', '', '', ''"; 
					$message .= ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
					$message .="".$inputstr."<br/>";
				}
			fclose($file); 
		}
	else {$message= "nix Datei!";}
}

////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$GAM."' ");
	$row = $sql-> db_Fetch();
	$smarray = getdate($row[$fieldname[2]]);
            $ne_hour = $smarray['hours'];
            $ne_minute = $smarray['minutes'];
	
////////////////////////// Table  ++++++++++++++++++++++	
 $text = "<link rel='stylesheet' href='".MAINTHEME."style.css' />\n";
 $text .= "<script type=\"text/javascript\" src=\"../../../../e107_files/e107.js\"></script>";
	$text .= "<div style='text-align:center;width:1000px;'>\n";
	$text .= "<form method='post' action='".e_SELF."?list.".$LIGid."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$text .="
		<tr><td colspan='3'>
			<table class='fborder' style='width:100%;border:0px'>
				<tr>
					<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[2]." / ".$fieldcapt[3].":</td>
					<td style=\"width:70%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[2] . "|" .$fieldtype[2]."|".$fieldvalu[2];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[2]],$fieldname[2]);
	$text .=" / ";
	
	$text .= make_hourmin("".$fieldname[2]."_",$ne_hour,$ne_minute);
	
	//$form_send = $fieldcapt[3] . "|" .$fieldtype[3]."|".$fieldvalu[3];
	//$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[3]],$fieldname[3]);
	$text .="</td></tr></table>
				</td></tr>";
/////////////////// Teams Auswahl   +++++++++++++++++
	$text .="
		<tr>
		<td style='width:48%; vertical-align:top;text-align:right' class='forumheader3'>".$fieldcapt[4]."</td><td style='width:4%; vertical-align:top' class='forumheader3'> </td>
		<td style='width:48%; vertical-align:top;text-align:left' class='forumheader3'>".$fieldcapt[5]." </td></tr>
		<tr>
		<td class='forumheader3' style='width:48%;text-align:right'>";
	$form_send = $fieldcapt[4] . "|" .$fieldtype[4]."|".$fieldvalu[4];	
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[4]],$fieldname[4]);
	$text .="</td><td style='width:4%; vertical-align:top;text-align:center' class='forumheader3'>vs.</td><td class='forumheader3' style='width:50%'>";
	$form_send = $fieldcapt[5] . "|" .$fieldtype[5]."|".$fieldvalu[5];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[5]],$fieldname[5]);
	$text .="</td></tr>";	
/////////////////// Ergebniss   +++++++++++++++++	
	$text .="
		<tr>
		<td style='width:48%; vertical-align:top;text-align:right' class='forumheader3'>".$fieldcapt[6]."</td><td style=\"width:4%; vertical-align:top\" class=\"forumheader3\"> </td>
		<td style='width:48%; vertical-align:top;text-align:left' class='forumheader3'>".$fieldcapt[7]." </td></tr>
		<tr>
		<td class='forumheader3' style='width:48%;text-align:right'>";
	$form_send = $fieldcapt[6] . "|" .$fieldtype[6]."|".$fieldvalu[6];	
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[6]],$fieldname[6]);
	$text .="</td>
					 <td style='width:4%; vertical-align:top;text-align:center' class='forumheader3'>:</td>
					 <td class='forumheader3' style='width:48%;text-align:left'>";
	$form_send = $fieldcapt[7] . "|" .$fieldtype[7]."|".$fieldvalu[7];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[7]],$fieldname[7]);
	$text .="</td></tr>";	
/////////////////  Unentsch / Enable
	$text .="
		<tr><td  colspan='3'>
			<table class='fborder' style='width:100%;border:0px'>
				<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[8].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[8] . "|" .$fieldtype[8]."|".$fieldvalu[8];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[8]],$fieldname[8]);
	$text .="</td></tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[9].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[9] . "|" .$fieldtype[9]."|".$fieldvalu[9];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[9]],$fieldname[9]);
	$text .="</td>
					</tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[10].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[10] . "|" .$fieldtype[10]."|".$fieldvalu[10];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[10]],$fieldname[10]);
	$text .="</td>
					</tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[11].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[11] . "|" .$fieldtype[11]."|".$fieldvalu[11];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[11]],$fieldname[11]);
	$text .="</td></tr></table></td></tr>";
	$text .= "<tr><td colspan='3' class='forumheader' style='text-align:center'>
		<input type='hidden' name='MYLIG' value='".$LIGid."'>
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'>
		</form><form method='post' action='".e_SELF."?list.".$LIGid."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAMES_ADMIN_23."' /></form></td></tr></table></div>";
		
	$configtitle="<b>".LAN_LEAGUE_GAMES_ADMIN_18."</b>";	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
	{
////////////////////////// Table  ++++++++++++++++++++++	
 $text = "<link rel='stylesheet' href='".MAINTHEME."style.css' />\n";
 $text .= "<script type=\"text/javascript\" src=\"../../../../e107_files/e107.js\"></script>";
	$text .= "<div style='text-align:center;width:1000px;'>\n";
	$text .= "<form method='post' action='".e_SELF."?list.".$LIGid."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$text .="
		<tr><td colspan='3'>
			<table class='fborder' style='width:100%;border:0px'>
				<tr>
					<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[2]." / ".$fieldcapt[3].":</td>
					<td style=\"width:70%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[2] . "|" .$fieldtype[2]."|".$fieldvalu[2];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[2]],$fieldname[2]);
	$text .=" / ";
	$text .= make_hourmin("".$fieldname[2]."_",$ne_hour,$ne_minute);
	//$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[3]],$fieldname[3]);
	$text .="</td></tr></table>
				</td></tr>";
		

/////////////////// Teams Auswahl   +++++++++++++++++
	$text .="
		<tr>
		<td style='width:48%; vertical-align:top;text-align:right' class='forumheader3'>".$fieldcapt[4]."</td><td style='width:4%; vertical-align:top' class='forumheader3'> </td>
		<td style='width:48%; vertical-align:top;text-align:left' class='forumheader3'>".$fieldcapt[5]." </td></tr>
		<tr>
		<td class='forumheader3' style='width:48%;text-align:right'>";
	$form_send = $fieldcapt[4] . "|" .$fieldtype[4]."|".$fieldvalu[4];	
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[4]],$fieldname[4]);
	$text .="</td><td style='width:4%; vertical-align:top;text-align:center' class='forumheader3'>vs.</td><td class='forumheader3' style='width:50%'>";
	$form_send = $fieldcapt[5] . "|" .$fieldtype[5]."|".$fieldvalu[5];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[5]],$fieldname[5]);
	$text .="</td></tr>";	
/////////////////// Ergebniss   +++++++++++++++++	
	$text .="
		<tr>
		<td style='width:48%; vertical-align:top;text-align:right' class='forumheader3'>".$fieldcapt[6]."</td><td style=\"width:4%; vertical-align:top\" class=\"forumheader3\"> </td>
		<td style='width:48%; vertical-align:top;text-align:left' class='forumheader3'>".$fieldcapt[7]." </td></tr>
		<tr>
		<td class='forumheader3' style='width:48%;text-align:right'>";
	$form_send = $fieldcapt[6] . "|" .$fieldtype[6]."|".$fieldvalu[6];	
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[6]],$fieldname[6]);
	$text .="</td>
					 <td style='width:4%; vertical-align:top;text-align:center' class='forumheader3'>:</td>
					 <td class='forumheader3' style='width:48%;text-align:left'>";
	$form_send = $fieldcapt[7] . "|" .$fieldtype[7]."|".$fieldvalu[7];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[7]],$fieldname[7]);
	$text .="</td></tr>";	
/////////////////  Unentsch / Enable
	$text .="
		<tr><td  colspan='3'>
			<table class='fborder' style='width:100%;border:0px'>
				<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[8].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[8] . "|" .$fieldtype[8]."|".$fieldvalu[8];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[8]],$fieldname[8]);
	$text .="</td></tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[9].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[9] . "|" .$fieldtype[9]."|".$fieldvalu[9];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[9]],$fieldname[9]);
	$text .="</td>
					</tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[10].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[10] . "|" .$fieldtype[10]."|".$fieldvalu[10];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[10]],$fieldname[10]);
	$text .="</td>
					</tr>
					<tr>
					<td style='width:30%; vertical-align:top' class='forumheader3'>".$fieldcapt[11].":</td>
					<td style='width:70%' class='forumheader3'>";
	$form_send = $fieldcapt[11] . "|" .$fieldtype[11]."|".$fieldvalu[11];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[11]],$fieldname[11]);
	$text .="</td></tr></table></td></tr>";
	$text .= "<tr><td colspan='3' class='forumheader' style='text-align:center'>
		<input type='hidden' name='MYLIG' value='".$LIGid."'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='".e_SELF."?list.".$LIGid."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAMES_ADMIN_23."' /></form></td></tr></table></div>";
	
	
		$configtitle="<b>".LAN_LEAGUE_GAMES_ADMIN_14."</b>";
	}
////////////////////// Neu Erstellen ////////////////
elseif($action == "list")
	{
///////////////////////////////////////////////////		
///////////////////////////////////////////////////		Achtung!!! Diese Funkrion wird alle Spiel-Zeiten in das Spiel-Datum integrieren.
///////////////////////////////////////////////////		Diese Funktion wird später rausgenohmen!!!!
///////////////////////////////////////////////////		
///////////////////////////////////////////////////		
		if(isset($_POST['datumakt']))
		{
			   $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_league_id ='".$_POST['ligaid']."' ORDER BY a.game_date
   		";

   	$datumcount=0;	
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
	 			$datum[$datumcount]['game_id']=$row['game_id'];
	 			$datum[$datumcount]['game_date']=$row['game_date'];
	 			$datum[$datumcount]['game_time']=$row['game_time'];
	 			$datum[$datumcount]['game_home_id']=$row['game_home_id'];
	 			$datum[$datumcount]['game_gast_id']=$row['game_gast_id'];
	 			$datum[$datumcount]['game_goals_home']=$row['game_goals_home'];
	 			$datum[$datumcount]['game_goals_gast']=$row['game_goals_gast'];
	 			$datum[$datumcount]['game_un']=$row['game_un'];
	 			$datum[$datumcount]['game_enable']=$row['game_enable'];
	 			$datum[$datumcount]['game_description']=$row['game_description'];
	 			$datum[$datumcount]['game_news_id']=$row['game_news_id'];
	 			$datumcount++;
	 			}
	 	$message="";
	 	for ($i=0; $i< $datumcount; $i++) 
			{	
				if($datum[$i]['game_time']!=0)
					{$inputstr="";
					$tmp1 = explode(":", $datum[$i]['game_time']);
					$tmp2=strftime("%d/%m/%Y",$datum[$i]['game_date']);
					$DATUMZUMUPDATE = $ecal_class->make_date($tmp1[0], $tmp1[1], $tmp2, "/");
					$inputstr="game_id='".$datum[$i]['game_id']."', game_date='".$DATUMZUMUPDATE."', game_time='".$datum[$i]['game_time']."', game_home_id='".$datum[$i]['game_home_id']."', game_gast_id='".$datum[$i]['game_gast_id']."', game_un='".$datum[$i]['game_un']."', game_enable='".$datum[$i]['game_enable']."', game_description='".$datum[$i]['game_description']."', game_news_id='".$datum[$i]['game_news_id']."'";
	 				$message .= ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$datum[$i]['game_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
	      } 		
	 		}
		}
///////////////////////////////////////////////////		
/////////////////      Ende!!!   //////////////////		
///////////////////////////////////////////////////		
		
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
		  if ($fieldtype[$i]=="DateTime"){
				//$ev_start	= "".$tp->toDB($_POST[game_date_hour]).":".$_POST['".$fieldname[$i]."_minute']."".$_POST[$fieldname[$i]]."";
				$ev_start	= $ecal_class->make_date($_POST[game_date_hour], $_POST[game_date_minute],$_POST[game_date], "/");
				$inputstr .= " '".$ev_start."'";				
			}		
			elseif($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			$year = $fieldname[$i]."_year";
			$month = $fieldname[$i]."_month";
			$day = $fieldname[$i]."_day";
			if($fieldtype[$i]=="date"){
					$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
        	}else {
					$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
        	}
					} 
			elseif($fieldname[$i]=="game_league_id")		
					{
					$inputstr .= " '".$LIGid."'";	
					}
			else {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
					}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		}
/////////////////// Aktualisierung /////////////////////////
	if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
			{
			if ($fieldtype[$i]=="DateTime"){
				//$ev_start	= "".$tp->toDB($_POST[game_date_hour]).":".$_POST['".$fieldname[$i]."_minute']."".$_POST[$fieldname[$i]]."";
				$ev_start	= $ecal_class->make_date($_POST[game_date_hour], $_POST[game_date_minute],$_POST[game_date], "/");
				$inputstr .= " ".$fieldname[$i]." = '".$ev_start."'";				
			}	
			elseif($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
				$year = $fieldname[$i]."_year";
				$month = $fieldname[$i]."_month";
				$day = $fieldname[$i]."_day";
       	if($fieldtype[$i]=="date"){
             $inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
            } else {
         	$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
					}
				} elseif($fieldname[$i]=="game_league_id")		
					{
					$inputstr .= " ".$fieldname[$i]." = '".$LIGid."'";	
					}
				else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
	
 $text = "<link rel='stylesheet' href='".MAINTHEME."style.css' />\n";
 $text .= "<script type=\"text/javascript\" src=\"../../../../e107_files/e107.js\"></script>";
 $text .= "<div style='text-align:center;width:1000px;'>
<div style='font-size: 14px;color:#00b42a;font-weight: bold;'>

";
///////////////////////////////////////////////////		
/////////////////      Ende!!!   //////////////////		
///////////////////////////////////////////////////	

$text .= "Hallo ".USERNAME."!<br/>Hier siest du die Liste der Spiele Deiner Mannschaften, die du Ergänzen/Bearbeiten darfst!<br/>Falls die Tabelle lehr ist, handelt es sich dann evtl um einen Fehler (was eigentlich unwascheinlig ist...) oder du hast dich auf der Seite \"verlaufen\" und befindest dich gerade nicht in deine Liga/Saison. Gehe dann bitte zurück auf die Seite, und volge einfach den Links auf der Termintabelle.<br/><br/><a href='".e_SELF."?neu.".$LIGid."'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_GAMES_ADMIN_14."</div></a>

 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center; width:15px;'>".LAN_LEAGUE_GAMES_ADMIN_24."</td>
	  <td class='fcaption' style='text-align:center; width:30px;'>".LAN_LEAGUE_GAMES_ADMIN_25."</td>
	  <td class='fcaption' style='text-align:center; width:30px;'>".LAN_LEAGUE_GAMES_ADMIN_28."</td>
	 	<td class='fcaption' style='text-align:left;'>".LAN_LEAGUE_GAMES_ADMIN_26."</td>
		<td class='fcaption' style='text-align:center; width: 40px;'>".LAN_LEAGUE_GAMES_ADMIN_27."</td>
		<td class='fcaption' style='text-align:center; width: 50px;'>".LAN_LEAGUE_GAMES_ADMIN_15."</td>
	</tr>";

//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
   $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_league_id ='".$LIGid."' ORDER BY a.game_date
   		";
  		
   	$GAMES_DATAS_COUNT=0;	
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_id']=$row['game_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_date']=$row['game_date'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_time']=$row['game_time'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_id']=$row['game_home_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_gast_id']=$row['game_gast_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_goals_home']=$row['game_goals_home'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_goals_gast']=$row['game_goals_gast'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_un']=$row['game_un'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_enable']=$row['game_enable'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_description']=$row['game_description'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_news_id']=$row['game_news_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_name']=$row['team_name'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_kurzname']=$row['team_kurzname'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_admin_id']=$row['team_admin_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_icon']=$row['team_icon'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_admin']=$row['team_admin_id'];
	 			$GAMES_DATAS_COUNT++;
	 			}

$oldTerm=0;
$newTerm=0;
$aktTerm=0;
		for($i=0; $i < $GAMES_DATAS_COUNT ;$i++)
			{
				 $qry1="
   			SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a
   			LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   			WHERE a.leagueteam_id ='".$GAMES_DATAS[$i]['game_gast_id']."'
   			";
			$sql->db_Select_gen($qry1);
			$row = $sql-> db_Fetch();
			$GAMES_DATAS[$i]['game_gast_name']=$row['team_name'];
	 		$GAMES_DATAS[$i]['game_gast_kurzname']=$row['team_kurzname'];
	 		$GAMES_DATAS[$i]['game_gast_admin_id']=$row['team_admin_id'];
	 		$GAMES_DATAS[$i]['game_gast_icon']=$row['team_icon'];
			$GAMES_DATAS[$i]['game_gast_admin']=$row['team_admin_id'];
			if($GAMES_DATAS[$i]['game_date'] < (time()-432000))
				{
				$OLD_GAMES_DATAS[$oldTerm]=$GAMES_DATAS[$i];
				$oldTerm++;
				}
			elseif($GAMES_DATAS[$i]['game_date'] > (time()+432000))
				{
				$NEW_GAMES_DATAS[$newTerm]=$GAMES_DATAS[$i];
				$newTerm++;
				}
			else
				{
				$AKT_GAMES_DATAS[$aktTerm]=$GAMES_DATAS[$i];
				$aktTerm++;
				}
			}

$expand_autohide = "display:none; ";
///////////////////////////////  Ältere Termine 
if($oldTerm > 0)
	{
	$text .="<tr><td class='fcaption' colspan='6'><div style='cursor:pointer;text-align:center;font-weight: bold;' onclick=\"expandit('exp_old')\">".LAN_LEAGUE_GAMES_ADMIN_19."</div></td></tr>
					<tr><td colspan='6'><div id='exp_old' style='$expand_autohide'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";	
	}
   		
		for($i=0; $i < $oldTerm ;$i++)
			{
			if(ADMIN || USERID==$OLD_GAMES_DATAS[$i]['game_home_admin'] || USERID==$OLD_GAMES_DATAS[$i]['game_gast_admin'])
				{
			if($OLD_GAMES_DATAS[$i]['game_enable']!='1')
				{$BGFARBE="#ff0000";}
				else{$BGFARBE="#00ff00";}
			$text .="<tr>";
			$text .="<td class='forumheader3' style='text-align:center; width:30px;height:30px;padding:2px;background-color:".$BGFARBE."'>".$OLD_GAMES_DATAS[$i]['game_id']."</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:100px;height:30px;padding:2px;'>".strftime("%a %d %b %Y",$OLD_GAMES_DATAS[$i]['game_date'])."</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:70px;height:30px;padding:2px;'>".strftime("%H:%M",$OLD_GAMES_DATAS[$i]['game_date'])."";
			$text .="</td>";
			$text .="<td class='forumheader3' style='text-align:center;height:30px;padding:2px;'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$OLD_GAMES_DATAS[$i]['game_home_icon']."' height='30'>  ".$OLD_GAMES_DATAS[$i]['game_home_name']." vs. ".$OLD_GAMES_DATAS[$i]['game_gast_name']." <img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$OLD_GAMES_DATAS[$i]['game_gast_icon']."' height='30'></td>";
			$text .="<td class='forumheader3' style='text-align:center; width:80px;'><b>".$OLD_GAMES_DATAS[$i]['game_goals_home'].":".$OLD_GAMES_DATAS[$i]['game_goals_gast']."</b>";
			if($OLD_GAMES_DATAS[$i]['game_un'])
				{$text .=" n.P.";}
$text .="</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:200px;height:30px;padding:2px;'><form method='post' action='".e_SELF."?list.".$LIGid."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$OLD_GAMES_DATAS[$i]['game_id']."'>
																				<a href='admin_game_config.php?list.".$OLD_GAMES_DATAS[$i]['game_id']."'>".$ImageCALENDER['LINK']."</a> | 
																				<a href='".e_SELF."?edit.".$LIGid.".".$OLD_GAMES_DATAS[$i]['game_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$OLD_GAMES_DATAS[$i]['game_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_GAMES_ADMIN_16." [".$OLD_GAMES_DATAS[$i]['game_id']."]')\"/></form></td></tr>";
         	}
         else{continue;}
         }
if($oldTerm > 0){
$text .="<tr><td class='fcaption' colspan='6' style='text-align:center;font-weight: bold;'>".LAN_LEAGUE_GAMES_ADMIN_13."</td></tr></table></div></td></tr>";
}
//////////////////////////////////   Aktuelle Termine
if($aktTerm > 0)
	{
		for($i=0; $i < $aktTerm ;$i++)
			{
			if(ADMIN || USERID==$AKT_GAMES_DATAS[$i]['game_home_admin'] || USERID==$AKT_GAMES_DATAS[$i]['game_gast_admin'])
				{
				
			if($AKT_GAMES_DATAS[$i]['game_date'] < time()&&$AKT_GAMES_DATAS[$i]['game_enable']!='1')
				{$BGFARBE="#ff0000";}
				elseif($AKT_GAMES_DATAS[$i]['game_date'] < time()&&$AKT_GAMES_DATAS[$i]['game_enable']=='1'){$BGFARBE="#00ff00";}
				else{$BGFARBE="#ffff00";}
			$text .="<tr>";
			$text .="<td class='forumheader3' style='text-align:center; width:30px;height:30px;padding:2px;background-color:".$BGFARBE."'>".$AKT_GAMES_DATAS[$i]['game_id']."</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:100px;height:30px;padding:2px;'>".strftime("%a. %d.%b.%Y",$AKT_GAMES_DATAS[$i]['game_date'])."</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:70px;height:30px;padding:2px;'>".strftime("%H:%M",$AKT_GAMES_DATAS[$i]['game_date'])."";
			$text .="</td>";
			$text .="<td class='forumheader3' style='text-align:center;height:30px;padding:2px;'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$AKT_GAMES_DATAS[$i]['game_home_icon']."' height='30'> ".$AKT_GAMES_DATAS[$i]['game_home_name']." vs. ".$AKT_GAMES_DATAS[$i]['game_gast_name']." <img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$AKT_GAMES_DATAS[$i]['game_gast_icon']."' height='30'> </td>";
			$text .="<td class='forumheader3' style='text-align:center;height:30px;padding:2px; width:80px;'><b>".$AKT_GAMES_DATAS[$i]['game_goals_home'].":".$AKT_GAMES_DATAS[$i]['game_goals_gast']."</b>";
			if($AKT_GAMES_DATAS[$i]['game_un'])
				{$text .=" n.P.";}
$text .="</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:200px;height:30px;padding:2px;'><form method='post' action='".e_SELF."?list.".$LIGid."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$AKT_GAMES_DATAS[$i]['game_id']."'>
																				<a href='admin_game_config.php?list.".$AKT_GAMES_DATAS[$i]['game_id']."'>".$ImageCALENDER['LINK']."</a> | 
																				<a href='".e_SELF."?edit.".$LIGid.".".$AKT_GAMES_DATAS[$i]['game_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$AKT_GAMES_DATAS[$i]['game_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_GAMES_ADMIN_16." [".$AKT_GAMES_DATAS[$i]['game_id']."]')\"/></form></td></tr>";
      
      	}
       else{continue;}
      }
	}
else{
	$text .="<tr><td class='forumheader3' colspan='6' style='text-align:center; width:100%;'>".LAN_LEAGUE_GAMES_ADMIN_29."</td></tr>";
	}
/////////////////////////////////////   Spätere Termine
if($newTerm > 0)
	{
	$text .="<tr><td class='fcaption' colspan='6'><div style='cursor:pointer; text-align:center;font-weight: bold;' onclick=\"expandit('exp_new')\">".LAN_LEAGUE_GAMES_ADMIN_20."</div></td></tr>
					<tr><td colspan='6'><div id='exp_new' style='$expand_autohide'>
					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
		
	}
   		
		for($i=0; $i < $newTerm ;$i++)
			{	
			if(ADMIN || USERID==$NEW_GAMES_DATAS[$i]['game_home_admin'] || USERID==$NEW_GAMES_DATAS[$i]['game_gast_admin'])
				{			
			$text .="<tr>";
			$text .="<td class='forumheader3' style='text-align:center;width:30px;height:30px;padding:2px;'>".$NEW_GAMES_DATAS[$i]['game_id']."</td>";
			$text .="<td class='forumheader3' style='text-align:center;width:100px;height:30px;padding:2px;'>".strftime("%a %d %b %Y",$NEW_GAMES_DATAS[$i]['game_date'])."</td>";
			$text .="<td class='forumheader3' style='text-align:center;width:70px;height:30px;padding:2px;'>".strftime("%H:%M",$NEW_GAMES_DATAS[$i]['game_date'])."";
			$text .="<td class='forumheader3' style='text-align:center;height:30px;padding:2px;'><img border='0' style='vertical-align:middle;padding:2px;' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$NEW_GAMES_DATAS[$i]['game_home_icon']."' height='30'>  ".$NEW_GAMES_DATAS[$i]['game_home_name']." vs. ".$NEW_GAMES_DATAS[$i]['game_gast_name']." <img border='0' style='vertical-align:middle;padding:2px;' title='".LAN_LEAGUE_GAMES_ADMIN_14."' src='".e_PLUGIN."sport_league_e107/logos/".$NEW_GAMES_DATAS[$i]['game_gast_icon']."' height='30'></td>";
			$text .="<td class='forumheader3' style='text-align:center; width:80px;height:30px;padding:2px;'><b>".$NEW_GAMES_DATAS[$i]['game_goals_home'].":".$NEW_GAMES_DATAS[$i]['game_goals_gast']."</b>";
$text .="</td>";
			$text .="<td class='forumheader3' style='text-align:center; width:200px;height:30px;padding:2px;'><form method='post' action='".e_SELF."?list.".$LIGid."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$NEW_GAMES_DATAS[$i]['game_id']."'>
																				<a href='admin_game_config.php?list.".$NEW_GAMES_DATAS[$i]['game_id']."'>".$ImageCALENDER['LINK']."</a> | 
																				<a href='".e_SELF."?edit.".$LIGid.".".$NEW_GAMES_DATAS[$i]['game_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$NEW_GAMES_DATAS[$i]['game_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_GAMES_ADMIN_16." [".$NEW_GAMES_DATAS[$i]['game_id']."]')\"/></form></td></tr>";
          }
       else{continue;}
         }
if($newTerm > 0)
	{
$text .="</table></div></td></tr>";
	}
 $text .= "</table>";
	$sql -> db_Select("league_leagues", "*", " league_id='".$LIGid."' LIMIT 1");
	$row = $sql-> db_Fetch();

$configtitle ="<b>".LAN_LEAGUE_GAMES_ADMIN_1." ".$row['league_name']."</b>";
}
else{$text="";}
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
 $text .= "<div style=\"text-align:center\"><br/><br/><br/>";
 $text.=powered_by();
 $text.="</div>";
$ns -> tablerender($configtitle, $text);
//require_once(FOOTERF);
?>