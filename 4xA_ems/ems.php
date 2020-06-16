<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/ems.php
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

require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."4xA_ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");

if( $pref['4xA_ems_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['4xA_ems_acces_class'], USERID, TRUE))
	{	
	if($pref['4xA_ems_ausgabe']==2)
		{
		if(file_exists("".THEME."4xA_ems_template2.php"))
			{require_once("".THEME."4xA_ems_template2.php");}else{require_once(e_PLUGIN."4xA_ems/4xA_ems_template2.php");}
		}
	else{if ( file_exists("".THEME."4xA_ems_template.php"))
			{require_once("".THEME."4xA_ems_template.php");}else{require_once(e_PLUGIN."4xA_ems/4xA_ems_template.php");}
		}
	if (file_exists("4xA_ems_shortcodes.php"))
		{require_once("4xA_ems_shortcodes.php");}else{require_once(e_PLUGIN."4xA_ems/4xA_ems_shortcodes.php");}
  

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
    <form action='".e_SELF."' method='get'>
    <table style='width:90%' class='fborder'>
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
	case 1:	$text .= "<input class='tbox' style='width:150px;' type='text' name='".$sys_user_fields[$i]['name']."' value='".$sys_user_fields[$i]['input']."' />";
			break;
//------Checkbox--------------------------			
	case 2:	$text .= "<input type='checkbox' name='".$sys_user_fields[$i]['name']."' ".($sys_user_fields[$i]['input']=="on"?"checked":"")." />";
			break;		
				}
		$text .= "</td></tr>";
		}
	}
$user_ext_fields = get_user_fields();
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
	$text .= get_my_row_for_filter($user_ext_fields[$i]);
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
$WHERE_QUERRY="";
for($i=1 ; $i < $sys_user_fields_count ; $i++) 
	{
	if($sys_user_fields[$i]['value']==1 && $sys_user_fields[$i]['input']!="")
		{
		 switch ($sys_user_fields[$i]['type']) {
		//------Textbox---------------------------
			case 1:	$sys_user_fields[$i]['querry'] = " AND ".$sys_user_fields[$i]['name']." LIKE '%".$tp->toDB($sys_user_fields[$i]['input'])."%'";
				break;
		//------Checkbox--------------------------			
			case 2:	$sys_user_fields[$i]['querry'] = " AND ".$sys_user_fields[$i]['name']."!=''";
				break;
		//------Kombobox--------------------------			
			case 3:	$sys_user_fields[$i]['querry'] = " AND ".$sys_user_fields[$i]['name']."='".$sys_user_fields[$i]['input']."'";
				break;
		//------------------------------------------
			default: $sys_user_fields[$i]['querry'] ="";
		break;
			}
		$WHERE_QUERRY .= $sys_user_fields[$i]['querry'];	
		}
	}	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
