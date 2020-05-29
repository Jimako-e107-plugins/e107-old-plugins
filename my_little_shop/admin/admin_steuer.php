<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/admin/admin_steuer.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/cat_lan.php");
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "Steuer werten erstellen";//"My Plugin - Configuration ";

    $tablename = "mls_steuer";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_steuer_id";   // first column of your table.
    $e_wysiwyg = ""; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "steuer";  // unique name that matches the one used in admin_menu.php.
	$show_preset = TRUE; // allow e107 presets to be saved for use in the form.


// Field 1   - first field after the primary one.
    $fieldcapt[] = "Steuer Bezeichnung";//"Steuer Bezeichnung";
    $fieldname[] = "mls_steuer_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 1   - first field after the primary one.
    $fieldcapt[] = "Steuer Wert dezimal <i>z.B. 19.09</i>";//Steuer Wert dezimal <i>z.B. 19.09</i>
    $fieldname[] = "mls_steuer_wert";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";


require_once(e_ADMIN."auth.php");
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
		<input class=\"button\" type=\"submit\" name=\"delete\" value=\"".LAN_DELETE."\" onclick=\"return jsconfirm('".$tp->toJS(LAN_CONFIRMDEL)."  ')\" />
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
