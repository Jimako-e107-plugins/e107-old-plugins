<?php
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "classmembership/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "classmembership/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "classmembership/languages/admin/English.php");
} 
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = CLASSY_A4;
$var['admin_config']['link'] = "admin_config.php";

show_admin_menu(CLASSY_A1, $action, $var);

?>
