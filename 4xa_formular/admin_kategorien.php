<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/admin_kategorien.php
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

$ImageFIELDS['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/logo_16.png";
$ImageFIELDS['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_FORM_122."' src='".$ImageFIELDS['PFAD']."'>";

$ImagePREVIEW['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/lupe.png";
$ImagePREVIEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_FORM_159."' src='".$ImagePREVIEW['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_4xA_FORM_121;//

    $tablename = "e4xA_form_kathegories";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "form_kat_id";   // first column of your table.
    $order_field = "form_kat_id";   // order column of your table.
    $e_wysiwyg = "form_kat_desc,form_kat_mail_desc"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "kat";  // unique name that matches the one used in admin_menu.php.
		$show_preset = false; // allow e107 presets to be saved for use in the form.

// Field 1
    $fieldcapt[] = LAN_4xA_FORM_104;
    $fieltabledcapt[] = LAN_4xA_FORM_105;
    $fieldname[] = "form_kat_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 2
    $fieldcapt[] = LAN_4xA_FORM_106;
    $fieltabledcapt[] = LAN_4xA_FORM_107;
    $fieldname[] = "form_kat_caption";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 3
    $fieldcapt[] = LAN_4xA_FORM_108;
    $fieltabledcapt[] = LAN_4xA_FORM_109;
    $fieldname[] = "form_kat_enable";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 4
    $fieldcapt[] = LAN_4xA_FORM_110;
    $fieltabledcapt[] = LAN_4xA_FORM_111;
    $fieldname[] = "form_kat_desc";
    $fieldtype[] = "textarea";
    $fieldvalu[] = ";100%;250px";
// Field 5
    $fieldcapt[] = LAN_4xA_FORM_112;
    $fieltabledcapt[] = LAN_4xA_FORM_113;
    $fieldname[] = "form_kat_mail";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
// Field 6
    $fieldcapt[] = LAN_4xA_FORM_112;
    $fieltabledcapt[] = LAN_4xA_FORM_113;
    $fieldname[] = "form_kat_mail_adress";
    $fieldtype[] = "text";
    $fieldvalu[] = SITEADMINEMAIL;
// Field 7
    $fieldcapt[] = LAN_4xA_FORM_114;
    $fieltabledcapt[] = LAN_4xA_FORM_115;
    $fieldname[] = "form_kat_mail_desc";
    $fieldtype[] = "textarea";
    $fieldvalu[] = ";100%;250px";
// Field 8
    $fieldcapt[] = LAN_4xA_FORM_116;
    $fieltabledcapt[] = LAN_4xA_FORM_117;
    $fieldname[] = "form_kat_submit_user";
    $fieldtype[] = "accesstable";
    $fieldvalu[] = "";
 
    $fieldcapt[] = LAN_4xA_FORM_163;
    $fieltabledcapt[] = LAN_4xA_FORM_164;
    $fieldname[] = "form_kat_certific";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";
    
 
    $fieldcapt[] = "Admin-Bereich- Formular";
    $fieltabledcapt[] = "Admin";
    $fieldname[] = "form_kat_admin";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1";    
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php
/*
if($show_preset){
require_once(e_HANDLER."preset_class.php");
$pst = new e_preset;
$pst->form = "adminform"; // form id of the form that will have it's values saved.
$pst->page = e_SELF; // display preset options on which page(s).
$pst->id = "admin_".$tablename;
}
*/
require_once(e_ADMIN."auth.php");
require_once("form_handler.php");
$rsf = new myf_form;

if(e_QUERY)
	{
	list($action, $ds_id) = explode(".", e_QUERY);
	$ds_id = intval($ds_id);
	}

if(isset($_POST['submitit'])){
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) {
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
		for ($i=0; $i<$count; $i++) {

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
		$ff_row = $sql-> db_Fetch();
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
$text="<div style=\"text-align:center\">\n";
$text.="<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldname); $i++) {

		$form_send = $fieldname[$i]."|".$fieldtype[$i]."|".$fieldvalu[$i];
		$text.="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		$F_NAME=$fieldname[$i];
	 	$text.=$rsf->user_extended_element_edit($form_send,$ff_row[$F_NAME],$F_NAME);
		$text.="</td></tr>";
	};

$text.="
<tr style='vertical-align:top'>
<td colspan='2' style='text-align:center' class='forumheader'>";


if(isset($_POST['edit']) || $action=="edit"){
		$text.="<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$ff_row[$primaryid]."'>";
}else{
		$text.="<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_4xA_FORM_94."' />";
}
$text.="<input class='button' type='submit' id='abbruch' name='abbruch' value='".LAN_4xA_FORM_95."' />";
$text.="</td>
</tr>
</table>
</form>
</div>
";
}
else{
$text = "<div style=\"text-align:center\">\n
	<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
	<input class='button' type='submit' id='new' name='new' value='".LAN_4xA_FORM_118."' />
	</form><br/><br/>";
$text .= "<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'><tr>";
$fields = count($fieldname);
for($i=0; $i< $fields; $i++)
	{
	$text .="<td class='fcaption'>".$fieltabledcapt[$i]."</td>";
	}
$text .= "<td class='fcaption' style='width:110px;'><b>".LAN_4xA_FORM_03."</b></td></tr>";
///////////////////////////////

$status_pfad[0]=e_PLUGIN.e4xA_FORM_FOLDER."/images/off.gif";
$status_pfad[1]=e_PLUGIN.e4xA_FORM_FOLDER."/images/on.gif";
///+++++++++++++++++++++++++
$useklasses_text[0] = LAN_4xA_FORM_38;	
$useklasses_text[252] = LAN_4xA_FORM_39;
$useklasses_text[253] = LAN_4xA_FORM_40;
$useklasses_text[254] = LAN_4xA_FORM_41;
$useklasses_text[255] = LAN_4xA_FORM_42;
$sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
  while($row = $sql-> db_Fetch()){
  extract($row);
	$useklasses_text[$userclass_id] = $userclass_name;
	}
///////////////////////////////	
$sql ->db_Select($tablename, "*", "".$primaryid."!='' ORDER BY ".$order_field."");
$rows_count=0;
while($row = $sql->db_Fetch()){
$my_rows[$rows_count]=$row;
$rows_count++;
}
for($m=0; $m < $rows_count;$m++){
		$text .= "<tr>";
		for($i=0; $i< $fields; $i++)
				{
				$text .="<td class='forumheader2'>";
				if($fieldtype[$i]=="checkbox")
					{
					$IMG_PFAD=$status_pfad[$my_rows[$m][$fieldname[$i]]];
					$stat_wert=($my_rows[$m][$fieldname[$i]]=='1') ? 0:1;	
					$text .= "
					<form method='post' action='".e_SELF."' id='setstat_".$my_rows[$m][$primaryid]."'>
							<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$my_rows[$m][$fieldname[$i]]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
							<input type='hidden' name='ID' value='".$my_rows[$m][$primaryid]."'>
							<input type='hidden' name='stat' value='".$stat_wert."'>
							<input type='hidden' name='field_name' value='".$fieldname[$i]."'>
					</form>";
					}
				elseif($fieldtype[$i]=="accesstable")
					{
					$text .=$useklasses_text[$my_rows[$m][$fieldname[$i]]];
					}
				elseif($fieldtype[$i]=="textarea")
					{
					$text .=$tp->toHTML($my_rows[$m][$fieldname[$i]], TRUE);
					}	
				else{
						$AT=$tp->toHTML($my_rows[$m][$fieldname[$i]], FALSE);
						$text .=$tp->html_truncate($AT, 30, " ...");
					}
				
				if($fieldname[$i]=='form_kat_name')
					{
					$text .="<br/><a href='admin_satz.php?.".$my_rows[$m][$primaryid]."'><b>".(get_data_cont($my_rows[$m][$primaryid]));	
					$text .="</b>Eintr.</a>";	
					}
				$text .="</td>";	
				}		
			$text .= "<td class='forumheader2'>
								<form method='post' action='".e_SELF."' id='editform_".$my_rows[$m][$primaryid]."'>
										<input type='hidden' name='ID' value='".$my_rows[$m][$primaryid]."'>
											<input type='image' title='".LAN_DELETE."' name='delete[kat_{$my_rows[$m][$primaryid]}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_FORM_123."')\"/> | 
										<a href='".e_SELF."?edit.".$my_rows[$m][$primaryid]."'>".$ImageEDIT['LINK']."</a> | 
										<a href='admin_optionen.php?list.0.".$my_rows[$m][$primaryid]."'>".$ImageFIELDS['LINK']."</a> | 
										<a href='formular.php?".$my_rows[$m][$primaryid]."'>".$ImagePREVIEW['LINK']."</a>
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

////////////////////////////////////////
function get_data_cont($id)
{
global $sql2;
$sql2 -> db_Select("e4xA_form_auftrag", "*","form_auftrag_form_id='".$id."' ORDER BY form_auftrag_form_id");
$count=0;
while($row = $sql2-> db_Fetch())
{
	$count++;
}
return $count;
}
////////////////////////////////////////
?>