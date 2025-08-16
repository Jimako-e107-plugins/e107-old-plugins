<?php

if (!defined('e107_INIT'))
{
    exit;
}
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%");
}
// *
// * Newslinks list
// *
// *
if (!isset($NEWSLINK_LIST_TABLE))
{
    // The main heading for the newslink list
    // displayed second
    $NEWSLINK_LIST_TABLE = "
<table class='fborder' style='" . USER_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . NEWSLINK_7 . "</td>
	</tr>
		<tr>
		<td class='forumheader3' colspan='2'>{NEWSLINK_CAT_MSG}&nbsp;</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:30%;'>" . NEWSLINK_5 . "</td>
		<td class='forumheader3' style='width:70%;'>{NEWSLINK_CAT_SEL}&nbsp;<input type='submit' name='newslink_filter' value='" . NEWSLINK_6 . "' class='tbox' /></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>{NEWSLINK_CAT_DESC}&nbsp;</td>
	</tr>
</table>";
}
// *
if (!isset($NEWSLINK_NEWSLINKLIST_SORT))
{
    // The heading for the columns of newslink
    $NEWSLINK_NEWSLINKLIST_SORT = "
<table style='" . USER_WIDTH . "'>
	<tr>
		<td class='forumheader3' style='width:70%;'>{NEWSLINK_CAT_NEWSLINK}</td>
		<td class='forumheader3' style='width:15%;'>{NEWSLINK_CAT_NAMEHEAD}</td>
		<td class='forumheader3' style='width:15%;'>{NEWSLINK_CAT_DATE}</td>
	</tr>";
}
// *
if (!isset($NEWSLINK_NEWSLINKLIST_LIST))
{
    // The list of newslink number of newslink is set in admin config
    $NEWSLINK_NEWSLINKLIST_LIST = "
	<tr>
		<td class='forumheader3' >{NEWSLINK_CAT_NEWSLINKLIST}<br />{NEWSLINK_LINK_DESC}<br />{NEWSLINK_CAT_RATEING=none}</td>
		<td class='forumheader3' >{NEWSLINK_CAT_NAME}</td>
		<td class='forumheader3' >{NEWSLINK_CAT_DATELIST=short}</td>
	</tr>";
}
// *
if (!isset($NEWSLINK_NEWSLINKLIST_NONEWSLINK))
{
    // No newslink to display
    $NEWSLINK_NEWSLINKLIST_NONEWSLINK .= "
	<tr>
		<td class='forumheader3' colspan='3'>" . NEWSLINK_8 . "</td>
	</tr>";
}
// *
if (!isset($NEWSLINK_NEWSLINKLIST_FOOTER))
{
    // Last section of the newslink list
    $NEWSLINK_NEWSLINKLIST_FOOTER .= "
	<tr>
		<td class='fcaption' colspan='3'>{NEWSLINK_CAT_NEWSLINKLIST_NP}&nbsp;{NEWSLINK_MANAGE}</td>
	</tr>
</table>";
}

