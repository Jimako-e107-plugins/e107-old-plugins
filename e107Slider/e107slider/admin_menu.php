<?php
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."e107slider/languages/".e_LANGUAGE.".php");

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = ES_PLUGIN_MU_4;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_slider_settings']['text'] = ES_PLUGIN_MU_1;
$var['admin_slider_settings']['link'] = 'admin_slider_settings.php';

$var['admin_news_slider_settings']['text'] = ES_PLUGIN_MU_2;
$var['admin_news_slider_settings']['link'] = 'admin_news_slider_settings.php';

show_admin_menu(ES_PLUGIN_MU_3, $action, $var);

$vanillatheme_text = "
   	<h3>".ES_PLUGIN_MU_5."</h3>
   	".ES_PLUGIN_MU_6."
   				
   			";
$ns->tablerender('', $vanillatheme_text);