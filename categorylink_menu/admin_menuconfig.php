<?php
/*
+---------------------------------------------------------------+
|        e107 website system plugin
|        Category Links Menu Plugin
|        Created By: acidfire
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
$lan_file=e_PLUGIN."categorylink_menu/language/".e_LANGUAGE.".php";
if(file_exists($lan_file)){
	require_once($lan_file);
} else {
	require_once(e_PLUGIN."categorylink_menu/language/English.php");
}
// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++

  $preftitle = categorylink_MENU_1;
	$pageid = "menuconfig";

// Preference 1 Menu Name
    $prefcapt[] = categorylink_MENU_9;
    $prefname[] = "categorylink_title";
    $preftype[] = "text";
    $prefvalu[] = "";

// Preference 4 Images
    $prefcapt[] = categorylink_MENU_10;
    $prefname[] = "categorylink_display";
    $preftype[] = "radio";
    $prefvalu[] = "".categorylink_Option_3.",".categorylink_Option_4."";
    
// Preference 4 Images
    $prefcapt[] = categorylink_MENU_4;
    $prefname[] = "categorylink_images";
    $preftype[] = "radio";
    $prefvalu[] = "".categorylink_Option_1.",".categorylink_Option_2.""; 

// Preference 3 Expandit
    $prefcapt[] = categorylink_MENU_3;
    $prefname[] = "categorylink_expandit";
    $preftype[] = "radio";
    $prefvalu[] = "".categorylink_Option_1.",".categorylink_Option_2."";
    
// Preference 5 Table Class
    $prefcapt[] = categorylink_MENU_7;
    $prefname[] = "ctable_class";
    $preftype[] = "text";
    $prefvalu[] = "";

// Preference 2 Accesstable.
    $prefcapt[] = categorylink_MENU_2;
    $prefname[] = "menucategory_class";
    $preftype[] = "accesstable";
    $prefvalu[] = ""; 


//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
if(IsSet($_POST['updatesettings'])){
        $count = count($prefname);
        for ($i=0; $i<$count; $i++) {
        $namehere = $prefname[$i];
        if($preftype[$i]=="date" || $fieldtype[$i] == "datestamp"){
        $year = $prefname[$i]."_year";
        $month = $prefname[$i]."_month";
        $day = $prefname[$i]."_day";
    		if($fieldtype[$i]=="date"){
				$datevalue = $_POST[$year]."-".$_POST[$month]."-".$_POST[$day];
        	}else {
				$datevalue = mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year]);
        	}
        $pref[$namehere] = $datevalue;
        }else{

        $pref[$namehere] = $_POST[$namehere];
        }
        };
        save_prefs();
        $message = categorylink_MENU_5;
}
if($message){
        $ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}
require_once("form_handler.php");
$rs = new form;
$text = "<div style='text-align:center'>
<form method='post' action='".e_SELF."'>
<table style='width:94%' class='fborder'>";
for ($i=0; $i<count($prefcapt); $i++) {
        $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
        $text .="
        <tr>
        <td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
        <td style=\"width:70%\" class=\"forumheader3\">";
        $name = $prefname[$i];
        $text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);
        $text .="</td></tr>";
    };
    $text .="<tr style='vertical-align:top'>
    <td colspan='2'  style='text-align:center' class='forumheader'>
    <input class='button' type='submit' name='updatesettings' value='".categorylink_MENU_6."' />
    </td>
    </tr>
    </table>
    </form>
    </div>";
$ns -> tablerender($preftitle, $text);
require_once(e_ADMIN."footer.php");
?>
