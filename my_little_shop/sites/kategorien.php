<?php 
/*
+---------------------------------------------------------------+
|		***russe*** (www.e107.4xa.de) 28.05.2009
|		sorce: ../../my_little_shop/sites/kategorien.php
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
require_once("../templates/categorie_table.php");
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
$fields = count($fieldname);
if (e_QUERY) {
	list($action,$action_id,$von) = explode(".", e_QUERY);
	$action_id = intval($action_id);
	$von = intval($action_id);
	unset($tmp);
}else{$action_id=0;$von=0;}
$parase= e_SELF."?".$action.".".$action_id;
//////////////////////////////////////////////////////////////////
if(isset($_POST['kauf']))
{
$PROD_ID=$_POST['ID'];
$sql -> db_Select("mls_temp","*","mls_temp_user_ip ='".USERIP."' AND mls_temp_products_id='".$PROD_ID."'");
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
	$inputstr="'', '".USERIP."', '".$PROD_ID."', '1', '".$Dat."'";	
	$sql -> db_Insert("mls_temp", "0, ".$inputstr." ");	
	$inputstr="'', '".USERIP."', '".$PROD_ID."', '1'";
	}
///$text="<meta http-equiv='refresh' content='0;URL=korb.php?list'>";
}
//////////////////////////////////////////////////////////////////
$text = "<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/import/scroll_main15.js\" language=\"javascript1.2\"></script>
		 <script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."import/wz_tooltip.js\"></script><div style=\"text-align:center\">\n\n";
		 
if($action_id!=0){
$text .= category_infos($action_id,e_PLUGIN.PLUG_FOLDER."categorie_images/");
}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$qry_rows ="
 SELECT COUNT(b.mls_products_id) AS b_count, a.* FROM #mls_category AS a
 LEFT JOIN #mls_products AS b on b.mls_products_category_id=a.mls_category_id
 WHERE a.mls_category_name !='' AND a.mls_category_enable='1' AND a.mls_parend_category_id='".$action_id."'
 GROUP BY a.mls_category_id
 ORDER BY a.mls_category_name
 ";
$sql->db_Select_gen($qry_rows);
$sub_cat = $sql->db_rows();
if($sub_cat >0)
{
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$text .= "
<table class='' style='margin-left:auto;margin-right:auto;width:98%'>
	<tr>
		<td class='fcaption' colspan='".$cat_pro_zeile."'>
		Unterkategorien.
		</td>
	</tr>
	<tr>";
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$my_kat_count=0;
$qry ="
 SELECT COUNT(b.mls_products_id) AS b_count, a.* FROM #mls_category AS a
 LEFT JOIN #mls_products AS b on b.mls_products_category_id=a.mls_category_id
 WHERE a.mls_category_name !='' AND a.mls_category_enable='1' AND a.mls_parend_category_id='".$action_id."'
 GROUP BY a.mls_category_id
 ORDER BY a.mls_category_name
 ";
$sql->db_Select_gen($qry);
while($row = $sql-> db_Fetch()){
if($my_kat_count==$cat_pro_zeile)
		{
		$text .= "</tr><tr>";	$my_kat_count=0;
		}
$my_kat_count++;
$text .= "<td class='' style='width:".$zeile_breite."%;text-align:left;vertical-align:top;'>";
$text .= get_kat_image(e_PLUGIN.PLUG_FOLDER.KAT_IMAGE_FOLDER.$row['mls_category_image'],e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$row['mls_category_id'],$row['mls_category_name'],150);
$text .=" ( ".$row['b_count']."  )";
$text .= "</td>";
	}
$text .= "</tr></table>";	
}

$text .= "<table class='' style='margin-left:auto;margin-right:auto;width:98%' cellspacing='3' cellpadding='3'>";
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sorty = $_GET['sort'];
if($sorty==""){
	$cockt_max = $COCT_PROSEITE;
	$cockt_von = 0;
	}else{
		$qs = explode(".", $sorty);
		$cockt_von = intval($qs[0]);
		$cockt_max = intval($qs[1]);
		}
$my_koc_count=0;
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$qry_rows ="
 SELECT a.*, b.*, c.* FROM #mls_products AS a
 LEFT JOIN #mls_category AS b on b.mls_category_id=a.mls_products_category_id
 LEFT JOIN #mls_steuer AS c on c.mls_steuer_id=b.mls_category_steuer_id
 WHERE a.mls_products_name !='' AND a.mls_products_enable='1' AND a.mls_products_category_id='".$action_id."'
 ORDER BY a.mls_products_name
 ";
    $sql->db_Select_gen($qry_rows);
    $found = $sql->db_rows();
if($found >0)
{
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(MLS_PROD_KARD_OR_LIST==1)
		{
		$text .= "<table class='' style='margin-left:auto;margin-right:auto;width:98%' cellspacing='3' cellpadding='3'>
								<tr>
									<td class='fcaption' colspan='".$cat_pro_zeile."'>
										Produkte in der Kategorie:(".$found.")
									</td>
								</tr><tr>";
		}
else{
	$text .= "<table class='' style='margin-left:auto;margin-right:auto;width:98%' cellspacing='0' cellpadding='0'>
							<tr>
								<td class='fcaption' colspan='4'>
									Produkte in der Kategorie:(".$found.")
								</td>
							</tr><tr>";
		}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$qry ="
 SELECT a.*, b.*, c.* FROM #mls_products AS a
 LEFT JOIN #mls_category AS b on b.mls_category_id=a.mls_products_category_id
 LEFT JOIN #mls_steuer AS c on c.mls_steuer_id=b.mls_category_steuer_id
 WHERE a.mls_products_name !='' AND a.mls_products_enable='1' AND a.mls_products_category_id='".$action_id."'
 ORDER BY a.mls_products_name
 LIMIT ".$cockt_von.",".$cockt_max."
 ";
$sql->db_Select_gen($qry);

if(MLS_PROD_KARD_OR_LIST==2)
{
$coc_pro_zeile=1;
}

$zeilen_count=0;
while($row = $sql-> db_Fetch()){
	if($row['mls_products_image']==""){$row['mls_products_image']="default.jpg";}
	if($my_koc_count==$coc_pro_zeile)
		{
		$text .= "</tr><tr>";	$my_koc_count=0;
		}
$Zeile=($zeilen_count%2);
$zeilen_count++;
$my_koc_count++;

	if(MLS_PROD_KARD_OR_LIST==1)
		{
		$type=MLS_PROD_KARD_TYP;	
		$text .= "<td class='' style='width:".$zeile_breite2."%;text-align:left;vertical-align:top;'>";
		$text .= get_produktkarte($row['mls_products_id'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$row['mls_products_image'],e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$row['mls_products_id'],$row['mls_products_name'],$row['mls_products_text'],$row['mls_products_price'],$row['mls_steuer_wert'],100,$type);
		$text .= "</td>";
		}
else{
		$text .= get_produktrow($row['mls_products_id'],e_PLUGIN.PLUG_FOLDER.PRODUCT_IMAGE_FOLDER.$row['mls_products_image'],e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$row['mls_products_id'],$row['mls_products_name'],$row['mls_products_text'],$row['mls_products_price'],$row['mls_steuer_wert'],70,$Zeile);
		}
	}
$text .= "</tr>";
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	}
$text .= "</table>";
$psort = 'sort=[FROM].'.$cockt_max;
$parase .= ".&".$psort;
if($found > $COCT_PROSEITE){
    $parms = $found.",".$cockt_max.",".$cockt_von.",".$parase;
    $text .="<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
   }

$title=get_nav_link($action_id);

$ns->tablerender($title, $text);
require_once(FOOTERF);
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
function Get_Kat_Image($image,$link,$name,$size)
{
return "<a href='".$link."'><img src='".$image."' style='width:".$size."px;border:0px;'/></a><br/><a href='".$link."'>".$name."</a>";
}
//////////////////////////////////////////////////////////////////
function get_produktkarte($id,$image,$link,$name,$desc,$prise,$steuer,$size,$type)
{
global $tp;
$Prise_inkl=to_prise($prise, $steuer);
$AT=$tp->toHTML($desc, TRUE);
$desc_text =$tp->html_truncate($AT, 60, " <a href='produkt.php?.".$id."'><strong>...</strong></a>");

if($type=="1")
{
$ausgabe="<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%;height:150px;'>
	<tr>
		<td class='forumheader2' colspan='2' style='heigt:15px;'><a href='".$link."'>".$name."</a>".(ADMIN? "     <a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?edit.".$id."'><img src='".e_PLUGIN.PLUG_FOLDER."images/edit_16.png' style='border:0px;' /></a>":"")."
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
						".kauf_button_self($id)."
					</td>
				</tr>
			</table>		
		</td>	
	</tr>
</table>";
}
else{
$name2 =$tp->html_truncate($name, 15, " <strong>...</strong>");
$ausgabe="<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%;height:150px;'>
	<tr>
		<td class='forumheader' style='vertical-align:top;'>
			<a href='".$link."' title='".$name."'>".$name2."</a>".(ADMIN? "     <a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produktliste.php?edit.".$id."'><img src='".e_PLUGIN.PLUG_FOLDER."images/edit_16.png' style='border:0px;' /></a>":"")."
			<div style='text-align:center;'>
			<a href='".$link."'>
				<img src='".$image."' style='width:".$size."px;border:0px;'/>
			</a></div><div style='text-align:right;'>
			<font style='font-size:100%;color:#BB0000;font-weigt:bold;'>".$Prise_inkl.MLS_WAERUNG_CHAR." </font><br/>
			<font style='font-size:70%;'> inkl ".$steuer." % St.</font></div>
		</td>
	</tr>
</table>";

}
return $ausgabe;
}
//////////////////////////////////////////////////////////////////
function get_produktrow($id,$image,$link,$name,$desc,$prise,$steuer,$size,$row_class)
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
			<font style='font-size:115%;font-weigt:bold;'>
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
					".kauf_button_self($id)."
		</td>";

return $ausgabe;
}
//////////////////////////////////////////////////////////////////
function get_nav_link($id)
{
global $sql;
$ausgabe="<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.0'>root</a>";
$sql->db_Select("mls_category", "*", "mls_category_id ='".$id."' limit 1");
if($row = $sql->db_Fetch())
	{
		$ausgabe=get_nav_link($row['mls_parend_category_id']);
		$ausgabe.="->";	
		$ausgabe.="<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$row['mls_category_id']."'>".$row['mls_category_name']."</a>";	
	}
return $ausgabe;
}
////////////////////////////////////////
function category_infos($id,$folder)
{
global $sql;
$qry ="
 SELECT COUNT(b.mls_products_id) AS b_count, a.* FROM #mls_category AS a
 LEFT JOIN #mls_products AS b on b.mls_products_category_id=a.mls_category_id
 WHERE a.mls_category_name !='' AND a.mls_category_id='".$id."'
 GROUP BY a.mls_category_name
 ";
$sql->db_Select_gen($qry);
while($row = $sql-> db_Fetch()){
$Ausgabe = "
<table class='' cellpadding='0' cellspacing='0'  style='width:98%'>
	<tr>
		<td class='fcaption' style='width:120px;border-right:0px;'>
			<img src='".$folder.$row['mls_category_image']."' style='width:120px;border:0px;'/>
		</td>
		<td class='fcaption' style='border-left:0px;vertical-align:top;text-align:left;'>
			Hier sehen Sie alle unsere Produkte in der Kategorie <b>\"".$row['mls_category_name']."\"</b><br/>
			Anzahl der Produkte:  ".$row['b_count']."
		</td>
	</tr>
</table>	
	";}
return $Ausgabe;
}
function kauf_button($id)
{
$button_text="<a href='korb.php?new.".$id."'><img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/korb.png'></a>";
return $button_text;
}
function kauf_button_self($id)
{
$button_text="
<form method='post' action='".e_SELF."?".e_QUERY."' id='to_korb_".$id."'>
<input type='image' title='".TO_KORB_LAN."' id='kauf[".$id."]' name='kauf[".$id."]' style='vertical-align: middle' src='".e_PLUGIN.PLUG_FOLDER."images/korb.png'>
<input type='hidden' name='ID' value='".$id."'>
</form>";
return $button_text;
}
?>
