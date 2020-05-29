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

   $text = "<script type=\"text/javascript\" src=\"".e_PLUGIN.PLUG_FOLDER."handler/slider.js\" language=\"JavaScript1.2\"></script>
   					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
	$sub="";
$MY_MENU = kategorien_menu_listen($cat_ID,$sub);
$text .=$MY_MENU['text'];
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
	
	if (e_QUERY) {
	list($action,$action_id,$von) = explode(".", e_QUERY);
	$action_id = intval($action_id);
	$von = intval($action_id);
	unset($tmp);
}else{$action_id=0;$von=0;}
		
		
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
$text2['text']="";
$text2['status']=false;		
	for($i=0; $i< $counter;$i++ )
	     		{
	     		if($cat[$i]['parend']==0)
	     			{$text2['text'] .="<div class='forumheader2' style='cursor:pointer;font-size:100%' onClick=\"expandit('exp_nav_prod_".$cat[$i]['id']."')\">";}
	     		else{	     			
	     				$text2['text'] .="<div class='forumheader' style='cursor:pointer;font-size:100%' onClick=\"expandit('exp_nav_prod_".$cat[$i]['id']."')\">";
							}
					if($cat[$i]['count']==0)
						{
							$text2['text'] .=$Sub.$cat[$i]['name'];
						}
					else{
					$text2['text'] .=$Sub."<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$cat[$i]['id']."' title='".MLS_LAN_PROD_NAV_1."'>".$cat[$i]['name']."</a>";
						}
				//$text2['text'] .=" (".$cat[$i]['count'].")";
				
				
				$SUB_CATS=kategorien_menu_listen($cat[$i]['id'],$Sub);
				
				if($cat[$i]['id']==$action_id || $SUB_CATS['status']){
					$text2['text'] .="</div><div id='exp_nav_prod_".$cat[$i]['id']."' style=''>";
					$text2['status']=true;
					}
				else{
					$text2['text'] .="</div><div id='exp_nav_prod_".$cat[$i]['id']."' style='".$expand_autohide."'>";
					}
				$text2['text'].=$SUB_CATS['text'];
				$text2['text'].="</div>";
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
