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

$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produkt_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produkt_lan.php");
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
    $pageid = "categorien";  // unique name that matches the one used in admin_menu.php.
	$show_preset = false; // allow e107 presets to be saved for use in the form.


// Field 1   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PRODUKT_1;//"Produkt Bezeichnung";
    $fieldname[] = "mls_products_name";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 2
    $fieldcapt[] = MLS_LAN_PRODUKT_32;//"Produkt Kategorie";
    $fieldname[] = "mls_products_category_id";
		$fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_category,mls_category_id,mls_category_name"; // [table name,value-field,display-field]
    
// Field 3
    $fieldcapt[] = MLS_LAN_PRODUKT_2;//"Produkt Hersteller";
    $fieldname[] = "mls_products_hersteller_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_hersteller,mls_hersteller_id,mls_hersteller_name"; // [table name,value-field,display-field]

// Field 4
    $fieldcapt[] = MLS_LAN_PRODUKT_3;//"Produkt Hersteller";
    $fieldname[] = "mls_products_parend_id";
    $fieldtype[] = "table";  // pulldown menu from a db table.
    $fieldvalu[] = "mls_products,mls_products_id,mls_products_name"; // [table name,value-field,display-field]




// Field 5   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PRODUKT_4;//"Produkt Preis <b>ohne Steuer";
    $fieldname[] = "mls_products_price";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "0.00";

// Field 6   - first field after the primary one.
    $fieldcapt[] = MLS_LAN_PRODUKT_5;//"Produkt Anzahl im Lager";
    $fieldname[] = "mls_products_lager";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "0";

// Field 7
    $fieldcapt[] = MLS_LAN_PRODUKT_7;//"Produkt Kurz- Beschreibung";
    $fieldname[] = "mls_products_text";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,100px";  // [default-text,width,height]

// Field 8
    $fieldcapt[] = MLS_LAN_PRODUKT_8;//"Produkt erweitete Beschreibung";
    $fieldname[] = "mls_products_text2";
    $fieldtype[] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[] = ",100%,200px";  // [default-text,width,height]

// Field 9
    $fieldcapt[] = MLS_LAN_PRODUKT_6;//"Produkt Aktiv ? ";
    $fieldname[] = "mls_products_enable";
    $fieldtype[] = "checkbox";     // simple checkbox.
    $fieldvalu[] = "1";           // [checkbox value]

// Field 10
    $fieldcapt[] = MLS_LAN_PRODUKT_9;//"*Produkt Farbe*";
    $fieldname[] = "mls_products_color";
    $fieldtype[] = "color";  // color selector
    $fieldvalu[] = "";       // [not required]

// Field 11
    $fieldcapt[] = MLS_LAN_PRODUKT_10;//"Produkt Bild";
    $fieldname[] = "mls_products_image";
    $fieldtype[] = "image";    // image selection.
    $fieldvalu[] = e_PLUGIN.PLUG_FOLDER."produkt_images/"; // [path to directory]


// Field 12   - first field after the primary one.
    $fieldcapt[] = "mls_products_pref";//"*mls_products_pref*";
    $fieldname[] = "mls_products_pref";
    $fieldtype[] = "text";  // simple text box.
    $fieldvalu[] = "";

// Field 14
    $fieldcapt[] = MLS_LAN_PRODUKT_11;//"Produkt aufgenohme am: <br/><i>bei neuerstellung wird automatisch aktuelle Datum erfasst.</i>";
    $fieldname[] = "mls_products_date";
    $fieldtype[] = "datestamp"; // unix datestamp format.
    $fieldvalu[] = "1900,2020"; // [start-year,end-year] (optional)

///++++++++++++++++++++++++++++++++++++++++++++++++++++++++

require_once(e_ADMIN."auth.php");
require_once("../handler/form_handler.php");
$rs = new my_form;

$text = "<div style='width:100%;text-align:center'>";

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

