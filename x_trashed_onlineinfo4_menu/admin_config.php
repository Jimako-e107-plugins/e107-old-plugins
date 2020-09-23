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
require_once("../../class2.php");
if (!getperms("4"))
{
    header("location:" . e_BASE . "index.php");
    exit ;
} 
require_once(e_ADMIN . "auth.php");


function online4_yn_dropdown($Selname,$SelectedVal){
	$ret_text="<select class='tbox' name='".$Selname."' >\n";
	$sqlotd=new db;
	$sel="";
	if($SelectedVal == "1"){
		$sel=" selected='selected'";
	}
	$ret_text.="<option value='1' ".$sel.">".ONLINE4_A74."</option>\n";
	$sel="";
	if($SelectedVal == "0"){
		$sel=" selected='selected'";
	}
	$ret_text.="<option value='0' ".$sel.">".ONLINE4_A75."</option>\n";
	$ret_text.="</select>\n";
	return $ret_text;
}
function onlineinfo_UpdateParm($parmname)
{
    global $pref;
    $pref[$parmname] = $_POST[$parmname];
} 

if (IsSet($_POST['update_menu']))
{
    $aj = new textparse;

    onlineinfo_UpdateParm("onlineinfo_pm");
    onlineinfo_UpdateParm("onlineinfo_online");
    onlineinfo_UpdateParm("onlineinfo_coppermine");
    onlineinfo_UpdateParm("onlineinfo_last");
    onlineinfo_UpdateParm("onlineinfo_guest");
    onlineinfo_UpdateParm("onlineinfo_lastnum");
    onlineinfo_UpdateParm("onlineinfo_caption");
    onlineinfo_UpdateParm("onlineinfo_downloads");
    onlineinfo_UpdateParm("onlineinfo_online_plug");
    onlineinfo_UpdateParm("onlineinfo_guestmessage");
    onlineinfo_UpdateParm("onlineinfo_guest_message");
    onlineinfo_UpdateParm("onlineinfo_guest_bg");
    onlineinfo_UpdateParm("onlineinfo_guest_displaymode");
    onlineinfo_UpdateParm("onlineinfo_guest_displaytime");
    onlineinfo_UpdateParm("onlineinfo_guest_flash");
    onlineinfo_UpdateParm("onlineinfo_guest_flashcolour");
    onlineinfo_UpdateParm("onlineinfo_guest_height");
    onlineinfo_UpdateParm("onlineinfo_guest_width");
    onlineinfo_UpdateParm("onlineinfo_show_info");
    onlineinfo_UpdateParm("onlineinfo_new_icon");
    onlineinfo_UpdateParm("onlineinfo_new_icontype");
    onlineinfo_UpdateParm("onlineinfo_avatar");
    onlineinfo_UpdateParm("onlineinfo_showbdays");
    onlineinfo_UpdateParm("onlineinfo_nobdays");
    onlineinfo_UpdateParm("onlineinfo_formatbdays");
    onlineinfo_UpdateParm("onlineinfo_width");
    onlineinfo_UpdateParm("onlineinfo_showforum");
    onlineinfo_UpdateParm("onlineinfo_forumno");
    onlineinfo_UpdateParm("onlineinfo_showvisit");
    onlineinfo_UpdateParm("onlineinfo_visitno");
    onlineinfo_UpdateParm("onlineinfo_hideforum");
    onlineinfo_UpdateParm("onlineinfo_hidevisit");
    onlineinfo_UpdateParm("onlineinfo_hidebdays");
    onlineinfo_UpdateParm("onlineinfo_hidelast");
    onlineinfo_UpdateParm("onlineinfo_showicons");
    onlineinfo_UpdateParm("onlineinfo_showadmin");
    onlineinfo_UpdateParm("onlineinfo_hidecounter");
    onlineinfo_UpdateParm("onlineinfo_hideupdates");
    onlineinfo_UpdateParm("onlineinfo_showupdates");
    onlineinfo_UpdateParm("onlineinfo_showcounter");
    onlineinfo_UpdateParm("onlineinfo_order1");
    onlineinfo_UpdateParm("onlineinfo_order2");
    onlineinfo_UpdateParm("onlineinfo_order3");
    onlineinfo_UpdateParm("onlineinfo_order4");
    onlineinfo_UpdateParm("onlineinfo_extraorder1");
    onlineinfo_UpdateParm("onlineinfo_extraorder2");
    onlineinfo_UpdateParm("onlineinfo_extraorder3");
    onlineinfo_UpdateParm("onlineinfo_extraorder4");
    onlineinfo_UpdateParm("onlineinfo_extraorder5");
    onlineinfo_UpdateParm("onlineinfo_extraorder6");

    save_prefs();

    while (list($key, $value) = each($_POST))
    {
        if ($value != "Update Menu Settings")
        {
            $menu_pref[$key] = str_replace("<br />", "", $aj->formtpa($value, "admin"));
        } 
    } 

    $tmp = addslashes(serialize($menu_pref));
    $sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
    $ns->tablerender("", "<div style='text-align:center' ><b>" . ONLINE4_A77 . "</b></div>");
} 

