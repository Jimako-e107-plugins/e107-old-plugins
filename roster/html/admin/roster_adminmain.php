<?php

class adminmain_html {

	function main_header() {
		return '
			<center>
			<table border="0">
				<tr>
					<td align="center">'.roster_LAN_ADMIN_MAIN_TITLE.'</td>
				</tr>
				<tr>
		';
	} // end function main_header


	function main_body() {
		return '
			<td>'.roster_LAN_ADMIN_MAIN_BODY.'</td>
		';
	} // end function main_body


	function main_footer() {
		return '
			</tr>
			</table>
			</center>
		';
	} // end function main_footer
} // end class adminmain_html
?>