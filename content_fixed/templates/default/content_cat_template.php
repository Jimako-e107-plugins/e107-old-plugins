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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_cat_template.php $
|     $Revision: 11678 $
|     $Id: content_cat_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

global $sc_style, $content_shortcodes;

$sc_style['CONTENT_CAT_TABLE_ICON']['pre'] = "<td class='forumheader3' rowspan='5' style='width:5%; white-space:nowrap; padding-right:5px;'>";
$sc_style['CONTENT_CAT_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_CAT_TABLE_AUTHORDETAILS']['pre'] = " ";
$sc_style['CONTENT_CAT_TABLE_AUTHORDETAILS']['post'] = " ";

$sc_style['CONTENT_CAT_TABLE_SUBHEADING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_TABLE_SUBHEADING']['post'] = "<br /></td></tr>";

$sc_style['CONTENT_CAT_TABLE_TEXT']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_TABLE_TEXT']['post'] = "<br /></td></tr>";

$sc_style['CONTENT_CAT_TABLE_RATING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_TABLE_RATING']['post'] = "<br /></td></tr>";

$sc_style['CONTENT_CAT_TABLE_AMOUNT']['pre'] = "(";
$sc_style['CONTENT_CAT_TABLE_AMOUNT']['post'] = ")";

$sc_style['CONTENT_CAT_TABLE_INFO_PRE']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_TABLE_INFO_PRE']['post'] = "";

$sc_style['CONTENT_CAT_TABLE_INFO_POST']['pre'] = "";
$sc_style['CONTENT_CAT_TABLE_INFO_POST']['post'] = "</td></tr>";

// ##### CONTENT CAT ----------------------------------------------------------
if(!isset($CONTENT_CAT_TABLE_START)){
	$CONTENT_CAT_TABLE_START = "";
}
if(!isset($CONTENT_CAT_TABLE)){
	$CONTENT_CAT_TABLE = "
	<table class='fborder' style='width:98%; text-align:left; margin-bottom:5px;'>
	<tr>
		{CONTENT_CAT_TABLE_ICON}
		<td class='fcaption' >{CONTENT_CAT_TABLE_HEADING} {CONTENT_CAT_TABLE_AMOUNT}</td>
	</tr>

	{CONTENT_CAT_TABLE_INFO_PRE}
		{CONTENT_CAT_TABLE_DATE} {CONTENT_CAT_TABLE_AUTHORDETAILS} {CONTENT_CAT_TABLE_EPICONS} {CONTENT_CAT_TABLE_COMMENT}
	{CONTENT_CAT_TABLE_INFO_POST}

	{CONTENT_CAT_TABLE_SUBHEADING}
	{CONTENT_CAT_TABLE_TEXT}
	{CONTENT_CAT_TABLE_RATING}
	</table>\n";

}
if(!isset($CONTENT_CAT_TABLE_END)){
	$CONTENT_CAT_TABLE_END = "";
}
// ##### ----------------------------------------------------------------------



$sc_style['CONTENT_CAT_LIST_TABLE_ICON']['pre'] = "<td class='forumheader3' style='width:5%; white-space:nowrap; padding-right:5px;' rowspan='5'>";
$sc_style['CONTENT_CAT_LIST_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_CAT_LIST_TABLE_SUBHEADING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_LIST_TABLE_SUBHEADING']['post'] = "</td></tr>";

$sc_style['CONTENT_CAT_LIST_TABLE_AUTHORDETAILS']['pre'] = " / ";
$sc_style['CONTENT_CAT_LIST_TABLE_AUTHORDETAILS']['post'] = "";

$sc_style['CONTENT_CAT_LIST_TABLE_RATING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_LIST_TABLE_RATING']['post'] = "</td></tr>";

$sc_style['CONTENT_CAT_LIST_TABLE_TEXT']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_LIST_TABLE_TEXT']['post'] = "</td></tr>";

$sc_style['CONTENT_CAT_LIST_TABLE_AMOUNT']['pre'] = "(";
$sc_style['CONTENT_CAT_LIST_TABLE_AMOUNT']['post'] = ")";

$sc_style['CONTENT_CAT_LIST_TABLE_INFO_PRE']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_LIST_TABLE_INFO_PRE']['post'] = "";

$sc_style['CONTENT_CAT_LIST_TABLE_INFO_POST']['pre'] = "";
$sc_style['CONTENT_CAT_LIST_TABLE_INFO_POST']['post'] = "</td></tr>";

// ##### CONTENT CAT_LIST -----------------------------------------------------
if(!isset($CONTENT_CAT_LIST_TABLE)){
	$CONTENT_CAT_LIST_TABLE = "
	<table class='fborder' style='width:98%; text-align:left; margin-bottom:10px;'>
	<tr>
		{CONTENT_CAT_LIST_TABLE_ICON}
		<td class='fcaption'>{CONTENT_CAT_LIST_TABLE_HEADING} {CONTENT_CAT_LIST_TABLE_AMOUNT}</td>
	</tr>
	{CONTENT_CAT_LIST_TABLE_SUBHEADING}
	
	{CONTENT_CAT_LIST_TABLE_INFO_PRE}
		{CONTENT_CAT_LIST_TABLE_DATE} {CONTENT_CAT_LIST_TABLE_AUTHORDETAILS} {CONTENT_CAT_LIST_TABLE_EPICONS} {CONTENT_CAT_LIST_TABLE_COMMENT}
	{CONTENT_CAT_LIST_TABLE_INFO_POST}

	{CONTENT_CAT_LIST_TABLE_RATING}
	{CONTENT_CAT_LIST_TABLE_TEXT}
	</table>\n";
}
// ##### ----------------------------------------------------------------------



$sc_style['CONTENT_CAT_LISTSUB_TABLE_ICON']['pre'] = "<td class='forumheader3' style='width:2%; white-space:nowrap; padding-right:5px; ' rowspan='2'>";
$sc_style['CONTENT_CAT_LISTSUB_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_CAT_LISTSUB_TABLE_SUBHEADING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_CAT_LISTSUB_TABLE_SUBHEADING']['post'] = "</td></tr>";

$sc_style['CONTENT_CAT_LISTSUB_TABLE_AMOUNT']['pre'] = "(";
$sc_style['CONTENT_CAT_LISTSUB_TABLE_AMOUNT']['post'] = ")";

// ##### CONTENT CAT_LIST SUB -------------------------------------------------
if(!isset($CONTENT_CAT_LISTSUB_TABLE_START)){
	$CONTENT_CAT_LISTSUB_TABLE_START = "";
}
if(!isset($CONTENT_CAT_LISTSUB_TABLE)){
	$CONTENT_CAT_LISTSUB_TABLE = "
	<table class='fborder' style='width:98%; text-align:left; margin-bottom:5px;'>
	<tr>
		{CONTENT_CAT_LISTSUB_TABLE_ICON}
		<td class='fcaption'>{CONTENT_CAT_LISTSUB_TABLE_HEADING} {CONTENT_CAT_LISTSUB_TABLE_AMOUNT}</td>
	</tr>
	{CONTENT_CAT_LISTSUB_TABLE_SUBHEADING}
	</table>\n";
}
if(!isset($CONTENT_CAT_LISTSUB_TABLE_END)){
	$CONTENT_CAT_LISTSUB_TABLE_END = "<br />";
}
// ##### ----------------------------------------------------------------------

?>