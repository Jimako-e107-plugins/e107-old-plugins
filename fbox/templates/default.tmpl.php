<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: default.tmpl.php 669 2007-11-15 17:07:13Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
global $sc_style;
//can contain all shortcodes - the values of the current page item is used (required get_one=1)
    $FBOX_TEMPLATE_PRE = "";

//loop & style
    $sc_style['FBOX_IMG']['pre'] = "<div style='float: left; padding: 15px'>";
    $sc_style['FBOX_IMG']['post'] = "</div>";
    
    $sc_style['FBOX_TITLE']['pre'] = "<span style='text-decoration: underline; clear: both'>";
    $sc_style['FBOX_TITLE']['post'] = "</span><br /><br />";
    
    $FBOX_TEMPLATE = "{FBOX_TITLE}{FBOX_IMG}{FBOX_TEXT}";

//can contain all shortcodes - the values of the current page item is used (required get_one=1)
    $FBOX_TEMPLATE_POST = "";

//ajax navigation template
    $FBOX_TEMPLATE_NAV_PRE = "<div style='clear: both; text-align: right'>";
    $FBOX_TEMPLATE_NAV = "<a href='#' class='{FBOX_NAVCLASS}' id='fbox-nav-{FBOX_ID}' title='{FBOX_TITLE_NAV}' onclick=\"fboxSetActiveItem('fbox-cont', '{FBOX_AJAXURL}','".e_PLUGIN."fbox/fbox_ajax.php', this, '".FBOX_LODING."', '".e_PLUGIN."fbox/images/loading_16.gif'); return false;\">{FBOX_NUM}</a>";
    $FBOX_TEMPLATE_NAV_POST = "</div>";
    
//navigation separator
    $FBOX_TEMPLATE_NAVSEPARATOR = "&nbsp;&nbsp;|&nbsp;&nbsp;";
?>