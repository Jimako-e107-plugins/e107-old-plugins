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
|		$Source: ../e107_plugins/my_little_shop/sites/produktlist.php $
|		$Revision: 1.00 $
|		$Date: 2008/07/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
require_once("../templates/produktlist_1.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/produktlist_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/produktlist_lan.php");
require_once("../handler/form_handler.php");
// ============= START OF THE BODY ====================================
$text .=  $tp->toHTML($pref['my_little_shop_begruesung'], TRUE);

if(e_QUERY)
	{
	list($cat_ID, $typ, $sort) = explode(".", e_QUERY);
	$cat_ID = intval($cat_ID);
	$typ = intval($typ);
	$sort = intval($sort);
	unset($tmp);
	}

$sql -> db_Select("mls_category", "*", "mls_category_id ='".$cat_ID."' ORDER BY mls_category_id");
        while($row = $sql-> db_Fetch()){ // start loop 
					$kategorie=$row['mls_category_name'];
					$kategorie_img=$row['mls_category_image'];
					$cat_pfad=$row['mls_category_dir'];
					$cat_steuer=$row['mls_category_steuer_id'];
				}
$syb_cat_count=0;
$sql -> db_Select("mls_category", "*", "mls_parend_category_id ='".$cat_ID."' ORDER BY mls_category_id");
        while($row = $sql-> db_Fetch()){ // start loop 
					$sub_cat[$syb_cat_count][Name]=$row['mls_category_name'];
					$sub_cat[$syb_cat_count][Image]=$row['mls_category_image'];
					$sub_cat[$syb_cat_count][ID]=$row['mls_category_id'];
					$syb_cat_count++;
				}


$count=0;
$sql -> db_Select("mls_products", "*", "mls_products_category_id ='".$cat_ID."' ORDER BY mls_products_name");
while($row = $sql-> db_Fetch())
		{
		if(!$row['mls_products_enable'])
				{continue;}
		$count++;
		}  				

