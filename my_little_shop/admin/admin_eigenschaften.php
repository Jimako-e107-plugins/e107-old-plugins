<?php
/*
+---------------------------------------------------------------+
|		4xA_coktails v0.1 - by ***RuSsE*** (www.e107.4xA.de) 28.05.2009
|		sorce: ../../4xA_coktails/admin_config3.php
|
|		For the e107 website system
|		&#659;teve Dunstan
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
define("PLUG_FOLDER", "my_little_shop/");
define("IMAGE_FOLDER", e_PLUGIN.PLUG_FOLDER."produkt_images/");



$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/eigenschaften_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/eigenschaften_lan.php");
// ------------------------------
if (e_QUERY) {
	list($action, $action_id) = explode(".", e_QUERY);
	$action_id = intval($action_id);
	unset($tmp);
}else{$action="list";}

define ("ZUT_IMAGES_FOLDER", "".e_PLUGIN.PLUG_FOLDER."zut_images/");
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "Eigenschaften";//
    $tablename = "mls_eigenschaften";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_eigenschaften_id";   // first column of your table.
    $order_field = "mls_eigenschaften_name";   // first column of your table.
    $e_wysiwyg = "mls_eigenschaften_text"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "admin_eigenschaften";  // unique name that matches the one used in admin_menu.php.
		$show_preset = TRUE; // allow e107 presets to be saved for use in the form.

// Field 1   - first field after the primary one.
    $fieldcapt[] = e4xA_zut_name;//"Name";
    $fieldname[] = "mls_eigenschaften_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
// Field 2
    $fieldcapt[] = e4xA_zut_zut_kat;//"Name";
    $fieldname[] = "mls_eigenschaften_kat";
    $fieldtype[] = "table";  // simple text box.
    $fieldvalu[] = "mls_eigen_kat,mls_eigen_kat_id,mls_eigen_kat_name,AND mls_eigen_kat_enable!='0'";
// Field 3   
     $fieldcapt[] = e4xA_zut_text;//"Name";
    $fieldname[] = "mls_eigenschaften_text";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,250px";  // [default-text,width,height]
// Field 4
    $fieldcapt[] = e4xA_coktail_img;//"Icon";
    $fieldname[] = "mls_eigenschaften_img";
    $fieldtype[] = "image";    // image selection.
    $fieldvalu[] = ZUT_IMAGES_FOLDER; // [path to directory]
//Field 5
    $fieldcapt[] = e4xA_zut_enable;//"Turn on";
    $fieldname[] = "mls_eigenschaften_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";           // [checkbox value]

if(file_exists(e_PLUGIN.PLUG_FOLDER."language/".e_LANGUAGE.".php")){
	@require_once(e_PLUGIN.PLUG_FOLDER."language/".e_LANGUAGE.".php");
}
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
if($show_preset){
require_once(e_HANDLER."preset_class.php");
$pst = new e_preset;
$pst->form = "adminform"; // form id of the form that will have it's values saved.
$pst->page = e_SELF; // display preset options on which page(s).
$pst->id = "admin_".$tablename;
}
require_once(e_ADMIN."auth.php");
$pst->save_preset(); // save and render result using unique name
require_once("../handler/form_handler.php");
$rs = new my_form;
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

$row = $pst->read_preset("admin_".$tablename); // read preset.
//++++++++++++++++++++++++++++++++
if(IsSet($_POST['edit']) || $action=="edit"){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}
		elseif($action=="edit"){$id_to_edit=$action_id;}
		else{$id_to_edit=$_POST['ID'];}
		$sql -> db_Select($tablename, "*", " $primaryid='".$id_to_edit."' ");
		$row = $sql-> db_Fetch();
}
//++++++++++++++++++++++++++++++++
if(IsSet($_POST['delete'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;		
}
if(isset($_POST['setstat']))
{
	$inputstr="mls_eigenschaften_enable='".$_POST['stat']."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
//++++++++++++++++++++++++++++++++
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$table_total = $sql -> db_Select($tablename);
// =================================================================
if(isset($_POST['edit']) || isset($_POST['new']) || $action=='edit' )
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


if(isset($_POST['edit']) || $action=="edit"){
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
$text .="<td class='fcaption'>IMG</td>";
for($i=0; $i< $fields-1; $i++)
	{if($i==2){continue;}
	$text .="<td class='fcaption'>".$fieldname[$i]."</td>";
	}
$text .= "<td class='fcaption' style='width:150px;'>Options</td></tr>";
$qry ="
 SELECT a.*, b.* FROM #mls_eigenschaften AS a
 LEFT JOIN #mls_eigen_kat AS b ON b.mls_eigen_kat_id=a.mls_eigenschaften_kat
 WHERE a.mls_eigenschaften_name !='' 
 ORDER by a.mls_eigenschaften_name
 ";
$sql->db_Select_gen($qry);
//$sql -> db_Select($tablename, "*", "$primaryid !='' ORDER BY $order_field");
while($row = $sql-> db_Fetch()){ // start loop 
			$text .= "<tr>";
$fieldname2[0]="mls_eigenschaften_name";
$fieldname2[1]="mls_eigen_kat_name";
$fieldname2[2]="";
$fieldname2[3]="mls_eigenschaften_enable";
$status_pfad[0]=e_PLUGIN.PLUG_FOLDER."images/off.png";
$status_pfad[1]=e_PLUGIN.PLUG_FOLDER."images/on.png";
$text .= "<td class='forumheader2'>";
$text .= get_prew_image2(ZUT_IMAGES_FOLDER.$row['mls_eigenschaften_img'],ZUT_IMAGES_FOLDER.$row['mls_eigenschaften_img'],$link="",$row['mls_eigenschaften_name'],400,30,e_PLUGIN.PLUG_FOLDER."images/default.gif");
$text .= "</td>";

			for($i=0; $i< $fields-2; $i++)
					{if($i==2){continue;}
					$text .="<td class='forumheader2'>".$row[$fieldname2[$i]]."</td>";
					}
			$IMG_PFAD=$status_pfad[$row['mls_eigenschaften_enable']];
			$stat_wert=($row['mls_eigenschaften_enable']=='1') ? 0:1;
			$text .= "<td class='forumheader2'>
									<form method='post' action='".e_SELF."' id='setstat_".$row[$primaryid]."'>
										<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$row[$primaryid]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
										<input type='hidden' name='ID' value='".$row[$primaryid]."'>
										<input type='hidden' name='stat' value='".$stat_wert."'>
									</form>	
										</td>";
			$text .= "<td class='forumheader2'>
								<form method='post' action='".e_SELF."' id='editform_".$row[$primaryid]."'>
										<input type='hidden' name='ID' value='".$row[$primaryid]."'>
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
