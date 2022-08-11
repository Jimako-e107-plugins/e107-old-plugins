<?php

if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    @include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
}
else
{
    @include_once(e_PLUGIN . "recipe_menu/languages/English.php");
}

if (!check_class($pref['recipe_menu_readclass']))
{
    exit;
}
if (!is_object($gen)) $gen = new convert;
if (!is_object($tp)) $tp = new e_parse;

$recipemenu_catcount = $sql->db_Count("recipemenu_category", "(*)", "");
$recipemenu_recipecount = $sql->db_Count("recipemenu_recipes", "(*)", "where recipe_approved='1'");
$recipemenu_toapprove = $sql->db_Count("recipemenu_recipes", "(*)", "where recipe_approved='0'");
$recipemenu_text .= RCPEMENU_51 . $recipemenu_recipecount . RCPEMENU_52 . " " . RCPEMENU_53 . " $recipemenu_catcount " . RCPEMENU_54 . "<br />" . RCPEMENU_55 ;
$sql->db_Select("recipemenu_recipes", "*", "where recipe_approved='1' order by recipe_posted desc limit 0," . $pref['recipe_menu_inmenu'], "nowhere");

while ($recipemenu_row = $sql->db_Fetch())
{
    extract($recipemenu_row);
	$recipemenu_postername = substr($recipe_author, strpos($recipe_author, ".")+1);

    $recipemenu_posted = $gen->convert_date($recipe_posted, "short");
    $recipemenu_text .= "<br /><br /><img src='" . THEME . "images/bullet2.gif' alt='' /> <span class='smalltext'>
	<strong><a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view.$recipe_id.$recipe_category.0'>" . $tp->toHTML($recipe_name,false) . "</a></strong></span><br /><span class='smallblacktext'><em> ".$tp->toHTML($recipemenu_postername,false)." " . RCPEMENU_57 . "$recipemenu_posted</em></span>";
} // while;
if ($recipemenu_toapprove > 0)
{
    $recipemenu_text .= "<br /><br /><span class='smalltext'>" . RCPEMENU_51 . $tp->toHTML($recipemenu_toapprove) . RCPEMENU_56 . "</span>";
}

$ns->tablerender($pref['recipe_menu_menutitle'], $recipemenu_text);

?>