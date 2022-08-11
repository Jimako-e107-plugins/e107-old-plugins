<?php

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/English.php");
}
if (!defined('e107_INIT'))
{
    exit;
}
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = "Recipes";
$feed['url'] = 'recipes';
$feed['topic_id'] = '';
$feed['path'] = 'recipe_menu';
$feed['text'] = "RSS Feed for recipes" ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;

// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();
global $pref;

if (check_class($pref['recipe_menu_readclass']))
{
    // get unexpired adds which are approved and are visible to this class
    $eclassf_args = "
    select s.*,c.recipe_category_name from #recipemenu_recipes as s
#left join #recipemenu_category as c on s.recipe_category=c.recipe_category_id
#where s.recipe_approved>0
#order by s.recipe_postedLIMIT 0," . $this->limit;

    if ($items = $sql->db_Select_gen($eclassf_args))
    {
        $i = 0;
        while ($rowrss = $sql->db_Fetch())
        {
            $rss[$i]['author'] = "" . substr($rowrss['recipe_author'], strpos($rowrss['recipe_author'], ".")+1) ;

            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "recipe_menu/recipes.php?0.view." . $rowrss['recipe_id'] ;
            $rss[$i]['linkid'] = $rowrss['recipe_id'];
            $rss[$i]['title'] = $rowrss['recipe_name'];
            $rss[$i]['description'] = $rowrss['recipe_body'];

            $rss[$i]['category_name'] = $rowrss['recipe_category_name'];
            $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "recipe_menu/recipes.php?0.show.0." . $rowrss['recipe_category'] ;
            $rss[$i]['datestamp'] = $rowrss['recipe_posted'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        $rss[$i]['author'] = "" . substr($rowrss['recipe_author'], strpos($rowrss['recipe_author'], ".")+1) ;
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "recipe_menu/recipes.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = "rcp";
        $rss[$i]['description'] = "none";
        $rss[$i]['category_name'] = "";
        $rss[$i]['category_link'] = '';
        $rss[$i]['datestamp'] = "";
        $rss[$i]['enc_url'] = "";
        $rss[$i]['enc_leng'] = "";
        $rss[$i]['enc_type'] = "";
    }
}
$eplug_rss_data[] = $rss;

?>