for($i=0 ; $i < $user_ext_fields_counts ; $i++) 
	{
	if($user_ext_fields[$i]['e4xA_ems_enable']==1 && $user_ext_fields[$i]['input']!="")
		{
		 switch ($user_ext_fields[$i]['user_extended_struct_type']){
		//------Textbox---------------------------
			case 1:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']." LIKE '%".$tp->toDB($user_ext_fields[$i]['input'])."%'";
				break;
		//------Checkbox--------------------------			
			case 2:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']."!=''";
				break;
		//------Kombobox--------------------------			
			case 3:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']."='".$user_ext_fields[$i]['input']."'";
				break;
		//------DB-Tabelle--------------------------			
			case 4:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']."='".$user_ext_fields[$i]['input']."'";
				break;
		//------Textbereich---------------------------
			case 5:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']." LIKE '%".$tp->toDB($user_ext_fields[$i]['input'])."%'";
				break;
		//------Intenger---------------------------
			case 6:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']." LIKE '%".$tp->toDB($user_ext_fields[$i]['input'])."%'";
				break;
		//------Datum---------------------------
			case 7: 
			//$text .= get_where_field_typ($user_ext_fields[$i]);
					$user_ext_fields[$i]['querry'] = get_where_field_typ($user_ext_fields[$i]);
				break;
		//------Sprache---------------------------
			case 8:	$user_ext_fields[$i]['querry'] = " AND user_".$user_ext_fields[$i]['e4xA_ems_field_name']." LIKE '%".$tp->toDB($user_ext_fields[$i]['input'])."%'";
				break;
		//------------------------------------------
			default: $user_ext_fields[$i]['querry'] ="";
		break;
			}
		$WHERE_QUERRY .= $user_ext_fields[$i]['querry'];
		}
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
// Search query
	  $qry_rows ="
	  SELECT u.*, ue.*, ub.*
	  FROM #user AS u
    LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
    LEFT JOIN #online AS ub ON ub.online_ip=u.user_ip
	  WHERE user_ban = '0' ".$WHERE_QUERRY."
    ORDER by user_name";
    $sql->db_Select_gen($qry_rows);
    $found = $sql->db_rows();

	  $qry ="
	  SELECT u.*, ue.*, ub.*
	  FROM #user AS u
    LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
    LEFT JOIN #online AS ub ON ub.online_ip=u.user_ip
	  WHERE user_ban = '0' ".$WHERE_QUERRY."
    ORDER by user_name
    LIMIT $from,$records";
    $sql->db_Select_gen($qry);

      if($sql->db_rows()==0){
        $results = "
        <tr>
        <td class='forumheader3' style='text-align:center' colspan='5'><b>".NO_RESULTS."</b></td>
        </tr>";
      }else{
      	$results = "";
      }

	if($found==0){
	$found ='0';
	}
	if(e_QUERY==""){
	$text .= "<br/><div style='text-align:center;'>".REGESTRIERTE_MITGIELDER.$found."</div><br/>";
	}else{
	$text .= "<br/><div style='text-align:center;'>".GEFUNDEN_MITGIELDER.$found."</div><br/>";
	}
$text .= "<br />";
if($pref['4xA_ems_ausgabe']==2)	
{
$text .= "<table style='width:100%' cellpadding='0' cellspacing='5'><tr>";
$ZAHLER=0;$NNS=$from;
     	while($row=$sql->db_Fetch())
    	{$ZAHLER++;$NNS++;
    	 if($ZAHLER > $pref['4xA_ems_cels'])
    	 		{
    	 		$text .="</tr><tr>";	$ZAHLER=1;
    	 		}
	$text .= renderuser($row,$NNS,"user_".$pref['4xA_ems_gen_field'],"user_".$pref['4xA_ems_burt_field'],"short");
    	}
   if($ZAHLER <= $pref['4xA_ems_cels'])
   	{
   	for($i=$ZAHLER; $i < $pref['4xA_ems_cels'];$i++)	
   		{
   		$text .= "<td style=''><table style='width:100%;font-size:80%;'><tr><td>&nbsp;&nbsp;&nbsp;</td></tr></table></td>";	
   		}
   	}
$text .= "</tr></table>\n</div>";
}
else{
 $text .= "<table style='width:100%' class='fborder'>
   	<tr>
	<td class='fcaption' colspan='2' style='width:20%'>".e4xA_EMS_SYS_01."</td>";
    $text .="<td class='fcaption' style='width:20%'>".e4xA_EMS_SYS_02."</td>";
    $text .="<td class='fcaption' style='width:20%'>".e4xA_EMS_SYS_08."</td>";
    $text .="<td class='fcaption' style='width:20%'>".e4xA_EMS_SYS_05."</td>
   	</tr>";
    $text .= $results;
     	while($row=$sql->db_Fetch())
    	{
		$text .= renderuser($row,"","","","short");
    	}
	$text .= "</table>\n</div>";
		}
 	}
else
	{
	$text="<div style='text-align:center'><br /><br /><b>".EMS_142."</b><br /><br /><br /></div>";}

//else{header("location:".e_HTTP."index.php");
//      exit;}
      
