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
    $pref['gamelist_pagetitle'] = $_POST['gamelist_pagetitle'];
    $pref['gamelist_detailstitle'] = $_POST['gamelist_detailstitle'];
    $pref['gamelist_detailstitlefs'] = $_POST['gamelist_detailstitlefs'];
    $pref['gamelist_details'] = $_POST['gamelist_details'];
    $pref['gamelist_detailsfs'] = $_POST['gamelist_detailsfs'];
    $pref['gamelist_catftsize'] = $_POST['gamelist_catftsize'];
    $pref['gamelist_catdetftsize'] = $_POST['gamelist_catdetftsize'];
    $pref['gamelist_iconsize'] = $_POST['gamelist_iconsize'];
    $pref['gamelist_namefs'] = $_POST['gamelist_namefs'];
    $pref['gamelist_detfs'] = $_POST['gamelist_detfs'];
    $pref['gamelist_alttheme_rows'] = $_POST['gamelist_alttheme_rows'];
    $pref['gamelist_cat_minisize'] = $_POST['gamelist_cat_minisize'];
    $pref['gamelist_gamesperpage'] = $_POST['gamelist_gamesperpage'];


    $pref['gamelistdet_namefs'] = $_POST['gamelistdet_namefs'];
    $pref['gamelistdet_detfs'] = $_POST['gamelistdet_detfs'];
    $pref['gamelist_avatar_size'] = $_POST['gamelist_avatar_size'];

    $pref['gamecatlist_menutitle'] = $_POST['gamecatlist_menutitle'];
    $pref['gamecatlistmenu_catftsize'] = $_POST['gamecatlistmenu_catftsize'];
    $pref['gamecatlist_menu_order'] = $_POST['gamecatlist_menu_order'];
    $pref['gamecatlist_menu_ordertype'] = $_POST['gamecatlist_menu_ordertype'];
    $pref['gamelist_cat_order'] = $_POST['gamelist_cat_order'];
    $pref['gamelist_cat_ordertype'] = $_POST['gamelist_cat_ordertype'];
    $pref['gamecatlistmenu_cat_minisize'] = $_POST['gamecatlistmenu_cat_minisize'];


    $pref['gamelist_menutitle'] = $_POST['gamelist_menutitle'];
    $pref['gamelist_menuheight'] = $_POST['gamelist_menuheight'];
    $pref['gamelistmenu_speed'] = $_POST['gamelistmenu_speed'];
    $pref['gamelistmenu_mouseoverspeed'] = $_POST['gamelistmenu_mouseoverspeed'];
    $pref['gamelistmenu_mouseoutspeed'] = $_POST['gamelistmenu_mouseoutspeed'];
    $pref['gamelistmenu_img'] = $_POST['gamelistmenu_img'];
    $pref['gamelist_menu_direction'] = $_POST['gamelist_menu_direction'];
    $pref['gamelist_menu_order'] = $_POST['gamelist_menu_order'];
    $pref['gamelist_menu_limit'] = $_POST['gamelist_menu_limit'];
    $pref['gamelist_menu_catexclude'] = $_POST['gamelist_menu_catexclude'];

    $pref['gameuser_menutitle'] = $_POST['gameuser_menutitle'];
    $pref['gameuser_menuheight'] = $_POST['gameuser_menuheight'];
    $pref['gameusermenu_speed'] = $_POST['gameusermenu_speed'];
    $pref['gameusermenu_mouseoverspeed'] = $_POST['gameusermenu_mouseoverspeed'];
    $pref['gameusermenu_mouseoutspeed'] = $_POST['gameusermenu_mouseoutspeed'];
    $pref['gameusermenu_img'] = $_POST['gameusermenu_img'];


    $pref['gamelist_forum_img'] = $_POST['gamelist_forum_img'];
    $pref['numgames'] = $_POST['numgames'];

    $pref['gamelist_profile_img'] = $_POST['gamelist_profile_img'];
    $pref['numgamesprofile'] = $_POST['numgamesprofile'];

    $pref['gamelist_comheight'] = $_POST['gamelist_comheight'];
    $pref['gamelist_comwidth'] = $_POST['gamelist_comwidth'];


