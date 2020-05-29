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
	|		$Source: ../e107_plugins/my_little_shop/MLS_main_kategorien_navigation_menu.php $
	|		$Revision: 1.00 $
	|		$Date: 2009/04/26 $
	|		$Author: ***RuSsE*** $
	+---------------------------------------------------------------+
	*/
	if (!defined('e107_INIT')) { exit; }
	define("PLUG_FOLDER", "my_little_shop/");
	$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/produkt_kat_lan.php";
	require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/produkt_kat_lan.php");
	
	$table_total3 = $sql -> db_Select("mls_category", "*", "mls_category_name !=''");			
	if($table_total3)
	  {	
	$text = "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'><tr>";
	$text .= kategorien_menu_listen2();
	$text .= "</tr></table></div>";
	}
		$caption = "";
		$ns -> tablerender($caption, $text, 'shopnav');
	///==================================================
	function kategorien_menu_listen2()
		{
			global $sql2;
			$counter=0;
			if($sql2 -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='0' AND mls_category_enable='1' ORDER BY mls_category_name"))
	        { 
	        	$sql2 -> db_Select("mls_category", "*", "mls_category_name !='' AND mls_parend_category_id='0' AND mls_category_enable='1' ORDER BY mls_category_name");
	        	while($row = $sql2-> db_Fetch()){
			  				if(!$row['mls_category_enable']){continue;}
								$cat[$counter]['id']=$row['mls_category_id'];
								$cat[$counter]['name']=$row['mls_category_name'];
								$cat[$counter]['text']=$row['mls_category_text'];
								$counter++;
							}
		$AUSGABE="";
		for($i=0; $i< $counter;$i++ )
		     	{
		     	$AUSGABE .="<td class='forumheader2' style='cursor:pointer;font-size:100%'>";
					$AUSGABE .="<a href='".e_PLUGIN.PLUG_FOLDER."sites/kategorien.php?.".$cat[$i]['id']."'>".$cat[$i]['name']."</a>";
					$AUSGABE .="</td>";
					}		
			return 	$AUSGABE;
	   }else return "";
		}
	///==================================================	
	///==================================================	
	?>
