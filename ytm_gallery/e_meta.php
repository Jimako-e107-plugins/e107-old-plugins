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

if (!defined('e107_INIT')) { exit; }

echo "<script type='text/javascript' src='".e_PLUGIN."ytm_gallery/scripts/check.js'></script>\n";

//rating
echo "<script type='text/javascript' src='".e_PLUGIN."ytm_gallery/scripts/behavior.js'></script>\n";
echo "<script type='text/javascript' src='".e_PLUGIN."ytm_gallery/scripts/rating.js'></script>\n";
echo "<link rel='stylesheet' type='text/css' href='".e_PLUGIN."ytm_gallery/css/rating.css' />";
?>
