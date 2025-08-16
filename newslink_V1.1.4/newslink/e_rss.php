<?php
// *
// e_rss for newslink
// *
if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_PLUGIN."newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}

global $tp;
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = NEWSLINK_RSS_1;
$feed['url'] = 'newslink';
$feed['topic_id'] = '';
$feed['path'] = 'newslink';
$feed['text'] = NEWSLINK_RSS_2 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;

$NEWSLINK_args = "select * from #newslink_category
where find_in_set(newslink_category_read,'".USERCLASS_LIST."')
order by newslink_category_name";

if ($sql->db_Select_gen($NEWSLINK_args))
{
    while ($rowrss = $sql->db_Fetch())
    {
        $feed['name'] = NEWSLINK_RSS_1 . " &gt; " . $rowrss['newslink_category_name'] ;
        $feed['url'] = 'newslink';
        $feed['topic_id'] = $rowrss['newslink_category_id'];
        $feed['path'] = 'newslink';
        $feed['text'] = NEWSLINK_RSS_2 . NEWSLINK_RSS_7 . $rowrss['newslink_category_name'];
        $feed['class'] = '0';
        $feed['limit'] = '9';
        $eplug_rss_feed[] = $feed;
    }
}
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();


if ($newslink_obj->newslink_reader)
{
    if ($this->topicid > 0)
    {
        $NEWSLINK_cat = " and newslink_category = " . $this->topicid . " ";
    }
// get newslink which are visible to this class
    $NEWSLINK_args = "
		select a.newslink_name,a.newslink_id,a.newslink_author,a.newslink_category,a.newslink_approved,s.newslink_category_name,s.newslink_category_id,s.newslink_category_read
		from #newslink_newslink as a
		left join #newslink_category as s
		on s.newslink_category_id = a.newslink_category
		where find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') $NEWSLINK_cat
		and newslink_approved > 0
		order by newslink_posted desc
		LIMIT 0," . $this->limit;

    if ($items = $sql->db_Select_gen($NEWSLINK_args))
    {
        $i = 0;
        while ($rowrss = $sql->db_Fetch())
        {
            $tmp = explode(".", $rowrss['newslink_author']);
            $rss[$i]['author'] = "" . $tmp[1] ;
            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "newslink/newslink.php?0.view." .$rowrss['newslink_id'].".". $rowrss['newslink_category_id'] ;
            $rss[$i]['linkid'] = $tp->toRss($rowrss['newslink_id'],false);
            $rss[$i]['title'] = $tp->toRss($rowrss['newslink_name'],false);
            $rss[$i]['description'] = "";
            if ($this->topicid > 0)
            {
                $rss[$i]['category_name'] = $tp->toRss($rowrss['newslink_category_name'],false) ;
                $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "newslink/newslink.php?0.item." . $rowrss['newslink_category_id']   ;
            }
            else
            {
                $rss[$i]['category_name'] = "";
                $rss[$i]['category_link'] = "";
            }
            $rss[$i]['datestamp'] = $rowrss['newslink_posted'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        $rss[$i]['author'] = "" . $tmp[1];
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "newslink/newslink.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = NEWSLINK_RSS_5;
        $rss[$i]['description'] = NEWSLINK_RSS_6;
        $rss[$i]['category_name'] = "";
        $rss[$i]['category_link'] = '';
        $rss[$i]['datestamp'] = "";
        $rss[$i]['enc_url'] = "";
        $rss[$i]['enc_leng'] = "";
        $rss[$i]['enc_type'] = "";
    }
}
else
{
    $rss[$i]['author'] = "" . $tmp[1];
    $rss[$i]['author_email'] = '';
    $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "newslink/newslink.php";
    $rss[$i]['linkid'] = '';
    $rss[$i]['title'] = NEWSLINK_RSS_3;
    $rss[$i]['description'] = NEWSLINK_RSS_4;
    $rss[$i]['category_name'] = "";
    $rss[$i]['category_link'] = '';
    $rss[$i]['datestamp'] = "";
    $rss[$i]['enc_url'] = "";
    $rss[$i]['enc_leng'] = "";
    $rss[$i]['enc_type'] = "";
}

$eplug_rss_data[] = $rss;

?>