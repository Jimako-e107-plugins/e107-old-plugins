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

include_once(e_PLUGIN."onlineinfo_menu/functions.php");


if(IsSet($_POST['update_menu'])){

$pref['onlineinfo_sa_coppermineuse']=$_POST['onlineinfo_sa_coppermineuse'];
$pref['onlineinfo_sa_coppermineprefix']=$_POST['onlineinfo_sa_coppermineprefix'];
$pref['onlineinfo_sa_copperminelocation']=$_POST['onlineinfo_sa_copperminelocation'];
$pref['onlineinfo_sa_copperminewindow']=$_POST['onlineinfo_sa_copperminewindow'];
$pref['onlineinfo_sa_coppermineshownum']=$_POST['onlineinfo_sa_coppermineshownum'];


	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A184. ' )</b></div>');
}



$onlineinfo_sa_coppermineuse = $pref['onlineinfo_sa_coppermineuse'];
$onlineinfo_sa_coppermineprefix = $pref['onlineinfo_sa_coppermineprefix'];
$onlineinfo_sa_copperminelocation = $pref['onlineinfo_sa_copperminelocation'];
$onlineinfo_sa_copperminewindow = $pref['onlineinfo_sa_copperminewindow'];
$onlineinfo_sa_coppermineshownum = $pref['onlineinfo_sa_coppermineshownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">
';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A185.'</td>

</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_LOGIN_MENU_A184.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_sa_coppermineuse',$onlineinfo_sa_coppermineuse).'</td>
</tr>


<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A184.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'cpg_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_sa_coppermineprefix" size="12" value="'.$onlineinfo_sa_coppermineprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A184.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'cpg)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_sa_copperminelocation" size="24" value="'.$onlineinfo_sa_copperminelocation.'" maxlength="100" /></td>
</tr>

<tr>';

if($onlineinfo_sa_copperminewindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A184. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_sa_copperminewindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_sa_copperminewindow" value="window"/>&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}else{
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A184.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_sa_copperminewindow" value="e107"/>&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_sa_copperminewindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}
$text .='</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A186. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_sa_coppermineshownum" size="4" value="'.$onlineinfo_sa_coppermineshownum .'" maxlength="4" /></td>
</tr>


<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A184, $text);

require_once(e_ADMIN.'footer.php');

?>