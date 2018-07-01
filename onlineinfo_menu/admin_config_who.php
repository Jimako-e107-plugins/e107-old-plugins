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


$pref['onlineinfo_border']=$_POST['onlineinfo_border'];
$pref['onlineinfo_color']=$_POST['onlineinfo_color'];
$pref['onlineinfo_avatar']=$_POST['onlineinfo_avatar'];
$pref['onlineinfo_showicons']=$_POST['onlineinfo_showicons'];
$pref['onlineinfo_showadmin']=$_POST['onlineinfo_showadmin'];
$pref['onlineinfo_guest']=$_POST['onlineinfo_guest'];
$pref['onlineinfo_hideguest']=$_POST['onlineinfo_hideguest'];
$pref['onlineinfo_hideusers']=$_POST['onlineinfo_hideusers'];
$pref['onlineinfo_usernamefontsize']=$_POST['onlineinfo_usernamefontsize'];
$pref['onlineinfo_botchecker']=$_POST['onlineinfo_botchecker'];
$pref['onlineinfo_ipchecker']=$_POST['onlineinfo_ipchecker'];
$pref['onlineinfo_nolocations']=$_POST['onlineinfo_nolocations'];


save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A72. ' )</b></div>');
}

$onlineinfo_border = $pref['onlineinfo_border'];
$onlineinfo_color = $pref['onlineinfo_color'];
$onlineinfo_avatar = $pref['onlineinfo_avatar'];
$onlineinfo_showicons = $pref['onlineinfo_showicons'];
$onlineinfo_showadmin = $pref['onlineinfo_showadmin'];
$onlineinfo_guest = $pref['onlineinfo_guest'];
$onlineinfo_hideguest = $pref['onlineinfo_hideguest'];
$onlineinfo_hideusers = $pref['onlineinfo_hideusers'];
$onlineinfo_usernamefontsize = $pref['onlineinfo_usernamefontsize'];
$onlineinfo_botchecker = $pref['onlineinfo_botchecker'];
$onlineinfo_ipchecker = $pref['onlineinfo_ipchecker'];
$onlineinfo_nolocations = $pref['onlineinfo_nolocations'];



$text = '<script language="JavaScript" src="'.e_PLUGIN.'onlineinfo_menu/picker.js"></script>

<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">

<tr><td class="forumheader3" colspan="4">'.ONLINEINFO_LOGIN_MENU_A43.'</td></tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A38. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_nolocations',$onlineinfo_nolocations).'</td>
</tr>

<tr><td class="forumheader" colspan="4">'.ONLINEINFO_LOGIN_MENU_A102.'</td></tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A37. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_botchecker',$onlineinfo_botchecker).'</td>
</tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A35. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_ipchecker',$onlineinfo_ipchecker).'</td>
</tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A119. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideusers',$onlineinfo_hideusers).'</td>
</tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A120. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideguest',$onlineinfo_hideguest).'</td>
</tr>

<tr><td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A15. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_avatar',$onlineinfo_avatar).'</td>
</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A16. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_guest',$onlineinfo_guest).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A17. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showicons',$onlineinfo_showicons).'</td>
</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A18. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showadmin',$onlineinfo_showadmin).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A58. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_border" size="12" value="'.$onlineinfo_border.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_border\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A59. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_color" size="12" value="'.$onlineinfo_color.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_color\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A144. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_usernamefontsize" size="2" value="'.$onlineinfo_usernamefontsize.'" maxlength="2" />&nbsp;'.ONLINEINFO_LOGIN_MENU_A143.'</td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A72, $text);

require_once(e_ADMIN.'footer.php');

?>