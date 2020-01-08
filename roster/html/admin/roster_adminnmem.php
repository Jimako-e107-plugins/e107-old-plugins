<?php

class adminnmem_html {

	function nmem_header() {
		return '
			<center>
			<table class="roster" cellspacing="0" width="100%">
				<tr>
					<td class="aroster_main" colspan="2"><strong>'.roster_LAN_ADMIN_NMEM_TITLE.'</strong></td>
				</tr>
		';
	} // end function nmem_header


	function nmem_form() {
	global $sql;

		// get the groups
		$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_id ASC");
		$groups = "<select class=\"tbox\" name=\"m_group\">";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$groups .= "<option value=\"{$row['roster_group_id']}\">{$row['roster_group_name']}</option>";
		}
		$groups .= "</select>";

		//get the ranks
		$ranks_q = $sql->db_Select("roster_ranks", "*", "roster_rank_id!='0' ORDER BY roster_rank_order ASC");
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$i+=1;
			$ranks[$i] = $row['roster_rank_name'].",".$row['roster_rank_order'];
		}
		
		// make the ranks
		$m_rank = "<select class=\"tbox\" name=\"m_rank\">";
		foreach($ranks as $rank){
			$specific = explode(",", $rank);
			$m_rank .= "<option value=\"{$rank}\">{$specific[0]} {$specific[1]}</option>";
		}
		$m_rank .= "</select>";


		//make the reports to
		$members_q = $sql->db_Select("roster_members", "*", "roster_member_id!='0' ORDER BY roster_member_ranknum DESC, roster_member_name ASC");
		$m_ureport = "<select class=\"tbox\" name=\"m_ureport\"><option value=\"\"> </option>";
		$m_dreport = "<select class=\"tbox\" name=\"m_dreport\"><option value=\"\"> </option>";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$c_rank = explode(",", $row['roster_member_rank']);
			$c_name = $c_rank[2]."-".$row['roster_member_name'];
			$m_ureport .= "<option value=\"{$row['roster_member_id']}\">{$c_name}</option>";
			$m_dreport .= "<option value=\"{$row['roster_member_id']}\">{$c_name}</option>";
		}
		$m_ureport .= "</select>";
		$m_dreport .= "</select>";

		return '
			<form action="admin_nmem.php?action=do_add" method="POST">
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_GROUP.':</td>
				<td class="aroster_row2" width="75%">'.$groups.'</td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_NAME.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_name" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_ENLISTED.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_enlisted" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_UASSIGN.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_uassign" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_STATUS.':</td>
				<td class="aroster_row2" width="75%"><select class="tbox" name="m_status"><option value="Active Duty">Active Duty</option> <option value="Retired">Retired</option> <option value="Reserve">Reserve</option> <option value="On Leave">On Leave</option></select></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_PFILE.':</td>
				<td class="aroster_row2" width="75%"><textarea class="tbox" name="m_pfile" cols="110" rows="25"></textarea><br /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_LOCATION.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_loc" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_row1" width="25%">'.roster_LAN_ADMIN_NMEM_XFIRE.':</td>
				<td class="aroster_row2" width="75%"><input class="tbox" type="text" name="m_xfire" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_footer" colspan="2"><input class="tbox" type="submit" name="submit" value="'.roster_LAN_ADMIN_NMEM_ADD.'" /></td>
			</tr>
			</form>
		';
	} // end function nmem_form


	function nmem_footer() {
		return '
			</table>
			</center>
		';
	} // end function nmem_footer


	function nmem_success($g_name){
		return '
			<tr>
				<td class="aroster_row1">'.roster_LAN_ADMIN_NMEM_SUCCESS.'.</td>
			</tr>
		';
	} // end function nmem_success

} // end class adminnmem_html
?>