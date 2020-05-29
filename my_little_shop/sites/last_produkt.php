<?php 
/*
+---------------------------------------------------------------+
|		***russe*** (www.e107.4xa.de) 28.05.2009
|		sorce: ../../my_little_shop/sites/last_produkt.php
|
|		for the e107 website system
|		â©steve dunstan
|		http://e107.org
|		jalist@e107.org
|
|		released under the terms and conditions of the
|		gnu general public license (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
require_once("../handler/constanten.php");
//require_once("../templates/categorie_table.php");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produktlist_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produktlist_lan.php");
require_once(HEADERF);
////if(!getperms("p")){ header("location:".e_base."index.php"); exit; }
require_once(e_PLUGIN.PLUG_FOLDER."handler/form_handler.php");

$cat_pro_zeile=MLS_CAT_PRO_ROW;
$coc_pro_zeile=MLS_PROD_PRO_ROW;
$COCT_PROSEITE=MLS_PROD_PRO_SITE;
$zeile_breite=intval(100 / $cat_pro_zeile);
$zeile_breite2=intval(100 / $coc_pro_zeile);
// ------------------------------
//////////////////////////////////////////////////////////////////
$text = "<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/import/scroll_main15.js\" language=\"javascript1.2\"></script>
		 <script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."import/wz_tooltip.js\"></script>
		 <div style=\"text-align:center\">\n\n";
//$text .=  $tp->toHTML($pref['my_little_shop_begruesung'], TRUE);
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$text .= "<table class='' style='margin-left:auto;margin-right:auto;width:98%' cellspacing='3' cellpadding='3'>";
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$MLS_SQL =& new db;
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$qry ="
 SELECT a.*, b.*, c.* FROM #mls_products AS a
 LEFT JOIN #mls_category AS b on b.mls_category_id=a.mls_products_category_id
 LEFT JOIN #mls_steuer AS c on c.mls_steuer_id=b.mls_category_steuer_id
 WHERE a.mls_products_name !='' AND a.mls_products_enable='1'
 ORDER BY a.mls_products_id DESC
 LIMIT ".$COCT_PROSEITE."
 ";
$MLS_SQL->db_Select_gen($qry);

if(MLS_PROD_KARD_OR_LIST==2)
{
$coc_pro_zeile=1;
}
$zeilen_count=0;
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
while($MLS_prod_row = $MLS_SQL-> db_Fetch()){
	if($MLS_prod_row['mls_products_image']==""){$MLS_prod_row['mls_products_image']="default.jpg";}
	if($my_koc_count==$coc_pro_zeile){$text .= "</tr><tr>";	$my_koc_count=0;}
		$Zeile=($zeilen_count%2);
		$zeilen_count++;
		$my_koc_count++;
	if(MLS_PROD_KARD_OR_LIST==1)
		{
		$text .= "<td class='' style='width:".$zeile_breite2."%;text-align:left;vertical-align:top;'>";
		$text .= get_lastproduktkarte($MLS_prod_row['mls_products_id'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$MLS_prod_row['mls_products_image'],e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$MLS_prod_row['mls_products_id'],$MLS_prod_row['mls_products_name'],$MLS_prod_row['mls_products_text'],$MLS_prod_row['mls_products_price'],$MLS_prod_row['mls_steuer_wert'],100);
		$text .= "</td>";
		}
else{
		$text .= get_lastproduktrow($MLS_prod_row['mls_products_id'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$MLS_prod_row['mls_products_image'],e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$MLS_prod_row['mls_products_id'],$MLS_prod_row['mls_products_name'],$MLS_prod_row['mls_products_text'],$MLS_prod_row['mls_products_price'],$MLS_prod_row['mls_steuer_wert'],70,$Zeile);
		}
	}
$text .= "</tr>";
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$text .= "</table></div>";
$title="Neuste Produkte in Shop";
$ns->tablerender($title,$text);
require_once(FOOTERF);
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
function get_lastproduktkarte($id,$image,$link,$name,$desc,$prise,$steuer,$size)
{
global $tp;
$Prise_inkl=to_prise($prise, $steuer);
$AT=$tp->toHTML($desc, TRUE);
$desc_text =$tp->html_truncate($AT, 60, " <a href='produkt.php?.".$id."'><strong>...</strong></a>");
$ausgabe="<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%;height:150px;'>
	<tr>
		<td class='forumheader2' colspan='2' style='heigt:15px;'>
			<font style='font-size:125%;font-weigt:bold;'>
				<a href='".$link."'>".$name."</a>
			</font>
		".(ADMIN? " 
		<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?edit.".$id."'>
		<img src='".e_PLUGIN.PLUG_FOLDER."images/edit_16.png' style='border:0px;' /></a>":"")."
		</td>	
	</tr>
	<tr>
		<td class='forumheader3' rowspan='2' style='width:30%;text-align:left;vertical-align:top;border-right:0px;'>
			<a href='".$link."'>
				<img src='".$image."' style='width:".$size."px;border:0px;'/>
			</a>
		</td>
		<td class='forumheader3' style='width:70%;text-align:right;vertical-align:top;border-left:0px;border-bottom:0px;'>
			".$desc_text."<br/>
		</td>	
	</tr>
	<tr>
		<td class='forumheader3' style='width:30%;text-align:left;vertical-align:bottom;border-left:0px;border-top:0px;'>
			<table class='' style='margin-left:auto;margin-right:auto;width:100%;height:100%;'>
				<tr>
					<td style='text-align:left;vertical-align:bottom;border-left:0px;border-top:0px;'>
						<font style='font-size:150%;color:#BB0000;font-weigt:bold;'>".$Prise_inkl.MLS_WAERUNG_CHAR." </font><br/>
						<font style='font-size:70%;'> inkl ".$steuer." % St.</font>
					</td>
					<td style='text-align:right;vertical-align:top;border-left:0px;border-top:0px;'>
						".kauf_button_last($id)."
					</td>
				</tr>
			</table>		
		</td>	
	</tr>
</table>";

return $ausgabe;
}
//////////////////////////////////////////////////////////////////
function get_lastproduktrow($id,$image,$link,$name,$desc,$prise,$steuer,$size,$row_class)
{
global $tp;
$Prise_inkl=to_prise($prise, $steuer);
$AT=$tp->toHTML($desc, TRUE);
$TABLE2_ROW_CLASS[0]="forumheader";
$TABLE2_ROW_CLASS[1]="forumheader2";
$desc_text =$tp->html_truncate($AT, 80, " <a href='produkt.php?.".$id."'><strong>...</strong></a>");
$ausgabe="
		<td class='".$TABLE2_ROW_CLASS[$row_class]."' style='text-align:left;vertical-align:top;border-right:0px;'>
			<a href='".$link."'>
				<img src='".$image."' style='width:".$size."px;border:0px;'/>
			</a>
		</td>
		<td class='".$TABLE2_ROW_CLASS[$row_class]."' style='text-align:left;vertical-align:top;border-right:0px;border-left:0px;'>
			<font style='font-size:125%;font-weigt:bold;'>
				<a href='".$link."'>".$name."</a></font>
				".(ADMIN? "     <a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?edit.".$id."'>
													<img src='".e_PLUGIN.PLUG_FOLDER."images/edit_16.png' style='border:0px;' />
												</a>
				":"")."
			<br/>
			".$desc_text."
		</td>
		<td class='".$TABLE2_ROW_CLASS[$row_class]."' style='text-align:left;vertical-align:top;border-right:0px;border-left:0px;'>
			<font style='font-size:150%;color:#BB0000;font-weigt:bold;'>".$Prise_inkl.MLS_WAERUNG_CHAR." </font><br/>
			<font style='font-size:70%;'> inkl ".$steuer." % St.</font>
		</td>
		<td class='".$TABLE2_ROW_CLASS[$row_class]."' style='text-align:left;vertical-align:top;border-left:0px;'>
					".kauf_button_last($id)."
		</td>";

return $ausgabe;
}
//////////////////////////////////////////////////////////////////
function kauf_button_last($id)
{
$button_text="<a href='korb.php?new.".$id."'><img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/korb.png'></a>";
return $button_text;
}
?>
