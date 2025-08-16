<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "pageear/languages/admin/" . e_LANGUAGE . ".php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = PAGEEAR_A8;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_campaign']['text'] = PAGEEAR_A21;
$var['admin_campaign']['link'] = "admin_campaign.php";

$var['admin_readme']['text'] = PAGEEAR_A6;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = PAGEEAR_A9;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(PAGEEAR_A1, $action, $var);

?>
