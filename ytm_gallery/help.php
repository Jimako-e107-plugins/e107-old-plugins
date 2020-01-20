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

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");

// Get the admin page

$urlparts = explode("/", e_SELF);

      foreach($urlparts as $part) {$get_part = $part;}

$last_part = $get_part;


// Display the help for Main
if ($last_part == "admin_config.php") {
$text .= "<b>" . LAN_YTM_PREFS_28 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_8;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_17 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_9;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_44 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_PREFS_45;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_46 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_PREFS_48;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_18 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_10;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_19 . "</b>";
$text .= "<br />";
$text .= "" . LAN_YTM_HELP_11 . " " . LAN_YTM_PREFS_26 . "";
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_20 . "</b>";
$text .= "<br />";
$text .= "" . LAN_YTM_HELP_12 . " " . LAN_YTM_PREFS_27 . "";
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_PREFS_8 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_13;
}

// Display the help for Categories
elseif ($last_part == "admin_config_category.php") {
$text .= "<b>" . LAN_YTM_CAT_PREFS_0 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_28;
$text .= "<br /><br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/edit_16.png' border='0' />" . LAN_YTM_HELP_29 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' />" . LAN_YTM_HELP_30 . "</a>";
$text .= "<br />";
}

// Display the help for Movie Database
elseif ($last_part == "admin_config_movie.php") {
$text .= "<b>" . LAN_YTM_MOVIE_PREFS_8 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_1;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_MOVIE_PREFS_0 . "</b>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/help_active.gif' border='0' />" . LAN_YTM_HELP_2 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/content_16.png' border='0' />" . LAN_YTM_HELP_3 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/edit_16.png' border='0' />" . LAN_YTM_HELP_4 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' />" . LAN_YTM_HELP_5 . "</a>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/checkbox.gif' border='0' />" . LAN_YTM_HELP_6 . "</a>";
$text .= "<br /><br />" . LAN_YTM_HELP_15 . "";
$text .= "<br /><br />" . LAN_YTM_HELP_7 . "";
$text .= "<br /><br />" . LAN_YTM_HELP_14 . "";
}

// Display the help for Submitted
elseif ($last_part == "admin_config_submit.php") {
$text .= "<b>" . LAN_YTM_SUBM_PREFS_0 . "</b>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/content_16.png' border='0' />" . LAN_YTM_HELP_3 . "</a>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/approve.gif' border='0' />" . LAN_YTM_HELP_16 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' />" . LAN_YTM_HELP_5 . "</a>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/checkbox.gif' border='0' />" . LAN_YTM_HELP_6 . "</a>";
$text .= "<br /><br />" . LAN_YTM_HELP_15 . "";
$text .= "<br /><br />" . LAN_YTM_HELP_17 . "";
$text .= "<br /><br />" . LAN_YTM_HELP_14 . "";
}

// Display the help for Import Movies
elseif ($last_part == "admin_config_import.php") {
$text .= "<b>" . LAN_YTM_HELP_18 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_19;
$text .= "<br /><br />";
$text .= LAN_YTM_HELP_20;
$text .= "<br /><br />";
$text .= LAN_YTM_HELP_21;
$text .= "<br /><br />";
$text .= LAN_YTM_HELP_22;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_HELP_23 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_24;
$text .= "<br /><br />";
$text .= "<b>" . LAN_YTM_HELP_25. "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_26;
$text .= "<br /><br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/content_16.png' border='0' />" . LAN_YTM_HELP_3 . "</a>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/approve.gif' border='0' />" . LAN_YTM_HELP_27 . "</a>";
$text .= "<br />";
$text .= "<img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' />" . LAN_YTM_HELP_5 . "</a>";
$text .= "<br />";
$text .= "<img src='".e_PLUGIN."ytm_gallery/images/checkbox.gif' border='0' />" . LAN_YTM_HELP_6 . "</a>";
}

// Display the help for Readme
elseif ($last_part == "admin_readme.php") {
$text .= "<b>" . LAN_YTM_PLUGIN . "</b>";
$text .= "<br />";
$text .= "" . LAN_YTM_HELP_32 . " " . LAN_YTM_PLUGIN_0 . ".";
$text .= "<br /><br />";
$text .= "" . LAN_YTM_HELP_33 . " <a href='mailto:info@erichradstake.nl?subject=Reaction YTM Gallery'>" . LAN_YTM_PLUGIN_2 . "</a>";
}

// Display the help for Update Check
elseif ($last_part == "admin_check_update.php") {
$text .= "<b>" . LAN_YTM_HELP_40 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_41;
}

// Display the help for Radstake News
elseif ($last_part == "admin_news.php") {
$text .= "<b>" . LAN_YTM_HELP_42 . "</b>";
$text .= "<br />";
$text .= LAN_YTM_HELP_43;
}


// Display message if something goes wrong
else {$text .= LAN_YTM_HELP_0;
}

$ns -> tablerender(LAN_YTM_HELP, $text);
?>
