<?php
/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// ajout de la page dans class2.php
require_once("../../class2.php");

// verifie si l'utilisateur est un admin, redirige sur l'index du site sinon
if (!getperms("P")) {
header("location:".e_HTTP."index.php");
exit;
}

// id de la page pour le menu navigation
$pageid = "advanced_bbcodes_prefs_affichage";

// multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

$advanced_bbcodes_path = e_PLUGIN.'advanced_bbcodes/';

// titre de la page
    $preftitle = "".LAN_ADVANCED_BBCODES_PREFS_AFFICHAGE."";

// ligne bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_LIGNE_NEWS."";
    $prefname[] = "advanced_bbcodes_ligne_news";
    $preftype[] = "radio";
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// roller bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_ROLLER_NEWS."";
    $prefname[] = "advanced_bbcodes_roller_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// strike bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_STRIKE_NEWS."";
    $prefname[] = "advanced_bbcodes_strike_news";
    $preftype[] = "radio";
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";

// hide bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_HIDE_NEWS."";
    $prefname[] = "advanced_bbcodes_hide_news";
    $preftype[] = "radio";
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";	
	
// googlevideo bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_GVIDEO_NEWS."";
    $prefname[] = "advanced_bbcodes_gvideo_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";

// youtube bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_YOUTUBE_NEWS."";
    $prefname[] = "advanced_bbcodes_youtube_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// dailymotion bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_DAILYMOTION_NEWS."";
    $prefname[] = "advanced_bbcodes_dailymotion_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";

// metacafe bbcode
    $prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_METACAFE_NEWS."";
    $prefname[] = "advanced_bbcodes_metacafe_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// acronym bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_ACRONYM_NEWS."";
    $prefname[] = "advanced_bbcodes_acronym_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";

// lecteur mp3 bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_MP3_NEWS."";
    $prefname[] = "advanced_bbcodes_mplayer_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";

// parchemin bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_PARCHEMIN_NEWS."";
    $prefname[] = "advanced_bbcodes_parchemin_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// spoiler bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_SPOILER_NEWS."";
    $prefname[] = "advanced_bbcodes_sp_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
// toolfaq bbcode
	$prefcapt[] = "".LAN_ADVANCED_BBCODES_PREFS_TOOLFAQ_NEWS."";
    $prefname[] = "advanced_bbcodes_toolfaq_news";
    $preftype[] = "radio"; 
    $prefvalu[] = "".LAN_ADVANCED_BBCODES_YES.",".LAN_ADVANCED_BBCODES_NO."";
	
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

require_once("form_handler.php");
$rs = new form;
$text = "<div style='text-align:center'>
<form method='post' action='".e_SELF."'>
<table style='width:94%' class='fborder'>";

for ($i=0; $i<count($prefcapt); $i++) {
        $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
        $text .="
        <tr>
        <td style=\"width:64%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i]."</td>
        <td style=\"width:30%\" class=\"forumheader3\">";
        $name = $prefname[$i];
        $text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);
        $text .="</td></tr>";
    };


    $text .="<tr style='vertical-align:top'>
    <td colspan='2'  style='text-align:center' class='forumheader'>
    <input class='button' type='submit' name='updatesettings' value='".LAN_ADVANCED_BBCODES_ADMIN_SAVE."' title='".LAN_ADVANCED_BBCODES_ADMIN_SAVE_TITLE."' />
    </td>
	</tr>
    </table>
    </form>
    </div>";
	
	
$ns -> tablerender($preftitle, $text);

require_once(e_ADMIN."footer.php");

?>