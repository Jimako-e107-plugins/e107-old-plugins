<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_player_data_config.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 13:07 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_player_data_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_player_data_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SD_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SD_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SD_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$ImageSORT1['PFAD']=e_PLUGIN."sport_league_e107/images/system/up.png";
$ImageSORT1['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SD_ADMIN_2."' src='".$ImageSORT1['PFAD']."'>";

$ImageSORT2['PFAD']=e_PLUGIN."sport_league_e107/images/system/down.png";
$ImageSORT2['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SD_ADMIN_3."' src='".$ImageSORT2['PFAD']."'>";

if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "<b>".LAN_LEAGUE_SD_ADMIN_1."</b>";

    $tablename = "league_players_extended_struct"; 
    $primaryid = "players_extended_struct_id";
    $e_wysiwyg = "";
    $pageid = "admin_player_data_config";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_4;//Feld Name: Name des Feldes, der in der Datenbank gesetzt wird. Muss sich von bestehenden Feldnamen unterscheiden und darf nicht in der Haupt-User-Tabelle verwendet werden 
    $fieldname[] = "players_extended_struct_name";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_5;//Feld Text: Angezeigter Name des Feldes auf der generierten Seite 
    $fieldname[] = "players_extended_struct_text";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_6;//Feld Typ 
    $fieldname[] = "players_extended_struct_type";
    $fieldtype[] = "dropdown2";  
    $fieldvalu[] = "1:".LAN_LEAGUE_SD_ADMIN_7."~2:".LAN_LEAGUE_SD_ADMIN_8."~3:".LAN_LEAGUE_SD_ADMIN_9."~4:".LAN_LEAGUE_SD_ADMIN_10."~5:".LAN_LEAGUE_SD_ADMIN_11."~6:".LAN_LEAGUE_SD_ADMIN_12."";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_13;//
    $fieldname[] = "players_extended_struct_parms";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_15;//Werte: Trage die Werte getrennt durch Komma ein, z.B. value1,value2 usw Für DB Tabellen bitte das Format benutzen: dbtable,field-value,field-name.
    $fieldname[] = "players_extended_struct_values";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_20;// Gesetzer Wert
    $fieldname[] = "players_extended_struct_default";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_21;// Leseberechtigung Legt fest wer den Wert auf der Benutzerseite angezeigt bekommt. 
    $fieldname[] = "players_extended_struct_read";
    $fieldtype[] = "accesstable";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_22;// Schreibberechtigung Legt fest wer dieses feld in seinen Einstellungen sieht. 
    $fieldname[] = "players_extended_struct_write";
    $fieldtype[] = "accesstable";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_23;// Erforderlich
    $fieldname[] = "players_extended_struct_required";
    $fieldtype[] = "dropdown2";
    $fieldvalu[] = "1:nein~2:ja";

    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_24;// ???
    $fieldname[] = "players_extended_struct_signup";
    $fieldtype[] = "text";
    $fieldvalu[] = ""; 
    
    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_25;// Anwendbar Legt fest welchen Benutzern dieses Feld angezeigt wird. 
    $fieldname[] = "players_extended_struct_applicable";
    $fieldtype[] = "accesstable";
    $fieldvalu[] = "";     
    
    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_26;// 
    $fieldname[] = "players_extended_struct_order";
    $fieldtype[] = "text";
    $fieldvalu[] = "";     
 
    $fieldcapt[] = LAN_LEAGUE_SD_ADMIN_27;//
    $fieldname[] = "players_extended_struct_parent";
    $fieldtype[] = "table";
    $fieldvalu[] = "league_players_extended_struct~players_extended_struct_id~players_extended_struct_name";    

/////////////////////////////
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_SD_ADMIN_28."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_LEAGUE_SD_ADMIN_19."".$row['team_name']."</b>";	
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
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_SD_ADMIN_30."' /></form></td></tr></table></div>";
		$configtitle="<b>".LAN_LEAGUE_SD_ADMIN_29."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
		if($action == "sort1")
			{$con=1;
			$sql -> db_Select($tablename,"*","".$primaryid."!='' ORDER BY players_extended_struct_order");
			while($row = $sql-> db_Fetch())
				{
				$S_id[$con]=$row['players_extended_struct_id'];
				$S_name[$con]=$row['players_extended_struct_name'];
				$S_text[$con]=$row['players_extended_struct_text'];
				$S_type[$con]=$row['players_extended_struct_type'];
				$S_parms[$con]=$row['players_extended_struct_parms'];
				$S_values[$con]=$row['players_extended_struct_values'];
				$S_default[$con]=$row['players_extended_struct_default'];
				$S_read[$con]=$row['players_extended_struct_read'];
				$S_write[$con]=$row['players_extended_struct_write'];
				$S_required[$con]=$row['players_extended_struct_required'];
				$S_signup[$con]=$row['players_extended_struct_signup'];
				$S_applicable[$con]=$row['players_extended_struct_applicable'];
				$S_order[$con]=$row['players_extended_struct_order'];
				$S_parent[$con]=$row['players_extended_struct_parent'];
				$con++;
				}
		for ($i=1; $i < $con; $i++)
				{
				if($S_id[$i]!=$id){
					$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$i])."', players_extended_struct_text = '".$tp->toDB($S_text[$i])."', players_extended_struct_type = '".$tp->toDB($S_type[$i])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$i])."', players_extended_struct_values = '".$tp->toDB($S_values[$i])."', players_extended_struct_default = '".$tp->toDB($S_default[$i])."', players_extended_struct_read = '".$tp->toDB($S_read[$i])."', players_extended_struct_write = '".$tp->toDB($S_write[$i])."', players_extended_struct_required = '".$tp->toDB($S_required[$i])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$i])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$i])."', players_extended_struct_order = '".$tp->toDB($i)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$i])."'";
					$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id = '".$S_id[$i]."'");
					continue;}
				else{$j=$i-1;
						$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$i])."', players_extended_struct_text = '".$tp->toDB($S_text[$i])."', players_extended_struct_type = '".$tp->toDB($S_type[$i])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$i])."', players_extended_struct_values = '".$tp->toDB($S_values[$i])."', players_extended_struct_default = '".$tp->toDB($S_default[$i])."', players_extended_struct_read = '".$tp->toDB($S_read[$i])."', players_extended_struct_write = '".$tp->toDB($S_write[$i])."', players_extended_struct_required = '".$tp->toDB($S_required[$i])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$i])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$i])."', players_extended_struct_order = '".$tp->toDB($j)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$i])."'";
						$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id='".$S_id[$i]."'");
						$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$j])."', players_extended_struct_text = '".$tp->toDB($S_text[$j])."', players_extended_struct_type = '".$tp->toDB($S_type[$j])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$j])."', players_extended_struct_values = '".$tp->toDB($S_values[$j])."', players_extended_struct_default = '".$tp->toDB($S_default[$j])."', players_extended_struct_read = '".$tp->toDB($S_read[$j])."', players_extended_struct_write = '".$tp->toDB($S_write[$j])."', players_extended_struct_required = '".$tp->toDB($S_required[$j])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$j])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$j])."', players_extended_struct_order = '".$tp->toDB($i)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$j])."'";
						$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id='".$S_id[$j]."'");		
						}
				}
		  }
