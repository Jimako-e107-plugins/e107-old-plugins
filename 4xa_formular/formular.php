<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/formular.php
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
require_once("constanten.php");

if(e_QUERY)
	{
	list($formid) = explode(".", e_QUERY);
	$formid = intval($formid);
	}
$sql -> db_Select("e4xA_form_kathegories", "*", "form_kat_id='".$formid."' LIMIT 1");
$my_form_data = $sql->db_Fetch();

if($my_form_data['form_kat_admin'] && ADMIN)
{
	if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
	require_once(e_ADMIN."auth.php");
}
else{
require_once(HEADERF);
}

$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");

define("UPLOAD_FOLDER", e_FILE."public/");


if($my_form_data['form_kat_caption']!='')
		{
		$page_caption=$my_form_data['form_kat_caption'];
		}
elseif($pref['e4xA_form_caption']!='')
		{
		$page_caption=$pref['e4xA_form_caption'];
		}
else{$page_caption=LAN_4xA_FORM_99;}

if(!$formid || $my_form_data['form_kat_id']==0)
{
$text="<br/><br/>".LAN_4xA_FORM_124."<br/><br/><br/>";
}
elseif($my_form_data['form_kat_enable']=='0')
	{	
$text="<br/><br/>".LAN_4xA_FORM_125."<br/><br/><br/>";
}
elseif(check_class($my_form_data['form_kat_submit_user']))
	{		
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['submitit']))
	{
	$autrag=data_save($formid);
	$auftrag_text=$autrag['mesage'];
	$autrag_id=$autrag['id'];
$varA=$_POST['varA'];
$varB=$_POST['varB'];
$vat_oper=$_POST['vat_oper'];	
$resultA=	$_POST['result'];


switch ($vat_oper) {
	case 1:
        $resultB=$varA-$varB;
        break;	
	case 2:
        $resultB=$varA+$varB;
        break;
  case 3:
        $resultB=$varA / $varB;
        break;
 	case 4:
        $resultB=$varA * $varB;
        break;
	}
if($my_form_data['form_kat_certific'] && $resultA!=$resultB)
	{
	$text="<div style='text-align:center;'><br/><br/><br/><br/>	".LAN_4xA_FORM_162."<br/><br/><br/>
					<form method='post' action='".e_SELF."?".$formid."' id='adminform'>
						<input class='button' type='submit' id='abbruch' name='abbruch' value='".LAN_4xA_FORM_139."' />
					</form><br/><br/>
					";
		
	}
else{
	if($autrag_id!=0)
		{
		$text="<br/><br/>".$auftrag_text."<br/>".LAN_4xA_FORM_101."<br/><br/><br/>";
		$ausgabe_text = data_ausgabe($autrag_id,$formid);
		if($my_form_data['form_kat_mail']=='1')
			{
			mail_versenden($ausgabe_text,$my_form_data['form_kat_mail_adress']);
			}
		$text .= $ausgabe_text;
		}
	else{
		$text="<br/><br/><br/>".$auftrag_text."<br/><br/><br/>";
		$text.="<div style='text-align:center;'><br/><br/>
							<form method='post' action='".e_SELF."?".$formid."' id='adminform'>
							<input class='button' type='submit' id='abbruch' name='abbruch' value='".LAN_4xA_FORM_139."' />
							</form><br/><br/>";
		}
		}
	}