$onlineinfo_caption = $pref['onlineinfo_caption'];
$onlineinfo_pm = $pref['onlineinfo_pm'];
$onlineinfo_online = $pref['onlineinfo_online'];
$onlineinfo_coppermine = $pref['onlineinfo_coppermine'];
$onlineinfo_last = $pref['onlineinfo_last'];
$onlineinfo_guest = $pref['onlineinfo_guest'];
$onlineinfo_lastnum = $pref['onlineinfo_lastnum'];
$onlineinfo_downloads = $pref['onlineinfo_downloads'];
$onlineinfo_online_plug = $pref['onlineinfo_online_plug'];
$onlineinfo_guestmessage = $pref['onlineinfo_guestmessage'];
$onlineinfo_guest_message = $pref['onlineinfo_guest_message'];
$onlineinfo_guest_bg = $pref['onlineinfo_guest_bg'];
$onlineinfo_guest_displaymode = $pref['onlineinfo_guest_displaymode'];
$onlineinfo_guest_displaytime = $pref['onlineinfo_guest_displaytime'];
$onlineinfo_guest_flash = $pref['onlineinfo_guest_flash'];
$onlineinfo_guest_flashcolour = $pref['onlineinfo_guest_flashcolour'];
$onlineinfo_guest_height = $pref['onlineinfo_guest_height'];
$onlineinfo_guest_width = $pref['onlineinfo_guest_width'];
$onlineinfo_show_info = $pref['onlineinfo_show_info'];
$onlineinfo_new_icon = $pref['onlineinfo_new_icon'];
$onlineinfo_new_icontype = $pref['onlineinfo_new_icontype'];
$onlineinfo_avatar = $pref['onlineinfo_avatar'];
$onlineinfo_showbdays = $pref['onlineinfo_showbdays'];
$onlineinfo_nobdays = $pref['onlineinfo_nobdays'];
$onlineinfo_formatbdays = $pref['onlineinfo_formatbdays'];
$onlineinfo_width = $pref['onlineinfo_width'];
$onlineinfo_showforum = $pref['onlineinfo_showforum'];
$onlineinfo_forumno = $pref['onlineinfo_forumno'];
$onlineinfo_showvisit = $pref['onlineinfo_showvisit'];
$onlineinfo_visitno = $pref['onlineinfo_visitno'];
$onlineinfo_hideforum = $pref['onlineinfo_hideforum'];
$onlineinfo_hidevisit = $pref['onlineinfo_hidevisit'];
$onlineinfo_hidebdays = $pref['onlineinfo_hidebdays'];
$onlineinfo_hidelast = $pref['onlineinfo_hidelast'];
$onlineinfo_showicons = $pref['onlineinfo_showicons'];
$onlineinfo_showadmin = $pref['onlineinfo_showadmin'];
$onlineinfo_hidecounter = $pref['onlineinfo_hidecounter'];
$onlineinfo_hideupdates = $pref['onlineinfo_hideupdates'];
$onlineinfo_showupdates = $pref['onlineinfo_showupdates'];
$onlineinfo_showcounter = $pref['onlineinfo_showcounter'];
$onlineinfo_order1 = $pref['onlineinfo_order1'];
$onlineinfo_order2 = $pref['onlineinfo_order2'];
$onlineinfo_order3 = $pref['onlineinfo_order3'];
$onlineinfo_order4 = $pref['onlineinfo_order4'];
$onlineinfo_extraorder1 = $pref['onlineinfo_extraorder1'];
$onlineinfo_extraorder2 = $pref['onlineinfo_extraorder2'];
$onlineinfo_extraorder3 = $pref['onlineinfo_extraorder3'];
$onlineinfo_extraorder4 = $pref['onlineinfo_extraorder4'];
$onlineinfo_extraorder5 = $pref['onlineinfo_extraorder5'];
$onlineinfo_extraorder6 = $pref['onlineinfo_extraorder6'];

