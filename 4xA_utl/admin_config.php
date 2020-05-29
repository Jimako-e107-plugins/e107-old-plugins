<?php
/*
+---------------------------------------------------------------+
|	4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/admin_config.php
|
|        For the e107 website system
|        Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!getperms("P")){
   header("location:".e_HTTP."index.php");
   exit;
}
// ------------------------------
if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from); 
	unset($tmp);
}
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_utl/languages/German.php");

$ImageDELETE['PFAD']=e_PLUGIN."4xA_utl/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".e4xA_UTL_DELET."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."4xA_utl/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".e4xA_UTL_EDIT."' src='".$ImageEDIT['PFAD']."'>";

$sql -> db_Select("e4xA_utl_param", "*", "e4xA_param_name!='' ORDER BY e4xA_param_sort ");
$par_count =0;
while($row = $sql-> db_Fetch())
	{
	$SACHBEREICH[$row['e4xA_param_id']]=$row['e4xA_param_name'];	
	}
$STATUS[1]=e4xA_UTL_STAT_1;
$STATUS[2]=e4xA_UTL_STAT_2;
$STATUS[3]=e4xA_UTL_STAT_3;
// +++++++++++++++++++++++++++++++++++++++++++++++++++++
    $configtitle = e4xA_UTL_MY_TEAM;
    $tablename = "e4xA_utl_data";
    $primaryid = "e4xA_utl_id";
    $e_wysiwyg = "";
    $pageid = "first";
	$show_preset = FALSE;

// Field 1   - first field after the primary one.
    $fieldcapt[] = e4xA_UTL_USER_SELECT;
    $fieldname[] = "e4xA_utl_user_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "user,user_id,user_name";
// Field 2
    $fieldcapt[] = e4xA_UTL_STATUS_SELECT;
    $fieldname[] = "e4xA_utl_status";
    $fieldtype[] = "dropdown2";
    $fieldvalu[] = "1:".e4xA_UTL_STAT_1.",2:".e4xA_UTL_STAT_2.",3:".e4xA_UTL_STAT_3."";
// Field 3
    $fieldcapt[] = e4xA_UTL_ENABLE_SELECT;
    $fieldname[] = "e4xA_utl_enable";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "";
// Field 4
    $fieldcapt[] = e4xA_UTL_PARAM_SELECT;
    $fieldname[] = "e4xA_utl_para";
    $fieldtype[] = "checkbox_multi";
    $fieldvalu[] = "e4xA_utl_param,e4xA_param_id,e4xA_param_name,e4xA_param_sort";
 // Field 5
    $fieldcapt[] = e4xA_UTL_DESC_SELECT;
    $fieldname[] = "e4xA_utl_text";
    $fieldtype[] = "textarea";
    $fieldvalu[] = ",100%,300px";
// Field 6
    $fieldcapt[] = e4xA_UTL_SORT_SELECT;
    $fieldname[] = "e4xA_utl_sort";
    $fieldtype[] = "text";
    $fieldvalu[] = ""; 
//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
require_once("form_handler.php");
$rs = new form;
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
	{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
	}
//////////////////////////////////////////////////////
if(isset($_POST['sort']))
	{
	$inputstr="e4xA_utl_sort='".$_POST['sort']."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
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
			$sql -> db_Select("e4xA_utl_param", "*", "e4xA_param_name!='' ORDER BY e4xA_param_sort ");
			$inputstr .= " '";
			while($row = $sql-> db_Fetch())
				{
        		if($_POST[$row['e4xA_param_name']]=="on")
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
	$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
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
		if($fieldtype[$i]=="checkbox_multi")
			{
			$text .=multickeck_edit($fieldvalu[$i],$row[$fieldname[$i]]);	
			}	
		else{
	 		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
	 		}
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".e4xA_UTL_BACK."' /></form></td></tr></table></div>";
	$configtitle="<b>".e4xA_UTL_EDIT."</b>";	
	}
///////////////////////Wenn Button "Neu" Geklickt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
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
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='".e_SELF."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_CANCEL."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".MLS_LAN_MANUF_10."</b>";
	}
///+++++++++++++++++++++++++
else{
/////////////////// Aktualisierung /////////////////////////
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
				$sql -> db_Select("e4xA_utl_param", "*", "e4xA_param_name!='' ORDER BY e4xA_param_sort ");
				$inputstr .= " ".$fieldname[$i]." = '";
				while($row = $sql-> db_Fetch())
					{
					if($_POST[$row['e4xA_param_name']]=="on")
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
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
////////////////////////////////  DS Auflisten  ///////////////////////////////////////////////////
$sql -> db_Select($tablename, "*", "".$fieldname[0]."!=''");			
$fcount_global=0;   
while($row = $sql-> db_Fetch())
    {
	$fcount_global++;
	}
$text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".e4xA_UTL_CREATE_USER."</a></div>
 </form>
 <br/> 
 <br/><b>".e4xA_UTL_TABLE_CAPTION."</b><br/><div style='width:96%'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='fcaption' width='70' colspan='2'>".e4xA_UTL_ID."</td>
   							<td class='fcaption' width='40'>".e4xA_UTL_NAME."</td>
								<td class='fcaption'>".e4xA_UTL_NICK."</td>
								<td class='fcaption' width='200'>".e4xA_UTL_BEREICHE."</td>
								<td class='fcaption'>".e4xA_UTL_STATUS."</td>		
								<td class='fcaption'>".e4xA_UTL_DESC."</td>
								<td class='fcaption' width='100'>".e4xA_UTL_OPTIONS."</td>
   							</tr>";
if($fcount_global > 0)
  {
	$qry="
   	SELECT a.*, ab.* FROM ".MPREFIX."e4xA_utl_data AS a
   	LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=a.e4xA_utl_user_id
   	WHERE a.e4xA_utl_user_id !='' ORDER BY a.e4xA_utl_sort
		";
	$sql->db_Select_gen($qry);
    while($row = $sql-> db_Fetch())
		{
		$SACHBEREICHE="";
		$tmpll=explode("~", $row['e4xA_utl_para']);
		for($i=0; $i< count($tmpll); $i++)
			{
			if($tmpll[$i])
				{
				$SACHBEREICHE.=$SACHBEREICH[$tmpll[$i]];
				$SACHBEREICHE.=", ";
				}
			}
		$DESC=$tp -> toHTML($row['e4xA_utl_text'], TRUE, '', '');
		$text .="<tr>
   					<td class='forumheader' width='70' colspan='2'>".$row['user_id']."</td>
   					<td class='forumheader' width='40'>".$row['user_loginname']."</td>
					<td class='forumheader'>".$row['user_name']."</td>
					<td class='forumheader' width='200'>".$SACHBEREICHE."</td>
					<td class='forumheader'>".$STATUS[$row['e4xA_utl_status']]."</td>		
					<td class='forumheader'>".$DESC."</td>
					<td class='forumheader' width='100'><form method='post' action='".e_SELF."' id='editform'>
															<input type='hidden' name='ID' value='".$row['e4xA_utl_id']."'>
															<input type='image' title='".LAN_DELETE."' name='delete[kat_{$row['e4xA_utl_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".e4xA_UTL_DELET_CONFIRM1." [".$row['user_name']."] ".e4xA_UTL_DELET_CONFIRM2."')\"/> | 
															<a href='".e_SELF."?edit.".$row['e4xA_utl_id']."'>".$ImageEDIT['LINK']."</a>
															".get_sort_box($row['e4xA_utl_sort'], $fcount_global, 'sort')."
															</form></td>
   				</tr>"; 	
		}
	}
else{
	$text .="<tr>".$fields_count_global."<td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".e4xA_UTL_NO_USER."<br/><br/></td></tr>";
	}
$text .= "</table></div>";
}
///////////////////////////Tabelle ///////////////
/*
"""Benutzte Felder die zur Verfügung stehen!!!!
  user_id
  user_name
  user_loginname		//R Name
  user_customtitle
  user_password
  user_sess			//Foto
  user_email
  user_signature
  user_image 		//Avatar
  user_timezone
  user_hideemail
  user_join
  user_lastvisit
  user_currentvisit
  user_lastpost
  user_chats
  user_comments
  user_forums
  user_ip
  user_ban
  user_prefs
  user_new
  user_viewed
  user_visits
  user_admin
  user_login
  user_class
  user_perms
  user_realm
  user_pwchange
  user_xup
*/
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler.
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt.
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text.="<br/><div style='text-align:center;font-size:90%;'>.:: powered by 4xA-UTL from <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>e107-Templates</a> ::.</div>";
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
$ns->tablerender($configtitle, $text);
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
///////////++++++++++++++++++++++++++++++++++++++++++++
function multickeck_edit($table_data,$from_user)
{
$AUSGABE="";
$AUS_DB= explode(",",$table_data);
$USER_DATA=explode("~",$from_user);
global $sql2;	
$sql2 -> db_Select($AUS_DB[0], "*", "".$AUS_DB[2]."!='' ORDER BY ".$AUS_DB[3]." ");
$par_count =0;
while($row = $sql2-> db_Fetch())
	{
	$AUSGABE.="<input type='checkbox' name='".$row[$AUS_DB[2]]."'";
	if(ckeck_data($row[$AUS_DB[1]],$USER_DATA))
		{
		$AUSGABE.=" checked='checked'";
		}	
	$AUSGABE.=" > ".$row[$AUS_DB[2]]."<br/>";
	}	
return $AUSGABE;
}
//////+++++++++++++++++++++++++++++++++++++++++++++++++
function ckeck_data($AUS_DB,$from_user)
{
for($i=0; $i< count($from_user);$i++ )
	{
	if($AUS_DB==$from_user[$i])
		{
		return true;
		}
	}	
return false;		
}
/////////////
function get_sort_box($index, $count, $box_name)
{
$Ausgabe="<select class='tbox' name='".$box_name."' style='width:40px;' onChange='this.form.submit()'>";
for($i=1; $i < $count+1; $i++)
	{
	$Ausgabe .="<option value='".$i."' ".(($i==$index) ?" selected='selected'":"").">".$i."</option>";
	} 
$Ausgabe .="</select>";
return $Ausgabe;
}
?>