<?php

class adminegroup_html {

	function egroup_header() {
		return '
			<center>
			<table class="roster" cellspacing="0" width="100%">
				<tr>
					<td class="aroster_main" colspan="3"><strong>'.roster_LAN_ADMIN_EGROUP_TITLE.'</strong></td>
				</tr>
		';
	} // end function egroup_header


	function egroup_show() {
	global $sql;

		//get the groups
		$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_order ASC");
		$groups = "";
		while($row = $sql->db_Fetch(MYSQL_ASSOC)){
			$i+=1;
			if($i%2 == 0){
				$groups .= "<tr>";
				$groups .= "<td class=\"aroster_row1\" width=\"80%\">{$row['roster_group_name']}</td>";
				$groups .= "<td class=\"aroster_row1\" width=\"10%\"><a href=\"admin_egroup.php?action=edit&g_id={$row['roster_group_id']}\">".roster_LAN_ADMIN_EGROUP_EDIT."</a></td>";
				$groups .= "<td class=\"aroster_row1\" width=\"10%\"><input class=\"tbox\" type=\"text\" name=\"g_order[{$row['roster_group_id']}]\" value=\"{$row['roster_group_order']}\" size=\"2\" /></td>";
				$groups .= "</tr>";
			}else{
				$groups .= "<tr>";
				$groups .= "<td class=\"aroster_row2\" width=\"80%\">{$row['roster_group_name']}</td>";
				$groups .= "<td class=\"aroster_row2\" width=\"10%\"><a href=\"admin_egroup.php?action=edit&g_id={$row['roster_group_id']}\">".roster_LAN_ADMIN_EGROUP_EDIT."</a></td>";
				$groups .= "<td class=\"aroster_row2\" width=\"10%\"><input class=\"tbox\" type=\"text\" name=\"g_order[{$row['roster_group_id']}]\" value=\"{$row['roster_group_order']}\" size=\"2\" /></td>";
				$groups .= "</tr>";
			}
		}

		return '
			<form action="admin_egroup.php?action=do_edit" method="POST">
			<tr>
				<td height="20" class="aroster_header" valign="middle" bgcolor="#515151" width="40%">'.roster_LAN_ADMIN_EGROUP_NAME.'</td>
				<td height="20" class="aroster_header" valign="middle" bgcolor="#515151" width="30%">'.roster_LAN_ADMIN_EGROUP_EDIT.'</td>
				<td height="20" class="aroster_header" valign="middle" bgcolor="#515151" width="30%">'.roster_LAN_ADMIN_EGROUP_ORDER.'</td>
			</tr>
			'.$groups.'
			<tr>
				<td class="aroster_footer" colspan="3"><input class="tbox" type="submit" name="do_order" value="'.roster_LAN_ADMIN_EGROUP_ORDER.'" /></td>
			</tr>
			</form>
		';
	} // end function egroup_show


	function egroup_form($g_id) {
	global $sql;

		// get the group
		$group_q = $sql->db_Select("roster_groups", "*", "roster_group_id='".$g_id."'");
		$group_a = $sql->db_Fetch(MYSQL_ASSOC);

		return '
			<form action="admin_egroup.php?action=do_edit&g_id='.$g_id.'" method="POST">
			<tr>
				<td class="aroster_row1" width="30%">'.roster_LAN_ADMIN_EGROUP_NNAME.':</td>
				<td class="aroster_row2" colspan="2" width="70%"><input class="tbox" type="text" name="g_name" size="35" value="'.$group_a['roster_group_name'].'" /></td>
			</tr>
			<tr>
				<td class="aroster_footer" colspan="3"><input class="tbox" type="submit" name="do_edit" value="'.roster_LAN_ADMIN_EGROUP_EDIT.'" /></td>
			</tr>
			</form>
		';
	} // end function ngroup_form


	function egroup_footer() {
		return '
			</table>
			</center>
		';
	} // end function egroup_footer


	function egroup_updated() {
		return '
			<tr>
				<td class="center" colspan="3">'.roster_LAN_ADMIN_EGROUP_UPDATED.'.</td>
			</tr>
		';
	} // end function egroup_updated


	function egroup_success($g_name) {
		return '
			<tr>
				<td class="center" colspan="2">'.roster_LAN_ADMIN_EGROUP_SUCCESS.'.</td>
			</tr>
		';
	} // end function eforms_success

} // end class adminegroup_html
?>