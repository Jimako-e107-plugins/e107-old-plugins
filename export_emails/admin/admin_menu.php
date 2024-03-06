<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN . 'export_emails/languages/' . e_LANGUAGE . '.php');
$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_export']['text'] = EE_ADMIN_MENU_02;
$var['admin_export']['link'] = 'admin_export.php';

$var['admin_config']['text'] = EE_ADMIN_MENU_03;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = EE_ADMIN_MENU_04;
$var['admin_readme']['link'] = 'admin_readme.php';

show_admin_menu(EE_ADMIN_MENU_01, $action, $var);
?>