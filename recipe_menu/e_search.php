<?php
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/English.php");
} 
if (check_class($pref['recipe_menu_readclass']))
{
    $recipemenu_title = RCPEMENU_50;
    $search_info[] = array('sfile' => e_PLUGIN . 'recipe_menu/search.php', 'qtype' => $recipemenu_title, 'refpage' => 'recipes.php');
} 

?>