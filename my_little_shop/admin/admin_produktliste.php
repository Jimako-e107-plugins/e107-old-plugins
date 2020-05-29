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
	 			$text .="<input type='hidden' name='old_".$fieldname[$i]."' value='".$row[$fieldname[$i]]."'><img border='0' src='".e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$row[$fieldname[$i]]."' style='vertical-align:middle;white-space:nowrap;width:70px;'>            ";	
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
		</form></td></tr></table>";
		
$text .=$_get['zub'];	
$text .=get_zubehoer_tables($id);		
$text .="</div>";		
	$configtitle="<b>Bearbeiten ".$row['team_name']."</b>";	
	}
//
//
//
/////////////////////////////////////////////////////////////////
/*

if (strstr(e_QUERY, 'clear'))
{
	$tmp = explode('.', e_QUERY);
	$class_id = $tmp[1];
	check_allowed($class_id);
	if ($sql->db_Select('user', 'user_id, user_class', "user_class = '{$class_id}' OR user_class REGEXP('^{$class_id},') OR user_class REGEXP(',{$class_id},') OR user_class REGEXP(',{$class_id}$')"))
	{
		while ($row = $sql->db_Fetch())
		{
			$uidList[$row['user_id']] = $row['user_class'];
		}
		$uclass->class_remove($class_id, $uidList);
		$message = UCSLAN_1;
	}
}
elseif(e_QUERY)
{
	$tmp2 = explode('-', e_QUERY);
	$class_id = $tmp2[0];
	check_allowed($class_id);
	$message = UCSLAN_2;

	if ($sql->db_Select('user', 'user_id, user_class', "user_class = '{$class_id}' OR user_class REGEXP('^{$class_id},') OR user_class REGEXP(',{$class_id},') OR user_class REGEXP(',{$class_id}$')"))
	{
		while ($row = $sql->db_Fetch())
		{
			$uidList[$row['user_id']] = $row['user_class'];
		}
		$uclass->class_remove($class_id, $uidList);
	}
	unset($uidList);
	if ($sql->db_Select('user', 'user_id, user_class', "user_id IN({$tmp2[1]})"))
	{
		while ($row = $sql->db_Fetch())
		{
			$uidList[$row['user_id']] = $row['user_class'];
		}
		$uclass->class_add($class_id, $uidList);
	}
}





*/

























































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
				}
				elseif($fieldtype[$i]=="image")
				{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST["old_".$fieldname[$i]])."'";	
				}
				else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}
			$inputstr .= ($i < ($count -1)) ? "," : "";
			};
		}
	$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ");
	
$mesage .=$inputstr;
	
/////////////////////////////////////////////////////
	}	

$table_total = $sql -> db_Select("mls_products", "*", "mls_products_category_id ='".$id."'");			

