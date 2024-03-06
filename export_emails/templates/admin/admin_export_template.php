<?php 
global $sc_style;

$ADMIN_CONFIRMATION_TEMPLATE = '
<form method="post" action="' . e_SELF . '">
	<div style="' . ADMIN_WIDTH . ' text-align:center;margin:20px;">{ITEM_MESSAGE}</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td colspan="2" class="forumheader2"><strong>' . EE_ADMIN_CONFIRMATION_04 . '</strong></td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIRMATION_03 . '</td>
			<td class="forumheader3">{ITEM_EXPORT_TYPE}</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:30%;">' . EE_ADMIN_CONFIRMATION_09 . '</td>
			<td class="forumheader3">' . EE_ADMIN_CONFIRMATION_10 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2" style="text-align:center;">
				{ITEM_EXPORT_ACTION}
				<input class="button" name="submit" type="submit" value="' . EE_ADMIN_CONFIRMATION_08 . '" />
			</td>
		</tr>
	</table>
</form>';

?>