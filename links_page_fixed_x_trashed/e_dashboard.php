<?php
/**
 *	e107 Links Page plugin
 *
 *	@package	e107_plugins
 *	@subpackage	links_page
 *	@version 	$Id$;
 */
 
if (!defined('e107_INIT')) { exit; }

e107::lan('links_page',true,true);

class links_page_dashboard // include plugin-folder in the name.
{
	function chart()
	{
		return false;
	}
	
	
	
	function status()
	{
		$db = e107::getDb();
		$alllinks = $db->count("links_page", "(*)", "WHERE link_active != 0 " );
		
		$var[0]['icon'] 	= "<img src='".e_PLUGIN_ABS."links_page/images/linkspage_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";
		$var[0]['title'] 	= LAN_LINKS_1;
		$var[0]['url']		= e_PLUGIN."links_page/admin_config.php?mode=main&action=list";
		$var[0]['total'] 	= $alllinks;
    
		$allcatlinks = $db->count("links_page_cat");
		
		$var[1]['icon'] 	= "<img src='".e_PLUGIN_ABS."links_page/images/linkspage_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";
		$var[1]['title'] 	= LCLAN_CAT_12;
		$var[1]['url']		= e_PLUGIN."links_page/admin_config.php?mode=cat&action=list";
		$var[1]['total'] 	= $allcatlinks;

		return $var;
	}	
  /* Just prepared */ 
	function latest()
	{
		$db = e107::getDb();
	  $submitted_links = $db->count("links_page", "(*)", "WHERE link_active = 0 " );
		
		$var[0]['icon'] 	= "<img src='".e_PLUGIN_ABS."links_page/images/linkspage_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";
		$var[0]['title'] 	= ADLAN_LAT_5;
		$var[0]['url']		= e_PLUGIN."links_page/admin_linkspage.php";
		$var[0]['total'] 	= ($submitted_links ? $submitted_links : 0);

		return $var;
	}	
}



?>