<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "faq/languages/admin/" . e_LANGUAGE . ".php");

$faq_qry = explode(".", e_QUERY);
$faq_qry = $faq_qry[0];

$faq_action = basename($_SERVER['PHP_SELF'], ".php") . $faq_qry;

if ($faq_qry == "info" || $faq_qry == "edit" || $faq_qry == "delparent")
{
    $faq_action = "admin_config";
}

$var['admin_settings']['text'] = FAQ_PREFLAN_08;
$var['admin_settings']['link'] = "admin_settings.php";

$var['admin_config']['text'] = FAQ_PREFLAN_05;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_configadd']['text'] = FAQ_PREFLAN_06;
$var['admin_configadd']['link'] = "admin_config.php?add";

$var['admin_configsub']['text'] = FAQ_PREFLAN_07;
$var['admin_configsub']['link'] = "admin_config.php?sub";

$var['admin_approve']['text'] = FAQ_ADLAN_97;
$var['admin_approve']['link'] = "admin_approve.php";

$var['admin_readme']['text'] = FAQ_ADLAN_140;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = FAQ_PREFLAN_11;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(FAQ_PREFLAN_04, $faq_action, $var);

?>