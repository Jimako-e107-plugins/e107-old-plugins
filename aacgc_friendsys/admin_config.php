<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
 

   $pref['fl_menu_title'] = $_POST['fl_menu_title'];
   $pref['fl_menu_height'] = $_POST['fl_menu_height'];
   $pref['fl_profile_avatarsize'] = $_POST['fl_profile_avatarsize'];
   $pref['fl_menu_avatarsize'] = $_POST['fl_menu_avatarsize'];
   $pref['fl_usersperrow'] = $_POST['fl_usersperrow'];
   $pref['fl_profilelist_height'] = $_POST['fl_profilelist_height'];


if (isset($_POST['fl_enable_forum'])) 
{$pref['fl_enable_forum'] = 1;}
else
{$pref['fl_enable_forum'] = 0;}

if (isset($_POST['fl_enable_forumcount'])) 
{$pref['fl_enable_forumcount'] = 1;}
else
{$pref['fl_enable_forumcount'] = 0;}



if (isset($_POST['fl_enable_profile'])) 
{$pref['fl_enable_profile'] = 1;}
else
{$pref['fl_enable_profile'] = 0;}

if (isset($_POST['fl_enable_profilelist'])) 
{$pref['fl_enable_profilelist'] = 1;}
else
{$pref['fl_enable_profilelist'] = 0;}

if (isset($_POST['fl_enable_profileavatar'])) 
{$pref['fl_enable_profileavatar'] = 1;}
else
{$pref['fl_enable_profileavatar'] = 0;}

if (isset($_POST['fl_enable_profileonline'])) 
{$pref['fl_enable_profileonline'] = 1;}
else
{$pref['fl_enable_profileonline'] = 0;}

if (isset($_POST['fl_enable_profilepm'])) 
{$pref['fl_enable_profilepm'] = 1;}
else
{$pref['fl_enable_profilepm'] = 0;}



if (isset($_POST['fl_enable_menuavatar'])) 
{$pref['fl_enable_menuavatar'] = 1;}
else
{$pref['fl_enable_menuavatar'] = 0;}


if (isset($_POST['fl_enable_menuonline'])) 
{$pref['fl_enable_menuonline'] = 1;}
else
{$pref['fl_enable_menuonline'] = 0;}

if (isset($_POST['fl_enable_menupm'])) 
{$pref['fl_enable_menupm'] = 1;}
else
{$pref['fl_enable_menupm'] = 0;}



if (isset($_POST['fl_enable_gold'])) 
{$pref['fl_enable_gold'] = 1;}
else
{$pref['fl_enable_gold'] = 0;}

if (isset($_POST['fl_enable_theme'])) 
{$pref['fl_enable_theme'] = 1;}
else
{$pref['fl_enable_theme'] = 0;}

if (isset($_POST['fl_enable_memlist'])) 
{$pref['fl_enable_memlist'] = 1;}
else
{$pref['fl_enable_memlist'] = 0;}



    save_prefs();
    $led_msgtext = "".AFSYS_01."";
}

$admin_title = "AACGC Friend System (Settings)";
//--------------------------------------------------------------------




$text .= "
<form method='post' action='" . e_SELF . "?update' id='frsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>".AFSYS_02.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_03."</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_theme'] == 1 ? "<input type='checkbox' name='fl_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_theme' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_04.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_memlist'] == 1 ? "<input type='checkbox' name='fl_enable_memlist' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_memlist' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>".AFSYS_05.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_06.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='fl_menu_title' value='" . $tp->toFORM($pref['fl_menu_title']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_07.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='fl_menu_height' value='" . $tp->toFORM($pref['fl_menu_height']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_08.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_menuavatar'] == 1 ? "<input type='checkbox' name='fl_enable_menuavatar' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_menuavatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_09.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='fl_menu_avatarsize' value='" . $tp->toFORM($pref['fl_menu_avatarsize']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_10.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_menuonline'] == 1 ? "<input type='checkbox' name='fl_enable_menuonline' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_menuonline' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_11.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_menupm'] == 1 ? "<input type='checkbox' name='fl_enable_menupm' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_menupm' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>".AFSYS_12.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_13.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_forum'] == 1 ? "<input type='checkbox' name='fl_enable_forum' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_forum' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_14.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_forumcount'] == 1 ? "<input type='checkbox' name='fl_enable_forumcount' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_forumcount' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>".AFSYS_15.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_16.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_profile'] == 1 ? "<input type='checkbox' name='fl_enable_profile' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_profile' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_17.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_profilelist'] == 1 ? "<input type='checkbox' name='fl_enable_profilelist' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_profilelist' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_18.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='fl_profilelist_height' value='" . $tp->toFORM($pref['fl_profilelist_height']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_19.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='fl_usersperrow' value='" . $tp->toFORM($pref['fl_usersperrow']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_20.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_profileavatar'] == 1 ? "<input type='checkbox' name='fl_enable_profileavatar' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_profileavatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_21.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='fl_profile_avatarsize' value='" . $tp->toFORM($pref['fl_profile_avatarsize']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_22.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_profileonline'] == 1 ? "<input type='checkbox' name='fl_enable_profileonline' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_profileonline' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_23.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_profilepm'] == 1 ? "<input type='checkbox' name='fl_enable_profilepm' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_profilepm' value='0' />")."</td>
	        </tr>





		<tr>
			<td colspan='3' class='fcaption'><b>".AFSYS_24.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AFSYS_25.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['fl_enable_gold'] == 1 ? "<input type='checkbox' name='fl_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='fl_enable_gold' value='0' />")." ".AFSYS_26."</td>
	        </tr>


";




$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".AFSYS_27."' class='button' /></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

