<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "ytm_gallery/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "ytm_gallery/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "ytm_gallery/languages/English.php");
}
?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
      <title><?echo LAN_YTM_HELP_31;?></title>

<?
// get stylesheet, code used from header template e107
echo "<!-- *CSS* -->\n";

if (isset($eplug_css) && $eplug_css) {
	echo "\n<!-- eplug_css -->\n";
	echo "<link rel='stylesheet' href='{$eplug_css}' type='text/css' />\n";
}

echo "<!-- Theme css -->\n";
if(defined("PREVIEWTHEME")) {
	echo "<link rel='stylesheet' href='".PREVIEWTHEME."style.css' type='text/css' />\n";
} else {
	$css_default = "all";
	if (isset($theme_css_php) && $theme_css_php) {
		echo "<link rel='stylesheet' href='".THEME_ABS."theme-css.php' type='text/css' />\n";
	} else {
		if(isset($pref['themecss']) && $pref['themecss'] && file_exists(THEME.$pref['themecss']))
		{
			// Support for print and handheld media.
			if(file_exists(THEME."style_mobile.css")){
            	echo "<link rel='stylesheet' href='".THEME_ABS."style_mobile.css' type='text/css' media='handheld' />\n";
				$css_default = "screen";
			}
			if(file_exists(THEME."style_print.css")){
            	echo "<link rel='stylesheet' href='".THEME_ABS."style_print.css' type='text/css' media='print' />\n";
                $css_default = "screen";
			}
			echo "<link rel='stylesheet' href='".THEME_ABS."{$pref['themecss']}' type='text/css' media='{$css_default}' />\n";


		}
		else
		{
			// Support for print and handheld media.
			if(file_exists(THEME."style_mobile.css")){
            	echo "<link rel='stylesheet' href='".THEME_ABS."style_mobile.css' type='text/css' media='handheld' />\n";
                $css_default = "screen";
			}
			if(file_exists(THEME."style_print.css")){
            	echo "<link rel='stylesheet' href='".THEME_ABS."style_print.css' type='text/css' media='print' />\n";
                $css_default = "screen";
			}
			echo "<link rel='stylesheet' href='".THEME_ABS."style.css' type='text/css' media='{$css_default}' />\n";
		}
		if (!isset($no_core_css) || !$no_core_css) {
			echo "<link rel='stylesheet' href='".e_FILE_ABS."e107.css' type='text/css' />\n";
		}
	}
}
?>
</head>
<body>
<?
echo "<img src='".e_PLUGIN."ytm_gallery/images/icon_32.gif' border='0' />";
echo "<center>";
echo "<br /><br />";
echo "<b>" . LAN_YTM_HELP_36 . "</b>";
echo "<br />";
echo LAN_YTM_HELP_37;
echo "<br /><br />";
echo "<b>" . LAN_YTM_HELP_34 . "</b>";
echo "<br />";
echo LAN_YTM_HELP_35;
echo "<br /><br />";
echo "<b>" . LAN_YTM_HELP_38 . "</b>";
echo "<br />";
echo LAN_YTM_HELP_39;
echo "</center>";
?>
</body>
</html>
