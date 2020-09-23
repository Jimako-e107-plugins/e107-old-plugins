<?php
// *************************************************************************
// *
// * 	Characters (eg brackets) before and after the age
// *
// *************************************************************************
$BDAY_AGE_PRE = '(';
$BDAY_AGE_POST = ')';

// using divs which is a pain for cross browser compatibility and will be dropped
/*
// *************************************************************************
// *
// * 	First part of menu display
// *
// *		BDAY_TITLE - no birthdays, one or all message
// *		BDAY_LOGO - logo eg birthday cake gif
// *
// *************************************************************************
if (!isset($BDAY_MENU_HEADER))
{
    $BDAY_MENU_HEADER = '
<div style="text-align:center;">
	<div style="font-size:11px;text-align:center;"><b>{BDAY_TITLE}</b><br />{BDAY_LOGO}</div>';
}
// *************************************************************************
// *
// * 	Show this if there are no birthdays today.
// *
// *
// *************************************************************************
if (!isset($BDAY_MENU_NONE))
{
    $BDAY_MENU_NONE = '<br />
    <div style="width:100%;text-align:center;font-size:11px;"><b>' . BDAY_LAN_6 . '</b></div>';
}
if (!isset($BDAY_MENU_NEXTHEADER))
{
    $BDAY_MENU_NEXTHEADER = '<br />
    <div style="width:100%;text-align:center;font-size:11px;"><b>' . BDAY_LAN_5 . '</b></div>';
}
// *************************************************************************
// *
// * 	Each birthday that occurs today
// *
// *		BDAY_USER - Displays the users name with link to their profile page
// *		BDAY_AGE - 	Display their age (if set in config) with pre and post
// *					characters, use nolinks to remove link to profile
// *
// *************************************************************************
// BDAY_LINEHEIGHT height of each row
// parameter in shortcode nolink to onit link to user info page
if (!isset($BDAY_MENU_DETAIL))
{
    if (BDAY_AVATAR == 1)
    {
        // avatars on
        $BDAY_MENU_DETAIL = '
    <div style="display:table-cell;vertical-align:middle;width:' . BDAY_LINEHEIGHT . 'px;height:' . BDAY_LINEHEIGHT . 'px;float:left;">{BDAY_AVATAR}</div>&nbsp;
	<div style="display:table-cell;vertical-align:middle;height:' . BDAY_LINEHEIGHT . 'px;float:left;">&nbsp;&nbsp;{BDAY_USER=link} {BDAY_AGE=nolink}</div>
	<div style="clear:both"></div>
	<br />';
    }
    else
    {
        // avatars off
        $BDAY_MENU_DETAIL = '
	<br />';
    }
}
// *************************************************************************
// *
// * 	Future birthdays
// *
// *		BDAY_UPCOMING - Displays the users name with link to their profile page
// *		BDAY_UPDATE - 	Display date of birthday date format in config
// *		BDATE_UPAGE - 	Display their age (if set in config) with pre and post
// *						characters, use nolinks to remove link to profile
// *
// *************************************************************************
if (!isset($BDAY_MENU_FUTURE))
{
    if (BDAY_AVATAR == 1)
    {
        $BDAY_MENU_FUTURE = '
    <div style="display:table-cell;vertical-align:middle;width:' . BDAY_LINEHEIGHT . 'px;height:' . BDAY_LINEHEIGHT . 'px;float:left;">{BDAY_AVATAR}</div>&nbsp;
	<div style="display:table-cell;vertical-align:middle;height:' . BDAY_LINEHEIGHT . 'px;float:left;">&nbsp;&nbsp;{BDAY_UPCOMING=link} {BDAY_UPDATE=nolink} {BDATE_UPAGE=nolink}</div>
	<div style="clear:both"></div>';
    }
    else
    {
        $BDAY_MENU_FUTURE = '
    <div style="text-align:center;" >{BDAY_UPCOMING=link} {BDAY_UPDATE=nolink} {BDATE_UPAGE=nolink}</div>';
    }
}

if (!isset($BDAY_MENU_FOOTER))
{
    $BDAY_MENU_FOOTER = '
{BDAY_DEMO}
</div>
    ';
}
*/
// *************************************************************************
// *
// * 	First part of menu display
// *
// *		BDAY_TITLE - no birthdays, one or all message
// *		BDAY_LOGO - logo eg birthday cake gif
// *
// *************************************************************************
if (!isset($BDAY_MENU_HEADER))
{
    $BDAY_MENU_HEADER = '
<table style="width:100%">';
}
if (!isset($BDAY_MENU_TODAY))
{
    $BDAY_MENU_TODAY = '
	<tr>
		<td colspan="2" style="text-align:center;">
			<span style="font-size:11px;text-align:center;"><b>{BDAY_TITLE}</b><br />{BDAY_LOGO}</span>
		</td>
	</tr>
	';
}
// *************************************************************************
// *
// * 	Show this if there are no birthdays today.
// *
// *
// *************************************************************************
if (!isset($BDAY_MENU_NONE))
{
    $BDAY_MENU_NONE = '
	<tr>
		<td colspan="2" style="text-align:center;">
    		<span style="text-align:center;font-size:11px;"><b>' . BDAY_LAN_6 . '</b></span>
		</td>
	</tr>';
}
if (!isset($BDAY_MENU_NEXTHEADER))
{
    $BDAY_MENU_NEXTHEADER = '
    <tr>
    	<td colspan="2" style="text-align:center;">
    		<br /><span style="text-align:center;font-size:11px;"><b>' . BDAY_LAN_5 . '</b></span>
		</td>
	</tr>';
}
// *************************************************************************
// *
// * 	Each birthday that occurs today
// *
// *		BDAY_USER - Displays the users name with link to their profile page
// *		BDAY_AGE - 	Display their age (if set in config) with pre and post
// *					characters, use nolinks to remove link to profile
// *
// *************************************************************************
// BDAY_LINEHEIGHT height of each row
// parameter in shortcode nolink to onit link to user info page
if (!isset($BDAY_MENU_DETAIL))
{
    if (BDAY_AVATAR == 1)
    {
        // avatars on
        $BDAY_MENU_DETAIL = '
    <tr>
    	<td style="vertical-align:middle;width:' . BDAY_LINEHEIGHT . 'px;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_AVATAR}</td>
    	<td style="vertical-align:middle;text-align:left;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_USER=link} {BDAY_AGE=nolink}</td>
	</tr>';
    }
    else
    {
        // avatars off
        $BDAY_MENU_DETAIL = '
	<tr>
		<td style="vertical-align:middle;text-align:left;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_USER=link} {BDAY_AGE=nolink}</td>
		<td style="width:1px;">&nbsp;</td>
	</tr>';
    }
}
// *************************************************************************
// *
// * 	Future birthdays
// *
// *		BDAY_UPCOMING - Displays the users name with link to their profile page
// *		BDAY_UPDATE - 	Display date of birthday date format in config
// *		BDATE_UPAGE - 	Display their age (if set in config) with pre and post
// *						characters, use nolinks to remove link to profile
// *
// *************************************************************************
if (!isset($BDAY_MENU_FUTURE))
{
    if (BDAY_AVATAR == 1)
    {
        $BDAY_MENU_FUTURE = '
    <tr>
    	<td style="vertical-align:middle;width:' . BDAY_LINEHEIGHT . 'px;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_AVATAR}</td>
    	<td style="vertical-align:middle;text-align:left;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_UPCOMING=link} {BDAY_UPDATE=nolink} {BDATE_UPAGE=nolink}</td>
	</tr>';
    }
    else
    {
        $BDAY_MENU_FUTURE = '
	<tr>
    	<td style="vertical-align:middle;text-align:left;height:' . BDAY_LINEHEIGHT . 'px;">{BDAY_UPCOMING=link} {BDAY_UPDATE=nolink} {BDATE_UPAGE=nolink}</td>
    	<td style="width:1px;" >&nbsp;</td>
	</tr>';
    }
}
if (!isset($BDAY_MENU_NOFUTURE))
{
$BDAY_MENU_NOFUTURE='
	<tr>
		<td style="text-align:center;" colspan="2">'.BDAY_LAN_12.'</td>
	</tr>';
}
if (!isset($BDAY_MENU_FOOTER))
{
    $BDAY_MENU_FOOTER = '
	<tr>
		<td style="text-align:center;" colspan="2"><br />{BDAY_DEMO}</td>
	</tr>
</table>
    ';
}

