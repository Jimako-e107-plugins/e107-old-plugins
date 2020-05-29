<?php
/*
+---------------------------------------------------------------+
|        EMS v1.0 - by iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
global $ems_shortcodes;
$Kartei_zeilen=3;
if($pref['ems_burt']){$Kartei_zeilen++;}
if($pref['ems_dat']){$Kartei_zeilen++;}
$EMS_SHORT_TEMPLATE = "
	<td class='fcaption' style='vertical-align:top;text-align:left;padding:2px;'>
	<table style='width:100%;font-size:80%;'>
		<tr>
			<td rowspan='".$Kartei_zeilen."' style='width:70px;text-align:center;padding:2px;padding-left:3px;'>{USER_PHOTO}</td>
			<td class='' style='width:80%;text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_143."</font> <b>{USER_NAME_LINK}</b>&nbsp;&nbsp;&nbsp;&nbsp;({USER_TAB_COUNT})</td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_144."</font> {USER_NAMERICH}</td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_145."</font> {USER_ID} {USER_STATUS}</td>
		</tr>";
if($pref['ems_burt']){
$EMS_SHORT_TEMPLATE .= "		
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_151."</font> {USER_BURTSDAY} / {USER_ALTER}</td>
		</tr>";}
		if($pref['ems_dat']){
$EMS_SHORT_TEMPLATE .= "
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_147."</font> {USER_DATA_VON}</td>
		</tr>";}
$EMS_SHORT_TEMPLATE .= "
		<tr>
			<td colspan='2' style='width:100%;text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>mail:</font> {USER_EMAIL}</td>
		</tr>";
if($pref['ems_dat']){
$EMS_SHORT_TEMPLATE .= "		
		<tr>
			<td colspan='2' style='width:100%;text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".EMS_146."</font> {USER_JOIN}</td>
		</tr>";
	}
$EMS_SHORT_TEMPLATE .= "</table></td>";
?>