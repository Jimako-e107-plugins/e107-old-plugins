<?php
/*
+---------------------------------------------------------------+
|	e107 website system
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
$fdata          = explode('-', $tmp[1]);

if($tmp[0]=='u'){
	$icontent = '<iframe src="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?action=profile;u='.$tmp[1].'" id="'.ONLINEINFO_LIST_42.'" name="iframe" width="100%" height="1000px" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?action=profile;u='.$tmp[1].'">Here</a>.<br /></iframe>';
	
}else{

$icontent = '<iframe src="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?topic='.$fdata[0].'.msg'.$fdata[1].'#msg'.$idata[1].'" id="'.ONLINEINFO_LIST_42.'" name="iframe" width="100%" height="1000px" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?topic='.$fdata[0].'.msg'.$fdata[1].'#msg'.$idata[1].'">Here</a>.<br /></iframe>';
}

$ns -> tablerender(ONLINEINFO_LIST_42, $icontent);

require_once(FOOTERF);

?>