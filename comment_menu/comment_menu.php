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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/comment_menu/comment_menu.php $
|     $Revision: 11678 $
|     $Id: comment_menu.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN."comment_menu/comment_menu_shortcodes.php");
require_once(e_HANDLER."comment_class.php");
$cobj = new comment;

if (file_exists(THEME."comment_menu_template.php")){
	require_once(THEME."comment_menu_template.php");
}else{
	require_once(e_PLUGIN."comment_menu/comment_menu_template.php");
}

$data = $cobj->getCommentData(intval($menu_pref['comment_display']));

$text = '';
// no posts yet ..
if(empty($data) || !is_array($data)){
	$text = CM_L1;
}

global $row;
foreach($data as $row){
	$text .= $tp->parseTemplate($COMMENT_MENU_TEMPLATE, true, $comment_menu_shortcodes);
}

$ns->tablerender($menu_pref['comment_caption'], $text, 'comment');

?>