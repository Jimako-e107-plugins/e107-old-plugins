<?php

class adminngroup_html {

	function ngroup_header() {
		return '
			<center>
			<table class="roster" cellspacing="0" width="100%">
				<tr>
					<td class="aroster_main" colspan="2"><strong>'.roster_LAN_ADMIN_NGROUP_TITLE.'</strong></td>
				</tr>
		';
	} // end function ngroup_header


	function ngroup_form() {
		return '
			<form action="admin_ngroup.php?action=do_add" method="POST">
			<tr>
				<td class="aroster_row1" width="30%">'.roster_LAN_ADMIN_NGROUP_NAME.':</td>
				<td class="aroster_row2" width="70%"><input class="tbox" type="text" name="g_name" size="35" /></td>
			</tr>
			<tr>
				<td class="aroster_footer" colspan="2"><input class="tbox" type="submit" name="submit" value="'.roster_LAN_ADMIN_NGROUP_ADD.'" /></td>
			</tr>
			</form>
		';
	} // end function ngroup_form


	function ngroup_footer() {
		return '
			</table>
			</center>
		';
	} // end function ngroup_footer


	function ngroup_success($g_name){
		return '
			<tr>
				<td class="center">'.roster_LAN_ADMIN_NGROUP_SUCCESS.'.</td>
			</tr>
		';
	} // end function ngroup_success

} // end class adminngroup_html
?>