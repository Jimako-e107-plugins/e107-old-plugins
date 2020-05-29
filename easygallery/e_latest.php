<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');

$file_count = num_files(e_PLUGIN."easygallery/upload/")-1; 
if ($file_count > 0) 
{
	$text .= "
	<div style='padding-bottom: 2px;'>
		<img src='".e_PLUGIN."easygallery/images/icon_easygallery_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />
		<a href='".e_PLUGIN."easygallery/admin_overview.php?".str_replace("../","",e_PLUGIN)."easygallery/upload/'>".EG_LATEST.": ".$file_count."</a>
	</div>";
}

function num_files($directory='.') {
    return count(glob($directory."/*.*"));
} 
?>