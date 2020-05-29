<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_create_groups.php
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
require_once("../settings/settings_groups.php");
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
if($action == "new")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='admin_groups.php?list.0.".$id_group."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		if($fieldname[$i]==$sortfild)
			{
			$text .="<input type='hidden' name='$fieldname[$i]' value='".($fcount_global+1)."'>";
			continue;
			}
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	if($fieldname[$i]=="group_round_id")
			{		
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i].",".$id_group;  //<input type='hidden' name='ID' value='".$row['round_id']."'>
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		else{
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='admin_groups.php?list.0.".$id_group."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_CANCEL."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_NEW_GROUP_CREATE_CAPTION."</b>";
	}
////////////////////////////////////////////////////////
elseif($action == "new")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='admin_groups.php?list.0.".$id_group."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		if($fieldname[$i]==$sortfild)
			{
			$text .="<input type='hidden' name='$fieldname[$i]' value='".($fcount_global+1)."'>";
			continue;
			}
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($fieldtype[$i]=="checkbox_multi")
			{		
			$text .=multickeck_create($fieldvalu[$i]);
			}
		elseif($fieldname[$i]=="group_round_id")
			{		
			$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i].",".$id_group;  //<input type='hidden' name='ID' value='".$row['round_id']."'>
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		else{
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='admin_groups.php?list.0.".$id_group."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_CANCEL."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_NEW_GROUP_CREATE_CAPTION."</b>";
	}
/////////////////////////////////////////////////
$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);
require_once(e_ADMIN."footer.php");
//////////////////////   Functionen   /////////////////////////////
?>
