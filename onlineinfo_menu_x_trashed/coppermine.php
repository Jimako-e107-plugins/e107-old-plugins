<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2002
|	http://jalist.com
|	stevedunstan@jalist.com
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('../../class2.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/English.php');

require_once(HEADERF);


$from         = intval(e_QUERY);
$tmp          = explode('.', e_QUERY);
$action       = $tmp[0];
$id = $tmp[1];

$icontent = '<iframe src="'.SITEURL.$pref['onlineinfo_sa_copperminelocation'].'/displayimage.php?pos=-'.$id.'" id="'.ONLINEINFO_LIST_34.'" name="iframe" width="100%" height="1000px" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$pref['onlineinfo_sa_copperminelocation'].'/displayimage.php?pos=-'.$id.'">Here</a>.<br /></iframe>';

$ns -> tablerender(ONLINEINFO_LIST_55, $icontent);

require_once(FOOTERF);


?>