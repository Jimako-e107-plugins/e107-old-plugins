<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
global $tp, $REVIEWER_PREF, $reviewer_obj , $e107cache;
if ($cacheData = $e107cache->retrieve("nq_reviewer_cat_menu"))
{
    echo $cacheData;
    return;
}
require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}

$reviewermenu_text = REVIEWER_L09;
$reviewer_arg = "select reviewer_category_id,reviewer_category_name,count(reviewer_items_approved=1) as numitems  from #reviewer_category
left join #reviewer_items on reviewer_items_catid=reviewer_category_id
group by reviewer_category_name
";
$sql->db_Select_gen($reviewer_arg, false);

while ($reviewermenu_row = $sql->db_Fetch())
{
    extract($reviewermenu_row);

    $reviewermenu_text .= "<br /><img src='" . THEME . "images/bullet2.gif' alt='' /> <span class='smalltext'>
	<strong>
		<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.list.0.$reviewer_category_id'>" . $tp->toHTML($tp->html_truncate($reviewer_category_name, 20), false) . "</a>
	</strong><br />" . REVIEWER_L10 . " $numitems " . ($numitems == 1?REVIEWER_L11:REVIEWER_L12) . "
	</span>";
} // while;
ob_start(); // Set up a new output buffer
$reviewer_obj->tablerender(REVIEWER_L09, $reviewermenu_text,'reviewer_category'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set("nq_reviewer_cat_menu", $cache_data); // Save to cache
