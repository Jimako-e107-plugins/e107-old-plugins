<?php
// **************************************************************************
// *  Random Newslink  Menu
// *
// **************************************************************************
if (!defined('e107_INIT'))
{
    exit;
}
if (is_readable(THEME . "newslink_menu_template.php"))
{
    define(NEWSLINK_THEME, THEME . "newslink_menu_template.php");
}
else
{
    define(NEWSLINK_THEME, e_PLUGIN . "newslink/templates/newslink_menu_template.php");
}
require_once(NEWSLINK_THEME);
require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
require_once(e_PLUGIN . "newslink/includes/newslink_shortcodes.php");
global $e107cache, $sql, $tp, $NEWSLINK_PREF, $newslink_obj, $newslink_shortcodes, $newslink_linkurl, $NEWSLINK_RANDOM,
$newslink_newslinkcount, $newslink_catcount, $newslink_body, $newslink_category_name, $newslink_postername, $newslink_posted;

$arg = "select a.newslink_id,a.newslink_name,a.newslink_body,a.newslink_link,a.newslink_author,a.newslink_posted,c.newslink_category_name,c.newslink_category_id from #newslink_newslink as a
		left join #newslink_category as c
		on newslink_category = newslink_category_id
		where find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')
		and newslink_approved > 0
		order by rand() limit 1";
if ($dsel = $sql->db_Select_gen($arg, false))
{
    $newslink_item = $sql->db_Fetch();
    $newslink_gen = new convert;
    extract($newslink_item);
    $newslink_tmp = explode(".", $newslink_item['newslink_author'], 2);
    $newslink_postername = $newslink_tmp[1];
    $newslink_posted = $newslink_gen->convert_date($newslink_item['newslink_posted'], "short");
    if (substr($newslink_link, 0, 4) != "http")
    {
        $newslink_link = "http://" . $newslink_link;
    }
    $newslink_linkurl = "<a href='" . $tp->toFORM($newslink_item['newslink_link']) . "' rel='external'>" . $tp->toFORM($newslink_item['newslink_name']) . "</a>";
    $newslink_rtext = $newslink_text .= $tp->parseTemplate($NEWSLINK_RANDOM, false, $newslink_shortcodes);
}
$ns->tablerender(NEWSLINK_114, $newslink_rtext);

?>