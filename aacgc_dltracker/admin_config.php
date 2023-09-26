<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Download Tracker          #    
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

if (e_QUERY == "update")
{
 
    $pref['dltracker_pagetitle'] = $_POST['dltracker_pagetitle'];
    $pref['dltracker_avatar_size'] = $_POST['dltracker_avatar_size'];
    $pref['dltracker_rendperpage'] = $_POST['dltracker_rendperpage'];
    $pref['dltracker_order'] = $_POST['dltracker_order'];


if (isset($_POST['dltracker_enable_gold'])) 
{$pref['dltracker_enable_gold'] = 1;}
else
{$pref['dltracker_enable_gold'] = 0;}

if (isset($_POST['dltracker_enable_avatar'])) 
{$pref['dltracker_enable_avatar'] = 1;}
else
{$pref['dltracker_enable_avatar'] = 0;}

if (isset($_POST['dltracker_enable_profile'])) 
{$pref['dltracker_enable_profile'] = 1;}
else
{$pref['dltracker_enable_profile'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Download Tracker (settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Download Tracker Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='dltracker_pagetitle' value='" . $tp->toFORM($pref['dltracker_pagetitle']) . "' /></td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Downloads Per Page:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='dltracker_rendperpage' value='" . $tp->toFORM($pref['dltracker_rendperpage']) . "' /></td>
		</tr>

		<tr>
                <td style='width:30%' class='forumheader3'>Order Downloads By:</td>
     <td style='width:' class=''>
<select name='dltracker_order' size='1' class='tbox' style='width:50%'>
<option name='dltracker_order' value='".$pref['dltracker_order']."'>".$pref['dltracker_order']."</option>
<option name='dltracker_order' value='Name/ASC'>Name/ASC</option>
<option name='dltracker_order' value='Name/DESC'>Name/DESC</option>
<option name='dltracker_order' value='Times Downloaded/ASC'>Times Downloaded/ASC</option>
<option name='dltracker_order' value='Times Downloaded/DESC'>Times Downloaded/DESC</option>
    </td>
		<tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Users Avatar:</td>
		        <td colspan=2 class='forumheader3'>".($pref['dltracker_enable_avatar'] == 1 ? "<input type='checkbox' name='dltracker_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='dltracker_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='dltracker_avatar_size' value='" . $tp->toFORM($pref['dltracker_avatar_size']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Downloaded Files In Profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['dltracker_enable_profile'] == 1 ? "<input type='checkbox' name='dltracker_enable_profile' value='1' checked='checked' />" : "<input type='checkbox' name='dltracker_enable_profile' value='0' />")."</td>
	        </tr>


		<tr>
			<td colspan='3' class='fcaption'><b>Extra Settings:</b></td>
		</tr>
              <tr>
		        <td style='width:30%' class='forumheader3'>Show Gold Orbs as Usernames: (must have Gold Orbs installed)</td>
		        <td colspan=2 class='forumheader3'>".($pref['dltracker_enable_gold'] == 1 ? "<input type='checkbox' name='dltracker_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='dltracker_enable_gold' value='0' />")."</td>
	        </tr>




                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
