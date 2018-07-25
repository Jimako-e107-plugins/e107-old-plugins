<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}
include_once(e_PLUGIN."pviewgallery/templates/menu_template.php");
$Menu = new Menu;

require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

// ------------------------------------- e107 Cache -----------------------------------------------------------------------------

// gallery cache ON?
if ($PView->getPView_config("cacheON")) {

// Admins in ADMIN Mode get the uncached (fresh) view, cache will NOT changed/refreshed
	if (ADMIN && $PView -> getPView_config("admin_Mode")) {
		$pv_text = $Menu -> getMenuStats();
	} else {
		// prepare caching...
		$cache_tag = "nq_pview_menu";
		
		// get refresh interval
		// in AUTO Mode the returnvalue is 0
		$cacheInterval = $PView -> getPView_config("cacheInt") * 24 * 60;
		
		// See if the page is already in the cache
		if($cacheData = $e107cache->retrieve($cache_tag, $cacheInterval))
		{
			$pv_text = $cacheData;
		} 
		else 
		{
			$pv_text = $Menu -> getMenuStats();
			$e107cache->set($cache_tag, $pv_text);	// Save to cache: only the statmenu content
		}
	}
} else {
	// if cache is turned off, render page as usual
	$pv_text = $Menu -> getMenuStats();
}
// ------------------------------------- e107 Cache end -------------------------------------------------------------------------

$ns->tablerender(LAN_MENU_3, $pv_text,'pview');



?>