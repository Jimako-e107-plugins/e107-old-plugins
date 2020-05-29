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
|		$Source: ../e107_plugins/my_little_shop/sites/produkt.php $
|		$Revision: 1.00 $
|		$Date: 2008/10/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
define("PLUG_FOLDER", "my_little_shop/");
define("IMAGE_FOLDER", "produkt_images/");
require_once(HEADERF);
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produkt_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produkt_lan.php");
require_once(e_PLUGIN.PLUG_FOLDER."handler/form_handler.php");
$text ="<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/funktionen.js\"></script>";
$text.="<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/slider.js\"></script>";
// ============= START OF THE BODY ====================================
$text .=  $tp->toHTML($pref['my_little_shop_begruesung'], TRUE);


$hintergrund="#FFFFFF";
$waerung_char=MLS_LAN_PRODUKT_21;
if (e_QUERY) {
	list($id_action,$id,$from) = explode(".", e_QUERY);
	$id = intval($id);
	//$from = intval($from);
	unset($tmp);
}
$Lager['red']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";
$Lager['green']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";

 $qry1="
 SELECT a.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_products AS a 
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=a.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=a.mls_products_hersteller_id
 WHERE a.mls_products_id ='".$id."' LIMIT 1
   			";

$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
/*
  mls_category_id
  mls_category_name
  mls_parend_category_id
  mls_category_steuer_id
  mls_category_text text
  mls_category_enable
  mls_category_color
  mls_category_dir
  mls_category_image

  mls_products_id
  mls_products_name
  mls_products_category_id
  mls_products_hersteller_id
  mls_products_parend_id
  mls_products_price
  mls_products_lager
  mls_products_text
  mls_products_text2
  mls_products_enable
  mls_products_color
  mls_products_image
  mls_products_pref
  mls_products_date  
 
  mls_hersteller_id
  mls_hersteller_name
  mls_hersteller_url
  mls_hersteller_text
  mls_hersteller_enable
  mls_hersteller_color
  mls_hersteller_dir
  mls_hersteller_image
  											
  mls_steuer_id
  mls_steuer_name
  mls_steuer_wert
*/
$text.="<div style='text-align:center'>
		<table cellpadding='0' cellspacing='0' width='100%'>
			<tr>
				<td class='fcaption' style='border-right:0px;'>";
$text.="<div style='font-size:14pt;font-weight:bold;'>"; /// Style von Produktname			
$text.=$row['mls_products_name']; /// Produktname	
$text.="</div></td>
				<td class='fcaption' style='border-left:0px;text-align:right;'> ".MLS_LAN_PRODUKT_2.": ".$row['mls_hersteller_name']."</td>
			</tr>
			<tr>
				<td class='forumheader3' style='background: ".$hintergrund.";border-bottom:0px;border-right:0px;text-align:left;vertical-align:top;width:50%'>";
				
				
$text.="<a id='thumb_0.5' href='".e_PLUGIN."zoom_images/foto.php?img=../".PLUG_FOLDER.IMAGE_FOLDER.$row['mls_products_image']."&h=1000&w=800' class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_0.5' } )\">
<img src='".e_PLUGIN."zoom_images/foto.php?img=../".PLUG_FOLDER.IMAGE_FOLDER.$row['mls_products_image']."&h=250&w=200' />";

$text.="</a>
			<div class='highslide-caption' id='caption_0.5'>
			<a class='bbcode' href='' rel='external' >
			</a>
			<br />".$row['mls_products_name']."</div>
					</td>
					<td class='forumheader3' style='background: ".$hintergrund.";border-bottom:0px;border-left:0px;text-align:right;vertical-align:top;width:50%'>";

$text.="	<table cellpadding='0' cellspacing='0' width='100%'>
						<tr>
							<td style='text-align:right;vertical-align:top;width:100%'>";
if(ADMIN){
$text.="<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?edit.".$id."'>
					<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/edit_16.png'>
				</a>";
				 }
			if($row['mls_products_lager']>=$pref['my_little_shop_lager'])
					{$text.=$Lager['green'];}
			else{$text.=$Lager['red'];}
    	$text.="</td>
            </tr>
            <tr>
							<td style='text-align:right;vertical-align:top;width:100%'>";

