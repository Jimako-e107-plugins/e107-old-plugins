<?php

if (!defined('e107_INIT'))
{
    exit;
}

if (check_class($pref['recipe_menu_readclass']))
{

    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "recipe_menu/languages/English.php");
    }

    $return_fields = 't.recipe_name,t.recipe_ingredients,t.recipe_source,t.recipe_author,t.recipe_posted,x.recipe_category_name,t.recipe_body,t.recipe_id,x.recipe_category_id';
    $search_fields = array('t.recipe_name', 't.recipe_author','x.recipe_category_name', "t.recipe_body", "t.recipe_ingredients", "t.recipe_source");
    $weights = array('2.5', '1.0', '1.0','2.0', '1.5', '1.0');
    $no_results = LAN_198;
    $where = "";
    $order = array('t.recipe_name' => DESC);
    $table = "recipemenu_recipes as t left join #recipemenu_category as x on recipe_category=recipe_category_id ";

    $ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_recipe', $no_results, $where, $order);
    $text .= $ps['text'];
    $results = $ps['results'];
}
function search_recipe($row)
{
    global $con, $tp;
    $poster_temp=explode(".",$row['recipe_author']);
    $poster_name=$poster_temp[1];
    $datestamp = $con->convert_date($row['recipe_posted'], "long");
    $title = $tp->toHTML($row['recipe_name'], false);
    $link_id = $row['recipe_id'];
    $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "recipe_menu/recipes.php?0.view." . $link_id . "";
    $res['pre_title'] = $title ?RCPEMENU_100 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = RCPEMENU_95 . " " . substr($tp->toFORM($row['recipe_ingredients']), 0, 30) . "\n" . RCPEMENU_96 . " " . substr($tp->toFORM($row['recipe_body']), 0, 30);
    $res['detail'] = RCPEMENU_101 . " " . $datestamp." - ".$poster_name;
    return $res;
}

?>