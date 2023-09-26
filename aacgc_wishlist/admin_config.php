<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #    
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

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
 
    $pref['wishlist_title'] = $_POST['wishlist_title'];
    $pref['wishlist_intro'] = $_POST['wishlist_intro'];
    $pref['wishlist_header'] = $_POST['wishlist_header'];
    $pref['wishlist_introfsize'] = $_POST['wishlist_introfsize'];
    $pref['wishlist_headerfsize'] = $_POST['wishlist_headerfsize'];

    $pref['wishlist_menutitle'] = $_POST['wishlist_menutitle'];
    $pref['wishlist_menuheight'] = $_POST['wishlist_menuheight'];
    $pref['wishlist_menuspeed'] = $_POST['wishlist_menuspeed'];
    $pref['wishlist_menuoverspeed'] = $_POST['wishlist_menuoverspeed'];


    $pref['wishlist_avatarsize'] = $_POST['wishlist_avatarsize'];

if (isset($_POST['wishlist_enable_theme'])) 
{$pref['wishlist_enable_theme'] = 1;}
else
{$pref['wishlist_enable_theme'] = 0;}

if (isset($_POST['wishlist_enable_listtype'])) 
{$pref['wishlist_enable_listtype'] = 1;}
else
{$pref['wishlist_enable_listtype'] = 0;}

if (isset($_POST['wishlist_enable_listtypemenu'])) 
{$pref['wishlist_enable_listtypemenu'] = 1;}
else
{$pref['wishlist_enable_listtypemenu'] = 0;}

if (isset($_POST['wishlist_enable_avatar'])) 
{$pref['wishlist_enable_avatar'] = 1;}
else
{$pref['wishlist_enable_avatar'] = 0;}

if (isset($_POST['wishlist_enable_profile'])) 
{$pref['wishlist_enable_profile'] = 1;}
else
{$pref['wishlist_enable_profile'] = 0;}

if (isset($_POST['wishlist_enable_forums'])) 
{$pref['wishlist_enable_forums'] = 1;}
else
{$pref['wishlist_enable_forums'] = 0;}

if (isset($_POST['wishlist_enable_gold'])) 
{$pref['wishlist_enable_gold'] = 1;}
else
{$pref['wishlist_enable_gold'] = 0;}

if (isset($_POST['wishlist_enable_autoscroll'])) 
{$pref['wishlist_enable_autoscroll'] = 1;}
else
{$pref['wishlist_enable_autoscroll'] = 0;}

    save_prefs();
    $text .= "<center><b>".AWL_25."</b></center><br>";
}

$admin_title = "AACGC Wish List (settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>

		<tr>
			<td colspan='3' class='fcaption'><b>".AWL_01.":</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_02.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_theme'] == 1 ? "<input type='checkbox' name='wishlist_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_theme' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_03.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='wishlist_title' value='" . $tp->toFORM($pref['wishlist_title'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_04.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='wishlist_header' value='" . $tp->toFORM($pref['wishlist_header'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_05.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_headerfsize' value='" . $tp->toFORM($pref['wishlist_headerfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_06.":</td>
			<td colspan='2'  class='forumheader3'>
                        <textarea class='tbox' rows='5' cols='100' name='wishlist_intro'>" . $tp->toFORM($pref['wishlist_intro']) . "</textarea>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_07.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_introfsize' value='" . $tp->toFORM($pref['wishlist_introfsize'])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_08.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_listtype'] == 1 ? "<input type='checkbox' name='wishlist_enable_listtype' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_listtype' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_09.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_avatar'] == 1 ? "<input type='checkbox' name='wishlist_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_10.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_avatarsize' value='" . $tp->toFORM($pref['wishlist_avatarsize'])."' />px</td>
		</tr>









		<tr>
			<td colspan='3' class='fcaption'><b>".AWL_11.":</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_12.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='wishlist_menutitle' value='" . $tp->toFORM($pref['wishlist_menutitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_13.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_menuheight' value='" . $tp->toFORM($pref['wishlist_menuheight'])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_08.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_listtypemenu'] == 1 ? "<input type='checkbox' name='wishlist_enable_listtypemenu' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_listtypemenu' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_15.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_autoscroll'] == 1 ? "<input type='checkbox' name='wishlist_enable_autoscroll' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_autoscroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_16.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_menuspeed' value='" . $tp->toFORM($pref['wishlist_menuspeed'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AWL_17.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='wishlist_menuoverspeed' value='" . $tp->toFORM($pref['wishlist_menuoverspeed'])."' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>".AWL_18.":</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_19.":<br>(".AWL_14.")</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_forums'] == 1 ? "<input type='checkbox' name='wishlist_enable_forums' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_forums' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_20.":<br>(".AWL_24.")</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_profile'] == 1 ? "<input type='checkbox' name='wishlist_enable_profile' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_profile' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AWL_21.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['wishlist_enable_gold'] == 1 ? "<input type='checkbox' name='wishlist_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='wishlist_enable_gold' value='0' />")." (".AWL_23.")</td>
	        </tr>

                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".AWL_22."' class='button' /></td>
		</tr>


</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
