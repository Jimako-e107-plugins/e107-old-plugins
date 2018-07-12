<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');
$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = ECLASSF_A2;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_cat']['text'] = ECLASSF_A3;
$var['admin_cat']['link'] = 'admin_cat.php';

$var['admin_sub']['text'] = ECLASSF_A4;
$var['admin_sub']['link'] = 'admin_sub.php';

$var['admin_submit']['text'] = ECLASSF_A5;
$var['admin_submit']['link'] = 'admin_submit.php';

$var['admin_purge']['text'] = ECLASSF_A101;
$var['admin_purge']['link'] = 'admin_purge.php';

$var['admin_imag']['text'] = ECLASSF_A103;
$var['admin_imag']['link'] = 'admin_imag.php';

$var['admin_readme']['text'] = ECLASSF_A137;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = ECLASSF_A121;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(ECLASSF_A1, $action, $var);
?>