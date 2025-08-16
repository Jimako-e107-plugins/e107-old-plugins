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
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php\?SaveApp/i", $_SERVER['REQUEST_URI'])) 
	&& 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?SaveApp/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}

$aid = intval($_GET['aid']);
$username = mysql_real_escape_string($_POST['username']);
$email = mysql_real_escape_string($_POST['email']);
$xfire = mysql_real_escape_string($_POST['xfire']);
$steam = mysql_real_escape_string($_POST['steam']);
$msn = mysql_real_escape_string($_POST['msn']);
$age = intval($_POST['age']);
$location = mysql_real_escape_string($_POST['location']);
$clans = mysql_real_escape_string($_POST['clans']);
$conn = mysql_real_escape_string($_POST['conn']);
$micro = intval($_POST['micro']);
$appdate = mysql_real_escape_string($_POST['date']);

$sql->db_Update("clan_applications", "username='$username', email='$email', xfire='$xfire', steam='$steam', msn='$msn', age='$age', location='$location', clans='$clans', conn='$conn', micro='$micro' WHERE aid='$aid'");

$ns->tablerender(_JOINAPP,"<center>"._CHANGESSAVED."</center>");
header("Refresh:1;url=".($incfile !=""?$incfile:"admin").".php?App&aid=$aid");
?>