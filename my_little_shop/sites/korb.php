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
|		$Source: ../e107_plugins/my_little_shop/sites/korb.php $
|		$Revision: 1.00 $
|		$Date: 2008/10/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
require_once("../handler/constanten.php");
require_once(HEADERF);
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/MLS_korb_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/MLS_korb_lan.php");
require_once("../handler/form_handler.php");
// ============= START OF THE BODY ====================================
$text =  $tp->toHTML($pref['my_little_shop_begruesung'], TRUE);
$waerung_char=MLS_LAN_KORB_0;

if (e_QUERY) {
	list($action,$id,$from) = explode(".", e_QUERY);
	$id = intval($id);
	//$from = intval($from);
	unset($tmp);
}

$Lager['red']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";
$Lager['green']="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";

//+++++++++++++++++  Anzahl der Produkte im Warenkorb aktualisieren   +++++++++++++++++++++
if($_POST['anzal']){
	$Str="mls_temp_anzahl = ".$_POST['anzal']." WHERE mls_temp_id=".$_POST['T_ID']." LIMIT 1";
	$sql -> db_Update("mls_temp", $Str);
	}
//++++++++++++++++++++++++  Produkt aus dem Warenkorb entfernen  ++++++++++++++++++++++++++
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$sql -> db_Delete("mls_temp", "mls_temp_id='".$del_id."' ");
}
//+++++++++++++++++++++++++  Warenkorb leern  ++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['lose']))
{
	$sql -> db_Delete("mls_temp", "mls_temp_user_ip ='".USERIP."' ");
}
//+++++++++++++++++++++++++Produkt in den Warenkorb zufügen  ++++++++++++++++++++++++++++++++
if($action=="new" && $id!='')
{
$sql -> db_Select("mls_temp","*","mls_temp_user_ip ='".USERIP."' AND mls_temp_products_id='".$id."'");
$row = $sql-> db_Fetch();
if($row['mls_temp_anzahl'] > 0)
	{
	$WWW = $row['mls_temp_anzahl']+1 ;
	$Str="mls_temp_anzahl = ".$WWW." WHERE mls_temp_id=".$row['mls_temp_id']." LIMIT 1";
	$sql -> db_Update("mls_temp", $Str);
	}
else
	{
	$Dat=$tp->toDB(time());	
	$inputstr="'', '".USERIP."', '".$id."', '1', '".$Dat."'";	
	$sql -> db_Insert("mls_temp", "0, ".$inputstr." ");	
	$inputstr="'', '".USERIP."', '".$id."', '1'";
	}
///$text="<meta http-equiv='refresh' content='0;URL=korb.php?list'>";
}
//--------------------------------------------------------------------------------
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_temp AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_temp_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=aa.mls_products_hersteller_id
 WHERE a.mls_temp_user_ip ='".USERIP."' ORDER BY a.mls_temp_date
   			";
 $sql->db_Select_gen($qry1);
 $counter=0;
 while($row = $sql-> db_Fetch()){
 $Produktlist[$counter]['mls_products_name']=$row['mls_products_name'];
 $Produktlist[$counter]['mls_products_price']=$row['mls_products_price'];
 $Produktlist[$counter]['mls_products_image']=$row['mls_products_image'];
 $Produktlist[$counter]['mls_category_dir']=$row['mls_category_dir'];
 $Produktlist[$counter]['mls_category_steuer_id']=$row['mls_category_steuer_id'];
 $Produktlist[$counter]['mls_steuer_wert']=$row['mls_steuer_wert'];
 $Produktlist[$counter]['mls_temp_anzahl']=$row['mls_temp_anzahl'];
 $Produktlist[$counter]['mls_temp_id']=$row['mls_temp_id'];
 $Produktlist[$counter]['mls_products_lager']=$row['mls_products_lager'];          
 $Produktlist[$counter]['mls_products_id']=$row['mls_products_id'];   
 $counter++;
 }

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
if($counter > 0)
	{
	$text.="<div style='text-align:center'>
			<table cellpadding='0' cellspacing='0' width='100%'>";			
	for($i=0; $i < $counter; $i++)
	{
///////////////  Berechne Die Steuer und die Summe /////////////////////////////////////////////	
	$Produktlist[$i]['EndPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),0.00);
	$Produktlist[$i]['EndPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),$Produktlist[$i]['mls_steuer_wert']);
	$Produktlist[$i]['EinzPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']), 0.00);
	$Produktlist[$i]['EinzPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']),$Produktlist[$i]['mls_steuer_wert']);
	$SummeNetto=$SummeNetto+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']);
	$SummeBrutto=($SummeBrutto+(((($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])/100)*$Produktlist[$i]['mls_steuer_wert'])+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])));
	}
	
$Steuer_Summe=to_prise($SummeBrutto-$SummeNetto,0.00);
$SummeNetto=to_prise($SummeNetto, 0.00);
$SummeBrutto=to_prise($SummeBrutto, 0.00);