// Paraser - Part 2
   if($found > $pref['4xA_ems_rows']){
    $parms = $found.",".$records.",".$from.",".e_SELF.'?'.$parase;
    $text .="<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
   }
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:90%;'>.:: powered by 4xA-EMS from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns->tablerender(PAGE_NAME_4xA_EMS, $text);
require_once(FOOTERF);
/////////////////////////////
function renderuser($uid,$nr,$sex,$geburt,$tt)
	{
		global $sql, $tp, $e4xA_ems_shortcodes;
		global $e4xA_EMS_SHORT_TEMPLATE;
		global $user;
		if(is_array($uid))
		{
			$user = $uid;
			$user['nr'] = $nr;
			$user['user_burtd'] =$user[$geburt];
			if(!$user[$geburt] ||$user[$geburt]==0 ||$user[$geburt]=="0000-00-00")
			{$user['user_alter']=0;
			 $user[$geburt]=0;
				}
			else{$user['user_alter'] =alter_ermittel($user[$geburt]);
					$usergeb = explode("-", $user[$geburt]);
					$user[$geburt]=$usergeb[2].".".$usergeb[1].".".$usergeb[0];
					}
		}
		else
		{
			//if(!$user = getx_user_data($uid))
			if(!$user = e107::user($uid))
			{
				return FALSE;
			}
		}
	return $tp->parseTemplate($e4xA_EMS_SHORT_TEMPLATE, FALSE, $e4xA_ems_shortcodes);
	}
