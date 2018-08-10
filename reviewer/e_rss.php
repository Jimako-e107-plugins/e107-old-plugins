<?php
/*
+---------------------------------------------------------------+
|        Reviewer for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
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
global $reviewer_obj;
include_lan(e_PLUGIN.'reviewer/languages/'.e_LANGUAGE.'.php');

if (!is_object($reviewer_obj))
{
require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}
require_once(e_HANDLER . "date_handler.php");
if (!is_object($partnews_gen))
{
    $partnews_gen = new convert;
}
// ##### e_rss.php ---------------------------------------------
// Create both feed types
// reviews
$feed['name'] = REVIEWER_RSS01;
$feed['url'] = 'reviewer';
$feed['topic_id'] = 'reviews';
$feed['path'] = 'reviewer';
$feed['text'] = REVIEWER_RSS02;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// items
$feed['name'] = REVIEWER_RSS01;
$feed['url'] = 'reviewer';
$feed['topic_id'] = 'items';
$feed['path'] = 'reviewer';
$feed['text'] = REVIEWER_RSS03 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();
global  $tp;
$reviewer_sql = new DB;
if (!is_object($gen)) $gen = new convert;


switch ($this->topicid)
{
    case 'reviews':

        $reviewer_args = 'select reviewer_items_name,reviewer_category_id,reviewer_items_id,reviewer_reviewer_review,reviewer_reviewer_id,reviewer_reviewer_postername,reviewer_reviewer_posted from #reviewer_reviewer
left join #reviewer_items on reviewer_reviewer_itemid=reviewer_items_id
left join #reviewer_category on reviewer_items_catid=reviewer_category_id
order by reviewer_reviewer_posted desc
limit 0,' . $this->limit;

        if ($items = $reviewer_sql->db_Select_gen($reviewer_args, false))
        {
            $i = 0;
            while ($rowrss = $reviewer_sql->db_Fetch())
            {
                extract($rowrss);
                $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
                $reviewermenu_postername = $reviewer_tmp[1];

                $reviewermenu_posted = $gen->convert_date($reviewer_reviewer_posted, "short");
                $rss[$i]['author'] = $tp->toRss($reviewermenu_postername, false);
                $rss[$i]['author_email'] = '';
                $rss[$i]['link'] = SITEURL . $PLUGINS_DIRECTORY . 'reviewer/reviewer.php?0.view.' . $reviewer_reviewer_id ;
                $rss[$i]['linkid'] = $tp->toRss($reviewer_reviewer_itemid, false);
                $rss[$i]['title'] = REVIEWER_RSS04.' ' . $tp->toRss($reviewer_items_name, false);;
                $rss[$i]['description'] = $tp->toRss($reviewer_reviewer_review, false);

                $rss[$i]['category_name'] = $tp->toRss('', false);
                $rss[$i]['category_link'] = SITEURL . $PLUGINS_DIRECTORY . "reviewer/index.php";
                $rss[$i]['datestamp'] = $rowrss['partnews_posted'];
                $rss[$i]['enc_url'] = "";
                $rss[$i]['enc_leng'] = "";
                $rss[$i]['enc_type'] = "";
                $i++;
            }
        }
        break;
    case 'items':

        $reviewer_args = 'select reviewer_items_name,reviewer_items_id,reviewer_items_description,reviewer_items_updated,user_name from #reviewer_items
left join #user on user_id=reviewer_items_posterid
order by reviewer_items_updated desc
limit 0,' . $this->limit;

        if ($items = $reviewer_sql->db_Select_gen($reviewer_args, false))
        {
            $i = 0;
            while ($rowrss = $reviewer_sql->db_Fetch())
            {
                extract($rowrss);
              #  $reviewermenu_posted = $gen->convert_date($reviewer_items_updated, "short");
                $rss[$i]['author'] = $tp->toRss($user_name, false);
                $rss[$i]['author_email'] = '';
                $rss[$i]['link'] = SITEURL . $PLUGINS_DIRECTORY . 'reviewer/reviewer.php?0.item.' . $reviewer_items_id ;
                $rss[$i]['linkid'] = $tp->toRss($reviewer_items_id, false);
                $rss[$i]['title'] = REVIEWER_RSS05.' ' . $tp->toRss($reviewer_items_name, false);;
                $rss[$i]['description'] = $tp->toRss($reviewer_items_description, false);

                $rss[$i]['category_name'] = $tp->toRss('', false);
                $rss[$i]['category_link'] = SITEURL . $PLUGINS_DIRECTORY . "reviewer/index.php";
                $rss[$i]['datestamp'] = $rowrss['reviewer_items_updated'];
                $rss[$i]['enc_url'] = "";
                $rss[$i]['enc_leng'] = "";
                $rss[$i]['enc_type'] = "";
                $i++;
            }
        }
        break;
}
$eplug_rss_data[] = $rss;

?>