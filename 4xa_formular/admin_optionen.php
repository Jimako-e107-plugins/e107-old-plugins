<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/admin_optionen.php
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
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageEDIT['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
if(e_QUERY)
	{
	list($action,$ds_id,$form_id) = explode(".", e_QUERY);
	$ds_id = intval($ds_id);
	$form_id = intval($form_id);
	}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql -> db_Select("e4xA_form_kathegories", "form_kat_name", "form_kat_id='".$form_id."' LIMIT 1");
$row = $sql-> db_Fetch();
 $configtitle = LAN_4xA_FORM_120."<b>".$row['form_kat_name']."</b>";//
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $tablename = "e4xA_form_opt";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "form_opt_id";   // first column of your table.
    $order_field = "form_opt_sort";   // order column of your table.
    $e_wysiwyg = "form_opt_text"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "opt_".$form_id;  // unique name that matches the one used in admin_menu.php.
		$show_preset = false; // allow e107 presets to be saved for use in the form.

// Field 0
    $fieldcapt[] = "";
    $fieltabledcapt[] = "";
    $fieldname[] = "form_opt_kat_id";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 1
    $fieldcapt[] = LAN_4xA_FORM_06;
    $fieltabledcapt[] = LAN_4xA_FORM_06a;
    $fieldname[] = "form_opt_iso_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 2
    $fieldcapt[] = LAN_4xA_FORM_07;
    $fieltabledcapt[] = LAN_4xA_FORM_07a;
    $fieldname[] = "form_opt_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field §
    $fieldcapt[] = LAN_4xA_FORM_141;
    $fieltabledcapt[] = LAN_4xA_FORM_142;
    $fieldname[] = "form_opt_pflicht";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 4
    $fieldcapt[] = LAN_4xA_FORM_08;
    $fieltabledcapt[] = LAN_4xA_FORM_08a;
    $fieldname[] = "form_opt_typ";
    $fieldtype[] = "dropdown2";
    $fieldvalu[] = "1:".LAN_4xA_FORM_09.";2:".LAN_4xA_FORM_10.";3:".LAN_4xA_FORM_11.";4:".LAN_4xA_FORM_12.";5:".LAN_4xA_FORM_13.";7:".LAN_4xA_FORM_15.";8:".LAN_4xA_FORM_15b.";9:upload;10:caleder"; ///6:".LAN_4xA_FORM_14.";
// Field 5
    $fieldcapt[] = LAN_4xA_FORM_16;
    $fieltabledcapt[] = LAN_4xA_FORM_16a;
    $fieldname[] = "form_opt_par";
    $fieldtype[] = "text2";
    $fieldvalu[] = "";
// Field 6
    $fieldcapt[] = LAN_4xA_FORM_17;
    $fieltabledcapt[] = LAN_4xA_FORM_17a;
    $fieldname[] = "form_opt_text";
    $fieldtype[] = "textarea";
    $fieldvalu[] = ";100%;250px";
// Field 7
    $fieldcapt[] = LAN_4xA_FORM_18;
    $fieltabledcapt[] = LAN_4xA_FORM_18a;
    $fieldname[] = "form_opt_sort";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 8
    $fieldcapt[] = LAN_4xA_FORM_19;
    $fieltabledcapt[] = LAN_4xA_FORM_19a;
    $fieldname[] = "form_opt_enable";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php

if($show_preset){
require_once(e_HANDLER."preset_class.php");
$pst = new e_preset;
$pst->form = "adminform"; // form id of the form that will have it's values saved.
$pst->page = e_SELF; // display preset options on which page(s).
$pst->id = "admin_".$tablename;
}

require_once(e_ADMIN."auth.php");
if($show_preset){
$pst->save_preset(); // save and render result using unique name
}
require_once("form_handler.php");
$rs = new myf_form;
//////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['submitit'])){
		$count = count($fieldname);
		$inputstr = "'".$tp->toDB($form_id)."',";
		for ($i=1; $i<$count; $i++) {
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
	
if(isset($_POST['setstat']))
{
	$setstat_fieldname=$_POST['field_name'];	
	$inputstr="".$setstat_fieldname."='".$_POST['stat']."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
////////////////////////////////////////////////////////////////////////////////////
	if(IsSet($_POST['update'])){

		$count = count($fieldname);
		$inputstr = " ".$fieldname[0]." = '".$tp->toDB($form_id)."', ";
		for ($i=1; $i<$count; $i++) {
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
		};

		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
if($show_preset){
$row = $pst->read_preset("admin_".$tablename); // read preset.
}
if(IsSet($_POST['edit']) || $action=="edit"){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}
		elseif($ds_id){$id_to_edit=$ds_id;}		
		else{$id_to_edit=$_POST['ID'];}
		$sql -> db_Select($tablename, "*", " $primaryid='".$id_to_edit."' ");
		$row = $sql-> db_Fetch();
}

if(IsSet($_POST['delete'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
		$message ."<br/>-".$_POST['existing']."-/-".$_POST['ID']."-";
		
}

if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$table_total = $sql -> db_Select($tablename);

// =================================================================
if(isset($_POST['edit']) || isset($_POST['new']) || $action=="edit")
{
$text = "<div style='text-align:center'>\n";
$text .= "<form method='post' action='".e_SELF."?list.0.".$form_id."' id='adminform'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=1; $i<count($fieldcapt); $i++) {

		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";

	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
	};
$text .= "
<tr style='vertical-align:top'>
<td colspan='2' style='text-align:center' class='forumheader'>";
if(isset($_POST['edit']) || $action=="edit"){
		$text .= "<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'>";
}else{
		$text .= "<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_4xA_FORM_94."' />";
}
$text .= "<input class='button' type='submit' id='abbruch' name='abbruch' value='".LAN_4xA_FORM_95."' />";
$text .= "</td>
</tr>
</table>
</form>
</div>
";
}
else{
$text = "<div style='text-align:center'><br/>
	<form method='post' action='".e_SELF."?new.0.".$form_id."' id='adminform'>
	<input class='button' type='submit' id='new' name='new' value='".LAN_NEW_CREATE."' />
	</form>
	<form method='post' action='admin_kategorien.php' id='bback'>
	<input class='button' type='submit' id='bback' name='bback' value='".LAN_4xA_FORM_119."' />
	</form><br/><br/>";
$text .= "<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'><tr><td class='fcaption'></td>";
$fields = count($fieldname);
for($i=1; $i< $fields; $i++)
	{
	$text .="<td class='fcaption'>".$fieltabledcapt[$i]."</td>";
	}
$text .= "<td class='fcaption'><b>".LAN_4xA_FORM_03."</b></td></tr>";
///////////////////////////////
$field_types[1]="text";
$field_types[2]="dropdown2";
$field_types[3]="checkbox";
$field_types[4]="table";
$field_types[5]="radio";
$field_types[6]="date";
$field_types[7]="datestamp";
$field_types[8]="textarea";
$field_types[9]="upload";

$status_pfad[0]=e_PLUGIN.e4xA_FORM_FOLDER."/images/off.gif";
$status_pfad[1]=e_PLUGIN.e4xA_FORM_FOLDER."/images/on.gif";
///////////////////////////////	
$sql ->db_Select($tablename, "*", "".$primaryid."!='' AND form_opt_kat_id='".$form_id."' ORDER BY ".$order_field."");
$rows_count=0;
while($row = $sql->db_Fetch()){
$my_rows[$rows_count]=$row;
$rows_count++;
}
for($m=0; $m < $rows_count;$m++){
		$text .= "<tr>";
		for($i=0; $i< $fields; $i++)
				{
				if($fieldtype[$i]=="checkbox")
					{
					$IMG_PFAD=$status_pfad[$my_rows[$m][$fieldname[$i]]];
					$stat_wert=($my_rows[$m][$fieldname[$i]]=='1') ? 0:1;
					$text .= "<td class='forumheader2'>
					<form method='post' action='".e_SELF."?new.0.".$form_id."' id='setstat_".$my_rows[$m][$primaryid]."'>
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
						elseif($fieldname[$i]=="form_opt_par")
						{
						$AT=$tp->toHTML($my_rows[$m][$fieldname[$i]], FALSE);
						$text .="<td class='forumheader2'>".($tp->html_truncate($AT, 15, " ..."))."</td>";
						}
						elseif($fieldname[$i]=="form_opt_text")
						{
						$AT=$tp->toHTML($my_rows[$m][$fieldname[$i]], FALSE);
						$text .="<td class='forumheader2'>".($tp->html_truncate($AT, 30, " ..."))."</td>";
						}
						else{
							$text .="<td class='forumheader2'>".$tp->toHTML($my_rows[$m][$fieldname[$i]], TRUE)."</td>";
								}
						}
				}				
			$text .= "<td class='forumheader2'>
								<form method='post' action='".e_SELF."?list.0.".$form_id."' id='editform_".$my_rows[$m][$primaryid]."'>
										<input type='hidden' name='ID' value='".$my_rows[$m][$primaryid]."'>
											<input type='image' title='".LAN_DELETE."' name='delete[kat_{$my_rows[$m][$primaryid]}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_FORM_123."')\"/> | 
										<a href='".e_SELF."?edit.".$my_rows[$m][$primaryid].".".$form_id."'>".$ImageEDIT['LINK']."</a>
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

?>