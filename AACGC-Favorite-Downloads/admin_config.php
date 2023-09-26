<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/
//-----------------------------------------------------------------------------------------------------------+


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

   $pref['favdls_menu_title'] = $_POST['favdls_menu_title'];
   $pref['favdls_menu_height'] = $_POST['favdls_menu_height'];
   $pref['favdls_usermenu_title'] = $_POST['favdls_usermenu_title'];
   $pref['favdls_usermenu_height'] = $_POST['favdls_usermenu_height'];
   $pref['favdls_profilelist_height'] = $_POST['favdls_profilelist_height'];
   $pref['favdls_menu_avatarsize'] = $_POST['favdls_menu_avatarsize'];
   $pref['favdls_page_avatarsize'] = $_POST['favdls_page_avatarsize'];
   $pref['favdls_menumax'] = $_POST['favdls_menumax'];
   $pref['favdls_usermaxfav'] = $_POST['favdls_usermaxfav'];

if (isset($_POST['favdls_enable_menuavatar'])) 
{$pref['favdls_enable_menuavatar'] = 1;}
else
{$pref['favdls_enable_menuavatar'] = 0;}

if (isset($_POST['favdls_enable_pageavatar'])) 
{$pref['favdls_enable_pageavatar'] = 1;}
else
{$pref['favdls_enable_pageavatar'] = 0;}

if (isset($_POST['favdls_enable_forumcount'])) 
{$pref['favdls_enable_forumcount'] = 1;}
else
{$pref['favdls_enable_forumcount'] = 0;}

if (isset($_POST['favdls_enable_profilelist'])) 
{$pref['favdls_enable_profilelist'] = 1;}
else
{$pref['favdls_enable_profilelist'] = 0;}

if (isset($_POST['favdls_enable_gold'])) 
{$pref['favdls_enable_gold'] = 1;}
else
{$pref['favdls_enable_gold'] = 0;}

if (isset($_POST['favdls_enable_theme'])) 
{$pref['favdls_enable_theme'] = 1;}
else
{$pref['favdls_enable_theme'] = 0;}

if (isset($_POST['favdls_enable_dlpage'])) 
{$pref['favdls_enable_dlpage'] = 1;}
else
{$pref['favdls_enable_dlpage'] = 0;}


if (isset($_POST['favdls_enable_dlpagecount'])) 
{$pref['favdls_enable_dlpagecount'] = 1;}
else
{$pref['favdls_enable_dlpagecount'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Favorite Downloads (Settings)";
//--------------------------------------------------------------------




$text .= "
<form method='post' action='" . e_SELF . "?update' id='frsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable Indent Layout:<br><i>Adds indent to the table and table data areas to give a more details look. Only works on some themes, disable if table and areas don't appear correctly.</i></td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_theme'] == 1 ? "<input type='checkbox' name='favdls_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_theme' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Add To Favorites button on Download Detail Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_dlpage'] == 1 ? "<input type='checkbox' name='favdls_enable_dlpage' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_dlpage' value='0' />")." (required to add to favorites)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Max Favorites Users Can Have:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_usermaxfav' value='" . $tp->toFORM($pref['favdls_usermaxfav']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Favorite User Count Download Detail Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_dlpagecount'] == 1 ? "<input type='checkbox' name='favdls_enable_dlpagecount' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_dlpagecount' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Favorite List Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='favdls_menu_title' value='" . $tp->toFORM($pref['favdls_menu_title']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_menu_height' value='" . $tp->toFORM($pref['favdls_menu_height']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_menuavatar'] == 1 ? "<input type='checkbox' name='favdls_enable_menuavatar' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_menuavatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_menu_avatarsize' value='" . $tp->toFORM($pref['favdls_menu_avatarsize']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Max User To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_menumax' value='" . $tp->toFORM($pref['favdls_menumax']) . "' /> (0 or blank for no limit)</td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>User's Favorite List Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='favdls_usermenu_title' value='" . $tp->toFORM($pref['favdls_usermenu_title']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_usermenu_height' value='" . $tp->toFORM($pref['favdls_usermenu_height']) . "' />px</td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>User's Favorite List Page Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_pageavatar'] == 1 ? "<input type='checkbox' name='favdls_enable_pageavatar' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_pageavatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_page_avatarsize' value='" . $tp->toFORM($pref['favdls_page_avatarsize']) . "' />px</td>
		</tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Forum Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Favorite Download Count in forum Posts:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_forumcount'] == 1 ? "<input type='checkbox' name='favdls_enable_forumcount' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_forumcount' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Profile Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Favorite Downloads List in profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_profilelist'] == 1 ? "<input type='checkbox' name='favdls_enable_profilelist' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_profilelist' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>List Section Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='favdls_profilelist_height' value='" . $tp->toFORM($pref['favdls_profilelist_height']) . "' />px</td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><b>Extra Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable Gold Orb Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['favdls_enable_gold'] == 1 ? "<input type='checkbox' name='favdls_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='favdls_enable_gold' value='0' />")." (must have gold orbs v1.2 or higher installed)</td>
	        </tr>


";




$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Update Settings' class='button' /></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

