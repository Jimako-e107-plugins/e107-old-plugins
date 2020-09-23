<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('../../class2.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/English.php');

require_once(HEADERF);


$icontent = '<iframe src="'.SITEURL.$pref["onlineinfo_flashchatlocation"].'/flashchat.php" width="100%" height="600px" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$pref["onlineinfo_flashchatlocation"].'/flashchat.php">Here</a>.<br /></iframe>';


$icontent.='<br /><div style="text-align:center;">'.OI_FLASHCHAT_3.'</div>';

$ns -> tablerender('FlashChat', $icontent);

require_once(FOOTERF);


?>