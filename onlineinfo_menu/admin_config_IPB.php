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


	if($_POST['onlineinfo_pm']==e_UC_PUBLIC){$_POST['onlineinfo_pm']=e_UC_MEMBER;}

$pref['onlineinfo_ibfpm']=$_POST['onlineinfo_ibfpm'];
$pref['onlineinfo_ibfuse']=$_POST['onlineinfo_ibfuse'];
$pref['onlineinfo_ibfprefix']=$_POST['onlineinfo_ibfprefix'];
$pref['onlineinfo_ibflocation']=$_POST['onlineinfo_ibflocation'];
$pref['onlineinfo_ibftime']=$_POST['onlineinfo_ibftime'];
$pref['onlineinfo_ibfshownum']=$_POST['onlineinfo_ibfshownum'];
$pref['onlineinfo_ibfautohide']=$_POST['onlineinfo_ibfautohide'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_IPB_A1. ' )</b></div>');
}


$onlineinfo_ibfpm = $pref['onlineinfo_ibfpm'];
$onlineinfo_ibfuse = $pref['onlineinfo_ibfuse'];
$onlineinfo_ibfprefix = $pref['onlineinfo_ibfprefix'];
$onlineinfo_ibflocation = $pref['onlineinfo_ibflocation'];
$onlineinfo_ibftime = $pref['onlineinfo_ibftime'];
$onlineinfo_ibfshownum = $pref['onlineinfo_ibfshownum'];
$onlineinfo_ibfautohide = $pref['onlineinfo_ibfautohide'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$dropdown1=Create_yes_no_dropdown('onlineinfo_ibfpm',$onlineinfo_ibfpm);
$dropdown2=Create_yes_no_dropdown('onlineinfo_ibfuse',$onlineinfo_ibfuse);
$dropdown3=Create_yes_no_dropdown('onlineinfo_ibfautohide',$onlineinfo_ibfautohide);


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_IPB_A12.'</td>

</tr>
<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A11. '</td>
<td class="forumheader3">'.$dropdown1.'</td>
</tr>
<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A3.'</td>
<td class="forumheader3">'.$dropdown2.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A13.'</td>
<td class="forumheader3">'.$dropdown3.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A4.'<br />('.ONLINEINFO_IPB_A5.')<br />('.ONLINEINFO_IPB_A6.'1 <i>'.ONLINEINFO_IPB_A7.'</i>)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibftime" size="3" value="'.$onlineinfo_ibftime.'" maxlength="3" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A8.'<br />('.ONLINEINFO_IPB_A6.'ibf_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibfprefix" size="12" value="'.$onlineinfo_ibfprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A9.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'forums)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_ibflocation" size="24" value="'.$onlineinfo_ibflocation.'" maxlength="100" /></td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_IPB_A10. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibfshownum" size="4" value="'.$onlineinfo_ibfshownum .'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';


$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_IPB_A1, $text);

require_once(e_ADMIN.'footer.php');

?>