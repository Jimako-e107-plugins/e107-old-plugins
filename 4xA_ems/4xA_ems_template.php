<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/ems_template.php
|	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
global $e4xA_ems_shortcodes, $pref;
$e4xA_EMS_SHORT_TEMPLATE = "
<tr>
	<td class='forumheader3' style='width:2%'>{USER_ICON_LINK}</td>
	<td class='forumheader'  style='width:20%'>{USER_NAME_LINK}</td>
	<td class='forumheader3' style='width:20%'>{USER_NAMERICH}</td>
	<td class='forumheader3' style='width:20%'>{USER_EMAIL}</td>
	<td class='forumheader3' style='width:20%'>{USER_STATUS}</td>
</tr>";
?>
