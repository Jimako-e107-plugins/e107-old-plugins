<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Easy Admin Page by Cameron. (www.e107coders.org)
|        a part of Your_plugin v3.0
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		    Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file=e_PLUGIN."categorylink_menu/language/".e_LANGUAGE.".php";
if(file_exists($lan_file)){
	require_once($lan_file);
} else {
	require_once(e_PLUGIN."categorylink_menu/language/English.php");
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = categorylink_LINK_1;

    $tablename = "categorylink";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "categorylink_id";   // first column of your table.
    $e_wysiwyg = ""; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "categorylink";  // unique name that matches the one used in admin_menu.php.
	$show_preset = TRUE; // allow e107 presets to be saved for use in the form.


// Field 1 - Link Name
    $fieldcapt[] = categorylink_LINK_2;
    $fieldname[] = "categorylink_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
    
// Field 2 - Link
    $fieldcapt[] = categorylink_LINK_3;
    $fieldname[] = "categorylink_link";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
   
// Field 4 - Member Pool
    $fieldcapt[] = categorylink_LINK_18;
    $fieldname[] = "categorylink_cat";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "linkcategory,linkcategory_id,linkcategory_name"; // [table name,value-field,display-field]   
    
// Field 4 - Link
    $fieldcapt[] = categorylink_LINK_4;
    $fieldname[] = "categorylink_pic";
    $fieldtype[] = "image";    // image selection.
    $fieldvalu[] = e_PLUGIN."categorylink_menu/catimages/"; // [path to directory]

// Field 5 - Category Class
    $fieldcapt[] = categorylink_LINK_5;
    $fieldname[] = "categorylink_class";
    $fieldtype[] = "accesstable";
    $fieldvalu[] = "";  // (not required for date )    
    
// Field 6 - Link Open
    $fieldcapt[] = categorylink_LINK_19;
    $fieldname[] = "categorylink_open";
    $fieldtype[] = "open";
    $fieldvalu[] = "";  // (not required for date )
    
// Field 7 - Link Color
    $fieldcapt[] = categorylink_LINK_20;
    $fieldname[] = "categorylink_css";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";  
      

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

// -------- Presets. ------------  // always load before auth.php

if($show_preset){
require_once(e_HANDLER."preset_class.php");
$pst = new e_preset;
$pst->form = "categorylinkform"; // form id of the form that will have it's values saved.
$pst->page = e_SELF; // display preset options on which page(s).
$pst->id = "admin_".$tablename;
}


require_once(e_ADMIN."auth.php");
$pst->save_preset(); // save and render result using unique name
require_once("form_handler.php");
$rs = new form;


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
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? categorylink_LINK_6 : categorylink_LINK_7;
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

		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? categorylink_LINK_8 : categorylink_LINK_9;
}

$row = $pst->read_preset("admin_".$tablename); // read preset.

if(IsSet($_POST['edit'])){
		$sql -> db_Select($tablename, "*", " $primaryid='".$_POST['existing']."' ");
		$row = $sql-> db_Fetch();

}

if(IsSet($_POST['delete'])){ 
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$_POST['existing']."' ")) ? categorylink_LINK_10 : categorylink_LINK_11;
}

if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}


$table_total = $sql -> db_Select($tablename);

$text = "
<div style=\"text-align:center\">
<form method=\"post\" action=\"".e_SELF."\" id=\"existingmemberform\">
<table style=\"width:96%;margin-left:auto;margin-right:auto;\" class=\"fborder\">
<tr>
<td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">";

if(!$table_total){
		$text .= categorylink_LINK_12;
}else{

		$text .= "<span class=\"defaulttext\">".categorylink_LINK_13.":</span>
		<select name=\"existing\" class=\"tbox\">";
		while(list($the_id_, $the_name_) = $sql-> db_Fetch()){
			$text .= "<option value=\"$the_id_\">".$the_name_."</option>";
		}
		$text .= "</select>
		<input class=\"button\" type=\"submit\" name=\"edit\" value=\"".categorylink_LINK_14."\" />
		<input class=\"button\" type=\"submit\" name=\"delete\" value=\"".categorylink_LINK_15."\" onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL)."  ')\" />
";
}

$text .= "</td></tr></table></form></div>";
// =================================================================

$text .= "<div style=\"text-align:center\">\n";
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
		$text .= "<input class='button' type='submit' id='update' name='update' value='".categorylink_LINK_16."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'>";
}else{
		$text .= "<input class='button' type='submit' id='submitit' name='submitit' value='".categorylink_LINK_17."' />";
}

$text .= "</td>
</tr>
</table>
</form>
</div>
";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>
