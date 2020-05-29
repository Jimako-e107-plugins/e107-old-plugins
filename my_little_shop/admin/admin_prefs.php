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
|		$Source: ../e107_plugins/my_little_shop/admin/admin_prefs.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/prefs_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/prefs_lan.php");
//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

  $preftitle = MLS_PREFS_LAN_0;// "My Plugin - Preferences";
	$pageid = "prefs";
    $e_wysiwyg = "my_little_shop_begruesung,my_little_shop_AGB"; // commas seperated list of textareas to use wysiwyg with.

// Preference 1 using radio options.
    $prefcapt[] = MLS_PREFS_LAN_1;//"Anzahl der Produkte in dem Last Product Menü <b>KLEIN!</b>
    $prefname[] = "my_little_shop_men_shmall";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:1,2:2,3:3,4:4,5:5,6:6,7:7,8:8,9:9,10:10"; // [value:display-text, value2:display-text2 etc]


    $prefcapt[] = MLS_PREFS_LAN_2;//"Anzahl der Spalten in dem Last Product Menü <b>GROß!</b>
    $prefname[] = "my_little_shop_men_row";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:1,2:2,3:3,4:4,5:5,6:6"; // [value:display-text, value2:display-text2 etc]


    $prefcapt[] = MLS_PREFS_LAN_3;//"Anzahl der Spalten in dem Last Product Menü <b>GROß!</b>
    $prefname[] = "my_little_shop_men_col";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:1,2:2,3:3,4:4,5:5,6:6"; // [value:display-text, value2:display-text2 etc]

    $prefcapt[] = MLS_PREFS_LAN_4;//"Anzahl der <b>Zeilen</b> in dem Kategorien- Übersicht
    $prefname[] = "my_little_shop_kat_row";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:1,2:2,3:3,4:4,5:5,6:6"; // [value:display-text, value2:display-text2 etc]


    $prefcapt[] = MLS_PREFS_LAN_5;//Anzahl der <b>Spalten</b> in dem Kategorien- Übersicht
    $prefname[] = "my_little_shop_kat_col";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:1,2:2,3:3,4:4,5:5,6:6"; // [value:display-text, value2:display-text2 etc]

    $prefcapt[] = MLS_PREFS_LAN_6;//Lager Schwelen wert <i>ab wann soll der Ampel Rot zeigen</i>
    $prefname[] = "my_little_shop_lager";
    $preftype[] = "text";
		$prefvalu[] = ""; // [value:display-text, value2:display-text2 etc]

    $prefcapt[] = MLS_PREFS_LAN_7;//"Begrüßung auf der erste Seite des Shops
    $prefname[] = "my_little_shop_begruesung";
    $preftype[] = "textarea";
		$prefvalu[] = ",100%,300px"; // [value:display-text, value2:display-text2 etc]
		
		$prefcapt[] = "AGB";//"Begrüßung auf der erste Seite des Shops
    $prefname[] = "my_little_shop_AGB";
    $preftype[] = "textarea";
		$prefvalu[] = ",100%,300px"; // [value:display-text, value2:display-text2 etc]

    $prefcapt[] = MLS_PREFS_LAN_8; //Pfad zu dem Web_Admin
    $prefname[] = "my_little_shop_webadmin";
    $preftype[] = "text";
		$prefvalu[] = ""; // [value:display-text, value2:display-text2 etc]
		
		
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


require_once("../handler/form_handler.php");
$rs = new my_form;
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
    <input class='button' type='submit' name='updatesettings' value='".LAN_ADM_MYS_94."' />
    </td>
    </tr>
    </table>
    </form>
    <table style='width:94%' class='fborder'>
				<tr>
						<td colspan='2'  style='text-align:center' class='forumheader'><form method='get' action='admin_steuer.php'><input class='button' type='submit' name='steuer' value='".MLS_PREFS_LAN_9."' /></form>
				 </td>
				 		<td colspan='2'  style='text-align:center' class='forumheader'>";//<form method='get' action='admin_zahlung.php'><input class='button' type='submit' name='zahlung' value='".MLS_PREFS_LAN_10."' />
			$text .="</td>
				 		<td colspan='2'  style='text-align:center' class='forumheader'>";//<form method='get' action='admin_porto.php'><input class='button' type='submit' name='porto' value='".MLS_PREFS_LAN_11."' />
			$text .="</td>
   		 </tr></table>
    </div>";
$text.=powered_by_shop();
$ns -> tablerender($preftitle, $text);

require_once(e_ADMIN."footer.php");

?>
