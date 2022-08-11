<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/English.php");
}
if (!check_class($pref['recipe_stats']))
{
    require_once(HEADERF);
    print "Not permitted to view stats";
    require_once(FOOTERF);
    exit;
}
$barl = (file_exists(THEME . "images/barl.png") ? THEME . "images/barl.png" : e_PLUGIN . "poll/images/barl.png");
$barr = (file_exists(THEME . "images/barr.png") ? THEME . "images/barr.png" : e_PLUGIN . "poll/images/barr.png");
$bar = (file_exists(THEME . "images/bar.png") ? THEME . "images/bar.png" : e_PLUGIN . "poll/images/bar.png");

require_once(HEADERF);
// Top Items
// Top 10 popular authors
// top 10 popular books
// top 10 rated books
// top 10 rated authors
$recipemenu_gen = new convert;
$recipemenu_dlurl = e_BASE;

$numrecipes = $sql->db_Count("recipemenu_recipes", "(*)", "where recipe_approved > 0", false);

$numcats = $sql->db_Count("recipemenu_category", "(*)", "", false);

$sql->db_Select("recipemenu_recipes", "sum(recipe_views) as numviews", "where recipe_approved>0", false);
$recipemenu_row = $sql->db_Fetch();
$numviews = $recipemenu_row['numviews'];

$recipemenu_arg = "select count(c.comment_item_id) as numpost from #comments as c
left join #recipemenu_recipes as m on comment_item_id =recipe_id
where recipe_approved > 0 and comment_type='recipe'";

$sql->db_Select_gen($recipemenu_arg, false);
$recipemenu_row = $sql->db_Fetch();
$numcom = $recipemenu_row['numpost'];

$latedl .= "
<table class='fborder' style='width:100%;'>
	<tr>
		<td class='fcaption' colspan='4'>" . RCPEMENU_139 . "</td>
	</tr>";
if (file_exists("./images/banner.png"))
{
    $latedl .= "<tr><td class='forumheader3' colspan='4' style='text-align:center;'><img src='./images/banner.png' alt='logo' title='' /></td></tr>";
}
$latedl .= "

	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_148 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . RCPEMENU_149 . "</td>
		<td class='forumheader3' colspan='2'>" . $numrecipes . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . RCPEMENU_150 . "</td>
		<td class='forumheader3' colspan='2'>" . $numcats . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . RCPEMENU_151 . "</td>
		<td class='forumheader3' colspan='2'>" . $numviews . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . RCPEMENU_152 . "</td>
		<td class='forumheader3' colspan='2'>" . $numcom . "</td>
	</tr>			";
// ********************************************************************
// ********************************************************************
// Top 10 Recipes by views
// ********************************************************************
// ********************************************************************
$latedl .= "

	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_131 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_140 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_141 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
