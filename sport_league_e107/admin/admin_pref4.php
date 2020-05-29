<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_pref4.php  $
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
$text="";
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$teamscount=0;
$sql -> db_Select("lique_liga", "*", "liga_saison_id='".$pref['lique_my_saison']."' ORDER BY liga_team_id");
 while($row = $sql-> db_Fetch()){
     $team[$teamscount]['id']=$row['liga_id'];
     $team[$teamscount]['team']=$row['liga_team_id'];
     $teamscount++;
      }
for($i=0; $i< $teamscount; $i++)
		{
		$sql -> db_Select("lique_teams", "*", "team_id='".$team[$i]['team']."'");
    while($row = $sql-> db_Fetch()){
        $team[$i]['TeamName']=$row['team_name'];
        }
			}
$Teamlist="";
for($i=0; $i< $teamscount; $i++)
		{
		$Teamlist.="".$team[$i]['id'].":".$team[$i]['TeamName']."~ ";
		}
// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++
  $preftitle = LAN_LEAGUE_PREFS_80;//Liga-Tabelle
	$pageid = "prefs4";

//0
		$prefcapt[0] = LAN_LEAGUE_PREFS_81;//Teamname in der Tabelle
    $prefname[0] = "sport_league_teamname_table";
    $preftype[0] = "dropdown2";
		$prefvalu[0] = "1:".LAN_LEAGUE_PREFS_24."~2:".LAN_LEAGUE_PREFS_25."";
		$prefhelp[0]	=	LAN_LEAGUE_PREFS_82;
//1
    $prefcapt[1] = LAN_LEAGUE_PREFS_83;//Logo in der Tabelle
    $prefname[1] = "sport_league_tab_logo";
    $preftype[1] = "checkbox";
    $prefvalu[1] = "0";
    $prefhelp[1]	=	LAN_LEAGUE_PREFS_84;
//2
		$prefcapt[2] = LAN_LEAGUE_PREFS_85;//Breite
    $prefname[2] = "sport_league_tab_W";
    $preftype[2] = "text";
		$prefvalu[2] = "~3";
		$prefhelp[2]	=	LAN_LEAGUE_PREFS_86;
//3
		$prefcapt[3] = LAN_LEAGUE_PREFS_87;//Höhe
    $prefname[3] = "sport_league_tab_H";
    $preftype[3] = "text";
		$prefvalu[3] = "~3";
		$prefhelp[3]	=	LAN_LEAGUE_PREFS_88;	
//4
		$prefcapt[4] = LAN_LEAGUE_PREFS_89;//KLASS- 1
    $prefname[4] = "sport_league_tab_style1";
    $preftype[4] = "dropdown2";
		$prefvalu[4] = "1:fcaption~2:forumheader~3:forumheader2~4:forumheader3~5:forumheader4";
		$prefhelp[4]	=	LAN_LEAGUE_PREFS_90;
//5
		$prefcapt[5] = LAN_LEAGUE_PREFS_91;//KLASS- 2
    $prefname[5] = "sport_league_tab_style2";
    $preftype[5] = "dropdown2";
		$prefvalu[5] = "1:fcaption~2:forumheader~3:forumheader2~4:forumheader3~5:forumheader4";
		$prefhelp[5]	=	LAN_LEAGUE_PREFS_92;
//6
		$prefcapt[6] = LAN_LEAGUE_PREFS_93;//KLASS- 3
    $prefname[6] = "sport_league_tab_style3";
    $preftype[6] = "dropdown2";
		$prefvalu[6] = "1:fcaption~2:forumheader~3:forumheader2~4:forumheader3~5:forumheader4";
		$prefhelp[6]	=	LAN_LEAGUE_PREFS_94;
//7
		$prefcapt[7] = LAN_LEAGUE_PREFS_95;//Mein Team extra
    $prefname[7] = "sport_league_tab_myteam";
    $preftype[7] = "checkbox";
		$prefvalu[7] = "0";
		$prefhelp[7]	=	LAN_LEAGUE_PREFS_96;
