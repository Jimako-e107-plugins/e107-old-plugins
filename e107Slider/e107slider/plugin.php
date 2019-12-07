<?php
/*
 * e107Slider Plugin
 *
 * Copyright (C) 2013 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 2 $
 * $Date: 24/04/2013 $
 * $Author: leonlloyd $
 *
*/

include_lan(e_PLUGIN."e107slider/languages/".e_LANGUAGE.".php");
$eplug_name = 'e107Slider';
$eplug_version = '0.2';
$eplug_author = 'Xen Themes';
$eplug_url = 'http://www.xenthemes.com/';
$eplug_email = 'support@xenthemes.com';
$eplug_description = 'Lightweight responsive slider menus for e107<br />Dual licensed under the <a href="'.e_PLUGIN.'e107slider/licence.txt">MIT or GPL Version 2</a> licenses';
$eplug_compatible = 'e107v1.0.1+';
$eplug_readme = $eplug_folder . 'readme.txt';
$eplug_folder = 'e107slider';
$eplug_menu_name = true;
$eplug_conffile = 'admin_config.php';
$eplug_icon = $eplug_folder . '/images/e107slider-logo-32.png';
$eplug_icon_small = $eplug_folder . '/images/e107slider-logo-16.png';
$eplug_caption = 'e107Slider';
$eplug_prefs = array(

'es_slider_title'=>'Featured',
'es_slider_auto'=>'true',
'es_slider_speed'=>'500',
'es_slider_timeout'=>'6000',
'es_slider_pager'=>'true',
'es_slider_nav'=>'true',
'es_slider_random'=>'false',
'es_slider_pause'=>'true',
'es_slider_pauseControls'=>'true',

'es_slider_news_title'=>'Latest News',
'es_slider_news_amount'=>'5',
'es_slider_news_auto'=>'true',
'es_slider_news_speed'=>'500',
'es_slider_news_timeout'=>'6000',
'es_slider_news_pager'=>'true',
'es_slider_news_nav'=>'true',
'es_slider_news_random'=>'false',
'es_slider_news_pause'=>'true',
'es_slider_news_pauseControls'=>'true'

);

$eplug_link = false;
$eplug_done = ES_PLUGIN_PL_2;

$eplug_table_names = array("e107slider");
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."e107slider (
   id int(11) unsigned NOT NULL auto_increment,
   caption text NOT NULL,
   image varchar(256) NOT NULL default '',
   link varchar(256) NOT NULL default '',
   PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=1;");

$eplug_upgrade_done = ES_PLUGIN_PL_3;

if (!function_exists('e107slider_uninstall'))
{
    function e107slider_uninstall()
    {
        global $sql;
        $sql->db_Delete('core', ' e107_name="e107slider" ');
    }
}

?>