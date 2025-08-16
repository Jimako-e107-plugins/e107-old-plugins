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
if (!(defined('CHAL_ADMIN') && preg_match("/admin.php/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('CHAL_MOD') && preg_match("/challengeus.php\?Mod/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}
?>
<style type="text/css">
	.pointer{
		cursor: pointer;
	}
</style>
<script type="text/javascript">
	var incfile = "<?php echo ($incfile !=""?$incfile:"admin");?>";
	var suredelchal = "<?php echo _SUREDELCHAL;?>";
	var errordelchal = "<?php echo _ERRORDELCHAL;?>";
</script>
<script type="text/javascript" src="includes/challenge.js"></script>
<?php	
$rows = $sql->db_Count("clan_challenges");
$text = "<center><table><tr><td>";
if($rows > 0){
	$sql1 = new db;
	$text .= "<table class='fborder'>
				<tr>
					<td class='forumheader2'><b>"._CHABY."</b></td>
					<td class='forumheader2'><b>"._CLANNAME."</b></td>
					<td class='forumheader2'><b>"._GAME."</b></td>
					<td class='forumheader2'><b>"._MATCHDATE."</b></td>
					<td class='forumheader2'><b>"._CHAON."</b></td>
					<td class='forumheader2'><b></b></td>
				</tr>";
		$sql->db_Select("clan_challenges", "*", "ORDER BY date ASC", "");
		while($row = $sql->db_Fetch()){
			$cid = $row['cid'];
			$username = $row['username'];
			$clanname = $row['clanname'];
			$game = $row['game'];
			$chdate = $row['chdate'];
			$chtime = $row['chtime'];
			$date = $row['date'];
			$link = "onclick=\"window.location='".($incfile !=""?$incfile:"admin").".php?Challenge&cid=$cid'\"";
			$text .= "<tr id='chal$cid' class='pointer'>
						<td class='forumheader3' $link>$username</td>
						<td class='forumheader3' $link>$clanname</td>
						<td class='forumheader3' $link>";
						if(intval($game) > 0 && $conf['linkwars']){
							$sql1->db_Select("clan_games", "gname", "gid='$game'");
							$row = $sql1->db_Fetch();
							$text .= $row['gname'];
						}else{
							$text .= $game;
						}
						$text .= "</td>
						<td class='forumheader3' $link>".date("j M Y H:i", $chdate)."</td>
						<td class='forumheader3' $link>".date("j M Y", $date)."</td>
						<td class='forumheader3'><input type='button' class='button pointer' value='"._DEL."' onclick=\"DelChallenge($cid);\" /></td>
					</tr>";
		}
	$text .= "</table>";
}else{
	$text .= _NOCHAS;
}
$text .= "</td></tr></table>";

$ns->tablerender(_CHALLS, $text);
?>