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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_saison_config.php $
|		$Revision: 0.87 $
|		$Date: 30.09.2011 09:58 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_saison_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_saison_config_lan.php");
require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SAISON_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SAISON_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_SAISON_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_SAISON_ADMIN_1;

    $tablename = "league_saison";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "saison_id";   // first column of your table.
    $e_wysiwyg = "saison_description"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "admin_saison";  // unique name that matches the one used in admin_menu.php.

    $fieldcapt[] = LAN_LEAGUE_SAISON_ADMIN_2;
    $fieldname[] = "saison_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_SAISON_ADMIN_3;
    $fieldname[] = "saison_beginn";
    $fieldtype[] = "datestamp"; // unix datestamp format.
    $fieldvalu[] = "1990~2020"; // [start-year,end-year] (optional) 
    
    $fieldcapt[] = LAN_LEAGUE_SAISON_ADMIN_4;
    $fieldname[] = "saison_end";
    $fieldtype[] = "datestamp"; // unix datestamp format.
    $fieldvalu[] = "1990~2020"; // [start-year,end-year] (optional)    
    
    $fieldcapt[] = LAN_LEAGUE_SAISON_ADMIN_5;
    $fieldname[] = "saison_description";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "~100%~250px";  // [default-text,width,height]

    $fieldcapt[] = LAN_LEAGUE_SAISON_ADMIN_22;
    $fieldname[] = "saison_order";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
///////////////----------------------------------------------
////////////////// Datensatz Sort setzen ////////////////////////
if($_POST['position_sel'])
{
	$Str="saison_order='".$_POST['position_sel']."' WHERE $primaryid='".$_POST['myID']."'";
	$message = ($sql -> db_Update($tablename, $Str)) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
////////////////// Datensatz Bearbeiten //////////////////////
if ($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
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
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_SAISON_ADMIN_6."' /></form></td></tr></table></div>";
	
	$configtitle=LAN_LEAGUE_SAISON_ADMIN_23."<b> ".$row['team_name']."</b>";	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method=\"post\" action=\"".e_SELF."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($fieldname[$i]=="saison_order")
			{$db_count=0;
			$sql -> db_Select($tablename, "*", " ".$primaryid."!=0");
			while($row = $sql-> db_Fetch())
				{$db_count++;}
			$text .= "<input class='tbox' type='text' name='".$fieldname[$i]."' size='5' value='".($db_count+1)."' readonly maxlength='20' />";	
			}
		else{
			$text .= $rs->user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);	
			}
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_SAISON_ADMIN_7."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_LEAGUE_SAISON_ADMIN_20."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			$year = $fieldname[$i]."_year";
			$month = $fieldname[$i]."_month";
			$day = $fieldname[$i]."_day";
			if($fieldtype[$i]=="date"){
					$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
        	}else {
					$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
        	}
					} else {
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
					}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
		}
/////////////////// Aktualisierung /////////////////////////
	if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
			{
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
				$year = $fieldname[$i]."_year";
				$month = $fieldname[$i]."_month";
				$day = $fieldname[$i]."_day";
       	if($fieldtype[$i]=="date"){
             $inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
            } else {
         	$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
					}
				} else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
///////////////////////////Tabelle mit vorhandenen Saisons zeigen. Ersmal Ãœberschrift...///////////////
 $text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_SAISON_ADMIN_14."</div></a>
 </form>
 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr><td class='fcaption' style='align:center;width:2%'>.</td>
	  <td class='fcaption' style='align:center;width:3%'>".LAN_LEAGUE_SAISON_ADMIN_8."</td>
	 	<td class='fcaption' style='align:left;width:25%'>".LAN_LEAGUE_SAISON_ADMIN_9."</td>
		<td class='fcaption' style='align: center;width:10%'>".LAN_LEAGUE_SAISON_ADMIN_10."</td>
		<td class='fcaption' style='align:center;width:10%'>".LAN_LEAGUE_SAISON_ADMIN_11."</td>
		<td class='fcaption' style='align:center;width:35%'>".LAN_LEAGUE_SAISON_ADMIN_12."</td>
		<td class='fcaption' style='align:center;width:25%'>".LAN_LEAGUE_SAISON_ADMIN_15."</td>
		<td class='fcaption' style='align:center;width:10%'>".LAN_LEAGUE_SAISON_ADMIN_21."</td>
	</tr>";

//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
$sql ->db_Select("league_saison","*","saison_name!='' ORDER BY saison_order DESC");
	 $coun=0;
	 while($row = $sql-> db_Fetch()){
	 		$saisondata[$coun]=$row;
	 		$coun++;
			}
	 	
for($i=0; $i< $coun; $i++)	 	
		{
			$text .="<tr><td class='forumheader3'>".($i+1)."</td>";
			$text .="<td class='forumheader3'>".$saisondata[$i]['saison_id']."</td>";
			$text .="<td class='forumheader3'>".$saisondata[$i]['saison_name']."</td>";
			$text .="<td class='forumheader3'>".strftime("%d.%b.%Y",$saisondata[$i]['saison_beginn'])."</td>";
			$text .="<td class='forumheader3'>".strftime("%d.%b.%Y",$saisondata[$i]['saison_end'])."</td>";
			$text .="<td class='forumheader3'>";
			$text .=$tp->toHTML($saisondata[$i]['saison_description'],TRUE);
			$text .="</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$saisondata[$i][$i]['saison_id']."'>
																				<a href='".e_SELF."?edit.".$saisondata[$i]['saison_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$saisondata[$i]['saison_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_SAISON_ADMIN_16." [".$saisondata[$i]['saison_name']."]')\"/></form></td>";
			$text .="<td class='forumheader2'>
								<form method='post' action='".e_SELF."' id='setstat_".$saisondata[$i][$primaryid]."'>
									<input type='hidden' name='myID' value='".$saisondata[$i][$primaryid]."'>";
			$text.=number_chose($saisondata[$i]['saison_order'], $coun);
			$text .="	</form>
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
///++++++++++++++++++++++++++++++++++++++++++++
function number_chose($number, $max)
{
$Ausgabe="<select name='position_sel' size='1' style='width:50px;font-size:9pt;' onChange='this.form.submit()'>";
for($i=1; $i <= $max; $i++)
		{
		$Ausgabe.="<option ";
		if($i==$number)
			{
			$Ausgabe.="selected ";
			}
		$Ausgabe.="value='".$i."'>";
		$Ausgabe.="".$i."</option>";
		}
$Ausgabe.="</select>";
return $Ausgabe;
}
?>