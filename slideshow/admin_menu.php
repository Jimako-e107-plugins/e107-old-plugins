<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }
require_once(e_ADMIN.'auth.php');
include_lan(e_PLUGIN.'slideshow/languages/'.e_LANGUAGE.'.php');
global $action;

$action = basename($_SERVER['PHP_SELF'], ".php");

		if ($action == "") 
		{
			$action = "main";
		}
		
		$var['main']['text'] = SLIDESHOW_29;
		$var['main']['link'] = "admin_slideshow.php";

		$var['create']['text'] = SLIDESHOW_30;
		$var['create']['link'] = "admin_slideshow.php?create";

		$var['conf']['text'] = "Config";
		$var['conf']['link'] = "admin_config.php";

		/*
		$var['cat']['text'] = DOWLAN_31;
		$var['cat']['link'] = e_SELF."?cat";
		$var['cat']['perm'] = "Q";

		$var['opt']['text'] = LAN_OPTIONS;
		$var['opt']['link'] = e_SELF."?opt";

		$var['limits']['text'] = DOWLAN_112;
		$var['limits']['link'] = e_SELF."?limits";

		$var['mirror']['text'] = DOWLAN_128;
		$var['mirror']['link'] = e_SELF."?mirror";
		
		$var['prune']['text'] = DOWLAN_201;
		$var['prune']['link'] = e_SELF."?prune";
		*/
		//show_admin_menu(DOWLAN_32, $action, $var);

		show_admin_menu("Slideshow menu", $action, $var);
?>