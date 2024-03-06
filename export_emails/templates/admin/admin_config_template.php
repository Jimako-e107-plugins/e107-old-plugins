<?php 
global $sc_style;

$ADMIN_CONFIG_TEMPLATE = '
<form method="post" action="' . e_SELF . '">
	<div style="' . ADMIN_WIDTH . ' text-align:center;margin:20px;">{ITEM_MESSAGE}</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td colspan="2" class="forumheader2"><strong>' . EE_ADMIN_CONFIG_13 . '</strong></td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIG_03 . '</td>
			<td class="forumheader3">{ITEM_EXPORT_TYPE}</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2"><strong>' . EE_ADMIN_CONFIG_05 . '</strong></td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIG_06 . '</td>
			<td class="forumheader3">{ITEM_FIELD_END}</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIG_07 . '</td>
			<td class="forumheader3">{ITEM_FIELD_CLOSE}</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIG_08 . '</td>
			<td class="forumheader3">{ITEM_FIELD_ESCAPE}</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIG_14 . '</td>
			<td class="forumheader3">{ITEM_ADD_USERNAME}</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2" style="text-align:center;">
				<input type="hidden" name="action" value="update" />
				<input class="button" name="submit" type="submit" value="' . EE_ADMIN_CONFIG_09 . '" />
			</td>
		</tr>
	</table>
</form>';

?>