$text = "<div style='text-align:center' >
<form method='post' action='" . e_SELF . "' id='menu_conf_form' >
<table style='width:97%' class='fborder' >
<tr>
<td colspan='5' class='fcaption' >" . ONLINE4_A73 . "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3' >" . ONLINE4_A6 . "<br /><span class='smalltext'>" . ONLINE4_A7 . "</span></td>
<td class='forumheader3' colspan='4'><input class='tbox' type='text' name='onlineinfo_caption' size='40' value='" . $onlineinfo_caption . "' maxlength='41' /><br />" . ONLINE4_A8 . "</td>
</tr>";

$dropdown1 = online4_yn_dropdown("onlineinfo_pm", $onlineinfo_pm);
$dropdown2 = online4_yn_dropdown("onlineinfo_online", $onlineinfo_online);
$dropdown3 = online4_yn_dropdown("onlineinfo_coppermine", $onlineinfo_coppermine);
$dropdown4 = online4_yn_dropdown("onlineinfo_last", $onlineinfo_last);
$dropdown5 = online4_yn_dropdown("onlineinfo_guest", $onlineinfo_guest);
$dropdown6 = online4_yn_dropdown("onlineinfo_downloads", $onlineinfo_downloads);
$dropdown7 = online4_yn_dropdown("onlineinfo_guestmessage", $onlineinfo_guestmessage);
$dropdown8 = online4_yn_dropdown("onlineinfo_guest_flash", $onlineinfo_guest_flash);
$dropdown9 = online4_yn_dropdown("onlineinfo_show_info", $onlineinfo_show_info);
$dropdown10 = online4_yn_dropdown("onlineinfo_new_icon", $onlineinfo_new_icon);
$dropdown11 = online4_yn_dropdown("onlineinfo_avatar", $onlineinfo_avatar);
$dropdown12 = online4_yn_dropdown("onlineinfo_showbdays", $onlineinfo_showbdays);
$dropdown13 = online4_yn_dropdown("onlineinfo_showforum", $onlineinfo_showforum);
$dropdown14 = online4_yn_dropdown("onlineinfo_hideforum", $onlineinfo_hideforum);
$dropdown15 = online4_yn_dropdown("onlineinfo_showvisit", $onlineinfo_showvisit);
$dropdown16 = online4_yn_dropdown("onlineinfo_hidevisit", $onlineinfo_hidevisit);
$dropdown17 = online4_yn_dropdown("onlineinfo_hidebdays", $onlineinfo_hidebdays);
$dropdown18 = online4_yn_dropdown("onlineinfo_hidelast", $onlineinfo_hidelast);
$dropdown19 = online4_yn_dropdown("onlineinfo_showicons", $onlineinfo_showicons);
$dropdown20 = online4_yn_dropdown("onlineinfo_showadmin", $onlineinfo_showadmin);
$dropdown21 = online4_yn_dropdown("onlineinfo_hidecounter", $onlineinfo_hidecounter);
$dropdown22 = online4_yn_dropdown("onlineinfo_hideupdates", $onlineinfo_hideupdates);
$dropdown23 = online4_yn_dropdown("onlineinfo_showcounter", $onlineinfo_showcounter);
$dropdown24 = online4_yn_dropdown("onlineinfo_showupdates", $onlineinfo_showupdates);

