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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/content_manager_template.php $
|     $Revision: 11678 $
|     $Id: content_manager_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
global $sc_style, $content_shortcodes;

// ##### CONTENT CONTENTMANAGER LIST --------------------------------------------------
if(!isset($CONTENT_CONTENTMANAGER_TABLE_START)){
	$CONTENT_CONTENTMANAGER_TABLE_START = "
	<table class='fborder' style='width:98%; text-align:left;' cellpadding='0' cellspacing='0'>
	<tr>
		<td class='forumheader3'>".CONTENT_ADMIN_ITEM_LAN_57."</td>
		<td class='forumheader3'>".CONTENT_ADMIN_ITEM_LAN_12."</td>
	</tr>\n";
}
if(!isset($CONTENT_CONTENTMANAGER_TABLE)){
	$CONTENT_CONTENTMANAGER_TABLE = "
	<tr>
		<td class='forumheader3'>{CONTENT_CONTENTMANAGER_CATEGORY}</td>
		<td class='forumheader3' style='width:10%;white-space:nowrap;'>{CONTENT_CONTENTMANAGER_ICONEDIT} {CONTENT_CONTENTMANAGER_ICONNEW} {CONTENT_CONTENTMANAGER_ICONSUBM}</td>
	</tr>";
}

if(!isset($CONTENT_CONTENTMANAGER_TABLE_END)){
	$CONTENT_CONTENTMANAGER_TABLE_END = "
	</table>";
}
// ##### ----------------------------------------------------------------------

?>