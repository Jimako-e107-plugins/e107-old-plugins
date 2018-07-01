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
if(!getperms('P')){ header('location:'.e_BASE.'index.php'); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

include_lan(e_PLUGIN.'list_new/languages/'.e_LANGUAGE.'.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


$islistinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="list_new" AND plugin_installflag ="1"');


if(IsSet($_POST['update_menu'])){

	if($_POST['onlineinfo_showupdates']==e_UC_PUBLIC){$_POST['onlineinfo_showupdates']=e_UC_MEMBER;}
	
$pref['onlineinfo_coppermine']=$_POST['onlineinfo_coppermine'];
$pref['onlineinfo_guestbook']=$_POST['onlineinfo_guestbook'];
$pref['onlineinfo_downloads']=$_POST['onlineinfo_downloads'];
$pref['onlineinfo_new_icon']=$_POST['onlineinfo_new_icon'];
$pref['onlineinfo_new_icontype']=$_POST['onlineinfo_new_icontype'];
$pref['onlineinfo_hideadminarea']=$_POST['onlineinfo_hideadminarea'];
$pref['onlineinfo_content']=$_POST['onlineinfo_content'];
$pref['onlineinfo_chatnum']=$_POST['onlineinfo_chatnum'];
$pref['onlineinfo_forumnum']=$_POST['onlineinfo_forumnum'];
$pref['onlineinfo_downloadnum']=$_POST['onlineinfo_downloadnum'];
$pref['onlineinfo_guestbooknum']=$_POST['onlineinfo_guestbooknum'];
$pref['onlineinfo_copperminenum']=$_POST['onlineinfo_copperminenum'];
$pref['onlineinfo_commentsnum']=$_POST['onlineinfo_commentsnum'];
$pref['onlineinfo_copperminecommentsnum']=$_POST['onlineinfo_copperminecommentsnum'];
$pref['onlineinfo_linksnum']=$_POST['onlineinfo_linksnum'];
$pref['onlineinfo_usersnum']=$_POST['onlineinfo_usersnum'];
$pref['onlineinfo_newsnum']=$_POST['onlineinfo_newsnum'];
$pref['onlineinfo_contentsnum']=$_POST['onlineinfo_contentsnum'];
$pref['onlineinfo_whatsnewtype']=$_POST['onlineinfo_whatsnewtype'];
$pref['onlineinfo_flashtext']=$_POST['onlineinfo_flashtext'];
$pref['onlineinfo_flashtext_colour']=$_POST['onlineinfo_flashtext_colour'];
$pref['onlineinfo_chatbox']=$_POST['onlineinfo_chatbox'];
$pref['onlineinfo_hideadmin']=$_POST['onlineinfo_hideadmin'];
$pref['onlineinfo_hideregusers']=$_POST['onlineinfo_hideregusers'];
$pref['onlineinfo_showregusers']=$_POST['onlineinfo_showregusers'];
$pref['onlineinfo_shownews']=$_POST['onlineinfo_shownews'];
$pref['onlineinfo_youtubenum']=$_POST['onlineinfo_youtubenum'];
$pref['onlineinfo_youtube']=$_POST['onlineinfo_youtube'];
$pref['onlineinfo_forum_summary']=$_POST['onlineinfo_forum_summary'];
$pref['onlineinfo_kroozearcade']=$_POST['onlineinfo_kroozearcade'];
$pref['onlineinfo_kroozearcadenum']=$_POST['onlineinfo_kroozearcadenum'];
$pref['onlineinfo_kroozearcadetop']=$_POST['onlineinfo_kroozearcadetop'];
$pref['onlineinfo_kroozearcadetopnum']=$_POST['onlineinfo_kroozearcadetopnum'];
$pref['onlineinfo_links']=$_POST['onlineinfo_links'];
$pref['onlineinfo_members']=$_POST['onlineinfo_members'];
$pref['onlineinfo_bugtracker3']=$_POST['onlineinfo_bugtracker3'];
$pref['onlineinfo_bugtracker3commentsnum']=$_POST['onlineinfo_bugtracker3commentsnum'];
$pref['onlineinfo_hideifnonew']=$_POST['onlineinfo_hideifnonew'];

$pref['onlineinfo_chatboxII']=$_POST['onlineinfo_chatboxII'];
$pref['onlineinfo_chatIInum']=$_POST['onlineinfo_chatIInum'];
$pref['onlineinfo_joke']=$_POST['onlineinfo_joke'];
$pref['onlineinfo_jokenum']=$_POST['onlineinfo_jokenum'];
$pref['onlineinfo_blog']=$_POST['onlineinfo_blog'];
$pref['onlineinfo_blognum']=$_POST['onlineinfo_blognum'];
$pref['onlineinfo_suggestions']=$_POST['onlineinfo_suggestions'];
$pref['onlineinfo_suggestionsnum']=$_POST['onlineinfo_suggestionsnum'];
$pref['onlineinfo_showcomments']=$_POST['onlineinfo_showcomments'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A76. ' )</b></div>');
}

$onlineinfo_coppermine = $pref['onlineinfo_coppermine'];
$onlineinfo_guestbook = $pref['onlineinfo_guestbook'];
$onlineinfo_downloads = $pref['onlineinfo_downloads'];
$onlineinfo_new_icon = $pref['onlineinfo_new_icon'];
$onlineinfo_new_icontype = $pref['onlineinfo_new_icontype'];
$onlineinfo_hideadminarea = $pref['onlineinfo_hideadminarea'];
$onlineinfo_content = $pref['onlineinfo_content'];
$onlineinfo_chatnum = $pref['onlineinfo_chatnum'];
$onlineinfo_forumnum = $pref['onlineinfo_forumnum'];
$onlineinfo_downloadnum = $pref['onlineinfo_downloadnum'];
$onlineinfo_guestbooknum = $pref['onlineinfo_guestbooknum'];
$onlineinfo_copperminenum = $pref['onlineinfo_copperminenum'];
$onlineinfo_commentsnum = $pref['onlineinfo_commentsnum'];
$onlineinfo_copperminecommentsnum = $pref['onlineinfo_copperminecommentsnum'];
$onlineinfo_linksnum = $pref['onlineinfo_linksnum'];
$onlineinfo_usersnum = $pref['onlineinfo_usersnum'];
$onlineinfo_newsnum = $pref['onlineinfo_newsnum'];
$onlineinfo_contentsnum = $pref['onlineinfo_contentsnum'];
$onlineinfo_whatsnewtype = $pref['onlineinfo_whatsnewtype'];
$onlineinfo_flashtext = $pref['onlineinfo_flashtext'];
$onlineinfo_flashtext_colour = $pref['onlineinfo_flashtext_colour'];
$onlineinfo_chatbox = $pref['onlineinfo_chatbox'];
$onlineinfo_forum = $pref['onlineinfo_forum'];
$onlineinfo_hideadmin = $pref['onlineinfo_hideadmin'];
$onlineinfo_hideregusers = $pref['onlineinfo_hideregusers'];
$onlineinfo_showregusers = $pref['onlineinfo_showregusers'];
$onlineinfo_youtubenum = $pref['onlineinfo_youtubenum'];
$onlineinfo_youtube = $pref['onlineinfo_youtube'];
$onlineinfo_shownews = $pref['onlineinfo_shownews'];
$onlineinfo_forum_summary  = $pref['onlineinfo_forum_summary'];
$onlineinfo_kroozearcadenum = $pref['onlineinfo_kroozearcadenum'];
$onlineinfo_kroozearcade = $pref['onlineinfo_kroozearcade'];
$onlineinfo_kroozearcadetopnum = $pref['onlineinfo_kroozearcadetopnum'];
$onlineinfo_kroozearcadetop = $pref['onlineinfo_kroozearcadetop'];
$onlineinfo_links = $pref['onlineinfo_links'];
$onlineinfo_members = $pref['onlineinfo_members'];
$onlineinfo_bugtracker3 = $pref['onlineinfo_bugtracker3'];
$onlineinfo_bugtracker3commentsnum = $pref['onlineinfo_bugtracker3commentsnum'];
$onlineinfo_hideifnonew = $pref['onlineinfo_hideifnonew'];
//added 8.5.0
$onlineinfo_chatboxII = $pref['onlineinfo_chatboxII'];
$onlineinfo_chatIInum = $pref['onlineinfo_chatIInum'];
$onlineinfo_joke = $pref['onlineinfo_joke'];
$onlineinfo_jokenum = $pref['onlineinfo_jokenum'];
$onlineinfo_blog = $pref['onlineinfo_blog'];
$onlineinfo_blognum = $pref['onlineinfo_blognum'];
$onlineinfo_suggestions = $pref['onlineinfo_suggestions'];
$onlineinfo_suggestionsnum = $pref['onlineinfo_suggestionsnum'];
$onlineinfo_showcomments = $pref['onlineinfo_showcomments'];



$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


// check for plugins installed and active
$iscopperinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="coppermine_menu" AND plugin_installflag ="1"');
$isguestbookinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="guestbook" AND plugin_installflag ="1"');
$ischatboxinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="chatbox_menu" AND plugin_installflag ="1"');
$ischatboxIIinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="chatbox2_menu" AND plugin_installflag ="1"');
$isforuminstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="forum" AND plugin_installflag ="1"');
$isyoutubeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="ytm_gallery" AND plugin_installflag ="1"');
$iskroozearcadeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="kroozearcade_menu" AND plugin_installflag ="1"');
$islinkpageinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="links_page" AND plugin_installflag ="1"');
$isbugtracker3installed = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="bugtracker3" AND plugin_installflag ="1"');
$isjokeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="jokes_menu" AND plugin_installflag ="1"');
$isbloginstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="userjournals_menu" AND plugin_installflag ="1"');
$issuggestioninstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="suggestions_menu" AND plugin_installflag ="1"');


$text .= '<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A107. '</td>
<td class="forumheader3" colspan="4">';

if($onlineinfo_whatsnewtype=='1'){
$text.=ONLINEINFO_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" checked />&nbsp;&nbsp;&nbsp;';

	$text.=ONLINEINFO_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0"';

	if($islistinstalled==1){
		$text.=' />';
	}else{
		$text.=' disabled />';
	}
}else{



	if($islistinstalled==1){
		$text.=ONLINEINFO_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" />&nbsp;&nbsp;&nbsp;';
		$text.=ONLINEINFO_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0" checked />';
	}else{
		$text.=ONLINEINFO_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" checked />&nbsp;&nbsp;&nbsp;';
		$text.=ONLINEINFO_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0" disabled />';
	}
}

$text.='</td>
</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A68. '</td>
<td class="forumheader3" colspan="3">'.r_userclass('onlineinfo_showregusers',$onlineinfo_showregusers).'</td>

</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A123. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideregusers',$onlineinfo_hideregusers).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A12. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_flashtext',$onlineinfo_flashtext).'
&nbsp;&nbsp;&nbsp;' .ONLINEINFO_LOGIN_MENU_A13.Create_colour_dropdown('onlineinfo_flashtext_colour',$onlineinfo_flashtext_colour).'
</td>
</tr>


<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A23. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_new_icon',$onlineinfo_new_icon).'</td>';


if($onlineinfo_new_icontype=='new.gif') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A24. '<br /><span class="smalltext">' .ONLINEINFO_LOGIN_MENU_A25. '</span></td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_new_icontype" value="new.gif" checked />&nbsp;<img src="'.e_PLUGIN.'onlineinfo_menu/images/new.gif" />' .ONLINEINFO_LOGIN_MENU_A26. '<br /><input type="radio"  name="onlineinfo_new_icontype" value="new2.gif"/>&nbsp;<img src="'.e_PLUGIN.'onlineinfo_menu/images/new2.gif" />' .ONLINEINFO_LOGIN_MENU_A27. '</td>';
}else{
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A24.'<br /><span class="smalltext">' .ONLINEINFO_LOGIN_MENU_A25. '</span></td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_new_icontype" value="new.gif"/>&nbsp;<img src="'.e_PLUGIN.'onlineinfo_menu/images/new.gif" />' .ONLINEINFO_LOGIN_MENU_A26. '<br /><input type="radio"  name="onlineinfo_new_icontype" value="new2.gif" checked />&nbsp;<img src="'.e_PLUGIN.'onlineinfo_menu/images/new2.gif" />' .ONLINEINFO_LOGIN_MENU_A27. '</td>';
}


