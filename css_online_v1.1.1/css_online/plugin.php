<?php
# $lan_file	= e_PLUGIN."css_online/languages/".e_LANGUAGE.".php";
# require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."css_online/languages/English.php"));


$eplug_name = "CSS online takeover";
$eplug_version = "1.0";
$eplug_author = "Daddy Cool";
$eplug_url = "http://e107educ.org";
$eplug_email = "david.coll@e107educ.org";
$eplug_description = 'Takeover of your CSS without changing the normal style.css file';
$eplug_compatible = "e107v0.7.6";
$eplug_compliant = true;

$eplug_folder = "css_online";
$eplug_menu_name = "css_online";
$eplug_conffile = "admin_prefs.php";
$eplug_module = true;
$eplug_icon = $eplug_folder."/css.jpg";
$eplug_icon_small = $eplug_folder."/css2.jpg";

$eplug_prefs = array(
"css_online_file" => '1'
);

$eplug_link_perms = 'admin';
$eplug_link = true;
$eplug_link_name = "Edit CSS styles";
$eplug_link_url = e_PLUGIN.$eplug_folder."/admin_prefs.php";

?>
