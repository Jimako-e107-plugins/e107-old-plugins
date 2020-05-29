uuzz<?php
/*
+---------------------------------------------------------------+
|		4xA_coktails v0.1 - by ***RuSsE*** (www.e107.4xA.de) 28.05.2009
|		sorce: ../../4xA_coktails/admin_config2.php 
|
|		For the e107 website system
|		Steve Dunstan
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."4xA_coktails/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."4xA_coktails/languages/German.php");
// ------------------------------

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "Cocktails-Kategorien";//

    $tablename = "e4xA_zut_kat";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "e4xA_zut_kat_id";   // first column of your table.
    $e_wysiwyg = ""; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "zut_kat";  // unique name that matches the one used in admin_menu.php.
	$show_preset = TRUE; // allow e107 presets to be saved for use in the form.
	$order_field = "e4xA_zut_kat_sort";
// Field 1   - first field after the primary one.
    $fieldcapt[] = e4xA_zut_kat_name;//"Name";
    $fieldname[] = "e4xA_zut_kat_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
// Field 2
    $fieldcapt[] = e4xA_zut_kat_text;//"Name";
    $fieldname[] = "e4xA_zut_kat_text";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
// Field 3
     $fieldcapt[] = e4xA_zut_kat_sort;//"Name";
    $fieldname[] = "e4xA_zut_kat_sort";
    $fieldtype[] = "text";  // simple text box. 
    $fieldvalu[] = ""; 
// Field 4
    $fieldcapt[] = e4xA_zut_kat_enable;//"Turn on";
    $fieldname[] = "e4xA_zut_kat_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";           // [checkbox value]

if(file_exists(e_PLUGIN."4xA_coktails/language/".e_LANGUAGE.".php")){
	@require_once(e_PLUGIN."4xA_coktails/language/".e_LANGUAGE.".php");
}
/////////////////////////////////////////////////////////////////
if($show_preset){
require_once(e_HANDLER."preset_class.php");
$pst = new e_preset;
$pst->form = "adminform"; // form id of the form that will have it's values saved.
$pst->page = e_SELF; // display preset options on which page(s).
$pst->id = "admin_".$tablename;
}

require_once(e_ADMIN."auth.php");
$pst->save_preset(); // save and render result using unique name
require_once("form_handler.php");
$rs = new form;
//++++++++++++++++++++++++++++++++
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
	//       echo $inputstr."<br>";
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
}
//++++++++++++++++++++++++++++++++
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
//++++++++++++++++++++++++++++++++
$row = $pst->read_preset("admin_".$tablename); // read preset.
//++++++++++++++++++++++++++++++++
if(IsSet($_POST['edit'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
		$sql -> db_Select($tablename, "*", " $primaryid='".$id_to_edit."' ");
		$row = $sql-> db_Fetch();
}
//++++++++++++++++++++++++++++++++
if(IsSet($_POST['delete'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
		$message = "T-".$id_to_edit."-U";
}
//++++++++++++++++++++++++++++++++
if(isset($_POST['setstat']))
{
	$inputstr="e4xA_zut_kat_enable='".$_POST['stat']."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
if(isset($_POST['up']))
{	
	$inputstr="e4xA_zut_kat_sort='".($_POST['mySort']-1)."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['myID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
	$inputstr="e4xA_zut_kat_sort='".($_POST['upSort']+1)."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['upID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
if(isset($_POST['down']))
{
	$inputstr="e4xA_zut_kat_sort='".($_POST['mySort']+1)."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['myID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
	$inputstr="e4xA_zut_kat_sort='".($_POST['downSort']-1)."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['downID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
//++++++++++++++++++++++++++++++++
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
//++++++++++++++++++++++++++++++++

$table_total = $sql -> db_Select($tablename);

/*

$text = "
<div style=\"text-align:center\">
<form method=\"post\" action=\"".e_SELF."\" id=\"myexistingform\">
<table style=\"width:96%;margin-left:auto;margin-right:auto;\" class=\"fborder\">
<tr>
<td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">";

if(!$table_total){
		$text .= LAN_EMPTY;
}else{

		$text .= "<span class=\"defaulttext\">".LAN_EXISTING.":</span>
		<select name=\"existing\" class=\"tbox\">";
		while(list($the_id_, $the_name_) = $sql-> db_Fetch()){
			$text .= "<option value=\"$the_id_\">".$the_name_."</option>";
		}
		$text .= "</select>
		<input class=\"button\" type=\"submit\" name=\"edit\" value=\"".LAN_EDIT."\" />
		<input class=\"button\" type=\"submit\" name=\"delete\" value=\"".LAN_DELETE."\" onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL)."  ')\" />
		</td>
		</tr>";
}

$text .= "</table></form></div>";

*/
// =================================================================
if(isset($_POST['edit']) || isset($_POST['new']))
{
$text = "<div style=\"text-align:center\">\n";
$text .= "<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++) {

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


if(isset($_POST['edit'])){
		$text .= "<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />  <input class='button' type='submit' id='cancel' name='cancel' value='".LAN_CANCEL."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'>";
}else{
		$text .= "<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />   <input class='button' type='submit' id='cancel' name='cancel' value='".LAN_CANCEL."' />";
}

$text .= "</td>
</tr>
</table>
</form>
</div>
";
}
else{
$text = "<div style=\"text-align:center\">\n
	<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
	<input class='button' type='submit' id='new' name='new' value='".LAN_CREATE."' />
	</form>\n\n";
$text .= "<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'><tr>";
$fields = count($fieldname);
for($i=0; $i< $fields; $i++)
	{
	$text .="<td class='fcaption'>".$fieldname[$i]."</td>";
	}
$text .= "<td class='fcaption'>Options</td></tr>";
$sql -> db_Select($tablename, "*", "$primaryid !='' ORDER BY $order_field");
while($row = $sql-> db_Fetch()){
			$my_list[]=$row;
			}
$count_of_row = count($my_list);
for($j=0; $j< $count_of_row; $j++)
	{
	$text .= "<tr>";
$status_pfad[0]=e_PLUGIN."4xA_coktails/images/off.gif";
$status_pfad[1]=e_PLUGIN."4xA_coktails/images/on.gif";
			for($i=0; $i< $fields-2; $i++)
					{
					$text .="<td class='forumheader2'>".$my_list[$j][$fieldname[$i]]."</td>";
					}
			$text .= "<td class='forumheader2'>
									<form method='post' action='".e_SELF."' id='setstat_".$my_list[$j][$primaryid]."'>
									<input type='image' title='".LAN_STATEDIT."' name='up[kat_{$my_list[$j][$primaryid]}]' style='vertical-align: middle' src='".e_PLUGIN."4xA_coktails/images/up.png'>
									<input type='image' title='".LAN_STATEDIT."' name='down[kat_{$my_list[$j][$primaryid]}]' style='vertical-align: middle' src='".e_PLUGIN."4xA_coktails/images/down.png'>
									<input type='hidden' name='myID' value='".$my_list[$j][$primaryid]."'>
									<input type='hidden' name='mySort' value='".$my_list[$j][e4xA_zut_kat_sort]."'>
									<input type='hidden' name='upID' value='".$my_list[$j-1][$primaryid]."'>
									<input type='hidden' name='upSort' value='".$my_list[$j-1][e4xA_zut_kat_sort]."'>
									<input type='hidden' name='downID' value='".$my_list[$j+1][$primaryid]."'>
									<input type='hidden' name='downSort' value='".$my_list[$j+1][e4xA_zut_kat_sort]."'>
									</form>	(".$my_list[$j]['e4xA_zut_kat_sort'].")
										</td>";				
			$IMG_PFAD=$status_pfad[$my_list[$j]['e4xA_zut_kat_enable']];
			$stat_wert=($my_list[$j]['e4xA_zut_kat_enable']=='1') ? 0:1;
			$text .= "<td class='forumheader2'>
									<form method='post' action='".e_SELF."' id='setstat_".$my_list[$j][$primaryid]."'>
									<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$my_list[$j][$primaryid]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
									<input type='hidden' name='ID' value='".$my_list[$j][$primaryid]."'>
									<input type='hidden' name='stat' value='".$stat_wert."'>
									</form>	
										</td>";
			$text .= "<td class='forumheader2'>
								<form method='post' action='".e_SELF."' id='editform_".$my_list[$j][$primaryid]."'>
										<input type='hidden' name='ID' value='".$my_list[$j][$primaryid]."'>
										<input class=\"button\" type=\"submit\" name=\"delete\" value=\"".LAN_DELETE."\" onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL)."  ')\" /> |
										<input class=\"button\" type=\"submit\" name=\"edit\" value=\"".LAN_EDIT."\" />
								</form>
								</td>
						</tr>";
			}
$text .= "</table>";
}
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>