if(isset($_POST['set_anzahl']))
{
$sql -> db_Select($tablename, "*", "$primaryid='".$_POST['ID']."' LIMIT 1");
while($row = $sql-> db_Fetch())
		{
		$Anzahl_old=$row['mls_products_lager'];
		}	
	$inputstr="mls_products_lager='".($Anzahl_old+$_POST['wert'])."'";
	$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ");
}
//////////////////////////////////////////////////////
$activ[0]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";
$activ[1]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";
$schwele=MLS_LAGER_SCHWELLE;
$table_total = $sql -> db_Select("mls_products", "*", "mls_products_lager <='".$schwele."'");			
if($table_total)
  {
$sql -> db_Select("mls_steuer", "*", "mls_steuer_wert !=''ORDER BY mls_steuer_id");
while($row = $sql-> db_Fetch())
		{
		$i=$row['mls_steuer_id'];
		$steuer[$i]['wert']=$row['mls_steuer_wert'];		
		}
$counter=0;
     $sql -> db_Select("mls_products", "*", "mls_products_lager <='".$schwele."' ORDER BY mls_products_name");
         while($row = $sql-> db_Fetch())
         			{
							$product[$counter]['id']=$row['mls_products_id'];
							$product[$counter]['name']=$row['mls_products_name'];
							$product[$counter]['steuer']=$row['mls_products_steuer_id'];
							$product[$counter]['category_id']=$row['mls_products_category_id'];
							$product[$counter]['hersteller_id']=$row['mls_products_hersteller_id'];
							$product[$counter]['price']=round(($row['mls_products_price']+($row['mls_products_price']/100)*$steuer[$product[$counter]['steuer']]['wert']),2);
							if($row['mls_products_lager']<=$schwele)
							{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";}
							else{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";}
							$product[$counter]['lager']=$row['mls_products_lager'];
							$product[$counter]['text']=$row['mls_products_text'];
							$product[$counter]['enable']=$row['mls_products_enable'];
							$product[$counter]['image']=$row['mls_products_image'];
							$product[$counter]['pref']=$row['mls_products_pref'];
							$product[$counter]['date']=$row['mls_products_date'];
							$counter++;
							}
	     for($i=0; $i< $counter;$i++ )
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
   							<td class='forumheader'width='70px'>".MLS_LAN_PRODUKT_13."</td>
   							<td class='forumheader'width='70px'>".MLS_LAN_PRODUKT_14."</td>
   							<td class='forumheader'width='70px'>".MLS_LAN_PRODUKT_15."</td>
								<td class='forumheader'>".MLS_LAN_PRODUKT_16."</td>
								<td class='forumheader'>".MLS_LAN_PRODUKT_17."</td>
								<td class='forumheader'width='150px'>".MLS_LAN_PRODUKT_18."</td>
								<td class='forumheader'>".MLS_LAN_PRODUKT_19."</td>
								<td class='forumheader'>".MLS_LAN_PRODUKT_20."</td>
   							</tr>";
$status_pfad[0]=e_PLUGIN.PLUG_FOLDER."images/off.png";
$status_pfad[1]=e_PLUGIN.PLUG_FOLDER."images/on.png";
			for($i=0; $i< $counter;$i++ )
	     		{
	     		$IMG_PFAD=$status_pfad[$product[$i]['enable']];
					$stat_wert=($product[$i]['enable']=='1') ? 0:1;	
	     		if(!($A=$i%2)){$tabform="fcaption";}else{$tabform="forumheader2";}
	     		$PRISE = to_prise($product[$i]['price']);
	     		$text .="<tr>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['id']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>
									<form method='post' action='".e_SELF."' id='setstat_".$product[$i]['id']."'>
										<input type='image' title='".LAN_STATEDIT."' name='setstat[kat_{$row[$primaryid]}]' style='vertical-align: middle' src='".$IMG_PFAD."'>
										<input type='hidden' name='ID' value='".$product[$i]['id']."'>
										<input type='hidden' name='stat' value='".$stat_wert."'>
									</form></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>";
					if($product[$i]['image']==''){$text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/default.jpg' ";}
					else{$text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."produkt_images/".$product[$i]['image']."'";}
					$text .="width='30px' height='30px'></a><br/></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['hersteller']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'><b>".$product[$i]['name']."</b></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'><div style='font-size: 12px; font-weight: bold; color: #f00;'>".$PRISE." ".MLS_LAN_PRODUKT_21."</div></td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>".$product[$i]['lager_amper']." ".$product[$i]['lager']."</td>";
					$text .="<td class='".$tabform."' style='text-align: left; padding: 4px; vertical-align: middle;'>
								<form method='post' action='".e_SELF."' id='editform'>
									<input type='hidden' name='ID' value='".$product[$i]['id']."'>
									<input type='tbox' style='width:20px' name='wert' value=''>
									<input class='button' type='submit' id='set_anzahl' name='set_anzahl' value='setzen' />
								</form>
							</td>
						</tr>";
				}
      $text .= "</table>";

}else{$text .= "<br/><br/>Es sind keine Produkte gefunden wurden, die die \"Mindenst-Bestand\" überschreiten, also soll es alles in Ordnung sein!";
			}	
   
   $text .= "<br/><br/><form method='post' action='admin_home.php' id='back_to_list'>
					<input class='button' type='submit' id='back_to_list' name='back_to_list' value='".MLS_LAN_PRODUKT_31."' />
					</form>
				</div>";
   $configtitle = "<b> ".MLS_LAN_LAGERBESTAND."</b> ";

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
?>


