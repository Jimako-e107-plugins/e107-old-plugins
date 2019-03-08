<?php
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%");
}
// *
// * FAQs list. This part is the front opening screen of the FAQ Plugin
// *
if (!isset($HDU_LISTTICKETS_HEADER))
{
    $HDU_LISTTICKETS_HEADER = "
<table style ='" . USER_WIDTH . "' class ='fborder'>
	<tr>
		<td class ='fcaption' colspan='8' style='text-align:left;' >{HDU_TITLE}&nbsp;</td>
	</tr>";
    if (defined('HDU_LOGO'))
    {
        $HDU_LISTTICKETS_HEADER .= "
	<tr>
		<td class ='forumheader2' colspan='8' style='text-align:center;' >
			<img src='".HDU_LOGO."' style='border:0;' alt='helpdesk logo' />
		</td>
	</tr>";
    }
    $HDU_LISTTICKETS_HEADER .= "
	<tr>
		<td style='vertical-align:top;'  colspan='8' class ='forumheader3'><b>{HDU_MESSAGE}</b>&nbsp;</td>
	</tr>";
    if (!empty($HELPDESK_PREF['hduprefs_messagetop']))
    {
        // If there is a message at the top of the helpdesk to display then display it
        $HDU_LISTTICKETS_HEADER .= "
	<tr>
		<td style='vertical-align:top;'  colspan='8' class ='forumheader3'>{HDU_MESSAGETOP}&nbsp;</td>
	</tr>
	<tr>
		<td colspan ='4' class ='forumheader3'>{HDU_PHONE}&nbsp;</td>
		<td colspan ='4' class ='forumheader3'>{HDU_FAQ}</td>
	</tr>
	<tr>
		<td class ='forumheader2' colspan ='4'>" . HDU_188 . "</td>
		<td class ='forumheader2' colspan ='4'>" . HDU_176 . "</td>
	</tr>
	<tr>
		<td style='text-align:left' colspan ='4' class='forumheader3' >{HDU_NEWTICKET} {HDU_REPORTS}&nbsp;</td>
		<td  class='forumheader3' colspan ='4' style='width:50%; vertical-align:top;' >" . HDU_77 . "{HDU_FILTER}<br />
		" . HDU_78 . " {HDU_GOTOREC} {HDU_DOFILTER}</td>
	</tr>
</table>
<table style ='" . USER_WIDTH . "' class ='fborder' >
	<tr>
		<td style ='width:3%; text-align:center' class ='forumheader'><span class ='defaulttext'>&nbsp;</span></td>
		<td style ='width:5%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_1 . "</span></td>
		<td style ='width:15%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_31 . "</span></td>
		<td style ='width:15%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_248 . "</span></td>
		<td style ='width:15%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_10 . "</span></td>
		<td style ='width:17%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_3 . "</span></td>
		<td style ='width:15%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_4 . "</span></td>
		<td style ='width:15%; text-align:center' class ='forumheader'><span class ='defaulttext'>" . HDU_25 . "</span></td>
	</tr>";
    }
}

if (!isset($HDU_LISTTICKETS_DETAIL))
{
    $HDU_LISTTICKETS_DETAIL = "
	<tr>
		<td style ='padding:3px; width:3%; border: #C3BDBD 1px solid; background-color:{HDU_PRIORITYCOLOUR}; text-align:center'>{HDU_TICKET_STATUS}</td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_ID}</span></td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_SUMMARY}</span>&nbsp;</td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_POSTED=d/m/Y}</span>&nbsp;</td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_CATEGORY}&nbsp;</span></td>
		<td class ='forumheader3' style ='text-align:center' ><span class='smalltext'>{HDU_TICKET_POSTER}</span></td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_RESOLUTION}&nbsp;</span></td>
		<td class ='forumheader3' style ='text-align:center'><span class='smalltext'>{HDU_TICKET_HELPDESK}&nbsp;</span></td>
	</tr>";
}
if (!isset($HDU_LISTTICKETS_NOTICKETS))
{
    $HDU_LISTTICKETS_NOTICKETS = "
	<tr>
		<td class ='forumheader3' style='vertical-align:top;text-align:center;' colspan ='8'>" . HDU_29 . "</td>
	</tr>";
}
if (!isset($HDU_LISTTICKETS_FOOTER))
{
    $HDU_LISTTICKETS_FOOTER = "
	<tr>
		<td style ='vertical-align:top;' colspan ='8' class ='forumheader3' >{HDU_MESSAGEBOTTOM}&nbsp;</td>
	</tr>
	<tr>
		<td style ='vertical-align:top;' colspan ='8' class ='forumheader3' >{HDU_NEXTPREV}&nbsp;<span class='smallblacktext'>{HDU_RIGHTS}</span></td>
	</tr>
</table>";
}

