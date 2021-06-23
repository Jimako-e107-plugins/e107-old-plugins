<?php
/**
 *	e107 Links Page plugin
 *
 *	@package	e107_plugins
 *	@subpackage	links_page
 *	@version 	$Id$;
 */
 
if (!defined('e107_INIT')) { exit; }

//e107::lan('links_page');   /* FRONTEND */
e107::lan('links_page',true,true); /* ADMIN */

class links_page_frontpage // include plugin-folder in the name.
{
	function config()
	{
		$frontPage = array();
		$frontPage['title'] = LCLAN_PLUGIN_LAN_1;  
		$frontPage['page'][] = array('page' => '{e_PLUGIN}links_page/links', 'title' => LCLAN_PAGETITLE_1);

		return $frontPage;
	}
}


?>