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
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/cat_lan.php");
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

$qry1="
 SELECT a.*, aa.*, ab.* FROM ".MPREFIX."mls_auftrag AS a
 LEFT JOIN ".MPREFIX."mls_kunde_data AS aa ON aa.mls_kunde_data_id=a.mls_auftrag_kunde_id
 LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=aa.mls_kunde_data_use_id
 WHERE a.mls_auftrag_id ='".$id."' LIMIT 1
 ";
 $sql->db_Select_gen($qry1);
 $Auftrag_Daten = $sql-> db_Fetch();
 
 $qry2="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_positionen AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_positionen_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ac ON ac.mls_hersteller_id=aa.mls_products_hersteller_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ad ON ad.mls_steuer_id=ab.mls_category_steuer_id
 WHERE a.mls_positionen_auftrag_id ='".$Auftrag_Daten['mls_auftrag_id']."' ORDER BY a.mls_positionen_date
   			";
$Poscount=0;
$sql->db_Select_gen($qry2);
 while($row = $sql-> db_Fetch())
 	{
 		$Pos_Daten[$Poscount]=$row;
 		$Poscount++;
 	}


//--------------------------------------------------------------------------------
$title="<b>RECHNUNG</b> Nr.: <b".$row['mls_auftrag_id']."</b>             Kunden-Nr.:".$row['mls_kunde_data_id']."        Datum: ".(strftime("%A, den %d %B %Y",$row['mls_auftrag_date3']))."";
$text="<link rel='stylesheet' href='".THEME."style.css' />\n<meta http-equiv='content-type' content='text/html; charset=utf-8' /><body style='background:#ffffff;'>";
$text.=auftrag_print($Auftrag_Daten,$Pos_Daten);
$text.="<br/><br/>";
//$text.="<a href=\"#\" onClick=\"javascript:window.print();javascript:self.close();\">drucken</a>";
///$text.="<input type=\"submit\" value=\"Drucke und schliesse\" onclick=\"window.print();window.close();\">";
$text.=powered_by_shop();
$text.="<br/><br/></body>";
	}	
