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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_author_template.php $
|     $Revision: 11678 $
|     $Id: content_author_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
global $sc_style, $content_shortcodes;

$sc_style['CONTENT_AUTHOR_TABLE_LASTITEM']['pre'] = "<tr><td class='forumheader3'>".CONTENT_LAN_55." ";
$sc_style['CONTENT_AUTHOR_TABLE_LASTITEM']['post'] = "</td></tr>";

$sc_style['CONTENT_AUTHOR_TABLE_TOTAL']['pre'] = "(";
$sc_style['CONTENT_AUTHOR_TABLE_TOTAL']['post'] = ")";

// ##### CONTENT AUTHOR -------------------------------------------------------
if(!isset($CONTENT_AUTHOR_TABLE_START)){
	$CONTENT_AUTHOR_TABLE_START = "
	<table class='fborder' style='width:98%; text-align:left;'>\n";
}
if(!isset($CONTENT_AUTHOR_TABLE)){
	$CONTENT_AUTHOR_TABLE = "
	<tr>
		<td class='fcaption'>{CONTENT_AUTHOR_TABLE_ICON} {CONTENT_AUTHOR_TABLE_NAME} {CONTENT_AUTHOR_TABLE_TOTAL}</td>
	</tr>
	{CONTENT_AUTHOR_TABLE_LASTITEM}
	";
}
if(!isset($CONTENT_AUTHOR_TABLE_END)){
	$CONTENT_AUTHOR_TABLE_END = "
	</table>\n";
}
// ##### ----------------------------------------------------------------------

?>