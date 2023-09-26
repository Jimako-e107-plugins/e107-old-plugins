<?php


/*
##########################
# AACGC Game List        #
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

    $pref['gamelist_adminiconpath'] = $_POST['gamelist_adminiconpath'];

    $pref['gamelist_listpageiconpath'] = $_POST['gamelist_listpageiconpath'];
    $pref['gamelist_catpageiconpath'] = $_POST['gamelist_catpageiconpath'];
    $pref['gamelist_listmenuiconpath'] = $_POST['gamelist_listmenuiconpath'];
    $pref['gamelist_catmenuiconpath'] = $_POST['gamelist_catmenuiconpath'];
    $pref['gamelist_detailpageiconpath'] = $_POST['gamelist_detailpageiconpath'];
    $pref['gamelist_userpageiconpath'] = $_POST['gamelist_userpageiconpath'];
    $pref['gamelist_usermenuiconpath'] = $_POST['gamelist_usermenuiconpath'];
    $pref['gamelist_forumiconpath'] = $_POST['gamelist_forumiconpath'];
    $pref['gamelist_profileiconpath'] = $_POST['gamelist_profileiconpath'];

    $pref['gameshowcase_scrollericonpath'] = $_POST['gameshowcase_scrollericonpath'];
    $pref['gameshowcase_newlisticonpath'] = $_POST['gameshowcase_newlisticonpath'];

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Game List (Icon Path Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>


	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'><font size='2'><b>Game Icon Path Settings:</b></font><br><i>Choose the folder that each section will look in for the game icon. Note you must have icons with the same name in all icon folders that you choose. The purpose for using seperate folders is to allow you to use large images for game detail pages and smaller thumbnail images for menus, list pages, and admin areas to icrease loading speeds. You must resize your images how you wish and upload them into the correct folders.<br><br>Example: most game icons are default of 256x256 at 100KB - 150KB, these would go in the icons folder. You can resize the same icons to 100x100 and they would be about 10KB - 30KB and put them in the icons_small folder and select below for menus and list page to load from the icons_small folder. This will greatly increas the loading speeds for those page when alot of games are listed. You can match the size of the icons in the Main Settings area.<br><br>You have 3 folders to choose from for 3 different icon sizes:<br>icons - Large Icons (256x256) (100KB-150KB)<br>icons_med - Medium Icons (150x150) (50KB-100KB)<br>icons_small - (100x100) (10KB-50KB)<br><br><b>You must resize and upload icons yourself to each folder. Auto resize and copy feature will hopefully be added in future update.</b></i></td>
		</tr>



                <tr>
			<td style='width:30%' class='forumheader3'>Admin Area Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_adminiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_adminiconpath_' value='".$pref['gamelist_adminiconpath']."'>".$pref['gamelist_adminiconpath']."</option>
                        <option name='gamelist_adminiconpath' value='icons'>icons</option>
                        <option name='gamelist_adminiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_adminiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game Category Page Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_catpageiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_catpageiconpath' value='".$pref['gamelist_catpageiconpath']."'>".$pref['gamelist_catpageiconpath']."</option>
                        <option name='gamelist_catpageiconpath' value='icons'>icons</option>
                        <option name='gamelist_catpageiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_catpageiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game List Page Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_listpageiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_listpageiconpath' value='".$pref['gamelist_listpageiconpath']."'>".$pref['gamelist_listpageiconpath']."</option>
                        <option name='gamelist_listpageiconpath' value='icons'>icons</option>
                        <option name='gamelist_listpageiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_listpageiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game Detail Page Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_detailpageiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_detailpageiconpath' value='".$pref['gamelist_detailpageiconpath']."'>".$pref['gamelist_detailpageiconpath']."</option>
                        <option name='gamelist_detailpageiconpath' value='icons'>icons</option>
                        <option name='gamelist_detailpageiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_detailpageiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>User Game List Page Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_userpageiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_userpageiconpath' value='".$pref['gamelist_userpageiconpath']."'>".$pref['gamelist_userpageiconpath']."</option>
                        <option name='gamelist_userpageiconpath' value='icons'>icons</option>
                        <option name='gamelist_userpageiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_userpageiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game List Menu Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_listmenuiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_listmenuiconpath' value='".$pref['gamelist_listmenuiconpath']."'>".$pref['gamelist_listmenuiconpath']."</option>
                        <option name='gamelist_listmenuiconpath' value='icons'>icons</option>
                        <option name='gamelist_listmenuiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_listmenuiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game Category Menu Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_catmenuiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_catmenuiconpath' value='".$pref['gamelist_catmenuiconpath']."'>".$pref['gamelist_catmenuiconpath']."</option>
                        <option name='gamelist_catmenuiconpath' value='icons'>icons</option>
                        <option name='gamelist_catmenuiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_catmenuiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>User List Menu Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_usermenuiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_usermenuiconpath' value='".$pref['gamelist_usermenuiconpath']."'>".$pref['gamelist_usermenuiconpath']."</option>
                        <option name='gamelist_usermenuiconpath' value='icons'>icons</option>
                        <option name='gamelist_usermenuiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_usermenuiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game Showcase Recent Games Section Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gameshowcase_newlisticonpath' size='1' class='tbox' style='width:200px'>
                        <option name='gameshowcase_newlisticonpath' value='".$pref['gameshowcase_newlisticonpath']."'>".$pref['gameshowcase_newlisticonpath']."</option>
                        <option name='gameshowcase_newlisticonpath' value='icons'>icons</option>
                        <option name='gameshowcase_newlisticonpath' value='icons_med'>icons_med</option>
                        <option name='gameshowcase_newlisticonpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Game Showcase Scrolling Section Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gameshowcase_scrollericonpath' size='1' class='tbox' style='width:200px'>
                        <option name='gameshowcase_scrollericonpath' value='".$pref['gameshowcase_scrollericonpath']."'>".$pref['gameshowcase_scrollericonpath']."</option>
                        <option name='gameshowcase_scrollericonpath' value='icons'>icons</option>
                        <option name='gameshowcase_scrollericonpath' value='icons_med'>icons_med</option>
                        <option name='gameshowcase_scrollericonpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Forum Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_forumiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_forumiconpath' value='".$pref['gamelist_forumiconpath']."'>".$pref['gamelist_forumiconpath']."</option>
                        <option name='gamelist_forumiconpath' value='icons'>icons</option>
                        <option name='gamelist_forumiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_forumiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Profile Icon Path:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_profileiconpath' size='1' class='tbox' style='width:200px'>
                        <option name='gamelist_profileiconpath' value='".$pref['gamelist_profileiconpath']."'>".$pref['gamelist_profileiconpath']."</option>
                        <option name='gamelist_profileiconpath' value='icons'>icons</option>
                        <option name='gamelist_profileiconpath' value='icons_med'>icons_med</option>
                        <option name='gamelist_profileiconpath' value='icons_small'>icons_small</option>
                        </td>
		</tr>



	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
