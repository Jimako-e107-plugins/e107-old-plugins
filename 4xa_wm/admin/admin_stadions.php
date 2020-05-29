<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_stadions.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}

require_once(e_ADMIN."auth.php");
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");
require_once("../settings/settings_stadions.php");
//require_once("../settings/settings_admen.php");

$ImageDELETE['PFAD']=e_PLUGIN."4xa_wm/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_025."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_024."' src='".$ImageEDIT['PFAD']."'>";



if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from); 
	unset($tmp);
}

// =================================================================
require_once("../form_handler.php");
$rs = new form;
/////===========================================================
if(isset($_POST['delete']))
	{
	$tmp = $_POST['delete'];
	list($delete, $del_id) = explode("_", $tmp);
	$del_id2=$_POST['ID'];
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id2."' ")) ? LAN_4xA_SPORTTIPPS_030 : LAN_4xA_SPORTTIPPS_031;
	}
////////////////////// Neu Erstellen ////////////////
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
			else{
				$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
				}
			}
		elseif($fieldtype[$i]=="checkbox_multi")
			{
			$sql -> db_Select("e4xA_ugl_data", "*", "e4xA_ugl_caption!='' ORDER BY e4xA_ugl_sort ");
			$inputstr .= " '";
			while($row = $sql-> db_Fetch())
				{
        if($_POST[$row['e4xA_ugl_caption']]=="on")
					{$inputstr .= $row['e4xA_param_id'];}
				$inputstr .= "~";
				}
			$inputstr .= "'";
			}		
		else{
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
			}
		$inputstr .= ($i < ($count -1)) ? "," : "";
		};
	$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_4xA_SPORTTIPPS_028 : LAN_4xA_SPORTTIPPS_029;
	}
	
///////////////////////////
if(IsSet($_POST['update']))
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
					$inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
					}
				else{
         		$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
					}
				}
			elseif($fieldtype[$i]=="checkbox_multi")
				{
				$sql -> db_Select("e4xA_ugl_data", "*", "e4xA_ugl_caption!='' ORDER BY e4xA_ugl_sort ");
				$inputstr .= " ".$fieldname[$i]." = '";
				while($row = $sql-> db_Fetch())
					{
					if($_POST[$row['e4xA_ugl_caption']]=="on")
						{$inputstr .=$row['e4xA_param_id'];}
					$inputstr .= "~";
					}
				$inputstr .= "'";
				}
			else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;
		}
///////////////////////////////////////////////////////////////////
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}

if($action == "neu")
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='".e_SELF."' id='adminform'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
		if($fieldtype[$i]=="checkbox_multi")
			{		
			$text .=multickeck_create($fieldvalu[$i]);
			}
		else{
			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
			}
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_4xA_SPORTTIPPS_048."' />
		</form><form method='post' action='".e_SELF."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_4xA_SPORTTIPPS_083."</b>";
	}
elseif($action == "edit")
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
		<input class='button' type='submit' id='update' name='update' value='".LAN_4xA_SPORTTIPPS_050."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' /></form></td></tr></table></div>";
	$configtitle="<b></b>";	
	}
///+++++++++++++++++++++++++
else{
$sql -> db_Select($tablename, "*", "$primaryid!=0");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
		$fcount_global++;
	}
$text .= "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".LAN_4xA_SPORTTIPPS_083."</a></div>
 </form>
 <br/> 
 <br/><b>".LAN_4xA_SPORTTIPPS_060."</b><br/>
 	<div style='width:96%'>
 		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_084."</td>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_085."</td>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_086."</td>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_087."</td>
								<td class='fcaption' width='100'>".LAN_4xA_SPORTTIPPS_056."</td>
   							</tr>";
if($fcount_global > 0)
  {
	$sql -> db_Select($tablename, "*", "$primaryid!=0");
    while($row = $sql-> db_Fetch())
			{
			$text .="<tr>
   				<td class='forumheader'>".$row[$primaryid]."</td>
   				<td class='forumheader'><img src='../img_stations/".$row['stadion_icon']."' alt='' title='' border='0'></td>
					<td class='forumheader'>".$row['stadion_name']."</td>
					<td class='forumheader'>".$row['stadion_ort']."</td>
					<td class='forumheader' width='100'><form method='post' action='".e_SELF."' id='editform'>
															<input type='hidden' name='ID' value='".$row[$primaryid]."'>
															<input type='image' title='".LAN_4xA_SPORTTIPPS_025."' name='delete[kat_{$row[$primaryid]}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_SPORTTIPPS_088." [".$row['stadion_name']."] ".LAN_4xA_SPORTTIPPS_089."')\"/> | 
															<a href='".e_SELF."?edit.".$row[$primaryid]."'>".$ImageEDIT['LINK']."</a>
															</form></td>
   				</tr>"; 	
			}
		}
else{
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".LAN_4xA_SPORTTIPPS_090."<br/><br/></td></tr>";
	}
$text .= "</table>";
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA- Sporttipps </a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";}

$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);
require_once(e_ADMIN."footer.php");


//////////////////////   Functionen   /////////////////////////////
function multickeck_create($table_data)
{
$AUSGABE="";
$AUS_DB= explode(",",$table_data);
$USER_DATA=explode("~",$table_data);
global $sql2;	
$sql2 -> db_Select($AUS_DB[0], "*", "".$AUS_DB[2]."!='' ORDER BY ".$AUS_DB[3]." ");
$par_count =0;
while($row = $sql2-> db_Fetch())
	{
	$AUSGABE.="<input type='checkbox' name='".$row[$AUS_DB[2]]."' ";
	$AUSGABE.=" > ".$row[$AUS_DB[2]]."<br/>";
	}
return $AUSGABE;
}
////////////////////
?>
