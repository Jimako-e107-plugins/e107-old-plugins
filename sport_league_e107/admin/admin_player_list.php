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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_player_list.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_players_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_players_lan.php");

$lan_file2 = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_roster_lan.php";
require_once(file_exists($lan_file2) ? $lan_file2 :  e_PLUGIN."sport_league_e107/languages/German/admin_roster_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_18."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_20."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageEDIT['PFAD']."'>";

$ImagePREW['PFAD']=e_PLUGIN."sport_league_e107/images/system/search_32.png";
$ImagePREW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_19."' src='".$ImagePREW['PFAD']."'>";



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
  			$teamdata[$teamscount1]['saison_id']=$row['league_id'];
  			$teamdata[$teamscount1]['saison_name']=$row['saison_name'];
  			$teamdata[$teamscount1]['liga_name']=$row['league_name'];
  			$teamdata[$teamscount1]['team_name']=$row['team_name'];
  			$teamscount1++;
			}
$team_list2="";
for($i=0; $i < $teamscount1; $i++)
		{
		$team_list2.="".$teamdata[$i]['leagueteam_id'].":";
		$team_list2.="".$teamdata[$i]['team_name']."-(".$teamdata[$i]['saison_name']."/".$teamdata[$i]['liga_name']."~";
		}		
////////===========================================

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_PAYERS_ADMIN_7;

    $tablename = "league_players";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "players_id";   // first column of your table.
    $e_wysiwyg = "players_description,roster_description"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "admin_player";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_30;
    $fieldname[] = "players_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_31;
    $fieldname[] = "players_pass";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_32;
    $fieldname[] = "players_user_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "user~user_id~user_name"; // [table name,value-field,display-field]
    
    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_33;
    $fieldname[] = "players_admin_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "user~user_id~user_name"; // [table name,value-field,display-field]
    
    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_34;
    $fieldname[] = "players_image";
    $fieldtype[] = "image";
    $fieldvalu[] = "../fotos/";
    
    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_35;
    $fieldname[] = "players_burthday";
    $fieldtype[] = "datestamp"; // unix datestamp format.
    $fieldvalu[] = "1950~2000"; // [start-year,end-year] (optional) 
    
    $fieldcapt[] = LAN_LEAGUE_PAYERS_ADMIN_36;
    $fieldname[] = "players_description";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "~100%~250px";  // [default-text,width,height]

/////////////////////////////////////////////////////////////////////////////////////////////////////
//  roster_league_id roster_name
//  roster_player_id

    $tablename2 = "league_roster";   // becomes e107_user2 or yourprefix_user2.
    $primaryid2 = "roster_id";   // first column of your table.
    
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_2;
    $fieldname2[] = "roster_name";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_42;
    $fieldname2[] = "roster_league_id";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = "roster_player_id";
    $fieldname2[] = "roster_player_id";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";

    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_43;
    $fieldname2[] = "roster_team_id";
    $fieldtype2[] = "dropdown2";  // simple text box.
    $fieldvalu2[] = $team_list2;

    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_44;
    $fieldname2[] = "roster_status";
    $fieldtype2[] = "dropdown2";    // radio buttons
	  $fieldvalu2[] = "1:".LAN_LEAGUE_ROSTER_ADMIN_38."~2:".LAN_LEAGUE_ROSTER_ADMIN_39."~3:".LAN_LEAGUE_ROSTER_ADMIN_40.""; // [value:display-text, value2:display-text2 etc]

    $fieldcapt2[] = "roster_jersy";
    $fieldname2[] = LAN_LEAGUE_PAYERS_ADMIN_45;
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = "roster_imfeld";
    $fieldname2[] = LAN_LEAGUE_PAYERS_ADMIN_46;
    $fieldtype2[] = "checkbox";  // simple text box.
    $fieldvalu2[] = "1";   
  
    $fieldcapt2[] = LAN_LEAGUE_ROSTER_ADMIN_12;
    $fieldname2[] = "roster_position";
    $fieldtype2[] = "dropdown2";    // radio buttons
	  $fieldvalu2[] = "1:".LAN_LEAGUE_ROSTER_ADMIN_19."~2:".LAN_LEAGUE_ROSTER_ADMIN_20."~3:".LAN_LEAGUE_ROSTER_ADMIN_21."~4:".LAN_LEAGUE_ROSTER_ADMIN_22."~9:".LAN_LEAGUE_ROSTER_ADMIN_23."~10:".LAN_LEAGUE_ROSTER_ADMIN_24.""; // [value:display-text, value2:display-text2 etc]
 
    $fieldcapt2[] = LAN_LEAGUE_ROSTER_ADMIN_30;
    $fieldname2[] = "roster_description";
    $fieldtype2[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu2[] = "~100%~200px";  // [default-text,width,height]   

    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_48;
    $fieldname2[] = "roster_pref1";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_48;
    $fieldname2[] = "roster_pref2";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_48;
    $fieldname2[] = "roster_pref3";
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";

    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_47;
    $fieldname2[] = "roster_image";
    $fieldtype2[] = "image";
    $fieldvalu2[] = "../fotos/";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////----------------------------------------------
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);

	$message =delete_player($del_id);
	
	//$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list\" id=\"adminform\">
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."?list\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_ADMIN_10."' /></form></td></tr></table></div>";
	$configtitle="<b>".LAN_LEAGUE_PAYERS_ADMIN_9." ".$row['players_name']."</b>";	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
