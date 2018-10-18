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
if ($cacheData = $e107cache->retrieve("nq_reviewer_poster_menu"))
{
    echo $cacheData;
    return;
}

if (!is_object($reviewer_obj))
{
    require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}

$reviewermenu_text = REVIEWER_L19 ;
$reviewer_arg = "select count(reviewer_reviewer_postername) as numrev,reviewer_reviewer_postername from #reviewer_reviewer
group by reviewer_reviewer_postername
order by numrev desc
limit 0," . $REVIEWER_PREF['reviewer_menu_inmenu'];
$sql->db_Select_gen($reviewer_arg, false);

while ($reviewermenu_row = $sql->db_Fetch())
{
    extract($reviewermenu_row);
    $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
    $reviewermenu_postername = $reviewer_tmp[1];
    $reviewer_posterid = $reviewer_tmp[0];

    $reviewermenu_text .= "<br /><img src='" . THEME . "images/bullet2.gif' alt='' /> <span class='smalltext'>
	<strong>
		<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.ulist.$reviewer_posterid'>" . $tp->toHTML($reviewermenu_postername, false) . "</a>
	</strong><br />" . REVIEWER_L20 . " $numrev " . ($numrev == 1?REVIEWER_L21:REVIEWER_L22) . "</span>";
} // while;
    $reviewermenu_text .= "<div style='text-align:center;'><a href='".e_PLUGIN."reviewer/reviewer.php?0.reviewers' >".REVIEWER_L27."</a></div>";
ob_start(); // Set up a new output buffer
$reviewer_obj->tablerender(REVIEWER_L18, $reviewermenu_text,'reviewer_topposter_menu'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set("nq_reviewer_poster_menu", $cache_data); // Save to cache