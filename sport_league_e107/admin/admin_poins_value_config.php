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
|		$Source: ../e107_plugins/sport_LEAGUE_TEAMS_e107/admin/admin_poins_value_config.phpp $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_poins_value_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_poins_value_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_TEAMS_LEAGUE_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageEDIT['PFAD']."'>";

$favor=0;

if (e_QUERY) {
	list($action, $id) = explode(".", e_QUERY);
	$id = intval($id);
	unset($tmp);
}

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "Punkte und Strafen";

    $tablename = "league_points_value";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "points_value_id";   // first column of your table.
    $pageid = "poins_value";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_23;
    $fieldname[] = "points_value_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_24;
    $fieldname[] = "points_value_typ";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = "1:".LAN_TEAMS_LEAGUE_ADMIN_18."~2:".LAN_TEAMS_LEAGUE_ADMIN_19.""; // [table name,value-field,display-field]

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_25;
    $fieldname[] = "points_value_mat";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_TEAMS_LEAGUE_ADMIN_26;
    $fieldname[] = "points_value_description";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
$rs = new form;
///////////////////////Wenn Button "Neu" Gecklikt wird
if($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_TEAMS_LEAGUE_ADMIN_7."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_TEAMS_LEAGUE_ADMIN_20."</b>";
	}
//////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message =delete_liga_team($del_id);
}
////////////////// Datensatz Bearbeiten //////////////////////
if($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style='text-align:center'>\n";
	$text .= "<form method='post' action='".e_SELF."?list' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];

		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
						<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
 								<tr>
 									<td style='width:50%;text-align:right;padding:4px;'>
 										<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
										<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form></form>
 									</td>
 									<td style='width:50%text-align:left;padding:4px;'>
 										<form method='post' action='".e_SELF."?list' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_TEAMS_LEAGUE_ADMIN_7."' /></form>
 									</td>
 								</tr>
 							</table>
						</td>
					</tr>
				</table>
			</div>";
	
	$configtitle="<b>".LAN_TEAMS_LEAGUE_ADMIN_1."</b>";	
	}
/////////////////////// Update  /////////////////////
if(IsSet($_POST['update']))
{$inputstr ="";$count = count($fieldname);
	for ($i=0; $i<$count; $i++) 
		{
			$inputstr .=" ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
		}
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
////////////////////// Neu Erstellen ////////////////
	elseif(isset($_POST['submitit']))
		{$inputstr ="";
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		$message.=$inputstr;
		}
//////////////////////////////////////////////////////////////	
if($action != "neu" && $action != "edit" )
	{
	$sql -> db_Select("league_points_value", "*","points_value_name!='' ORDER BY points_value_id");
	$count=0;
	while($row = $sql-> db_Fetch())
		{
		$PVALUE[$count]['points_value_id']=$row['points_value_id'];
		$PVALUE[$count]['points_value_name']=$row['points_value_name'];
		$PVALUE[$count]['points_value_typ']=$row['points_value_typ'];
		$PVALUE[$count]['points_value_mat']=$row['points_value_mat'];
		$PVALUE[$count]['points_value_description']=$row['points_value_description'];
		$count++;
		}
//////////////////////+++++++++++++++++++++++++++++++++++++++++++
 $text = "<div style=\"text-align:center\">
 						<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
 							<tr>
 								<td class='fcaption' style='width:100%;text-align:right'>
 								 	<form method='post' action='".e_SELF."' id='neu'>
 								 		<div style='font-size: 14px;color:#00b42a;font-weight: bold;text-align: center'>
 											<a href='".e_SELF."?neu.".$id."'>".$ImageNEW['LINK']."  ".LAN_TEAMS_LEAGUE_ADMIN_9." </a>
 										</div>
 									</form>
 								</td>";
 	 $text .= "	</tr>
 						</table>
 					<br/>
 					<br/>
 				<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_8."</td>
	 	<td class='fcaption' style='text-align:center;width:5%'>".LAN_TEAMS_LEAGUE_ADMIN_10."</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_TEAMS_LEAGUE_ADMIN_11."</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_TEAMS_LEAGUE_ADMIN_12."</td>
		<td class='fcaption' style='text-align:left;'>".LAN_TEAMS_LEAGUE_ADMIN_13."</td>
		<td class='fcaption' style='text-align:center;width:20%'>".LAN_TEAMS_LEAGUE_ADMIN_15."</td>
	</tr>";
//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
$TYPTEXT[0]=LAN_TEAMS_LEAGUE_ADMIN_16; // Keine angaben
$TYPTEXT[1]=LAN_TEAMS_LEAGUE_ADMIN_18; // LAN_TEAMS_LEAGUE_ADMIN_18
$TYPTEXT[2]=LAN_TEAMS_LEAGUE_ADMIN_19;  // Strafe


	 for($i = 0; $i < $count; $i++){
	 	
	 		if($PVALUE[$i]['points_value_typ']==1){$ROWCOLOR="#0d0";}
	 		elseif($PVALUE[$i]['points_value_typ']==2){$ROWCOLOR="#dd0";}
			$text .="<tr>";
			$text .="<td class='forumheader3' style='background-color:".$ROWCOLOR."'>".$PVALUE[$i]['points_value_id']."</td>";
			$text .="<td class='forumheader3' style='background-color:".$ROWCOLOR."'>".$PVALUE[$i]['points_value_name']."</a></td>";
			$text .="<td class='forumheader3' style='background-color:".$ROWCOLOR."'>".$TYPTEXT[$PVALUE[$i]['points_value_typ']]."</td>";
			$text .="<td class='forumheader3' style='background-color:".$ROWCOLOR."'>".$PVALUE[$i]['points_value_mat']."</td>";
			$text .="<td class='forumheader3' style='background-color:".$ROWCOLOR."'>".$PVALUE[$i]['points_value_description']."</td>";
			$text .="<td class='forumheader3' style='text-align:center;'><form method='post' action='".e_SELF."?list' id='editform'>
																				<input type='hidden' name='T_ID' value='".$PVALUE[$i]['points_value_id']."'>
																				<a href='".e_SELF."?edit.".$PVALUE[$i]['points_value_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$PVALUE[$i]['points_value_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_TEAMS_LEAGUE_ADMIN_21." [ID-".$PVALUE[$i]['points_value_id']."] ".LAN_TEAMS_LEAGUE_ADMIN_22."')\"/></form>
																				</td>";												
			$text .="</tr>";
         }
 $text .= "</table>";
 }
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>
