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
|		$Source: ../e107_plugins/my_little_shop/sites/kategorien.php $
|		$Revision: 1.00 $
|		$Date: 2008/07/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
require_once("../templates/categorie_table.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/produktlist_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/produktlist_lan.php");

// ============= START OF THE BODY ====================================

		$text ="<div style='width:100%;padding:10px;'>";
		$text .=  $tp->toHTML($pref['my_little_shop_begruesung'], TRUE);
		$text .="</div>";
		$spalten=$pref['my_little_shop_kat_row'];
   	$A=0;
   	$count=0;
   $breite=(100 / $spalten)-1;

$LIST_TYP = "2";
$LIST_PRO_SEITE = "10";
   
if(e_QUERY)
	{
	list($cat_ID, $typ, $sort) = explode(".", e_QUERY);
	$cat_ID = intval($cat_ID);
	$typ = intval($typ);
	$sort = intval($sort);
	unset($tmp);
	}
	
  
     $sql -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='".$cat_ID."' ORDER BY mls_category_name");
         while($row = $sql-> db_Fetch()){
		  				if(!$row['mls_category_enable']){continue;}
   						$kat[$count]['ID']=$row['mls_category_id'];
   						$kat[$count]['Name']=$row['mls_category_name'];
   						$kat[$count]['Image']=$row['mls_category_image'];
   						$kat[$count]['parend']=$row['mls_parend_category_id'];
   						$count++;
  						}
for($i=0; $i< $count; $i++)
					{
					$kat[$i]['count']= zaehler("mls_products",  "mls_products_category_id ='".$kat[$i]['ID']."' AND mls_products_enable='1'");
					$kat[$i]['sub_cat']=zaehler("mls_category", "mls_category_name !='' AND mls_parend_category_id='".$kat[$i]['ID']."' ORDER BY mls_category_name");
					if($kat[$i]['count']!=0){$weiter[$i]="<a href='produktlist.php?".$kat[$i]['ID'].".".$LIST_TYP.".".$LIST_PRO_SEITE."&cat_ID=1' title='".MLS_PRODUKTLIST_LAN_30."'>";}
					else if($kat[$i]['sub_cat']!=0){$weiter[$i]="<a href='".e_SELF."?".$kat[$i]['ID']."' title='".MLS_PRODUKTLIST_LAN_2."'>";}
					else {$weiter[$i]="<a href='produktlist.php?".$kat[$i]['ID'].".".$LIST_TYP.".".$LIST_PRO_SEITE."&cat_ID=1' title='".MLS_PRODUKTLIST_LAN_30."'>";}
					}   


$title = caption_pfad("mls_category", "mls_category_name !='' AND mls_category_id='".$cat_ID."'", $cat_ID ); 

					
$text .= "<div style='width:100%'><table style='width:100%;backgroung: transparent;border:0px;' cellspacing='0' cellpadding='0'>";
for($i=0; $i< $count; $i++){		  
		  			if($A==$spalten){$text .="</tr>";$A=0;$text .="<tr>";}
						$A++;

		        $text .="<td style='text-align: center; padding: 2px; vertical-align: top; width: ".$breite."%;'>";
						$text .="".PRE_CATEGORYNAME."<b>".$kat[$i]['Name']."</b>".POST_CATEGORYNAME."".PRE_CATEGORYINFO."".$weiter[$i]."<img border='0' src='../categorie_images/".$kat[$i]['Image']."'><br/></a><br/>(".$kat[$i]['count'].") ".MLS_PRODUKTLIST_LAN_31."<br/>(".$kat[$i]['sub_cat'].") ".MLS_PRODUKTLIST_LAN_32."".POST_CATEGORYINFO."";
						$text .= "</td>";
	         }
			$text .="</tr>";
      $text .= "</table></div>";
      $ns -> tablerender($title, $text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
/// Eigene Functionen ----------------------------------
function zaehler($tab_name, $query){
	$c=0;
	global $pref,$key,$sql,$user_pref;$_POST;
	$sql -> db_Select($tab_name, "*", $query);
  while($row = $sql-> db_Fetch()){
				$c++;
				}
	return $c;
	}
///======================================================
function caption_pfad($tab_name, $query, $par_id){
if($par_id==0||$par_id=='')
	{
	$text2="<b><a href=".e_PLUGIN."my_little_shop/sites/kategorien.php>".MLS_PRODUKTLIST_LAN_0."<a></b> ";
	return $text2;
	}
	global $pref,$key,$sql,$user_pref;$_POST;
	$sql -> db_Select($tab_name, "*", $query);
  while($row = $sql-> db_Fetch())
  {
	if($row['mls_parend_category_id']==''){return $text2;}
	if($row['mls_parend_category_id']!=0)
			{
			$text2 .= caption_pfad($tab_name, "mls_category_name !='' AND mls_category_id='".$row['mls_parend_category_id']."'", $row['mls_category_id']); 	
			$text2 .=" >> ";
			}
	else{$text2="<b><a href=".e_PLUGIN."my_little_shop/sites/kategorien.php>".MLS_PRODUKTLIST_LAN_0."</a></b> >>";}
			$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."'> ".$row['mls_category_name']."</a></b>";	
			}
	$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."'> ".$row['mls_category_name']."</a></b>";
	return $text2;
} 		
///======================================================
?>

	list($cat_ID, $typ, $sort) = explode(".", e_QUERY);
	$cat_ID = intval($cat_ID);
	$typ = intval($typ);
	$sort = intval($sort);
	unset($tmp);
	}
	
  
     $sql -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='".$cat_ID."' ORDER BY mls_category_name");
         while($row = $sql-> db_Fetch()){
		  				if(!$row['mls_category_enable']){continue;}
   						$kat[$count]['ID']=$row['mls_category_id'];
   						$kat[$count]['Name']=$row['mls_category_name'];
   						$kat[$count]['Image']=$row['mls_category_image'];
   						$kat[$count]['parend']=$row['mls_parend_category_id'];
   						$count++;
  						}