/////////////////////////////////////////////////////////////////////
		if($action == "sort2")
			{$con=1;
			$sql -> db_Select($tablename,"*","".$primaryid."!='' ORDER BY players_extended_struct_order");
			while($row = $sql-> db_Fetch())
				{
				$S_id[$con]=$row['players_extended_struct_id'];
				$S_name[$con]=$row['players_extended_struct_name'];
				$S_text[$con]=$row['players_extended_struct_text'];
				$S_type[$con]=$row['players_extended_struct_type'];
				$S_parms[$con]=$row['players_extended_struct_parms'];
				$S_values[$con]=$row['players_extended_struct_values'];
				$S_default[$con]=$row['players_extended_struct_default'];
				$S_read[$con]=$row['players_extended_struct_read'];
				$S_write[$con]=$row['players_extended_struct_write'];
				$S_required[$con]=$row['players_extended_struct_required'];
				$S_signup[$con]=$row['players_extended_struct_signup'];
				$S_applicable[$con]=$row['players_extended_struct_applicable'];
				$S_order[$con]=$row['players_extended_struct_order'];
				$S_parent[$con]=$row['players_extended_struct_parent'];
				$con++;
				}
		for ($i=1; $i < $con; $i++)
				{
				if($S_id[$i]!=$id){
					$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$i])."', players_extended_struct_text = '".$tp->toDB($S_text[$i])."', players_extended_struct_type = '".$tp->toDB($S_type[$i])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$i])."', players_extended_struct_values = '".$tp->toDB($S_values[$i])."', players_extended_struct_default = '".$tp->toDB($S_default[$i])."', players_extended_struct_read = '".$tp->toDB($S_read[$i])."', players_extended_struct_write = '".$tp->toDB($S_write[$i])."', players_extended_struct_required = '".$tp->toDB($S_required[$i])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$i])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$i])."', players_extended_struct_order = '".$tp->toDB($i)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$i])."'";
					$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id = '".$S_id[$i]."'");
					continue;}
				else{$j=$i+1;
						$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$i])."', players_extended_struct_text = '".$tp->toDB($S_text[$i])."', players_extended_struct_type = '".$tp->toDB($S_type[$i])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$i])."', players_extended_struct_values = '".$tp->toDB($S_values[$i])."', players_extended_struct_default = '".$tp->toDB($S_default[$i])."', players_extended_struct_read = '".$tp->toDB($S_read[$i])."', players_extended_struct_write = '".$tp->toDB($S_write[$i])."', players_extended_struct_required = '".$tp->toDB($S_required[$i])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$i])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$i])."', players_extended_struct_order = '".$tp->toDB($j)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$i])."'";
						$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id='".$S_id[$i]."'");
						$UPDSTR="players_extended_struct_name = '".$tp->toDB($S_name[$j])."', players_extended_struct_text = '".$tp->toDB($S_text[$j])."', players_extended_struct_type = '".$tp->toDB($S_type[$j])."', players_extended_struct_parms = '".$tp->toDB($S_parms[$j])."', players_extended_struct_values = '".$tp->toDB($S_values[$j])."', players_extended_struct_default = '".$tp->toDB($S_default[$j])."', players_extended_struct_read = '".$tp->toDB($S_read[$j])."', players_extended_struct_write = '".$tp->toDB($S_write[$j])."', players_extended_struct_required = '".$tp->toDB($S_required[$j])."', players_extended_struct_signup = '".$tp->toDB($S_signup[$j])."', players_extended_struct_applicable = '".$tp->toDB($S_applicable[$j])."', players_extended_struct_order = '".$tp->toDB($i)."', players_extended_struct_parent = '".$tp->toDB($S_parent[$j])."'";
						$sql -> db_Update("league_players_extended_struct", "".$UPDSTR." WHERE players_extended_struct_id='".$S_id[$j]."'");		
						$i++;
						}
				}
		  }
	if(isset($_POST['submitit']))
		{
		$sql -> db_Select($tablename,"*","".$primaryid."!='' ORDER BY players_extended_struct_order DESC LIMIT 1");
		while($row = $sql-> db_Fetch())
		{
		$LAST_NR=$row['players_extended_struct_order'];
		}
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
		 if($fieldname[$i]=="players_extended_struct_order")
			{
			$inputstr .= " '".$tp->toDB($LAST_NR+1)."'";
			}
		else{
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
			$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message .= ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
	}
//////////////////////////////////////////
 $text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']." ".LAN_LEAGUE_SD_ADMIN_31."</div></a>
 </form>
 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='align:center;width:'>".LAN_LEAGUE_SD_ADMIN_32."</td>
	 	<td class='fcaption' style='align:left'>".LAN_LEAGUE_SD_ADMIN_33."</td>
		<td class='fcaption' style='align: center;width:'>".LAN_LEAGUE_SD_ADMIN_34."</td>
		<td class='fcaption' style='align:center;width:'>".LAN_LEAGUE_SD_ADMIN_35."</td>
		<td class='fcaption' style='align:center;width:'>".LAN_LEAGUE_SD_ADMIN_36."</td>
		<td class='fcaption' style='align:center;width:'>".LAN_LEAGUE_SD_ADMIN_37."</td>
		<td class='fcaption' style='align:center;width:'>".LAN_LEAGUE_SD_ADMIN_38."</td>
	</tr>";

$RECHE[0]=LAN_LEAGUE_SD_ADMIN_40;
$RECHE[252]=LAN_LEAGUE_SD_ADMIN_41;
$RECHE[253]=LAN_LEAGUE_SD_ADMIN_42;
$RECHE[254]=LAN_LEAGUE_SD_ADMIN_43;
$RECHE[255]=LAN_LEAGUE_SD_ADMIN_44;

$PFLICHT[0]=LAN_LEAGUE_SD_ADMIN_45;
$PFLICHT[2]=LAN_LEAGUE_SD_ADMIN_46;
$PFLICHT[1]=LAN_LEAGUE_SD_ADMIN_47;
$count1=0;

$FIELDTYP[0]=LAN_LEAGUE_SD_ADMIN_45;
$FIELDTYP[1]=LAN_LEAGUE_SD_ADMIN_7;
$FIELDTYP[2]=LAN_LEAGUE_SD_ADMIN_8;
$FIELDTYP[3]=LAN_LEAGUE_SD_ADMIN_9;
$FIELDTYP[4]=LAN_LEAGUE_SD_ADMIN_10;
$FIELDTYP[5]=LAN_LEAGUE_SD_ADMIN_11;
$FIELDTYP[6]=LAN_LEAGUE_SD_ADMIN_11;
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
$sql -> db_Select($tablename,"*","".$primaryid."!='' ORDER BY players_extended_struct_order");
	 while($row = $sql-> db_Fetch()){
	 	 $count1++;
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$row['players_extended_struct_name']."</td>";
			$text .="<td class='forumheader3'>".$FIELDTYP[$row['players_extended_struct_type']]."</td>";
			$text .="<td class='forumheader3'>".$row['players_extended_struct_text']."</td>";
			$text .="<td class='forumheader3'>".$RECHE[$row['players_extended_struct_read']]."</td>";
			$text .="<td class='forumheader3'>".$PFLICHT[$row['players_extended_struct_required']]."</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row['players_extended_struct_id']."'>
																				<a href='".e_SELF."?edit.".$row['players_extended_struct_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$row['players_extended_struct_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_SD_ADMIN_16." [".$row['stadions_name']."]')\"/></form></td>";
			$text .="<td class='forumheader3'>
										<a href='".e_SELF."?sort1.".$row['players_extended_struct_id']."'>".$ImageSORT1['LINK']."</a>
										<a href='".e_SELF."?sort2.".$row['players_extended_struct_id']."'>".$ImageSORT2['LINK']."</a> 
										[".$row['players_extended_struct_order']."] (".$count1.")
								</td>";																	
			$text .="</tr>";
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