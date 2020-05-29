<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/admin/admin_hersteller.php $
|		$Revision: 0.01 $
|		$Date: 2008/07/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/hersteller_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/hersteller_lan.php");
// ------------------------------

if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}
$ImageNEW['PFAD']=e_PLUGIN."my_little_shop/images/OK.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_MANUF_20."' src='".$ImageNEW['PFAD']."'>";

$ImageDELETE['PFAD']=e_PLUGIN."my_little_shop/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_MANUF_22."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."my_little_shop/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_MANUF_23."' src='".$ImageEDIT['PFAD']."'>";

$ImageLIST['PFAD']=e_PLUGIN."my_little_shop/images/sublink_16.png";
$ImageLIST['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_MANUF_18."' src='".$ImageLIST['PFAD']."'>";

$ImageNEWPROD['PFAD']=e_PLUGIN."my_little_shop/images/articles_16.png";
$ImageNEWPROD['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_MANUF_24."' src='".$ImageNEWPROD['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = MLS_LAN_MANUF_0;//"Hersteller verwalten ";

    $tablename = "mls_hersteller";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_hersteller_id";   // first column of your table.
    $e_wysiwyg = "mls_hersteller_text"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "hersteller";  // unique name that matches the one used in admin_menu.php.
	  $show_preset = TRUE; // allow e107 presets to be saved for use in the form.


    $fieldcapt[] = MLS_LAN_MANUF_1;//Hersteller- Name
    $fieldname[] = "mls_hersteller_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";

    $fieldcapt[] = MLS_LAN_MANUF_2;//Hersteller- Hompage
    $fieldname[] = "mls_hersteller_url";
    $fieldtype[] = "text"; 
    $fieldvalu[] = "";

    $fieldcapt[] = MLS_LAN_MANUF_4;//Hersteller Beschreibung
    $fieldname[] = "mls_hersteller_text";
    $fieldtype[] = "textarea";     
    $fieldvalu[] = ",100%,200px";  // [default-text,width,height]

    $fieldcapt[] = MLS_LAN_MANUF_5;//Hersteller Activ ? 
    $fieldname[] = "mls_hersteller_enable";
    $fieldtype[] = "checkbox";
    $fieldvalu[] = "1"; 
    $ckeck1="1";          // [checkbox value]
// Field 5
    $fieldcapt[] = MLS_LAN_MANUF_6;//*Hersteller Farbe*
    $fieldname[] = "mls_hersteller_color";
    $fieldtype[] = "color";
    $fieldvalu[] = "";

// Field 6
    $fieldcapt[] = MLS_LAN_MANUF_7;//*Hersteller- Verzeichniss*
    $fieldname[] = "mls_hersteller_dir";
    $fieldtype[] = "dir";
    $fieldvalu[] = "".e_PLUGIN."myl_ittle_shop/manufact_images/";

// Field 7
    $fieldcapt[] = MLS_LAN_MANUF_8;//Hersteller- Logo
    $fieldname[] = "mls_hersteller_image";
    $fieldtype[] = "image";
    $fieldvalu[] = "".e_PLUGIN."my_little_shop/manufact_images/";




// -------- Presets. ------------  // always load before auth.php
require_once(e_ADMIN."auth.php");
require_once("../handler/form_handler.php");
$rs = new my_form;

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
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='Zurück' /></form></td></tr></table></div>";
	
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";	
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
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method='post' action='".e_SELF."' id='back'><input class='button' type='submit' id='back' name='back' value='".MLS_LAN_MANUF_9."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".MLS_LAN_MANUF_10."</b>";
	}
////////////////////// Neu Erstellen ////////////////
else{
	if(isset($_POST['submitit']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
		  {
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			$year = $fieldname[$i]."_year";
			$month = $fieldname[$i]."_month";
			$day = $fieldname[$i]."_day";
			if($fieldtype[$i]=="date"){
					$inputstr .= " '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
        	}else {
					$inputstr .= " '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
        	}
					} else {
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
	
///////////////////////////Tabelle mit vorhandenen zeigen. Ersmal Überschrift...///////////////
$table_total2 = $sql -> db_Select("mls_hersteller", "*", "mls_hersteller_name !=''");			
$text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".MLS_LAN_MANUF_20."</div></a>
 </form>
 <br/> 
 <br/><b>".MLS_LAN_MANUF_11."</b><br/><div style='width:96%'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='forumheader' width='70' colspan='2'>".MLS_LAN_MANUF_12."</td>
								<td class='forumheader' width='40'>".MLS_LAN_MANUF_14."</td>
								<td class='forumheader'>".MLS_LAN_MANUF_15."</td>
								<td class='forumheader'>".MLS_LAN_MANUF_3."</td>
								<td class='forumheader'width='40'>".MLS_LAN_MANUF_16."</td>		
								<td class='forumheader'width='40'>".MLS_LAN_MANUF_13."</td>
								<td class='forumheader' width='110'>".MLS_LAN_MANUF_17."</td>
   							</tr>";

if($table_total2)
  {
  	
$activ[0]="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_rot.gif'>";
$activ[1]="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_gruen.gif'>";
$counter=0;
$sql -> db_Select("mls_hersteller", "*", "mls_hersteller_name !='' ORDER BY mls_hersteller_name");
while($row = $sql-> db_Fetch()){
	$hersteller[$counter]['id']=$row['mls_hersteller_id'];
	$hersteller[$counter]['hersteller']=$row['mls_hersteller_name'];
	$hersteller[$counter]['url']=$row['mls_hersteller_url'];
	$hersteller[$counter]['hersteller_text']=$row['mls_hersteller_text'];
	$hersteller[$counter]['hersteller_enable']=$row['mls_hersteller_enable'];
	$hersteller[$counter]['hersteller_color']=$row['mls_hersteller_color'];
	$hersteller[$counter]['hersteller_dir']=$row['mls_hersteller_dir'];
	$hersteller[$counter]['hersteller_image']=$row['mls_hersteller_image'];
	$hersteller[$counter]['count']= zaehler("mls_products",  "mls_products_hersteller_id ='".$hersteller[$counter]['id']."' AND mls_products_enable='1'");
	$counter++;
	}    

for($i=0; $i < $counter; $i++)
		{if(!($A=$i%2)){$tabform="fcaption";}else{$tabform="forumheader2";}
		if($hersteller[$i]['hersteller_enable']!=1){$AKT=0;}
		else{$AKT=1;}		
		$text .="<tr>
   							<td class='".$tabform."' width='40'>".$hersteller[$i]['id']."</td>
   							<td class='".$tabform."' width='30'>".$activ[$AKT]."</td>
   							<td class='".$tabform."'>";
   			if(!$hersteller[$i]['hersteller_image']){$text .="<img border='0' src='".e_PLUGIN."my_little_shop/images/default.jpg'";}
					else{$text .="<img border='0' src='".e_PLUGIN."my_little_shop/manufact_images/".$hersteller[$i]['hersteller_image']."'";}
					$text .="height='20px'></td>
   							<td class='".$tabform."'>".$hersteller[$i]['hersteller']."</td>
								<td class='".$tabform."'>".$hersteller[$i]['url']."</td>
								<td class='".$tabform."' width='40'>".$hersteller[$i]['count']."</td>
								<td class='".$tabform."' width='40'><table style='width:100%' class='fborder' cellspacing='2' cellpadding='2'><tr><td style='width:10px;height:10px;background-color:#".$hersteller[$i]['hersteller_color']."'>&nbsp;&nbsp;</td></tr></table></td>							
								<td class='".$tabform."' width='110'><form method='post' action='".e_SELF."' id='editform'>
																							<input type='hidden' name='ID' value='".$hersteller[$i]['id']."'>
																							<input type='image' title='".LAN_DELETE."' name='delete[kat_{$hersteller[$i]['id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".MLS_LAN_MANUF_21." [".$hersteller[$i]['hersteller']."]')\"/> | 
																							<a href='".e_SELF."?edit.".$hersteller[$i]['id']."'>".$ImageEDIT['LINK']."</a> | 
																							<a href='".e_SELF."?list.".$hersteller[$i]['id']."' title='".MLS_LAN_MANUF_18."'>".$ImageLIST['LINK']."</a>
																						</form>	
																			</td></tr>";
		}

	}
else{
	$text .="<tr><td class='forumheader' colspan='8'>".MLS_LAN_MANUF_24."</td></tr>";

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
/////////////////////////////////////////////////////////////
function zaehler($tab_name, $query){
	$c=0;
	global $pref,$key,$sql2,$user_pref;$_POST;
	$sql2 -> db_Select($tab_name, "*", $query);
  while($row3 = $sql2-> db_Fetch()){
				$c++;
				}
	return $c;
	}
?>