if (isset($_POST['alt_gamelist_theme'])) 
{$pref['alt_gamelist_theme'] = 1;}
else
{$pref['alt_gamelist_theme'] = 0;}

if (isset($_POST['gamelist_show_mini'])) 
{$pref['gamelist_show_mini'] = 1;}
else
{$pref['gamelist_show_mini'] = 0;}

if (isset($_POST['gamelist_show_incat'])) 
{$pref['gamelist_show_incat'] = 1;}
else
{$pref['gamelist_show_incat'] = 0;}

if (isset($_POST['gamecatlistmenu_show_mini'])) 
{$pref['gamecatlistmenu_show_mini'] = 1;}
else
{$pref['gamecatlistmenu_show_mini'] = 0;}

if (isset($_POST['gamelistmenu_enable_scroll'])) 
{$pref['gamelistmenu_enable_scroll'] = 1;}
else
{$pref['gamelistmenu_enable_scroll'] = 0;}

if (isset($_POST['gameuserlistmenu_enable_scroll'])) 
{$pref['gameuserlistmenu_enable_scroll'] = 1;}
else
{$pref['gameuserlistmenu_enable_scroll'] = 0;}

if (isset($_POST['gamelist_show_popup'])) 
{$pref['gamelist_show_popup'] = 1;}
else
{$pref['gamelist_show_popup'] = 0;}

if (isset($_POST['gamelist_show_usermini'])) 
{$pref['gamelist_show_usermini'] = 1;}
else
{$pref['gamelist_show_usermini'] = 0;}

if (isset($_POST['gamelist_enable_userjoin'])) 
{$pref['gamelist_enable_userjoin'] = 1;}
else
{$pref['gamelist_enable_userjoin'] = 0;}

if (isset($_POST['gamelist_enable_gold'])) 
{$pref['gamelist_enable_gold'] = 1;}
else
{$pref['gamelist_enable_gold'] = 0;}

if (isset($_POST['gamelist_enable_forum'])) 
{$pref['gamelist_enable_forum'] = 1;}
else
{$pref['gamelist_enable_forum'] = 0;}

if (isset($_POST['gamelist_enable_profile'])) 
{$pref['gamelist_enable_profile'] = 1;}
else
{$pref['gamelist_enable_profile'] = 0;}

if (isset($_POST['gamelist_enable_avatar'])) 
{$pref['gamelist_enable_avatar'] = 1;}
else
{$pref['gamelist_enable_avatar'] = 0;}

if (isset($_POST['gamelist_enable_theme'])) 
{$pref['gamelist_enable_theme'] = 1;}
else
{$pref['gamelist_enable_theme'] = 0;}

if (isset($_POST['gamelist_enable_friends'])) 
{$pref['gamelist_enable_friends'] = 1;}
else
{$pref['gamelist_enable_friends'] = 0;}

if (isset($_POST['gamelist_enable_comments'])) 
{$pref['gamelist_enable_comments'] = 1;}
else
{$pref['gamelist_enable_comments'] = 0;}

if (isset($_POST['gamelist_enable_rating'])) 
{$pref['gamelist_enable_rating'] = 1;}
else
{$pref['gamelist_enable_rating'] = 0;}

