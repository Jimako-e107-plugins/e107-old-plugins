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

global $ems_shortcodes, $pref;


$EMS_SHORT_TEMPLATE = "

<tr>
	<td class='forumheader3' style='width:2%'>{USER_ICON_LINK}</td>
	<td class='forumheader'  style='width:20%'>{USER_NAME_LINK}</td>";
    
    if($pref['ems_usrn']){
   $EMS_SHORT_TEMPLATE .= "<td class='forumheader3' style='width:20%'>{USER_NAMERICH}</td> ";
    }	
	    if($pref['ems_email']){
    $EMS_SHORT_TEMPLATE .= "<td class='forumheader3' style='width:20%'>{USER_EMAIL}</td> ";
    }
  	    if($pref['ems_dat']){
    $EMS_SHORT_TEMPLATE .= "<td class='forumheader3' style='width:20%'>{USER_DATA_VON}-{USER_DATA_BIS}</td> ";
    }   
    
    $EMS_SHORT_TEMPLATE .= "
	<td class='forumheader3' style='width:20%'>{USER_JOIN}</td>
</tr>
";

?>