$text.="<div style='color:#cc0000;font-size:16pt;font-weight:bold;'>"; /// Style von Preis
$text.=	to_prise($row['mls_products_price'], $row['mls_steuer_wert']);// Preis
$text.=	" ".$waerung_char.""; // Waehrung			
$text.="</div></td>
            </tr>
            <tr>
							<td style='text-align:right;vertical-align:top;width:100%'>";

$text.="<div class='smaltext'>".MLS_LAN_PRODUKT_33." ";
$text.=	$row['mls_steuer_wert'];
$text.=	" ".MLS_LAN_PRODUKT_34.""; // Steuer			
$text.="</div><br/></td>
            </tr>
            <tr>
							<td>";
$text.=$tp->toHTML($row['mls_products_text'], TRUE);
$text.="</td>
            </tr>
            <tr>
							<td style='text-align:right;vertical-align:top;width:100%'><br/>";
					$text.=kauf_button( $row['mls_products_id'] );
					$text.="<br/><br/>
							</td>
            </tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2' style='background: ".$hintergrund.";border-top:0px;'>";

///////////////////////////  Definition der TABs. Aussehen, Breite, usw.
/// Hier werden die eigene Menues fuer den TAB-Panel defenier.....

if(!$row['mls_products_text2']){$Produktdetails="<div style='text-align:center'><br/><b>".MLS_LAN_PRODUKT_35."</b><br/><br/><br/><br/><br/>";}
else{$Produktdetails=$tp->toHTML($row['mls_products_text2'], TRUE, 'parse_sc,nobreak,emotes_on,no_make_clickable');}

$MLS_tab[0]['name']=MLS_LAN_PRODUKT_41; // Name
$MLS_tab[0]['item']=$Produktdetails; // und Inhallt

$MLS_tab[1]['name']=MLS_LAN_PRODUKT_36;
$MLS_tab[1]['item']="<div style='text-align:center'><br/><b>".MLS_LAN_PRODUKT_36."</b><br/><br/>";
//$tab[1]['item'].=passendes_zubehoer($row['mls_products_id']);

//$tab[2]['name']=MLS_LAN_PRODUKT_37;
//$tab[2]['item']="<div style='text-align:center'><br/><b>".MLS_LAN_PRODUKT_38."</b><br/><br/><br/><br/><br/>";

//Bitte nicht mehr als 6 Bereiche definieren und auf die Darstellung achten!!!
$TABconter=count($MLS_tab);
if($TABconter >0)
{
$text.=	reiter_menue($MLS_tab, $TABconter);
}

$text.="</td>
			</tr>
		</table>";
