<?php

include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . "_helpdesk_admin.php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = HDU_A30;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_mail']['text'] = HDU_A106;
$var['admin_mail']['link'] = "admin_mail.php";

$var['admin_colour']['text'] = HDU_A32;
$var['admin_colour']['link'] = "admin_colour.php";

$var['admin_desk']['text'] = HDU_A140;
$var['admin_desk']['link'] = "admin_desk.php";

$var['admin_cat']['text'] = HDU_A31;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_res']['text'] = HDU_A43;
$var['admin_res']['link'] = "admin_res.php";

$var['admin_fixes']['text'] = HDU_A44;
$var['admin_fixes']['link'] = "admin_fixes.php";

$var['admin_readme']['text'] = HDU_A352;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = HDU_A500;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(HDU_A33, $action, $var);
?>