//8
		$prefcapt[8] = LAN_LEAGUE_PREFS_97;//Link
    $prefname[8] = "sport_league_tab_link";
    $preftype[8] = "dropdown2";
		$prefvalu[8] = "1:".LAN_LEAGUE_PREFS_98."~2:".LAN_LEAGUE_PREFS_99."~3:".LAN_LEAGUE_PREFS_100."";
		$prefhelp[8]	=	LAN_LEAGUE_PREFS_101;
//9
		$prefcapt[9] = LAN_LEAGUE_PREFS_102;//Erläuterungen anzeigen
    $prefname[9] = "sport_league_tab_erl";
    $preftype[9] = "checkbox";
		$prefvalu[9] = "0";
		$prefhelp[9]	=	LAN_LEAGUE_PREFS_103;
//10
		$prefcapt[10] = LAN_LEAGUE_PREFS_104;//Tabelle spalten
    $prefname[10] = "sport_league_tab_spalten";
    $preftype[10] = "checkbox";
		$prefvalu[10] = "0";
		$prefhelp[10]	=	LAN_LEAGUE_PREFS_105;
//11
		$prefcapt[11] = LAN_LEAGUE_PREFS_106;//Obere Grenze ab
    $prefname[11] = "sport_league_tab_spalt_ab";
    $preftype[11] = "text";
		$prefvalu[11] = "~3";
		$prefhelp[11]	=	LAN_LEAGUE_PREFS_107;
//12
		$prefcapt[12] = LAN_LEAGUE_PREFS_108;//Untere Grenze ab
    $prefname[12] = "sport_league_tab_spalt_bis";
    $preftype[12] = "text";
		$prefvalu[12] = "~3";
		$prefhelp[12]	=	LAN_LEAGUE_PREFS_109;
//13
		$prefcapt[13] = LAN_LEAGUE_PREFS_112;//Zebra- Effekt
    $prefname[13] = "sport_league_tab_zebra";
    $preftype[13] = "checkbox";
		$prefvalu[13] = "0";
		$prefhelp[13]	=	LAN_LEAGUE_PREFS_113;
