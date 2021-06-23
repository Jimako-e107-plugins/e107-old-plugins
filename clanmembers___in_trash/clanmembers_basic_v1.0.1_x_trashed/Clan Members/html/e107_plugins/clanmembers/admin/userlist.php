<script type="text/javascript">
function CheckForm(){
	var gamesorteams = "<?php echo strtolower($conf['gamesorteams']);?>";
	var gameorteam = "<?php echo substr(strtolower($conf['gamesorteams']),0,4);?>";
	var chkmem = false;
	var chkgroup = false;
	var members = document.getElementsByName('members[]');
	for(var i=0; i < members.length; i++){
		if(members[i].checked) chkmem = true;
	}
	var groups = document.getElementsByName(gamesorteams+'[]');
	for(var i=0; i < groups.length; i++){
		if(groups[i].checked) chkgroup = true;
	}
	
	if(!chkmem){
		alert("Please select at least 1 member");
		return false;
	}
	
	if(chkgroup){
		return true;
	}else{
		sure = confirm("You haven't selected a "+gameorteam+". Members won't be shown on the clan members page unless they have a "+gameorteam+" assigned.");
		if(sure){
			return true;
		}else{
			return false;
		}
	}
}
</script>
<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
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

$query = mysql_real_escape_string($_POST['query']);
$games = mysql_real_escape_string($_POST['games']);
if($games !="") $glist = explode(",", $games);


$text = "<form method='post'><input type='text' size='15' name='query' value='$query'> <input type='submit' class='button' value='"._SEARCH."'><input type='hidden' name='e-token' value='".e_TOKEN."' /></form><br />";
$text .= "<form method='post' action='admin.php?AddUsers' onsubmit='return CheckForm();'>";
$where = "";
if($query !=""){
	$where = "WHERE user_name LIKE '%$query%'";
}
$sql1 = new db;
$sql -> db_Select("user", "user_id, user_name", "$where ORDER BY user_name ASC", "");
	while($row = $sql-> db_Fetch()){
		$userid = $row['user_id'];
		$member = $row['user_name'];
		if($sql1->db_Count("clan_members_info", "(*)", "WHERE userid='$userid'") == 0){
			$text .= "<label><input name='members[]' value='$userid' type='checkbox' ".($games !="" && $member==$query?"checked":"").">$member</label><br />";
			$nousers++;
		}		
	}


if($nousers > 0){	
	$ns->tablerender(_USERS, $text);
	//Games
	if($sql->db_Count("clan_games", "(*)", "WHERE inmembers='1'") > 0){
		$text = "";
		$sql -> db_Select("clan_games", "gid, gname", "ORDER BY position ASC", "");
		while($row = $sql-> db_Fetch()){
			$gid = $row['gid'];
			$gname = $row['gname'];
			$text .= "<label><input name='games[]' value='$gid' type='checkbox' ".($games !="" && in_array($gid,$glist)?"checked":"").">$gname</label><br />";
		}
		$ns->tablerender(_INFOGames, $text);
	}
	
	//Teams
	if($sql->db_Count("clan_teams", "(*)", "WHERE inmembers='1'") > 0){
	$text = "";
	$sql -> db_Select("clan_teams", "tid, team_name", "ORDER BY position ASC", "");
		while($row = $sql-> db_Fetch()){
			$tid = $row['tid'];
			$team_name = $row['team_name'];
			$text .= "<label><input name='teams[]' value='$tid' type='checkbox'>$team_name</label><br />";
		}
		$ns->tablerender(_INFOTeams, $text);
	}
	
	$text = "<input type='submit' class='button' value='"._ADDUSERS."'>";
	$ns->tablerender($text, "");
}elseif($query == ""){
	$ns->tablerender(_USERS, _ALLUSERSINCMLIST);
}else{
$text = "<form method='post'><input type='text' size='15' name='query' value='$query'> <input type='submit' class='button' value='"._SEARCH."'><input type='hidden' name='e-token' value='".e_TOKEN."' /></form><br />";
	$ns->tablerender(_USERS, $text."<br />"._NOUSERSFOUND);
}

echo "<input type='hidden' name='e-token' value='".e_TOKEN."' />
</form>";

?>