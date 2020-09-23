<?php
if (!isset($BDAY_MENU_A_HEADER))
{
    $BDAY_MENU_A_HEADER = "
<table style='" . USER_WIDTH . "' class='fborder' >
	<tr>
		<td class='fcaption' colspan='4'>" . BDAY_ADMIN_A59 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='4'><b>" . $bday_msg . "</b>&nbsp;</td>
	</tr>
	<tr>
		<td style='width:15%;' class='forumheader2'><b>" . BDAY_ADMIN_A61 . "</b></td>
		<td style='width:10%;text-align:right;' class='forumheader2'><b>" . BDAY_ADMIN_A63 . "</b></td>
		<td style='width:65%;' class='forumheader2'><b>&nbsp;</b></td>
		<td style='width:10%;text-align:right;' class='forumheader2'><b>" . BDAY_ADMIN_A62 . "</b></td>
	</tr>";
}
if (!isset($BDAY_MENU_A_DETAIL))
{
    $BDAY_MENU_A_DETAIL = "
	<tr>
		<td class='forumheader3'>{BDAY_RANGE}</td>
		<td class='forumheader3' style='text-align:right;'>{BDAY_TOTAL_RANGE}</td>
		<td class='forumheader3'>{BDAY_BAR}</td>
		<td class='forumheader3' style='text-align:right;' >{BDAY_PERCENT}%</td>
	</tr>
		";
}
if (!isset($BDAY_MENU_A_FOOTER))
{
    $BDAY_MENU_A_FOOTER = "
	<tr>
		<td class='forumheader2' colspan='4'>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' >&nbsp;</td>
		<td class='forumheader3' >" . BDAY_ADMIN_A60 . " <b>{BDAY_UNDEFINED}</b>&nbsp;</td>
		<td class='forumheader3' >&nbsp;</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='4'>&nbsp;</td>
	</tr>
</table>
";
}
