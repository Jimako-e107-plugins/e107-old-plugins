<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_content_template.php $
|     $Revision: 11678 $
|     $Id: content_content_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

// ##### CONTENT CONTENT ------------------------------------------------------
global $sc_style, $content_shortcodes;

$sc_style['CONTENT_CONTENT_TABLE_REFER']['pre'] = "<br />".CONTENT_LAN_44." ";
$sc_style['CONTENT_CONTENT_TABLE_REFER']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_COMMENT']['pre'] = "<br />".CONTENT_LAN_57." ";
$sc_style['CONTENT_CONTENT_TABLE_COMMENT']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_SCORE']['pre'] = "<br />".CONTENT_LAN_45." ";
$sc_style['CONTENT_CONTENT_TABLE_SCORE']['post'] = "/100";

$sc_style['CONTENT_CONTENT_TABLE_RATING']['pre'] = "<br />";
$sc_style['CONTENT_CONTENT_TABLE_RATING']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_AUTHORDETAILS']['pre'] = "<br />".CONTENT_LAN_11." ";
$sc_style['CONTENT_CONTENT_TABLE_AUTHORDETAILS']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_PAGENAMES']['pre'] = "<br /><div>".CONTENT_LAN_46."<br />";
$sc_style['CONTENT_CONTENT_TABLE_PAGENAMES']['post'] = "</div>";

$sc_style['CONTENT_CONTENT_TABLE_CUSTOM_TAGS']['pre'] = "<br /><br />";
$sc_style['CONTENT_CONTENT_TABLE_CUSTOM_TAGS']['post'] = "<br /><br />";

$sc_style['CONTENT_CONTENT_TABLE_SUMMARY']['pre'] = "<div>";
$sc_style['CONTENT_CONTENT_TABLE_SUMMARY']['post'] = "<br /><br /></div>";

$sc_style['CONTENT_CONTENT_TABLE_TEXT']['pre'] = "<div>";
$sc_style['CONTENT_CONTENT_TABLE_TEXT']['post'] = "</div>";

$sc_style['CONTENT_CONTENT_TABLE_IMAGES']['pre'] = "<div style='float:left; padding-right:10px;'>";
$sc_style['CONTENT_CONTENT_TABLE_IMAGES']['post'] = "</div>";

$sc_style['CONTENT_CONTENT_TABLE_SUBHEADING']['pre'] = "";
$sc_style['CONTENT_CONTENT_TABLE_SUBHEADING']['post'] = "<br />";

$sc_style['CONTENT_CONTENT_TABLE_FILE']['pre'] = "<br />";
$sc_style['CONTENT_CONTENT_TABLE_FILE']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_DATE']['pre'] = CONTENT_LAN_10." ";
$sc_style['CONTENT_CONTENT_TABLE_DATE']['post'] = "";

$sc_style['CONTENT_CONTENT_TABLE_PARENT']['pre'] = "<br />".CONTENT_LAN_9." ";
$sc_style['CONTENT_CONTENT_TABLE_PARENT']['post'] = "";

//$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE']['pre'] = "<div style='clear:both;'><div style='float:left;'>";
//$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE']['post'] = "";
//$sc_style['CONTENT_CONTENT_TABLE_INFO_POST']['pre'] = "";
//$sc_style['CONTENT_CONTENT_TABLE_INFO_POST']['post'] = "</div></div>";

//$sc_style['CONTENT_CONTENT_TABLE_ICON']['pre'] = "<div style='float:left; padding-right:10px;'>";
//$sc_style['CONTENT_CONTENT_TABLE_ICON']['post'] = "</div>";

$sc_style['CONTENT_CONTENT_TABLE_ICON']['pre'] = "<td style='width:10%; white-space:nowrap; vertical-align:top; padding-right:10px;'>";
$sc_style['CONTENT_CONTENT_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE']['pre'] = "<table cellpadding='0' cellspacing='0' style='width:100%; margin-bottom:20px;'><tr>";
$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE']['post'] = "";
$sc_style['CONTENT_CONTENT_TABLE_INFO_POST']['pre'] = "";
$sc_style['CONTENT_CONTENT_TABLE_INFO_POST']['post'] = "</tr></table>";

