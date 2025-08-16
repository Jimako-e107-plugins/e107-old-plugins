<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!defined('JOIN_ADMIN') or !preg_match("/admin.php\?SaveConfig/i", $_SERVER['REQUEST_URI'])) {
    die ("Access denied.");
}

$mailto = mysql_real_escape_string($_POST['mailto']);
$sendmail = intval($_POST['sendmail']);
$mustregister = intval($_POST['mustregister']);
$linkmembers = intval($_POST['linkmembers']);
$jointext = mysql_real_escape_string($_POST['jointext']);
$newspecialprivs = mysql_real_escape_string($_POST['newspecialprivs']);

if (!isset($pref['plug_installed']['clanmembers'])) $linkmembers = 0;

	$sql->db_Update("clan_joinus_config", "mailto='$mailto', sendmail='$sendmail', mustregister='$mustregister', linkmembers='$linkmembers', jointext='$jointext', specialprivs='$newspecialprivs'");

	$ns->tablerender(_JOINUS, "<center><br />"._CONFIGSUC."</center>");
	
	header("Refresh:1;URL=admin.php?Config");
	
	
	
?>