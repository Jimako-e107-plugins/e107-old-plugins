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
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php\?App/i", $_SERVER['REQUEST_URI'])) 
	&& 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?App/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}
?>
<script type="text/javascript">
	var suredelapp = "<?php echo _SUREDELAPP;?>";
	var errordelapp = "<?php echo _ERRORDELAPP;?>";
	var incfile = "<?php echo ($incfile !=""?$incfile:"admin");?>";
</script>
<script type="text/javascript" src="includes/app.js"></script>
<?php
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

if($micro == 1){
	$micro = _CSGO;
}else if ($micro == 2){
	$micro = _BF;
}else if ($micro == 3){
	$micro = _TITAN;
}else if ($micro == 4){
	$micro = _LOL;
}else if ($micro == 5){
	$micro = _COD;
}else{
	$micro = _ANDET;
}


$text = "<center><table class='fborder' width='300'>
		<tr>
			<td class='forumheader2' nowrap><b>"._NICK.":</b> </td>
			<td class='forumheader3'>$username</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._EMAIL.":</b> </td>
			<td class='forumheader3'><a href='mailto:$email'>$email</a></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._STEAM.":</b> </td>
			<td class='forumheader3'>$steam</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._CONNSPEED.":</b> </td>
			<td class='forumheader3'>$conn</td>	
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._AGE.":</b> </td>
			<td class='forumheader3'>$age</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._LOCATION.":</b> </td>
			<td class='forumheader3'>$location</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._PCLANS.": </b> </td>
			<td class='forumheader3'>$clans</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._MICRO.":</b> </td>
			<td class='forumheader3'>$micro</td>
		</tr>";

if($extra !=""){
$text .= "<tr>
		<td colspan='2' class='forumheader2'><b>"._EXTRAINFO.":</b></td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader3'>$extra</td>
	</tr>";
}
	
$text .= "</table><br /><br />";
if($conf['linkmembers']){
	$text .= "<input type='submit' class='button' value='Add to Clan Members List' onclick=\"window.location='".($incfile !=""?$incfile:"admin").".php?AddCM&aid=$aid'\" />&nbsp;";
}
$text .= "<input type='button' class='button' value='"._EDIT."' onclick=\"window.location='".($incfile !=""?$incfile:"admin").".php?EditApp&aid=$aid'\" />&nbsp;<input type='button' class='button' value='"._DEL."' onclick=\"DelApp($aid);\" />&nbsp;<input type='button' class='button' value='"._JUGOBACK."' onclick=\"window.location='".($incfile !=""?$incfile.".php?Mod":"admin.php")."'\" />";
$text .= "</center>";

$ns->tablerender(_JOINAPP,$text);
?>