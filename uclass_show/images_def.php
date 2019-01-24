<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012 rev. 12 nov 2012 09.42
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."uclass_show/languages/".e_LANGUAGE.".php");
//Icone del plugin

//Lato Admin
$ico_warning = "<img src='".e_PLUGIN_ABS."uclass_show/images/ico_warning.png' style='vertical-align:middle' alt=''/>";
$ico_ucshow_on = "<img src='".e_PLUGIN."uclass_show/images/ico_ucshow_on.png' style='vertical-align:middle' alt=' '/>";
$ico_ucshow_off = "<img src='".e_PLUGIN."uclass_show/images/ico_ucshow_off.png' style='vertical-align:middle' alt='' />";
$ico_forum_active = "<img src='".e_PLUGIN."uclass_show/images/ico_forum_active.png' style='vertical-align:middle' alt='' />";
$ico_comment_active = "<img src='".e_PLUGIN."uclass_show/images/ico_comment_active.png' style='vertical-align:middle' alt='' />";
$ico_profile_active = "<img src='".e_PLUGIN."uclass_show/images/ico_profile_active.png' style='vertical-align:middle' alt='' />";
$ico_max_images = "<img src='".e_PLUGIN."uclass_show/images/ico_max_images.png' style='vertical-align:middle' alt='' />";
$ico_show_guest = "<img src='".e_PLUGIN."uclass_show/images/ico_show_guest.png' style='vertical-align:middle' alt='' />";
$ico_show_desc = "<img src='".e_PLUGIN."uclass_show/images/ico_show_desc.png' style='vertical-align:middle' alt='' />";
//upgrade 1.01 12 nov 12
$ico_custom_templates = "<img src='".e_PLUGIN."uclass_show/images/ico_custom_templates.png' style='vertical-align:middle' alt='' />";



?>