///////////////////////////////////////////////////////////////////
else{
require_once("form_handler.php");
$rs = new myf_form;
$tablename="e4xA_form_opt";
$primaryid="form_opt_id";
$order_field="form_opt_sort";
$e_wysiwyg="";
$e_wysiwyg_count=0;
$fc=0;
$sql -> db_Select($tablename, "*", "form_opt_enable!='0' AND form_opt_kat_id='".$formid."' ORDER BY form_opt_sort");
while($row = $sql-> db_Fetch())
	{
	$fields[$fc]=$row;
	$fields[$fc]['field_pflicht']=(($row['form_opt_pflicht']==1)? true:false);
	if($row['form_opt_typ']=="8")
		{
		$e_wysiwyg .=($e_wysiwyg_count >0)? ",".$row['form_opt_iso_name']:$row['form_opt_iso_name'];	
		}
	$fc++;
	}
$field_types[1]="text";
$field_types[2]="dropdown2";
$field_types[3]="checkbox";
$field_types[4]="table";
$field_types[5]="radio";
$field_types[6]="date";
$field_types[7]="datestamp";
$field_types[8]="textarea";
$field_types[9]="upload";
$field_types[10]="caleder";
$text="";
$pflicht_felder_anzahl=0;
for($i=0; $i < $fc; $i++)
	{
	if($fields[$i]['field_pflicht'])
		{
		$pflicht_felder_anzahl++;	
		}
	}
if($my_form_data['form_kat_desc']!='')
{
$text.=$tp->toHTML($my_form_data['form_kat_desc'], TRUE);
}
if($pflicht_felder_anzahl > 0)
{
$text.=LAN_4xA_FORM_140;
}

$text.="<br/>
				<div style='text-align:center;'>
				<form enctype=\"multipart/form-data\" method=\"post\" action=\"".e_SELF."?".$formid."\" id=\"4xa_form\">
				<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";

for($i=0; $i < $fc; $i++)
		{		
		$form_send = $fields[$i]['form_opt_text']."|".$field_types[$fields[$i]['form_opt_typ']]."|".$fields[$i]['form_opt_par'];
		$text .="<tr>
						<td style='width:30%; vertical-align:top' class='forumheader'><b>".$fields[$i]['form_opt_name']."".(($fields[$i]['field_pflicht'])?"<font style='color:#f00'> *</font>":"")."</b><br/><font style='font-size:80%;'>".($tp->toHTML($fields[$i]['form_opt_text'], TRUE))."</font>";			
		if($fields[$i]['form_opt_typ']==9)
				{
				$text .="<br/>".LAN_4xA_FORM_165."<b>".filetypes_chek($fields[$i]['form_opt_par'])."</b><br/>";	
				$text .="<br/>".LAN_4xA_FORM_166."<b>".filesize_chek($fields[$i]['form_opt_par'])."</b>";		
				}				
		$text .="</td>
						<td style='width:70%;' class='forumheader3'>";
		$text .= $rs->user_extended_element_edit($form_send,"",$fields[$i]['form_opt_iso_name']);
		$text .="	</td>
					</tr>";
		}
	
$varA=rand(1,9);
$varB=rand(1,9);
$vat_oper=rand(2,2);
$operatoren[1]="-";
$operatoren[2]="+";
$operatoren[3]=":";
$operatoren[4]="*";
$text .="</table><br/>";

if($my_form_data['form_kat_certific']){
$text .="<input class='tbox' type='hidden' name='varA' value='".$varA."'/>
					<input class='tbox' type='hidden' name='varB' value='".$varB."'/>
					<input class='tbox' type='hidden' name='vat_oper' value='".$vat_oper."'/><br/>
					".LAN_4xA_FORM_161.": ".$varA." ".$operatoren[$vat_oper]."  ".$varB." =
					<input class='tbox' type='text' name='result' size='3' value='' maxlength='3' />";
		}					
$text .="<br/><br/>
					<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' /></form>
					</div><br/>";
	}
}
else{
$useklasses_text[0] = LAN_4xA_FORM_38;	
$useklasses_text[252] = LAN_4xA_FORM_39;
$useklasses_text[253] = LAN_4xA_FORM_40;
$useklasses_text[254] = LAN_4xA_FORM_41;
$useklasses_text[255] = LAN_4xA_FORM_42;
$sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
  while($row = $sql-> db_Fetch()){
  extract($row);
	$useklasses_text[$userclass_id] = $userclass_name;
	}

$text ="<br/><br/>".LAN_4xA_FORM_96."<br/><br/>".LAN_4xA_FORM_98."  <b>\"".$useklasses_text[$my_form_data['form_kat_submit_user']]."\"</b><br/><br/>";	
$page_caption=LAN_4xA_FORM_97;
	}

/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:80%;'>.:: powered by 4xA-Formular v".e4xA_FORM_VERSION." from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns->tablerender($page_caption, $text);
///+++++++++++++++++++++++++++++++++++++++++++++++++
if($my_form_data['form_kat_admin'] && ADMIN)
{
require_once(e_ADMIN."footer.php");
}
else{
require_once(FOOTERF);
}
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
	$fields[$fc]['fieldpar']=$row['form_opt_par'];
	$fields[$fc]['field_pflicht']=(($row['form_opt_pflicht']==1)? true:false);
	$fc++;
	}
