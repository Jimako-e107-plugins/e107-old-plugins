<?php
// **************************************************************************
// *  Newslinks Menu
// *
// **************************************************************************

global $e107cache, $sql, $tp, $NEWSLINK_PREF, $newslink_obj, $newslink_shortcodes, $newslink_linkurl, $NEWSLINK_MENU,$NEWSLINK_MENU_DETAIL,$NEWSLINK_MENU_HEAD,
$newslink_newslinkcount, $newslink_catcount, $newslink_body, $newslink_category_name, $newslink_postername, $newslink_posted;
if ($newslink_text = $e107cache->retrieve("nq_newslink"))
{
    echo $newslink_text;
}
else
{
    // get template
    if (is_readable(THEME . "newslink_menu_template.php"))
    {
        define(NEWSLINK_THEME, THEME . "newslink_menu_template.php");
    }
    else
    {
        define(NEWSLINK_THEME, e_PLUGIN . "newslink/templates/newslink_menu_template.php");
    }
    require_once(NEWSLINK_THEME);
    require_once(e_PLUGIN . "newslink/includes/newslink_shortcodes.php");
    require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
    if (!is_object($newslink_obj))
    {
        $newslink_obj = new newslink;
    }
    unset($newslink_text);
    $newslink_gen = new convert;
    $newslink_catcount = $sql->db_Count("newslink_category", "(*)", " where find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')");
    $newslink_arg = "select newslink_id from #newslink_newslink left join #newslink_category on newslink_category=newslink_category_id where newslink_approved='1' and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')";
    $newslink_newslinkcount = $sql->db_Select_gen($newslink_arg);
    $newslink_toapprove = $sql->db_Count("newslink_newslink", "(*)", "where newslink_approved='0'");
    $newslink_text .= $tp->parseTemplate($NEWSLINK_MENU_HEAD, false, $newslink_shortcodes);

    $newslink_arg = "select * from #newslink_newslink left join #newslink_category on newslink_category=newslink_category_id where newslink_approved='1' and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') order by newslink_posted desc limit 0," . $NEWSLINK_PREF['newslink_inmenu'];
    $sql->db_Select_gen($newslink_arg, false);

    while ($newslink_row = $sql->db_Fetch())
    {
        extract($newslink_row);
        $newslink_poster = explode(".", $newslink_author, 2);
        $newslink_postername = $tp->toHTML($newslink_poster[1], false);
        $newslink_posted = $newslink_gen->convert_date($newslink_posted, "short");
        if (substr($newslink_link, 0, 4) != "http")
        {
            $newslink_link = "http://" . $newslink_link;
        }
        $newslink_linkurl = "<a href='" . $tp->toFORM($newslink_link) . "' rel='external'>" . $tp->toFORM($newslink_name) . "</a>";
        $newslink_text .= $tp->parseTemplate($NEWSLINK_MENU_DETAIL, false, $newslink_shortcodes);
    } // while;
    ob_start();
    $ns->tablerender(NEWSLINK_95, $newslink_text);
    $newslinkmenu_cache = ob_get_flush();
    $e107cache->set("nq_newslink", $newslinkmenu_cache);
}

?>