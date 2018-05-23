<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC Arcade Addins V1.0        #
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

if (e_QUERY == "update")
{
 
   $pref['arcadeaddin_popgamecount'] = $_POST['arcadeaddin_popgamecount'];
   $pref['arcadeaddin_randgamecount'] = $_POST['arcadeaddin_randgamecount'];
   $pref['arcadeaddon_unplayedcount'] = $_POST['arcadeaddon_unplayedcount'];
   $pref['arcadeaddin_latestgamecount'] = $_POST['arcadeaddin_latestgamecount'];
   $pref['arcadeaddin_topuserwcount'] = $_POST['arcadeaddin_topuserwcount'];
   $pref['arcadeaddin_topusertcount'] = $_POST['arcadeaddin_topusertcount'];
   $pref['arcadeaddin_topuserccount'] = $_POST['arcadeaddin_topuserccount'];
   $pref['arcadeaddon_scoresmenutitle'] = $_POST['arcadeaddon_scoresmenutitle'];
   $pref['arcadeaddonscore_onscroll'] = $_POST['arcadeaddonscore_onscroll'];
   $pref['arcadeaddonscore_offscroll'] = $_POST['arcadeaddonscore_offscroll'];
   $pref['arcadeaddon_scoresmenucount'] = $_POST['arcadeaddon_scoresmenucount'];
   $pref['arcadeaddonhof_sscroll'] = $_POST['arcadeaddonhof_sscroll'];
   $pref['arcadeaddonhof_onscroll'] = $_POST['arcadeaddonhof_onscroll'];
   $pref['arcadeaddonhof_offscroll'] = $_POST['arcadeaddonhof_offscroll'];
   $pref['arcadeaddonhof_height'] = $_POST['arcadeaddonhof_height'];
   $pref['arcadeaddonhof_title'] = $_POST['arcadeaddonhof_title'];
   $pref['altarcade_menutitle'] = $_POST['altarcade_menutitle'];
   $pref['altarcade_logotype'] = $_POST['altarcade_logotype'];
   $pref['altarcade_logopath'] = $_POST['altarcade_logopath'];
   $pref['altarcade_logosize'] = $_POST['altarcade_logosize'];
   $pref['altarcade_logosizeh'] = $_POST['altarcade_logosizeh'];
   $pref['altarcade_menutitle'] = $_POST['altarcade_menutitle'];
   $pref['altarcade_catcolms'] = $_POST['altarcade_catcolms'];
   $pref['altarcade_menutitle'] = $_POST['altarcade_menutitle'];
   $pref['altarcade_catfsize'] = $_POST['altarcade_catfsize'];
   $pref['arcadeaddin_avatar_size'] = $_POST['arcadeaddin_avatar_size'];

if (isset($_POST['arcadeaddin_enable_gold'])) 
{$pref['arcadeaddin_enable_gold'] = 1;}
else
{$pref['arcadeaddin_enable_gold'] = 0;}

if (isset($_POST['arcadeaddin_enable_avatar'])) 
{$pref['arcadeaddin_enable_avatar'] = 1;}
else
{$pref['arcadeaddin_enable_avatar'] = 0;}

if (isset($_POST['arcadeaddin_enable_xplayed'])) 
{$pref['arcadeaddin_enable_xplayed'] = 1;}
else
{$pref['arcadeaddin_enable_xplayed'] = 0;}

if (isset($_POST['altarcade_enable_logo'])) 
{$pref['altarcade_enable_logo'] = 1;}
else
{$pref['altarcade_enable_logo'] = 0;}

if (isset($_POST['altarcade_enable_topthree'])) 
{$pref['altarcade_enable_topthree'] = 1;}
else
{$pref['altarcade_enable_topthree'] = 0;}

if (isset($_POST['altarcade_enable_topthreeavatar'])) 
{$pref['altarcade_enable_topthreeavatar'] = 1;}
else
{$pref['altarcade_enable_topthreeavatar'] = 0;}

if (isset($_POST['altarcade_enable_links'])) 
{$pref['altarcade_enable_links'] = 1;}
else
{$pref['altarcade_enable_links'] = 0;}

if (isset($_POST['altarcade_enable_cats'])) 
{$pref['altarcade_enable_cats'] = 1;}
else
{$pref['altarcade_enable_cats'] = 0;}

if (isset($_POST['altarcade_enable_catcount'])) 
{$pref['altarcade_enable_catcount'] = 1;}
else
{$pref['altarcade_enable_catcount'] = 0;}

if (isset($_POST['altarcade_enable_tourscurrent'])) 
{$pref['altarcade_enable_tourscurrent'] = 1;}
else
{$pref['altarcade_enable_tourscurrent'] = 0;}

if (isset($_POST['altarcade_enable_toursupcoming'])) 
{$pref['altarcade_enable_toursupcoming'] = 1;}
else
{$pref['altarcade_enable_toursupcoming'] = 0;}

if (isset($_POST['altarcade_enable_totalcount'])) 
{$pref['altarcade_enable_totalcount'] = 1;}
else
{$pref['altarcade_enable_totalcount'] = 0;}

if (isset($_POST['altarcade_enable_playlist'])) 
{$pref['altarcade_enable_playlist'] = 1;}
else
{$pref['altarcade_enable_playlist'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Arcade Addins (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='arcadeaddins'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><b>User Menu Options:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['arcadeaddin_enable_avatar'] == 1 ? "<input type='checkbox' name='arcadeaddin_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='arcadeaddin_enable_avatar' value='0' />")."(All Menus)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_avatar_size' value='" . $tp->toFORM($pref['arcadeaddin_avatar_size']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Top Arcade Winners To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_topuserwcount' value='" . $tp->toFORM($pref['arcadeaddin_topuserwcount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Top Tournament Winners To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_topusertcount' value='" . $tp->toFORM($pref['arcadeaddin_topusertcount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Top Challenge Winners To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_topuserccount' value='" . $tp->toFORM($pref['arcadeaddin_topuserccount']) . "' /></td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Game Menu Options:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Popular Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_popgamecount' value='" . $tp->toFORM($pref['arcadeaddin_popgamecount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Random Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_randgamecount' value='" . $tp->toFORM($pref['arcadeaddin_randgamecount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Unplayed Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddon_unplayedcount' value='" . $tp->toFORM($pref['arcadeaddon_unplayedcount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Newest Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddin_latestgamecount' value='" . $tp->toFORM($pref['arcadeaddin_latestgamecount']) . "' /></td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Times Played:</td>
		        <td colspan=2 class='forumheader3'>".($pref['arcadeaddin_enable_xplayed'] == 1 ? "<input type='checkbox' name='arcadeaddin_enable_xplayed' value='1' checked='checked' />" : "<input type='checkbox' name='arcadeaddin_enable_xplayed' value='0' />")."(Both Menus)</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Scrolling Scores Menu Options:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scrolling Scores Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='arcadeaddon_scoresmenutitle' value='" . $tp->toFORM($pref['arcadeaddon_scoresmenutitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scores To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddon_scoresmenucount' value='" . $tp->toFORM($pref['arcadeaddon_scoresmenucount']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mouse-over Scroll Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonscore_onscroll' value='" . $tp->toFORM($pref['arcadeaddonscore_onscroll']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mouse-out Scroll Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonscore_offscroll' value='" . $tp->toFORM($pref['arcadeaddonscore_offscroll']) . "' /></td>
		</tr>


		<tr>
			<td colspan='3' class='fcaption'><b>Scrolling HOF Menu Options:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scrolling HOF Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='arcadeaddonhof_title' value='" . $tp->toFORM($pref['arcadeaddonhof_title']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOF Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonhof_height' value='" . $tp->toFORM($pref['arcadeaddonhof_height']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Start Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonhof_sscroll' value='" . $tp->toFORM($pref['arcadeaddonhof_sscroll']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mouse-over Scroll Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonhof_onscroll' value='" . $tp->toFORM($pref['arcadeaddonhof_onscroll']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Mouse-out Scroll Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='arcadeaddonhof_offscroll' value='" . $tp->toFORM($pref['arcadeaddonhof_offscroll']) . "' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Alternate Arcade Menu & Category Options:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Main Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='altarcade_menutitle' value='" . $tp->toFORM($pref['altarcade_menutitle']) . "' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Custom Logo:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_logo'] == 1 ? "<input type='checkbox' name='altarcade_enable_logo' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_logo' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Custom Logo Type:</td>
			<td style='width:' class='' colspan='2'>
                        <select name='altarcade_logotype' size='1' class='tbox' style='width:15%'>
                        <option name='altarcade_logotype' value='".$pref['altarcade_logotype']."'>".$pref['altarcade_logotype']."</option>
                        <option name='altarcade_logotype' value='image'>image</option>
                        <option name='altarcade_logotype' value='flash'>flash</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Custom Logo Image/Flash Path:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='altarcade_logopath' value='" . $tp->toFORM($pref['altarcade_logopath']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Custom Logo Image/Flash Size:</td>
			<td colspan='2'  class='forumheader3'>
                        Width:<input class='tbox' type='text' size='10' name='altarcade_logosize' value='" . $tp->toFORM($pref['altarcade_logosize']) . "' />px
                        Height:<input class='tbox' type='text' size='10' name='altarcade_logosizeh' value='" . $tp->toFORM($pref['altarcade_logosizeh']) . "' />px
                        </td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Games Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_totalcount'] == 1 ? "<input type='checkbox' name='altarcade_enable_totalcount' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_totalcount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Dropdown List of Games:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_playlist'] == 1 ? "<input type='checkbox' name='altarcade_enable_playlist' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_playlist' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Top 3 Winners:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_topthree'] == 1 ? "<input type='checkbox' name='altarcade_enable_topthree' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_topthree' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Top 3 Winner Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_topthreeavatar'] == 1 ? "<input type='checkbox' name='altarcade_enable_topthreeavatar' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_topthreeavatar' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Links:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_links'] == 1 ? "<input type='checkbox' name='altarcade_enable_links' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_links' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Categories:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_cats'] == 1 ? "<input type='checkbox' name='altarcade_enable_cats' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_cats' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='altarcade_catfsize' value='" . $tp->toFORM($pref['altarcade_catfsize']) . "' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Categories Totals:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_catcount'] == 1 ? "<input type='checkbox' name='altarcade_enable_catcount' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_catcount' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number of Category Columns:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='altarcade_catcolms' value='" . $tp->toFORM($pref['altarcade_catcolms']) . "' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Current Tournaments:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_tourscurrent'] == 1 ? "<input type='checkbox' name='altarcade_enable_tourscurrent' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_tourscurrent' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Upcoming Tournaments:</td>
		        <td colspan=2 class='forumheader3'>".($pref['altarcade_enable_toursupcoming'] == 1 ? "<input type='checkbox' name='altarcade_enable_toursupcoming' value='1' checked='checked' />" : "<input type='checkbox' name='altarcade_enable_toursupcoming' value='0' />")."</td>
	        </tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Gold System Support:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold Orbs:</td>
		        <td colspan=2 class='forumheader3'>".($pref['arcadeaddin_enable_gold'] == 1 ? "<input type='checkbox' name='arcadeaddin_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='arcadeaddin_enable_gold' value='0' />")."(All Menus)</td>
	        </tr>










                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Update Settings' class='button' /></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

