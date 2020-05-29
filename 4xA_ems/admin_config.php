<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/admin_config.php
| 	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunsta
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

if (!getperms("P")) {
   header("location:".e_HTTP."index.php");
      exit;
}

$lan_file = e_PLUGIN."4xA_ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");
require_once(e_ADMIN."auth.php");

$fields = get_user_fields();
$fields_count= count($fields);
/*

"""Benutzte Felder die zur Verfügung stehen!!!!

user_extended_struct_id
user_extended_struct_name
user_extended_struct_text
user_extended_struct_type
user_extended_struct_parms 
user_extended_struct_values 
user_extended_struct_read
user_extended_struct_write
user_extended_struct_required
user_extended_struct_signup
user_extended_struct_applicable
user_extended_struct_order
user_extended_struct_parent

e4xA_ems_id
e4xA_ems_field_name
e4xA_ems_enable
e4xA_ems_para varchar
e4xA_ems_sort

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

if (isset($_POST['updatepagesets'])) {
	$pref['4xA_ems_UL']= (($_POST['user_login']) ? 1 : 2);
	$pref['4xA_ems_BN']= (($_POST['user_name']) ? 1 : 2);
	$pref['4xA_ems_UI']= (($_POST['user_image']) ? 1 : 2);
	$pref['4xA_ems_UF']= (($_POST['user_sess']) ? 1 : 2);
	$pref['4xA_ems_OS']= (($_POST['onlinestat']) ? 1 : 2);
	$pref['4xA_ems_UL_S'] = $_POST['sort_user_login'];
	$pref['4xA_ems_BN_S'] = $_POST['sort_user_name'];
	$pref['4xA_ems_UI_S'] = $_POST['sort_user_image'];
	$pref['4xA_ems_UF_S'] = $_POST['sort_user_sess'];
	$pref['4xA_ems_UF_S'] = $_POST['sort_onlinestat'];
	
	$pref['4xA_ems_UL_N'] = $_POST['text_user_login'];
	$pref['4xA_ems_BN_N'] = $_POST['text_user_name'];
	$pref['4xA_ems_UI_N'] = $_POST['text_user_image'];
	$pref['4xA_ems_UF_N'] = $_POST['text_user_sess'];
	$pref['4xA_ems_OS_N'] = $_POST['text_onlinestat'];
	
	$pref['4xA_ems_ausgabe'] = $_POST['4xA_ems_ausgabe'];
	$pref['4xA_ems_rows'] = $_POST['4xA_ems_rows'];
	$pref['4xA_ems_cels'] = $_POST['4xA_ems_cels'];
	$pref['4xA_ems_acces_class'] = $_POST['4xA_ems_acces_class'];
	$pref['4xA_ems_css_class'] = $_POST['4xA_ems_css_class'];
	$pref['4xA_ems_burt_field'] = $_POST['4xA_ems_burt_field'];
	$pref['4xA_ems_gen_field'] = $_POST['4xA_ems_gen_field'];
  save_prefs();
	$message = EINSTELLUNGEN_GESCHPEICHERT;
	
	}
	
$sys_user_fields[1]['sort']=$pref['4xA_ems_BN_S'];
$sys_user_fields[1]['name']='user_name';
$sys_user_fields[1]['text']=e4xA_EMS_SYS_01;
$sys_user_fields[1]['opt_text']=$pref['4xA_ems_BN_N'];
$sys_user_fields[1]['value']=$pref['4xA_ems_BN'];

$sys_user_fields[2]['sort']=$pref['4xA_ems_UL_S'];
$sys_user_fields[2]['name']='user_login';
$sys_user_fields[2]['text']=e4xA_EMS_SYS_02;
$sys_user_fields[2]['opt_text']=$pref['4xA_ems_UL_N'];
$sys_user_fields[2]['value']=$pref['4xA_ems_UL'];

$sys_user_fields[3]['sort']=$pref['4xA_ems_UI_S'];
$sys_user_fields[3]['name']='user_image';
$sys_user_fields[3]['text']=e4xA_EMS_SYS_03;
$sys_user_fields[3]['opt_text']=$pref['4xA_ems_UI_N'];
$sys_user_fields[3]['value']=$pref['4xA_ems_UI'];

$sys_user_fields[4]['sort']=$pref['4xA_ems_UF_S'];
$sys_user_fields[4]['name']='user_sess';
$sys_user_fields[4]['text']=e4xA_EMS_SYS_04;
$sys_user_fields[4]['opt_text']=$pref['4xA_ems_UF_N'];
$sys_user_fields[4]['value']=$pref['4xA_ems_UF'];

$sys_user_fields[5]['sort']=$pref['4xA_ems_OS_S'];
$sys_user_fields[5]['name']='onlinestat';
$sys_user_fields[5]['text']=e4xA_EMS_SYS_05;
$sys_user_fields[5]['opt_text']=$pref['4xA_ems_OS_N'];
$sys_user_fields[5]['value']=$pref['4xA_ems_OS'];


$fields_count_global=5;
$text = "
	<div style='text-align:center'>
  	<form method='post' action='".e_SELF."'>
 			<table style='width:100%' class='fborder'>
 			<tr>
      	  <td style='vertical-align:top;' colspan='5' class='fcaption'>".SYSTEM_BENUTZER_FELDER."</td>
        </tr>";
			for($i=1;$i< (count($sys_user_fields)+1); $i++){
				$text .= get_system_field($sys_user_fields[$i]['name'],$sys_user_fields[$i]['text'],$sys_user_fields[$i]['value'],$fields_count_global,$sys_user_fields[$i]['sort'],$sys_user_fields[$i]['opt_text']);
				}
///++++++++++++++++++++++++++++++++++++++++++++++
$fields_count_global=$fields_count;
if (isset($_POST['updatepagesets'])) {
	for($i=0; $i < $fields_count; $i++)
		{
		$FieldName=$fields[$i]['user_extended_struct_name'];
		$sortfield="sort_".$FieldName."";
		$parfield="typ_".$FieldName."";
		$namepost="text_".$FieldName."";
		$fields[$i]['e4xA_ems_enable']=(($_POST[$FieldName]) ? 1 : 2);
		$fields[$i]['e4xA_ems_sort']=$_POST[$sortfield];
		$fields[$i]['e4xA_ems_para']=$_POST[$parfield];
		$fields[$i]['e4xA_ems_field_text']=$_POST[$namepost];
		$opt_name=$fields[$i]['e4xA_ems_field_text'];
		$wert = $fields[$i]['e4xA_ems_enable'];
		$SSo=$fields[$i]['e4xA_ems_sort'];
		$para_wert=$fields[$i]['e4xA_ems_para'];
	  if($sql->db_Select("e4xA_ems_fields", "*", "e4xA_ems_field_name='".$FieldName."' LIMIT 1"))
			{
 			$inputstr="e4xA_ems_field_name='".$FieldName."',e4xA_ems_field_text='".$opt_name."', e4xA_ems_enable='".$wert."', e4xA_ems_para='".$para_wert."', e4xA_ems_sort='".$SSo."' ";
	 		$sql -> db_Update("e4xA_ems_fields", "".$inputstr." WHERE e4xA_ems_field_name='".$FieldName."' ");
			}else{$sql -> db_Insert("e4xA_ems_fields", "0, '".$FieldName."', '".$opt_name."', '".$wert."', '".$para_wert."', '".$SSo."'");
					}
    }
  $fields = get_user_fields();
	$fields_count= count($fields);
	}
///+++++++++++++++++++++++++++++++++++++++++++++
define("EMS_EDIT_LINK_IMG", "<img src='".e_PLUGIN."4xA_ems/images/edit.png' alt='' title='".DB_FIELD_EDIT."' border='0'>");

$text .="<tr>
      	  <td style='vertical-align:top;' colspan='5' class='fcaption'>".ERWEITERTE_BENUTZER_FELDER."</td>
        </tr>";
if($fields_count > 0)
	{
	for($i=0; $i < $fields_count; $i++)
		{
		$text .= "
				<tr>
					<td style='width:40%;vertical-align:top;' class='forumheader3'>Benutzer nach <b>".$fields[$i]['user_extended_struct_text']."</b> (user_".$fields[$i]['user_extended_struct_name'].") filtern erlauben?<br/>
					".e4xA_EMS_FIELT_OPT_NAME."<input class='tbox' style='width:100px;' type='text' name='text_".$fields[$i]['user_extended_struct_name']."' value='".$fields[$i]['e4xA_ems_field_text']."' />
					".e4xA_EMS_FIELT_OPT_NAME2."
					</td>
					<td style='width:2%;vertical-align:top;' class='forumheader3'><input name='".$fields[$i]['user_extended_struct_name']."' type='checkbox' value='1' ".($fields[$i]['e4xA_ems_enable']==1?" checked='checked' ":"")." />
					</td>
					<td style='width:50%;vertical-align:top;' class='forumheader3'>        	
					".get_box_typ($fields[$i]['user_extended_struct_type'], $fields[$i]['user_extended_struct_values'], $fields[$i]['e4xA_ems_para'], 'typ_'.$fields[$i]['user_extended_struct_name'].'')."
					</td>
					<td style='width:5%;vertical-align:top;' class='forumheader3'>
					".get_sort_box($fields[$i]['e4xA_ems_sort'], $fields_count_global, 'sort_'.$fields[$i]['user_extended_struct_name'].'')."
					</td>
					<td style='width:5%;vertical-align:top;' class='forumheader3'>
						<a href='../../e107_admin/users_extended.php?editext.".$fields[$i]['user_extended_struct_id']."'>".EMS_EDIT_LINK_IMG."</a>
					</td>
				</tr>";
	
		}
	}

$text .= "	<tr>
				<td colspan='5' class='fcaption'>".e4xA_EMS_RECHTE."</td>
     		</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".RESULTS_ZEIGEN_ALS."</td>
				<td colspan='3' class='forumheader3'> <select class='tbox' name='4xA_ems_ausgabe' style='width:250px;'>
				    	<option value='1' ".($pref['4xA_ems_ausgabe']==1?" selected='selected'":"").">".TABELLE."</option>
    					<option value='2' ".($pref['4xA_ems_ausgabe']==2?" selected='selected'":"").">".VISITENKARTE."</option>
    				</select></td>
     		</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".NO_OF_RESULTS_PER_SITE."</td>
				<td colspan='3' class='forumheader3'><input style='width: 150px;' name='4xA_ems_rows' type='text' value='".$pref['4xA_ems_rows']."'/></td>
			</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".e4xA_EMS_CEL_COUNT_TEXT."</td>
				<td colspan='3' class='forumheader3'><input style='width: 150px;' name='4xA_ems_cels' type='text' value='".$pref['4xA_ems_cels']."'/></td>
			</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".SEARCH_USER_ACCES."</td>
				<td colspan='3' class='forumheader3'>".get_useracces_dd()."</td>
			</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".e4xA_EMS_BURT_FIELD_TEXT."</td>
				<td colspan='3' class='forumheader3'>".get_table_value("4xA_ems_burt_field","user_extended_struct","user_extended_struct_id","user_extended_struct_name","user_extended_struct_name","user_extended_struct_name!='' AND user_extended_struct_type!='0'")."</td>
			</tr>
			<tr>
				<td colspan='2' class='forumheader3'>".e4xA_EMS_SEX_FIELD_TEXT."</td>
				<td colspan='3' class='forumheader3'>".get_table_value("4xA_ems_gen_field", "user_extended_struct","user_extended_struct_id","user_extended_struct_name","user_extended_struct_name","user_extended_struct_name!='' AND user_extended_struct_type!='0'")."</td>
			</tr>
			<tr>
				<td colspan='5' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".SPEICHERN."' /></div></td>
     		</tr>
     	</table>
     </form>
    </div>";
 
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:60%;'>.:: powered by 4xA-EMS from <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>e107-Templates</a> ::.</div>";   
 
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
 
$ns->tablerender("<div style='text-align:center'>".e4xA_EMS_ADMIN_CAPTION."</div>", $text);
require_once(e_ADMIN."footer.php");
//////////////////////
function get_system_field($fieldname,$field_text,$fieldvalue,$fields_count,$field_sort,$value)
{
$AUSGABE="<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".USER_SEARCH_TO."<b>".$field_text."</b> (".$fieldname.")".USER_SEARCH_TO_ACCES."<br/>".e4xA_EMS_FIELT_OPT_NAME."<input class='tbox' style='width:100px;' type='text' name='text_".$fieldname."' value='".$value."' />".e4xA_EMS_FIELT_OPT_NAME2."</td>
        	<td style='width:2%;vertical-align:top;' class='forumheader3'><input name='".$fieldname."' type='checkbox' value='".$fieldvalue."' ".($fieldvalue==1?" checked='checked' ":"")." />
        	</td>
        	<td style='width:50%;vertical-align:top;' class='forumheader3'>
        	</td>
        	<td style='width:5%;vertical-align:top;' class='forumheader3'>
          ".get_sort_box($field_sort, $fields_count, 'sort_'.$fieldname.'')."
          </td>
          <td style='width:5%;vertical-align:top;' class='forumheader3'>
          ---
        	</td>
				</tr>";
return $AUSGABE;
}
/////////////////////////////////
function get_user_fields()
{
global $sql;

$query="
 SELECT a.*, ab.* FROM ".MPREFIX."user_extended_struct AS a 
 LEFT JOIN ".MPREFIX."e4xA_ems_fields AS ab ON ab.e4xA_ems_field_name=a.user_extended_struct_name
 WHERE a.user_extended_struct_name!='' AND user_extended_struct_type!='0' ORDER BY ab.e4xA_ems_sort";
$sql->db_Select_gen($query);
$fields_count=0;
while($fields_row = $sql->db_Fetch()){
    $fields[$fields_count]=$fields_row;
    if(!$fields[$fields_count]['e4xA_ems_sort']){$fields[$fields_count]['e4xA_ems_sort']=$fields_count;}
    $fields_count++;
    }	
return $fields;
}
//////////////////////
function get_sort_box($index, $count, $box_name)
{
$Ausgabe="<select class='tbox' name='".$box_name."' style='width:40px;'>";
for($i=1; $i < $count+1; $i++)
	{
  $Ausgabe .="<option value='".$i."' ".(($i==$index) ?" selected='selected'":"").">".$i."</option>";
  } 
$Ausgabe .="</select>";
return $Ausgabe;
}
//////////////////////
function get_box_typ($typ, $par, $value, $box_name)
{
 switch ($typ) {
//------Textbox---------------------------
	case 1:	$ASGABE ="<b>ist ein Textbox</b>";
//	<input class='tbox' style='width:300px;' type='text' name='".$box_name."' value='".$value."' />";
			break;
//--------------Radio Buttons-----------------
	case 2:	$field_parms = explode(",",$par);
			$ASGABE =" <b>Radio Buttons!</b>";
					
			break;
//--------Kombobox------------------------
	case 3:	$ASGABE ="<b>Kombobox</b>   <select class='tbox' name='anzeige_".$box_name."' style='width:150px;'>";
				$field_parms = explode(",",$par);
				$field_parms_count= count($field_parms);
				for($i=0; $i < $field_parms_count; $i++)
					{
					$ASGABE .="<option value='".$field_parms[$i]."' ".($field_parms[$i]==$value?" selected='selected'":"").">".$field_parms[$i]."</option>";
					}
				$ASGABE .="</select>";
			break;
//-----------DB-Tabelle--------------------
	case 4:	$field_parms = explode(",",$par);
					$ASGABE ="<b>DB-".FIELD_TYP_TABLE."</b> (".FIELD_TYP_FROM_TABLE."<b>".$field_parms[0]."</b> ".FIELD_TYP_FROM_TABLE_ISO."<b>".$field_parms[1]."</b> ".FIELD_TYP_FROM_TABLE_TXT."<b>".$field_parms[2]."</b>)";
			break;
//------------Textbereich--------------------
	case 5:	$field_parms = explode(",",$par);
					$ASGABE ="<b>".FIELD_TYP_TXTAREA."</b>";
			break;
//------------Intenger--------------------
	case 6:	$field_parms = explode(",",$par);
					$ASGABE ="<b>".FIELD_TYP_INT."</b> ".ABFRAGE_PARAMETER."<input class='tbox' style='width:300px;' type='text' name='".$box_name."' value='".$value."' />";
			break;
//------------Datum--------------------
	case 7:	$field_parms = explode(",",$par);
					$ASGABE ="<b>".FIELD_TYP_DATA."</b> ".ABFRAGE_PARAMETER."<input class='tbox' style='width:300px;' type='text' name='".$box_name."' value='".$value."' />";
			break;
//------------Sprache--------------------
	case 8:	$field_parms = explode(",",$par);
					$ASGABE ="<b>".FIELD_TYP_LANG."</b> ".ABFRAGE_PARAMETER."<input class='tbox' style='width:300px;' type='text' name='".$box_name."' value='".$value."' />";
			break;
//----------------------------------------
	default:  $ASGABE="";
			break;
}

return $ASGABE;
}
//////////////////////
function get_useracces_dd()
{
global $sql,$pref;
	$ret ="<select class='tbox' style='width:250px'  name='4xA_ems_acces_class'><option></option>";
	$checked = ($pref['4xA_ems_acces_class'] == 0)? " selected='selected'" : "";
	$ret .="<option value='0' $checked >".JEDER."</option>"; 							//Jeder
	$checked = ($pref['4xA_ems_acces_class'] == 252)? " selected='selected'" : "";
	$ret .="<option value='252' $checked >".NUR_MITGLIEDER."</option>"; 						//Nur Mitglieder
	$checked = ($pref['4xA_ems_acces_class'] == 254)? " selected='selected'" : "";
    $ret .="<option value='254' $checked >".NUR_ADMIN."</option>";							//Nur Admins
    $checked = ($pref['4xA_ems_acces_class'] == 255)? " selected='selected'" : "";
    $ret .="<option value='255' $checked >".KEINER."</option>";							//keiner (inaktiv)
    $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
    while($row = $sql-> db_Fetch()){
		extract($row);
		$checked = ($userclass_id == $pref['4xA_ems_acces_class'])? " selected='selected' " : "";
     	$ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
      	}
   $ret .="</select>";
 return $ret;
}
////////////////////////////////////////////
function get_table_value($field_name,$table_name,$table_id_field,$table_name_field,$table_sort,$table_where)
{
global $sql,$pref;
	$ret ="<select class='tbox' style='width:250px'  name='".$field_name."'><option></option>";
  $sql -> db_Select($table_name,"".$table_id_field.", ".$table_name_field."","".$table_where." ORDER BY ".$table_sort."");
    while($row = $sql-> db_Fetch()){
    	
		$checked = ($row[$table_name_field] == $pref[$field_name])? " selected='selected' " : "";
     	$ret .="<option value='".$row[$table_name_field]."' $checked > $row[$table_name_field] </option>";
      	}
   $ret .="</select>";
 return $ret;
}
?>