if (!isset($HDU_SHOWTICKET_HEADER))
{
    $HDU_SHOWTICKET_HEADER = "";
}
if (!isset($HDU_SHOWTICKET))
{
    $HDU_SHOWTICKET = "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' >" . HDU_1 . " {HDU_SHOW_ACTION}</td>
	</tr>
	<tr>
		<td style='vertical-align:top;' class='forumheader3'>{HDU_SHOW_UPDIR}&nbsp;{HDU_SHOW_PRINT}&nbsp;{HDU_SHOW_EMAILLINK}&nbsp;{HDU_SHOW_PDF}&nbsp;{HDU_SHOW_DELETE}</td>
	</tr>
	<tr>
		<td class='forumheader2' >{HDU_SHOW_TABLIST}</td>
	</tr>
	<tr>
		<td >";
}

if (!isset($HDU_SHOWTICKET_TICKET))
{
    $HDU_SHOWTICKET_TICKET = "
<table style='display:;width:100%;' id='hduTableTicket'>
	<tr>
		<td style='width:30%; vertical-align:top;'  class='forumheader3'>" . HDU_3 . "</td>
		<td style='width:70%; vertical-align:top;'  class='forumheader3'>{HDU_SHOW_USER}&nbsp;</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;'  class='forumheader3'>" . HDU_36 . "</td>
		<td  style='width:70%; vertical-align:top;' class='forumheader3'>{HDU_SHOW_DATEPOSTED}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_6 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>{HDU_SHOW_PRIORITY}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_31 . " *</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>{HDU_SHOW_SUMMARY}</td>
	</tr>
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_10 . " *</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' >{HDU_SHOW_CATEGORY}</td>
	</tr>";
    if ($helpdesk_obj->hduprefs_showassettag)
    {
        $HDU_SHOWTICKET_TICKET .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_39 . " </td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' >{HDU_SHOW_ASSET}</td>
	</tr>";
        // If we show the asset tag
    }
    $HDU_SHOWTICKET_TICKET .= "
	<tr>
		<td style='width:30%;vertical-align:top;'  class='forumheader3'>" . HDU_12 . " *</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3'>{HDU_SHOW_DESCRIPTION}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;vertical-align:top' class='forumheader3'>" . HDU_28 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3'>{HDU_SHOW_EMAIL}</td>
	</tr>
</table>	";
}
if (!isset($HDU_SHOWTICKET_DETAILS))
{
    $HDU_SHOWTICKET_DETAILS = "
<table style='display:none;width:100%;' id='hduTableDetails' >
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3' > " . HDU_154 . " </td>
		<td style='width:70%; vertical-align:top;' class='forumheader3' >{HDU_SHOW_STATUS}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_25 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_ASSIGNEDTO}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_26 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3'>{HDU_SHOW_ALLOCATE_TIME}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_37 . "</td>
		<td style='width:70%;vertical-align:top;'  class='forumheader3'>{HDU_SHOW_CLOSED}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_143 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_FIX}</td>
	</tr>