$text .= "

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A9 . "<br /><span class='smalltext'>" . ONLINE4_A10 . "</span></td>
<td class='forumheader3' colspan='4'><input class='tbox' type='text' name='onlineinfo_width' size='6' value='" . $onlineinfo_width . "' maxlength='5' />&nbsp;" . ONLINE4_A11 . "</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A12 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown1 . "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3' valign='top'>" . ONLINE4_A13 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown2 . "<br /><br />

<table style='width:100%' class='fborder'>
<tr>";
if ($onlineinfo_online_plug == "Standard")
{
    $text .= "<td style='width:30%' class='forumheader3'>" . ONLINE4_A14 . "</td>
<td style='width:70%' class='forumheader3'><input type=\"radio\"  name=\"onlineinfo_online_plug\" value=\"Standard\" checked='checked' />&nbsp;" . ONLINE4_A15 . "&nbsp;<input type=\"radio\"  name=\"onlineinfo_online_plug\" value=\"Cams\" />&nbsp;" . ONLINE4_A16 . "&acute;s</td>";
} 
else
{
    $text .= "<td style='width:30%' class='forumheader3'>" . ONLINE4_A14 . "</td>
<td style='width:70%' class='forumheader3'><input type=\"radio\"  name=\"onlineinfo_online_plug\" value=\"Standard\" />&nbsp;" . ONLINE4_A15 . "&nbsp;<input type=\"radio\"  name=\"onlineinfo_online_plug\" value=\"Cams\" checked='checked' />&nbsp;" . ONLINE4_A16 . "&acute;s</td>";
} 

$text .= "</tr>
<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A17 . "</td>
<td class='forumheader3'>" . $dropdown11 . "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A18 . "</td>
<td class='forumheader3'>" . $dropdown5 . "</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A19 . "</td>
<td class='forumheader3'>" . $dropdown19 . "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A20 . "</td>
<td class='forumheader3'>" . $dropdown20 . "</td>
</tr>
</table>
</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td colspan='5' style='width:100%'><b>" . ONLINE4_A21 . "</b></td></tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A22 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown9 . "</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3' valign='top'>" . ONLINE4_A23 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown24 . "<br /><br />
<table style='width:100%' class='fborder'>
<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A24 . "</td>
<td style='width:70%' class='forumheader3' colspan='3'>" . $dropdown22 . "</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A25 . "</td>
<td colspan='4' class='forumheader3'>" . $dropdown10 . "</td>
</tr>
<tr>";

if ($onlineinfo_new_icontype == "new.gif")
{
    $text .= "<td style='width:30%' class='forumheader3'>" . ONLINE4_A28 . "<br /><span class='smalltext'>" . ONLINE4_A29 . "</span></td>
<td colspan='4' class='forumheader3'><input type=\"radio\"  name=\"onlineinfo_new_icontype\" value=\"new.gif\" checked='checked' />&nbsp;<img src=\"" . e_PLUGIN . "onlineinfo4_menu/images/new.gif\" alt='new' /> " . ONLINE4_A26 . "<br /><input type=\"radio\"  name=\"onlineinfo_new_icontype\" value=\"new2.gif\" />&nbsp;<img src=\"" . e_PLUGIN . "onlineinfo4_menu/images/new2.gif\" alt='new' /> " . ONLINE4_A27 . "</td>";
} 
else
{
    $text .= "<td style='width:30%' class='forumheader3'>" . ONLINE4_A28 . "<br /><span class='smalltext'>" . ONLINE4_A29 . "</span></td>
<td colspan='4' class='forumheader3'><input type=\"radio\"  name=\"onlineinfo_new_icontype\" value=\"new.gif\"/>&nbsp;<img src=\"" . e_PLUGIN . "onlineinfo4_menu/images/new.gif\" alt='new' /> " . ONLINE4_A26 . "<br /><input type=\"radio\"  name=\"onlineinfo_new_icontype\" value=\"new2.gif\" checked='checked' />&nbsp;<img src=\"" . e_PLUGIN . "onlineinfo4_menu/images/new2.gif\" alt='new' /> " . ONLINE4_A27 . "</td>";
} 
$text .= "</tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A30 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown6 . "</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A31 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown3 . "</td>
</tr>
</table>
</td></tr>


