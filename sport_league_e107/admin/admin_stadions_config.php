<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_stadions_config.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 16:32 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_stadions_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_stadions_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";


if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "<b>".LAN_LEAGUE_STADIONS_ADMIN_1."</b>";

    $tablename = "league_stadions"; 
    $primaryid = "stadions_id";
    $e_wysiwyg = "stadions_description";
    $pageid = "admin_stadions";


    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_2;// "stadions_name"
    $fieldname[] = "stadions_name";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_3;// "stadions_ort"
    $fieldname[] = "stadions_ort";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_3a;// "stadions_plz"
    $fieldname[] = "stadions_plz";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_4;// "stadions_street"
    $fieldname[] = "stadions_street";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_4a;// "stadions_tel"
    $fieldname[] = "stadions_tel";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_4b;// "stadions_fax"
    $fieldname[] = "stadions_fax";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_4c;// "stadions_contakt"
    $fieldname[] = "stadions_contakt";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_5;// "stadions_url"
    $fieldname[] = "stadions_url";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";  

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_6;// "stadions_image"
    $fieldname[] = "stadions_image";
    $fieldtype[] = "image";
    $fieldvalu[] = "../stadions_images/";

    $fieldcapt[] = LAN_LEAGUE_STADIONS_ADMIN_7;// "stadions_description"
    $fieldname[] = "stadions_description";
    $fieldtype[] = "textarea";
    $fieldvalu[] = "~80%~300px";  
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_STADIONS_ADMIN_12."' /></form></td></tr></table></div>";
	
	$configtitle=LAN_LEAGUE_STADIONS_ADMIN_19;	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird  /////////////////////////
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
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='Abbrechen' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_LEAGUE_STADIONS_ADMIN_20."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
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
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
///////////////////////////Tabelle mit vorhandenen Stadions zeigen. Ersmal Überschrift...///////////////
 $text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_STADIONS_ADMIN_14." </div></a>
 </form>
 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='align:center;width:5%'>".LAN_LEAGUE_STADIONS_ADMIN_8."</td>
	 	<td class='fcaption' style='align:left'>".LAN_LEAGUE_STADIONS_ADMIN_10."</td>
		<td class='fcaption' style='align: center;width:5%'>".LAN_LEAGUE_STADIONS_ADMIN_9."</td>
		<td class='fcaption' style='align:center;width:15%'>".LAN_LEAGUE_STADIONS_ADMIN_11.".</td>
		<td class='fcaption' style='align:center;width:25%'>".LAN_LEAGUE_STADIONS_ADMIN_13."</td>
		<td class='fcaption' style='align:center;width:15%'>".LAN_LEAGUE_STADIONS_ADMIN_15."</td>
	</tr>";
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
$sql -> db_Select($tablename,"*","".$primaryid."!='' ORDER BY stadions_name");
	 while($row = $sql-> db_Fetch()){
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$row['stadions_id']."</td>";
			$text .="<td class='forumheader3'>".$row['stadions_name']."</td>";
			$text .="<td class='forumheader3'>".$row['stadions_plz']."</td>";
			$text .="<td class='forumheader3'>".$row['stadions_ort']."</td>";
			$text .="<td class='forumheader3'>".$row['stadions_street']."</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row['stadions_id']."'>
																				<a href='".e_SELF."?edit.".$row['stadions_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$row['stadions_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_STADIONS_ADMIN_16." [".$row['stadions_name']."]')\"/></form></td></tr>";
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