</table>	";
}
if (!isset($HDU_SHOWTICKET_FINANCE))
{
    $HDU_SHOWTICKET_FINANCE = "
<table style='width:100%;display:none;' id='hduTableFinance'>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_144 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_FIXCOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_145 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_HOURS}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_146 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_RATE}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_147 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_COST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_148 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_TRAVEL}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'>" . HDU_149 . "</td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_DISTANCERATE}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_150 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_DISTANCECOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_164 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_EQUPTCOST}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_151 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_CALLOUT}</td>
	</tr>
	<tr>
		<td style='width:30%;vertical-align:top;' class='forumheader3'><b>" . HDU_152 . "</b></td>
		<td style='width:70%;vertical-align:top;' class='forumheader3'>{HDU_SHOW_TOTALCOST}</td>
	</tr>
</table>" ;
}
if (!isset($HDU_SHOWTICKET_COMMENT_HEADER))
{
    $HDU_SHOWTICKET_COMMENT_HEADER = "
<table  style='width:100%;display:none;' id='hduTableComment'>
	<tr>
		<td style='vertical-align:top;' colspan='3' class='forumheader3'>{HDU_SHOW_NEWCOMMENT}</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:10%; vertical-align:top;' >" . HDU_98 . "</td>
		<td class='forumheader2' style='width:20%; vertical-align:top;' >" . HDU_99 . "</td>
		<td class='forumheader2' style='width:70%; vertical-align:top;' >" . HDU_100 . "</td>
	</tr>	";
}

if (!isset($HDU_SHOWTICKET_COMMENT_DETAIL))
{
    $HDU_SHOWTICKET_COMMENT_DETAIL = "
	<tr>
		<td class='forumheader3' style='width:10%; vertical-align:top;' >{HDU_SHOW_COMMENTDATE}</td>
		<td class='forumheader3' style='width:20%; vertical-align:top;' >{HDU_SHOW_COMMENTPOSTER}</td>
		<td class='forumheader3' style='width:70%; vertical-align:top;' >{HDU_SHOW_COMMENT}</td>
	</tr>";
}

if (!isset($HDU_SHOWTICKET_COMMENT_FOOTER))
{
    $HDU_SHOWTICKET_COMMENT_FOOTER = "
</table>";
}


if (!isset($HDU_SHOWTICKET_FOOTER))
{
    $HDU_SHOWTICKET_FOOTER = "
		</td>
	</tr>
	<tr>
		<td  class='forumheader3' >* - ".HDU_250."<br /><br />{HDU_SHOW_SUBMIT}</td>
	</tr>
	<tr>
		<td  class='fcaption' >&nbsp;</td>
	</tr>
</table>";
}
if (!isset($HDU_DELETE_OK))
{
    $HDU_DELETE_OK = "
<table style='".USER_WIDTH."' class='fborder'>
	<tr>
		<td class ='fcaption'  style='text-align:left;' >{HDU_TITLE}&nbsp;</td>
	</tr>
	<tr>
		<td style='vertical-align:top;' class='forumheader3'  >{HDU_SHOW_UPDIR}</td>
	</tr>
	<tr>
		<td  class='forumheader3' style='text-align:center;' >".HDU_230." {HDU_TICKET_ID}<br /><br />{HDU_DELETE_CONFIRM}&nbsp;&nbsp;{HDU_DELETE_CANCEL}<br />
		</td>
	</tr>
	<tr>
		<td  class='fcaption' >&nbsp;</td>
	</tr>
</table>";
}
if (!isset($HDU_DELETE_NOTOK))
{
    $HDU_DELETE_NOTOK = "
<table style='".USER_WIDTH."' class='fborder'>
	<tr>
		<td class ='fcaption'  style='text-align:left;' >{HDU_TITLE}&nbsp;</td>
	</tr>
	<tr>
		<td style='vertical-align:top;' class='forumheader3'  >{HDU_SHOW_UPDIR}</td>
	</tr>
	<tr>
		<td  class='forumheader3' style='text-align:center;' >".HDU_233."</td>
	</tr>
	<tr>
		<td  class='fcaption' >&nbsp;</td>
	</tr>
</table>";
}
?>