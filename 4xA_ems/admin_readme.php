<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/admin_readme.php
| 	 Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|       ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if (!getperms("P"))
{
	header("location:".e_HTTP."index.php");
	exit;
}

$lan_file = e_PLUGIN."4xA_ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");

require_once(e_ADMIN."auth.php");

$caption = e4xA_EMS_HELP_CAP;

$text    = e4xA_EMS_HELP;

$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");

?>