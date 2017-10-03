<?php
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

class glossary_dashboard // include plugin-folder in the name.
{
	private $title; // dynamic title.
	
	function chart()
	{
		return false;
	}
	
	function status() // Status Panel in the admin area
	{
    $count = e107::getDb()->count("glossary", "(*)", "where glo_approved = '1'");
    
		$var[0]['icon'] 	= "<img src='".e_PLUGIN."glossary/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[0]['title'] 	= LAN_GLOSSARY_STATUS_01;
		$var[0]['url']		= e_PLUGIN."glossary/admin_config.php?mode=main&action=list";
		$var[0]['total'] 	= $count;

		return $var;
	}	
	
	
	function latest() // Latest panel in the admin area.
	{
	  $submitted_words = e107::getDb()->count("glossary", "(*)", "where glo_approved = '0'");
	  
		$var[0]['icon'] 	= "<img src='".e_PLUGIN."glossary/images/content_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[0]['title'] 	= LAN_GLOSSARY_LATEST_01;
		$var[0]['url']		= e_PLUGIN."glossary/admin_config.php?mode=submitted&action=list";
		$var[0]['total'] 	= $submitted_words;

		return $var;
	}	
	
	
}
?>