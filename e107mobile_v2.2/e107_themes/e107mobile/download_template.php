<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_themes/templates/download_template.php,v $
|     $Revision: 1.18 $
|     $Date: 2007/09/20 11:08:14 $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:100%"); }


/* set style of download image and thumbnail */
define("DL_IMAGESTYLE","border:0px");

// ##### CAT TABLE --------------------------------------------------------------------------------
if(!isset($DOWNLOAD_CAT_TABLE_START))
{
                $DOWNLOAD_CAT_TABLE_START = "
                <div style='text-align:center'>
                <table class='fborder' style='".USER_WIDTH."'>
                <tr>
                <td style='width:70%; text-align:center' class='fcaption'>".LAN_dl_19."</td>
                <td style='width:10%; text-align:center' class='fcaption'>".LAN_dl_20."</td>
                <td style='width:15%; text-align:center' class='fcaption'>".LAN_dl_77."</td>
                </tr>";
}
if(!isset($DOWNLOAD_CAT_PARENT_TABLE))
{
                $DOWNLOAD_CAT_PARENT_TABLE = "";
}

if(!isset($DOWNLOAD_CAT_CHILD_TABLE))
{
                $DOWNLOAD_CAT_CHILD_TABLE = "
                <tr>
                <td class='forumheader3'>
                        {DOWNLOAD_CAT_SUB_NEW_ICON} {DOWNLOAD_CAT_SUB_NAME}<br />
                        <span class='smalltext'>
                        {DOWNLOAD_CAT_SUB_DESCRIPTION}
                        </span>
                </td>
                <td class='forumheader3' style='text-align:center;'>
                        {DOWNLOAD_CAT_SUB_COUNT}
                </td>
                <td class='forumheader3' style='text-align:center;'>
                        {DOWNLOAD_CAT_SUB_DOWNLOADED}
                </td>
                </tr>
                {DOWNLOAD_CAT_SUBSUB}
                ";

}

if(!isset($DOWNLOAD_CAT_SUBSUB_TABLE))
{
	$DOWNLOAD_CAT_SUBSUB_TABLE = "
	<tr>
		<td class='forumheader3' style='width:100%'>
			<table>
			<tr>
				<td class='forumheader3' style='border:0'>".
				LAN_dl_42."
				</td>
				<td class='forumheader3' style='border:0'>
				{DOWNLOAD_CAT_SUBSUB_ICON}
				</td>
				<td class='forumheader3' style='border:0; width: 100%'>
					{DOWNLOAD_CAT_SUBSUB_NEW_ICON} {DOWNLOAD_CAT_SUBSUB_NAME}<br />
					<span class='smalltext'>
					{DOWNLOAD_CAT_SUBSUB_DESCRIPTION}
					</span>
				</td>
			</tr>
			</table>
		</td>

	<td class='forumheader3' style='text-align:center;'>
		{DOWNLOAD_CAT_SUBSUB_COUNT}
	</td>
	<td class='forumheader3' style='text-align:center;'>
		{DOWNLOAD_CAT_SUBSUB_DOWNLOADED}
	</td>
	</tr>";
}

if(!isset($DOWNLOAD_CAT_TABLE_END))
{
                $DOWNLOAD_CAT_TABLE_END = "
                <tr><td class='forumheader3' colspan='3' style='text-align:right;'>{DOWNLOAD_CAT_NEWDOWNLOAD_TEXT}</td></tr>
                </table>
                </div>\n";
}
// ##### ------------------------------------------------------------------------------------------



// ##### LIST TABLE -------------------------------------------------------------------------------
if(!isset($DOWNLOAD_LIST_TABLE_START))
{
                $DOWNLOAD_LIST_TABLE_START = "
                <div style='text-align:center'>
        
		<table class='fborder' style='".USER_WIDTH."'>\n
        <tr>
        <td style='width:50%; text-align:center' class='fcaption'>".LAN_dl_28."</td>
        <td style='width:30%; text-align:center' class='fcaption'>".LAN_dl_24."</td>
        <td style='width:10%; text-align:center' class='fcaption'>".LAN_dl_29."</td>
        <td style='width:10%; text-align:center' class='fcaption'>".LAN_dl_8."</td>
        </tr>";

}

if(!isset($DOWNLOAD_LIST_TABLE))
{
		$DOWNLOAD_LIST_TABLE = "
		<tr>
		<td class='forumheader3' style='width:50%; text-align:left;'>
		{DOWNLOAD_LIST_NEWICON} {DOWNLOAD_LIST_NAME}
		</td>
		<td class='forumheader3' style='width:30%; text-align:center;'>
		{DOWNLOAD_LIST_AUTHOR}
		</td>
		<td class='forumheader3' style='width:10%; text-align:center;'>
		{DOWNLOAD_LIST_REQUESTED}
		</td>
		<td class='forumheader3' style='width:10%; text-align:center;'>
		{DOWNLOAD_LIST_LINK} {DOWNLOAD_LIST_ICON}</a>
		</td>
		</tr>";
}

if(!isset($DOWNLOAD_LIST_TABLE_END))
{
		$DOWNLOAD_LIST_TABLE_END = "<table class='fborder' style='".USER_WIDTH."'>\n
        <tr><td class='forumheader3' style='text-align:right;'>{DOWNLOAD_LIST_TOTAL_AMOUNT} {DOWNLOAD_LIST_TOTAL_FILES}</td></tr>
		</table>
		</form>
		</div>\n";
}
// ##### ------------------------------------------------------------------------------------------


// ##### VIEW TABLE -------------------------------------------------------------------------------

$DL_VIEW_PAGETITLE = PAGE_NAME." / {DOWNLOAD_CATEGORY} / {DOWNLOAD_VIEW_NAME}";
$DL_VIEW_CAPTION = "{DOWNLOAD_VIEW_CAPTION}";

