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
$pref['onlineinfo_smfuse']=$_POST['onlineinfo_smfuse'];
$pref['onlineinfo_smfprefix']=$_POST['onlineinfo_smfprefix'];
$pref['onlineinfo_smflocation']=$_POST['onlineinfo_smflocation'];
$pref['onlineinfo_smfwindow']=$_POST['onlineinfo_smfwindow'];
$pref['onlineinfo_smfshownum']=$_POST['onlineinfo_smfshownum'];
	
	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_SMF_1. ' )</b></div>');
}



$onlineinfo_smfuse = $pref['onlineinfo_smfuse'];
$onlineinfo_smfprefix = $pref['onlineinfo_smfprefix'];
$onlineinfo_smflocation = $pref['onlineinfo_smflocation'];
$onlineinfo_smfwindow = $pref['onlineinfo_smfwindow'];
$onlineinfo_smfshownum = $pref['onlineinfo_smfshownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A172.'</td>

</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_SMF_1.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_smfuse',$onlineinfo_smfuse).'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_SMF_1.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'smf_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_smfprefix" size="12" value="'.$onlineinfo_smfprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_SMF_1.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'smf)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_smflocation" size="24" value="'.$onlineinfo_smflocation.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_smfwindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_SMF_1. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_smfwindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_smfwindow" value="window" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_SMF_1.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_smfwindow" value="e107" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_smfwindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_SMF_2. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_smfshownum" size="4" value="'.$onlineinfo_smfshownum.'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_SMF_1, $text);

require_once(e_ADMIN.'footer.php');

?>