if (!isset($NEWSLINK_NEWSLINKSHOW_PRE))
{
    $NEWSLINK_NEWSLINKSHOW_PRE .= "
<table style='" . USER_WIDTH . "' class='fborder'>";
}
// *
// *
// * Display Newslink
// *
// *
if (!isset($NEWSLINK_NEWSLINKSHOW_HEADER))
{
    $NEWSLINK_NEWSLINKSHOW_HEADER .= "
	<tr>
		<td class='fcaption' colspan='2'>" . NEWSLINK_9 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'>{NEWSLINK_SHOW_UP}&nbsp;&nbsp;{NEWSLINK_SHOW_PRINT}&nbsp;&nbsp;{NEWSLINK_SHOW_EMAIL}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_14 . "</td>
		<td class='forumheader3'>{NEWSLINK_SHOW_NAME}</td></tr>
	<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_13 . "</td>
		<td class='forumheader3'>{NEWSLINK_SHOW_BODY}</td>
		</tr>
	<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_110 . "</td>
		<td class='forumheader3'>{NEWSLINK_CAT_RATEING}</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_127 . "</td>
		<td class='forumheader3'>{NEWSLINK_SHOW_VIEWS} ({NEWSLINK_SHOW_UNIQUE} ".NEWSLINK_126.")</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_10 . "</td>
		<td class='forumheader3'>{NEWSLINK_SHOW_POSTER}</td>
	</tr>";
}
// *
if (!isset($NEWSLINK_NEWSLINKSHOW_NONE))
{
    $NEWSLINK_NEWSLINKSHOW_NONE = "
	<tr>
		<td class='forumheader3' colspan='2' style='width:30%;vertical-align:top;'>" . NEWSLINK_90 . "</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'><a href='?$0.show'>" . NEWSLINK_15 . "</a></td>
	</tr>";
}
if (!isset($NEWSLINK_NEWSLINKSHOW_POST))
{
    $NEWSLINK_NEWSLINKSHOW_POST = "
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
}
// *
// *
// *
#if (!isset($NEWSLINK_NEWSLINKSUBMITTED_PRE))
#{
#    $NEWSLINK_NEWSLINKSUBMITTED_PRE = "<div class='fborder' style='" . USER_WIDTH . "' >";
#}
#
#if (!isset($NEWSLINK_NEWSLINKSUBMITTED_SUBMITTED))
#{
#    $NEWSLINK_NEWSLINKSUBMITTED_SUBMITTED = "
#	<table style='" . USER_WIDTH . "' >
#		<tr>
#			<td class='fcaption' >" . NEWSLINK_111 . "</td>
#		</tr>
#		<tr>
#		<td class='forumheader2' colspan='2'>{NEWSLINK_SHOW_UP}</td>
#		</tr>
#		<tr>
#			<td class='forumheader3' >{NEWSLINK_SUBMIT_RESULT}</td>
#		</tr>
#			<tr>
#				<td class='fcaption' colspan='2'>{NEWSLINK_CONT_BUTTON}</td>
#			</tr>
#	</table>";
#}
#
#if (!isset($NEWSLINK_NEWSLINKSUBMITTED_POST))
#{
#    $NEWSLINK_NEWSLINKSUBMITTED_POST = "</div>";
#}
// *
// *
// *
if (!isset($NEWSLINK_NEWSLINKSUBMIT_PRE))
{
    $NEWSLINK_NEWSLINKSUBMIT_PRE = "<div class='fborder' style='" . USER_WIDTH . "' >";
}

if (!isset($NEWSLINK_NEWSLINKSUBMIT_FORM))
{
    $NEWSLINK_NEWSLINKSUBMIT_FORM = "
		<table style='" . USER_WIDTH . "'>
			<tr>
				<td class='fcaption' colspan='2'>" . NEWSLINK_3 . "</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2'>{NEWSLINK_SHOW_UP} <b>{NEWSLINK_SUBMIT_MSG}</b></td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:30%;vertical-align:top;' >" . NEWSLINK_130 . "</td>
				<td class='forumheader3' style='width:70%;vertical-align:top;' >{NEWSLINK_SUBMIT_POSTER} {NEWSLINK_EDIT_SECURE}</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:30%;vertical-align:top;' >" . NEWSLINK_16 . "</td>
				<td class='forumheader3' style='width:70%;vertical-align:top;'>{NEWSLINK_CAT_SEL=nosubmit}</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_14 . "</td>
				<td class='forumheader3' style='width:70%;vertical-align:top;'>{NEWSLINK_SUBMIT_NAME}</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_129 . "</td>
				<td class='forumheader3' style='width:70%;vertical-align:top;'>{NEWSLINK_SUBMIT_LINK}</td>
			</tr>
		    <tr>
				<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_13 . "</td>
				<td class='forumheader3' style='width:70%;vertical-align:top;'>{NEWSLINK_SUBMIT_BODY}</td>
			</tr>
			<tr>
				<td class='fcaption' colspan='2'>{NEWSLINK_SUBMIT_BUTTON}</td>
			</tr>
		</table>";
}

if (!isset($NEWSLINK_NEWSLINKSUBMIT_POST))
{
    $NEWSLINK_NEWSLINKSUBMIT_POST = "</div>";
}

?>