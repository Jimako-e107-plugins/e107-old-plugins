<?php
/*
===============================================================
   GOOGLE Maps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

MAp Class from   www.phpinsider.com  ported for use on E107
===============================================================
+---------------------------------------------------------------+
|        e107 website system
|        Easy Admin Page by Cameron. (www.e107coders.org)
|        a part of Your_plugin v3.1  multilanguage by Juan  Reseau.li
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."google_maps/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."google_maps/languages/admin/English.php");
// ------------------------------

//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------
/*

$tablename:  eg. table name in your DB
$primaryid: the primary id and first column of your table.
$fieldcapt: The label or caption to be displayed for the field.
$fieldname: the name of the field in your table to display.
$fieldtype: choose from either: text,radio,checkbox, dropdown, date or table
$fieldvalu: the default values of the above- format changes depending on type.
 			see below for examples.


Simply duplicate the 4 "field...." values as many times as needed.
Note: You must have a group of 4 "fieldxxxx" options for every field in your table
        except for the primary id. (first column).

		The fields must be in the same order as your table.


*/

$class_map = '';
//get class info
$sql -> db_Select("userclass_classes ", "*");
while($row = $sql-> db_Fetch()){
        extract($row);
         $class_map .= $userclass_id  ;
         $class_map .= ':';
         $class_map .= $userclass_name ;
         $class_map .=',';
     }
//end get class

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "maps";

    $tablename = "google_maps";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "map_id";   // first column of your table.
    $e_wysiwyg = ""; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "google_maps_config";  // unique name that matches the one used in admin_menu.php.
	//$show_preset = FALSE; // allow e107 presets to be saved for use in the form.


// Field 1   - first field after the primary one.
    $fieldcapt[] = "Google API Number";
    $fieldname[] = "map_api";
    $fieldtype[] = "text";  // simple text box.
   $fieldvalu[] = "";


// Field 2
    $fieldcapt[] = "User Class to Show up on Map";
    $fieldname[] = "map_class";
    $fieldtype[] = "dropdown2";    // radio buttons
    $fieldvalu[] = "$class_map";   // [list of options]

// Field 3
    $fieldcapt[] = "Enable Map Control";
    $fieldname[] = "map_control";
    $fieldtype[] = "dropdown2";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "1:True, 0:False";  // [default-text,width,height]

// Field 4
    $fieldcapt[] = "Map Control Type";
    $fieldname[] = "map_control_type";
    $fieldtype[] = "dropdown2";     // simple checkbox.
    $fieldvalu[] = "0:Small, 1:Large";           // [checkbox value]

// Field 5
    $fieldcapt[] = "Enable Map Type Control";
    $fieldname[] = "map_type_control";
    $fieldtype[] = "dropdown2";  // color selector
    $fieldvalu[] = "1:True, 0:False";       // [not required]

// Field 6
    $fieldcapt[] = "Default Map Type";
    $fieldname[] = "map_type_default";
    $fieldtype[] = "dropdown2";     // read a directory.
    $fieldvalu[] = "1:Normal, 2:Satellite, 3:Hybrid";   // [path to directory]

// Field 7
    $fieldcapt[] = "Enable Scale Map Control";
    $fieldname[] = "map_scale_control";
    $fieldtype[] = "dropdown2";     // read a directory.
    $fieldvalu[] = "1:True, 0:False";   // [path to directory]


// Field 7
    $fieldcapt[] = "Enable Map Overview Control";
    $fieldname[] = "map_overview_control";
    $fieldtype[] = "dropdown2";     // read a directory.
    $fieldvalu[] = "1:True, 0:False";   // [path to directory]

// Field9
    $fieldcapt[] = "Default Map Zoom Level Default =16";
    $fieldname[] = "map_zoom";
    $fieldtype[] = "dropdown";     // read a directory.
    $fieldvalu[] = "0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17";   // [path to directory]

// Field10
    $fieldcapt[] = "Map Width: in px ex 500px ";
    $fieldname[] = "map_width";
    $fieldtype[] = "text";     // read a directory.
    $fieldvalu[] = "";   // [path to directory]

// Field11
    $fieldcapt[] = "Map Height: in px ex 500px";
    $fieldname[] = "map_height";
    $fieldtype[] = "text";     // read a directory.
    $fieldvalu[] = "";   // [path to directory]

    // Field12
	    $fieldcapt[] = "Enable Sidebar:";
	    $fieldname[] = "map_sidebar";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]


// Field13
	    $fieldcapt[] = "Enable Info Window:";
	    $fieldname[] = "map_infowindow";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]


// Field14
	    $fieldcapt[] = "Enable Directions:";
	    $fieldname[] = "map_directions";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]

// Field15
	    $fieldcapt[] = "Enable Email in Info Window:";
	    $fieldname[] = "map_email";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]

// Field16
	    $fieldcapt[] = "Enable Forum Post Count in Info Window:";
	    $fieldname[] = "map_posts";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]

// Field17
	    $fieldcapt[] = "Enable Member Since Count in Info Window:";
	    $fieldname[] = "map_member_since";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]

// Field18
	    $fieldcapt[] = "Enable Last Seen Count in Info Window:";
	    $fieldname[] = "map_lastseen";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]


// Field19
	    $fieldcapt[] = "Enable Avatar in Info Window:";
	    $fieldname[] = "map_avatar";
	    $fieldtype[] = "dropdown2";     // read a directory.
	    $fieldvalu[] = "1:True, 0:False";   // [path to directory]



if(file_exists(e_PLUGIN."google_maps/language/".e_LANGUAGE.".php")){
	@require_once(e_PLUGIN."google_maps/language/".e_LANGUAGE.".php");
}
// replace 'yourplugin_menu' with your own folder name;



//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------


$_POST['edit'] = '1';

require_once(e_ADMIN."auth.php");


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

$_POST['existing'] = 1;
if(IsSet($_POST['edit'])){
		$sql -> db_Select($tablename, "*", " $primaryid='".$_POST['existing']."' ");
		$row = $sql-> db_Fetch();

}

if(IsSet($_POST['delete'])){
		$message = ($sql -> db_Delete($tablename, "$primaryid='".$_POST['existing']."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}

if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}


$table_total = $sql -> db_Select($tablename);

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
		</td>
		</tr>";
}

$text .= "</table></form></div>";
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
		$text .= "<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'>";
}else{
		$text .= "<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />";
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