if($action == "neu")
	{
	$expand_autohide = "display:none; ";
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list\" id=\"adminform\">
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
$text .= "<tr>
						<td style='width:100%; text-align:center' class='forumheader3' colspan='2'><div style='cursor:pointer' onclick=\"expandit('exp_toteram')\"><b> >> ".LAN_LEAGUE_PAYERS_ADMIN_41." << </b> </div></td></rd>
						</table>
						<div id='exp_toteram' style='".$expand_autohide."'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>
						";

	for ($i=3; $i<count($fieldcapt2); $i++)
		{
		$form_send = $fieldcapt2[$i] . "|" .$fieldtype2[$i]."|".$fieldvalu2[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt2[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname2[$i]],$fieldname2[$i]);
		$text .="</td></tr>";
		};
$text .= "</table>
						</div>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";		
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."?list\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_ADMIN_8."' /></form></td></tr></table></div>";
		$configtitle="<b>".LAN_LEAGUE_PAYERS_ADMIN_7."</b>";

	}
////////////////////// Neu Erstellen ////////////////
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			$year = $fieldname[$i]."_year";
			$month = $fieldname[$i]."_month";
			$day = $fieldname[$i]."_day";
			if($fieldtype[$i]=="date"){
					$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
        	}else {
					$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
        	}
					} else {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
					}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
//////////////// direkt zu den Roster zufügen!!!		
if($_POST['roster_team_id']!="")
	{
		$sql -> db_Select($tablename, "*", "players_name='".$_POST['players_name']."' ORDER BY ".$primaryid." DESC LIMIT 1");
		$row = $sql-> db_Fetch();
		$NEW_ID=$row['players_id'];
		$sql -> db_Select("league_leagueteams", "*", "leagueteam_id='".$_POST['roster_team_id']."' LIMIT 1");
		$row = $sql-> db_Fetch();
		$NEW_LIG_ID=$row['leagueteam_league_id'];

		$inputstr ="";
		$count = count($fieldname2);
		for ($i=0; $i<$count; $i++) 
		  {
		  if($fieldname2[$i]=="roster_name")
		  	{
		  	$inputstr .= " '".$_POST['players_name']."'";
		  	}
		  elseif($fieldname2[$i]=="roster_player_id")
		  	{
		  	$inputstr .= " ".$NEW_ID."";	
		  	}
		  elseif($fieldname2[$i]=="roster_league_id")
		  	{
		  	$inputstr .= " ".$NEW_LIG_ID."";	
		  	}
			else {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname2[$i]])."'";
					}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		$message .= ($sql -> db_Insert($tablename2, "0, ".$inputstr." ")) ? "Spieler erfolgreich dem Team zugefügt" : "Spieler könnte dem Team nicht zugefügt werden!";	
		$message .=$inputstr;
	}	
 }
