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
|		$Source: ../e107_plugins/my_little_shop/admin/admin_produkt_no_cat.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once("../handler/constanten.php");

$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produkt_no_cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produkt_no_cat_lan.php");
// ------------------------------

$ImageDELETE['PFAD']=e_PLUGIN.PLUG_FOLDER."images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_PRODUKT_22."' src='".$ImageDELETE['PFAD']."'>";

$ImageNEW['PFAD']=e_PLUGIN.PLUG_FOLDER."images/OK.png";
$ImageNEW['LINK']="<img border='0' style='vertical-align: middle' title='".MLS_LAN_PRODUKT_26."' src='".$ImageNEW['PFAD']."'>";


if (e_QUERY) {
	list($action, $id) = explode(".", e_QUERY);
	$id = intval($id);
	unset($tmp);
}

//////++++++++++++++++++++++++++++++++++++
    $tablename = "mls_products";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_products_id";   // first column of your table.
    $e_wysiwyg = "mls_products_text,mls_products_text2"; // commas seperated list of textareas to use wysiwyg with.
    $pageid = "ohne_kat";  // unique name that matches the one used in admin_menu.php.
	$show_preset = false; // allow e107 presets to be saved for use in the form.
	
// Field 1   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_1;//"Produkt Bezeichnung";
    $fieldname[] = "mls_products_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 2
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_32;//"Produkt Kategorie";
    $fieldname[] = "mls_products_category_id";
		$fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_category,mls_category_id,mls_category_name"; // [table name,value-field,display-field]
    
// Field 3
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_2;//"Produkt Hersteller";
    $fieldname[] = "mls_products_hersteller_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_hersteller,mls_hersteller_id,mls_hersteller_name"; // [table name,value-field,display-field]

// Field 4
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_3;//"Produkt Hersteller";
    $fieldname[] = "mls_products_parend_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_products,mls_products_id,mls_products_name"; // [table name,value-field,display-field]




// Field 4   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_4;//"Produkt Preis <b>ohne Steuer";
    $fieldname[] = "mls_products_price";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "0.00";

// Field 4   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_5;//"Produkt Anzahl im Lager";
    $fieldname[] = "mls_products_lager";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "0";

// Field 5
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_7;//"Produkt Kurz- Beschreibung";
    $fieldname[] = "mls_products_text";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,100px";  // [default-text,width,height]

// Field 5
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_8;//"Produkt erweitete Beschreibung";
    $fieldname[] = "mls_products_text2";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,200px";  // [default-text,width,height]

// Field 6
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_6;//"Produkt Aktiv ? ";
    $fieldname[] = "mls_products_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";           // [checkbox value]

// Field 7
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_9;//"*Produkt Farbe*";
    $fieldname[] = "mls_products_color";
    $fieldtype[] = "color";  // color selector
    $fieldvalu[] = "";       // [not required]

// Field 8
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_10;//"Produkt Bild";
    $fieldname[] = "mls_products_image";
    $fieldtype[] = "image";    // image selection.
    $fieldvalu[] = e_PLUGIN."my_little_shop/produkte/".$catpfad."/"; // [path to directory]


// Field 9   - first field after the primary one.
    $fieldcapt[] = "mls_products_pref";//"*mls_products_pref*";
    $fieldname[] = "mls_products_pref";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 9
    $fieldcapt[] = MLS_LAN_PROD_NO_KAT_11;//"Produkt aufgenohme am: <br/><i>bei neuerstellung wird automatisch aktuelle Datum erfasst.</i>";
    $fieldname[] = "mls_products_date";
    $fieldtype[] = "datestamp"; // unix datestamp format.
    $fieldvalu[] = "1900,2020"; // [start-year,end-year] (optional)

///++++++++++++++++++++++++++++++++++++++++++++++++++++++++

require_once(e_ADMIN."auth.php");
require_once("../handler/form_handler.php");
$rs = new my_form;

$text = "<div style='width:100%;text-align:center'><form method='post' action='".e_SELF."' id='neu'> <div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?new.".$id."'>".$ImageNEW['LINK']."  ".MLS_LAN_PRODUKT_26."</div></a>
 </form>";


