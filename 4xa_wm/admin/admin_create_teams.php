<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_create_teams.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}
require_once("../settings/settings_teams_in_group.php");
//require_once("../settings/settings_admen.php");
require_once(e_ADMIN."auth.php");
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");

if (e_QUERY) {
	list($action,$id_round,$id_group,$id_team) = explode(".", e_QUERY);
	$id_round = intval($id_round);
	$id_group = intval($id_group);
	$id_team = intval($id_team);
	unset($tmp);
}
// =================================================================
require_once("../form_handler.php");
$rs = new form;
////////////////////// Neu Erstellen ////////////////
if($action == "teams")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='admin_groups.php?list.".$id_round.".".$id_group."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";

    $fieldcapt[] = LAN_4xA_SPORTTIPPS_032;
    $fieldname[] = "teams_virtual_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_4xA_SPORTTIPPS_033;
    $fieldname[] = "team_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_teams,team_id,team_name,team_name";

    $fieldcapt[] = LAN_4xA_SPORTTIPPS_034;
    $fieldname[] = "group_id";
    $fieldtype[] = "table";
    $fieldvalu[2] = "4xa_wm_groups,group_id,group_name,group_name,".$id_group."";

	for ($i=0; $i<count($fieldcapt); $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($fieldname[$i]=="group_id")
			{
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i].",".$id_group;
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		else{
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submititeam' value='".LAN_4xA_SPORTTIPPS_048."' />
		</form><form method='post' action='admin_groups.php?list.0.".$id_group."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_4xA_SPORTTIPPS_040."</b>";
	}
///////////=====================================
elseif($action == "edit_team")
	{
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_032;
    $fieldname[] = "teams_virtual_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_4xA_SPORTTIPPS_033;
    $fieldname[] = "team_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_teams,team_id,team_name,team_name";

    $fieldcapt[] = LAN_4xA_SPORTTIPPS_034;
    $fieldname[] = "group_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_groups,group_id,group_name,group_name,".$id_group."";
    		
		
	$sql -> db_Select($tablename, "*", " $primaryid='".$id_team."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"admin_groups.php?list.0.".$id_group."\" id=\"adminform\">
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
		<input class='button' type='submit' id='update_teams' name='update_teams' value='".LAN_4xA_SPORTTIPPS_050."' />
		<input type='hidden' name='teams_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"admin_groups.php?list.0.".$id_group."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' /></form></td></tr></table></div>";
	$configtitle="<b></b>";	
	}


/////////////////////////////////////////////////
$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);
require_once(e_ADMIN."footer.php");
//////////////////////   Functionen   /////////////////////////////
?>