for ($i=0; $i< $fc; $i++) {
if(($fields[$i]['field_pflicht'] && $fields[$i]['fieldtype']=='7') || ($fields[$i]['field_pflicht'] && $fields[$i]['fieldtype']=='6'))
	{	
	$DDAY=$fields[$i]['field_iso_name']."_day";
	$DMON=$fields[$i]['field_iso_name']."_month";
	$DYEAR=$fields[$i]['field_iso_name']."_year";
	if(!$_POST[$DDAY] || !$_POST[$DMON] || !$_POST[$DYEAR])
		{
		$fields_ausgabe['id']=false;
		$fields_ausgabe['mesage']=LAN_4xA_FORM_137.$fields[$i]['fieldname'].LAN_4xA_FORM_138."";
		return $fields_ausgabe;	
		}
	}		
elseif($fields[$i]['field_pflicht'] && !$_POST[$fields[$i]['field_iso_name']] && $fields[$i]['fieldtype']!=9)
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
$inputstr .= "'0', '0', '0', '0', '0', '0', '".$formid."'";
$new_antrag = ($sql -> db_Insert("e4xA_form_auftrag", "0, ".$inputstr." ")) ? true : false;	
if($new_antrag)
	{
	$sql -> db_Select("e4xA_form_auftrag", "*", "form_auftrag_uid='".USERID."' ORDER BY form_auftrag_id DESC LIMIT 1");
	$row = $sql-> db_Fetch();
	$auftrag=$row;

	$upload_ausgabe_text="";
	for ($i=0; $i< $fc; $i++) {
	$inputstr="'".$auftrag['form_auftrag_id']."', '".$fields[$i]['form_opt_id']."', ";
	
	if ($fields[$i]['fieldtype']==10){
		$dat_data=explode(" / ",$_POST[$fields[$i]['field_iso_name']]);
		$datum_ganz=$dat_data[0];
		$time_ganz=$dat_data[1];
		$datum_data=explode(".",$datum_ganz);
		$Jahr=$datum_data[2];$Monat=$datum_data[1];$Tag=$datum_data[0];
		$time_data=explode(":",$time_ganz);
		$Stunden=$time_data[0]; $Minuten=$time_data[1];
		$inputstr .= " '".mktime ($Stunden,$Minuten,0,$Monat,$Tag,$Jahr)."' ";			
		}
	elseif ($fields[$i]['fieldtype']==6 || $fields[$i]['fieldtype'] == 7){
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
			$FILE_UPLOAD_FOLDER=get_filefolder($fields[$i]['fieldpar']);
			if(is_dir(e_BASE.$FILE_UPLOAD_FOLDER))
				{echo e_BASE.$FILE_UPLOAD_FOLDER."OK!";
				$MY_UPLOAD_FOLDER=e_BASE.$FILE_UPLOAD_FOLDER."/";
				}
			else{echo e_BASE.$FILE_UPLOAD_FOLDER;
				$MY_UPLOAD_FOLDER=UPLOAD_FOLDER."";
				}
			$MY_FILE= file_upload($_FILES[$fields[$i]['field_iso_name']]['tmp_name'],$MY_UPLOAD_FOLDER,$_FILES[$fields[$i]['field_iso_name']]['name']);
			if($MY_FILE['wert']!=0)
				{
				$upload_ausgabe_text .=	"<br/>".$MY_FILE['text'];
				$inputstr .= " '".$tp->toDB("<a href='".$MY_UPLOAD_FOLDER.$MY_FILE['file']."'>".$MY_FILE['file']."</a>")."'";
				}
			else{
			  $fields_ausgabe['id']=false;
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
function data_ausgabe($id,$formid)
{
global $sql,$tp;
$tablename="e4xA_form_opt";
$primaryid="form_opt_id";
$order_field="form_opt_sort";
$fc=0;
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
$AUSGABE="<br/>	<div style='text-align:left;'>";
for($i=0; $i <  $fc; $i++)
	{
	$AUSGABE.="<b>".$my_value[$i]['form_opt_name'].":</b>  ";
	$AUSGABE.= value_ausgeben($my_value[$i]);
	$AUSGABE.="<br/><br/> \n";
	}
$AUSGABE.="</div><br/>";
/////////  MAIL ALS HTML AUSGEBEN !!! ////////////////////	
/*
$AUSGABE="<br/>
					<div style='text-align:center;'>
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
*/					
/////////////////////////////////////////////////////////////					
					
		
					
return $AUSGABE;
}
/////////////////////////////////////////////////////////
function mail_versenden($text,$adressen)
{
require_once(e_HANDLER."mail.php");
global $my_form_data,$tp,$sql;
$mails = explode(";",$adressen);
$ANZ=count($mails);
if ($adressen!='' && $ANZ > 0)
 { 	
for($i=0; $i< $ANZ; $i++) 	
	{
		$send_to=$mails[$i];
		$subject=$my_form_data['form_kat_caption']." ".strftime("%d.%b.%Y %H:%M",time())."";
		$to_name="Admins";
		$send_from=SITENAME;
		$from_name=SITENAME;

		$Mesages_text=$tp->toHTML($my_form_data['form_kat_mail_desc']."<br/><br/>".$text, TRUE);
		sendemail($send_to, $subject, $Mesages_text, $to_name, $send_from, $from_name, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");
	} 	
 }
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
elseif($my_value['form_opt_typ']==10)
	{	////////////// datei
	$par_pos = explode(";", $my_value['form_opt_par']);
	$calDFormat=$par_pos[0];
	$calTFormat=$par_pos[1];
	return strftime($calDFormat." / ".$calTFormat,$my_value['form_pos_opt_value']);
	}
else{
return $my_value['form_pos_opt_value'];
	}
}
?>