if($table_total)
  {
$sql -> db_Select("mls_steuer", "*", "mls_steuer_wert !=''ORDER BY mls_steuer_id");
while($row = $sql-> db_Fetch())
		{
		$i=$row['mls_steuer_id'];
		$steuer[$i]['wert']=$row['mls_steuer_wert'];		
		}

$activ[0]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";
$activ[1]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";
$schwele=MLS_LAGER_SCHWELLE;

$counter=0;
     $sql -> db_Select("mls_products", "*", "mls_products_category_id ='".$id."' ORDER BY mls_products_name");
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
									<form method='post' action='".e_SELF."?list.".$id."' id='setstat_".$product[$i]['id']."'>
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
					<form method='post' action='".e_SELF."?list.".$id."' id='editform'>
																							<input type='hidden' name='ID' value='".$product[$i]['id']."'>
																							<input type='image' title='".LAN_DELETE."' name='delete[kat_{$product[$i]['id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".MLS_LAN_PRODUKT_23." [".$product[$i]['name']."]')\"/> |
									<a href='admin_produktliste.php?edit.".$product[$i]['id']."' title='".MLS_LAN_PRODUKT_24."'>".ADMIN_EDIT_ICON."</a>
									</td>
					</form>";
				}
      $text .= "</table></div>";

}else{$text .= "<br/><br/>".MLS_LAN_PRODUKT_27."  <b>".$kategorie."</b> ".MLS_LAN_PRODUKT_28.".";
			}	
   
   $text .= "<br/><br/><form method='post' action='admin_categorie.php' id='back_to_list'>
					<input class='button' type='submit' id='back_to_list' name='back_to_list' value='".MLS_LAN_PRODUKT_31."' />
					</form>
				</div>";
   $configtitle = "<b><a href='admin_categorie.php'>".MLS_LAN_PRODUKT_29."<a></b> ".MLS_LAN_PRODUKT_30." <b>".$kategorie."</b>";
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
function get_zubehoer_tables($prod_id)
{
global $sql;

$qry_rows ="
 SELECT a.*, p.*, b.*, c.* FROM #mls_zubehoer AS a
 LEFT JOIN #mls_products AS p on p.mls_products_id=a.mls_zubehoer_par_id 
 LEFT JOIN #mls_category AS b on b.mls_category_id=p.mls_products_id
 LEFT JOIN #mls_hersteller AS c on c.mls_hersteller_id=p.mls_products_hersteller_id
 a.mls_zubehoer_main_id='".$prod_id."' ORDER BY mls_zubehoer_id
 ";
$sql->db_Select_gen($qry_rows);
$vorh_zubehoer_count=0;
while ($row = $sql->db_Fetch())
	{
	$vorh_zubehoer[$vorh_zubehoer_count]=$row;$vorh_zubehoer_count++;
	}
///+++++++++++++++++++++++++++++++++++++
/*
$qry_rows ="
 SELECT a.*, b.*, c.* FROM #mls_products AS a
 LEFT JOIN #mls_category AS b on b.mls_category_id=a.mls_products_category_id
 LEFT JOIN #mls_hersteller AS c on c.mls_hersteller_id=a.mls_products_hersteller_id
 WHERE a.mls_products_name !='' AND a.mls_products_enable='1' AND b.mls_category_enable='1'
 ORDER BY b.mls_category_name, b.mls_hersteller_name, a.mls_products_name 
 ";
*/ 
$qry_rows ="
 SELECT a.*, b.* FROM #mls_products AS a
 LEFT JOIN #mls_category AS b on b.mls_category_id=a.mls_products_category_id
 WHERE a.mls_products_name !='' AND a.mls_products_enable='1' AND b.mls_category_enable='1'
 ORDER BY b.mls_category_name, a.mls_products_name 
 "; 
 
$sql->db_Select_gen($qry_rows);
	$c = 0;
	$d = 0;
$zubehoer_count=0;
	while ($row = $sql->db_Fetch())
	{
	$zubehoer[$zubehoer_count]=$row;$zubehoer_count++;	
	}
///+++++++++++++++++++++++++++++++++++++
for($i=0; $i< $zubehoer_count; $i++)
	{
		if(($vorh_zubehoer_index = check_table($zubehoer[$i],$vorh_zubehoer)))
		{		
			$in_zubehoer[$c] = $vorh_zubehoer[$vorh_zubehoer_index];
			$c++;
		}
		else
		{
			$out_zubehoer[$d] = $zubehoer[$i];
			$d++;
		}
	}
	$AUSGABE = "<br /><table class='fborder' style='width:95%'>
		<tr>
		<td class='fcaption' style='text-align:center;width:30%'>Passender Zubehör zu ".$prod_id."</td></tr>
		<tr>
		<td class='forumheader3' style='width:100%;text-align:center'>
		<table style='width:90%'>
		<tr>
		<td style='width:45%; vertical-align:top'>
		".PRODUKTE_Z_AUSWAHL."".$zubehoer_count."<br />
		<select class='tbox' id='assignclass1' name='assignclass1' size='50' style='width:400px' multiple='multiple' onchange='moveOver();'>";

for ($a = 0; $a <= ($d-1); $a++)
	{
	$AUSGABE .= "<option value=".$out_zubehoer[$a]['mls_products_id'].">(".$out_zubehoer[$a]['mls_category_name']." / ".$out_zubehoer[$a]['mls_hersteller_name'].") ".$out_zubehoer[$a]['mls_products_name']."</option>";
	}
$AUSGABE .= "</select>
		</td>
		<td style='width:45%; vertical-align:top'>
		".VORHAND_ZUBEH."".$vorh_zubehoer_index."<br />
		<select class='tbox' id='assignclass2' name='assignclass2' size='47' style='width:400px' multiple='multiple'>";
for($a = 0; $a <= ($c-1); $a++)
	{
		$AUSGABE .= "<option value=".$in_zubehoer[$a]['mls_zubehoer_id'].">".$in_zubehoer[$a]['mls_zubehoer_main_id']." ".$in_zubehoer[$a]['mls_zubehoer_par_id']."</option>";
	}
$AUSGABE .= "</select><br /><br />
		<input class='button' type='button' value='".ENTFERNEN."' onclick='removeMe();' />
		<input class='button' type='button' value='".ALLE_ENTFERNEN."' onclick='clearMe($prod_id);' />
		<input type='hidden' name='class_id' value='$userclass_id' />

		</td></tr></table>
		</td></tr>
		<tr><td colspan='2' style='text-align:center' class='forumheader'>
		<input class='button' type='button' value='".SPEICHERN."' onclick='saveMe($prod_id);' />
		</td>
		</tr>
		</table>";
return $AUSGABE;
}		
////////////////////////////////////////////////////////////////////		
function headerjs()
{

	$script_js = "<script type=\"text/javascript\">
		//<![CDATA[
		// Adapted from original:  Kathi O'Shea (Kathi.O'Shea@internet.com)
		function moveOver() {
		var boxLength = document.getElementById('assignclass2').length;
		var selectedItem = document.getElementById('assignclass1').selectedIndex;
		var selectedText = document.getElementById('assignclass1').options[selectedItem].text;
		var selectedValue = document.getElementById('assignclass1').options[selectedItem].value;
		var i;
		var isNew = true;
		if (boxLength != 0) {
		for (i = 0; i < boxLength; i++) {
		thisitem = document.getElementById('assignclass2').options[i].text;
		if (thisitem == selectedText) {
		isNew = false;
		break;
		}
		}
		}
		if (isNew) {
		newoption = new Option(selectedText, selectedValue, false, false);
		document.getElementById('assignclass2').options[boxLength] = newoption;
		document.getElementById('assignclass1').options[selectedItem].text = '';
		}
		document.getElementById('assignclass1').selectedIndex=-1;
		}


		function removeMe() {
		var boxLength = document.getElementById('assignclass2').length;
		var boxLength2 = document.getElementById('assignclass1').length;
		arrSelected = new Array();
		var count = 0;
		for (i = 0; i < boxLength; i++) {
		if (document.getElementById('assignclass2').options[i].selected) {
		arrSelected[count] = document.getElementById('assignclass2').options[i].value;
		var valname = document.getElementById('assignclass2').options[i].text;
		for (j = 0; j < boxLength2; j++) {
		if (document.getElementById('assignclass1').options[j].value == arrSelected[count]){
		document.getElementById('assignclass1').options[j].text = valname;
		}
		}

		// document.getElementById('assignclass1').options[i].text = valname;
		}
		count++;
		}
		var x;
		for (i = 0; i < boxLength; i++) {
		for (x = 0; x < arrSelected.length; x++) {
		if (document.getElementById('assignclass2').options[i].value == arrSelected[x]) {
		document.getElementById('assignclass2').options[i] = null;
		}
		}
		boxLength = document.getElementById('assignclass2').length;
		}
		}

		function clearMe(clid) {
		location.href = document.location + \"?clear.\" + clid;
		}

		function saveMe(clid) {
		var strValues = \"\";
		var boxLength = document.getElementById('assignclass2').length;
		var count = 0;
		if (boxLength != 0) {
		for (i = 0; i < boxLength; i++) {
		if (count == 0) {
		strValues = document.getElementById('assignclass2').options[i].value;
		} else {
		strValues = strValues + \",\" + document.getElementById('assignclass2').options[i].value;
		}
		count++;
		}
		}
		if (strValues.length == 0) {
		//alert(\"You have not made any selections\");
		}
		else {
		location.href = document.location + \"&zub=\" + clid + \"-\" + strValues;
		}
		}
		//]]>
		</script>\n";
	return $script_js;
}
/////////////////////////////////////////
function check_table($zubehoer,$vorh_zubehoer)
{
$ind=count($vorh_zubehoer);
for($i=0; $i < $ind; $i++)
	{
	if($vorh_zubehoer[$i]['mls_zubehoer_par_id']==$zubehoer['mls_products_id'])
		{
		return 	$vorh_zubehoer[$i]['mls_zubehoer_id'];
		}
	}
return false;
}
/////////////////////////////////////////
?>