if($count > 0)
  {
$sql -> db_Select("mls_steuer", "*", "mls_steuer_id ='".$cat_steuer."'");
while($row = $sql-> db_Fetch())
		{
		$steuerwert=$row['mls_steuer_wert'];
		}
if($syb_cat_count!=0){
			$link_zu_sub_kat="<br/><b><a href='kategorien.php?".$cat_ID."' title='".MLS_PRODUKTLIST_LAN_2."'> ".MLS_PRODUKTLIST_LAN_3."(".$syb_cat_count.") ".MLS_PRODUKTLIST_LAN_4."<br/> ".MLS_PRODUKTLIST_LAN_5."</a></d>";
		}else{$link_zu_sub_kat="";}
$text = "<table style='width:100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='text-align: left; padding: 10px; vertical-align: middle; width: 30%;'><img border='0' src='".e_PLUGIN."my_little_shop/categorie_images/".$kategorie_img."'></td>
						<td style='text-align: left; padding: 10px; vertical-align: top; width: 60%;'>".MLS_PRODUKTLIST_LAN_19." <b>".$kategorie."</b>".MLS_PRODUKTLIST_LAN_18."<br/>".MLS_PRODUKTLIST_LAN_16." (".$count.") ".MLS_PRODUKTLIST_LAN_17.".<br/>".$link_zu_sub_kat."</td>
					</tr>	
				</table>";

$schwele=$pref['my_little_shop_lager'];

$counter=0;
   
  $qry1="
 SELECT a.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_products AS a 
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=a.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=a.mls_products_hersteller_id
 WHERE a.mls_products_category_id ='".$cat_ID."'
   			";
$sql->db_Select_gen($qry1);
         while($row = $sql-> db_Fetch()){ // start loop 
		  				if(!$row['mls_products_enable']){continue;} // Wenn Kategorie Nicht Aktiv ist Ãœberspringen
							$product[$counter]['id']=$row['mls_products_id'];
							$product[$counter]['name']=$row['mls_products_name'];
							$product[$counter]['steuer']=$steuerwert;
							$product[$counter]['category_id']=$row['mls_products_category_id'];
							$product[$counter]['hersteller_id']=$row['mls_products_hersteller_id'];
							$product[$counter]['price']=$row['mls_products_price'];
							if($row['mls_products_lager']<=$schwele)
							{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_rot.gif'>";}
					else{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN."my_little_shop/images/ampel_gruen.gif'>";}
							$product[$counter]['lager']=$row['mls_products_lager'];
							$product[$counter]['text']=$row['mls_products_text'];
							$product[$counter]['enable']=$row['mls_products_enable'];
							$product[$counter]['image']=$row['mls_products_image'];
							$product[$counter]['pref']=$row['mls_products_pref'];
							$product[$counter]['date']=$row['mls_products_date'];
         			$product[$counter]['hersteller']=$row['mls_hersteller_name'];
							$product[$counter]['url']=$row['mls_hersteller_url'];
							$product[$counter]['hersteller_text']=$row['mls_hersteller_text'];
							$product[$counter]['hersteller_enable']=$row['mls_hersteller_enable'];
							$product[$counter]['hersteller_color']=$row['mls_hersteller_color'];
							$product[$counter]['hersteller_dir']=$row['mls_hersteller_dir'];
							$product[$counter]['hersteller_image']=$row['mls_hersteller_image'];
    					$counter++;
        	}

if($typ==3){
   $text .= "<div style='width:100%'><table style='width:100%' cellspacing='0' cellpadding='0'>
   							<tr>
								<td class='fcaption'style='text-align:center;' >Artikel</td>
								<td class='fcaption' style='text-align:center;' width='150px'>".MLS_PRODUKTLIST_LAN_13."</td>
								<td class='fcaption' style='text-align:center;'>".MLS_PRODUKTLIST_LAN_14."</td>
   							</tr>";					
			for($i=0; $i< $counter;$i++ )
	     		{
		
		$Steuerwert[$i]=($product[$i]['price']/100)*$steuerwert;
	 	$Endprise[$i]=($product[$i]['price']+$Steuerwert[$i]);
	 	$Endprise[$i]=to_prise($Endprise[$i],0);
	 	
	     		if(!($A=$i%2)){$tabform="forumheader";}else{$tabform="forumheader2";}	
	     		$text .="<tr class='".$tabform."'>";
	     			$Tool_Desc="";
					$Tool_Tip_Text="<table border=\'0\' cellspacing=\'0\'><tr><td style=\'text-align:right;background:#fff;\'><img src=".e_PLUGIN."my_little_shop/produkt_images/".$cat_pfad."/".$product[$i]['image']." width=150 /><\/td><\/tr><tr><td style=\'text-align:right;background:#fff;\'>".$Tool_Desc."<\/td><\/tr><\/table>";	
	     		$text.="<td><a href=\"".e_PLUGIN."my_little_shop/sites/produkt.php?".$product[$i]['id']."\" onmouseover=\"Tip('$Tool_Tip_Text', TITLE, 'Vorschau', WIDTH, 150, SHADOW, false, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true, TITLEBGCOLOR, '#000', TITLEFONTCOLOR, '#fff', BGCOLOR, '#fff', BORDERCOLOR, '#000')\" onmouseout=\"UnTip()\" ><b>".$product[$i]['name']."</b>";     		
					//$text .="<td><a href=produkt.php?".$product[$i]['id']." title='".MLS_PRODUKTLIST_LAN_10."'><b>".$product[$i]['name']."</b></a>   ";
					//$AT=$tp->toHTML($product[$i]['text'], TRUE);
					//$text .=$tp->html_truncate($AT, 30, " ...");		
					$text .="</td>";
					$text .="<td style='text-align:right;font-size: 15px; font-weight: bold; color: #f00;'>".$Endprise[$i]." €     <a href='korb.php?new.".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_8."'><img border='0' src='".e_PLUGIN."my_little_shop/images/korb2_s.png'></a></td>";
					$text .="<td style='text-align:center;'>".$product[$i]['lager_amper']."";
					if(ADMIN){$text .="<a target='_blank' href='".e_PLUGIN."my_little_shop/admin/admin_produktliste.php?edit.".$product[$i]['id']."' title=''>
									<img border='0' src='".e_PLUGIN."my_little_shop/images/edit_16.png'></a>";}
					$text .="</td>";
					
				}
 }

else if($typ==2){

   $text .= "<div style='width:100%'><table style='width:100%' cellspacing='0' cellpadding='0'>
   							<tr>
   							<td class='fcaption' width='70px'>".MLS_PRODUKTLIST_LAN_11."</td>
								<td class='fcaption'>".MLS_PRODUKTLIST_LAN_12."</td>
								<td class='fcaption' width='150px'>".MLS_PRODUKTLIST_LAN_13."</td>
								<td class='fcaption'>".MLS_PRODUKTLIST_LAN_14."</td>
   							</tr>";					
			for($i=0; $i< $counter;$i++ )
	     		{
		
		$Steuerwert[$i]=($product[$i]['price']/100)*$steuerwert;
	 	$Endprise[$i]=($product[$i]['price']+$Steuerwert[$i]);
	 	$Endprise[$i]=to_prise($Endprise[$i],0);
	 	
	     		if(!($A=$i%2)){$tabform="forumheader";}else{$tabform="forumheader2";}	
	     		$text .="<tr class='".$tabform."'>";
					$text .="<td><a href='produkt.php?".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_10."'>";
					if($product[$i]['image']==''||$cat_pfad==''){$text .="<img border='0' src='".e_PLUGIN."my_little_shop/images/default.jpg'";}
					else{$text .="<img border='0' src='".e_PLUGIN."my_little_shop/produkt_images/".$cat_pfad."/".$product[$i]['image']."'";}

					$text .="width='70px' height='70px'></a><br/></td>";
					//$text .="<td><a href='produktliste2.php?".$product[$i]['hersteller_id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_9."'>";			
					//if(!$product[$i]['hersteller_image']){$text .="".$product[$i]['hersteller']."";}
					//else{$text .="<img border='0' src='".e_PLUGIN."my_little_shop/manufact_images/".$product[$i]['hersteller_image']."' width='70px'>";}
					//$text .="</a></td>";
					$text .="<td><a href='produkt.php?".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_10."'><b>".$product[$i]['name']."</b></a>
					<div class='smalltext'>";
					$AT=$tp->toHTML($product[$i]['text'], TRUE);
					$text .=$tp->html_truncate($AT, 50, " <a href='produkt.php?".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."'><strong>".MLS_PRODUKTLIST_LAN_15."</strong></a>");									
					$text .="</div></td>";
					$text .="<td><div style='font-size: 20px; font-weight: bold; color: #f00;'>".$Endprise[$i]." €</div><div class='smalltext'>".MLS_PRODUKTLIST_LAN_6."<b>".$steuerwert." % </b>".MLS_PRODUKTLIST_LAN_7."</div></td>";
					$text .="<td>".$product[$i]['lager_amper']."<br/><a href='korb.php?new.".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_8."'><img border='0' src='".e_PLUGIN."my_little_shop/images/korb.png'></a>";
					if(ADMIN){$text .="<a target='_blank' href='".e_PLUGIN."my_little_shop/admin/admin_produktliste.php?edit.".$product[$i]['id']."' title=''>
									<img border='0' src='".e_PLUGIN."my_little_shop/images/edit_16.png'></a>";}
					$text .="</td>";
					
				}
 }
else if($typ==1)
{	
$text .= "<div style='width:100%'><table style='width:100%' cellspacing='0' cellpadding='0'>
   							<tr>";
$spalten=$pref['my_little_shop_kat_row'];
$breite=(100 / $spalten)-1;
$breite=sprintf("%3.0f", $breite);
$breite.="%";
$PNML=14;
for($i=0; $i< $counter; $i++){
		$Steuerwert[$i]=($product[$i]['price']/100)*$steuerwert;
	 	$Endprise[$i]=($product[$i]['price']+$Steuerwert[$i]);
	 	$Endprise[$i]=to_prise($Endprise[$i],0);
			  			if($A==$spalten){$text .="</tr>";$A=0;$text .="<tr>";}
						$A++;
						$PNL=strlen($product[$i]['name']);
						if($PNL > $PNML+3)
							{
							$product_short_name= substr ($product[$i]['name'],0,$PNML);
							$product_short_name .="...";
							}
							else{$product_short_name =$product[$i]['name'];}
						
		        $text .="<td style='text-align: center; padding: 0px; vertical-align: top; width: ".$breite.";'>";
						$text .="".PRE_PRODUKTNAME."<a href='produkt.php?".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_10." zu \"".$product[$i]['name']."\"'><b>".$product_short_name."</b></a>".POST_PRODUKTNAME."".PRE_PRODUKTINFO."<a href='produkt.php?".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_10."'>";
					if($product[$i]['image']==''||$cat_pfad==''){$text .="<img border='0' src='".e_PLUGIN."my_little_shop/images/default.jpg'";}
					else{$text .="<img border='0' src='".e_PLUGIN."my_little_shop/produkt_images/".$cat_pfad."/".$product[$i]['image']."'";}
					$text .="width='120px'></a>
										<br/><div style='font-size:130%;color:#AA0000;font-weight:bold;text-align:right;vertical-align:middle;'>".$Endprise[$i]." € <a href='korb.php?new.".$product[$i]['id']."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_8."'><img border='0' src='".e_PLUGIN."my_little_shop/images/korb_s.png'></a></div></div><div style='font-size:70%;text-align:right;'>".MLS_PRODUKTLIST_LAN_6."<b>".$steuerwert." % </b>".MLS_PRODUKTLIST_LAN_7."</div>".POST_PRODUKTINFO."";
						$text .= "</td>";
					}
			if($A!=0)
				{
				for($i=$A; $i< $spalten; $i++)
						{
							$text .="<td style='text-align: center; padding: 0px; vertical-align: top; width: ".$breite.";'></td>";
						}
				}

}



      $text .= "</table></div>";
}else{
$syb_cat_count=0;
$sql -> db_Select("mls_category", "*", "mls_parend_category_id ='".$cat_ID."' ORDER BY mls_category_id");
        while($row = $sql-> db_Fetch()){ // start loop 
					$sub_cat[$syb_cat_count][Name]=$row['mls_category_name'];
					$sub_cat[$syb_cat_count][Image]=$row['mls_category_image'];
					$sub_cat[$syb_cat_count][ID]=$row['mls_category_id'];
					$syb_cat_count++;
				}
if($syb_cat_count!=0){
			$link_zu_sub_kat="<br/><b><a href='kategorien.php?".$cat_ID."&cat_ID=".$_GET['cat_ID']."' title='".MLS_PRODUKTLIST_LAN_2."'> ".MLS_PRODUKTLIST_LAN_3."(".$syb_cat_count.") ".MLS_PRODUKTLIST_LAN_4."<br/>".MLS_PRODUKTLIST_LAN_5."</a></d>";
		}else{$link_zu_sub_kat="";}
	$text = "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='text-align: left; padding: 10px; vertical-align: middle; width: 30%;'><img border='0' src='".e_PLUGIN."my_little_shop/categorie_images/".$kategorie_img."'></td>
						<td style='text-align: left; padding: 10px; vertical-align: top; width: 60%;'>".MLS_PRODUKTLIST_LAN_20."<b>".$kategorie."</b> ".MLS_PRODUKTLIST_LAN_22."<br/> ".MLS_PRODUKTLIST_LAN_21."<br/><br/>".$link_zu_sub_kat."</td>
					</tr>	
				</table>";
			}	
       $title = caption_pfad("mls_category", "mls_category_name !='' AND mls_category_id='".$cat_ID."'", $cat_ID ); 

        $ns -> tablerender($title, $text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
///======================================================

function caption_pfad($tab_name, $query, $par_id){
	if($par_id==0||$par_id=='')
		{
		$text2="<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?cat_ID=".$_GET['cat_ID']."'>".MLS_PRODUKTLIST_LAN_0."<a></b> ";
		return $text2;
		}
	
		global $pref,$key,$sql,$user_pref;$_POST;
		$sql -> db_Select($tab_name, "*", $query);
   			while($row = $sql-> db_Fetch()){
					   							
					if($row['mls_parend_category_id']==''){return $text2;}
					if($row['mls_parend_category_id']!=0)
							{
							$text2 .= caption_pfad($tab_name, "mls_category_name !='' AND mls_category_id='".$row['mls_parend_category_id']."'", $row['mls_category_id']); 	
							$text2 .=" ".MLS_PRODUKTLIST_LAN_1." ";
							}
					else{$text2="<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?cat_ID=".$_GET['cat_ID']."'>".MLS_PRODUKTLIST_LAN_0."</a></b> ".MLS_PRODUKTLIST_LAN_1."";}
				$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."&cat_ID=".$_GET['cat_ID']."'> ".$row['mls_category_name']."</a></b>";	
			}
		$text2 .= "<b><a href='".e_PLUGIN."my_little_shop/sites/kategorien.php?".$row['mls_category_id']."&cat_ID=".$_GET['cat_ID']."'> ".$row['mls_category_name']."</a></b>";
		return $text2;
		} 
		
///++++++++++++++++++++++++++++++++++++++++++++
?>