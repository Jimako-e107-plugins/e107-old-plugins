<?php

class adminemem_html {

	function emem_header() {
		return '
			<center>
			<table class="roster" cellspacing="0" width="100%">
				<tr>
					<td class="aroster_main" colspan="5"><strong>'.roster_LAN_ADMIN_EMEM_TITLE.'</strong></td>
				</tr>
		';
	} // end function emem_header

	
	function emem_show() {
	global $sql, $sql2;

		//get the groups
		$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_order ASC");
		$members = "</table>";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$tables .= "<table class=\"roster\" width=\"100%\">
				<tr>
					<td class=\"roster_header\" colspan=\"5\">{$row['roster_group_name']}</td>
				</tr>
				<tr>
					<td class=\"aroster_header\" width=\"25%\">".roster_LAN_ADMIN_EMEM_NAME."</td>
					<td class=\"aroster_header\" width=\"25%\">".roster_LAN_ADMIN_EMEM_ENLISTED."</td>
					<td class=\"aroster_header\" width=\"25%\">".roster_LAN_ADMIN_EMEM_STATUS."</td>
					<td class=\"aroster_header\" width=\"25%\">".roster_LAN_ADMIN_EMEM_EDIT."</td>
				</tr>";

			// get the members
			$members_q = $sql2->db_Select("roster_members", "*", "roster_member_group='".$row['roster_group_id']."' ORDER BY roster_member_ranknum DESC, roster_member_name ASC");
			$count = 0;
			while($row2 = $sql2->db_Fetch(MYSQL_ASSOC)){
				$i++;
				if($row2['roster_member_status'] == "Retired"){
					$status = "<font color=\"#ff0000\">Retired</font>";
				}else if($row2['roster_member_status'] == "Reserve"){
					$status = "<font color=\"#d9c30a\">Reserve</font>";
				}else if($row2['roster_member_status'] == "On Leave"){
					$status = "<font color=\"#ff9c00\">On Leave</font>";
				}else{
					$status = "<font color=\"#48E702\">Active Duty</font>";
				}	
				$rank = explode(",", $row2['roster_member_rank']);
				$enlisted = date("dMY", $row2['roster_member_enlisted']);
				$enlisted = strtoupper($enlisted);
				$patterns[0] = "/JUN/";
				$patterns[1] = "/JUL/";
				$patterns[2] = "/SEP/";
				$replacements[0] = "JUNE";
				$replacements[1] = "JULY";
				$replacements[2] = "SEPT";
				$enlisted = preg_replace($patterns, $replacements, $enlisted);
				$tables .= "<tr>";
				if($i%2 == 0){
					$tables .= "<td class=\"aroster_row1\" width=\"25%\">{$rank[0]} {$row2['roster_member_name']}</td>";
					$tables .= "<td class=\"aroster_row1\" width=\"25%\">{$enlisted}</td>";
					$tables .= "<td class=\"aroster_row1\" width=\"25%\">{$status}</td>";
					$tables .= "<td class=\"aroster_row1\" width=\"10%\"><a href=\"admin_emem.php?action=edit&m_id={$row2['roster_member_id']}\">".roster_LAN_ADMIN_EMEM_EDIT."</a></td>";
				}else{
					$tables .= "<td class=\"aroster_row2\" width=\"25%\">{$rank[0]} {$row2['roster_member_name']}</td>";
					$tables .= "<td class=\"aroster_row2\" width=\"25%\">{$enlisted}</td>";
					$tables .= "<td class=\"aroster_row2\" width=\"25%\">{$status}</td>";
					$tables .= "<td class=\"aroster_row2\" width=\"10%\"><a href=\"admin_emem.php?action=edit&m_id={$row2['roster_member_id']}\">".roster_LAN_ADMIN_EMEM_EDIT."</a></td>";
				}
				$tables .= "</tr>";
			}
			
			$tables .= "</table><br />";
		}
	
		$tables .= "<table style=\"border-width : thin; border-style : solid; border-color: #000000; text-align: center;\" cellspacing=\"0\" width=\"80%\">";

