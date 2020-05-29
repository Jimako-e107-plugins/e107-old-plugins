<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_teams_config.php $
|		$Revision: 0.87 $
|		$Date: 29.09.2011 16:40 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_teams_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_teams_config_lan.php");

require_once("../functionen.php");

$ImageNEW['PFAD']=e_PLUGIN."sport_league_e107/images/system/new_32.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_TEAMS_ADMIN_14."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_TEAMS_ADMIN_17."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_TEAMS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";


if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "<b>".LAN_LEAGUE_TEAMS_ADMIN_1."</b>";

    $tablename = "league_teams"; 
    $primaryid = "team_id";
    $e_wysiwyg = "team_description";
    $pageid = "admin_teams";


    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_2;// "Mannschafts- Name:"
    $fieldname[] = "team_name";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_3;// "Mannschafts- team_kurzname:"
    $fieldname[] = "team_kurzname";
    $fieldtype[] = "text";  
    $fieldvalu[] = "";

    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_4;//"Administrator für das Team";
    $fieldname[] = "team_admin_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "user~user_id~user_name";
   
    
    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_5;
    $fieldname[] = "team_url";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
    
    
    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_6;
    $fieldname[] = "team_icon";
    $fieldtype[] = "image";
    $fieldvalu[] = "../logos/";
    
    
    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_7;
    $fieldname[] = "team_description";
    $fieldtype[] = "textarea";
    $fieldvalu[] = "~90%~250px";
    
    $fieldcapt[] = LAN_LEAGUE_TEAMS_ADMIN_21;
    $fieldname[] = "team_stadion_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "league_stadions~stadions_id~stadions_name";

/////////////////////////////
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA

require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_TEAMS_ADMIN_22."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_LEAGUE_TEAMS_ADMIN_19."".$row['team_name']."</b>";	
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
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_TEAMS_ADMIN_23."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".LAN_LEAGUE_TEAMS_ADMIN_20."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp")
				{
				$year = $fieldname[$i]."_year";
				$month = $fieldname[$i]."_month";
				$day = $fieldname[$i]."_day";
				if($fieldtype[$i]=="date")
					{
					$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
    	   	}
      	 else
       		{
					$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
  	     	}
    	   } 
	     else
  	   	{
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
		for ($i=0; $i<$count; $i++) {

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
		};
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
///////////////////////////Tabelle mit vorhandenen Teams zeigen. Ersmal Überschrift...///////////////
 $text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".LAN_LEAGUE_TEAMS_ADMIN_14." </div></a>
 </form>
 <br/>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
	 $text .="<tr>
	  <td class='fcaption' style='text-align:center;width:50px'>".LAN_LEAGUE_TEAMS_ADMIN_8."</td>
		<td class='fcaption' style='text-align:center;width:50px'>".LAN_LEAGUE_TEAMS_ADMIN_9."</td>
		<td class='fcaption' style='text-align:center;width:50px'>".LAN_LEAGUE_TEAMS_ADMIN_9."-2</td>
		<td class='fcaption' style='text-align:left'>".LAN_LEAGUE_TEAMS_ADMIN_10."</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_LEAGUE_TEAMS_ADMIN_11.".</td>
		<td class='fcaption' style='text-align:center;width:15%'>".LAN_LEAGUE_TEAMS_ADMIN_13."</td>
		<td class='fcaption' style='text-align:center;width:5%'>Stadion</td>
		<td class='fcaption' style='text-align:center;width:100px'>".LAN_LEAGUE_TEAMS_ADMIN_15."</td>
	</tr>";

//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
   $qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_teams AS a 
   LEFT JOIN ".MPREFIX."user AS ae ON ae.user_id=a.team_admin_id   
   WHERE a.team_name !='' ORDER BY team_name
   		";
	$sql->db_Select_gen($qry1);
	 while($row = $sql-> db_Fetch()){
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$row['team_id']."</td>";
			$text .="<td class='forumheader3'><img border='0' src='../logos/".$row['team_icon']."' height='20'></td>";
			$text .="<td class='forumheader3'><img border='0' src='../logos/big/".$row['team_icon']."' height='20'></td>";
			$text .="<td class='forumheader3'>";
			if($row['team_url']!='')
			{$text .="<a href='".$row['team_url']."' ><b>".$row['team_name']."</b></a></td>";}
			else{$text .="".$row['team_name']."</td>";}
			$text .="<td class='forumheader3'>".$row['team_kurzname']."</td>";
			$text .="<td class='forumheader3'>".$row['user_name']."</td>";
			if($row['team_stadion_id']!=0){
				$text .="<td class='forumheader3' style='text-align:center;'><a href='admin_stadions_config.php?edit.".$row['team_stadion_id']."'><img border='0' src='../images/system/ok.gif'></a></td>";
				}else{$text .="<td class='forumheader3' style='text-align:center;'><img border='0' src='../images/system/no.gif'></td>";}
			
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row['team_id']."'>
																				<a href='".e_SELF."?edit.".$row['team_id']."'>".$ImageEDIT['LINK']."</a> | 
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$row['team_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_TEAMS_ADMIN_16." [".$row['team_name']."]')\"/></form></td></tr>";
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