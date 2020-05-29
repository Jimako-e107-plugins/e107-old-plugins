<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_prefs.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 16:50 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_prefs_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_prefs_lan.php");
require_once("../functionen.php");

// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++
$text="";
  $preftitle = LAN_LEAGUE_PREFS_0;// "My Plugin - Preferences";
	$pageid = "prefs";

    $prefcapt[] = LAN_LEAGUE_PREFS_3;
    $prefname[] = "league_sport";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_1."~2:".LAN_LEAGUE_PREFS_2."";
		
		$prefcapt[] = LAN_LEAGUE_PREFS_6;
    $prefname[] = "league_my_saison";
    $preftype[] = "table";
		$prefvalu[] = "league_saison~saison_id~saison_name"; 

    $prefcapt[] = LAN_LEAGUE_PREFS_8;
    $prefname[] = "league_my_team_only";
    $preftype[] = "checkbox";
    $prefvalu[] = "0";
    
    $prefcapt[] = LAN_LEAGUE_PREFS_14;//
    $prefname[] = "league_count_gamestermine";
    $preftype[] = "text";
    $prefvalu[] = "0";  
/////////// Formular ------------------------

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
  //    echo $namehere." = ".$_POST[$namehere]."<br>";
  //      echo $namehere." = ".$datevalue;
        };

        save_prefs();
        $message = LAN_SETSAVED;
	

}

if($message){
        $ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}


require_once("../form_handler.php");
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
    <input class='button' type='submit' name='updatesettings' value='".LAN_LEAGUE_PREFS_34."' />
    </td>
    </tr>
    </table>
    </form>
    </div>";
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($preftitle, $text);

require_once(e_ADMIN."footer.php");

?>
