<?php
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/English.php");
}
if (!check_class($pref['recipe_menu_readclass'])) {
	exit;
}
require_once(e_HANDLER . "cache_handler.php");
global $sql, $tp, $pref;
$latedl = $e107cache->retrieve("recipetop_menu", 240);
if (!$latedl)
{
    // Top Items
    // Top 10 popular authors
    // top 10 popular books
    // top 10 rated books
    // top 10 rated authors
    $latedl = "
<script type='text/javascript'>
<!--
function rcpDiv(divid) {

	if (document.getElementById('rcpmenu'+divid).style.display == 'block')
	{
		document.getElementById('rcpmenu'+divid).style.display = 'none';

	}
	else
	{
		document.getElementById('rcpmenu'+divid).style.display = 'block';
	}
}
-->
</script>

	<div id='latedl0' class=\"fborder\">";

    $recipemenu_gen = new convert;
    $recipemenu_imode = (IMODE == "lite"?"lite/":"dark/");
    $rcpmenu_divid = 1;
    $recipemenu_dlurl = e_BASE;
    // ********************************************************************
    // ********************************************************************
    // Top 10 Recipes by views
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
		<div  class='forumheader3' >";
    $rcpmenu_divid = 1;
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_131 . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>

						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>

				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
    }
    // =============preference=========================
    $latedl .= "
				<div style='padding:10px' >";
    // Get top 10 authors
    $sql->db_Select("recipemenu_recipes", "recipe_id,recipe_name,recipe_views", "where recipe_approved>0 order by recipe_views desc limit 0," . $pref['recipe_topno'], "nowhere", false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $latedl .= "<a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "'><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong> (" . $recipemenu_row['recipe_views'] . ")</a><br />";
    } // while
    $latedl .= "
				</div>";
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			</div>
			";
    }
    $latedl .= "
		</div>";
    // end // Top 10 Recipes by views
    // ********************************************************************
    // ********************************************************************
    // Top 10 recipe posters
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
		<div  class='forumheader3' >";
    $rcpmenu_divid = 2;
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_132 . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
    }
    // =============preference=========================
    $latedl .= "
				<div style='padding:10px' >";
    // Get top 10 authors
    $sql->db_Select("recipemenu_recipes", "recipe_author, count(recipe_author) as numpost", "where recipe_approved > 0 group by recipe_author order by numpost desc limit 0," . $pref['recipe_topno'], "nowhere", false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $recipemenu_tmp = explode(".", $recipemenu_row['recipe_author'], 2);

        $latedl .= "<a href='" . "../../user.php?id." . $recipemenu_tmp[0] . "'><strong>" . $tp->toFORM($recipemenu_tmp[1]) . "</strong>" . " (" . $recipemenu_row['numpost'] . ")</a><br />";
    } // while
    $latedl .= "
				</div>";
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "</div>
			";
    }
    $latedl .= "
		</div>";
    // end // Top 10 Recipe posters
    // ********************************************************************
    if ($pref['recipe_rating'] > 0)
    {
        // ********************************************************************
        // Top 10 Recipes by rating
        // ********************************************************************
        // ********************************************************************
        $latedl .= "
		<div  class='forumheader3' >";
        $rcpmenu_divid = 3;
        if (!$pref['rcpmenu_expand'] > 0)
        {
            $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_133 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
        }
        // =============preference=========================
        $latedl .= "
				<div style='padding:10px' >";
        // Get top 10 authors
        $recipemenu_arg = "select r.*,m.* from #rate as r
left join #recipemenu_recipes as m on rate_itemid=recipe_id
where rate_table='recipe' and recipe_approved > 0
order by rate_rating desc
limit 0," . $pref['recipe_topno'];
        $sql->db_Select_gen($recipemenu_arg, false);
        while ($recipemenu_row = $sql->db_Fetch())
        {
            $latedl .= "<a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "' ><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong> (" . $recipemenu_row['rate_rating'] . ")</a><br />";
        } // while
        $latedl .= "
				</div>";
        if (!$pref['rcpmenu_expand'] > 0)
        {
            $latedl .= "
			</div>";
        }
        $latedl .= "
		</div>";
        // end // Top 10 recipes by rating
        // ********************************************************************
    }
    if ($pref['recipe_comments'] > 0)
    {
        // Top 10 recipes by comments
        // ********************************************************************
        // ********************************************************************
        $latedl .= "
		<div  class='forumheader3' >";
        $rcpmenu_divid = 4;
        if (!$pref['rcpmenu_expand'] > 0)
        {
            $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_134 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
        }
        // =============preference=========================
        $latedl .= "
				<div style='padding:10px' >";
        // Get top 10 recipes by comments
        $recipemenu_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #recipemenu_recipes as m on comment_item_id =recipe_id
where recipe_approved > 0 and comment_type='recipe' group by comment_item_id order by numpost desc limit 0," . $pref['recipe_topno'];

        $sql->db_Select_gen($recipemenu_arg, false);
        while ($recipemenu_row = $sql->db_Fetch())
        {
            $latedl .= "<a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "' ><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong> (" . $recipemenu_row['numpost'] . ")</a><br />";
        } // while
        $latedl .= "
				</div>";
        if (!$pref['rcpmenu_expand'] > 0)
        {
            $latedl .= "
			</div>";
        }
        $latedl .= "
		</div>";
        // end // Top 10 recipes by comments
    }
    // ********************************************************************
    // Top 10 Categories by recipes
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
		<div  class='forumheader3' >";
    $rcpmenu_divid = 5;
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_135 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
    }
    // =============preference=========================
    $latedl .= "
				<div style='padding:10px' >";
    // Get top 10 authors
    $recipemenu_arg = "select COUNT(recipe_id) as numpost,c.*,r.* from #recipemenu_category as c
