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
require_once(e_ADMIN."auth.php");
//$pst->save_preset(); // save and render result using unique name
require_once("../handler/form_handler.php");
$rs = new my_form;
// ------------------------------

if (e_QUERY) {
	list($id, $from) = explode(".", e_QUERY);
	$id = intval($id);
	$from = intval($from);
	unset($tmp);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(!ADMIN)
{
exit;
}
else{
//--------------------------------------------------------------------------------


$title="<b>Auftrag ansehen</b>";
$text=auftrag_wiev($id);


$text.="<input class=\"button\" style=\"cursor:pointer\" type =\"button\" size=\"30\" value=\"Drücken\" onclick=\"win=window.open('auftrag_print.php?".$id."','adr','width=800,height=1100,toolbar=no,status=no,menubar=no,scollbars=auto,left=300,top=300');win.focus();return false;\" />";
$text.="<br/><br/>";
$text.=powered_by_shop();
$text.="<br/><br/>";
	}
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

$ns -> tablerender($title, $text);
// ========= End of the BODY ============================
require_once(e_ADMIN."footer.php");
///======================================================
function vorstellen_fühlen($value,$positionen) // Input: Zahl, Stellenanzahl
{	if($positionen > $value)
		{$positionen--;$Ausgabe="";
		for($i=$positionen; $i >= 1; $i--)
			 {$zahl=10;for($j=1; $j < $i ; $j++){$zahl=$zahl*10;}
		 		if($value < $zahl)
		 			{
		 			$Ausgabe .="0";	
		 			}else continue;
			 }
		}
		else {return $value;}
$Ausgabe .=$value;
return $Ausgabe;
}
///======================================================
function positionen_auflisten($ID) // Input: Auftragid
{
global $sql2;
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_positionen AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_positionen_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ac ON ac.mls_hersteller_id=aa.mls_products_hersteller_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ad ON ad.mls_steuer_id=ab.mls_category_steuer_id
 WHERE a.mls_positionen_auftrag_id ='".$ID."' ORDER BY a.mls_positionen_date
   			";
$tabele_text = "<table cellpadding='0' cellspacing='0' style='width:100%'>";
	$tabele_text .="<tr>
										<td class='fcaption'>Pos.</td>
										<td class='fcaption'>Art.Nr.</td>
										<td class='fcaption'>Art.Bezeichnung.</td>
										<td class='fcaption'>Art.Hersteller.</td>
										<td class='fcaption'>Anzahl / Einzelnpreis</td>
										<td class='fcaption'>Preis / Speuer</td>
										<td class='fcaption'>auf d. Lager</td>
										<td class='fcaption'>Optionen</td>
									</tr>	
										";

$pos_counter=1;
$SummeNetto=0.00;
$SummeBrutto=0.00;
 $sql2->db_Select_gen($qry1);
 while($row = $sql2-> db_Fetch())
 	{
	$EndPriseNetto[$pos_counter]=to_prise(($row['mls_products_price']*$row['mls_positionen_products_anzahl']),0.00);
	$EndPriseBrutto[$pos_counter]=to_prise(($row['mls_products_price']*$row['mls_positionen_products_anzahl']),$row['mls_steuer_wert']);
	$EinzPriseNetto[$pos_counter]=to_prise($row['mls_products_price'], 0.00);
	$EinzPriseBrutto[$pos_counter]=to_prise($row['mls_products_price'],$row['mls_steuer_wert']);
	$SummeNetto=$SummeNetto+($row['mls_products_price']*$row['mls_positionen_products_anzahl']);
	$SummeBrutto=($SummeBrutto+(((($row['mls_products_price']*$row['mls_positionen_products_anzahl'])/100)*$row['mls_steuer_wert'])+($row['mls_products_price']*$row['mls_positionen_products_anzahl'])));
 
	$tabele_text .="<tr>
										<td>".$pos_counter."</td>
										<td><a href='".e_PLUGIN."my_little_shop/admin/admin_produktliste.php?edit.".$row['mls_products_id']."'>";
	$tabele_text .=vorstellen_fühlen($row['mls_positionen_products_id'],6);						
	$tabele_text .="</a></td>
										<td><a href='".e_PLUGIN."my_little_shop/sites/produkt.php?".$row['mls_products_id']."'>".$row['mls_products_name']."</a></td>
										<td>".$row['mls_hersteller_name']."</td>
										<td style='text-align:right;'>".$row['mls_positionen_products_anzahl']." x ".$EinzPriseBrutto[$pos_counter]."€ =</td>
										<td>";
	$tabele_text .=	$EndPriseBrutto[$pos_counter];									
	$tabele_text .=	"€ inkl.".$row['mls_steuer_name']."";									
	$tabele_text .=		"</td>
										<td>".$row['mls_products_lager']."</td>
										<td>".$row['mls_category_dir']."</td>
									</tr>";
	$pos_counter++;
	}
	$Steuer_Summe=to_prise($SummeBrutto-$SummeNetto,0.00);
	$SummeNetto=to_prise($SummeNetto, 0.00);
	$SummeBrutto=to_prise($SummeBrutto, 0.00);	
$tabele_text .="<tr>
										<td  class='fcaption' style='text-align:right;' colspan='5'>Summe: ".$SummeNetto."€ + ".$Steuer_Summe."€ (St.) = </td>
										<td class='fcaption'><b>".$SummeBrutto." €</b></td>
										<td class='fcaption' colspan='2'>&nbsp;</td>
								</tr>";

$tabele_text .="</table>";

 /*
  mls_positionen_id
  mls_positionen_auftrag_id
  mls_positionen_products_id
  mls_positionen_enable
  mls_positionen_products_anzahl
  mls_positionen_price
  mls_positionen_date
  
  
 mls_products
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
  

mls_category (
  mls_category_id
  mls_category_name
  mls_parend_category_id
  mls_category_steuer_id
  mls_category_text
  mls_category_enable
  mls_category_color
  mls_category_dir
  mls_category_image
  

mls_hersteller (
  mls_hersteller_id
  mls_hersteller_name
  mls_hersteller_url
  mls_hersteller_text
  mls_hersteller_enable
  mls_hersteller_color
  mls_hersteller_dir
  mls_hersteller_image
  
  
mls_steuer (
  mls_steuer_id
  mls_steuer_name
  mls_steuer_wert
  
*/	
	Return $tabele_text;
}

function auftrag_wiev($id)
{
global $sql;

$qry1="
 SELECT a.*, aa.*, ab.* FROM ".MPREFIX."mls_auftrag AS a
 LEFT JOIN ".MPREFIX."mls_kunde_data AS aa ON aa.mls_kunde_data_id=a.mls_auftrag_kunde_id
 LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=aa.mls_kunde_data_use_id
 WHERE a.mls_auftrag_id ='".$id."' LIMIT 1
   			";
 $sql->db_Select_gen($qry1);
 $row= $sql-> db_Fetch();
/*
mls_auftrag (
  mls_auftrag_id
  mls_auftrag_kunde_id
  mls_auftrag_zahlung
  mls_auftrag_status
  mls_auftrag_color
  mls_auftrag_date
  mls_auftrag_date2
  mls_auftrag_date3

mls_kunde_data (
  mls_kunde_data_id
  mls_kunde_data_use_id
  mls_kunde_data_name
  mls_kunde_data_sex
  mls_kunde_data_firstname
  mls_kunde_data_secondname
  mls_kunde_data_contry
  mls_kunde_data_plz
  mls_kunde_data_sity
  mls_kunde_data_sreet
  mls_kunde_data_mail
  mls_kunde_data_telephon
  mls_kunde_data_text
  mls_kunde_data_enable
  mls_kunde_lifer_sex
  mls_kunde_lifer_firstname
  mls_kunde_lifer_secondname
  mls_kunde_lifer_contry
  mls_kunde_lifer_plz
  mls_kunde_lifer_sity
  mls_kunde_lifer_sreet
  mls_kunde_data_image
  mls_kunde_data_pref

*/
///+++++++++++++++++++++++++++++++++++++++++
	$STATI[0]="Fehler";
	$STATI[1]="<div style='font-size:18px;color:#f00;'>Neu</div>";
	$STATI[2]="<div style='font-size:18px;color:#aa0;'>Im Bearbeitung</div>";
	$STATI[3]="<div style='font-size:18px;color:#7da7d9;'>Gesendet</div>";
	$STATI[4]="<div style='font-size:18px;color:#00a91c;'>Erledigt</div>";
///+++++++++++++++++++++++++++++++++++++++++
	$ANREDE_TEXT[0]="";
  $ANREDE_TEXT[1]="Herr";
	$ANREDE_TEXT[2]="Frau";
	$ANREDE_TEXT[3]="Firma";
	//--------
	$LAND[0]="";
	$LAND[1]="Deutschland";
	$LAND[2]="";
	$LAND[3]="";
	$LAND[4]="";
	$LAND[5]="";
	$LAND[6]="";
///+++++++++++++++++++++++++++++++++++++++++
  $AUSGABE="
  				<table cellpadding='0' cellspacing='0' style='width:100%'>
						<tr>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:left;border-bottom:0px;'>
							<b>Rechnungsadresse</b><br/>
							".$ANREDE_TEXT[$row['mls_kunde_data_sex']]."<br/>
							".$row['mls_kunde_data_firstname']."&nbsp;".$row['mls_kunde_data_secondname']."
							<br/>
							".$row['mls_kunde_data_sreet']."<br/><br/>
							".$row['mls_kunde_data_plz']."&nbsp;".$row['mls_kunde_data_sity']."<br/>
							".$LAND[$row['mls_kunde_data_contry']]."<br/><br/>
							tel.:&nbsp;".$row['mls_kunde_data_telephon']."<br/><br/>
							Mail:&nbsp;".$row['user_email']."<br/><br/>
							</td>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:left;border-left:0px;border-bottom:0px;'>
							<b>Lieferadresse</b><br/>";

	$AUSGABE .=(!$row['mls_kunde_data_sex'] ? $ANREDE_TEXT[$row['mls_kunde_lifer_sex']] :  $ANREDE_TEXT[$row['mls_kunde_data_sex']]);	// Anrede	
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$row['mls_kunde_data_firstname'] ? $row['mls_kunde_lifer_firstname'] :  $row['mls_kunde_data_firstname']); // Vorname
	$AUSGABE .="&nbsp;";
	$AUSGABE .=(!$row['mls_kunde_data_secondname'] ? $row['mls_kunde_lifer_secondname'] :  $row['mls_kunde_data_secondname']); // Nachname
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$row['mls_kunde_data_sreet'] ? $row['mls_kunde_lifer_sreet'] :  $row['mls_kunde_data_sreet']); // Strasse
	$AUSGABE .="<br/><br/>";
	$AUSGABE .=(!$row['mls_kunde_data_plz'] ? $row['mls_kunde_lifer_plz'] :  $row['mls_kunde_data_plz']); // PLZ
	$AUSGABE .="&nbsp;";
	$AUSGABE .=(!$row['mls_kunde_data_sity'] ? $row['mls_kunde_lifer_sity'] :  $row['mls_kunde_data_sity']); // Ort
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$row['mls_kunde_data_contry'] ? $LAND[$row['mls_kunde_lifer_contry']] :  $LAND[$row['mls_kunde_data_contry']]); // Land
	$AUSGABE .="<br/><br/><br/>Status:".$STATI[$row['mls_auftrag_status']]."
							</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2' style='width:100%;text-align:left;border-bottom:0px;'>
								<b>Kunder Nr.:&nbsp;";
$AUSGABE .= vorstellen_fühlen($row['mls_kunde_data_id'],5);
$AUSGABE.="</b>
								<br/>
								<b>Auftragsnummer:&nbsp;";
	$AUSGABE .= vorstellen_fühlen($row['mls_auftrag_id'],5);				
	$AUSGABE .= "&nbsp;&nbsp;&nbsp;erfasst am:&nbsp;".strftime("%A, den %d %B %Y",$row['mls_auftrag_date'])."</b><br/><br/>";
	$AUSGABE .=positionen_auflisten($row['mls_auftrag_id']);
	$AUSGABE .="</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2' style='width:100%;text-align:center;'>							
								<div style='cursor:pointer' onclick=\"javascript:history.back()\"><b>Zurück</b></div>
								<br/><br/>
							</td>
						</tr>
					</table><br/>";	
return $AUSGABE;
}
////////////////////////////////////
?>