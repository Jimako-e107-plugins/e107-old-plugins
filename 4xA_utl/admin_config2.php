<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/admin_config2.php
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
if (!getperms("P")) {
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
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = e4xA_UTL_AUFG_ED;//"";

    $tablename = "e4xA_utl_param";
    $primaryid = "e4xA_param_id";
    $e_wysiwyg = "";
    $pageid = "sekond";
	$show_preset = FALSE;

// Field 1   - first field after the primary one.
    $fieldcapt[] = e4xA_UTL_AUFG_NAME;//
    $fieldname[] = "e4xA_param_name";
    $fieldtype[] = "text";  //
    $fieldvalu[] = "";
// Field 2    
    $fieldcapt[] = e4xA_UTL_AUFG_SORT;//
    $fieldname[] = "e4xA_param_sort";
    $fieldtype[] = "text";  //
    $fieldvalu[] = "";
// Field 3    
    $fieldcapt[] = e4xA_UTL_AUFG_IMG;//
    $fieldname[] = "e4xA_param_img";
    $fieldtype[] = "image";  //
    $fieldvalu[] = e_PLUGIN."4xA_utl/logos/";
//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
require_once("form_handler.php");
$rs = new form;
//////////////////////////////////////////////////////////////77
if(isset($_POST['sort']))
{
$inputstr="e4xA_param_sort='".$_POST['sort']."'";
$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
$tmp = array_keys($_POST['delete']);
list($delete, $del_id) = explode("_", $tmp[0]);
$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
/////////////////////////////////////////////////////
if (isset($_POST['updatepagesets'])) 
{
$pref['4xA_utl_acces_class'] = $_POST['4xA_utl_acces_class'];
$pref['4xA_utl_css_class'] = $_POST['4xA_utl_css_class'];
$pref['4xA_utl_colls'] = $_POST['4xA_utl_colls'];
$pref['4xA_utl_show'] = $_POST['4xA_utl_show'];
$pref['4xA_utl_show_main'] = $_POST['4xA_utl_show_main'];
save_prefs();
$message = EINSTELLUNGEN_GESCHPEICHERT;	
}
////////////////////// Neu Erstellen ////////////////
if(isset($_POST['submitit']))
	{
	$count = count($fieldname);
	for ($i=0; $i<$count; $i++) 
		{
		if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
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
	else{
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
		}
	$inputstr .= ($i < ($count -1)) ? "," : "";
	};
	$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
	}
echo $inputstr;
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".e4xA_UTL_BACK."' /></form></td></tr></table></div>";
	$configtitle="<b></b>";	
	}
///////////////////////Wenn Button "Neu" geklickt wird soll Formular erschenen!! /////////////////////////
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
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
	$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='".e_SELF."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_CANCEL."' /></form></td></tr></table></div>";
	$configtitle="<b>".e4xA_UTL_CREATE_AUFG2."</b>";
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
			else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
		}
//////////////////////////////////TS-Auflisten//////////////////////////////////
$sql -> db_Select($tablename, "*", "".$fieldname[0]."!=''");			
$fcount_global=0;   
while($row = $sql-> db_Fetch())
    {
	$fcount_global++;
	}
$text = "<div style='text-align:center'>
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".e4xA_UTL_CREATE_AUFG."</a></div>
 </form>
 <br/> 
 <br/><b>".e4xA_UTL_TABLE_CAPTION."</b><br/>
 			<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>
   							<tr>
   							<td class='fcaption' width='50'>".e4xA_UTL_ID."</td>
   							<td class='fcaption' width='50'>".e4xA_UTL_SORT."</td>
   							<td class='fcaption' width='50'>".e4xA_UTL_IMG."</td>
   							<td class='fcaption'>".e4xA_UTL_BEZ."</td>
								<td class='fcaption' width='100'>".e4xA_UTL_OPTIONS."</td>
   							</tr>";
if($fcount_global > 0 )
	{
	$sql -> db_Select($tablename, "*", "".$primaryid."!='' ORDER BY ".$fieldname[1]."");	
    while($row = $sql-> db_Fetch())
        {
		$text .="<tr>
   					<td class='forumheader' width='70'>".$row['e4xA_param_id']."</td>
   					<td class='forumheader' width='70'>".$row['e4xA_param_sort']."</td>
   					<td class='forumheader'><img border='0' style='vertical-align:middle;width:30px;' title='' src='".e_PLUGIN."4xA_utl/logos/".$row['e4xA_param_img']."'/></td>
						<td class='forumheader'>".$row['e4xA_param_name']."</td>
						<td class='forumheader' width='100'><form method='post' action='".e_SELF."' id='editform'>
															<input type='hidden' name='ID' value='".$row['e4xA_param_id']."'>
															<input type='image' title='".LAN_DELETE."' name='delete[kat_{$row['e4xA_param_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".e4xA_UTL_DELET_CONFIRM1." [".$row['e4xA_param_name']."] ".e4xA_UTL_DELET_CONFIRM2."')\"/> | 
															<a href='".e_SELF."?edit.".$row['e4xA_param_id']."'>".$ImageEDIT['LINK']."</a>
															".get_sort_box($row['e4xA_param_sort'], $fcount_global, 'sort')."
															</form></td>
   				</tr>"; 	
		}
	}
