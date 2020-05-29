<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/admin/admin_auftraege_offen.php $
|		$Revision: 0.01 $
|		$Date: 2008/10/05 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/cat_lan.php");
// ------------------------------

if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);

$link_query="?".$action."";
}

$ImageDELETE['PFAD']=e_PLUGIN."my_little_shop/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Auftrag LÃ¶schen' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."my_little_shop/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='???' src='".$ImageEDIT['PFAD']."'>";

$ImageLIST['PFAD']=e_PLUGIN."my_little_shop/images/search_16.png";
$ImageLIST['LINK']="<img border='0' style='vertical-align: middle' title='Auftrag ansehen' src='".$ImageLIST['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = "Offene Aufträge verwalten";//"My Plugin - Configuration ";

    $tablename = "mls_auftrag";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_auftrag_id";   // first column of your table.
    $e_wysiwyg = ""; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "offene";  // unique name that matches the one used in admin_menu.php.
	$show_preset = FALSE; // allow e107 presets to be saved for use in the form.

/*
// Field 1   - first field after the primary one.
    $fieldcapt[] = ".mls_auftrag_kunde_id.";//"mls_auftrag_kunde_id";
    $fieldname[] = "mls_auftrag_kunde_id";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 2
    $fieldcapt[] = "mls_auftrag_zahlung";//"mls_auftrag_zahlung";
    $fieldname[] = "mls_auftrag_zahlung";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_category,mls_category_id,mls_category_name"; // [table name,value-field,display-field]

    $fieldcapt[] = "mls_auftrag_status";//"mls_auftrag_status";
    $fieldname[] = "mls_auftrag_status";
    $fieldtype[] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[] = "1:offen,2:im bearbeitung,3:geschloßen"; // [table name,value-field,display-field]


// Field 3
    $fieldcapt[] = "mls_auftrag_color";//"mls_auftrag_color";
    $fieldname[] = "mls_auftrag_color";
    $fieldtype[] = "color";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = "";  // [default-text,width,height]

// Field 4
    $fieldcapt[] = "mls_auftrag_date";//"mls_auftrag_date";
    $fieldname[] = "mls_auftrag_date";
    $fieldtype[] = "text";     // simple checkbox.
    $fieldvalu[] = ""; 

// Field 5
    $fieldcapt[] = "mls_auftrag_date2";//"mls_auftrag_date2";
    $fieldname[] = "mls_auftrag_date2";
    $fieldtype[] = "text";  // color selector
    $fieldvalu[] = "";       // [not required]

// Field 6
    $fieldcapt[] = "mls_auftrag_date3";//"mls_auftrag_date3";
    $fieldname[] = "mls_auftrag_date3";
    $fieldtype[] = "text";  // color selector
    $fieldvalu[] = "";       // [not required]
*/
//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
//$pst->save_preset(); // save and render result using unique name
require_once("../handler/form_handler.php");
$rs = new my_form;

////////////////// Datensatz LÃ¶schen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
//////////////////////////////////////////////////////////////
if(isset($_POST['setstat']))
{
	$inputstr="mls_auftrag_status='".$_POST['setstat']."', mls_auftrag_date3='".time()."'";
	$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='ZurÃ¼ck' /></form></td></tr></table></div>";
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
///+++++++++++++++++++++++++
else{
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
///////////////////////////Tabelle ///////////////
if($action == "NEUE")
	{	$SQLSTRING="mls_auftrag_status ='1'";
		$SQLSTRING2="a.mls_auftrag_kunde_id!='' AND a.mls_auftrag_status ='1'";
	}
if($action == "OK")
	{	$SQLSTRING="mls_auftrag_status ='3'";
		$SQLSTRING2="a.mls_auftrag_kunde_id!='' AND a.mls_auftrag_status ='3'";
	}
elseif($action == "PROZES")
	{	$SQLSTRING="mls_auftrag_status ='2'";
		$SQLSTRING2="a.mls_auftrag_kunde_id!='' AND a.mls_auftrag_status ='2'";
	}
elseif($action == "OFF")
	{	$SQLSTRING="mls_auftrag_status ='1' OR mls_auftrag_status ='2'";
		$SQLSTRING2="a.mls_auftrag_kunde_id!='' AND a.mls_auftrag_status ='1' OR a.mls_auftrag_status ='2' AND a.mls_auftrag_kunde_id!=''";
	}
else{
$SQLSTRING="mls_auftrag_id!='0'";$SQLSTRING2="a.mls_auftrag_kunde_id!=''";
}
$table_total2 = $sql -> db_Select("mls_auftrag", "*", $SQLSTRING);			
$text = "<div style=\"text-align:center\">
					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='forumheader' width='5%'>Auftrag</td>
   							<td class='forumheader' width='15%'>reingekommen</td>
   							<td class='forumheader' width='5%'>Kunden Nr.</td>
   							<td class='forumheader' >Kunde</td>
   							<td class='forumheader' >Auftrag</td>
   							<td class='forumheader' >letzte Änderungen</td>
   							<td class='forumheader' width='120px'>Status</td>
   							<td class='forumheader'>Optionen</td>
   							</tr>";

if($table_total2)
  {
  	///WHERE a.mls_auftrag_status ='1' OR a.mls_auftrag_status ='2'
  	
	 $qry1="
 			SELECT a.*, ab.* FROM ".MPREFIX."mls_auftrag AS a 
 			LEFT JOIN ".MPREFIX."mls_kunde_data AS ab ON ab.mls_kunde_data_id=a.mls_auftrag_kunde_id
 			WHERE ".$SQLSTRING2." ORDER BY a.mls_auftrag_id
   			";
   		$counter1=0;
			$sql->db_Select_gen($qry1);
      while($row = $sql-> db_Fetch()){
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_id']=$row['mls_auftrag_id'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_kunde_id']=$row['mls_auftrag_kunde_id'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_zahlung']=$row['mls_auftrag_zahlung'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_status']=$row['mls_auftrag_status'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_color']=$row['mls_auftrag_color'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_date']=$row['mls_auftrag_date'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_date2']=$row['mls_auftrag_date2'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_auftrag_date3']=$row['mls_auftrag_date3'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_kunde_data_use_id']=$row['mls_kunde_data_use_id'];
     		$OFFENE_AUFTRAEGE[$counter1]['mls_kunde_data_sex']=$row['mls_kunde_data_sex'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_kunde_data_firstname']=$row['mls_kunde_data_firstname'];
      	$OFFENE_AUFTRAEGE[$counter1]['mls_kunde_data_secondname']=$row['mls_kunde_data_secondname'];
      	
      	$counter1++;
      	}

$status_pfad[1]=e_PLUGIN."my_little_shop/images/red.png";
$status_pfad[2]=e_PLUGIN."my_little_shop/images/yelow.png";
$status_pfad[3]=e_PLUGIN."my_little_shop/images/green.png";

$kunde_data_sex[1]="Herr";
$kunde_data_sex[2]="Frau";
$kunde_data_sex[3]="Firma";

for($i=0; $i < $counter1; $i++)
			{$IMG_PFAD=$status_pfad[$OFFENE_AUFTRAEGE[$i]['mls_auftrag_status']];
	$text .= "<tr>
   						<td class='forumheader' width='5%'>".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."</td>
   						<td class='forumheader' width='15%'>".strftime("%d.%m.%y(%H:%M)",$OFFENE_AUFTRAEGE[$i]['mls_auftrag_date'])."</td>
   						<td class='forumheader' >".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_kunde_id']."</td>
   						<td class='forumheader' >".$kunde_data_sex[$OFFENE_AUFTRAEGE[$i]['mls_kunde_data_sex']]." ".$OFFENE_AUFTRAEGE[$i]['mls_kunde_data_firstname']." ".$OFFENE_AUFTRAEGE[$i]['mls_kunde_data_secondname']."</td>
   						<td class='forumheader' ><img src='".$IMG_PFAD."'></td>
   						<td class='forumheader' >";
   $text .= ($OFFENE_AUFTRAEGE[$i]['mls_auftrag_date3']!="0")? strftime("%d.%m.%y(%H:%M)",$OFFENE_AUFTRAEGE[$i]['mls_auftrag_date3']) : "";												
   $text .="	</td>
   						<td class='forumheader' width='120px'>
   								<form method='post' action='".e_SELF.$link_query."' id='setstat_".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."'>
										<input type='hidden' name='ID' value='".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."'>
										<select class='tbox' style='width:150px' name='setstat' onChange='this.form.submit()'>
											<option value='1'".($OFFENE_AUFTRAEGE[$i]['mls_auftrag_status']==1?" selected='selected'":"").">Offen</option>
											<option value='2'".($OFFENE_AUFTRAEGE[$i]['mls_auftrag_status']==2?" selected='selected'":"").">Im Bearbeitung</option>
											<option value='3'".($OFFENE_AUFTRAEGE[$i]['mls_auftrag_status']==3?" selected='selected'":"").">Geschlossen</option>
										</select>
									</form>
   							</td>
   							<td class='forumheader'>
   								<form method='post' action='".e_SELF."' id='update'>
   									<input type='hidden' name='auftrag_id' value='".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."'>
   									<input type='image' title='Auftrag löschen' name='delete[kat_{$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('Auchtung!! Soll dieses Auftrag gelÃ¶scht werden [".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."] ?')\"/> | 
											<a href='admin_auftrag.php?".$OFFENE_AUFTRAEGE[$i]['mls_auftrag_id']."' title='Auftrag ansehen'>".$ImageLIST['LINK']."</a>
   								</form>
   							</td>
   						</tr>";
			}
	$configtitle .= $counter1;
	$configtitle .="-";
	$configtitle .=count($sql-> db_Fetch());
	}
else{
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".KEINE_OFFENE."<br/><br/></td></tr>";

	}
$text .= "</table></div>";
}
$text .= "<br/><br/>";
$text.=powered_by_shop();
$text .= "</div>";
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
///++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///							Eigene Funktionen
///++++++++++++++++++++++++++++++++++++++++++++++++++++++++
?>