$text .='</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A177. '</td>
<td class="forumheader3" colspan="4">'.Create_yes_no_dropdown('onlineinfo_hideifnonew',$onlineinfo_hideifnonew).'<span class="smalltext">'.ONLINEINFO_LOGIN_MENU_A178.'</span></td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A63. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideadminarea',$onlineinfo_hideadminarea).'&nbsp;&nbsp;&nbsp;'.ONLINEINFO_LOGIN_MENU_A122.Create_yes_no_dropdown('onlineinfo_hideadmin',$onlineinfo_hideadmin).'
</td>
</tr>

<tr><td class="forumheader3" colspan="5" style="font-style: italic;">'.ONLINEINFO_LOGIN_MENU_A171.'</td></tr>

<tr>
<td class="forumheader" colspan="5" style="text-align:center; font-weight:bold;">' .ONLINEINFO_LOGIN_MENU_A89. '</td>
</tr>

<tr>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A199.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A200.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A201.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A176.'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A153. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_shownews',$onlineinfo_shownews).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_newsnum" size="4" value="'.$onlineinfo_newsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A67. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_content',$onlineinfo_content).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_contentsnum" size="4" value="'.$onlineinfo_contentsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A14. '</td>

<td class="forumheader3">';

if ($ischatboxinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_chatbox',$onlineinfo_chatbox);
}else{
$text .=Create_no_dropdown('onlineinfo_chatbox','0');
}