/////////////////// Aktualisierung /////////////////////////
	if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
			{
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
				$year = $fieldname[$i]."_year";
				$month = $fieldname[$i]."_month";
				$day = $fieldname[$i]."_day";
       	if($fieldtype[$i]=="date"){
             $inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
            } else {
         	$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
					}
				} else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
////////////////////////////////////////////////////////////////////////////////////
if($action == "list")
{

$first_chek=false;
$count=0;
$count2=0;
$pages=0;
$sql -> db_Select("league_players", "*", "players_id!='' ORDER BY ".$sortierung." ".$richt."");
   while($row = $sql-> db_Fetch()){
   $count++;
   $count2++;
   if($count2 == $pro_seite)
   	{
   	$count2=0;
   	$pages++;
   	}
   }
if($count!=0)
	{ 
if(!$id){$beg=0;$Seite_index=0;}else{$Seite_index=$id;$beg=$Seite_index*$pro_seite;}


if(!$_GET['ID']){$club="";}
else {$club="user_teamid =";$club.=$_GET['ID'];}
//////////////////////////////////////////////////
$seite[1]=LAN_LIQUE_156;
$seite[2]=LAN_LIQUE_157;
//////////////////////////////////////////////////
$visier[1]=LAN_LIQUE_159;
$visier[2]=LAN_LIQUE_160;
$visier[3]=LAN_LIQUE_161;
//////////////////////////////////////////////////
$VALUESLIST1[0]['Name']=LAN_LEAGUE_PAYERS_ADMIN_1; //ID
$VALUESLIST1[0]['Wert']="players_id";
$VALUESLIST1[1]['Name']=LAN_LEAGUE_PAYERS_ADMIN_2; //Name
$VALUESLIST1[1]['Wert']="players_name";
$VALUESLIST1[2]['Name']=LAN_LEAGUE_PAYERS_ADMIN_3; //User-ID
$VALUESLIST1[2]['Wert']="players_user_id";
$VALUESLIST1[3]['Name']=LAN_LEAGUE_PAYERS_ADMIN_4; // Admin-ID
$VALUESLIST1[3]['Wert']="players_admin_id";
$VALUESLIST1[4]['Name']=LAN_LEAGUE_PAYERS_ADMIN_5; //Geburtstag
$VALUESLIST1[4]['Wert']="players_burthday";
$VALUESLIST1[5]['Name']=LAN_LEAGUE_PAYERS_ADMIN_38; // Größe
$VALUESLIST1[5]['Wert']="players_pass";
//$VALUESLIST1[6]['Name']=LAN_LEAGUE_PAYERS_ADMIN_39; // Gewicht
//$VALUESLIST1[6]['Wert']="roster_pref2";
//$VALUESLIST1[7]['Name']=LAN_LEAGUE_PAYERS_ADMIN_40; // Gewicht
//$VALUESLIST1[7]['Wert'] = "roster_pref3";

//////////////////////////////////////////////////
$VALUESLIST2[0]['Name']=LAN_LEAGUE_PAYERS_ADMIN_12; //Absteigend
$VALUESLIST2[0]['Wert']="DESC";
$VALUESLIST2[1]['Name']=LAN_LEAGUE_PAYERS_ADMIN_13; // Aufsteigend
$VALUESLIST2[1]['Wert']="ASC";
//////////////////////////////////////////////////
$VALUESLIST3[0]['Name']="5";
$VALUESLIST3[0]['Wert']=5;
$VALUESLIST3[1]['Name']="10";
$VALUESLIST3[1]['Wert']=10;
$VALUESLIST3[2]['Name']="20";
$VALUESLIST3[2]['Wert']=20;
$VALUESLIST3[3]['Name']="50";
$VALUESLIST3[3]['Wert']=50;
$VALUESLIST3[4]['Name']="100";
$VALUESLIST3[4]['Wert']=100;
//////////////////////////////////////////////////
$text = "<div style='width:100%; text-align:center'>";
$text .= "
					<form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 					<a href='".e_SELF."?neu.".$id."'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_PAYERS_ADMIN_18."</div></a>
 					</form>";
$text .= navigation($Seite_index, $pages, $sortierung, $richt, $pro_seite);
$text .= "<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
					<form method='post' action='".e_SELF."?list'id='sortierung'> 	
						<tr>
							<td class='forumheader'>
								".LAN_LEAGUE_PAYERS_ADMIN_11.": 
								  <select name='sort_nach' size='1'>";
								  
								 for($i=0; $i< 7; $i++)
								 	{
								 	$text .= "<option value='".$VALUESLIST1[$i]['Wert']."'";
								 	if($VALUESLIST1[$i]['Wert']==$sortierung)
								 		{$text .= "selected";}
								 	$text .= ">".$VALUESLIST1[$i]['Name']."</option>";
								 		}
    						$text .= "</select>
							</td>
							<td class='forumheader'> ".LAN_LEAGUE_PAYERS_ADMIN_15.":
								  <select name='richtung' size='1'>";
								 for($i=0; $i< 2; $i++)
								 	{
								 	$text .= "<option value='".$VALUESLIST2[$i]['Wert']."'";
								 	if($VALUESLIST2[$i]['Wert']==$richt)
								 		{$text .= "selected";}
								 	$text .= ">".$VALUESLIST2[$i]['Name']."</option>";
								 		}
    						$text .= "</select>
							</td>
							<td class='forumheader'>".LAN_LEAGUE_PAYERS_ADMIN_14.":
								<select name='proseite' size='1'>";
								 for($i=0; $i< 5; $i++)
								 	{
								 	$text .= "<option value='".$VALUESLIST3[$i]['Wert']."'";
								 	if($VALUESLIST3[$i]['Wert']==$pro_seite)
								 		{$text .= "selected";}
								 	$text .= ">".$VALUESLIST3[$i]['Name']."</option>";
								 		}
    						$text .= "</select>
							</td>
							<td class='forumheader'>
							<input class='button' type='submit' name='edit' value='".LAN_LEAGUE_PAYERS_ADMIN_16."'/>
							</td>
						</tr></form></table>
";
 		
   $text .= "<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	 						<td>
	 							<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>				
	 								<tr>		
	 									<td class='fcaption', style='text-align:right;width:30px'><b>".LAN_LEAGUE_PAYERS_ADMIN_1."</b></td>
	 									<td class='fcaption', style='text-align:left;'><b>".LAN_LEAGUE_PAYERS_ADMIN_2."</b></td>
	 									<td class='fcaption', style='text-align:center;width:50px'><b>".LAN_LEAGUE_PAYERS_ADMIN_6."</b></td>
	 									<td class='fcaption', style='text-align:center;width:60px'><b>".LAN_LEAGUE_PAYERS_ADMIN_5."</b></td>
	 									<td class='fcaption', style='text-align:center;width:60px'><b>".LAN_LEAGUE_PAYERS_ADMIN_38."</b></td>
	 									<td class='fcaption', style='text-align:center;width:60px'><b>".LAN_LEAGUE_PAYERS_ADMIN_39."</b></td>
	 								</tr>
	 							</table>	
	 						</td>
	 					</tr>	
	 					";
     $count2=0;
     $zahler=0;
     $sql -> db_Select("league_players", "*", "players_id!='' ORDER BY ".$sortierung." ".$richt."");
         while($row = $sql-> db_Fetch()){
         $playerid[$zahler]=$row['players_id'];
         $Name[$zahler]=$row['players_name'];
         $user[$zahler]=name($row['players_user_id']);
         $user_id[$zahler]=$row['players_user_id'];
         $Admin[$zahler]=name($row['players_admin_id']);
         $Admin_id[$zahler]=$row['players_admin_id'];
         $Burtstag[$zahler]=strftime("%d.%m.%Y",$row['players_burthday']);
         $Mit_Visier[$zahler]=$visier[$row['players_visier']];
         $Spielseite[$zahler]=$seite[$row['players_site']];
         $wohnen[$zahler]=$row['players_location'];
         $Pass[$zahler]=$row['players_pass'];
         $Foto[$zahler]=$row['players_image'];
         $Beschreibung[$zahler]=$row['players_description'];
         $zahler++;
        }
    for($i=0; $i< $zahler; $i++)
        {
    		$qry1="
   			SELECT a.*, ae.*, ad.*, ab.*, ac.* FROM ".MPREFIX."league_roster AS a 
   			LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.roster_team_id
   			LEFT JOIN ".MPREFIX."league_teams AS ad ON ad.team_id=ae.leagueteam_team_id
   			LEFT JOIN ".MPREFIX."league_leagues AS ab ON ab.league_id=ae.leagueteam_league_id
   			LEFT JOIN ".MPREFIX."league_saison AS ac ON ac.saison_id=ab.league_saison_id
   			WHERE a.roster_player_id='".$playerid[$i]."' ORDER BY ac.saison_beginn ASC
   			";
				$sql->db_Select_gen($qry1);
  			while($row = $sql-> db_Fetch())
  					{
  					$Team[$i]=$row['team_name'];
  					$TeamID[$i]=$row['leagueteam_id'];
  					$Logo[$i]=$row['team_icon'];
  					$Saison[$i]=$row['saison_name'];
  					$Link[$i]=$row['team_url'];
  					$Roster[$i]=$row['roster_id'];
  					$saison_ID[$i]=$row['saison_id'];
  					$liga_ID[$i]=$row['league_id'];
  					$liga_NAME[$i]=$row['league_name'];
  					$saison_begin[$i]=$row['saison_beginn'];
  					$Roster_pref1[$i]=$row['roster_pref1'];
  					$Roster_pref2[$i]=$row['roster_pref2'];
  					$Roster_pref3[$i]=$row['roster_pref3'];
  					}
    		}
    $expand_autohide = "display:none; ";
    for($i=0; $i< $zahler; $i++)
        {
      if($i < $beg ){continue;}
      if($i >= ($beg+$pro_seite) ){break;}
      if(!($A=$i%2)){$tabform="forumheader";}else{$tabform="forumheader2";}
			$text .="<tr><td>
								<div style='cursor:pointer' onclick=\"expandit('exp_Details_".$i."')\">
									<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>				
	 									<tr>";
			$text .="<td class='".$tabform."' style='text-align:right;width:30px'>".$playerid[$i]."</td>";
			$text .="<td class='".$tabform."' style='text-align:left' >".$Name[$i]."</td>";
			$text .="<td class='".$tabform."' style='text-align:center;width:50px' ><img border='0' width=30px src='../logos/".$Logo[$i]."'></td>";
			$text .="<td class='".$tabform."' style='text-align:center;width:60px'>";
			if($Burtstag[$i]==""){$text .="<font color=red>".LAN_LIQUE_158."</font>";}
			elseif($Burtstag[$i]=="01.01.1970"){$text .="<font color=red>".$Burtstag[$i]."</font>";}
			else{$text .="<font color=green>".$Burtstag[$i]."</font>";}
			$text .="</td>";
			$text .="<td class='".$tabform."' style='text-align:center;width:60px'>".$Pass[$i]."</td>";
			$text .="<td class='".$tabform."' style='text-align:center;width:60px'>".LAN_LEAGUE_PAYERS_ADMIN_49."</td>";
			$text .="</tr></table></div></td></tr>";

			$text .="<tr><td>
								<div id='exp_Details_".$i."' style='$expand_autohide'>
									<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>				
	 									<tr>";
 			$text .="<td class='".$tabform."' style='text-align:center;border-bottom: 3px solid;'><a href=admin_player_list.php?edit.".$playerid[$i]."><img border='0' width=100px src='../fotos/".$Foto[$i]."'></a></td>";
			$text .="<td class='".$tabform."' style='text-align:left;vertical-align:top;border-bottom: 3px solid;'>
													<b>".LAN_LEAGUE_PAYERS_ADMIN_21." </b> ";
													if($user[$i]==""){$text .="<font color=red>".LAN_LEAGUE_PAYERS_ADMIN_25."</font>";}
													else{$text .="<a href='../../../user.php?id.".$user_id[$i]."'><font color=green>".$user[$i]."</font></a>";}
												 $text .="<br/>
													<b>".LAN_LEAGUE_PAYERS_ADMIN_22."</b> ";
													if($Admin[$i]==""){$text .="<font color=red>".LAN_LEAGUE_PAYERS_ADMIN_25."</font>";}
													else{$text .="<a href='../../../user.php?id.".$Admin_id[$i]."'><font color=green>".$Admin[$i]."</font></a>";}
												 $text .="<br/>
													<b>".LAN_LEAGUE_PAYERS_ADMIN_23."</b> ";
													if($Team[$i]==""){$text .="<font color=red>".LAN_LEAGUE_PAYERS_ADMIN_25."</font>";}
													else{$text .="<a href='admin_roster_config.php?list.".$TeamID[$i]."'><font color=green>".$Team[$i]."</font></a>";}
												 $text .="<br/>
													<b>".LAN_LEAGUE_PAYERS_ADMIN_24."</b> ";
													if($Saison[$i]==""){$text .="<font color=red>".LAN_LEAGUE_PAYERS_ADMIN_25."</font>";}
													elseif($saison_begin[$i]<(time()-17280000)){$text .="<a href='admin_tleague_config.php?list.".$saison_ID[$i]."'><font color=yellow>".$Saison[$i]."</font></a>";}
													else{$text .="<a href='admin_tleague_config.php?list.".$saison_ID[$i]."'><font color=green>".$Saison[$i]."</font></a>";}
												 $text .="<b>".LAN_LEAGUE_PAYERS_ADMIN_27."</b> ( ".$liga_NAME[$i]." )<br/>
											</td><td class='".$tabform."' style='width:30%;border-bottom: 3px solid;'>".$inhalt=$tp->toHTML($Beschreibung[$i],TRUE)."</td>";
			$text .="<td class='".$tabform."' style='border-bottom: 3px solid;text-align:center;width:129px'>
								<form method='post' action='".e_SELF."?list.".$id."' id='editform_".$playerid[$i]."'>
								<input type='hidden' name='T_ID' value='".$playerid[$i]."'>
								<a href='".e_SELF."?edit.".$playerid[$i]."'>".$ImageEDIT['LINK']."</a> |
								<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$playerid[$i]}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('Soll dieser Spieler gelöscht werden? [".$Name[$i]."]')\"/> | 
								<a href='profil.php?player_id=".$Roster[$i]."' title='".LAN_LIQUE_294."'>".$ImagePREW['LINK']."</a> </form>
			</td>";
      $text .="</tr></table></div></td></tr>";
         }
      $text .= "</table></div>";
$text .= navigation($Seite_index, $pages, $sortierung, $richt, $pro_seite);
}
else{
$text ="<div style='width:100%; text-align: center;'><br/><br/>".LAN_LEAGUE_PAYERS_ADMIN_26."<br/><br/>
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.".$id."'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_PAYERS_ADMIN_18."</div></a>
 </form>
</form></div>";
	}
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
///////-----------------------------------------------
function navigation($A, $B, $C, $D, $E)
{

$text2 = "<div style='width:100%; text-align: center;'><br/><br/>";

if($A > 0){$j=($A-1);
  	$text2 .="<a href='".e_SELF."?list.".$j.".".$C.".".$D.".".$E."'><<</a>  ";
  }
for($i=0; $i<= $B; $i++)
  {
	if($i==$A){
  		$text2 .="[".$i."]";
  		}
  else{
 			$text2 .="<a href='".e_SELF."?list.".$i.".".$C.".".$D.".".$E."'>".$i."</a>  ";
  		}
  }
if($A != $B){$j=$A+1;
	$text2 .="<a href='".e_SELF."?list.".$j.".".$C.".".$D.".".$E."'>>></a>";
	}  		
$text2 .="<br/><br/></div>"; 

return $text2;
}

?>