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
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
} 
$recipe_approve = $sql->db_Count('recipemenu_recipes', '(*)', "WHERE recipe_approved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "recipe_menu/images/recipe_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($recipe_approve))
{
    $recipe_approve = 0;
} 
if ($recipe_approve)
{
    $text .= "<a href='" . e_PLUGIN . "recipe_menu/admin_submit.php'>" . RCPEMENU_A85 . ": " . $recipe_approve . "</a>";
} 
else
{
    $text .= RCPEMENU_A85 . ': ' . $recipe_approve;
} 

$text .= '</div>';

?>