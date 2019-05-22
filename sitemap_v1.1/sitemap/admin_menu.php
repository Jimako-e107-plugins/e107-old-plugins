<?php

if (!defined('e107_INIT')) { exit; }



	$action = (e_QUERY) ? e_QUERY : "list";
    $var['list']['text'] = SITEMAP_MENU_L16;
	$var['list']['link'] = e_SELF;

    $var['new']['text'] = SITEMAP_MENU_L18 ;
	$var['new']['link'] = e_SELF."?new";

	$var['instructions']['text'] = SITEMAP_MENU_L17 ;
	$var['instructions']['link'] = e_SELF."?instructions";
	
	show_admin_menu(SITEMAP_MENU_L15, $action, $var);


?>