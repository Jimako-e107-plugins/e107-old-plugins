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
|		$Source: ../e107_plugins/my_little_shop/admin/admin_categorie.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once("../handler/constanten.php");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/cat_lan.php");
// ------------------------------

if (e_QUERY) {
	list($action, $id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}

$ImageNEW['PFAD']=e_PLUGIN.PLUG_FOLDER."images/OK.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_CAT_20."' src='".$ImageNEW['PFAD']."'>";

// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = MLS_LAN_CAT_0;//"My Plugin - Configuration ";

    $tablename = "mls_category";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_category_id";   // first column of your table.
    $e_wysiwyg = "mls_category_text"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "categorien";  // unique name that matches the one used in admin_menu.php.
	$show_preset = TRUE; // allow e107 presets to be saved for use in the form.


// Field 1   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_CAT_1;//"Kategorie Bezeichnung";
    $fieldname[] = "mls_category_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 2
    $fieldcapt[] = MLS_LAN_CAT_2;//"Übergeordnete Kategorie";
    $fieldname[] = "mls_parend_category_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_category,mls_category_id,mls_category_name"; // [table name,value-field,display-field]

    $fieldcapt[] = MLS_LAN_CAT_3;//"Steuer";
    $fieldname[] = "mls_category_steuer_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_steuer,mls_steuer_id,mls_steuer_name"; // [table name,value-field,display-field]


// Field 3
    $fieldcapt[] = MLS_LAN_CAT_4;//"Kategorie Beschreibung";
    $fieldname[] = "mls_category_text";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,100px";  // [default-text,width,height]

// Field 4
    $fieldcapt[] = MLS_LAN_CAT_5;//"Kategorie aktiv ? ";
    $fieldname[] = "mls_category_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1"; 
    $ckeck1="1";          // [checkbox value]

// Field 5
    $fieldcapt[] = MLS_LAN_CAT_6;//"*Kategorie Farbe*";
    $fieldname[] = "mls_category_color";
    $fieldtype[] = "color";  // color selector
    $fieldvalu[] = "";       // [not required]

// Field 6
    $fieldcapt[] = MLS_LAN_CAT_7;//"Kategorie Pfad";
    $fieldname[] = "mls_category_dir";
    $fieldtype[] = "dir";     // read a directory.
    $fieldvalu[] = "".e_PLUGIN.PLUG_FOLDER."produkt_images/";   // [path to directory]

// Field 7
    $fieldcapt[] = MLS_LAN_CAT_8;//"Kategorie Bild";
    $fieldname[] = "mls_category_image";
    $fieldtype[] = "image";    // image selection.
    $fieldvalu[] ="".e_PLUGIN.PLUG_FOLDER."categorie_images/"; // [path to directory]

//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
//$pst->save_preset(); // save and render result using unique name
require_once("../handler/form_handler.php");
$rs = new my_form;

////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
//////////////////////////////////////////////////////////////
if(isset($_POST['setstat']))
{
	$inputstr="mls_category_enable='".$_POST['stat']."'";
	$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ");
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
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='Zurück' /></form></td></tr></table></div>";
	
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";	
	}
///////////////////////Wenn Button "Neu" Gecklikt wird soll Formular erschenen!! /////////////////////////
elseif($action == "neu")
	{
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
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
		</form><form method=\"post\" action=\"".e_SELF."\" id=\"back\"><input class='button' type='submit' id='back' name='back' value='".MLS_LAN_CAT_9."' /></form></td></tr></table></div>";
	
		$configtitle="<b>".MLS_LAN_CAT_10."</b>";
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
///////////////////////////Tabelle mit vorhandenen Saisons zeigen. Ersmal Überschrift...///////////////
$table_total2 = $sql -> db_Select("mls_category", "*", "mls_category_name !=''");			
$text = "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.0'>".$ImageNEW['LINK']."  ".MLS_LAN_CAT_20."</div></a>
 </form>
 <br/> 
 <br/><b>".MLS_LAN_CAT_11."</b><br/><div style='width:96%'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='forumheader' width='70' colspan='2'>".MLS_LAN_CAT_12."</td>
   							<td class='forumheader' width='40'>".MLS_LAN_CAT_13."</td>
								<td class='forumheader'>".MLS_LAN_CAT_14."</td>
								<td class='forumheader' width='40'>".MLS_LAN_CAT_25."</td>	
								<td class='forumheader'>".MLS_LAN_CAT_16."</td>
								<td class='forumheader' width='110'>".MLS_LAN_CAT_17."</td>
   							</tr>";

if($table_total2)
  {
$counter=0;
$text .= req(0, 0);
	}
else{
	$text .="<tr><td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".MLS_LAN_CAT_26."<br/><br/></td></tr>";

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
///
///				Eigene Funktionen
///
///++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function zaehler($tab_name, $query){
	$c=0;
	global $pref,$key,$sql2,$user_pref;$_POST;
	$sql2 -> db_Select($tab_name, "*", $query);
  while($row3 = $sql2-> db_Fetch()){
				$c++;
				}
	return $c;
	}
function req($cat_ID, $ST){
		global $pref,$key,$sql,$user_pref;$_POST;

$ImageDELETE['PFAD']=e_PLUGIN.PLUG_FOLDER."images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_CAT_22."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN.PLUG_FOLDER."images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_CAT_23."' src='".$ImageEDIT['PFAD']."'>";

$ImageLIST['PFAD']=e_PLUGIN.PLUG_FOLDER."images/sublink_16.png";
$ImageLIST['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_CAT_18."' src='".$ImageLIST['PFAD']."'>";

$ImageNEWPROD['PFAD']=e_PLUGIN.PLUG_FOLDER."images/add.png";
$ImageNEWPROD['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_CAT_24."' src='".$ImageNEWPROD['PFAD']."'>";
		
		
		$counter=0;
	if($sql -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='".$cat_ID."' ORDER BY mls_category_name"))
        {
          $qry="
   	SELECT a.*, ab.* FROM ".MPREFIX."mls_category AS a
   	LEFT JOIN ".MPREFIX."mls_steuer AS ab ON ab.mls_steuer_id=a.mls_category_steuer_id
   	WHERE a.mls_category_name !='' AND a.mls_parend_category_id='".$cat_ID."' ORDER BY a.mls_category_name
		";
		$sql->db_Select_gen($qry);		
    while($row = $sql-> db_Fetch())
        	{
		  		///if(!$row['mls_category_enable']){continue;} // Wenn Kategorie Nicht Aktiv ist Überspringen
					$cat[$counter]['id']=$row['mls_category_id'];
					$cat[$counter]['name']=$row['mls_category_name'];
					$cat[$counter]['text']=$row['mls_category_text'];
					$cat[$counter]['enable']=$row['mls_category_enable'];
					$cat[$counter]['verzeichniss']=$row['mls_category_dir'];
					$cat[$counter]['image']=$row['mls_category_image'];
					$cat[$counter]['parend']=$row['mls_parend_category_id'];
					$cat[$counter]['steuer_id']=$row['mls_category_steuer_id'];
					$cat[$counter]['steuer']=$row['mls_steuer_name'];
					$cat[$counter]['count']= zaehler("mls_products",  "mls_products_category_id ='".$cat[$counter]['id']."' AND mls_products_enable='1'");
					$counter++;
					}
			$status_pfad[0]=e_PLUGIN.PLUG_FOLDER."images/off.png";
			$status_pfad[1]=e_PLUGIN.PLUG_FOLDER."images/on.png";
			for($i=0; $i< $counter;$i++ )
	     		{
	     		$TREE="";	
	     		if($cat[$i]['parend']!='0')
	     			{
						for($Z=0; $Z < $ST; $Z++)
							{
							$TREE .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/tree1.gif' style='style='vertical-align:middle;white-space:nowrap;''>";
							}
							$TREE .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/tree.gif' style='style='vertical-align:middle;white-space:nowrap;''>	
	     									<a href='admin_produktliste.php?list.".$cat[$i]['id']."' title='".MLS_LAN_CAT_18."'>".$cat[$i]['name']."</a></td>";
	     			}
	     		else{
	     				$TREE="<a href='admin_produktliste.php?list.".$cat[$i]['id']."' title='".MLS_LAN_CAT_18."'><b>".$cat[$i]['name']."</b></a></td>";
	     				}	
	     		if(!($A=$i%2)){$tabform="forumheader";}else{$tabform="forumheader2";}
	     		//if($cat[$i]['parend']=='0'){$tabform="fcaption";}
	     		$text2 .="<tr>";	
				$text2 .="<td class='".$tabform."' width='50'>".$cat[$i]['id']."</td>";
				$IMG_PFAD=$status_pfad[$cat[$i]['enable']];
				$stat_wert=($cat[$i]['enable']=='1') ? 0:1;		
				$text2 .="<td class='".$tabform."' style='width:20px;text-align: left; padding: 4px; vertical-align: middle;'>
									<form method='post' action='".e_SELF."' id='setstat_".$cat[$i]['id']."'>
										<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$cat[$i][$primaryid]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
										<input type='hidden' name='ID' value='".$cat[$i]['id']."'>
										<input type='hidden' name='stat' value='".$stat_wert."'>
									</form></td>";					
					$text2 .="</td>";
					$text2 .="<td class='".$tabform."'><a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$cat[$i]['id']."' title='".MLS_LAN_CAT_18."'>";
					if(!$cat[$i]['image']){$text2 .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/default.jpg'";}
					else{$text2 .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."categorie_images/".$cat[$i]['image']."'";}
					$text2 .="height='20px'></a><br/></td>";
					$text2 .="<td class='".$tabform."' style='vertical-align:middle;white-space:nowrap;'>";
					$text2 .=$TREE;
					$text2 .="</td>";
					$text2 .="<td class='".$tabform."'>".$cat[$i]['steuer']."</td>";
					$text2 .="<td class='".$tabform."'><a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?list.".$cat[$i]['id']."' title='".MLS_LAN_CAT_18."'><div style='font-size: 12px; font-weight: bold; color: #f00;'>".$activ[$cat[$i]['enable']]." (".$cat[$i]['count'].") ".MLS_LAN_CAT_19."</a></div></td>";
					$text2 .="<td class='".$tabform."'><form method='post' action='".e_SELF."' id='editform'>
																							<input type='hidden' name='ID' value='".$cat[$i]['id']."'>
																							<input type='image' title='".LAN_DELETE."' name='delete[kat_{$cat[$i]['id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".MLS_LAN_CAT_21." [".$cat[$i]['name']."]')\"/> | 
																							<a href='".e_SELF."?edit.".$cat[$i]['id']."'>".$ImageEDIT['LINK']."</a> | 
																							<a href='admin_produktliste.php?list.".$cat[$i]['id']."' title='".MLS_LAN_CAT_18."'>".$ImageLIST['LINK']."</a>	|
																							<a href='admin_produktliste.php?new.".$cat[$i]['id']."' title='".MLS_LAN_CAT_24."'>".$ImageNEWPROD['LINK']."</a>
																						</form>	
																			</td>";
				$text2 .="</tr>";
				$ST_OUT=$ST+1;
				$text2 .=req($cat[$i]['id'], $ST_OUT);
				}
	return 	$text2;
   }
  else return "";
	}
?>