left join #recipemenu_recipes as r on recipe_category_id=recipe_category
where recipe_approved > 0
group by recipe_category_id
order by numpost desc
limit 0," . $pref['recipe_topno'];
    $sql->db_Select_gen($recipemenu_arg, false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $latedl .= "<strong>" . $tp->toFORM($recipemenu_row['recipe_category_name']) . "</strong> (" . $recipemenu_row['numpost'] . ")<br />";
    } // while
    $latedl .= "
				</div>";
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			</div>";
    }
    $latedl .= "
		</div>";
    // end // Top 10 recipes by rating
    // ********************************************************************
    // Top 10 Categories by views
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
		<div  class='forumheader3' >";
    $rcpmenu_divid = 6;
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			<div style='width:100%'>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . RCPEMENU_136 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"rcpDiv(" . $rcpmenu_divid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='rcpcwrtr" . $rcpmenu_divid . "' src='" . e_PLUGIN . "recipe_menu/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='rcpmenu" . $rcpmenu_divid . "' style='display:none' >";
    }
    // =============preference=========================
    $latedl .= "
				<div style='padding:10px' >";
    // Get top 10 authors
    $recipemenu_arg = "select sum(recipe_views) as numpost,c.*,r.* from #recipemenu_category as c
left join #recipemenu_recipes as r on recipe_category_id=recipe_category
group by recipe_category_id
order by numpost desc
limit 0," . $pref['recipe_topno'];
    $sql->db_Select_gen($recipemenu_arg, false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $latedl .= "<strong>" . $tp->toFORM($recipemenu_row['recipe_category_name']) . "</strong> (" . $recipemenu_row['numpost'] . ")<br />";
    } // while
    $latedl .= "
				</div>";
    if (!$pref['rcpmenu_expand'] > 0)
    {
        $latedl .= "
			</div>";
    }
    $latedl .= "
		</div>";
    // end // Top 10 categories by views
    $latedl .= "
	</div>";
    if ($pref['cachestatus'] == 1)
    {
        $e107cache->set("recipetop_menu", $latedl);
    }
}
$ns->tablerender(RCPEMENU_130, $latedl);

?>