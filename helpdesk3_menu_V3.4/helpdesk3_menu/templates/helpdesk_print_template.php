<?php
if (!defined("HDU_PRINT_WIDTH"))
{
    define(HDU_PRINT_WIDTH, "width:60%;");
}
if (!isset($HDU_PRINTTICKET))
{
    $HDU_PRINTTICKET = "
<table style='" . HDU_PRINT_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='3'>" . HDU_1 . " {HDU_SHOW_ACTION}</td>
	</tr>
	<tr>
		<td  class='forumheader2' colspan='3'>" . HDU_240 . "</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;'  class='forumheader3'>" . HDU_3 . "</td>
		<td style='width:70%; vertical-align:top;'  class='forumheader3' colspan='2'>{HDU_SHOW_USER}&nbsp;</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;'  class='forumheader3'>" . HDU_36 . "</td>
		<td  style='width:70%; vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_DATEPOSTED}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_6 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_PRIORITY}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_31 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_SUMMARY}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_10 . " </td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'  colspan='2'>{HDU_SHOW_CATEGORY}</td>
	</tr>";
    if ($helpdesk_obj->hduprefs_showassettag)
    {
        $HDU_PRINTTICKET .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_39 . " </td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'  colspan='2'>{HDU_SHOW_ASSET}</td>
	</tr>";
        // If we show the asset tag
    }
    $HDU_PRINTTICKET .= "
	<tr>
		<td style='width:30%;vertical-align:top;'  class='forumheader3'>" . HDU_12 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3' colspan='2'>{HDU_SHOW_DESCRIPTION}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;vertical-align:top' class='forumheader3'>" . HDU_28 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3' colspan='2'>{HDU_SHOW_EMAIL}</td>
	</tr>
	<tr>
		<td  class='forumheader2' colspan='3'>" . HDU_241 . "</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_154 . " </td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' colspan='2' >{HDU_SHOW_STATUS}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_25 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_ASSIGNEDTO}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_26 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3' colspan='2'>{HDU_SHOW_ALLOCATE_TIME}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_37 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3' colspan='2'>{HDU_SHOW_CLOSED}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_143 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_FIX}</td>
	</tr>";
}
if ($helpdesk_obj->hduprefs_showfinance)
{
    $HDU_PRINTTICKET .= "
	<tr>
		<td  class='forumheader2' colspan='3'>" . HDU_242 . "</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_144 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_FIXCOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_145 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_HOURS}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_146 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_RATE}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_147 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_COST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_148 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_TRAVEL}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_149 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_DISTANCERATE}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_150 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_DISTANCECOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_164 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_EQUPTCOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_151 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_CALLOUT}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_152 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3' colspan='2'>{HDU_SHOW_TOTALCOST}</td>
	</tr>" ;
}

$HDU_PRINTTICKET .= "
    	<tr>
		<td  class='forumheader2' colspan='3'>" . HDU_243 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:10%; vertical-align:top;' >" . HDU_98 . "</td>
		<td class='forumheader2' style='width:20%; vertical-align:top;' >" . HDU_99 . "</td>
		<td class='forumheader2' style='width:70%; vertical-align:top;' >" . HDU_100 . "</td>
	</tr>	";

if (!isset($HDU_PRINTTICKET_DETAIL))
{
    $HDU_PRINTTICKET_DETAIL = "
	<tr>
		<td class='forumheader3' style='width:10%; vertical-align:top;' >{HDU_SHOW_COMMENTDATE}</td>
		<td class='forumheader3' style='width:20%; vertical-align:top;' >{HDU_SHOW_COMMENTPOSTER}</td>
		<td class='forumheader3' style='width:70%; vertical-align:top;' >{HDU_SHOW_COMMENT}</td>
	</tr>";
}

if (!isset($HDU_PRINTTICKET_FOOTER))
{
    $HDU_PRINTTICKET_FOOTER = "
	<tr>
		<td  class='fcaption' colspan='3'>&nbsp;</td>
	</tr>
</table>";
}

?>