if (isset($_POST['gamelist_enable_catmenutotals'])) 
{$pref['gamelist_enable_catmenutotals'] = 1;}
else
{$pref['gamelist_enable_catmenutotals'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Game List (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Main Settings:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Use Fcaption and Indent Tables (Effects all pages and menus):</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_theme'] == 1 ? "<input type='checkbox' name='gamelist_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_theme' value='0' />")." (Recommended - Only Works On Some Themes)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Category / Game List Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_pagetitle' value='" . $tp->toFORM($pref['gamelist_pagetitle' ]) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game List Header:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_detailstitle' value='" . $tp->toFORM($pref['gamelist_detailstitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Header Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_detailstitlefs' value='" . $tp->toFORM($pref['gamelist_detailstitlefs']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game List Intro:</td>
			<td colspan='2'  class='forumheader3'>
                        <textarea class='tbox' rows='5' cols='100' name='gamelist_details'>" . $tp->toFORM($pref['gamelist_details']) . "</textarea>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game List Intro Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_detailsfs' value='" . $tp->toFORM($pref['gamelist_detailsfs']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number of Games Per Page:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_gamesperpage' value='" . $tp->toFORM($pref['gamelist_gamesperpage']) . "' /></td>
		</tr>

                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game Category Page Settings:</b></font></td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Order Categories By:</td>
                        <td style='width:' class=''>
                        <select name='gamelist_cat_ordertype' size='1' class='tbox' style='width:'>
                        <option name='gamelist_cat_ordertype' value='".$pref['gamelist_cat_ordertype']."'>".$pref['gamelist_cat_ordertype']."</option>
                        <option name='gamelist_cat_ordertype' value='Name'>Name</option>
                        <option name='gamelist_cat_ordertype' value='ID'>ID</option>
                        </td>
                        <td style='width:60%' class=''>
                        <select name='gamelist_cat_order' size='1' class='tbox' style='width:'>
                        <option name='gamelist_cat_order' value='".$pref['gamelist_cat_order']."'>".$pref['gamelist_cat_order']."</option>
                        <option name='gamelist_cat_order' value='ASC'>ASC</option>
                        <option name='gamelist_cat_order' value='DESC'>DESC</option>
                        <option name='gamelist_cat_order' value='Random'>Random</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_catftsize' value='" . $tp->toFORM($pref['gamelist_catftsize']) . "' />px  (pixles)</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Mini Icons Under Category Title (Only on Category List Page):</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_show_mini'] == 1 ? "<input type='checkbox' name='gamelist_show_mini' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_show_mini' value='0' />")." (Recommended)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mini Icons Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_cat_minisize' value='" . $tp->toFORM($pref['gamelist_cat_minisize']) . "' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Pop-up Image Under Category Title When User Clicks Game Icons:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_show_popup'] == 1 ? "<input type='checkbox' name='gamelist_show_popup' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_show_popup' value='0' />")."</td>
	        </tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game List Page Settings:</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Category Detail Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_catdetftsize' value='" . $tp->toFORM($pref['gamelist_catdetftsize']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Use Alternate Theme For Game List:</td>
		        <td colspan=2 class='forumheader3'>".($pref['alt_gamelist_theme'] == 1 ? "<input type='checkbox' name='alt_gamelist_theme' value='1' checked='checked' />" : "<input type='checkbox' name='alt_gamelist_theme' value='0' />")." (Recommended If Listing Many Games)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Games Per Row On Game List Page (Only If Alternate Theme Enabled):</td>
			<td style='width:' class=''>
                        <select name='gamelist_alttheme_rows' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_alttheme_rows' value='".$pref['gamelist_alttheme_rows']."'>".$pref['gamelist_alttheme_rows']."</option>
                        <option name='gamelist_alttheme_rows' value='2'>2</option>
                        <option name='gamelist_alttheme_rows' value='3'>3</option>
                        <option name='gamelist_alttheme_rows' value='4'>4</option>
                        <option name='gamelist_alttheme_rows' value='5'>5</option>
                        </td>

		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_iconsize' value='" . $tp->toFORM($pref['gamelist_iconsize']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Name Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_namefs' value='" . $tp->toFORM($pref['gamelist_namefs']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Detail Font Size: (Only if Alternate Theme Disabled)</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_detfs' value='" . $tp->toFORM($pref['gamelist_detfs']) . "' />px  (pixles)</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game Detail Page Settings:</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Name Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistdet_namefs' value='" . $tp->toFORM($pref['gamelistdet_namefs']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Detail Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistdet_detfs' value='" . $tp->toFORM($pref['gamelistdet_detfs']) . "' />px  (pixles)</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game Category List Menu Settings:</b></font></td>
		</tr>
<tr>
</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Category List Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamecatlist_menutitle' value='" . $tp->toFORM($pref['gamecatlist_menutitle']) . "' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Count Tabs:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_catmenutotals'] == 1 ? "<input type='checkbox' name='gamelist_enable_catmenutotals' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_catmenutotals' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamecatlistmenu_catftsize' value='" . $tp->toFORM($pref['gamecatlistmenu_catftsize']) . "' />px  (pixles)</td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Order Categories By:</td>
                        <td style='width:' class=''>
                        <select name='gamecatlist_menu_ordertype' size='1' class='tbox' style='width:'>
                        <option name='gamecatlist_menu_ordertype' value='".$pref['gamecatlist_menu_ordertype']."'>".$pref['gamecatlist_menu_ordertype']."</option>
                        <option name='gamecatlist_menu_ordertype' value='Name'>Name</option>
                        <option name='gamecatlist_menu_ordertype' value='ID'>ID</option>
                        </td>
                        <td style='width:60%' class=''>
                        <select name='gamecatlist_menu_order' size='1' class='tbox' style='width:'>
                        <option name='gamecatlist_menu_order' value='".$pref['gamecatlist_menu_order']."'>".$pref['gamecatlist_menu_order']."</option>
                        <option name='gamecatlist_menu_order' value='ASC'>ASC</option>
                        <option name='gamecatlist_menu_order' value='DESC'>DESC</option>
                        <option name='gamecatlist_menu_order' value='Random'>Random</option>
                        </td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Mini Icons Under Category Title (Only on Category List Menu):</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamecatlistmenu_show_mini'] == 1 ? "<input type='checkbox' name='gamecatlistmenu_show_mini' value='1' checked='checked' />" : "<input type='checkbox' name='gamecatlistmenu_show_mini' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mini Icons Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamecatlistmenu_cat_minisize' value='" . $tp->toFORM($pref['gamecatlistmenu_cat_minisize']) . "' />px</td>
		</tr>
                </table>





<br><br><br>";



$sql = new db;
$sql->db_Select("aacgc_gamelist_cat", "*", "ORDER BY cat_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='gamelist_menu_catexclude' value='".$option['cat_id']."'>".$option['cat_name']."</option>";}


$sql2 = new db;
$sql2->db_Select("aacgc_gamelist_cat", "*", "WHERE cat_id='".$pref['gamelist_menu_catexclude']."'", "");
$row2 = $sql2->db_Fetch();




$text .= "      <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game List Menu Settings:</b></font></td>
		</tr>
<tr>
</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game List Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_menutitle' value='" . $tp->toFORM($pref['gamelist_menutitle']) . "' /></td>
		</tr>
                <tr>
                        <td style='width:25%' class='forumheader3'>Game Category To Exclude From Game List Menu:</td>
                        <td style='width:' class='forumheader3'>
		        <select name='gamelist_menu_catexclude' size='1' class='tbox' style='width:50%'>
                        <option name='gamelist_menu_catexclude' value='".$pref['gamelist_menu_catexclude']."'>".$row2['cat_name']."</option>
		        ".$options."
                        </td>
                </tr>

                <tr>
			<td style='width:30%' class='forumheader3'>Order Games By Name:</td>
                        <td style='width:' class=''>
                        <select name='gamelist_menu_order' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_menu_order' value='".$pref['gamelist_menu_order']."'>".$pref['gamelist_menu_order']."</option>
                        <option name='gamelist_menu_order' value='ASC'>ASC</option>
                        <option name='gamelist_menu_order' value='DESC'>DESC</option>
                        <option name='gamelist_menu_order' value='Random'>Random</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistmenu_img' value='" . $tp->toFORM($pref['gamelistmenu_img']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Games To Show (0 for unlimited):</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='gamelist_menu_limit' value='" . $tp->toFORM($pref['gamelist_menu_limit']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game List Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_menuheight' value='" . $tp->toFORM($pref['gamelist_menuheight']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Auto Scroll:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelistmenu_enable_scroll'] == 1 ? "<input type='checkbox' name='gamelistmenu_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='gamelistmenu_enable_scroll' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Scrolling Direction: (Effects both Game List and User List Menus)</td>
                        <td style='width:' class=''>
                        <select name='gamelist_menu_direction' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_menu_direction' value='".$pref['gamelist_menu_direction']."'>".$pref['gamelist_menu_direction']."</option>
                        <option name='gamelist_menu_direction' value='up'>up</option>
                        <option name='gamelist_menu_direction' value='down'>down</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistmenu_speed' value='" . $tp->toFORM($pref['gamelistmenu_speed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseover:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistmenu_mouseoverspeed' value='" . $tp->toFORM($pref['gamelistmenu_mouseoverspeed']) . "' />  (1 for slow, 10 for fast, 0 for it to stop)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseout:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelistmenu_mouseoutspeed' value='" . $tp->toFORM($pref['gamelistmenu_mouseoutspeed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>User Game List Menu Settings:</b></font></td>
		</tr>
<tr>
</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>User List Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gameuser_menutitle' value='" . $tp->toFORM($pref['gameuser_menutitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>User List Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gameuser_menuheight' value='" . $tp->toFORM($pref['gameuser_menuheight']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Mini Icons Under User:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_show_usermini'] == 1 ? "<input type='checkbox' name='gamelist_show_usermini' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_show_usermini' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gameusermenu_img' value='" . $tp->toFORM($pref['gameusermenu_img']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Auto Scroll:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gameuserlistmenu_enable_scroll'] == 1 ? "<input type='checkbox' name='gameuserlistmenu_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='gameuserlistmenu_enable_scroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gameusermenu_speed' value='" . $tp->toFORM($pref['gameusermenu_speed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseover:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gameusermenu_mouseoverspeed' value='" . $tp->toFORM($pref['gameusermenu_mouseoverspeed']) . "' />  (1 for slow, 10 for fast, 0 for it to stop)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseout:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gameusermenu_mouseoutspeed' value='" . $tp->toFORM($pref['gameusermenu_mouseoutspeed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>User Settings:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable User Join Feature:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_userjoin'] == 1 ? "<input type='checkbox' name='gamelist_enable_userjoin' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_userjoin' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User's Avatar:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_avatar'] == 1 ? "<input type='checkbox' name='gamelist_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>User Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_avatar_size' value='" . $tp->toFORM($pref['gamelist_avatar_size'])."' />px  (If enabled above)</td>
		</tr>";

/*
$text .= "
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Add to Friends Button Beside Users:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_friends'] == 1 ? "<input type='checkbox' name='gamelist_enable_friends' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_friends' value='0' />")." (<a href='http://www.aacgc.com/SSGC/e107_plugins/e_version/e_version.php?0.view.22' target='_blank'>AACGC Alt-Profile</a> plugin required and friends option enabled)</td>
	        </tr>
";
*/

$text .= "      </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
       	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Forums Settings: (Only Works if Default Forum Theme is Used)</b></font></td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Random Game Icons That User Has In Forums:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_forum'] == 1 ? "<input type='checkbox' name='gamelist_enable_forum' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_forum' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Number of Random Game Icons To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='numgames' value='".$tp->toFORM($pref['numgames'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Forum Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_forum_img' value='".$tp->toFORM($pref['gamelist_forum_img'])."' />px</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
       	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Profile Settings: (Only Works if Default Profile is Used)</b></font></td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Users Game Choices In Profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_profile'] == 1 ? "<input type='checkbox' name='gamelist_enable_profile' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_profile' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Number of Game Icons To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='numgamesprofile' value='".$tp->toFORM($pref['numgamesprofile'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_profile_img' value='".$tp->toFORM($pref['gamelist_profile_img'])."' />px</td>
		</tr>
                </table>





<br><br><br>




	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Comment & Rating Settings:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Allow Game Rating:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_rating'] == 1 ? "<input type='checkbox' name='gamelist_enable_rating' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_rating' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Allow Game Comments:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_comments'] == 1 ? "<input type='checkbox' name='gamelist_enable_comments' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_comments' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Comment Box Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_comheight' value='".$tp->toFORM($pref['gamelist_comheight'])."' /> (rows not pixels - best default is 5)</td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Comment Box Width:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_comwidth' value='".$tp->toFORM($pref['gamelist_comwidth'])."' /> (rows not pixels - best default is 100)</td>
		</tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Gold System Support:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold Orbs:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_gold'] == 1 ? "<input type='checkbox' name='gamelist_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_gold' value='0' />")."(shows orbs, must have gold sytem 4.x and gold orbs 1.x installed)</td>
	        </tr>
                </table>





<br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
