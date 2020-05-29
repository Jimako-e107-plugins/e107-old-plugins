<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Easy Admin Page by Cameron. (www.e107coders.org)
|        a part of Your_plugin v3.1  multilanguage by Juan  Reseau.li
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/
//		BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/admin_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."my_little_shop/languages/German/admin_menu_lan.php");

	$menutitle = MLS_ADMIN_MENU_LAN_0;//"Menu Title";

	$butname[] = "Hauptmenü";//"Hauptmenü";  
	$butlink[] = "admin_home.php";   
	$butid[] = "MLS_Home";       
	
	$butname[] = MLS_ADMIN_MENU_LAN_4;//"Kategorien";  
	$butlink[] = "admin_categorie.php";   
	$butid[] = "categorien";       

	$butname[] = "Produkte ohne Kat.";//"Kategorien";  
	$butlink[] = "admin_produkt_no_cat.php";   
	$butid[] = "ohne_kat";     

	$butname[] = MLS_ADMIN_MENU_LAN_1;//"Shop Voreinstellungen";
	$butlink[] = "admin_prefs.php"; 
	$butid[] = "prefs";         

	$butname[] = MLS_ADMIN_MENU_LAN_3;//"Hersteller";
	$butlink[] = "admin_hersteller.php"; 
	$butid[] = "hersteller";
	
	$butname[] = "Eigensch. Kat";//  
	$butlink[] = "admin_eigenschaften_kat.php";   
	$butid[] = "admin_eigenschaften_kat";
	
	$butname[] = "Eigenschaften";//  
	$butlink[] = "admin_eigenschaften.php";   
	$butid[] = "admin_eigenschaften";
	
	//$butname[] = "Produkt erstellen";//"Produkte";  
	//$butlink[] = "admin/admin_products.php";   
	//$butid[] = "prodikte";

	$butname[] = MLS_ADMIN_MENU_LAN_6;//"Lager- Bestand*";  
	$butlink[] = "admin_lagerbestand.php";   
	$butid[] = "lager";              

	$butname[] = MLS_ADMIN_MENU_LAN_7;//"Offene Aufträge*";  
	$butlink[] = "admin_auftraege_offen.php";   
	$butid[] = "auftraege_offen";   

	$butname[] = MLS_ADMIN_MENU_LAN_8;//"Bezahlte Aufträge*";  
	$butlink[] = "admin_auftraege_bezahlt.php";   
	$butid[] = "auftraege_bezahlt";   


	$butname[] = MLS_ADMIN_MENU_LAN_9;//"Kunden- Verwaltung*";  
	$butlink[] = "admin_kunde.php";
	$butid[] = "kunde";              

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);

if($pageid == "match"){
    $ns -> tablerender(MLS_ADMIN_MENU_LAN_0,plugin_selector());
}

?>
