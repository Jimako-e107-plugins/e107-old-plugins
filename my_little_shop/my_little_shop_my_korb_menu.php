<?
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
|		$Source: ../e107_plugins/my_little_shop/my_little_shop_my_korb_menu.php $
|		$Revision: 1.00 $
|		$Date: 2009/04/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once(e_PLUGIN."my_little_shop/handler/constanten.php");
require_once("handler/form_handler.php");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/MLS_korb_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/MLS_korb_menu_lan.php");
////////+++++++++++++++++++++++++++++++++++++++++
$Korb_time= MLS_KORB_TEMP_TIME;
$waerung_char=MLS_LAN_KORB_MENU_0;
global $tp;

$MAX_DAT= time()-$Korb_time;
///// abgelaufene Artiklen werden im TEMP_Korb automatisch gelöscht!!!
$sql -> db_Delete("mls_temp", "mls_temp_date < '".$MAX_DAT."' ");

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
 $Produktlist[$counter]['mls_products_text']=$row['mls_products_text']; 
 $counter++;
 }
///////++++++++++++++++++++++++++++++++++++++++++
if($counter > 0)
	{$SummeNetto=0.00;
	 $SummeBrutto=0.00;
	$text="<div style='text-align:center'>
					<table cellpadding='0' cellspacing='0' width='100%'>";
$text.="<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/wz_tooltip.js\"></script>";
$TABLE_ROW_CLASS[0]="class='forumheader'";
$TABLE_ROW_CLASS[1]="class='forumheader2'";

for($i=0; $i < $counter; $i++)
		{
	$Zeile=($i%2);
	$Produktlist[$i]['EndPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),0.00);
	$Produktlist[$i]['EndPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),$Produktlist[$i]['mls_steuer_wert']);
	$Produktlist[$i]['EinzPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']), 0.00);
	$Produktlist[$i]['EinzPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']),$Produktlist[$i]['mls_steuer_wert']);
	$SummeNetto=$SummeNetto+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']);
	$SummeBrutto=($SummeBrutto+(((($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])/100)*$Produktlist[$i]['mls_steuer_wert'])+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])));
	$Produktlist[$i]['kurz_name']= $tp->html_truncate($Produktlist[$i]['mls_products_name'], MLS_KORB_PROD_CHARS, "<strong>..</strong>");
	//$Tool_Desc="<b>".$Produktlist[$i]['mls_products_text']."<\/b><br\/><font style=\"font-size:80%;\">".($tp->toHTML($Produktlist[$i]['mls_products_text'], TRUE))."<\/font>";
	$Tool_Desc=$Produktlist[$i]['mls_products_name'];
	$Tool_Tip_Text="<table border=\'0\' cellspacing=\'0\'><tr><td style=\'text-align:right;background:#fff;\'><img src=".e_PLUGIN.PLUG_FOLDER."produkt_images/".$Produktlist[$i]['mls_products_image']." width=150 /><\/td><\/tr><tr><td style=\'text-align:right;background:#fff;\'>".$Tool_Desc."<\/td><\/tr><\/table>";	
	$text.="	<tr> 
							<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'>".$Produktlist[$i]['mls_temp_anzahl']." x ";
							
	$text.="<a href=\"".e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$Produktlist[$i]['mls_products_id']."\" onmouseover=\"Tip('$Tool_Tip_Text', TITLE, 'Vorschau', WIDTH, 150, SHADOW, false, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true, TITLEBGCOLOR, '#000', TITLEFONTCOLOR, '#fff', BGCOLOR, '#fff', BORDERCOLOR, '#000')\" onmouseout=\"UnTip()\" > ".$Produktlist[$i]['kurz_name']."";
										
	$text.="</td>
							<td ".$TABLE_ROW_CLASS[$Zeile]." style='text-align:right;border-bottom:0px;border-left:0px;border-right:0px'> = ".$Produktlist[$i]['EndPriseBrutto']."".$waerung_char."</td>
						</tr>";
		}		
	$SummeNetto=to_prise($SummeNetto, 0.00);
	$SummeBrutto=to_prise($SummeBrutto, 0.00);
	$text.="
						<tr>
							<td style='text-align:right;border-top:5px double #444;' colspan='2'><b>".$SummeBrutto."".$waerung_char."</b></td>
						</tr>
					</table>
				</div>
					";
	$title="<a href='".e_PLUGIN.PLUG_FOLDER."sites/korb.php?list'>".MLS_LAN_KORB_MENU_2."</a>";
	}
else{
$title=MLS_LAN_KORB_MENU_4;
$text="<div style='text-align:center'>
	<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/warenkorb_leer.gif'><br/><br/>".MLS_LAN_KORB_MENU_3."<br/><br/>
</div>
";
}
$ns -> tablerender($title, $text);
///==================================================
///==================================================	

?>