for($i=0; $i< $count; $i++)
					{
					$kat[$i]['count']= zaehler("mls_products",  "mls_products_category_id ='".$kat[$i]['ID']."' AND mls_products_enable='1'");
					$kat[$i]['sub_cat']=zaehler("mls_category", "mls_category_name !='' AND mls_parend_category_id='".$kat[$i]['ID']."' ORDER BY mls_category_name");
					if($kat[$i]['count']!=0){$weiter[$i]="<a href='produktlist.php?".$kat[$i]['ID'].".".$LIST_TYP.".".$LIST_PRO_SEITE."&cat_ID=1' title='".MLS_PRODUKTLIST_LAN_30."'>";}
					else if($kat[$i]['sub_cat']!=0){$weiter[$i]="<a href='".e_SELF."?".$kat[$i]['ID']."' title='".MLS_PRODUKTLIST_LAN_2."'>";}
					else {$weiter[$i]="<a href='produktlist.php?".$kat[$i]['ID'].".".$LIST_TYP.".".$LIST_PRO_SEITE."&cat_ID=1' title='".MLS_PRODUKTLIST_LAN_30."'>";}
					}
$title = caption_pfad("mls_category", "mls_category_name !='' AND mls_category_id='".$cat_ID."'", $cat_ID ); 

					
$text .= "<div style='width:100%'><table style='width:100%;backgroung: transparent;border:0px;' cellspacing='0' cellpadding='0'>";
for($i=0; $i< $count; $i++){		  
		  			if($A==$spalten){$text .="</tr>";$A=0;$text .="<tr>";}
						$A++;

		        $text .="<td style='text-align: center; padding: 2px; vertical-align: top; width: ".$breite."%;'>";
						$text .="".PRE_CATEGORYNAME."<b>".$kat[$i]['Name']."</b>".POST_CATEGORYNAME."".PRE_CATEGORYINFO."".$weiter[$i]."<img border='0' src='../categorie_images/".$kat[$i]['Image']."'><br/></a><br/>(".$kat[$i]['count'].") ".MLS_PRODUKTLIST_LAN_31."<br/>(".$kat[$i]['sub_cat'].") ".MLS_PRODUKTLIST_LAN_32."".POST_CATEGORYINFO."";
						$text .= "</td>";
	         }
			$text .="</tr>";
      $text .= "</table></div>";
      $ns -> tablerender($title, $text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
/// Eigene Functionen ----------------------------------
function zaehler($tab_name, $query){
	$c=0;
	global $pref,$key,$sql,$user_pref;$_POST;
	$sql -> db_Select($tab_name, "*", $query);
  while($row = $sql-> db_Fetch()){
				$c++;
				}
	return $c;
	}
///======================================================
function caption_pfad($tab_name, $query, $par_id){
if($par_id==0||$par_id=='')
	{
	$text2="<b><a href=".e_PLUGIN."my_little_shop/sites/kategorien.php>".MLS_PRODUKTLIST_LAN_0."<a></b> ";
	return $text2;
	}
	global $pref,$key,$sql,$user_pref;$_POST;
	$sql -> db_Select($tab_name, "*", $query);
  while($row = $sql-> db_Fetch())
  {
	if($row['mls_parend_category_id']==''){return $text2;}
	if($row['mls_parend_category_id']!=0)
			{
			$text2 .= caption_pfad($tab_name, "mls_category_name !='' AND mls_category_id='".$row['mls_parend_category_id']."'", $row['mls_category_id']); 	
			$text2 .=" >> ";
			}
	else{$text2="<b><a href=".e_PLUGIN."my_little_shop/sites/kategorien.php>".MLS_PRODUKTLIST_LAN_0."</a></b> >>";}
			$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."'> ".$row['mls_category_name']."</a></b>";	
			}
	$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."'> ".$row['mls_category_name']."</a></b>";
	return $text2;
} 		
///======================================================
?>