$sc_style['CONTENT_CONTENT_TABLE_PREV_PAGE']['pre'] = "<div style='clear:both; padding-bottom:20px; padding-top:20px;'><div style='float:left;'>";
$sc_style['CONTENT_CONTENT_TABLE_PREV_PAGE']['post'] = "</div>";
$sc_style['CONTENT_CONTENT_TABLE_NEXT_PAGE']['pre'] = "<div style='float:right;'>";
$sc_style['CONTENT_CONTENT_TABLE_NEXT_PAGE']['post'] = "</div></div>";

$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE_HEADDATA']['pre'] = "<td style='vertical-align:top;'>";
$sc_style['CONTENT_CONTENT_TABLE_INFO_PRE_HEADDATA']['post'] = "";
$sc_style['CONTENT_CONTENT_TABLE_INFO_POST_HEADDATA']['pre'] = "";
$sc_style['CONTENT_CONTENT_TABLE_INFO_POST_HEADDATA']['post'] = "</td>";


$CONTENT_CONTENT_TABLE = "<table class='fborder' cellpadding='0' cellspacing='0' style='width:100%;'><tr><td>
<div style='clear:both;'>

	{CONTENT_CONTENT_TABLE_INFO_PRE}
		{CONTENT_CONTENT_TABLE_ICON}
		{CONTENT_CONTENT_TABLE_INFO_PRE_HEADDATA}
			{CONTENT_CONTENT_TABLE_SUBHEADING}
			{CONTENT_CONTENT_TABLE_DATE} {CONTENT_CONTENT_TABLE_AUTHORDETAILS} {CONTENT_CONTENT_TABLE_EPICONS} {CONTENT_CONTENT_TABLE_EDITICON} {CONTENT_CONTENT_TABLE_PARENT} {CONTENT_CONTENT_TABLE_COMMENT} {CONTENT_CONTENT_TABLE_SCORE} {CONTENT_CONTENT_TABLE_REFER}
			{CONTENT_CONTENT_TABLE_RATING}
			{CONTENT_CONTENT_TABLE_FILE}
		{CONTENT_CONTENT_TABLE_INFO_POST_HEADDATA}
	{CONTENT_CONTENT_TABLE_INFO_POST}
	<div style='clear:both;'><br /></div>
	<table class='fborder' cellpadding='0' cellspacing='0' style='width:100%;'><tr><td class='forumheader3'>
		{CONTENT_CONTENT_TABLE_IMAGES}
		{CONTENT_CONTENT_TABLE_SUMMARY}
		{CONTENT_CONTENT_TABLE_TEXT}
		{CONTENT_CONTENT_TABLE_CUSTOM_TAGS}
		{CONTENT_CONTENT_TABLE_PAGENAMES}
		{CONTENT_CONTENT_TABLE_PREV_PAGE}{CONTENT_CONTENT_TABLE_NEXT_PAGE}
	</td></tr></table>
</div>
</td></tr></table>\n";

// ##### ----------------------------------------------------------------------

$CONTENT_CONTENT_TABLE_CUSTOM_START = "<table style='width:100%;margin-left:0;padding-left:0;' cellspacing='0' cellpadding='0' >";

$CONTENT_CONTENT_TABLE_CUSTOM = "
<tr>
	<td style='width:25%;white-space:nowrap; vertical-align:top; line-height:150%;'>
		{CONTENT_CONTENT_TABLE_CUSTOM_KEY}
	</td>
	<td style='width:90%; line-height:150%;'>
		{CONTENT_CONTENT_TABLE_CUSTOM_VALUE}
	</td>
</tr>";

$CONTENT_CONTENT_TABLE_CUSTOM_END = "</table>";

?>