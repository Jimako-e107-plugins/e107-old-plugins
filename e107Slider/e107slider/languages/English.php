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

/* PLUGIN LANGUAGES */

define(ES_PLUGIN_1, 'e107Slider');
define(ES_PLUGIN_2, 'Settings saved successfully!');
define(ES_PLUGIN_3, 'Save settings');
define(ES_PLUGIN_4, 'e107 Image Slider');
define(ES_PLUGIN_5, 'e107 News Slider');
define(ES_PLUGIN_6, 'e107Slider Plugin');

/*admin_menu.php*/
define(ES_PLUGIN_MU_1, 'Image Slider');
define(ES_PLUGIN_MU_2, 'News Slider');
define(ES_PLUGIN_MU_3, 'Slider Settings');
define(ES_PLUGIN_MU_4, 'Plugin Details');
define(ES_PLUGIN_MU_5, 'Vanilla Theme');
define(ES_PLUGIN_MU_6, '<p>Build an unlimited number of unique sites with the most powerful e107 theme on the market!</p><p><a href="http://www.xenthemes.com/product/e107/vanilla/">View Vanilla Theme Details</a></p>');

/*admin_slider_settings.php*/
define(ES_PLUGIN_SS_1, 'Slider Settings');
define(ES_PLUGIN_SS_2, 'Auto-start slider:');
define(ES_PLUGIN_SS_3, 'Transition speed:');
define(ES_PLUGIN_SS_4, 'Pause Time:');
define(ES_PLUGIN_SS_5, 'Display pager:');
define(ES_PLUGIN_SS_6, 'Display controls:');
define(ES_PLUGIN_SS_7, 'Display slides randomly:');
define(ES_PLUGIN_SS_8, 'Pause on hover:');
define(ES_PLUGIN_SS_9, 'Pause on control hover');
define(ES_PLUGIN_SS_10, 'ID');
define(ES_PLUGIN_SS_11, 'Caption');
define(ES_PLUGIN_SS_12, 'Image');
define(ES_PLUGIN_SS_13, 'Link');
define(ES_PLUGIN_SS_14, 'Options');
define(ES_PLUGIN_SS_15, 'Number of posts to display:');
define(ES_PLUGIN_SS_16, 'Menu caption:');
define(ES_PLUGIN_SS_17, 'Add a Slide');

/*admin_slider.php*/
define(ES_PLUGIN_SL_1, 'Edit A Slide');
define(ES_PLUGIN_SL_2, 'Add Slides');
define(ES_PLUGIN_SL_3, 'Title<span class="smalltext">Optional</span>');
define(ES_PLUGIN_SL_4, 'Caption<span class="smalltext">Optional</span>');
define(ES_PLUGIN_SL_5, 'Image');
define(ES_PLUGIN_SL_6, 'Link URL<span class="smalltext">Optional</span>');
define(ES_PLUGIN_SL_7, 'Apply changes');
define(ES_PLUGIN_SL_8, 'Submit');

/*plugin.php*/
define(ES_PLUGIN_PL_2, 'Plugin Installed Successfully!');
define(ES_PLUGIN_PL_3, 'Plugin Updated Successfully!');

/*admin_config.php*/
define(ES_PLUGIN_CF_1, 'Plugin Details');
define(ES_PLUGIN_CF_2, 'The e107Slider Plugin is a lightweight responsive slider built using ResponsiveSlides.js. The plugin has 2 menus, an <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>image slider</a> and a <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>news slider</a>.');
define(ES_PLUGIN_CF_3, 'ResponsiveSlides.js is a tiny jQuery plugin that creates a responsive slider using list items inside &#60;ul&#62;. It works with wide range of browsers including all IE versions from IE6 and up. It also adds css max-width support for IE6 and other browsers that don\'t natively support it. Its only dependency is that <strong>all the images are the same size</strong>.');
define(ES_PLUGIN_CF_4, 'The biggest difference to other responsive slider plugins is the file size (1kb minified and gzipped).');
define(ES_PLUGIN_CF_5, 'Instructions');
define(ES_PLUGIN_CF_6, 'The Image Slider Menu displays image slides and an optional caption, slides can also be given a link. The menu has a number of settings which can be configured in the <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>Image Slider settings</a> page.');
define(ES_PLUGIN_CF_7, 'Add images to <code>e107_plugins/e107slider/slides/</code> then choose which image to use when you \'Add a Slide\'. <strong>Each image must be the same size</strong>. You can add an optional caption or create a link for each slide. Captions can contain HTML.');
define(ES_PLUGIN_CF_8, 'The News Slider Menu will display your latest news posts images and headline in a responsive slider. The slides are generated from the news items image which is set when you create a news item. <strong>Each image must be the same size</strong>. You can choose how many posts to display in the <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>News Slider settings</a> page.');
define(ES_PLUGIN_CF_9, 'Licence');