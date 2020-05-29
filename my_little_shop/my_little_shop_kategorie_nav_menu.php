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
|		$Source: ../e107_plugins/my_little_shop/my_little_shop_kategorie_nav_menu.php $
|		$Revision: 1.00 $
|		$Date: 2009/04/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
define("PLUG_FOLDER", "my_little_shop/");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produkt_kat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produkt_kat_lan.php");

if(e_QUERY)
	{
	list($cat_ID, $typ, $sort) = explode(".", e_QUERY);
	$cat_ID = intval($cat_ID);
	$typ = intval($typ);
	$sort = intval($sort);
	unset($tmp);
	}


if(!$_GET['cat_ID'])
{
$cat_ID=0;
}
else{$cat_ID=$_GET['cat_ID'];}


$table_total2 = $sql -> db_Select("mls_category", "*", "mls_category_name !=''");			
if($table_total2)
  {
  	
$activ[0]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_rot.gif'>";
$activ[1]="<img border='0' src='".e_PLUGIN.PLUG_FOLDER."images/ampel_gruen.gif'>";
$counter=0;

   $text = "<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/Scroll_main15.js\" language=\"JavaScript1.2\"></script>
   					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
	$sub="";
$text .= kategorien_menu_listen($cat_ID,$sub);

      $text .= "</table></div>";
}


	$caption = "<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php'>".MLS_LAN_PROD_NAV_0."(";
	$caption .= zaehler2("mls_category", " mls_category_name!='' AND mls_category_enable='1'");
	$caption .= ")</a>";
	$ns -> tablerender($caption, $text, 'shopnav');
///==================================================
function kategorien_menu_listen($cat_ID, $Sub){
		global $pref,$key,$sql,$user_pref;$_POST;
		$expand_autohide = "display:none; ";
		$Sub .="&nbsp;&nbsp;";
		$counter=0;
		if($sql -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='".$cat_ID."' ORDER BY mls_category_name"))
        { 
        	$sql -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='".$cat_ID."' ORDER BY mls_category_name");
        	while($row = $sql-> db_Fetch()){
		  				if(!$row['mls_category_enable']){continue;}
							$cat[$counter]['id']=$row['mls_category_id'];
							$cat[$counter]['parend']=$row['mls_parend_category_id'];
							if($cat[$counter]['parend']=='0'){$cat[$counter]['name']="<b>".$row['mls_category_name']."</b>";}
							else{$cat[$counter]['name']=$row['mls_category_name'];}
							$cat[$counter]['text']=$row['mls_category_text'];
							if(!$row['mls_category_enable']){$cat[$counter]['enable']='0';}
							else{$cat[$counter]['enable']='1';}
							$cat[$counter]['image']=$row['mls_category_image'];
							$cat[$counter]['count']= zaehler2("mls_products",  "mls_products_category_id ='".$cat[$counter]['id']."' AND mls_products_enable='1'");
							$cat[$counter]['count2']= zaehler2("mls_category", " mls_parend_category_id='".$cat[$counter]['id']."'");
							$counter++;
						}
			
$LIST_TYP = "2";
$LIST_PRO_SEITE = "10";
			for($i=0; $i< $counter;$i++ )
	     		{
	     		$text2 .="<div class='forumheader' style='cursor:pointer;font-size:100%' onclick=\"expandit('exp_nav_prod_".$cat[$i]['id']."')\">";
					if($cat[$i]['count']==0)
						{
							$text2 .=$cat[$i]['name'];
						}
					else{
					$text2 .=$Sub."<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$cat[$i]['id']."' title='".MLS_LAN_PROD_NAV_1."'>".$cat[$i]['name']."</a>";
						}
				$text2 .=" (".$cat[$i]['count'].")";
				
				$text2 .="</div><div id='exp_nav_prod_".$cat[$i]['id']."' style='".$expand_autohide."'>";
				$text2 .=kategorien_menu_listen($cat[$i]['id'],$Sub);
				$text2 .="</div>";
				}
		return 	$text2;
   }else return "";
	}
///==================================================	
function zaehler2($tab_name, $query){
	$c=0;
	global $pref,$key,$sql2,$user_pref;$_POST;
	$sql2 -> db_Select($tab_name, "*", $query);
  while($row = $sql2-> db_Fetch()){
				$c++;
				}
	return $c;
	}
///==================================================	

?>