///////////////////////////////
function alter_ermittel($Geburtstag)
{
$jetzt['dat'] = date("d");
$jetzt['mon'] = date("m"); 
$jetzt['year'] = date("Y");
$Heute=$jetzt['year']."-".$jetzt['mon']."-".$jetzt['dat'];
$Geb = explode("-", $Geburtstag);
$Alt=$jetzt['year']-$Geb[0];
if($jetzt['mon'] < $Geb[1] || $jetzt['mon']== $Geb[1] && $jetzt['dat'] < $Geb[2] )
	{$Alt=$Alt-1;}
return $Alt;
}
///////////////////////////////
function benutzer_gruppe_pruefen($gruppe, $benutzer_ID,$typ)
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
/////////////////////////////////
function get_user_fields()
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
function get_my_row_for_filter($user_ext_fields)
{
global $sql2;
if($user_ext_fields['user_extended_struct_parent']!=0)
{
$sql2 -> db_Select("user_extended_struct","user_extended_struct_name","user_extended_struct_id=".$user_ext_fields['user_extended_struct_parent']." LIMIT 1");
$row2 = $sql2-> db_Fetch();
$fielbeschreibung=($row2['user_extended_struct_text']=="")? $row2['user_extended_struct_name'] : $row2['user_extended_struct_text'];	
}else{
$fielbeschreibung=($user_ext_fields['e4xA_ems_field_text']=="")? $user_ext_fields['user_extended_struct_text'] : $user_ext_fields['e4xA_ems_field_text'];
}

$AUSGABE ="<tr>
				<td style='vertical-align:top;' class='forumheader2'>".$fielbeschreibung.": </td>
				<td style='vertical-align:top;' class='forumheader2'>";
				
switch ($user_ext_fields['user_extended_struct_type']) {
//------Textbox---------------------------
	case 1:	$AUSGABE .= "<input class='tbox' style='width:150px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
			break;
//------Checkbox--------------------------
	case 2:	$AUSGABE .= "<input type='checkbox' name='".$user_ext_fields['e4xA_ems_field_name']."' ".($user_ext_fields['input']=="1"?"checked":"")." />";
			break;
//--------Kombobox------------------------
	case 3:	$AUSGABE .="<select class='tbox' name='".$user_ext_fields['e4xA_ems_field_name']."' style='width:150px;'>";
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
		$AUSGABE .="<select class='tbox' style='width:200px'  name='".$user_ext_fields['e4xA_ems_field_name']."'><option></option>";
		$sql2 -> db_Select($field_parms[0],"".$field_parms[1].",".$field_parms[2].""," ORDER BY ".$field_parms[2]."", "no_where");
		while($row2 = $sql2-> db_Fetch()){
			extract($row2);
			$checked = ($row2[$field_parms[1]] == $user_ext_fields['input'])? " selected='selected' " : "";
			$AUSGABE .="<option value='".$row2[$field_parms[1]]."'".$checked.">".$row2[$field_parms[2]]."</option>";
			}
		$AUSGABE .="</select>";
		break;
//------------Textbereich--------------------
	case 5:	$AUSGABE .= "<input class='tbox' style='width:150px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
		break;
//------------Intenger--------------------
	case 6:	$AUSGABE .= "<input class='tbox' style='width:150px;' type='text' name='".$user_ext_fields['e4xA_ems_field_name']."' value='".$user_ext_fields['input']."' />";
		break;
//------------Datum--------------------
	case 7:	$field_parms = explode(",",$user_ext_fields['user_extended_struct_values']);
			$AUSGABE .="";
			if($user_ext_fields['e4xA_ems_para']=="")
				{
				$AUSGABE .="<b>Datum</b>";
				}
			else {$AUSGABE .=get_fiel_params($user_ext_fields);}

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
function get_fiel_params($user_ext_fields)
{
$field_parms = explode("|",$user_ext_fields['e4xA_ems_para']);
if($field_parms[0]=="A")
	{
	$MANE=$field_parms[0]."_".$user_ext_fields['e4xA_ems_field_name'];
	$AUSGABE =get_alter_box($field_parms[1], $field_parms[2], '', $MANE);
	}
if($field_parms[0]=="VB")
	{
	$MANE=$field_parms[0]."_".$user_ext_fields['e4xA_ems_field_name'];
	$AUSGABE =get_alter_box($field_parms[1], $field_parms[2], '', $MANE);
	}
return $AUSGABE;
}
////////////////////////////////////////////////////////////////////
function get_alter_box($typ, $par, $value, $box_name)
{
 switch ($typ) {
//------Textbox---------------------------
	case 1:	$ASGABE ="<b>".VON.":</b>   <input class='tbox' style='width:50px;' type='text' name='".$box_name."_1' value='".$value."' />";
					$ASGABE.="<b>".BIS.":</b>   <input class='tbox' style='width:50px;' type='text' name='".$box_name."_2' value='".$value."' />";
			break;
//--------Kombobox------------------------
	case 2:	$ASGABE ="<b>".VON.":</b>  <select class='tbox' name='".$box_name."_1' style='width:60px;'>";
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

				$ASGABE .="<b>".BIS.":</b>  <select class='tbox' name='".$box_name."_2' style='width:60px;'>";
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
//----------------------------------------
function get_where_field_typ($user_ext_field)
{
if($user_ext_field['e4xA_ems_para']=="")
	{
	return "Keine Parametern sind gesetzt";	
	}
else{
$AUSGABE=get_fiel_params_to_where($user_ext_field);
	}
return $AUSGABE;
}
//----------------------------------------
function get_fiel_params_to_where($user_ext_fields)
{
$field_parms = explode("|",$user_ext_fields['e4xA_ems_para']);
$alterbereich = explode("-",$user_ext_fields['input']);

if($field_parms[0]=="A")
	{
	$AUSGABE =get_data_where_nach_alter($user_ext_fields['e4xA_ems_field_name'],$alterbereich[0], $alterbereich[1]);
	}
if($field_parms[0]=="VB")
	{
	$AUSGABE =get_data_where_von_bis($user_ext_fields['e4xA_ems_field_name'],$alterbereich[1], $alterbereich[0],$field_parms[3]);
	}
return $AUSGABE;
}
//-------------------------------------------
function get_data_where_nach_alter($field, $alter_von, $alter_bis)
{
$jetzt['dat'] = date("d");
$jetzt['mon'] = date("m"); 
$jetzt['year'] = date("Y");
    	
$myAltervon=$jetzt['year']-($alter_bis+1);
$myAltervon.="-".$jetzt['mon']."-".$jetzt['dat'];
$myAlterbis=$jetzt['year']-$alter_von;
$myAlterbis.="-".$jetzt['mon']."-".$jetzt['dat'];	

$AUSGABE2 =" AND user_".$field." >= '".$myAltervon."' AND user_".$field." <= '".$myAlterbis."' AND user_".$field." !='0'";
return $AUSGABE2;
}
//----------------------------------------
function get_data_where_von_bis($field, $alter_von, $alter_bis, $field2)
{
$myAltervon=$alter_bis;
$myAltervon.="-00-00";
$myAlterbis=$alter_von;
$myAlterbis.="-00-00";
if($field2)
	{
	$AUSGABE2 =" AND user_".$field." >= '".$myAltervon."' AND user_".$field." <= '".$myAlterbis."' OR ".$field2." >= '".$myAltervon."' AND ".$field2." <= '".$myAlterbis."' OR user_".$field." <= '".$myAltervon."' AND ".$field2." >= '".$myAlterbis."'";
	}
else{
$AUSGABE2 =" AND user_".$field." >= '".$myAltervon."' AND user_".$field." <= '".$myAlterbis."' AND user_".$field." !='0'";
	}
return $AUSGABE2;
}
//----------------------------------------
?>