<tr>
<td style='width:30%' class='forumheader3'>" . ONLINE4_A32 . "</td>
<td style='width:15%' class='forumheader3'>" . $dropdown13 . "</td>
<td style='width:20%' class='forumheader3'>" . ONLINE4_A33 . "&nbsp;" . $dropdown14 . "</td>
<td style='width:25%' class='forumheader3'>" . ONLINE4_A34 . "<br /><span class='smalltext'>" . ONLINE4_A35 . "</span></td>
<td style='width:10%' class='forumheader3'>
<input class='tbox' type='text' name='onlineinfo_forumno' size='3' value='" . $onlineinfo_forumno . "' maxlength='2' />
</td>
</tr>
<tr>
<td class='forumheader3'>" . ONLINE4_A36 . "</td>
<td class='forumheader3'>" . $dropdown15 . "</td>
<td class='forumheader3'>" . ONLINE4_A37 . "&nbsp;" . $dropdown16 . "</td>
<td class='forumheader3'>" . ONLINE4_A38 . "<br /><span class='smalltext'>" . ONLINE4_A39 . "</span></td>
<td class='forumheader3'>
<input class='tbox' type='text' name='onlineinfo_visitno' size='3' value='" . $onlineinfo_visitno . "' maxlength='2' />
</td>
</tr>

<tr>
<td class='forumheader3'>" . ONLINE4_A40 . "</td>
<td class='forumheader3'>" . $dropdown12 . "</td>
<td class='forumheader3'>" . ONLINE4_A41 . "&nbsp;" . $dropdown17 . "</td>
<td class='forumheader3'>" . ONLINE4_A42 . "<br /><span class='smalltext'>" . ONLINE4_A43 . "</span></td>
<td class='forumheader3'><input class='tbox' type='text' name='onlineinfo_nobdays' size='3' value='" . $onlineinfo_nobdays . "' maxlength='2' /><br />" . ONLINE4_A44 . "<input type='checkbox' name='onlineinfo_formatbdays' value='1'";
if ($pref['onlineinfo_formatbdays'] == "1")
    $text .= " checked='checked' ";
$text .= " />
</td>
</tr>

<tr>
<td class='forumheader3'>" . ONLINE4_A45 . "</td>
<td class='forumheader3'>" . $dropdown4 . "</td>
<td class='forumheader3'>" . ONLINE4_A46 . "&nbsp;" . $dropdown18 . "</td>
<td class='forumheader3'>" . ONLINE4_A47 . "<br /><span class='smalltext'>" . ONLINE4_A48 . "</span></td>
<td class='forumheader3'>
<input class='tbox' type='text' name='onlineinfo_lastnum' size='3' value='" . $onlineinfo_lastnum . "' maxlength='2' />
</td>
</tr>


<tr>
<td class='forumheader3'>" . ONLINE4_A49 . "</td>
<td class='forumheader3'>" . $dropdown23 . "</td>
<td class='forumheader3' colspan='3'>" . ONLINE4_A50 . "&nbsp;" . $dropdown21 . "</td>
</tr>

<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td colspan='5' style='width:100%'><b>" . ONLINE4_A51 . "</b></td></tr>

<tr><td colspan='5' class='forumheader3'>1.&nbsp;
<select name='onlineinfo_order1' class='tbox'>

