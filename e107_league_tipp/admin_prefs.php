<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipp_admin_prefs_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipp_admin_prefs_lan.php");
//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------
if($pref['league_tipp_saison_or_liga']=='1'){$Table_L="league_saison,saison_id,saison_name";}
else{$Table_L="league_leagues,league_id,league_name";}

    $preftitle = LAN_LEAGUE_TIPP_ADMIN_PREF_1;
		$pageid = "prefs";

    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_2;
    $prefname[] = "league_tipp_saison_or_liga";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:".LAN_LEAGUE_TIPP_ADMIN_PREF_3.",2:".LAN_LEAGUE_TIPP_ADMIN_PREF_4."";

    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_5;
    $prefname[] = "league_tipp_saison";
    $preftype[] = "table";
    $prefvalu[] = $Table_L; 
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_6;
    $prefname[] = "league_tipp_treffer";
    $preftype[] = "text";  //
    $prefvalu[] = ""; //
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_7;
    $prefname[] = "league_tipp_treffer_color";
    $preftype[] = "color";  //
    $prefvalu[] = ""; //
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_8;
    $prefname[] = "league_tipp_tendenz";
    $preftype[] = "text";  //
    $prefvalu[] = ""; //
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_9;
    $prefname[] = "league_tipp_tendenz_color";
    $preftype[] = "color";  //
    $prefvalu[] = ""; //
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_10;
    $prefname[] = "league_tipp_tabelgames_color";
    $preftype[] = "color";  //
    $prefvalu[] = ""; //

    $prefcapt[] = "Farbe bei Kein Ergäbniss liegt vor";
    $prefname[] = "league_tipp_noresult_color";
    $preftype[] = "color";  //
    $prefvalu[] = ""; //

    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_11;
    $prefname[] = "league_tipp_tabelgames";
    $preftype[] = "text";  //
    $prefvalu[] = ""; //
    
    
    $prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_12;
    $prefname[] = "league_tipp_timeout";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:".LAN_LEAGUE_TIPP_ADMIN_PREF_13.",5:".LAN_LEAGUE_TIPP_ADMIN_PREF_14.",10:".LAN_LEAGUE_TIPP_ADMIN_PREF_15.",30:".LAN_LEAGUE_TIPP_ADMIN_PREF_16.",60:".LAN_LEAGUE_TIPP_ADMIN_PREF_17.",120:".LAN_LEAGUE_TIPP_ADMIN_PREF_18."";
		
		$prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_19;
    $prefname[] = "league_tipp_user_acc";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:".LAN_LEAGUE_TIPP_ADMIN_PREF_20.",2:".LAN_LEAGUE_TIPP_ADMIN_PREF_21."";
		
		$prefcapt[] = LAN_LEAGUE_TIPP_ADMIN_PREF_23;
    $prefname[] = "league_tipp_week";
    $preftype[] = "dropdown2";
		$prefvalu[] = "1:".LAN_LEAGUE_TIPP_ADMIN_PREF_24.",2:".LAN_LEAGUE_TIPP_ADMIN_PREF_25.",3:Feste Vorgabe (bitte unten angeben)";	
		
    $prefcapt[] = "Anzal der Spiele pro Seite";
    $prefname[] = "league_tipp_tabelcount";
    $preftype[] = "text";  //
    $prefvalu[] = ""; //
	
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
    <input class='button' type='submit' name='updatesettings' value='".LAN_LEAGUE_TIPP_ADMIN_PREF_22."' />
    </td>
    </tr>
    </table>
    </form>
    	<br/><br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
			<br/>
    </div>";

$ns -> tablerender($preftitle, $text);
require_once(e_ADMIN."footer.php");
?>