// Get top 10 recipes by views
$sql->db_Select("recipemenu_recipes", "recipe_id,recipe_name,recipe_views", "where recipe_approved>0 order by recipe_views desc limit 0,10", "nowhere", false);
while ($recipemenu_row = $sql->db_Fetch())
{
    $percentage = round((($recipemenu_row['recipe_views'] / $numviews) * 100), 2);
    $latedl .= "
    <tr>
    	<td class='forumheader3' ><a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "'><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong></a></td>
		<td class='forumheader3' >" . $recipemenu_row['recipe_views'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10 Recipes by views
// ********************************************************************
// ********************************************************************
// Top 10 recipe posters
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_132 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_144 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_143 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
// Get top 10 authors
$sql->db_Select("recipemenu_recipes", "recipe_author, count(recipe_author) as numpost", "where recipe_approved > 0 group by recipe_author order by numpost desc limit 0,10", "nowhere", false);
while ($recipemenu_row = $sql->db_Fetch())
{
    $percentage = round((($recipemenu_row['numpost'] / $numrecipes) * 100), 2);
    $recipemenu_tmp = explode(".", $recipemenu_row['recipe_author'], 2);
    $latedl .= "
	<tr>
		<td class='forumheader3' ><a href='" . "../../user.php?id." . $recipemenu_tmp[0] . "'><strong>" . $tp->toFORM($recipemenu_tmp[1]) . "</strong></a></td>
		<td class='forumheader3' >" . $recipemenu_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10 Recipe posters
// ********************************************************************
if ($pref['recipe_rating'] > 0)
{
    // ********************************************************************
    // Top 10 Recipes by rating
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_133 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_140 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_145 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
    // Get top 10 authors
    $recipemenu_arg = "select r.*,m.* from #rate as r
left join #recipemenu_recipes as m on rate_itemid=recipe_id
where rate_table='recipe' and recipe_approved > 0
order by rate_rating desc
limit 0,10";
    $sql->db_Select_gen($recipemenu_arg, false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $percentage = round((($recipemenu_row['rate_rating'] / 10) * 100), 2);
        $latedl .= "
    <tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "' ><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong></a></td>
		<td class='forumheader3' >" . $recipemenu_row['rate_rating'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
    } // while
    // end // Top 10 recipes by rating
    // ********************************************************************
}
if ($pref['recipe_comments'] > 0)
{
    // Top 10 recipes by comments
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_134 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_140 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_146 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
    // Get top 10 recipes by comments
    $recipemenu_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #recipemenu_recipes as m on comment_item_id =recipe_id
where recipe_approved > 0 and comment_type='recipe' group by comment_item_id order by numpost desc limit 0,10";

    $sql->db_Select_gen($recipemenu_arg, false);
    while ($recipemenu_row = $sql->db_Fetch())
    {
        $percentage = round((($recipemenu_row['numpost'] / $numcom) * 100), 2);
        $latedl .= "
	<tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $recipemenu_row['recipe_id'] . "' title='" . recipe_menu_LAN_30 . "'><strong>" . $tp->toFORM($recipemenu_row['recipe_name']) . "</strong></a></td>
		<td class='forumheader3' >" . $recipemenu_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
    } // while
    // end // Top 10 recipes by comments
}
// ********************************************************************
// Top 10 Categories by recipes
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_135 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_147 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_143 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
// Get top categories by number of recipes
$recipemenu_arg = "select COUNT(recipe_id) as numpost,c.*,r.* from #recipemenu_category as c
left join #recipemenu_recipes as r on recipe_category_id=recipe_category
where recipe_approved > 0
group by recipe_category_id
order by numpost desc
limit 0,10";
$sql->db_Select_gen($recipemenu_arg, false);
while ($recipemenu_row = $sql->db_Fetch())
{
    $percentage = round((($recipemenu_row['numpost'] / $numrecipes) * 100), 2);

    $latedl .= "
	<tr>
        <td class='forumheader3' ><strong>" . $tp->toFORM($recipemenu_row['recipe_category_name']) . "</strong> </td>
		<td class='forumheader3' >" . $recipemenu_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // top categories by number of recipes
// ********************************************************************
// Top 10 Categories by views
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . RCPEMENU_136 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:25%;'>" . RCPEMENU_147 . "</td>
		<td class='forumheader2' style='width:5%;'>" . RCPEMENU_141 . "</td>
		<td class='forumheader2' style='width:10%;'>" . RCPEMENU_142 . "</td>
		<td class='forumheader2' style='width:60%;'>&nbsp;</td>
	</tr>";
// Get top 10 categories by views
$recipemenu_arg = "select sum(recipe_views) as numpost,c.*,r.* from #recipemenu_category as c
left join #recipemenu_recipes as r on recipe_category_id=recipe_category
group by recipe_category_id
order by numpost desc
limit 0,10";
$sql->db_Select_gen($recipemenu_arg, false);
while ($recipemenu_row = $sql->db_Fetch())
{
    $percentage = round((($recipemenu_row['numpost'] / $numviews) * 100), 2);
    $latedl .= "
	<tr>
        <td class='forumheader3' ><strong>" . $tp->toFORM($recipemenu_row['recipe_category_name']) . "</strong></td>
		<td class='forumheader3' >" . $recipemenu_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage)/2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
$latedl .= "</table>";

$ns->tablerender(RCPEMENU_130, $latedl);
require_once(FOOTERF);

?>