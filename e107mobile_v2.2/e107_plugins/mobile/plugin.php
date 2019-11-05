<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

$eplug_name = "e107 Mobile";
$eplug_version = "2.2";
$eplug_author = "Martinj";
$eplug_folder = "mobile";
$eplug_url = "http://www.martinj.co.uk";
$eplug_email = "martinleeds@gmail.com";
$eplug_description = "This detects mobile browsers and overrides your e107 theme to suit the display. Change the look and feel of your mobile theme within the plugin.";
$eplug_compatible = "e107v0.7+";
$eplug_caption = "e107 Mobile";
$eplug_conffile = "admin_config.php";

$eplug_prefs = array(
	$eplug_folder."_active" => "true",
    $eplug_folder."_theme" => "e107mobile",
	$eplug_folder."_menu" => "0",
	$eplug_folder."_iphone" => "e107mobile",

	$eplug_folder."_linkStyle" => "#0076a3|#DFDFDF|1.0|3",
	$eplug_folder."_colourScheme" => "|#0076a3|#DFDFDF|1.3|0.8|100|100|off",
	$eplug_folder."_imgX" => "150",
	$eplug_folder."_imgY" => "250"
	);


$eplug_icon = "mobile/images/mobile_32.png";
$eplug_icon_small  = "mobile/images/mobile_16.png";
$eplug_caption     = 'e107 mobile phone optimisation';
$eplug_done = "Installation was Successful...";
$eplug_upgrade_done = "Upgrade was successful...";
$eplug_module = TRUE;

// Upgrade

// upgrade from 1.5
if($pref['plug_installed']['mobile']<'2') {
$upgrade_remove_prefs = array("mobile_img");
$upgrade_add_prefs = array (
					$eplug_folder."_theme" => "e107mobile",
					$eplug_folder."_active" => "true",
					$eplug_folder."_menu" => "0",
					$eplug_folder."_iphone" => "e107mobile",
					$eplug_folder."_linkStyle" => "#0076a3|#DFDFDF|1.0|2",
					$eplug_folder."_colourScheme" => "|#0076a3|#DFDFDF|1.3|0.8|100|100|off",
					$eplug_folder."_imgX" => "150",
					$eplug_folder."_imgY" => "250"
					);
}
elseif($pref['plug_installed']['mobile']<'2.2') {

}
?>