$text.=produkttable_caption();
$text.=produkttable($Produktlist,$counter);
$text.=produkttable_summen($SummeBrutto,$Steuer_Summe);

	
	$text.="</table><br/>
					<table cellpadding='0' cellspacing='0' style='border:0px;'>
					 <tr>
					  <td style='padding:5px;'><form method='post' action='kategorien.php' id='shop'>
							<input class='button' type='submit' id='shop' name='back' value='".MLS_LAN_KORB_5."' />
							</form></td>
						<td style='padding:5px;'><form method='post' action='".e_SELF."' id='lose'>
							<input class='button' type='submit' id='lose' name='lose' value='".MLS_LAN_KORB_6."' onclick=\"return jsconfirm('".MLS_LAN_KORB_8."')\"/>
							</form></td>
					 	<td style='padding:5px;'><form method='post' action='korb_user.php' id='vor'>
							<input class='button' type='submit' id='vor' name='back' value='".MLS_LAN_KORB_7."' />
							</form></td>
					 </tr>
					</table>
					";
	}
else
	{
	$text="<div style='text-align:center'><br/><br/><br/>
	<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/warenkorb_leer.gif'><br/><br/>".MLS_LAN_KORB_9."";
	}
$text.="<br/><br/>";
$text.=powered_by_shop();
$text.="<br/><br/>";
$title = caption_pfad($row['mls_category_id']);

if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

$ns -> tablerender($title, $text);
// ========= End of the BODY ===================================================
require_once(FOOTERF);
///======================================================
function caption_pfad($kat_id)
{
$Ausgabe="<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php'>".MLS_LAN_KORB_10."</a>";	
$Ausgabe.=" >> ".MLS_LAN_KORB_14."";
return $Ausgabe;
}
///++++++++++++++++++++++++++++++++++++++++++++
function number_chose($number, $max)
{
$Ausgabe="<select name='anzal' size='1' style='width:50px;font-size:9pt;' onChange='this.form.submit()'>";
for($i=1; $i < $max; $i++)
		{
		$Ausgabe.="<option ";
		if($i==$number)
			{
			$Ausgabe.="selected ";
			}
		$Ausgabe.="value='".$i."'>";
		$Ausgabe.="".$i."</option>";
		}
$Ausgabe.="</select>";
return $Ausgabe;
}
////////////////////////////
function produkttable_caption()
{
return "<tr>
					<td class='fcaption' style='width:5%;text-align:center;border-right:0px'>".MLS_LAN_KORB_11."</td>
					<td class='fcaption' style='width:50%;text-align:center;border-left:0px;border-right:0px'>".MLS_LAN_KORB_12."</td>
					<td class='fcaption' style='width:5%;text-align:center;border-left:0px;border-right:0px'>&nbsp;</td>
					<td class='fcaption' style='text-align:center;border-left:0px;border-right:0px'>".MLS_LAN_KORB_13."</td>
					<td class='fcaption' style='width:5%;text-align:center;border-left:0px;'>&nbsp;</td>
				</tr>";
}
///////////////////////////
function produkttable($Produktlist,$counter)
{
$AUSGABE="";
$TABLE_ROW_CLASS[0]="class='forumheader'";
$TABLE_ROW_CLASS[1]="class='forumheader2'";
$ImageDELETE['PFAD']="".e_PLUGIN.PLUG_FOLDER."images/banlist_16.png";
for($i=0; $i < $counter; $i++)
	{$Zeile=($i%2);
$AUSGABE.="<form method='post' action='".e_SELF."' id='editform_".$i."'>		
				<tr>
					<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:left;border-bottom:0px;border-right:0px'>".($i+1)."</td>
					<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'>
							<a href='".e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$Produktlist[$i]['mls_products_id']."'>".$Produktlist[$i]['mls_products_name']."</a></td>
					<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'>";
	$AUSGABE.=number_chose($Produktlist[$i]['mls_temp_anzahl'], $Produktlist[$i]['mls_products_lager']);
	$AUSGABE.="</td>
					<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:right;border-bottom:0px;border-left:0px;border-right:0px'> x ";
	$AUSGABE.=$Produktlist[$i]['EinzPriseBrutto'];// Einzeln Preis inkl Steuer
	$AUSGABE.=	" ".$waerung_char.""; // Waehrung	
	$AUSGABE.=	" =";
	
	$AUSGABE.= $Produktlist[$i]['EndPriseBrutto']; //Einzeln Preis * Anzahl inkl Steuer
	$AUSGABE.=	" ".$waerung_char.""; // Waehrung	
	$AUSGABE.="</td>
					<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:center;border-bottom:0px;border-left:0px;'>
						<input type='hidden' name='T_ID' value='".$Produktlist[$i]['mls_temp_id']."'>
						<input type='image' title='".MLS_LAN_KORB_2."' name='delete[team_{$Produktlist[$i]['mls_temp_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".MLS_LAN_KORB_1." [".$Produktlist[$i]['mls_products_name']."] ?')\"/>
					</td>
				</tr></form>";
		}
return $AUSGABE;
}
//////////////////////////////////
function produkttable_summen($SummeBrutto,$Steuer_Summe)
{
return "<tr>
					<td style='text-align:right;border-top:5px double #444;' colspan='4'>".MLS_LAN_KORB_3."<b>".$SummeBrutto."".MLS_WAERUNG_CHAR."<br/>
																																							".MLS_LAN_KORB_4."".$Steuer_Summe."".MLS_WAERUNG_CHAR."</b>
					</td>
					<td style='text-align:right;border-top:5px double #444;'>&nbsp;</td>
				</tr>";	
}
?>