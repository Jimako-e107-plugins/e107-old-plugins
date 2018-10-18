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
if ($cacheData = $e107cache->retrieve("nq_reviewer_menu"))
{
    echo $cacheData;
    return;
}

if (!is_object($reviewer_obj))
{
    require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}

if (!is_object($gen)) $gen = new convert;

$reviewermenu_catcount = $sql->db_Count("reviewer_category", "(*)", "");
$reviewermenu_reviewercount = $sql->db_Count("reviewer_reviewer", "(*)", "");
$reviewermenu_text = REVIEWER_L02 . " " . $reviewermenu_reviewercount . " " . REVIEWER_L03 . " " . REVIEWER_L04 . " $reviewermenu_catcount " . REVIEWER_L05 . "<br />" . REVIEWER_L06 ;
$reviewer_arg = "select reviewer_items_name,reviewer_items_rate,reviewer_category_id,reviewer_items_id,reviewer_reviewer_id,reviewer_reviewer_postername,reviewer_reviewer_posted from #reviewer_reviewer
left join #reviewer_items on reviewer_reviewer_itemid=reviewer_items_id
left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_items_approved=1
order by reviewer_reviewer_posted desc
limit 0," . $REVIEWER_PREF['reviewer_menu_inmenu'];
$sql->db_Select_gen($reviewer_arg, false);

while ($reviewermenu_row = $sql->db_Fetch())
{
    extract($reviewermenu_row);
    $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
    $reviewermenu_postername = $reviewer_tmp[1];

    $reviewermenu_posted = $gen->convert_date($reviewer_reviewer_posted, "short");
    $reviewermenu_text .= "
	<br /><br /><img src='" . THEME . "images/bullet2.gif' alt='' /> <span class='smalltext'>
	<b>
		<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.item.$reviewer_items_id'>" . $tp->toHTML($tp->html_truncate($reviewer_items_name, 20), false) . "</a>
	</b></span><br />".$reviewer_obj->rate_image($reviewer_items_rate,true) . REVIEWER_L08 . " <span class='smalltext'><i> " . $tp->toHTML($reviewermenu_postername, false) . "</i> " . REVIEWER_L07 . " <i>".$reviewermenu_posted."</i></span>";
} // while;
ob_start(); // Set up a new output buffer
$reviewer_obj->tablerender(REVIEWER_L01, $reviewermenu_text,'reviewer_menu'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set("nq_reviewer_menu", $cache_data); // Save to cache
