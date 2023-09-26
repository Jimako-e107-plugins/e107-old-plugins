<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
 
    $pref['msmenu_height'] = $_POST['msmenu_height'];
    $pref['msmenu_speed'] = $_POST['msmenu_speed'];
    $pref['msmenu_mouseoverspeed'] = $_POST['msmenu_mouseoverspeed'];
    $pref['msmenu_mouseoutspeed'] = $_POST['msmenu_mouseoutspeed'];
    $pref['msmenu_avatar_size'] = $_POST['msmenu_avatar_size'];
    $pref['ms_inputheight'] = $_POST['ms_inputheight'];
    $pref['ms_inputwidth'] = $_POST['ms_inputwidth'];
    $pref['mspage_inputheight'] = $_POST['mspage_inputheight'];
    $pref['mspage_inputwidth'] = $_POST['mspage_inputwidth'];
    $pref['mspage_avatar_size'] = $_POST['mspage_avatar_size'];


if (isset($_POST['ms_enable_gold'])) 
{$pref['ms_enable_gold'] = 1;}
else
{$pref['ms_enable_gold'] = 0;}

if (isset($_POST['ms_enable_autoscroll'])) 
{$pref['ms_enable_autoscroll'] = 1;}
else
{$pref['ms_enable_autoscroll'] = 0;}

if (isset($_POST['ms_enable_forum'])) 
{$pref['ms_enable_forum'] = 1;}
else
{$pref['ms_enable_forum'] = 0;}

if (isset($_POST['ms_enable_profile'])) 
{$pref['ms_enable_profile'] = 1;}
else
{$pref['ms_enable_profile'] = 0;}

if (isset($_POST['msmenu_enable_avatar'])) 
{$pref['msmenu_enable_avatar'] = 1;}
else
{$pref['msmenu_enable_avatar'] = 0;}

if (isset($_POST['mspage_enable_avatar'])) 
{$pref['mspage_enable_avatar'] = 1;}
else
{$pref['mspage_enable_avatar'] = 0;}

if (isset($_POST['msmenu_enable_members'])) 
{$pref['msmenu_enable_members'] = 1;}
else
{$pref['msmenu_enable_members'] = 0;}

if (isset($_POST['ms_enable_bbcode'])) 
{$pref['ms_enable_bbcode'] = 1;}
else
{$pref['ms_enable_bbcode'] = 0;}

if (isset($_POST['ms_enable_theme'])) 
{$pref['ms_enable_theme'] = 1;}
else
{$pref['ms_enable_theme'] = 0;}

    save_prefs();
    $text .= "".AMS_05."";
}

$admin_title = "AACGC Member Status (".AMS_06.")";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>".AMS_07.":</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_34.":<br><i>".AMS_35."</i></td>
		        <td colspan=2 class='forumheader3'>".($pref['ms_enable_theme'] == 1 ? "<input type='checkbox' name='ms_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_theme' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_08.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['ms_enable_bbcode'] == 1 ? "<input type='checkbox' name='ms_enable_bbcode' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_bbcode' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_09.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['ms_enable_profile'] == 1 ? "<input type='checkbox' name='ms_enable_profile' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_profile' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_10.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['ms_enable_forum'] == 1 ? "<input type='checkbox' name='ms_enable_forum' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_forum' value='0' />")."</td>
	        </tr>


		<tr>
			<td colspan='3' class='fcaption'><b>".AMS_11.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_12.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='mspage_inputheight' value='" . $tp->toFORM($pref['mspage_inputheight'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_13.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='mspage_inputwidth' value='" . $tp->toFORM($pref['mspage_inputwidth'])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_14.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['mspage_enable_avatar'] == 1 ? "<input type='checkbox' name='mspage_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='mspage_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_15.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='mspage_avatar_size' value='" . $tp->toFORM($pref['mspage_avatar_size'])."' />px</td>
		</tr>



		<tr>
			<td colspan='3' class='fcaption'><b>".AMS_16.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_12.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='ms_inputheight' value='" . $tp->toFORM($pref['ms_inputheight'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_13.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='ms_inputwidth' value='" . $tp->toFORM($pref['ms_inputwidth'])."' />px</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_17.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['msmenu_enable_members'] == 1 ? "<input type='checkbox' name='msmenu_enable_members' value='1' checked='checked' />" : "<input type='checkbox' name='msmenu_enable_members' value='0' />")."</td>
	        </tr>



                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_14.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['msmenu_enable_avatar'] == 1 ? "<input type='checkbox' name='msmenu_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='msmenu_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_15.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='msmenu_avatar_size' value='" . $tp->toFORM($pref['msmenu_avatar_size'])."' />px</td>
		</tr>



		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_18.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='msmenu_height' value='" . $tp->toFORM($pref['msmenu_height']) . "' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_19.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['ms_enable_autoscroll'] == 1 ? "<input type='checkbox' name='ms_enable_autoscroll' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_autoscroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_20.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='msmenu_speed' value='" . $tp->toFORM($pref['msmenu_speed']) . "' />  ".AMS_27."</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_21.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='msmenu_mouseoverspeed' value='" . $tp->toFORM($pref['msmenu_mouseoverspeed']) . "' />  ".AMS_28."</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_22.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='msmenu_mouseoutspeed' value='" . $tp->toFORM($pref['msmenu_mouseoutspeed']) . "' />  ".AMS_27."</td>
		</tr>


";


$text .= "

		<tr>
			<td colspan=2 class='fcaption'><b>".AMS_23.":</b></td>
		</tr>
            <tr>
		        <td style='width:30%' class='forumheader3'>".AMS_24.":</td>
		        <td class='forumheader3'>".($pref['ms_enable_gold'] == 1 ? "<input type='checkbox' name='ms_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='ms_enable_gold' value='0' />")." ".AMS_25."</td>
	        </tr>





                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".AMS_26."' class='button' /></td>
		</tr>





</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
