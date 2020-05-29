<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/formular_data.php
|
|		For the e107 website system
|		©Steve Dunstan 2001-2002
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
require_once("constanten.php");
$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");

$ImageDELETE['PFAD']=e_PLUGIN.e4xA_FORM_FOLDER."/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='' src='".$ImageDELETE['PFAD']."'>";

if(IsSet($_POST['delete'])){
		if($_POST['existing']){$id_to_edit=$_POST['existing'];}else{$id_to_edit=$_POST['ID'];}
$meldung = delete_antrag($id_to_edit);
echo $meldung;
}

if($_GET['formdata'])
{
	list($formid,$autrag_id) = explode(".", $_GET['formdata']);
	$formid = intval($formid);
	$autrag_id = intval($autrag_id);
}
else{
if(e_QUERY)
	{
	list($formid,$autrag_id) = explode(".", e_QUERY);
	$formid = intval($formid);
	$autrag_id = intval($autrag_id);
	}
}

$sort = $_GET['sort'];
if($sort==""){
	$anzahl = 10;
	$von = 0;
	}
	else {
		$qs = explode(".", $sort);
		$von = intval($qs[0]);
		$anzahl = intval($qs[1]);
	}


$sql -> db_Select("e4xA_form_kathegories", "*", "form_kat_id='".$formid."' LIMIT 1");
$my_form_data = $sql->db_Fetch();

if($my_form_data['form_kat_caption']!='')
		{
		$page_caption=$my_form_data['form_kat_caption'];
		}
elseif($pref['e4xA_form_caption']!='')
		{
		$page_caption=$pref['e4xA_form_caption'];
		}
else{$page_caption=LAN_4xA_FORM_99;}

if($my_form_data['form_kat_enable']=='0')
	{	
	$text="<br/><br/>".LAN_4xA_FORM_125."<br/><br/><br/>";
	} 
