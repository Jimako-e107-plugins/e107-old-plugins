<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/4xA_ems_menu.php
| 	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."4xA_ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");

if( $pref['4xA_ems_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen1($pref['4xA_ems_acces_class'], USERID, TRUE))
	{	

$sys_user_fields[1]['sort']=$pref['4xA_ems_BN_S'];
$sys_user_fields[1]['name']='user_name';
$sys_user_fields[1]['text']=($pref['4xA_ems_BN_N']=="")? e4xA_EMS_SYS_01 : $pref['4xA_ems_BN_N'];
$sys_user_fields[1]['type']=1;
$sys_user_fields[1]['value']=$pref['4xA_ems_BN'];

$sys_user_fields[2]['sort']=$pref['4xA_ems_UL_S'];
$sys_user_fields[2]['name']='user_login';
$sys_user_fields[2]['text']=($pref['4xA_ems_UL_N']=="")? e4xA_EMS_SYS_02 : $pref['4xA_ems_UL_N'];
$sys_user_fields[2]['type']=1;
$sys_user_fields[2]['value']=$pref['4xA_ems_UL'];

$sys_user_fields[3]['sort']=$pref['4xA_ems_UI_S'];
$sys_user_fields[3]['name']='user_image';
$sys_user_fields[3]['text']=($pref['4xA_ems_UI_N']=="")? e4xA_EMS_SYS_03 : $pref['4xA_ems_UI_N'];
$sys_user_fields[3]['type']=2;
$sys_user_fields[3]['value']=$pref['4xA_ems_UI'];

$sys_user_fields[4]['sort']=$pref['4xA_ems_UF_S'];
$sys_user_fields[4]['name']='user_sess';
$sys_user_fields[4]['text']=($pref['4xA_ems_UF_N']=="")? e4xA_EMS_SYS_04 : $pref['4xA_ems_UF_N'];
$sys_user_fields[4]['type']=2;
$sys_user_fields[4]['value']=$pref['4xA_ems_UF'];

$sys_user_fields[5]['sort']=$pref['4xA_ems_OS_S'];
$sys_user_fields[5]['name']='online_user_id';
$sys_user_fields[5]['text']=($pref['4xA_ems_OS_N']=="")? e4xA_EMS_SYS_05 : $pref['4xA_ems_OS_N'];
$sys_user_fields[5]['type']=2;
$sys_user_fields[5]['value']=$pref['4xA_ems_OS'];


$sys_user_fields_count = count($sys_user_fields)+1;
 
$text = "<div style='text-align:center'>
    <form action='".e_PLUGIN."4xA_ems/ems.php' method='get'>
    <table style='width:100%' class='fborder'>
	<tr>
	<td style='vertical-align:top;' colspan='2' class='fcaption'>".SEARCH_FORM_CAPTION."</td>
	</tr>"; 
for($i=1 ; $i < $sys_user_fields_count ; $i++) 
	{
	$sys_user_fields[$i]['input']=$_GET[$sys_user_fields[$i]['name']];
	$sys_user_fields[$i]['link']  = "".$sys_user_fields[$i]['name']."=".$sys_user_fields[$i]['input']."&";
	if($sys_user_fields[$i]['value']==1)
		{
		$text .= "<tr>
					<td style='vertical-align:top;' class='forumheader2'>".$sys_user_fields[$i]['text'].": </td>
					<td style='vertical-align:top;' class='forumheader2'>";
					
 switch ($sys_user_fields[$i]['type']) {
//------Textbox---------------------------
	case 1:	$text .= "<input class='tbox' style='width:120px;' type='text' name='".$sys_user_fields[$i]['name']."' value='".$sys_user_fields[$i]['input']."' />";
			break;
//------Checkbox--------------------------			
	case 2:	$text .= "<input type='checkbox' name='".$sys_user_fields[$i]['name']."' ".($sys_user_fields[$i]['input']=="on"?"checked":"")." />";
			break;		
				}
		$text .= "</td></tr>";
		}
	}
$user_ext_fields = get_user_fields1();
$user_ext_fields_counts=count($user_ext_fields);
for($i=0 ; $i < $user_ext_fields_counts ; $i++)
	{
	if($user_ext_fields[$i]['user_extended_struct_type']==7 && $user_ext_fields[$i]['e4xA_ems_para']!="")
			{
			$field_parms = explode("|",$user_ext_fields[$i]['e4xA_ems_para']);
			$NAME1 = $field_parms[0]."_".$user_ext_fields[$i]['e4xA_ems_field_name']."_1";	
			$NAME2 = $field_parms[0]."_".$user_ext_fields[$i]['e4xA_ems_field_name']."_2";
			if($_GET[$NAME1]!="" && $_GET[$NAME2]!="")
				{
				$user_ext_fields[$i]['input']=$_GET[$NAME1]."-".$_GET[$NAME2];
				$user_ext_fields[$i]['link'] 	= "".$NAME1."=".$_GET[$NAME1]."&";
				$user_ext_fields[$i]['link'] .= "".$NAME2."=".$_GET[$NAME2]."&";
				}
			else $user_ext_fields[$i]['input']="";
			}
else		
		{
		$user_ext_fields[$i]['input']=$_GET[$user_ext_fields[$i]['e4xA_ems_field_name']];
		$user_ext_fields[$i]['link'] = "".$user_ext_fields[$i]['e4xA_ems_field_name']."=".$user_ext_fields[$i]['input']."&";
		}
	$text .= get_my_row_for_filter1($user_ext_fields[$i]);
	}

	
 $text .="
	<td class='fcaption' style='vertical-align:top; text-align:center;' colspan='2'>
	<input class='button' type='submit' value='".SEARCH_START."' />
	</td>
	</tr>
    </table></form></div>";
   }
//
$sort = $_GET['sort'];
if($sort==""){
	$records = $pref['4xA_ems_rows'];
	$from = 0;
	} else {
		$qs = explode(".", $sort);
		$from = intval($qs[0]);
		$records = intval($qs[1]);
		
	}
$psort = 'sort=[FROM].'.$records;
$parase="";	
	
for($i=1 ; $i < $sys_user_fields_count ; $i++) 
	{
	$parase .= $sys_user_fields[$i]['link'];
	}
for($i=0 ; $i < $user_ext_fields_counts ; $i++) 
	{	
	$parase .= $user_ext_fields[$i]['link'];
	}
$parase .= $psort;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 	}
else
	{
	$text="<div style='text-align:center'><br /><br /><b>".EMS_142."</b><br /><br /></div>";
	}
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:63%;'>.:: powered by 4xA-EMS from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns->tablerender(PAGE_NAME_4xA_EMS, $text);
///////////////////////////////
function benutzer_gruppe_pruefen1($gruppe, $benutzer_ID,$typ)
{
if($gruppe==0){return true;}
elseif(!$gruppe ||$gruppe==255){return false;}
elseif($gruppe==252 && $benutzer_ID){return true;}
elseif($gruppe==254 || ($gruppe< 250 && $gruppe > 0))
	{
	global $sql, $tp;
 	$sql->db_Select("user", "*", "user_id ='".$benutzer_ID."'");
	if($row = $sql->db_Fetch())
		{
		if($gruppe==254 && $row['user_admin']==1){return true;}
		$u_Classes = explode(",", $row['user_class']);
		$count_class = count($u_Classes);
		for($i=0; $i < $count_class ; $i++)
			{$TESTT.= $u_Classes[$i];
			if($u_Classes[$i]==$gruppe){return $u_Classes[$i];}
			}
		}
	}
else{return false;}
return false;
}
/////////////////////////////////////////////
function get_user_fields1()
{
global $sql;

$query="
 SELECT a.*, ab.* FROM ".MPREFIX."e4xA_ems_fields AS a 
 LEFT JOIN ".MPREFIX."user_extended_struct AS ab ON ab.user_extended_struct_name=a.e4xA_ems_field_name
 WHERE a.e4xA_ems_field_name!='' AND a.e4xA_ems_enable='1' ORDER BY a.e4xA_ems_sort";
$sql->db_Select_gen($query);
$fields_count=0;
while($fields_row = $sql->db_Fetch()){
    $fields[$fields_count]=$fields_row;
    $fields_count++;
    }	
return $fields;
}
//////////////////////////////////////////////////////////////////
function get_my_row_for_filter1($user_ext_fields)
{
global $sql2;

if($user_ext_fields['user_extended_struct_parent']!=0)
{
$sql2 -> db_Select("user_extended_struct","user_extended_struct_name","user_extended_struct_id=".$user_ext_fields['user_extended_struct_parent']." LIMIT 1");
$row2 = $sql2-> db_Fetch();
$fielbeschreibung=$row2['user_extended_struct_name'];	
}else{$fielbeschreibung=($user_ext_fields['e4xA_ems_field_text']=="")? $user_ext_fields['user_extended_struct_text'] : $user_ext_fields['e4xA_ems_field_text'];	}
$AUSGABE ="<tr>
				<td style='vertical-align:top;' class='forumheader2'>".$fielbeschreibung.": </td>
				<td style='vertical-align:top;' class='forumheader2'>";
				
switch ($user_ext_fields['user_extended_struct_type']) {
//------Textbox---------------------------
	case 1:	$AUSGABE .= "<input class='tbox' style='width:120px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
			break;
//------Checkbox--------------------------
	case 2:	$AUSGABE .= "<input type='checkbox' name='".$user_ext_fields['e4xA_ems_field_name']."' ".($user_ext_fields['input']=="1"?"checked":"")." />";
			break;
//--------Kombobox------------------------
	case 3:	$AUSGABE .="<select class='tbox' name='".$user_ext_fields['e4xA_ems_field_name']."' style='width:120px;'>";
			$field_parms = explode(",",$user_ext_fields['user_extended_struct_values']);
			$field_parms_count= count($field_parms);
			$AUSGABE .="<option value='' ".($user_ext_fields['input']==''?" selected='selected'":"")."></option>";
			for($i=0; $i < $field_parms_count; $i++)
				{
				$AUSGABE .="<option value='".$field_parms[$i]."' ".($field_parms[$i]==$user_ext_fields['input']?" selected='selected'":"").">".$field_parms[$i]."</option>";
				}
			$AUSGABE .="</select>";
		break;
//-----------DB-Tabelle--------------------
	case 4:	$field_parms = explode(",",$user_ext_fields['user_extended_struct_values']);
		$AUSGABE .="<select class='tbox' style='width:120px'  name='".$user_ext_fields['e4xA_ems_field_name']."'><option></option>";
		$sql2 -> db_Select($field_parms[0],"".$field_parms[1].",".$field_parms[2].""," ORDER BY ".$field_parms[2]."", "no_where");
		while($row2 = $sql2-> db_Fetch()){
			extract($row2);
			$checked = ($row2[$field_parms[1]] == $user_ext_fields['input'])? " selected='selected' " : "";
			$AUSGABE .="<option value='".$row2[$field_parms[1]]."'".$checked.">".$row2[$field_parms[2]]."</option>";
			}
		$AUSGABE .="</select>";
		break;
//------------Textbereich--------------------
	case 5:	$AUSGABE .= "<input class='tbox' style='width:120px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
		break;
//------------Intenger--------------------
	case 6:	$AUSGABE .= "<input class='tbox' style='width:120px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
		break;
//------------Datum--------------------
	case 7:	$field_parms = explode(",",$user_ext_fields['user_extended_struct_values']);
			$AUSGABE .="";
			if($user_ext_fields['e4xA_ems_para']=="")
				{
				$AUSGABE .="<b>Datum</b>";
				}
			else {$AUSGABE .=get_fiel_params1($user_ext_fields);}

		break;
//------------Sprache--------------------
	case 8:	$field_parms = explode(",",$user_ext_fields['user_extended_struct_values']);
			$AUSGABE .="<b>Sprache</b>";
		break;
//-------------------------------------------
		default: $AUSGABE .="";
		break;
			}
$AUSGABE .= "</td></tr>";
return $AUSGABE;
}
//////////////////////////////////////////////////////////////////
function get_fiel_params1($user_ext_fields)
{
$field_parms = explode("|",$user_ext_fields['e4xA_ems_para']);
if($field_parms[0]=="A")
	{
	$MANE=$field_parms[0]."_".$user_ext_fields['e4xA_ems_field_name'];
	$AUSGABE =get_alter_box1($field_parms[1], $field_parms[2], '', $MANE);
	}
if($field_parms[0]=="VB")
	{
	$MANE=$field_parms[0]."_".$user_ext_fields['e4xA_ems_field_name'];
	$AUSGABE =get_alter_box1($field_parms[1], $field_parms[2], '', $MANE);
	}
return $AUSGABE;
}
////////////////////////////////////////////////////////////////////
function get_alter_box1($typ, $par, $value, $box_name)
{
 switch ($typ) {
//------Textbox---------------------------
	case 1:	$ASGABE ="<input class='tbox' style='width:55px;' type='text' name='".$box_name."_1' value='".$value."' />";
					$ASGABE.="<b>&nbsp;-&nbsp;</b><input class='tbox' style='width:55px;' type='text' name='".$box_name."_2' value='".$value."' />";
			break;
//--------Kombobox------------------------
	case 2:	$ASGABE ="<select class='tbox' name='".$box_name."_1' style='width:55px;'>";
				$field_parms = explode(",",$par);
				$ASGABE .="<option value=''></option>";
				if($field_parms[1]=="-")
					{
					for($i=$field_parms[0]; $i < $field_parms[2]; $i++)
						{
						$ASGABE .="<option value='".$i."'>".$i."</option>";
						}
					}
				else
				$field_parms_count= count($field_parms);
				for($i=0; $i < $field_parms_count; $i++)
					{
					$ASGABE .="<option value='".$field_parms[$i]."'>".$field_parms[$i]."</option>";
					}
				$ASGABE .="</select>";

				$ASGABE .="<b>&nbsp;-&nbsp;</b><select class='tbox' name='".$box_name."_2' style='width:55px;'>";
				$field_parms = explode(",",$par);
				$ASGABE .="<option value=''></option>";
				if($field_parms[1]=="-")
					{
					for($i=$field_parms[0]; $i < $field_parms[2]; $i++)
						{
						$ASGABE .="<option value='".$i."'>".$i."</option>";
						}
					}
				else
				$field_parms_count= count($field_parms);
				for($i=0; $i < $field_parms_count; $i++)
					{
					$ASGABE .="<option value='".$field_parms[$i]."'>".$field_parms[$i]."</option>";
					}
				$ASGABE .="</select>";
			break;
//----------------------------------------
			default:  $ASGABE="";
			break;
	}
return $ASGABE;
}
//----------------------------------------//----------------------------------------
?>

