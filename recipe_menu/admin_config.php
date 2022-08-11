<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Barry (recipe @ keal.me.uk)
|
|        v2.00 modifications foodisfunagain.com allergy support
|
|        This module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
}

if (e_QUERY == "update")
{
    // Update rest
    $pref['recipe_menu_menutitle'] = $tp->toDB($_POST['recipe_menu_menutitle']);
    $pref['recipe_menu_perpage'] = $tp->toDB($_POST['recipe_menu_perpage']);
    $pref['recipe_menu_readclass'] = $tp->toDB($_POST['recipe_menu_readclass']);
    $pref['recipe_menu_submitclass'] = $tp->toDB($_POST['recipe_menu_submitclass']);
    $pref['recipe_menu_adminclass'] = $tp->toDB($_POST['recipe_menu_adminclass']);
    $pref['recipe_menu_autoclass'] = $tp->toDB($_POST['recipe_menu_autoclass']);
    $pref['recipe_menu_inmenu'] = $tp->toDB($_POST['recipe_menu_inmenu']);
    $pref['recipe_menu_email'] = $tp->toDB($_POST['recipe_menu_email']);
    $pref['recipe_menu_print'] = $tp->toDB($_POST['recipe_menu_print']);
    $pref['recipe_menu_credit'] = $tp->toDB($_POST['recipe_menu_credit']);
    $pref['recipe_menu_preptime'] = $tp->toDB($_POST['recipe_menu_preptime']);
    $pref['recipe_menu_servings'] = $tp->toDB($_POST['recipe_menu_servings']);
    $pref['recipe_menu_nutrition'] = $tp->toDB($_POST['recipe_menu_nutrition']);
    $pref['recipe_menu_width'] = $tp->toDB($_POST['recipe_menu_width']);
    $pref['recipe_menu_height'] = $tp->toDB($_POST['recipe_menu_height']);
    $pref['recipe_menu_ptitle'] = $tp->toDB($_POST['recipe_menu_ptitle']);
    $pref['recipe_menu_deforder'] = $tp->toDB($_POST['recipe_menu_deforder']);
    $pref['recipe_topno'] = $tp->toDB($_POST['recipe_topno']);
    $pref['recipe_rating'] = $tp->toDB($_POST['recipe_rating']);
    $pref['recipe_comments'] = $tp->toDB($_POST['recipe_comments']);
    $pref['recipe_round'] = $tp->toDB($_POST['recipe_round']);
    $pref['recipe_stats'] = $tp->toDB($_POST['recipe_stats']);
    save_prefs();
    $recipe_menu_msgtext = "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A7 . "</strong></td></tr>";
}

$recipe_menu_text .= "<form method='post' action='" . e_SELF . "?update' id='confrecipe'>
<table style='width: 97%;' class='fborder'>
<tr><td colspan='2' class='fcaption'>" . RCPEMENU_A1 . "</td></tr>
$recipe_menu_fmsg $recipe_menu_msgtext";
// Main admin class
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A5 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("recipe_menu_readclass", $tp->toFORM($pref['recipe_menu_readclass']), "off", 'public, nobody, member, main,admin, classes') . "
</td></tr>";
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A6 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("recipe_menu_submitclass", $tp->toFORM($pref['recipe_menu_submitclass']), "off", 'public, nobody, member,main, admin, classes') . "
</td></tr>";
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A130 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("recipe_menu_autoclass", $tp->toFORM($pref['recipe_menu_autoclass']), "off", 'public, nobody, member,main, admin, classes') . "
</td></tr>";
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A131 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("recipe_menu_adminclass", $tp->toFORM($pref['recipe_menu_adminclass']), "off", 'nobody, member, admin, main,classes') . "
</td></tr>";
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A118 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("recipe_stats", $tp->toFORM($pref['recipe_stats']), "off", 'public,guest,nobody, member, admin, main,classes') . "
</td></tr>";
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A8 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='30' name='recipe_menu_menutitle' value='" . $tp->toFORM($pref['recipe_menu_menutitle']) . "' /></td>
</tr>";
// Default sort order
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_121 . "</td>
<td style='width:70%' class='forumheader3'>
<select class='tbox' name='recipe_menu_deforder'>
<option value='0' ".(empty($pref['recipe_menu_deforder'])?"selected='selected'":"").">".RCPEMENU_122."</option>
<option value='1' ".($pref['recipe_menu_deforder']==1?"selected='selected'":"").">".RCPEMENU_123."</option>
<option value='2' ".($pref['recipe_menu_deforder']==2?"selected='selected'":"").">".RCPEMENU_124."</option>
</select>
</td>
</tr>";
// Number of recipes to show
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A9 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_menu_perpage' value='" . $tp->toFORM($pref['recipe_menu_perpage']) . "' /></td>
</tr>";
// Number of recipes in menu
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A61 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_menu_inmenu' value='" . $tp->toFORM($pref['recipe_menu_inmenu']) . "' /></td>
</tr>";
// decimal places in menu
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A61 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_round' value='" . $tp->toFORM($pref['recipe_round']) . "' /></td>
</tr>";
// Number of recipes in top rate menu
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_125 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_topno' value='" . $tp->toFORM($pref['recipe_topno']) . "' /></td>
</tr>";
// picture width
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A113 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_menu_width' value='" . $tp->toFORM($pref['recipe_menu_width']) . "' /></td>
</tr>";
// picture height
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A114 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='recipe_menu_height' value='" . $tp->toFORM($pref['recipe_menu_height']) . "' /></td>
</tr>";
//Show email link
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A87 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_email' value='1'".
($pref['recipe_menu_email']>0?"checked='checked'":"")." /></td>
</tr>";
// Show printable link
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A88 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_print' value='1'".
($pref['recipe_menu_print']>0?"checked='checked'":"")." /></td>
</tr>";
// Show credit
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A96 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_credit' value='1'".
($pref['recipe_menu_credit']>0?"checked='checked'":"")." /></td>
</tr>";
// Show preptime
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A97 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_preptime' value='1'".
($pref['recipe_menu_preptime']>0?"checked='checked'":"")." /></td>
</tr>";
// Show servings
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A98 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_servings' value='1'".
($pref['recipe_menu_servings']>0?"checked='checked'":"")." /></td>
</tr>";
// Show nutrition
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A99 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_menu_nutrition' value='1'".
($pref['recipe_menu_nutrition']>0?"checked='checked'":"")." /></td>
</tr>";
// use rating
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_126 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_rating' value='1'".
($pref['recipe_rating']>0?"checked='checked'":"")." /></td>
</tr>";
// use comments
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_127 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='recipe_comments' value='1'".
($pref['recipe_comments']>0?"checked='checked'":"")." /></td>
</tr>";
// Page Title
$recipe_menu_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . RCPEMENU_A115 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='40' name='recipe_menu_ptitle' value='" . $tp->toFORM($pref['recipe_menu_ptitle']) . "' /></td>
</tr>";
// Submit button
$recipe_menu_text .= "
<tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='" . RCPEMENU_A10 . "' class='button' />\n
</td>
</tr>";

$recipe_menu_text .= "</table></form>";

$ns->tablerender(RCPEMENU_A2, $recipe_menu_text);

require_once(e_ADMIN . "footer.php");

?>