if(!isset($DL_VIEW_NEXTPREV))
{
		$DL_VIEW_NEXTPREV = "
		<div style='text-align:center'>
			<table style='".USER_WIDTH."'>
			<tr>
			<td style='width:40%;'>{DOWNLOAD_VIEW_PREV}</td>
			<td style='width:20%; text-align: center;'>{DOWNLOAD_BACK_TO_LIST}</td>
			<td style='width:40%; text-align: right;'>{DOWNLOAD_VIEW_NEXT}</td>
			</tr>
			</table>
		</div>\n";
}

// Only renders the following rows when data is present.
$sc_style['DOWNLOAD_VIEW_AUTHOR_LAN']['pre'] = "<tr><td style='width:20%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHOR_LAN']['post'] = "</td>";

$sc_style['DOWNLOAD_VIEW_AUTHOR']['pre'] = "<td style='width:80%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHOR']['post'] = "</td></tr>";

$sc_style['DOWNLOAD_VIEW_AUTHOREMAIL_LAN']['pre'] = "<tr><td style='width:20%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHOREMAIL_LAN']['post'] = "</td>";

$sc_style['DOWNLOAD_VIEW_AUTHOREMAIL']['pre'] = "<td style='width:80%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHOREMAIL']['post'] = "</td></tr>";

$sc_style['DOWNLOAD_VIEW_AUTHORWEBSITE_LAN']['pre'] = "<tr><td style='width:20%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHORWEBSITE_LAN']['post'] = "</td>";

$sc_style['DOWNLOAD_VIEW_AUTHORWEBSITE']['pre'] = "<td style='width:80%' class='forumheader3'>";
$sc_style['DOWNLOAD_VIEW_AUTHORWEBSITE']['post'] = "</td></tr>";

if(!isset($DOWNLOAD_VIEW_TABLE))
{
		$DOWNLOAD_VIEW_TABLE = "
        <div style='text-align:center'>
		<table class='fborder' style='".USER_WIDTH."'>
		<tr>
		<td colspan='2' class='fcaption' style='text-align:left;'>
		{DOWNLOAD_VIEW_NAME}
		</td>
		</tr>

		{DOWNLOAD_VIEW_AUTHOR_LAN}
		{DOWNLOAD_VIEW_AUTHOR}

		{DOWNLOAD_VIEW_AUTHOREMAIL_LAN}
		{DOWNLOAD_VIEW_AUTHOREMAIL}

		{DOWNLOAD_VIEW_AUTHORWEBSITE_LAN}
		{DOWNLOAD_VIEW_AUTHORWEBSITE}

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_DESCRIPTION_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_DESCRIPTION}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_IMAGE_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_IMAGE}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_FILESIZE_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_FILESIZE}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_DATE_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_DATE=long}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_REQUESTED_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_REQUESTED}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_LINK_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_LINK}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3'>{DOWNLOAD_VIEW_RATING_LAN}</td>
		<td style='width:80%' class='forumheader3'>{DOWNLOAD_VIEW_RATING}</td>
		</tr>

		<tr>
		<td style='width:20%' class='forumheader3' colspan='2'>{DOWNLOAD_REPORT_LINK}</td>
		</tr>
		</table>
		<div style='text-align:right; ".USER_WIDTH."; margin-left: auto; margin-right: auto'>{DOWNLOAD_ADMIN_EDIT}</div>
		</div>\n";
}

// ##### ------------------------------------------------------------------------------------------

// ##### MIRROR LIST -------------------------------------------------------------------------------

if(!isset($DOWNLOAD_MIRROR_START))
{
	$DOWNLOAD_MIRROR_START = "
	<div style='text-align:center'>
	<table class='fborder' style='".USER_WIDTH."'>
	<tr>
	<td class='fcaption' colspan='4'>{DOWNLOAD_MIRROR_REQUEST}</td>
	</tr>
	<tr>
	<td class='forumheader' style='width: 30%; text-align: center;'>{DOWNLOAD_MIRROR_HOST_LAN}</td>
	<td class='forumheader' style='width: 40%;'>{DOWNLOAD_MIRROR_DESCRIPTION_LAN}</td>
	<td class='forumheader' style='width: 20%; text-align: center;'>{DOWNLOAD_MIRROR_LOCATION_LAN}</td>
	<td class='forumheader' style='width: 10%; text-align: center;'>{DOWNLOAD_MIRROR_GET_LAN}</td>
	</tr>
	";
}

if(!isset($DOWNLOAD_MIRROR))
{
	$DOWNLOAD_MIRROR = "
	<tr>
	<td class='forumheader3' style='width: 30%; text-align: center;'>{DOWNLOAD_MIRROR_IMAGE}<br /><br /><div class='smalltext'>{DOWNLOAD_MIRROR_REQUESTS}<br />{DOWNLOAD_TOTAL_MIRROR_REQUESTS}</div></td>
	<td class='forumheader3' style='width: 40%'><div class='smalltext'>{DOWNLOAD_MIRROR_DESCRIPTION}</div></td>
	<td class='forumheader3' style='width: 20%;; text-align: center;'>{DOWNLOAD_MIRROR_LOCATION}</td>
	<td class='forumheader3' style='width: 10%; text-align: center;'><div class='smalltext'>{DOWNLOAD_MIRROR_LINK} {DOWNLOAD_MIRROR_FILESIZE}</div></td>
	</tr>
	";
}

if(!isset($DOWNLOAD_MIRROR_END))
{
	$DOWNLOAD_MIRROR_END = "
	</table>
	</div>
	";
}

// ##### ------------------------------------------------------------------------------------------
?>