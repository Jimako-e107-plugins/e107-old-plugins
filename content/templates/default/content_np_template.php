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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/templates/default/content_np_template.php $
|     $Revision: 11678 $
|     $Id: content_np_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

global $sc_style, $content_shortcodes;

// ##### CONTENT NEXT PREV --------------------------------------------------
if(!isset($CONTENT_NP_TABLE)){
	$CONTENT_NP_TABLE = "<div class='nextprev'>{CONTENT_NEXTPREV}</div>";
}
// ##### ----------------------------------------------------------------------

?>