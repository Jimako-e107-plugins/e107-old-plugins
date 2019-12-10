<?php
if (!defined('e107_INIT')) { exit; }
 
e107::lan('creative_writer', true);

class creative_writer_dashboard // include plugin-folder in the name.
{
	private $title; // dynamic title.
	
	function chart()
	{
		return false;
	}
	
	function status() // Status Panel in the admin area
	{
    $count = e107::getDb()->count("cw_book", "(*)", "where cw_book_approved = '1'");
    
		$var[0]['icon'] 	= "<img src='".e_PLUGIN."creative_writer/images/cwriter_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[0]['title'] 	= CWRITER_A74;
		$var[0]['url']		= e_PLUGIN."creative_writer/admin_config.php?mode=book&action=list";
		$var[0]['total'] 	= $count;
 
    $cwriter_where = "WHERE cw_challenge_starttime = '' OR cw_challenge_starttime < ".time();
    $count = e107::getDb()->count("cw_challenge", "(*)", $cwriter_where);
    
		$var[1]['icon'] 	= "<img src='".e_PLUGIN."creative_writer/images/challenge_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[1]['title'] 	= LAN_CWRITER_A011;
		$var[1]['url']		= e_PLUGIN."creative_writer/admin_config.php?mode=challenge&action=list";
		$var[1]['total'] 	= $count;
    
    $cwriter_where = "WHERE cw_challenge_starttime >= ".time();
    $count = e107::getDb()->count("cw_challenge", "(*)", $cwriter_where);
    
		$var[2]['icon'] 	= "<img src='".e_PLUGIN."creative_writer/images/challenge_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[2]['title'] 	= LAN_CWRITER_A012;
		$var[2]['url']		= e_PLUGIN."creative_writer/admin_config.php?mode=challenge&action=list";
		$var[2]['total'] 	= $count;
    
		return $var;
	}	
	
	
	function latest() // Latest panel in the admin area.
	{
	  $submitted_words = e107::getDb()->count("cw_book", "(*)", "where cw_book_approved = '0'");
	  
		$var[0]['icon'] 	= "<img src='".e_PLUGIN."creative_writer/images/cwriter_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />";
		$var[0]['title'] 	= CWRITER_A73;
		$var[0]['url']		= e_PLUGIN."creative_writer/admin_config.php?mode=submitted&action=list";

		$var[0]['total'] 	= $submitted_words;

		return $var;
	}	
	
	
}
?>