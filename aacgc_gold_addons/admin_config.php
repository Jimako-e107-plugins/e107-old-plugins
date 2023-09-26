<?php


/*
##########################
# AACGC Gold Addons      #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
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


    $pref['goldaddon_richcount'] = $_POST['goldaddon_richcount'];
    $pref['goldaddon_topassetcount'] = $_POST['goldaddon_topassetcount'];
    $pref['goldaddon_topgoldmemimg'] = $_POST['goldaddon_topgoldmemimg'];
    $pref['goldaddon_assetimg'] = $_POST['goldaddon_assetimg'];
    $pref['goldaddon_avatarsize'] = $_POST['goldaddon_avatarsize'];


if (isset($_POST['goldaddon_enable_orbs'])) 
{$pref['goldaddon_enable_orbs'] = 1;}
else
{$pref['goldaddon_enable_orbs'] = 0;}

if (isset($_POST['goldaddon_enable_avatar'])) 
{$pref['goldaddon_enable_avatar'] = 1;}
else
{$pref['goldaddon_enable_avatar'] = 0;}

if (isset($_POST['goldaddon_enable_assets'])) 
{$pref['goldaddon_enable_assets'] = 1;}
else
{$pref['goldaddon_enable_assets'] = 0;}

if (isset($_POST['goldaddon_enable_profileassets'])) 
{$pref['goldaddon_enable_profileassets'] = 1;}
else
{$pref['goldaddon_enable_profileassets'] = 0;}

if (isset($_POST['goldaddon_enable_profilepresents'])) 
{$pref['goldaddon_enable_profilepresents'] = 1;}
else
{$pref['goldaddon_enable_profilepresents'] = 0;}

if (isset($_POST['goldaddon_enable_forumprescount'])) 
{$pref['goldaddon_enable_forumprescount'] = 1;}
else
{$pref['goldaddon_enable_forumprescount'] = 0;}

if (isset($_POST['goldaddon_enable_forumassetcount'])) 
{$pref['goldaddon_enable_forumassetcount'] = 1;}
else
{$pref['goldaddon_enable_forumassetcount'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Gold Addons (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confgoldaddons'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>





		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_avatar'] == 1 ? "<input type='checkbox' name='goldaddon_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='goldaddon_avatarsize' value='".$tp->toFORM($pref['goldaddon_avatarsize'])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold Orbs:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_orbs'] == 1 ? "<input type='checkbox' name='goldaddon_enable_orbs' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_orbs' value='0' />")."(shows orbs, must have gold orbs 1.x or higher installed)</td>
	        </tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Richest Member Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Money Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='goldaddon_topgoldmemimg' value='".$tp->toFORM($pref['goldaddon_topgoldmemimg'])."' />px</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'><b>Richest Members Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Users To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='goldaddon_richcount' value='".$tp->toFORM($pref['goldaddon_richcount'])."' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Top Asset Member Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Asset Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='goldaddon_assetimg' value='".$tp->toFORM($pref['goldaddon_assetimg'])."' />px</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'><b>Top Asset Members Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Users To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='goldaddon_topassetcount' value='".$tp->toFORM($pref['goldaddon_topassetcount'])."' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Profile Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Presents in Profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_profilepresents'] == 1 ? "<input type='checkbox' name='goldaddon_enable_profilepresents' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_profilepresents' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Assets in Profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_profileassets'] == 1 ? "<input type='checkbox' name='goldaddon_enable_profileassets' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_profileassets' value='0' />")."</td>
	        </tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Forum Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Present Count In Forum Posts:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_forumprescount'] == 1 ? "<input type='checkbox' name='goldaddon_enable_forumprescount' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_forumprescount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Asset Count In Forum Posts:</td>
		        <td colspan=2 class='forumheader3'>".($pref['goldaddon_enable_forumassetcount'] == 1 ? "<input type='checkbox' name='goldaddon_enable_forumassetcount' value='1' checked='checked' />" : "<input type='checkbox' name='goldaddon_enable_forumassetcount' value='0' />")."</td>
	        </tr>



                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