if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;		
	$message .=" Artikel-Nr: ".$del_id."";
}
/////////////////////////////////////////////////////
if(isset($_POST['setstat']))
{
	$inputstr="mls_products_enable='".$_POST['stat']."'";
	$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ");
}
//////////////////////////////////////////////////////
$sql -> db_Select("mls_category", "*", "mls_category_id ='".$id."' ORDER BY mls_category_id");
        while($row = $sql-> db_Fetch())
        	{
					$kategorie=$row['mls_category_name'];
					$kategorie_img=$row['mls_category_image'];
					$cat_pfad=$row['mls_category_dir'];
					}

if ($action == "edit")
	{
	$fieldtype[1] = "dropdown2";
  $fieldvalu[1]	=categorien_liste(0, 0);
	$sql -> db_Select($tablename, "*", " $primaryid='".$id."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style='text-align:center'>\n !! ".$id." ". $fieldvalu[10]."";
	$text .= "<form enctype=\"multipart/form-data\" method=\"post\" action=\"".e_SELF."?list.".$row['mls_products_category_id']."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{	
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td class='forumheader3' style='width:30%; vertical-align:top'>".$fieldcapt[$i].":</td>
		<td class='forumheader3' style='width:70%'>";
	 	if($fieldtype[$i] == "image"){
	 		if($row[$fieldname[$i]]!="")
	 			{
	 			$text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$row[$fieldname[$i]]."' style='vertical-align:middle;white-space:nowrap;width:70px;'>            ";	
	 			}
	 		$text .= "<input type='file' name='datei'>";
	 		}
	 	else{$text .= $rs-> user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);}
		$text .="</td></tr>";
		};
		$text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form>
		<form method='post' action='".e_SELF."' id='back'>
			<input class='button' type='submit' id='back' name='back' value='".MLS_LAN_PRODUKT_31."' />
		</form></td></tr></table></div>";		
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";	
	}

elseif($action == 'new')
	{
	$text = "<div style=\"text-align:center\">\n";
	$text .= "<form enctype=\"multipart/form-data\" method=\"post\" action=\"".e_SELF."?list.".$id."\" id=\"adminform\">
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
	for ($i=0; $i<count($fieldcapt); $i++)
		{
		if($fieldname[$i]=='mls_products_category_id')
			{
			$text .="<input type='hidden' name='".$fieldname[$i]."' value='".$id."'>";
			}
		elseif($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			continue;
			}
		else{	
				$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
				$text .="
				<tr>
					<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
					<td style=\"width:70%\" class=\"forumheader3\">";
	 			if($fieldtype[$i] == "image"){
					$text .= "<input type='file' name='datei'>";
					}
				else{
					$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
					}
				$text .="</td></tr>";
			}
		};
		$text .= "<tr>
		<td colspan=\"2\" class=\"forumheader\" style=\"text-align:center\"> 
					<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_CREATE."' />
				</form>
				<form method='post' action='".e_SELF."?list.".$id."' id='back'>
					<input class='button' type='submit' id='back' name='back' value='".MLS_LAN_PRODUKT_12."' />
				</form>
				<form method='post' action='admin_categorie.php' id='back_cat'>
					<input class='button' type='submit' id='back_cat' name='back_cat' value='".MLS_LAN_PRODUKT_25."' />
				</form>
		</td></tr></table></div>";
		$configtitle="<b>".MLS_LAN_PRODUKT_26."</b>";
	}