else{
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".e4xA_UTL_NO_AUFG."<br/><br/></td></tr>";
	}
$text .= "</table></div>";

//////////////////////////  Voreinstellungen ////////////////////////////////////////////////////
$text.="<br/><br/>
<form method='post' action='".e_SELF."'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>
		<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".e4xA_UTL_PREF_SELECT."</td>
       </tr>
       <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_UTL_PREF_ACESS."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_useracces_dd()."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_UTL_PREF_SCC."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class()."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_UTL_PREF_PRO_COL."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols()."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_UTL_SHOW_AS."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_show()."</td>
 		</tr>
  	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_UTL_GROUP_AS."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_show_main()."</td>
 		</tr>		 		
		<tr>
			<td colspan='2' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".SPEICHERN."' /></div></td>
     	</tr>
	</table>
</form></div>";
}
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
//////////////////////  Functionen //////////////////////////////////////////////////
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
//////////////////////////
function get_useracces_dd()
{
global $sql,$pref;
$ret ="<select class='tbox' style='width:250px'  name='4xA_utl_acces_class'><option></option>";
$checked = ($pref['4xA_utl_acces_class'] == 0)? " selected='selected'" : "";
$ret .="<option value='0' $checked >".JEDER."</option>"; 							//Jeder
$checked = ($pref['4xA_utl_acces_class'] == 252)? " selected='selected'" : "";
$ret .="<option value='252' $checked >".NUR_MITGLIEDER."</option>"; 						//Nur Mitglieder
$checked = ($pref['4xA_utl_acces_class'] == 254)? " selected='selected'" : "";
$ret .="<option value='254' $checked >".NUR_ADMIN."</option>";							//Nur Admins
$checked = ($pref['4xA_utl_acces_class'] == 255)? " selected='selected'" : "";
$ret .="<option value='255' $checked >".KEINER."</option>";							//keiner (inaktiv)
$sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
while($row = $sql-> db_Fetch())
	{
	extract($row);
	$checked = ($userclass_id == $pref['4xA_utl_acces_class'])? " selected='selected' " : "";
    $ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
    }
$ret .="</select>";
return $ret;
}
////////////////////
function get_css_class()
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='4xA_utl_css_class'><option></option>";
$checked = ($pref['4xA_utl_css_class'] == "fcaption")? " selected='selected'" : "";
$ret .="<option value='fcaption' $checked >fcaption</option>";
$checked = ($pref['4xA_utl_css_class'] == "forumheader")? " selected='selected'" : "";
$ret .="<option value='forumheader' $checked >forumheader</option>";
$checked = ($pref['4xA_utl_css_class'] == "forumheader2")? " selected='selected'" : "";
$ret .="<option value='forumheader2' $checked >forumheader2</option>";
$checked = ($pref['4xA_utl_css_class'] == "forumheader3")? " selected='selected'" : "";
$ret .="<option value='forumheader3' $checked >forumheader3</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_cols()
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='4xA_utl_colls'>";
$checked = ($pref['4xA_utl_colls'] == 1)? " selected='selected'" : "";
$ret .="<option value='1' $checked >1</option>";
$checked = ($pref['4xA_utl_colls'] == 2)? " selected='selected'" : "";
$ret .="<option value='2' $checked >2</option>";
$checked = ($pref['4xA_utl_colls'] == 3)? " selected='selected'" : "";
$ret .="<option value='3' $checked >3</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_show()
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='4xA_utl_show'>";
$checked = ($pref['4xA_utl_show'] == 1)? " selected='selected'" : "";
$ret .="<option value='1' $checked >".e4xA_UTL_TEXT_ONLY."</option>";
$checked = ($pref['4xA_utl_show'] == 2)? " selected='selected'" : "";
$ret .="<option value='2' $checked >".e4xA_UTL_IMG_ONLY."</option>";
$checked = ($pref['4xA_utl_show'] == 3)? " selected='selected'" : "";
$ret .="<option value='3' $checked >".e4xA_UTL_IMG_AND_TEXT."</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_show_main()
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='4xA_utl_show_main'>";
$checked = ($pref['4xA_utl_show_main'] == 1)? " selected='selected'" : "";
$ret .="<option value='1' $checked >".e4xA_UTL_TO_USER."</option>";
$checked = ($pref['4xA_utl_show_main'] == 2)? " selected='selected'" : "";
$ret .="<option value='2' $checked >".e4xA_UTL_TO_CATEGORIES."</option>";
$ret .="</select>";
return $ret;
}
?>