<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!defined('CHAL_ADMIN') or !preg_match("/admin.php\?SaveConfig/i", $_SERVER['REQUEST_URI'])) {
    die ("Access denied.");
}

$mailto = mysql_real_escape_string($_POST['mailto']);
$sendmail = intval($_POST['sendmail']);
$mustregister = intval($_POST['mustregister']);
$linkwars = intval($_POST['linkwars']);
$textdanish = mysql_real_escape_string($_POST['textdanish']);
$textenglish = mysql_real_escape_string($_POST['textenglish']);
$format = mysql_real_escape_string($_POST['format1'])."/".mysql_real_escape_string($_POST['format2'])."/".mysql_real_escape_string($_POST['format3']);
$newspecialprivs = mysql_real_escape_string($_POST['newspecialprivs']);

if (!isset($pref['plug_installed']['clanwars'])) $linkwars = 0;

	$sql->db_Update("clan_challenge_config", "mailto='$mailto', sendmail='$sendmail', mustregister='$mustregister', linkwars='$linkwars', textdanish='$textdanish', textenglish='$textenglish', dateformat='$format', specialprivs='$newspecialprivs'");

	$ns->tablerender(_CHAUS, "<center><br />"._CONFIGSUC."</center>");
	
	header("Refresh:1;URL=admin.php?Config");
	
	
	
?>