$text.="<br/><br/>";
$text.=powered_by_shop();
$text.="<br/><br/>";
$title = caption_pfad($row['mls_category_id']); 
$ns -> tablerender($title,$text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
///======================================================
///======================================================
///======================================================

function caption_pfad($kat_id)
{
$Ausgabe="<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php'>".MLS_LAN_PRODUKT_39."</a>";	
global 	$sql2;
$sql2 -> db_Select("mls_category","*","mls_category_id=".$kat_id."");
$row = $sql2-> db_Fetch();
if($row['mls_parend_category_id'])
	{
	$Ausgabe .=parend_pfad($row['mls_parend_category_id']);
	}
$Ausgabe.=" >> <a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$kat_id."'>".$row['mls_category_name']."</a>";
return $Ausgabe;
}
///++++++++++++++++++++++++++++++++++++++++++++
function parend_pfad($kat_id)
{
global 	$sql2;
$sql2 -> db_Select("mls_category","*","mls_category_id=".$kat_id."");
$row = $sql2-> db_Fetch();
if($row['mls_parend_category_id'])
	{
	$Test .=parend_pfad($row['mls_parend_category_id']);
	}
$RRR=	"".$Test." >> <a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$row['mls_category_id']."'>".$row['mls_category_name']."</a>";
return $RRR;	
}

///++++++++++++++++++++++++++++++++++++++++++++
function passendes_zubehoer($ID)
{
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produktlist_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produktlist_lan.php");
global $sql,$tp,$pref;
$schwele=MLS_LAGER_SCHWELLE;
$counter=0;
   
  $qry1="
 SELECT a.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_products AS a 
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=a.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=a.mls_products_hersteller_id
 WHERE a.mls_products_parend_id ='".$ID."'
   			";
$sql->db_Select_gen($qry1);
         while($row = $sql-> db_Fetch()){ // start loop 
		  				if(!$row['mls_products_enable']){continue;} // Wenn Kategorie Nicht Aktiv ist ueberspringen
							$product[$counter]['id']=$row['mls_products_id'];
							$product[$counter]['name']=$row['mls_products_name'];
							$product[$counter]['steuer']=$steuerwert;
							$product[$counter]['category_id']=$row['mls_products_category_id'];
							$product[$counter]['hersteller_id']=$row['mls_products_hersteller_id'];
							$product[$counter]['price']=$row['mls_products_price'];
							if($row['mls_products_lager']< $schwele)
							{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";}
					else{$product[$counter]['lager_amper']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";}
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
 if($counter > 0)       	
   {    	
   $zubehoer_text = "<div style='width:100%'><table style='width:100%' cellspacing='0' cellpadding='0'>
   							<tr class='fcaption'>
   							<td width='70px'>".MLS_PRODUKTLIST_LAN_11."</td>
								<td>".MLS_PRODUKTLIST_LAN_9."</td>
								<td>".MLS_PRODUKTLIST_LAN_12."</td>
								<td width='150px'>".MLS_PRODUKTLIST_LAN_13."</td>
								<td>".MLS_PRODUKTLIST_LAN_14."</td>
   							</tr>";
			for($i=0; $i< $counter;$i++ )
	     		{
	     		$Steuerwert[$i]=($product[$i]['price']/100)*$steuerwert;
	     		$Endprise[$i]=($product[$i]['price']+$Steuerwert[$i]);
	     		$Endprise[$i]=to_prise($Endprise[$i],0);

	     		if(!($A=$i%2)){$tabform="forumheader";}else{$tabform="forumheader2";}	
	     		$zubehoer_text .="<tr class='".$tabform."'>";		
					$zubehoer_text .="<td><a href=produkt.php?".$product[$i]['id']." title='".MLS_PRODUKTLIST_LAN_10."'>";
					if($product[$i]['image']==''){$zubehoer_text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/default.jpg'";}
					else{$zubehoer_text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER.IMAGE_FOLDER.$product[$i]['image']."'";}

					$zubehoer_text .="width='70px' height='70px'></a><br/></td>";
					$zubehoer_text .="<td><a href=produktliste2.php?cat=".$product[$i]['hersteller_id']." title='".MLS_PRODUKTLIST_LAN_9."'>";			
					if(!$product[$i]['hersteller_image']){$zubehoer_text .="".$product[$i]['hersteller']."";}
					else{$zubehoer_text .="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."manufact_images/".$product[$i]['hersteller_image']."' width='30px'>";}
					$zubehoer_text .="</a></td>";
					$zubehoer_text .="<td><a href=produkt.php?".$product[$i]['id']." title='".MLS_PRODUKTLIST_LAN_10."'><b>".$product[$i]['name']."</b></a>
					<div class='smalltext'>";
					$AT=$tp->toHTML($product[$i]['text'], TRUE);
					$zubehoer_text .=$tp->html_truncate($AT, 50, " <a href='produkt.php?".$product[$i]['id']."'><strong>".MLS_PRODUKTLIST_LAN_15."</strong></a>");									
					$zubehoer_text .="</div></td>";
					$zubehoer_text .="<td><div style='font-size: 13pt; font-weight: bold; color: #f00;'>".$Endprise[$i]." ".$waerungs_char."</div></td>";
					$zubehoer_text .="<td>".$product[$i]['lager_amper']."";
					$zubehoer_text .="</td>";
					}
      $zubehoer_text .= "</table></div>";
   }
else{
	$zubehoer_text = "<div style='width:100%;text-alidgn:center;'><br/><br/><br/><br/>".MLS_LAN_PRODUKT_40." <br/><br/><br/><br/></div>";

	}
return  $zubehoer_text;
}
///++++++++++++++++++++++++++++++++++++++++++++
function kauf_button($id)
{
$button_text="<a href='korb.php?new.".$id."'><img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/korb2.gif'></a>";
return $button_text;
}
///+++++++++++++++++++++++++++++++++++++++++++++
function reiter_menue($tab,$TABconter)
{
$TABTEXT="";
$tab_width = round(((100-22+$TABconter)   / $TABconter),0);  //// wie Breit werden die einzelne Tabs... (22 px ist die Breite des letztes $DYMMY, also unterstrich, sieht einfach gut aus wenn es etwas länger ist als der rest)
///////////////////////////////  Aussehen, Breite, usw.
$expand_autohide = "display:none; ";
$hervorheben="padding:2px 4px 0px 4px;width:".$tab_width."%;vertical-align:midle;text-align:center;height:20px;background: #d4d4d4 url(".e_PLUGIN.PLUG_FOLDER."images/MC2.png) repeat-x;color:#000;border: #c3c3c3 1px solid; border-bottom: 0px;font-family: Arial;font-size:12px;";
$nichthervorheben="padding:2px 4px 0px 4px;width:".$tab_width."%;vertical-align:midle;text-align:center;height:20px;background: #aaaaaa;color:#000;border-right: #ccc 1px solid;border-top: #ccc 1px solid;border-left: #ccc 1px solid;border-bottom: #c3c3c3 1px solid;font-family: Arial;font-size:12px;";
$DYMMY="<td style='height:20px;width:1%;background: transparent;border: 0px;border-bottom: #c3c3c3 1px solid;font-family: Arial;font-size:12px;'></td>";
$DYMMYLAST="<td style='height:21px;width:22%;background: transparent;border: 0px;border-bottom: #c3c3c3 1px solid;font-family: Arial;font-size:12px;'></td>";
////////////////////////////////// TAB-Menue Erstellung!!
for($i=0; $i< $TABconter; $i++)
	{
$TABTEXT .="<div id='mls_exp_menu_".$i."'";
if($i >0)
	{
$TABTEXT .=" style='$expand_autohide'";		
	}
$TABTEXT .=">
						<table style='width:100%;' cellspacing='0' cellpadding='0'><tr>";			
	for($j=0; $j< $TABconter; $j++)
		{
		if($j==$i)
			{
			$TABTEXT .="<td style='".$hervorheben."'>";
			}
		else{
			$TABTEXT .="<td style='".$nichthervorheben."' onMouseover=\"this.style.backgroundImage='url(".e_PLUGIN.PLUG_FOLDER."images/MC2.png)';\" onMouseout=\"this.style.background='#aaaaaa';\">";
			}
		$TABTEXT .="<div style='cursor:pointer' onclick=\"";
		for($k=0; $k< $TABconter; $k++)
			{
			if($k==$j)
				{
				$TABTEXT .="einblenden('mls_exp_menu_".$k."')";
				}
			else{
					$TABTEXT .="ausblenden('mls_exp_menu_".$k."')";
				}
			if($k <  $TABconter-1)
				{
				$TABTEXT .=", ";
				}
			}
	$TABTEXT .="\" ><b>".$tab[$j]['name']."</b></div></td>	";
	if($j <  $TABconter-1)
			{
			$TABTEXT .=$DYMMY;
			}
	else{
		$TABTEXT .=$DYMMYLAST;
			}
		}	
$TABTEXT .="</tr><tr>
						<td colspan='".($TABconter*2)."' style='background: #fff url(".e_PLUGIN.PLUG_FOLDER."images/MC.png) repeat-x;color: #000;vertical-align:top;text-align:left;border: #c3c3c3 1px solid;border-top: 0px;padding:10px;font-family: Arial;font-size: 12px;'>								  
							".$tab[$i]['item']."
						</td>
					</tr>
				</table>
			</div>";
	}
$TABTEXT .="<br/>";
return $TABTEXT;
}
///+++++++++++++++++++++++++++++++++++++++++++++
?>