$text.='</td>

<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_chatnum" size="4" value="'.$onlineinfo_chatnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A182. '</td>

<td class="forumheader3">';


if ($ischatboxIIinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_chatboxII',$onlineinfo_chatboxII);
}else{
$text .=Create_no_dropdown('onlineinfo_chatboxII','0');
}

$text.='</td>';


$text.='<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_chatIInum" size="4" value="'.$onlineinfo_chatIInum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A121. '</td>
<td class="forumheader3">
';


if ($isforuminstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_forum',$onlineinfo_forum);
}else{
$text .=Create_no_dropdown('onlineinfo_forum','0');
}

$text.='</td>

<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_forumnum" size="4" value="'.$onlineinfo_forumnum .'" maxlength="4" /></td>';


$text .='<td class="forumheader3"><b>'.ONLINEINFO_LOGIN_MENU_A156.'</b>';

	if($onlineinfo_forum_summary==1){
		$text.=ONLINEINFO_LOGIN_MENU_A157.'<input type="radio"  name="onlineinfo_forum_summary" value="1" checked />&nbsp;&nbsp;&nbsp;';
		$text.=ONLINEINFO_LOGIN_MENU_A158.'<input type="radio"  name="onlineinfo_forum_summary" value="0" />';
	}else{
		$text.=ONLINEINFO_LOGIN_MENU_A157.'<input type="radio"  name="onlineinfo_forum_summary" value="1" />&nbsp;&nbsp;&nbsp;';
		$text.=ONLINEINFO_LOGIN_MENU_A158.'<input type="radio"  name="onlineinfo_forum_summary" value="0" checked />';
	}

