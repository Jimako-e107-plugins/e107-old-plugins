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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_pref_menus.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_pref_menus_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_pref_menus_lan.php");

require_once("../functionen.php");
$ImageHELP['PFAD']=e_PLUGIN."sport_league_e107/images/system/help.png";
$ImageHELP['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PREFS_73."' src='".$ImageHELP['PFAD']."'>";

// ++++++++ ADMIN PREFERENCE CONFIGURATION +++++++++++++++++++++++++++++++++++++
$text="";
  $preftitle = LAN_LEAGUE_PREFS_1;// "Menüs- Voreinstellungen";
	$pageid = "prefs2";
 
//0
    $prefcapt[] = LAN_LEAGUE_PREFS_2;
    $prefname[] = "sport_league_last_games";
    $preftype[] = "text";
		$prefvalu[] = "~2";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_3;
//1
		$prefcapt[] = LAN_LEAGUE_PREFS_4;
    $prefname[] = "sport_league_next_games";
    $preftype[] = "radio";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_35."~2:".LAN_LEAGUE_PREFS_39."";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_5;
//2
		$prefcapt[] = LAN_LEAGUE_PREFS_6;
    $prefname[] = "sport_league_gamesmenu_scroll";
    $preftype[] = "checkbox";
		$prefvalu[] = "0";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_7;
//3
    $prefcapt[] = LAN_LEAGUE_PREFS_40;
    $prefname[] = "sport_league_menu_scorer_first";
    $preftype[] = "checkbox";
    $prefvalu[] = "0";
		$prefhelp[]	=	"";
//4
    $prefcapt[] = LAN_LEAGUE_PREFS_10;
    $prefname[] = "sport_league_menu_report_link";
    $preftype[] = "radio";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_11."~2:".LAN_LEAGUE_PREFS_12."~3:".LAN_LEAGUE_PREFS_13."";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_14;
//5
		$prefcapt[] = LAN_LEAGUE_PREFS_15;
    $prefname[] = "sport_league_L_N_logo_menu";
    $preftype[] = "radio";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_16."~2:".LAN_LEAGUE_PREFS_17."~3:".LAN_LEAGUE_PREFS_41."~4:".LAN_LEAGUE_PREFS_42."~5:".LAN_LEAGUE_PREFS_43."";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_18;
//6
		$prefcapt[] = LAN_LEAGUE_PREFS_19;
    $prefname[] = "sport_league_L_N_logo_w_menu";
    $preftype[] = "text";
		$prefvalu[] = "~3";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_20;
//7
		$prefcapt[] = LAN_LEAGUE_PREFS_21;
    $prefname[] = "sport_league_L_N_logo_h_menu";
    $preftype[] = "text";
		$prefvalu[] = "~3";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_22;
//8
    $prefcapt[] = LAN_LEAGUE_PREFS_23;
    $prefname[] = "sport_league_teamname_menu";
    $preftype[] = "radio";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_24."~2:".LAN_LEAGUE_PREFS_25."";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_26;
//9
		$prefcapt[] = LAN_LEAGUE_PREFS_27;
    $prefname[] = "sport_league_logo_menu";
    $preftype[] = "checkbox";
    $prefvalu[] = "0";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_28;
//10
		$prefcapt[] = LAN_LEAGUE_PREFS_19; //Breite
    $prefname[] = "sport_league_logo_w_menu";
    $preftype[] = "text";
		$prefvalu[] = "~3";
		$prefhelp[]	=	"";
//11
		$prefcapt[] = LAN_LEAGUE_PREFS_21;
    $prefname[] = "sport_league_logo_h_menu";
    $preftype[] = "text";
		$prefvalu[] = "~3";
		$prefhelp[]	=	"";
//12
		$prefcapt[] = LAN_LEAGUE_PREFS_29;
    $prefname[] = "sport_league_top_scorer";
    $preftype[] = "text";
		$prefvalu[] = "10~2";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_30;
//13
		$prefcapt[] = LAN_LEAGUE_PREFS_37;
    $prefname[] = "sport_league_my_last_or_next";
    $preftype[] = "checkbox";
		$prefvalu[] = "0";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_38;
//14
		$prefcapt[] = LAN_LEAGUE_PREFS_44;
    $prefname[] = "sport_league_Menu_wat_logo";
		$preftype[] = "radio";
		$prefvalu[] = "1:".LAN_LEAGUE_PREFS_45."~2:".LAN_LEAGUE_PREFS_46."";
		$prefhelp[]	=	LAN_LEAGUE_PREFS_47;
//15
		$prefcapt[] = "Last/Next- Game Menü, nur mein Team?";
    $prefname[] = "sport_league_gamesmenu_my_only";
    $preftype[] = "checkbox";
		$prefvalu[] = "0";
		$prefhelp[]	=	"";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
require_once("../form_handler.php");
$rs = new form;
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }

if(IsSet($_POST['updatesettings']))
	{
   $count = count($prefname);
   for ($i=0; $i<$count; $i++)
   		{
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
        }
       else{
        $pref[$namehere] = $_POST[$namehere];
        }
    };
    
///---------------------------------------
$ligasckekliste="";
for($i=0; $i< $_POST['ligaslist_count']; $i++)
	{
	if($_POST['ligaslist_'.$i.''])
		{		
  	$ligasckekliste.=$_POST['ligaslist_value_'.$i.'']."|"; 
		}
	}
 $pref['league_last_and_next_ligas']=$ligasckekliste;
///---------------------------------------- 
 save_prefs();
  $message = LAN_SETSAVED;
  }
if($message){
 	$ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
$text .="
<div style='text-align:center'>
	<table style='".USER_WIDTH."' class='fborder'>
	<form method='post' action='".e_SELF."'>
		<tr>
			<td style='width:100%' class='forumheader' colspan='2'><b>".LAN_LEAGUE_PREFS_31."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help1')\">".$ImageHELP['LINK']."</div>
						<div id='help1' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[0]."</div><b>".$prefcapt[0].": </b>";
				$form_send = $prefname[0] . "|" .$preftype[0]."|".$prefvalu[0];
				$name = $prefname[0];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);		
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help2')\">".$ImageHELP['LINK']."</div>
						<div id='help2' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[1]."</div><b>".$prefcapt[1].": </b><br/>";
				$form_send = $prefname[1] . "|" .$preftype[1]."|".$prefvalu[1];
				$name = $prefname[1];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);			
				$text .="</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help3')\">".$ImageHELP['LINK']."</div>
						<div id='help3' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br /><b>".$prefcapt[2]."</b>-".$prefhelp[2]."<br/><br/>
						<b>".$prefcapt[13]."</b>-".$prefhelp[13]."<br/><br/>
						<b>".LAN_LEAGUE_PREFS_48."</b>-".LAN_LEAGUE_PREFS_49."<br/><br/>
						</div>
				<table style='100%' border='0'>
					<tr>
						<td style='width:90%'><b>".$prefcapt[2]."</b></td>
						<td style='width:10%'>";
				$form_send = $prefname[2] . "|" .$preftype[2]."|".$prefvalu[2];
				$name = $prefname[2];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);
				$text .="</td>
				</tr>
					<tr>
						<td style='width:90%'><b>".$prefcapt[13]."</b></td>
						<td style='width:10%'>";
				$form_send = $prefname[13] . "|" .$preftype[13]."|".$prefvalu[13];
				$name = $prefname[13];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
					</tr>
				<tr>
						<td style='width:90%'><b>".$prefcapt[15]."</b></td>
						<td style='width:10%'>";
				$form_send = $prefname[15] . "|" .$preftype[15]."|".$prefvalu[15];
				$name = $prefname[15];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);
				$text .="</td>
				</tr>
				</table>";
	$text .= "<br/><b>".LAN_LEAGUE_PREFS_128."</b><br/>";
	$text .= ligas_cheklist($pref['league_last_and_next_ligas']);
	$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help4')\">".$ImageHELP['LINK']."</div>
						<div id='help4' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[4]."</div><b>".$prefcapt[4].":</b> <br /><br />";
				$form_send = $prefname[4] . "|" .$preftype[4]."|".$prefvalu[4];
				$name = $prefname[4];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
		</tr>		
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help5')\">".$ImageHELP['LINK']."</div>
						<div id='help5' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[5]."</div><b>".$prefcapt[5].":</b><br /><br />";
				$form_send = $prefname[5] . "|" .$preftype[5]."|".$prefvalu[5];
				$name = $prefname[5];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help7')\">".$ImageHELP['LINK']."</div>
						<div id='help7' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><b>".$prefcapt[14]."</b>-".$prefhelp[14]."<br /><b>".$prefhelp[7]."</b>-".$prefhelp[6]."<br></div><b>".$prefcapt[14]."</b><br/>";
				$form_send = $prefname[14] . "|" .$preftype[14]."|".$prefvalu[14];
				$name = $prefname[14];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<b>".$prefhelp[7]."</b><br/><table style='100%' border='0'>
					<tr>
						<td style='width:50%'>".$prefcapt[6]."</td>
						<td style='width:50%'>";
				$form_send = $prefname[6] . "|" .$preftype[6]."|".$prefvalu[6];
				$name = $prefname[6];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
					</tr>
					<tr>
						<td style='width:50%'>".$prefcapt[7]."</td>
						<td style='width:50%'>";
				$form_send = $prefname[7] . "|" .$preftype[7]."|".$prefvalu[7];
				$name = $prefname[7];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
		<tr>
			<td style='width:100%' class='forumheader' colspan='2'><b>".LAN_LEAGUE_PREFS_32."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help8')\">".$ImageHELP['LINK']."</div>
						<div id='help8' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[8]."</div><b>".$prefcapt[8].":</b> <br /><br />";
				$form_send = $prefname[8] . "|" .$preftype[8]."|".$prefvalu[8];
				$name = $prefname[8];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help9')\">".$ImageHELP['LINK']."</div>
						<div id='help9' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[9]."</div><b>".$prefcapt[9].":</b> ";
				$form_send = $prefname[9] . "|" .$preftype[9]."|".$prefvalu[9];
				$name = $prefname[9];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="<br />		
							<table style='100%' border='0'>
								<tr>
									<td style='width:50%'>".$prefcapt[10]."</td>
									<td style='width:50%'>";
				$form_send = $prefname[10] . "|" .$preftype[10]."|".$prefvalu[10];
				$name = $prefname[10];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
								</tr>
							<tr>
								<td style='width:50%'>".$prefcapt[11]."</td>
								<td style='width:50%'>";
				$form_send = $prefname[11] . "|" .$preftype[11]."|".$prefvalu[11];
				$name = $prefname[11];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .=" px</td>
							</tr>
						</table>
			</td>
		</tr>
		<tr>
			<td style='width:100%' class='forumheader' colspan='2'><b>".LAN_LEAGUE_PREFS_33."</b></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help12')\">".$ImageHELP['LINK']."</div>
						<div id='help12' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[12]."</div><b>".$prefcapt[12].":</b> ";
				$form_send = $prefname[12] . "|" .$preftype[12]."|".$prefvalu[12];
				$name = $prefname[12];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
			<td class='forumheader3' style='width:50%;vertical-align:top;'><div style='cursor:pointer' onclick=\"expandit('help13')\">".$ImageHELP['LINK']."</div>
						<div id='help13' style='display: none; border:1px dashed #65a4eb;color:#65a4eb;'><br />".$prefhelp[3]."</div><b>".$prefcapt[3].":</b> ";
				$form_send = $prefname[3] . "|" .$preftype[3]."|".$prefvalu[3];
				$name = $prefname[3];
				$text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);	
				$text .="</td>
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
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function ligas_cheklist($liga_prefs)
{
global $pref, $sql;

$sql -> db_Select("league_leagues", "*", "league_saison_id=".$pref['league_my_saison']."");
$ligas_count=0;
   while($row = $sql-> db_Fetch()){
				$ligas[$ligas_count]['id']=$row['league_id'];
				$ligas[$ligas_count]['name']=$row['league_name'];
				$ligas_count++;
				}	
for($i=0; $i< $ligas_count; $i++)
	{	
	$AUSGABE.="<input type='checkbox' name='ligaslist_".$i."' value='".$ligas[$i]['id']."'";
	if(ligas_cheked($liga_prefs,$ligas[$i]['id']))
		{
		$AUSGABE.=" checked='checked'";
		}
	$AUSGABE.=">".$ligas[$i]['name']."<input type='hidden' name='ligaslist_value_".$i."' value='".$ligas[$i]['id']."'><br/>";	
	}
$AUSGABE.="<input type='hidden' name='ligaslist_count' value='".$ligas_count."'>";
return	$AUSGABE;
}
///+++++++++++++++++++++++++++++++++++++++++++
function ligas_cheked($prefs,$id)
{
$my_ligas = explode("|", $prefs);
$lmy_ligas_count=count($my_ligas);
for($i=0; $i< $lmy_ligas_count; $i++)
	{		
	 if($my_ligas[$i]==$id)
	 	{
	 	return true;
	 	}
	}
return false;
///+++++++++++++++++++++++++++++++++++++++++++
}
?>
