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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_league_config.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_league_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_league_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_LEAGUE_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_LEAGUE_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_LEAGUE_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$ImageCALENDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/termine.png";
$ImageCALENDER['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_LEAGUE_ADMIN_21."' src='".$ImageCALENDER['PFAD']."'>";

$ImageTEAMS['PFAD']=e_PLUGIN."sport_league_e107/images/system/teams.png";
$ImageTEAMS['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_LEAGUE_ADMIN_13."' src='".$ImageTEAMS['PFAD']."'>";


if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}

/////===========================================================================
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_LEAGUE_ADMIN_1;

    $tablename = "league_leagues";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "league_id";   // first column of your table.
    $e_wysiwyg = "league_description"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "admin_league";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_2;
    $fieldname[] = "league_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_3;
    $fieldname[] = "league_saison_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "league_saison~saison_id~saison_name"; // [table name,value-field,display-field]
    
    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_5;
    $fieldname[] = "league_description";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "~100%~250px";  // [default-text,width,height]


//////////////////////////////////////////////////////////
    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_4;
    $fieldname[] = "league_pref1";
    $fieldtype[] = "dropdown2";  // simple text box.
    $fieldvalu[] = "1:".LAN_LEAGUE_LEAGUE_ADMIN_22."~2:".LAN_LEAGUE_LEAGUE_ADMIN_23."~3:".LAN_LEAGUE_LEAGUE_ADMIN_24."";
    
    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_6;
    $fieldname[] = "league_pref2";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_7;
    $fieldname[] = "league_pref3";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_LEAGUE_LEAGUE_ADMIN_7;
    $fieldname[] = "league_pref4";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

require_once(e_ADMIN."auth.php");
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
////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_LEAGUE_ADMIN_10."' /></form></td></tr></table></div>";
	
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
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
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_LEAGUE_ADMIN_19."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_LEAGUE_LEAGUE_ADMIN_20."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
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
///////////////////////////Tabelle mit vorhandenen Ligen zeigen. Ersmal Überschrift...///////////////
 $text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_LEAGUE_ADMIN_14."</div></a>
 </form>
 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center;width:5%'>".LAN_LEAGUE_LEAGUE_ADMIN_8."</td>
	 	<td class='fcaption' style='text-align:left'>".LAN_LEAGUE_LEAGUE_ADMIN_9."</td>
		<td class='fcaption' style='text-align:center;width:30%'>".LAN_LEAGUE_LEAGUE_ADMIN_12."</td>
		<td class='fcaption' style='text-align:center;width:10%'>".LAN_LEAGUE_LEAGUE_ADMIN_11."</td>
		<td class='fcaption' style='text-align:center;width:25%'>".LAN_LEAGUE_LEAGUE_ADMIN_15."</td>
	</tr>";

$LIEAGUEPREAF1[0]="";
$LIEAGUEPREAF1[1]=LAN_LEAGUE_LEAGUE_ADMIN_22;
$LIEAGUEPREAF1[2]=LAN_LEAGUE_LEAGUE_ADMIN_23;
$LIEAGUEPREAF1[3]=LAN_LEAGUE_LEAGUE_ADMIN_24;
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id
   WHERE a.league_name !='' ORDER BY ae.saison_order DESC
   		";
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch()){
	 		$description =  $tp->html_truncate($tp->toHTML($row['league_description'], TRUE), 100, "...");	
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$row['league_id']."</td>";
			$text .="<td class='forumheader3'>".$row['league_name']."-(".$row['saison_name'].")</td>";
			$text .="<td class='forumheader3'>".$description."</td>";
			$text .="<td class='forumheader3'>".$LIEAGUEPREAF1[$row['league_pref1']]."</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row['league_id']."'>
																				<a href='admin_tleague_config.php?list.".$row['league_id']."'>".$ImageTEAMS['LINK']."</a> | 
																				<a href='admin_games_config.php?list.".$row['league_id']."'>".$ImageCALENDER['LINK']."</a> | 
																				<a href='".e_SELF."?edit.".$row['league_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$row['league_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_LEAGUE_ADMIN_16." [".$row['league_name']."]')\"/></form></td></tr>";
         }
 $text .= "</table>";
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