//------------------------------------------------------------------------
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
require_once("../form_handler.php");
$rs = new form;
if(IsSet($_POST['updatesettings']))
	{
  $count = count($prefname);
  for ($i=0; $i<$count; $i++)
  	{
    $namehere = $prefname[$i];
    if($preftype[$i]=="date" || $fieldtype[$i] == "datestamp")
    	{
    	$year = $prefname[$i]."_year";
    	$month = $prefname[$i]."_month";
    	$day = $prefname[$i]."_day";
  		if($fieldtype[$i]=="date")
  			{
				$datevalue = $_POST[$year]."-".$_POST[$month]."-".$_POST[$day];
    		}else
    		{
				$datevalue = mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year]);
    		}
    	$pref[$namehere] = $datevalue;
    	}else
    	{
    	$pref[$namehere] = $_POST[$namehere];
    	}
    };
   save_prefs();
   $message = LAN_SETSAVED;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if($message)
	{
  $ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$text .="
<div style='text-align:center'>
	<table style='".USER_WIDTH."' class='fborder'>
	<form method='post' action='".e_SELF."'>
		<tr>
			<td class='forumheader' style='width:100%;text-align:center;' colspan='2'><b>".LAN_LEAGUE_PREFS_110."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help0')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help0' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[0]."</div><b>".$prefcapt[0].":</b> <br /><br />";
				$form_send = $prefname[0] . "|" .$preftype[0]."|".$prefvalu[0];
				$name = $prefname[0];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help2')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help2' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[1]."<br /><b>".$prefcapt[2]."</b>-".$prefhelp[2]."<br /><b>".$prefcapt[3]."</b>-".$prefhelp[3]."</div><b>".$prefcapt[1].":</b> ";
				$form_send = $prefname[1] . "|" .$preftype[1]."|".$prefvalu[1];
				$name = $prefname[1];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br />		
							<table style='100%' border='0'>
								<tr>
									<td style='width:50%'>".$prefcapt[2].":</td>
									<td style='width:50%'>";
				$form_send = $prefname[2] . "|" .$preftype[2]."|".$prefvalu[2];
				$name = $prefname[2];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
								</tr>
							<tr>
								<td style='width:50%'>".$prefcapt[3].":</td>
								<td style='width:50%'>";
				$form_send = $prefname[3] . "|" .$preftype[3]."|".$prefvalu[3];
				$name = $prefname[3];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
							</tr>
						</table>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help7')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help7' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[7]."</div><b>".$prefcapt[7].":</b>";
				$form_send = $prefname[7] . "|" .$preftype[7]."|".$prefvalu[7];
				$name = $prefname[7];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
			/*					
				$text .="<br /><div style='cursor:pointer' onclick=\"expandit('help9')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help9' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[9]."</div><b>".$prefcapt[9].":</b>";
				$form_send = $prefname[9] . "|" .$preftype[9]."|".$prefvalu[9];
				$name = $prefname[9];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br /><div style='cursor:pointer' onclick=\"expandit('help8')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help8' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[8]."</div><b>".$prefcapt[8].":</b>";
				$form_send = $prefname[8] . "|" .$preftype[8]."|".$prefvalu[8];
				$name = $prefname[8];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
			*/
				$text .="<br /></td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help4')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help4' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[4]."</div><b>".$prefcapt[4].":</b> ";
				$form_send = $prefname[4] . "|" .$preftype[4]."|".$prefvalu[4];
				$name = $prefname[4];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br /><br /><div style='cursor:pointer' onclick=\"expandit('help5')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help5' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[5]."</div><b>".$prefcapt[5].":</b> ";
				$form_send = $prefname[5] . "|" .$preftype[5]."|".$prefvalu[5];
				$name = $prefname[5];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br /><br /><div style='cursor:pointer' onclick=\"expandit('help6')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help6' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[6]."</div><b>".$prefcapt[6].":</b> ";
				$form_send = $prefname[6] . "|" .$preftype[6]."|".$prefvalu[6];
				$name = $prefname[6];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br /><br /></td>
					</tr>
					<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help13')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help13' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[13]."</div><b>".$prefcapt[13].":</b> <br /><br />";
				$form_send = $prefname[13] . "|" .$preftype[13]."|".$prefvalu[13];
				$name = $prefname[13];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help11')\"><img border='0' src='../images/system/help.png' style='float: left;'  title='Hilfe'></div>
						<div id='help11' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[10]."<br /><b>".$prefcapt[11]."</b>-".$prefhelp[11]."<br /><b>".$prefcapt[12]."</b>-".$prefhelp[12]."</div><b>".$prefcapt[10].":</b> ";
				$form_send = $prefname[10] . "|" .$preftype[10]."|".$prefvalu[10];
				$name = $prefname[10];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br />		
							<table style='100%' border='0'>
								<tr>
									<td style='width:50%'>".$prefcapt[11].":</td>
									<td style='width:50%'>";
				$form_send = $prefname[11] . "|" .$preftype[11]."|".$prefvalu[11];
				$name = $prefname[11];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" ".LAN_LEAGUE_PREFS_111."</td>
								</tr>
							<tr>
								<td style='width:50%'>".$prefcapt[12].":</td>
								<td style='width:50%'>";
				$form_send = $prefname[12] . "|" .$preftype[12]."|".$prefvalu[12];
				$name = $prefname[12];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" ".LAN_LEAGUE_PREFS_111."</td>
							</tr>
						</table>
			</td>
		</tr>";


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
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
?>