else{
	if(isset($_POST['submitit']))
		{
	$inputstr="";
	if($_FILES['datei']['tmp_name']!="")
		{echo "bin drin (";
		 echo $_FILES['datei']['tmp_name'];
		 echo ")-";
		 echo e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER;
 		$MY_IMAGE= image_upload($_FILES['datei']['tmp_name'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER);
			$count = count($fieldname);
			for ($i=0; $i<$count; $i++) {
			if($fieldname[$i]=="mls_products_image")
				{
				$inputstr .= " '".$tp->toDB($MY_IMAGE['wert'])."'";	
				}
			elseif ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
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
			}
 		}
 	else{echo "bin  nicht drinn";
			$count = count($fieldname);
			for ($i=0; $i<$count; $i++) {
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
			}
		}
$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;			
$message.=$inputstr;
	}
///////////////////////////////		
	if(IsSet($_POST['update']))
		{
	$inputstr="";
	if($_FILES['datei']['tmp_name']!="")
		{echo "bin drin (";
		 echo $_FILES['datei']['tmp_name'];
		 echo ")-";
		 echo e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER;
 		$MY_IMAGE= image_upload($_FILES['datei']['tmp_name'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER);
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) {
			if($fieldname[$i]=="mls_products_image")
				{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($MY_IMAGE['wert'])."'";	
				}
			elseif($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp"){
			$year = $fieldname[$i]."_year";
			$month = $fieldname[$i]."_month";
			$day = $fieldname[$i]."_day";
       		if($fieldtype[$i]=="date"){
               $inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
           	}else{
           	$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
						}
				}else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		}else{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) {
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
			};
		}
	$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ");
	
$mesage .=$inputstr;
	
/////////////////////////////////////////////////////
	}
$ANZAHL_PROD_OHNE_KAT=0;
$sql -> db_Select("mls_products", "*", "mls_products_id !=''");
while($row = $sql-> db_Fetch())
		{
		$POK=zaehler("mls_category",  "mls_category_id ='".$row['mls_products_category_id']."'");
		if($POK == 0)
			{
			$product[$ANZAHL_PROD_OHNE_KAT]['ohne_kat']=$row['mls_products_id'];
			$ANZAHL_PROD_OHNE_KAT++;
			}
		}		

if($ANZAHL_PROD_OHNE_KAT > 0)
  {
$sql -> db_Select("mls_steuer", "*", "mls_steuer_wert !=''ORDER BY mls_steuer_id");
while($row = $sql-> db_Fetch())
		{
		$i=$row['mls_steuer_id'];
		$steuer[$i]['wert']=$row['mls_steuer_wert'];		
		}
$status_pfad[0]=e_PLUGIN.PLUG_FOLDER."images/off.png";
$status_pfad[1]=e_PLUGIN.PLUG_FOLDER."images/on.png";$schwele=$pref['mls_lager'];
for($i=0; $i< $ANZAHL_PROD_OHNE_KAT;$i++ )
	     		{
     $sql -> db_Select("mls_products", "*", "mls_products_id ='".$product[$i]['ohne_kat']."' ORDER BY mls_products_id");
         while($row = $sql-> db_Fetch())
         			{
							$product[$i]['id']=$row['mls_products_id'];
							$product[$i]['name']=$row['mls_products_name'];
							$product[$i]['steuer']=$row['mls_products_steuer_id'];
							$product[$i]['category_id']=$row['mls_products_category_id'];
							$product[$i]['hersteller_id']=$row['mls_products_hersteller_id'];
							$product[$i]['price']=round(($row['mls_products_price']+($row['mls_products_price']/100)*$steuer[$product[$i]['steuer']]['wert']),2);
							if($row['mls_products_lager']<=$schwele)
							{$product[$i]['lager_amper']="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_rot.gif'>";}
							else{$product[$i]['lager_amper']="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_gruen.gif'>";}
							$product[$i]['lager']=$row['mls_products_lager'];
							$product[$i]['text']=$row['mls_products_text'];
							$product[$i]['enable']=$row['mls_products_enable'];
							$product[$i]['image']=$row['mls_products_image'];
							$product[$i]['pref']=$row['mls_products_pref'];
							$product[$i]['date']=$row['mls_products_date'];
							}
				  }
	     for($i=0; $i< $ANZAHL_PROD_OHNE_KAT;$i++ )
	     		{
	     			$sql -> db_Select("mls_hersteller", "*", "mls_hersteller_id ='".$product[$i]['hersteller_id']."' ORDER BY mls_hersteller_id");
         		while($row = $sql-> db_Fetch()){
         					$product[$i]['hersteller']=$row['mls_hersteller_name'];
									$product[$i]['url']=$row['mls_hersteller_url'];
									$product[$i]['hersteller_text']=$row['mls_hersteller_text'];
									$product[$i]['hersteller_enable']=$row['mls_hersteller_enable'];
									$product[$i]['hersteller_color']=$row['mls_hersteller_color'];
									$product[$i]['hersteller_dir']=$row['mls_hersteller_dir'];
									$product[$i]['hersteller_image']=$row['mls_hersteller_image'];
         					}      	
        	}

   $text .= "<div style='width:100%'><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='forumheader'width='70px'>".MLS_LAN_PROD_NO_KAT_13."</td>
   							<td class='forumheader'width='70px'>".MLS_LAN_PROD_NO_KAT_14."</td>
   							<td class='forumheader'width='70px'>".MLS_LAN_PROD_NO_KAT_15."</td>
								<td class='forumheader'>".MLS_LAN_PROD_NO_KAT_16."</td>
								<td class='forumheader'>".MLS_LAN_PROD_NO_KAT_17."</td>
								<td class='forumheader'width='150px'>".MLS_LAN_PROD_NO_KAT_18."</td>
								<td class='forumheader'>".MLS_LAN_PROD_NO_KAT_19."</td>
								<td class='forumheader'>".MLS_LAN_PROD_NO_KAT_20."</td>
   							</tr>";
			for($i=0; $i< $ANZAHL_PROD_OHNE_KAT;$i++ )
	     		{
				$IMG_PFAD=$status_pfad[$product[$i]['enable']];
				$stat_wert=($product[$i]['enable']=='1') ? 0:1;	
	     		if(!($A=$i%2)){$tabform="fcaption";}else{$tabform="forumheader2";}
	     		$PRISE = to_prise($product[$i]['price']);
	     		$text .="<tr>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['id']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>
					<form method='post' action='".e_SELF."?list.".$id."' id='setstat_".$product[$i]['id']."'>
										<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$row[$primaryid]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
										<input type='hidden' name='ID' value='".$product[$i]['id']."'>
										<input type='hidden' name='stat' value='".$stat_wert."'>
									</form>					
					</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>";
					if($product[$i]['image']==''||$cat_pfad==''){$text .="<img border='0' src='".e_PLUGIN."my_little_shop/images/default.jpg' ";}
					else{$text .="<img border='0' src='".e_PLUGIN."mylittleshop/produkte/".$cat_pfad."/".$product[$i]['image']."'";}
					$text .="width='30px' height='30px'></a><br/></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['hersteller']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'><b>".$product[$i]['name']."</b></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'><div style='font-size: 12px; font-weight: bold; color: #f00;'>".$PRISE." ".MLS_LAN_PROD_NO_KAT_21."</div></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['lager_amper']." ".$product[$i]['lager']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>
					<form method='post' action='".e_SELF."?list.".$id."' id='editform'>
																							<input type='hidden' name='ID' value='".$product[$i]['id']."'>
																							<input type='image' title='".LAN_DELETE."' name='delete[kat_{$product[$i]['id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".MLS_LAN_PROD_NO_KAT_23." [".$product[$i]['name']."]')\"/> |
									<a href='admin_produkt_no_cat.php?edit.".$product[$i]['id']."' title='".MLS_LAN_PROD_NO_KAT_24."'>".ADMIN_EDIT_ICON."</a>
									</td>
					</form>";
				}
      $text .= "</table></div>";

}else{$text .= "<br/><br/>".MLS_LAN_PROD_NO_KAT_27.".";
			}	
   
   $text .= "</div>";
   $configtitle = "<b>".MLS_LAN_PROD_NO_KAT_0."</b>";
 }
$text .= "<br/><br/>";			
$text.=powered_by_shop(); 
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
///
///
///
//////////////////////////////////////////////
function categorien_liste($par_id, $stuffe)
{
global $sql;
$liste="";
$sql -> db_Select("mls_category", "*", "mls_parend_category_id='".$par_id."' ORDER BY mls_category_name");


$con=0;
while($row = $sql-> db_Fetch()){
	$CATEGORIE[$con]['id']= $row['mls_category_id'];
	$CATEGORIE[$con]['name']= $row['mls_category_name'];
	$CATEGORIE[$con]['parend']= $row['mls_parend_category_id'];	
	$con++;
}

for($j = 0 ; $j < $con ; $j++ )
	{$liste_name="";
	for($i = 0 ;$i < $stuffe; $i++)
		{
		$liste_name .="&nbsp;&nbsp;&nbsp;&nbsp;";	
		}
$liste_name .=$CATEGORIE[$j]['name'];
$liste.="".$CATEGORIE[$j]['id'].":".$liste_name.", ";

	$liste .= categorien_liste($CATEGORIE[$j]['id'], ($stuffe+1));
	}
return $liste;
 }
//////////////////////////////////////
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


