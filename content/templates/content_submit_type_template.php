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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/content_submit_type_template.php $
|     $Revision: 11678 $
|     $Id: content_submit_type_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
global $sc_style, $content_shortcodes;

$sc_style['CONTENT_SUBMIT_TYPE_TABLE_ICON']['pre'] = "";
$sc_style['CONTENT_SUBMIT_TYPE_TABLE_ICON']['post'] = "";

$sc_style['CONTENT_SUBMIT_TYPE_TABLE_SUBHEADING']['pre'] = "";
$sc_style['CONTENT_SUBMIT_TYPE_TABLE_SUBHEADING']['post'] = "";

// ##### CONTENT SUBMIT TYPE LIST --------------------------------------------------
if(!isset($CONTENT_SUBMIT_TYPE_TABLE_START)){
				$CONTENT_SUBMIT_TYPE_TABLE_START = "
				<table class='fborder' style='width:98%; text-align:left;'>\n";
}
if(!isset($CONTENT_SUBMIT_TYPE_TABLE)){
				$CONTENT_SUBMIT_TYPE_TABLE = "
				<tr>
					<td class='forumheader3' style='width:10%; white-space:nowrap;' rowspan='2'>{CONTENT_SUBMIT_TYPE_TABLE_ICON}</td>
					<td class='forumheader3'>{CONTENT_SUBMIT_TYPE_TABLE_HEADING}</td>
				</tr>
				<tr><td class='forumheader3'>{CONTENT_SUBMIT_TYPE_TABLE_SUBHEADING}<br /></td></tr>\n";
}
if(!isset($CONTENT_SUBMIT_TYPE_TABLE_END)){
				$CONTENT_SUBMIT_TYPE_TABLE_END = "
				</table>";
}
// ##### ----------------------------------------------------------------------

?>