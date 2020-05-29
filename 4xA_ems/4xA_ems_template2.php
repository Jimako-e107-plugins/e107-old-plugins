<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/ems_template2.php
| 	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
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
global $e4xA_ems_shortcodes;
$e4xA_EMS_SHORT_TEMPLATE = "
<td class='fcaption' style='vertical-align:top;text-align:left;padding:2px;'>
	({USER_TAB_COUNT}.)&nbsp;&nbsp;<font style='color:#888'>".e4xA_EMS_SYS_02.":</font> {USER_NAMERICH}
	<table style='width:100%;font-size:80%;'>
		<tr>
			<td rowspan='4' style='width:70px;text-align:center;padding:2px;padding-left:3px;'>{USER_PHOTO}</td>
			<td class='' style='width:80%;text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_EMS_SYS_01.":</font><b>&nbsp;{USER_NAME_LINK}</b></td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_EMS_SYS_05.":</font>&nbsp;{USER_STATUS}</td>
		</tr>		
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_EMS_SYS_06.":</font>&nbsp;{USER_BURTSDAY}{USER_ALTER}</td>
		</tr>		
		<tr>
			<td class=''  style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_EMS_SYS_07.":</font>&nbsp;{USER_JOIN}</td>
		</tr>
		<tr>
			<td colspan='2' style='width:100%;text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_EMS_SYS_08.":</font>&nbsp;{USER_EMAIL}</td>
		</tr>	
	</table>
</td>";
?>