$text.='</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A28. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_downloads',$onlineinfo_downloads).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_downloadnum" size="4" value="'.$onlineinfo_downloadnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A29. '</td>
<td class="forumheader3">
';

if ($iscopperinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_coppermine',$onlineinfo_coppermine);
}else{
$text .=Create_no_dropdown('onlineinfo_coppermine','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_copperminenum" size="4" value="'.$onlineinfo_copperminenum .'" maxlength="4" /></td>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A96. '<input class="tbox" type="text" name="onlineinfo_copperminecommentsnum" size="4" value="'.$onlineinfo_copperminecommentsnum .'" maxlength="4" /></td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A57. '</td>
<td class="forumheader3">
';

if ($isguestbookinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_guestbook',$onlineinfo_guestbook);
}else{
$text .=Create_no_dropdown('onlineinfo_guestbook','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_guestbooknum" size="4" value="'.$onlineinfo_guestbooknum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A155. '</td>

<td class="forumheader3">';

if ($isyoutubeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_youtube',$onlineinfo_youtube);
}else{
$text .=Create_no_dropdown('onlineinfo_youtube','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_youtubenum" size="4" value="'.$onlineinfo_youtubenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A165. '</td>
<td class="forumheader3">
';

if ($iskroozearcadeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_kroozearcade',$onlineinfo_kroozearcade);
}else{
$text .=Create_no_dropdown('onlineinfo_kroozearcade','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_kroozearcadenum" size="4" value="'.$onlineinfo_kroozearcadenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A166. '</td>

<td class="forumheader3">';

if ($iskroozearcadeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_kroozearcadetop',$onlineinfo_kroozearcadetop);
}else{
$text .=Create_no_dropdown('onlineinfo_kroozearcadetop','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_kroozearcadetopnum" size="4" value="'.$onlineinfo_kroozearcadetopnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A169. '</td>

<td class="forumheader3">';

if ($islinkpageinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_links',$onlineinfo_links);
}else{
$text .=Create_no_dropdown('onlineinfo_links','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_linksnum" size="4" value="'.$onlineinfo_linksnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A170. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_members',$onlineinfo_members).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_usersnum" size="4" value="'.$onlineinfo_usersnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A173. '</td>

<td class="forumheader3">';

if ($isbugtracker3installed==1){
$text .=Create_yes_no_dropdown('onlineinfo_bugtracker3',$onlineinfo_bugtracker3);
}else{
$text .=Create_no_dropdown('onlineinfo_bugtracker3','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_bugtracker3commentsnum" size="4" value="'.$onlineinfo_bugtracker3commentsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A194. '</td>

<td class="forumheader3">';

if ($isjokeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_joke',$onlineinfo_joke);
}else{
$text .=Create_no_dropdown('onlineinfo_joke','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_jokenum" size="4" value="'.$onlineinfo_jokenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A196. '</td>

<td class="forumheader3">';

if ($isbloginstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_blog',$onlineinfo_blog);
}else{
$text .=Create_no_dropdown('onlineinfo_blog','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_blognum" size="4" value="'.$onlineinfo_blognum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A198. '</td>

<td class="forumheader3">';

if ($issuggestioninstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_suggestions',$onlineinfo_suggestions);
}else{
$text .=Create_no_dropdown('onlineinfo_suggestions','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_suggestionsnum" size="4" value="'.$onlineinfo_suggestionsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A95. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_showcomments',$onlineinfo_showcomments).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_commentsnum" size="4" value="'.$onlineinfo_commentsnum .'" maxlength="4" /></td>
<td class="forumheader3" style="text-style:italic;">'.ONLINEINFO_LOGIN_MENU_A202.'</td>
</tr>

<tr>
<td colspan="6" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A76, $text);

require_once(e_ADMIN.'footer.php');

?>