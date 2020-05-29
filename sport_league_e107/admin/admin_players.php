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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_players.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 11:58 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_players_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_players_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_18."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_20."' src='".$ImageDELETE['PFAD']."'>";

$ImageUPDATET['PFAD']=e_PLUGIN."sport_league_e107/images/system/check.png";
$ImageUPDATET['LINK']="<div style='border: #009900 1px solid;color:#009900;background:#dfffdf;padding:10px;text-align:left;'>
<img border='0' style='vertical-align: middle;flit:left;' title='' src='".$ImageUPDATET['PFAD']."'>";

$ImageERROR['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageERROR['LINK']="<div style='border: #BB4444 1px solid;color:#BB4444;background:#ffcccc;padding:10px;text-align:left;'>
<img border='0' style='vertical-align: middle;flit:left;' title='' src='".$ImageERROR['PFAD']."'>";



$pageid = "admin_player";




if (e_QUERY) {
	list($action,$from) = explode(".", e_QUERY);
	$from = intval($from);
	unset($tmp);
}
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
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_PAYERS_ADMIN_7;

    $tablename = "league_players";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "players_id";   // first column of your table.
    $e_wysiwyg = "players_description,roster_description"; // commas seperated list of textareas to use wysiwyg with.

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
	  $fieldvalu2[] = "1:".LAN_LEAGUE_PAYERS_ADMIN_21."~2:".LAN_LEAGUE_PAYERS_ADMIN_22."~3:".LAN_LEAGUE_PAYERS_ADMIN_23.""; // [value:display-text, value2:display-text2 etc]

    $fieldcapt2[] = "roster_jersy";
    $fieldname2[] = LAN_LEAGUE_PAYERS_ADMIN_45;
    $fieldtype2[] = "text";  // simple text box.
    $fieldvalu2[] = "";
    
    $fieldcapt2[] = "roster_imfeld";
    $fieldname2[] = LAN_LEAGUE_PAYERS_ADMIN_46;
    $fieldtype2[] = "checkbox";  // simple text box.
    $fieldvalu2[] = "1";   
  
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_3;
    $fieldname2[] = "roster_position";
    $fieldtype2[] = "dropdown2";    // radio buttons
	  $fieldvalu2[] = "1:".LAN_LEAGUE_PAYERS_ADMIN_10."~2:".LAN_LEAGUE_PAYERS_ADMIN_11."~3:".LAN_LEAGUE_PAYERS_ADMIN_12."~4:".LAN_LEAGUE_PAYERS_ADMIN_13."~9:".LAN_LEAGUE_PAYERS_ADMIN_14."~10:".LAN_LEAGUE_PAYERS_ADMIN_15."~11:".LAN_LEAGUE_PAYERS_ADMIN_16.""; // [value:display-text, value2:display-text2 etc]
 
    $fieldcapt2[] = LAN_LEAGUE_PAYERS_ADMIN_19;
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
////++++++++++++++++++
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
/////////////////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message =delete_player($del_id);
}
///////////////////////////////////////////
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
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? $ImageUPDATET['LINK'].LAN_CREATED."</div>" : $ImageERROR['LINK'].LAN_CREATED_FAILED."</div>" ;
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
		$message .= ($sql -> db_Insert($tablename2, "0, ".$inputstr." ")) ? $ImageUPDATET['LINK'].LAN_LEAGUE_PAYERS_ADMIN_57."" : $ImageERROR['LINK'].LAN_LEAGUE_PAYERS_ADMIN_58."";	
		$message .=$inputstr."</div><br/>";
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
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? $ImageUPDATET['LINK'].LAN_UPDATED."</div>": $ImageERROR['LINK'].LAN_UPDATED_FAILED."</div>" ;
	}
/////////////////////////////////////
if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
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
////////////////// Datensatz Bearbeiten //////////////////////
elseif ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$from."' ");
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."?list\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_ADMIN_8."' /></form></td></tr></table></div>";
	$configtitle="<b>".LAN_LEAGUE_PAYERS_ADMIN_9." ".$row['players_name']."</b>";	
	}
