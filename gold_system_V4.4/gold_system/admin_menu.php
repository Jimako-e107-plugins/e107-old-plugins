<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
global $GOLD_PREF;
$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = ADLAN_GS_MM01;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_menset']['text'] = ADLAN_GS_MM08;
$var['admin_menset']['link'] = 'admin_menset.php';

$var['admin_forum']['text'] = ADLAN_GS_MM02;
$var['admin_forum']['link'] = 'admin_forum.php';

$var['admin_paypal']['text'] = ADLAN_GS_MM04;
$var['admin_paypal']['link'] = 'admin_paypal.php';

$var['admin_gold']['text'] = ADLAN_GS_MM05;
$var['admin_gold']['link'] = 'admin_gold.php';

$var['admin_bulk']['text'] = ADLAN_GS_MM10;
$var['admin_bulk']['link'] = 'admin_bulk.php';
if($GOLD_PREF['gold_pdftrans'] == 1)
{
$var['admin_arctrans']['text'] = ADLAN_GS_MM09;
$var['admin_arctrans']['link'] = 'admin_arctrans.php';
}
$var['admin_plugins']['text'] = ADLAN_GS_MM07;
$var['admin_plugins']['link'] = 'admin_plugins.php';

$var['admin_readme']['text'] = ADLAN_GS_MM90;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = ADLAN_GS_MM91;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(ADLAN_GS_MM92, $action, $var);

?>