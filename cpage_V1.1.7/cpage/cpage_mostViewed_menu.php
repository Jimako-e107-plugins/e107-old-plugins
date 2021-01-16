<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
$cpage_cache_tag = 'nq_cpage_viewmenu';
if ($cacheData = $e107cache->retrieve($cpage_cache_tag)) {
    echo $cacheData;
    return;
}

global $cpage_obj, $tp, $CPAGE_PREF, $PLUGINS_DIRECTORY;
if (!is_object($cpage_obj)) {
    require_once("includes/cpage_class.php");
    $cpage_obj = new cpage;
}
require_once(e_HANDLER . 'date_handler.php');
$cpage_conv = new convert;
$cpage_arg = "select * from #cpage_page where cpage_menu_flag=1 and cpage_unique> 0 and find_in_set(cpage_class,'" . USERCLASS_LIST . "') order by cpage_unique desc,rand()  limit 0," . $CPAGE_PREF['cpage_inmenu'];
$cpage_pagecount = $sql->db_Select_gen($cpage_arg);
$cpage_text = CPAGE_MENU_MV01 ;

if ($sql->db_Select_gen($cpage_arg, false)) {
    while ($cpage_row = $sql->db_Fetch()) {
        $views = $cpage_row['cpage_unique'];
        if ($cpage_row['cpage_showauthor_flag'] == 1) {
            if (!empty($cpage_row['user_name'])) {
                $cpage_postername = $tp->toHTML($cpage_row['user_name'], false, "no_make_clickable emotes_off");
            } else {
                $cpage_poster = explode(".", $cpage_row['cpage_author'], 2);
                $cpage_postername = $tp->toHTML($cpage_poster[1], false, "no_make_clickable emotes_off");
            }
            $cpage_postername = "<span class='smallblacktext'><i> " . CPAGE_MENU_MV02 . ": " . $cpage_postername . "</i></span><br />";
        }
        if ($cpage_row['cpage_showdate_flag'] == 1) {
            // show posted
            $posted = CPAGE_MENU_MV03 . ': ' . $cpage_conv->convert_date($cpage_row['cpage_datestamp'], 'short') . '<br />';
        }
        if ($cpage_row['cpage_lastdate_flag'] == 1) {
            // show posted
            $posted .= CPAGE_MENU_MV04 . ': ' . $cpage_conv->convert_date($cpage_row['cpage_lastupdate'], 'short');
        }
        $cpage_text .= "<br /><br />
{$cpage_obj->bullet}
<span class='smalltext'><b><a href='" .  SITEURL .  $cpage_obj->make_url($tp->toFORM($cpage_row['cpage_link']), $cpage_row['cpage_id'], 0,$tp->toFORM($cpage_row['cpage_title'])) . "'>" . $tp->toHTML($cpage_row['cpage_link'], false, "no_make_clickable emotes_off") . " ($views)</a></b>
</span><br /><span class='smalltext'>$cpage_postername $posted</span>";
    } // while;
} else {
    $cpage_text .= '<br />' . CPAGE_MENU_MV07;
}
ob_start(); // Set up a new output buffer
$ns->tablerender(CPAGE_MENU_MV01, $cpage_text, 'cpage_menu_viewed'); // Render the menu
$cache_data = ob_get_flush(); // Get the menu content, and display it
$e107cache->set($cpage_cache_tag, $cache_data); // Save to cache