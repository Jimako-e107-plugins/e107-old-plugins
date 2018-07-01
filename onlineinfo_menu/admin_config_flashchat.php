<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


if(IsSet($_POST['update_menu'])){

	$pref['onlineinfo_flashchatuse']=$_POST['onlineinfo_flashchatuse'];
	$pref['onlineinfo_flashchatprefix']=$_POST['onlineinfo_flashchatprefix'];
	$pref['onlineinfo_flashchatlocation']=$_POST['onlineinfo_flashchatlocation'];
	$pref['onlineinfo_flashchatwindow']=$_POST['onlineinfo_flashchatwindow'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A110. ' )</b></div>');
}

$onlineinfo_flashchatuse = $pref['onlineinfo_flashchatuse'];
$onlineinfo_flashchatprefix = $pref['onlineinfo_flashchatprefix'];
$onlineinfo_flashchatlocation = $pref['onlineinfo_flashchatlocation'];
$onlineinfo_flashchatwindow = $pref['onlineinfo_flashchatwindow'];


$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A118.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_LOGIN_MENU_A110.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_flashchatuse',$onlineinfo_flashchatuse).'</td>
</tr>


<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A110.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'e107_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_flashchatprefix" size="12" value="'.$onlineinfo_flashchatprefix.'" maxlength="12"" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A110.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'chat)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_flashchatlocation" size="24" value="'.$onlineinfo_flashchatlocation.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_flashchatwindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A110. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_flashchatwindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_flashchatwindow" value="window" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A110.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_flashchatwindow" value="e107" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_flashchatwindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>
<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text.='<br /><br /><iframe src="'.SITEURL.$menu_pref['onlineinfo_flashchatlocation'].'/admin/index.php" id="Flashchat Admin" name="iframe" width="100%" height="800px" scrolling="yes" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$menu_pref['onlineinfo_flashchatlocation'].'/admin/index.php">Here</a>.<br /></iframe>';


$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A110, $text);

require_once(e_ADMIN.'footer.php');

?>