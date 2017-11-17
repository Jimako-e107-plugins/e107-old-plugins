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
if (!defined('JOIN_ADMIN') or !preg_match("/admin.php\?App/i", $_SERVER['REQUEST_URI'])) {
    die ("Access denied.");
}
?>
<script type="text/javascript">
	var suredelapp = "<?php echo _SUREDELAPP;?>";
	var errordelapp = "<?php echo _ERRORDELAPP;?>";
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
	$apply = $row['apply'];
	$conn = $row['conn'];
	$micro = $row['micro'];
	$extra = $row['extra'];
	$appdate = $row['date'];

if($micro == 1){
	$micro = _YES;
}else{
	$micro = _NO;
}
$dot = explode(",", $apply);
if($conf['linkmembers'] && intval($dot[0]) > 0){
	$games = $apply;
	$apply = "";
	foreach($dot as $game){
		$sql->db_Select("clan_games", "abbr, gname", "gid='$game'");
		$row = $sql->db_Fetch();
		$apply .= ($apply !=""?", ":"").($row['abbr'] !="" ? $row['abbr'] : $row['gname']);
	}
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
			<td class='forumheader2' nowrap><b>"._XFIRE.":</b> </td>
			<td class='forumheader3'><a href='http://www.xfire.com/profile/$xfire' target='_blank'>$xfire</a></td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._STEAM.":</b> </td>
			<td class='forumheader3'>$steam</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._MSN.":</b> </td>
			<td class='forumheader3'>$msn</td>
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
			<td class='forumheader2' nowrap><b>"._APPLYF.":</b> </td>
			<td class='forumheader3'>$apply</td>
		</tr>
		<tr>
			<td class='forumheader2' nowrap><b>"._CONNSPEED.":</b> </td>
			<td class='forumheader3'>$conn</td>	
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
	$text .= "<form action='../clanmembers/admin.php?Userlist' method='post'>
	<input type='hidden' value='$username' name='query' />
	<input type='hidden' value='$games' name='games' />	
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='submit' class='button' value='Add to Clan Members List' />&nbsp;";
}
$text .= "<input type='button' class='button' value='"._DELLAPP."' onclick=\"DelApp($aid);\" />&nbsp;<input type='button' class='button' value='"._JUGOBACK."' onclick=\"window.location='admin.php'\" />";
if($conf['linkmembers']) $text .= "</form>";
$text .= "</center>";

$ns->tablerender(_JOINAPP,$text);
?>