elseif(check_class($my_form_data['form_kat_submit_user']))
	{
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
if(!$autrag_id || $autrag_id==0)
{
}

if($autrag_id)
	{
	$text="<br/><br/>"; 
	$ausgabe_text = data_ausgabe($autrag_id,$formid);
	$text .= $ausgabe_text;
	$text .="<br/>";
	
$text .= "<div style='text-align:center;'>
<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>".LAN_4xA_FORM_ZURUECK."</b></div><br/></div>";
	}
else{

if(!$formid || $my_form_data['form_kat_id']==0)
	{
	$MY_WHERE="";
	}
else{$MY_WHERE="AND form_auftrag_form_id='".$formid ."' ";}

$text.="<br/><br/><table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	$text.="<tr>";
	$text.="<td class='fcaption'>ID</td>";
	$text.="<td class='fcaption'>Verfasser</td>";
	$text.="<td class='fcaption'>Betreff</td>";
	$text.="<td class='fcaption'>erfasst am</td>";
	$text.=(ADMIN)? "<td class='fcaption'>Opt.</td>":"";
	$text.="</tr>";	

$qry1=" SELECT a.*, ab.*, ac.* FROM ".MPREFIX."e4xA_form_auftrag AS a
 LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=a.form_auftrag_uid
 LEFT JOIN ".MPREFIX."e4xA_form_kathegories AS ac ON ac.form_kat_id=a.form_auftrag_form_id 
 WHERE form_auftrag_id!='0' ".$MY_WHERE." 
 ORDER BY form_auftrag_id DESC 
 ";
$sql->db_Select_gen($qry1);
$found = $sql->db_rows();


	if($found < 100)
	{
	$text="<br/><br/><br/>".LAN_4xA_FORM_124."<br/><br/><br/>	";
	}
	else{
		$parase="formdata=".$formid.".".$autrag_id."&";
		$psort = 'sort=[FROM].'.$anzahl;
		$parase .= $psort;

		$qry1=" SELECT a.*, ab.*, ac.* FROM ".MPREFIX."e4xA_form_auftrag AS a
 		LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=a.form_auftrag_uid
 		LEFT JOIN ".MPREFIX."e4xA_form_kathegories AS ac ON ac.form_kat_id=a.form_auftrag_form_id 
		WHERE a.form_auftrag_enable ='1' ".$MY_WHERE." 
 		ORDER BY form_auftrag_id DESC 
		LIMIT $von,$anzahl
 	";

	$sql->db_Select_gen($qry1);
	while($row = $sql-> db_Fetch()){
		$text.="<tr>";
		$text.="<td class='forumheader2'><a href='".e_SELF."?".$formid.".".$row['form_auftrag_id']."'>".$row['form_auftrag_id']."</a></td>";
		$text.="<td class='forumheader'><a href='".e_SELF."?".$formid.".".$row['form_auftrag_id']."'>".$row['user_name']."</a></td>";
		$text.="<td class='forumheader'><a href='".e_SELF."?".$formid.".".$row['form_auftrag_id']."'>".$row['form_kat_caption']."</a></td>";
		$text.="<td class='forumheader'><a href='".e_SELF."?".$formid.".".$row['form_auftrag_id']."'>".strftime("%a. %d.%b.%Y (%H:%M)",$row['form_auftrag_data'])."</a></td>";
		$text.=(ADMIN)? "<td class='forumheader2'>
						<form method='post' action='".e_SELF."?formdata=".$formid.".".$autrag_id."&sort=".$von.".".$anzahl."' id='editform_".$row['form_auftrag_id']."'>
							<input type='hidden' name='ID' value='".$row['form_auftrag_id']."'><input type='image' title='".LAN_DELETE."' name='delete[kat_{$row['form_auftrag_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_FORM_123."')\"/>
						</form>
					</td>":"";
		$text.="</tr>";	
		}
	if(!$formid || $my_form_data['form_kat_id']==0)
		{
		$text="<br/><br/><br/>".LAN_4xA_FORM_124."<br/><br/><br/>";
		}
		$text.="</table><br/><br/>";


		if($found >12){
 		$parms = $found.",".$anzahl.",".$von.",".e_SELF.'?'.$parase;
 		$text .="<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
 		}
	}
 }
}
else{
/////////////////////////////////////////////////////////////////// } else{ 
$useklasses_text[0] = LAN_4xA_FORM_38;
$useklasses_text[252] = LAN_4xA_FORM_39; 
$useklasses_text[253] = LAN_4xA_FORM_40;
$useklasses_text[254] = LAN_4xA_FORM_41;
$useklasses_text[255] = LAN_4xA_FORM_42;
$sql ->db_Select("userclass_classes","userclass_id, userclass_name"," ORDER BY userclass_name", "no_where"); 
while($row = $sql-> db_Fetch()){
	extract($row);
	$useklasses_text[$userclass_id] = $userclass_name;
	}

$text ="<br/><br/>".LAN_4xA_FORM_96."<br/><br/>".LAN_4xA_FORM_98." 
<b>\"".$useklasses_text[$my_form_data['form_kat_submit_user']]."\"</b><br/><br/>";	
$page_caption=LAN_4xA_FORM_97;
	}