//////////////////////////////////////
elseif($action == "POG")
	{
$personenlist = get_personenlist();
$pers_no_burtday=get_personen_no_burtday($personenlist);
$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";
$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_59."(".$pers_no_burtday.")                  ";
if($pers_no_burtday < $from+200){$bis=$pers_no_burtday;}else{$bis=$from+200;}
if($pers_no_burtday < $from+100){$aktuell=$pers_no_burtday;}else{$aktuell=$from+100;}

$text .= nav_links("POG",$from,$pers_no_burtday,$aktuell,$bis);
$text .= "</h3>";
$text .=get_personenlist_no_burtday($personenlist,$pers_no_burtday,$from);
$text .= "";
$text .= "</td></tr>";
$text .= "<tr><td class='fcaption' style='font-size:20px;color:#f00;text-align:center;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<a href='".e_SELF."'>".LAN_LEAGUE_PAYERS_ADMIN_61."</a>";
$text .= "</td></tr>";
$text .= "</table>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
	}
//////////////////////////////////////
elseif($action == "POF")
	{
$personenlist = get_personenlist();
$pers_no_img=get_personen_no_img($personenlist);
$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";
$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_62."(".$pers_no_img.")                         ";
if($pers_no_img < $from+200){$bis=$pers_no_img;}else{$bis=$from+200;}
if($pers_no_img < $from+100){$aktuell=$pers_no_img;}else{$aktuell=$from+100;}

$text .= nav_links("POF",$from,$pers_no_img,$aktuell,$bis);

$text .= "</h3>";
$text .=get_personenlist_no_img($personenlist,$pers_no_img,$from);
$text .= "";
$text .= "</td></tr>";
$text .= "<tr><td class='fcaption' style='font-size:20px;color:#f00;text-align:center;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<a href='".e_SELF."'>".LAN_LEAGUE_PAYERS_ADMIN_61."</a>";
$text .= "</td></tr>";
$text .= "</table>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
	}
//////////////////////////////////////
elseif($action == "PMF")
	{
$personenlist = get_personenlist();
$pers_wit_img=get_personen_wit_img($personenlist);
$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";
$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_63." (".$pers_wit_img.")                         ";
if($pers_wit_img < $from+200){$bis=$pers_wit_img;}else{$bis=$from+200;}
if($pers_wit_img < $from+100){$aktuell=$pers_wit_img;}else{$aktuell=$from+100;}

$text .= nav_links("PMF",$from,$pers_wit_img,$aktuell,$bis);

$text .= "</h3>";
$text .=get_personenlist_wit_img($personenlist,$pers_wit_img,$from);
$text .= "";
$text .= "</td></tr>";
$text .= "<tr><td class='fcaption' style='font-size:20px;color:#f00;text-align:center;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<a href='".e_SELF."'>".LAN_LEAGUE_PAYERS_ADMIN_61."</a>";
$text .= "</td></tr>";
$text .= "</table>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
	}
