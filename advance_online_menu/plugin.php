<?php

$eplug_name = "Advance Online Menu";
$eplug_version = "1.1";

$eplug_author = "eleljrk";
$eplug_url = "http://jurksplanet.co.cc";
$eplug_folder = "advance_online_menu";
$eplug_email = "eleljrk@gmail.com";
$eplug_description = "This is an advanced online menu! Simply beutiful!";
$eplug_compatible = "e107: 0.7.xx (Tested version: 0.7.16)";
$eplug_readme = "admin_readme.php";
$eplug_compliant = TRUE;
$eplug_status = TRUE;

$eplug_done = "The Advanced Online Menu has been installed!";
$eplug_upgrade_done = "The Advanced Online Menu has been upgraded!";

$eplug_icon = $eplug_folder."/images/icon-32.png";
$eplug_icon_small = $eplug_folder."/images/icon-16.png";
$eplug_caption = "Configure the Advanced Online Menu";
$eplug_conffile = "admin_config.php";

$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = e_PLUGIN."";
$eplug_link_perms = "";

$eplug_prefs = array(
		"ao_menu_show_guests" => TRUE,
		"ao_menu_name" => "Online Menu",
		"aom_nm_l_n" => 5,
		"aom_lm_l_n" => 5,
		"aom_nm_s" => TRUE,
		"aom_lm_s" => TRUE,
		"aom_om_s" => TRUE,
		"aom_mm_s" => TRUE,
		"aom_seperator" => " | "
);
$eplug_table_names = array("");
$eplug_tables = array();
?>