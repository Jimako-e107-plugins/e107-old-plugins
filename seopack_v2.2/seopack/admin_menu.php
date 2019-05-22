<?php

if (!defined('e107_INIT')) { exit; }



	$action = (e_QUERY) ? e_QUERY : "list";
    $var['list']['text'] = SEOPACK_MENU_L1;
	$var['list']['link'] = e_SELF;

    $var['robot']['text'] = SEOPACK_MENU_L2 ;
	$var['robot']['link'] = e_SELF."?robot";

    $var['spider']['text'] = SEOPACK_MENU_L22 ;
	$var['spider']['link'] = e_SELF."?spider";
	
    $var['keywords']['text'] = SEOPACK_MENU_L34 ;
	$var['keywords']['link'] = e_SELF."?keywords";	
	
    $var['sef']['text'] = SEOPACK_MENU_L3 ;
	$var['sef']['link'] = e_SELF."?sef";
	
	$var['help']['text'] = SEOPACK_MENU_L4 ;
	$var['help']['link'] = e_SELF."?help";
	
	show_admin_menu(SEOPACK_MENU_L5, $action, $var);


?>