echo $text;
///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
function vorstellen_fühlen($value,$positionen) // Input: Zahl, Stellenanzahl
{
	$value = intval($value);
	if($positionen > $value)
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
function positionen_auflisten($Pos_Daten,$von,$bis) // Input: Auftragid
{
$styleR[0]="forumheader";
$styleR[1]="forumheader2";
$pos_counter=1;
$Anzahl_pos=count($Pos_Daten);
$AUSGABE = "<table cellpadding='0' cellspacing='0' style='width:100%;empty-cells:show;' >";
$AUSGABE .="<tr>
										<td class='fcaption'>Pos.</td>
										<td class='fcaption'>Art.Nr.</td>
										<td class='fcaption'>Art.Bezeichnung.</td>
										<td class='fcaption'>Art.Hersteller.</td>
										<td class='fcaption'>Anzahl / Einzelnpreis</td>
										<td class='fcaption'>Preis / Speuer</td>
									</tr>	
										";

 for($i=0; $i< $Anzahl_pos; $i++)
 	{$WW=$pos_counter%2;
	$AUSGABE .="<tr>
										<td class='".$styleR[$WW]."' style='border-top:0px;'>&nbsp;&nbsp;".$pos_counter."</td>
										<td class='".$styleR[$WW]."' style='border-top:0px;border-left:0px;'>&nbsp;";
	$AUSGABE .=vorstellen_fühlen($Pos_Daten[$i]['mls_positionen_products_id'],6);						
	$AUSGABE .="</a></td>
										<td class='".$styleR[$WW]."' style='border-top:0px;border-left:0px;'>&nbsp;".$Pos_Daten[$i]['mls_products_name']."</td>
										<td class='".$styleR[$WW]."' style='border-top:0px;border-left:0px;'>&nbsp;".$Pos_Daten[$i]['mls_hersteller_name']."</td>
										<td class='".$styleR[$WW]."' style='text-align:right;border-top:0px;border-left:0px;'>&nbsp;".$Pos_Daten[$i]['mls_positionen_products_anzahl']." x ".$Pos_Daten[$i]['EinzPriseBrutto']."€ =</td>
										<td class='".$styleR[$WW]."' style='border-top:0px;border-left:0px;'>&nbsp;";
	$AUSGABE .=	$Pos_Daten[$i]['EndPriseBrutto'];									
	$AUSGABE .=	"€ inkl.".$Pos_Daten[$i]['mls_steuer_name']."";									
	$AUSGABE .=		"</td>
									</tr>";
	$pos_counter++;
	}
$AUSGABE .="</table>";
Return $AUSGABE;
}
////////////////////////////////////
function rechung_header_print($Auftrag_Daten)
{
$AUSGABE="<table cellpadding='0' cellspacing='0' style='width:100%'>
		<tr>
			<td class='' style='vertical-align:top;width:70%;height:100%;text-align:left;border:0px;font-size:220%;color:#880000;padding:15px;'>
				<b>MY LITLE SHOP</b><br/><br/>";
$AUSGABE .=rechung_kundendata_print($Auftrag_Daten);
$AUSGABE .="</td>
  		<td class='' style='vertical-align:top;width:30%;text-align:left;border:0px;Border-left 3:font-size:100%;color:#bbbbbb;padding:15px;'>
  			<font style='font-size:200%;color:#880000;'>MY LITLE SHOP</font><br/>mein kleines Online-Shop<br/>Meine Strasse 123b<br/><br/>14576 Mein Superstadt<br/>tel:02123-5456554<br/>fax:02123-5456554<br/>www.mein-shop.de<br/>
  		</td>
  	</tr>
  </table>";
 return $AUSGABE;	
}
////////////////////////////////////////////////
function rechung_kundendata_print($Auftrag_Daten)
{
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

  $AUSGABE="
  				<table cellpadding='0' cellspacing='0' style='width:100%'>
						<tr>
							<td class='' style='vertical-align:top;width:50%;text-align:left;border-bottom:0px;border:0px;padding:15px;'>
							Rechnungsadresse<br/><b>
							".$ANREDE_TEXT[$Auftrag_Daten['mls_kunde_data_sex']]."<br/>
							".$Auftrag_Daten['mls_kunde_data_firstname']."&nbsp;".$Auftrag_Daten['mls_kunde_data_secondname']."
							<br/>
							".$Auftrag_Daten['mls_kunde_data_sreet']."<br/><br/>
							".$Auftrag_Daten['mls_kunde_data_plz']."&nbsp;".$Auftrag_Daten['mls_kunde_data_sity']."<br/>
							".$LAND[$Auftrag_Daten['mls_kunde_data_contry']]."<br/><br/>
							tel.:&nbsp;".$Auftrag_Daten['mls_kunde_data_telephon']."<br/><br/>
							Mail:&nbsp;".$Auftrag_Daten['user_email']."<br/><br/></b>
							</td>
							<td class='' style='vertical-align:top;width:50%;text-align:left;border-left:0px;border-bottom:0px;border:0px;padding:15px;'>
							Lieferadresse<br/><b>";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_sex'] ? $ANREDE_TEXT[$Auftrag_Daten['mls_kunde_lifer_sex']] :  $ANREDE_TEXT[$Auftrag_Daten['mls_kunde_data_sex']]);	// Anrede	
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_firstname'] ? $Auftrag_Daten['mls_kunde_lifer_firstname'] :  $Auftrag_Daten['mls_kunde_data_firstname']); // Vorname
	$AUSGABE .="&nbsp;";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_secondname'] ? $Auftrag_Daten['mls_kunde_lifer_secondname'] :  $Auftrag_Daten['mls_kunde_data_secondname']); // Nachname
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_sreet'] ? $Auftrag_Daten['mls_kunde_lifer_sreet'] :  $Auftrag_Daten['mls_kunde_data_sreet']); // Strasse
	$AUSGABE .="<br/><br/>";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_plz'] ? $Auftrag_Daten['mls_kunde_lifer_plz'] :  $Auftrag_Daten['mls_kunde_data_plz']); // PLZ
	$AUSGABE .="&nbsp;";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_sity'] ? $Auftrag_Daten['mls_kunde_lifer_sity'] :  $Auftrag_Daten['mls_kunde_data_sity']); // Ort
	$AUSGABE .="<br/>";
	$AUSGABE .=(!$Auftrag_Daten['mls_kunde_data_contry'] ? $LAND[$Auftrag_Daten['mls_kunde_lifer_contry']] :  $LAND[$Auftrag_Daten['mls_kunde_data_contry']]); // Land
	$AUSGABE .="<br/><br/><br/></b>
							</td>
						</tr>
					</table>";
return $AUSGABE;
}
////////////////////////////////////
function auftrag_print($Auftrag_Daten,$Pos_Daten)
{


$pos_counter=1;
$SummeNetto=0.00;
$SummeBrutto=0.00;
$Anzahl_pos=count($Pos_Daten);

 for($i=0; $i< $Anzahl_pos; $i++)
 	{
	$Pos_Daten[$i]['EndPriseNetto']=to_prise(($Pos_Daten[$i]['mls_products_price']*$Pos_Daten[$i]['mls_positionen_products_anzahl']),0.00);
	$Pos_Daten[$i]['EndPriseBrutto']=to_prise(($Pos_Daten[$i]['mls_products_price']*$Pos_Daten[$i]['mls_positionen_products_anzahl']),$Pos_Daten[$i]['mls_steuer_wert']);
	$Pos_Daten[$i]['EinzPriseNetto']=to_prise($Pos_Daten[$i]['mls_products_price'], 0.00);
	$Pos_Daten[$i]['EinzPriseBrutto']=to_prise($Pos_Daten[$i]['mls_products_price'],$Pos_Daten[$i]['mls_steuer_wert']);
	
	$SummeNetto=$SummeNetto+($Pos_Daten[$i]['mls_products_price']*$Pos_Daten[$i]['mls_positionen_products_anzahl']);
	$SummeBrutto=($SummeBrutto+(((($Pos_Daten[$i]['mls_products_price']*$Pos_Daten[$i]['mls_positionen_products_anzahl'])/100)*$Pos_Daten[$i]['mls_steuer_wert'])+($Pos_Daten[$i]['mls_products_price']*$Pos_Daten[$i]['mls_positionen_products_anzahl'])));
	}
$Steuer_Summe=to_prise($SummeBrutto-$SummeNetto,0.00);
$SummeNetto=to_prise($SummeNetto, 0.00);
$SummeBrutto=to_prise($SummeBrutto, 0.00);
///+++++++++++++++++++++++++++++++++++++++++
$AUSGABE.="<table cellpadding='0' cellspacing='0' style='width:100%;border:0px;'>
  					<tr>
							<td class='forumheader' style='width:100%;text-align:center;'>							
								<a href=\"#\" onClick=\"javascript:window.print();javascript:self.close();\">Rechnung drucken</a>
								<br/><br/>
							</td>
						</tr>
						<tr>
							<td style='width:100%;height:200px;text-align:left;border-bottom:0px;'>";
$AUSGABE.=rechung_header_print($Auftrag_Daten);
//++++++++++++++++++
$AUSGABE.="</td></tr><tr>
							<td class='forumheader' style='width:100%;height:50px;text-align:left;border:0px;padding:15px;'>
								<b><font style='font-size:150%;'><b>RECHNUNG</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Auftragsnummer:&nbsp;<b>";
$AUSGABE .= vorstellen_fühlen($Auftrag_Daten['mls_auftrag_id'],5);							
$AUSGABE .= "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kunden-Nr.:&nbsp;<b>";
$AUSGABE .= vorstellen_fühlen($Auftrag_Daten['mls_kunde_data_id'],5);
$AUSGABE.="</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Datum am:&nbsp;".strftime("%A, den %d %B %Y",$Auftrag_Daten['mls_auftrag_date'])."</b><br/><br/>";
//++++++++++++++++++
$AUSGABE.="</td></tr><tr>
							<td class='forumheader' style='width:100%;height:400px;text-align:center;vertical-align:top;border:0px;padding:15px;'>";
$AUSGABE .=positionen_auflisten($Pos_Daten);

$AUSGABE.="</td></tr><tr>
							<td class='forumheader' style='width:100%;height:50px;text-align:center;vertical-align:top;border:0px;border-top:2px solid;padding:15px;'>";
$AUSGABE.="<table cellpadding='0' cellspacing='0' style='width:100%;border:0px;'>
							<tr>
								<td class='fcaption' style='width:80%;text-align:right;'>Summe: ".$SummeNetto."€ + ".$Steuer_Summe."€ (St.) = </td>
								<td class='fcaption' style='width:20%;text-align:right;'><b>".$SummeBrutto." €</b></td>
							</tr>
						</table>		
								";
////++++++++++++++++++++++++++++++++++++++++++++++
$AUSGABE .="</td>
						</tr>
					</table><br/>";	
return $AUSGABE;	
}
?>