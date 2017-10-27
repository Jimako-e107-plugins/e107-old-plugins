<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

	$helptitle  = LOCATOR_ADMIN_HELP_00;

	$helpcapt[] = LOCATOR_ADMIN_HELP_01;
	$helptext[] = LOCATOR_ADMIN_HELP_02;

	$helpcapt[] = LOCATOR_ADMIN_HELP_03;
	$helptext[] = LOCATOR_ADMIN_HELP_04;

	$helpcapt[] = LOCATOR_ADMIN_HELP_05;
	$helptext[] = LOCATOR_ADMIN_HELP_06;

	$helpcapt[] = LOCATOR_ADMIN_HELP_07;
	$helptext[] = LOCATOR_ADMIN_HELP_08;

	$helpcapt[] = LOCATOR_ADMIN_HELP_90;
	$helptext[] = LOCATOR_ADMIN_HELP_91;

	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .= "<b>".$helpcapt[$i]."</b><br />";
	   $text2 .= $helptext[$i]."<br /><br />";
	};

   $ns -> tablerender($helptitle, $text2);
?>