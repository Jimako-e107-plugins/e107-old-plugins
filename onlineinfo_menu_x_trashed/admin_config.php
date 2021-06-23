<?php

require_once('../../class2.php');
require_once(e_HANDLER.'userclass_class.php');
if(!getperms('P')) { header("location:".e_BASE."index.php"); exit; }

require_once(e_ADMIN.'auth.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_lan(e_PLUGIN.'pm/languages/admin/'.e_LANGUAGE.'.php');
include_lan(e_PLUGIN.'log/languages/admin/'.e_LANGUAGE.'.php');
include_lan(e_PLUGIN.'list_new/languages/'.e_LANGUAGE.'.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');

$deletemeplugin = $sql->db_Count("plugin", "(*)", "WHERE plugin_path='deleteme' and plugin_installflag='1'");




if(IsSet($_POST['update_menu'])){
	
	$pref['onlineinfo_caption']=$_POST['onlineinfo_caption'];
	$pref['onlineinfo_width']=$_POST['onlineinfo_width'];
	$pref['onlineinfo_showpmmsg']=$_POST['onlineinfo_showpmmsg'];
	$pref['onlineinfo_rememberbuttons']=$_POST['onlineinfo_rememberbuttons'];
	$pref['onlineinfo_fontsize']=$_POST['onlineinfo_fontsize'];
	$pref['onlineinfo_sound']=$_POST['onlineinfo_sound'];
	$pref['onlineinfo_deleteme']=$_POST['onlineinfo_deleteme'];
	$pref['onlineinfo_logindiag']=$_POST['onlineinfo_logindiag'];
	$pref['onlineinfo_turnoffavatar']=$_POST['onlineinfo_turnoffavatar'];
	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A71. ' )</b></div>');
}




$onlineinfo_caption = $pref['onlineinfo_caption'];
$onlineinfo_width = $pref['onlineinfo_width'];
$onlineinfo_showpmmsg = $pref['onlineinfo_showpmmsg'];
$onlineinfo_rememberbuttons = $pref['onlineinfo_rememberbuttons'];
$onlineinfo_fontsize = $pref['onlineinfo_fontsize'];
$onlineinfo_sound =  $pref['onlineinfo_sound'];
$onlineinfo_deleteme =  $pref['onlineinfo_deleteme'];
$onlineinfo_logindiag =  $pref['onlineinfo_logindiag'];
$onlineinfo_turnoffavatar = $pref['onlineinfo_turnoffavatar'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A3. '<br /><span class="smalltext">' .ONLINEINFO_LOGIN_MENU_A4. '</td>
<td class="forumheader3" colspan="3">
<input class="tbox" type="text" name="onlineinfo_caption" size="40" value="'.$onlineinfo_caption.'" maxlength="41" />
<br />' .ONLINEINFO_LOGIN_MENU_A5. '<b>[Welcome User]</b>' .ONLINEINFO_LOGIN_MENU_A6. '</td>
</tr>';

if ($deletemeplugin){
	$dropdown2=Create_yes_no_dropdown('onlineinfo_deleteme',$onlineinfo_deleteme);
	}else{
	$dropdown2=Create_no_dropdown('onlineinfo_deleteme',$onlineinfo_deleteme);
		}


$text .= '<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A7.'<br /><span class="smalltext">' .ONLINEINFO_LOGIN_MENU_A8. '</td>
<td class="forumheader3" colspan="3">
<input class="tbox" type="text" name="onlineinfo_width" size="6" value="'.$onlineinfo_width.'" maxlength="5" />
&nbsp;' .ONLINEINFO_LOGIN_MENU_A9. '</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A126.'</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showpmmsg',$onlineinfo_showpmmsg).'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A64.'</td>
<td class="forumheader3" colspan="3">'.Create_sound_dropdown('onlineinfo_sound',$onlineinfo_sound).'<br />'.ONLINEINFO_LOGIN_MENU_A65.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A128.'</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_rememberbuttons',$onlineinfo_rememberbuttons).'<br />'.ONLINEINFO_LOGIN_MENU_A141.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A142.'</td>
<td class="forumheader3" colspan="3">
<input class="tbox" type="text" name="onlineinfo_fontsize" size="2" value="'.$onlineinfo_fontsize.'" maxlength="2" />
&nbsp;' .ONLINEINFO_LOGIN_MENU_A143. '</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A152.': </td>
<td class="forumheader3" colspan="3">'.$dropdown2.'<br />'.ONLINEINFO_LOGIN_MENU_A161.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A160.': </td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_logindiag',$onlineinfo_logindiag).'<br />'.ONLINEINFO_LOGIN_MENU_A162.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A203.': </td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_turnoffavatar',$onlineinfo_turnoffavatar).'</td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A71, $text);

require_once(e_ADMIN.'footer.php');

?>