		return $tables;
	} // end function emem_show
			


	function emem_form($m_id) {
	global $sql;

		// get this member
		$member_q = $sql->db_Select("roster_members", "*", "roster_member_id='".$m_id."'");
		$member_a = $sql->db_Fetch(MYSQL_ASSOC);

		// get the groups
		$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_id ASC");
		$groups = "<select class=\"tbox\" name=\"m_group\">";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			if($row['roster_group_id'] == $member_a['roster_member_group']){
				$groups .= "<option value=\"{$row['roster_group_id']}\" selected=\"selected\">{$row['roster_group_name']}</option>";
			}else{
				$groups .= "<option value=\"{$row['roster_group_id']}\">{$row['roster_group_name']}</option>";
			}
		}
		$groups .= "</select>";

		//get the ranks
		$ranks_q = $sql->db_Select("roster_ranks", "*", "roster_rank_id!='0' ORDER BY roster_rank_order ASC");
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$i+=1;
			$ranks[$i] = $row['roster_rank_name'].",".$row['roster_rank_order'];
		}


		$m_rank = "<select class=\"tbox\" name=\"m_rank\">";
		foreach($ranks as $rank){
			$specific = explode(",", $rank);
			if($rank == $member_a['roster_member_rank']){
				$m_rank .= "<option value=\"{$rank}\" selected=\"selected\">{$specific[0]} {$specific[1]}</option>";
			}else{
 				$m_rank .= "<option value=\"{$rank}\">{$specific[0]} {$specific[1]}</option>";
			}
		}
		$m_rank .= "</select>";


		// make the reports to
		$members_q = $sql->db_Select("roster_members", "*", "roster_member_id!='0' ORDER BY roster_member_ranknum DESC, roster_member_name ASC");
		$m_ureport = "<select class=\"tbox\" name=\"m_ureport\"><option value=\"\"> </option>";
		$m_dreport = "<select class=\"tbox\" name=\"m_dreport\"><option value=\"\"> </option>";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$c_rank = explode(",", $row['roster_member_rank']);
			$c_name = $c_rank[2]."-".$row['roster_member_name'];

			if($row['roster_member_id'] == $member_a['roster_member_unitreport']){
				$m_ureport .= "<option value=\"{$row['roster_member_id']}\" selected=\"selected\">{$c_name}</option>";
			}else{
				$m_ureport .= "<option value=\"{$row['roster_member_id']}\">{$c_name}</option>";
			}

			if($row['roster_member_id'] == $member_a['roster_member_dutyreport']){
				$m_dreport .= "<option value=\"{$row['roster_member_id']}\" selected=\"selected\">{$c_name}</option>";
			}else{
				$m_dreport .= "<option value=\"{$row['roster_member_id']}\">{$c_name}</option>";
			}
		}
		$m_ureport .= "</select>";
		$m_dreport .= "</select>";

		$enlistdate = date("m/d/Y", $member_a['roster_member_enlisted']);
		$rankdate = date("m/d/Y", $member_a['roster_member_rankdate']);

		// status
		if($member_a['roster_member_status'] == "Retired"){
			$status = "<option value=\"Active Duty\">Active Duty</option> <option value=\"Retired\" selected=\"selected\">Retired</option> <option value=\"Reserve\">Reserve</option> <option value=\"On Leave\">On Leave</option>";
		}else if($member_a['roster_member_status'] == "Reserve"){
			$status = "<option value=\"Active Duty\">Active Duty</option> <option value=\"Retired\">Retired</option> <option value=\"Reserve\" selected=\"selected\">Reserve</option> <option value=\"On Leave\">On Leave</option>";
		}else if($member_a['roster_member_status'] == "On Leave"){
			$status = "<option value=\"Active Duty\">Active Duty</option> <option value=\"Retired\">Retired</option> <option value=\"Reserve\">Reserve</option> <option value=\"On Leave\" selected=\"selected\">On Leave</option>";
		}else{
			$status = "<option value=\"Active Duty\" selected=\"selected\">Active Duty</option> <option value=\"Retired\">Retired</option> <option value=\"Reserve\">Reserve</option> <option value=\"On Leave\">On Leave</option>";
		}

		return '
			<form action="admin_emem.php?action=do_edit&m_id='.$member_a['roster_member_id'].'" method="POST">
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_GROUP.':</td>
				<td class="aroster_row2" width="75%">'.$groups.'</td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_NAME.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_name" size="35" value="'.$member_a['roster_member_name'].'" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_ENLISTED.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_enlisted" size="35" value="'.$enlistdate.'" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_UASSIGN.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_uassign" size="35" value="'.$member_a['roster_member_unit'].'" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_STATUS.':</td>
				<td class="aroster_row2" width="75%"><select class="tbox" name="m_status">'.$status.'</select></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_PFILE.':</td>
				<td class="aroster_row2" width="75%"><textarea class="tbox" name="m_pfile" cols="110" rows="25">'.$member_a['roster_member_pfile'].'</textarea><br /><br /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_LOCATION.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_loc" size="35" value="'.$member_a['roster_member_location'].'" /></td>
			<tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_EMEM_XFIRE.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_xfire" size="35" value="'.$member_a['roster_member_xfire'].'" /></td>
			</tr>
			<tr>
				<td class="aroster_footer" colspan="2"><input type="checkbox" name="delete_member" value="delete_member" /> '.roster_LAN_ADMIN_EMEM_DELETE.'</td>
			<tr>
				<td class="aroster_footer" colspan="2"><input class="tbox" type="submit" name="submit" value="'.roster_LAN_ADMIN_EMEM_EDIT.'" /></td>
			</tr>
			</form>
		';
	} // end function emem_form


	function emem_footer() {
		return '
			</table>
			</center>
		';
	} // end function emem_footer


	function emem_edited(){
		return '
			<tr>
				<td class="center">'.roster_LAN_ADMIN_EMEM_EDITED.'.</td>
			</tr>
		';
	} // end function emem_edited


	function emem_deleted(){
		return '
			<tr>
				<td class="center">'.roster_LAN_ADMIN_EMEM_DELETED.'.</td>
			</tr>
		';
	} // end function emem_deleted

} // end class adminemem_html
?>