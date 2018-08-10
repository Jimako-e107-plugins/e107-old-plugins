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
if ($cacheData = $e107cache->retrieve("nq_reviewer_items"))
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


$reviewermenu_text = REVIEWER_IM02 ;
$reviewer_arg = "select reviewer_items_name,reviewer_items_id,reviewer_items_updated,reviewer_items_catid from #reviewer_items
where reviewer_items_approved=1
order by reviewer_items_updated desc
limit 0," . $REVIEWER_PREF['reviewer_menu_inmenu'];
$sql->db_Select_gen($reviewer_arg, false);

while ($reviewermenu_row = $sql->db_Fetch())
{
    extract($reviewermenu_row);

    $reviewermenu_posted = $gen->convert_date($reviewer_items_updated, "short");
    $reviewermenu_text .= "<br /><img src='" . THEME . "images/bullet2.gif' alt='' /> <span class='smalltext'>
	<strong>
		<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.item.$reviewer_items_id.$reviewer_items_catid'>" . $tp->toHTML($tp->html_truncate($reviewer_items_name, 20), false) . "</a>
	</strong>
	<br />" . REVIEWER_IM03 . " <em>$reviewermenu_posted</em></span>";
} // while;
ob_start(); // Set up a new output buffer
$reviewer_obj->tablerender(REVIEWER_IM01, $reviewermenu_text,'reviewer_items'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set("nq_reviewer_items", $cache_data); // Save to cache