//////////////////////////////////////
else
{
$text = "<div style='text-align:center'><br/>";

$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";
            
$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>

<table class='' style='width:100%'>
<tr><td rowspan='4' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
		<h3>".LAN_LEAGUE_PAYERS_ADMIN_64."</h3><br/>".LAN_LEAGUE_PAYERS_ADMIN_65."<b>";

$personenlist = get_personenlist();
$text .=count($personenlist);
$text .="</b><br/>";

$pers_no_burtday=get_personen_no_burtday($personenlist);
$pers_no_img=get_personen_no_img($personenlist);
$pers_wit_img=get_personen_wit_img($personenlist);
$double=get_double_personen($personenlist);
$pers_no_team=get_personen_no_team($personenlist);

if($pers_no_burtday == 0)
	{$text .="<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check_12.png'>";}	
	else{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>";}
$text .= "<a href='".e_SELF."?POG'>".LAN_LEAGUE_PAYERS_ADMIN_66."<b>".$pers_no_burtday."</b></a><br/>";

if($pers_no_img == 0)
	{$text .="<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check_12.png'>";}	
	else{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>";}
$text .= "<a href='".e_SELF."?POF'>".LAN_LEAGUE_PAYERS_ADMIN_67."<b>".$pers_no_img."</b></a><br/>";

if($pers_wit_img != 0)
	{$text .="<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check_12.png'>";}	
	else{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>";}
$text .= "<a href='".e_SELF."?PMF'>".LAN_LEAGUE_PAYERS_ADMIN_68."<b>".$pers_wit_img."</b></a><br/>";


$DUPLE=count($double);
if($DUPLE==0)
	{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check_12.png'>";}
	else{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>";}
$text .= "".LAN_LEAGUE_PAYERS_ADMIN_60.": <b>";
$text .=$DUPLE."</b><br/>";

if($pers_no_team == 0)
	{$text .="<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check_12.png'>";}	
	else{$text .= "<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>";}
$text .= "".LAN_LEAGUE_PAYERS_ADMIN_83." <b>".$pers_no_team."</b><br/>";

$expand_autohide = "display:none; ";
$text .= "</b>
</td>
<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
	<form method='post' action='admin_player.php' id='search_plaer'>
		<input class='tbox' type='text' name='player_name' size='40' value='".$_POST['player_name']."' maxlength='150'/>
		<input class='button' type='submit' id='search_player' name='search_player' value='".LAN_LEAGUE_PAYERS_ADMIN_77."' />
	</form>
</td>
</tr>
<tr>
		<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
			<div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 				<a href='".e_SELF."?neu'>".$ImageNEW['LINK']."
 					".LAN_LEAGUE_PAYERS_ADMIN_18."
 				</a>
 			</div>
		</td>
</tr>
<tr>
<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>

<div style='cursor:pointer;font-size: 14px;color:#00b42a;font-weight: bold;text-align: center' onclick=\"expandit('exp_import')\">
".LAN_LEAGUE_PAYERS_ADMIN_69."
</div>
<div id='exp_import' style='$expand_autohide'><br/>
<form method='post' action='admin_players_import.php' id='textinput'>
<input class='button' style='vertical-align: left;' type='submit' id='t_input' name='t_input' value='".LAN_LEAGUE_PAYERS_ADMIN_70."' />
</form>
<br/>
</div>
</td>
</tr>
<tr>
<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
<a href='admin_player_list.php?list'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/plaerslist.png'>  ".LAN_LEAGUE_PAYERS_ADMIN_71."</a>
</td>
</tr>
</table>
</td></tr>";

$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_59."(".$pers_no_burtday.")</h3>";
$text .=get_personenlist_no_burtday($personenlist,50,0);
$text .= "";
$text .= "</td></tr>";

$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_60."</h3>";
$text .=get_double_list($double);
$text .= "";
$text .= "</td></tr>";

$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_72." (".$pers_wit_img.")</h3>";
$text .=get_personenlist_wit_img($personenlist,50,0);
$text .= "";
$text .= "</td></tr>";

$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<h3>".LAN_LEAGUE_PAYERS_ADMIN_62."(".$pers_no_img.")</h3>";
$text .=get_personenlist_no_img($personenlist,50,0);
$text .= "";
$text .= "</td></tr>";
$text .= "</table>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
}
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");

///////-----------------------------------------------
///////-----------------------------------------------

////////////////////////////////////////////////////////
function get_personenlist()
{
global 	$sql;
$sql->db_Select("league_players", "*", "players_name!=''");
	while($row = $sql-> db_Fetch()){
		$personenlist[]=$row;
		}
return $personenlist;

}
//////////////////////////////////////////////////////////
function get_personen_no_burtday($personenlist)
{
$AUSGABE=0;	
$personen_count=count($personenlist);
for($i=0; $i< $personen_count; $i++)
		{
		if(!$personenlist[$i]['players_burthday'] || $personenlist[$i]['players_burthday']==0 || $personenlist[$i]['players_burthday']=="-3600" || $personenlist[$i]['players_burthday']=="-1")
			{
			$AUSGABE++;	
			}
		}
return $AUSGABE;
}

//////////////////////////////////////////////////////////
function get_personen_no_img($personenlist)
{
$AUSGABE=0;	
$personen_count=count($personenlist);
for($i=0; $i< $personen_count; $i++)
		{
		if(!$personenlist[$i]['players_image'] || $personenlist[$i]['players_image']=="default.jpg")
			{
			$AUSGABE++;	
			}
		}
return $AUSGABE;
}
//////////////////////////////////////////////////////////
function get_personen_wit_img($personenlist)
{
$AUSGABE=0;	
$personen_count=count($personenlist);
for($i=0; $i< $personen_count; $i++)
		{
		if($personenlist[$i]['players_image'] && $personenlist[$i]['players_image']!="default.jpg")
			{
			$AUSGABE++;	
			}
		}
return $AUSGABE;
}
//////////////////////////////////////////////////////////
function get_personen_no_team($personenlist)
{
$AUSGABE=0;
$personen_count=count($personenlist);
for($i=0; $i< $personen_count; $i++)
		{
		$Saisons = get_saisons_count($personenlist[$i]['players_id']);
		if($Saisons < 1){$AUSGABE++;}
		}
return $AUSGABE;
}
//////////////////////////////////////////////////////////
function get_double_personen($personenlist)
{
$k=0;
$AUSGABE=0;
$flag=false;
$personen_count=count($personenlist);
for($i=0; $i< $personen_count-1; $i++)
		{$flag=false;
		$pers[$k]['namens']=$personenlist[$i]['players_name'];
		$pers[$k]['ids']=$personenlist[$i]['players_id'];
		for($j=$i+1; $j< $personen_count; $j++)
			{
			if($personenlist[$i]['players_name']==$personenlist[$j]['players_name'] && $personenlist[$j]['players_name']!="")
				{
				$pers[$k]['namens'].=";".$personenlist[$j]['players_name'];
				$pers[$k]['ids'].=";".$personenlist[$j]['players_id'];
				$flag = true;
				$personenlist[$j]['players_name']="";
				}
			}
		if($flag){$k++;}else{$pers[$k]['namens']=false;$pers[$k]['ids']=false;}
		}
unset($pers[$k]);
return $pers;
}
//////////////////////////////////////////////////////////
function get_double_list($double)
{
$countf =count($double);
$AUSGABE="";
for($i=0; $i< $countf; $i++ )
	{
	$tmp1=explode(";", $double[$i]['namens']);
	$tmp2=explode(";", $double[$i]['ids']);	
  $duplicate1=count($tmp1);
	for($k=0; $k< $duplicate1; $k++ )
			{
			$roster=get_roster_id($tmp2[$k]);
				//$roster['count'];
				//$roster['id']; 
			$AUSGABE .="<a href='admin_double_players.php?.".$tmp2[$k]."'>".$tmp2[$k]."-".$tmp1[$k]."</a> <i>(".LAN_LEAGUE_PAYERS_ADMIN_73." <b>".$roster['count']."</b>x ".LAN_LEAGUE_PAYERS_ADMIN_74." ".LAN_LEAGUE_PAYERS_ADMIN_75."<b>".$roster['id'].")</b></i>, ";	
			}
	$AUSGABE .="<br/>";

	}
if($countf==0)
	{
	$AUSGABE .="<br/><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/check.png'>".LAN_LEAGUE_PAYERS_ADMIN_76."<br/>";	
		
	}

return $AUSGABE;

}
//////////////////////////////////////////////////////////
function  get_personenlist_wit_img($personenlist,$menge,$from)
{
if($menge == 0){$menge=99999;}
$AUSGABE="";
$personen_count=count($personenlist);
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_12.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Delete' src='".$ImageDELETE['PFAD']."'>";
$count=$personen_count;
$personen_count2=0;
$AUSGABE.="<div>";
for($i=0; $i< $count; $i++)
		{
		if($personenlist[$i]['players_image'] && $personenlist[$i]['players_image']!="default.jpg")
			{
			$personen_count2++;	
			if($personen_count2 < ($menge+1))
				{
			if($personen_count2 < $from || $personen_count2 > ($from+100)){continue;}
			
			$sekond_ing=get_sek_img($personenlist[$i]['players_id']);
			$bg=get_personenlist_bg($personenlist[$i]['players_id']);
			$F_size = getimagesize("../fotos/".$personenlist[$i]['players_image']);
			$Im_size= "<b>".$F_size[0]."</b>x<b>".$F_size[1]."</b>px";
			$team_logo=get_saisons_teams_img($personenlist[$i]['players_id']);
			$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:100px;vertical-align:top;text-align:left;padding:3px;background:#AAA ".$bg.";margin:4px;'>";
			$AUSGABE.="<form method='post' action='".e_SELF."' id='editform_".$personenlist[$i]['players_id']."'>
									<input type='hidden' name='T_ID' value='".$personenlist[$i]['players_id']."'>
									<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_54." [".$personenlist[$i]['players_name']."]')\"/>
									</form>";
			$AUSGABE.="<a target='_blank' href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'><img src='../fotos/".$personenlist[$i]['players_image']."' style='width:40px;float:left;margin:3px;'></a><b><a target='_blank' href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'>".$personenlist[$i]['players_name']."</a></b><br/>(".(chek_burtday($personenlist[$i]['players_burthday'], "%d.%m.%Y")).")<br/> ".LAN_LEAGUE_PAYERS_ADMIN_53.":<b>".$sekond_ing."</b><br/>".$Im_size." <br/>".$team_logo."";	
			$AUSGABE.="</div>";
				}
			else{continue;}	
			}
		}
$AUSGABE.="</div><br/>";
if ($personen_count2 > $menge)
{$AUSGABE.="<br/><br/><b>".LAN_LEAGUE_PAYERS_ADMIN_78."".($personen_count2-$menge)."".LAN_LEAGUE_PAYERS_ADMIN_79."<a href='".e_SELF."?PMF'>.. ALLE ZEIGEN</a></b>";}
return $AUSGABE;	
}
//////////////////////////////////////////////////////////	
function  get_personenlist_no_img($personenlist,$menge,$from)
{
if($menge == 0){$menge=99999;}
$AUSGABE="";	
$personen_count=count($personenlist);
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_12.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Delete' src='".$ImageDELETE['PFAD']."'>";
$count=$personen_count;
$personen_count2=0;
$AUSGABE.="<div>";
for($i=0; $i< $count; $i++)
		{
		if(!$personenlist[$i]['players_image'] || $personenlist[$i]['players_image']=="default.jpg")
			{
			$personen_count2++;	
			if($personen_count2 < ($menge+1))
				{
			if($personen_count2 < $from || $personen_count2 > ($from+100)){continue;}
			
			$team_logo=get_saisons_teams_img($personenlist[$i]['players_id']);
			$bg=get_personenlist_bg($personenlist[$i]['players_id']);	
			$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:90px;text-align:left;padding:3px;background:#AAA ".$bg.";margin:4px;'>";
			$AUSGABE.="<form method='post' action='".e_SELF."?list' id='editform_".$personenlist[$i]['players_id']."'>
									<input type='hidden' name='T_ID' value='".$personenlist[$i]['players_id']."'>
									<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_54." [".$personenlist[$i]['players_name']."]')\"/>
									</form>";			
			
			$AUSGABE.="<a href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'><b>".$personenlist[$i]['players_name']."</b></a>
			<br/>(".(chek_burtday($personenlist[$i]['players_burthday'], "%d.%m.%Y")).")  <br/>".$team_logo."";	
			$AUSGABE.="</div>";
				}
			else{continue;}	
			}
		}
$AUSGABE.="</div><br/>";
if ($personen_count2 > $menge)
{$AUSGABE.="<br/><br/><b>".LAN_LEAGUE_PAYERS_ADMIN_78."".($personen_count2-$menge)."".LAN_LEAGUE_PAYERS_ADMIN_79."<a href='".e_SELF."?POF'>".LAN_LEAGUE_PAYERS_ADMIN_80."</a></b>";}
return $AUSGABE;	
}
//////////////////////////////////////////////////////////	
function  get_personenlist_no_burtday($personenlist,$menge,$from)
{
if($menge==0){$menge=9999;}
$AUSGABE="";
$personen_count=count($personenlist);
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_12.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Delete' src='".$ImageDELETE['PFAD']."'>";
$count=$personen_count;
$personen_count2=0;
$AUSGABE.="<div>";
for($i=0; $i< $count; $i++)
		{
		if(!$personenlist[$i]['players_burthday'] || $personenlist[$i]['players_burthday']==0 || $personenlist[$i]['players_burthday']=="-3600" || $personenlist[$i]['players_burthday']=="-1")
			{
			$personen_count2++;	
			if($personen_count2 < ($menge+1))
				{
			if($personen_count2 < $from || $personen_count2 > ($from+100)){continue;}
								
			$bg=get_personenlist_bg($personenlist[$i]['players_id']);	
			if($personenlist[$i]['players_image'] && $personenlist[$i]['players_image']!="default.jpg")
				{
				$sekond_ing=get_sek_img($personenlist[$i]['players_id']);
				$F_size = getimagesize("../fotos/".$personenlist[$i]['players_image']);
				$Im_size= "<b>".$F_size[0]."</b> x <b>".$F_size[1]."</b> px";		
				$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:90px;vertical-align:top;text-align:left;padding:3px;background:#AAA ".$bg.";margin:2px;'>";
				$AUSGABE.="<form method='post' action='".e_SELF."?list' id='editform_".$personenlist[$i]['players_id']."'>
									<input type='hidden' name='T_ID' value='".$personenlist[$i]['players_id']."'>
									<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_54." [".$personenlist[$i]['players_name']."]')\"/>
									</form>";
				
				$AUSGABE.="<a target='_blank' href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'>
				<img src='../fotos/".$personenlist[$i]['players_image']."' style='width:40px;float:left;margin:3px;'>
				</a>
				<b><a target='_blank' href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'>".$personenlist[$i]['players_name']."</a></b>
				<br/>";	
				$AUSGABE.=get_saisons_teams_img($personenlist[$i]['players_id']);
				}	
			else{	
			$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:90px;text-align:left;padding:3px;background:#AAA ".$bg.";margin:2px;'>";
			$AUSGABE.="<form method='post' action='".e_SELF."?list' id='editform_".$personenlist[$i]['players_id']."'>
									<input type='hidden' name='T_ID' value='".$personenlist[$i]['players_id']."'>
									<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_54." [".$personenlist[$i]['players_name']."]')\"/>
									</form>";			
						
			$AUSGABE.="<a href='".e_SELF."?edit.".$personenlist[$i]['players_id']."'>
			<b>".$personenlist[$i]['players_name']."</b></a>
			<br/>";
			$AUSGABE.=get_saisons_teams_img($personenlist[$i]['players_id']);
				}
		$AUSGABE.="</div>";
				}
				else{continue;}
			}
		}
$AUSGABE.="</div>";
if ($personen_count2 > $menge)
{$AUSGABE.="<br/><br/><b>".LAN_LEAGUE_PAYERS_ADMIN_78."".($personen_count2-$menge)."".LAN_LEAGUE_PAYERS_ADMIN_79."<a href='".e_SELF."?POG'>".LAN_LEAGUE_PAYERS_ADMIN_80."</a></b>";}
return $AUSGABE;	
}
//////////////////////////////////////////////////////////	
function get_roster_id($person)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   WHERE a.roster_player_id='".$person."' ORDER BY d.saison_order, c.league_id DESC
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
      $AUSGABE['id']=$row['roster_id'];
      $e++;
			}
$AUSGABE['count']=$e;
return   $AUSGABE;
}
////////////////////////////////////
function get_sek_img($id)
{
$pers_sek_img=0;
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' AND roster_image!=''");
	while($row = $sql-> db_Fetch()){
		$pers_sek_img++;
		}
return $pers_sek_img;	
}
//////////////////////////////////////
function get_pers_img_data($id)
{
$pers_sek_img="";
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' AND roster_image!=''");
	while($row = $sql-> db_Fetch()){
		$pers_sek_img.="<a target='_blank' href='admin_roster_config.php?edit.".$row['roster_id'].".".$row['roster_team_id']."' ><img src='../fotos/".$row['roster_image']."' style='width:20px;'></a>";
		}
return $pers_sek_img;	
}
//////////////////////////////////////
function get_saisons_teams_img($id)
{
$expand_autohide = "display:none; ";
global $sql;
$AUSGABE="";
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.*, e.*, f.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   LEFT JOIN ".MPREFIX."league_teams AS e ON e.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_players AS f ON f.players_id=a.roster_player_id
   WHERE a.roster_player_id='".$id."' ORDER BY d.saison_order DESC, c.league_id
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
      $datas[$e]=$row;
      $e++;
			}
if($e < 1)
	{
	$AUSGABE.="<div style='font-weight:bold;font-size:10px;color:#f00;text-align:center;border:2px #f00 solid;background:#fcc;padding:5px;'>".LAN_LEAGUE_PAYERS_ADMIN_81."</div>";
	}
else{
	if($e > 3)
		{
		for($i=0; $i< 3; $i++)
			{
			$AUSGABE.="<a target='_blank' href='../roster.php?team=".$datas[$i]['roster_team_id']."'><img border='0' style='vertical-align: middle' title='".$datas[$i]['league_name'].", ".$datas[$i]['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_55."(".$datas[$i]['team_name'].")' src='".e_PLUGIN."sport_league_e107/logos/".$datas[$i]['team_icon']."' width='30' /></a>";
			}
		$AUSGABE.="<br/><div style='cursor:pointer;font-size: 10px;color:#f00;font-weight: bold;text-align: center' onclick=\"expandit('exp_allsteams_".$id."')\">";
		$AUSGABE.="".LAN_LEAGUE_PAYERS_ADMIN_82."</div>";
		$AUSGABE.="<div id='exp_allsteams_".$id."' style='$expand_autohide'><br/>";
		for($i=3; $i< $e; $i++)
			{
			$AUSGABE.="<a target='_blank' href='../roster.php?team=".$datas[$i]['roster_team_id']."'><img border='0' style='vertical-align: middle' title='".$datas[$i]['league_name'].", ".$datas[$i]['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_55."(".$datas[$i]['team_name'].")' src='".e_PLUGIN."sport_league_e107/logos/".$datas[$i]['team_icon']."' width='30' /></a>";
			}
		$AUSGABE.="</div>";
		}
	else{
			for($i=0; $i< $e; $i++)
			{
			$AUSGABE.="<a target='_blank' href='../roster.php?team=".$datas[$i]['roster_team_id']."'><img border='0' style='vertical-align: middle' title='".$datas[$i]['league_name'].", ".$datas[$i]['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_55."(".$datas[$i]['team_name'].")' src='".e_PLUGIN."sport_league_e107/logos/".$datas[$i]['team_icon']."' width='30' /></a>";
			}
		}
	}
return $AUSGABE;
}
//////////////////////////////////////



/////////////////////////////////////
function get_saisons_count($id)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   WHERE a.roster_player_id='".$id."' ORDER BY d.saison_order, c.league_id DESC
   		";
	$sql->db_Select_gen($qry1);
	  while($row = $sql-> db_Fetch())
  		{
      $e++;
			}
return   $e;
}
///////////////////////////////////////////
function get_one_teams_img($id)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.*, e.*, f.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   LEFT JOIN ".MPREFIX."league_teams AS e ON e.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_players AS f ON f.players_id=a.roster_player_id
   WHERE a.roster_player_id='".$id."' ORDER BY d.saison_order DESC, c.league_id LIMIT 1
   		";
	$sql->db_Select_gen($qry1);
	$row = $sql-> db_Fetch();
$AUSGABE.="<a target='_blank' href='../roster.php?team=".$row['roster_team_id']."'><img border='0' style='vertical-align: middle' title='".$row['league_name'].", ".$row['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_55."(".$row['team_name'].")' src='".e_PLUGIN."sport_league_e107/logos/".$row['team_icon']."' width='30' /></a>";
return $AUSGABE;
}
//////////////////////
function chek_burtday($value, $format)
{
if(!$format){$format="%d.%m.%Y";}
if(!$value || $value==0 || $value=="-3600" || $value=="-1"){return "<span style='color:#f00;'>".LAN_LEAGUE_PAYERS_ADMIN_56."</span>";}
else{return "<span style='color:#006600;'>".(strftime($format,$value))."</span>";}
}
/////////////////////////////
function  get_personenlist_bg($id)
{

$pers_sek_img="";
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' ORDER BY roster_league_id LIMIT 1");
	$row = $sql-> db_Fetch();

switch ($row['roster_position']) {
	case "1":
  return "url(../images/tw.jpg) no-repeat; background-position:right";
	break;
///-------
	case "2":
  return "url(../images/vt.jpg) no-repeat; background-position:right";
	break;
///-------
	case "3":
  return "url(../images/st.jpg) no-repeat; background-position:right";
	break;
///-------
	case "9":
  return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
///-------
	case "10":
   return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
///-------
	case "11":
   return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
		
	default:
  return " ";
	break;
	}
}
function nav_links($Art,$from,$summe,$aktuell,$bis)
{
$AUSGABE="";	
$letzte_seite=$summe-($summe%100);
if($from!=0)
	{
		$AUSGABE .= "
		<a href='".e_SELF."?".$Art.".0' style='color:#A77;font-size:70%;'><img border='0' style='vertical-align: middle' title='zur erste Seite' src='".e_PLUGIN."sport_league_e107/images/system/Right2.png'></a>
		<a href='".e_SELF."?".$Art.".".($from-100)."' style='color:#A77;font-size:70%;'><img border='0' style='vertical-align: middle' title='(".($from-100)."-".($from-1).")' src='".e_PLUGIN."sport_league_e107/images/system/Right.png'></a>
		
		";
	}
$AUSGABE .= "   <font style='font-size:70%;color;#666; '>(".($from)."-".($aktuell).")</font>    ";
if($summe > ($from+100))
	{
		$AUSGABE .= "<a href='".e_SELF."?".$Art.".".($from+100)."' style='color:#A77;font-size:70%;'><img border='0' style='vertical-align: middle' title='(".($from+101)."-".$bis.")' src='".e_PLUGIN."sport_league_e107/images/system/Left.png'></a>
		<a href='".e_SELF."?".$Art.".".$letzte_seite."' style='color:#A77;font-size:70%;'><img border='0' style='vertical-align: middle' title='Zur letzte Seite' src='".e_PLUGIN."sport_league_e107/images/system/Left2.png'></a>
		";
	}
return 	$AUSGABE;
}
?>