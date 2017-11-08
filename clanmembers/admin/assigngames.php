<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$games = $_POST['games'];

$text = "<form method='post' action='admin.php?assign&type=Games'>";	

if(count($games) == 0){
	header("Location: admin.php?games");
}

for($i=0;$i<count($games);$i++){
	$text .= "<input type='hidden' name='games[]' value='$games[$i]'>";
}

$result = $sql->db_Select_gen("SELECT u.user_name, i.userid from #clan_members_info i, #user u WHERE u.user_id=i.userid order by u.user_name");
	while($row = $sql->db_Fetch()){
		$memberid = $row['userid'];
		$member = $row['user_name'];
		
		$text .= "<label><input type='checkbox' name='cmnames[]' value='$memberid'> $member</label><br />";
	}

$text .= "<br /><input type='submit' class='button' value='"._ASSIGNGAMES."'>
<input type='hidden' name='e-token' value='".e_TOKEN."' />
</form>";
	
$ns->tablerender(_ASSIGNGAMESTO, $text);
			
?>