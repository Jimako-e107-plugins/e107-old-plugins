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
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?Mod/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}
?>
<script type="text/javascript">
	var suredelapp = "<?php echo _SUREDELAPP;?>";
	var errordelapp = "<?php echo _ERRORDELAPP;?>";
	var incfile = "<?php echo ($incfile !=""?$incfile:"admin");?>";
</script>
<script type="text/javascript" src="includes/apps.js"></script>
<?php	
$rows = $sql->db_Count("clan_applications");
$text = "<center><table><tr><td>";
if($rows > 0){
	$text .= "<table class='fborder'>
				<tr>
					<td class='forumheader2'><b>"._NAME."</b></td>
					<td class='forumheader2'><b>"._DATE."</b></td>
					<td class='forumheader2'><b></b></td>
				</tr>";
		$sql->db_Select("clan_applications", "*", "ORDER BY date ASC", "");
		while($row = $sql->db_Fetch()){
			$aid = $row['aid'];
			$username = $row['username'];
			$appdate = $row['date'];
			$text .= "<tr id='app$aid'>
						<td class='forumheader3'><a href=\"".($incfile !=""?$incfile:"admin").".php?App&aid=$aid\">$username</a></td>
						<td class='forumheader3'>".date("j M Y", $appdate)."</td>
						<td class='forumheader3'><input type='button' class='button' value='"._DEL."' onclick=\"DelApp($aid);\" /></td>
					</tr>";
		}
	$text .= "</table>";
}else{
	$text .= _NOAPPS;
}
$text .= "</td></tr></table>";

$ns->tablerender(_APPS, $text);
?>