<option value='avatar.php' ";

if ($onlineinfo_order1 == 'avatar.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Avatar</option>
<option value='pm.php' ";

if ($onlineinfo_order1 == 'pm.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Private Message</option>
<option value='currentlyonline.php' ";

if ($onlineinfo_order1 == 'currentlyonline.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Who is Online</option>
<option value='extrainfo.php' ";

if ($onlineinfo_order1 == 'extrainfo.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Extra Info</option>
</select>
</td></tr>

<tr><td colspan='5' class='forumheader3'>2.&nbsp;
<select name='onlineinfo_order2' class='tbox'>

<option value='avatar.php' ";

if ($onlineinfo_order2 == 'avatar.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Avatar</option>
<option value='pm.php' ";

if ($onlineinfo_order2 == 'pm.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Private Message</option>
<option value='currentlyonline.php' ";

if ($onlineinfo_order2 == 'currentlyonline.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Who is Online</option>
<option value='extrainfo.php' ";

if ($onlineinfo_order2 == 'extrainfo.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Extra Info</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>3.&nbsp;
<select name='onlineinfo_order3' class='tbox'>

<option value='avatar.php' ";

if ($onlineinfo_order3 == 'avatar.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Avatar</option>
<option value='pm.php' ";

if ($onlineinfo_order3 == 'pm.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Private Message</option>
<option value='currentlyonline.php' ";

if ($onlineinfo_order3 == 'currentlyonline.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Who is Online</option>
<option value='extrainfo.php' ";

if ($onlineinfo_order3 == 'extrainfo.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Extra Info</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>4.&nbsp;
<select name='onlineinfo_order4' class='tbox'>

<option value='avatar.php' ";

if ($onlineinfo_order4 == 'avatar.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Avatar</option>
<option value='pm.php' ";

if ($onlineinfo_order4 == 'pm.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Private Message</option>
<option value='currentlyonline.php' ";

if ($onlineinfo_order4 == 'currentlyonline.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Who is Online</option>
<option value='extrainfo.php' ";

if ($onlineinfo_order4 == 'extrainfo.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Extra Info</option>
</select></td></tr>



<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td colspan='5' style='width:100%'><b>" . ONLINE4_A52 . "</b></td></tr>

<tr><td colspan='5' class='forumheader3'>1.&nbsp;
<select name='onlineinfo_extraorder1' class='tbox'>

<option value='updated.php' ";

if ($onlineinfo_extraorder1 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder1 == 'toppost.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder1 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder1 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder1 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder1 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>

</select></td></tr>

<tr><td colspan='5' class='forumheader3'>2.&nbsp;
<select name='onlineinfo_extraorder2' class='tbox'>
<option value='updated.php' ";

if ($onlineinfo_extraorder2 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder2 == 'toppost.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder2 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder2 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder2 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder2 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>3.&nbsp;
<select name='onlineinfo_extraorder3' class='tbox'>
<option value='updated.php' ";

if ($onlineinfo_extraorder3 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder3 == 'toppost.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder3 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder3 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder3 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder3 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>4.&nbsp;
<select name='onlineinfo_extraorder4' class='tbox'>
<option value='updated.php' ";

if ($onlineinfo_extraorder4 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder4 == 'toppost.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder4 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder4 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder4 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder4 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>5.&nbsp;
<select name='onlineinfo_extraorder5' class='tbox'>
<option value='updated.php' ";

if ($onlineinfo_extraorder5 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder5 == 'toppost.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder5 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder5 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder5 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder5 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>
</select></td></tr>

<tr><td colspan='5' class='forumheader3'>6.&nbsp;
<select name='onlineinfo_extraorder6' class='tbox'>
<option value='updated.php' ";

if ($onlineinfo_extraorder6 == 'updated.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Latest Changes</option>
<option value='toppost.php' ";

if ($onlineinfo_extraorder6 == 'toppost.php')
{
    $text .= "selected";
} 
$text .= ">Top Forum Posts</option>
<option value='topvisits.php' ";

if ($onlineinfo_extraorder6 == 'topvisits.php')
{
    $text .= "selected='selected'";
} 
$text .= ">Top Visitors</option>
<option value='birthday.php' ";

if ($onlineinfo_extraorder6 == 'birthday.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Birthdays</option>
<option value='lastvisitors.php' ";

if ($onlineinfo_extraorder6 == 'lastvisitors.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Last Visitors</option>
<option value='counter.php' ";

if ($onlineinfo_extraorder6 == 'counter.php')
{
    $text .= "selected='selected'";
} 

$text .= ">Hit Counter</option>
</select></td></tr>

<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td colspan='5'><strong>" . ONLINE4_A78 . "</strong></td></tr>
<tr>
<td style='width:30%' class='forumheader3' valign='top'>" . ONLINE4_A53 . "</td>
<td class='forumheader3' colspan='4'>" . $dropdown7 . "<br /><br />

<table style='width:100%' class='fborder'>
<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A54 . "<br /><span class='smalltext'>" . ONLINE4_A55 . "</span></td>
<td class='forumheader3' colspan='3'><textarea class='tbox' name='onlineinfo_guest_message' cols='60' rows='4'>" . $onlineinfo_guest_message . "</textarea></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A56 . "<br /><span class='smalltext'>" . ONLINE4_A57 . "<br />default: #FFFF8A</span></td>
<td class='forumheader3' colspan='3'><input class='tbox' type='text' name='onlineinfo_guest_bg' size='8' value='" . $onlineinfo_guest_bg . "' maxlength='7' /></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A58 . "<br /><span class='smalltext'>" . ONLINE4_A59 . "<br />" . ONLINE4_A60 . "</span></td>
<td class='forumheader3' colspan='3'><input class='tbox' type='text' name='onlineinfo_guest_displaymode' size='2' value='" . $onlineinfo_guest_displaymode . "' maxlength='1' /></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A61 . "<br /><span class='smalltext'>" . ONLINE4_A62 . "<br />" . ONLINE4_A63 . "" . ONLINE4_A63 . "</span></td>
<td class='forumheader3' colspan='3'><input class='tbox' type='text' name='onlineinfo_guest_displaytime' size='7' value='" . $onlineinfo_guest_displaytime . "' maxlength='6' /></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A64 . "<br /><span class='smalltext'>" . ONLINE4_A65 . "</span></td>
<td style='width:30%' class='forumheader3'>" . $dropdown8 . "</td>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A66 . "<br /><span class='smalltext'>" . ONLINE4_A67 . "<br />" . ONLINE4_A68 . "</span></td>
<td style='width:10%' class='forumheader3'><input class='tbox' type='text' name='onlineinfo_guest_flashcolour' size='8' value='" . $onlineinfo_guest_flashcolour . "' maxlength='7' /></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A69 . "<br /><span class='smalltext'>" . ONLINE4_A70 . "</span></td>
<td class='forumheader3' colspan='3'><input class='tbox' type='text' name='onlineinfo_guest_height' size='5' value='" . $onlineinfo_guest_height . "' maxlength='4' /></td>
</tr>

<tr>
<td style='width:30%' valign='top' class='forumheader3'>" . ONLINE4_A71 . "<br /><span class='smalltext'>" . ONLINE4_A72 . "</span></td>
<td class='forumheader3' colspan='3'><input class='tbox' type='text' name='onlineinfo_guest_width' size='5' value='" . $onlineinfo_guest_width . "' maxlength='4' /></td>
</tr>
</table>
</td>
</tr>

<tr>
<td colspan='5' class='fcaption' style='text-align:left'><input class='button' type='submit' name='update_menu' value='" . ONLINE4_A73 . "' /></td>
</tr>
</table>
</form>
</div>";
$ns->tablerender(ONLINE4_A73 , $text);

require_once(e_ADMIN . "footer.php");

?>