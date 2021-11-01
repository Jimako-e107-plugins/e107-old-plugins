<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/pagerestriction/pagerestriction_template.php,v $
|    $Revision: 1.0 $
|    $Date: 2006/07/23 08:03:58 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

//##### PAGE RESTRICTION : PAGE START/END -----------------------
	$PR_PAGE_START = "
	<div style='text-align:center'>
	".$rs -> form_open("post", e_SELF, "pagerestriction_form", "", "enctype='multipart/form-data'");

	$PR_PAGE_END = "
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td style='text-align:center' class='forumheader'>{FIELD_BUT}</td>
		</tr>
	</table>
	</form>
	</div>";

//##### PAGE RESTRICTION : PLUGINS ------------------------------
	$PR_START = "
		<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr><td class='fcaption' colspan='2'>{HEADING}</td></tr>
		<tr>
			<td class='forumheader' style='white-space:nowrap;'>{HEADING_LEFT}</td>
			<td class='forumheader' style='width:30%; text-align:center;'>".LAN_PAGERESTRICTION_6."</td>
		</tr>";

	$PR_ROW = "
		<tr>
			<td class='forumheader3' style='white-space:nowrap;'>{FIELD_KEY}</td>
			<td class='forumheader3' style='width:30%; text-align:center'>{FIELD_VAL}</td>
		</tr>";

	$PR_END = "
		</table><br />";

//##### PAGE RESTRICTION : PAGES --------------------------------
	$PR_PAGEROW_START = "
	<table class='fborder' style='".ADMIN_WIDTH."'>
	<tr><td class='fcaption' colspan='2'>".LAN_PAGERESTRICTION_3."</td></tr>
	<tr>
	<td class='forumheader' style='white-space:nowrap;'>".LAN_PAGERESTRICTION_5."</td>
	<td class='forumheader' style='width:30%; text-align:center;'>".LAN_PAGERESTRICTION_6."</td>
	</tr>
	</table>
	<div id='up_container' style='width:100%;'>
		<table class='fborder' style='".ADMIN_WIDTH."'>";

	$PR_PAGEROW_ROW = "
		<tr>
			<td class='forumheader3' style='white-space:nowrap;'>{FIELD_KEY}</td>
			<td class='forumheader3' style='width:30%; text-align:center'>{FIELD_VAL}</td>
		</tr>";

	$PR_PAGEROW_END = "
		</table>

		<div id='upline'>
			<table class='fborder' style='".ADMIN_WIDTH."'>
				<tr>
					<td class='forumheader3' style='white-space:nowrap;'>{FIELD_KEY}</td>
					<td class='forumheader3' style='width:30%; white-space:nowrap; text-align:center;'>{FIELD_VAL}</td>
				</tr>
			</table>
		</div>
	</div><br />
	<table class='fborder' style='".ADMIN_WIDTH."'><tr><td>{FIELD_BUT}</td></tr></table><br />";

//##### PAGE RESTRICTION : OPTIONS ------------------------------
	$PR_OPT_START = "
		<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr><td class='fcaption' colspan='2'>".LAN_PAGERESTRICTION_13."</td></tr>";

	$PR_OPT_ROW = "
		<tr>
			<td class='forumheader3' style='width:30%; white-space:nowrap;'>{FIELD_KEY}</td>
			<td class='forumheader3' style='width:70%; text-align:center'>{FIELD_VAL}</td>
		</tr>";

	$PR_OPT_END = "
		</table><br />";


?>