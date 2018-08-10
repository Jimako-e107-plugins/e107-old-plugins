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
global $tp, $sql, $sql2, $REVIEWER_PREF, $reviewer_obj , $e107cache;
if ($cacheData = $e107cache->retrieve("nq_reviewer_cattop_menu"))
{
    echo $cacheData;
    return;
}
require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}

$reviewermenu_text = REVIEWER_L23;
if ($sql2->db_Select('reviewer_category', 'reviewer_category_name,reviewer_category_id', 'order by reviewer_category_name', '', false))
{
    // we have categories
    while ($reviewer_catrow = $sql2->db_fetch())
    {
        extract($reviewer_catrow);
        $reviewermenu_text .= "<br /><img src='" . THEME . "images/bullet2.gif' alt='' /> " . $tp->toHTML($tp->html_truncate($reviewer_category_name, 20)) . '<br />';
        if ($sql->db_Select('reviewer_items', 'reviewer_items_id,reviewer_items_name,reviewer_items_rate', "where reviewer_items_catid=$reviewer_category_id order by reviewer_items_rate desc limit 3", 'nowhere', false))
        {
            while ($reviewermenu_row = $sql->db_Fetch())
            {
                extract($reviewermenu_row);

                $reviewermenu_text .= "
	<span class='smalltext'>
	<strong>
		<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.item.$reviewer_items_id.$reviewer_category_id'>" . $tp->toHTML($tp->html_truncate($reviewer_items_name, 20), false) . "</a>
	</strong> Rating: " . $reviewer_obj->rate_numeric($reviewer_items_rate) . "<br /></span>";
            } // while;
        }
        else
        {
            // no items for this category
            $reviewermenu_text .= REVIEWER_L25;
        }
    }
}
else
{
    // no categories
    $reviewermenu_text .= REVIEWER_L24;
}
ob_start(); // Set up a new output buffer
$reviewer_obj->tablerender(REVIEWER_L09, $reviewermenu_text, 'reviewer_categorytop'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set("nq_reviewer_cattop_menu", $cache_data); // Save to cache
