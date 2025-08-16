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
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php\?EditApp/i", $_SERVER['REQUEST_URI'])) 
	&& 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?EditApp/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}

$aid = intval($_GET['aid']);
$sql->db_Select("clan_applications", "*", "aid='$aid'");
$row = $sql->db_Fetch();
	$username = $row['username'];
	$email = $row['email'];
	$xfire = $row['xfire'];
	$steam = $row['steam'];
	$msn = $row['msn'];
	$age = $row['age'];
	$location = $row['location'];
	$clans = $row['clans'];
	$conn = $row['conn'];
	$micro = $row['micro'];
	$extra = $row['extra'];
	$appdate = $row['date'];

$text = "<center>
	<form method='post' action='".($incfile !=""?$incfile:"admin").".php?SaveApp&amp;aid=$aid'>
	<table class='fborder' width='300'>
		<tr>
			<td class='forumheader2' nowrap><b>"._NICK.":</b> </td>
			<td class='forumheader3'><input type='text' value='$username' size='30' name='username' /></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._EMAIL.":</b> </td>
			<td class='forumheader3'><input type='text' value='$email' size='30' name='email' /></a></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._XFIRE.":</b> </td>
			<td class='forumheader3'><input type='text' value='$xfire' size='30' name='xfire' /></a></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._STEAM.":</b> </td>
			<td class='forumheader3'><input type='text' value='$steam' size='30' name='steam' /></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._CONNSPEED.":</b> </td>
			<td class='forumheader3'><input type='text' value='$conn' size='30' name='conn' /></td>	
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._MSN.":</b> </td>
			<td class='forumheader3'><input type='text' value='$msn' size='30' name='msn' /></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._AGE.":</b> </td>
			<td class='forumheader3'><input type='text' value='$age' size='30' name='age' /></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._LOCATION.":</b> </td>
			<td class='forumheader3'><input type='text' value='$location' size='30' name='location' /></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._PCLANS.": </b> </td>
			<td class='forumheader3'><input type='text' value='$clans' size='30' name='clans' /></td>
		</tr>
		
		<tr>
			<td class='forumheader2' nowrap><b>"._MICRO.":</b> </td>
			<td class='forumheader3'><select name='micro'>
				<option value='0'".($micro?"":" selected").">"._ANDET."</option>
				<option value='1'".($micro?" selected":"").">"._CSGO."</option>
				<option value='2'".($micro?"":" selected").">"._BF."</option>
				<option value='3'".($micro?"":" selected").">"._TITAN."</option>
				<option value='4'".($micro?"":" selected").">"._LOL."</option>
				<option value='5'".($micro?"":" selected").">"._COD."</option>
			<select></td>
		</tr>";

	
$text .= "</table><br /><br />";

$text .= "<input type='submit' class='button' value='"._SAVECHANGES."' />&nbsp;<input type='button' class='button' value='"._JUGOBACK."' onclick=\"window.location='".($incfile !=""?$incfile.".php?Mod":"admin.php")."?App&aid=$aid'\" />";
$text .= "<input type='hidden' name='e-token' value='".e_TOKEN."' />
</form></center>";

$ns->tablerender(_JOINAPP,$text);
?>