/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:80%;'>.:: powered by 4xA-Formular v".e4xA_FORM_VERSION." from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns->tablerender($page_caption, $text);
require_once(FOOTERF);
/////////////////////////////
function data_save($formid)
{
require_once("form_handler.php");
global $sql,$tp,$_POST,$_FILES;
$tablename="e4xA_form_opt";
$primaryid="form_opt_id";
$order_field="form_opt_sort";

$fc=0;
$sql -> db_Select($tablename, "*", "form_opt_enable!='0' AND form_opt_kat_id='".$formid."' ORDER BY form_opt_sort");
while($row = $sql-> db_Fetch())
	{
	$fields[$fc]['form_opt_id']=$row['form_opt_id'];	
	$fields[$fc]['field_iso_name']=$row['form_opt_iso_name'];
	$fields[$fc]['fieldname']=$row['form_opt_name'];
	$fields[$fc]['fieldtype']=$row['form_opt_typ'];
	//$fields[$fc]['fieldpar']=$row['form_opt_par'];
	$fields[$fc]['field_pflicht']=(($row['form_opt_pflicht']==1)? true:false);
	$fc++;
	}
	for ($i=0; $i< $fc; $i++) {
if($fields[$i]['field_pflicht'] && !$_POST[$fields[$i]['field_iso_name']] && $fields[$i]['fieldtype']!=9)
	{
	$fields_ausgabe['id']=false;
	$fields_ausgabe['mesage']=LAN_4xA_FORM_137.$fields[$i]['fieldname'].LAN_4xA_FORM_138."-".$_POST[$fields[$i]['field_iso_name']]."-";
	return $fields_ausgabe;
	}
elseif($fields[$i]['fieldtype']==9 && $fields[$i]['field_pflicht'] && $_FILES[$fields[$i]['field_iso_name']]['tmp_name']=="")
	{
	$fields_ausgabe['id']=false;
	$fields_ausgabe['mesage']=LAN_4xA_FORM_137.$fields[$i]['fieldname'].LAN_4xA_FORM_138."-".$_FILES[$fields[$i]['field_iso_name']]['tmp_name']."-";
	return $fields_ausgabe;
	}

}
$inputstr  = USERID.", ";
$inputstr .= "'".time()."', ";
$inputstr .= "'0', '1', '1', '1', '1', '1', '".$formid."'";
$new_antrag = ($sql -> db_Insert("e4xA_form_auftrag", "0, ".$inputstr." ")) ? true : false;	
if($new_antrag)
	{
	$sql -> db_Select("e4xA_form_auftrag", "*", "form_auftrag_uid='".USERID."' ORDER BY form_auftrag_id DESC LIMIT 1");
	$row = $sql-> db_Fetch();
	$auftrag=$row;

	$upload_ausgabe_text="";
	for ($i=0; $i< $fc; $i++) {
	$inputstr="'".$auftrag['form_auftrag_id']."', '".$fields[$i]['form_opt_id']."', ";
	if ($fields[$i]['fieldtype']==6 || $fields[$i]['fieldtype'] == 7){
	$year = $fields[$i]['field_iso_name']."_year";
	$month = $fields[$i]['field_iso_name']."_month";
	$day = $fields[$i]['field_iso_name']."_day";
	if($fields[$i]['fieldtype']==6){
			$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
   	}else {
			$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
       	}
		}
		elseif($fields[$i]['fieldtype']==9)
			{
			$MY_FILE= file_upload($_FILES[$fields[$i]['field_iso_name']]['tmp_name'],UPLOAD_FOLDER,$_FILES[$fields[$i]['field_iso_name']]['name']);
			if($MY_FILE['wert']!=0)
				{
				$upload_ausgabe_text .=	"<br/>".$MY_FILE['text'];
				$inputstr .= " '".$tp->toDB("<a href='".UPLOAD_FOLDER.$MY_FILE['file']."'>".$MY_FILE['file']."</a>")."'";
				}
			else{
				$upload_ausgabe_text .=	"<br/>".$MY_FILE['text'];
			  }
			}
		else{
		$inputstr .= " '".$tp->toDB($_POST[$fields[$i]['field_iso_name']])."'";
		}
		$to_DB=$sql -> db_Insert("e4xA_form_pos", "0, ".$inputstr."");
		};
	
	$fields_ausgabe['id']=$auftrag['form_auftrag_id'];
	$fields_ausgabe['mesage']=$upload_ausgabe_text;
	return $fields_ausgabe;
	}
else{
  $fields_ausgabe['id']=false;
	return $fields_ausgabe;
	}
}
/////////////////////////////
function get_antrag_daten($id)
{
global $sql,$tp;

$qry1=" SELECT a.*, ab.* FROM ".MPREFIX."e4xA_form_auftrag AS a
 LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=a.form_auftrag_uid
 WHERE a.form_auftrag_id='".$id."' LIMIT 1
 ";

$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
return $row;
}
/////////////////////////////
function data_ausgabe($id,$formid)
{
global $sql,$tp;
$tablename="e4xA_form_opt";
$primaryid="form_opt_id";
$order_field="form_opt_sort";
$fc=0;

$ANTRAG= get_antrag_daten($id);

$sql -> db_Select($tablename, "*", "form_opt_enable!='0' AND form_opt_kat_id='".$formid."'  ORDER BY form_opt_sort");
while($row = $sql-> db_Fetch())
	{
	$fields[$fc]=$row;$fc++;
	}
$pos_c=0;
$sql -> db_Select("e4xA_form_pos", "*", "form_pos_auftrag_id='".$id."' ORDER BY form_pos_id");
while($row = $sql-> db_Fetch())
	{
	$positionen[$pos_c]=$row;$pos_c++;
	}
///####
for($i=0; $i <  $fc; $i++)
	{
	for($j=0; $j <  $pos_c; $j++)
		{
		if($fields[$i]['form_opt_id'] == $positionen[$j]['form_pos_opt_id'])
			{
			 $my_value[$i]=$fields[$i];
			 $my_value[$i]['form_pos_opt_value']=$positionen[$j]['form_pos_opt_value'];
			}
		}
	}
$AUSGABE="Daten erfasst durch:<a href='../../user.php?id.".$ANTRAG['user_id']."'> ".$ANTRAG['user_name']."</a> am: ".strftime("%a. %d.%b.%Y (%H:%M)",$ANTRAG['form_auftrag_data'])." <br/>
					".$ANTRAG['form_auftrag_akt_data']."    ".$ANTRAG['form_auftrag_enable']."
					
					<div style='text-align:center;'><br/><br/>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
for($i=0; $i <  $fc; $i++)
	{
	$AUSGABE.="<tr><td style='vertical-align:top;width:30%;' class='forumheader3'>".$my_value[$i]['form_opt_name'].": </td><td style='vertical-align:top' class='forumheader3'>";
	$AUSGABE.= value_ausgeben($my_value[$i]);
	$AUSGABE.="</td></tr>";
	}
$AUSGABE.="	</table>
					</div>
					<br/>";
return $AUSGABE;
}
/////////////////////////////////////////////////////////
function mail_versenden($text)
{
require_once(e_HANDLER."mail.php");
global $my_form_data,$tp;

$send_to=SITEADMINEMAIL;
$subject=$my_form_data['form_kat_caption']." ".strftime("%d.%b.%Y %H:%M",time())."";
$to_name="Admins";
$send_from=SITENAME;
$from_name=SITENAME;

$Mesages_text=$tp->toHTML($my_form_data['form_kat_mail_desc']."<br/><br/>".$text, TRUE);
sendemail($send_to, $subject, $Mesages_text, $to_name, $send_from, $from_name, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");
/////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////
function value_ausgeben($my_value)
{
global $tp,$sql;
if($my_value['form_opt_typ']==1 || $my_value['form_opt_typ']==8)
	{
	return $tp->toHTML($my_value['form_pos_opt_value'], TRUE);
	}
elseif($my_value['form_opt_typ']==2 || $my_value['form_opt_typ']==5)
	{  /////////////dropdown2 or radio
		$par_pos = explode(";", $my_value['form_opt_par']);
		$par_pos_c=count($par_pos);
		for($j=0; $j < $par_pos_c ;$j++)
			{
			list($par_id, $par_text) = explode(":", $par_pos[$j]);
			$my_par[$j]['id']=$par_id;
			$my_par[$j]['text']=$par_text;
			}
	return $my_par[($my_value['form_pos_opt_value']-1)]['text'];
	}
elseif($my_value['form_opt_typ']==3)
	{  /////////////Checkbox
	($my_value['form_pos_opt_value']==1)? $ja_nein= "JA" :$ja_nein="Nein";
	return $ja_nein;
	}
elseif($my_value['form_opt_typ']==4)
	{	//////////////Tabelle 
	list($table_name, $id_feld, $ausgabe_feld) = explode(";", $my_value['form_opt_par']);
	$sql -> db_Select($table_name, "*", "".$id_feld."='".$my_value['form_pos_opt_value']."' LIMIT 1");
	$row = $sql-> db_Fetch();
	return $row[$ausgabe_feld];
	}
elseif($my_value['form_opt_typ']==6 || $my_value['form_opt_typ']==7 )
	{	//////////////date  datestamp
	return strftime("%d %b %Y",$my_value['form_pos_opt_value']);
	}
elseif($my_value['form_opt_typ']==9)
	{	////////////// datei
	return $tp->toHTML($my_value['form_pos_opt_value'], TRUE);
	}
else{
return $my_value['form_pos_opt_value'];
	}
}
/////////////////////////////////////////////////////////////////////
function delete_antrag($id_to_edit)
{
global $sql;

	$message ="";
	$message .= ($sql -> db_Delete("e4xA_form_pos", "form_pos_auftrag_id='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
	$message .= ($sql -> db_Delete("e4xA_form_auftrag", "form_auftrag_id='".$id_to_edit."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;	
	$message .="";
return 	$message;
}
?>