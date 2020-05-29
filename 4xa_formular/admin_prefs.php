<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/admin_prefs.php
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
//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++

    $preftitle = LAN_4xA_FORM_04;// "My Plugin - Preferences";
		$pageid = "prefs";
		$e_wysiwyg = "e4xA_form_emails_text";

// Preference 1 using radio options.
    $prefcapt[] = LAN_4xA_FORM_20;//;
    $prefname[] = "e4xA_form_caption";
    $preftype[] = "text";
    $prefvalu[] = "";

// Preference 2 using a accesstable.
    $prefcapt[] = LAN_4xA_FORM_21;//;
    $prefname[] = "e4xA_form_submit_user";
    $preftype[] = "accesstable";
    $prefvalu[] = "";  // (not required for date )

// Preference 3 using a accesstable.
    $prefcapt[] = LAN_4xA_FORM_26;//;
    $prefname[] = "e4xA_form_emails_send";
    $preftype[] = "checkbox";
    $prefvalu[] = "1"; 

// Preference 4 using a accesstable.
    $prefcapt[] = LAN_4xA_FORM_27;//;
    $prefname[] = "e4xA_form_emails_text";
    $preftype[] = "textarea";
    $prefvalu[] = ";100%;250px";
    
// Preference 5 using a accesstable.
    $prefcapt[] = LAN_4xA_FORM_102;//;
    $prefname[] = "e4xA_form_text";
    $preftype[] = "textarea";
    $prefvalu[] = ";100%;250px"; 

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
        $message = LAN_SETSAVED;
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
    <input class='button' type='submit' name='updatesettings' value='".LAN_4xA_FORM_22."' />
    </td>
    </tr>
    </table>
    </form>
    </div>";
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:80%;'>.:: powered by 4xA-Formular from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////  
$ns -> tablerender($preftitle, $text);
require_once(e_ADMIN."footer.php");

?>
