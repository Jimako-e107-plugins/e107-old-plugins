<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_pref2.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/prefs_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/prefs_lan.php");

require_once("../functionen.php");

$ImageHELP['PFAD']=e_PLUGIN."sport_league_e107/images/system/help.png";
$ImageHELP['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PREFS_73."' src='".$ImageHELP['PFAD']."'>";


//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------
// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++

  $preftitle = LAN_LEAGUE_PREFS_40;//
	$pageid = "prefs3";

//0
    $prefcapt[0] = LAN_LEAGUE_PREFS_41;//Spiel Verlängerung
    $prefname[0] = "sport_league_game_un";
    $preftype[0] = "checkbox";
    $prefvalu[0] = "0";
    $prefhelp[0]	=	LAN_LEAGUE_PREFS_42;
//1
		$prefcapt[1] = LAN_LEAGUE_PREFS_43;//Puntke Unentschieden
    $prefname[1] = "sport_league_game_unistun";
    $preftype[1] = "text";
		$prefvalu[1] = "~3";
		$prefhelp[1]	=	LAN_LEAGUE_PREFS_44;
//2
		$prefcapt[2] = LAN_LEAGUE_PREFS_45;//Sieger- Punkte
    $prefname[2] = "sport_league_points_winer";
    $preftype[2] = "text";
		$prefvalu[2] = "~3";
		$prefhelp[2]	=	LAN_LEAGUE_PREFS_46;
//3
		$prefcapt[3] = LAN_LEAGUE_PREFS_47;//Verlierer- Punkte
    $prefname[3] = "sport_league_points_louser";
    $preftype[3] = "text";
		$prefvalu[3] = "~3";
		$prefhelp[3]	=	LAN_LEAGUE_PREFS_48;
//4		
		$prefcapt[4] = LAN_LEAGUE_PREFS_49;//Sieger n.P- Punkte
    $prefname[4] = "sport_league_points_winer2";
    $preftype[4] = "text";
		$prefvalu[4] = "~3";
		$prefhelp[4]	=	LAN_LEAGUE_PREFS_50;
//5		
		$prefcapt[5] = LAN_LEAGUE_PREFS_51;//Verlierer n.P- Punkte
    $prefname[5] = "sport_league_points_louser2";
    $preftype[5] = "text";
		$prefvalu[5] = "~3";
		$prefhelp[5]	=	LAN_LEAGUE_PREFS_52;
//6		
		$prefcapt[6] = LAN_LEAGUE_PREFS_56;//Anzahl der Perioned / Halbzeiten
    $prefname[6] = "sport_league_periods";
    $preftype[6] = "text";
		$prefvalu[6] = "~3";
		$prefhelp[6]	=	LAN_LEAGUE_PREFS_57;
//7	
		$prefcapt[7] = LAN_LEAGUE_PREFS_58;//Spieldauer pro Period / Halbzeit
    $prefname[7] = "sport_league_times";
    $preftype[7] = "text";
		$prefvalu[7] = "~5";
		$prefhelp[7]	=	LAN_LEAGUE_PREFS_59;
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------


if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
require_once("../form_handler.php");
$rs = new form;
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

$text ="
<div style='text-align:center'>
	<table style='".USER_WIDTH."' class='fborder'>
	<form method='post' action='".e_SELF."'>
		<tr>
			<td class='forumheader' style='width:100%;text-align:center;' colspan='2'><b>".LAN_LEAGUE_PREFS_53."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help0')\">".$ImageHELP['LINK']."</div>
						<div id='help0' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[0]."</div><b>".$prefcapt[0].":</b> ";
				$form_send = $prefname[0] . "|" .$preftype[0]."|".$prefvalu[0];
				$name = $prefname[0];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
					<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help1')\">".$ImageHELP['LINK']."</div>
						<div id='help1' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[1]."</div><b>".$prefcapt[1].":</b> ";
				$form_send = $prefname[1] . "|" .$preftype[1]."|".$prefvalu[1];
				$name = $prefname[1];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
		</tr>		
		<tr>
			<td class='forumheader' style='width:100%;text-align:center;' colspan='2'><b>".LAN_LEAGUE_PREFS_54."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help2')\">".$ImageHELP['LINK']."</div>
						<div id='help2' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[2]."</div><b>".$prefcapt[2].":</b> ";
				$form_send = $prefname[2] . "|" .$preftype[2]."|".$prefvalu[2];
				$name = $prefname[2];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help3')\">".$ImageHELP['LINK']."</div>
						<div id='help3' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[3]."</div><b>".$prefcapt[3].":</b> ";
				$form_send = $prefname[3] . "|" .$preftype[3]."|".$prefvalu[3];
				$name = $prefname[3];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
		</tr>
		<tr>
			<td class='forumheader' style='width:100%;text-align:center;' colspan='2'><b>".LAN_LEAGUE_PREFS_55."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help4')\">".$ImageHELP['LINK']."</div>
						<div id='help4' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[4]."</div><b>".$prefcapt[4].":</b> ";
				$form_send = $prefname[4] . "|" .$preftype[4]."|".$prefvalu[4];
				$name = $prefname[4];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help5')\">".$ImageHELP['LINK']."</div>
						<div id='help5' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[5]."</div><b>".$prefcapt[5].":</b> ";
				$form_send = $prefname[5] . "|" .$preftype[5]."|".$prefvalu[5];
				$name = $prefname[5];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help6')\">".$ImageHELP['LINK']."</div>
						<div id='help6' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[6]."</div><b>".$prefcapt[6].":</b> ";
				$form_send = $prefname[6] . "|" .$preftype[6]."|".$prefvalu[6];
				$name = $prefname[6];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help7')\">".$ImageHELP['LINK']."</div>
						<div id='help7' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[7]."</div><b>".$prefcapt[7].":</b> ";
				$form_send = $prefname[7] . "|" .$preftype[7]."|".$prefvalu[7];
				$name = $prefname[7];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" ".LAN_LEAGUE_PREFS_36." </td>
		</tr>
";

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
///++++++++++++++++++++++++++++++++++++++++

?>