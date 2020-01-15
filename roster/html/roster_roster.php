<?php

class roster_html {

	function roster_show() {
	global $sql, $sql2;

		// make the groups
		$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_order ASC");
		$tables = "";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$tables .= "<table class=\"roster\" width=\"100%\">
					<tr>
						<td class=\"roster_main\" colspan=\"6\">{$row['roster_group_name']}</td>
					</tr>
					<tr>
						<td class=\"roster_header\" width=\"40%\">".roster_LAN_ROSTER_NAME."</td>
						<td class=\"roster_header\" width=\"40%\">".roster_LAN_ROSTER_UASSIGN."</td>
						<td class=\"roster_header\" width=\"20%\">".roster_LAN_ROSTER_STATUS."</td>
					</tr>
				";
			$sql3 = new db();
			// get the members in this group
			$members_q = $sql2->db_Select("roster_members", "*", "roster_member_group='".$row['roster_group_id']."' ORDER BY roster_member_ranknum DESC, roster_member_rankdate ASC, roster_member_name ASC");
			while($row2 = $sql2->db_Fetch(MYSQL_ASSOC)){
				if($row2['roster_member_status'] == "Retired"){
					$status = "<font color=\"#ff0000\">Retired</font>";
				}else if($row2['roster_member_status'] == "Reserve"){
					$status = "<font color=\"#d9c30a\">Reserve</font>";
				}else if($row2['roster_member_status'] == "On Leave"){
					$status = "<font color=\"#ff9c00\">On Leave</font>";
				}else{
					$status = "<font color=\"#48E702\">Active Duty</font>";
				}	
				$i++;
				$rank = explode(",", $row2['roster_member_rank']);
				$site_name = $rank[2]."-".$row2['roster_member_name'];
				$info_q = $sql3->db_Select("user", "*", "user_name='".$site_name."'");
				$info_a = $sql3->db_Fetch(MYSQL_ASSOC);
				$pm = "<a href=\"".e_PLUGIN."pm/pm.php?send.".$info_a['user_id']."\"><img src=\"".e_THEME."AA/forum/pm.png\" border=\"0\" /></a>";
				
				if($i%2==0){
					$tables .= "<tr>
							<td class=\"roster_row1\"><a href=\"userinfo.php?m_id={$row2['roster_member_id']}\">{$rank[0]} {$row2['roster_member_name']}</a></td>
							<td class=\"roster_row1\">{$row2['roster_member_unit']}</td>
							<td class=\"roster_row1\"><div align=\"center\">{$status}</div></td>
						</tr>";
				}else{
					$tables .= "<tr>
							<td class=\"roster_row2\"><a href=\"userinfo.php?m_id={$row2['roster_member_id']}\">{$rank[0]} {$row2['roster_member_name']}</a></td>
							<td class=\"roster_row2\">{$row2['roster_member_unit']}</td>
							<td class=\"roster_row2\"><div align=\"center\">{$status}</div></td>
						</tr>";
				}
			}
	
			$tables .= "</table><br /><br />";
		}

		return $tables;
	} // end function roster_show

}// end class roster_html
?>