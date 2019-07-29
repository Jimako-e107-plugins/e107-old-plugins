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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_recent_template.php $
|     $Revision: 11678 $
|     $Id: content_recent_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

// ##### CONTENT RECENT LIST --------------------------------------------------


global $sc_style, $content_shortcodes;

$sc_style['CONTENT_RECENT_TABLE_ICON']['pre'] = "<td class='forumheader3' rowspan='7' style='vertical-align:top; width:10%; white-space:nowrap; padding-right:10px;'>";
$sc_style['CONTENT_RECENT_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_RECENT_TABLE_DATE']['pre'] = CONTENT_LAN_10." ";
$sc_style['CONTENT_RECENT_TABLE_DATE']['post'] = "";

$sc_style['CONTENT_RECENT_TABLE_PARENT']['pre'] = CONTENT_LAN_9." ";
$sc_style['CONTENT_RECENT_TABLE_PARENT']['post'] = "";

$sc_style['CONTENT_RECENT_TABLE_REFER']['pre'] = " (".CONTENT_LAN_44." ";
$sc_style['CONTENT_RECENT_TABLE_REFER']['post'] = ")";

$sc_style['CONTENT_RECENT_TABLE_AUTHORDETAILS']['pre'] = CONTENT_LAN_11." ";
$sc_style['CONTENT_RECENT_TABLE_AUTHORDETAILS']['post'] = "";

$sc_style['CONTENT_RECENT_TABLE_SUBHEADING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_RECENT_TABLE_SUBHEADING']['post'] = "</td></tr>";

$sc_style['CONTENT_RECENT_TABLE_SUMMARY']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_RECENT_TABLE_SUMMARY']['post'] = "</td></tr>";

$sc_style['CONTENT_RECENT_TABLE_TEXT']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_RECENT_TABLE_TEXT']['post'] = "</td></tr>";

$sc_style['CONTENT_RECENT_TABLE_RATING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_RECENT_TABLE_RATING']['post'] = "</td></tr>";

$sc_style['CONTENT_RECENT_TABLE_INFOPRE']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_RECENT_TABLE_INFOPRE']['post'] = "";

$sc_style['CONTENT_RECENT_TABLE_INFOPOST']['pre'] = "";
$sc_style['CONTENT_RECENT_TABLE_INFOPOST']['post'] = "</td></tr>";

if(!isset($CONTENT_RECENT_TABLE_START)){
	$CONTENT_RECENT_TABLE_START = "";
}
if(!isset($CONTENT_RECENT_TABLE)){
	$CONTENT_RECENT_TABLE = "
	<table class='fborder' style='width:98%; text-align:left;margin-bottom:5px;'>
		<tr>
			{CONTENT_RECENT_TABLE_ICON}
			<td class='fcaption'>{CONTENT_RECENT_TABLE_HEADING} {CONTENT_RECENT_TABLE_REFER}</td>
		</tr>
		{CONTENT_RECENT_TABLE_SUBHEADING}
		
		{CONTENT_RECENT_TABLE_INFOPRE}
			{CONTENT_RECENT_TABLE_DATE} {CONTENT_RECENT_TABLE_AUTHORDETAILS} {CONTENT_RECENT_TABLE_PARENT} {CONTENT_RECENT_TABLE_EPICONS} {CONTENT_RECENT_TABLE_EDITICON}
		{CONTENT_RECENT_TABLE_INFOPOST}

		{CONTENT_RECENT_TABLE_SUMMARY}
		{CONTENT_RECENT_TABLE_TEXT}
		{CONTENT_RECENT_TABLE_RATING}
	</table>\n";
}
if(!isset($CONTENT_RECENT_TABLE_END)){
	$CONTENT_RECENT_TABLE_END = "";
}
// ##### ----------------------------------------------------------------------

?>