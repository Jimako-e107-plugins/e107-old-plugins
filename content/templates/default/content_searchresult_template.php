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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_searchresult_template.php $
|     $Revision: 11678 $
|     $Id: content_searchresult_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

global $sc_style, $content_shortcodes;

$sc_style['CONTENT_SEARCHRESULT_TABLE_ICON']['pre'] = "<td class='forumheader3'>";
$sc_style['CONTENT_SEARCHRESULT_TABLE_ICON']['post'] = "</td>";

$sc_style['CONTENT_SEARCHRESULT_TABLE_HEADING']['pre'] = "<tr><td class='fcaption'>";
$sc_style['CONTENT_SEARCHRESULT_TABLE_HEADING']['post'] = "</td></tr>";

$sc_style['CONTENT_SEARCHRESULT_TABLE_SUBHEADING']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_SEARCHRESULT_TABLE_SUBHEADING']['post'] = "</td></tr>";

$sc_style['CONTENT_SEARCHRESULT_TABLE_DATE']['pre'] = CONTENT_LAN_10." ";
$sc_style['CONTENT_SEARCHRESULT_TABLE_DATE']['post'] = "";

$sc_style['CONTENT_SEARCHRESULT_TABLE_AUTHORDETAILS']['pre'] = CONTENT_LAN_11." ";
$sc_style['CONTENT_SEARCHRESULT_TABLE_AUTHORDETAILS']['post'] = "";

$sc_style['CONTENT_SEARCHRESULT_TABLE_TEXT']['pre'] = "<tr><td class='forumheader3'>";
$sc_style['CONTENT_SEARCHRESULT_TABLE_TEXT']['post'] = "</td></tr>";

// ##### CONTENT SEARCHRESULT LIST --------------------------------------------------
if(!isset($CONTENT_SEARCHRESULT_TABLE_START)){
	$CONTENT_SEARCHRESULT_TABLE_START = "";
}
if(!isset($CONTENT_SEARCHRESULT_TABLE)){
	$CONTENT_SEARCHRESULT_TABLE .= "
	<table class='fborder' style='width:98%; text-align:left;margin-bottom:5px;'>
		<tr>
			{CONTENT_SEARCHRESULT_TABLE_ICON}
			<td>
				<table style='width:100%;' cellpadding='0' cellspacing='0'>
					{CONTENT_SEARCHRESULT_TABLE_HEADING}
					{CONTENT_SEARCHRESULT_TABLE_SUBHEADING}
					<tr><td class='forumheader3'>{CONTENT_SEARCHRESULT_TABLE_AUTHORDETAILS} {CONTENT_SEARCHRESULT_TABLE_DATE}</td></tr>
					{CONTENT_SEARCHRESULT_TABLE_TEXT}
				</table>
			</td>
		</tr>
	</table>\n";
}
if(!isset($CONTENT_SEARCHRESULT_TABLE_END)){
	$CONTENT_SEARCHRESULT_TABLE_END .= "";
}
// ##### ----------------------------------------------------------------------

?>