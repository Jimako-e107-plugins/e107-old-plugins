<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/admin_satz.php
|
|		For the e107 website system
|		©Steve Dunstan 2001-2002
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once("constanten.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");
// ------------------------------

$ImageDELETE['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_FORM_156."' src='".$ImageDELETE['PFAD']."'>";

$ImageLUPE['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/lupe.png";
$ImageLUPE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_FORM_155."' src='".$ImageLUPE['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
if(e_QUERY)
	{
	list($action,$ds_id,$form_id) = explode(".", e_QUERY);
	$ds_id = intval($ds_id);
	$form_id = intval($form_id);
	}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql -> db_Select("e4xA_form_kathegories", "form_kat_name", "form_kat_id='".$ds_id."' LIMIT 1");
$row = $sql-> db_Fetch();
$configtitle = LAN_4xA_FORM_154.": <b>".$row['form_kat_name']."</b>";//
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $tablename = "e4xA_form_auftrag";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "form_auftrag_id";   // first column of your table.
    $order_field = "form_auftrag_id";   // order column of your table.
    $pageid = "opt_".$form_id;  // unique name that matches the one used in admin_menu.php.
		$show_preset = false; // allow e107 presets to be saved for use in the form.

// Field 1
    $fieldcapt[] = form_auftrag_data;
    $fieltabledcapt[] = LAN_4xA_FORM_146;
    $fieldname[] = "form_auftrag_data";
    $fieldtype[] = "data";
    $fieldvalu[] = "";   
// Field 2
    $fieldcapt[] = form_auftrag_akt_data;
    $fieltabledcapt[] = LAN_4xA_FORM_147;
    $fieldname[] = "form_auftrag_akt_data";
    $fieldtype[] = "data";
    $fieldvalu[] = "";
// Field 3
    $fieldcapt[] = form_auftrag_kf1;
    $fieltabledcapt[] = LAN_4xA_FORM_148;
    $fieldname[] = "form_auftrag_kf1";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 4
    $fieldcapt[] = form_auftrag_kf2;
    $fieltabledcapt[] = LAN_4xA_FORM_149;
    $fieldname[] = "form_auftrag_kf2";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 5
    $fieldcapt[] = form_auftrag_kf3;
    $fieltabledcapt[] = LAN_4xA_FORM_150;
    $fieldname[] = "form_auftrag_kf3";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 6
    $fieldcapt[] = form_auftrag_kf4;
    $fieltabledcapt[] = LAN_4xA_FORM_151;
    $fieldname[] = "form_auftrag_kf4";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 7
    $fieldcapt[] = form_auftrag_enable;
    $fieltabledcapt[] = LAN_4xA_FORM_152;
    $fieldname[] = "form_auftrag_enable";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";    
// Field 8
    $fieldcapt[] = form_auftrag_form_id;
    $fieltabledcapt[] = LAN_4xA_FORM_153;
    $fieldname[] = "form_auftrag_form_id";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php

require_once(e_ADMIN."auth.php");
require_once("form_handler.php");
$rs = new myf_form;
//////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['setstat']))
{
	$setstat_fieldname=$_POST['field_name'];	
	$inputstr="".$setstat_fieldname."='".$_POST['stat']."'";
	$inputstr.=", form_auftrag_akt_data='".time()."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
//++++++++++++++++++++++++++++++
if(IsSet($_POST['delete'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
		// Positionen löschen
		$message .= ($sql -> db_Delete("e4xA_form_pos", "form_pos_auftrag_id='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
//++++++++++++++++++++++++++++++
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
//++++++++++++++++++++++++++++++
$table_total = $sql -> db_Select($tablename);
//++++++++++++++++++++++++++++++
if($action == 'view' )
{$text = data_ausgabe($ds_id,$form_id);
$configtitle = LAN_4xA_FORM_159.": ".$ds_id;
}
else{
// =================================================================
$text = "<div style=\"text-align:center\"><br/>";
$text .= "<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'><tr>";
$fields = count($fieldname);
for($i=0; $i< $fields; $i++)
	{
	$text .="<td class='fcaption'>".$fieltabledcapt[$i]."</td>";
	}
$text .= "<td class='fcaption'><b>".LAN_4xA_FORM_03."</b></td></tr>";
///////////////////////////////

$status_pfad[0]=e_PLUGIN.e4xA_FORM_FOLDER."/images/off.gif";
$status_pfad[1]=e_PLUGIN.e4xA_FORM_FOLDER."/images/on.gif";
///////////////////////////////	
$sql ->db_Select($tablename, "*", "form_auftrag_form_id='".$ds_id."' ORDER BY ".$primaryid." DESC");
$rows_count=0;
while($row = $sql->db_Fetch()){
$my_rows[$rows_count]=$row;
$rows_count++;
}
for($m=0; $m < $rows_count;$m++){
		$text .= "<tr>";
		for($i=0; $i< $fields; $i++)
				{
				if($fieldtype[$i]=="data")	
					{
					if($my_rows[$m][$fieldname[$i]]==0)	
						{
						$text .= "<td class='forumheader2'> -/- </td>";
						}		
					else{	
							$text .= "<td class='forumheader2'>".LAN_4xA_FORM_157." ".strftime("%a %d %b %Y",$my_rows[$m][$fieldname[$i]])." ".LAN_4xA_FORM_158." ".strftime("%H:%M",$my_rows[$m][$fieldname[$i]])."</td>";	
						}
					}
				elseif($fieldtype[$i]=="checkbox")
					{
					$IMG_PFAD=$status_pfad[$my_rows[$m][$fieldname[$i]]];
					$stat_wert=($my_rows[$m][$fieldname[$i]]=='1') ? 0:1;
					$text .= "<td class='forumheader2'>
					<form method='post' action='".e_SELF."?.".$ds_id."' id='setstat_".$my_rows[$m][$primaryid]."'>
							<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$my_rows[$m][$fieldname[$i]]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
							<input type='hidden' name='ID' value='".$my_rows[$m][$primaryid]."'>
							<input type='hidden' name='stat' value='".$stat_wert."'>
							<input type='hidden' name='field_name' value='".$fieldname[$i]."'>
					</form></td>";
				}
				else{				
				$form_send =$my_rows[$m]['form_opt_name']."|".$field_types[$my_rows[$m]['form_opt_typ']]."|".$my_rows[$m]['form_opt_par'];
					if($fieldname[$i]=="form_opt_typ")
						{
							$text .="<td class='forumheader2'>";
							if($my_rows[$m]['form_opt_typ']>1 && $my_rows[$m]['form_opt_typ']< 8)
								{
								$form_send =$my_rows[$m]['form_opt_name']."|".$field_types[$my_rows[$m]['form_opt_typ']]."|".$my_rows[$m]['form_opt_par'];
								$text .=$rs->user_extended_element_edit($form_send,"",$my_rows[$m]['form_opt_iso_name']);
								$text .="</td>";	
								}
							else {
								$text .="".$field_types[$my_rows[$m][$fieldname[$i]]]."-".$my_rows[$m][$fieldname[$i]]." </td>";
								}
						}
						else{
							$text .="<td class='forumheader2'>".$tp->toHTML($my_rows[$m][$fieldname[$i]], TRUE)."</td>";
								}
						}
				}				
			$text .= "<td class='forumheader2'>
								<form method='post' action='".e_SELF."?.".$ds_id.".".$form_id."' id='editform_".$my_rows[$m][$primaryid]."'>
										<input type='hidden' name='ID' value='".$my_rows[$m][$primaryid]."'>
											<input type='image' title='".LAN_DELETE."' name='delete[kat_{$my_rows[$m][$primaryid]}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_FORM_123."')\"/>
											| <a href='".e_SELF."?view.".$my_rows[$m][$primaryid].".".$ds_id."'>".$ImageLUPE['LINK']."</a>
								
								</form>
								</td>
						</tr>";
			}
$text .= "</table>";
}
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:80%;'>.:: powered by 4xA-Formular v.".e4xA_FORM_VERSION." from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns -> tablerender($configtitle, $text);

require_once(e_ADMIN."footer.php");
////////////////////////////////////////////
function data_ausgabe($id,$formid)
{
global $sql,$tp;
$tablename="e4xA_form_opt";
$primaryid="form_opt_id";
$order_field="form_opt_sort";
$fc=0;
$sql -> db_Select($tablename, "*", "form_opt_enable!='0' AND form_opt_kat_id='".$formid."'  ORDER BY form_opt_sort");
while($row = $sql-> db_Fetch())
	{
	$fields[$fc]=$row;$fc++;
	}
$pos_c=0;
$sql -> db_Select("e4xA_form_pos", "*", "form_pos_auftrag_id='".$id."' ORDER BY form_pos_id");
while($row = $sql-> db_Fetch())
	{
	$positionen[$pos_c]=$row;$pos_c++;
	}
///####
for($i=0; $i <  $fc; $i++)
	{
	for($j=0; $j <  $pos_c; $j++)
		{
		if($fields[$i]['form_opt_id'] == $positionen[$j]['form_pos_opt_id'])
			{
			 $my_value[$i]=$fields[$i];
			 $my_value[$i]['form_pos_opt_value']=$positionen[$j]['form_pos_opt_value'];
			}
		}
	}
$AUSGABE="<br/>

<div style='text-align:center;'>
<form method='post' action='".e_SELF."?.".$formid."' id='back'>

<input class='button' type='submit' id='back' name='back' value='".LAN_4xA_FORM_160."' />
</form>
</div>
<div style='text-align:left;'>";
for($i=0; $i <  $fc; $i++)
	{
	$AUSGABE.="<b>".$my_value[$i]['form_opt_name'].":</b>  ";
	$AUSGABE.= value_ausgeben($my_value[$i]);
	$AUSGABE.="<br/><br/> \n";
	}
$AUSGABE.="</div><br/>";
return $AUSGABE;
}
/////////////////////////////////////////////////////////
function value_ausgeben($my_value)
{
global $tp,$sql;
if($my_value['form_opt_typ']==1 || $my_value['form_opt_typ']==8)
	{
	return $tp->toHTML($my_value['form_pos_opt_value'], TRUE);
	}
elseif($my_value['form_opt_typ']==2 || $my_value['form_opt_typ']==5)
	{  /////////////dropdown2 or radio
		$par_pos = explode(";", $my_value['form_opt_par']);
		$par_pos_c=count($par_pos);
		for($j=0; $j < $par_pos_c ;$j++)
			{
			list($par_id, $par_text) = explode(":", $par_pos[$j]);
			$my_par[$j]['id']=$par_id;
			$my_par[$j]['text']=$par_text;
			}
	return $my_par[($my_value['form_pos_opt_value']-1)]['text'];
	}
elseif($my_value['form_opt_typ']==3)
	{  /////////////Checkbox
	($my_value['form_pos_opt_value']==1)? $ja_nein= "JA" :$ja_nein="Nein";
	return $ja_nein;
	}
elseif($my_value['form_opt_typ']==4)
	{	//////////////Tabelle 
	list($table_name, $id_feld, $ausgabe_feld) = explode(";", $my_value['form_opt_par']);
	$sql -> db_Select($table_name, "*", "".$id_feld."='".$my_value['form_pos_opt_value']."' LIMIT 1");
	$row = $sql-> db_Fetch();
	return $row[$ausgabe_feld];
	}
elseif($my_value['form_opt_typ']==6 || $my_value['form_opt_typ']==7 )
	{	//////////////date  datestamp
	return strftime("%d %b %Y",$my_value['form_pos_opt_value']);
	}
elseif($my_value['form_opt_typ']==9)
	{	////////////// datei
	return $tp->toHTML($my_value['form_pos_opt_value'], TRUE);
	}
elseif($my_value['form_opt_typ']==10)
	{	////////////// Calender
	$par_pos = explode(";", $my_value['form_opt_par']);
	$calDFormat=$par_pos[0];
	$calTFormat=$par_pos[1];
	return strftime($calDFormat." / ".$calTFormat,$my_value['form_pos_opt_value']);
	}
else{
return $my_value['form_pos_opt_value'];
	}
}
?>